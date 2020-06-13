<?php
class Booking_service_block_handler extends  block_handler{
	function info()
	{
		$info['category_name'] = "Booking Services";
		$info['category_icon'] = "dsf";

		$info['block_name'] = "Service";
		$info['block_icon'] = "fa-envelope-o public";
		
		return $info;
	}
	public function generate_admin()
	{
		$curr_service_id = $this->block->data('service_id');
		$available_services = array();
		$all_services = new Booking_service();
		foreach($all_services->where('active','yes')->get() as $key => $value){
			$available_services[$value->id] = stripslashes(str_replace('_',' ',$value->name));
		}
		$this->admin_select('service_id', $available_services, 'Services: ', $curr_service_id);
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

		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		$curr_service_id = $this->block->data('service_id');
		$service = new Booking_service();
		if(strpos($_SERVER['REQUEST_URI_PATH'],'booking_services/service/') !== FALSE)
			$service = $service->where('id',$segments[$count-1])->get();
		else{
			if(empty($curr_service_id))
				$service = $service->where('id',1)->get();
			else
				$service = $service->where('id',$curr_service_id)->get();
		}
		$groups_allowed_to_book = explode(',',$CI->BuilderEngine->get_option('be_booking_services_shop_groups'));
		$output = '
			<div id="booking-services-container-'.$this->block->get_id().'" class="booking-service-prices-container">';
			if($service->exists() && $service->active == 'yes'){
				$currency = new Currency($service->currency_id);
				if($currency->id == 3)
					$currency->symbol = '&#36;';
				$style = '';
				if($service->featured == 'yes')
					$style = '<div class="ribbon-wrapper-red">
								<div class="ribbon-red">
									&nbsp;<span>Featured</span>
								</div>
							</div>';
				$output .= '
		<div class="row">
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
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="beblocks-Pricing-box beblocks-highlight block-colors-light-bg">
					'.$style.'
					<div class="booking-services-main-image-border">
						<div class="booking-services-prices-spacing-box-single booking-services-prices-image-text" style="background: url('.$service->image.');">
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<div class="booking-services-pricing-features beblocks-spacing-grid event-product-desc block-colors-light block-colors-light-bg">
								<h3>'.$service->name.'</h3>
								<p><b>Availability:</b> '.date('d F Y',strtotime($service->start_date)).' to '.date('d F Y',strtotime($service->end_date)).' </p>';
								if($service->addonservice->get()->exists()){
								$output .='
									<p><b>Additional Checkout Options:</b></p>
									<ul>';
										foreach($service->addonservice->get() as $addon){
											if($addon->price_opt == 'flat'){
												if($currency->symbol_position == 'before')
													$output .='<li>'.$addon->name.' for '.$currency->symbol. number_format($addon->price,2,'.',',').' Extra</li>';
												else
													$output .='<li>'.$addon->name.' for '.number_format($addon->price,2,'.',',').$currency->symbol.' Extra</li>';
											}else{
												$price = (($service->price * $addon->price) / 100);
												if($currency->symbol_position == 'before')
													$output .='<li>'.$addon->name.' for '.$currency->symbol. number_format($price,2,'.',',').' Extra</li>';
												else
													$output .='<li>'.$addon->name.' for '.number_format($price,2,'.',',').$currency->symbol.' Extra</li>';
											}
										}
									$output .='
									</ul>';
								}
							$output .='
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="booking-services-pricing-features beblocks-spacing-grid block-colors-light block-colors-light-bg">
								<div class="booking-services-pay-price pull-right">';
									if($service->price > 0){
										if($service->vat > 0)
											if($service->show_vat == 'yes')
												$price = number_format(($service->price + (($service->price * $service->vat) / 100)),2,'.',',').'<small style="font-size:9px">vat included</small>';
											else
												$price = number_format($service->price,2,'.',',');
										else
											$price = number_format($service->price,2,'.',',');
									}else{
										$price = '<span>FREE</span>';
									}
									$output .='
									<div class="event-price label label-success">'.$currency->symbol.''.$price.' 
										<small style="font-size: 45%;">';
										$price_option = explode('-',$service->subscription_period);
										if($price_option[0] == '1')
											$wording = 'per '.$price_option[1];
										else
											$wording = 'for '.$price_option[0].' '.$price_option[1].'s';
										$output .= $wording;
										$output .='</small>
									</div>
										<br><br><br>
										
								</div>
									<div class="booking-services-pay-bookbutton">	
										<div class="event-product-buynow">
											<div class="booking-services-pricing-book block-colors-light block-colors-light-bg btn-block">';
												if($user->is_member_of_any($groups_allowed_to_book)){
													if(($service->questionnaire == 'yes' || $service->approval == 'yes') || $user->is_guest())
														$output .= '<a class="btn btn-lg btn-block btn-colors booking-services-pay-price-button" href="'.base_url('booking_services/application/'.$service->id).'">APPLY NOW</a>';
													else
														$output .= '<a class="btn btn-lg btn-block btn-colors booking-services-pay-price-button" href="'.base_url('booking_services/checkout/'.$service->id).'">BOOK NOW</a>';
												}else
														$output .= '<a class="btn btn-lg btn-block btn-colors booking-services-pay-price-button booking-services-warning" href="javascript:;">SORRY,YOU ARE NOT ALLOWED TO BOOK A SERVICE.PLEASE CONTACT ADMIN</a>';
												$output .= ' 
											</div>
										</div>
									</div>
							</div>
						</div>
					</div>

					<div class="panel-body event-product-tab" jstcache="0">	
						<ul id="event-product-tab" class="nav nav-tabs">
							<li class="active"><a href="#product-desc" data-toggle="tab" aria-expanded="true">Description</a></li>
						</ul>
						<div id="event-product-tab-content" class="" jstcache="0">
							<div class="tab-pane fade active in" id="product-desc" jstcache="0">
					<div class="row">
						<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
							<div class="booking-services-pricing-features beblocks-spacing-grid block-colors-light block-colors-light-bg">
								'.$service->description.'
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<div class="booking-services-pricing-features beblocks-spacing-grid block-colors-light block-colors-light-bg">
								<div class="row">';
									if($service->exists() && ($service->additional_image->count() > 0 || $service->image != '')){
										if($service->image != ''){
											$output .='
												<div class="col-md-12">
													<a class="example-image-link img-thumbnail booking-services-application-images" href="'.$service->image.'" data-lightbox="example-1"><img class="" src="'.$service->image.'"/></a>
												</div>';
										}
									if($service->additional_image->count() > 0){
										foreach($service->additional_image->get() as $image){
											$output .='
												<div class="col-md-12">
													<a class="example-image-link img-thumbnail booking-services-application-images" href="'.$image->url.'" data-lightbox="example-1"><img class="" src="'.$image->url.'"/></a>
												</div>';
										}
									}
									}else{
									$output .='
										<div class="col-md-12">
											<img src="'.base_url('builderengine/public/img/no_preview.png').'" class="img-thumbnail booking-services-application-images"/>
										</div>';
									}
									$output .='
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
					<hr />
				</div>';
			}else
				$output = '<h1 class="text-center">No such Service</h1>';
			$output .='
			</div>
		</div>
	</div>
		';
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'booking-services-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), $menu);
		else
			return $output.$this->apply_custom_css();
	}
}
?>