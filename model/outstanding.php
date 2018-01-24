<?php
include '../dbManager/dbManager.php';

class outstanding
{
    function getOutstand()
    {
        $date = date("Y-m-d");
        $where = '';
        if($_POST["customer_nic"] != '')
            $where .= " AND c.nic = '".$_POST["customer_nic"]."'";
        if($_POST["order_no"] != '')
            $where .= " AND p.order_id = '".$_POST["order_no"]."'";
        if($_POST["date"] != '')
            $date = $_POST["date"];
        if($_POST["recovery_officer_id"] != '')
            $where .= " AND off.officer_id = '".$_POST["recovery_officer_id"]."'";

        $where .= " AND p.payment_date <= '".$date."'";

        $sql = "SELECT o.order_no, sum(p.amount) paied, outs.outstand to_paied, c.nic, c.name
            FROM
                payments p,
                customer_details c,
                orders o,
                officer off,
                (SELECT sum(p.payment_amount) outstand, p.order_id 
                FROM 
                    orders o,
                    payment_plan p,
                    customer_details c,
                    officer off
                WHERE 
                    p.order_id = o.id
                    AND off.id = o.recovery_officer_id
                    AND o.customer_id = c.id
                    ".$where."
                ) outs
            WHERE
                p.order_id = o.id
                AND off.id = o.recovery_officer_id
                AND o.customer_id = c.id
                AND p.order_id = outs.order_id 
                ".$where;

        $DbManager = new DbManager();
        $data = $DbManager->select($sql);
        return ($data);
    }
}