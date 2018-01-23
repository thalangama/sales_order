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
    <script type="text/javascript" src="../js/CreateHTML5Elements.js"></script>
</head>

<body>
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
                <p class="visible-xs">
                    <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"> <span class="glyphicon glyphicon-align-justify"></span> Navigation </button>
                </p>
                <!-- common search -->
                <div class="col-12 col-sm-12 col-xs-12 col-lg-12 common-box">
                    <h2>Outstanding</h2>
                    <div class="form-group col-lg-4 col-sm-4 col-xs-12">
                        <label for="" class="col-sm-5 col-xs-5">Location<span class="mandatory">*</span></label>
                        <div class="col-sm-7 col-xs-7">
                            <select class="selectpicker ">
                                <option>--Select--</option>
                                <option>Make </option>
                                <option>Make</option>
                                <option>Make</option>
                                <option>Make</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-lg-4 col-sm-4 col-xs-12">
                        <label for="" class="col-sm-5 col-xs-5">Module<span class="mandatory">*</span></label>
                        <div class="col-sm-7 col-xs-7">
                            <select class="selectpicker ">
                                <option>FD</option>
                                <option>Credit</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-lg-4 col-sm-4 col-xs-12">
                        <label for="" class="col-sm-5 col-xs-5">Payment Mode<span class="mandatory">*</span></label>
                        <div class="col-sm-7 col-xs-7">
                            <select class="selectpicker ">
                                <option>cheque</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-lg-4 col-sm-4 col-xs-12">
                        <label for="" class="col-sm-5 col-xs-5">Product<span class="mandatory">*</span></label>
                        <div class="col-sm-7 col-xs-7">
                            <select class="selectpicker ">
                                <option>ST</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-lg-4 col-sm-4 col-xs-12">
                        <label for="" class="col-sm-5 col-xs-5">Code Type</label>
                        <div class="col-sm-7 col-xs-7">
                            <select class="selectpicker ">
                                <option>--Select--</option>
                                <option>FD Number</option>
                                <option>Contract Number</option>
                                <option>New NIC</option>
                                <option>NIC</option>
                                <option>BRN</option>
                                <option>Driving License</option>
                                <option>Passport</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-lg-4 col-sm-4 col-xs-12">
                        <label for="" class="col-sm-5 col-xs-5">Code</label>
                        <div class="col-sm-7 col-xs-7">
                            <input class="form-control" type="text"> </div>
                    </div>
                    <div class="form-group col-lg-4 col-sm-4 col-xs-12 pull-right"> <a id="btnSearch" class="btn btn-add pull-right" href="#">Search <span class="glyphicon glyphicon glyphicon-search"></span></a> </div>
                    <!-- form-group-->
                </div>
                <!-- /common search -->
                <!-- FD Details -->
                <div class="col-sm-12 col-xs-12 common-box">
                    <h2>FD Details</h2>
                    <div class="icon-action-detail pull-right"> <span class="label label-danger">Dormant</span> <span class="label label-warning">Freeze</span> <span class="label label-pending">Pending</span> </div>
                    <div class="dataTables_wrapper no-footer" id="tblAccountDetails_wrapper">
                        <table class="display table footable dataTable no-footer footable-loaded" id="tblAccountDetails" role="grid" border="0" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc">Select</th>
                                    <th class="sorting">FD No</th>
                                    <th class="sorting">Location</th>
                                    <th class="sorting">Customer Ref. No</th>
                                    <th class="sorting">Customer Name</th>
                                    <th class="sorting">FD Amount</th>
                                    <th class="sorting">Term</th>
                                    <th class="sorting">Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="odd" role="row">
                                    <td class="sorting_1">
                                        <input name="chkAccountDetails" class="account-change" id="chkAccountDetails_0" type="radio"> </td>
                                    <td class="left">035001000071381 </td>
                                    <td class="currency-min right info-balance-035001000071381">32006.6</td>
                                    <td class="currency-min right info-hold-035001000071381">0</td>
                                    <td class="currency-min right info-available-035001000071381">32006.6</td>
                                    <td>STATEMENT</td>
                                    <td>STATEMENT</td>
                                    <td>STATEMENT</td>
                                </tr>
                                <tr class="even" role="row">
                                    <td class="sorting_1">
                                        <input name="chkAccountDetails" class="account-change" id="chkAccountDetails_1" type="radio"> </td>
                                    <td class="left">035008000000021 </td>
                                    <td class="currency-min right info-balance-035008000000021">32796.36</td>
                                    <td class="currency-min right info-hold-035008000000021">2000</td>
                                    <td class="currency-min right info-available-035008000000021">30796.36</td>
                                    <td>PASSBOOK</td>
                                    <td>PASSBOOK</td>
                                    <td>PASSBOOK</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /FD Details -->
                <!-- Contract Details -->
                <div class="col-12 col-sm-12 col-xs-12 col-lg-12 common-box report-table-scroll" style="" id="divContractDetailsRadio">
                    <h2>Contract Details</h2>
                    <div id="tblContractRadio_wrapper" class="dataTables_wrapper no-footer">
                        <div class="dataTables_length" id="tblContractRadio_length">
                            <label>Show
                                <select name="tblContractRadio_length" aria-controls="tblContractRadio" class="">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select> entries</label>
                        </div>
                        <div id="tblContractRadio_processing" class="dataTables_processing" style="display: none;">Processing...</div>
                        <table cellpadding="0" cellspacing="0" border="0" class="display table footable footable-loaded no-footer dataTable" id="tblContractRadio" role="grid" style="" aria-describedby="tblContractRadio_info">
                            <thead>
                                <tr role="row">
                                    <th data-sort-ignore="true" class="center sorting_disabled" tabindex="0" aria-controls="tblContractRadio" rowspan="1" colspan="1" aria-label="Select" style="width: 0px;">Select</th>
                                    <th data-toggle="true" data-sort-initial="true" class="center sorting_disabled" tabindex="0" aria-controls="tblContractRadio" rowspan="1" colspan="1" aria-label="Contract No" style="width: 0px;">Contract No</th>
                                    <th class="left sorting_disabled" tabindex="0" aria-controls="tblContractRadio" rowspan="1" colspan="1" aria-label="Location" style="width: 0px;">Location</th>
                                    <th class="center sorting_disabled" tabindex="0" aria-controls="tblContractRadio" rowspan="1" colspan="1" aria-label="NIC" style="width: 0px;">NIC</th>
                                    <th class="left sorting_disabled" tabindex="0" aria-controls="tblContractRadio" rowspan="1" colspan="1" aria-label="Customer Name" style="width: 0px;">Customer Name</th>
                                    <th class="right center sorting_disabled" tabindex="0" aria-controls="tblContractRadio" rowspan="1" colspan="1" aria-label="Customer Type" style="width: 0px;">Customer Type</th>
                                    <th class="center currency-min right sorting_disabled" tabindex="0" aria-controls="tblContractRadio" rowspan="1" colspan="1" aria-label="Loan Amount" style="width: 0px;">Loan Amount</th>
                                    <th class="center sorting_disabled" tabindex="0" aria-controls="tblContractRadio" rowspan="1" colspan="1" aria-label="Contract Status" style="width: 0px;">Contract Status</th>
                                    <th class="right center sorting_disabled" tabindex="0" aria-controls="tblContractRadio" rowspan="1" colspan="1" aria-label="Recovery Status" style="width: 0px;">Recovery Status</th>
                                    <th class="right currency-min sorting_disabled" tabindex="0" aria-controls="tblContractRadio" rowspan="1" colspan="1" aria-label="Total Outstanding" style="width: 0px;">Total Outstanding</th>
                                    <th data-sort-ignore="true" class="right currency-min sorting_disabled" tabindex="0" aria-controls="tblContractRadio" rowspan="1" colspan="1" aria-label="Arrears Amount" style="width: 0px;">Arrears Amount</th>
                                    <th data-sort-ignore="true" class="right currency-min sorting_disabled" tabindex="0" aria-controls="tblContractRadio" rowspan="1" colspan="1" aria-label="DI Interest" style="width: 0px;">DI Interest</th>
                                    <th data-sort-ignore="true" class="center currency-min right sorting_disabled" tabindex="0" aria-controls="tblContractRadio" rowspan="1" colspan="1" aria-label="Arrears Age" style="width: 0px;">Arrears Age</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr role="row" class="odd">
                                    <td class="center sorting_1">
                                        <input type="radio" name="contractRadio" id="contractRadio39048" checked=""> </td>
                                    <td class=" center">AGMBA012369</td>
                                    <td class=" left">001 - AMBALANGODA</td>
                                    <td class=" center">936110177V</td>
                                    <td class=" left">MISS. T.G.M. DILPRABHA</td>
                                    <td class=" center">APPLICANT</td>
                                    <td class=" currency-min right">52,500.00</td>
                                    <td class=" center"><span class="label draft label-success">Active</span></td>
                                    <td class=" center">-</td>
                                    <td class=" currency-min right">68,617.40</td>
                                    <td class=" currency-min right">63,719.00</td>
                                    <td class=" currency-min right">4,423.40</td>
                                    <td class=" currency-min right">22.95</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="dataTables_info" id="tblContractRadio_info" role="status" aria-live="polite">Showing 1 to 1 of 1 entries</div>
                        <div class="dataTables_paginate paging_full_numbers" id="tblContractRadio_paginate"><a class="paginate_button first disabled" aria-controls="tblContractRadio" data-dt-idx="0" tabindex="0" id="tblContractRadio_first">First</a><a class="paginate_button previous disabled" aria-controls="tblContractRadio" data-dt-idx="1" tabindex="0" id="tblContractRadio_previous">Previous</a><span><a class="paginate_button current" aria-controls="tblContractRadio" data-dt-idx="2" tabindex="0">1</a></span><a class="paginate_button next disabled" aria-controls="tblContractRadio" data-dt-idx="3" tabindex="0" id="tblContractRadio_next">Next</a><a class="paginate_button last disabled" aria-controls="tblContractRadio" data-dt-idx="4" tabindex="0" id="tblContractRadio_last">Last</a></div>
                    </div>
                </div>
                <!-- /Contract Details -->
                <!-- Expenses Details -->
                <div class="clearfix">
                    <div class="col-12 col-sm-12 col-xs-12 col-lg-12 common-box">
                        <h2>Payment Detail</h2>
                        <table class="display table table-credit footable dataTable no-footer footable-loaded" id="tblDocuments" role="grid" border="0" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr role="row">
                                    <th>Select</th>
                                    <th>Payee Reference</th>
                                    <th>Payee Name</th>
                                    <th>Payment Amount</th>
                                    <th>Print NIC</th>
                                    <th>Print Bearer</th>
                                    <th>Customer Visit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="rdoCandicate" value=""> </td>
                                    <td>1458</td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" name="rdoCandicate" value=""> </td>
                                    <td>
                                        <input type="checkbox" name="rdoCandicate" value=""> </td>
                                    <td>
                                        <input type="checkbox" name="rdoCandicate" value=""> </td>
                                </tr>
                            </tbody>
                        </table>
                        <br />
                        <br />
                        <!-- controls -->
                        <!-- /controls -->
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-xs-12 col-lg-12 common-box without-heading">
                    <div class="form-group col-lg-4 col-sm-4 col-xs-12">
                        <label for="" class="col-sm-5 col-xs-5">Reason<span class="mandatory">*</span></label>
                        <div class="col-sm-7 col-xs-7">
                            <select class="selectpicker ">
                                <option>--Select--</option>
                                <option>Customer request </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-lg-6 col-sm-6 col-xs-12">
                        <label class="col-sm-4 col-xs-4">Remark<span class="mandatory">*</span></label>
                        <div class="col-sm-8 col-xs-8">
                            <textarea rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <!-- /Expenses Details -->
                <div class="col-12 col-sm-12 col-xs-12 col-lg-12 common-box without-heading "> <a id="" class="btn btn-next pull-right draft " href="#">Process</a></div>
            </div>
            <!--/detail panel-->
        </div>
        <!--/.container-->
        <!-- bootdtrap-->
        <script src="../js/lib/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../js/bootstrap-datepicker.js"></script>
        <script src="../js/lib/jquery.dataTables.min.js"></script>
        <script src="../js/footable.min.js"></script>
        <script src="../js/lib/modernizr.custom.js"></script>
        <script src="../js/lib/jquery.dlmenu.min.js"></script>
        <script src="../js/lib/bootstrap-multiselect.min.js"></script>
		<script src="../js/lib/w3.js"></script>
		<script>
			w3.includeHTML();
		</script>
</body>
<!-- Preloader -->

</html>