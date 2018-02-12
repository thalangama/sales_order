<?php
include_once '../dbManager/dbManager.php';
include_once 'customer_creation.php';

class ChangeRecoveryOfficer
{

    function updateRecoveryOfficer()
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