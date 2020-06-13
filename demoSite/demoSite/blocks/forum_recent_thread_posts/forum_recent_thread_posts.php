<?php
class forum_recent_thread_posts_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Forum";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Recent Thread Posts";
        $info['block_icon'] = "fa-envelope-o public";

        return $info;
    }
    public function generate_admin()
    {
		$this->show_placeholder();
    }
    public function generate_style()
    {
    }
    public function generate_content()
    {
		//Controller
        $CI = & get_instance();
        $CI->load->module('forum');
		$CI->load->model('forum_thread');
		$CI->load->model('forum_topic');
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		$single_element = '';
		$top = new Forum_topic();
		if(strpos($segments[$count-1],'.html') !== FALSE || strpos($_SERVER['REQUEST_URI_PATH'],'/layout_system/ajax/') !== FALSE){
			$topic = $top->get();
		}else{
			$name = $segments[$count-1];
			$name = str_replace('%20',' ',$name);
			$topic = $top->where('name',$name)->get();
		}
		$page_num = 1;
		if(isset($_GET['page']))
			$page_num = $_GET['page'];
		if(!$CI->BuilderEngine->get_option('forum_num_recent_posts_displayed'))
			$num_recent_posts = 3;
		else
			$num_recent_posts = $CI->BuilderEngine->get_option('forum_num_recent_posts_displayed');
		
		//View
        $output ='
                    <div id="forums-recent-thread-container-'.$this->block->get_id().'">
					<!-- begin panel-forum -->
                    <div class="panel panel-forum forums-recent-box ">
                        <div class="panel-heading">
                            <h4 class="panel-title">Recent Thread Posts</h4>
                        </div>
                        <!-- begin threads-list -->
                        <ul class="threads-list">';

							$threads = new Forum_thread();
							$all_post_times = array();
							$c = new Forum_category();
							$c = $c->where('topic_id',$topic->id)->get();
							foreach($c as $category)
							{
							 $threads = $threads->where('category_id',$category->id)->order_by('time_created', 'desc')->limit($num_recent_posts)->get();
									$user = new User($threads->user_id);
									array_push($all_post_times,$threads->time_created);
							}
							$all_posts_times = rsort($all_post_times);
							$i=0;
						foreach($all_post_times as $recent_post){ 
							$thread = new Forum_thread();
							$categ = new Forum_category;
							$thread = $thread->where('time_created',$recent_post)->get();
							$user = $user->where('id',$thread->user_id)->get();
							$categ = $categ->where('id',$thread->category_id)->get();
							if($i < $num_recent_posts){
								$output .='
								<li>
									<h4 class="title"><a href="'.base_url('forum/topic/'.$topic->name.'/category/'.$categ->id.'').'">'.$categ->name.'</a></h4>';
									$recent_post = strtotime(date('Y-m-d H:i:s',$recent_post));
									$output .='last reply by <a href="#"> '.$user->first_name.' '.$user->last_name.''.' </a> '.$CI->forum->calculateTime($recent_post).' ago
								</li>';
								$i++;
							}
						}
                        $output .='</ul>
                        <!-- end threads-list -->
                    </div></div>
                    <!-- end panel-forum -->
		
		';
        if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
				$menu ='with_settings_global';
			else
				$menu ='with_settings';
			if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
				return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'forums-recent-thread-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
			else
        return $output;
    }
}
?>