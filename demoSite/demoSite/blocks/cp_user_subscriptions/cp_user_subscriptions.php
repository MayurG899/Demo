<?php
class Cp_user_subscriptions_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Account Dashboard";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Account Dashboard User Subscriptions";
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
		$CI->load->model('users');
		$usergroups = $CI->users->get_user_group_name($user->id);
		$u = new User($user->id);
		$objects = $u->subscribed->get();
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
								<h4 class="panel-title">Account Subscriptions</h4>
								<h3>Membership: ';
								foreach($usergroups as $group){
									if($group != 'Guests')
										$output .= ' <span class="label label-success">'.$group.'</span> ';
								}
								$output .='
								</h3>
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
											<th>Subscription Id.</th>
											<th>Module</th>
											<th>Description</th>
											<th>Type</th>
											<th>Status</th>
											<th>Time of creation</th>
											<th>Expiration time</th>
											<th>Note</th>
											<th>Actions</th>
										</tr>
										</thead>
										<tbody class="beaccount-orders-table">';
										foreach($objects as $object){
											$custom_data = json_decode($object->custom_data);
											$output .='
											<tr>
												<td>'.$object->id.'</td>
												<td>'.ucfirst(str_replace('_',' ',$object->module)).'</td>
												<td>';
													if($object->module == 'booking_memberships'){
														$order = new BuilderPaymentOrder($custom_data->order_id);
														$output .= 'Membership Subscription';
														if($order->exists()){
															$order_data = json_decode($order->custom_data);
															if($order_data->membership_groups)
															$output .= '<br/>('.$order_data->membership_groups.' <small> Usergroup</small>)';
														}
													}else
														$output .= 'N/A';
												$output .='
												</td>
												<td>'.ucfirst($object->type).'</td>
												<td>';
													$label = '';
													$icon = '';
													if($object->status == 'active'){
														$label = 'success';
														$icon = 'check';
													}
													if($object->status == 'pending'){
														$label = 'warning';
														$icon = 'pause';
													}
													if($object->status == 'expired' || $object->status == 'terminated' || $object->status == 'canceled'){
														$label = 'danger';
														$icon = 'times';
														if($object->status == 'terminated')
															$icon = 'trash';
													}
													$output .=' <span class="label label-'.$label.'"><i class="fa fa-'.$icon.'"></i> '.ucfirst($object->status).'</span>
												</td>
												<td>'.date('d-m-Y G:i:s',$object->time_created).'</td>
												<td>'.date('d-m-Y G:i:s',$object->expiry_time).'</td>
												<td>';
													if(isset($custom_data->note))
														$output .= $custom_data->note;
													else
														$output .= 'N/A';
												$output .='
												</td>
												<td style="text-align: center">';
													if($object->type == 'recurring' && (!isset($custom_data->terminated) || (isset($custom_data->terminated) && $custom_data->terminated == 'no')))
													    $output .='<a href="'.base_url('cp/cancel_subscription/'.$object->id).'" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Cancel This Subscription"><i class="fa fa-times"></i></a>';
													$output .='
													<a href="'.base_url('cp/ajax/order_invoice/'.$object->module.'/'.$custom_data->order_id).'" target="_blank" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="View Invoice"><i class="fa fa-eye"></i></a>
												</td>
											</tr>';
										}
										$output .='
										</tbody>
									</table>
								</div>';
							}else{
								$output .='<h2 class="text-center"><i class="fa fa-info-circle"></i> You Are not subscribed to any service yet </h2>';
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