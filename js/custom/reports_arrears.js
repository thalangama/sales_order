var GET_REPORT_URL = "../controllers/reports_controller.php";
var tblReportsSales = "";

jQuery(document).ready(function () {
    pageInit();
    formValidation();
    eventHandler();
});

function pageInit(){

    tblReportsArrears = $('#tblReportsArrears').dataTable({
        "bFilter":false, "bInfo":false, "bPaginate":false, "bSortable":false,  "bDestroy":true,

        "aoColumns": [
            {"sClass": ""},
            {"sClass": ""},
            {"sClass": "numericCol "}
        ],
        "aoColumnDefs":[
            // { "bVisible":false, "aTargets":[7] },
            { "bSortable": false, "aTargets":[ 0,1,2] }
        ],
        "oLanguage":{"sEmptyTable":"<div class='info-text'></div>"}
    });
}

function formValidation() {

    $("#frmReportsArrears").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        rules: {
            "order_no": {
                required: true
            }
        },
        errorElement: "div"
    });

}

function eventHandler() {

    $("#btnSearch").on('click', function (e) {
        if($('#frmReportsArrears').valid()){
            search();
        }
    });

}

function clearFields(){
    $('#order_no').val("");
    return false;
}

function search() {
    $("#wait").fadeIn('fast');

    var objData = {
        type: "POST",
        url: GET_REPORT_URL,
        cache: false,
        async: false,
        data: ({
            REQUEST_TYPE : 'GET_ARREARS',
            order_no : $('#order_no').val()
        }),
        dataType: "json",
        timeout: 180000,
        "bAutoWidth": false,
        success: function (data, textStatus) {
            $('#tblReportsArrears').dataTable().fnClearTable();
            $('#download_order_no').val( $('#order_no').val());
            $('#btnDownload').attr( 'disabled', false);
            var row_count = 1;
            var totalArrears = 0;
            $.each(data, function (counter, item) {
                tblReportsArrears.fnAddData([
                    row_count++,
                    item.month,
                    item.arrears_amount,
                ]);
                totalArrears = parseFloat(totalArrears) + parseFloat(item.arrears_amount);
            });
            clearMsg();
            clearFields();
            if(data.length == 0)
                showMsgSuccess("No records found.");
            var msg = "Total Arrears is " + totalArrears;
            $('#totalArrears').html(msg);
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