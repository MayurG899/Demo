<?php
class Booking_services_block_handler extends  block_handler{
	function info()
	{
		$info['category_name'] = "Booking Services";
		$info['category_icon'] = "dsf";

		$info['block_name'] = "Services";
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
		$services = new Booking_service();
		$services = $services->where('active','yes')->get();


		$output = '
			<div id="booking-services-container-'.$this->block->get_id().'" class="bookingevents-container">';
				$i = 0;
				$output .='
				<div class="row">';
				foreach($services as $service)
				{
					$style = '';
					if($service->featured == 'yes')
						$style = '<div class="ribbon-wrapper-red">
									<div class="ribbon-red">
										&nbsp;<span>Featured</span>
									</div>
								</div>';
					$currency = new Currency($service->currency_id);
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
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 booking-services-pricing-multiple-col">
						<div class="beblocks-Pricing-box beblocks-highlight block-colors-light-bg">
							'.$style.'
							<div class="beblocks-price-title beblocks-spacing-box block-colors-dark">
								<h4>'.$service->name.'</h4>
							</div>
							<hr />
							<div class="beblocks-spacing-box booking-service-prices-image-text booking-services-prices-image" style="background: url('.$service->image.');">';
								if($service->price > 0){
									if($service->vat > 0)
										$price = number_format(($service->price + (($service->price * $service->vat) / 100)),2,'.',',').'<small style="font-size:9px">vat included</small>';
									else
										$price = number_format($service->price,2,'.',',');
								}else{
									$price = '<span style="color:#00ff00 !important;">FREE</span>';
								}
								$output .='
								<div class="beblocks-price"><span class="beblocks-price-sm">'.$currency->symbol.'</span><span class="beblocks-price-lg booking-services-pay-price-lg">'.$price.'</span></div>
							</div>
							<hr />
							<div class="booking-services-pricing-features beblocks-spacing-grid booking-services-main-padding-boxes block-colors-light block-colors-light-bg">
								'.$service->description.'
							</div>
							<hr />
							<div class="booking-services-pricing-book block-colors-light block-colors-light-bg">';
								if($service->questionnaire == 'yes')
									$output .= '<a class="btn btn-lg btn-block btn-colors" href="'.base_url('booking_services/service/'.$service->id).'">VIEW DETAILS & APPLY</a>';
								else
									$output .= '<a class="btn btn-lg btn-block btn-colors" href="'.base_url('booking_services/service/'.$service->id).'">VIEW DETAILS & PAYMENT</a>';
								$output .= '
							</div>
						</div>
					</div>';
					$i++;
					if($i%2 == 0)
						$output .='</div><div class="row">';
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
			return $output.$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'booking-services-container--'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output.$this->apply_custom_css();
	}
}
?>