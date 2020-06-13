<?php
    class Blog_tags_block_handler extends  block_handler{
        function info()
        {
            $info['category_name'] = "Blog";
            $info['category_icon'] = "dsf";

            $info['block_name'] = "Blog Tags";
            $info['block_icon'] = "fa-envelope-o public";
            
            return $info;
        }
        public function generate_admin()
        {
            $tags_count = $this->block->data('tags_count');
            $alphabetical_order_tags = $this->block->data('alphabetical_order_tags');
            
            $count = array(
                "1" => "1",
                "2" => "2",
                "3" => "3",
                "4" => "4",
                "5" => "5",
                "all" => "All"
                );

            $option = array(
                "yes" => "Yes",
                "no" => "No"
                );
            $this->admin_select('tags_count', $count, 'Tag Count: ', $tags_count);
            $this->admin_select('alphabetical_order_tags', $option, 'Alphabetical Order (a-z): ', $alphabetical_order_tags);
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

			//generic animations
			$this->load_generic_styles();
			$single_element = '';
            $tags_count = $this->block->data('tags_count');
            $alphabetical_order_tags = $this->block->data('alphabetical_order_tags');

			//$settings[0][0] = 'tags-container-'.$this->block->get_id();
			//$settings[0][1] = $animation_event;
			//$settings[0][2] = $animation_duration.' '.$animation_delay.' '.$animation_type;
			//add_action("be_foot", generate_animation_events($settings));

            $output = '
				<div class="widgetblogtags" id="blog">
				<div id="tags'.$this->block->get_id().'" class="masonry-item-blog-tags">
                    <h4>Blog Tags</h4>';
                    $BuilderEngine = new BuilderEngine();
					$uc = new Category();
					$unallocated_category = $uc->where('name','Unallocated')->get();
                    $CI = & get_instance();
                    $CI->load->model('post');
                    $posts = new Post();

                    $posts = $posts->where('category_id !=', $unallocated_category->id)->order_by('time_created', 'desc')->get();
                    $available_tags = array();
                    $set_limit = $BuilderEngine->get_option('be_blog_num_tags_displayed');
                    if($set_limit == '' || $set_limit == 0)
                        $set_limit = 12;
                    foreach($posts as $post)
                    {
                        $tags = explode(',',$post->tags);    
                        foreach($tags as $tag)
                        {
                            array_push($available_tags,$tag);
                        }
                    }
                    if(isset($tags_count)){
                        if($tags_count == 'all')
                        {
                            $set_limit = count($available_tags);
                        }else{
                            $set_limit = $tags_count;
                        }
                    }
                    $available_tags = array_unique($available_tags);
                    $available_tags = array_slice($available_tags,0,$set_limit);

                    if($alphabetical_order_tags == 'yes')
                        asort($available_tags);

                    foreach($available_tags as $tag){
                        $output .= '
                            <a class="label label-colors label-md tagsblock" href="'.base_url('blog/search/'.stripslashes($tag)).'"><i class="fa fa-tags"></i> '.stripslashes(str_replace('_',' ',$tag)).'</a>';
                    }
            $output .= '
                        <div class="clearfix"></div>
                   </div> </div>';
			if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
				$menu ='with_settings_global';
			else
				$menu ='with_settings';
			if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
				return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'blog-tags-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
			else
				return $output;
        }
    }
?>