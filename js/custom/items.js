var currencyMinValue = "-9999999999999999.99";
var currencyMaxValue = "9999999999999999.99";
var MSG_ERROR_ROOT = "msg-area";
var GET_ITEMS_URL = "../controllers/items_controller.php";

jQuery(document).ready(function () {
    pageInit();
    formValidation();
    eventHandler();
});

function pageInit(){
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
        clearMsgData();
        if ($("#frmItemSearch").valid()) {
            getItems();
        }
    });

    $("#btnProcess").on('click', function (e) {
        process();
    });

}

function clearMsgData() {
    clearMsg(MSG_ERROR_ROOT, MSG_ERROR_ROOT);
}

function getItems(){

    total_out = 0;
    $('#tblAddItems').dataTable().fnClearTable();
    $("#wait").fadeIn('fast');
    $.ajax
    ({
        type: "POST",
        url: GET_ITEMS_URL,
        cache: false,
        async: false,
        data: ({
            code: $('#search_code').val()
        }),
        dataType: "json",
        timeout: 180000,
        "bAutoWidth": false,
        success: function (data, textStatus) {
            if (data[0] != null && data[0].id != null) {
                $('#id').val(data[0].id);
                $('#code').val(data[0].code);
                $('#description').val(data[0].description);
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
