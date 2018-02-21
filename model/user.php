<?php
include_once '../dbManager/dbManager.php';

class User
{
    function getUser()
    {
        $sql = "SELECT * 
                FROM users 
                WHERE username='{$_POST['username']}' AND is_deleted=0";

        $DbManager = new DbManager();
        $data = $DbManager->select($sql);
        return ($data);
    }

    function addUser()
    {
        $userExists = false;
        $passwordMissMatch = false;
        $username_reg = $_POST['username'];
        $firstName_reg = $_POST['firstName'];
        $lastName_reg = $_POST['lastName'];
        $userType_reg = $_POST['empType'];
        $newPassword_reg = $_POST['newPassword'];
        $hashedPassword_reg = sha1($newPassword_reg);
        $confirmPassword_reg = $_POST['confirmPassword'];

        $user = $this->getUser();

        if (count($user)) {
            $userExists = true;
            $data = 'User Already Exists';
        } else {
            if ($newPassword_reg != $confirmPassword_reg) {
                $passwordMissMatch = true;
                $data = 'Password Miss Match';
            } else {
                $DbManager = new DbManager();

                $query = "INSERT INTO users(first_name,last_name,username,user_type,password,is_deleted) VALUES('{$firstName_reg}','{$lastName_reg}','{$username_reg}','{$userType_reg}','$hashedPassword_reg',0)";

                $data = $DbManager->save($query);
            }
        }
        return ($data);
    }

    function updateUser()
    {
        if(!isManager()){
            return ('You don\'t have permission to perform this action');
        }
        $id = $_POST['id'];
        $username_reg = $_POST['username'];
        $firstName_reg = $_POST['firstName'];
        $lastName_reg = $_POST['lastName'];
        $userType_reg = $_POST['empType'];
        $newPassword_reg = $_POST['newPassword'];
        $hashedPassword_reg = sha1($newPassword_reg);
        $confirmPassword_reg = $_POST['confirmPassword'];

        if ($newPassword_reg != $confirmPassword_reg) {
            $data = 'Password Miss Match';
        } else {
            $query = "UPDATE users
                  SET first_name = '{$firstName_reg}', last_name='{$lastName_reg}', username='{$username_reg}', user_type='{$userType_reg}', password='$hashedPassword_reg',is_deleted=0
                  WHERE id='{$id}'";
            $DbManager = new DbManager();
            $data = $DbManager->update($query);
        }
        return ($data);
    }

}