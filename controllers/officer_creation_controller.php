<?php
include '../model/officer_creation.php';

$createOfficer = new createOfficer();
$data = $createOfficer->getOfficer();
if(isset($data[0]))
    echo (json_encode($data[0]));
