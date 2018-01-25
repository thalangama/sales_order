<?php
include '../dbManager/dbManager.php';

class Order
{
    function getOrder()
    {
        $sql = "SELECT 
                  o.id, o.order_no, o.date, c.nic, o.sales_officer_id, o.recovery_officer_id 
                FROM 
                  orders o, 
                  customer_details c 
                WHERE 
                  c.id = o.customer_id
                  AND o.order_no = '". $_POST["order_no"] . "'";

        $DbManager = new DbManager();
        $data = $DbManager->select($sql);
        if(isset($data[0])) {
            $sql = "SELECT 
                  i.code, i.description, o.price 
                FROM 
                  order_items o, 
                  items i 
                WHERE 
                  i.id = o.item_id 
                  AND o.order_id = '" . $data[0]["id"] . "'";
            $data['items'] = $DbManager->select($sql);
        }
        return ($data);
    }
}