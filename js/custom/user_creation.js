var USER_URL = "../controllers/user_controller.php";

jQuery(document).ready(function () {
    pageInit();
    formValidation();
    eventHandler();
});

function clearFields(){
    $('#search_user_id').val("");
    $('#username').val("");
    $('#firstName').val("");
    $('#lastName').val("");
    $('#empType').val("");
    $('#newPassword').val("");
    $('#confirmPassword').val("");
    return false;
}

function pageInit(){
}

function formValidation() {
    $("#frmUserSearch").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        rules: {
            "search_user_id": {
                required: true
            },
        },
        errorElement: "div"
    });

    $("#frmUserSave").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        rules: {
            "username": {
                required: true
            },
            "firstName": {
                required: true
            },
            "lastName": {
                required: true
            },
            "empType": {
                required: true
            },
            "newPassword": {
                required: true,
                compare_password: true
            },
            "confirmPassword": {
                required: true,
                compare_password: true
            },
        },
        errorElement: "div"
    });

    $.validator.addMethod("compare_password", function(value, element) {
        new_password = $('#newPassword').val();
        confirm_password = $('#confirmPassword').val();
        if(new_password == confirm_password )
            return true;
        else
            return false;
    }, "New Password and Confirm Password mismatch");
}

function eventHandler() {

    $("#btnSearch").on('click', function (e) {
        clearMsg();
        if ($("#frmUserSearch").valid()) {
            getUser();
        }
    });

    $("#btnProcess").on('click', function (e) {
        if($("#frmUserSave").valid()) {
            process();
        }
    });

}

function getUser(){
    clearMsg();
    $("#wait").fadeIn('fast');

    var objData = {
        type: "POST",
        url: USER_URL,
        cache: false,
        async: false,
        data: ({
            REQUEST_TYPE: 'GET_USER',
            username: $('#search_user_id').val()
        }),
        dataType: "json",
        timeout: 180000,
        "bAutoWidth": false,
        success: function (data, textStatus) {
            clearFields();
            if (data.length != 0) {
                data = data[0];
                $('#search_user_id').val("");
                $('#id').val(data.id);
                $('#username').val(data.username);
                $('#firstName').val(data.first_name);
                $('#lastName').val(data.last_name);
                $('#empType').val(data.user_type);
                $('#newPassword').val("");
                $('#confirmPassword').val("");
            }else{
                showMsgError( "No User Found.");
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            showMsgError( textStatus);
            $("#wait").fadeOut('slow');
            $('#nic').val("");
        }
    }

    $.ajax
    (objData).done(function (data) {
        $("#wait").fadeOut('slow');
    });

}

function process() {

    $("#wait").fadeIn('fast');
    id = $('#id').val();
    request_type = 'ADD_USER';
    if(id != '')
        request_type = 'UPDATE_USER';

    var objData = {
        type: "POST",
        url: USER_URL,
        cache: false,
        async: false,
        data: ({
            REQUEST_TYPE : request_type,
            id : id,
            username : $('#username').val(),
            firstName : $('#firstName').val(),
            lastName : $('#lastName').val(),
            empType : $('#empType').val(),
            newPassword : $('#newPassword').val(),
            confirmPassword : $('#confirmPassword').val()
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