<?php
class forum_category_thread_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Forum";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Category Thread";
        $info['block_icon'] = "fa-envelope-o public";

        return $info;
    }
    public function generate_admin()
    {
		$curr_topic_id = $this->block->data('topic');
		$available_topics = array();
		$all_topics = new Forum_topic();
		foreach($all_topics->get() as $key => $value){
			$available_topics[$value->id] = stripslashes(str_replace('_',' ',$value->title));
		}
		$this->admin_select('topic', $available_topics, 'All Topics: ', $curr_topic_id);
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
		$CI->load->model('users');
		$CI->load->model('area');
		$CI->load->model('forum_thread');
		$CI->load->model('forum_topic');
		$CI->load->model('forum_category');

		$this->load_generic_styles();
		$curr_topic_id = $this->block->data('topic');
		if(empty($curr_topic_id))
			$curr_topic_id = 1;
		if(strpos($CI->uri->uri_string(),'.html') !== FALSE || strpos($CI->uri->uri_string(),'/layout_system/ajax/') !== FALSE){
			$topic = new Forum_topic($curr_topic_id);
			$topic_name = $topic->name;
			$category_id = 1;	
		}else{
		    if(strpos($CI->uri->uri_string(),'forum/topic') !== FALSE){
		        $category_id = $CI->uri->segment(5);
		        $topic_name = str_replace("%20"," ",$CI->uri->segment(3));
		    }else{
				$topic = new Forum_topic($curr_topic_id);
				$topic_name = $topic->name;
				$category_id = 1;
		    }
		}
		$topic = $CI->forum_topic->where('name',$topic_name)->get();	
		$page_number = 1;
		if(isset($_GET['page']))
			$page_number = $_GET['page'];
			
		if(!$CI->BuilderEngine->get_option('forum_num_posts_displayed'))
			$posts_per_page = 6;
		else
			$posts_per_page = $CI->BuilderEngine->get_option('forum_num_posts_displayed');
			
		if(isset($_POST['content']))
		{
			if(!$user->is_guest())
			{
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
				$data = array(
					'title' => $_POST['title'],
					'text' => $text,
					'image' => $CI->forum->get_avatar(),
					'category_id' => $_POST['category_id'],
					'groups_allowed' => 'Guests,Members',
					'user_id' => $user->id
				);
				$CI->forum_thread->create($data);
				redirect($_SERVER['HTTP_REFERER']);
			}
			else
				redirect(base_url('/forum/login'), 'location');
		}
		if(isset($_POST['text']))
		{
			if(!$user->is_guest())
			{
				$user_id = $user->id;
				$id = $_POST['thread_id'];
				$data = array(
					'text' => stripslashes(str_replace('\r\n', '',$_POST['text'])),
					'time_created' => time(),
					'edited' => 'yes'
				);
				$CI->forum_thread->where('id',$id)->update($data);
				redirect($_SERVER['HTTP_REFERER']);
			}
			else
				redirect(base_url('forum/login'), 'location');
		}
		$threads = $CI->forum_thread->where('category_id',$category_id)->order_by('time_created','asc')->get_paged($page_number,$posts_per_page);
		$area = $CI->area->where('id',$topic->area_id)->get();
		$category = $CI->forum_category->where('id',$category_id)->get();
		$cat_id = $category_id;
		$single_element = '';
		//View
        $output ='
			<script type="text/javascript" src="'.base_url('builderengine/public/ckeditor/ckeditor.js').'"></script>	
                    <!-- begin pagination -->
					<div id="forum-topic-container-'.$this->block->get_id().'" class="">
                    <div class="text-right">
                    </div>
                    <!-- end pagination -->                    
                    <!-- begin forum-list -->
                    <ul class="forum-list forum-detail-list">';
					$i=0;
					foreach($threads as $thread){
                        $output .='<li>
                            <!-- begin media -->
                            <div class="media">';
								  $t_user = new User($thread->user_id);
								  $setting = new Setting();
								  $setting = $setting->where('user_id',$t_user->id)->get();
								if($t_user->avatar == null || $setting->allow_avatar == 0){
									$output .='<img src="'.$thread->image.'" alt="" />';
								}else{
									$output .='<img src="'.$t_user->avatar.'" alt="" />';
								}
								$output .='</span>
                            </div>
                            <!-- end media -->
                            <!-- begin info-container -->
                            <div class="info-container forums-userbutton-right" id="'.$t_user->username.'/'.$thread->time_created.'/'.$thread->id.'" >';
								$auth = ($category->user_id == $thread->user_id)?'Author':'Reply';
                                $output .='
								<!-- begin member type -->
                            <div class="forums-member-type-button float-right">';
								  $t_user = new User($thread->user_id);
								  $setting = new Setting();
								  $setting = $setting->where('user_id',$t_user->id)->get();
								$groups = $t_user->group->get();
								foreach($groups as $g){
									if($g->id == 1){
										$t_user->level = 'Administrator';
									}
								}
								switch($t_user->level)
								{
									case'Administrator':
										$label = 'danger';
										break;
									case 'Member':
										$label =  'success';
										break;
									case 'Guest':
										$label =  'info';
										break;
									default:
										$label =  'info';
								}
                                $output .='<span class="label label-'.$label.'">';
								if($t_user->level =='Administrator'){
									$output .='Admin';
								}else{
									$output .=$t_user->level;
								}
								$output .='</span>
                            </div>
                            <!-- end member type -->
								
								<div class="post-user"><a href="'.base_url('cp/user/'.$t_user->id).'"> '.ucfirst($t_user->first_name).' '.ucfirst($t_user->last_name).''.' </a> <small>'.$auth.'</small>
								';
								$posted = strtotime(date('Y-m-d H:i:s',$thread->time_created));
								$edited = ($thread->edited == 'yes')?'(edited)':'';
                                $output .='<span class="post-time"><span class="">'.$edited.'</span> '.$CI->forum->calculateTime($posted).' ago </span>
								</div>
                                <div class="post-content">
									<span id="text'.$i.'" style="display:block;">'.$thread->text.'</span>';

									if($user->id == $thread->user_id || $CI->users->is_admin()){
										$lockers = ($category->locked == 'yes')?'disabled':'';
										$output .='<a href="#" id="edit_post'.$i.'" class="btn btn-xs btn-success '.$lockers.' pull-right" style="display:block;margin-right:5px;">Edit Post</a>';
										$perm = ($CI->users->is_admin() && $user->id == $thread->user_id)?'grey':'danger';
										$l = ($category->locked == 'yes')?'disabled':'';
										$output .='<a href="'.base_url('forum/delete_post/'.$thread->id.'').'" id="delete_post'.$i.'" class="btn btn-xs btn-'.$perm.' '.$l.' pull-right" style="display:block;margin-right:5px">Delete</a>
										<div class="" style="display:none;" id="edit_div'.$i.'" >
											<form action="" name="edit" method="POST">
												<textarea id="cke1'.$i.'" type="text" name="text" > '.$thread->text.' </textarea>
												<script> CKEDITOR.replace( \'cke1'.$i.'\' ); </script>
												<input id="post'.$i.'" type="hidden" name="thread_id" value="'.$thread->id.'">
												<button href="#" id="save'.$i.'" type="submit" class="btn btn-xs btn-success" style="display:none;"><i class="fa fa-check"></i></button>
												<a href="#" id="cancel'.$i.'" class="btn btn-xs btn-success" style="display:none;"><i class="fa fa-times"></i></a>
											</form>
										</div>';
									}							
                                $output .='</div>';
								'
								<div class="row">
									<div class="col-md-12">';
										$likes = new Like();
										$likes = $likes->where('post_id',$thread->id)->get();
										$num_of_likes = $likes->count();
										$log = (!$user->is_logged_in())? base_url('forum/login'):'#';
										$output .='<p class="forums-post-like-left"><a href="'.$log.'" id="like'.$thread->id.'" class="btn btn-xs"><i class="fa fa-thumbs-up forums-post-like-size"></i></a></p>
										<p id="likes'.$i.'" class="forums-post-like-names">';
										foreach($likes as $like){
											$user_liked = new User($like->user_id);
												$output .='<span class="label label-default forums-thread-post-likes"><i class="fa fa-thumbs-up"></i> '.$user_liked->first_name.' '.$user_liked->last_name.' </span>';
										}
										$output .='</p>
									</div>
								
                            <!-- end info-container -->
							</li>';
							$i++;
							
						}
                    $output .='</div></div></ul>
                    <!-- end forum-list -->
                    
                    <!-- begin pagination -->
                    <div class="text-right">

                        <ul class="be-pagination m-t-0"><div class="text-right pagination"><span class="forums-pagination-pages-text">Pages: </span>';
							$threads_num = new Forum_thread();
							$threads_num = $threads_num->where('category_id',$category->id)->count();
							$number_of_posts = $threads_num;
							$number_of_posts = $threads_num;
							if(!$CI->BuilderEngine->get_option('forum_num_posts_displayed')){
					            $posts_per_page = 6;
					        }else{
					            $posts_per_page = $CI->BuilderEngine->get_option('forum_num_posts_displayed');
							}
					        $total_pages = ceil($number_of_posts / $posts_per_page);

					        if(!isset($_GET['page']))
					        	$current_page = 1;
					       	else
					       		$current_page = $_GET['page'];

					       	$back_page =  $current_page - 1;
					       	if($back_page > 0){
								$output .='<li><a href="'.base_url('forum/topic/'.$topic->name.'/category/'.$category->id.'?page='.$back_page).'"><i class="fa fa-chevron-left"></i></a></li>';
							}
							
					        for($i = 1; $i <= $total_pages; $i++){
					        	$output .='<li';
								if($i == $current_page){
									$output .=' class="active"';
								}
								$output .='><a href="'.base_url('forum/topic/'.$topic->name.'/category/'.$category->id.'?page='.$i).'"';
								if($i == $current_page){
									$output .=' class="active"';
								}
								$output .='>'.$i.'</a></li>';
					        }

					        $front_page =  $current_page + 1;
					       	if($front_page <= $total_pages){
								$output .='<li class="right"><a href="'.base_url('forum/topic/'.$topic->name.'/category/'.$category->id.'?page='.$front_page).'"><i class="fa fa-chevron-right"></i></a></li>';
							}				
                        $output .='</div></ul>
                    </div>
                    <!-- end pagination -->
                    
                    <!-- begin comment-section -->';
					if($user->is_logged_in() && $category->locked == 'no'){
						$output .='
					<div class="">
						<div class="panel panel-forum">
                        <div class="panel-heading">';
							$r = (!is_array($threads))?'':'Reply';
                            $output .='<h4 class="panel-title"><b>Post Reply</b></h4>
                        </div>
                        <div class="panel-body forums-text-box">
                            <form action="" name="wysihtml5" method="POST" enctype="multipart/form-data">
                                <textarea class="textarea form-control" name="content" id="cke" placeholder="Enter text ..." rows="20" ></textarea>
								<script> CKEDITOR.replace( \'cke\' ); </script>
								<input type="hidden" name="category_id" value="'.$category->id.'" >
								<input type="hidden" name="title" value="'.$category->name.'" >
								<input type="hidden" name="user_id" value="'.$user->id.'" >
								<span class="" style="font-size:14px;"><strong>Insert Image</strong></span>
								<input type="file" name="img" >';
								if($CI->users->is_admin()){
									$output .='
									<span class="" style="font-size:14px;"><strong>Add Attachment</strong></span>
									<input type="file" name="attachment" >										
									';
								}
                        $output .='<div class="text-right m-t-10">
                                    <button type="submit" id="submit'.$i.'" class="btn btn-sm btn-dark-grey">Post Comment <i class="fa fa-paper-plane"></i></button>
                                </div>
                            </form>
                        </div>
                     </div>
					 </div>';
					}else{
						if($category->locked == 'no'){
							$output .='<div class="comment-banner-msg">
								Posting to the forum is only allowed for members with active accounts. 
								Please <a href="'.base_url('forum/login').'">sign in</a> or <a href="'.base_url('forum/register').'">sign up</a> to post.
							</div>';
						}else{
								}
					}
                    $output .='</div><!-- end comment-section -->

			
	<script>';
	$i=0;
	foreach($threads as $thread){
		$output .='$("#edit_post'.$i.'").click(function () {
				$("#edit_div'.$i.'").addClass(\'animated bounceInRight\');
				$("#edit_div'.$i.'").toggle();
				$("#edit_post'.$i.'").toggle();
				$("#delete_post'.$i.'").toggle();
				$("#save'.$i.'").toggle();
				$("#cancel'.$i.'").toggle();
				$("#text'.$i.'").toggle();
			});
		$("#cancel'.$i.'").click(function () {
				$("#edit_div'.$i.'").removeClass(\'animated bounceInRight\');
				$("#edit_div'.$i.'").addClass(\'animated bounceOutRight\');
				$("#edit_div'.$i.'").toggle().fadeOut(\'slow\');
				$("#edit_post'.$i.'").toggle();
				$("#delete_post'.$i.'").toggle();
				$("#cancel'.$i.'").toggle();
				$("#save'.$i.'").toggle();
				$("#text'.$i.'").toggle();
				$("#edit_div'.$i.'").removeClass(\'animated bounceOutRight\');

			});

		$(document).ready(function() {';
			if($user->is_logged_in() && $category->locked == 'no'){
				$output .='
				$(\'#like'.$thread->id.'\').click(function(e){
					e.preventDefault();
					user_id = "'.$user->id.'";
					post_id = "'.$thread->id.'";
					likes = $(\'#likes'.$i.'\').html();
					setTimeout(function(){
						$.get( site_root + \'/forum/ajax/toggle_like/\' + user_id + \'/\' + post_id , function(data){
							if(data != \'\'){
								$(\'#likes'.$i.'\').hide().append(data).fadeIn(\'fast\');
							}
							else{
								$(\'#likes'.$i.':contains("'.$user->first_name.' '.$user->last_name.''.'")\').each(function(){
									$(this).html($(this).html().split("'.$user->first_name.' '.$user->last_name.''.'").join(""));
								});
							}						
						});
					}, 500);
				});';
			}
			$output.='
		});';
		
		$i++;
	}
	$output .='
	</script>

		';
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'forum-topic-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output;
    }
}
?>