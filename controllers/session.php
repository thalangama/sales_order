<?php
/**
 * Created by PhpStorm.
 * User: Madushanka
 * Date: 1/30/2018
 * Time: 8:06 PM
 */
session_start();


function isManager(){
    if(isset($_SESSION['username'])){
        if($_SESSION['user_type'] == 'M'){
            return true;
        }else{
            return false;
        }
    }
}

function checkAndAllow($filename){
    if(!isset($_SESSION['username'])){
        header('Location:user_login.php?access='.$filename);
    }/*else{
        header('Location:'.$filename);
    }*/
}