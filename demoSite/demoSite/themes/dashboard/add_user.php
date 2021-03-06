<?php echo get_header() ?>
<?php echo get_sidebar() ?>
<?include('modules/ecommerce/assets/misc/country_list.php');?>
<!-- begin #content -->
<div id="content" class="content page-with-two-sidebar content-two-sidebars">
			<!-- begin row -->
			<div class="row">
                <!-- begin col-8 -->
			    <div class="col-md-12">
					<form class="form-horizontal form-bordered" data-parsley-validate="true" name="demo-form" method="post" enctype="multipart/form-data">
						<!-- begin panel -->
						<div class="panel panel-white">
							<div class="panel-heading">
								<div class="panel-heading-btn">
									<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								</div>
								<h4 class="panel-title">Create New User (Member) Account</h4>
							</div>
							<div class="panel-body panel-form">
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-be-4" for="fullname"><b>Username:</b>
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Create Username"></i></label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" id="username" name="username" placeholder="Required" data-parsley-required="true" required />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-be-4" for="fullname"><b>First Name:</b>
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Enter First Name"></i></label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" id="firstname" name="first_name" placeholder="First Name" data-parsley-required="true" required />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-be-4" for="fullname"><b>Surname Name:</b>
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Enter Surname"></i></label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" id="surname" name="last_name" placeholder="Surname Name" data-parsley-required="true" required />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-be-4" for="fullname"><b>Avatar:</b>
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Add Profile Photo"></i></label>
									<div class="col-md-6 col-sm-6">
										<span class="btn btn-success fileinput-button">
											<i class="fa fa-plus"></i>
											<span>Add image...</span>
											<style>
												.file_preview {
													max-height: 100px;
													margin-top: 10px;
												}
												.profile-avatar{
													float:none !important;
													margin-left: -14px;
												}
												.profile-avatar img{
													width:100px !important;
													max-height:50%;
													max-width:50%;
												}
											</style>
											<input type="file" name="avatar" rel="file_manager" id="f">
										</span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-be-4" for="email"><b>Email:</b>
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Enter Email - Also Used For Recovery"></i></label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="email" id="email" name="email" data-parsley-type="email" placeholder="Email" data-parsley-required="true" required />
										<br/>
										<div id="emailError" class="alert alert-danger" style="display:none">
											<p><i class="fa fa-exclamation-triangle"></i> Email already taken,please choose another!</p>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-be-4" for="fullname"><b>Password:</b>
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Create a Strong Password"></i></label>
									<div class="form-group">
									<div class="col-md-6 col-sm-6">			
										<input type="text" name="password" id="password-indicator-visible" class="form-control m-b-5" required />
										<div id="passwordStrengthDiv2" class="is0 m-t-5"></div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-be-4" for="website"><b>Usergroup Access Allowed:</b>
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Which Usergroup/Membership Should This User Belong to?"></i></label>
									<div class="form-group">
									<div class="col-md-6 col-sm-6">
										<ul id="user-groups-select">
											<li>Guests</li>
											<li>Members</li>
										</ul>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-be-4"></label>
									<div class="col-md-6 col-sm-6">
										<button type="submit" class="suBtn btn btn-primary">Create New User</button>
									</div>
								</div>
							</div>
						</div>
						<!-- end panel -->
						<!-- Billing info panel -->
						<div class="panel panel-white">
							<div class="panel-heading">
								<div class="panel-heading-btn">
									<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								</div>
								<h4 class="panel-title"> Account Information & Billing Address</h4>
							</div>
							<div class="panel-body panel-form">
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-be-4" for="address"><b>Address:</b>
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Enter Billing Address"></i></label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" id="address" name="address" placeholder="Billing Address" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-be-4" for="city"><b>City:</b>
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Enter City"></i></label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" id="city" name="city" placeholder="City" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-be-4" for="city"><b>State:</b>
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Enter State"></i></label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" id="state" name="state" placeholder="State" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-be-4" for="zip"><b>Zip Code:</b>
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Enter Zip Code"></i></label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" id="zip" name="zip" placeholder="Zip Code" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-be-4" for="country"><b>Country:</b>
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Select your country"></i></label>
									<div class="col-md-6 col-sm-6">
										<select class="form-control" name="country" id="country" placeholder="Select Country">
											<option value="">Select Country</option>
											<? foreach ($countries as $country):?>
												<option value="<?=$country?>"><?=$country?></option>
											<? endforeach;?>
										</select>
									</div>
								</div>	
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-be-4" for="telephone"><b>Phone:</b>
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Enter Your Phone Number"></i></label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" id="telephone" name="telephone" placeholder="Enter Your Phone Number" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-be-4" for="gender"><b>Gender:</b>
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Select your gender"></i></label>
									<div class="col-md-6 col-sm-6">
										<select class="form-control" name="gender" id="gender" placeholder="Select Gender">
											<option value="male">Male</option>
											<option value="female">Female</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-be-4" for="telephone"><b>Company:</b>
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Enter Your Company Name"></i></label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" id="company" name="company" placeholder="Enter Your Company Name" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-be-4"></label>
									<div class="col-md-6 col-sm-6">
										<button type="submit" class="suBtn btn btn-primary"><i class="fa fa-check"></i> Save </button>
									</div>
								</div>
							</div>
						</div>
					</form>
                </div>
            </div>
            <!-- end row -->
			<!-- begin #sidebar-right -->
		<div id="sidebar-right" class="sidebar sidebar-right">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav m-t-10">
					<h4 class="sidebar-right-main-title">User Accounts</h4>
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
                                        Add a new user (member) account manually to your website or create new admin accounts.
										
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
										<div class="todolist-title">User Accounts</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Add New Member</div>
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
										<div class="todolist-title">Account Details</div>
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
<?php echo get_footer()?>
<script>
    $('#user-groups-select').tagit({
        fieldName: "groups",
        singleField: true,
        showAutocompleteOnFocus: true,
        availableTags: [ <?php foreach ($groups as $group): ?>"<?php echo $group->name?>", <?php endforeach;?>]
    });

	$("#f").click(function(e){
	   e.preventDefault();
	});

	$(document).ready(function(){
		var email = $('#email').val();
		$('#email').on('blur keyup change click',function(event){
			var email = this.value;
			$.ajax({
				url: '<?=base_url('admin/ajax/check_if_email_exists')?>',
				type: "POST",
				data: {email: email},
				aync: false,
				success: function (data){
					if(data == 'true' || email == this.value) {
						$('#emailError').show();
						$('.suBtn').attr('disabled',true);
					} else {
						$('#emailError').hide();
						$('.suBtn').attr('disabled',false);
					}
				}
			});
		});
	});
</script>