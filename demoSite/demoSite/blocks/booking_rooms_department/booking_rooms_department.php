<?php
class Booking_rooms_department_block_handler extends  block_handler{
	function info()
	{
		$info['category_name'] = "Booking Rooms";
		$info['category_icon'] = "dsf";

		$info['block_name'] = "Room Details";
		$info['block_icon'] = "fa-envelope-o public";
		
		return $info;
	}
	public function generate_admin()
	{
		$curr_department_id = $this->block->data('department_id');
		$available_departments = array();
		$all_departments = new BookingRoomDepartment();
		foreach($all_departments->where('active','yes')->get() as $key => $value){
			$available_departments[$value->id] = stripslashes(str_replace('_',' ',$value->name));
		}
		$this->admin_select('department_id', $available_departments, 'Departments: ', $curr_department_id);
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
		$user = &$active_controller->user;
		$CI = &get_instance();
		$CI->load->module('layout_system');
		$this->load_generic_styles();
		$booking_permission = $CI->BuilderEngine->get_option('booking_rooms_permission');
		$allowed_to_book_groups = explode(',',$CI->BuilderEngine->get_option('be_booking_rooms_shop_groups'));
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		$curr_department_id = $this->block->data('department_id');
		$single_element = '';
		//generic animations
		//$this->load_generic_styling();
		$department = new BookingRoomDepartment();
		if(strpos($_SERVER['REQUEST_URI_PATH'],'booking_rooms/department/') !== FALSE)
			$department = $department->where('slug',$segments[$count-1])->get();
		else{
			if(empty($curr_department_id))
				$department = $department->where('id',1)->get();
			else
				$department = $department->where('id',$curr_department_id)->get();
		}


		$output = '
			<div id="booking-rooms-department-container-'.$this->block->get_id().'" class="bookingrooms-container-room-details">
			<link href="'.base_url('modules/booking_rooms/assets/css/owl.carousel.css').'" rel="stylesheet">
			<link href="'.base_url('modules/booking_rooms/assets/css/owl.theme.css').'" rel="stylesheet">
			<link href="'.base_url('modules/booking_rooms/assets/css/style.css').'" rel="stylesheet" type="text/css" />
			<div class="bookingrooms-top-padding bookingrooms-style">
				<div class="row">
					<div class="col-lg-6 col-md-7 col-sm-12 col-xs-12 event-calendar-1 bookingrooms-details-left-box">';
						$owner = new User($department->user_id);
						$category = new BookingRoomCategory($department->category_id);
						$currency = new Currency($department->currency_id);
						$output .='
						<div class="">
								<div class="panel bookingrooms-header-dark">
									<div class="panel-heading navbar-user-box"><img src="'.checkImagePath($owner->avatar).'"> '.$owner->first_name.' '.$owner->last_name.' <br> <div class="text-grey">Meeting Room Provider</div></div>
									<div class="panel-body bookingrooms-panel-body-white">
										<h4>Meeting Room Details:</h4>
										<p><b>Room Name:</b> '.$department->name.'</p>
										<p><b>Department:</b> '.$category->name.'</p>
										<p><b>Capacity:</b> '.$department->capacity.'</p>
										<p><b>Available Days:</b> '.$department->available_days.'</p>
										<p><b>Booking Time Start:</b> '.$department->start_time.'</p>
										<p><b>Booking Time End:</b> '.$department->end_time.'</p>
										<p><b>Description:</b> '.$department->description.'</p>
										</p>

									</div>
								</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-5 col-sm-12 col-xs-12 bookingrooms-panel-body-white bookingrooms-details-right-box">
						<div class="event-calendar-bg-1">
						<div style="height:35px;">
							<div class="pull-left">
								
							</div>
							<div class="pull-right event-logins">';
								if(!$user->is_logged_in()){
									if($booking_permission == 'no'){
										$output .='
										<a href="'.base_url('cp/login').'" type="button" class="btn btn-sm btn-default"><i class="fa fa-sign-in"></i> Sign In</a>
										<a href="'.base_url('cp/register').'" type="button" class="btn btn-sm btn-default"><i class="fa fa-users"></i> Create Account</a>';
									}
								}else{
									if($booking_permission == 'no'){
										$output .='
										<a href="'.base_url('cp/dashboard').'" type="button" class="btn btn-sm btn-default"><i class="fa fa-user"></i> My Dashboard</a>
										<a href="'.base_url('cp/logout').'" type="button" class="btn btn-sm btn-default"><i class="fa fa-sign-out"></i> Logout</a>';
									}
								}
							$output .='
							</div>
						</div>';
						if($department->additional_image->count() > 0){
							$output .='
							<div id="owl-images'.$this->block->get_id().'" class="owl-carousel owl-theme">';
								foreach($department->additional_image->get() as $image){
									$output .='
									<div class="item">
										<a href="'.base_url('booking_rooms/department/'.$department->slug).'">
											<img class="img-responsive" src="'.checkImagePath($image->url).'" style="max-height:450px" alt="">
										</a>
									</div>';
								}
							$output .='
							</div>';
						}else{
							$output .='
							<img src="'.checkImagePath($department->image).'" class="img-responsive" style="max-height:450px" />';
						}
						$output .='
						</div><br/>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="panel bookingrooms-header-dark">
								<div class="panel-body bookingrooms-panel-body-white bookingrooms-prices-box">
									<h4>Booking Price Details:</h4>
										<div class="col-lg-4 col-md-4 col-sm-3 col-xs-12">
										<p><b>Price Per Minute:</b></p>
										</div>
										<div class="col-lg-8 col-md-8 col-sm-9 col-xs-12">';
										$price_vat = $department->price + (($department->price * $department->vat)/ 100);
										$output .='
										<div class="bookingrooms-event-product-price"><div class="bookingrooms-event-price label label-success">'.str_replace('$', '&#36;',$currency->symbol).$price_vat.' <small style="font-size: 55%;">incl. VAT @ '.$department->vat.'%</small></div></div>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bookingrooms-booking-price-hr">
										<hr>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-3 col-xs-12">
										<p><b>Price Per Hour:</b></p>
										</div>
										<div class="col-lg-8 col-md-8 col-sm-9 col-xs-12">';
										$price_vat_per_hr = ($department->price + (($department->price * $department->vat)/ 100)) * 60;
										$output .='
										<div class="bookingrooms-event-product-price"><div class="bookingrooms-event-price label label-success">'.str_replace('$', '&#36;',$currency->symbol).$price_vat_per_hr.' <small style="font-size: 55%;">incl. VAT @ '.$department->vat.'.%</small></div></div>
										</div>';
										if($user->is_logged_in()){
											if($user->is_member_of_any($allowed_to_book_groups))
												$output .='<div class="bookingrooms-department-booknow-area"><a href="'.base_url('booking_rooms/calendar?room='.$department->id).'" class="btn btn-lg btn-success bookingrooms-department-booknow">BOOK THIS ROOM</a></div>';
										}else{
											$output .='<div class="bookingrooms-department-booknow-area"><a href="'.base_url('cp/register').'" class="btn btn-lg btn-success bookingrooms-department-booknow">BOOK THIS ROOM</a></div>';
										}
									$output .='
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<script src="'.base_url('modules/booking_rooms/assets/js/owl.carousel.min.js').'"></script>
			<script>
			$(document).ready(function(){
				var secondRow'.$this->block->get_id().' = $("#owl-images'.$this->block->get_id().'");
				secondRow'.$this->block->get_id().'.owlCarousel({
					autoPlay: true,
					stopOnHover: true,
					navigation: true,
					itemsCustom: [
						[0, 1],
						[450, 1],
						[600, 2],
						[700, 3],
						[1000, 3],
						[1200, 3],
						[1400, 3],
						[1600, 3]
					],
				});
			});
			</script>
			</div>';
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'booking-rooms-department-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output.$this->apply_custom_css();
	}
}
?>