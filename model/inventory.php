<?php
include_once '../dbManager/dbManager.php';

class Inventory
{
    function getInventory()
    {
        $item_id = explode('::' , $_POST["item_id"]);
        $warehouse_id = explode('::' , $_POST["warehouse_id"]);
        $sql = "SELECT INV.`id`, INV.`no_of_items`, INV.`min_item_level`, INV.`price`
                FROM 
                  inventory INV,
                  warehouse_type W,
                  items I
                WHERE 
                  INV.item_id = I.id 
                  AND INV.warehouse_id = W.id 
                  AND I.code = '".$item_id[0] . "'
                  AND W.code = '".$warehouse_id[0] . "'";

        $DbManager = new DbManager();
        $data = $DbManager->select($sql);

        return ($data);
    }

    function updateInventory()
    {
        $itemCode = '';
        $warehouseId = '';
        $minItemsLimit = '';
        $newItems = '';
        $price = '';
        $inventoryId = '';

        $DbManager = new DbManager();

        if($_POST["itemCode"] != '') {
            $itemCode = explode('::' , $_POST["itemCode"]);
            $sql = 'select id from items where code="'.$itemCode[0].'"';
            $itemCode = $DbManager->select($sql);
            $itemCode = $itemCode[0]['id'];
        }
        if($_POST["warehouseId"] != '') {
            $warehouseId = explode('::', $_POST["warehouseId"]);
            $sql = 'select id from warehouse_type where code="'.$warehouseId[0].'"';
            $warehouseId = $DbManager->select($sql);
            $warehouseId = $warehouseId[0]['id'];
        }
        if($_POST["minItemsLimit"] != '')
            $minItemsLimit = $_POST['minItemsLimit'];
        if($_POST["newItems"] != '')
            $newItems = $_POST['newItems'];
        if($_POST["price"] != '')
            $price = $_POST['price'];
        if($_POST["inventoryId"] != '')
            $inventoryId = $_POST['inventoryId'];

        if($warehouseId != 1){
            $sql = 'select no_of_items from inventory where warehouse_id=1 AND item_id='.$itemCode;
            $no_of_items = $DbManager->select($sql);
            if(!isset($no_of_items[0]))
                return( "No Items available in Main Stock");
            $no_of_items = $no_of_items[0]['no_of_items'];
            if($no_of_items < $newItems)
                return( "No enough Items available in Main Stock");
        }

        if($inventoryId == '') {
            $sql = "INSERT INTO inventory (`id` ,`item_id` , `warehouse_id`, `no_of_items`, `min_item_level`, `price`) VALUES('',$itemCode, $warehouseId, ( `no_of_items` + $newItems), '$minItemsLimit', '$price')";

            $data = $DbManager->save($sql);

        } else {

            $sql = "UPDATE inventory SET `no_of_items` = ( `no_of_items` + $newItems), `min_item_level` ='$minItemsLimit', `price` ='$price' WHERE id='$inventoryId'";
            $data = $DbManager->updateOperator($sql);

        }

        if($warehouseId != 1){
            $sql = "UPDATE inventory SET `no_of_items` =( `no_of_items` - $newItems) WHERE warehouse_id=1 AND item_id=$itemCode";
            $data = $DbManager->updateOperator($sql);
        }
        return ($data);

    }

    function returnInventory()
    {
        $itemCode = '';
        $warehouseId = '';
        $inventoryId = '';
        $returnItems = '';
        $toWarehouse = '';

        $DbManager = new DbManager();

        if($_POST["itemCode"] != '') {
            $itemCode = explode('::' , $_POST["itemCode"]);
            $sql = 'select id from items where code="'.$itemCode[0].'"';
            $itemCode = $DbManager->select($sql);
            $itemCode = $itemCode[0]['id'];
        }
        if($_POST["warehouseId"] != '') {
            $warehouseId = explode('::', $_POST["warehouseId"]);
            $sql = 'select id from warehouse_type where code="'.$warehouseId[0].'"';
            $warehouseId = $DbManager->select($sql);
            $warehouseId = $warehouseId[0]['id'];
        }
        if($_POST["toWarehouse"] != '') {
            $toWarehouse = explode('::', $_POST["toWarehouse"]);
            $sql = 'select id from warehouse_type where code="'.$toWarehouse[0].'"';
            $toWarehouse = $DbManager->select($sql);
            $toWarehouse = $toWarehouse[0]['id'];
        }
        if( $toWarehouse == $warehouseId)
            return( "Can not return to same warehouse");

        if($_POST["returnItems"] != '')
            $returnItems = $_POST['returnItems'];

        if($_POST["inventoryId"] != '')
            $inventoryId = $_POST['inventoryId'];

        if($warehouseId == 1){
            return( "Can not return item from Main warehouse");
        }

        if($inventoryId != '') {
            $sql = "SELECT no_of_items FROM inventory WHERE warehouse_id=$toWarehouse AND item_id=$itemCode";
            $no_of_items = $DbManager->select($sql);
            if(!isset($no_of_items[0])) {
                return( "Add Item to warehouse Before Return.");
            }
            $sql = "UPDATE inventory SET `no_of_items` = ( `no_of_items` - $returnItems) WHERE id='$inventoryId'";
            $data = $DbManager->updateOperator($sql);

            $sql = "UPDATE inventory SET `no_of_items` = ( `no_of_items` + $returnItems) WHERE warehouse_id=$toWarehouse AND item_id=$itemCode";
            $data = $DbManager->updateOperator($sql);

        }

        return ($data);

    }
}