<?php
include_once '../dbManager/dbManager.php';

class Installment
{

    function updateInstallment()
    {
        $payment = '';
        $payment_date = '';
        $order_id = '';
        $recovery_officer_id = '';

        if($_POST["order_id"] != '')
            $order_id = $_POST['order_id'];
        if($_POST["payment"] != '')
            $payment = $_POST['payment'];
        if($_POST["payment_date"] != '')
            $payment_date = $_POST['payment_date'];
        if($_POST["recovery_officer_id"] != '')
            $recovery_officer_id = $_POST['recovery_officer_id'];

        $DbManager = new DbManager();

        $sql = "INSERT INTO  `payment_plan` (`id`, `order_id`, `amount`, `payment_date`, `order_id`)
                VALUES ('', '$order_id', '$payment', '$payment_date','$recovery_officer_id' )";
        $data = $DbManager->save($sql);

        return ($data);
    }

}