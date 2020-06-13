<?php
class forum_all_topics_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Forum";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "All Topics";
        $info['block_icon'] = "fa-envelope-o public";

        return $info;
    }
    public function generate_admin()
    {
			$this->show_placeholder();
    }
    public function generate_style($active_menu = '')
    {
      
    }
    public function load_generic_styling()
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
		$areas = new Area();
		$this->load_generic_styles();
		//View
        $output ='
			<div block-editor="ckeditor" id="forum-all-topics-'.$this->block->get_id().'">
			<!-- begin content -->
			<div class="">
				<!-- begin container -->
				<div class="">
					<!-- begin panel-forum -->';
					foreach($areas->get() as $area){
						$output .='
						<div class="panel panel-forum forums-directory-box">
						<!-- begin panel-heading -->
						<div class="panel-heading">
							<h4 class="panel-title be-forum-title"><a href="'.base_url('forum/area/'.$area->name).'">'.$area->name.'</a></h4>
						</div>
						<!-- end panel-heading -->
						<!-- begin forum-list -->

						<ul class="forum-list">';
						$topics = new Forum_topic();
						foreach($topics->where('area_id',$area->id)->get() as $topic){
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

										$output .='<span class="forums-area-thread-name"> Threads: <span class="total-post">'.$num_categories.'</span></span> <span class="divider"><br></span> Posts: <span class="total-post">'.$num_posts.'</span><span class="divider"><br></span> Views: <span class="total-post">'.$views.'</span><span class="divider"></span>
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
					  </div>';
					}
					$output .='<!-- end panel-forum -->
				</div>
				<!-- end container -->
			</div>
			<!-- end content -->
		</div>
	
		';
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='global_style';
		else
			$menu ='style';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'forum-all-topics-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), $menu);
		else
			return $output;
    }
}
?>