<?php
class Booking_memberships_application_images_block_handler extends  block_handler{
	function info()
	{
		$info['category_name'] = "Booking Memberships";
		$info['category_icon'] = "dsf";

		$info['block_name'] = "Membership Images";
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
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		$curr_membership_id = $this->block->data('membership_id');
		$single_element = '';
		//generic animations
		//$this->load_generic_styling();
		$membership = new Booking_membership();
		if(strpos($_SERVER['REQUEST_URI_PATH'],'booking_memberships/application/') !== FALSE)
			$membership = $membership->where('id',$segments[$count-1])->get();
		else{
			if(empty($curr_membership_id))
				$membership = $membership->where('id',1)->get();
			else
				$membership = $membership->where('id',$curr_membership_id)->get();
		}

		$output = '
			<div id="booking-memberships-application-images-container-'.$this->block->get_id().'" class="booking-membership-application-container module-colors">
				<div class="row">';
					if($membership->exists() && ($membership->additional_image->count() > 0 || $membership->image != '')){
						if($membership->image != ''){
							$output .='
							<div class="col-md-12">
								<img src="'.$membership->image.'" class="img-thumbnail booking-membership-application-images"/>
							</div>';
						}
						if($membership->additional_image->count() > 0){
							foreach($membership->additional_image->get() as $image){
								$output .='
								<div class="col-md-12">
									<img src="'.$image->url.'" class="img-thumbnail booking-membership-application-images"/>
								</div>';
							}
						}
					}else{
						$output .='
						<div class="col-md-12">
							<img src="'.base_url('builderengine/public/img/no_preview.png').'" class="img-thumbnail booking-membership-application-images"/>
						</div>';
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
			return $output.$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'booking-memberships-application-images-container--'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output.$this->apply_custom_css();
	}
}
?>