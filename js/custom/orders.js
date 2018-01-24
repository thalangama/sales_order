var MSG_ERROR_ROOT = "msg-area";
var GET_ORDER_URL = "../controllers/orders_controller.php";
var tblAddItems = null;

jQuery(document).ready(function () {
    pageInit();
    formValidation();
    eventHandler();
});

function pageInit(){

    $('#date').datepicker({
        format: "yyyy-mm-dd",
        todayHighlight: true  ,
        orientation: "top auto"
    });

    tblAddItems = $('#tblAddItems').dataTable({
        "bFilter":false, "bInfo":false, "bPaginate":false, "bSortable":false,  "bDestroy":true,

        "aoColumns": [
            {"sClass": ""},
            {"sClass": ""},
            {"sClass": ""},
            {"sClass": ""},
            {"sClass": ""}
        ],
        "aoColumnDefs":[
            // { "bVisible":false, "aTargets":[7] },
            { "bSortable": false, "aTargets":[ 0,1,2,3,4] }
        ],
        "oLanguage":{"sEmptyTable":"<div class='info-text'></div>"}
    });

}

function formValidation() {
    $("#frmOrdersSearch").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        rules: {
            "order_no": {
                required: true
            }
        },
        errorElement: "div"
    });
}

function eventHandler() {

    $("#btnSearch").on('click', function (e) {
        clearMsg(MSG_ERROR_ROOT, MSG_ERROR_ROOT);
        if ($("#frmOutstandingSearch").valid()) {
            getOrder();
        }
    });

    $("#btnProcess").on('click', function (e) {
        process();
    });

    $("#btnAddItems").on('click', function (e) {

        alert(1);
        addItems();
    });

}

function clearMsgData() {
    clearMsg(MSG_ERROR_ROOT, MSG_ERROR_ROOT);
}


function getOrder(){

    total_out = 0;
    $('#tblOutstanding').dataTable().fnClearTable();
    $("#wait").fadeIn('fast');
    $.ajax
    ({
        type: "POST",
        url: GET_ORDER_URL,
        cache: false,
        async: false,
        data: ({
            order_no: $('#order_no').val()
        }),
        dataType: "json",
        timeout: 180000,
        "bAutoWidth": false,
        success: function (data, textStatus) {
            if (data[0] != null && data[0].order_no != null) {

            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            showMsgText(MSG_ERROR_ROOT, MSG_ERROR_ROOT, textStatus);
            $("#wait").fadeOut('slow');
        }

    }).done(function (data) {

        $("#wait").fadeOut('slow');
    });

}

function addItems(){
    item = $("#item_code").val().split("::");
    tblAddItems.fnAddData([
        (tblAddItems.data().count() ),
        item[0],
        item[1],
        $("#price").val(),
        '<a class="btn btn-next pull-center draft " href="#" id="btnAddItems">Remove</a>'
    ]);
}