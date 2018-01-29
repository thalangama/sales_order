var ITEMS_URL = "../controllers/items_controller.php";

jQuery(document).ready(function () {
    pageInit();
    formValidation();
    eventHandler();
});

function pageInit(){
}

function clearFields(){
    $('#search_code').val("");
    $('#item_id').val("");
    $('#code').val("");
    $('#description').val("");
    return false;
}

function formValidation() {
    $("#frmItemSearch").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        rules: {
            "item_code": {
                required: true
            }
        },
        errorElement: "div"
    });
}

function eventHandler() {

    $("#btnSearch").on('click', function (e) {
        clearMsg();
        if ($("#frmItemSearch").valid()) {
            getItems();
        }
    });

    $("#btnProcess").on('click', function (e) {
        process();
    });

}

function getItems(){

    $('#tblAddItems').dataTable().fnClearTable();
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
                $('#item_id').val(data[0].id);
                $('#code').val(data[0].code);
                $('#description').val(data[0].description);
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
    item_id = $('#item_id').val();
    request_type = 'ADD';
    if (item_id != '')
        request_type = 'UPDATE';
    var objData = {
        type: "POST",
        url: ITEMS_URL,
        cache: false,
        async: false,
        data: ({
            REQUEST_TYPE : request_type,
            id : item_id,
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