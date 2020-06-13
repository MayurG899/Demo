<?php
class Cp_ecommerce_wishlist_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Account Dashboard";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Account Dashboard Ecommerce Wishlist";
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
		$CI->load->model('ecommerce_product');

		$wishes = $CI->ecommerce_product->get_wishlist($user->id);
		$currency = new Currency($CI->BuilderEngine->get_option('be_ecommerce_settings_currency'));

		if(isset($_GET['delete']))
		{
			$product_id = $_GET['delete'];
			$CI->ecommerce_product->delete_wishlist_item($member_id, $product_id);
			redirect('cp/ecommerce/mywishlist','location');
		}
		if(isset($_GET['add']))
		{
			$insert = array(
				'member_id' => $user->id,
				'product_id' => $_GET['add']
			);
			foreach($wishes as $item){
				if($item->id == $_GET['add'])
					redirect($_SERVER['HTTP_REFERER']);
			}
			$CI->ecommerce_product->add_to_wishlist($insert);
			redirect($_SERVER['HTTP_REFERER']);
		}
		if(isset($_GET['id']))
		{
			$product = new Ecommerce_product($_GET['id']);
			$data = array(
				"id" => $_GET['id'],
				"qty"=> 1,
				"price" => $product->price,
				"name" => $product->name,
				"image" => $product->image,
				"option" => '',
				"all_options" => '',
				"shipping" => 1
				);
			$CI->load->library('cart');
			$CI->cart->product_name_rules = '[:print:]';
			$CI->cart->insert($data);
			$CI->ecommerce_product->delete_wishlist_item($user->id, $product->id);
			redirect(base_url('ecommerce/cart'),'location');
		}
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
							if(!empty($wishes)){
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
												<th>Image</th>
												<th>Name</th>
												<th>Price</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody class="beaccount-orders-table">';
											$i = 1;
											foreach($wishes as $product){
												$output .='
												<tr class="item first">
													<td>'.$i.'</td>
													<td style="max-width:25%;"><a href="'.base_url('ecommerce/product/'.$product->id).'"><img src="'.checkImagePath($product->image).'" style="max-width:100px;" alt="'.$product->name.'"/></a></td>
													<td>'.$product->name.'</td>
													<td>';
														if($currency->symbol_position == 'before'){
															$output .= $currency->symbol.number_format($product->price,2,".",",");
														}else{
															$output .= number_format($product->price,2,".",",").$currency->symbol;
														}
													$output .='
													</td>
													<td style="text-align:center;">
														<div class="btn-group">
															<a class="btn btn-primary btn-sm" href="'.base_url('ecommerce/product/'.$product->id.'').'"><i class="fa fa-eye"></i> View</a>
															<a class="btn btn-warning btn-sm" href="'.base_url('ecommerce/wishlist?id='.$product->id).'"><i class="fa fa-shopping-cart"></i> Add to cart</a>
															<a class="btn btn-sm btn-danger" href="'.base_url('ecommerce/wishlist?delete='.$product->id).'"><i class="fa fa-trash"></i> Delete</a>
														</div>
													</td>
												</tr>';
												$i++;
											}
										$output .='
										</tbody>
									</table>
								</div>';
							}else{
								$output .='<h2 class="text-center"><i class="fa fa-info-circle"></i> No Wishlist Items </h2>';
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