var ORDER_URL = "../controllers/orders_controller.php";
var CUSTOMER_URL = "../controllers/customer_creation_controller.php";
var tblAddItems = null;

jQuery(document).ready(function () {
    pageInit();
    formValidation();
    eventHandler();
});

function pageInit(){

    $( "#itemPayment" ).keyup(function() {
        $("#itemBalance").val($("#itemTotal").val() - $("#itemPayment").val());
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
            {"sClass": ""},
            {"sClass": ""},
            {"sClass": ""},
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

    $("#btnSearchCus").on('click', function (e) {
        clearMsg();
        if ($("#frmCustomerSearch").valid()) {
            getCustomer();
        }
    });

    $("#btnProcess").on('click', function (e) {
        process();
    });

    $("#btnAddItems").on('click', function (e) {
        addItems();
        updateBalance();
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
        '<a id="btnRemoveItems" class="deleteFile pull-center" title="Remove" href="#"> </a>'
    ]);
}

function clearFields(){
    $('#search_order_no').val("")
    $('#customer_id').val("");
    $('#name').val("");
    $('#customer_nic').val("");
    $('#address').val("");
    $('#phone_no').val("");
    $('#nic').val("");
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
    return false;
}

function getCustomer(){
    clearMsg();
    $("#wait").fadeIn('fast');

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
                $('#customer_nic').val(data.nic );
                $('#name').val(data.name );
                $('#address').val(data.address );
                $('#phone_no').val(data.phone_no );
            }else{
                showMsgError("No Customer Found.");
            }
            $('#nic').val("");
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
            customer_nic : $('#customer_nic').val(),
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
            payment_date : $('#paymentDate').val()
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
}