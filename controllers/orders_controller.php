<?php
include '../model/orders.php';

$Order = new Order();
$data = $Order->getOrder();
echo (json_encode($data));