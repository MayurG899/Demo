
<div class="container" style="padding-top:120px;">
	<div class="col-md-12" style="margin-bottom:100px;">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="Pricing-box">
					<div class="price-title spacing-box">
						<h4><?=$membership->name?></h4>
					</div>
					<hr />
					<?
						$currency = new Currency($membership->currency_id);
						if($currency->id == 3)
							$currency->symbol = '&#36;';
					?>
					<div class="spacing-box">
						<div class="price"><span class="price-sm"><?=$currency->symbol?></span><span class="price-lg"><?=number_format($membership->price,2)?></span></div>
						<div class="price-tenure">per year</div>
					</div>
					<hr />
					<div class="pricing-features spacing-grid">
						<?=$membership->description?>
					</div>
					<hr />
					<div class="spacing-grid">
					<?if($membership->questionnaire == 'yes'):?>
						<a href="<?=base_url('booking_memberships/application/'.$membership->id)?>" class="btn btn-md btn-warning">BOOK NOW</a>
					<?else:?>
						<a href="<?=base_url('booking_memberships/checkout/'.$membership->id)?>" class="btn btn-md btn-warning">BOOK NOW</a>
					<?endif;?>
					</div>
				</div>							
			</div>
		</div>
	</div>
</div>