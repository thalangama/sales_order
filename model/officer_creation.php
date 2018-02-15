<?php
include_once '../dbManager/dbManager.php';

class createOfficer
{
    function getOfficer()
    {
        $where = ' 1=1';
        if(isset($_POST["nic"]) && $_POST["nic"] != '')
            $where .= ' AND nic = "' .$_POST["nic"].'"';
        if($_POST["officer_id"] != '')
            $where .= ' AND officer_id = "' .$_POST["officer_id"].'"';


        $sql = "SELECT * from officer WHERE ".$where;

        $DbManager = new DbManager();
        $data = $DbManager->select($sql);
        return ($data);
    }

    function addOfficer()
    {
        $name = "";
        $nic = "";
        $officer_id = "";
        $address = "";
        $phone = "";

        if($_POST["name"] != '')
            $name = $_POST['name'];
        if($_POST["officer_nic"] != '')
            $nic = $_POST['officer_nic'];
        if($_POST["officer_id"] != '')
            $officer_id = $_POST['officer_id'];
        if($_POST["address"] != '')
            $address = $_POST['address'];
        if($_POST["phone_no"] != '')
            $phone = $_POST['phone_no'];

        $sql = "INSERT INTO officer(name,address,phone,nic,officer_id) VALUES('$name','$address',$phone,'$nic','$officer_id')";

        $DbManager = new DbManager();
        $data = $DbManager->save($sql);

        return ($data);
    }

    function updateOfficer()
    {
        $name = "";
        $nic = "";
        $officer_id = "";
        $address = "";
        $phone = "";
        $id = "";

        if($_POST["name"] != '')
            $name = $_POST['name'];
        if($_POST["officer_nic"] != '')
            $nic = $_POST['officer_nic'];
        if($_POST["officer_id"] != '')
            $officer_id = $_POST['officer_id'];
        if($_POST["address"] != '')
            $address = $_POST['address'];
        if($_POST["phone_no"] != '')
            $phone = $_POST['phone_no'];
        if($_POST["id"] != '')
            $id = $_POST['id'];

        $sql = "UPDATE officer SET name='$name', address ='$address' ,officer_id='$officer_id', phone = $phone,  nic='$nic' where id='$id' ";

        $DbManager = new DbManager();
        $data = $DbManager->update($sql);

        return ($data);
    }
}