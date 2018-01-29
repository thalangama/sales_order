<?php
include '../dbManager/dbManager.php';

class Items
{
    function getItems()
    {
        $sql = "SELECT * FROM items WHERE code = '". $_POST["code"] . "'";

        $DbManager = new DbManager();
        $data = $DbManager->select($sql);

        return ($data);
    }

    function addItems()
    {
        $code = '';
        $description = '';

        if($_POST["code"] != '')
            $code = $_POST['code'];
        if($_POST["description"] != '')
            $description = $_POST['description'];

        $sql = "INSERT INTO items(id,code,description) VALUES('','$code','$description')";

        $DbManager = new DbManager();
        $data = $DbManager->save($sql);

        return ($data);
    }

    function updateItems()
    {
        $id = '';
        $code = '';
        $description = '';

        if($_POST["id"] != '')
            $id = $_POST['id'];
        if($_POST["code"] != '')
            $code = $_POST['code'];
        if($_POST["description"] != '')
            $description = $_POST['description'];

        $sql = "UPDATE items SET code='$code', description ='$description' WHERE id='$id'";

        $DbManager = new DbManager();
        $data = $DbManager->update($sql);

        return ($data);
    }
}