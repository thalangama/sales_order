<?php
    include '../controllers/session.php';
    checkAndAllow('customer_creation.php');
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

	<style>
		h1 {
			font-size: 20px;
			color: #111;
		}

		.content {
			width: 80%;
			margin: 0 auto;
			margin-top: 50px;
		}

		.tt-hint{
			border: 2px solid #CCCCCC;
			border-radius: 8px 8px 8px 8px;
			outline: medium none;
		}

		.tt-dropdown-menu {
			width: 250px;
			margin-top: 5px;
			padding: 8px 12px;
			background-color: #fff;
			border: 1px solid #ccc;
			border: 1px solid rgba(0, 0, 0, 0.2);
			border-radius: 8px 8px 8px 8px;
			font-size: 18px;
			color: #111;
			/*background-color: #F1F1F1;*/
		}
	</style>

</head>

<body>
    <header>
        <div class="navbar navbar-fixed-top" role="navigation">
            <a class="logo" href="#"><img src="../images/logo.png" class="img-responsive"> </a>
            <div class="pull-right head-notice col-sm-10 col-xs-9">
                <!-- page header -->
                <h1>Customer Creation</h1>
                <!-- /page header -->
				<div class="nav-info">
					<div class="dropdown">
						<a class="btn btn-default" href="#" data-toggle="dropdown">
							<input type="hidden" value="<?php echo $_SESSION['user_type']; ?>" id="session_user_type" >
							<input type="hidden" value="<?php echo $_SESSION['username']; ?>" id="session_user_name" >
							<?php echo $_SESSION['username']; ?>
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
							<li><a href="user_login.php?logout=logout">Logout</a></li>
						</ul>
					</div>
				</div>
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
                    <h2>Search Customer</h2>
					<form id="frmCustomerSearch" name="frmCustomerSearch" action="" method="POST">
						<div class="form-group col-lg-6 col-sm-6 col-xs-12">
							<label for="" class="col-sm-5 col-xs-5">NIC<span class="mandatory">*</span></label>
							<div class="col-sm-7 col-xs-7">
								<input class="form-control" id="nic" name="nic" type="text"> </div>
						</div>
						<div class="form-group col-lg-6 col-sm-6 col-xs-12">
							<label for="" class="col-sm-5 col-xs-5">NAME<span class="mandatory">*</span></label>
							<div class="col-sm-7 col-xs-7">
								<input type="text" name="name" size="30" class="name" placeholder="Please Enter Customer Name"> </div>
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
						<div class="form-group col-lg-6 col-sm-6 col-xs-12">
							<label for="" class="col-sm-5 col-xs-5">Blacklist</label>
							<div class="col-sm-7 col-xs-7">
								<input class="form-control" id="is_blacklist" name="is_blacklist" type="checkbox">
							</div>
						</div>
						<div class="form-group col-lg-6 col-sm-6 col-xs-12 pull-right">
							<a id="btnProcess" class="btn btn-next pull-right draft " >Process</a>
							<a id="btnClear" class="btn btn-next pull-right draft " onclick="clearFields()" >Clear</a>
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
        <script src="../js/lib/typeahead.js"></script>
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