<?php
class Cp_booking_events_list_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Account Dashboard";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Account Dashboard Booking Events List";
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

		$events = new Booking_event();
		$events = $events->where('user_id',$user->id)->get();
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
							if($events->exists()){
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
									<a href="'.base_url('cp/booking/events/add').'" class="btn btn-sm btn-success" style="margin-bottom:15px;"><i class="fa fa-plus"></i> Add New Event</a>
									<table id="data-table-order" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>#</th>
												<th>Image</th>
												<th>Name</th>
												<th>Categories</th>
												<th>Price</th>
												<th>Start Date</th>
												<th>End Date</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>';
											$i = 1;
											foreach($events as $event){
												$output .='
												<tr class="odd gradeX">
													<td>'.$i.'</td>
													<td><img src="'.$event->image.'" class="img-responsive" style="width:80px;" /></td>
													<td>'.stripslashes($event->name).'</td>
													<td>'.stripslashes($event->categories).'</td>
													<td>'.$event->price.'</td>
													<td>'.date('m/d/Y',strtotime($event->start_date)).'</td>
													<td>'.date('m/d/Y',strtotime($event->end_date)).'</td>
													<td>
														<a href="'.base_url().'booking_events/event/'.$event->slug.'" type="button" class="btn btn-sm btn-primary" target="_blank"><i class="fa fa-eye"></i></a>
														<a href="'.base_url().'cp/booking/events/edit/'.$event->id.'" type="button" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
														<a href="'.base_url().'cp/booking/events/delete_event/'.$event->id.'" type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
													</td>
												</tr>';
												$i++;
											}
											$output .='
										</tbody>
									</table>
								</div>';
							}else{
								$output .='<h2 class="text-center"><i class="fa fa-info-circle"></i> No Events Created </h2>';
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
							{ extend: "copy", className: "btn-sm", exportOptions: {columns: [ 0, 2, 3, 4, 5, 6 ]} },
							{ extend: "csv", className: "btn-sm", exportOptions: {columns: [ 0, 2, 3, 4, 5, 6 ]} },
							{ extend: "excel", className: "btn-sm", exportOptions: {columns: [ 0, 2, 3, 4, 5, 6 ]} },
							{ extend: "pdf", className: "btn-sm", exportOptions: {columns: [ 0, 2, 3, 4, 5, 6]} },
							{ extend: "print", className: "btn-sm", exportOptions: {columns: [ 0, 2, 3, 4, 5, 6 ]} }
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