<?php
class Cp_blog_category_add_edit_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Account Dashboard";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Account Blog Category Add / Edit";
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
		$CI->load->model('users');
		$this->load_generic_styles();

		$page = ucfirst($CI->uri->segment(4));
		$type = ucfirst($CI->uri->segment(4));
		$id = -1;
		if($type = 'Edit')
			$id = $CI->uri->segment(5);

        $groups_name = $CI->users->get_user_group_name(get_active_user_id());
        $groups = array();
        $user_created_posts = '';
        $user_created_categories = '';

        foreach ($groups_name as $key => $value) {
            $group = $CI->users->get_groups($value);

            if($group[0]->allow_posts)
                $user_created_posts = 1;

            if($group[0]->allow_categories)
                $user_created_categories = 1;

            $groups[] = $group[0];
        }

		if($user_created_categories && $type != '')
		{
			$category = new Category($id);
			$object = $category;

			if($CI->input->post()){
				$image_name = mt_rand().'.jpg';
				$user->upload_file('image', 'files/users', $image_name);

				$_POST['groups_allowed'] = implode(',',$CI->users->get_user_group_name($user->id));
				$_POST['user_id'] = $user->get_id();
				if(isset($_FILES['image']) && $_FILES['image']['size'] > 0){
					$_POST['image'] = base_url().'files/users/'.$image_name;
				}elseif(isset($_POST['image1'])){
					$_POST['image'] = $_POST['image1'];
				}else{
					$_POST['image'] = $category->image;
				}
				$category->create($_POST);
				redirect(base_url('cp/blog/categories'), 'location');
			}
		}
		//View
        $output ='
			<div id="userdashboard-container-blog-category-add-edit-'.$this->block->get_id().'">
			<link href="'.base_url().'modules/cp/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
			<link href="'.base_url().'modules/cp/assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
			<link href="'.base_url().'modules/cp/assets/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" />
			<link href="'.base_url().'modules/cp/assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
			<link href="'.base_url().'modules/cp/assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="be-uaccount-main-pad">
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-cp-account">
									<div class="panel-heading">
										<div class="panel-heading-btn"></div>
										<h4 class="panel-title">'.$page.' Blog Category</h4><br>
										<!--<div class="alert alert-info beaccount-domains-i-pad"></div>-->
									</div>
									<div class="panel-body">
										<form class="form-horizontal form-bordered" data-parsley-validate="true" method="post" enctype="multipart/form-data" name="category">
											<div class="form-group">
												<label class="control-label col-md-2 col-sm-2" for="categoryname">Category Title:</label>
												<div class="col-md-10 col-sm-10">
													<input class="form-control form-control-be-40 form-control-uaccount-responsive" type="text" id="categoryname" name="name" value="'.stripslashes($object->name).'" data-parsley-required="true" />
													<span id="catName" style="color:red;font-weight:600;"></span>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-2 col-sm-2" for="blogimage">Post Image:</label>
												<div class="col-md-10 col-sm-10">
													<span class="btn btn-success fileinput-button" style="height:34px;">
														<i class="fa fa-plus"></i>
														<span>'.$page.' Image</span>
															<input type="file" name="image" id="uploadImage1" onchange="PreviewImage(1);$("#avat").show();$("#plc").remove();"><br/>
														</span>
														<br/>
														<div id="avat" class="be-uaccount-blog-img"> 
														<script>var input = "<input type=\"hidden\" name=\"image1\" value=\"'.base_url('builderengine/public/img/photo_placeholder.png').'\">";</script>
															<a class="close" onclick="$(\"#avat\").hide();$(\"#plc\").append(input).show();(\"#uploadImage1\").remove();">×</a>';
															if($page =='Add') 
																$image = base_url('builderengine/public/img/photo_placeholder.png');
															else{
																if($object->image != '')
																	$image = $object->image;
																else
																	$image = base_url('builderengine/public/img/photo_placeholder.png');
															}
															$output .='
															<img id="uploadPreview1" src="'.$image.'" width="80"/>
														</div>
														<div id="plc" class="alert" style="display: none;width:130px;margin-top:10px;margin-bottom:10px;"> 
															<!--<a class="close" onclick="$(\"#plc\").hide();$(\"#avat\").show();">×</a> -->
															<img id="uploadPreview1" src="'.base_url('builderengine/public/img/photo_placeholder.png').'" width="80"/>
														</div>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-2 col-sm-2" for="categoryselection">Parent Category:</label>
												<div class="col-md-10 col-sm-10">								
													<select class="form-control form-control-be-40 form-control-uaccount-responsive" id="parent_id" name="parent_id" data-parsley-required="true">
														<option value="0">No Parent</option>';				
															$categories = new Category();
															if($page == 'Add'){
																foreach ($categories->get() as $parent_category){
																	if($parent_category->name != 'Unallocated'){
																		$output .='<option value="'.$parent_category->id.'">'.stripslashes($parent_category->name).'</option>';
																	}
																}
															}else{
																foreach ($categories->get() as $parent_category){
																	if($parent_category->id != $object->id && $parent_category->name != 'Unallocated'){
																		$output .='<option value="'.$parent_category->id.'"'; if($object->parent_id == $parent_category->id) $output .= 'selected';$output .='>'.stripslashes($parent_category->name).'</option>';
																	}
																}
															}
														$output .='
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-2 col-sm-2"></label>
												<div class="col-md-6 col-sm-6">
													<button type="submit" class="btn btn-md btn-primary">'.$page.' Blog Category</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>';
				$groups = new Group;
				$output .='
				<script src="'.base_url().'modules/cp/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
				<script src="'.base_url().'modules/cp/assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>
				<script>
					$(document).ready(function (){
						$("#access-groups").tagit({
							fieldName: "groups_allowed",
							singleField: true,
							showAutocompleteOnFocus: true,
							availableTags: [ ';foreach ($groups->get() as $group){$output .='"'.$group->name.'",'; }$output .=']
						});
					});
				   function PreviewImage(no) {
						var oFReader = new FileReader();
						oFReader.readAsDataURL(document.getElementById("uploadImage"+no).files[0]);
						oFReader.onload = function (oFREvent) {
							document.getElementById("uploadPreview"+no).src = oFREvent.target.result;
						};
					};
					$("form").submit(function(event){
						if ($("#categoryname").val() != "Unallocated") {
							return;
						}
						$("#catName").text( "This category name is reserved.Please,choose another !" ).show().fadeOut(3000);
						event.preventDefault();
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
				return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'userdashboard-container-blog-category-add-edit-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
			else
				return $output;
		}
    }
}
?>