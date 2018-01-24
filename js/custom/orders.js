/*

var currencyMinValue = "-9999999999999999.99";
var currencyMaxValue = "9999999999999999.99";
var MSG_ERROR_ROOT = "msg-area";
var GET_CUSTOMER_URL = "customer.get";
var PROCESS_CUSTOMER_URL = 'customer.save';

jQuery(document).ready(function () {
    pageInit();
    formValidation();
    eventHandler();
});

function pageInit(){

    tblPayments = $('#tblPayments').dataTable({
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
*/

//newly created for testing
var cellCount = 1;
function addItemIntoTable(){
    var item_code = document.getElementById("item_code").value;
    var price = document.getElementById("price").value;

    if(item_code != "" && price != ""){
        var table = document.getElementById("tblAddItems");

        var row = table.insertRow(cellCount);

        var cellItemCount = row.insertCell(0);
        var cellItemCode = row.insertCell(1);
        var cellItemName = row.insertCell(2);
        var cellPrice = row.insertCell(3);
        var cellAction = row.insertCell(4);

        cellItemCount.innerHTML = cellCount.toString();
        cellItemCode.innerHTML = item_code;
        cellItemName.innerHTML = "Some name";
        cellPrice.innerHTML = "<input type='number'/>";
        cellAction.innerHTML = "Action Link";

        cellCount++;
    }
}

//ended newly created for testing