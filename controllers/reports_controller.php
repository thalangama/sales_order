<?php
include_once '../model/reports.php';
include_once '../pdf/pdf.php';
include_once '../model/inventory.php';
include_once '../model/outstanding.php';

$reports = new Reports();

if($_POST["REQUEST_TYPE"] == 'GET_SALES'){
    $data = $reports->getSales();
    echo (json_encode($data));
}elseif($_POST["REQUEST_TYPE"] == 'GET_RECOVERIES'){
    $data = $reports->getRecoveries();
    echo (json_encode($data));
}elseif($_POST["REQUEST_TYPE"] == 'GET_LEDGER'){
    $data = $reports->getLedger();
    echo (json_encode($data));
}elseif($_POST["REQUEST_TYPE"] == 'DOWNLOAD'){
    if($_POST["REPORT"] == 'SALES') {
        $dataArray = $reports->getSales();
        $data = [];
        foreach ($dataArray as $key => $value) {
            $data[$key] = [];
            $data[$key][] = $key + 1;
            foreach ($value as $k => $val) {
                $data[$key][] = $val;
            }
        }
        $pdf = new PDF();
        $header = array(['value' => 'NO', 'type' => 'S'], ['value' => 'ORDER NO', 'type' => 'S'], ['value' => 'ORDER DATE', 'type' => 'S'], ['value' => 'SALES OFFICER ID', 'type' => 'S'], ['value' => 'AMOUNT', 'type' => 'C']);
        $fields = array(['code' => 'SALES OFFICER ID', 'value' => (!empty($_POST['sales_officer_id']) ? $_POST['sales_officer_id'] : 'ALL')], ['code' => 'FROM DATE', 'value' => $_POST['from_date']], ['code' => 'TO DATE', 'value' => $_POST['to_date']]);

        $pdf->AddPage('', 'a4');
        $pdf->setPageTitle('SALES REPORT');
        $w = array(15, 35, 40, 55, 35);
    }elseif($_POST["REPORT"] == 'RECOVERIES') {
        $dataArray = $reports->getRecoveries();
        $data = [];
        foreach ($dataArray as $key => $value) {
            $data[$key] = [];
            $data[$key][] = $key + 1;
            foreach ($value as $k => $val) {
                $data[$key][] = $val;
            }
        }
        $pdf = new PDF();
        $header = array(['value' => 'NO', 'type' => 'S'], ['value' => 'ORDER NO', 'type' => 'S'], ['value' => 'ORDER DATE', 'type' => 'S'], ['value' => 'RECOVERY OFFICER ID', 'type' => 'S'], ['value' => 'AMOUNT', 'type' => 'C']);
        $fields = array(['code' => 'RECOVERY OFFICER ID', 'value' => (!empty($_POST['recovery_officer_id']) ? $_POST['recovery_officer_id'] : 'ALL')], ['code' => 'FROM DATE', 'value' => $_POST['from_date']], ['code' => 'TO DATE', 'value' => $_POST['to_date']]);

        $pdf->AddPage('', 'a4');
        $pdf->setPageTitle('RECOVERY REPORT');
        $w = array(15, 35, 40, 55, 35);
    }elseif($_POST["REPORT"] == 'LEDGER') {
        $dataArray = $reports->getLedger();
        $data = [];
        foreach ($dataArray as $key => $value) {
            $data[$key] = [];
            $data[$key][] = $key + 1;
            foreach ($value as $k => $val) {
                $data[$key][] = $val;
            }
        }
        $pdf = new PDF();
        $header = array(['value' => 'NO', 'type' => 'S'], ['value' => 'ORDER NO', 'type' => 'S'], ['value' => 'ORDER DATE', 'type' => 'S'], ['value' => 'CUSTOMER NIC', 'type' => 'S'], ['value' => 'AMOUNT', 'type' => 'C'], ['value' => 'PAYMENT', 'type' => 'C']);
        $fields = array(['code' => 'CUSTOMER NIC', 'value' => (!empty($_POST['customer_nic']) ? $_POST['customer_nic'] : 'ALL')], ['code' => 'FROM DATE', 'value' => $_POST['from_date']], ['code' => 'TO DATE', 'value' => $_POST['to_date']]);

        $pdf->AddPage('', [400,250]);
        $pdf->setPageTitle('LEDGER REPORT');
        $w = array(15, 35, 40, 55, 35);
    }elseif($_POST["REPORT"] == 'WAREHOUSE'){
        $Inventory = new Inventory();
        $dataArray = $Inventory->getInventoryReport();
        $data = [];
        foreach ($dataArray as $key => $value) {
            $data[$key] = [];
            $data[$key][] = $key + 1;
            foreach ($value as $k => $val) {
                $data[$key][] = $val;
            }
        }
        $pdf = new PDF();
        $header = array(['value' => 'NO', 'type' => 'S'], ['value' => 'ITEM CODE', 'type' => 'S'], ['value' => 'ITEM DESCRIPTION', 'type' => 'S'], ['value' => 'WAREHOUSE', 'type' => 'S'], ['value' => 'AVAILABILITY', 'type' => 'N'], ['value' => 'MINIMUM LEVEL', 'type' => 'N'], ['value' => 'PRICE', 'type' => 'C']);
        $fields = array(['code' => 'ITEM CODE', 'value' => (!empty($_POST['itemCode']) ? $_POST['itemCode'] : 'ALL')], ['code' => 'WAREHOUSE CODE', 'value' => (!empty($_POST['warehouseId']) ? $_POST['warehouseId'] : 'ALL')]);

        $pdf->AddPage('', [400,350]);
        $pdf->setPageTitle('WAREHOUSE REPORT');
        $w = array(15, 35, 100, 55, 40, 45, 35);
    }elseif($_POST["REPORT"] == 'OUTSTANDING'){
        $outstanding = new outstanding();
        $dataArray = $outstanding->getOutstand();
        $data = [];
        foreach ($dataArray as $key => $value) {
            $data[$key] = [];
            $data[$key][] = $key + 1;
            foreach ($value as $k => $val) {
                $data[$key][] = $val;
            }
        }
        $pdf = new PDF();
        $header = array(['value' => 'NO', 'type' => 'S'], ['value' => 'ORDER NO', 'type' => 'S'], ['value' => 'CUSTOMER NIC', 'type' => 'S'], ['value' => 'CUSTOMER NAME', 'type' => 'S'], ['value' => 'OUTSTANDING AMOUNT', 'type' => 'C']);
        $fields = array(['code' => 'CUSTOMER NIC', 'value' => (!empty($_POST['customer_nic']) ? $_POST['customer_nic'] : 'ALL')],
                        ['code' => 'ORDER NO', 'value' => (!empty($_POST['order_no']) ? $_POST['order_no'] : 'ALL')],
                        ['code' => 'RECOVERY OFFICER ID', 'value' => (!empty($_POST['recovery_officer_id']) ? $_POST['recovery_officer_id'] : 'ALL')],
                        ['code' => 'DATE', 'value' => (!empty($_POST['date']) ? $_POST['date'] : 'ALL')]);

        $pdf->AddPage('', [450,300]);
        $pdf->setPageTitle('OUTSTANDING REPORT');
        $w = array(15, 35, 55, 100, 65);
    }
    $pdf->setSearchFields($fields);
    $pdf->SetFont('Arial', '', 14);
    $pdf->setTable($header, $data, $w);
    $pdf->Output();
}


