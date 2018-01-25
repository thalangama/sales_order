<?php
include '../model/items.php';

$Items = new Items();
$data = $Items->getItems();
echo (json_encode($data));