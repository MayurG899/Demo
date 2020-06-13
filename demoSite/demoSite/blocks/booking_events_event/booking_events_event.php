<?php
class Booking_events_event_block_handler extends  block_handler{
	function info()
	{
		$info['category_name'] = "Booking Events";
		$info['category_icon'] = "dsf";

		$info['block_name'] = "Event";
		$info['block_icon'] = "fa-envelope-o public";
		
		return $info;
	}
	public function generate_admin()
	{
		$curr_event_id = $this->block->data('event_id');
		$available_events = array();
		$all_events = new Booking_event();
		foreach($all_events->where('active','yes')->get() as $key => $value){
			$available_events[$value->id] = stripslashes(str_replace('_',' ',$value->name));
		}
		$this->admin_select('event_id', $available_events, 'Events: ', $curr_event_id);
	}
	public function generate_style($active_menu = '')
	{
		
	}
	public function load_generic_styling()
	{
		
	}
    public function load_module_css()
    {
        return '
       
        ';
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
		$allowed_to_book_groups = explode(',',$CI->BuilderEngine->get_option('be_booking_events_shop_groups'));
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		$curr_event_id = $this->block->data('event_id');
		$single_element = '';
		//generic animations
		//$this->load_generic_styling();
		$event = new Booking_event();
		if(strpos($_SERVER['REQUEST_URI_PATH'],'booking_events/event/') !== FALSE)
			$event = $event->where('slug',$segments[$count-1])->get();
		else{
			if(empty($curr_event_id))
				$event = $event->where('id',1)->get();
			else
				$event = $event->where('id',$curr_event_id)->get();
		}


		$output = '
			<div id="booking-events-event-container-'.$this->block->get_id().'" class="bookingevents-container">
				<div class="event-top-padding">
					<div class="">
					<div class="event-topbar">
					<div class="pull-right event-logins">
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
					<div class="pull-left event-price-1">';
					if($event->end_date >= date('Y-m-d',time()))
						$output .='<h1 class="event-product-title">'.ucfirst($event->name).'</h1>';
					else
						$output .='<h1 class="event-product-title">'.ucfirst($event->name).' (ENDED)</h1>';
					$output .='
					</div>
				</div>
						<div class="event-container" style="margin-bottom:20px;">
								<!-- BEGIN product -->
								<div class="event-product module-colors module-colors-bg">
									<!-- BEGIN product-detail -->
									<div class="event-product-detail">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 event-column-1">
										<!-- BEGIN product-image -->
										<div class="event-product-image event-image-1">
											<!-- BEGIN product-thumbnail -->
											<div class="event-product-thumbnail">
												<ul class="event-product-thumbnail-list">';
													$images = $event->additional_image->get();
													$output .='
													<li class="active"><a href="#" data-click="show-main-image" data-url="'.checkImagePath($event->image).'"><img src="'.checkImagePath($event->image).'" alt="" /></a></li>';
													if($images->exists()){
														foreach($images as $image){
															$output .='<li><a href="#" data-click="show-main-image" data-url="'.checkImagePath($image->url).'"><img src="'.checkImagePath($image->url).'" alt="" /></a></li>';
														}
													}
												$output .='
												</ul>
											</div>
											<!-- END product-thumbnail -->
											<!-- BEGIN product-main-image -->
											<div class="event-product-main-image" data-id="main-image">
												<img src="'.checkImagePath($event->image).'" alt="" />
											</div>
											<!-- END product-main-image -->
										</div>
										<!-- END product-image -->
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 event-column-2">
										<!-- BEGIN product-info -->
										<div class="event-product-info event-info-1">
											
											<input type="hidden" name="id" value="'.$event->slug.'" />
											<input type="hidden" name="object" value="event" />';
											$currency = new Currency($event->currency_id);
											$output .='
											<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 event-column-3">
											<!-- BEGIN product-info-header -->
											<div class="event-product-info-header">';
											if($event->end_date >= date('Y-m-d',time()))
												$output .= '<h1 class="event-product-title"><b>Event:</b> '.ucfirst($event->name).'</h1>';
											else
												$output .= '<h1 class="event-product-title"><b>Event:</b> '.ucfirst($event->name).' (ENDED)</h1>';
												$early_discount = $event->earlydiscount->get();
												$group_discount = $event->groupdiscount->get();
												$usergroup_discount = $event->usergroupdiscount->get();
												$addon_service = $event->addonservice->get();
												if($early_discount->exists()){
													$symbol = ($early_discount->price_opt == 'percent')?'':str_replace('$', '&#36;',$currency->symbol);
													$output .='<span class="label label-success">Early Discount '.$symbol.$early_discount->price;if($early_discount->price_opt == 'percent')$output .= '%';$output .=' OFF</span>';
												}
												if($group_discount->exists()){
													$symbol = ($group_discount->price_opt == 'percent')?'':str_replace('$', '&#36;',$currency->symbol);
													$output .='<span class="label label-success">'.ucfirst($group_discount->name).' Discount '.$symbol.$group_discount->price;if($group_discount->price_opt == 'percent')$output .= '%';$output .=' OFF</span>';
												}
												if($usergroup_discount->exists()){
													$symbol = ($usergroup_discount->price_opt == 'percent')?'':str_replace('$', '&#36;',$currency->symbol);
													$output .='<span class="label label-success">'.ucfirst($usergroup_discount->usergroup_name).' Usergroup Discount '.$symbol.$usergroup_discount->price;if($usergroup_discount->price_opt == 'percent')$outpiut .= '%';$output .=' OFF</span>';
												}
												if($addon_service->exists()){
													$symbol = ($addon_service->price_opt == 'percent')?'':str_replace('$', '&#36;',$currency->symbol);
													$output .='<span class="label label-danger">'.ucfirst($addon_service->name).' '.$symbol.$addon_service->price;if($addon_service->price_opt == 'percent')$output .= '%';$output .=' +</span>';
												}
											$output .='
											<!-- BEGIN product-purchase-container -->
											<div class="event-product-purchase-container buynow-1">
												<div class="event-product-discount">
													<!--<span class="discount">$869.00</span>-->
												</div>
												<div class="event-product-price">';
													if($event->price > 0){
														if($early_discount->exists()){
															if($early_discount->price_opt == 'flat'){
																$vat = (($event->price - $early_discount->price) * $event->vat) / 100;
																$output .='<div class="event-price label label-success">'.str_replace('$', '&#36;',$currency->symbol). number_format((($event->price - $early_discount->price) + $vat),2).' <small style="font-size: 45%;">incl. VAT @ '.$event->vat.'%</small></div>';
															}else{
																$discount = ($event->price * $early_discount->price) / 100;
																$vat = (($event->price - $discount) * $event->vat) / 100;
																$output .='<div class="event-price label label-success">'.str_replace('$', '&#36;',$currency->symbol). number_format((($event->price - $discount) + $vat),2).' <small style="font-size: 45%;">incl. VAT @ '.$event->vat.'%</small></div>';
															}
														}else{
															$vat = ($event->price * $event->vat) / 100;
															$output .='<div class="event-price label label-success">'.str_replace('$', '&#36;',$currency->symbol). number_format(($event->price + $vat),2).' <small style="font-size: 45%;">incl. VAT @ '.$event->vat.'%</small></div>';
														}
													}else{
														$output .='<div class="event-price label label-success">EVENT PRICE: FREE</div>';
													}
												$output .='
												</div>
												<div class="event-product-buynow">';
												if($event->end_date >= date('Y-m-d',time())){
													if($user->is_logged_in()){
														if($user->is_member_of_any($allowed_to_book_groups))
															if($event->link == '' || $event->link == null)
																$output .='<button class="btn btn-colors btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-check"></i> Book Now</button>';
															else
																$output .='<a class="btn btn-colors btn-lg" href="'.$event->link.'"><i class="fa fa-check"></i> Book Now</a>';
													}else{
														if($booking_permission == 'yes'){
															if($user->is_member_of_any($allowed_to_book_groups))
																if($event->link == '' || $event->link == null)
																	$output .='<button class="btn btn-colors btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-check"></i> Book Now</button>';
																else
																	$output .='<a class="btn btn-colors btn-lg" href="'.$event->link.'"><i class="fa fa-check"></i> Book Now</a>';
														}else{
															$output .='<a class="btn btn-colors btn-lg" href="'.base_url('cp/register').'"><i class="fa fa-check"></i> Book Now</a>';
														}
													}
												}
												$output .='
												</div>
											</div>
											<!-- END product-purchase-container -->
											<!-- BEGIN product-social -->	
											<div class="event-product-social-2">
												<ul>
													<li><a href="javascript:;" class="facebook" data-toggle="tooltip" data-trigger="hover" data-title="Facebook" data-placement="top"><i class="fa fa-facebook"></i></a></li>
													<li><a href="javascript:;" class="twitter" data-toggle="tooltip" data-trigger="hover" data-title="Twitter" data-placement="top"><i class="fa fa-twitter"></i></a></li>
													<li><a href="javascript:;" class="google-plus" data-toggle="tooltip" data-trigger="hover" data-title="Google Plus" data-placement="top"><i class="fa fa-google-plus"></i></a></li>
													<li><a href="javascript:;" class="whatsapp" data-toggle="tooltip" data-trigger="hover" data-title="Whatsapp" data-placement="top"><i class="fa fa-whatsapp"></i></a></li>
													<li><a href="javascript:;" class="tumblr" data-toggle="tooltip" data-trigger="hover" data-title="Tumblr" data-placement="top"><i class="fa fa-tumblr"></i></a></li>
												</ul>
											</div>
											<!-- END product-social -->
											
											</div>
											<!-- END product-info-header -->
											</div>
											<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 event-column-3">
											
											<!-- BEGIN event-date -->
											<div class="event-date"><div class="event-datename">Date:</div> <p>'.date('d M Y',strtotime($event->start_date)).' to '.date('d M Y',strtotime($event->end_date)).'</p></div>
											<div class="event-date"><div class="event-datename">Time:</div> <p>'.$event->start_time.' - '.$event->end_time.'</p></div>';
											if($event->show_capacity == 'yes'){
												$result = ($event->capacity - $event->booked);
												$output .='<div class="event-date event-capacity-1"><div class="event-datename">Capacity:</div> <p><span id="capacity">'.$result.'</span> Tickets Remaining</p></div>';
											}
											$output .='
											<!-- BEGIN product-warranty -->
											<div class="event-product-warranty">
												<div class="pull-right maptext"><p><a href="#event-product-tab-content"> <i class="fa fa-map-marker" style="color:red;"></i> Map</a></p></div>
												<div><div class="event-datename">Location:</div><p><span id="addressCoordinates">'.$event->location.'</span></p></div>
											</div>
											<!-- END product-warranty -->
											<div class="event-product-buynow-3">';
												if($user->is_logged_in() && $booking_permission == 'yes')
													$output .='<button class="btn btn-colors btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-check"></i> Book Now</button>';
												else
													$output .='<a class="btn btn-colors btn-lg" href="'.base_url('cp/register').'"><i class="fa fa-check"></i> Book Now</a>';
											$output .='
											</div>
											<!-- BEGIN product-social -->	
											<div class="event-product-social">
												<ul>
													<li><a href="https://www.facebook.com/sharer/sharer.php?u=http%3A//'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'" target="_blank" class="facebook" data-toggle="tooltip" data-trigger="hover" data-title="Facebook" data-placement="top"><i class="fa fa-facebook"></i></a></li>
													<li><a href="https://twitter.com/home?status=http%3A//'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'" target="_blank" class="twitter" data-toggle="tooltip" data-trigger="hover" data-title="Twitter" data-placement="top"><i class="fa fa-twitter"></i></a></li>
													<li><a href="https://plus.google.com/share?url=http%3A//'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'" target="_blank" class="google-plus" data-toggle="tooltip" data-trigger="hover" data-title="Google Plus" data-placement="top"><i class="fa fa-google-plus"></i></a></li>
													<li><a href="whatsapp://send?text=http%3A//'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'" data-action="share/whatsapp/share" class="whatsapp" data-toggle="tooltip" data-trigger="hover" data-title="Whatsapp" data-placement="top"><i class="fa fa-whatsapp"></i></a></li>
													<li><a href="https://www.tumblr.com/share/link?url=http%3A//'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'" target="_blank" class="tumblr" data-toggle="tooltip" data-trigger="hover" data-title="Tumblr" data-placement="top"><i class="fa fa-tumblr"></i></a></li>
												</ul>
											</div>
											<!-- END product-social -->
											</div>
										</div>
										<!-- END product-info -->
									</div>
									</div>
									<!-- END product-detail -->
									<div class="event-product-tab">
										<ul id="event-product-tab" class="nav nav-tabs">
											<li class="active"><a href="#product-desc" data-toggle="tab">Event Description</a></li>
											<li class=""><a href="#product-info" data-toggle="tab">Additional Information</a></li>
											<li class=""><a href="#direction-info" data-toggle="tab">Get Directions</a></li>
										</ul>
										<div id="event-product-tab-content" class="tab-content">
											<div class="tab-pane fade active in" id="product-desc">
												<div class="event-product-desc"> 	
													'.$event->description.'
												</div>
												<div class="event-product-desc">	
													<div class="row">
														<div class="">
															<br>
															<div class="widget">
																<h4 class="red-text">Map</h4>
															</div>
															<div id="map_canvas" style="width:100%; height:350px;"></div>
															<br>
														</div>
													</div>
													<div class="row">
														<div class="">
															<div class="widget">
																<h4 class="red-text">Location (Street View)</h4>
															</div>
															<div id="pano" style="width:100%; height:350px;"></div>
														</div>
													</div>                                    
												</div>
											</div>
											<div class="tab-pane fade" id="product-info">
												<div class="event-product-desc">
													<h4>Event Location: '.$event->location.'</h4>
													<div class="event-date"><div class="event-datename">Date:</div> <p>'.date('d M Y',strtotime($event->start_date)).' to '.date('d M Y',strtotime($event->end_date)).'</p></div>
													<div class="event-date"><div class="event-datename">Time:</div> <p>'.$event->start_time.' - '.$event->end_time.'</p></div>
												</div>
											</div>
											<div class="tab-pane fade" id="direction-info">
												<div class="event-product-directions">
													<div   id="itemMap" class="col-md-12 event-product-mapdirections">
														<div style="background:#00acac !important;padding:20px;">
															<div class="widget">
																<h2 class="white-text"><i class="fa fa-map-marker" aria-hidden="true"></i> Get Directions</h2>
															</div>
															<form action="https://maps.google.com/maps" method="get" target="_blank" class="form-horizontal">
															   <label class="white-text" for="saddr">Enter your location:</label>
															   <input type="text" class="form-control" name="saddr" style="margin-bottom:10px;"/>
															   <input type="hidden" name="daddr" value="'.$event->location.'" />
															   <input type="submit" class="btn btn-xs btn-white" value="Get directions"style="font-size:16px !important;font-weight:bold !important;"  />
															</form>
														</div>
													</div>
												</div>
											</div>
											<!-- END #product-info -->
										</div>
										<!-- END #product-tab-content -->
									</div>
									<!-- END product-tab -->
								</div>
								<!-- END product -->
						</div>
					</div>
				</div>
				<!-- Modal -->
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document" style="margin-top:100px;">
						<div class="modal-content bookingevents-model-space">
							<form id="bookForm" name="" method="get" data-parsley-validate="true" action="'.base_url('booking_events/event_checkout').'" class="" style="margin-bottom:0">
								<div class="modal-header bookingevents-model-top-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title text-center" id="myModalLabel">Event Registration</h4>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-md-12">';
										if($event->end_date >= date('Y-m-d',time())){
											$output .='
											<h4>Event Booking Ends on '.date('d-m-Y',strtotime($event->end_date)).'</h4>';
											if($event->voucher_discount == 'yes'){
												$output .='
												<div class="row booking-voucher-area" id="vc">
													<div class="col-md-5">
														<p id="vctext" class="booking-code">Enter Voucher Code:</p>
													</div>
													<div class="col-md-7">
														<input type="text" name="voucher_code" id="voucherCode" value="" class="form-control col-md-3" style="animation-duration:1s" />
													</div>
												</div>';
											}
											$output .='
											<div class="well well-lg bookingevents-model-side-bar">
												<div class="row">
													<div class="col-md-9">
														<label class="control-label booking-title" for="tickets">'.ucfirst($event->name).'</label>';
														if($event->price > 0){
																$price = $event->price + $vat;
																$earlyDiscountPrice = 0;
																$earlydiscount = $event->earlydiscount->get();
																if($earlydiscount->exists()){
																	$discountType = $event->earlydiscount->get()->price_opt;
																	$num = $event->earlydiscount->get()->num_days;
																	$endTime = strtotime($event->end_date);
																	$earlyDiscountEndTime = strtotime($event->end_date.' -'.$num.'days');
																	if($earlyDiscountEndTime <= $endTime){
																		$earlyDiscountPrice = $event->earlydiscount->get()->price;
																		if($discountType == 'percent'){
																			$discountAmount = ($event->price * $earlyDiscountPrice) / 100;
																			$vat = (($event->price - $discountAmount) * $event->vat) / 100;
																		}
																		if($discountType == 'flat'){
																			$discountAmount = $earlyDiscountPrice;
																			$vat = (($event->price - $discountAmount) * $event->vat) / 100;
																		}
																		$price = ($event->price - $discountAmount) + $vat;
																	}
																}
															$output .='<br/>';
															if($earlydiscount->exists()){
																$output .='
																<span id="discountContainer">
																	Regular Price: '.str_replace('$', '&#36;',$currency->symbol). number_format(($event->price + $event->vat),2).' <small style="font-size: 45%;">incl. VAT @ '.$event->vat.'%</small><br/>';
																	if($discountType == 'percent'){
																		$output .='Early Discount: -'.$earlyDiscountPrice.'%<br/>';
																	}else{
																		$output .='Early Discount: -'.str_replace('$', '&#36;',$currency->symbol).$earlyDiscountPrice.'<br/>';
																	}
																$output .='
																</span>';
															}else{
																$output .='<span id="discountContainer"></span>';
															}
															$output .='
															<div id="finalPrice" class="booking-price">												
																'.str_replace('$', '&#36;',$currency->symbol).'<span id="updateTotal">'.number_format($price,2).'</span> <small style="font-size: 45%;">incl. VAT @ '.$event->vat.'%</small>
																<input id="finalAmount" type="hidden" name="amount" value="'.$price.'" />
															</div>';
														}else{
															$vat = 0;
															$price = 0;
															$output .='
															<input id="finalAmount" type="hidden" name="amount" value="'.$price.'" />
															<div class="price" style="margin-top:0;">FREE</div>';
														}
													$output .='
													</div>
													<div class="col-md-3">
														<input type="hidden" name="event_id" value="'.$event->id.'" />
														<input type="hidden" name="date" value="'.$event->start_date.'" />
														<input type="number" class="form-control" name="tickets" id="tickets" min="1" value="1" required />
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<span id="categs" style="color:red;font-size:18px;"></span>
											</div>';
										}else{
											$output .= '<h2 class="text-center"><i class="fa fa-info-circle"></i> Event ended on '.date('d-m-Y',strtotime($event->end_date)).'</h2>';
										}
										$output .='
										</div>
									</div>
								</div>
								<div class="modal-footer">';
								if($event->end_date >= date('Y-m-d',time())){
									$output .='
									<button type="button" class="btn btn-lg btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
									<button id="submit" type="submit" class="btn btn-lg btn-success"><i class="fa fa-check"></i> Checkout</button>
									';
								}
								$output .='
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- End Modal -->';
				$google_maps_api_key = $CI->BuilderEngine->get_option('google_maps_api_key');
				if(!isset($google_maps_api_key) || $google_maps_api_key == '')
					$google_maps_api_key = 'AIzaSyAyoLgzKTuHntTdtYN1vnA68ZvSfANoWJc';
				$output .='
				<script type="text/javascript" src="https://maps.google.com/maps/api/js?key='.$google_maps_api_key.'"></script>
				<script type="text/javascript" src="'.base_url('blocks/booking_events_event/custom.js').'"></script>
				';
				$voucher = new Booking_event_voucher();
				$voucher = $voucher->where('event_id',$event->id)->get();
				if($voucher->exists()){
					$output .='
					<script>
				   $("#voucherCode").keyup(function(event){
						var code = "'.$voucher->code.'";';
					if($early_discount->exists()){
							$price = $event->price + $vat;
							$earlyDiscountPrice = 0;
							$earlydiscount = $event->earlydiscount->get();
							if($earlydiscount->exists()){
								$discountType = $event->earlydiscount->get()->price_opt;
								$num = $event->earlydiscount->get()->num_days;
								$endTime = strtotime($event->end_date);
								$earlyDiscountEndTime = strtotime($event->end_date.' -'.$num.'days');
								if($earlyDiscountEndTime <= $endTime){
									$earlyDiscountPrice = $event->earlydiscount->get()->price;
									if($discountType == 'percent'){
										$discountAmount = ($event->price * $earlyDiscountPrice) / 100;
										$vat = (($event->price - $discountAmount) * $event->vat) / 100;
									}
									if($discountType == 'flat'){
										$discountAmount = $earlyDiscountPrice;
										$vat = (($event->price - $discountAmount) * $event->vat) / 100;
									}
									$price = ($event->price - $discountAmount) + $vat;
								}else{
									$discountAmount = 0;
								}
							}
						$output .='
						var earlyDiscountAmount = "'.$discountAmount.'";
							earlyDiscountAmount = parseFloat(earlyDiscountAmount);';
					}else{
						$output .='
						var earlyDiscountAmount = 0;';
					}
						$output .='
						var eventPrice = "'.$event->price.'";
							eventPrice = parseFloat(eventPrice);
						var vat = "'.$event->vat.'";
							vat = parseFloat(vat);
						var voucherDiscount = "'.$voucher->price.'";
							voucherDiscount = parseFloat(voucherDiscount);';
							$voucherDiscountAmount = ($voucher->price_opt == 'percent')?((($event->price - $discountAmount) * $voucher->price) / 100):$voucher->price;
						$output .='
						var voucherDiscountAmount = "'.$voucherDiscountAmount.'";
							voucherDiscountAmount = parseFloat(voucherDiscountAmount);
						var voucherType = "'.$voucher->price_opt.'";
						var currency = "'.str_replace('$', '&#36;',$currency->symbol).'";
						var curr_val = this.value;
						var i = 1;
						if(code == this.value){
							$(this).off();
							$("#voucherCode").addClass("animated flash");
							$("#voucherCode").css("border","3px solid #00acac");
							$("#voucherCode").attr("readonly","readonly");
							$("#vc").css("border","3px dashed #00acac");
							$("#vctext").html("Code Validated <i class=\"fa fa-check-circle\" style=\"color:#00acac\"></i>");
							var vatAmount = ((eventPrice - (earlyDiscountAmount + voucherDiscountAmount)) * vat) / 100;
								vatAmount = parseFloat(vatAmount);
							var updateTotal = ((eventPrice -(voucherDiscountAmount + earlyDiscountAmount)) + vatAmount);
								updateTotal = parseFloat(updateTotal);
							if(i == 1){
								if(voucherType == "flat")
									$("#discountContainer").append("Voucher Discount: -" + currency + voucherDiscount.toFixed(2));
								else
									$("#discountContainer").append("Voucher Discount: -" + voucherDiscount.toFixed(2) + "%");
							}
							$("#updateTotal").text(updateTotal.toFixed(2));
							$("#updateTotal").css("color","green");
							$("#finalAmount").val(updateTotal.toFixed(2));
							console.log("earlydiscountamount:"+earlyDiscountAmount.toFixed(2));
							console.log("vatAmount:"+vatAmount.toFixed(2));
							console.log("voucherDiscountAmount" + voucherDiscountAmount.toFixed(2));
							console.log("finalAmount:" + updateTotal.toFixed(2));
							i++;
						}else{
							$("#vctext").html("Wrong code <i class=\"fa fa-times\" style=\"color:red\"></i>");
						}
				   });
				</script>';
				}
				$output .= '
			</div>';
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'booking-events-event-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output.$this->apply_custom_css();
	}
}
?>