<?php echo get_header() ?>

<?php echo get_sidebar() ?>

<!-- begin #content -->
<div id="content" class="content page-with-two-sidebar content-two-sidebars" style="min-height:800px">

<!-- end page-header -->
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
                            <h4 class="panel-title">Adjust Website Settings & Security</h4>
                        </div>
                        <div class="panel-body panel-form">
                            <form class="form-horizontal form-bordered" method="post" data-parsley-validate="true" name="demo-form">
								
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-be-4" for="website">Usergroups Allowed to Access Website:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Decide which Usergroups can view Website Pages - Example: Guests equals public visitors, remove guests & the website pages are private to members"></i></label>
									<div class="form-group">
									<div class="col-md-8 col-sm-8">
                                        <ul id="jquery">
										<?php $default_groups = explode(',',$default_website_access_groups);?>
										<?php foreach($default_groups as $default_group):?>
											<li value="<?=$default_group?>"><?=$default_group?></li>
										<?php endforeach;?>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-be-4" for="ect">Erase Content Tools:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Enable to allow erasing/wiping of content data in the database on pages"></i></label>
									<div class="col-md-6 col-sm-6">
										<?php if( $erase_content_control == 'off' || empty($erase_content_control))
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
											<input type="radio" id="erase_content_control" name="erase_content_control" value="off" <?php echo $check1?>/>
											Off
										</label>
										<label class="radio-inline">
											<input type="radio" id="erase_content_control" name="erase_content_control" value="on" <?php echo $check2?>/>
											On - Available To Use
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-be-4" for="adminemail">Default Admin Email Address:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="The Email Address used here gets most admin related email notices"></i></label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" id="adminemail" value="<?php echo $builderengine->get_option("adminemail");?>" name="adminemail" placeholder="Enter Default Email Address for Admin" data-parsley-required="true" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-be-4" for="adminemail">Force secure connection (https):
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Force secure https protocol connection site wide"></i></label>
									<div class="col-md-6 col-sm-6">
										<?php if( $force_https == 'off' || empty($force_https))
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
											<input type="radio" id="force_https" name="force_https" value="off" <?php echo $check1?>/>
											Off
										</label>
										<label class="radio-inline">
											<input type="radio" id="force_https" name="force_https" value="on" <?php echo $check2?>/>
											On
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-be-4" for="adminemail">Security Count Login Attempts:
									<i class="fa fa-question-circle" style="font-size:16px;color: red;" data-toggle="tooltip" data-placement="top" title="If set to 'On', this option prevents brute-force attacks.Highly recommended!"></i></label>
									<div class="col-md-3 col-sm-3">
										<select id="select-required" name="login_count_attempts" class="form-control" required >
											<option value="yes" <?php if($login_count_attempts == 'yes') echo "selected"?>>On</option>
											<option value="no" <?php if($login_count_attempts == 'no') echo "selected"?>>Off</option>
										</select>
									</div>
								</div>
								<div id="live">
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-be-4" for="login_max_attempts">Max Login Attempts:
										<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Number of maximum login attempts allowed"></i></label>
										<div class="col-md-6 col-sm-6">
											<input class="form-control" type="number" min="0" step="1" data-number-to-fixed="2" data-number-stepfactor="1" id="login_max_attempts" value="<?php echo $builderengine->get_option("login_max_attempts");?>" name="login_max_attempts" placeholder="Number of maximum login attempts allowed" required />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-be-4" for="login_attempt_expire">Login Attempt Auto Expiry Time:<br/> [in seconds] <br/> (example: 24h = 86400 seconds) 
										<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Login attempt expiry time (in seconds)"></i></label>
										<div class="col-md-6 col-sm-6">
											<input class="form-control" type="number" min="0" step="1" data-number-to-fixed="2" data-number-stepfactor="1" id="login_attempt_expire" value="<?php echo $builderengine->get_option("login_attempt_expire");?>" name="login_attempt_expire" placeholder="Login attempt expiry time (in seconds)" required />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-4 col-sm-4 col-be-4" for="notify_admin_about_banned_user">Notify Admin On Suspended Accounts:
										<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Notify Admin about banned users"></i></label>
										<div class="col-md-3 col-sm-3">
											<select id="notify_admin_about_banned_user" name="notify_admin_about_banned_user" class="form-control" required >
												<option value="yes" <?php if($notify_admin_about_banned_user == 'yes') echo "selected"?>>Yes</option>
												<option value="no" <?php if($notify_admin_about_banned_user == 'no') echo "selected"?>>No</option>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-be-4" for="google_maps_api_key">Google Maps Api Key:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Go to the Google Maps Api`s Page and get your api key.You are currently using demo one.Warning!Maps wont show up on your website until you fill in and save your key here."></i>
									<br/><a class="btn btn-xs btn-success" href="https://developers.google.com/maps/documentation/embed/get-api-key" target="_blank"><i class="fa fa-download"></i> Get Your Api Key Here</a>
									</label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" id="google_maps_api_key" value="<?php echo $builderengine->get_option("google_maps_api_key");?>" name="google_maps_api_key" placeholder="Google Maps Api Key" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-be-4"></label>
									<div class="col-md-6 col-sm-6">
										<button type="submit" class="btn btn-primary">Save Settings</button>
									</div>
								</div>
                            </form>
                        </div>
                    </div>
			        <div class="panel panel-white">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            </div>
                            <h4 class="panel-title">Social Login Settings</h4>
                        </div>
                        <div class="panel-body">
							<form class="form-horizontal form-bordered" method="post" data-parsley-validate="true" name="demo-form">
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-be-4">Login With Facebook
										<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Facebook Login Settings"></i><br/><br/>
										<a href="https://developers.facebook.com/" class="btn btn-xs btn-success" target="_blank"><i class="fa fa-cog"></i> Create New Facebook App </a>
								    </label>
									<div class="col-md-8 col-sm-8">
										<div class="row">
											<div class="col-md-12">
												<?php if( $facebook_login == 'off' || empty($facebook_login))
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
													<input type="radio" id="facebook_login" name="facebook_login" value="off" <?=$check1?>/>
													Disabled
												</label>
												<label class="radio-inline">
													<input type="radio" id="facebook_login1" name="facebook_login" value="on" <?=$check2?>/>
													Enabled
												</label>
											</div>
											<hr/>
											<div class="col-md-12 m-t-10">
												<label>Facebook App ID</label><br/>
												<input class="form-control" type="text" id="facebook_app_id" value="<?=$builderengine->get_option("facebook_app_id");?>" name="facebook_app_id" placeholder="Facebook App ID" style="width:100%" />
											</div>
											<div class="col-md-12 m-t-10">
												<label>Facebook App Secret</label><br/>
												<input class="form-control" type="password" id="facebook_app_secret" value="<?=$builderengine->get_option("facebook_app_secret");?>" name="facebook_app_secret" placeholder="Facebook App Secret" style="width:100%" />
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-be-4"></label>
									<div class="col-md-6 col-sm-6">
										<button type="submit" class="btn btn-primary">Save</button>
									</div>
								</div>
							</form>
                        </div>
                    </div>
			        <div class="panel panel-white">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            </div>
                            <h4 class="panel-title">Admin Dashboard Type Selection</h4>
                        </div>
                        <div class="panel-body">
							<form class="form-horizontal form-bordered" method="post" data-parsley-validate="true" name="demo-form">
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-be-4">Admin Dashboard Type
										<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Admin dashboard type selection"></i>
								    </label>
									<div class="col-md-4 col-sm-4 col-be-4">
										<select name="admin_dashboard_selection" class="form-control">
											<option value="default" <? if($admin_dashboard_selection == 'default') echo 'selected';?>>Default</option>
											<option value="online_store" <? if($admin_dashboard_selection == 'online_store') echo 'selected';?>>Online Store</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-be-4">Admin Theme Color Pattern
										<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Admin Theme Color selection"></i>
								    </label>
									<div class="col-md-4 col-sm-4 col-be-4">
										<select name="admin_theme_color_pattern" class="form-control">
											<option value="default" <? if($admin_theme_color_pattern == 'default') echo 'selected';?>>Default</option>
											<?/*
											<option value="green" <? if($admin_theme_color_pattern == 'green') echo 'selected';?>>Green</option>
											<option value="blue" <? if($admin_theme_color_pattern == 'blue') echo 'selected';?>>Blue</option>
											<option value="white" <? if($admin_theme_color_pattern == 'white') echo 'selected';?>>White</option>
											*/?>
											<option value="bizengine" <? if($admin_theme_color_pattern == 'bizengine') echo 'selected';?>>BizEngine</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-be-4">Admin Left Sidebar Minimized
										<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Admin Left Sidebar Minimzed"></i>
								    </label>
									<div class="col-md-4 col-sm-4 col-be-4">
										<select name="admin_left_sidebar_minimized" class="form-control">
											<option value="off" <? if($admin_left_sidebar_minimized == 'off') echo 'selected';?>>Off</option>
											<option value="on" <? if($admin_left_sidebar_minimized == 'on') echo 'selected';?>>On</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-be-4"></label>
									<div class="col-md-6 col-sm-6">
										<button type="submit" class="btn btn-primary">Save</button>
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
					<h4 class="sidebar-right-main-title">Website Settings</h4>
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
                                        Control the settings for your entire website here and select your preferred dashboard type.
										
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
										<div class="todolist-title">Website Settings</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Usergroups Allowed</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">System Email</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">HTTPS Confirmed</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Security Options</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Dashboard Type</div>
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
	</div>
	<!-- end page container -->
<?php echo get_footer()?>
<?php $groups = new Group;?>
<script>
    $(document).ready(function (){
	    $('#jquery').tagit({
	        fieldName: "default_website_access_group",
	        singleField: true,
	        showAutocompleteOnFocus: true,
	        availableTags: [ <?php foreach ($groups->get() as $group): ?>"<?php echo $group->name?>", <?php endforeach;?>]
	    });
		
		$('#tutorials-switch').click(function(){
			$.ajax({
				url: "<?=base_url('admin/ajax/switch_tutorials_state')?>",
				context: document.body
			}).done(function() {
				var switcher = $('#tutorials-switch').find('.fa').first();
				if(switcher.hasClass( "fa-toggle-on"))
					switcher.removeClass("fa-toggle-on").addClass('fa-toggle-off');
				else
					switcher.removeClass("fa-toggle-off").addClass('fa-toggle-on');
			});
		});

		var loaded = $( "#select-required option:selected" ).val();
		if(loaded == 'yes'){
			$('#live').show('fast');
			$('#live :input').attr('required','required');
		}else{
			$('#live').hide('fast');
			$('#live :input').removeAttr('required');
		}
		$("#select-required").change(function(){
			var option = $( "#select-required option:selected" ).val();
			if(option == 'no'){
				$('#live').hide('fast');
				$('#live :input').removeAttr('required');
			}else{
				$('#live').show('fast');
				$('#live :input').attr('required','required');
			}
		});
	});
</script>