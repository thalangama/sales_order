<?php
include_once '../dbManager/dbManager.php';
include_once 'customer_creation.php';

class Order
{
    function getOrder()
    {
        $sql = "SELECT 
                  o.id, o.order_no, o.date, c.nic, c.id cus_id, c.name, c.address, c.phone_no, o.sales_officer_id, o.recovery_officer_id, o.payment, o.payment_date, o.no_of_terms
                FROM 
                  orders o, 
                  customer_details c 
                WHERE 
                  c.id = o.customer_id
                  AND o.order_no = '". $_POST["order_no"] . "'";

        $DbManager = new DbManager();
        $data = $DbManager->select($sql);

        return ($data);
    }

    function updateOrder()
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