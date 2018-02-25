var OUTSTANDING_URL = "../controllers/outstanding_controller.php";
var tblAddItems = null;

jQuery(document).ready(function () {
    pageInit();
    formValidation();
    eventHandler();
});

function pageInit(){

    tblAddItems = $('#tblAddItems').dataTable({
        "bFilter":false, "bInfo":false, "bPaginate":false, "bSortable":false,  "bDestroy":true,

        "aoColumns": [
            {"sClass": ""},
            {"sClass": ""},
            {"sClass": ""},
            {"sClass": "numericCol "},
            {"sClass": "numericCol "},
            {"sClass": "numericCol "}
        ],
        "aoColumnDefs":[
            // { "bVisible":false, "aTargets":[7] },
            { "bSortable": false, "aTargets":[ 0,1,2,3,4,5] }
        ],
        "oLanguage":{"sEmptyTable":"<div class='info-text'></div>"}
    });

    tblPaymentHistory = $('#tblPaymentHistory').dataTable({
        "bFilter":false, "bInfo":false, "bPaginate":false, "bSortable":false,  "bDestroy":true,

        "aoColumns": [
            {"sClass": ""},
            {"sClass": "numericCol"},
            {"sClass": ""},
            {"sClass": ""}
        ],
        "aoColumnDefs":[
            // { "bVisible":false, "aTargets":[7] },
            { "bSortable": false, "aTargets":[ 0,1,2,3] }
        ],
        "oLanguage":{"sEmptyTable":"<div class='info-text'></div>"}
    });

    getDetails();
}

function formValidation() {
}

function eventHandler() {

}

function getDetails(){

    total_out = 0;
    $('#tblAddItems').dataTable().fnClearTable();
    $("#wait").fadeIn('fast');
    $.ajax
    ({
        type: "POST",
        url: OUTSTANDING_URL,
        cache: false,
        async: false,
        data: ({
            REQUEST_TYPE: 'GET_DETAILS',
            order_no: order_number
        }),
        dataType: "json",
        timeout: 180000,
        "bAutoWidth": false,
        success: function (data, textStatus) {
            var outstanding = 0;
            if (data[0] != null && data[0].id != null) {
                $('#order_id').val(data[0].id);
                $('#order_no').val(data[0].order_no);
                $('#customer_id').val(data[0].cus_id );
                $('#customer_nic').val(data[0].nic);
                $('#name').val(data[0].name);
                $('#address').val(data[0].address);
                $('#phone_no').val(data[0].phone_no);
                $('#sales_officer_id').val(data[0].sales_officer_id);
                $('#recovery_officer_id').val(data[0].recovery_officer_id);
                $('#date').val(data[0].date);
                $('#itemPayment').val(data[0].payment);
                $('#noOfterms').val(data[0].no_of_terms);
                $('#paymentDate').val(data[0].payment_date);
                $('#invoiceNo').val(data[0].invoice_no);

                row_count = 1;
                itemTotal = 0;
                $.each(data.items, function (counter, item) {
                    tblAddItems.fnAddData([
                        row_count++,
                        item.code,
                        item.description,
                        item.quantity,
                        item.price,
                        item.price*item.quantity
                    ]);
                    itemTotal = itemTotal + (item.price*item.quantity);
                });

                $('#itemTotal').val(itemTotal);
                $('#itemBalance').val(itemTotal - data[0].payment);
                ins = ((itemTotal - data[0].payment) / data[0].no_of_terms);
                $('#installment').val(ins.toFixed(2));
                outstanding = itemTotal - data[0].payment;

            }
            if(data[2] != null ){
                row_count = 1;
                paymentTotal = 0;
                $.each(data[2], function (counter, item) {
                    tblPaymentHistory.fnAddData([
                        row_count++,
                        item.amount,
                        item.payment_date,
                        item.name
                    ]);
                    outstanding = outstanding - item.amount;
                });
            }
            $('#TotalOutstanding').val(outstanding);
            if(data[1] != null && data[1].length != 0 ){
                $('#currentOutstanding').val(data[1][0].to_paied);
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

function updateBalance(){
    table = $('#tblAddItems').DataTable();
    sum = 0;
    var plainArray = table
        .column( 5 )
        .data()
        .toArray();
    $.each(plainArray,function(){sum+=parseFloat(this) || 0;});
    $('#itemTotal').val(sum);
    balance =  sum - (parseFloat($('#itemPayment').val())||0);
    $('#itemBalance').val(balance);
}