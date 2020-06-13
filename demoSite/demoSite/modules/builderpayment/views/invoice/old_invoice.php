<?php $ship = $order->shippingAddress->get();
$bill = $order->billingAddress->get();
?>
<div style="width:680px">
  <h2>Invoice #<?=$order->id?></h2>
      <table style="border-collapse:collapse;width:100%;border-top:1px solid #dddddd;border-left:1px solid #dddddd;margin-bottom:20px">
    <thead>
      <tr>
        <td style="font-size:12px;border-right:1px solid #dddddd;border-bottom:1px solid #dddddd;font-weight:bold;text-align:left;padding:7px;color:#222222" colspan="2">
			<img src="<?=$this->BuilderEngine->get_option('be_'.$order->module.'_company_logo')?>" width="600px" />
		</td>
      </tr>
      <tr>
        <td style="font-size:12px;border-right:1px solid #dddddd;border-bottom:1px solid #dddddd;background-color:#efefef;font-weight:bold;text-align:left;padding:7px;color:#222222" colspan="2">Order Details</td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="font-size:12px;border-right:1px solid #dddddd;border-bottom:1px solid #dddddd;text-align:left;padding:7px">
		  <b>Transaction ID:</b> <?=$order->trans_id?><br>
          <b>Order Date :</b> <?=date("d/m/Y", $order->time_created)?><br>
          <b>Payment Method:</b> <?=ucfirst($order->payment_method)?><br>
          <?php if($ship->email != ""):?>
        <td style="font-size:12px;border-right:1px solid #dddddd;border-bottom:1px solid #dddddd;text-align:left;padding:7px"><b>Email:</b> <a href="mailto:dimitar.t.krastev@gmail.com" target="_blank"><?=$ship->email?></a><br>
          <?php endif?>
          <?php if($ship->phone != ""):?>
          <b>Phone:</b> <a href="tel:%2B359883504595" value="+359883504595" target="_blank"><?=$ship->phone?></a><br>
          <?php endif?>
      </tr>
    </tbody>
  </table>
    <table style="border-collapse:collapse;width:100%;border-top:1px solid #dddddd;border-left:1px solid #dddddd;margin-bottom:20px">
    <thead>
       <tr>
        <td style="font-size:12px;border-right:1px solid #dddddd;border-bottom:1px solid #dddddd;background-color:#efefef;font-weight:bold;text-align:left;padding:7px;color:#222222">Billing Address</td>
        <td style="font-size:12px;border-right:1px solid #dddddd;border-bottom:1px solid #dddddd;background-color:#efefef;font-weight:bold;text-align:left;padding:7px;color:#222222">Shipping Address</td>
        </tr>
    </thead>
    <tbody>
		<tr>
			<td style="font-size:12px;border-right:1px solid #dddddd;border-bottom:1px solid #dddddd;text-align:left;padding:7px">
				<?=$bill->first_name?> <?=$bill->last_name?><br>
				<?=$bill->address_line_1?> <?=$bill->address_line_2?><br><?=$bill->state?><br><?=$bill->city?> <?=$bill->zip?><br><?=$bill->country?>
			</td>
            <td style="font-size:12px;border-right:1px solid #dddddd;border-bottom:1px solid #dddddd;text-align:left;padding:7px">
				<?=$ship->first_name?> <?=$ship->last_name?><br>
				<?=$ship->address_line_1?> <?=$ship->address_line_2?><br><?=$ship->state?><br><?=$ship->city?> <?=$ship->zip?><br><?=$ship->country?>
			</td>
        </tr>
    </tbody>
  </table>
  <table style="border-collapse:collapse;width:100%;border-top:1px solid #dddddd;border-left:1px solid #dddddd;margin-bottom:20px">
    <thead>
      <tr>
        <td style="font-size:12px;border-right:1px solid #dddddd;border-bottom:1px solid #dddddd;background-color:#efefef;font-weight:bold;text-align:left;padding:7px;color:#222222">Product</td>
        
        <td style="font-size:12px;border-right:1px solid #dddddd;border-bottom:1px solid #dddddd;background-color:#efefef;font-weight:bold;text-align:right;padding:7px;color:#222222">Quantity</td>
        <td style="font-size:12px;border-right:1px solid #dddddd;border-bottom:1px solid #dddddd;background-color:#efefef;font-weight:bold;text-align:right;padding:7px;color:#222222">Price</td>
        <td style="font-size:12px;border-right:1px solid #dddddd;border-bottom:1px solid #dddddd;background-color:#efefef;font-weight:bold;text-align:right;padding:7px;color:#222222">Subtotal</td>
      </tr>
    </thead>
    <tbody>
		<?php $currency = new Currency($order->currency);?>
      <?php foreach($order->product->get() as $product):?>
      <tr>
        <td style="font-size:12px;border-right:1px solid #dddddd;border-bottom:1px solid #dddddd;text-align:left;padding:7px">
          <?=$product->name?>
        </td>
        
        <td style="font-size:12px;border-right:1px solid #dddddd;border-bottom:1px solid #dddddd;text-align:right;padding:7px"><?=$product->quantity?></td>
		<?if($currency->symbol_position == 'after'):?>
			<td style="font-size:12px;border-right:1px solid #dddddd;border-bottom:1px solid #dddddd;text-align:right;padding:7px"><?=money_format('%.2n', $product->price)?><?=$currency->symbol?></td>
			<td style="font-size:12px;border-right:1px solid #dddddd;border-bottom:1px solid #dddddd;text-align:right;padding:7px"><?=money_format('%.2n', $product->price * $product->quantity)?><?=$currency->symbol?></td>
		<?else:?>
			<td style="font-size:12px;border-right:1px solid #dddddd;border-bottom:1px solid #dddddd;text-align:right;padding:7px"><?=$currency->symbol?><?=money_format('%.2n', $product->price)?></td>
			<td style="font-size:12px;border-right:1px solid #dddddd;border-bottom:1px solid #dddddd;text-align:right;padding:7px"><?=$currency->symbol?><?=money_format('%.2n', $product->price * $product->quantity)?></td>
		<?endif;?>
      </tr>
      <?php endforeach;?>
                </tbody>
    <tfoot>
            
            <tr>
        <td style="font-size:12px;border-right:1px solid #dddddd;border-bottom:1px solid #dddddd;text-align:right;padding:7px" colspan="3"><b>Total:</b></td>
		<?if($currency->symbol_position == 'after'):?>
			<td style="font-size:12px;border-right:1px solid #dddddd;border-bottom:1px solid #dddddd;text-align:right;padding:7px"><?=money_format('%.2n', $order->gross)?><?=$currency->symbol?></td>
		<?else:?>
			<td style="font-size:12px;border-right:1px solid #dddddd;border-bottom:1px solid #dddddd;text-align:right;padding:7px"><?=$currency->symbol?><?=money_format('%.2n', $order->gross)?></td>
		<?endif;?>
      </tr>
          </tfoot>
  </table>
  <p style="margin-top:0px;margin-bottom:20px">Thank you for using our services.</p>
  <p style="margin-top:0px;margin-bottom:20px">Powered By <a href="http://www.builderengine.com" target="_blank">BuilderEngine</a>.</p><div class="yj6qo"></div><div class="adL">
</div></div>