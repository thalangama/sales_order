<?php
include_once '../model/user.php';

$user = new User();

if($_POST["REQUEST_TYPE"] == 'GET_USER'){
    $data = $user->getUser();
    if(isset($data))
        echo (json_encode($data));
}elseif($_POST["REQUEST_TYPE"] == 'ADD_USER'){
    $data = $user->addUser();
    if(isset($data))
        echo (json_encode($data));
}elseif($_POST["REQUEST_TYPE"] == 'UPDATE_USER'){
    $data = $user->updateUser();
    if(isset($data))
        echo (json_encode($data));
}