<?php
include '../controllers/session.php';
checkAndAllow('outstanding.php');
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
    <link href="../css/jquery-ui/jquery-ui.css" rel="stylesheet">
    <script type="text/javascript" src="../js/lib/CreateHTML5Elements.js"></script>
</head>

<body>
    <div id="wait" style="display:none;width:100%;height:100%;position:absolute;top:25px;left:15px;z-index:5555; background: rgba(255,255,255,0.4)">
        <img src="../images/ajax-loader.gif" alt=""/>
    </div>
    <header>
        <div class="navbar navbar-fixed-top" role="navigation">
            <a class="logo" href="#"><img src="../images/logo.png" class="img-responsive"> </a>
            <div class="pull-right head-notice col-sm-10 col-xs-9">
                <!-- page header -->
                <h1>Outstanding</h1>
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
                    <h2>Search Outstanding</h2>
					<form id="frmOutstandingSearch" name="frmOutstandingSearch" action="" method="POST">
						<div class="form-group col-lg-4 col-sm-4 col-xs-12">
							<label for="" class="col-sm-5 col-xs-5">Customer Nic</label>
							<div class="col-sm-7 col-xs-7">
								<input class="form-control" type="text" id="customer_nic" name="customer_nic"> </div>
						</div>
						<div class="form-group col-lg-4 col-sm-4 col-xs-12">
							<label for="" class="col-sm-5 col-xs-5">Order No</label>
							<div class="col-sm-7 col-xs-7">
								<input class="form-control" type="text" id="order_no" name="order_no"> </div>
						</div>
						<div class="form-group col-lg-4 col-sm-4 col-xs-12">
							<label for="" class="col-sm-5 col-xs-5">Recovery Officer ID</label>
							<div class="col-sm-7 col-xs-7">
								<input class="form-control" type="text" id="recovery_officer_id" name="recovery_officer_id"> </div>
						</div>
						<div class="form-group col-lg-4 col-sm-4 col-xs-12">
							<label for="" class="col-sm-5 col-xs-5">Date</label>
							<div class="col-sm-7 col-xs-7">
								<input class="form-control" type="text" id="date" name="date"> </div>
						</div>
						<div class="form-group col-lg-4 col-sm-4 col-xs-12 pull-right"> <a id="btnSearch" class="btn btn-add pull-right" href="#">Search <span class="glyphicon glyphicon glyphicon-search"></span></a> </div>
                    </form>
                </div>
                <!-- /common search -->
                <!-- Outstading Details -->
                <div class="col-sm-12 col-xs-12 common-box">
                    <h2>Outstading</h2>
                    <div class=" col-sm-12 col-xs-12 col-lg-12 without-heading">
                        <table cellpadding="0" cellspacing="0" border="0" class="display table footable" id="tblOutstanding">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc">No</th>
                                    <th class="sorting">Order No</th>
                                    <th class="sorting">Customer Nic</th>
                                    <th class="sorting">Customer Name</th>
                                    <th class="sorting">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
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
        <script src="../js/lib/jquery-ui/jquery-ui.js"></script>
        <script src="../js/lib/footable.min.js"></script>
        <script src="../js/lib/modernizr.custom.js"></script>
        <script src="../js/lib/jquery.dlmenu.min.js"></script>
        <script src="../js/lib/bootstrap-multiselect.min.js"></script>
		<script src="../js/lib/w3.js"></script>
		<script src="../js/lib/jquery.validate.js"></script>
		<script src="../js/custom/common.js"></script>
		<script src="../js/custom/outstanding.js"></script>
		<script>
			w3.includeHTML();
		</script>
</body>
<!-- Preloader -->

</html>