var GET_OUTSTANDING_URL = "../controllers/outstanding_controller.php";
var tblOutstanding = null;

jQuery(document).ready(function () {
    pageInit();
    formValidation();
    eventHandler();
});

function pageInit(){
	
	$('#date').datepicker({
        dateFormat: "yy-mm-dd",
        todayHighlight: true  ,
        orientation: "auto"
    });
	
    tblOutstanding = $('#tblOutstanding').dataTable({
        "bFilter":false, "bInfo":false, "bPaginate":false, "bSortable":false,  "bDestroy":true,

        "aoColumns": [
            {"sClass": ""},
            {"sClass": ""},
            {"sClass": ""},
            {"sClass": ""},
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
    $("#frmOutstandingSearch").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        rules: {
            "date": {
                date: true
            }
        },
        errorElement: "div"
    });
}

function eventHandler() {

    $("#btnSearch").on('click', function (e) {
        clearMsg();
        if ($("#frmOutstandingSearch").valid()) {
            getOutstanding();
        }
    });
}

function getOutstanding(){

    total_out = 0;
    $('#tblOutstanding').dataTable().fnClearTable();
    $("#wait").fadeIn('fast');
    $.ajax
    ({
        type: "POST",
        url: GET_OUTSTANDING_URL,
        cache: false,
        async: false,
        data: ({
            REQUEST_TYPE: 'GET_OUTSTANDING',
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
                row_count = 1;
                $.each(data, function (counter, item) {
                    tblOutstanding.fnAddData([
                        row_count++,
                        item.order_no,
                        item.nic,
                        item.name,
                        (item.to_paied ),
                        '<a class="detail-open pull-center" title="Remove" target="_blank" href="outstanding_details.php?order_no=' + item.order_no + '"> </a>'
                    ]);
                    total_out += parseFloat(item.to_paied);
                    if(data.length < row_count){
                        tblOutstanding.fnAddData([
                            row_count,
                            '',
                            '',
                            'Total Outstanding',
                            total_out,
                            ''
                        ]);
                    }
                });
            }else{
                showMsgError("No Record Found.");
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            showMsgError(textStatus);
            $("#wait").fadeOut('slow');
        }

    }).done(function (data) {

        $("#wait").fadeOut('slow');
    });

}