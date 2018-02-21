var CHANGE_PASSWORD_URL = "../controllers/change_password_controller.php";

jQuery(document).ready(function () {
    pageInit();
    formValidation();
    eventHandler();
});

function pageInit(){
}

function formValidation() {

    $("#frmChangePassword").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        rules: {
            "current_password": {
                required: true
            },
            "new_password": {
                required: true,
                compare_password: true
            },
            "confirm_password": {
                required: true,
                compare_password: true
            }
        },
        errorElement: "div"
    });

    $.validator.addMethod("compare_password", function(value, element) {
        new_password = $('#new_password').val();
        confirm_password = $('#confirm_password').val();
        if(new_password == confirm_password )
            return true;
        else
            return false;
    }, "New Password and Confirm Password mismatch");
}

function eventHandler() {

    $("#btnProcess").on('click', function (e) {
        if($('#frmChangePassword').valid()){
            process();
        }
    });

}

function clearFields(){
    $('#current_password').val("");
    $('#new_password').val("");
    $('#confirm_password').val("");
    return false;
}

function process() {
    //test
    $("#wait").fadeIn('fast');

    var objData = {
        type: "POST",
        url: CHANGE_PASSWORD_URL,
        cache: false,
        async: false,
        data: ({
            REQUEST_TYPE : 'UPDATE_PASSWORD',
            current_password : $('#current_password').val(),
            new_password : $('#new_password').val(),
            confirm_password : $('#confirm_password').val()
        }),
        dataType: "json",
        timeout: 180000,
        "bAutoWidth": false,
        success: function (data, textStatus) {
            $('#tblAddItems').dataTable().fnClearTable();
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