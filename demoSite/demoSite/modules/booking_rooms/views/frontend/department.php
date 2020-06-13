<link href="<?=base_url('modules/booking_rooms/assets/css/owl.carousel.css')?>" rel="stylesheet">
<link href="<?=base_url('modules/booking_rooms/assets/css/owl.theme.css')?>" rel="stylesheet">
<style>

</style>
<div class="container bookingrooms-top-padding bookingrooms-style">
	<div class="row">
		<div class="col-md-6 col-sm-6 event-calendar-1">
			<?
			$owner = new User($department->user_id);
			$category = new BookingRoomCategory($department->category_id);
			$currency = new Currency($department->currency_id);
			?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="panel bookingrooms-header-dark">
						<div class="panel-heading navbar-user-box"><img src="<?=checkImagePath($owner->avatar)?>"> Admin Manager <br> <div class="text-grey">Meeting Room Provider</div></div>
						<div class="panel-body bookingrooms-panel-body-white">
							<h4>Meeting Room Details:</h4>
							<p><b>Room Name:</b> <?=$department->name?></p>
							<p><b>Department:</b> <?=$category->name?></p>
							<p><b>Capacity:</b> <?=$department->capacity?></p>
							<p><b>Available Days:</b> <?=$department->available_days?></p>
							<p><b>Booking Time Start:</b> <?=$department->start_time?></p>
							<p><b>Booking Time End:</b> <?=$department->end_time?></p>
							<p><b>Description:</b> <?=$department->description?></p>
							</p>

                        </div>
                    </div>
			</div>
		</div>
		<div class="col-md-6 col-sm-6 event-calendar-1">
			<div style="height:35px;">
				<div class="pull-left">
					
				</div>
				<div class="pull-right event-logins">
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
			</div>
			<?if($department->additional_image->count() > 0):?>
				<div id="owl-images" class="owl-carousel owl-theme">
					<?foreach($department->additional_image->get() as $image):?>
						<div class="item">
							<a href="<?=base_url('booking_rooms/department/'.$image->slug)?>">
								<img class="img-responsive" src="<?=$image->url?>" style="max-height:450px" alt="">
							</a>
						</div>
					<?endforeach;?>
				</div>
			<?else:?>
				<img src="<?=$department->image?>" class="img-responsive" style="max-height:450px" />
			<?endif;?>
			<br/>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="panel bookingrooms-header-dark">
					<div class="panel-body bookingrooms-panel-body-white">
						<h4>Booking Price Details:</h4>
							<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<p><b>Price Per Minute:</b></p>
							</div>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
							<div class="bookingrooms-event-product-price"><div class="bookingrooms-event-price label label-success"><?=$currency->symbol?><?=$price_vat = $department->price + (($department->price * $department->vat)/ 100);?> <small style="font-size: 55%;">incl. VAT @ <?=$department->vat?>%</small></div></div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bookingrooms-booking-price-hr">
							<hr>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<p><b>Price Per Hour:</b></p>
							</div>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
							<div class="bookingrooms-event-product-price"><div class="bookingrooms-event-price label label-success"><?=$currency->symbol?><?=$price_vat_per_hr = ($department->price + (($department->price * $department->vat)/ 100)) * 60;?> <small style="font-size: 55%;">incl. VAT @ <?=$department->vat?>%</small></div></div>
							</div>
							<div class="bookingrooms-department-booknow-area"><a href="<?=base_url('booking_rooms/calendar?room='.$department->id)?>" class="btn btn-lg btn-success bookingrooms-department-booknow">BOOK THIS ROOM</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?=base_url('modules/booking_rooms/assets/js/owl.carousel.min.js')?>"></script>
<script>
$(document).ready(function(){
    var secondRow = $("#owl-images");
    secondRow.owlCarousel({
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