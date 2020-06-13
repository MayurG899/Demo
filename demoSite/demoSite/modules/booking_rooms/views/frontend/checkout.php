<link href="<?=base_url()?>themes/dashboard/assets/plugins/parsley/src/parsley.css" rel="stylesheet" />
<link href="<?=base_url('modules/booking_rooms/assets/css/room_checkout.css')?>" rel="stylesheet" />
<div class="container event-checkout-top-padding">
    <div class="row">
        <div class="col-md-12">
			<h4 class="title"><i class="fa fa-check"></i> Event Checkout <a class="btn btn-sm btn-success pull-right" href="<?=base_url('booking_rooms/rooms')?>"><i class="fa fa-arrow-left"></i> Back to rooms listing</a></h4>
			<div class="row" style="margin-bottom:30px">
				<?$method = $this->BuilderEngine->get_option('be_booking_rooms_payment_methods');?>
				<?foreach($payment_methods as $gateway):?>
					<?if($gateway->name == $method):?>
						<form method="post" data-parsley-validate="true" class="form-horizontal" <?if($method == 'PayPal') echo 'action="'.base_url("booking_rooms/process_paypal").'"';?>>
						<input type="hidden" name="submitAjaxFormPSC" value="<?=$this->user->get_id();?>"/>
					<?endif;?>
				<?endforeach;?>
					<div class="col-md-6">
						<div class="form form-small">
							<div style="background:#eee;padding: 25px;border-radius:5px;margin-bottom:20px">
								  <div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="name1">First Name</label>
									<div class="col-md-9 col-sm-9">
									  <input type="text" name="first_name" <?if(isset($userinfo->first_name)) echo 'value="'.$userinfo->first_name.'"';?> data-parsley-pattern="^[a-zA-Z0-9\s]*$" class="form-control" id="name1" required />
									</div>
								  </div>  
								  <div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="name1">Last Name</label>
									<div class="col-md-9 col-sm-9">
									  <input type="text" name="last_name" <?if(isset($userinfo->last_name)) echo 'value="'.$userinfo->last_name.'"';?> data-parsley-pattern="^[a-zA-Z0-9\s]*$" class="form-control" id="name2" required />
									</div>
								  </div>   
								  <!-- Email -->
								  <div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="email1">Email</label>
									<div class="col-md-9 col-sm-9">
									  <input type="email" name="email" <?if(isset($userinfo->email)) echo 'value="'.$userinfo->email.'"';?> class="form-control" data-parsley-type="email" id="email1" required />
									</div>
								  </div>
								  <!-- Telephone -->
								  <div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="telephone">Telephone</label>
									<div class="col-md-9 col-sm-9">
									  <input type="text" name="phone" <?if(isset($customer->telephone)) echo 'value="'.$customer->telephone.'"';?> class="form-control" id="telephone" required />
									</div>
								  </div>  
								  <!-- Address -->
								  <div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="address">Address</label>
									<div class="col-md-9 col-sm-9">
									  <input type="text" class="form-control" <?if(isset($customer->address)) echo 'value="'.$customer->address.'"';?>  name="address" id="address" required >
									</div>
								  </div>                           
								  <!-- Country -->
								  
								  <div class="form-group">
									<label class="control-label col-md-3 col-sm-3">Country</label>
									<div class="col-md-9 col-sm-9">                             
										<select class="form-control" name="country" required>
										<option value=""> --- Please Select --- </option>
										<? foreach ($countries as $country):?>
											<?if($country == $customer->country):?>
												<option value="<?=$country?>" selected><?=$country?></option>
											<?else:?>
												<option value="<?=$country?>"><?=$country?></option>
											<?endif;?>
										<? endforeach;?>
										 </select>  
									</div>
								  </div>  
								  <!-- State -->
								  <div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="city">Zip</label>
									<div class="col-md-9 col-sm-9">
									  <input type="text" name="zip" <?if(isset($customer->zip)) echo 'value="'.$customer->zip.'"';?>  class="form-control" id="zip" />
									</div>
								  </div>   
									
								  <!-- City -->
								  <div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="city">City</label>
									<div class="col-md-9 col-sm-9">
									  <input type="text"  name="city"  <?if(isset($customer->city)) echo 'value="'.$customer->city.'"';?> data-parsley-pattern="^[a-zA-Z\s]*$" class="form-control" id="city" required />
									</div>
								  </div>
							  </div>
								<?foreach($payment_methods as $gateway):?>
									<?if($gateway->name == $method):?>
										<?if($gateway->name == 'Stripe'):?>
											<div id="stripebox" style="background:#fafad2;padding: 25px;border-radius:5px;margin-bottom:20px">
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label for="exampleInputEmail1">Credit card number</label>
															<input type="text" data-parsley-minlength="16" class="form-control" name="credit_card_number" placeholder="Credit Card Number" required />
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-12">
															<label for="exampleInputPassword1">Name on card</label>
															<input type="text" class="form-control" name="credit_card_name" placeholder="" required />
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-6">
															<label for="exampleInputPassword1">Type</label>
															<select name="credit_card_type" class="form-control" required>
																<option value="">Please choose</option>
																<option value="visa">Visa</option>
																<option value="mc">MasterCard</option>
																<option value="laser">Laser</option>
																<option value="AMEX">American Express</option>
																<option value="DINERS">Diners</option>
															</select>
														</div>
														<div class="col-md-6">
															<label for="exampleInputPassword1">CVV (CSC/CVV/CVN)</label>
															<input type="text" class="form-control" name="credit_card_cvn" placeholder="Last digits on the back of your card" required />
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-md-6">
															<label for="exampleInputPassword1">Expire Date Month</label>
															<select name="credit_card_exp_month" class="form-control" required>
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
														</div>
														<div class="col-md-6">
															<label for="exampleInputPassword1">Expiry Date Year</label>
															<select name="credit_card_exp_year" class="form-control" required>
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
																<option value="28">2028</option>
																<option value="29">2029</option>
																<option value="30">2030</option>
																<option value="31">2031</option>
																<option value="32">2032</option>
																<option value="33">2033</option>
																<option value="34">2034</option>
																<option value="35">2035</option>
																<option value="36">2036</option>
																<option value="37">2037</option>
																<option value="38">2038</option>
																<option value="39">2039</option>
																<option value="40">2040</option>
																<option value="41">2041</option>
																<option value="42">2042</option>
																<option value="43">2043</option>
																<option value="44">2044</option>
																<option value="45">2045</option>
																<option value="46">2046</option>
																<option value="47">2047</option>
																<option value="48">2048</option>
																<option value="49">2049</option>
																<option value="50">2050</option>
															</select>
														</div>
													</div>
												</div>
												<input name="idempotency_key" value="<?php echo time();?>" type="hidden"/>
												<input type="hidden" name="payment_method" id="optionsRadios4" value="<?=$gateway->id?>" />
											</div>
										<?else:?>
											 <input type="hidden" name="payment_method" id="optionsRadios4" value="<?=$gateway->id?>" />
										<?endif;?>
									<?endif;?>
								<?endforeach?>
								<div id="errorBox" class="alert alert-danger alert-dismissible" role="alert" style="display:none">
									<!--<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
									<div id="errContainer"></div>
								</div>
								<div class="form-group">
									<?
										$total = $_GET['amount'] * $_GET['tickets'];
									?>
									<input type="hidden" name="amount" value="<?=$total?>" />
									<input type="hidden" name="event_id" value="<?=$object->id?>" />
									<input type="hidden" name="tickets" value="<?=$_GET['tickets']?>" />
								    <div id="replacement">
										<label class="control-label col-md-6 col-sm-6" style="padding-top:5px !important;">
											<?$currency = new Currency($this->BuilderEngine->get_option('be_booking_rooms_default_currency'));?>
											<?if($object->price > 0):?>
												<span id="showTotal" class="label label-success" style="font-size:20px;margin-left: 150px;padding:10px;border:2px dashed black;">Price: <?=$currency->symbol?><?=number_format($total,2)?> <small style="font-size: 45%;">incl. VAT</small></span>
											<?else:?>
												Price : <span style="color:#00ff00 !important;">FREE</span>
											<?endif;?>
										</label>
										<div class="col-md-6 col-sm-6 text-center" style="padding-left: 70px;">
											<button id="submitBtn" type="submit" class="btn btn-success btn-lg"><i class="fa fa-check"></i> Book Now</button>
										</div>
									</div>
								</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="thumbnails">
							<div class="thumbnail">
							  <img alt="" class="img-responsive" src="<?=checkImagePath($object->image)?>" style="width:940px;min-height:350px">
							</div>
							  <br/>
							  <h3 class="text-center"><?=strtoupper($object->name)?></h3><br/>
							  <?=$object->description?>
						</div><br/>
					</div>
				</form>
			</div>  
        </div>
    </div>
</div>
<script src="<?=base_url()?>themes/dashboard/assets/plugins/parsley/dist/parsley.js"></script>
<?if($method != 'PayPal'):?>
<script>
$( document ).ready(function() {
	var request;
	$("form").on("submit", function (event) {
		event.preventDefault();
		var method = '<?=$method?>';
<?foreach($payment_methods as $gateway):?>
	<?if($gateway->name == $method):?>
		<?if($gateway->name == 'Stripe'):?>
			var gateway = '<?=base_url('booking_rooms/ajax/process_stripe_payment')?>';
		<?else:?>
			var gateway = '<?=base_url('booking_rooms/ajax/process_cod_payment')?>';
		<?endif;?>
	<?endif;?>
<?endforeach;?>
		// Abort any pending request
		if(request){
			request.abort();
		}

		var $form = $(this);

		// Select and cache all the fields
		var $inputs = $form.find("input, select, button, textarea");

		// Serialize the data in the form
		var serializedData = $form.serialize();

		// Disable inputs for the duration of the Ajax request.
		// Note: Disable elements AFTER the form data has been serialized.
		// Disabled form elements will not be serialized.
		$inputs.prop("disabled", true);
		$('#errContainer').empty();
		$('#errorBox').hide();
		$('#submitBtn').html('<i class="fa fa-cog fa-spin fa-fw"></i> Processing...');
		// Fire off the request
		$.ajax({
			url: gateway,
			type: "post",
			dataType: 'json',
			data: serializedData
		}).done(function (response, textStatus, jqXHR){
			$('#submitBtn').html('<i class="fa fa-check"></i> Book Now');
			if(response.status == 'success'){
				$('#errorBox').removeClass('alert-danger');
				$('#errorBox').addClass('alert-success');
				$('#errorBox').show();
				$('#errContainer').append('<p>Transaction Description: ' + response.description + '</p>');
				$('#errContainer').append('<p><i class="fa fa-info-circle"></i> ' + response.message + '</p>');
				$('#errContainer').append('<p> Transaction ID: <strong>' + response.transaction_id + '</strong></p>');
				$('#showTotal').remove;
				var url = '<?=base_url()?>';
				$('#replacement').replaceWith('<div class="col-md-12"><a href="' + url + '" class="btn btn-success btn-block"><i class="fa fa-arrow-left"></i> Back To The Home Page</a></div>');
				$('form')[0].reset();
				//console.log('success');
			}
			if(response.status == 'fail'){
				$('#errorBox').show();
				$('#errContainer').append('<p><i class="fa fa-exclamation-triangle"></i> Server error,please try again later!</p>');
			}
			if(response.status == 'error'){
				$('#errorBox').show();
				$.each(response.message, function(k, v) {
					if(v != '')
						$('#errContainer').append('<p><i class="fa fa-exclamation-triangle"></i> ' + v + '</p>');
				});
				
			}
			console.log(response);
		}).fail(function (response, textStatus, errorThrown){
			$('#submitBtn').html('<i class="fa fa-check"></i> Book Now');
			$('#errorBox').show();
			$('#errContainer').append('<p><i class="fa fa-exclamation-triangle"></i> Server error,please try again later!</p>');
			// Log the error to the console
			console.error(
				"The following error occurred: "+
				textStatus, errorThrown
			);
		}).always(function () {
			// Re-enable the inputs
			$inputs.prop("disabled", false);
		});

	});
});
</script>
<?endif;?>