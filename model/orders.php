<?php
include_once '../dbManager/dbManager.php';
include_once 'customer_creation.php';

class Order
{
    function getOrder()
    {
        $sql = "SELECT 
                  o.id, o.order_no, o.date, c.nic, c.id cus_id, c.name, c.address, c.phone_no, o.sales_officer_id, o.recovery_officer_id 
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

    function addOrder()
    {

        $DbManager = new DbManager();
        $date = '';
        $items = '';
        $order_no = '';
        $recovery_officer_id = '';
        $sales_officer_id = '';

        if($_POST["customer_id"] == ''){
            $cus = new createCustomer();
            $cus->addCustomer();
            $customer_id = $DbManager->getLastInsertId();
        }else{
            $customer_id = $_POST["customer_id"];
        }

        if($_POST["date"] != '')
            $date = $_POST['date'];
        if($_POST["items"] != '')
            $items = $_POST['items'];
        if($_POST["order_no"] != '')
            $order_no = $_POST['order_no'];
        if($_POST["recovery_officer_id"] != '')
            $recovery_officer_id = $_POST['recovery_officer_id'];
        if($_POST["sales_officer_id"] != '')
            $sales_officer_id = $_POST['sales_officer_id'];

        $sql = "INSERT INTO orders(`id`,`order_no`,`date`,`customer_id`,`sales_officer_id`,`recovery_officer_id`)
                VALUES('','$order_no','$date','$customer_id','$sales_officer_id','$recovery_officer_id')";
        $data = $DbManager->save($sql);
        $order_id = $DbManager->getLastInsertId();

        foreach ($items as $key => $value){
            $sql = "INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `price`)
                    VALUES('','$order_id',(SELECT id FROM `items` WHERE `code`= $value[1]),'$value[3]')";
            $data = $DbManager->save($sql);
        }

        return ($data);
    }

    function updateOrder()
    {
        $name = '';
        $nic = '';
        $address = '';
        $phone = '';

        if($_POST["name"] != '')
            $name = $_POST['name'];
        if($_POST["customer_nic"] != '')
            $nic = $_POST['customer_nic'];
        if($_POST["address"] != '')
            $address = $_POST['address'];
        if($_POST["phone_no"] != '')
            $phone = $_POST['phone_no'];
        if($_POST["customer_id"] != '')
            $id = $_POST['customer_id'];

        $sql = "UPDATE customer_details SET name='$name', address ='$address' , phone_no = '$phone', nic='$nic' WHERE id='$id'";

        $DbManager = new DbManager();
        $data = $DbManager->update($sql);

        return ($data);
    }

}