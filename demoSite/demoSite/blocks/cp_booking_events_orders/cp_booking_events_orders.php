<?php
class Cp_booking_events_orders_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Account Dashboard";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Account Dashboard Events Orders";
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

		//$objects = new BuilderPaymentOrder();
		//$objects = $objects->where('user_id',$user->get_id())->where('module','booking_events')->get();
		$o = new Booking_event_order();
		$orders = $o->where('user_id',$user->id)->order_by('time_created','DESC')->get();
		$currency = new Currency($CI->BuilderEngine->get_option('be_booking_events_default_currency'));
		if($currency->symbol == '$')
			$currency->symbol = '&#36;';
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
								<h4 class="panel-title">Booking Events Orders & Invoices</h4>
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
							if($orders->exists()){
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
											<th>Id</th>
											<th>Email</th>
											<th>Tickets</th>
											<th>Total</th>
											<th>Invoice (VAT included)</th>
											<th>Status</th>
											<th>Date Created</th>
											<th>Gateway</th>
											<th>Transaction Id</th>
											<th>Actions</th>
										</tr>
										</thead>
										<tbody>';
											foreach($orders as $order){
												$event = new Booking_event($order->event_id);
												$bu = new User();
												$booking_user = $bu->where('email',$order->email)->get();
												$user_groups = $CI->users->get_user_group_name($booking_user->id);
												if(empty($user_groups))
													$user_groups = array('Non Members');
												$output .='
												<tr>
													<td>'.$order->id.'</td>
													<td><a href="mailto:'.$order->email.'?Subject=Hello%20'.ucfirst($order->username).'">'.$order->email.'</a></td>
													<td>'.$order->tickets.'</td>
													<td>';
														if($order->price == 0)
															$output .= '<span class="badge" style="background:green;">FREE</span>';
														else
															$output .= $currency->symbol.$order->price;
													$output .='
													</td>
													<td>'.$currency->symbol.$order->paid.'</td>
													<td>';
														if($order->payment_method == 'cod'){
															if((int)$order->price === 0){
																$output .= '<span class="label label-success"><i class="fa fa-check"></i> Paid</span>';
															}else{
																if($order->paid_toggle == 'yes')
																	$output .= '<span class="label label-success"><i class="fa fa-check"></i> Paid</span>';
																else
																	$output .= '<span class="onHold'.$order->id.' label label-warning"><i class="onHi'.$order->id.' fa fa-pause"></i><span class="onT'.$order->id.'"> Pending</span></span>';
															}
														}else
															$output .= '<span class="label label-success"><i class="fa fa-check"></i> Paid</span>';
													$output .='
													</td>
													<td>'.date('d/m/Y H:i:s',$order->time_created).'</td>
													<td>'.ucfirst($order->payment_method).'</td>
													<td>'.$order->trans_id.'</td>
													<td>
														<a class="btn btn-sm btn-primary" href="'.base_url('admin/ajax/invoices/'.$order->id.'/event/'.$event->id).'" target="_blank"><i class="fa fa-television"></i> View</a>
													</td>
												</tr>';
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
							{ extend: "copy", className: "btn-sm", exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]} },
							{ extend: "csv", className: "btn-sm", exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]} },
							{ extend: "excel", className: "btn-sm", exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]} },
							{ extend: "pdf", className: "btn-sm", exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8]} },
							{ extend: "print", className: "btn-sm", exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]} }
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