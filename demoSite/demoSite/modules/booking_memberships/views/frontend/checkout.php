<?
	$allowed_to_checkout = false;
	if(isset($usr))
		$user = $usr;
	$user_groups = $this->users->get_user_group_name($user->id);
	foreach($user_groups as $group){
		if(in_array($group,$groups_allowed_to_book))
			$allowed_to_checkout = true;
	}
	if(isset($order) && $order_id){
		$order_data = json_decode($order->custom_data);
		if(	!isset($order_data->code) || 
			(isset($order_data->code) && (($this->session->flashdata('guest_order_code') != null && $this->session->flashdata('guest_order_code') != $order_data->code) || ($this->uri->segment(5) !== FALSE && $this->uri->segment(5) != $order_data->code)))
		)
			$allowed_to_checkout = false;
	}
?>
<link href="<?=base_url()?>themes/dashboard/assets/plugins/parsley/src/parsley.css" rel="stylesheet" />
<div id="booking-memberships-content" class="container booking-membership-checkout-container">
    <div class="row">
        <div class="col-md-12">
			<h4 class="title"><i class="fa fa-check"></i> Checkout - <?=$membership->name?><a class="pull-right booking-membership-checkout-back" href="<?=base_url('booking_memberships/memberships')?>">Back to Memberships</a></h4>
			<div class="row" style="margin-bottom:30px">
				<?$method = $this->BuilderEngine->get_option('be_booking_memberships_payment_methods');?>
				<?foreach($payment_methods as $gateway):?>
					<?if($gateway->name == $method):?>
						<?
							$action = '';
							if($method == 'PayPal')
								$action = 'action="'.base_url("booking_memberships/process_paypal").'"';
							if($method == 'Stripe')
								$action = 'action="'.base_url("booking_memberships/process_stripe_payment").'"';
							if($method == 'Cash on Delivery')
								$action = 'action="'.base_url("booking_memberships/process_cod_payment").'"';
						?>
						<form id="checkout" method="post" data-parsley-validate="true" class="form-horizontal" <?=$action?>>
						<input type="hidden" name="submitAjaxFormPSC" value="<?=$user->id?>"/>
					<?endif;?>
				<?endforeach;?>
					<div class="col-lg-8 col-md-8">
						<?if($allowed_to_checkout):?>
							<?if(isset($order)):?>
								<input type="hidden" name="order_id" value="<?=$order->id?>" />
							<?endif;?>
								<input id="membership_id" type="hidden" name="membership_id" value="<?=$membership->id?>" />
								<input type="hidden" name="user_id" value="<?=$user->id?>" />
							<div class="form form-small bookingevents-checkout-box">
								  <div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="name1">Name</label>
									<div class="col-md-9 col-sm-9">
										<div class="row">
											<div class="col-lg-6 col-md-6">
												<input type="text" name="first_name" data-parsley-pattern="^[a-zA-Z0-9\s]*$" class="form-control form-control-be-40"  value="<?=$user->first_name?>" id="name1" required />
											</div>
											<div class="col-lg-6 col-md-6">
												<input type="text" name="last_name" data-parsley-pattern="^[a-zA-Z0-9\s]*$" class="form-control form-control-be-40"  value="<?=$user->last_name?>" id="name2" required />
											</div>
										</div>
									</div>
								  </div>   
								  <!-- Email -->
								  <div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="email1">Email</label>
									<div class="col-md-9 col-sm-9">
									  <input type="email" name="email" class="form-control form-control-be-40" data-parsley-type="email" value="<?=$user->email?>" id="email1" required />
									</div>
								  </div>
								  <!-- Telephone -->
								  <div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="telephone">Telephone</label>
									<div class="col-md-9 col-sm-9">
										<? $phone = $user->extended->get()->telephone;
											if($phone == 'none')
												$phone = '';
										?>
									  <input type="text" name="phone" class="form-control form-control-be-40" id="telephone" value="<?=$phone?>" required />
									</div>
								  </div>  
								  <!-- Address -->
								  <div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="address">Address</label>
									<div class="col-md-9 col-sm-9">
										<? $address = $user->extended->get()->address;
											if($address == 'none')
												$address = '';
										?>
									  <input class="form-control form-control-be-40"  type="text" name="address" id="address" value="<?=$address?>" required />
									</div>
								  </div> 
								  <!-- State -->
								  <div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="address">State</label>
									<div class="col-md-9 col-sm-9">
										<? $state = $user->extended->get()->state;
											if($state == 'none')
												$state = '';
										?>
									  <input class="form-control form-control-be-40"  type="text" name="state" id="state" value="<?=$state?>" />
									</div>
								  </div>  								  
								  <!-- Country -->
								  <div class="form-group">
									<label class="control-label col-md-3 col-sm-3">Country</label>
									<div class="col-md-9 col-sm-9">                             
										<select class="form-control" name="country" required>
										<option value=""> --- Please Select --- </option>
										<? foreach ($countries as $country):?>
											<option value="<?=$country?>" <?if($user->extended->get()->country == $country) echo 'selected';?>><?=$country?></option>
										<? endforeach;?>
										 </select>  
									</div>
								  </div>  
								  <!-- State -->
								  <div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="city">Zip</label>
									<div class="col-md-9 col-sm-9">
										<? $zip = $user->extended->get()->zip;
											if($zip == 'none')
												$zip = '';
										?>
									  <input type="text" name="zip"  class="form-control" id="zip"  value="<?=$zip?>">
									</div>
								  </div>   
								  <!-- City -->
								  <div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="city">City</label>
									<div class="col-md-9 col-sm-9">
										<? $city = $user->extended->get()->city;
											if($city == 'none')
												$city = '';
										?>
									  <input type="text" name="city" data-parsley-pattern="^[a-zA-Z\s]*$" class="form-control form-control-be-40" value="<?=$city?>" id="city" required />
									</div>
								  </div>
								  <div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="ce">
										<h4 class="booking-membership-checkout-serviceprice-novat">Membership Price:</h4>
										<?$note = '';if($membership->vat > 0)$note = '<small>(before tax / vat)</small>';?>
										<?=$note;?>
									</label>
									<div class="col-md-9 col-sm-9">
										<div class="booking-membership-checkout-price pull-right">
										<?if($membership->price > 0):?>
											<?$currency = new Currency($membership->currency_id);?>
											<?if($currency->symbol_position == 'before'):?>
												<?=$currency->symbol?><span id="mPrice" data-price="<?=$membership->price?>"><?=number_format($membership->price,2,'.',',');?></span>
											<?else:?>
												<span id="mPrice" data-price="<?=$membership->price?>"><?=number_format($membership->price,2,'.',',')?></span><?=$currency->symbol;?>
											<?endif;?>
										<?else:?>
											Price : <span id="mPrice" data-price="<?=$membership->price?>" style="color:#00ff00 !important;">FREE</span>
										<?endif;?>
										<br>
										<span class="booking-services-checkout-small">
										<?
											$price_option = explode('-',$membership->subscription_period);
											if($price_option[0] == '1')
												$wording = 'per '.$price_option[1];
											else
												$wording = 'for '.$price_option[0].' '.$price_option[1].'s';
										?>
										<?=$wording?>
										</div>
									</div>
								  </div>
									<?
									$addons = $membership->addonservice->get();
									$vouchers = $membership->voucher->get();
									$usergroupdiscounts = $membership->usergroupdiscount->get();
									if($addons->exists() || $vouchers->exists() || $usergroupdiscounts->exists()):?>
									<div class="extra-options booking-services-checkout-extrabox">
										<style>.extra-fields{text-align:right}</style>
										<?if($addons->exists()):?>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3" for="city">Additional Options:</label>
												<div class="col-md-9 col-sm-9">
													<div class="row">
														<div class="col-md-8 col-sm-8">
																<?foreach($addons as $addon):?>
																<span class="booking-services-addon-tick">
																	<input type="checkbox" class="addOnChk" name="add_on_ids[]" data-aid="<?=$addon->id?>" data-name="<?=$addon->name?>" data-price="<?=$addon->price?>" data-type="<?=$addon->price_opt?>" value="<?=$addon->id?>"> 
																</span>	
																	<div class="booking-services-checkout-addons-text">
																		<?if($addon->price_opt == 'flat'):?>
																			<?if($currency->symbol_position == 'before'):?>
																				<?=ucfirst($addon->name)?> +<?=$currency->symbol?><?=$addon->price?>
																			<?else:?>
																				<?=ucfirst($addon->name)?> +<?=$addon->price?><?=$currency->symbol?>
																			<?endif;?>
																		<?else:?>
																			<?=ucfirst($addon->name)?> +<?=$addon->price?>%
																		<?endif;?></div>
																<?endforeach;?>
														</div>
														<div class="col-md-4 col-sm-4">
															<input id="addon_value" type="text" name="add_on_value" class="form-control form-control-be-40 extra-fields" value="" readonly />
														</div>
													</div>
												</div>
											</div>
											
										<?endif;?>
										<?if($vouchers->exists()):?>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3" for="city">Voucher Discount:</label>
												<div class="col-md-9 col-sm-9">
													<div class="row">
														<div class="col-md-8 col-sm-8">
															<div class="row">
																<div class="col-6-lg col-md-6">
																	<select id="vouchers" class="form-control" name="voucher_id">
																		<option value="">Select Offer</option>
																		<?foreach($vouchers as $voucher):?>
																			<option value="<?=$voucher->id?>"><?=str_replace('_',' ',$voucher->name)?></option>
																		<?endforeach;?>
																	</select>
																</div>
																<div class="col-6-lg col-md-6">
																	<span id="voucherError" style="position:absolute;top:-20px;left:40px;"></span>
																	<input id="voucher_code" data-voucher-id="" type="text" name="voucher_code" class="form-control form-control-be-40 extra-fields" placeholder="Enter Code" value="" style="text-align:left" readonly="readonly" />
																</div>
															</div>
														</div>
														<div class="col-md-4 col-sm-4">
															<input id="voucher_value" type="text" name="voucher_value" class="form-control form-control-be-40 extra-fields" value="" readonly />
														</div>
													</div>
												</div>
											</div>
										<?endif;?>
										<?/*
										<?$groupdiscounts = $membership->groupdiscount->get();
										if($groupdiscounts->exists()):?>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3" for="city">Group Discounts</label>
												<div class="col-md-9 col-sm-9">
													<div class="row">
														<div class="col-md-6 col-sm-6">
															<select id="groupdiscounts" class="form-control" name="groupdiscount_id" style="height:40px">
																<option value="">Select One</option>
																<?foreach($groupdiscounts as $groupdiscount):?>
																	<option value="<?=$groupdiscount->id?>"><?=$groupdiscount->name?> (<?=$groupdiscount->num_persons?> person<?if($groupdiscount->num_persons > 1)echo 's';?>)</option>
																<?endforeach;?>
															</select>
														</div>
														<div class="col-md-6 col-sm-6">
															<input type="text" name="voucher_code" data-parsley-pattern="^[a-zA-Z\s]*$" class="form-control form-control-be-40 extra-fields" value="" id="groupdiscount_value" readonly />
														</div>
													</div>
												</div>
											</div>
										<?endif;?>
										*/?>
										<?	
											$show_discounts = false;
											if($usergroupdiscounts->exists()){
												foreach($usergroupdiscounts as $usergroupdiscount){
													if(in_array($usergroupdiscount->usergroup_name,$user_groups)){
														$show_discounts = true;
													}
												}
											}

										if($show_discounts):?>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3" for="city">Members Discount:</label>
												<div class="col-md-9 col-sm-9">
													<div class="row">
														<div class="col-md-8 col-sm-8">
															<select id="usergroupdiscounts" class="form-control" name="usergroupdiscount_id">
																<option value="">Select Membership</option>
																<?foreach($usergroupdiscounts as $usergroupdiscount):?>
																	<?if(in_array($usergroupdiscount->usergroup_name,$user_groups)):?>
																		<option data-uid="<?=$usergroupdiscount->id?>" data-option="<?=$usergroupdiscount->price_opt?>" value="<?=$usergroupdiscount->price?>"><?=$usergroupdiscount->usergroup_name?></option>
																	<?endif;?>
																<?endforeach;?>
															</select>
														</div>
														<div class="col-md-4 col-sm-4">
															<input id="usergroupdiscount_value" type="text" name="usergroup_discount_value" class="form-control form-control-be-40 extra-fields" value="" readonly />
															<input id="uid" type="hidden" name="uid" value="" />
														</div>
													</div>
												</div>
											</div>
										<?endif;?>
									</div><br/>
									<?endif;?>
									<input id="amount" type="hidden" name="amount" value="<?=$membership->price?>" />
									<div class="form-group">
										<div class="col-md-12 col-lg-12">
											<div class="row">
												<div class="col-lg-4 col-md-4 col-sm-4"><br/>
													<label class="booking-membership-checkout-addons-text">Enable Recurring Subscription</label>
													<span class="booking-membership-addon-tick">
														<input type="checkbox" id="recurring" name="recurring" value="1" />
													</span> 
													<button id="submitBtn" type="submit" class="btn btn-success btn-lg"><i class="fa fa-check"></i> Pay Membership</button>
												</div>
												<div class="control-label col-lg-8 col-md-8 col-sm-8" style="font-size:22px;padding-top:0">
													<div class="booking-membership-checkout-price">
														<?if($membership->price > 0):?>
															<?$currency = new Currency($membership->currency_id);?>
															<?
																$sub = '';
																if($membership->vat > 0){
																	$sub = 'Sub';
																	$vatAmount = (($membership->price * $membership->vat) / 100);
																}
															?>
															<?if($currency->symbol_position == 'before'):?>
																<?//if($addons->exists() || $vouchers->exists() || $usergroupdiscounts->exists()):?>
																	<span class="booking-membership-checkout-small-16 "><?=$sub?>  Total: </span><?=$currency->symbol?><span id="sPrice" data-price="<?=number_format($membership->price,2,'.',',');?>"><?=number_format($membership->price,2,'.',',');?></span>
																<?//endif;?>
																<?if($membership->vat > 0):?>
																	<br/><span id="vatPercent" data-percent="<?=$membership->vat?>" class="booking-services-checkout-small">TAX / VAT (<?=$membership->vat?>%): </span><span class="booking-services-checkout-small-vat "><?=$currency->symbol?><span id="vatAmount"><?=number_format($vatAmount,2,'.',',');?></span></span>
																	<?$total_price = $membership->price +  (($membership->price * $membership->vat) / 100);?>
																	<br/><p></p><span class="booking-membership-checkout-small-16 booking-services-checkout-total">Total Price:</span> <b><?=$currency->symbol?><span id="tPrice" data-price="<?=number_format($total_price,2,'.',',');?>"><?=number_format($total_price,2,'.',',');?></span></b>
																<?else:?>
																	<br/><p></p><span class="booking-membership-checkout-small-16 booking-services-checkout-total">Total Price:</span> <b><?=$currency->symbol?><span id="tPrice" data-price="<?=number_format($membership->price,2,'.',',');?>"><?=number_format($membership->price,2,'.',',');?></span></b>
																<?endif;?>
															<?else:?>
																<?if($addons->exists() || $vouchers->exists() || $usergroupdiscounts->exists()):?>
																	<span class="booking-membership-checkout-small-16 "><?=$sub?> Total: </span> <span id="sPrice" data-price="<?=number_format($membership->price,2,'.',',');?>"><?=number_format($membership->price,2,'.',',');?></span><?=$currency->symbol?>
																<?endif;?>
																<?if($membership->vat > 0):?>
																	<br/><span id="vatPercent" data-percent="<?=$membership->vat?>" class="booking-services-checkout-small">TAX / VAT (<?=$membership->vat?>%): </span><span class="booking-services-checkout-small-vat "><span id="vatAmount"><?=number_format($vatAmount,2,'.',',');?></span></span><?=$currency->symbol?>
																	<?$total_price = $membership->price +  (($membership->price * $membership->vat) / 100);?>
																	<br/><p></p><span class="booking-membership-checkout-small-16 booking-services-checkout-total">Total Price:</span> <b><span id="tPrice" data-price="<?=number_format($total_price,2,'.',',');?>"><?=number_format($total_price,2,'.',',');?></span><?=$currency->symbol?></b>
																<?else:?>
																	<br/><p></p><span class="booking-membership-checkout-small-16 booking-services-checkout-total">Total Price:</span> <b><span id="tPrice" data-price="<?=number_format($membership->price,2,'.',',');?>"><?=number_format($membership->price,2,'.',',');?></span><?=$currency->symbol?></b>
																<?endif;?>
															<?endif;?>
														<?else:?>
															<span class="booking-membership-checkout-small-16 ">Price:</span> <span class="label label-success" style="font-size:24px">FREE</span>
														<?endif;?>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?foreach($payment_methods as $gateway):?>
									<?if($gateway->name == $method):?>
										<?if($membership->price > 0 && $gateway->name == 'Stripe'):?>
											<?
												$keys = json_decode($this->BuilderEngine->get_option('builderpayment-config-StripeGateway'));
												if((int)$keys->STRIPE_SANDBOX === 0)
													$publishable_key = $keys->STRIPE_TEST_API_PUBLISHABLE_KEY;
												else
													$publishable_key = $keys->STRIPE_LIVE_API_PUBLISHABLE_KEY;
											?>
											<script src="https://checkout.stripe.com/checkout.js"></script>
											<script>
												var phpemail = "<?if(!$this->user->is_guest())echo $user->email;?>";
												var elememail = $('#email1').val();
												var userEmail = (phpemail != '') ? phpemail : elememail;
												$('#email1').on('keyup',function(){
													userEmail = $(this).val();
												});
												var submittedForm = false;

												var handler = StripeCheckout.configure({
													key: "<?=$publishable_key?>",
													image: "<?=base_url('builderengine/public/img/pay-icon-green.png')?>",
													email: userEmail,
													description: "<?=strtoupper($membership->name)?>",
													name: "<?=$this->BuilderEngine->get_option('be_booking_memberships_company_name')?>",
													amount: stripeTotal(),
													currency: "<?=strtolower($currency->signature)?>",
													token: function(response) {
														var $tok = $("<input type=\"hidden\" name=\"stripeToken\" />").val(response.id);
														var $email = $("<input type=\"hidden\" name=\"stripeEmail\" />").val(response.email);
														$("a").bind("click", function() { return false; });
														$("#submitBtn").addClass("disabled");
														$("#submitBtn").attr("disabled","disabled");
														submittedForm = true;
														$("#checkout").append($tok).append($email).submit();
													}
												});

												document.getElementById("submitBtn").addEventListener("click", function(e) {

													handler.open({
														image: "<?=base_url('builderengine/public/img/pay-icon-green.png')?>",
														email: userEmail,
														description: "<?=strtoupper($membership->name)?>",
														name: "<?=$this->BuilderEngine->get_option('be_booking_memberships_company_name')?>",
														amount: stripeTotal(),
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
												function stripeTotal(){
													var totalPrice = $('#amount').val();
													totalPrice = parseFloat(totalPrice);
													return totalPrice * 100;
												}
											</script>
												<input type="hidden" name="payment_method" id="optionsRadios4" value="<?=$gateway->id?>" />
										<?else:?>
											 <input type="hidden" name="payment_method" id="optionsRadios4" value="<?=$gateway->id?>" />
										<?endif;?>
									<?endif;?>
								<?endforeach?>
								</div>
						<?else:?>
							<div class="alert alert-info">
								<p class="text-center">
									<i class="fa fa-info-circle"></i> Sorry, You are not allowed to book this membership. Please contact the manager.
								</p>
							</div>
						<?endif;?>
						</div>
						<div class="col-lg-4 col-md-4">
							<div class="thumbnails">
								<div class="thumbnail">
								  <img alt="" class="img-responsive" src="<?=$membership->image?>">
								</div>
							</div><br/>
							<!--<button type="submit" class="btn btn-primary btn-lg">Book Now</button>-->
						</div>
					</div>
				</form>
			</div>
        </div>
    </div>
</div>
<script src="<?=base_url()?>themes/dashboard/assets/plugins/parsley/dist/parsley.js"></script>
<script src="<?=base_url()?>modules/booking_memberships/assets/js/checkout.js"></script>