<?php
include_once '../controllers/session.php';
checkAndAllow('orders.php');
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
            <h1>Sales Reports</h1>
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
                <form id="frmReportsSales" name="frmReportsSales" method="POST">
                    <div class="form-group col-lg-6 col-sm-6 col-xs-12">
                        <label for="" class="col-sm-5 col-xs-5">Sales Officer ID</label>
                        <div class="col-sm-7 col-xs-7">
                            <input class="form-control" id="sales_officer_id" name="sales_officer_id" type="text">
                        </div>
                    </div>
                    <div class="form-group col-lg-6 col-sm-6 col-xs-12">
                        <label for="" class="col-sm-5 col-xs-5">From Date</label>
                        <div class="col-sm-7 col-xs-7">
                            <input class="form-control" id="from_date" name="from_date" type="test">
                        </div>
                    </div>
                    <div class="form-group col-lg-6 col-sm-6 col-xs-12">
                        <label for="" class="col-sm-5 col-xs-5">To Date</label>
                        <div class="col-sm-7 col-xs-7">
                            <input class="form-control" id="to_date" name="to_date" type="test">
                        </div>
                    </div>
                    <div class="form-group col-lg-6 col-sm-6 col-xs-12 pull-right">
                        <a id="btnSearch" class="btn btn-add pull-right" href="#">Search <span class="glyphicon glyphicon glyphicon-search"></span></a>
                        <a id="btnClear" class="btn btn-next pull-right draft " onclick="clearFields()" >Clear</a>
                    </div>
                </form>
            </div>

            <div class="col-12 col-sm-12 col-xs-12 col-lg-12 common-box without-heading">
                <h2>Sales Details</h2>
                <table class="display table footable dataTable no-footer footable-loaded" id="tblReportsSales" role="grid" border="0" cellspacing="0" cellpadding="0">
                    <thead>
                    <tr role="row">
                        <th class="sorting_asc">No</th>
                        <th class="sorting">Order No</th>
                        <th class="sorting">Order Date</th>
                        <th class="sorting">Amount</th>
                        <th class="sorting">Sales Officer ID</th>
                        <th class="sorting">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <h3><div id="totalSale"></div></h3>
                <div>
                    <form target="_blank" action="../controllers/reports_controller.php" method="post">
                        <input type="hidden" name="REQUEST_TYPE" id="REQUEST_TYPE" value="DOWNLOAD">
                        <input type="hidden" name="REPORT" id="REPORT" value="SALES">
                        <input type="hidden" name="sales_officer_id" id="download_sales_officer_id" value="">
                        <input type="hidden" name="from_date" id="download_from_date" value="">
                        <input type="hidden" name="to_date" id="download_to_date" value="">
                        <button type="submit" id="btnDownload" class="btn btn-next pull-right draft " disabled >Download</button>
                    </form>
                </div>
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
<script src="../js/lib/jquery-ui/jquery-ui.js"></script>
<script src="../js/lib/jquery.dataTables.min.js"></script>
<script src="../js/lib/footable.min.js"></script>
<script src="../js/lib/modernizr.custom.js"></script>
<script src="../js/lib/jquery.dlmenu.min.js"></script>
<script src="../js/lib/bootstrap-multiselect.min.js"></script>
<script src="../js/lib/w3.js"></script>
<script src="../js/lib/jquery.validate.js"></script>
<script src="../js/custom/common.js"></script>
<script src="../js/custom/reports_sales.js"></script>
<script>
    w3.includeHTML();
</script>
</body>
<!-- Preloader -->

</html>