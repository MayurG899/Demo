<script src="<?php echo get_theme_path()?>assets/plugins/jquery/jquery-1.9.1.min.js"></script>
<script src="<?=base_url('builderengine/public/js/editor/ckeditor.js')?>"></script>
<script type="text/javascript">
    $(document).ready(function (){
        CKEDITOR.replace( 'editor1' );
        CKEDITOR.replace( 'editor2' );
    });
</script>
<div id="content" class="page-with-two-sidebar content-two-sidebars" style="min-height:800px">
<!-- begin row -->
<div class="row">
	<!-- begin col-8 -->
	<div class="col-md-12">
	<!-- begin panel -->
        <div class="panel panel-white">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				</div>
				<h4 class="panel-title">Online Store Main Settings</h4>
			</div>
            <div class="panel-body panel-form">
                <form class="form-horizontal form-bordered" method="post" data-parsley-validate="true" name="demo-form">
					<div class="form-group" id="visible">
						<label class="control-label col-md-4 col-sm-4 col-be-4" for="forum_active">Online Store Module Active:</label>
						<div class="col-md-6 col-sm-6">
							<?php if($this->BuilderEngine->get_option('ecommerce_active') == 'yes')
						   	{
						   		$check1 = 'checked'; 
						   		$check2 = '';
						   	}
						   	else
						   	{
						   		$check1 = ''; 
						   		$check2 = 'checked';
						   	}
							?>									
							<label class="radio-inline">
                                <input type="radio" name="ecommerce_active" id="disabled" value="yes" <?=$check1?>/>
                                Yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="ecommerce_active" id="active" value="no" <?=$check2?>/>
                               No
                            </label>
						</div>
					</div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-be-4" for="required"><b> Online Store Default Currency:</b></label>
                        <div class="col-md-6 col-sm-6">
                            <? $currencies = new Currency();?>
                            <select class="form-control" name="currency">
                                <?foreach ($currencies->get() as $currency) :?>
                                    <?if($currency->id == $this->BuilderEngine->get_option('be_ecommerce_settings_currency')):?>
                                        <option value="<?=$currency->id?>" selected="selected"><?=$currency->name?></option>
                                    <?else:?>
                                        <option value="<?=$currency->id?>"><?=$currency->name?></option>
                                    <?endif;?>
                                <?endforeach;?>
                            </select>
                        </div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-be-4" for="website"><b>Checkout Payment Methods:</b></label>
						<div class="col-md-6 col-sm-6">
							<?
								$payment_methods = array(
									'Cash on Delivery',
									'PayPal',
									'Stripe'
								);
								$active_method = $this->BuilderEngine->get_option('be_ecommerce_payment_methods');
							?>
							<select id="payment_methods" class="form-control" name="payment_methods">
								<?foreach($payment_methods as $method):?>
									<option value="<?=$method?>" <?if($method == $active_method) echo 'selected';?>><?=$method?></option>
								<?endforeach?>
							</select>
							<br/>
							<div id="err" class="alert alert-danger" style="display:none">
								<p><i class="fa fa-exclamation-triangle"></i> Warrning! In order to use this gateway,you need to enable it first.<br/><a id="gtwLink" href="" class="btn btn-xs btn-warning"><i class="fa fa-cog"></i> Enable <span id="gtwText"></span></a></p>
							</div>
							<?/* # multiple payment gateways disabled
							<ul id="payment-methods">
								<?php $payment_methods = array(
									'Cash on Delivery',
									'PayPal',
									'Stripe',
									'Authorize.net'
								);?>
								<?$methods = $this->BuilderEngine->get_option('be_ecommerce_payment_methods');?>
								<?if($methods == ''):?>
									<?php foreach($payment_methods as $method):?>
										<li><?=$method?></li>
									<?php endforeach?>
								<?else:?>
									<?php $methods = explode(',', $this->BuilderEngine->get_option('be_ecommerce_payment_methods'));?>
									<?php foreach($methods as $method):?>
										<li><?=$method?></li>
									<?php endforeach?>
								<?endif;?>
								*/?>
						</div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-be-4" for="required"><b>Display Product Views:</b></label>
                        <div class="col-md-2 col-sm-2">
                            <select class="form-control" name="views">
                                <option value='no' <?if($this->BuilderEngine->get_option('be_ecommerce_display_views') == "no") echo "selected"?>>No</option>
                                <option value='yes'<?if($this->BuilderEngine->get_option('be_ecommerce_display_views') == "yes") echo "selected"?> >Yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-be-4" for="adminemail"><b>Shipping For Store or Products:</b></label>
                        <div class="col-md-6 col-sm-6">
                            <? $shipping_options = $this->BuilderEngine->get_option('be_ecommerce_settings_shipping_options');?>
                            <select id="shipping-select" class="form-control" name="shipping_options">
                                <?if($shipping_options == 'all') {?>
                                    <option value="all" selected="selected">For All Products</option>
                                    <option value="single">For Each Product</option>
                                <?} else {?>
                                    <option value="all">For All Products</option>
                                    <option value="single" selected="selected">For Each Product</option>
                                <?}?>
                            </select>
                        </div>
                    </div>
                    <?/*if($shipping_options == 'all'):?>
                        <div id="shipping-options-all" class="form-group">
                            <label class="control-label col-md-4 col-sm-4" for="website" style="padding-top:36px;">Shippings available:</label>
                            <div class="form-group">
                                <div class="col-md-8 col-sm-8">
                                    <?$shippings = new Checkout_field_ecommerce();?>
                                    <?$shippings = $shippings->where('input_name', 'shipping')->get()?>
                                    <?$shipping_details = explode(',', $shippings->options)?>
                                    <ul id="shippings">
                                        <?foreach ($shipping_details as $shipping_detail) :?>
                                            <li><?=$shipping_detail?></li>
                                        <?endforeach;?>
                                </div>
                            </div>
                        </div>
                    <?else :?>
                        <div id="shipping-options-all" class="form-group" hidden>
                            <label class="control-label col-md-4 col-sm-4" for="website">Shippings available:</label>
                            <div class="form-group">
                                <div class="col-md-8 col-sm-8">
                                    <?$shippings = new Checkout_field_ecommerce();?>
                                    <?$shippings = $shippings->where('input_name', 'shipping')->get()?>
                                    <?$shipping_details = explode(',', $shippings->options)?>
                                    <ul id="shippings">
                                        <?foreach ($shipping_details as $shipping_detail) :?>
                                            <li><?=$shipping_detail?></li>
                                        <?endforeach;?>
                                </div>
                            </div>
                        </div>
                    <?endif; */?>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-be-4" for="required"><b>Terms and Conditions URL:</b></label>
                        <div class="col-md-6 col-sm-6">
                                <input type="text" name="terms_conditions_url" class="required form-control" value="<?=$this->BuilderEngine->get_option('be_ecommerce_settings_url')?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-be-4" for="website"><b>Usergroups Allowed to Shop & Add Products to Cart:</b></label>
                        <div class="form-group">
                            <div class="col-md-8 col-sm-8">
                                <ul id="shop-groups">
                                    <?php $groups = explode(',', $this->BuilderEngine->get_option('be_ecommerce_shop_groups'));?>
                                    <?php foreach($groups as $group):?>
                                        <li><?=$group?></li>
                                    <?php endforeach?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-be-4" for="website"><b>Usergroups Allowed to Add Reviews:</b></label>
                        <div class="form-group">
                            <div class="col-md-8 col-sm-8">
                                <ul id="reviews-groups">
                                    <?php $groups = explode(',', $this->BuilderEngine->get_option('be_ecommerce_reviews_groups'));?>
                                    <?php foreach($groups as $group):?>
                                        <li><?=$group?></li>
                                    <?php endforeach?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-be-4" for="website"><b>Usergroups Allowed Access to View  Online Store Pages / Products:</b></label>
                        <div class="form-group">
                            <div class="col-md-8 col-sm-8">
                                <ul id="access-groups">
                                    <?php $groups = explode(',', $this->BuilderEngine->get_option('be_ecommerce_access_groups'));?>
                                    <?php foreach($groups as $group):?>
                                        <li><?=$group?></li>
                                    <?php endforeach?>
                            </div>
                        </div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-ck-4" for="required"><b> Online Store Members Login Page Information:</b></label>
                        <div class="col-md-8 col-sm-8 col-ck-8">
                            <textarea id="editor1" name="log_in_info" class="ckeditor required form-control" required><?=$this->BuilderEngine->get_option('be_ecommerce_settings_log_in_info')?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-ck-4" for="required"><b> Online Store Members Register Page Information:</b></label>
                        <div class="col-md-8 col-sm-8 col-ck-8">
                            <textarea id="editor2" name="register_info" class="ckeditor required form-control" required><?=$this->BuilderEngine->get_option('be_ecommerce_settings_register_info')?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-be-4"></label>
                        <div class="col-md-6 col-sm-6">
                            <button type="submit" class="suBtn btn btn-primary">Save Store Settings</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>	
<!-- end row -->
<!-- begin #sidebar-right -->
		<div id="sidebar-right" class="sidebar sidebar-right">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav m-t-10">
					<h4 class="sidebar-right-main-title">Online Store</h4>
					<li class="nav-widget">
                        <div class="panel-group m-b-0" id="accordion">
							<div class="panel panel-grey panel-bg-buttons">
                                <div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('ecommerce/category/All');?>" target="_blank" class="btn btn-sm btn-block btn-success btn-r-sidebar-2">
                                            <i class="fa fa-file-o pull-right text-white"></i>
											<b>Store Homepage</b>
                                        </a>
                                    </h3>
                                </div>
								<div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('ecommerce/register');?>" target="_blank" class="btn btn-sm btn-block btn-warning btn-r-sidebar-2">
                                            <i class="fa fa-sign-in pull-right text-white"></i>
											<b>Registration Page</b>
                                        </a>
                                    </h3>
                                </div>
								<div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('ecommerce/login');?>" target="_blank" class="btn btn-sm btn-block btn-warning btn-r-sidebar-2">
                                            <i class="fa fa-sign-in pull-right text-white"></i>
											<b>Store Login Page</b>
                                        </a>
                                    </h3>
                                </div>
								<div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('admin/module/ecommerce/add_product');?>" class="btn btn-sm btn-block btn-indigo btn-r-sidebar-2">
                                            <i class="fa fa-plus pull-right text-white"></i>
											<b>Add Store Product</b>
                                        </a>
                                    </h3>
                                </div>
								<div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('admin/module/ecommerce/show_products');?>" class="btn btn-sm btn-block btn-indigo btn-r-sidebar-2">
                                            <i class="fa fa-shopping-basket pull-right text-white"></i>
											<b>View All Products</b>
                                        </a>
                                    </h3>
                                </div>
								<div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('admin/module/ecommerce/orders');?>" class="btn btn-sm btn-block btn-indigo btn-r-sidebar-2">
                                            <i class="fa fa-money pull-right text-white"></i>
											<b>View All Orders</b>
                                        </a>
                                    </h3>
                                </div>
                            </div>
                            <div class="panel panel-grey">
                                <div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseQuide">
                                            <i class="fa fa-plus-circle pull-right text-blue"></i> 
                                            Quick Tutorial
                                        </a>
                                    </h3>
                                </div>
                                <div id="collapseQuide" class="panel-collapse collapse">
                                    <div class="panel-body panel-body-2">
                                        Setup your Online Store Website by using the module options on the left sidebar. <br><br>
										Configure your store module settings, shipping & payments to go live.
										
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-grey">
                                <div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseLinks">
                                            <i class="fa fa-plus-circle pull-right text-blue"></i> 
                                            Help & Support
                                        </a>
                                    </h3>
                                </div>
                                <div id="collapseLinks" class="panel-collapse collapse">
                                    <div class="panel-body panel-body-2">
										<td><a href="#modal-guides" class="btn btn-sm btn-block btn-inverse" data-toggle="modal">Guides & Tutorials</a></td>
										<td><a href="#modal-forums" class="btn btn-sm btn-block btn-inverse" data-toggle="modal">Community Forums</a></td>
										<td><a href="#modal-tickets" class="btn btn-sm btn-block btn-inverse" data-toggle="modal">Support Tickets</a></td>
										<td><a href="#modal-cloudlogin" class="btn btn-sm btn-block btn-inverse" data-toggle="modal">My Account</a></td>
                                    </div>
                                </div>
                            </div>
                        </div>
					</li>
					<li class="nav-widget text-white">
						<div class="panel panel-grey">
						<div class="panel-heading panel-heading-2">
							<h3 class="panel-title title-14">
								<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseList">
									<i class="fa fa-question-circle pull-right" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Checklist to Configure Your Website"></i>
                                    To Do List
								</a>
							</h3>
						</div>
						<div id="collapseList" class="panel-collapse collapse">
						<div class="panel-body p-0">
							<ul class="todolist">
								<li class="active">
									<a href="javascript:;" class="todolist-container active" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Store Access</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Enable/Disable This Module</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Adjust Store Settings</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Add Store Categories</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Add Store Products</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Shipping Settings</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Add Payment Provider</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Invoice Details</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Usergroup Access</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Custom Checkout Options</div>
									</a>
								</li>
							</ul>
						</div>
						</div>
					</div>

				    </li>
				</ul>
				<!-- end sidebar user -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg sidebar-right"></div>
		<!-- end #sidebar-right -->
							<!-- #modal-dialog -->
							<div class="modal fade" id="modal-forums">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">BuilderEngine Support Forums</h4>
										</div>
										<div class="modal-body">
											You are about to leave your Administration Control Panel, click Continue to view page.
										</div>
										<div class="modal-footer">
											<a href="" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
											<a href="https://builderengine.com/forum/all_topics" target="_blank" class="btn btn-sm btn-success">Continue</a>
										</div>
									</div>
								</div>
							</div>
							<div class="modal fade" id="modal-guides">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">BuilderEngine Tutorials/Guides</h4>
										</div>
										<div class="modal-body">
											You are about to leave your Administration Control Panel, click Continue to view page.
										</div>
										<div class="modal-footer">
											<a href="" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
											<a href="https://builderengine.com/guides/all_posts" target="_blank" class="btn btn-sm btn-success">Continue</a>
										</div>
									</div>
								</div>
							</div>
							<div class="modal fade" id="modal-tickets">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">BuilderEngine Support Tickets</h4>
										</div>
										<div class="modal-body">
											You are about to leave your Administration Control Panel, click Continue to view page.
										</div>
										<div class="modal-footer">
											<a href="" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
											<a href="https://builderengine.com/support" target="_blank" class="btn btn-sm btn-success">Continue</a>
										</div>
									</div>
								</div>
							</div>
							<div class="modal fade" id="modal-cloudlogin">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">BuilderEngine Account Login</h4>
										</div>
										<div class="modal-body">
											You are about to leave your Administration Control Panel, click Continue to view page.
										</div>
										<div class="modal-footer">
											<a href="" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
											<a href="https://builderengine.com/account/dashboard" target="_blank" class="btn btn-sm btn-success">Continue</a>
										</div>
									</div>
								</div>
							</div>	
							<!-- end sidebar -->
		</div>
		<!-- end #content -->

<?php $groups = new Group;?>
<script>
    $(document).ready(function (){
        $('#access-groups').tagit({
            fieldName: "access_groups",
            singleField: true,
            showAutocompleteOnFocus: true,
            availableTags: [ <?php foreach ($groups->get() as $group): ?>"<?php echo $group->name?>", <?php endforeach;?>]
        });
    });
</script>
<?/* #multiple payment gateways disabled
<script>
    $(document).ready(function (){
        $('#payment-methods').tagit({
            fieldName: "payment_methods",
            singleField: true,
            showAutocompleteOnFocus: true,
			tagLimit: 1,
            availableTags: [ <?php foreach ($payment_methods as $payment_method): ?>"<?php echo $payment_method?>", <?php endforeach;?>]
        });
    });
</script>
*/?>
<?
	$payPalSettings = json_decode($this->BuilderEngine->get_option('be_builderpayment_paypal_settings'));
	$paypal_enabled = 'false';
	if(isset($payPalSettings)){
		if($payPalSettings->active == 'yes' && !empty($payPalSettings->paypal_address))
			$paypal_enabled = 'true';
	}
	$stripeSettings = json_decode($this->BuilderEngine->get_option('builderpayment-config-StripeGateway'));
	$stripe_enabled = 'false';
	if(isset($stripeSettings)){
		if(
			$stripeSettings->active == 'yes' && 
			(
				(!empty($stripeSettings->STRIPE_LIVE_API_PUBLISHABLE_KEY) && !empty($stripeSettings->STRIPE_LIVE_API_SECRET_KEY)) || 
				(!empty($stripeSettings->STRIPE_TEST_API_PUBLISHABLE_KEY) && !empty($stripeSettings->STRIPE_TEST_API_SECRET_KEY))
			)
		)
			$stripe_enabled = 'true';
	}
?>
<script>
	$(document).ready(function (){
		var selectedValue = $('#payment_methods').val();
		$('#payment_methods').on('change',function(){
			var selectedValue = this.value;
			var paypalEnabled = '<?=$paypal_enabled;?>';
			var stripeEnabled = '<?=$stripe_enabled?>';
			var payPalLink = '<?=base_url('admin/module/builderpayment/paypal_settings')?>';
			var stripeLink = '<?=base_url('admin/module/builderpayment/stripe_settings')?>';
			console.log(selectedValue);
			if(selectedValue == 'PayPal' && paypalEnabled == 'false'){
				$('#err').show();
				$('#gtwText').text('PayPal Settings');
				$('#gtwLink').attr('href',payPalLink);
				$('.suBtn').attr('disabled',true);
			}
			else if(selectedValue == 'Stripe' && stripeEnabled == 'false'){
				$('#err').show();
				$('#gtwText').text('Stripe Settings');
				$('#gtwLink').attr('href',stripeLink);
				$('.suBtn').attr('disabled',true);
			}
			else{
				$('#err').hide();
				$('.suBtn').attr('disabled',false);
			}
		});
    });
</script>
<script>
    $(document).ready(function (){
        $('#shop-groups').tagit({
            fieldName: "shop_groups",
            singleField: true,
            showAutocompleteOnFocus: true,
            availableTags: [ <?php foreach ($groups->get() as $group): ?>"<?php echo $group->name?>", <?php endforeach;?>]
        });
    });
</script>
<script>
    $(document).ready(function (){
        $('#reviews-groups').tagit({
            fieldName: "reviews_groups",
            singleField: true,
            showAutocompleteOnFocus: true,
            availableTags: [ <?php foreach ($groups->get() as $group): ?>"<?php echo $group->name?>", <?php endforeach;?>]
        });
    });
</script>
<script type="text/javascript">
    $('#shipping-select').on('change',function(){
        var selection = $(this).val();
        switch(selection){
            case "all":
                $("#shipping-options-all").show();
                $("#shipping-options-all").prop('disabled', false);
                break;
            default:
                $("#shipping-options-all").hide();
                $("#shipping-options-all").prop('disabled', true);
        }
    });
</script>
<script>
    $(document).ready(function (){
        $('#shippings').tagit({
            fieldName: "shippings",
            singleField: true,
            showAutocompleteOnFocus: true,
            availableTags: [ <?php $shippings = new Ecommerce_shipping(); foreach ($shippings->get() as $shipping): ?>"<?php echo $shipping->name?>", <?php endforeach;?>]
        });
    });
</script>