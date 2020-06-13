<div class="container" style="margin-top:150px;">
	<div class="row">
		<div class="col-md-12" style="min-height:400px;">
			<div class="alert alert-danger"><br/>
				<?if($order):?>
					<?$currency = new Currency($order->currency);?>
					<h3 class="text-center"> Unfortunately, your order (<?=$currency->symbol.number_format($order->gross,2)?>) has been canceled!</h3><br/>
					<p class="text-center"><i class="fa fa-info-circle" style="font-size:48px;color:blue"></i></p><br/>
				<?else:?>
					<h3 class="text-center">Unfortunately, your order has been canceled!</h3>
					<p class="text-center"><i class="fa fa-info-circle" style="font-size:48px;color:blue"></i></p><br/>
				<?endif;?>
				<div class="text-center">
					<a href="<?=base_url('user/main/dashboard')?>" class="text-center btn btn-lg btn-primary"><i class="fa fa-arrow-left"></i> Back to Dashboard </a>
				</div>
			</div>
		</div>
	</div>
</div>