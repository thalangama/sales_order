var currencyMinValue = "-9999999999999999.99";
var currencyMaxValue = "9999999999999999.99";
var MSG_ERROR_ROOT = "msg-area";
var GET_CUSTOMER_URL = "../controllers/customer_creation_controller.php";
var tblOutstanding = null;

jQuery(document).ready(function () {
    pageInit();
    formValidation();
    eventHandler();
});

function pageInit(){
}

function formValidation() {
    $("#frmCustomerSearch").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        rules: {
            "nic": {
                required: true
            },
        },
        errorElement: "div"
    });
}

function eventHandler() {

    $("#btnSearch").on('click', function (e) {
        clearMsg(MSG_ERROR_ROOT, MSG_ERROR_ROOT);
        if ($("#frmCustomerSearch").valid()) {
            getCustomer();
        }
    });

    $("#btnProcess").on('click', function (e) {
        process();
    });

}

function clearMsgData() {
    clearMsg(MSG_ERROR_ROOT, MSG_ERROR_ROOT);
}


function getCustomer(){

    $("#wait").fadeIn('fast');
    $.ajax
    ({
        type: "POST",
        url: GET_CUSTOMER_URL,
        cache: false,
        async: false,
        data: ({
            customer_nic: $('#nic').val()
        }),
        dataType: "json",
        timeout: 180000,
        "bAutoWidth": false,
        success: function (data, textStatus) {
            if (data.nic != null) {
                $('#customer_nic').val(data.nic );
                $('#name').val(data.name );
                $('#address').val(data.address );
                $('#phone_no').val(data.phone_no );
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