var GET_REPORT_URL = "../controllers/reports_controller.php";
var tblReportsRecoveries = "";

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

    tblReportsRecoveries = $('#tblReportsRecoveries').dataTable({
        "bFilter":false, "bInfo":false, "bPaginate":false, "bSortable":false,  "bDestroy":true,

        "aoColumns": [
            {"sClass": ""},
            {"sClass": ""},
            {"sClass": ""},
            {"sClass": "numericCol "},
            {"sClass": ""},
            {"sClass": ""}
        ],
        "aoColumnDefs":[
            // { "bVisible":false, "aTargets":[7] },
            { "bSortable": false, "aTargets":[ 0,1,2,3,4,5] }
        ],
        "oLanguage":{"sEmptyTable":"<div class='info-text'></div>"}
    });
}

function formValidation() {

    $("#frmReportsRecoveries").validate({
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
        if($('#frmReportsRecoveries').valid()){
            search();
        }
    });

}

function clearFields(){
    $('#recovery_officer_id').val("");
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
            REQUEST_TYPE : 'GET_RECOVERIES',
            recovery_officer_id : $('#recovery_officer_id').val(),
            from_date : $('#from_date').val(),
            to_date : $('#to_date').val()
        }),
        dataType: "json",
        timeout: 180000,
        "bAutoWidth": false,
        success: function (data, textStatus) {
            $('#tblReportsRecoveries').dataTable().fnClearTable();
            $('#totalRecovery').html("");
            var row_count = 0;
            var totalRecovery = 0;
            $.each(data, function (counter, item) {
                tblReportsRecoveries.fnAddData([
                    row_count++,
                    item.order_no,
                    item.date,
                    item.officer_id,
                    item.amount,
                    '<a class="detail-open pull-center" title="Remove" target="_blank" href="outstanding_details.php?order_no=' + item.order_no + '"> </a>'
                ]);
                totalRecovery = parseFloat(totalRecovery) + parseFloat(item.amount);
                $('#totalRecovery').val(totalRecovery);
            });
            clearMsg();
            clearFields();
            if(data.length == 0)
                showMsgSuccess("No records found.");
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