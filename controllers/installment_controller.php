<?php
include '../model/installment.php';

$updateInstallment = new Installment();

if($_POST["REQUEST_TYPE"] == 'ADD'){
    $data = $updateInstallment->updateInstallment();
    echo (json_encode($data));
}