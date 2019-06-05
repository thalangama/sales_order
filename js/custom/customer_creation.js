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
    $('#is_blacklist').prop('checked', false);
    return false;
}

function pageInit(){

    $('#name').autocomplete({
        serviceUrl: CUSTOMER_URL + '?REQUEST_TYPE=GET_SUGGESTION' ,
        onSelect: function (suggestion) {

            console.log(suggestion);
            $("#nic").val(suggestion.data);
        },
        onSearchStart: function (query) {
            query.rid = new Date().getTime();
            $("#nic").val("");
        },
        onSearchError: function (query, jqXHR, textStatus, errorThrown) {
            $('#name').val('');
            $('#name').val('');
        },
        transformResult: function(response) {
            if(JSON.parse(response).length > 0){
                return {
                    suggestions: $.map(JSON.parse(response), function(dataItem) {
                        return { value: dataItem.value, data: dataItem.label };
                    })
                }
            }else{
                $('#name').val('');
                $('#nic').val('');
                return {
                    suggestions:[]
                }
            }
        },
        minChars: 3,
        noCache: true
    });
}

function formValidation() {
    $("#frmCustomerSearch").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        rules: {
            "nic": {
                required: true,
                minlength:10,
            },
        },
        errorElement: "div"
    });

    $("#frmCustomerSave").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        rules: {
            "name": {
                required: true
            },
            "customer_nic": {
                required: true,
                minlength:10,
            },
            "address": {
                required: true
            },
            "phone_no": {
                required: true,
                number: true,
                minlength:9,
                maxlength:10
            }
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
        if($('#frmCustomerSave').valid()) {
            process();
        }
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
                $('#is_blacklist').prop('checked', false);
                if(data.is_blacklist == 1)
                    $('#is_blacklist').prop('checked', true);
            }else{
                showMsgError( "No Customer Found.");
            }
            $('#nic').val("");
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
            phone_no : $('#phone_no').val(),
            is_blacklist : $("input[type='checkbox']").is(":checked")
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