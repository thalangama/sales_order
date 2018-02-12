<?php
include '../model/change_recovery_officer.php';

$ChangeRecoveryOfficer = new ChangeRecoveryOfficer();

if($_POST["REQUEST_TYPE"] == 'UPDATE'){
    $data = $ChangeRecoveryOfficer->updateRecoveryOfficer();
    echo (json_encode($data));
}