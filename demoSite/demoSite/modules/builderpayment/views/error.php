<div class="container" style="margin-top:150px;">
	<div class="row">
		<div class="col-md-12" style="min-height:400px;">
			<div class="alert alert-danger"><br/>
				<?if($error != ''):?>
					<h1 class="text-center"><i class="fa fa-info-circle"></i> <?=$error?></h1>
				<?endif;?>
				<div class="text-center">
					<a href="<?=base_url('user/wholesale/checkout')?>" class="text-center btn btn-lg btn-theme"><i class="fa fa-arrow-left"></i> Back to Checkout</a>
				</div>
			</div>
		</div>
	</div>
</div>