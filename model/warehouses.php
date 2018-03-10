<?php
include_once '../dbManager/dbManager.php';

class Warehouses
{
    function getWarehouses()
    {
        $sql = "SELECT * FROM warehouse_type WHERE code = '". $_POST["code"] . "'";

        $DbManager = new DbManager();
        $data = $DbManager->select($sql);

        return ($data);
    }

    function getWarehouseCode()
    {
        $sql = "SELECT * FROM warehouse_type";

        $DbManager = new DbManager();
        $data = $DbManager->select($sql);

        $warehouse_code = '[';
        foreach($data as $key => $val){
            $warehouse_code .= '"' .$val['code'] . '::' . $val['description'] . '", ';
        }
        $warehouse_code .= ']';
        return ($warehouse_code);
    }

    function addWarehouses()
    {
        $code = '';
        $description = '';

        if($_POST["code"] != '')
            $code = $_POST['code'];
        if($_POST["description"] != '')
            $description = $_POST['description'];

        $sql = "INSERT INTO warehouse_type(id,code,description) VALUES('','$code','$description')";

        $DbManager = new DbManager();
        $data = $DbManager->save($sql);

        return ($data);
    }

    function updateWarehouses()
    {
        if(!isManager()){
            return ('You don\'t have permission to perform this action');
        }
        $id = '';
        $code = '';
        $description = '';

        if($_POST["id"] != '')
            $id = $_POST['id'];
        if($_POST["code"] != '')
            $code = $_POST['code'];
        if($_POST["description"] != '')
            $description = $_POST['description'];

        $sql = "UPDATE warehouse_type SET code='$code', description ='$description' WHERE id='$id'";

        $DbManager = new DbManager();
        $data = $DbManager->updateOperator($sql);

        return ($data);
    }
}