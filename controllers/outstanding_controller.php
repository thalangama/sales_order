<?php
include_once '../model/outstanding.php';
include_once '../model/orders.php';

$outstanding = new outstanding();

if($_POST["REQUEST_TYPE"] == 'GET_OUTSTANDING'){
    $data = $outstanding->getOutstand();
    if(isset($data))
        echo (json_encode($data));
}elseif($_POST["REQUEST_TYPE"] == 'GET_DETAILS'){
    $Order = new Order();
    $data = $Order->getOrder();
    $data[1] = $outstanding->orderOutstanding();
    $data[2] = $outstanding->getPaymentHistory();

    if(isset($data))
        echo (json_encode($data));
}