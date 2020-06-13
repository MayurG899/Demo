<?php
class forum_topic_categories_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Forum";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Topic Categories";
        $info['block_icon'] = "fa-envelope-o public";

        return $info;
    }
    public function generate_admin()
    {
		$curr_topic_id = $this->block->data('topic');
		$available_topics = array();
		$all_topics = new Forum_topic();
		foreach($all_topics->get() as $key => $value){
			$available_topics[$value->id] = stripslashes(str_replace('_',' ',$value->name));
		}
		$this->admin_select('topic', $available_topics, 'All Topics: ', $curr_topic_id);
    }
    public function generate_style()
    {
    }
    public function generate_content()
    {
 		//Controller
		global $active_controller;
		$user = &$active_controller->user;		
        $CI = & get_instance();
        $CI->load->module('forum');
		$CI->load->model('users');
		$CI->load->model('area');
		$CI->load->model('forum_thread');
		$CI->load->model('forum_topic');
		$CI->load->model('forum_category');
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$this->load_generic_styles();
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		$curr_topic_id = $this->block->data('topic');
		if(empty($curr_topic_id))
			$curr_topic_id = 1;
		if(strpos($segments[$count-1],'.html') !== FALSE || strpos($_SERVER['REQUEST_URI_PATH'],'/layout_system/ajax/') !== FALSE){
			$topic = new Forum_topic($curr_topic_id);
			$topic_name = $topic->name;
		}else{
			$topic_name = str_replace("%20"," ",$segments[$count-1]);
		}
		$page_num = 1;
		if(isset($_GET['page']))
			$page_num = $_GET['page'];
		if(!$CI->BuilderEngine->get_option('forum_num_recent_posts_displayed'))
			$num_recent_posts = 3;
		else
			$num_recent_posts = $CI->BuilderEngine->get_option('forum_num_recent_posts_displayed');
		if(!$CI->BuilderEngine->get_option('forum_num_categories_displayed'))
			$categories_per_page = 6;
		else
			$categories_per_page = $CI->BuilderEngine->get_option('forum_num_categories_displayed');
		
		
		$topic = $CI->forum_topic->where('name',$topic_name)->get();
		$categories = $CI->forum_category->where('topic_id',$topic->id)->order_by('time_created','desc')->get_paged($page_num,$categories_per_page);
		$area = $CI->area->where('id',$topic->area_id)->get();
		$single_element = '';
		//View
        $output ='
			<div id="forum-topic-categories-container-'.$this->block->get_id().'">
				<script type="text/javascript" src="'.base_url('builderengine/public/ckeditor/ckeditor.js').'"></script>
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 be-forums-col-wide ">
				<h4 class="forums-category-title">All Threads</h4>
				</div>
				<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 forums-header-breadcrumb-padding be-forums-col-wide ">
				<!-- begin pagination -->
				<div class="text-right">
					<div class="float-right">
					<a class="btn btn-sm btn-colors forums-create-right" href="'.base_url('forum/new_thread/'.$topic->id.'').'">Create New Thread  &nbsp;&nbsp;<i class="fa fa-paper-plane"></i></a>
					</div>
					</div></ul>
				</div>
				<!-- end pagination -->
				</div>
				<!-- begin panel-forum -->';
				
				$arr =(array)$categories;
				if(!empty($arr)){
					$output .='
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 be-forums-col-wide">
					<div class="panel panel-forum noborder">
					<!-- begin forum-list -->
					<ul class="forum-list forum-topic-list forums-category-box">';
					foreach($categories as $category){
							$output .='<li>
							<!-- begin media -->
							<a href="'.base_url('forum/topic/'.$topic->name.'/category/'.$category->id.'').'"><div class="media">
								<img src="'.$category->image.'" alt="" />
							</div></a>
							<!-- end media -->
							<!-- begin info-container -->
							<div class="info-container">
								<div class="info">
									<h4 class="title">';
									$locker = ($category->locked == 'yes')?'<span style="color:red;"> [locked] </span>':'';
										$output .='<a href="'.base_url('forum/topic/'.$topic->name.'/category/'.$category->id.'').'">'.$category->name.' '.$locker.'</a>';
										if($CI->users->is_admin()){
											if($category->locked == 'no'){
												$text = 'Lock';
												$buttons ='<a href="'.base_url('forum/toggle_lock_thread/'.$category->id.'').'" class="btn btn-xs btn-danger forums-thread-lock"><i class="fa fa-lock"></i> '.$text.' </a>';
											}
											else{
												$text = 'Unlock';
												$buttons ='<a href="'.base_url('forum/toggle_lock_thread/'.$category->id.'').'" class="btn btn-xs btn-success forums-thread-lock"><i class="fa fa-unlock-alt"></i> '.$text.' </a>';					
											}
											$output .= $buttons;
										}
									$output .='</h4>
									<ul class="info-start-end">';
										$c_user = new User($category->user_id);
										$output .='<li><small><b>Post Creator:</b> '.$c_user->first_name.' '.$c_user->last_name.''.'</small></li>';

										$arr = array();
										$all_posts = new Forum_thread();
										$all_posts = $all_posts->where('category_id',$category->id)->get();
										foreach($all_posts as $posts){
										  array_push($arr,$posts->id);
										}
										$post_id = intval(end($arr));
										$poster_id = new Forum_thread($post_id);
										$poster_id = $poster_id->user_id;
										$last_poster = new User($poster_id);
										
										$output .='<li><small><b>Latest Reply From:</b> '.$last_poster->first_name.' '.$last_poster->last_name.''.'</small></li>
										<li><small><b>Views:</b> '.$category->views.'</small></li>
									</ul>
								</div>
								<a href="'.base_url('forum/topic/'.$topic->name.'/category/'.$category->id.'').'"><div class="media">
								<div class="date-replies">
									<div class="time">';
									$posted = strtotime(date('Y-m-d H:i:s',$category->time_created));
									$output .='created '.$CI->forum->calculateTime($posted).' ago
									</div>
									<div class="replies">';
									$posts = new Forum_thread();
									$posts = $posts->where('category_id',$category->id)->count();
										$output .='<div class="total">'.$posts.'</div>';
										$pos = ($posts == 1)?'POST':'POSTS';
										$output .='<div class="text">'.$pos.'</div>
									</div>
								</div></a>
							</div>
							<!-- end info-container -->
						</li>';
					}
					$output .='</ul>
					<!-- end forum-list -->
				   </div></div>';
				}
				$output .='
				<!-- end panel-forum -->
				<!-- begin pagination -->
				<div class="text-right">
					<ul class="be-pagination m-t-0"><div class="text-right pagination"><span class="forums-pagination-pages-text">Pages: </span>';
						$number_of_posts = $categories->where('topic_id',$topic->id)->count();
						if(!$CI->BuilderEngine->get_option('forum_num_categories_displayed')){
							$posts_per_page = 6;
						}
						else{
							$posts_per_page = $CI->BuilderEngine->get_option('forum_num_categories_displayed');
						}
						$total_pages = ceil($number_of_posts / $posts_per_page);

						if(!isset($_GET['page']))
							$current_page = 1;
						else
							$current_page = $_GET['page'];

						$back_page =  $current_page - 1;
						if($back_page > 0){
							$output .='<li><a href="'.base_url('forum/topic/'.$topic->name.'?page='.$back_page).'"><i class="fa fa-chevron-left"></i></a></li>';
						}
						
						for($i = 1; $i <= $total_pages; $i++){
							$output .='<li';
							if($i == $current_page){
								$output .=' class="active"';
							}
							$output .='><a href="'.base_url('forum/topic/'.$topic->name.'?page='.$i).'"'; 
							if($i == $current_page){
								$output .= ' class="active"';
							}
							$output .='>'.$i.'</a></li>';
						}

						$front_page =  $current_page + 1;
						if($front_page <= $total_pages){
							$output .='<li class="right"><a href="'.base_url('forum/topic/'.$topic->name.'?page='.$front_page).'"><i class="fa fa-chevron-right"></i></a></li>';
						}					
					$output .='</div></ul>
				</div>
				<!-- end pagination -->
			</div>		
		';
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'forum-topic-categories-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output;
    }
}
?>