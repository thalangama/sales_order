<?php
include_once '../dbManager/dbManager.php';

class ChangePassword
{

    function updatePassword()
    {
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
            $data = $db->updateOperator($query);
        }else{
            $data = 'Wrong Password';
        }

        return ($data);
    }
}