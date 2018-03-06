var GET_REPORT_URL = "../controllers/reports_controller.php";
var tblReportsLedger = "";

jQuery(document).ready(function () {
    pageInit();
    formValidation();
    eventHandler();
});

function pageInit(){

    $('#to_date').datepicker({
        dateFormat: "yy-mm-dd",
        todayHighlight: true  ,
        orientation: "auto"
    });

    $('#from_date').datepicker({
        dateFormat: "yy-mm-dd",
        todayHighlight: true  ,
        orientation: "auto"
    });

    tblReportsLedger = $('#tblReportsLedger').dataTable({
        "bFilter":false, "bInfo":false, "bPaginate":false, "bSortable":false,  "bDestroy":true,

        "aoColumns": [
            {"sClass": ""},
            {"sClass": ""},
            {"sClass": ""},
            {"sClass": "numericCol "},
            {"sClass": "numericCol "},
            {"sClass": ""},
            {"sClass": ""}
        ],
        "aoColumnDefs":[
            // { "bVisible":false, "aTargets":[7] },
            { "bSortable": false, "aTargets":[ 0,1,2,3,4,5,6] }
        ],
        "oLanguage":{"sEmptyTable":"<div class='info-text'></div>"}
    });
}

function formValidation() {

    $("#frmReportsLedger").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        rules: {
            "from_date": {
                required: true,
                compare_date_from:true
            },
            "to_date": {
                required: true,
                compare_date_to: true
            }
        },
        errorElement: "div"
    });

    $.validator.addMethod("compare_date_to", function(value, element) {
        var from_date = $('#from_date').val();
        from_date = from_date.split("-");
        from_date = from_date[0]+"/"+from_date[1]+"/"+from_date[2];
        from_date = new Date(from_date).getTime();

        var to_date = $('#to_date').val();
        to_date = to_date.split("-");
        to_date = to_date[0]+"/"+to_date[1]+"/"+to_date[2];
        to_date = new Date(to_date).getTime();
        if(from_date <= to_date )
            return true;
        else
            return false;
    }, "To Date should greater than From Date");

    $.validator.addMethod("compare_date_from", function(value, element) {
        var from_date = $('#from_date').val();
        from_date = from_date.split("-");
        from_date = from_date[0]+"/"+from_date[1]+"/"+from_date[2];
        from_date = new Date(from_date).getTime();

        var to_date = $('#to_date').val();
        to_date = to_date.split("-");
        to_date = to_date[0]+"/"+to_date[1]+"/"+to_date[2];
        to_date = new Date(to_date).getTime();
        if(from_date <= to_date )
            return true;
        else
            return false;
    }, "From Date should less than To Date");
}

function eventHandler() {

    $("#btnSearch").on('click', function (e) {
        if($('#frmReportsLedger').valid()){
            search();
        }
    });

}

function clearFields(){
    $('#customer_nic').val("");
    $('#from_date').val("");
    $('#to_date').val("");
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
            REQUEST_TYPE : 'GET_LEDGER',
            customer_nic : $('#customer_nic').val(),
            from_date : $('#from_date').val(),
            to_date : $('#to_date').val()
        }),
        dataType: "json",
        timeout: 180000,
        "bAutoWidth": false,
        success: function (data, textStatus) {
            $('#tblReportsLedger').dataTable().fnClearTable();
            $('#totalLedger').html("");
            var row_count = 1;
            var totalLedger = 0;
            var totalRecovery = 0;
            $.each(data, function (counter, item) {
                tblReportsLedger.fnAddData([
                    row_count++,
                    item.order_no,
                    item.date,
                    item.amount,
                    item.payment,
                    item.customer_nic,
                    '<a class="detail-open pull-center" title="Remove" target="_blank" href="outstanding_details.php?order_no=' + item.order_no + '"> </a>'
                ]);
                totalLedger = parseFloat(totalLedger) + parseFloat(item.amount);
                totalRecovery = parseFloat(totalRecovery) + parseFloat(item.amount);
            });
            clearMsg();
            clearFields();
            if(data.length == 0)
                showMsgSuccess("No records found.");
            var msg = "Total Sale is " + totalLedger;
            $('#totalLedger').html(msg);
            var msg = "Total Recovery is " + totalRecovery;
            $('#totalRecovery').html(msg);
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