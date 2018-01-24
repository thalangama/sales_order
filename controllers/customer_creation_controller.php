<?php
include '../model/customer_creation.php';

$createCustomer = new createCustomer();
$data = $createCustomer->getCustomer();
echo (json_encode($data[0]));
