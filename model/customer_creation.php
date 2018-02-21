<?php
include_once '../dbManager/dbManager.php';

class createCustomer
{
    function getCustomer()
    {
        $nic = '';
        if($_POST["customer_nic"] != '')
            $nic = $_POST["customer_nic"];


        $sql = "SELECT * from customer_details WHERE nic='".$nic."'";

        $DbManager = new DbManager();
        $data = $DbManager->select($sql);
        return ($data);
    }

    function addCustomer()
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

        $sql = "INSERT INTO customer_details(name,address,phone_no,nic) VALUES('$name','$address','$phone','$nic')";

        $DbManager = new DbManager();
		$data = $DbManager->save($sql);

        return ($data);
    }

    function updateCustomer()
    {
        if(!isManager()){
            return ('You don\'t have permission to perform this action');
        }
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