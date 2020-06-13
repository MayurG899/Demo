<?php
class Cp_booking_events_my_calendar_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Account Dashboard";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Account Dashboard My Booking Events Calendar";
        $info['block_icon'] = "fa-envelope-o";

        return $info;
    }

    public function generate_admin()
    {
		$this->show_placeholder();
    }

    public function generate_content()
    {
		//Controller
		global $active_controller;
		$user = &$active_controller->user;
        $CI = & get_instance();
		$this->load_generic_styles();
		$CI->load->module('cp');

		$events = new Booking_event();
		$events = $events->where('user_id',$user->get_id())->get();
		//View

			$output ='
			<!-- Start col-10 -->
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="be-uaccount-main-pad">
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-cp-account">
							<div class="panel-heading">
								<div class="panel-heading-btn"></div>
								<h4 class="panel-title">Booking Events Calendar</h4>
								<br>
								<!--
								<div class="alert alert-info beaccount-domains-i-pad">
								</div>-->
							</div>
							<div class="panel-body">
								<link href="'.base_url('builderengine/public/fullcalendar-3.5.1/fullcalendar.min.css').'" rel="stylesheet" />
								<link href="'.base_url('modules/booking_events/assets/css/events.css').'" rel="stylesheet" />
								<div class="row">
									<div class="col-md-12 col-sm-12" style="padding:30px;">';
										if($events->exists()){
											$output .='<div id="calendar" class="vertical-box-column p-15 calendar"></div>';
										}else{
											$output .='
											<h1 class="text-center">
												<a href="'.base_url('cp/booking/events/add').'" class="btn btn-success btn-lg" ><i class="fa fa-plus"></i> Create your first event</a>
											</h1>';
										}
										$output .='
									</div>
								</div>
							</div><!-- End .widget-content -->
						</div><!-- End .widget -->
					</div><!-- End .span12  -->
				</div><!-- End .row-fluid  -->
				<script src="'.base_url('modules/cp/assets/plugins/jquery/jquery-1.9.1.min.js').'"></script>
				<script src="'.base_url('builderengine/public/fullcalendar-3.5.1/lib/moment.min.js').'"></script>
				<script src="'.base_url('builderengine/public/fullcalendar-3.5.1/fullcalendar.min.js').'"></script>
				<script>
				var date = new Date();
				var currentYear = date.getFullYear();
				var currentMonth = date.getMonth() + 1;
					currentMonth = (currentMonth < 10) ? "0" + currentMonth : currentMonth;

				$("#calendar").fullCalendar({
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
							$("#calendar").fullCalendar("renderEvent", eventData, true); // stick? = true
						}
						$("#calendar").fullCalendar("unselect");
					},
					editable: false,
					eventLimit: true, // allow "more" link when too many events
					events: [';
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
										image: "'.$event->image.'",
										price: "'.$event->price.'",
										currency: "'.$currency->symbol.'",
										description: "'.$decription.'",                        
										url: "'.base_url('booking_events/event/'.$event->slug).'",
										start: "'.$event->start_date.'",';
										if($event->start_date !== $event->end_date)
											$out .= 'end: "'.$event->end_date.'",';
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
					eventMouseover: function(calEvent, jsEvent) {
						var tooltip =\'<div class="tooltipevent" style="width:auto;max-width:250px;height:auto;background:#fff;border:1px solid #000;position:absolute;z-index:10001;padding:5px;">\' +
										\'<div class="row">\' +
											\'<div class="col-md-12" style="margin-bottom:-10px;">\' +
												\'<h6 style="background:#eee;padding:5px;"><b>\' + calEvent.title + \'</b><span class="pull-right" style="font-size:11px;">(\'+ calEvent.currency + calEvent.price +\')</span></h6>\' +
											\'</div>\' +
											\'<div class="col-md-4">\' +
												\'<img src="\' + calEvent.image + \'" class="img-thumbnail" style="width:100%;" />\' +
											\'</div>\' +
											\'<div class="col-md-8" style="padding-left:0;">\' +
												\'<p style="word-break:break-all;font-size:11px;">\' + calEvent.description + \'<p/>\' +
											\'</div>\' +
										\'</div>\' +
									\'</div>\';
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
				</script>
				';
			$output .='
			</div>

			<!-- end col-10 -->
	</div>
			<!-- end #content -->	
		';
		if(!$user->is_guest())
			return $output;
    }
}
?>