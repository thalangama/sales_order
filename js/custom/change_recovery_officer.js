var ORDER_URL = "../controllers/orders_controller.php";
var CHANGE_RECOVERY_OFFICER_URL = "../controllers/change_recovery_officer_controller.php";

jQuery(document).ready(function () {
    pageInit();
    formValidation();
    eventHandler();
});

function pageInit(){
}

function formValidation() {

    $("#frmOrdersSearch").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        rules: {
            "search_order_no": {
                required: true
            }
        },
        errorElement: "div"
    });

    $("#frmChangeRecoveryOfficer").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        rules: {
            "order_no": {
                required: true
            },
            "date": {
                required: true
            },
            "recovery_officer_id": {
                required: true
            }
        },
        errorElement: "div"
    });
}

function eventHandler() {

    $("#btnSearch").on('click', function (e) {
        clearMsg();
        if ($("#frmOrdersSearch").valid()) {
            getOrder();
        }
    });

    $("#btnProcess").on('click', function (e) {
        if($('#frmChangeRecoveryOfficer').valid()){
            process();
        }
    });

}


function getOrder(){

    $("#wait").fadeIn('fast');
    $.ajax
    ({
        type: "POST",
        url: ORDER_URL,
        cache: false,
        async: false,
        data: ({
            REQUEST_TYPE: 'GET',
            order_no: $('#search_order_no').val()
        }),
        dataType: "json",
        timeout: 180000,
        "bAutoWidth": false,
        success: function (data, textStatus) {
            clearFields();
            if (data[0] != null && data[0].id != null) {
                $('#order_id').val(data[0].id);
                $('#order_no').val(data[0].order_no);
                $('#sales_officer_id').val(data[0].sales_officer_id);
                $('#recovery_officer_id').val(data[0].recovery_officer_id);
                $('#date').val(data[0].date);

            }else{
                showMsgError("No Order Found.");
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            clearFields();
            showMsgError(textStatus);
            $("#wait").fadeOut('slow');
        }

    }).done(function (data) {
        $("#wait").fadeOut('slow');
    });
}

function clearFields(){
    $('#search_order_no').val("");
    $('#order_id').val("");
    $('#order_no').val("");
    $('#sales_officer_id').val("");
    $('#recovery_officer_id').val("");
    $('#date').val("");
    return false;
}

function process() {

    order_id = $('#order_id').val();
    if(order_id == '') {
        showMsgError("Search Order before submit");
        return false;
    }
    $("#wait").fadeIn('fast');

    var objData = {
        type: "POST",
        url: CHANGE_RECOVERY_OFFICER_URL,
        cache: false,
        async: false,
        data: ({
            REQUEST_TYPE : 'UPDATE',
            order_id : $('#order_id').val(),
            recovery_officer_id : $('#recovery_officer_id').val()
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