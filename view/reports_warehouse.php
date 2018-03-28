<?php
    include '../controllers/session.php';
    include_once '../model/items.php';
    include_once '../model/warehouses.php';
    checkAndAllow('items.php');
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
    <header>
        <div class="navbar navbar-fixed-top" role="navigation">
            <a class="logo" href="#"><img src="../images/logo.png" class="img-responsive"> </a>
            <div class="pull-right head-notice col-sm-10 col-xs-9">
                <!-- page header -->
                <h1>Inventory Report</h1>
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
                    <h2>Search Inventory</h2>
					<form id="frmInventorySearch" name="frmInventorySearch" action="" method="POST">
						<div class="form-group col-lg-6 col-sm-6 col-xs-12">
							<label for="" class="col-sm-5 col-xs-5">Item Code<span class="mandatory">*</span></label>
							<div class="col-sm-7 col-xs-7">
								<input class="form-control" id="item_code" name="item_code" type="text"> </div>
						</div>
                        <div class="form-group col-lg-6 col-sm-6 col-xs-12">
							<label for="" class="col-sm-5 col-xs-5">WareHouse Code<span class="mandatory">*</span></label>
							<div class="col-sm-7 col-xs-7">
								<input class="form-control" id="warehouse_code" name="warehouse_code" type="text"> </div>
						</div>
						<div class="form-group col-lg-6 col-sm-6 col-xs-12 pull-right">
                            <a id="btnClear" class="btn btn-next pull-right draft " onclick="clearFields()" >Clear</a>
                            <a id="btnSearch" class="btn btn-add pull-right" href="#">Search <span class="glyphicon glyphicon glyphicon-search"></span></a>
                        </div>
                    </form>
                </div>
			
                <div class="col-12 col-sm-12 col-xs-12 col-lg-12 common-box without-heading">
                    <h2>Inventory Details</h2>
                    <table class="display table footable dataTable no-footer footable-loaded" id="tblInventory" role="grid" border="0" cellspacing="0" cellpadding="0">
                        <thead>
                        <tr role="row">
                            <th class="sorting_asc">No</th>
                            <th class="sorting">Item Code</th>
                            <th class="sorting">Item Description</th>
                            <th class="sorting">Warehouse</th>
                            <th class="sorting">Availability</th>
                            <th class="sorting">Minimum Level</th>
                            <th class="sorting">Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <div>
                        <form target="_blank" action="../controllers/reports_controller.php" method="post">
                            <input type="hidden" name="REQUEST_TYPE" id="REQUEST_TYPE" value="DOWNLOAD">
                            <input type="hidden" name="REPORT" id="REPORT" value="WAREHOUSE">
                            <input type="hidden" name="warehouseId" id="download_warehouse_code" value="">
                            <input type="hidden" name="itemCode" id="download_item_code" value="">
                            <button type="submit" id="btnDownload" class="btn btn-next pull-right draft " disabled >Download</button>
                        </form>
                    </div>
                </div>
            </div>
		</div>
            <!--/detail panel-->
        </div>
        <!--/.container-->
        <!-- bootdtrap-->
        <script src="../js/lib/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../js/lib/jquery-ui/jquery-ui.js"></script>
        <script src="../js/lib/bootstrap-datepicker.js"></script>
        <script src="../js/lib/jquery.dataTables.min.js"></script>
        <script src="../js/lib/footable.min.js"></script>
        <script src="../js/lib/modernizr.custom.js"></script>
        <script src="../js/lib/jquery.dlmenu.min.js"></script>
        <script src="../js/lib/bootstrap-multiselect.min.js"></script>
		<script src="../js/lib/w3.js"></script>
		<script src="../js/lib/jquery.validate.js"></script>
		<script src="../js/custom/common.js"></script>
		<script src="../js/custom/reports_warehouse.js"></script>
		<script>
			w3.includeHTML();
            <?php $items = new Items() ?>
            var item_code = <?php echo $items->getItemCode(); ?>;
            <?php $warehouse_code = new Warehouses() ?>
            var warehouse_code = <?php echo $warehouse_code->getWarehouseCode(); ?>;
		</script>
</body>
<!-- Preloader -->

</html>