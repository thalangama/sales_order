<?php
include '../model/outstanding.php';

$outstanding = new outstanding();
$data = $outstanding->getOutstand();
echo (json_encode($data));