<?php
include '../model/orders.php';

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
}