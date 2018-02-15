<?php
include '../model/change_password.php';

$ChangePassword = new ChangePassword();

if($_POST["REQUEST_TYPE"] == 'UPDATE_PASSWORD'){
    $data = $ChangePassword->updatePassword();
    echo (json_encode($data));
}


