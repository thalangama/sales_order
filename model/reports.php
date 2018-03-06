<?php
include_once '../dbManager/dbManager.php';

class Reports
{

    function getSales()
    {
        $db = new DbManager();

        $sales_officer_id = $_POST['sales_officer_id'];
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];
        $where = '';
        if($sales_officer_id != ''){
            $where = " AND off.`officer_id` = '$sales_officer_id'";
        }
        $query = "SELECT 
                    O.`order_no`, 
                    O.`date`,  
                    off.`officer_id` ,
                    (SELECT SUM(OI.`price` * OI.`quantity`) FROM `order_items` OI WHERE OI.`status`=1 AND O.`id`= OI.`order_id` GROUP BY OI.`order_id` ) amount 
                  FROM 
                    `orders` O,
                    `officer` off
                  WHERE
                    off.`id` = O.`sales_officer_id`
                    AND O.`date` BETWEEN '$from_date' AND '$to_date' 
                    $where ";
        $data = $db->select($query);

        return ($data);
    }
}