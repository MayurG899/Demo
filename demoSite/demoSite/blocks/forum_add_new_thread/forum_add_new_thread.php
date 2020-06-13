<?php
class forum_add_new_thread_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Forum";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Add New Thread";
        $info['block_icon'] = "fa-envelope-o";

        return $info;
    }
    public function generate_admin()
    {
    }
    public function generate_style()
    {
    }
    public function generate_content()
    {
 		//Controller
		//require_once('assets_loader.php');
		global $active_controller;
		$user = &$active_controller->user;		
        $CI = & get_instance();
        $CI->load->module('forum');
		$CI->load->model('forum_thread');
		$CI->load->model('forum_topic');
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		
		if($segments[$count-1] == 'error'){
			$topic_id = $segments[$count-2];
			$title_err = 'You cannot create new thread with no title !';
		}
		else{
			$topic_id = $segments[$count-1];
			$title_err = '';
		}
		/*
		if(!$user->is_guest())
		{
			if($_POST)
			{
				if(!empty($_POST['title']))
				{
					$topic = $CI->forum_topic->get_by_id($topic_id);

					$thread = array(
						'name' => $_POST['title'],
						'description' => stripslashes(str_replace('\r\n', '',$_POST['title'])),
						'image' => $CI->forum->get_thread_image(),
						'topic_id' => $topic_id,
						'groups_allowed' => 'Administrators,Guests,Members',
						'user_id' => $user->id,
					);
					$CI->forum_category->create($thread);
					$category = $CI->forum_category->where('name',$_POST['title'])->where('description',$_POST['title'])->where('user_id',$user->id)->get();
						
						if(isset($_FILES['img']) && !empty($_FILES['img']['tmp_name']))
						{
							$file_name = $_FILES['img']['name'];
							$file_size =$_FILES['img']['size'];
							$file_tmp = $_FILES['img']['tmp_name'];
							$file_type = $_FILES['img']['type'];   
							$file_ext = strtolower(end(explode('.',$_FILES['img']['name'])));
							$extensions = array("jpeg","jpg","png");

							if(in_array($file_ext,$extensions )=== false)
								$errors[] ="This extension is not allowed, please choose a JPEG,JPG or PNG file.";
							if($file_size > 1000000)
								$errors[] ='File size must be less than 1 MB';	
							if(empty($errors)==true)
								move_uploaded_file($file_tmp,"files/".$file_name);
							$file_name = base_url().'files/'.$_FILES['img']['name'];
							$img = '<img width="100" height="100" src="'.$file_name.'" >';
						}
						else
							$img ='';
							
						$text = stripslashes(str_replace('\r\n', '',$_POST['content']));
						$text .= $img;
						
					$post = array(
						'title' => $_POST['title'],
						'text' => $text,
						'image' => $CI->forum->get_avatar(),
						'category_id' => $category->id,
						'groups_allowed' => 'Administrators,Guests,Members',
						'user_id' => $user->id,
					);				
					$CI->forum_thread->create($post);
					
					redirect(base_url('forum/topic/'.$topic->name.'/category/'.$category->id.''),'location');
				}
				else
					$title_err = 'You cannot create new thread with no title !';
		    }
			$topic_id = $topic_id;
		}
		else
			redirect(base_url('forum/login/info'), 'location');
		*/
		//View
        $output ='
			<!-- ================== END BASE CSS STYLE ================== -->
			<script type="text/javascript" src="'.base_url('builderengine/public/ckeditor/ckeditor.js').'"></script>
				<!-- begin container -->
				<div class="">
					<!-- begin panel-forum -->
					<div class="panel panel-forum">
						<!-- begin panel-heading -->
						<div class="panel-heading">';
						$title_err = (!empty($title_err))?'<span style="color:red;"><strong>'.$title_err.'</strong></span>':'';
							$output .='<h4 class="panel-title"><a href="#">Create New Thread:</a></h4> '.$title_err.'
						</div>
						<!-- end panel-heading -->
						<div class="panel-body forums-text-box">
							<form action="" name="wysihtml5" method="POST" enctype="multipart/form-data">
								<input class="form-control" type="text" name="title" value="" placeholder="Thread Title" style="margin-bottom:15px;">
								<textarea class="textarea form-control" name="content" id="cke" placeholder="Post text" rows="20"></textarea>
								<script> CKEDITOR.replace( \'cke\' ); </script>';
								if($CI->BuilderEngine->get_option('forum_thread_image') == 'custom'){
									$output .='<label class="control-label" for="photo" style="margin-top:15px;">Post Image:</label>
									<input class="form-control" type="file" name="photo" placeholder="Thread Thumbnail" style="margin-top:15px;margin-bottom:15px;">';
								}
								$output .='<span class="" style="font-size:14px;"><strong>Insert Image</strong></span>
								<input type="file" name="img" >';
								if($CI->users->is_admin()){
									$output .='
									<span class="" style="font-size:14px;"><strong>Add Attachment</strong></span>
									<input type="file" name="attachment" >										
									';
								}								
						$output .='<input type="hidden" name="user_id" value="'.$user->id.'" >
								<div class="text-right m-t-10">
									<button type="submit" class="btn btn-sm btn-dark-grey">Create Thread <i class="fa fa-paper-plane"></i></button>
								</div>
							</form>
						</div>
					</div>
				</div>
	
		';
        return $output;
    }
}
?>