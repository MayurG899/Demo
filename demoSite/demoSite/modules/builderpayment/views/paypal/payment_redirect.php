<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        document.getElementById("paypal_form").submit();
    });
</script>
<?php
$encoded_settings = $this->BuilderEngine->get_option('be_builderpayment_paypal_settings');
$settings = json_decode($encoded_settings);
$sandbox = '';
if(!empty($settings)){
	if($settings->sandbox == 1){
		$sandbox = 'sandbox.';
	}
}
$currency = new Currency($order->currency);
?>
<link href="<?=base_url('builderengine/public/css/bootstrap.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('builderengine/public/css/font-awesome.css')?>" rel="stylesheet" type="text/css" />
<div class="container">
	<div class="content" style="margin-top:200px;"><br/><br/><br/>
		<h2 class="text-center"><i class="fa fa-cog fa-spin" style="font-size:72px;color:#1ed7d1"></i></h2><br/>
		<h3 class="text-center">Please wait, we are redirecting you to the payment gateway...</h3>
		<form action="https://www.<?=$sandbox?>paypal.com/cgi-bin/webscr" method="post" id="paypal_form">

			<?php /* Config for sending multiple cart items to paypal's external checkout */ ?>
            <input type="hidden" name="cmd" value="_cart">
            <input type="hidden" name="upload" value="1">
            <input name="business" type="hidden" value="<?=$settings->paypal_address?>">
            <input name="currency_code" type="hidden" value="<?=$currency->signature?>">

			<?php /* Add each cart item to form */ ?>
            <?php $i = 1; ?>
            <?php foreach($order->product->get() as $product):?>
				<input name="item_name_<?=$i?>" type="hidden" value="<?=$product->name?>">
				<input name="amount_<?=$i?>" type="hidden" value="<?=$product->price?>">
				<input name="quantity_<?=$i?>" type="hidden" value="<?=$product->quantity?>">
				<?php $i++; ?>
			<?php endforeach?>

			<?php /* Instant Payment Notification config */ ?>
            <input name="return" type="hidden" value="<?=base_url('builderpayment/order_success')?>">
            <input name="cancel_return" type="hidden" value="<?=base_url('builderpayment/order_canceled/'.$order->id)?>">
            <input name="notify_url" type="hidden" value="<?=base_url('builderpayment/paypalgateway/ipn')?>">

			<?php /* Additional settings */ ?>
			<input type="hidden" name="no_shipping" value="1">
            <input name="custom" type="hidden" value="<?=$order->id?>">
		</form>
	</div>
</div>
