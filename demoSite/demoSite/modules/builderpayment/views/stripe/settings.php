<?/*
<script src="<?=get_theme_path()?>js/plugins/forms/uniform/jquery.uniform.min.js"></script>
<script src="<?=get_theme_path()?>js/plugins/forms/validation/jquery.validate.js"></script>
<script src="<?=get_theme_path()?>js/plugins/forms/select2/select2.js"></script>
<script src="<?=get_theme_path()?>js/pages/form-validation.js"></script><!-- Init plugins only for page -->
<link href="<?=get_theme_path()?>js/plugins/forms/select2/select2.css" rel="stylesheet" />
*/?>
<script src="<?php echo get_theme_path()?>assets/plugins/jquery/jquery-1.9.1.min.js"></script>
<div id="content" class="page-with-two-sidebar content-two-sidebars" style="min-height:800px">
<!-- begin row -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                </div>
                <h4 class="panel-title">Stripe Payments - Main Settings</h4>
            </div> 
					<div class="panel-body panel-form">
						<form class="form-horizontal form-bordered" method="post" data-parsley-validate="true" name="demo-form">
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4" for="stripesandlive">Stripe Sandbox or Live</label>
								<div class="form-group">
									<div class="col-md-3 col-sm-3">
										<select class="form-control" id="select-required" name="STRIPE_SANDBOX" data-parsley-required="true">
											<option value='0' <?php if($STRIPE_SANDBOX == '0') echo "selected"?>>Sandbox</option>
											<option value='1' <?php if($STRIPE_SANDBOX == '1') echo "selected"?>>Live</option>
										</select>
									</div>
								</div>
							</div>
							<div id="testKeys">
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="stripetestkey">TEST API Publishable Key:</label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" value="<?=$STRIPE_TEST_API_PUBLISHABLE_KEY?>" id="stripetestkey" name="STRIPE_TEST_API_PUBLISHABLE_KEY" placeholder="Enter Your TEST API Publishable Key" required />
									</div>
								</div>
								<div class="form-group">
								   <label class="control-label col-md-4 col-sm-4" for="stripetestkey">TEST API Secret Key:</label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" value="<?=$STRIPE_TEST_API_SECRET_KEY?>" id="stripetestkey" name="STRIPE_TEST_API_SECRET_KEY" placeholder="Enter Your TEST API Secret Key" required />
									</div>
								</div>
							</div>
							<div id="liveKeys">
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="stripelivekey">LIVE API Publishable KEY:</label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" value="<?=$STRIPE_LIVE_API_PUBLISHABLE_KEY?>" id="stripelivekey" name="STRIPE_LIVE_API_PUBLISHABLE_KEY" placeholder="Enter Your LIVE API Publishable Key" required />
									</div>
								</div>
								<div class="form-group">
								   <label class="control-label col-md-4 col-sm-4" for="stripetestkey">LIVE API Secret Key:</label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" value="<?=$STRIPE_LIVE_API_SECRET_KEY?>" id="stripetestkey" name="STRIPE_LIVE_API_SECRET_KEY" placeholder="Enter Your LIVE API Secret Key " required />
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4" for="activestripe">Active Stripe</label>
								<div class="form-group">
									<div class="col-md-2 col-sm-2">
										<select class="form-control" id="select-required" name="active" data-parsley-required="true">
											<option value='yes' <?php if(!empty($active) && $active == 'yes') echo "selected"?>>Yes</option>
											<option value='no' <?php if($active == 'no') echo "selected"?>>No</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4"></label>
								<div class="col-md-6 col-sm-6">
									<button type="submit" class="btn btn-primary" value="Save Settings">Save Stripe Details</button>
								</div>
							</div>
					    </form>
					</div>
				</div>
				<!-- end panel -->
			</div>
</div>
<!-- end row -->
<!-- begin #sidebar-right -->
		<div id="sidebar-right" class="sidebar sidebar-right">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav m-t-10">
					<h4 class="sidebar-right-main-title">Stripe Payments</h4>
					<li class="nav-widget">
                        <div class="panel-group m-b-0" id="accordion">
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
                                        Setup your Stripe Details for your Website. <br><br>
										Enter Stripe Test Codes to test payments out.<br><br>
										Enter Stripe Test Live codes to Accept Payments.
										
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
										<div class="todolist-title">Stripe Payments</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Enter Publishable Key</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Enter Secret Key</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Change Sandbox Test To Live</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Activate Provider</div>
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
	<!-- begin scroll to top btn -->
	<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	<!-- end scroll to top btn -->
<!-- end page container -->
<script>
$(document).ready(function (){
	var loaded = $( "#select-required option:selected" ).val();
	if(loaded == '0'){
		$('#liveKeys').hide('fast');
		//$('#liveKeys :input').attr('disabled','disabled');
		$('#liveKeys :input').removeAttr('required');
		$('#testKeys').show('fast');
		//$('#testKeys :input').removeAttr('disabled');
		$('#testKeys :input').attr('required','required');
	}else{
		$('#testKeys').hide('fast');
		//$('#testKeys :input').attr('disabled','disabled');
		$('#testKeys :input').removeAttr('required');
		$('#liveKeys').show('fast');
		//$('#liveKeys :input').removeAttr('disabled');
		$('#liveKeys :input').attr('required','required');
	}
	$("#select-required").change(function(){
		var option = $( "#select-required option:selected" ).val();
		if(option == '0'){
			$('#liveKeys').hide('fast');
			//$('#liveKeys :input').attr('disabled','disabled');
			$('#liveKeys :input').removeAttr('required');
			$('#testKeys').show('fast');
			//$('#testKeys :input').removeAttr('disabled');
			$('#testKeys :input').attr('required','required');
		}else{
			$('#testKeys').hide('fast');
			//$('#testKeys :input').attr('disabled','disabled');
			$('#testKeys :input').removeAttr('required');
			$('#liveKeys').show('fast');
			//$('#liveKeys :input').removeAttr('disabled');
			$('#liveKeys :input').attr('required','required');
		}
	});
});
</script>