<?include('modules/ecommerce/assets/misc/country_list.php');?>
<link href="<?=base_url('/builderengine/public/editor/css/special.css')?>" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    function validate() {
        if($('#shipping-billing-equal').is(":checked")) {
            $("#shipping-op-1").prop('disabled', true);
            $("#shipping-op-2").prop('disabled', true);
            $("#shipping-op-3").prop('disabled', true);
            $("#shipping-op-4").prop('disabled', true);
            $("#shipping-op-5").prop('disabled', true);
            $("#shipping-op-6").prop('disabled', true);
            $("#shipping-op-7").prop('disabled', true);
            $(".shipping-optional").hide();
        } else {
            $(".shipping-optional").show();
            $(".shipping-info").prop('disabled', false);
        }
    }
</script>
<div id="wrapper">
    <div id="shop">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-9">
				<br>
                    <?if($this->BuilderEngine->get_option('be_ecommerce_settings_template') == 'second'):?>
                    <form style="margin-top: 95px;" method="post" id="checkout-form" class="alert alert-default shop-cart-checkout-alert" action="<?=base_url('ecommerce/confirm_order')?>" name="checkout">
                        <?else: ?>
                        <form method="post" id="checkout-form" class="alert alert-default shop-cart-checkout-alert" action="<?=base_url('ecommerce/confirm_order')?>" name="checkout">
                            <?endif;?>
							<h4>Store Checkout & Payment</h4>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>First Name</label>
                                        <input type="text" name="billing_address[first_name]" class="form-control" <?if(isset($userinfo->first_name)) echo 'value="'.$userinfo->first_name.'"';?> required/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>Last Name</label>
                                        <input type="text" name="billing_address[last_name]" class="form-control" <?if(isset($userinfo->last_name)) echo 'value="'.$userinfo->last_name.'"';?> required/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>Email</label>
                                        <input id="email1" type="text" name="billing_address[email]" <?if(isset($userinfo->email)) echo 'value="'.$userinfo->email.'"';?> class="form-control" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>Phone</label>
                                        <input type="text" name="billing_address[phone]" <?if(isset($customer->telephone)) echo 'value="'.$customer->telephone.'"';?> class="form-control" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>Address</label>
                                        <input type="text" name="billing_address[address]" <?if(isset($customer->address)) echo 'value="'.$customer->address.'"';?> class="form-control" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>City</label>
                                        <input type="text" name="billing_address[city]" <?if(isset($customer->city)) echo 'value="'.$customer->city.'"';?> class="form-control" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>Country</label>
                                        <select class="form-control" name="billing_address[country]" required>
                                            <?/*$options = explode(', ', $checkout_country->options)*/?>
                                            <option value="">- Select -</option>
                                            <?foreach ($countries as $country) :?>
                                                <?if(isset($customer->country)):?>
                                                    <?if($customer->country == $country):?>
                                                        <option value="<?=$country?>"  <?php echo "selected"?>><?=$country?></option>
                                                    <?else:?>
                                                        <option value="<?=$country?>"><?=$country?></option>
                                                    <?endif;?>
                                                <?else :?>
                                                    <option value="<?=$country?>"><?=$country?></option>
                                                <?endif;?>
                                            <?endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="pointer shop-cart-agree">
                                        <input id="shipping-billing-equal" onclick="validate();" style="opacity: 1.0 !important" type="checkbox" name="shipping_same" value="1" checked/> Shipping address is the same as Billing address
                                    </label>
                                </div>
                            </div>
                            <hr class="shipping-optional">
                            <h5 class="shipping-optional">Shipping Details</h5>
                            <div class="row shipping-optional">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>First Name</label>
                                        <input type="text" name="shipping_address[first_name]" id="shipping-op-1" disabled class="form-control shipping-info" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="row shipping-optional">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>Last Name</label>
                                        <input type="text" name="shipping_address[last_name]" id="shipping-op-2" disabled class="form-control shipping-info"  required/>
                                    </div>
                                </div>
                            </div>
                            <div class="row shipping-optional">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>Email</label>
                                        <input type="text" name="shipping_address[email]" id="shipping-op-3" disabled class="form-control shipping-info"  required/>
                                    </div>
                                </div>
                            </div>
                            <div class="row shipping-optional">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>Phone</label>
                                        <input type="text" name="shipping_address[phone]" id="shipping-op-4" disabled class="form-control shipping-info"  required/>
                                    </div>
                                </div>
                            </div>
                            <div class="row shipping-optional">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>Address</label>
                                        <input type="text" name="shipping_address[address]" id="shipping-op-5" disabled class="form-control shipping-info"  required/>
                                    </div>
                                </div>
                            </div>
                            <div class="row shipping-optional">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>City</label>
                                        <input type="text" name="shipping_address[city]" id="shipping-op-6" disabled class="form-control shipping-info" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="row shipping-optional">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>Country</label>
                                        <select id="shipping-op-7" class="form-control shipping-info" disabled name="shipping_address[country]" required>
                                            <option value="">- Select -</option>
                                            <?foreach ($countries as $country) :?>
                                                <?if(isset($customer->country)):?>
                                                    <?if($customer->country == $country):?>
                                                        <option value="<?=$country?>"  <?php echo "selected"?>><?=$country?></option>
                                                    <?else:?>
                                                        <option value="<?=$country?>"><?=$country?></option>
                                                    <?endif;?>
                                                <?else :?>
                                                    <option value="<?=$country?>"><?=$country?></option>
                                                <?endif;?>
                                            <?endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
							<? #temp fix for payment blocks
							$readonly = false;
							foreach($var as $itm){
								if(strpos($itm['id'],'block') !== FALSE)
									$readonly = true;
							}
							?>
							<?if($readonly):?>
								<div class="row">
									<div class="form-group">
										<div class="col-md-12">
											<label>Shipping</label>
											<select id="shipping-op-17" class="form-control shipping-info" name="shipping" required>
												<?if($readonly == false):?>
													<option value="">- Select -</option>
												<?endif;?>
												<?$shipping_options = new Ecommerce_shipping();?>
												<?$shipping_options->get();?>
												<?foreach ($shipping_options as $shipping_option) :?>
													<?if($readonly == true):?>
														<?if($shipping_option->id == 1): #temp fix for payment blocks?>
															<option value="<?=$shipping_option->name?>"
																<?if(isset($_GET['shipping']) && $_GET['shipping'] == $shipping_option->name) echo 'selected'?>>
																<?
																echo $shipping_option->name.' ';
																if($shipping_option->type == 'flat')
																	echo $currency->symbol;
																echo $shipping_option->price;
																if($shipping_option->type == 'percent')
																	echo '%';
																?>
															</option>
														<?endif;?>
													<?else:?>
														<?if((int)$shipping_option->id !== 1): #temp fix for payment blocks?>
															<option value="<?=$shipping_option->name?>"
																<?if(isset($_GET['shipping']) && $_GET['shipping'] == $shipping_option->name) echo 'selected'?>>
																<?
																echo $shipping_option->name.' ';
																if($shipping_option->type == 'flat')
																	echo $currency->symbol;
																echo $shipping_option->price;
																if($shipping_option->type == 'percent')
																	echo '%';
																?>
															</option>
														<?endif;?>
													<?endif;?>
												<?endforeach;?>
											</select>
										</div>
									</div>
								</div>
							<?endif;?>
                            <hr class="shipping-optional">

                            <?foreach ($checkout_fields->get() as $checkout_field): ?>
                                <?if($checkout_field->input_name == 'name' || $checkout_field->input_name == 'email' || $checkout_field->input_name == 'phone' || $checkout_field->input_name == 'address' || $checkout_field->input_name == 'city' || $checkout_field->input_name == 'country'):?>
                                    <?continue;?>
                                <?else :?>
                                    <?if(($checkout_field->input_name == 'Shipping_Method' && $this->BuilderEngine->get_option('be_ecommerce_settings_shipping_options') == 'all') || $checkout_field->input_name != 'Shipping_Method') :?>
                                        <?if($checkout_field->input_name == 'Shipping_Method'):?>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label><?=$checkout_field->displayed_name?></label>
                                                        <?if($checkout_field->type == 'text') :?>
                                                            <input type="text" name="custom[<?=$checkout_field->input_name?>]" class="form-control" <?if($checkout_field->required == 'yes') echo "required";?>/>
                                                        <?elseif($checkout_field->type == 'textarea'): ?>
                                                            <textarea class="form-control" name="custom[<?=$checkout_field->input_name?>]" <?if($checkout_field->required == 'yes') echo "required";?>></textarea>
                                                        <?else: ?>
                                                            <select id="shipping-choice" class="form-control" name="custom[<?=$checkout_field->input_name?>]" <?if($checkout_field->required == 'yes') echo "required";?>>
                                                                <?$options = explode(',', $checkout_field->options)?>
                                                                <option value="">- Select -</option>
                                                                <?foreach ($options as $option) :?>
                                                                    <?=$option?>
                                                                    <?$shipping = new Ecommerce_shipping();?>
                                                                    <?$option_name = trim($option);?>
                                                                    <?$shipping = $shipping->where('name', $option_name)->get()?>
                                                                    <?if($shipping->type == 'flat'):?>
                                                                        <?if($currency->symbol_position == 'before'):?>
                                                                            <option value="<?=$option_name?>"><?=$option_name?> +<?=$currency->symbol?><?=$shipping->price?></option>
                                                                        <?else :?>
                                                                            <option value="<?=$option_name?>"><?=$option_name?> +<?=$shipping->price?><?=$currency->symbol?></option>
                                                                        <?endif;?>
                                                                    <?else:?>
                                                                        <option value="<?=$option_name?>"><?=$option_name?> +<?=$shipping->price?>%</option>
                                                                    <?endif;?>
                                                                <?endforeach;?>
                                                            </select>
                                                        <?endif;?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?else:?>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label><?=$checkout_field->displayed_name?></label>
                                                        <?if($checkout_field->type == 'text') :?>
                                                            <input type="text" name="custom[<?=$checkout_field->input_name?>]" class="form-control" <?if($checkout_field->required == 'yes') echo "required";?>/>
                                                        <?elseif($checkout_field->type == 'textarea'): ?>
                                                            <textarea class="form-control" name="custom[<?=$checkout_field->input_name?>]" <?if($checkout_field->required == 'yes') echo "required";?>></textarea>
                                                        <?else: ?>
                                                            <select class="form-control" name="custom[<?=$checkout_field->input_name?>]" <?if($checkout_field->required == 'yes') echo "required";?>>
                                                                <?$options = explode(',', $checkout_field->options)?>
                                                                <option value="">- Select -</option>
                                                                <?foreach ($options as $option) :?>
                                                                    <option value="<?=$option?>"><?=$option?></option>
                                                                <?endforeach;?>
                                                            </select>
                                                        <?endif;?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?endif;?>
                                    <?endif;?>
                                <?endif;?>
                            <?endforeach;?>
							<?
								$service_product = false;
								$service_gateway = '';
								foreach($this->cart->contents() as $itm){
									if(strpos($itm['id'],'block') !== FALSE){
										$service_product = true;
										$service_gateway = $itm['service_payment_gateway'];
									}
								}
							?>
							<?foreach($payment_methods as $gateway):?>
								<?$method = $this->BuilderEngine->get_option('be_ecommerce_payment_methods');?>
								<?if($gateway->name == $method):?>
									<?if($gateway->name == 'Stripe' || ($service_product == TRUE && $service_gateway == 'stripe')):?>

										<input type="hidden" name="payment_method" id="optionsRadios4" value="<?=$gateway->id?>" />
									<?else:?>
										<input type="hidden" name="payment_method" id="optionsRadios4" value="<?=$gateway->id?>" />
									<?endif;?>
								<?endif;?>
							<?endforeach?>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="pointer shop-cart-agree">
									<br>
                                        <input id="termsConditions" style="opacity: 1.0 !important" type="checkbox" name="agree" value="1" required/> I understand and agree to the <a href="<?=$this->BuilderEngine->get_option('be_ecommerce_settings_url')?>" target="_blank">terms and conditions</a>
                                    </label>
                                </div>
                            </div>
							<?/*
							<!-- Multiple Payment Gateway Solution -->
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="title">Select Payment Provider:</h5>
                                    <?foreach($payment_methods as $gateway):?>
                                        <?$methods = explode(',', $this->BuilderEngine->get_option('be_ecommerce_payment_methods'));?>
                                        <?if(!in_array($gateway->name, $methods))
                                            continue;?>
                                        <label style="float:left; margin-left: 20px;margin-top:0px;width:20%" class="btn btn-ecom btn-xs active">
                                            <input style="position:relative;margin-left:0px" type="radio" name="payment_method" id="optionsRadios4" value="<?=$gateway->id?>" required checked>
                                            <?if($gateway->icon):?>
                                                <img src="<?=$gateway->icon?>" style="float:left; height: 90px; margin-top: 10px; border-radius: 3px !important;">
                                            <?else:?>
                                                <span style="float:left; line-height: 45px"><?=$gateway->name?></span>
                                            <?endif;?>
                                        </label>
                                    <?endforeach?>
                                </div>
                            </div>
							<!-- End Multiple Payment Gateway Solution -->
							*/?>
                            <div class="row">
								<div id="stripe-error" class="col-md-12 alert alert-danger" style="display:none">
									<p id="stripeErrorText"></p>
								</div>
                                <div class="col-md-12">
								<br>
                                    <button id="submitBtn" type="submit"class="btn btn-success btn-lg"><i class="fa fa-check"></i> &nbsp; CONFIRM ORDER</button>
                                    <!-- <input  class="btn btn-primary btn-lg" value="&nbsp; PLACE ORDER"/> -->
                                </div>
                            </div>
                        </form>
                </div>
                <? $count = count($this->cart->contents());?>
                <?if($count > 0):?>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div id="sidebar-fixed">
                            <h3>Order Summary</h3>
                            <form class="cart-sidebar" method="post">
                                <div class="cart-totals">
                                    <table id="checkout-table">
										<?
											$service_product = false;
											foreach($this->cart->contents() as $itm){
												if(strpos($itm['id'],'block') !== FALSE)
													$service_product = true;
											}
											if($service_product):
										?>
										<?foreach($this->cart->contents() as $itm):?>
										<tr>
											<td><?=$itm['name'];?></td><td class="total align-r"><?=$currency->symbol?><?=$itm['subtotal'];?></td>
										</tr>
										<?endforeach;?>
										<?endif;?>
                                        <tr id="product-row">
                                            <td>Products Total</td>
                                            <?if($currency->symbol_position == 'before'):?>
                                                <?if($this->BuilderEngine->get_option('be_ecommerce_settings_shipping_options') == 'single') :?>
                                                    <td class="total align-r"><?=$currency->symbol?><?=number_format($cart_calculations[1],2,".",",")?></td>
                                                <?else:?>
                                                    <td class="total align-r"><?=$currency->symbol?><?=number_format($cart_calculations[1],2,".",",")?></td>
                                                <?endif;?>
                                            <?else :?>
                                                <?if($this->BuilderEngine->get_option('be_ecommerce_settings_shipping_options') == 'single') :?>
                                                    <td class="total align-r"><?=number_format($cart_calculations[1],2,".",",")?><?=$currency->symbol?></td>
                                                <?else:?>
                                                    <td class="total align-r"><?=number_format($cart_calculations[1],2,".",",")?><?=$currency->symbol?></td>
                                                <?endif;?>
                                            <?endif;?>
                                        </tr>
                                        <?if($this->BuilderEngine->get_option('be_ecommerce_settings_shipping_options') == 'single'):?>
                                            <tr>
                                                <td>Shipping Total</td>
                                                <?if($currency->symbol_position == 'before'):?>
                                                    <td class="total align-r"><?=$currency->symbol?><?=number_format($cart_calculations[0],2,".",",")?></td>
                                                <?else :?>
                                                    <td class="total align-r"><?=number_format($cart_calculations[0],2,".",",")?><?=$currency->symbol?></td>
                                                <?endif;?>
                                            </tr>
                                        <?endif;?>
                                        <tr id="order-total-row" class="total-order-tr">
                                            <td>Order Total</td>
                                            <?if($currency->symbol_position == 'before'):?>
                                                <?if($this->BuilderEngine->get_option('be_ecommerce_settings_shipping_options') == 'single') :?>
                                                    <td class="total align-r"><?=$currency->symbol?><?=number_format($cart_calculations[2],2,".",",")?></td>
                                                <?else:?>
                                                    <td class="total align-r"><?=$currency->symbol?><?=number_format($cart_calculations[2],2,".",",")?></td>
                                                <?endif;?>
                                            <?else :?>
                                                <?if($this->BuilderEngine->get_option('be_ecommerce_settings_shipping_options') == 'single') :?>
                                                    <td class="total align-r"><?=number_format($cart_calculations[2],2,".",",")?><?=$currency->symbol?></td>
                                                <?else:?>
                                                    <td class="total align-r"><?=number_format($cart_calculations[2],2,".",",")?><?=$currency->symbol?></td>
                                                <?endif;?>
                                            <?endif;?>
                                        </tr>
                                    </table>
                                    <a style="width:100%;font-size:18px;" href="<?=base_url('ecommerce/category/All?page=1')?>" class="btn btn-inverse"><i class="fa fa-shopping-cart"></i> Continue Shopping</a>
                                </div>
                            </form>
                            <?endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var elementPosition = $('#sidebar-fixed').offset();
        $(window).scroll(function(){
            if ( $(window).width() > 778) {
                if($(window).scrollTop() > elementPosition.top){
                    $('#sidebar-fixed').css('position','fixed').css('top','0').css('margin-top', '65px');
                } else {
                    $('#sidebar-fixed').css('position','static').css('margin-top','22px');
                }
            }
        });
    </script>
    <script type="text/javascript">
		Number.prototype.formatMoney = function(c, d, t){
		var n = this, 
			c = isNaN(c = Math.abs(c)) ? 2 : c, 
			d = d == undefined ? "." : d, 
			t = t == undefined ? "," : t, 
			s = n < 0 ? "-" : "", 
			i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
			j = (j = i.length) > 3 ? j % 3 : 0;
		   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
		};
        if ( $( "#shipping-choice" ).length ) {
            $('#shipping-choice').on('change',function(){
                var selection = $('#shipping-choice').find(":selected").text();
                var shippingPrice = selection.substr(selection.indexOf("+") + 1);
                var symbolPosition = '<?=$currency->symbol_position;?>';
                var symbol = '<?=$currency->symbol;?>';
                if(shippingPrice != '- Select -') {
                    if(shippingPrice.indexOf("%") > -1){
                        var productsTotal = $('#checkout-table #product-row .total').html();
                        productsTotal = Number(productsTotal.replace(/[^0-9\.]+/g,""));
                        shippingPrice = Number(shippingPrice.replace(/[^0-9\.]+/g,""));
                        var totalShippingPercent = (shippingPrice * (productsTotal / 100));
                        if($('#shipping-row').length) {
                            if(symbolPosition == 'before'){
                                $('#checkout-table #shipping-row').html('<td>Shipping Total</td><td class="total align-r">' + symbol + totalShippingPercent.formatMoney(2, '.', ',') +'</td>');
                            } else {
                                $('#checkout-table #shipping-row').html('<td>Shipping Total</td><td class="total align-r">' + totalShippingPercent.formatMoney(2, '.', ',') + symbol +'</td>');
                            }
                        } else {
                            if(symbolPosition == 'before'){
                                $('#checkout-table #product-row').after('<tr id="shipping-row"><td>Shipping Total</td><td class="total align-r">'+ symbol + totalShippingPercent.formatMoney(2, '.', ',') + '</td></tr>');
                            } else {
                                $('#checkout-table #product-row').after('<tr id="shipping-row"><td>Shipping Total</td><td class="total align-r">' + totalShippingPercent.formatMoney(2, '.', ',') + symbol + '</td></tr>');
                            }
                        }

                        var shippingPrice = selection.substr(selection.indexOf("+") + 1);
                    } else {
                        if($('#shipping-row').length) {
                            $('#checkout-table #shipping-row').html('<td>Shipping Total</td><td class="total align-r">' + shippingPrice + '</td>');
                        } else {
                            $('#checkout-table #product-row').after('<tr id="shipping-row"><td>Shipping Total</td><td class="total align-r">' + shippingPrice + '</td></tr>');
                        }
                    }
                    var oldPriceWithSymbol = $('#checkout-table #order-total-row .total').html();
                    var productsTotal = $('#checkout-table #product-row .total').html();
                    productsTotal = Number(productsTotal.replace(/[^0-9\.]+/g,""));
                    if(shippingPrice.indexOf("%") > -1) {
                        shippingPrice = Number(shippingPrice.replace(/[^0-9\.]+/g,""));
                        var total = productsTotal + (shippingPrice * (productsTotal / 100));
						if(symbolPosition == 'before')
							$('#checkout-table #order-total-row .total').html(symbol+total.formatMoney(2, '.', ','));
						else
							$('#checkout-table #order-total-row .total').html(total.formatMoney(2, '.', ',')+symbol);
                    } else {
                        shippingPrice = Number(shippingPrice.replace(/[^0-9\.]+/g,""));
                        var total = productsTotal + shippingPrice;
						if(symbolPosition == 'before')
							$('#checkout-table #order-total-row .total').html(symbol+total.formatMoney(2, '.', ','));
						else
							$('#checkout-table #order-total-row .total').html(total.formatMoney(2, '.', ',')+symbol);
                    }
                }
            });
        }
    </script>
	<?foreach($payment_methods as $gateway):?>
		<?$method = $this->BuilderEngine->get_option('be_ecommerce_payment_methods');?>
		<?if($gateway->name == $method):?>
			<input type="hidden" name="payment_method" id="optionsRadios4" value="<?=$gateway->id?>" />
			<?if($gateway->name == 'Stripe' || ($service_product == TRUE && $service_gateway == 'stripe')):?>
				<?
					$keys = json_decode($this->BuilderEngine->get_option('builderpayment-config-StripeGateway'));
					if((int)$keys->STRIPE_SANDBOX === 0)
						$publishable_key = $keys->STRIPE_TEST_API_PUBLISHABLE_KEY;
					else
						$publishable_key = $keys->STRIPE_LIVE_API_PUBLISHABLE_KEY;
					$total = $cart_calculations[2];
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
						description: "Online Store",
						name: "<?=$this->BuilderEngine->get_option('be_ecommerce_company_name')?>",
						amount: stripeTotal(),
						currency: "<?=strtolower($currency->signature)?>",
						token: function(response) {
							var $tok = $("<input type=\"hidden\" name=\"stripeToken\" />").val(response.id);
							var $email = $("<input type=\"hidden\" name=\"stripeEmail\" />").val(response.email);
							$("a").bind("click", function() { return false; });
							$("#submitBtn").addClass("disabled");
							$("#submitBtn").attr("disabled","disabled");
							submittedForm = true;
							$("#checkout-form").append($tok).append($email).submit();
						}
					});

					document.getElementById("submitBtn").addEventListener("click", function(e) {
						if($('#termsConditions').is(':checked') && $('#shipping-choice').val() != ''){
							handler.open({
								image: "<?=base_url('builderengine/public/img/pay-icon-green.png')?>",
								email: userEmail,
								description: "Online Store",
								name: "<?=$this->BuilderEngine->get_option('be_ecommerce_company_name')?>",
								amount: stripeTotal(),
								currency: "<?=strtolower($currency->signature)?>",
								closed: function () {
									if(submittedForm != false){
										$("body").append("<div class=\"loading-screen\"><img class=\"loading-image\" src=\"<?=base_url('files/loading.gif')?>\"><h2 class=\"loading-text\">Processing ...</h2></div>");
										$(".loading-screen").css("background-color", "rgba(0, 0, 0, 0.65)");
									}
								}
							});
						}else{
							if(!$('#termsConditions').is(':checked'))
								$('#stripeErrorText').text('You must agree with our terms and conditions!');
							if($('#shipping-choice').val() == '')
								$('#stripeErrorText').text('Please,select the shipping method!');
							$('#stripe-error').show().fadeOut(3000);
						}
						e.preventDefault();
					});

					window.addEventListener("popstate", function() {
					  handler.close();
					});
					function stripeTotal(){
						var totalPrice = $('#checkout-table #order-total-row .total').text();
						totalPrice = Number(totalPrice.replace(/[^0-9\.]+/g,""));
						return totalPrice * 100;
					}
				</script>
			<?endif;?>
		<?endif;?>
	<?endforeach?>