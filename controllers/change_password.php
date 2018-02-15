<?php
/**
 * Created by PhpStorm.
 * User: Madushanka
 * Date: 2/15/2018
 * Time: 12:40 PM
 */

session_start();
include_once '../dbManager/dbManager.php';

$db = new DbManager();

$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];
$username = $_SESSION['username'];

$query = "select password from users where username='$username'";
$value = $db->select($query);

$hashedPassword = sha1($current_password);
if($value[0]['password'] === $hashedPassword){
    $hashedPassword = sha1($new_password);
    $query = "update users set password='$hashedPassword'  where username='$username' ";
    $db->update($query);
    header('location:../view/change_password.php?success=true');
}else{
    header('location:../view/change_password.php?error=wrongpassword');
}



