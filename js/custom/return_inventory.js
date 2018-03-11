var INVENTORY_URL = "../controllers/inventory_controller.php";
var InventorySearched = false;

jQuery(document).ready(function () {
    pageInit();
    formValidation();
    eventHandler();
});

function pageInit(){

    $( "#itemCode" ).keyup(function() {
        InventorySearched = false;
        $('#returnItems').val("");
        $('#toWarehouse').val("");
        $('#returnItems').prop('disabled', true);
        $('#toWarehouse').prop('disabled', true);
    });

    $( "#warehouseId" ).keyup(function() {
        InventorySearched = false;
        $('#returnItems').val("");
        $('#toWarehouse').val("");
        $('#returnItems').prop('disabled', true);
        $('#toWarehouse').prop('disabled', true);
    });

    $( "#itemCode" ).autocomplete({
        source: item_code
    });

    $( "#warehouseId" ).autocomplete({
        source: warehouse_code
    });

    $( "#toWarehouse" ).autocomplete({
        source: warehouse_code
    });
}

function formValidation() {
    $("#frmInventorySearch").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        rules: {
            "itemCode": {
                required: true
            },
            "warehouseId": {
                required: true
            }
        },
        errorElement: "div"
    });

    $("#frmInventorySave").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        rules: {
            "returnItems": {
                required: true,
                min:1,
                max: function(){
                    var str = $('#availableItems').val();
                    return parseInt(str);
                },
                number:true
            },
            "toWarehouse": {
                required: true
            }
        },
        errorElement: "div"
    });

}

function eventHandler() {

    $("#btnSearch").on('click', function (e) {
        clearMsg();
        if ($("#frmInventorySearch").valid()) {
            getInventory();
        }
    });

    $("#btnProcess").on('click', function (e) {
        if(InventorySearched == false) {
            showMsgError("Please Search Inventory before Process");
            return false;
        }
        if($('#frmInventorySave').valid() && $('#frmInventorySearch').valid() ){
            process();
        }
    });
}

function getInventory(){
    $('#inventoryId').val("");
    $('#availableItems').val("");
    $('#returnItems').val("");
    $('#toWarehouse').val("");

    $("#wait").fadeIn('fast');
    $.ajax
    ({
        type: "POST",
        url: INVENTORY_URL,
        cache: false,
        async: false,
        data: ({
            REQUEST_TYPE: 'GET',
            item_id: $('#itemCode').val(),
            warehouse_id: $('#warehouseId').val()
        }),
        dataType: "json",
        timeout: 180000,
        "bAutoWidth": false,
        success: function (data, textStatus) {
            $('#availableItems').val('0');
            if (data[0] != null && data[0].id != null) {
                $('#inventoryId').val(data[0].id);
                $('#availableItems').val(data[0].no_of_items);
            }else{
                showMsgError("No Inventory Found.");
            }
            InventorySearched = true;
            $('#returnItems').prop('disabled', false);
            $('#toWarehouse').prop('disabled', false);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            clearFields();
            showMsgError(textStatus);
            $("#wait").fadeOut('slow');
        }

    }).done(function (data) {
        $("#wait").fadeOut('slow');
    });

}

function clearFields(){
    $('#inventoryId').val("");
    $('#itemCode').val("");
    $('#warehouseId').val("");
    $('#availableItems').val("");
    $('#returnItems').val("");
    $('#toWarehouse').val("");

    $('#returnItems').prop('disabled', true);
    $('#toWarehouse').prop('disabled', true);

    return false;
}

function process() {
    clearMsg();
    $("#wait").fadeIn('fast');
    var objData = {
        type: "POST",
        url: INVENTORY_URL,
        cache: false,
        async: false,
        data: ({
            REQUEST_TYPE : 'RETURN',
            itemCode : $('#itemCode').val(),
            warehouseId : $('#warehouseId').val(),
            returnItems : $('#returnItems').val(),
            toWarehouse : $('#toWarehouse').val(),
            inventoryId : $('#inventoryId').val()
        }),
        dataType: "json",
        timeout: 180000,
        "bAutoWidth": false,
        success: function (data, textStatus) {
            clearMsg();
            clearFields();
            showMsgSuccess(data);
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