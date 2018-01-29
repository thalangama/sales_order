var ORDER_URL = "../controllers/orders_controller.php";
var CUSTOMER_URL = "../controllers/customer_creation_controller.php";
var tblAddItems = null;

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

    tblAddItems = $('#tblAddItems').dataTable({
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

    $('#tblAddItems tbody').on( 'click', '#btnAddItems', function () {
        $('#tblAddItems').DataTable()
            .row( $(this).parents('tr') )
            .remove()
            .draw();
    } );
}

function formValidation() {
    $("#frmOrdersSearch").validate({
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

                row_count = 1;
                $.each(data.items, function (counter, item) {
                    tblAddItems.fnAddData([
                        row_count++,
                        item.code,
                        item.description,
                        item.price,
                        '<a id="btnAddItems" class="deleteFile pull-center" title="Remove" href="#"> </a>'
                    ]);
                });
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

function addItems(){
    item = $("#item_code").val().split("::");
    tblAddItems.fnAddData([
        $('#tblAddItems >tbody >tr').length ,
        item[0],
        item[1],
        $("#price").val(),
        '<a id="btnAddItems" class="deleteFile pull-center" title="Remove" href="#"> </a>'
    ]);

}

function clearFieldsCus(){
    $('#customer_id').val("");
    $('#name').val("");
    $('#customer_nic').val("");
    $('#address').val("");
    $('#phone_no').val("");
    $('#nic').val("");
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
            items : tblAddItems.fnGetData()
        }),
        dataType: "json",
        timeout: 180000,
        "bAutoWidth": false,
        success: function (data, textStatus) {
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
