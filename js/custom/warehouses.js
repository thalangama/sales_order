var ITEMS_URL = "../controllers/warehouses_controller.php";

jQuery(document).ready(function () {
    pageInit();
    formValidation();
    eventHandler();
});

function pageInit(){
}

function clearFields(){
    $('#search_code').val("");
    $('#warehouse_id').val("");
    $('#code').val("");
    $('#description').val("");
    return false;
}

function formValidation() {
    $("#frmWarehouseSearch").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        rules: {
            "search_code": {
                required: true
            }
        },
        errorElement: "div"
    });

    $("#frmWarehouseSave").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        rules: {
            "code": {
                required: true
            },
            "description": {
                required: true
            }
        },
        errorElement: "div"
    });
}

function eventHandler() {

    $("#btnSearch").on('click', function (e) {
        clearMsg();
        if ($("#frmWarehouseSearch").valid()) {
            getWarehouses();
        }
    });

    $("#btnProcess").on('click', function (e) {
        if($('#frmWarehouseSave').valid()) {
            process();
        }
    });

}

function getWarehouses(){

    $('#tblAddWarehouses').dataTable().fnClearTable();
    $("#wait").fadeIn('fast');
    $.ajax
    ({
        type: "POST",
        url: ITEMS_URL,
        cache: false,
        async: false,
        data: ({
            REQUEST_TYPE : 'GET',
            code : $('#search_code').val()
        }),
        dataType: "json",
        timeout: 180000,
        "bAutoWidth": false,
        success: function (data, textStatus) {
            clearFields();
            if (data[0] != null && data[0].id != null) {
                $('#warehouse_id').val(data[0].id);
                $('#code').val(data[0].code);
                $('#description').val(data[0].description);
            }else{
                showMsgError( "No Warehouse Found.");
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            showMsgError( textStatus);
            $("#wait").fadeOut('slow');
        }

    }).done(function (data) {
        $("#wait").fadeOut('slow');
    });

}

function process() {

    $("#wait").fadeIn('fast');
    warehouse_id = $('#warehouse_id').val();
    request_type = 'ADD';
    if (warehouse_id != '')
        request_type = 'UPDATE';
    var objData = {
        type: "POST",
        url: ITEMS_URL,
        cache: false,
        async: false,
        data: ({
            REQUEST_TYPE : request_type,
            id : warehouse_id,
            code : $('#code').val(),
            description : $('#description').val()
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