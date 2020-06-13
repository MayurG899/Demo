	<script>
		$(document).ready(function (){
			$( "#paypal_form" ).submit();
		});
	</script>

	<div class="container">
		<div class="content">
			<h2 style="text-align:center">Please wait, we are redirecting you to the payment gateway...</h2>
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="paypal_form">

		    <input name="amount" type="hidden" value="<?=$order->order_price?>">
		    <input name="currency_code" type="hidden" value="<?=$symbol?>">
		    <input name="return" type="hidden" value="<?=base_url()."ecommerce/order_completed/".$order->id?>">
		    <input name="cancel_return" type="hidden" value="<?=base_url()."ecommerce/order_completed/".$order->id?>">
		    <input name="notify_url" type="hidden" value="<?=base_url()."ecommerce/paypal/ipn"?>">
		    <input name="cmd" type="hidden" value="_xclick">
		    <input name="business" type="hidden" value="">
		    <input name="item_name" type="hidden" value="Order #<?=$order->id?>">
		    <input type="hidden" name="no_shipping" value="1">

		    <input name="custom" type="hidden" value="<?=$order->id?>">
		    
		    </form>
		</div>
	</div>