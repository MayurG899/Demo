<link href="<?=base_url()?>themes/dashboard/assets/plugins/parsley/src/parsley.css" rel="stylesheet" />
<div class="container event-checkout-top-padding">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h4 class="title"><i class="fa fa-check"></i> Event Checkout <a class="btn btn-sm btn-default pull-right" href="<?=base_url('booking_events/events')?>"><i class="fa fa-arrow-left"></i> Back to events listing</a></h4>
			<div class="row" style="margin-bottom:30px">
				<?$method = $this->BuilderEngine->get_option('be_booking_events_payment_methods');?>
				<?foreach($payment_methods as $gateway):?>
					<?if($gateway->name == $method):?>
						<?
							$action = '';
							if(isset($_GET['amount']) && $_GET['amount'] > 0 && $method == 'PayPal')
								$action = 'action="'.base_url("booking_events/process_paypal").'"';
							if(isset($_GET['amount']) && $_GET['amount'] > 0 && $method == 'Stripe')
								$action = 'action="'.base_url("booking_events/process_stripe_payment").'"';
							if(isset($_GET['amount']) && ($_GET['amount'] == 0 || (($_GET['amount'] > 0) && $method == 'Cash on Delivery')))
								$action = 'action="'.base_url("booking_events/process_cod_payment").'"';
						?>
						<form <?if($gateway->name == 'Stripe') echo 'id="stripe-form"';?> method="post" data-parsley-validate="true" class="form-horizontal" <?=$action;?>>
							<input type="hidden" name="submitAjaxFormPSC" value="<?=$this->user->get_id();?>"/>
							<input type="hidden" name="payment_method" id="optionsRadios4" value="<?=$gateway->id?>" />
					<?endif;?>
				<?endforeach;?>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form form-small">
							<div class="bookingevents-checkout-box">
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

							<div class="form-group">
								<?
									$total = round(($_GET['amount'] * $_GET['tickets']),2);
								?>
								<input type="hidden" name="amount" value="<?=$total?>" />
								<input type="hidden" name="event_id" value="<?=$object->id?>" />
								<input type="hidden" name="tickets" value="<?=$_GET['tickets']?>" />
								<div id="replacement">
									<label class="col-md-6 col-sm-6">
										<?$currency = new Currency($this->BuilderEngine->get_option('be_booking_events_default_currency'));?>
										<?if($object->price > 0):?>
											<span id="showTotal" class="label label-success booking-events-price-checkout">Price: <?=$currency->symbol?><?=number_format($total,2)?> <small style="font-size: 45%;">incl. VAT</small></span>
										<?else:?>
											Price : <span style="color:#00ff00 !important;">FREE</span>
										<?endif;?>
									</label>
									<div class="col-md-6 col-sm-6">
										<button id="submitBtn" type="submit" class="btn btn-success btn-lg booking-events-booking-checkout"><i class="fa fa-check"></i> Book Now</button>
									</div>
								</div>
							</div>
							<?foreach($payment_methods as $gateway):?>
								<?if($gateway->name == $method):?>
									<?if(isset($_GET['amount']) && $_GET['amount'] > 0 && $gateway->name == 'Stripe'):?>
										<?
											$keys = json_decode($this->BuilderEngine->get_option('builderpayment-config-StripeGateway'));
											if((int)$keys->STRIPE_SANDBOX === 0)
												$publishable_key = $keys->STRIPE_TEST_API_PUBLISHABLE_KEY;
											else
												$publishable_key = $keys->STRIPE_LIVE_API_PUBLISHABLE_KEY;
										?>
										<script src="https://checkout.stripe.com/checkout.js"></script>
										<script>
											var userEmail = "<?if(!$this->user->is_guest())echo $userinfo->email;?>";
											$('#email1').on('keyup',function(){
												userEmail = $(this).val();
											});
											var submittedForm = false;

											var handler = StripeCheckout.configure({
												key: "<?=$publishable_key?>",
												image: "<?=base_url('builderengine/public/img/pay-icon-green.png')?>",
												email: userEmail,
												description: "<?=strtoupper($object->name)?>",
												name: "<?=$this->BuilderEngine->get_option('be_booking_events_company_name')?>",
												amount: "<?=$total * 100;?>",
												currency: "<?=strtolower($currency->signature)?>",
												token: function(response) {
													var $tok = $("<input type=\"hidden\" name=\"stripeToken\" />").val(response.id);
													var $email = $("<input type=\"hidden\" name=\"stripeEmail\" />").val(response.email);
													$("a").bind("click", function() { return false; });
													$("#submitBtn").addClass("disabled");
													$("#submitBtn").attr("disabled","disabled");
													submittedForm = true;
													$("#stripe-form").append($tok).append($email).submit();
												}
											});

											document.getElementById("submitBtn").addEventListener("click", function(e) {

												handler.open({
													image: "<?=base_url('builderengine/public/img/pay-icon-green.png')?>",
													email: userEmail,
													description: "<?=strtoupper($object->name)?>",
													name: "<?=$this->BuilderEngine->get_option('be_booking_events_company_name')?>",
													amount: "<?=$total * 100;?>",
													currency: "<?=strtolower($currency->signature)?>",
													closed: function () {
														if(submittedForm != false){
															$("body").append("<div class=\"loading-screen\"><img class=\"loading-image\" src=\"<?=base_url('files/loading.gif')?>\"><h2 class=\"loading-text\">Processing ...</h2></div>");
															$(".loading-screen").css("background-color", "rgba(0, 0, 0, 0.65)");
														}
													}
												});
											  e.preventDefault();
											});

											window.addEventListener("popstate", function() {
											  handler.close();
											});
										</script>
									<?endif;?>
								<?endif;?>
							<?endforeach;?>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="thumbnails">
							<div class="thumbnail">
							  <img alt="" class="img-responsive booking-events-image-checkout" src="<?=checkImagePath($object->image)?>">
							</div>
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