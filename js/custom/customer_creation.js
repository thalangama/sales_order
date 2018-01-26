
var currencyMinValue = "-9999999999999999.99";
var currencyMaxValue = "9999999999999999.99";
var MSG_ERROR_ROOT = "error-msg";
var MSG_SUCCESS_ROOT = "success-msg";
var CUSTOMER_URL = "../controllers/customer_creation_controller.php";
var tblOutstanding = null;

jQuery(document).ready(function () {
    pageInit();
    formValidation();
    eventHandler();
});

function clearFields(){
    document.getElementById('customer_id').value = "";
    document.getElementById('name').value = "";
    document.getElementById('customer_nic').value = "";
    document.getElementById('address').value = "";
    document.getElementById('phone_no').value = "";
    return false;
}

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
        clearMsg();
        if ($("#frmCustomerSearch").valid()) {
            getCustomer();
        }
    });

    $("#btnProcess").on('click', function (e) {
        process();
    });

}

function getCustomer(){
    clearMsg();
    $("#wait").fadeIn('fast');

    var objData = {
        type: "POST",
        url: CUSTOMER_URL,
        cache: false,
        async: false,
        data: ({
            REQUEST_TYPE: 'GET',
            customer_nic: $('#nic').val()
        }),
        dataType: "json",
        timeout: 180000,
        "bAutoWidth": false,
        success: function (data, textStatus) {
            if (data.nic != null) {
                $('#customer_id').val(data.id );
                $('#customer_nic').val(data.nic );
                $('#name').val(data.name );
                $('#address').val(data.address );
                $('#phone_no').val(data.phone_no );
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            showMsgText(MSG_ERROR_ROOT, textStatus);
            $("#wait").fadeOut('slow');
        }

    }

    $.ajax
    (objData).done(function (data) {
        $("#wait").fadeOut('slow');
    });

}


function process() {

    $("#wait").fadeIn('fast');
    id = $('#customer_id').val();
    request_type = 'ADD';
    if(id != '')
        request_type = 'UPDATE';
    var objData = {
        type: "POST",
        url: CUSTOMER_URL,
        cache: false,
        async: false,
        data: ({
            REQUEST_TYPE : request_type,
            customer_nic : $('#customer_nic').val(),
            customer_id : id,
            name: $('#name').val(),
            address : $('#address').val(),
            phone_no : $('#phone_no').val()
        }),
        dataType: "json",
        timeout: 180000,
        "bAutoWidth": false,
        success: function (data, textStatus) {
            showMsgText(MSG_SUCCESS_ROOT, data);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            showMsgText(MSG_ERROR_ROOT, textStatus);
            $("#wait").fadeOut('slow');
        }
    }
    $.ajax
    (objData).done(function (data) {
        $("#wait").fadeOut('slow');
    });

}