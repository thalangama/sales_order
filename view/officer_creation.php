<?php
include '../dbManager/dbManager.php';

$errors = null;

if(isset($_POST['add']) || isset($_POST['update'])) {
	$name = $_POST['name'];
	$nic = $_POST['nic'];
	$officer_id = $_POST['officer_id'];
	$address = $_POST['address'];
	$phone = $_POST['phone_no'];


	if (isset($_POST['add'])) {
		$result = insertUpdateDelete("INSERT INTO officer(name,address,phone,nic,officer_id) VALUES('$name','$address',$phone,'$nic','$officer_id')");
		if ($result == 1) {
			//success
		} else {
			$errors.="Save Error";
		}
	}
	if (isset($_POST['update'])) {
		$query = "UPDATE officer SET name='$name', address ='$address' ,officer_id='$officer_id', phone = $phone where nic='$nic' ";
		$result = insertUpdateDelete($query);

		if ($result == 1) {
			//success
		} else {
			$errors.="Update Error";
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
                <h1>Officer Creation</h1>
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
				<div id="msg-area">
					<?php

					if(isset($_POST['add']) || isset($_POST['update'])) {
						if ($errors != null) {
							echo '<p class="error-msg"> Error, Action is not Completed. </p> ';
						} else {
							echo '<p class="success-msg" > Success. </p> ';
						}
					}
					?>
				</div>
                <p class="visible-xs">
                    <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"> <span class="glyphicon glyphicon-align-justify"></span> Navigation </button>
                </p>
                <!-- common search -->
                <div class="col-12 col-sm-12 col-xs-12 col-lg-12 common-box">
                    <h2>Search Officer</h2>
					<form id="frmOfficerSearch" name="frmOfficerSearch" action="" method="POST">
						<div class="form-group col-lg-6 col-sm-6 col-xs-12">
							<label for="" class="col-sm-5 col-xs-5">NIC</label>
							<div class="col-sm-7 col-xs-7">
								<input class="form-control" id="search_nic" name="search_nic" type="text"> </div>
						</div>
						<div class="form-group col-lg-6 col-sm-6 col-xs-12">
							<label for="" class="col-sm-5 col-xs-5">Officer ID</label>
							<div class="col-sm-7 col-xs-7">
								<input class="form-control" id="search_officer_id" name="search_officer_id" type="text"> </div>
						</div>
						<div class="form-group col-lg-6 col-sm-6 col-xs-12 pull-right"> <a id="btnSearch" class="btn btn-add pull-right" href="#">Search <span class="glyphicon glyphicon glyphicon-search"></span></a> </div>
                    </form/>
                </div>

			<div class="col-12 col-sm-12 col-xs-12 col-lg-12 common-box without-heading">
				<form id="frmOfficerSave" name="frmOfficerSave" action="" method="POST">
					<input class="form-control" id="customer_id" name="customer_id" type="hidden">
					<div class="form-group col-lg-6 col-sm-6 col-xs-12">
						<label for="" class="col-sm-5 col-xs-5">Name<span class="mandatory">*</span></label>
						<div class="col-sm-7 col-xs-7">
							<input class="form-control" id="name" name="name" type="text">
						</div>
					</div>
					<div class="form-group col-lg-6 col-sm-6 col-xs-12">
						<label for="" class="col-sm-5 col-xs-5">NIC No<span class="mandatory">*</span></label>
						<div class="col-sm-7 col-xs-7">
							<input class="form-control" id="nic" name="nic" type="text">
						</div>
					</div>
					<div class="form-group col-lg-6 col-sm-6 col-xs-12">
						<label for="" class="col-sm-5 col-xs-5">Officer ID<span class="mandatory">*</span></label>
						<div class="col-sm-7 col-xs-7">
							<input class="form-control" id="officer_id" name="officer_id" type="text">
						</div>
					</div>
					<div class="form-group col-lg-6 col-sm-6 col-xs-12">
						<label for="" class="col-sm-5 col-xs-5">Address<span class="mandatory">*</span></label>
						<div class="col-sm-7 col-xs-7">
							<input class="form-control" id="address" name="address" type="text">
						</div>
					</div>
					<div class="form-group col-lg-6 col-sm-6 col-xs-12">
						<label for="" class="col-sm-5 col-xs-5">Phone No <span class="mandatory">*</span></label>
						<div class="col-sm-7 col-xs-7">
							<input class="form-control" id="phone_no" name="phone_no" type="text">
						</div>
					</div>
					<div class="form-group col-lg-6 col-sm-6 col-xs-12 pull-right">
						<Button id="btnAdd" class="btn btn-next pull-right draft " name="add" type="submit">Add</Button>
						<a id="btnClear" class="btn btn-next pull-right draft " onclick="clearFields()" >Clear</a>
						<Button id="btnUpdate" class="btn btn-next pull-right draft " name="update" type="submit">Update</Button>
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