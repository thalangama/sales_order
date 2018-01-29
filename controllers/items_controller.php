<?php
include '../model/items.php';

$Items = new Items();
if($_POST["REQUEST_TYPE"] == 'GET'){
    $data = $Items->getItems();
    if(isset($data))
        echo (json_encode($data));
}elseif($_POST["REQUEST_TYPE"] == 'ADD'){
    $data = $Items->addItems();
    echo (json_encode($data));
}elseif($_POST["REQUEST_TYPE"] == 'UPDATE'){
    $data = $Items->updateItems();
    echo (json_encode($data));;
}