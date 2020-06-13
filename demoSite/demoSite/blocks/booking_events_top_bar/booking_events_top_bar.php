<?php
class Booking_events_top_bar_block_handler extends  block_handler{
	function info()
	{
		$info['category_name'] = "Booking Events";
		$info['category_icon'] = "dsf";

		$info['block_name'] = "Events Top Bar";
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
		$user = &$active_controller->user;
		$CI = &get_instance();
		$CI->load->module('layout_system');
		$this->load_generic_styles();
		$booking_permission = $CI->BuilderEngine->get_option('booking_events_permission');

		$single_element = '';
		//generic animations
		//$this->load_generic_styling();

		$output = '
			<div id="booking-events-top-bar-container-'.$this->block->get_id().'" class="bookingevents-container">
				<div class="pull-right event-logins bookingevents-top-container">
					<a href="'.base_url('booking_events/events').'" type="button" class="btn btn-sm btn-default"><i class="fa fa-calendar"></i> View More Events</a>';
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
			</div>
		';
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'booking-events-top-bar-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output.$this->apply_custom_css();
	}
}
?>