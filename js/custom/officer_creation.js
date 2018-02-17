var OFFICER_URL = "../controllers/officer_creation_controller.php";

jQuery(document).ready(function () {
    pageInit();
    formValidation();
    eventHandler();
});

function clearFields(){
    $('#name').val("");
    $('#nic').val("");
    $('#officer_id').val("");
    $('#id').val("");
    $('#address').val("");
    $('#phone_no').val("");
    $('#search_nic').val("");
    $('#search_officer_id').val("");
    return false;
}

function pageInit(){

}

function formValidation() {
    $("#frmOfficerSearch").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        rules: {
            "search_nic": {
                atleast_one_required: true,
                minlength:10
            },
            "search_officer_id": {
                atleast_one_required: true
            }
        },
        errorElement: "div"
    });
    $.validator.addMethod("atleast_one_required", function(value, element) {
        search_nic = $('#search_nic').val();
        search_officer_id = $('#search_officer_id').val();
        if(search_nic != '' || search_officer_id != '')
            return true;
        else
            return false;
    }, "Please Enter at least one of Search input");

    $("#frmOfficerSave").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        rules: {
            "nic": {
                required: true
            },
            "name": {
                required: true
            },
            "address": {
                required: true
            },
            "phone_no": {
                required: true,
                number:true,
                minlength:9,
                maxlength:10
            },
            "officer_id": {
                required: true
            }
        },
        errorElement: "div"
    });
}

function eventHandler() {

    $("#btnSearch").on('click', function (e) {
        clearMsg();
        if ($("#frmOfficerSearch").valid()) {
            getOfficer();
        }
    });

    $("#btnProcess").on('click', function (e) {
        if ($("#frmOfficerSave").valid()) {
            process();
        }
    });

}

function getOfficer(){
    $("#wait").fadeIn('fast');

    var objData = {
        type: "POST",
        url: OFFICER_URL,
        cache: false,
        async: false,
        data: ({
            REQUEST_TYPE : 'GET',
            nic : $('#search_nic').val(),
            officer_id : $('#search_officer_id').val()
        }),
        dataType: "json",
        timeout: 180000,
        "bAutoWidth": false,
        success: function (data, textStatus) {
            clearFields();
            if (data.nic != null) {
                $('#id').val(data.id );
                $('#nic').val(data.nic );
                $('#name').val(data.name );
                $('#address').val(data.address );
                $('#phone_no').val(data.phone );
                $('#officer_id').val(data.officer_id );
            }else{
                showMsgError("No Officer Found.");
                clearFields();
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            clearMsg();
            clearFields();
            showMsgError(textStatus);
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
    var id = $('#id').val();
    var request_type = 'ADD';
    if (id != '')
        request_type = 'UPDATE';
    var objData = {
        type: "POST",
        url: OFFICER_URL,
        cache: false,
        async: false,
        data: ({
            REQUEST_TYPE: request_type,
            officer_nic: $('#nic').val(),
            id: id,
            officer_id: $('#officer_id').val(),
            name: $('#name').val(),
            address: $('#address').val(),
            phone_no: $('#phone_no').val()
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