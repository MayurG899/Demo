<?php
class Booking_events_calendar_block_handler extends  block_handler{
	function info()
	{
		$info['category_name'] = "Booking Events";
		$info['category_icon'] = "dsf";

		$info['block_name'] = "Events Calendar";
		$info['block_icon'] = "fa-envelope-o public";
		
		return $info;
	}
	public function generate_admin()
	{
		$default_view = $this->block->data('default_view');
		
		$views = array(
			"list" => "List",
			"tiles" => "Tiles",
			"calendar" => "Calendar"
		);

		$this->admin_select('default_view', $views, 'Default View: ', $default_view);
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
		$default_view = $this->block->data('default_view');
		if($default_view == 'list')
			$_GET['currentview'] = 'list';
		elseif($default_view == 'tiles')
			$_GET['currentview'] = 'tiles';
		elseif($default_view == 'calendar')
			$_GET['currentview'] = 'calendar';
		else
			$_GET['currentview'] = 'calendar';

		$output = '
			<link href="'.base_url('builderengine/public/fullcalendar-3.5.1/fullcalendar.min.css').'" rel="stylesheet" />
			<div id="booking-events-calendar-container-'.$this->block->get_id().'" class="bookingevents-container bookingevents-bg-space">
				<ul class="nav nav-pills event-pills bookingevents-bg-calendar">
					<li class="';if(isset($_GET['currentview']) && $_GET['currentview'] == 'list') $output .= 'active';$output .='"><a href="#nav-pills-tab-1" data-toggle="tab"><i class="fa fa-list"></i> EVENTS LIST</a></li>
					<li class="';if(isset($_GET['currentview']) && $_GET['currentview'] == 'tiles') $output .= 'active';$output .='"><a href="#nav-pills-tab-2" data-toggle="tab"><i class="fa fa-th"></i> EVENTS TILES</a></li>
					<li id="calendarView" class="';if((isset($_GET['currentview']) && $_GET['currentview'] == 'calendar') )$output .= 'active';$output .='"><a href="#nav-pills-tab-3" data-toggle="tab"><i class="fa fa-calendar"></i> CALENDAR</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade ';if(isset($_GET['currentview']) && $_GET['currentview'] == 'list') $output .= 'active in';$output .='" id="nav-pills-tab-1">
						<div class="col-lg-12 bookingevents-list-bg-2">
							<div class="col-md-12" style="padding:30px 15px;">';
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
																		<h4 class="title"><a href="'.base_url('booking_events/event/'.$event->slug).'">'.stripslashes($event->name).'</a></h4>
																		<p class="location">'.$event->location.'</p>
																		<p class="desc">';
																			$text_without_slashes = strip_tags(ChEditorfix($event->description));
																			if(strlen($event->description) > 250)
																				$text = substr($text_without_slashes, 0, 250).'...';
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
					<div class="tab-pane fade bookingevents-bg-calendar ';if(!isset($_GET['currentview']) || (isset($_GET['currentview']) && $_GET['currentview'] == 'tiles')) $output .= 'active in';$output .='" id="nav-pills-tab-2">
						<div class="col-lg-12 bookingevents-list-bg-1">
							<div class="row">
								<div class="">';
									foreach($events as $event){
										$currency = new Currency($event->currency_id);
										$event_categories = explode(',',$event->categories);
										$category = new Booking_event_category();
										$category = $category->where('name',$event_categories[0])->get();
										if($event->active == 'yes' && $event->end_date >= date('Y-m-d',time())){
											$output .='
											<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 event-tiles-padding">
												<div class="thumbnail bgwhite1 event-tiles">
													<a href="'.base_url('booking_events/event/'.$event->slug).'"><img src="'.checkImagePath($event->image).'" class="img-responsive shadow1 event-tiles-image" alt="'.$event->name.'"></a>';
													if($event->price > 0){
														$price = $event->price;
														$currency = str_replace('$', '&#36;',$currency->symbol);
													}
													else{
														$price = 'FREE';
														$currency = '';
													}
													$output .='
													<div class="caption">
														<h3>'.$event->name.'</h3>
														<p>'.date('d M Y',strtotime($event->start_date)).'</p>
														<span class="label '.$category->color.'" style=""><strong>'.ucfirst(stripslashes($category->name)).'</strong></span>
														<p><small>Book Now for '.$currency.$price.'</small></p>
														<div class="event-short-text">';
														$text_without_slashes = strip_tags(ChEditorfix($event->description));
														if(strlen($event->description) > 250)
															$text = substr($text_without_slashes, 0, 250).'...';
														else
															$text = $text_without_slashes;
														$output .='
														<p>'.$text.'</p>
														</div>
													</div>
													<div class="caption event-titles-view-event">
														<p class="text-center">
															<a href="'.base_url('booking_events/event/'.$event->slug).'" class="btn btn-sm btn-colors" role="button"><i class="fa fa-eye"></i> VIEW EVENT</a>
														</p>
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
					<div class="tab-pane fade bookingevents-bg-calendar '; if((isset($_GET['currentview']) && $_GET['currentview'] == 'calendar') )$output .= 'active in';$output .='" id="nav-pills-tab-3">
						<div class="row">
							<div class="col-md-12 col-sm-12" style="padding:30px;">
								<div id="calendar'.$this->block->get_id().'" class="vertical-box-column p-15 calendar bookingevents-style"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<script src="'.base_url('builderengine/public/fullcalendar-3.5.1/lib/moment.min.js').'"></script>
			<script src="'.base_url('builderengine/public/fullcalendar-3.5.1/fullcalendar.min.js').'"></script>
			<script>
			$(document).ready(function(){
				var date = new Date();
				var currentYear = date.getFullYear();
				var currentMonth = date.getMonth() + 1;
					currentMonth = (currentMonth < 10) ? "0" + currentMonth : currentMonth;

				$("#calendar'.$this->block->get_id().'").fullCalendar({
					//height:600,
					header: {
						left: "month,agendaWeek,agendaDay",
						center: "title",
						right: "prev,today,next "
					},
					droppable: false, // this allows things to be dropped onto the calendar
					drop: function() {
						$(this).remove();
					},
					selectable: false,
					selectHelper: true,
					select: function(start, end) {
						var title = prompt("Event Title:");
						var eventData;
						if (title) {
							eventData = {
								title: title,
								start: start,
								end: end
							};
							$("#calendar'.$this->block->get_id().'").fullCalendar("renderEvent", eventData, true); // stick? = true
						}
						$("#calendar'.$this->block->get_id().'").fullCalendar("unselect");
					},
					editable: false,
					eventLimit: true, // allow "more" link when too many events
					events: [
						';
							$out = '';
							foreach($events as $event){
								$event_categories = explode(',',$event->categories);
								$category = new Booking_event_category();
								$category = $category->where('name',$event_categories[0])->get();
								$event_color = '';
								if($category->exists()){
									if($category->color == 'be-category-bar-blue')
										$event_color = '#02C3F3';
									if($category->color == 'be-category-bar-pink')
										$event_color = '#F079AD';
									if($category->color == 'be-category-bar-yellow')
										$event_color = '#b3a300';
									if($category->color == 'be-category-bar-orange')
										$event_color = '#FB9404';
									if($category->color == 'be-category-bar-green')
										$event_color = '#C2DA66';
									if($category->color == 'be-category-bar-white')
										$event_color = '#FFFFFF';
								}
								if($event->active == 'yes'){
									$currency = new Currency($event->currency_id);
									if($event->price > 0){
										$price = $event->price;
										$currency = str_replace('$', '&#36;',$currency->symbol);
									}
									else{
										$price = 'FREE';
										$currency = '';
									}
									$event_description = preg_replace("/\s+/", " ", strip_tags(str_replace('&nbsp;',' ',ChEditorfix($event->description))));
									if(strlen($event_description) > 300)
										$decription = trim(substr($event_description,0,300)).'...';
									else
										$decription = trim($event_description);
									$title = $event->name;
									if(strlen($title) > 25)
										$title = trim(substr($title,0,25)).'...';					
									$out .= '{
										title: "'.$title.'",
										image: "'.checkImagePath($event->image).'",
										price: "'.$price.'",
										currency: "'.$currency.'",
										description: "'.$decription.'",                        
										url: "'.base_url('booking_events/event/'.$event->slug).'",
										start: "'.$event->start_date.'T'.$event->start_time.'",';
										//if($event->start_date !== $event->end_date)
											$out .= 'end: "'.$event->end_date.'T'.$event->end_time.'",';
										if($event->featured == 'yes')
											$out .= 'color: "#ff5b57"';
										else
											$out .= 'color: "'.$event_color.'"';
									$out .= '},';
								}
							}
							$output .= $out;
					$output .='
					],
					timeFormat: "H:mm",
					eventMouseover: function(calEvent, jsEvent) {    
						var tooltip ="<div class=\"tooltipevent bookingevents-calendar-popup-style\" style=\"\">" +
										"<div class=\"row\">" +
											"<div class=\"col-md-12\" style=\"margin-bottom:-10px;\">" +
												"<h6><b>" + calEvent.title + "</b><span class=\"pull-right\" style=\"font-size:11px;\">("+ calEvent.currency + calEvent.price +")</span></h6>" +
											"</div>" +
											"<div class=\"col-md-4\">" +
												"<img src=\"" + calEvent.image + "\" class=\"img-thumbnail\" style=\"width:100%;\" />" +
											"</div>" +
											"<div class=\"col-md-8\" style=\"padding-left:0;\">" +
												"<p>" + calEvent.description + "<p/>" +
											"</div>" +
										"</div>" +
									"</div>";
						$("body").append(tooltip);
						$(this).mouseover(function(e) {
							$(this).css("z-index", 10000);
							$(".tooltipevent").fadeIn("500");
							$(".tooltipevent").fadeTo("10", 1.9);
						}).mousemove(function(e) {
							$(".tooltipevent").css("top", e.pageY + 10);
							$(".tooltipevent").css("left", e.pageX + 20);
						});
					},
					eventMouseout: function(calEvent, jsEvent) {
						 $(this).css("z-index", 8);
						 $(".tooltipevent").remove();
					}
				});
				console.log(currentYear + "-" + currentMonth +"-01");

				$("#calendarView").on("shown.bs.tab", function () {
				   $("#calendar'.$this->block->get_id().'").fullCalendar("render");
				});
			});
			</script>
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