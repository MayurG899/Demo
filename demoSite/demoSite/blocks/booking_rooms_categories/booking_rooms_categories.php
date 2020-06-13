<?php
class Booking_rooms_categories_block_handler extends  block_handler{
	function info()
	{
		$info['category_name'] = "Booking Rooms";
		$info['category_icon'] = "dsf";

		$info['block_name'] = "Meeting Departments Slider";
		$info['block_icon'] = "fa-envelope-o public";
		
		return $info;
	}
	public function generate_admin()
	{
		$curr_category_id = $this->block->data('category_id');
		$available_categories = array();
		$available_categories[0] = 'All';
		$all_categories = new BookingRoomCategory();
		foreach($all_categories->where('active','yes')->get() as $key => $value){
			$available_categories[$value->id] = stripslashes(str_replace('_',' ',$value->name));
		}
		$this->admin_select('category_id', $available_categories, 'Department Categories: ', $curr_category_id);
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
		$this->load_generic_styles();
		$booking_permission = $CI->BuilderEngine->get_option('booking_rooms_permission');
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		$curr_category_id = $this->block->data('category_id');
		$single_element = '';
		//generic animations
		//$this->load_generic_styling();
		$categories = new BookingRoomCategory();
		if(strpos($_SERVER['REQUEST_URI_PATH'],'booking_rooms/category/') !== FALSE){
			if($segments[$count-1] == 'all'){
				$categories = $categories->get();
			}else{
				$categories = $categories->where('id',$segments[$count-1])->get();
				if($categories->exists())
					$categories = $categories;
				else
					show_404();
			}
		}else{
			if(empty($curr_category_id)){
				$categories = $categories->get();
			}else{
				if($id == 'all'){
					$categories = $categories->get();
				}else{
					$categories = $categories->where('id',$curr_category_id)->get();
					if(!$categories->exists())
						show_404();
				}
			}
		}

		$output = '
			<div id="booking-rooms-categories-container-'.$this->block->get_id().'" class="bookingrooms-container">
				<link href="'.base_url('modules/booking_rooms/assets/css/owl.carousel.css').'" rel="stylesheet">
				<link href="'.base_url('modules/booking_rooms/assets/css/owl.theme.css').'" rel="stylesheet">
				<div class="event-top-padding">
					<div class="row">
						<div class="col-md-12 col-sm-12 event-calendar-1">
							<div>
								<div class="pull-left">
								</div>
							</div>';
							if($categories->exists()){
								$output .='
								<div id="owl-categories'.$this->block->get_id().'" class="owl-carousel owl-theme">';
									foreach($categories as $category){
										$output .='
										<div class="item" style="border-left:20px solid #000;">
											<a href="'.base_url('booking_rooms/departments/'.$category->id).'">
												<h1 style="position:absolute;top:0;background:#000;color:#fff;margin:20px;padding:10px;">
													<span>'.$category->name.'</span>
												</h1>
												<div style="position:absolute;bottom:0px;background:#000;color:#fff;margin:20px;padding:10px;opacity:0.5">
													'.$category->description.'
												</div>
												<img class="img-responsive" src="'.$category->image.'" style="max-height:450px" alt="">
											</a>
										</div>';
									}
								$output .='
								</div>';
							}else{
								$output .='<h1 class="text-center" style="margin:200px 0"><i class="fa fa-info-circle"></i> No Categories Created </h1>';
							}
						$output .='
						</div>
					</div>
				</div>
				<script src="'.base_url('modules/booking_rooms/assets/js/owl.carousel.min.js').'"></script>
				<script>
				$(document).ready(function(){
					var secondRow'.$this->block->get_id().' = $("#owl-categories'.$this->block->get_id().'");
					secondRow'.$this->block->get_id().'.owlCarousel({
						autoPlay: true,
						stopOnHover: true,
						navigation: false,
						pagination: false,
						itemsCustom: [//screen view states px/num_slides
							[0, 1],
							[450, 1],
							[600, 2],
							[700, 3],
							[1000, 1],
							[1200, 1],
							[1400, 1],
							[1600, 1]
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
			return $output.$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'booking-rooms-categories-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output.$this->apply_custom_css();
	}
}
?>