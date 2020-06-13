<link href="<?=base_url('/builderengine/public/editor/css/special.css')?>" rel="stylesheet" type="text/css" />
<div class="container">
<div class="content">
<img src="<?=base_url('modules/builderpayment/img/gateways/stripe/stripe.png')?>" style="margin-top: 10px;width: 250px;float: right;"> <br>
</div>
</div>

<div class="container">
		<div class="content">
<form role="form" action="/builderpayment/stripegateway/process_payment/<?=$order->id?>" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Credit card number</label>
    <input type="text" class="form-control" name="credit_card_number" placeholder="Credit Card Number">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Name on card</label>
    <input type="text" class="form-control" name="credit_card_name" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">CVV (CSC/CVV/CVN)</label>
    <input type="text" class="form-control" name="credit_card_cvn" placeholder="Last digits on the back of your card">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Type</label>
    <select name="credit_card_type" class="form-control">
      <option value="">Please choose</option>
      <option value="visa">Visa</option>
      <option value="mc">MasterCard</option>
      <option value="laser">Laser</option>
      <option value="AMEX">American Express</option>
      <option value="DINERS">Diners</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Expire date</label>
    <div class="">
      <select name="credit_card_exp_month" class="form-control pull-left" style="width: 50%;">
        <option value="01">01</option>
        <option value="02">02</option>
        <option value="03">03</option>
        <option value="04">04</option>
        <option value="05">05</option>
        <option value="06">06</option>
        <option value="07">07</option>
        <option value="08">08</option>
        <option value="09">09</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
      </select>
      <select name="credit_card_exp_year" class="form-control pull-left" style="width: 50%;">
        <option value="14">2014</option>
        <option value="15">2015</option>
        <option value="16">2016</option>
        <option value="17">2017</option>
        <option value="18">2018</option>
        <option value="19">2019</option>
        <option value="20">2020</option>
        <option value="21">2021</option>
        <option value="22">2022</option>
        <option value="23">2023</option>
        <option value="24">2024</option>
        <option value="25">2025</option>
        <option value="26">2026</option>
        <option value="27">2027</option>
      </select>
    </div>
  </div>
  <input name="idempotency_key" value="<?php echo time();?>" type="hidden"/>
  <button type="submit" class="btn btn-lg btn-success" style="margin-top: 20px;margin-left: 15px;">Pay Now</button>
</form>

</div>
  </div>
