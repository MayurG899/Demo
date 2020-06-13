<?php
class Booking_events_list_block_handler extends  block_handler{
	function info()
	{
		$info['category_name'] = "Booking Events";
		$info['category_icon'] = "dsf";

		$info['block_name'] = "Events List";
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
		$this->load_generic_styles();
		$single_element = '';
		//generic animations
		//$this->load_generic_styling();
		$events = new Booking_event();
		$events = $events->order_by('start_date','ASC')->get();


		$output = '
			<link href="'.base_url('builderengine/public/fullcalendar-3.5.1/fullcalendar.min.css').'" rel="stylesheet" />
			<div id="booking-events-calendar-container-'.$this->block->get_id().'" class="bookingevents-container">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="nav-pills-tab-1">
						<div class="row">
							<div class="col-md-12 booking-events-list-box">';
								foreach($events as $event){
									$event_categories = explode(',',$event->categories);
									$category = new Booking_event_category();
									$category = $category->where('name',$event_categories[0])->get();
									if($event->active == 'yes' && $event->end_date >= date('Y-m-d',time())){
										$output .='
										<div class="panel-group" id="accordion">
											<div class="panel panel-inverse overflow-hidden">
												<div class="panel-heading">
													<h3 class="panel-title">
														<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$event->id.'">
															<i class="fa fa-plus-circle pull-right"></i> 
															'.$event->name.' ('.date('d M Y',strtotime($event->start_date)).')
															<span class="label label-';if($event->capacity < 1)$output .= 'danger'; else $output .= 'success'; $output .=' pull-right" style="margin-right:20px;">';
																if($event->capacity < 1)
																	$output .='Booked Out';
																else $output .= 'HIDE DETAILS';
															$output .='
															</span>
														</a>
														&nbsp;&nbsp;&nbsp;&nbsp;<span class="label '.$category->color.'" style=""><strong>'.ucfirst(stripslashes($category->name)).'</strong></span>
													</h3>
												</div>
												<div id="collapse'.$event->id.'" class="">
													<div class="panel-body">
														<div class="result-container">
															<ul class="result-list">
																<li style="list-style:none">
																	<div class="result-image bookingevents-25">
																		<a href="'.base_url('booking_events/event/'.$event->slug).'"><img src="'.checkImagePath($event->image).'" alt="" /></a>
																	</div>
																	<div class="result-info bookingevents-50">
																		<h4 class="title"><a href="'.base_url('booking_events/event/'.$event->slug).'">'.$event->name.'</a></h4>
																		<p class="location">'.$event->location.'</p>
																		<p class="desc">';
																			$text_without_slashes = strip_tags(ChEditorfix($event->description));
																			if(strlen($event->description) > 100)
																				$text = substr($text_without_slashes, 0, 100).'...';
																			else
																				$text = $text_without_slashes;
																			$output .= $text;
																		$output .='
																		</p>
																		<div class="btn-row">
																		<!--
																			<a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Analytics"><i class="fa fa-fw fa-bar-chart-o"></i></a>
																			<a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Tasks"><i class="fa fa-fw fa-tasks"></i></a>
																			<a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Configuration"><i class="fa fa-fw fa-cog"></i></a>
																			<a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Performance"><i class="fa fa-fw fa-tachometer"></i></a>
																			<a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Users"><i class="fa fa-fw fa-user"></i></a>
																			-->
																		</div>
																	</div>
																	<div class="result-price bookingevents-25">';
																		$currency = new Currency($event->currency_id);
																		if($event->price > 0){
																			$price = $event->price;
																			$currency = str_replace('$', '&#36;',$currency->symbol);
																			$info = 'PER PERSON';
																		}
																		else{
																			$price = 'FREE';
																			$currency = '';
																			$info = '';
																		}
																		$output .= $currency.$price.'<small> '.$info.'</small>
																		<a href="'.base_url('booking_events/event/'.$event->slug).'" class="btn btn-colors btn-block"><i class="fa fa-eye"></i> VIEW EVENT</a>
																	</div>
																</li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>';
									}
								}
							$output .='
							</div>
						</div>
					</div>
				</div>
			</div>
		';
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'booking-events-calendar-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output.$this->apply_custom_css();
	}
}
?>