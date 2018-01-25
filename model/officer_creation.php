<?php
include '../dbManager/dbManager.php';

class createOfficer
{
    function getOfficer()
    {
        $where = ' 1=1';
        if($_POST["nic"] != '')
            $where .= ' AND nic = "' .$_POST["nic"].'"';
        if($_POST["officer_id"] != '')
            $where .= ' AND officer_id = "' .$_POST["officer_id"].'"';


        $sql = "SELECT * from officer WHERE ".$where;

        $DbManager = new DbManager();
        $data = $DbManager->select($sql);
        return ($data);
    }
}