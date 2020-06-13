<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Order | Invoice</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="<?=base_url()?>themes/dashboard/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="<?=base_url()?>themes/dashboard/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?=base_url()?>themes/dashboard/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="<?=base_url()?>themes/dashboard/assets/css/animate.min.css" rel="stylesheet" />
	<link href="<?=base_url()?>modules/booking_events/assets/css/style.min.css" rel="stylesheet" />
	<link href="<?=base_url()?>themes/dashboard/assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="<?=base_url()?>themes/dashboard/assets/css/invoice-print.css" rel="stylesheet" />
	<link href="<?=base_url()?>themes/dashboard/assets/css/invoice-custom.css" rel="stylesheet" />
	<link href="<?=base_url()?>themes/dashboard/assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?=base_url()?>themes/dashboard/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
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
                    <img src="<?=checkImagePath($company_logo)?>" class="img-responsive"style=" width:120px;"/>
                </div>
                <div class="invoice-header">
                    <div class="invoice-from">
                        <small>from</small>
                        <address class="m-t-5 m-b-5">
                            <strong><?=$company_name?></strong><br />
                            <?=$company_address?><br />
							<?=$company_zip?>, <?=$company_city?><br/>
							<?=$company_country?><br/>
							Email: <?=$company_email?><br/>
                            Phone: <?=$company_phone?><br />
							TAX VAT Number: <?=$company_tax_vat_number?><br/>
							Bank Account Number: <?=$company_bank_account_number?>
                        </address>
                    </div>
					<?if($order->billingaddress_id > 0):?>
                    <div class="invoice-to">
                        <small>billing address</small>
                        <address class="m-t-5 m-b-5">
                            <strong><?=ucfirst($order_bill_address->first_name).' '.ucfirst($order_bill_address->last_name);?></strong><br />
                            <?=$order_bill_address->address_line_1?><br />
                            <?=$order_bill_address->zip?>, <?=$order_bill_address->city?><br />
							<?=$order_bill_address->country?><br/>
							Email: <?=$order_bill_address->email?><br />
                            Phone: <?=$order_bill_address->phone?><br />
                        </address>
                    </div>
					<?endif;?>
					<?if($order->shippingaddress_id > 0):?>
                    <div class="invoice-to">
                        <small>shipping address</small>
                        <address class="m-t-5 m-b-5">
                            <strong><?=ucfirst($order_ship_address->first_name).' '.ucfirst($order_ship_address->last_name);?></strong><br />
                            <?=$order_ship_address->address_line_1?><br />
                            <?=$order_ship_address->zip?>, <?=$order_ship_address->city?><br />
							<?=$order_ship_address->country?><br/>
							Email: <?=$order_ship_address->email?><br />
                            Phone: <?=$order_ship_address->phone?><br />
                        </address>
                    </div>
					<?endif;?>
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
									<th>#</th>
                                    <th>ITEM</th>
                                    <th>QUANTITY</th>
									<th>PRICE</th>
                                    <th>TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
								<?$i = 1;?>
								<?$total_price = 0;?>
								<?foreach($products as $product):?>
									<?$custom_data = json_decode($product->custom_data);?>
									<tr>
										<td><?=$i?></td>
										<?if($product->name != "Shipping"):?>
											<td>
												<?=$product->name;?> 
												<?
												if($order->module == 'ecommerce'){
													if($custom_data->product_color != 'none' && $custom_data->product_color != '') 
														echo "  ".str_replace('default--+0','',$custom_data->product_color);
													if($custom_data->product_option != 'none' && $custom_data->product_option != '') 
														echo "  ".implode(', ', array_filter(str_replace('default--+0','',$custom_data->product_option)));
												}
												if($order->module != 'ecommerce' && !empty($custom_fields)){
													if(isset($custom_fields->description)){
														echo '<br /><small>'.strip_tags($custom_fields->description).'</small>';
													}
												}
												?>
											</td>
										<?else:?>
											<td><?=$product->name;?><br /></td>
										<?endif;?>
										<td><?=$product->quantity?></td>
										<?if($currency->symbol_position == 'before'):?>
											<td><?=$currency->symbol ?><?=number_format($product->price,2,".",",");?></td>
											<td><?=$currency->symbol ?><?=$subtotal = number_format(($product->quantity * $product->price),2,".",","); ?></td>
										<?else:?>
											<td><?=number_format($product->price,2,".",",");?><?=$currency->symbol ?></td>
											<td><?=$subtotal = number_format(($product->quantity * $product->price),2,".",","); ?><?=$currency->symbol ?></td>
										<?endif;?>
									</tr>
									<?$total_price += $product->price * $product->quantity;?>
									<?$i++;?>
								<?endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="invoice-price">
                        <div class="invoice-price-left">
							<div class="invoice-price-row">
                                <div class="sub-price">
									<?if($order->gross == 0) 
										echo '<span class="label label-success" style="color:#fff;font-size:20px;">FREE OF CHARGE</span>';
									?>
                                </div>
								<?if(!empty($additional_info)):?>
									<div class="sub-price">
										<small>
											<?=$additional_info?>
										</small>
									</div>
								<?endif;?>
                            </div>
                        </div>
                        <div class="invoice-price-right">
							<?$order_details = json_decode($order->custom_data);?>
							<?if(isset($order_details->total)):?>
								<?if($currency->symbol_position == 'before'):?>
									<p><span class="leftSub">SUBTOTAL :</span><span class="rightSub"> <?=$currency->symbol ?><?=number_format($total_price,2,".",",");?></span></p>
								<?else:?>
									<p><span class="leftSub">TOTAL:</span><span class="rightSub">  <?=number_format($total_price,2,".",",");?><?=$currency->symbol ?></span></p>
								<?endif;?>
								<?if(isset($order_details->addons_total) && $order_details->addons_total > 0):?>
									<p><span class="leftSub">Add-On`s:</span><span class="rightSub">  <?=$currency->symbol ?><?=number_format($order_details->addons_total,2,".",",");?></span></p>
								<?endif;?>
								<?if(isset($order_details->total_discount)):?>
									<p><span class="leftSub">Discounts:</span><span class="rightSub">  <?=$currency->symbol ?><?=number_format($order_details->total_discount,2,".",",");?></span></p>
								<?endif;?>
								<?if(isset($order_details->vat_amount) && $order_details->vat_amount > 0):?>
									<p><span class="leftSub">VAT:</span><span class="rightSub">  <?=$currency->symbol ?><?=number_format($order_details->vat_amount,2,".",",");?></span></p>
								<?endif;?>
								<?if(isset($order_details->total)):?>
									<p><b><span class="leftSub">TOTAL:</span><span class="rightSub">  <?=$currency->symbol ?><?=number_format($order_details->total,2,".",",");?></span></b></p>
								<?endif;?>
							<?else:?>
								<?if($currency->symbol_position == 'before'):?>
									<p><b><small>TOTAL : </small> <?=$currency->symbol ?><?=number_format($total_price,2,".",",");?></b></p>
								<?else:?>
									<p><b><small>TOTAL: </small> <?=number_format($total_price,2,".",",");?><?=$currency->symbol ?></b></p>
								<?endif;?>
							<?endif;?>
                        </div>
                    </div>
                </div>
                <div class="invoice-note">
					* Order Status: <?=ucfirst($order->status)?><br/>
                    * Make all cheques payable to [<?=$company_name?>]<br />
					<?if($order->payment_method == 'cod'):?>
					* Payment Method : <?=strtoupper($order->payment_method)?><br/>
                    * Payment option / Due Date: <?=$payment_option?><br />
					<?else:?>
					* Payment Method : <?=ucfirst($order->payment_method)?><br/>
					<?endif;?>
					<?if(!empty($order->trans_id)):?>
					* Transaction ID: <?=$order->trans_id?><br/>
					<?endif;?>
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
