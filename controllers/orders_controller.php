<?php
include '../model/orders.php';
include_once '../pdf/pdf.php';

$Order = new Order();

if($_POST["REQUEST_TYPE"] == 'GET'){
    $data = $Order->getOrder();
    if(isset($data))
        echo (json_encode($data));
}elseif($_POST["REQUEST_TYPE"] == 'ADD'){
    $data = $Order->addOrder();
    echo (json_encode($data));
}elseif($_POST["REQUEST_TYPE"] == 'UPDATE'){
    $data = $Order->updateOrder();
    echo (json_encode($data));
}elseif($_POST["REQUEST_TYPE"] == 'PRINT') {
    $_POST["order_no"] = $_POST["print_order_no"];
    $dataArray = $Order->getOrder();

    $data = [];

    foreach ($dataArray['items'] as $key => $value) {
        $data[$key] = [];

        $data[$key][] = 4;

        $data[$key][0] = $value['quantity'];
        $data[$key][1] = $value['description'];
        $data[$key][2] = $value['price'];
        $data[$key][3] = $value['quantity'] * $value['price'];
    }
    $pdf = new PDF();

    $header = array(['value' => 'QTY', 'type' => 'N'], ['value' => 'DETAILS', 'type' => 'S'], ['value' => 'UNIT PRICE', 'type' => 'C'], ['value' => 'NET AMOUNT', 'type' => 'C']);

    $pdf->AddPage('', [400,285]);
    $pdf->setPageTitle(' ');
    $pdf->setPageTitle(' ');
    $pdf->setPageTitle(' ');
    $pdf->setPageTitle(' ');
    $pdf->setPageTitle(' ');
    $w = array(15, 150, 40, 50);

    $pdf->setText('NALEEN HARDWARE                                            SHYATECH INTERNATIONAL (PVT) LTD');
    $pdf->setText('AMBAGASWEWA                                                   MAIN STREET MEDIRIGIRIYA');
    $pdf->setText('                                                                                027 2248166');

    $pdf->setPageTitle(' ');

    $pdf->setText('                                                                                INVOICE NO       :  ' . $_POST['print_order_no']);
    $pdf->setText('                                                                                INVOICE DATE   :  ' . $dataArray[0]["date"]);

    $pdf->setPageTitle(' ');

    $pdf->SetFont('Arial', '', 14);
    $pdf->setPrintTable($header, $data, $w);
    $pdf->Output();
}