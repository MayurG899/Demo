<?php
    class Booking_events_upcoming_category_events_block_handler extends  block_handler{
        function info()
        {
            $info['category_name'] = "Booking Events";
            $info['category_icon'] = "dsf";

            $info['block_name'] = "Event Categories";
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
            $categores = new Booking_event_category();		
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
		public function load_generic_styling()
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
			/*
            $users = new User();
            $all_posts = new Booking_event();
            $all_category = new Booking_event_category();
			$uc = new Booking_event_category();
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
			*/
		$output = '
				<div id="booking-events-container-'.$this->block->get_id().'" class="bookingevents-container">
					<div class="panel panel-default panel-with-tabs" data-sortable-id="ui-unlimited-tabs-2">
						<div class="panel-heading p-0">
							<div class="panel-heading-btn m-r-10 m-t-10">
							</div>
							<!-- begin nav-tabs -->
							<div class="tab-overflow">
								<ul class="nav nav-tabs">
									<li class="prev-button"><a href="javascript:;" data-click="prev-tab" class="text-inverse"><i class="fa fa-arrow-left"></i></a></li>				
									';
									$i=1;
									$bookingEventCategories = new Booking_event_category();
									foreach($bookingEventCategories->get() as $beCategory){
										$class = ($i == 1)?'active':'';
										$output .= '<li class="'.$class.'"><a href="#nav-tab'.$this->block->get_id().'-'.$beCategory->id.'" data-toggle="tab">'.stripslashes($beCategory->name).'</a></li>';
										$i++;
									}
									$output .= '
                                    <li class="next-button"><a href="javascript:;" data-click="next-tab" class="text-inverse"><i class="fa fa-arrow-right"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content">';
							$j=1;
							$bookingEventCategories = new Booking_event_category();
							foreach($bookingEventCategories->get() as $beCategory){
								$tabClass = ($j == 1)?'active in':'';
								//$text_without_slashes = ChEditorfix($event->description);
								$output .= '
									<div class="tab-pane fade '.$tabClass.'" id="nav-tab'.$this->block->get_id().'-'.$beCategory->id.'">
										<h4 class="bookingevents-upcoming-category-heading"><i class="fa fa-caret-right"></i> '.stripslashes($beCategory->name).'</h4>
										<div class="row">';
											$events = new Booking_event();
											foreach($events->where('active','yes')->get() as $event){
												$eventCategories = explode(',',$event->categories);
												if(in_array($beCategory->name,$eventCategories)){
													$currency = new Currency($event->currency_id);
													$text_without_slashes = ChEditorfix($event->description);
													if(strlen($event->description) > 250)
														$text = substr($text_without_slashes, 0, 250).'...';
													else
														$text = $text_without_slashes;
													$output .= '
													<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 event-tiles-padding">
														<div class="thumbnail bgwhite1 event-tiles">
															<a href="'.base_url('booking_events/event/'.$event->slug).'"><img src="'.checkImagePath($event->image).'" class="img-responsive shadow1 event-tiles-image" alt="'.stripslashes($event->name).'"></a>
															<div class="caption">
																<h3>'.$event->name.'</h3>
																<p>'.date('d M Y',strtotime($event->start_date)).'</p>
																<small style="border:1px dashed #000;padding:5px;">Book now for '.str_replace('$', '&#36;',$currency->symbol).$event->price.'</small>
																<style>p{word-break: break-all !important;}</style>
																<p>'.$text.'</p>
															</div>
															<div class="caption event-titles-view-event">
																<p class="text-center">
																	<a href="'.base_url().'booking_events/event/'.$event->slug.'" class="btn btn-sm btn-colors" role="button"><i class="fa fa-eye"></i> VIEW EVENT</a>
																</p>
															</div>
														</div>
													</div>';
												}
											}
											$output .= '
										</div>
									</div>';
								$j++;
							}
						$output .= '						
                        </div>
                    </div>
				</div>
				<script src="'.base_url('blocks/booking_events_upcoming_category_events/tabs.js').'"></script>
				<script>
					handleUnlimitedTabsRender();
				</script>
			';
			if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
				$menu ='with_settings_global';
			else
				$menu ='with_settings';
			if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
				return $output.$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'booking-events-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
			else
				return $output.$this->apply_custom_css();
        }
    }
?>