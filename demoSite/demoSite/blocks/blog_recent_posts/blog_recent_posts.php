<?php
    class Blog_recent_posts_block_handler extends  block_handler{
        function info()
        {
            $info['category_name'] = "Blog";
            $info['category_icon'] = "dsf";

            $info['block_name'] = "Recent Posts List";
            $info['block_icon'] = "fa-envelope-o public";
            
            return $info;
        }
        public function generate_admin()
        {
            $post_count = $this->block->data('post_count');
            
            $count = array(
                "1" => "1",
                "2" => "2",
                "3" => "3",
                "4" => "4",
                "5" => "5",
				"all" => "All",
                );
            $this->admin_select('post_count', $count, 'Post Count: ', $post_count);
        }
		public function generate_style($active_menu = '')
		{
			
		}
		public function load_generic_styling()
		{
			
		}
        public function generate_content()
        {
            global $active_controller;
            $CI = &get_instance();
            $CI->load->module('layout_system');

			$single_element = '';
			//generic animations
			$this->load_generic_styles();

            $post_count = $this->block->data('post_count');

			//$animation = $this->block->data('animation');
			//$animation_type = $this->block->data('animation_type');	  
		    //$animation_duration = $this->block->data('animation_duration');
		    //$animation_event = $this->block->data('animation_event');
		    //$animation_delay = $this->block->data('animation_delay');
			//$settings[0][0] = 'recentitems'.$this->block->get_id();
			//$settings[0][1] = $animation_event;
			//$settings[0][2] = $animation_duration.' '.$animation_delay.' '.$animation_type;
			//add_action("be_foot", generate_animation_events($settings));

            $CI = & get_instance();
            $CI->load->model('post');
            $all_posts = new Post();
			$all = $all_posts->count();
            $BuilderEngine = new BuilderEngine();
			$uc = new Category();
			$unallocated_category = $uc->where('name','Unallocated')->get();
            $recent_posts = $all_posts->where('category_id !=', $unallocated_category->id)->order_by('time_created','desc');
            $recent_post_limit = $BuilderEngine->get_option('be_blog_num_recent_posts_displayed');
            if($recent_post_limit == '' || $recent_post_limit == 0){
                $recent_post_limit = 5;
            }
            if(isset($post_count)){
				if($post_count == 'all')
					$post_count = $all;
                $recent_post_limit = $post_count;
            }
            $j=1;

            $output = '
                <div id="blog-recent-posts-container-'.$this->block->get_id().'" class="block-colors-light">
					<div class="widgetbloglist" id="blog_list">
					<div id="recentitems'.$this->block->get_id().'" class="masonry-item-blog-list">
                         <h4>Recent Blogs</h4>
                        <ul class="nav nav-list be-blog-recent">';
                        foreach ($recent_posts->get() as $recent_post){
                            if($j <= $recent_post_limit){
                                $output .= '
                                    <li>
                                        <a href="'.base_url().'blog/post/'.$recent_post->slug.'">
                                            <h5><i class="fa fa-caret-right"></i>'.stripslashes(str_replace('_',' ',$recent_post->title)).'
                                        </h5> <small><i class="fa fa-clock-o be-blog-clock"></i>'.date('d M Y &#9478; h:i',$recent_post->time_created).'</small></a>
                                    </li>';
                                $j++;
                            }
                        }
            $output .= '
                        </ul>
                   </div> </div></div>';
			if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
				$menu ='with_settings_global';
			else
				$menu ='with_settings';
			if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
				return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'blog-recent-posts-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
			else
				return $output;
        }
    }
?>