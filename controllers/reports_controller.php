<?php
include_once '../model/reports.php';
include_once '../pdf/pdf.php';

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

        $pdf->AddPage('', 'a2');
        $pdf->setPageTitle('SALES REPORT');
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
        $header = array(['value' => 'NO', 'type' => 'S'], ['value' => 'ORDER NO', 'type' => 'S'], ['value' => 'ORDER DATE', 'type' => 'S'], ['value' => 'SALES OFFICER ID', 'type' => 'S'], ['value' => 'AMOUNT', 'type' => 'C']);
        $fields = array(['code' => 'SALES OFFICER ID', 'value' => (!empty($_POST['recovery_officer_id']) ? $_POST['recovery_officer_id'] : 'ALL')], ['code' => 'FROM DATE', 'value' => $_POST['from_date']], ['code' => 'TO DATE', 'value' => $_POST['to_date']]);

        $pdf->AddPage('', 'a2');
        $pdf->setPageTitle('SALES REPORT');
    }
    $pdf->setSearchFields($fields);
    $pdf->SetFont('Arial', '', 14);
    $w = array(15, 35, 40, 55, 35);
    $pdf->setTable($header, $data, $w);
    $pdf->Output();
}


