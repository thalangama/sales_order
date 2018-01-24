var currencyMinValue = "-9999999999999999.99";
var currencyMaxValue = "9999999999999999.99";
var MSG_ERROR_ROOT = "msg-area";
var GET_OUTSTANDING_URL = "../controllers/outstanding_controller.php";
var tblOutstanding = null;

jQuery(document).ready(function () {
    pageInit();
    formValidation();
    eventHandler();
});

function pageInit(){
	
	$('#date').datepicker({
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
    $("#frmOutstandingSearch").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        rules: {
            // "cmbLocation": {
            //     required: true
            // },
            // "txtCustomerCode":{
            //     required: function (element) {
            //         return $('#cmbCodeType').val() != '';
            //     }
            // }
        },
        errorElement: "div"
    });
}

function eventHandler() {

    $("#btnSearch").on('click', function (e) {
        clearMsg(MSG_ERROR_ROOT, MSG_ERROR_ROOT);
        if ($("#frmOutstandingSearch").valid()) {
            getOutstanding();
        }
    });

    $("#btnProcess").on('click', function (e) {
        process();
    });

}

function clearMsgData() {
    clearMsg(MSG_ERROR_ROOT, MSG_ERROR_ROOT);
}


function getOutstanding(){

    $('#tblOutstanding').dataTable().fnClearTable();
    $("#wait").fadeIn('fast');
    $.ajax
    ({
        type: "POST",
        url: GET_OUTSTANDING_URL,
        cache: false,
        async: false,
        data: ({
            customer_nic: $('#customer_nic').val(),
            order_no: $('#order_no').val(),
            recovery_officer_id: $('#recovery_officer_id').val(),
            date: $('#date').val()
        }),
        dataType: "json",
        timeout: 180000,
        "bAutoWidth": false,
        success: function (data, textStatus) {
            if (data[0] != null && data[0].order_no != null) {
                row_count = 0;
                total_out = 0;
                $.each(data, function (counter, item) {
                    tblOutstanding.fnAddData([
                        row_count++,
                        item.order_no,
                        item.nic,
                        item.name,
                        (item.to_paied - item.paied)
                    ]);
                    total_out += (item.to_paied - item.paied);
                });
                tblOutstanding.fnAddData([
                    '',
                    '',
                    '',
                    'Total',
                    total_out
                ]);
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