<?php

    include '../dbManager/dbManager.php';
    include '../controllers/session.php';

    //checkAndAllow('user_creation.php');


    $db = new DbManager();

    if(!isManager()){
        header('location:user_login.php?logas=manager');
    }

    $userExists = false;
    $passwordMissMatch = false;
    $isReg = false;
    $regClicked = false;
    if(isset($_POST['register'])){
        $regClicked = true;
        $username_reg = $_POST['username'];
        $firstName_reg = $_POST['firstName'];
        $lastName_reg = $_POST['lastName'];
        $userType_reg = $_POST['empType'];


        $newPassword_reg = $_POST['newPassword'];
        $hashedPassword_reg = sha1($newPassword_reg);
        $confirmPassword_reg = $_POST['confirmPassword'];
        $query = "SELECT * FROM users WHERE username='{$username_reg}'";
        //$result = mysqli_query($connection,$query);
        $result = insertUpdateDelete($query);
        $user = mysqli_fetch_assoc($result);
        if($user){
            $userExists = true;
        }
        else{
            if($newPassword_reg != $confirmPassword_reg){
                $passwordMissMatch = true;

            }else{
                $query = "";
                $query = "INSERT INTO users(first_name,last_name,username,user_type,password,is_deleted) VALUES('{$firstName_reg}','{$lastName_reg}','{$username_reg}','{$userType_reg}','$hashedPassword_reg',0)";

                $db->save($query);
                $isReg = true;
            }
        }

    }
?>
<html>
    <head>
        <title>Create User</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/png" href="images/alt_favicon.png" sizes="16x16" />
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/main_style.css" rel="stylesheet">
        <script type="text/javascript" src="../js/lib/CreateHTML5Elements.js"></script>
    </head>
<body>
<div class="col-12 col-sm-12 col-xs-12 col-lg-12 common-box without-heading">
    <div class="login">
    <form action="user_creation.php" method="post">

        <fieldset>

            <?php

            if($regClicked) {
                if($isReg){
                    echo "<p class=\"success-msg\">Successfully Registered!</p>";
                    $isReg = false;

                }else if($userExists){
                    echo "<p class=\"error-msg\">User Already exists!</p>";
                    $userExists = false;
                }else if($passwordMissMatch){
                    echo "<p class=\"error-msg\">Password Missmatch!</p>";
                    $passwordMissMatch = false;
                }
                $regClicked = false;
            }

            ?>

            <p>
                <label class="col-sm-5 col-xs-5">Username:</label>
                <input class="form-control" type="text" name="username" placeholder="Username" required>
            </p>



            <p>
                <label class="col-sm-5 col-xs-5">First Name:</label>
                <input class="form-control" type="text" name="firstName" placeholder="First Name" required>
            </p>

            <p>
                <label class="col-sm-5 col-xs-5">Last Name:</label>
                <input class="form-control" type="text" name="lastName" placeholder="Last Name" required>
            </p>
            <p>
                <label class="col-sm-5 col-xs-5">Select User Type:</label>
                <select class="form-control" name="empType" style="height:36px">
                    <option values = "M">Manager
                    </option>
                    <option values = "O">Operator
                    </option>

                </select>
            </p>

            <p>
                <label class="col-sm-5 col-xs-5">New Password:</label>
                <input class="form-control" type="Password" name="newPassword" id="newPassword" placeholder="New Password" required>
            </p>
            <p>
                <label class="col-sm-5 col-xs-5">Confirm Password:</label>
                <input class="form-control" type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password" required>
            </p>


            <p>
                <button class="form-control" type="sumbit" class="button_hover button_trans" style="width:100%" name="register" onclick="return checkPassword()">Register</button>

            </p>

        </fieldset>

    </form>
    </div>
    </div>
        <script src="../js/lib/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../js/lib/bootstrap-datepicker.js"></script>
        <script src="../js/lib/jquery.dataTables.min.js"></script>
        <script src="../js/lib/footable.min.js"></script>
        <script src="../js/lib/modernizr.custom.js"></script>
        <script src="../js/lib/jquery.dlmenu.min.js"></script>
        <script src="../js/lib/bootstrap-multiselect.min.js"></script>
        <script src="../js/lib/w3.js"></script>
        <script src="../js/lib/jquery.validate.js"></script>
        <script src="../js/custom/common.js"></script>
        <script src="../js/custom/user_creation.js"></script>
</body>
</html>
