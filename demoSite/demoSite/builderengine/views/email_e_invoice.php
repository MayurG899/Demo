<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Portershed | Invoice</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="<?=base_url()?>themes/dashboard/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="<?=base_url()?>themes/dashboard/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?=base_url()?>themes/dashboard/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="<?=base_url()?>themes/dashboard/assets/css/animate.min.css" rel="stylesheet" />
	<link href="<?=base_url()?>modules/booking_events/assets/css/style.min.css" rel="stylesheet" />
	<link href="<?=base_url()?>themes/dashboard/assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="<?=base_url()?>themes/dashboard/assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?=base_url()?>themes/dashboard/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	<style type="text/css">

			body,
			.content,
			.page-header-fixed {
				padding: 0 !important;
				margin: 0 !important;
			}
			.sidebar,
			.header,
			.theme-panel {
				display: none !important;
			}
			.invoice-company {
				border-bottom: 1px solid #e2e7eb !important;
				margin-bottom: 20px !important;
			}
			.invoice .invoice-from, 
			.invoice .invoice-to {
				float: left !important;
				display: inline !important;
				width: 25% !important;
				margin: 0 !important;
			}
			.invoice .invoice-date {
				float: right !important;
				margin: 0 !important;
				width: 25% !important;
				display: inline !important;
				text-align: right !important;
			}
			.invoice-header {
				margin: 0 !important;
				padding: 0 !important;
			}
			.table-responsive {
				border: none !important;
				display: block !important;
				float: left !important;
				width: 100% !important;
				margin-top: 10px !important;
			}
			.invoice-price {
				margin-top: 20px !important;
				border: 1px solid #e2e7eb !important;
				float: left !important;
				width: 100% !important;
				display: block !important;
			}
			.invoice .invoice-price .invoice-price-left,
			.invoice .invoice-price .invoice-price-right {
				display: block !important;
				float: left !important;
				width: 75% !important;
			}
			.invoice .invoice-price .invoice-price-right {
				width: 25% !important;
			}
			.invoice-price .invoice-price-right {
				text-align: right !important;
			}
			.invoice-price .invoice-price-left .sub-price {
				float: left !important;
				display: block !important;
				margin-top: 5px;
			}
			.invoice-note,
			.invoice-footer {
				float: left !important;
				width: 100% !important;
			}
			
	</style>
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" style="padding-top:10px;">		
		<!-- begin #content -->
		<div id="content" class="content" style="margin:20px;padding:20px;">
			<!-- begin page-header -->
			<h1 class="page-header hidden-print">Invoice #<?=$order->id?></h1>
			<!-- end page-header -->
			
			<!-- begin invoice -->
			<div class="invoice">
                <div class="invoice-company">
                    <span class="pull-right hidden-print">
                    <!--<a href="javascript:;" class="btn btn-sm btn-success m-b-10"><i class="fa fa-download m-r-5"></i> Export as PDF</a>-->
                    <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print m-r-5"></i> Print</a>
                    </span>
                    <img src="<?=$company_logo?>" class="img-responsive"style=" width:120px;"/>
                </div>
                <div class="invoice-header">
                    <div class="invoice-from">
                        <small>from</small>
                        <address class="m-t-5 m-b-5">
                            <strong><?=$company_name?></strong><br />
                            <?=$company_address?><br />
							Email: <?=$company_email?><br/>
                            Phone: <?=$company_phone?><br />
							TAX VAT Number: <?=$company_tax_vat_number?>
                        </address>
                    </div>
                    <div class="invoice-to">
                        <small>to</small>
                        <address class="m-t-5 m-b-5">
                            <strong><?=ucfirst($order->username)?></strong><br />
                            <?=$order->address?><br />
                            <?=$order->city?><br />
							Email: <?=$order->email?><br />
                            Phone: <?=$order->phone?><br />
                        </address>
                    </div>
                    <div class="invoice-date">
                        <div class="date m-t-5"><b>Invoice #<?=$order->id?></b></div>
                        <div class="date m-t-5"><?=date('d/m/Y',$order->time_created)?></div>
                        <!--<div class="invoice-detail">
                            #0000123DSS<br />
                            Services Product
                        </div>-->
                    </div>
                </div>
                <div class="invoice-content">
                    <div class="table-responsive">
                        <table class="table table-invoice">
                            <thead>
                                <tr>
                                    <th><?=ucfirst($object_type)?></th>
                                    <th>TICKETS</th>
                                    <th>TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <?=$object->name?><br />
                                        <small><?=strip_tags($object->description)?></small>
                                    </td>
                                    <td><?=$order->tickets?></td>
									<?$currency = new Currency(1);?>
                                    <td><?=$currency->symbol?><?=$order->price?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="invoice-price">
                        <div class="invoice-price-left">
							<div class="invoice-price-row">
                                <div class="sub-price">
									<?if($order->price == 0) echo '<span class="label label-success" style="color:#fff;font-size:20px;">FREE EVENT</span>';?>
                                </div>
								<!--
                                <div class="sub-price">
                                    <i class="fa fa-plus"></i>
                                </div>
                                <div class="sub-price">
                                    <small>PAYPAL FEE (5.4%)</small>
                                    $108.00
                                </div>
								-->
                            </div>
                        </div>
                        <div class="invoice-price-right">
                            <small>TOTAL</small> <?=$currency->symbol?><?=$order->price?>
                        </div>
                    </div>
                </div>
                <div class="invoice-note">
                    * Make all cheques payable to [<?=$company_name?>]<br />
                    * Payment is due within 30 days<br />
                    * If you have any questions concerning this invoice, contact  [ <?=$company_phone?>, <?=$company_email?>]
                </div>
                <div class="invoice-footer text-muted">
                    <p class="text-center m-b-5">
                        THANK YOU FOR YOUR ORDER
                    </p>
                    <p class="text-center">
                        <span class="m-r-10"><i class="fa fa-globe"></i> <?=base_url()?></span>
                        <span class="m-r-10"><i class="fa fa-phone"></i> T:<?=$company_phone?></span>
                        <span class="m-r-10"><i class="fa fa-envelope"></i> <?=$company_email?></span>
                    </p>
                </div>
            </div>
			<!-- end invoice -->
		</div>
		<!-- end #content -->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?=base_url()?>themes/dashboard/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="<?=base_url()?>themes/dashboard/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="<?=base_url()?>themes/dashboard/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="<?=base_url()?>themes/dashboard/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="assets/crossbrowserjs/html5shiv.js"></script>
		<script src="assets/crossbrowserjs/respond.min.js"></script>
		<script src="assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="<?=base_url()?>themes/dashboard/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?=base_url()?>themes/dashboard/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="<?=base_url()?>themes/dashboard/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>
</body>
</html>
