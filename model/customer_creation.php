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
        $is_blacklist = 0;

        if($_POST["name"] != '')
            $name = $_POST['name'];
        if($_POST["customer_nic"] != '')
            $nic = $_POST['customer_nic'];
        if($_POST["address"] != '')
            $address = $_POST['address'];
        if($_POST["phone_no"] != '')
            $phone = $_POST['phone_no'];
        if(isset($_POST["is_blacklist"]) && $_POST["is_blacklist"] != '')
            $is_blacklist = $_POST['is_blacklist'];

        $sql = "INSERT INTO customer_details(name,address,phone_no,nic,is_blacklist) VALUES('$name','$address','$phone','$nic',$is_blacklist)";

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
        if($_POST["is_blacklist"] != '')
            $is_blacklist = $_POST['is_blacklist'];

        $sql = "UPDATE customer_details SET name='$name', address ='$address' , phone_no = '$phone', nic='$nic', is_blacklist=$is_blacklist WHERE id='$id'";

        $DbManager = new DbManager();
        $data = $DbManager->update($sql);

        return ($data);
    }

    function getCustomerSuggestion()
    {

        $name = '';

        if($_GET["query"] != '')
            $name = $_GET['query'];

        $sql = "SELECT nic,name from customer_details WHERE name LIKE '".$name."%'";

        $DbManager = new DbManager();
        $data = $DbManager->select($sql);

        foreach ($data as $key => $value) {
            $array[] = array (
                'label' => $value['nic'],
                'value' => $value['name'],
            );
        }

        return ($array);
    }

}