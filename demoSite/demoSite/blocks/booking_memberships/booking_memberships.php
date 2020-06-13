<?php
class Booking_memberships_block_handler extends  block_handler{
	function info()
	{
		$info['category_name'] = "Booking Memberships";
		$info['category_icon'] = "dsf";

		$info['block_name'] = "Memberships";
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
		$memberships = new Booking_membership();
		$memberships = $memberships->where('active','yes')->get();


		$output = '
			<div id="booking-memberships-container-'.$this->block->get_id().'" class="bookingevents-container">
				<div class="row">';
				foreach($memberships as $membership)
				{
					$style = '';
					if($membership->featured == 'yes')
						$style = '<div class="ribbon-wrapper-red memberships-multiple-ribbon">
									<div class="ribbon-red">
										&nbsp;<span>Featured</span>
									</div>
								</div>';
					$currency = new Currency($membership->currency_id);
					if($currency->id == 3)
						$currency->symbol = '&#36;';
					$output .= '
				<style>
					.ribbon-wrapper-red {
						width: 124px;
						height: 124px;
						overflow: hidden;
						position: absolute;
						top: 0px;
						left: 15px;
					}
					.ribbon-red {
						font: bold 10px Sans-Serif;
						color: #333;
						text-align: center;
						/* text-shadow: rgba(255,255,255,0.5) 0px 1px 0px; */
						-webkit-transform: rotate(-45deg);
						-moz-transform: rotate(-45deg);
						-ms-transform: rotate(-45deg);
						-o-transform: rotate(-45deg);
						position: relative;
						padding: 7px 0;
						left: -33px;
						top: 10px;
						width: 145px;
						background-image: -webkit-linear-gradient(top, #cc0000 0%, #990000 100%);
						background-image: linear-gradient(to bottom, #cc0000 0%, #990000 100%);
						background-repeat: repeat-x;
						filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#ffcc0000", endColorstr="#ff990000", GradientType=0);
						color: #ffffff;
						-webkit-box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3);
						box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3);
						z-index: 1;
						text-transform: uppercase;
					}
				</style>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 booking-membership-pricing-multiple-col">
						<div class="beblocks-Pricing-box beblocks-highlight block-colors-light-bg">
						'.$style.'
						<div class="beblocks-price-title beblocks-spacing-box block-colors-dark">
						<h4>'.$membership->name.'</h4>
						</div>

					<hr />
					<div class="beblocks-spacing-box booking-membership-prices-image-text booking-membership-prices-image" style="background: url('.$membership->image.');">';
					if($membership->price > 0){
						if($membership->vat > 0)
							$price = number_format(($membership->price + (($membership->price * $membership->vat) / 100)),2,'.',',').'<small style="font-size:9px">vat included</small>';
						else
							$price = number_format($membership->price,2,'.',',');
					}else{
						$price = '<span style="color:#00ff00 !important;">FREE</span>';
					}
					$output .='
					<div class="beblocks-price"><span class="beblocks-price-sm">'.$currency->symbol.'</span><span class="beblocks-price-lg">'.$price.'</span></div>
					</div>

					<hr />
					<div class="booking-membership-pricing-features beblocks-spacing-grid block-colors-light block-colors-light-bg be-special-memberships">
						'.$membership->description.'
					</div>

					<hr />
					<div class="booking-membership-pricing-book block-colors-light block-colors-light-bg">';
						if($membership->questionnaire == 'yes')
							$output .= '<a class="btn btn-md btn-colors" href="'.base_url('booking_memberships/membership/'.$membership->id).'">APPLY NOW</a>';
						else
							$output .= '<a class="btn btn-md btn-colors" href="'.base_url('booking_memberships/membership/'.$membership->id).'">BOOK NOW</a>';
						$output .= '
					</div>
					</div>
				</div>
					';
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
			return $output.$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'booking-memberships-container--'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output.$this->apply_custom_css();
	}
}
?>