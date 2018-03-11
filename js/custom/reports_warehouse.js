var GET_INVENTORY_URL = "../controllers/inventory_controller.php";
var tblInventory = "";

jQuery(document).ready(function () {
    pageInit();
    formValidation();
    eventHandler();
});

function pageInit(){
    tblInventory = $('#tblInventory').dataTable({
        "bFilter":false, "bInfo":false, "bPaginate":false, "bSortable":false,  "bDestroy":true,

        "aoColumns": [
            {"sClass": ""},
            {"sClass": ""},
            {"sClass": ""},
            {"sClass": ""},
            {"sClass": ""},
            {"sClass": ""},
            {"sClass": ""}
        ],
        "aoColumnDefs":[
            // { "bVisible":false, "aTargets":[7] },
            { "bSortable": false, "aTargets":[ 0,1,2,3,4,5,6] }
        ],
        "oLanguage":{"sEmptyTable":"<div class='info-text'></div>"}
    });

    $( "#item_code" ).autocomplete({
        source: item_code
    });

    $( "#warehouse_code" ).autocomplete({
        source: warehouse_code
    });
}

function clearFields(){
    $( "#item_code" ).val("");
    $( "#warehouse_code" ).val("");
    return false;
}

function formValidation() {
}

function eventHandler() {
    $("#btnSearch").on('click', function (e) {
        search();
    });
}

function search() {
    $("#wait").fadeIn('fast');

    var objData = {
        type: "POST",
        url: GET_INVENTORY_URL,
        cache: false,
        async: false,
        data: ({
            REQUEST_TYPE : 'GET_INVENTORY_REPORT',
            warehouseId : $('#warehouse_code').val(),
            itemCode : $('#item_code').val()
        }),
        dataType: "json",
        timeout: 180000,
        "bAutoWidth": false,
        success: function (data, textStatus) {
            $('#tblInventory').dataTable().fnClearTable();
            row_count = 1;
            $.each(data, function (counter, item) {
                tblInventory.fnAddData([
                    row_count++,
                    item.code,
                    item.description,
                    item.warehouse,
                    item.no_of_items,
                    item.min_item_level,
                    item.price
                ]);
            });
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            showMsgError(textStatus);
            $("#wait").fadeOut('slow');
        }
    }
    $.ajax
    (objData).done(function (data) {
        $("#wait").fadeOut('slow');
    });
}