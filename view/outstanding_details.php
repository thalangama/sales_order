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
                <h1>Outstanding Details</h1>
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

                <div class="col-12 col-sm-12 col-xs-12 col-lg-12 common-box without-heading">
                    <h2>Customer Details</h2>
                    <form id="frmCustomerSave" name="frmCustomerSave" action="customer_creation.php" method="POST">
                        <input class="form-control" id="customer_id" name="customer_id" type="hidden">
                        <div class="form-group col-lg-6 col-sm-6 col-xs-12">
                            <label for="" class="col-sm-5 col-xs-5">Name</label>
                            <div class="col-sm-7 col-xs-7">
                                <input class="form-control" id="name" name="name" type="text" disabled>
                            </div>
                        </div>
                        <div class="form-group col-lg-6 col-sm-6 col-xs-12">
                            <label for="" class="col-sm-5 col-xs-5">ID No</label>
                            <div class="col-sm-7 col-xs-7">
                                <input class="form-control" id="customer_nic" name="customer_nic" type="text" disabled>
                            </div>
                        </div>
                        <div class="form-group col-lg-6 col-sm-6 col-xs-12">
                            <label for="" class="col-sm-5 col-xs-5">Address</label>
                            <div class="col-sm-7 col-xs-7">
                                <input class="form-control" id="address" name="address" type="text" disabled>
                            </div>
                        </div>
                        <div class="form-group col-lg-6 col-sm-6 col-xs-12">
                            <label for="" class="col-sm-5 col-xs-5">Phone No </label>
                            <div class="col-sm-7 col-xs-7">
                                <input class="form-control" id="phone_no" name="phone_no" type="text" disabled>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-12 col-sm-12 col-xs-12 col-lg-12 common-box without-heading">
                    <h2>Order Details</h2>
                    <form id="frmOrdersSave" name="frmOrdersSave" action="" method="POST">
                        <input class="form-control" id="order_id" name="order_id" type="hidden">
                        <div class="form-group col-lg-6 col-sm-6 col-xs-12">
                            <label for="" class="col-sm-5 col-xs-5">Order No</label>
                            <div class="col-sm-7 col-xs-7">
                                <input class="form-control" id="order_no" name="order_no" type="text" disabled>
                            </div>
                        </div>
                        <div class="form-group col-lg-6 col-sm-6 col-xs-12">
                            <label for="" class="col-sm-5 col-xs-5">Sales Officer Id</label>
                            <div class="col-sm-7 col-xs-7">
                                <input class="form-control" id="sales_officer_id" name="sales_officer_id" type="text" disabled>
                            </div>
                        </div>
                        <div class="form-group col-lg-6 col-sm-6 col-xs-12">
                            <label for="" class="col-sm-5 col-xs-5">Order Date</label>
                            <div class="col-sm-7 col-xs-7">
                                <input class="form-control" id="date" name="date" type="text"  disabled>
                            </div>
                        </div>
                        <div class="form-group col-lg-6 col-sm-6 col-xs-12">
                            <label for="" class="col-sm-5 col-xs-5">Recovery Officer Id</label>
                            <div class="col-sm-7 col-xs-7">
                                <input class="form-control" id="recovery_officer_id" name="recovery_officer_id" type="text" disabled>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-sm-12 col-xs-12 col-lg-12 common-box without-heading">
                    <h2>Order Items</h2>

                    <div class="dataTables_wrapper no-footer" id="tblAccountDetails_wrapper">
                        <table class="display table footable dataTable no-footer footable-loaded" id="tblAddItems" role="grid" border="0" cellspacing="0" cellpadding="0">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc">No</th>
                                <th class="sorting">Item Code</th>
                                <th class="sorting">Name</th>
                                <th class="sorting">Quantity</th>
                                <th class="sorting">Price</th>
                                <th class="sorting">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <div class="col-3 col-sm-3 col-xs-3 col-lg-3 common-box without-heading ">
                            <table class="display table footable dataTable footable-loaded" role="grid" border="0" cellspacing="0" cellpadding="0">

                                <tr>
                                    <td>Total</td>
                                    <td><input width="20px" type="text" id="itemTotal" value="0.00"  style="text-align:right" disabled /></td>
                                </tr>
                                <tr>
                                    <td>Initial Payment</td>
                                    <td><input width="20px" type="text" id="itemPayment"  style="text-align:right" disabled/></td>
                                </tr>
                                <tr>
                                    <td>Balance</td>
                                    <td><input width="20px" type="text" id="itemBalance" value="0.00" style="text-align:right" disabled /></td>
                                </tr>
                                <tr>
                                    <td>Invoice No</td>
                                    <td><input width="20px" type="text" id="invoiceNo" name="invoiceNo" value="" style="text-align:right" disabled /></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-8 col-sm-8 col-xs-8 col-lg-8 common-box without-heading "style="margin: 0px 0px 10px 15px!important">
                            <h2>Payment Details</h2>
                            <div class="form-group col-lg-4 col-sm-4 col-xs-12">
                                <label for="" class="col-sm-6 col-xs-6">Number Of Terms</label>
                                <div class="col-sm-6 col-xs-6">
                                    <input class="form-control" id="noOfterms" name="noOfterms" type="text" disabled>
                                </div>
                            </div>
                            <div class="form-group col-lg-4 col-sm-4 col-xs-12">
                                <label for="" class="col-sm-6 col-xs-6">Payment Date</label>
                                <div class="col-sm-6 col-xs-6">
                                    <div class="clearfix"></div>
                                    <input class="form-control" id="paymentDate" name="paymentDate" type="text" disabled>
                                </div>
                            </div>
                            <div class="form-group col-lg-4 col-sm-4 col-xs-12">
                                <label for="" class="col-sm-6 col-xs-6">Monthly Installment</label>
                                <div class="col-sm-6 col-xs-6">
                                    <div class="clearfix"></div>
                                    <input class="form-control" id="installment" name="installment" type="text" value="0.00" disabled>
                                </div>
                            </div>
                            <div class="form-group col-lg-4 col-sm-4 col-xs-12">
                                <label for="" class="col-sm-6 col-xs-6">Total Outstanding</label>
                                <div class="col-sm-6 col-xs-6">
                                    <div class="clearfix"></div>
                                    <input class="form-control" id="TotalOutstanding" name="TotalOutstanding" type="text" value="0.00" disabled>
                                </div>
                            </div>
                            <div class="form-group col-lg-4 col-sm-4 col-xs-12">
                                <label for="" class="col-sm-6 col-xs-6">Current Outstanding</label>
                                <div class="col-sm-6 col-xs-6">
                                    <div class="clearfix"></div>
                                    <input class="form-control" id="currentOutstanding" name="currentOutstanding" type="text" value="0.00" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-xs-12 col-lg-12 common-box without-heading">
                    <h2>Payment History</h2>

                    <div class="dataTables_wrapper no-footer" id="tblAccountDetails_wrapper">
                        <table class="display table footable dataTable no-footer footable-loaded" id="tblPaymentHistory" role="grid" border="0" cellspacing="0" cellpadding="0">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc">No</th>
                                <th class="sorting">Amount</th>
                                <th class="sorting">Invoice No</th>
                                <th class="sorting">Payment Date</th>
                                <th class="sorting">Recovery Officer</th>
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
		<script src="../js/custom/outstanding_details.js"></script>
		<script>
			w3.includeHTML();
            var order_number = '<?php echo $_GET["order_no"]; ?>';
		</script>
</body>
<!-- Preloader -->

</html>