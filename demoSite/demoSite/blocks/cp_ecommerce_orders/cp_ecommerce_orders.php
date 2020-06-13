<?php
class Cp_ecommerce_orders_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Account Dashboard";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Account Dashboard Ecommerce Orders";
        $info['block_icon'] = "fa-envelope-o";

        return $info;
    }

    public function generate_admin()
    {
		$this->show_placeholder();
    }

    public function generate_content()
    {
		//Controller
		global $active_controller;
		$user = &$active_controller->user;
        $CI = & get_instance();
		$this->load_generic_styles();
		$CI->load->module('cp');

		$objects = new BuilderPaymentOrder();
		$objects = $objects->where('user_id',$user->get_id())->where('module','ecommerce')->get();
		//View

			$output ='
			<!-- Start col-10 -->
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="be-uaccount-main-pad">
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-cp-account">
							<div class="panel-heading">
								<div class="panel-heading-btn"></div>
								<h4 class="panel-title">Account Orders & Invoices</h4>
								<br>
								<!--
								<div class="alert alert-info beaccount-domains-i-pad">
								</div>-->
							</div>
							<div class="panel-body">
							<link href="'.base_url('modules/cp/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css').'" rel="stylesheet" />
							<link href="'.base_url('modules/cp/assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css').'" rel="stylesheet" />
							<link href="'.base_url('modules/cp/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css').'" rel="stylesheet" />
							<link href="'.base_url('modules/cp/assets/plugins/DataTables/media/css/dataTablesArrowsFix.css').'" rel="stylesheet" />
							';
							if($objects->exists()){
								$output.='
								<style>
									.dataTables_filter{
										float:right !important;
									}
									.dt-buttons{
										margin-top:10px;
									}
									.buttons-csv, .buttons-html5, .buttons-pdf, .buttons-print, .buttons-copy, .buttons-excel{
										background:#BDBDBD !important;
									}
								</style>
								<div class="table-responsive">
									<table id="data-table-order" class="table table-striped table-bordered table-hover">
										<thead>
										<tr>
											<th>#</th>
											<th>Order No.</th>
											<th>Description</th>
											<th>Order Total</th>
											<th>Payment Method</th>
											<th>Transaction Id</th>
											<th>Time of creation</th>
											<th>Status</th>
											<th>Invoice</th>
										</tr>
										</thead>
										<tbody class="beaccount-orders-table">';
										$i = 1;
										foreach($objects as $object){
											//if($this->user->get_id() == $object->user_id){
											$output .='
												<tr>
													<td>'.$i.'</td>
													<td>'.$object->id.'</td>';
													if($object->module == 'ecommerce')
														$info = 'Online Store';
													if($object->module == 'booking_events' || $object->module == 'booking_rooms' || $object->module == 'booking_services')
														$info = 'Booking';
													$output .='
													<td>'.$info.'</td>';
													$currency = new Currency($object->currency);
													if($currency->symbol == '$')
														$currency->symbol = '&#36;';
													$output .='
													<td>'.$currency->symbol.number_format($object->gross,2).'</td>';
													if($object->payment_method == 'cod')
														$img = base_url('modules/builderpayment/img/gateways/cod/icon.png');
													if($object->payment_method == 'stripe')
														$img = base_url('builderengine/public/img/stripe.png');
													if($object->payment_method == 'paypal')
														$img = base_url('builderengine/public/img/paypal.png');
													$output .='
													<td><img src="'.$img.'" class="img-responsive" style="width:70px" /><br/><small>'.ucfirst($object->payment_method).'</small></td>
													<td>'.$object->trans_id.'</td>
													<td>'.date('d-M-Y H:i:s',$object->time_created).'</td>';
													if($object->status == 'paid')
														$status = '<span class="label label-success"><i class="fa fa-check-circle"></i> '.ucfirst($object->status).'</span>';
													if($object->status == 'pending')
														$status = '<span class="label label-warning"><i class="fa fa-pause"></i> '.ucfirst($object->status).'</span>';
													if($object->status == 'canceled')
														$status = '<span class="label label-danger"><i class="fa fa-times"></i> '.ucfirst($object->status).'</span>';
													$output .='
													<td>'.$status.'</td>
													<td style="text-align: center">';
														if($object->module == 'ecommerce')
															$output .='<a class="btn btn-sm btn-primary" href="'.base_url('cp/ajax/order_invoice/'.$object->module.'/'.$object->id).'" target="_blank"><i class="fa fa-television"></i> View</a>';
														else
															$output .='<a class="btn btn-sm btn-primary" href="'.base_url('cp/ajax/invoices/'.$object->id.'/'.$object->module.'/'.$object->id).'" target="_blank"><i class="fa fa-television"></i> View</a>';
														$output .='
													</td>
												</tr>';
												$i++;
											//}
										}
										$output .='
										</tbody>
									</table>
								</div>';
							}else{
								$output .='<h2 class="text-center"><i class="fa fa-info-circle"></i> No Orders </h2>';
							}
							$output.='
							</div><!-- End .widget-content -->
						</div><!-- End .widget -->
					</div><!-- End .span12  -->
				</div><!-- End .row-fluid  -->
				<script src="'.base_url('modules/cp/assets/plugins/jquery/jquery-1.9.1.min.js').'"></script>';
			$output .='
			</div>

			<!-- end col-10 -->
		<script src="'.base_url("modules/cp/assets/plugins/DataTables/media/js/jquery.dataTables.js").'"></script>
		<script src="'.base_url("modules/cp/assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js").'"></script>
		<script src="'.base_url("modules/cp/assets/plugins/DataTables/extensions/Buttons/js/dataTables.buttons.min.js").'"></script>
		<script src="'.base_url("modules/cp/assets/plugins/DataTables/extensions/Buttons/js/buttons.bootstrap.min.js").'"></script>
		<script src="'.base_url("modules/cp/assets/plugins/DataTables/extensions/Buttons/js/buttons.flash.min.js").'"></script>
		<script src="'.base_url("modules/cp/assets/plugins/DataTables/extensions/Buttons/js/jszip.min.js").'"></script>
		<script src="'.base_url("modules/cp/assets/plugins/DataTables/extensions/Buttons/js/pdfmake.min.js").'"></script>
		<script src="'.base_url("modules/cp/assets/plugins/DataTables/extensions/Buttons/js/vfs_fonts.min.js").'"></script>
		<script src="'.base_url("modules/cp/assets/plugins/DataTables/extensions/Buttons/js/buttons.html5.min.js").'"></script>
		<script src="'.base_url("modules/cp/assets/plugins/DataTables/extensions/Buttons/js/buttons.print.min.js").'"></script>
		<script src="'.base_url("modules/cp/assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js").'"></script>

		<!-- ================== END PAGE LEVEL JS ================== -->
		
		<script>
			var handleDataTableButtons = function() {
				"use strict";
				
				if ($("#data-table-order").length !== 0) {
					$("#data-table-order").DataTable({
						dom: "Bfrtip",
						buttons: [
							{ extend: "copy", className: "btn-sm", exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]} },
							{ extend: "csv", className: "btn-sm", exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]} },
							{ extend: "excel", className: "btn-sm", exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]} },
							{ extend: "pdf", className: "btn-sm", exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6, 7]} },
							{ extend: "print", className: "btn-sm", exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]} }
						],
						responsive: true
					});
				}
			};

			var TableManageButtons = function () {
				"use strict";
				return {
					//main function
					init: function () {
						handleDataTableButtons();
					}
				};
			}();

			$(document).ready(function() {
				//App.init();
				TableManageButtons.init();
			});
		</script>
	</div>
			<!-- end #content -->	
		';
		if(!$user->is_guest())
			return $output;
    }
}
?>