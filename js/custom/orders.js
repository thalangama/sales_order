var ORDER_URL = "../controllers/orders_controller.php";
var CUSTOMER_URL = "../controllers/customer_creation_controller.php";
var tblAddItems = null;
var customerSerched = false;

jQuery(document).ready(function () {
    pageInit();
    formValidation();
    eventHandler();
});

function pageInit(){

    $( "#itemPayment" ).keyup(function() {
        $("#itemBalance").val($("#itemTotal").val() - $("#itemPayment").val());
        $("#noOfterms").trigger('keyup');
    });

    $("#noOfterms").keyup( function () {
        balance = $('#itemBalance').val();
        noOfterms = $('#noOfterms').val();
        if(noOfterms != ''){
            installment = balance / noOfterms;
            $('#installment').val(installment.toFixed(2));
        }
    });

    $('#date').datepicker({
        dateFormat: "yy-mm-dd",
        todayHighlight: true  ,
        orientation: "auto"
    });

    $('#paymentDate').datepicker({
        dateFormat: "yy-mm-dd",
        todayHighlight: true  ,
        orientation: 'auto'
    });

    tblAddItems = $('#tblAddItems').dataTable({
        "bFilter":false, "bInfo":false, "bPaginate":false, "bSortable":false,  "bDestroy":true,

        "aoColumns": [
            {"sClass": ""},
            {"sClass": ""},
            {"sClass": ""},
            {"sClass": "numericCol "},
            {"sClass": "numericCol "},
            {"sClass": "numericCol "},
            {"sClass": ""}
        ],
        "aoColumnDefs":[
            // { "bVisible":false, "aTargets":[7] },
            { "bSortable": false, "aTargets":[ 0,1,2,3,4,5,6] }
        ],
        "oLanguage":{"sEmptyTable":"<div class='info-text'></div>"}
    });

    $('#tblAddItems tbody').on( 'click', '#btnRemoveItems', function () {
        $('#tblAddItems').DataTable()
            .row( $(this).parents('tr') )
            .remove()
            .draw();
        updateBalance();
    } );

    $( "#item_code" ).autocomplete({
        source: item_code
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

    $("#frmCustomerSearch").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        rules: {
            "nic": {
                required: true,
                minlength:10
            }
        },
        errorElement: "div"
    });

    $("#frmAddItems").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        rules: {
            "item_code": {
                required: true
            },
            "quantity": {
                required: true,
                number : true
            },
            "price": {
                required: true,
                number:true
            }
        },
        errorElement: "div"
    });

    $("#frmOrdersDetails").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        rules: {
            "order_no": {
                required: true
            },
            "sales_officer_id": {
                required: true
            },
            "date": {
                required: true,
                date:true
            },
            "recovery_officer_id": {
                required: true
            }
        },
        errorElement: "div"
    });

    $("#frmCustomerDetail").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        rules: {
            "name": {
                required: true
            },
            "address": {
                required: true
            },
            "phone_no": {
                required: true,
                number: true,
                minlength:9
            }
        },
        errorElement: "div"
    });

    $("#frmPaymentDetails").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        rules: {
            "itemPayment": {
                required: true,
                number:true
            },
            "invoiceNo": {
                required: true,
                number:true
            },
            "noOfterms": {
                required: true,
                number:true
            },
            "paymentDate": {
                required: true,
                date:true
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

    $("#btnSearchCus").on('click', function (e) {
        clearMsg();
        if ($("#frmCustomerSearch").valid()) {
            getCustomer();
        }
    });

    $("#btnProcess").on('click', function (e) {
        var items = tblAddItems.fnGetData();
        if(items.length == 0) {
            showMsgError("Select Atleast one item");
            return false;
        }

        if($('#frmOrdersDetails').valid() && $('#frmCustomerDetail').valid() && $('#frmPaymentDetails').valid()){
            process();
        }
    });

    $("#btnAddItems").on('click', function (e) {
        if ($("#frmAddItems").valid()) {
            addItems();
            updateBalance();
        }
    });

    $('#nic').on('input', function(){
        customerSerched = false;
        $('#name').prop('disabled', true);
        $('#address').prop('disabled', true);
        $('#phone_no').prop('disabled', true);
    });
}

function clearMsgData() {
    clearMsg();
}

function getOrder(){
    total_out = 0;
    $('#tblAddItems').dataTable().fnClearTable();
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
                customerSerched = true;
                $('#order_id').val(data[0].id);
                $('#order_no').val(data[0].order_no);
                $('#customer_id').val(data[0].cus_id );
                $('#nic').val(data[0].nic);
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
                        item.price*item.quantity,
                        '<a id="btnRemoveItems" class="deleteFile pull-center" title="Remove" href="#"> </a>'
                    ]);
                    itemTotal = itemTotal + (item.price*item.quantity);
                });

                $('#itemTotal').val(itemTotal);
                $('#itemBalance').val(itemTotal - data[0].payment);
                ins = (itemTotal - data[0].payment) / data[0].no_of_terms;
                $('#installment').val(ins.toFixed(2));

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

function addItems(){
    item = $("#item_code").val().split("::");
    tblAddItems.fnAddData([
        $('#tblAddItems >tbody >tr').length ,
        item[0],
        item[1],
        $("#quantity").val(),
        $("#price").val(),
        $("#price").val()*$("#quantity").val(),
        '<a id="btnRemoveItems" class="deleteFile pull-center" title="Remove" > </a>'
    ]);
    $("#item_code").val("");
    $("#quantity").val("");
    $("#price").val("");
}

function clearFields(){
    $('#search_order_no').val("")
    $('#customer_id').val("");
    $('#name').val("");
    $('#nic').val("");
    $('#address').val("");
    $('#phone_no').val("");
    $('#order_id').val("");
    $('#order_no').val("");
    $('#sales_officer_id').val("");
    $('#recovery_officer_id').val("");
    $('#date').val("");
    $('#itemPayment').val("");
    $('#noOfterms').val("");
    $('#paymentDate').val("");
    $('#itemTotal').val("");
    $('#itemBalance').val("");
    $('#invoiceNo').val("");
    $('#item_code').val("");
    $('#quantity').val("");
    $('#price').val("");
    $('#installment').val("");

    $('#tblAddItems').dataTable().fnClearTable();
    return false;
}

function getCustomer(){
    clearMsg();
    $("#wait").fadeIn('fast');
    $('#name').val('');
    $('#address').val('');
    $('#phone_no').val('');
    $('#customer_id').val('');
    customerSerched = true;
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
                $('#name').val(data.name );
                $('#address').val(data.address );
                $('#phone_no').val(data.phone_no );
            }else{
                $('#name').prop('disabled', false);
                $('#address').prop('disabled', false);
                $('#phone_no').prop('disabled', false);
                showMsgError("No Customer Found.");
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            showMsgError( textStatus);
            $("#wait").fadeOut('slow');
        }

    }

    $.ajax
    (objData).done(function (data) {
        $("#wait").fadeOut('slow');
    });
}

function process() {

    clearMsg();
    if(customerSerched == false){
        showMsgError("Search Customer Before Submit.");
        return false;
    }
    $("#wait").fadeIn('fast');
    order_id = $('#order_id').val();
    request_type = 'ADD';
    if (order_id != '')
        request_type = 'UPDATE';
    var objData = {
        type: "POST",
        url: ORDER_URL,
        cache: false,
        async: false,
        data: ({
            REQUEST_TYPE : request_type,
            customer_nic : $('#nic').val(),
            customer_id : $('#customer_id').val(),
            name: $('#name').val(),
            address : $('#address').val(),
            phone_no : $('#phone_no').val(),
            order_id : $('#order_id').val(),
            order_no : $('#order_no').val(),
            sales_officer_id : $('#sales_officer_id').val(),
            recovery_officer_id : $('#recovery_officer_id').val(),
            date : $('#date').val(),
            items : tblAddItems.fnGetData(),
            payment : $('#itemPayment').val(),
            no_of_terms : $('#noOfterms').val(),
            payment_date : $('#paymentDate').val(),
            invoice_no : $('#invoiceNo').val()
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
    noOfterms = $('#noOfterms').val();
    if(noOfterms != ''){
        installment = balance / noOfterms;
        $('#installment').val(installment);
    }

}

function clearFieldsCus(){
    $('#customer_id').val('');
    $('#nic').val('');
    $('#name').val('');
    $('#address').val('');
    $('#phone_no').val('');
}