<?php
include '../model/reports.php';

$reports = new Reports();

if($_POST["REQUEST_TYPE"] == 'GET_SALES'){
    $data = $reports->getSales();
    echo (json_encode($data));
}elseif($_POST["REQUEST_TYPE"] == 'GET_RECOVERIES'){
    $data = $reports->getRecoveries();
    echo (json_encode($data));
}


