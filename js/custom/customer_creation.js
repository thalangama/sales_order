var CUSTOMER_URL = "../controllers/customer_creation_controller.php";

jQuery(document).ready(function () {
    pageInit();
    formValidation();
    eventHandler();
});

function clearFields(){
    $('#customer_id').val("");
    $('#name').val("");
    $('#customer_nic').val("");
    $('#address').val("");
    $('#phone_no').val("");
    $('#nic').val("");
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
            showMsgError( textStatus);
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
            clearMsg();
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