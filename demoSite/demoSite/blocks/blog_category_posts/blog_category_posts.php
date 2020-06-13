<?php
    class Blog_category_posts_block_handler extends  block_handler{
        function info()
        {
            $info['category_name'] = "Blog";
            $info['category_icon'] = "dsf";

            $info['block_name'] = "Category Posts";
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
            $this->admin_select('alphabetical_order', $option, 'Alphabetical Order (a-z): ', $alphabetical_order);
            $this->admin_select('category', $category_option, 'Category: ', $category);
        }
		public function generate_style($active_menu = '')
		{
		
		}
		public function apply_custom_css()
		{
			$style_arr = $this->block->data("style");
			if(!isset($style_arr['color']))
				$style_arr['color'] = '';
			if(!isset($style_arr['text-align']))
				$style_arr['text-align'] = '';
			if(!isset($style_arr['background-color']))
				$style_arr['background-color'] = '';

			return '
			<style>
			div[name="'.$this->block->get_name().'"] h1{
					color: '.$style_arr['color'].' !important;
			}
			div[name="'.$this->block->get_name().'"] h2{
					color: '.$style_arr['color'].' !important;
			}
			div[name="'.$this->block->get_name().'"] h3{
					color: '.$style_arr['color'].' !important;
			}
			div[name="'.$this->block->get_name().'"] h4{
					color: '.$style_arr['color'].' !important;
			}
			div[name="'.$this->block->get_name().'"] h5{
					color: '.$style_arr['color'].' !important;
			}
			div[name="'.$this->block->get_name().'"] p{
				/*    color: '.$style_arr['color'].' !important; */
			}
			div[name="'.$this->block->get_name().'"] span{
				/*    color: '.$style_arr['color'].' !important; */
					text-align: ' . $style_arr['text-align'].' !important;
				/*    background-color: ' . $style_arr['background-color'].' !important; */
			}
			div[name="'.$this->block->get_name().'"] div{
					color: '.$style_arr['color'].' !important;
					text-align: '.$style_arr['text-align'].' !important;
				/*    background-color: '.$style_arr['background-color'].' !important; */
			}
			div[name="'.$this->block->get_name().'"] ul{
					color: '.$style_arr['color'].' !important;
					text-align: '.$style_arr['text-align'].' !important;
				/*    background-color: '.$style_arr['background-color'].' !important; */
			}
			div[name="'.$this->block->get_name().'"] ol{
					color: ' . $style_arr['color'].' !important;
					text-align: ' . $style_arr['text-align'].' !important;
				 /*   background-color: ' . $style_arr['background-color'].' !important; */
			}
			div[name="'.$this->block->get_name().'"] li{
					color: '.$style_arr['color'].' !important;
					text-align: ' . $style_arr['text-align'].' !important;
				/*    background-color: ' . $style_arr['background-color'].' !important; */
			}
			div[name="'.$this->block->get_name().'"] a{
				/*    color: '.$style_arr['color'].' !important; */
			}
			.bckgrd{
				background-color: '.$style_arr['background-color'].' !important;
			}
			</style>';
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

            $post_count = $this->block->data('post_count');
            $alphabetical_order = $this->block->data('alphabetical_order');
            $category = $this->block->data('category');

			//$settings[0][0] ='category'.$this->block->get_id();
			//$settings[0][1] = $sections_animation_event;
			//$settings[0][2] = $sections_animation_duration.' '.$sections_animation_delay.' '.$sections_animation_type;
			//add_action("be_foot", generate_animation_events($settings));			

            $users = new User();
            $all_posts = new Post();
            $all_category = new Category();
			$uc = new Category();
			$unallocated_category = $uc->where('name','Unallocated')->get();	
            $BuilderEngine = new BuilderEngine();

            $recent_posts = $all_posts->where('category_id !=', $unallocated_category->id)->order_by('time_created','desc');

            if($category == 'all' || intval($category) == 0){
                $recent_posts = $recent_posts->get();
            }else{
                $recent_posts = $recent_posts->get_where(array('category_id' => intval($category)));
            }
            $recent_post_limit = $BuilderEngine->get_option('be_blog_posts_per_page');
            if($recent_post_limit == '' || $recent_post_limit == 0){
                $recent_post_limit = 1;
            }
            if(isset($post_count)){
                if($post_count == 'all')
                {
                    $recent_post_limit = count($recent_posts->all);
                }else{
                    $recent_post_limit = $post_count;
                }
            }

            if($alphabetical_order == 'az')
                ksort($sequence);
            if($alphabetical_order == 'za')
				krsort($sequence);
            if($alphabetical_order == 'oldest')
				$recent_posts = $all_posts->order_by('time_created','asc');
            if($alphabetical_order == 'latest')
				rsort($sequence);
            if($alphabetical_order == 'updated')
				$recent_posts = $all_posts->order_by('time_created','desc');
            if($alphabetical_order == 'most_visited')
				arsort($sequence);
            if($alphabetical_order == 'less_visited')
				asort($sequence);
				
            $output = '<div id="blog-category-posts-container-'.$this->block->get_id().'">
                <div class="masonry-list block-colors-light">';

            $i = 1;
            foreach ($sequence as $key => $value) {
                foreach($recent_posts as $post){
                    if($key == $post->slug){
                        if($i <= $recent_post_limit){
                            $user = $users->get_by_id($post->user_id);
                            $output .= '
							<div class="be-blog-block-containers" id="blog">
                                <li class="masonry-item-blog-category-post block-colors-light-bg">
                                    <div class="item" id="category'.$this->block->get_id().'">
                                        <div class="item-title blog-header-small">
                                            <h3><a href="'.base_url('/blog/post').'/'.$post->slug.'"> '.stripslashes(str_replace('_',' ',$post->title)).'</a></h3>';
                                                $post_comments = array();
                                                $CI = & get_instance();
                                                $CI->load->model('comment');
                                                $comments = new Comment;
                                                foreach($comments->where('post_id',$post->id)->get() as $comment)
                                                    {array_push($post_comments,$comment->id);}
                                                $num_comments = count($post_comments);
                                                $pluralizer = ($num_comments == 1) ? 'Comment' : 'Comments' ;
                                        $output .= '                                          
                                            <a href="'.base_url('cp/user/'.$user->id).'" class="label label-colors">'.$user->first_name.' '.$user->last_name.'</a>
											<a href="/blog/post/'.$post->slug.'#comments" class="label label-colors"><i class="fa fa-comment-o"></i> '.$num_comments.' '.$pluralizer.'</a>
                                            <span class="label label label-colors"><b>Date:</b> '.date('M d, Y', $post->time_created).'</span> 
										</div>

                                        <figure>
                                            <a href="/blog/post/'.$post->slug.'"><img src="'.checkImagePath($post->image).'" class="img-responsive" alt="" /></a>
                                        </figure>';
                                            $text_without_slashes = ChEditorfix($post->text);
                                            if(strlen($post->text) > 300)
                                            {
                                                $text = substr($text_without_slashes, 0, 300).'...';
                                            }
                                            else{
                                                $text = $text_without_slashes;
                                            }
                                    $output .= '<div>'.$text.'</div>
                                        <p>
										<a href="/blog/post/'.$post->slug.'" class="btn btn-colors btn-sm pull-right"><i class="fa fa-caret-right"></i> READ MORE</a>
										</p>
                                    </div>
                                
                                </li></div>';
                            $i++;
                        }
                    }
                }
            }
            $output .= '
                </div></div>';
			if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
				$menu ='with_settings_global';
			else
				$menu ='with_settings';
			if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
				return $output.$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'blog-category-posts-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
			else
				return $output.$this->apply_custom_css();
        }
    }
?>