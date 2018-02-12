<?php
include '../model/installment.php';

$updateInstallment = new Installment();

if($_POST["REQUEST_TYPE"] == 'ADD'){
    $data = $updateInstallment->updateInstallment();
    echo (json_encode($data));
}elseif($_POST["REQUEST_TYPE"] == 'GET_INSTALLMENT'){
    $data = $updateInstallment->getInstallment();
    echo (json_encode($data));
}elseif($_POST["REQUEST_TYPE"] == 'DELETE_INSTALLMENT'){
    $data = $updateInstallment->deleteInstallment();
    echo (json_encode($data));
}