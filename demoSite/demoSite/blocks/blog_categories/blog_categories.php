<?php
    class Blog_categories_block_handler extends  block_handler{
        function info()
        {
            $info['category_name'] = "Blog";
            $info['category_icon'] = "dsf";

            $info['block_name'] = "Category List";
            $info['block_icon'] = "fa-envelope-o public";
            
            return $info;
        }
        public function generate_admin()
        {
            $category_count = $this->block->data('category_count');
            $alphabetical_order_category = $this->block->data('alphabetical_order_category');
            
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
				"latest" => "Latest categories",
				"oldest" => "Oldest categories",
				"updated" => "Updated categories",
				"most_visited" => "Most visited",
				"less_visited" => "Less visited"
                );
				
            $this->admin_select('category_count', $count, 'Post Count: ', $category_count);
            $this->admin_select('alphabetical_order_category', $option, 'Category Order: ', $alphabetical_order_category);
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
            $sequence = $CI->visits->popular_category_by_visits();
            $category_count = $this->block->data('category_count');
            $alphabetical_order_category = $this->block->data('alphabetical_order_category');
			$single_element = '';
			//generic animations
			$this->load_generic_styles();
			
			//$settings[0][0] ='blog_cat';
			//$settings[0][1] = $sections_animation_event;
			//$settings[0][2] = $sections_animation_duration.' '.$sections_animation_delay.' '.$sections_animation_type;
			//add_action("be_foot", generate_animation_events($settings));

            $output = '
					<div id="blog-categories-container-'.$this->block->get_id().'" class="block-colors-light">
					<div class="widgetblogcategorylist" id="blog_cat">
					<div class="masonry-item-blog-category-list">
                        <h4>Blog Categories</h4>
                        <ul class="nav nav-list">
                            <li><a style="" href="'.base_url('blog/all_posts').'"><i class="fa fa-th-large"></i>Blog Homepage</a></li>';
                            $i = 1;
							$all_categories = new Category();
                            $categories = new Category();
                            $categories = $categories->where('name !=', "Unallocated")->get();
							$all = $categories->count();
                            if($category_count != '')
                                if($category_count == 'all'){
                                    $count = $all;
                                    foreach ($categories->all as $key => $value) {
                                        if($value->parent_id == 0)
                                            $count++;
                                    }
                                }else{
                                    $count = $category_count;
                                }
                            else
                                $count = 5;
                            $category_name = array();
                            foreach ($categories->all as $key => $value) {
                                if($value->parent_id == 0)
                                    array_push($category_name,$value->name);
                            }

                            if($alphabetical_order_category == 'az')
                                asort($category_name);
                            if($alphabetical_order_category == 'za')
                                rsort($category_name);
							if($alphabetical_order_category == 'oldest'){
								$category_name = array();
								foreach ($categories->order_by('time_created','asc')->get() as $key => $value) {
									if($value->parent_id == 0)
										array_push($category_name,$value->name);
								}	
							}								
							if($alphabetical_order_category == 'latest'){
								$category_name = array();
								foreach ($categories->order_by('time_created','desc')->get() as $key => $value) {
									if($value->parent_id == 0)
										array_push($category_name,$value->name);
								}	
							}	
							if($alphabetical_order_category == 'updated'){
								$category_name = array();
								foreach ($categories->order_by('time_created','desc')->get() as $key => $value) {
									if($value->parent_id == 0)
										array_push($category_name,$value->name);
								}	
							}	
							if($alphabetical_order_category == 'most_visited')//ok
								arsort($sequence);
							if($alphabetical_order_category == 'less_visited')//ok
								asort($sequence);
	
							if($alphabetical_order_category == 'az' || $alphabetical_order_category == 'za' || $alphabetical_order_category == 'oldest' || $alphabetical_order_category == 'latest' || $alphabetical_order_category == 'updated'){
								foreach ($category_name as $key => $value) {
									foreach($categories as $parent_category){
										if($value == $parent_category->name){
											if($i <= $count)
												if($parent_category->parent_id == 0){
													if($parent_category->has_children()){
														$output .= '
															<li id="parent'.$i.'"><a style="/* color:inherit; */" href="'.base_url('blog/category/'.$parent_category->id).'"><i class="fa fa-plus-circle"></i>'.stripslashes(str_replace('_',' ',$parent_category->name)).'</a></li>
																<ul class="child'.$i.' nav nav-list" style="display: none; margin-left: 2%">
																	  <li><a style="/* color:inherit; */" href="'.base_url('blog/category/'.$parent_category->id).'"><i class="fa fa-th-large"></i> All Posts:'.stripslashes(str_replace('_',' ',$parent_category->name)).'</a></li>';
																	foreach($categories as $category){
																		if($category->parent_id == $parent_category->id){
																			$output .= '
																			<li><a style="/* color:inherit; */" href="'.base_url('blog/category/'.$category->id).'"><i class="fa fa-arrow-circle-o-right"></i>'.stripslashes(str_replace('_',' ',$category->name)).'</a></li>';
																		}
																	}
														$output .= '
															</ul>';
													}else{
														$output .= '
															<li>
																<a style="/* color:inherit; */" href="'.base_url('blog/category/'.$parent_category->id).'">
																	<i class="fa fa-arrow-circle-o-right"></i>'.stripslashes(str_replace('_',' ',$parent_category->name)).'</a>
															</li>';
													}
												}
											$i++;
										}
									}
								}
							}else{
								foreach ($sequence as $k => $v){
									foreach($categories as $parent_category){
										if($k == $parent_category->id){
											if($i <= $count)
												if($parent_category->parent_id == 0){
													if($parent_category->has_children()){
														$output .= '
															<li id="parent'.$i.'"><a style="/* color:inherit; */" href="'.base_url('blog/category/'.$parent_category->id).'"><i class="fa fa-plus-circle"></i>'.stripslashes(str_replace('_',' ',$parent_category->name)).'</a></li>
																<ul class="child'.$i.' nav nav-list" style="display: none; margin-left: 2%">
																	  <li><a href="'.base_url('blog/category/'.$parent_category->id).'"><i class="fa fa-th-large"></i> All Posts: '.stripslashes(str_replace('_',' ',$parent_category->name)).'</a></li>';
																	foreach($categories as $category){
																		if($category->parent_id == $parent_category->id){
																			$output .= '
																			<li><a style="/* color:inherit; */" href="'.base_url('blog/category/'.$category->id).'"><i class="fa fa-arrow-circle-o-right"></i>'.stripslashes(str_replace('_',' ',$category->name)).'</a></li>';
																		}
																	}
														$output .= '
															</ul>';
													}else{
														$output .= '
															<li>
																<a style="/* color:inherit; */" href="'.base_url('blog/category/'.$parent_category->id).'">
																	<i class="fa fa-arrow-circle-o-right"></i>'.stripslashes(str_replace('_',' ',$parent_category->name)).'</a>
															</li>';
													}
												}
											$i++;
										}
									}	
								}
							}
            $output .= '
                        </ul>
                    </div></div></div>
						<style>
						.visible-li
						{
						  display: block !important;
						}
						</style>';
						 $number_of_parents = $categories->where('parent_id', 0)->get()->count();
						$output .='<script>
						$(document).ready(function()
						{
						  var number = "'.$number_of_parents.'";
						  for (var i = 1; i < number; i++) 
						  {
						    $("#parent" + i).click( createCallback( i ) );
						  }
						});

						function createCallback( i ){
						  return function(event){
						    event.preventDefault();
						      if($(".child" + i).hasClass("visible-li"))
						        $(".child" + i).removeClass("visible-li");
						      else
						        $(".child" + i).addClass("visible-li");
						  }
						}
						</script>';
			if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
				$menu ='with_settings_global';
			else
				$menu ='with_settings';
			if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
				return $output.$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'blog-categories-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
			else
				return $output.$this->apply_custom_css();
        }
    }
?>