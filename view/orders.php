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
                <h1>Order</h1>
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
                    <h2>Search Order</h2>
					<form id="frmOrdersSearch" name="frmOrdersSearch" action="" method="POST">
						<div class="form-group col-lg-6 col-sm-6 col-xs-12">
							<label for="" class="col-sm-5 col-xs-5">Order No</label>
							<div class="col-sm-7 col-xs-7">
								<input class="form-control" id="search_order_no" name="search_order_no" type="text"> </div>
						</div>
						<div class="form-group col-lg-6 col-sm-6 col-xs-12 pull-right"> <a id="btnSearch" class="btn btn-add pull-right" href="#">Search <span class="glyphicon glyphicon glyphicon-search"></span></a> </div>
                    </form/>
                </div>
			
			<div class="col-12 col-sm-12 col-xs-12 col-lg-12 common-box without-heading">
				<h2>Order Details</h2>
				<form id="frmOrdersSave" name="frmOrdersSave" action="" method="POST">
					<input class="form-control" id="order_id" name="order_id" type="hidden">
					<div class="form-group col-lg-6 col-sm-6 col-xs-12">
						<label for="" class="col-sm-5 col-xs-5">Order No<span class="mandatory">*</span></label>
						<div class="col-sm-7 col-xs-7">
							<input class="form-control" id="order_no" name="order_no" type="text">
						</div>
					</div>
					<div class="form-group col-lg-6 col-sm-6 col-xs-12">
						<label for="" class="col-sm-5 col-xs-5">Customer NIC<span class="mandatory">*</span></label>
						<div class="col-sm-7 col-xs-7">
							<input class="form-control" id="customer_nic" name="customer_nic" type="text">
						</div>
					</div>
					<div class="form-group col-lg-6 col-sm-6 col-xs-12">
						<label for="" class="col-sm-5 col-xs-5">Sales Officer Id<span class="mandatory">*</span></label>
						<div class="col-sm-7 col-xs-7">
							<input class="form-control" id="sales_officer_id" name="sales_officer_id" type="text">
						</div>
					</div>
					<div class="form-group col-lg-6 col-sm-6 col-xs-12">
						<label for="" class="col-sm-5 col-xs-5">Order Date<span class="mandatory">*</span></label>
						<div class="col-sm-7 col-xs-7">
							<input class="form-control" id="date" name="date" type="text">
						</div>
					</div>
					<div class="form-group col-lg-6 col-sm-6 col-xs-12">
						<label for="" class="col-sm-5 col-xs-5">Recovery Officer Id<span class="mandatory">*</span></label>
						<div class="col-sm-7 col-xs-7">
							<input class="form-control" id="recovery_officer_id" name="recovery_officer_id" type="text">
						</div>
					</div>
				</form>
			</div>
			<div class="col-12 col-sm-12 col-xs-12 col-lg-12 common-box without-heading">
				<h2>Order Items</h2>
				<div class="form-group col-lg-6 col-sm-6 col-xs-12">
					<label for="" class="col-sm-5 col-xs-5">Item Code<span class="mandatory">*</span></label>
					<div class="col-sm-7 col-xs-7">
						<input class="form-control" id="item_code" name="item_code" type="text">
					</div>
				</div>
				<div class="form-group col-lg-6 col-sm-6 col-xs-12">
					<label for="" class="col-sm-5 col-xs-5">Price<span class="mandatory">*</span></label>
					<div class="col-sm-7 col-xs-7">
						<input class="form-control" id="price" name="price" type="text">
					</div>
				</div>
				<div class="col-12 col-sm-12 col-xs-12 col-lg-12 common-box without-heading "> <a class="btn btn-next pull-right draft " href="#" id="btnAddItems">Add Item</a></div>
				<div class="dataTables_wrapper no-footer" id="tblAccountDetails_wrapper">
					<table class="display table footable dataTable no-footer footable-loaded" id="tblAddItems" role="grid" border="0" cellspacing="0" cellpadding="0">
						<thead>
							<tr role="row">
								<th class="sorting_asc">No</th>
								<th class="sorting">Item Id</th>
								<th class="sorting">Name</th>
								<th class="sorting">Price</th>
								<th class="sorting">Action</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
                <!-- /Expenses Details -->
			<div class="col-12 col-sm-12 col-xs-12 col-lg-12 common-box without-heading "> <a id="btnProcess" class="btn btn-next pull-right draft " href="#">Process</a></div>
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
		<script src="../js/custom/orders.js"></script>
		<script>
			w3.includeHTML();
		</script>
</body>
<!-- Preloader -->

</html>