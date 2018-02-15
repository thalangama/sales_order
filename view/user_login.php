<?php
/**
 * Created by PhpStorm.
 * User: Madushanka
 * Date: 1/29/2018
 * Time: 7:50 PM
 */

include_once '../dbManager/dbManager.php';

$errors = array();

if (isset($_GET['logas'])) {
    if ($_GET['logas'] == 'manager') {
        $errors[] = "Please login as manager to access the page";
    }
}

if (isset($_GET['logout'])) {
    if ($_GET['logout'] == 'logout') {
        session_destroy();
        unset($_SESSION);
    }
}

if (isset($_POST['submit'])) {

    if (!isset($_POST['email']) || strlen(trim($_POST['email'])) < 1) {
        $errors[] = "Username is missing or invalid";
    }

    if (!isset($_POST['password']) || strlen(trim($_POST['password'])) < 1) {
        $errors[] = "Password is missing or invalid";
    }

    if (empty($errors)) {

        $username = $_POST['email'];
        $username = strtolower($username);
        $password = $_POST['password'];
        $hashedPassword = sha1($password);

        $query = "SELECT * FROM users WHERE username='{$username}' AND password='{$hashedPassword}' AND is_deleted=0 LIMIT 1";

        $db = new dbManager();
        $user = $db->select($query);
        if ($user) {

            session_start();
            $_SESSION['username'] = $user[0]['username'];
            $_SESSION['user_type'] = $user[0]['user_type'];

            $type = $_SESSION['user_type'];

            if (strcmp($type, 'M') == 0) {

                if ($_POST['access'] != 'null') {
                    header('Location:' . $_POST['access']);
                } else {
                    header('Location:customer_creation.php');
                }
            }
            if (strcmp($type, 'O') == 0) {
                if ($_POST['access'] != 'null') {
                    header('Location:' . $_POST['access']);
                } else {
                    header('Location:items.php');
                }
            }
        } else {
            //username or password is invalid
            $errors[] = "Invalid username or passowrd";
        }
    }
}
?>

<html>
<head>
    <title>System Login</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="images/alt_favicon.png" sizes="16x16"/>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/main_style.css" rel="stylesheet">
    <script type="text/javascript" src="../js/lib/CreateHTML5Elements.js"></script>
</head>
<body>
<div class="col-12 col-sm-12 col-xs-12 col-lg-12 common-box without-heading">
    <div class="login">
        <form action="user_login.php?logout=false" method="post">

            <fieldset>
                <legend><h1>Sign in</h1></legend>

                <?php
                if (isset($errors) && !empty($errors)) {
                    echo "<p class=\"error-msg\">$errors[0]</p>";
                }
                ?>
                <?php
                if (isset($_GET['logout'])) {

                    $logoutValue = $_GET['logout'];

                    if ($logoutValue == 'true') {
                        echo "<p class=\"success-msg\">Successfully Logged out!</p>";
                    }
                }
                ?>

                <p>
                    <label class="col-sm-5 col-xs-5">Username:</label>
                    <input class="form-control" type="text" name="email" placeholder="System Username" required>
                </p>

                <p>
                    <label class="col-sm-5 col-xs-5">Password:</label>
                    <input class="form-control" type="password" name="password" placeholder="Password" required>
                </p>

                <input hidden name="access" value="<?php
                if (isset($_GET['access'])) {
                    echo $_GET['access'];
                } else {
                    echo "null";
                }
                ?>"/>

                <p>
                    <button class="form-control" type="sumbit" name=submit>Sign in</button>
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
</body>
</html>