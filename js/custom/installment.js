var ORDER_URL = "../controllers/orders_controller.php";
var INSTALLMENT_URL = "../controllers/installment_controller.php";

jQuery(document).ready(function () {
    pageInit();
    formValidation();
    eventHandler();
});

function pageInit(){

    $('#payment_date').datepicker({
        dateFormat: "yy-mm-dd",
        todayHighlight: true  ,
        orientation: 'auto'
    });

    tblInstallment = $('#tblInstallment').dataTable({
        "bFilter":false, "bInfo":false, "bPaginate":false, "bSortable":false,  "bDestroy":true,

        "aoColumns": [
            {"sClass": ""},
            {"sClass": ""},
            {"sClass": ""},
            {"sClass": ""},
            {"sClass": ""}
        ],
        "aoColumnDefs":[
            // { "bVisible":false, "aTargets":[7] },
            { "bSortable": false, "aTargets":[ 0,1,2,3,4] }
        ],
        "oLanguage":{"sEmptyTable":"<div class='info-text'></div>"}
    });
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

    $("#frmInstallment").validate({
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
            },
            "payment_date": {
                required: true,
                date: true
            },
            "payment": {
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
        if($('#frmInstallment').valid()){
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
            $('#tblInstallment').dataTable().fnClearTable();
            if (data[0] != null && data[0].id != null) {
                $('#order_id').val(data[0].id);
                $('#order_no').val(data[0].order_no);
                $('#sales_officer_id').val(data[0].sales_officer_id);
                $('#recovery_officer_id').val(data[0].recovery_officer_id);
                $('#date').val(data[0].date);
                getInstallment(data[0].id);
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

function getInstallment(order_id){
    $('#tblInstallment').dataTable().fnClearTable();
    $("#wait").fadeIn('fast');
    $.ajax
    ({
        type: "POST",
        url: INSTALLMENT_URL,
        cache: false,
        async: false,
        data: ({
            REQUEST_TYPE: 'GET_INSTALLMENT',
            order_id: order_id
        }),
        dataType: "json",
        timeout: 180000,
        "bAutoWidth": false,
        success: function (data, textStatus) {
            if (data[0] != null ) {
                var row_count = 1;
                $.each(data, function (counter, item) {
                    tblInstallment.fnAddData([
                        row_count++,
                        item.amount,
                        item.payment_date,
                        item.officer_id,
                        '<a onclick="deletePayment('+ item.id +')" class="deleteFile pull-center" title="Delete" href="#"> </a>'
                    ]);
                });
            }else{
                showMsgError("No Order Found.");
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            $("#wait").fadeOut('slow');
        }

    }).done(function (data) {
        $("#wait").fadeOut('slow');
    });
}

function clearFields(){
    $('#tblInstallment').dataTable().fnClearTable();
    $('#search_order_no').val("")
    $('#order_id').val("");
    $('#order_no').val("");
    $('#sales_officer_id').val("");
    $('#recovery_officer_id').val("");
    $('#date').val("");
    $('#payment_date').val("");
    $('#recovery_officer_id').val("");
    $('#payment').val("");
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
        url: INSTALLMENT_URL,
        cache: false,
        async: false,
        data: ({
            REQUEST_TYPE : 'ADD',
            order_id : $('#order_id').val(),
            payment_date : $('#payment_date').val(),
            recovery_officer_id : $('#recovery_officer_id').val(),
            payment : $('#payment').val(),
        }),
        dataType: "json",
        timeout: 180000,
        "bAutoWidth": false,
        success: function (data, textStatus) {
            $('#tblInstallment').dataTable().fnClearTable();
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

function deletePayment(installment_id){
    if (confirm('Are You Sure, You want delete this Installment ?')) {

        $("#wait").fadeIn('fast');
        var objData = {
            type: "POST",
            url: INSTALLMENT_URL,
            cache: false,
            async: false,
            data: ({
                REQUEST_TYPE : 'DELETE_INSTALLMENT',
                installment_id : installment_id
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
    } else {
        return false;
    }
}