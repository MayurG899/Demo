<?php
class Booking_rooms_calendar_block_handler extends  block_handler{
	function info()
	{
		$info['category_name'] = "Booking Rooms";
		$info['category_icon'] = "dsf";

		$info['block_name'] = "Rooms Calendar";
		$info['block_icon'] = "fa-envelope-o public";
		
		return $info;
	}
	public function generate_admin()
	{
		$default_view = $this->block->data('default_view');
		$available_rooms = array();
		$available_rooms[0] = 'all';
		$all_rooms = new BookingRoomDepartment();
		foreach($all_rooms->where('active','yes')->get() as $key => $value){
			$available_rooms[$value->id] = stripslashes(str_replace('_',' ',$value->name));
		}
		$this->admin_select('default_view', $available_rooms, 'Default Room View: ', $default_view);
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
		$user = &$active_controller->user;
		$CI = &get_instance();
		$CI->load->module('layout_system');
		$CI->load->model('users');
		$this->load_generic_styles();
		$booking_permission = $CI->BuilderEngine->get_option('booking_rooms_permission');
		$allowed_to_book_groups = explode(',',$CI->BuilderEngine->get_option('be_booking_rooms_shop_groups'));
		$selectable = 'false';
		if($user->is_member_of_any($allowed_to_book_groups))
			$selectable = 'true';
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		$default_view = $this->block->data('default_view');
		if(empty($default_view) || $default_view == 'all')
			$_GET['room'] = 'all';
		else
			$_GET['room'] = $default_view;
		$single_element = '';
		
		$bookings = new BookingRoom();
		$departments = new BookingRoomDepartment();
		$bookings = $bookings->get();
		$departments = $departments->where('active','yes')->order_by('name','asc')->get();

		$output = '
		<div id="booking-rooms-calendar-container-'.$this->block->get_id().'" class="bookingrooms-container">
			<link href="'.base_url('builderengine/public/fullcalendar-3.5.1/fullcalendar.min.css').'" rel="stylesheet" />
			<script src="'.base_url('builderengine/public/fullcalendar-3.5.1/lib/moment.min.js').'"></script>
			<script src="'.base_url('builderengine/public/fullcalendar-3.5.1/fullcalendar.min.js').'"></script>
			<link href="'.base_url().'themes/dashboard/assets/plugins/parsley/src/parsley.css" rel="stylesheet" />
			
			<div class="bookingrooms-container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bookingrooms-calendar-box-1">
						<div class="panel panel-default panel-with-tabs" data-sortable-id="ui-unlimited-tabs-2">';
							if($departments->exists()){
								$output .='
								<div class="panel-heading p-0 panel-rooms-white">
									<div class="tab-overflow">
										<ul class="nav nav-tabs">
											<li class="prev-button"><a href="javascript:;" data-click="prev-tab" class="text-inverse"><i class="fa fa-arrow-left"></i></a></li>
											<li class="';if(isset($_GET['room']) && $_GET['room'] == 'all')$output .='active';$output .='"><a class="calAll" href="#nav-tab2-0" data-toggle="tab">All Meeting Areas</a></li>';
											foreach($departments as $department){
												$output .='<li class="';if(isset($_GET['room']) && $_GET['room'] == $department->id) $output .= 'active';$output .='"><a class="cal" href="#nav-tab2-'.$department->id.'" data-toggle="tab">'.$department->name.'</a></li>';
											}
											$output .='
											<li class="next-button"><a href="javascript:;" data-click="next-tab" class="text-inverse"><i class="fa fa-arrow-right"></i></a></li>
										</ul>
									</div>
								</div>
								<div class="pull-right bookingrooms-calendar-logins">';
									if(!$user->is_logged_in()){
										$output .='
										<a href="'.base_url('cp/login').'" type="button" class="btn btn-sm btn-grey"><i class="fa fa-sign-in"></i> Sign In</a>
										<a href="'.base_url('cp/register').'" type="button" class="btn btn-sm btn-grey"><i class="fa fa-users"></i> Create Account</a>';
									}else{
										$output .='
										<a href="'.base_url('cp/dashboard').'" type="button" class="btn btn-sm btn-grey"><i class="fa fa-user"></i> My Dashboard</a>
										<a href="'.base_url('cp/logout').'" type="button" class="btn btn-sm btn-grey"><i class="fa fa-sign-out"></i> Logout</a>';
									}
									$output .='
								</div>
								<div class="tab-content bookingrooms-bg-calendar">
									<div class="tab-pane fade ';if(isset($_GET['room']) && $_GET['room'] == 'all')$output .='active in';$output .='" id="nav-tab2-0" style="padding:10px">
										<h4 class="be-bookingrooms-areas-title"><i class="fa fa-caret-right"></i> All Meeting Areas</h4>
										<div id="calendarAll" class="vertical-box-column p-15 calendar bookingrooms-style"></div>
									</div>';
									foreach($departments as $department){
										$output .='
										<div class="tab-pane fade ';if(isset($_GET['room']) && $_GET['room'] == $department->id) $output .= 'active in';$output .='" id="nav-tab2-'.$department->id.'" style="padding:10px">
											<h4 class="be-bookingrooms-areas-title">';
												if(!empty($department->image)){
													$output .='';
												}
												$output .='
												<i class="fa fa-caret-right"></i> '.$department->name.' <a href="'.base_url('booking_rooms/department/'.$department->slug).'" class="btn btn-xs btn-colors bookingrooms-calendar-details-button"><i class="fa fa-info-circle"></i> Details & Prices</a>
											</h4>
											<div id="calendar'.$department->id.'" class="vertical-box-column p-15 calendar bookingrooms-style"></div>
										</div>';
									}
								$output .='
								</div>';
							}else{
								$output .='<h1 class="text-center">No Active Departments</h1>';
							}
						$output .='
						</div>
					</div>
				</div>
			</div>
			<div id="editModal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<form id="editBooking" method="post" data-parsley-validate="true">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
								<h4 id="editModalTitle" class="modal-title"></h4>
							</div>
							<div id="modalBody" class="modal-body">';
								$rooms = new BookingRoomDepartment();
								$rooms = $rooms->where('active','yes')->get();
								$output .='
								<div class="form-group">
									<select id="editDepartmentId" name="department_id" class="form-control" required>
										<option value="">Select Room</option>';
										foreach($rooms as $room){
											$output .='<option value="'.$room->id.'">'.$room->name.'</option>';
										}
									$output .='
									</select>
								</div>
								<div class="form-group">
									<input type="hidden" id="editStatus" name="status" value="booked" />
								</div>';
								if($CI->users->is_admin()){
									$output .='
									<div class="form-group">
										<select id="editUserId" name="user_id" class="form-control" required>
											<option value="">Select Client</option>';
											$usrs = new User();
											$usrs = $usrs->where('verified','yes')->get();
											foreach($usrs as $u){
												$output .='<option value="'.$u->id.'">'.$u->first_name.' '.$u->last_name.'</option>';
											}
										$output .='
										</select>
									</div>';
								}else{
									$output .='<input id="editUserId" type="hidden" name="user_id" value="'.$user->get_id().'" />';
								}
								$output .='
								<input id="editId" type="hidden" name="id" />
								<input id="editbookDate" type="hidden" name="date" />
								<input id="editStartTime" type="hidden" name="start_time" />
								<input id="editEndTime" type="hidden" name="end_time" />
								<input id="editst" type="hidden" />
								<input id="editen" type="hidden" />
							</div>
							<div class="modal-footer">
								<div class="col-lg-12">
									<div class="alert alert-info">
										<p style="text-align:left">
											<i class="fa fa-info-circle"></i> 
											Start/End times can be set by resizing an event within calendar week or day views only.You can also
											drag (move) event to another date column to change the event date.
										</p>
									</div>
								</div>
								<div class="col-lg-12">
									<a id="deleteBooking" href="" class="btn btn-sm btn-danger pull-left"><i class="fa fa-trash"></i> Delete</a>
									<button id="cancelR" type="button" class="btn btn-sm btn-grey" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
									<button id="edit" type="submit" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Save Changes</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div id="addModal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<form id="addNewBooking" method="post" data-parsley-validate="true">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
								<h4 id="addModalTitle" class="modal-title"><i class="fa fa-book"></i> Book a Room</h4>
							</div>
							<div id="addModalBody" class="modal-body">';
								$rooms = new BookingRoomDepartment();
								$rooms = $rooms->where('active','yes')->get();
								$output .='
								<div class="form-group">
									<select id="deptId" name="department_id" class="form-control" required>
										<option value="">Select Room</option>';
										foreach($rooms as $room){
											$output .='<option value="'.$room->id.'">'.$room->name.'</option>';
										}
									$output .='
									</select>
								</div>
								<div class="form-group">
									<input type="hidden" id="editStatus" name="status" value="booked" />
								</div>';
								if($CI->users->is_admin()){
									$output .='
									<div class="form-group">
										<select id="userId" name="user_id" class="form-control" required>
											<option value="">Select Client</option>';
											$usrs = new User();
											$usrs = $usrs->where('verified','yes')->get();
											foreach($usrs as $u){
												$output .='<option value="'.$u->id.'">'.$u->first_name.' '.$u->last_name.'</option>';
											}
										$output .='
										</select>
									</div>';
								}else{
									$output .='<input id="userId" type="hidden" name="user_id" value="'.$user->get_id().'" />';
								}
								$output .='
								<input id="bookDate" type="hidden" name="date" />
								<input id="StartTime" type="hidden" name="start_time" />
								<input id="EndTime" type="hidden" name="end_time" />
								<input id="st" type="hidden" />
								<input id="en" type="hidden" />
							</div>
							<div class="modal-footer">
								<div class="col-lg-12">
									<div class="alert alert-info">
										<p style="text-align:left">
											<i class="fa fa-info-circle"></i> 
											Start/End times can be set by resizing an event within calendar week or day views only.You can also
											drag (move) event to another date column to change the event date.
										</p>
									</div>
								</div>
								<div class="col-lg-12">
									<button type="button" class="btn btn-sm btn-grey" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
									<button id="save" type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Save</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div id="errModal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
							<h4 id="addModalTitle" class="modal-title"><i class="fa fa-exclamation-triangle"></i> Error</h4>
						</div>
						<div id="errModalBody" class="modal-body">
							<div class="alert alert-danger">
								<p class="text-center">Oops, you are trying to edit somebody else`s booking !</p>
								<p class="text-center"><i class="fa fa-smile-o" style="font-size:20px;"></i></p>
								<p class="text-center"><small>You do not have this permission !</small></p>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-grey" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
						</div>
					</div>
				</div>
			</div>
			<script>
			$(document).ready(function(){
				$(".canceled").css("background","red").css("animation-duration","2s").addClass("animated flash infinite");
				var date = new Date();
				var currentYear = date.getFullYear();
				var currentMonth = date.getMonth() + 1;
					currentMonth = (currentMonth < 10) ? "0" + currentMonth : currentMonth;

				$("#calendarAll").fullCalendar({
					defaultView: "agendaWeek",
					header: {
						left: "month,agendaWeek,agendaDay,listYear,listMonth,listWeek,listDay",
						center: "title",
						right: "prev,today,next "
					},/*
					viewRender: (function () {
						var lastViewName;
						return function (view) {
							var view = $("#calendarAll").fullCalendar("getView");
							alert("The new title of the view is " + view.title);
						}
					})(),*/
					views: {
						listDay: {
						  buttonText: "list day"
						},
						listWeek: {
						  buttonText: "list week"
						},
						listMonth: {
						  buttonText: "list month"
						},
						listYear: {
						  buttonText: "list year"
						}
					},
					businessHours: {
						// days of week. an array of zero-based day of week integers (0=Sunday)
						dow: [ 1, 2, 3, 4, 5, 6, 0 ], // Monday - Thursday

						start: "09:00", // a start time (10am in this example)
						end: "24:00", // an end time (6pm in this example)
					},
					eventAfterRender:function( event, element, view ) {
						$(".canceled").css("background","red").css("animation-duration","2s").addClass("animated flash infinite");
					},
					navLinks: true,
					//lazyFetching: false,
					slotDuration: "00:30:00",
					allDaySlot: false,
					minTime: "09:00:00",
					maxTime: "24:00:00",
					droppable: false,
					drop: function() {
						$(this).remove();
					},
					selectable: '.$selectable.',
					selectOverlap: function(event) {
						return event.rendering === "background";
					},
					eventStartEditable: true,
					eventDrop:function( event, delta, revertFunc, jsEvent, ui, view ) {
						var st = moment(event.start).format("HH:mm");
						var en = moment(event.end).format("HH:mm");
						var curr_user_id = "'.$user->get_id().'";
						var bookDate = moment(event.end).format("YYYY-MM-DD");';
						$admin = ($CI->users->is_admin())?"true":"false";
						$output .='
						var admin = "'.$admin.'";
						if(event.user_id == curr_user_id || admin == "true"){
							$("#editStatus").val(event.status.toLowerCase());
							$("#editUserId").val(event.user_id);
							$("#editDepartmentId").val(event.room_id);
							$("#editModalTitle").html(event.modalTitle);
							$("#edituserId").val(event.user_id);
							$("#editId").val(event.id);
							$("#editbookDate").val(bookDate);
							$("#editStartTime").val(st);
							$("#editEndTime").val(en);
							$("#editst").val(st);
							$("#editen").val(en);
							var link = "'.base_url("booking_rooms/delete_booking").'/" + event.id;
							$("#deleteBooking").attr("href",link);
							$("#editModal").modal();
							$(".canceled").css("background","red").css("animation-duration","2s").addClass("animated flash infinite");
							$("#cancelR").on("click",function(){
								revertFunc();
							});
						}else{
							$("#errModal").modal();
							revertFunc();
						}
					},
					eventResize: function(event, delta, revertFunc) {
						/*
						alert(event.title + " end is now (" + delta.asMinutes() + ")" + event.end.format());

						if (!confirm("is this okay?")) {
							revertFunc();
						}
						*/
						var st = moment(event.start).format("HH:mm");
						var en = moment(event.end).format("HH:mm");
						var curr_user_id = "'.$user->get_id().'";';
						$admin = ($CI->users->is_admin())?"true":"false";
						$output .='
						var admin = "'.$admin.'";
						if(event.user_id == curr_user_id || admin == "true"){
							$("#editStatus").val(event.status.toLowerCase());
							$("#editUserId").val(event.user_id);
							$("#editDepartmentId").val(event.room_id);
							$("#editModalTitle").html(event.modalTitle);
							$("#edituserId").val(event.user_id);
							$("#editId").val(event.id);
							$("#editbookDate").val(event.bookDate);
							$("#editStartTime").val(st);
							$("#editEndTime").val(en);
							$("#editst").val(st);
							$("#editen").val(en);
							var link = "'.base_url("booking_rooms/delete_booking").'/" + event.id;
							$("#deleteBooking").attr("href",link);
							$("#editModal").modal();
							$(".canceled").css("background","red").css("animation-duration","2s").addClass("animated flash infinite");
							$("#cancelR").on("click",function(){
								revertFunc();
							});
						}else{
							$("#errModal").modal();
							revertFunc();
						}
					},
					selectHelper: true,
					select: function(start, end, allDay) {
						var view = $("#calendarAll").fullCalendar("getView");
						console.log("Start: " + start.format());
						console.log("End: " + start.format());
						console.log("Current view: " + view.name);
						if (view.name == "agendaWeek" || view.name == "agendaDay") {
							var bookDate = start.format("YYYY-MM-DD");
							var startTime = start.format("HH:mm");
							var endTime = end.format("HH:mm");
							var st = start.format("YYYY-MM-DD HH:mm:00");
							var en = end.format("YYYY-MM-DD HH:mm:00");
							$("#bookDate").val(bookDate);
							$("#StartTime").val(startTime);
							$("#EndTime").val(endTime);
							$("#st").val(st);
							$("#en").val(en);
							$("#addModal").modal("show");
						}
						if(view.name == "month"){
							var bookDate = start.format();
							var startTime = "10:00";
							var endTime = "23:59";
							var st = start.format(bookDate + " 10:00:00");
							var en = end.format(bookDate + " 23:59:00");
							console.log(st);
							console.log(en);
							$("#bookDate").val(bookDate);
							$("#StartTime").val(startTime);
							$("#EndTime").val(endTime);
							$("#st").val(st);
							$("#en").val(en);
							$("#addModal").modal("show");
						}
					},
					editable: true,
					eventLimit: false,
					events: [
						';
							$out = '';
							foreach($bookings as $event){
								$room = new BookingRoomDepartment($event->department_id);
								$category = new BookingRoomCategory($room->category_id);
								$usr = new User($event->user_id);
								$event_color = '';
								if($room->exists()){
									if($room->color == 'be-category-bar-blue')
										$event_color = '#02C3F3';
									if($room->color == 'be-category-bar-pink')
										$event_color = '#F079AD';
									if($room->color == 'be-category-bar-yellow')
										$event_color = '#FFFF00';
									if($room->color == 'be-category-bar-orange')
										$event_color = '#FB9404';
									if($room->color == 'be-category-bar-green')
										$event_color = '#C2DA66';
									if($room->color == 'be-category-bar-white')
										$event_color = '#FFFFFF';
									if($room->color == 'be-category-bar-purple')
										$event_color = '#9900CC';
								}
								if($room->active == 'yes'){
									$currency = new Currency($room->currency_id);
									if($room->price > 0){
										$to_time = strtotime($event->date.' '.$event->end_time.':00');
										$from_time = strtotime($event->date.' '.$event->start_time.':00');
										$price = (((int)$to_time - (int)$from_time) / 60) * $room->price;
										$currency = str_replace('$', '&#36;',$currency->symbol);
									}
									else{
										$price = 'FREE';
										$currency = '';
									}
									$title = $room->name;
									if(strlen($title) > 14)
										$title = trim(substr($title,0,14));	
									$className = '';
									if($event->status == 'canceled')
										$className = 'canceled';
									$out .= '{
										id: "'.$event->id.'",
										user_id: "'.$usr->id.'",
										room_id: "'.$room->id.'",
										title: "'.$title.'",
										modalTitle: "'.$room->name.' room <small>'.$event->date.' ('.$event->start_time.' - '.$event->end_time.')</small>'.'",
										status: "'.ucfirst($event->status).'",
										image: "'.checkImagePath($usr->avatar).'",
										price: "'.$price.'",
										currency: "'.$currency.'",
										className: "'.$className.'",
										user: "'.$usr->first_name.' '.$usr->last_name.'",  
										description: "Venue: <strong style=\"color:'.$event_color.'\">'.$room->name.'</strong> <br/> from: <b>'.$event->start_time.'</b> to <b>'.$event->end_time.'</b>",                        
										/*url: "'.base_url('booking_rooms/room/'.$event->slug).'",*/
										bookDate: "'.$event->date.'",
										start: "'.$event->date.'T'.$event->start_time.'",
										end: "'.$event->date.'T'.$event->end_time.'",';
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
					eventClick:  function(event, jsEvent, view) {
						var view = $("#calendarAll").fullCalendar("getView");
						if (view.name == "month" || view.name == "agendaWeek" || view.name == "agendaDay") {
							var st = moment(event.start).format("HH:mm");
							var en = moment(event.end).format("HH:mm");
							var curr_user_id = "'.$user->get_id().'";';
							$admin = ($CI->users->is_admin())?"true":"false";
							$output .='
							var admin = "'.$admin.'";
							if(event.user_id == curr_user_id || admin == "true"){
								$("#editStatus").val(event.status.toLowerCase());
								$("#editUserId").val(event.user_id);
								$("#editDepartmentId").val(event.room_id);
								$("#editModalTitle").html(event.modalTitle);
								$("#editId").val(event.id);
								$("#editbookDate").val(event.bookDate);
								$("#editStartTime").val(st);
								$("#editEndTime").val(en);
								$("#editst").val(st);
								$("#editen").val(en);
								var link = "'.base_url("booking_rooms/delete_booking").'/" + event.id;
								$("#deleteBooking").attr("href",link);
								$("#editModal").modal();
								$(".canceled").css("background","red").css("animation-duration","2s").addClass("animated flash infinite");
							}else
								$("#errModal").modal();
						}
					},
					timeFormat: "HH:mm",
					eventMouseover: function(calEvent, jsEvent) {
						var tooltip ="<div class=\"tooltipevent booking-rooms-calendar-popup-style\">" +
										"<div class=\"row-booking-rooms-tooltip\">" +
											"<div class=\"\">" +
												"<h6><b>Meeting: " + calEvent.status + "</b><span class=\"pull-right\" style=\"font-size:11px;\">("+ calEvent.currency + calEvent.price +")</span></h6>" +
											"</div>" +
											"<div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-3 \">" +
												"<img src=\"" + calEvent.image + "\" class=\"img-thumbnail\" style=\"width:100%;margin-left:5px;\" />" +
											"</div>" +
											"<div class=\"col-lg-9 col-md-9 col-sm-9 col-xs-9 be-bookingrooms-popup-p\">" +
												"<p><strong>" + calEvent.user + "</strong></p>" +
												"<p>" + calEvent.description + "</p>" +
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
				//console.log(currentYear + "-" + currentMonth +"-01");

				$("[data-click=\"show-main-image\"]").click(function(e) {
					e.preventDefault();
					
					
					var targetContainer = "[data-id=\"main-image\"]";
					var targetImage = "<img src=\""+ $(this).attr("data-url") +"\" />";
					var targetLi = $(this).closest("li");
					
					$(targetContainer).html(targetImage);
					$(targetLi).addClass("active");
					$("[data-click=\"show-main-image\"]").closest("li").not(targetLi).removeClass("active");
				});


				$("#addNewBooking").on("submit", function(e){
					e.preventDefault();
					booking("add");
				});
				$("#editBooking").on("submit", function(e){
					e.preventDefault();
					booking("edit");
				});
				function booking(action){

					if(action == "edit"){
						var $form = $("#editBooking");
						var urls = "'.base_url("booking_rooms/ajax/room_booking/edit").'";
						var modal = $("#editModal");
					}else{
						var $form = $("#addNewBooking");
						var urls = "'.base_url("booking_rooms/ajax/room_booking/add").'";
						var modal = $("#addModal");
					}
					var $inputs = $form.find("input, select, button, textarea");
					var serializedData = $form.serialize();

					if((action == "add" && $("#userId").val().length > 0 && $("#deptId").val().length > 0) || (action == "edit" && $("#editUserId").val().length > 0 && $("#editDepartmentId").val().length > 0)){
						$.ajax({
							url: urls,
							type: "post",
							dataType: "json",
							data: serializedData
						}).done(function (response, textStatus, jqXHR){
							if(response.ajax == "success"){
								modal.modal("hide");
								if(action == "add"){
									$("#calendarAll").fullCalendar("renderEvent",
									{
										id: response.id,
										user_id: response.user_id,
										room_id: response.room_id,
										title: response.title,
										status: response.status,
										price: response.price,
										currency: response.currency,
										image: response.image,
										user: response.user,
										bookDate: response.bookDate,
										description: response.description,
										start: new Date(response.start),
										end: new Date(response.end),
										color: response.color,
									},
									true);
								}else{
									$("#calendarAll").fullCalendar("refetchEvents");
									$(".canceled").css("background","red").css("animation-duration","2s").addClass("animated flash infinite");
									var item = $("#calendarAll").fullCalendar( "clientEvents", response.id );
									console.log(item);
									item[0].title = response.title;
									item[0].color = response.color;
									item[0].description = response.description;
									item[0].price = response.price;
									item[0].user = response.user;
									item[0].currency = response.currency;
									item[0].user_id = response.user_id;
									item[0].status = response.status;
									item[0].bookDate = response.bookDate;
									item[0].image = response.image;
									if(response.status == "canceled")
										item[0].className = "canceled";
									else
										item[0].className = "";
									$("#calendarAll").fullCalendar("updateEvent",item[0]);
									$(".canceled").css("background","red").css("animation-duration","2s").addClass("animated flash infinite");
								}
							}
							if(response.ajax == "fail"){

							}
							if(response.ajax == "error"){
								alert("Sorry,you can not use this time range!");
							}

						}).fail(function (response, textStatus, errorThrown){
							console.error( "The following error occurred: " + textStatus, errorThrown );
						}).always(function () {
							
						});
					}
				}
				$(".canceled").css("background","red").css("animation-duration","2s").addClass("animated flash infinite");
				$(".calAll").on("shown.bs.tab", function () {
				   $("#calendarAll").fullCalendar("render");
				});
			});
			</script>';
			if($departments->exists()){
				foreach($departments as $department){
					$output .='
					<div id="editModal'.$department->id.'" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<form id="editBooking'.$department->id.'" method="post" data-parsley-validate="true">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
										<h4 id="editModalTitle'.$department->id.'" class="modal-title"></h4>
									</div>
									<div id="modalBody" class="modal-body">';
										$rooms = new BookingRoomDepartment();
										$rooms = $rooms->where('active','yes')->get();
										if($CI->users->is_admin()){
											$output .='
											<div class="form-group">
												<select id="editDepartmentId'.$department->id.'" name="department_id" class="form-control" required>
													<option value="">Select Room</option>';
													foreach($rooms as $room){
														$output .='<option value="'.$room->id.'">'.$room->name.'</option>';
													}
												$output .='
												</select>
											</div>';
										}else{
											$output .='<input type="hidden" id="editDepartmentId'.$department->id.'" name="department_id" value="'.$department->id.'" />';
										}
										$output .='
										<div class="form-group">
											<input type="hidden" id="editStatus" name="status" value="booked" />
										</div>';
										if($CI->users->is_admin()){
											$output .='
											<div class="form-group">
												<select id="editUserId'.$department->id.'" name="user_id" class="form-control" required>
													<option value="">Select Client</option>';
													$usrs = new User();
													$usrs = $usrs->where('verified','yes')->get();
													foreach($usrs as $u){
														$output .='<option value="'.$u->id.'">'.$u->first_name.' '.$u->last_name.'</option>';
													}
												$output .='
												</select>
											</div>';
										}else{
											$output .='<input id="editUserId'.$department->id.'" type="hidden" name="user_id" value="'.$user->get_id().'" />';
										}
										$output .='
										<input id="editId'.$department->id.'" type="hidden" name="id" />
										<input id="editbookDate'.$department->id.'" type="hidden" name="date" />
										<input id="editStartTime'.$department->id.'" type="hidden" name="start_time" />
										<input id="editEndTime'.$department->id.'" type="hidden" name="end_time" />
										<input id="editst'.$department->id.'" type="hidden" />
										<input id="editen'.$department->id.'" type="hidden" />
									</div>
									<div class="modal-footer">
										<div class="col-lg-12">
											<div class="alert alert-info">
												<p style="text-align:left">
													<i class="fa fa-info-circle"></i> 
													Start/End times can be set by resizing an event within calendar week or day views only.You can also
													drag (move) event to another date column to change the event date.
												</p>
											</div>
										</div>
										<div class="col-lg-12">
											<a id="deleteBooking'.$department->id.'" href="" class="btn btn-sm btn-danger pull-left"><i class="fa fa-trash"></i> Delete</a>
											<button id="cancelR'.$department->id.'" type="button" class="btn btn-sm btn-grey" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
											<button id="edit'.$department->id.'" type="submit" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Save Changes</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div id="addModal'.$department->id.'" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<form id="addNewBooking'.$department->id.'" method="post" data-parsley-validate="true">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
										<h4 id="addModalTitle'.$department->id.'" class="modal-title"><i class="fa fa-book"></i> Book a Room</h4>
									</div>
									<div id="addModalBody'.$department->id.'" class="modal-body">';
										$rooms = new BookingRoomDepartment();
										$rooms = $rooms->where('active','yes')->get();
										$output .='
										<input type="hidden" id="deptId'.$department->id.'" name="department_id" value="'.$department->id.'" />
										<div class="form-group">
											<input type="hidden" id="editStatus" name="status" value="booked" />
										</div>';
										if($CI->users->is_admin()){
											$output .='
											<div class="form-group">
												<select id="userId'.$department->id.'" name="user_id" class="form-control" required>
													<option value="">Select Client</option>';
													$usrs = new User();
													$usrs = $usrs->where('verified','yes')->get();
													foreach($usrs as $u){
														$output .='<option value="'.$u->id.'">'.$u->first_name.' '.$u->last_name.'</option>';
													}
												$output .='
												</select>
											</div>';
										}else{
											$output .='<input id="userId'.$department->id.'" type="hidden" name="user_id" value="'.$user->get_id().'" />';
										}
										$output .='
										<input id="bookDate'.$department->id.'" type="hidden" name="date" />
										<input id="StartTime'.$department->id.'" type="hidden" name="start_time" />
										<input id="EndTime'.$department->id.'" type="hidden" name="end_time" />
										<input id="st'.$department->id.'" type="hidden" />
										<input id="en'.$department->id.'" type="hidden" />
									</div>
									<div class="modal-footer">
										<div class="col-lg-12">
											<div class="alert alert-info">
												<p style="text-align:left">
													<i class="fa fa-info-circle"></i> 
													Start/End times can be set by resizing an event within calendar week or day views only.You can also
													drag (move) event to another date column to change the event date.
												</p>
											</div>
										</div>
										<div class="col-lg-12">
											<button type="button" class="btn btn-sm btn-grey" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
											<button id="save'.$department->id.'" type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Save</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div id="errModal'.$department->id.'" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
									<h4 id="addModalTitle'.$department->id.'" class="modal-title"><i class="fa fa-exclamation-triangle"></i> Error</h4>
								</div>
								<div id="errModalBody'.$department->id.'" class="modal-body">
									<div class="alert alert-danger">
										<p class="text-center">Oops, you are trying to edit somebody else`s booking !</p>
										<p class="text-center"><i class="fa fa-smile-o" style="font-size:20px;"></i></p>
										<p class="text-center"><small>You do not have this permission !</small></p>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-sm btn-grey" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
								</div>
							</div>
						</div>
					</div>
					<script>
					$(document).ready(function(){
						$(".canceled").css("background","red").css("animation-duration","2s").addClass("animated flash infinite");
						var date = new Date();
						var currentYear = date.getFullYear();
						var currentMonth = date.getMonth() + 1;
							currentMonth = (currentMonth < 10) ? "0" + currentMonth : currentMonth;
						var available_days = [];
						var hidden_days = []; ';
						$available_days = explode(',',$department->available_days);
						if(in_array('Monday',$available_days)){
							$output .=' available_days.push(1);';
						}else{
							$output .=' hidden_days.push(1);';
						}
						if(in_array('Tuesday',$available_days)){
							$output .=' available_days.push(2);';
						}else{
							$output .=' hidden_days.push(2);';
						}
						if(in_array('Wednesday',$available_days)){
							$output .=' available_days.push(3);';
						}else{
							$output .=' hidden_days.push(3);';
						}
						if(in_array('Thursday',$available_days)){
							$output .=' available_days.push(4);';
						}else{
							$output .=' hidden_days.push(4);';
						}
						if(in_array('Friday',$available_days)){
							$output .=' available_days.push(5);';
						}else{
							$output .=' hidden_days.push(5);';
						}
						if(in_array('Saturday',$available_days)){
							$output .=' available_days.push(6);';
						}else{
							$output .=' hidden_days.push(6);';
						}
						if(in_array('Sunday',$available_days)){
							$output .=' available_days.push(0);';
						}else{
							$output .=' hidden_days.push(0); ';
						}
						$output .='
						
						$("#calendar'.$department->id.'").fullCalendar({
							defaultView: "'.$department->default_view.'",
							header: {
								left: "month,agendaWeek,agendaDay,listYear,listMonth,listWeek,listDay",
								center: "title",
								right: "prev,today,next "
							},/*
							viewRender: (function () {
								var lastViewName;
								return function (view) {
									var view = $("#calendarAll").fullCalendar("getView");
									alert("The new title of the view is " + view.title);
								}
							})(),*/
							views: {
								listDay: {
								  buttonText: "list day"
								},
								listWeek: {
								  buttonText: "list week"
								},
								listMonth: {
								  buttonText: "list month"
								},
								listYear: {
								  buttonText: "list year"
								}
							},
							hiddenDays: hidden_days,
							businessHours: {
								// days of week. an array of zero-based day of week integers (0=Sunday)
								dow: available_days, // Monday - Thursday

								start: "'.$department->start_time.'", // a start time (10am in this example)
								end: "'.$department->end_time.'", // an end time (6pm in this example)
							},
							eventAfterRender:function( event, element, view ) {
								$(".canceled").css("background","red").css("animation-duration","2s").addClass("animated flash infinite");
							},
							navLinks: true,
							//lazyFetching: false,
							slotDuration: "00:30:00",
							allDaySlot: false,
							minTime: "'.$department->start_time.'",
							maxTime: "'.$department->end_time.'",
							droppable: false,
							drop: function() {
								$(this).remove();
							},
							selectable: '.$selectable.',
							selectOverlap: function(event) {
								return event.rendering === "background";
							},
							eventStartEditable: true,
							eventDrop:function( event, delta, revertFunc, jsEvent, ui, view ) {
								var st = moment(event.start).format("HH:mm");
								var en = moment(event.end).format("HH:mm");
								var curr_user_id = "'.$user->get_id().'";
								var bookDate = moment(event.end).format("YYYY-MM-DD");';
								$admin = ($CI->users->is_admin())?'true':'false';
								$output .='
								var admin = "'.$admin.'";
								if(event.user_id == curr_user_id || admin == "true"){
									$("#editStatus'.$department->id.'").val(event.status.toLowerCase());
									$("#editUserId'.$department->id.'").val(event.user_id);
									$("#editDepartmentId'.$department->id.'").val(event.room_id);
									$("#editModalTitle'.$department->id.'").html(event.modalTitle);
									$("#edituserId'.$department->id.'").val(event.user_id);
									$("#editId'.$department->id.'").val(event.id);
									$("#editbookDate'.$department->id.'").val(bookDate);
									$("#editStartTime'.$department->id.'").val(st);
									$("#editEndTime'.$department->id.'").val(en);
									$("#editst'.$department->id.'").val(st);
									$("#editen'.$department->id.'").val(en);
									var link = "'.base_url("booking_rooms/delete_booking").'/" + event.id;
									$("#deleteBooking'.$department->id.'").attr("href",link);
									$("#editModal'.$department->id.'").modal();
									$(".canceled").css("background","red").css("animation-duration","2s").addClass("animated flash infinite");
									$("#cancelR'.$department->id.'").on("click",function(){
										revertFunc();
									});
								}else{
									$("#errModal").modal();
									revertFunc();
								}
							},
							eventResize: function(event, delta, revertFunc) {
								/*
								alert(event.title + " end is now (" + delta.asMinutes() + ")" + event.end.format());

								if (!confirm("is this okay?")) {
									revertFunc();
								}
								*/
								var st = moment(event.start).format("HH:mm");
								var en = moment(event.end).format("HH:mm");
								var curr_user_id = "'.$user->get_id().'";';
								$admin = ($CI->users->is_admin())?"true":"false";
								$output .='
								var admin = "'.$admin.'";
								if(event.user_id == curr_user_id || admin == "true"){
									$("#editStatus'.$department->id.'").val(event.status.toLowerCase());
									$("#editUserId'.$department->id.'").val(event.user_id);
									$("#editDepartmentId'.$department->id.'").val(event.room_id);
									$("#editModalTitle'.$department->id.'").html(event.modalTitle);
									$("#edituserId'.$department->id.'").val(event.user_id);
									$("#editId'.$department->id.'").val(event.id);
									$("#editbookDate'.$department->id.'").val(event.bookDate);
									$("#editStartTime'.$department->id.'").val(st);
									$("#editEndTime'.$department->id.'").val(en);
									$("#editst'.$department->id.'").val(st);
									$("#editen'.$department->id.'").val(en);
									var link = "'.base_url("booking_rooms/delete_booking").'/" + event.id;
									$("#deleteBooking'.$department->id.'").attr("href",link);
									$("#editModal'.$department->id.'").modal();
									$(".canceled").css("background","red").css("animation-duration","2s").addClass("animated flash infinite");
									$("#cancelR'.$department->id.'").on("click",function(){
										revertFunc();
									});
								}else{
									$("#errModal'.$department->id.'").modal();
									revertFunc();
								}
							},
							selectHelper: true,
							select: function(start, end, allDay) {
								var view = $("#calendar'.$department->id.'").fullCalendar("getView");
								console.log("Start: " + start.format());
								console.log("End: " + start.format());
								console.log("Current view: " + view.name);
								if (view.name == "agendaWeek" || view.name == "agendaDay") {
									var bookDate = start.format("YYYY-MM-DD");
									var startTime = start.format("HH:mm");
									var endTime = end.format("HH:mm");
									var st = start.format("YYYY-MM-DD HH:mm:00");
									var en = end.format("YYYY-MM-DD HH:mm:00");
									$("#bookDate'.$department->id.'").val(bookDate);
									$("#StartTime'.$department->id.'").val(startTime);
									$("#EndTime'.$department->id.'").val(endTime);
									$("#st'.$department->id.'").val(st);
									$("#en'.$department->id.'").val(en);
									$("#addModal'.$department->id.'").modal("show");
								}
								if(view.name == "month"){
									var bookDate = start.format();
									var startTime = "10:00";
									var endTime = "23:59";
									var st = start.format(bookDate + " 10:00:00");
									var en = end.format(bookDate + " 23:59:00");
									console.log(st);
									console.log(en);
									$("#bookDate'.$department->id.'").val(bookDate);
									$("#StartTime'.$department->id.'").val(startTime);
									$("#EndTime'.$department->id.'").val(endTime);
									$("#st'.$department->id.'").val(st);
									$("#en'.$department->id.'").val(en);
									$("#addModal'.$department->id.'").modal("show");
								}
							},
							editable: true,
							eventLimit: false,
							events: [';
									$out = '';
									$department_bookings = new BookingRoom();
									foreach($department_bookings->where('department_id',$department->id)->get() as $event){
										$room = new BookingRoomDepartment($event->department_id);
										$category = new BookingRoomCategory($room->category_id);
										$usr = new User($event->user_id);
										$event_color = '';
										if($room->exists()){
											if($room->color == 'be-category-bar-blue')
												$event_color = '#02C3F3';
											if($room->color == 'be-category-bar-pink')
												$event_color = '#F079AD';
											if($room->color == 'be-category-bar-yellow')
												$event_color = '#FFFF00';
											if($room->color == 'be-category-bar-orange')
												$event_color = '#FB9404';
											if($room->color == 'be-category-bar-green')
												$event_color = '#C2DA66';
											if($room->color == 'be-category-bar-white')
												$event_color = '#FFFFFF';
											if($room->color == 'be-category-bar-purple')
												$event_color = '#9900CC';
										}
										if($room->active == 'yes'){
											$currency = new Currency($room->currency_id);
											if($room->price > 0){
												$to_time = strtotime($event->date.' '.$event->end_time.':00');
												$from_time = strtotime($event->date.' '.$event->start_time.':00');
												$price = (((int)$to_time - (int)$from_time) / 60) * $room->price;
												$currency = str_replace('$', '&#36;',$currency->symbol);
											}
											else{
												$price = 'FREE';
												$currency = '';
											}
											$title = $room->name;
											if(strlen($title) > 14)
												$title = trim(substr($title,0,14));	
											$className = '';
											if($event->status == 'canceled')
												$className = 'canceled';
											$out .= '{
												id: "'.$event->id.'",
												user_id: "'.$usr->id.'",
												room_id: "'.$room->id.'",
												title: "'.$title.'",
												modalTitle: "'.$room->name.' room <small>'.$event->date.' ('.$event->start_time.' - '.$event->end_time.')</small>'.'",
												status: "'.ucfirst($event->status).'",
												image: "'.checkImagePath($usr->avatar).'",
												price: "'.$price.'",
												currency: "'.$currency.'",
												className: "'.$className.'",
												user: "'.$usr->first_name.' '.$usr->last_name.'",  
												description: "Booked <strong style=\"color:'.$event_color.'\">'.$room->name.'</strong> <br/> from: <b>'.$event->start_time.'</b> to <b>'.$event->end_time.'</b>",                        
												/*url: "'.base_url('booking_rooms/room/'.$event->slug).'",*/
												bookDate: "'.$event->date.'",
												start: "'.$event->date.'T'.$event->start_time.'",
												end: "'.$event->date.'T'.$event->end_time.'",';
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
							eventClick:  function(event, jsEvent, view) {
								var view = $("#calendar'.$department->id.'").fullCalendar("getView");
								if (view.name == "month" || view.name == "agendaWeek" || view.name == "agendaDay") {
									var st = moment(event.start).format("HH:mm");
									var en = moment(event.end).format("HH:mm");
									var curr_user_id = "'.$user->get_id().'";';
									$admin = ($CI->users->is_admin())?"true":"false";
									$output .='
									var admin = "'.$admin.'";
									if(event.user_id == curr_user_id || admin == "true"){
										$("#editStatus'.$department->id.'").val(event.status.toLowerCase());
										$("#editUserId'.$department->id.'").val(event.user_id);
										$("#editDepartmentId'.$department->id.'").val(event.room_id);
										$("#editModalTitle'.$department->id.'").html(event.modalTitle);
										$("#editId'.$department->id.'").val(event.id);
										$("#editbookDate'.$department->id.'").val(event.bookDate);
										$("#editStartTime'.$department->id.'").val(st);
										$("#editEndTime'.$department->id.'").val(en);
										$("#editst'.$department->id.'").val(st);
										$("#editen'.$department->id.'").val(en);
										var link = "'.base_url("booking_rooms/delete_booking").'/" + event.id;
										$("#deleteBooking'.$department->id.'").attr("href",link);
										$("#editModal'.$department->id.'").modal();
										$(".canceled").css("background","red").css("animation-duration","2s").addClass("animated flash infinite");
									}else
										$("#errModal'.$department->id.'").modal();
								}
							},
							timeFormat: "HH:mm",
							eventMouseover: function(calEvent, jsEvent) {
								var tooltip ="<div class=\"tooltipevent booking-rooms-calendar-popup-style\">" +
										"<div class=\"row-booking-rooms-tooltip\">" +
											"<div class=\"\">" +
												"<h6><b>Meeting: " + calEvent.status + "</b><span class=\"pull-right\" style=\"font-size:11px;\">("+ calEvent.currency + calEvent.price +")</span></h6>" +
											"</div>" +
											"<div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-3 \">" +
												"<img src=\"" + calEvent.image + "\" class=\"img-thumbnail\" style=\"width:100%;margin-left:5px;\" />" +
											"</div>" +
											"<div class=\"col-lg-9 col-md-9 col-sm-9 col-xs-9 be-bookingrooms-popup-p\">" +
												"<p><strong>" + calEvent.user + "</strong></p>" +
												"<p>" + calEvent.description + "</p>" +
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
						//console.log(currentYear + "-" + currentMonth +"-01");

						$("[data-click=\"show-main-image\"]").click(function(e) {
							e.preventDefault();
							
							var targetContainer = "[data-id=\"main-image\"]";
							var targetImage = "<img src=\""+ $(this).attr("data-url") +"\" />";
							var targetLi = $(this).closest("li");
							
							$(targetContainer).html(targetImage);
							$(targetLi).addClass("active");
							$("[data-click=\"show-main-image\"]").closest("li").not(targetLi).removeClass("active");
						});


						$("#addNewBooking'.$department->id.'").on("submit", function(e){
							e.preventDefault();
							booking("add");
						});
						$("#editBooking'.$department->id.'").on("submit", function(e){
							e.preventDefault();
							booking("edit");
						});
						function booking(action){

							if(action == "edit"){
								var $form = $("#editBooking'.$department->id.'");
								var urls = "'.base_url("booking_rooms/ajax/room_booking/edit").'";
								var modal = $("#editModal'.$department->id.'");
							}else{
								var $form = $("#addNewBooking'.$department->id.'");
								var urls = "'.base_url("booking_rooms/ajax/room_booking/add").'";
								var modal = $("#addModal'.$department->id.'");
							}
							var $inputs = $form.find("input, select, button, textarea");
							var serializedData = $form.serialize();

							if((action == "add" && $("#userId'.$department->id.'").val().length > 0 && $("#deptId'.$department->id.'").val().length > 0) || (action == "edit" && $("#editUserId'.$department->id.'").val().length > 0 && $("#editDepartmentId'.$department->id.'").val().length > 0)){
								$.ajax({
									url: urls,
									type: "post",
									dataType: "json",
									data: serializedData
								}).done(function (response, textStatus, jqXHR){
									if(response.ajax == "success"){
										modal.modal("hide");
										if(action == "add"){
											$("#calendar'.$department->id.'").fullCalendar("renderEvent",
											{
												id: response.id,
												user_id: response.user_id,
												room_id: response.room_id,
												title: response.title,
												status: response.status,
												price: response.price,
												currency: response.currency,
												image: response.image,
												user: response.user,
												bookDate: response.bookDate,
												description: response.description,
												start: new Date(response.start),
												end: new Date(response.end),
												color: response.color,
											},
											true);
										}else{
											$("#calendar'.$department->id.'").fullCalendar("refetchEvents");
											$(".canceled").css("background","red").css("animation-duration","2s").addClass("animated flash infinite");
											var item = $("#calendar'.$department->id.'").fullCalendar( "clientEvents", response.id );
											console.log(item);
											item[0].title = response.title;
											item[0].color = response.color;
											item[0].description = response.description;
											item[0].price = response.price;
											item[0].user = response.user;
											item[0].currency = response.currency;
											item[0].user_id = response.user_id;
											item[0].status = response.status;
											item[0].bookDate = response.bookDate;
											item[0].image = response.image;
											if(response.status == "canceled")
												item[0].className = "canceled";
											else
												item[0].className = "";
											$("#calendar'.$department->id.'").fullCalendar("updateEvent",item[0]);
											$(".canceled").css("background","red").css("animation-duration","2s").addClass("animated flash infinite");
										}
									}
									if(response.ajax == "fail"){

									}
									if(response.ajax == "error"){
										alert("Sorry,you can not use this time range!");
									}

								}).fail(function (response, textStatus, errorThrown){
									console.error( "The following error occurred: " + textStatus, errorThrown );
								}).always(function () {
									
								});
							}
						}
						$(".canceled").css("background","red").css("animation-duration","2s").addClass("animated flash infinite");
						$(".cal").on("shown.bs.tab", function () {
						   $("#calendar'.$department->id.'").fullCalendar("render");
						});
					});
					</script>';
				}
			}
			$output .='
			<script src="'.base_url().'themes/dashboard/assets/plugins/parsley/dist/parsley.js"></script>	
			<script src="'.base_url('modules/booking_rooms/assets/js/unlimited_tabs.js').'"></script>
			<script>
				$(document).ready(function(){
					handleUnlimitedTabsRender();
				});
			</script>
		</div>';
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'booking-rooms-calendar-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output.$this->apply_custom_css();
	}
}
?>