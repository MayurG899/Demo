<div class="container event-top-padding">
	<div class="row">
		<div class="event-topbar">
			<div class="pull-right event-logins">
				<a href="<?=base_url('booking_events/events')?>" type="button" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> View More Events</a>
				<?if(!$this->user->is_logged_in()):?>
					<?if($booking_permission == 'no'):?>
						<a href="<?=base_url('user/main/userLogin')?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-sign-in"></i> Sign In</a>
						<a href="<?=base_url('user/registration/index')?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-users"></i> Create Account</a>
					<?endif;?>
				<?else:?>
					<?if($booking_permission == 'no'):?>
						<a href="<?=base_url('user/main/dashboard')?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-user"></i> My Dashboard</a>
						<a href="<?=base_url('user/main/logout')?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-sign-out"></i> Logout</a>
					<?endif;?>
				<?endif;?>
			</div>
			<div class="pull-left event-price-1">
				<h1 class="event-product-title"><?=ucfirst($event->name);?></h1>
			</div>
		</div>
		<div class="event-container" style="margin-bottom:20px;">
                <!-- BEGIN product -->
                <div class="event-product">
                    <!-- BEGIN product-detail -->
                    <div class="event-product-detail">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 event-column-1">
                        <!-- BEGIN product-image -->
                        <div class="event-product-image event-image-1">
                            <!-- BEGIN product-thumbnail -->
                            <div class="event-product-thumbnail">
                                <ul class="event-product-thumbnail-list">
									<?$images = $event->additional_image->get();?>
									<li class="active"><a href="#" data-click="show-main-image" data-url="<?=checkImagePath($event->image)?>"><img src="<?=checkImagePath($event->image)?>" alt="" /></a></li>
									<?if($images->exists()):?>
										<?foreach($images as $image):?>
											<li><a href="#" data-click="show-main-image" data-url="<?=checkImagePath($image->url)?>"><img src="<?=checkImagePath($image->url)?>" alt="" /></a></li>
										<?endforeach?>
									<?endif;?>
                                </ul>
                            </div>
                            <!-- END product-thumbnail -->
                            <!-- BEGIN product-main-image -->
                            <div class="event-product-main-image" data-id="main-image">
                                <img src="<?=checkImagePath($event->image)?>" alt="" />
                            </div>
                            <!-- END product-main-image -->
                        </div>
                        <!-- END product-image -->
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 event-column-2">
                        <!-- BEGIN product-info -->
                        <div class="event-product-info event-info-1">
							
							<input type="hidden" name="id" value="<?=$event->slug?>" />
							<input type="hidden" name="object" value="event" />
							<?$currency = new Currency($event->currency_id);?>
                            
							<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 event-column-3">
							<!-- BEGIN product-info-header -->
                            <div class="event-product-info-header">
								<h1 class="event-product-title"><?=ucfirst($event->name);?></h1>
								<?
									$early_discount = $event->earlydiscount->get();
									$group_discount = $event->groupdiscount->get();
									$usergroup_discount = $event->usergroupdiscount->get();
									$addon_service = $event->addonservice->get();
								?>
									<?if($early_discount->exists()):?>
										<span class="label label-success">Early Discount <?$symbol = ($early_discount->price_opt == 'percent')?'':$currency->symbol;?><?=$symbol.$early_discount->price?><?if($early_discount->price_opt == 'percent')echo '%';?> OFF</span>
									<?endif;?>
									<?if($group_discount->exists()):?>
										<span class="label label-success"><?=ucfirst($group_discount->name)?> Discount <?$symbol = ($group_discount->price_opt == 'percent')?'':$currency->symbol;?><?=$symbol.$group_discount->price?><?if($group_discount->price_opt == 'percent')echo '%';?> OFF</span>
									<?endif;?>
									<?if($usergroup_discount->exists()):?>
										<span class="label label-success"><?=ucfirst($usergroup_discount->usergroup_name)?> Usergroup Discount <?$symbol = ($usergroup_discount->price_opt == 'percent')?'':$currency->symbol;?><?=$symbol.$usergroup_discount->price?><?if($usergroup_discount->price_opt == 'percent')echo '%';?> OFF</span>
									<?endif;?>
									<?if($addon_service->exists()):?>
										<span class="label label-danger"><?=ucfirst($addon_service->name)?> <?$symbol = ($addon_service->price_opt == 'percent')?'':$currency->symbol;?><?=$symbol.$addon_service->price?><?if($addon_service->price_opt == 'percent')echo '%';?> +</span>
									<?endif;?>
									
							
							<!-- BEGIN product-purchase-container -->
                            <div class="event-product-purchase-container buynow-1">
                                <div class="event-product-discount">
                                    <!--<span class="discount">$869.00</span>-->
                                </div>
                                <div class="event-product-price">
									<?if($event->price > 0):?>
										<?if($early_discount->exists()):?>
											<?if($early_discount->price_opt == 'flat'):?>
												<?$vat = (($event->price - $early_discount->price) * $event->vat) / 100;?>
												<div class="event-price label label-success"><?=$currency->symbol?><?=number_format((($event->price - $early_discount->price) + $vat),2)?> <small style="font-size: 45%;">incl. VAT @ <?=$event->vat?>%</small></div>
											<?else:?>
												<?
													$discount = ($event->price * $early_discount->price) / 100;
													$vat = (($event->price - $discount) * $event->vat) / 100;
												?>
												<div class="event-price label label-success"><?=$currency->symbol?><?=number_format((($event->price - $discount) + $vat),2)?> <small style="font-size: 45%;">incl. VAT @ <?=$event->vat?>%</small></div>
											<?endif;?>
										<?else:?>
											<?$vat = ($event->price * $event->vat) / 100;?>
											<div class="event-price label label-success"><?=$currency->symbol?><?=number_format(($event->price + $vat),2)?> <small style="font-size: 45%;">incl. VAT @ <?=$event->vat?>%</small></div>
										<?endif;?>
									<?else:?>
										<div class="event-price label label-success">EVENT PRICE: FREE</div>
									<?endif;?>
								</div>
								<div class="event-product-buynow">
								<?if($this->user->is_logged_in()):?>
									<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-check"></i> Book Now</button>
								<?else:?>
									<?if($booking_permission == 'yes'):?>
										<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-check"></i> Book Now</button>
									<?else:?>
										<a class="btn btn-primary btn-lg" href="<?=base_url('user/registration/index');?>"><i class="fa fa-check"></i> Book Now</a>
									<?endif;?>
								<?endif;?>
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
                            
							<!-- BEGIN product-purchase-container -->
							<?/*
                            <div class="event-product-purchase-container buynow-2">
                                <div class="event-product-discount">
                                    <!--<span class="discount">$869.00</span>-->
                                </div>
                                <div class="event-product-price">
									<?$vat = ($event->price * $event->vat) / 100;?>
									<?if($event->price > 0):?>
										<div class="event-price label label-success"><?=$currency->symbol?><?=number_format(($event->price + $vat),2)?> <small style="font-size: 45%;">incl. VAT @ <?=$event->vat?>%</small></div>
									<?else:?>
										<div class="event-price label label-success">EVENT PRICE: FREE</div>
									<?endif;?>
								</div>
								<div class="event-product-buynow-2">
								<?if($this->user->is_logged_in()):?>
									<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-check"></i> Book Now</button>
								<?endif;?>
								</div>
                            </div>
							*/?>
                            <!-- END product-purchase-container -->
							
							<!-- BEGIN event-date -->
							<div class="event-date"><div class="event-datename">Date:</div> <p><?=date('d M Y',strtotime($event->start_date))?> to <?=date('d M Y',strtotime($event->end_date))?></p></div>
							<div class="event-date"><div class="event-datename">Time:</div> <p><?=$event->start_time?> - <?=$event->end_time?></p></div>
							<?if($event->show_capacity == 'yes'):?>
								<div class="event-date event-capacity-1"><div class="event-datename">Capacity:</div> <p><span id="capacity"><?=$event->capacity - $event->booked?></span> Tickets Remaining</p></div>
							<?endif;?>
							<!-- BEGIN product-warranty -->
                            <div class="event-product-warranty">
                                <div class="pull-right maptext"><p><a href="#event-product-tab-content"> <i class="fa fa-map-marker" style="color:red;"></i> Map</a></p></div>
                                <div><div class="event-datename">Location:</div><p><span id="addressCoordinates"><?=$event->location?></span></p></div>
                            </div>
                            <!-- END product-warranty -->							
							
							<div class="event-product-buynow-3">
								<?if($this->user->is_logged_in()):?>
									<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-check"></i> Book Now</button>
								<?else:?>
									<a class="btn btn-primary btn-lg" href="<?=base_url('user/registration/index');?>"><i class="fa fa-check"></i> Book Now</a>
								<?endif;?>
							</div>
							<!-- BEGIN product-social -->	
                            <div class="event-product-social">
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
                                <div class="event-product-desc" style="word-break: break-word;"> 	
									<?=$event->description?>
                                </div>
                                <div class="event-product-desc" style="word-break: break-word;">	
									<div class="row">
										<div class="col-md-12">
											<br>
											<div class="widget">
												<h2 class="red-text">Map</h2>
											</div>
											<div id="map_canvas" style="width:100%; height:350px;"></div>
											<br>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="widget">
												<h2 class="red-text">Location (Street View)</h2>
											</div>
											<div id="pano" style="width:100%; height:350px;"></div>
										</div>
									</div>                                    
                                </div>
                            </div>
                            <div class="tab-pane fade" id="product-info">
								<div class="event-product-desc">
									<h4>Event Location: <?=$event->location?></h4>
									<div class="event-date"><div class="event-datename">Date:</div> <p><?=date('d M Y',strtotime($event->start_date))?> to <?=date('d M Y',strtotime($event->end_date))?></p></div>
									<div class="event-date"><div class="event-datename">Time:</div> <p><?=$event->start_time?> - <?=$event->end_time?></p></div>
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
											   <input type="hidden" name="daddr" value="<?=$event->location?>" />
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
	<div class="row">
		<h3>Upcoming Events</h3>
		<div class="col-md-12">
			<?  $events = new Block('booking_events_upcoming_events');
				$events->set_type('booking_events_upcoming_events');
				$events->show();
			?>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document" style="margin-top:100px;">
		<div class="modal-content">
			<form id="bookForm" name="" method="get" data-parsley-validate="true" action="<?=base_url('booking_events/event_checkout')?>" class="" style="margin-bottom:0">
				<div class="modal-header" style="background:#ccc;border-top-left-radius:5px;border-top-right-radius:5px;">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title text-center" id="myModalLabel">Event Registration</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<h4>Event Booking Ends on <?=date('d-m-Y',strtotime($event->end_date))?></h4>
							<?if($event->voucher_discount == 'yes'):?>
								<div class="row booking-voucher-area" id="vc">
									<div class="col-md-5">
										<p id="vctext" class="booking-code">Enter Voucher Code:</p>
									</div>
									<div class="col-md-7">
										<input type="text" name="voucher_code" id="voucherCode" value="" class="form-control col-md-3" style="animation-duration:1s" />
									</div>
								</div>
							<?endif;?>
							<div class="well well-lg" style="border-left:15px solid #00acac;margin-top:10px">
								<div class="row">
									<div class="col-md-9">
										<label class="control-label booking-title" for="tickets"><?=ucfirst($event->name);?></label>
										<?if($event->price > 0):?>		
											<?  
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
											?><br/>
											<?if($earlydiscount->exists()):?>
												<span id="discountContainer">
													Regular Price: <?=$currency->symbol?><?=number_format(($event->price + $event->vat),2)?> <small style="font-size: 45%;">incl. VAT @ <?=$event->vat?>%</small><br/>
													<?if($discountType == 'percent'):?>
														Early Discount: -<?=$earlyDiscountPrice?>%<br/>
													<?else:?>
														Early Discount: -<?=$currency->symbol?><?=$earlyDiscountPrice?><br/>
													<?endif;?>
												</span>
											<?else:?>
												<span id="discountContainer"></span>
											<?endif;?>
											<div id="finalPrice" class="booking-price">												
												<?=$currency->symbol?><span id="updateTotal"><?=number_format($price,2);?></span> <small style="font-size: 45%;">incl. VAT @ <?=$event->vat?>%</small>
												<input id="finalAmount" type="hidden" name="amount" value="<?=$price?>" />
											</div>
										<?else:?>
											<div class="price" style="margin-top:0;">FREE</div>
										<?endif;?>
									</div>
									<div class="col-md-3">
										<input type="hidden" name="event_id" value="<?=$event->id?>" />
										<input type="hidden" name="date" value="<?=$event->start_date?>" />
										<input type="number" class="form-control" name="tickets" id="tickets" min="1" value="1" required />
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<span id="categs" style="color:red;font-size:18px;"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-lg btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
					<button id="submit" type="submit" class="btn btn-lg btn-success"><i class="fa fa-check"></i> Checkout</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- End Modal -->
<script>
    $('[data-click="show-main-image"]').click(function(e) {
        e.preventDefault();
        
        var targetContainer = '[data-id="main-image"]';
        var targetImage = '<img src="'+ $(this).attr('data-url') +'" />';
        var targetLi = $(this).closest('li');
        
        $(targetContainer).html(targetImage);
        $(targetLi).addClass('active');
        $('[data-click="show-main-image"]').closest('li').not(targetLi).removeClass('active');
    });
</script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js"></script>
<script type="text/javascript">
  var geocoder;
  var map;
  var address = document.getElementById("addressCoordinates").innerHTML;
function initialize() {
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(53.272393, -9.048774);
  var myOptions = {
	zoom: 18,
	center: latlng,
	mapTypeControl: true,
	mapTypeControlOptions: {
	  style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
	},
	navigationControl: true,
	mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
  if (geocoder) {
	geocoder.geocode({
	  'address': address
	}, function(results, status) {
	  if (status == google.maps.GeocoderStatus.OK) {
		if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
		  map.setCenter(results[0].geometry.location);

		  var infowindow = new google.maps.InfoWindow({
			content: '<b>' + address + '</b>',
			size: new google.maps.Size(150, 50)
		  });

		  var marker = new google.maps.Marker({
			position: results[0].geometry.location,
			map: map,
			title: address
		  });
		  google.maps.event.addListener(marker, 'click', function() {
			infowindow.open(map, marker);
		  });
			var panorama = new google.maps.StreetViewPanorama(
				document.getElementById('pano'), {
				  position: results[0].geometry.location,
				  pov: {
					heading: 34,
					pitch: 10
				  }
				});
			map.setStreetView(panorama);
		} else {
		  alert("No results found");
		}
	  } else {
		  var latlng = new google.maps.LatLng(53.272393, -9.048774);
			var panorama = new google.maps.StreetViewPanorama(
				document.getElementById('pano'), {
				  position: latlng,
				  pov: {
					heading: 34,
					pitch: 10
				  }
				});
			map.setStreetView(panorama);
		
		console.log("Geocode was not successful for the following reason: " + status);
	  }
	});
  }
}
google.maps.event.addDomListener(window, 'load', initialize);

$("#bookForm").on("submit", function () {
	var capacity = $("#capacity").text();
		capacity = parseInt(capacity);
	var booked_tickets = $('#tickets').val();
		booked_tickets = parseInt(booked_tickets);console.log(capacity);console.log(booked_tickets);
	if (booked_tickets > capacity) {
		$('#categs').text( "You can book max "+ capacity + " tickets!" ).show().fadeOut(4000);
		return false; 
	}
});
<?
$voucher = new Booking_event_voucher();
$voucher = $voucher->where('event_id',$event->id)->get();
if($voucher->exists()):?>
   $('#voucherCode').keyup(function(event){
		var code = '<?=$voucher->code;?>';
	<?if($early_discount->exists()):?>
		<?  
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
		?>
		var earlyDiscountAmount = '<?=$discountAmount?>';
			earlyDiscountAmount = parseFloat(earlyDiscountAmount);
	<?else:?>
		var earlyDiscountAmount = 0;
	<?endif;?>
		var eventPrice = '<?=$event->price?>';
			eventPrice = parseFloat(eventPrice);
		var vat = '<?=$event->vat;?>';
			vat = parseFloat(vat);
		var voucherDiscount = '<?=$voucher->price?>';
			voucherDiscount = parseFloat(voucherDiscount);
		var voucherDiscountAmount = '<?=$voucherDiscountAmount = ($voucher->price_opt == 'percent')?((($event->price - $discountAmount) * $voucher->price) / 100):$voucher->price;?>';
			voucherDiscountAmount = parseFloat(voucherDiscountAmount);
		var voucherType = '<?=$voucher->price_opt?>';
		var currency = '<?=$currency->symbol?>';
		var curr_val = this.value;
		var i = 1;
		if(code == this.value){
			$(this).off();
			$('#voucherCode').addClass('animated flash');
			$('#voucherCode').css('border','3px solid #00acac');
			$('#voucherCode').attr('readonly','readonly');
			$('#vc').css('border','3px dashed #00acac');
			$('#vctext').html('Code Validated <i class="fa fa-check-circle" style="color:#00acac"></i>');
			var vatAmount = ((eventPrice - (earlyDiscountAmount + voucherDiscountAmount)) * vat) / 100;
				vatAmount = parseFloat(vatAmount);
			var updateTotal = ((eventPrice -(voucherDiscountAmount + earlyDiscountAmount)) + vatAmount);
				updateTotal = parseFloat(updateTotal);
			if(i == 1){
				if(voucherType == 'flat')
					$('#discountContainer').append('Voucher Discount: -' + currency + voucherDiscount.toFixed(2));
				else
					$('#discountContainer').append('Voucher Discount: -' + voucherDiscount.toFixed(2) + '%');
			}
			$('#updateTotal').text(updateTotal.toFixed(2));
			$('#updateTotal').css('color','green');
			$('#finalAmount').val(updateTotal.toFixed(2));
			console.log('earlydiscountamount:'+earlyDiscountAmount.toFixed(2));
			console.log('vatAmount:'+vatAmount.toFixed(2));
			console.log('voucherDiscountAmount' + voucherDiscountAmount.toFixed(2));
			console.log('finalAmount:' + updateTotal.toFixed(2));
			i++;
		}else{
			$('#vctext').html('Wrong code <i class="fa fa-times" style="color:red"></i>');
		}
   });
<?endif;?>
</script>