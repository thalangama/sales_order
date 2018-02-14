<?php

    include_once '../dbManager/dbManager.php';
    include_once '../controllers/session.php';

    checkAndAllow('user_creation.php');


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

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Udaya</title>
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
<header>
    <div class="navbar navbar-fixed-top" role="navigation">
        <a class="logo" href="#"><img src="../images/logo.png" class="img-responsive"> </a>
        <div class="pull-right head-notice col-sm-10 col-xs-9">
            <!-- page header -->
            <h1>Create Creation</h1>
            <!-- /page header -->
        </div>
    </div>
</header>
<div id="main-wrap">
    <!--sidebar-offcanvas-->
    <div w3-include-html="menu.html"></div>
    <!--sidebar-offcanvas-->
    <div class="row-offcanvas row-offcanvas-left">
        <!--detail panel-->
        <div id="detail-panel" class=" col-sm-10 col-xs-12 pull-right">
            <div id="msg-area"></div>
            <p class="visible-xs">
                <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"> <span class="glyphicon glyphicon-align-justify"></span> Navigation </button>
            </p>
            <!-- common search -->
            <div class="col-12 col-sm-12 col-xs-12 col-lg-12 common-box">
                <h2>Search User</h2>
                <form id="frmUserSearch" name="frmUserSearch" action="" method="POST">
                    <div class="form-group col-lg-6 col-sm-6 col-xs-12">
                        <label for="" class="col-sm-5 col-xs-5">User ID</label>
                        <div class="col-sm-7 col-xs-7">
                            <input class="form-control" id="search_user_id" name="search_user_id" type="text"> </div>
                    </div>
                    <div class="form-group col-lg-6 col-sm-6 col-xs-12 pull-right"> <a id="btnSearch" class="btn btn-add pull-right" href="#">Search <span class="glyphicon glyphicon glyphicon-search"></span></a> </div>
                </form/>
            </div>

            <div class="col-12 col-sm-12 col-xs-12 col-lg-12 common-box without-heading">
                <form id="frmUserSave" name="frmUserSave" action="" method="POST">
                    <input class="form-control" id="id" name="id" type="hidden">
                    <div class="form-group col-lg-6 col-sm-6 col-xs-12">
                        <label for="" class="col-sm-5 col-xs-5">Username<span class="mandatory">*</span></label>
                        <div class="col-sm-7 col-xs-7">
                            <input class="form-control" type="text" name="username" placeholder="Username" required>
                        </div>
                    </div>
                    <div class="form-group col-lg-6 col-sm-6 col-xs-12">
                        <label for="" class="col-sm-5 col-xs-5">First Name<span class="mandatory">*</span></label>
                        <div class="col-sm-7 col-xs-7">
                            <input class="form-control" type="text" name="firstName" placeholder="First Name" required>
                        </div>
                    </div>
                    <div class="form-group col-lg-6 col-sm-6 col-xs-12">
                        <label for="" class="col-sm-5 col-xs-5">Last Name<span class="mandatory">*</span></label>
                        <div class="col-sm-7 col-xs-7">
                            <input class="form-control" type="text" name="lastName" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="form-group col-lg-6 col-sm-6 col-xs-12">
                        <label for="" class="col-sm-5 col-xs-5">User Type<span class="mandatory">*</span></label>
                        <div class="col-sm-7 col-xs-7">
                            <select class="form-control" name="empType">
                                <option values = "M">Manager</option>
                                <option values = "O">Operator</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-lg-6 col-sm-6 col-xs-12">
                        <label for="" class="col-sm-5 col-xs-5">New Password <span class="mandatory">*</span></label>
                        <div class="col-sm-7 col-xs-7">
                            <input class="form-control" type="Password" name="newPassword" id="newPassword" placeholder="New Password" required>
                        </div>
                    </div>
                    <div class="form-group col-lg-6 col-sm-6 col-xs-12">
                        <label for="" class="col-sm-5 col-xs-5">Confirm Password <span class="mandatory">*</span></label>
                        <div class="col-sm-7 col-xs-7">
                            <label class="col-sm-5 col-xs-5">
                            <input class="form-control" type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password" required>
                        </div>
                    </div>
                    <div class="form-group col-lg-6 col-sm-6 col-xs-12 pull-right">
                        <a id="btnClear" class="btn btn-next pull-right draft " onclick="clearFields()" >Clear</a>
                        <a id="btnProcess" class="btn btn-next pull-right draft " >Process</a>
                    </div>
                </form>
            </div>
            <!-- /Expenses Details -->
            <!--			<div class="col-12 col-sm-12 col-xs-12 col-lg-12 common-box without-heading "> <a id="btnProcess" class="btn btn-next pull-right draft " href="#">Process</a></div>-->
        </div>
    </div>
    <!--/detail panel-->
</div>
<!--/.container-->
<!-- bootdtrap-->
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
<script src="../js/custom/officer_creation.js"></script>
<script>
    w3.includeHTML();
</script>
</body>
<!-- Preloader -->

</html>


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
                <button class="form-control" type="sumbit" class="button_hover button_trans" style="width:100%" name="register" onclick="return checkPassword()">Register</button>

            </p>
