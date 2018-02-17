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

        $sql = "INSERT INTO  `payments` (`id`, `order_id`, `amount`, `payment_date`, `officer_id`)
                VALUES ('', '$order_id', '$payment', '$payment_date','$recovery_officer_id' )";
        $data = $DbManager->save($sql);

        return ($data);
    }

    function getInstallment(){

        $order_id = '';
        if($_POST["order_id"] != '')
            $order_id = $_POST['order_id'];

        $sql = "SELECT  p.`id`, p.`amount`, p.`payment_date`, o.`officer_id` 
                FROM `payments` p, officer o
                WHERE order_id = '$order_id' AND amount > 0 AND record_status=1 AND o.id = p.officer_id";
        $DbManager = new DbManager();
        $data = $DbManager->select($sql);
        return ($data);
    }

    function deleteInstallment(){
        $installment_id = '';
        if($_POST["installment_id"] != '')
            $installment_id = $_POST['installment_id'];

        $sql = "UPDATE payments SET record_status = 0 WHERE id = '$installment_id'";

        $DbManager = new DbManager();
        $data = $DbManager->delete($sql);
        return ($data);
    }
}