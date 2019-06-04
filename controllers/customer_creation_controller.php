<?php
include '../model/customer_creation.php';

$createCustomer = new createCustomer();
if(isset($_POST["REQUEST_TYPE"]) && $_POST["REQUEST_TYPE"] == 'GET'){
    $data = $createCustomer->getCustomer();
    if(isset($data[0]))
        echo (json_encode($data[0]));
    else
        echo '[]';
}elseif(isset($_POST["REQUEST_TYPE"]) && $_POST["REQUEST_TYPE"] == 'ADD'){
    $data = $createCustomer->addCustomer();
    echo (json_encode($data));
}elseif(isset($_POST["REQUEST_TYPE"]) && $_POST["REQUEST_TYPE"] == 'UPDATE'){
    $data = $createCustomer->updateCustomer();
    echo (json_encode($data));
}elseif(isset($_GET["REQUEST_TYPE"]) && $_GET["REQUEST_TYPE"] == 'GET_SUGGESTION'){
    $data = $createCustomer->getCustomerSuggestion();
    echo (json_encode($data));
}
