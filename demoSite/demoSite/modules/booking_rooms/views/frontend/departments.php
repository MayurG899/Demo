<link href="<?=base_url('modules/booking_rooms/assets/css/owl.carousel.css')?>" rel="stylesheet">
<link href="<?=base_url('modules/booking_rooms/assets/css/owl.theme.css')?>" rel="stylesheet">
<style>

</style>
<div class="container event-top-padding">
	<div class="row">
		<div class="col-md-12 col-sm-12 event-calendar-1">
			<div style="height:35px;">
				<div class="pull-left">
					breadcrumbs
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
			<?if($rooms->exists()):?>
				<div id="owl-rooms" class="owl-carousel owl-theme">
					<?foreach($rooms as $room):?>
						<?if($room->active == 'yes'):?>
							<div class="item" style="border-left:20px solid #000;border-top-left-radius:10px;border-bottom:10px solid #000;border-bottom-left-radius:10px;">
								<a href="<?=base_url('booking_rooms/department/'.$room->slug)?>">
									<?if($room->featured == 'yes'):?>
										<h1 style="position:absolute;top:0;background:#000;color:#fff;padding:10px;border-bottom-right-radius:10px;">
											<span><?=$room->name?></span>
										</h1>
									<?else:?>
										<h2 style="position:absolute;top:0;background:#000;color:#fff;padding:10px;border-bottom-right-radius:10px;">
											<span><?=$room->name?></span>
										</h2>
									<?endif;?>
									<div class="<?if($room->featured == 'yes')echo 'animated flash infinite';?>" style="position:absolute;top:150;background:#000;color:#fff;padding:10px;animation-duration:2.5s;border-left:20px solid #000;border-top-left-radius:10px;border-bottom-right-radius:10px;" class="<?if($room->featured == 'yes')echo 'animated slideInLeft';?>">
										<?$currency = new Currency($room->currency_id);?>
										<span style="<?if($room->featured == 'yes')echo 'font-size:24px;';?>">
											<?if($room->price == 0):?>
												<strong>FREE</strong>
											<?else:?>
												<strong><?=$currency->symbol?><?=$price = $room->price * 60;?></strong> / hr <small>excl. VAT</small>
											<?endif;?>
										</span>
									</div>
									<div style="position:absolute;bottom:0px;background:#000;color:#fff;padding:10px;opacity:0.5">
										<?=$room->description?>
										<p>Available Days: <strong><?=$room->available_days?></strong></p>
									</div>
									<img class="img-responsive" src="<?=$room->image?>" style="max-height:450px" alt="">
								</a>
							</div>
						<?endif;?>
					<?endforeach;?>
				</div>
			<?else:?>
				<h1 class="text-center" style="margin:200px 0"><i class="fa fa-info-circle"></i> No Rooms Created </h1>
			<?endif;?>
		</div>
	</div>
</div>
<script src="<?=base_url('modules/booking_rooms/assets/js/owl.carousel.min.js')?>"></script>
<script>
$(document).ready(function(){
    var secondRow = $("#owl-rooms");
    secondRow.owlCarousel({
        autoPlay: true,
        stopOnHover: true,
        navigation: true,
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