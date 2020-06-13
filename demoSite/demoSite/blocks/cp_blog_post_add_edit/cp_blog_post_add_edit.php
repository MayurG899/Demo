<?php
class Cp_blog_post_add_edit_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Account Dashboard";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Account Blog Post Add / Edit";
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

        $groups_name = $CI->users->get_user_group_name($user->id);
        $groups = array();
        $user_created_posts = '';
        $user_created_categories = '';
        $default_user_post_category = '';

        foreach ($groups_name as $key => $value)
		{
            $group = $CI->users->get_groups($value);

            if($group[0]->allow_posts)
                $user_created_posts = 1;

            if($group[0]->allow_categories)
                $user_created_categories = 1;

            $default_user_post_category .= $group[0]->default_user_post_category;

            $groups[] = $group[0];
        }

		if($user_created_posts && $type != '')
		{
			$category = new Category();
			$categores = explode(',', $default_user_post_category);
			$default_user_post_category = $category->where_in('name',$categores)->get();

			$CI->load->model('post');
			$post = new Post($id);
			$object = $post;

			if($CI->input->post() && $CI->input->post('category_id')){
				$image_name = mt_rand().'.jpg';
				$user->upload_file('image', 'files/users', $image_name);

				$_POST['groups_allowed'] = implode(',',$CI->users->get_user_group_name($user->id));
				if(isset($_FILES['image']) && $_FILES['image']['size'] > 0){
					$_POST['image'] = base_url().'files/users/'.$image_name;
				}elseif(isset($_POST['image1'])){
					$_POST['image'] = $_POST['image1'];
				}else{
					$_POST['image'] = $post->image;
				}
				
				if(isset($_FILES['img']) && !empty($_FILES['img']['tmp_name']))
				{
					$file_name = $_FILES['img']['name'];
					$file_size =$_FILES['img']['size'];
					$file_tmp = $_FILES['img']['tmp_name'];
					$file_type = $_FILES['img']['type'];   
					$file_ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
					$extensions = array("jpeg","jpg","png"); 

					if(!is_dir("files"))
						mkdir("files");
					if(in_array($file_ext,$extensions))
						move_uploaded_file($file_tmp,"files/".$file_name);
					$file_name = base_url().'files/'.$_FILES['img']['name'];
					$img = '<img class="img-responsive" src="'.$file_name.'" >';
				}
				else
					$img ='';
				
				$_POST['text'] .= $img;
				//print_r($_POST);print_r($_FILES);die;
				$post->create($_POST);
				redirect(base_url('cp/blog/posts'), 'location');
			}
			$current_page = 'blog';
			$current_child_page = 'posts';
		}
		//View
        $output ='
			<div id="userdashboard-container-blog-post-add-edit-'.$this->block->get_id().'">
			<link href="'.base_url().'modules/cp/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
			<link href="'.base_url().'modules/cp/assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
			<link href="'.base_url().'modules/cp/assets/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" />
			<link href="'.base_url().'modules/cp/assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
			<link href="'.base_url().'modules/cp/assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />
				<div id="be-uaccount-page-container" class="be-uaccount-main-pad">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="panel panel-cp-account">';
						if($user->is_logged_in()){
							$output .='
							<script src="'.base_url().'modules/cp/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
							<script src="'.base_url('builderengine/public/js/editor/ckeditor.js').'">
							</script>
							<script type="text/javascript">
								$(document).ready(function (){
									CKEDITOR.replace( "editor1",{
										toolbarGroups:[
											{ name: "clipboard",   groups: [ "clipboard", "undo" ] },
											{ name: "forms" },
											"/",
											{ name: "styles" },
											{ name: "editing",     groups: [ "find", "selection", "spellchecker" ] },
											"/",
											{ name: "basicstyles", groups: [ "basicstyles", "cleanup" ] },
											{ name: "colors" },
											{ name: "paragraph",   groups: [ "list", "indent", "blocks", "align", "bidi" ] },
											{ name: "links" },
										]
									});
								});
							</script>
							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-cp-account">
										<div class="panel-heading">
											<div class="panel-heading-btn"></div>
											<h4 class="panel-title">'.$page.' Blog Post</h4>
										</div>
										<div class="panel-body panel-form">
											<form class="form-horizontal form-bordered" data-parsley-validate="true" method="post" enctype="multipart/form-data" name="post">
												<div class="form-group">
													<label class="control-label col-md-2 col-sm-2" for="title">Blog Title:</label>
													<div class="col-md-10 col-sm-10">
														<input class="form-control form-control-be-40 form-control-uaccount-responsive" type="text" id="title" name="title" value="'.stripslashes($object->title).'" data-parsley-required="true" />
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-2 col-sm-2" for="slug">URL Slug:</label>
													<div class="col-md-10 col-sm-10">
														<input class="form-control form-control-be-40 form-control-uaccount-responsive" type="text" id="slug" name="slug" placeholder="URL Address Link" value="'.$object->slug.'" />
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-2 col-sm-2" for="blogimage">Blog Image:</label>
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
																if($page =="Add") 
																	$image = base_url('builderengine/public/img/photo_placeholder.png');
																else
																	$image = $object->image;
																$output .='
																<img id="uploadPreview1" src="'.$image.'" width="80"/> 
															</div>
															<div id="plc" class="alert" style="display: none;width:130px;margin-top:10px;margin-bottom:10px;"> 
																<!--<a class="close" onclick="$(\"#plc\").hide();$(\"#avat\").show();">×</a> -->
																<img id="uploadPreview1" src="'.base_url('builderengine/public/img/photo_placeholder.png').'" width="80"/> 
															</div>
													</div>
												</div>';
													$groups_name = $CI->users->get_user_group_name(get_active_user_id());
													$groups = array();
													$use_created_categories = '';

													foreach ($groups_name as $key => $value) {
														$group = $CI->users->get_groups($value);

														if($group[0]->use_created_categories)
															$use_created_categories = 1;

														$groups[] = $group[0];
													}
												$output .='
												<div class="form-group">
													<label class="control-label col-md-2 col-sm-2" for="categoryselection">Category Selection:</label>
													<div class="col-md-10 col-sm-10">								
														<select class="form-control form-control-be-40 form-control-uaccount-responsive" id="select-required" name="category_id" data-parsley-required="true">
															<option value="">Select Category</option>';
															if($use_created_categories){
																$categories = new Category();
																foreach($categories->where('name !=', 'Unallocated')->where('user_id',$user->get_id())->or_where('name',$default_user_post_category->name)->get() as $category){
																	$output .='<option value="'.$category->id.'"'; if($category->id == $object->category_id) $output .= 'selected';$output .='>'.stripslashes($category->name).'</option>';
																}
															}else{
																foreach($default_user_post_category as $category){
																	$output .='<option value="'.$category->id.'"'; if($category->id == $object->category_id) $output .= 'selected';$output .='>'.stripslashes($category->name).'</option>';
																}
															}
														$output .='
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-2 col-sm-2" for="fullname">Allow Comments:</label>
													<div class="col-md-10 col-sm-10">
														<label class="radio-inline">';
															if($object->comments_allowed == 'yes') 
															{  
																$check1 = 'checked';  
																$check2 = '';
																$check3 = '';
															}
															elseif($object->comments_allowed == 'no')
															{  
																$check1 = ''; 
																$check2 = 'checked';
																$check3 = '';
															}
															else{
																$check1 = ''; 
																$check2 = '';
																$check3 = 'checked';
															}
															$output .='
															<input type="radio" name="comments_allowed" value="yes" '.$check1.'/>Yes
														</label>
														<label class="radio-inline">
															<input type="radio" name="comments_allowed" value="no" '.$check2.'/>Disable,Show existing
														</label>
														<label class="radio-inline">
															<input type="radio" name="comments_allowed" value="hide" '.$check3.'/>Disable,Hide all
														</label>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-2 col-sm-2" for="website">Add Tags:</label>
													<div class="col-md-10 col-sm-10">
														<ul id="tags" class="white form-control-uaccount-responsive">';
															if($page == 'Edit'){
																$tags = explode(',', $object->tags);
																foreach($tags as $tag){
																	$output .='<li>'.stripslashes($tag).'</li>';
																}
															}
															$output .='
														</ul>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-2 col-sm-2" for="blogname">Blog Content:</label>
													<div class="be-uaccount-ck-responsive">
														<div class="panel-body panel-form">
														<textarea class="ckeditor" id="editor1" name="text" rows="20">'.ChEditorfix($object->text).'</textarea>
													</div>
													</div>
													<label class="control-label col-md-2 col-sm-2" for="blogname">Add Image:</label>
													<div class="col-md-10 col-sm-10">
														<div class="panel-body panel-form">
														<input class="form-control form-control-be-40" type="file" id="img" name="img">
													</div>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-2 col-sm-2"></label>
													<div class="col-md-10 col-sm-10">
														<span class="label label-danger" id="catName" style="color:#fff;font-weight:600;margin-bottom:10px;"></span><br/>
														<button type="submit" class="btn btn-primary" style="margin-top:5px;">'.$page.' Blog Post</button>
													</div>
												</div>
												<input type="hidden" name="user_id" id="user_id" value="'.$user->id.'">
											</form>
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
										availableTags: [ '; foreach ($groups->get() as $group){$output .='"'.$group->name.'", ';}$output .=']
									});
									$("#tags").tagit({
										fieldName: "tags",
										singleField: true,
										showAutocompleteOnFocus: true
									});
								});
							</script>
							<script>
								function convertToSlug(Text)
								{
									return Text
										.toLowerCase()
										.replace(/ /g,"-")
										.replace(/[^\w-]+/g,"")
										;
								}
								$(document).ready(function (){
									$("#title").keyup(function() {
										$("#slug").val($("#title").val());
										$("#slug").change();
									});

									$("#slug").keyup(function() {
										$("#slug").change();
									});
									$("#slug").change(function() {
										$("#slug").val(convertToSlug($("#slug").val()));
									});
								});';
								$posts = new Post();
								$output .='
								$("form").submit(function(event){
									var title = $("#title").val();';
									if($page == 'Edit'){
										$output .='var array = [ ';foreach ($posts->where('title !=',$object->title)->get() as $post){$output .='"'.$post->title.'", ';} $output .='];';
									}else{
										$output .='var array = [ ';foreach ($posts->get() as $post){$output .='"'.$post->title.'", '; }$output .='];';	
									}
									$output .='
									if(array.indexOf(title) == -1) {
										return;
									}
									$("#catName").text( "This blog title already exists! Please,choose another !" ).show().fadeOut(4000);
									event.preventDefault();
								});
							   function PreviewImage(no) {
									var oFReader = new FileReader();
									oFReader.readAsDataURL(document.getElementById("uploadImage"+no).files[0]);
									oFReader.onload = function (oFREvent) {
										document.getElementById("uploadPreview"+no).src = oFREvent.target.result;
									};
								};
							</script>
							';
						}else{
							$output .='<div class="alert alert-warning"><h2 class="text-center"><i class="fa fa-exclamation-triangle"></i> Private content</h2></div>';
						}
							$output .='
						</div>
					</div>
				</div>
			</div>
		';

		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='global_style';
		else
			$menu ='style';
		if(!$user->is_guest()){
			if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
				return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'userdashboard-container-blog-post-add-edit-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
			else
				return $output;
		}
    }
}
?>