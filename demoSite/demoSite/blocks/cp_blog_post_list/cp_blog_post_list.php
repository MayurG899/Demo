<?php
class Cp_blog_post_list_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Account Dashboard";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Account Blog Post List";
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
		$posts = new Post();
		$posts = $posts->where('user_id',$user->id)->get();
		$post_user_id = 0;
		foreach($posts as $post){
			if($post->user_id == $user->id)
				$post_user_id = $post->user_id;
		}
		//View
        $output ='
			<div id="userdashboard-container-blog-post-list-'.$this->block->get_id().'">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="be-uaccount-main-pad">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="panel panel-cp-account">
									<div class="panel-heading">
										<div class="panel-heading-btn"></div>
										<h4 class="panel-title">Blog Posts Created & Published</h4><br>
										<!--<div class="alert alert-info beaccount-domains-i-pad"></div>-->
									</div>
									<div class="panel-body">
									<link href="'.base_url('modules/cp/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css').'" rel="stylesheet" />
									<link href="'.base_url('modules/cp/assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css').'" rel="stylesheet" />
									<link href="'.base_url('modules/cp/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css').'" rel="stylesheet" />
									<link href="'.base_url('modules/cp/assets/plugins/DataTables/media/css/dataTablesArrowsFix.css').'" rel="stylesheet" />
									';
									if($user->is_logged_in()){
										$output .='
										<div class="table-responsive">
											<style>
												.dataTables_filter{
													float:right !important;
												}
												.dt-buttons{
													margin-top:10px;
												}
												.buttons-csv, .buttons-html5, .buttons-pdf, .buttons-print, .buttons-copy, .buttons-excel{
													
												}
											</style>
											<a href="'.base_url('cp/blog/add_post/add').'" class="btn btn-sm btn-datatable-vertical btn-success"><i class="fa fa-plus"></i> Add New Post</a>
											<table id="data-table-order" class="table table-striped table-bordered">
												<thead>
													<tr>
														<th>#</th>
														<th>Post Title</th>
														<th>Post URL slug</th>
														<th>Category</th>
														<th width="270">Groups</th>
														<th>Post Date</th>
														<th>Actions</th>
													</tr>
												</thead>
												<tbody>';
													$i = 1;
													foreach($posts as $post){
														if($post->user_id == $user->id){
															$output .='
															<tr class="odd gradeX">
																<td>'.$i.'</td>
																<td>'.stripslashes(str_replace('_',' ',$post->title)).'</td>
																<td>'.$post->slug.'</td>';
																$categories = new Category;
																foreach($categories->get() as $category){
																	if($category->id == $post->category_id){
																		$output .='<td>'.stripslashes(str_replace('_',' ',$category->name)).'</td>';
																	}
																}
																$output .='
																<td>'.$post->groups_allowed.'</td>
																<td>'.date('d.m.Y',$post->time_created).'</td>
																<td>
																	<a href="'.base_url().'blog/post/'.$post->slug.'" type="button" class="btn btn-sm btn-primary" target="_blank"><i class="fa fa-eye"></i></a>
																	<a href="'.base_url().'cp/blog/add_post/edit/'.$post->id.'" type="button" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
																	<a href="'.base_url().'cp/blog/delete_post/'.$post->id.'" type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
																</td>
															</tr>';
															$i++;
														}
													}
													$output .='
												</tbody>
											</table>
										</div>';
									}else{
										$output .='<div class="alert alert-warning"><h2 class="text-center"><i class="fa fa-exclamation-triangle"></i> Private content</h2></div>';
									}
										$output .='
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<script src="'.base_url('modules/cp/assets/plugins/jquery/jquery-1.9.1.min.js').'"></script>
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
									{ extend: "copy", className: "btn-sm", exportOptions: {columns: [ 1, 2, 3, 4, 5 ]} },
									{ extend: "csv", className: "btn-sm", exportOptions: {columns: [ 1, 2, 3, 4, 5 ]} },
									{ extend: "excel", className: "btn-sm", exportOptions: {columns: [ 1, 2, 3, 4, 5 ]} },
									{ extend: "pdf", className: "btn-sm", exportOptions: {columns: [ 1, 2, 3, 4, 5]} },
									{ extend: "print", className: "btn-sm", exportOptions: {columns: [ 1, 2, 3, 4, 5 ]} }
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
		';

		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='global_style';
		else
			$menu ='style';
		if(!$user->is_guest()){
			if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
				return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'userdashboard-container-blog-post-list-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
			else
				return $output;
		}
    }
}
?>