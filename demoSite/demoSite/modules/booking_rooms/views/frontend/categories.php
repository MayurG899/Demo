<link href="<?=base_url('modules/booking_rooms/assets/css/owl.carousel.css')?>" rel="stylesheet">
<link href="<?=base_url('modules/booking_rooms/assets/css/owl.theme.css')?>" rel="stylesheet">
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
			<?if($categories->exists()):?>
				<div id="owl-categories" class="owl-carousel owl-theme">
					<?foreach($categories as $category):?>
						<div class="item" style="border-left:20px solid #000;">
							<a href="<?=base_url('booking_rooms/departments/'.$category->id)?>">
								<h1 style="position:absolute;top:0;background:#000;color:#fff;margin:20px;padding:10px;">
									<span><?=$category->name?></span>
								</h1>
								<div style="position:absolute;bottom:0px;background:#000;color:#fff;margin:20px;padding:10px;opacity:0.5">
									<?=$category->description?>
								</div>
								<img class="img-responsive" src="<?=$category->image?>" style="max-height:450px" alt="">
							</a>
						</div>
					<?endforeach;?>
				</div>
			<?else:?>
				<h1 class="text-center" style="margin:200px 0"><i class="fa fa-info-circle"></i> No Categories Created </h1>
			<?endif;?>
		</div>
	</div>
</div>
<script src="<?=base_url('modules/booking_rooms/assets/js/owl.carousel.min.js')?>"></script>
<script>
$(document).ready(function(){
    var secondRow = $("#owl-categories");
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