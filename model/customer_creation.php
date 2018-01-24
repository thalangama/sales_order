<?php
include '../dbManager/dbManager.php';

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
}