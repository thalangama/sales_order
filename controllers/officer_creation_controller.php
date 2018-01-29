<?php
include '../model/officer_creation.php';

$createOfficer = new createOfficer();

if($_POST["REQUEST_TYPE"] == 'GET'){
    $data = $createOfficer->getOfficer();
    if(isset($data[0]))
        echo (json_encode($data[0]));
}elseif($_POST["REQUEST_TYPE"] == 'ADD'){
    $data = $createOfficer->addOfficer();
    echo (json_encode($data));
}elseif($_POST["REQUEST_TYPE"] == 'UPDATE'){
    $data = $createOfficer->updateOfficer();
    echo (json_encode($data));
}