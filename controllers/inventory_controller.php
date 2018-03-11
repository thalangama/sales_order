<?php
include '../model/inventory.php';

$Inventory = new Inventory();
if($_POST["REQUEST_TYPE"] == 'GET'){
    $data = $Inventory->getInventory();
    if(isset($data))
        echo (json_encode($data));
}elseif($_POST["REQUEST_TYPE"] == 'UPDATE'){
    $data = $Inventory->updateInventory();
    echo (json_encode($data));
}elseif($_POST["REQUEST_TYPE"] == 'RETURN'){
    $data = $Inventory->returnInventory();
    echo (json_encode($data));
}elseif($_POST["REQUEST_TYPE"] == 'GET_INVENTORY_DASHBOARD'){
    $data = $Inventory->getInventoryDashboard();
    echo (json_encode($data));
}