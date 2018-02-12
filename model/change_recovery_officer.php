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
        $order_id = '';
        $recovery_officer_id = '';

        if($_POST["order_id"] != '')
            $order_id = $_POST['order_id'];
        if($_POST["recovery_officer_id"] != '')
            $recovery_officer_id = $_POST['recovery_officer_id'];

        $DbManager = new DbManager();

        $sql = "UPDATE orders SET  recovery_officer_id='$recovery_officer_id' WHERE id='$order_id'";
        $data = $DbManager->updateOperator($sql);

        return ($data);
    }

}