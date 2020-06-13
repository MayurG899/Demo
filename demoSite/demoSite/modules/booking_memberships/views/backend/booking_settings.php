<script src="<?php echo get_theme_path()?>assets/plugins/jquery/jquery-1.9.1.min.js"></script>
<script src="<?=base_url()?>builderengine/public/js/editor/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function (){
        CKEDITOR.replace( 'editor1' );
    });
</script>
<script type="text/javascript">
    $(document).ready(function (){
        CKEDITOR.replace( 'editor2' );
    });
</script>
<div id="content" class="page-with-two-sidebar content-two-sidebars" style="min-height:800px">
<!-- begin row -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                </div>
                <h4 class="panel-title">Booking Memberships Settings</h4>
            </div>
            <div class="panel-body panel-form">
                <form class="form-horizontal form-bordered" method="post" data-parsley-validate="true" name="demo-form">
					<div class="form-group" id="visible">
						<label class="control-label col-md-4 col-sm-4 col-be-4" for="forum_active">Memberships Module Active:</label>
						<div class="col-md-6 col-sm-6">
							<?php if($this->BuilderEngine->get_option('booking_memberships_active') == 'yes')
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
                                <input type="radio" name="booking_memberships_active" id="disabled" value="yes" <?=$check1?>/>
                                Yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="booking_memberships_active" id="active" value="no" <?=$check2?>/>
                               No
                            </label>
						</div>
					</div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-be-4" for="required"><b>Default Currency:</b></label>
                        <div class="col-md-6 col-sm-6">
                            <? $currencies = new Currency();?>
                            <select class="form-control" name="default_currency">
                                <?foreach ($currencies->get() as $currency) :?>
                                    <?if($currency->id == $this->BuilderEngine->get_option('be_booking_memberships_default_currency')):?>
                                        <option value="<?=$currency->id?>" selected="selected"><?=$currency->name?> - (<?=$currency->signature?>)</option>
                                    <?else:?>
                                        <option value="<?=$currency->id?>"><?=$currency->name?> - (<?=$currency->signature?>)</option>
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
								$active_method = $this->BuilderEngine->get_option('be_booking_memberships_payment_methods');
							?>
							<select id="payment_methods" class="form-control" name="payment_methods">
								<?foreach($payment_methods as $method):?>
									<option value="<?=$method?>" <?if($method == $active_method) echo 'selected';?>><?=$method?></option>
								<?endforeach?>
							</select>
							<br/>
							<div id="err" class="alert alert-danger" style="display:none">
								<p><i class="fa fa-exclamation-triangle"></i> Warrning! In order to use this gateway,you need to enable it first.<br/><a id="gtwLink" href="" class="btn btn-xs btn-warning"><i class="fa fa-cog"></i> <span id="gtwText"></span></a></p>
							</div>
									<?/* # multiple payment gateways disabled
                                    <?$methods = $this->BuilderEngine->get_option('be_booking_rooms_payment_methods');?>
                                    <?if($methods == ''):?>
                                        <?php foreach($payment_methods as $method):?>
                                            <li><?=$method?></li>
                                        <?php endforeach?>
                                    <?else:?>
                                        <?php $methods = explode(',', $this->BuilderEngine->get_option('be_booking_rooms_payment_methods'));?>
                                        <?php foreach($methods as $method):?>
                                            <li><?=$method?></li>
                                        <?php endforeach?>
                                    <?endif;?>
									*/?>
                            </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-be-4" for="website"><b>Usergroups Allowed to Book</b></label>
                        <div class="form-group">
                            <div class="col-md-8 col-sm-8">
                                <ul id="shop-groups">
                                    <?php $groups = explode(',', $this->BuilderEngine->get_option('be_booking_memberships_shop_groups'));?>
                                    <?php foreach($groups as $group):?>
                                        <li><?=$group?></li>
                                    <?php endforeach?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-be-4" for="website"><b>Usergroups Allowed to Add Memberships:</b></label>
                        <div class="form-group">
                            <div class="col-md-8 col-sm-8">
                                <ul id="service-groups">
                                    <?php $groups = explode(',', $this->BuilderEngine->get_option('be_booking_memberships_add_membership_groups'));?>
                                    <?php foreach($groups as $group):?>
                                        <li><?=$group?></li>
                                    <?php endforeach?>
                            </div>
                        </div>
                    </div>				
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-be-4" for="website">
						Module Default Registration Group(s):
						<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Allows a group membership policy to be defined for users registering by way of this Modules registration page, that takes precedence over the system default user group."></i></label>
						<div class="form-group">
						<div class="col-md-8 col-sm-8">
                            <ul id="access-groups">
		                      <?php $groups = explode(',', $this->BuilderEngine->get_option('be_booking_memberships_access_groups'));?>
		                      <?php foreach($groups as $group):?>
		                      	<li><?=$group?></li>
		                      <?php endforeach?>
							</div>
						</div>
					</div>
					<style>.price{margin-bottom:5px;}</style>
					<!--<div class="form-group">
						<label class="control-label col-md-4">Block Booking Event Dates:</label>
						<div class="col-md-8">
							<div class="input-group" id="default-daterange">
								<input type="text" name="default-daterange" class="form-control" value="" placeholder="click to select the date range" />
								<span class="input-group-btn">
									<button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
								</span>
							</div>
						</div>
					</div>-->
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-be-4" for="active">
							<b>Block Membership Dates:</b>
							<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Block Booking Membership Dates"></i>
						</label>
						<?php
							$event_block_start = $this->BuilderEngine->get_option('be_booking_memberships_event_block_start_date');
							$event_block_end = $this->BuilderEngine->get_option('be_booking_memberships_event_block_end_date');
						?>
						<div class="col-md-8 col-sm-8">
							<label class="col-md-5 control-label">Block Dates From:
								<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Membership Start Date"></i>
							</label>
							<div class="col-md-6">
								<input type="text" class="form-control form-control-100 price" name="event_block_start_date" value="<?php if(!empty($event_block_start)) echo date("m/d/Y", strtotime($event_block_start));?>" id="bookingSettingEventStartDate" placeholder="Start date" />
							</div>
							<label class="col-md-5 control-label">Block Dates To:
								<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Membership End Date"></i>
							</label>
							<div class="col-md-6">
								<input type="text" class="form-control form-control-100 price" name="event_block_end_date" value="<?php if(!empty($event_block_end)) echo date("m/d/Y", strtotime($event_block_end));?>" id="bookingSettingEventEndDate" placeholder="End date" />
							</div>	
						</div>
					</div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-be-4" for="required"><b>Terms and Conditions URL:</b></label>
                        <div class="col-md-6 col-sm-6">
                                <input type="text" name="terms_conditions_url" class="required form-control" value="<?=$this->BuilderEngine->get_option('be_booking_memberships_settings_url')?>">
                        </div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-be-4" for="required"><b>Membership Approval Email Message:</b></label>
                        <div class="col-md-8 col-sm-8">
                            <textarea id="editor1" name="approval_email" class="ckeditor form-control" ><?=$this->BuilderEngine->get_option('be_booking_memberships_approval_email')?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-be-4" for="required"><b>Membership Rejection Email Message:</b></label>
                        <div class="col-md-8 col-sm-8">
                            <textarea id="editor2" name="rejected_email" class="ckeditor form-control" ><?=$this->BuilderEngine->get_option('be_booking_memberships_rejected_email')?></textarea>
                        </div>
                    </div>
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-be-4"></label>
						<div class="col-md-6 col-sm-6">
							<button type="submit" class="btn btn-primary">Save Booking Settings</button>
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
					<h4 class="sidebar-right-main-title">Booking Memberships</h4>
					<li class="nav-widget">
                        <div class="panel-group m-b-0" id="accordion">
							<div class="panel panel-grey panel-bg-buttons">
                                <div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('booking_memberships/memberships');?>" target="_blank" class="btn btn-sm btn-block btn-success btn-r-sidebar-2">
                                            <i class="fa fa-file-o pull-right text-white"></i>
											<b>Memberships Page</b>
                                        </a>
                                    </h3>
                                </div>
								<div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('admin/module/booking_memberships/add_membership');?>" class="btn btn-sm btn-block btn-indigo btn-r-sidebar-2">
                                            <i class="fa fa-calendar pull-right text-white"></i>
											<b>Add Membership</b>
                                        </a>
                                    </h3>
                                </div>
								<div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('admin/module/booking_memberships/show_memberships');?>" class="btn btn-sm btn-block btn-indigo btn-r-sidebar-2">
                                            <i class="fa fa-calendar pull-right text-white"></i>
											<b>All Memberships</b>
                                        </a>
                                    </h3>
                                </div>
								<div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('admin/module/booking_memberships/show_membership_orders');?>" class="btn btn-sm btn-block btn-indigo btn-r-sidebar-2">
                                            <i class="fa fa-money pull-right text-white"></i>
											<b>All Applications</b>
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
                                        Setup your Booking Memberships Website by using the module options on the left sidebar. <br><br>
										Allow visitors to sign-up & pay for membership or wait for approval by you.
										
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
										<div class="todolist-title">Membership Access</div>
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
										<div class="todolist-title">Adjust Membership Settings</div>
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
										<div class="todolist-title">Add Category</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Add Membership</div>
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
										<div class="todolist-title">Membership Dates</div>
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

        $('#shop-groups').tagit({
            fieldName: "shop_groups",
            singleField: true,
            showAutocompleteOnFocus: true,
            availableTags: [ <?php foreach ($groups->get() as $group): ?>"<?php echo $group->name?>", <?php endforeach;?>]
        });
		
        $('#event-groups').tagit({
            fieldName: "event_groups",
            singleField: true,
            showAutocompleteOnFocus: true,
            availableTags: [ <?php foreach ($groups->get() as $group): ?>"<?php echo $group->name?>", <?php endforeach;?>]
        });

        $('#service-groups').tagit({
            fieldName: "membership_groups",
            singleField: true,
            showAutocompleteOnFocus: true,
            availableTags: [ <?php foreach ($groups->get() as $group): ?>"<?php echo $group->name?>", <?php endforeach;?>]
        });

        $('#room-groups').tagit({
            fieldName: "room_groups",
            singleField: true,
            showAutocompleteOnFocus: true,
            availableTags: [ <?php foreach ($groups->get() as $group): ?>"<?php echo $group->name?>", <?php endforeach;?>]
        });

        $('#payment-methods').tagit({
            fieldName: "payment_methods",
            singleField: true,
            showAutocompleteOnFocus: true,
            availableTags: [ <?php foreach ($payment_methods as $payment_method): ?>"<?php echo $payment_method?>", <?php endforeach;?>]
        });
    });
</script>		
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