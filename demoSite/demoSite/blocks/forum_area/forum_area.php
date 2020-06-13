<?php
class forum_area_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Forum";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Area";
        $info['block_icon'] = "fa-envelope-o public";

        return $info;
    }
    public function generate_admin()
    {
		$curr_area_id = $this->block->data('area');
		$available_areas = array();
		$all_areas = new Area();
		foreach($all_areas->get() as $key => $value){
			$available_areas[$value->id] = stripslashes(str_replace('_',' ',$value->title));
		}
		$this->admin_select('area', $available_areas, 'All Areas: ', $curr_area_id);
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
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$this->load_generic_styles();
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		$curr_area_id = $this->block->data('area');
		if(empty($curr_area_id))
			$curr_area_id = 1;
		if(strpos($segments[$count-1],'.html') !== FALSE || strpos($_SERVER['REQUEST_URI_PATH'],'/layout_system/ajax/') !== FALSE){
			$a = new Area($curr_area_id);
			$area_name = $a->name;
		}else{
			$area_name = $segments[$count-1];
		}

		$area_name = str_replace("%20"," ",$area_name);
		$area = new Area();
		$area = $area->where('name',$area_name)->order_by('time_created','desc')->get();
		$single_element = '';
		//View
        $output ='
			<div id="area-container-'.$this->block->get_id().'">
			<div class="content">
				<!-- begin container -->
				<div class="">
					<!-- begin panel-forum -->
					<div class="panel panel-forum forums-directory-box">
						<!-- begin panel-heading -->
						<div class="panel-heading">
							<h4 class="panel-title"><a href="'.base_url('forum/area/'.$area->name).'">'.$area->name.'</a></h4>
						</div>
						<!-- end panel-heading -->
						<!-- begin forum-list -->

						<ul class="forum-list">';
						$topics = new Forum_topic();
						foreach($topics->where('area_id',$area->id)->order_by('time_created','desc')->get() as $topic){
							$output .='<li>
								<!-- begin media -->
								<div class="media">
									<img src="'.$topic->image.'" alt="" />
								</div>
								<!-- end media -->
								<!-- begin info-container -->
								<div class="info-container">
									<div class="info">
										<h4 class="title"><a href="'.base_url('forum/topic/'.$topic->name.'').'">'.$topic->name.'</a></h4>
										<p class="desc">
										   '.str_replace('\r\n','',$topic->description).'
										</p>
									</div>
									<div class="total-count">';
										  $categories = new Forum_category();
										  $threads = new Forum_thread();
										  $num_categories = $categories->where('topic_id',$topic->id)->count();
										  $topic_cats = $categories->where('topic_id',$topic->id)->get();
										  $num_posts = 0;
										  $topic_posts=array();
										  $views = 0;
										  foreach($topic_cats as $cat)
										  {
											$views += $cat->views;
											$posts= $threads->where('category_id',$cat->id)->count();
											$cat_posts = $threads->where('category_id',$cat->id)->get();
											foreach($cat_posts as $cat_post)
											{
												array_push($topic_posts,$cat_post->time_created);
											}
											$num_posts = $num_posts + $posts;
										  }
										  sort($topic_posts);
										  $recent_time_created = end($topic_posts);
										  $recent_thread = $threads->where('time_created',$recent_time_created)->get();
										  $recent_user = $user->where('id',$recent_thread->user_id)->get();
										  $c = new Forum_category();
										  $recent_category = $c->where('id',$recent_thread->category_id)->get();

										$output .='
											Threads: <span class="total-post">'.$num_categories.'</span> <span class="divider"><br></span>&nbsp;&nbsp; 
											Posts: <span class="total-post">'.$num_posts.'</span><span class="divider"><br></span> 
											Views: <span class="total-post">'.$views.'</span>
									</div>
									<div class="latest-post">
										<h4 class="title"><a href="'.base_url('forum/topic/'.$topic->name.'/category/'.$recent_category->id.'').'">'.$recent_category->name.'</a></h4>';
										if(!empty($recent_time_created)){
											$output .='<p class="time">last post '.$CI->forum->calculateTime($recent_time_created).' ago by<a href="#" class="user"> '.$recent_user->first_name.' ' .$recent_user->last_name.''.'</a></p>';
										}
									$output .='</div>
								</div>
								<!-- end info-container -->
							</li>';
						}
						$output .='</ul>
						<!-- end forum-list -->
					</div>

					<!-- end panel-forum -->
				</div>
				<!-- end container -->
			</div>
			<!-- end content -->	
		</div>	
		';
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'area-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output;
    }
}
?>