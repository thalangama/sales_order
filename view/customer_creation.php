<?php
include '../dbManager/dbManager.php';

$errors = null;

if(isset($_POST['add']) || isset($_POST['update'])) {
	$name = $_POST['name'];
	$nic = $_POST['customer_nic'];
	$address = $_POST['address'];
	$phone = $_POST['phone_no'];

	if (isset($_POST['add'])) {
		$result = insertUpdateDelete("INSERT INTO customer_details(name,address,phone_no,nic) VALUES('$name','$address',$phone,'$nic')");
		if ($result == 1) {
			//success
		} else {
			$errors.="Save Error";
		}
	}
	if (isset($_POST['update'])) {
		//$db = new DbManager();
		$result = insertUpdateDelete("UPDATE customer_details SET name='$name', address ='$address' , phone_no = $phone where nic='$nic' ");
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
                <h1>Customer Creation</h1>
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
					if($errors != null){
						echo '<p class="error-msg"> Error, Action is not Completed. </p> ';
					}
				?>
			</div>
                <p class="visible-xs">
                    <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"> <span class="glyphicon glyphicon-align-justify"></span> Navigation </button>
                </p>
                <!-- common search -->
                <div class="col-12 col-sm-12 col-xs-12 col-lg-12 common-box">
                    <h2>Search Customer</h2>
					<form id="frmCustomerSearch" name="frmCustomerSearch" action="" method="POST">
						<div class="form-group col-lg-6 col-sm-6 col-xs-12">
							<label for="" class="col-sm-5 col-xs-5">NIC</label>
							<div class="col-sm-7 col-xs-7">
								<input class="form-control" id="nic" name="nic" type="text"> </div>
						</div>
						<div class="form-group col-lg-6 col-sm-6 col-xs-12 pull-right"> <a id="btnSearch" class="btn btn-add pull-right" href="#">Search <span class="glyphicon glyphicon glyphicon-search"></span></a> </div>
					</form>
                </div>

			<div class="col-12 col-sm-12 col-xs-12 col-lg-12 common-box without-heading">
				<form id="frmCustomerSave" name="frmCustomerSave" action="customer_creation.php" method="POST">
					<input class="form-control" id="customer_id" name="customer_id" type="hidden">
					<div class="form-group col-lg-6 col-sm-6 col-xs-12">
						<label for="" class="col-sm-5 col-xs-5">Name<span class="mandatory">*</span></label>
						<div class="col-sm-7 col-xs-7">
							<input class="form-control" id="name" name="name" type="text">
						</div>
					</div>
					<div class="form-group col-lg-6 col-sm-6 col-xs-12">
						<label for="" class="col-sm-5 col-xs-5">ID No<span class="mandatory">*</span></label>
						<div class="col-sm-7 col-xs-7">
							<input class="form-control" id="customer_nic" name="customer_nic" type="text">
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
						<Button id="btnClear" class="btn btn-next pull-right draft " onclick="clearFields()" >Clear</Button>
						<Button id="btnUpdate" class="btn btn-next pull-right draft " name="update" type="submit">Update</Button>
					</div>
				</form>
			</div>
                <!-- /Expenses Details -->
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
		<script src="../js/custom/customer_creation.js"></script>
		<script>
			w3.includeHTML();
		</script>
</body>
<!-- Preloader -->

</html>