<?php
include '../model/warehouses.php';

$Warehouses = new Warehouses();
if($_POST["REQUEST_TYPE"] == 'GET'){
    $data = $Warehouses->getWarehouses();
    if(isset($data))
        echo (json_encode($data));
}elseif($_POST["REQUEST_TYPE"] == 'ADD'){
    $data = $Warehouses->addWarehouses();
    echo (json_encode($data));
}elseif($_POST["REQUEST_TYPE"] == 'UPDATE'){
    $data = $Warehouses->updateWarehouses();
    echo (json_encode($data));;
}