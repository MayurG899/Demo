<?php
    class Blog_posts_list_block_handler extends  block_handler{
        function info()
        {
            $info['category_name'] = "Blog";
            $info['category_icon'] = "dsf";

            $info['block_name'] = "Blog Posts List";
            $info['block_icon'] = "fa-envelope-o public";
            
            return $info;
        }
        public function generate_admin()
        {
            $post_count = $this->block->data('post_count');
            $alphabetical_order = $this->block->data('alphabetical_order');
            $category = $this->block->data('category');
            
            $count = array(
                "1" => "1",
                "2" => "2",
                "3" => "3",
                "4" => "4",
                "5" => "5",
                "all" => "All"
                );

            $option = array(
                "az" => "Alphabetical from A to Z",
                "za" => "Alphabetical from Z to A",
				"latest" => "Latest posts",
				"oldest" => "Oldest posts",
				"updated" => "Updated posts",
				"most_visited" => "Most visited",
				"less_visited" => "Less visited"
                );
            
            $category_option = array(
                "all" => "All"
                );
            $categores = new Category();	
            $all_category = $categores->where('name !=', 'Unallocated')->get();
            foreach ($all_category->all as $key => $value) {
                $category_option[$value->id] = stripslashes($value->name);
            }

            $this->admin_select('post_count', $count, 'Post Count: ', $post_count);
            $this->admin_select('alphabetical_order', $option, 'Posts order: ', $alphabetical_order);
            $this->admin_select('category', $category_option, 'Category: ', $category);
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

            $CI->load->model('visits');
            $sequence = $CI->visits->populyar_post_by_visits();

			$single_element = '';
			//generic animations
			$this->load_generic_styles();

			//$settings[0][0] ='blog_list';
			//$settings[0][1] = $sections_animation_event;
			//$settings[0][2] = $sections_animation_duration.' '.$sections_animation_delay.' '.$sections_animation_type;
			//add_action("be_foot", generate_animation_events($settings));
            $post_count = $this->block->data('post_count');
            $alphabetical_order = $this->block->data('alphabetical_order');
            $category = $this->block->data('category');

            $all_posts = new Post();
            $all_category = new Category();
			$uc = new Category();
			$unallocated_category = $uc->where('name','Unallocated')->get();
            $BuilderEngine = new BuilderEngine();

            $recent_posts = $all_posts->where('category_id !=', $unallocated_category->id)->order_by('time_created','desc');
            // out(intval($category));
            if($category == 'all' || intval($category) == 0){
                $recent_posts = $recent_posts->get();
            }else{
                $recent_posts = $recent_posts->get_where(array('category_id' => intval($category)));
            }
            $recent_post_limit = $BuilderEngine->get_option('be_blog_num_recent_posts_displayed');
            if($recent_post_limit == '' || $recent_post_limit == 0){
                $recent_post_limit = 5;
            }
            if(isset($post_count)){
                if($post_count == 'all')
                {
                    $recent_post_limit = count($recent_posts->all);
                }else{
                    $recent_post_limit = $post_count;
                }
            }

            if($alphabetical_order == 'az')//ok
                ksort($sequence);
            if($alphabetical_order == 'za')//ok
				krsort($sequence);
            if($alphabetical_order == 'oldest')
				$recent_posts = $all_posts->order_by('time_created','asc')->get();
            if($alphabetical_order == 'latest')//ok
				rsort($sequence);
            if($alphabetical_order == 'updated')
				$recent_posts = $all_posts->order_by('time_created','desc')->get();
            if($alphabetical_order == 'most_visited')//ok
				arsort($sequence);
            if($alphabetical_order == 'less_visited')//ok
				asort($sequence);

            $output = '
					<div id="blog-list-container-'.$this->block->get_id().'" class="block-colors-light">
					<div class="widgetbloglist" id="blog_list">
					<div class="masonry-item-blog-list">
                        <h4>Blog Posts</h4>
                        <ul class="nav nav-list be-blog-recent">';
                        $j=1;
						if($alphabetical_order != 'oldest'){
							foreach ($sequence as $key => $value) {
								foreach ($recent_posts as $recent_post){
									if($key == $recent_post->slug)
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
							}
						}else{
                            foreach ($recent_posts as $recent_post){
                                    if($j <= $recent_post_limit){
                                        $output .= '
                                            <li>
                                                <a href="'.base_url().'blog/post/'.$recent_post->slug.'">
                                                    <h5><i class="fa fa-caret-right"></i>'.stripslashes(str_replace('_',' ',$recent_post->title)).'
                                                </h5> <small><i class="fa fa-clock-o be-blog-clock"></i>'.date('d.M.Y / h:i',$recent_post->time_created).'</small></a>
                                            </li>';
                                        $j++;
                                    }
                            }							
						}
            $output .= '
                        </ul>
                  </div>   </div></div>';
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'blog-list-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output;
        }
    }
?>