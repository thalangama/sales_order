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
}