<?php
include '../model/customer_creation.php';

$createCustomer = new createCustomer();
if($_POST["REQUEST_TYPE"] == 'GET'){
    $data = $createCustomer->getCustomer();
    if(isset($data[0]))
        echo (json_encode($data[0]));
    else
        echo '[]';
}elseif($_POST["REQUEST_TYPE"] == 'ADD'){
    $data = $createCustomer->addCustomer();
    echo (json_encode($data));
}elseif($_POST["REQUEST_TYPE"] == 'UPDATE'){
    $data = $createCustomer->updateCustomer();
    echo (json_encode($data));
}
