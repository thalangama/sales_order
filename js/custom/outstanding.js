var currencyMinValue = "-9999999999999999.99";
var currencyMaxValue = "9999999999999999.99";
var MSG_ERROR_ROOT = "msg-area";
var GET_CUSTOMER_URL = "customer.get";
var PROCESS_CUSTOMER_URL = 'customer.save';
var tblOutstanding = null;

jQuery(document).ready(function () {
    pageInit();
    formValidation();
    eventHandler();
});

function pageInit(){
	
	$('#from_date').datepicker({
        format: "yyyy-mm-dd",
        todayHighlight: true  ,
        orientation: "top auto"
    });
	
	$('#to_date').datepicker({
        format: "yyyy-mm-dd",
        todayHighlight: true  ,
        orientation: "top auto"
    });
	
    tblOutstanding = $('#tblOutstanding').dataTable({
        "bFilter":false, "bInfo":false, "bPaginate":false, "bSortable":false,  "bDestroy":true,

        "aoColumns": [
            {"sClass": ""},
            {"sClass": ""},
            {"sClass": ""},
            {"sClass": ""},
            {"sClass": ""},
            {"sClass": ""},
            {"sClass": ""},
            {"sClass": ""}
        ],
        "aoColumnDefs":[
            { "bVisible":false, "aTargets":[7] },
            { "bSortable": false, "aTargets":[ 0,1,2,3,4,5,6] }
        ],
        "oLanguage":{"sEmptyTable":"<div class='info-text'></div>"}
    });

}

function formValidation() {
    $("#frmCustomerSave").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        rules: {
            "cmbLocation": {
                required: true
            },
            "txtCustomerCode":{
                required: function (element) {
                    return $('#cmbCodeType').val() != '';
                }
            }
        },
        errorElement: "div"
    });
}

function eventHandler() {

    $("#btnSearch").on('click', function (e) {
        clearMsgData();
        if ($("#openChequeSpecialApprovalFrm").valid()) {
            getFDDetails();
        }
    });

    $("#btnProcess").on('click', function (e) {
        process();
    });

}

function clearMsgData() {
    clearMsg(MSG_ERROR_ROOT, MSG_ERROR_ROOT);
}


function getFDChequePaymentDetails(fd_no){

    $('#tblOutstanding').dataTable().fnClearTable();
    $.ajax
    ({
        type: "POST",
        url: GET_FD_CHEQUE_PAYMENT_DETAILS + "?rid=" + new Date().getTime(),
        cache: false,
        async: false,
        data: ({ FD_NO: fd_no }),
        dataType: "json",
        timeout: 180000,
        "bAutoWidth": false,
        success: function (data, textStatus) {
            if (data.isSuccess == true) {
                if (data.resultData != null) {
                    $.each(data.resultData, function (counter, item) {
                        tblOutstanding.fnAddData([
                            "<input type='checkbox' id='selectPayment_"+item.PAYMENT_POOL_ID_PK+"' name='isView' id='isView_'>",
                            item.PAYEE_REFERENCE,
                            item.PAYEE_NAME,
                            item.PAYMENT_AMOUNT,
                            "<input type='checkbox' id='print_nic_"+item.PAYMENT_POOL_ID_PK+"' name='isView' id='isView_' checked>",
                            "<input type='checkbox' id='print_bearer_"+item.PAYMENT_POOL_ID_PK+"' name='isView' id='isView_' checked>",
                            "<input type='checkbox' id='is_visit_"+item.PAYMENT_POOL_ID_PK+"' name='isView' id='isView_'>",
                            item.PAYMENT_POOL_ID_PK
                        ]);
                    });
                }
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            showMsgText(MSG_ERROR_ROOT, MSG_ERROR_ROOT, network_unavailable);
        }

    }).done(function (data) {
            $("#wait").fadeOut('slow');
    });

}