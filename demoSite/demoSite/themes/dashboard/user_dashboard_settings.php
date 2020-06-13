<?php echo get_header() ?>

<?php echo get_sidebar() ?>
<!-- begin #content -->
<div id="content" class="content page-with-two-sidebar content-two-sidebars" style="min-height:800px">
			<!-- begin row -->
			<div class="row">
                <!-- begin col-8 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
                    <form id="dashForm" class="form-horizontal form-bordered" enctype="multipart/form-data" method="post" data-parsley-validate="true" name="demo-form">
                    <div class="panel panel-white">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            </div>
                            <h4 class="panel-title">Account Dashboard Settings For Members</h4>
                        </div>
                        <div class="panel-body panel-form">

								
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="fullname">Account Dashboard Active:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Enable or Disable the User Dashboard - Disabled equals No User Registrations"></i></label>
									<div class="col-md-6 col-sm-6">
										<label class="radio-inline">
										 	<input type="radio" name="user_dashboard_activ" value="yes" <?php echo ( !$user_dashboard_activ ) ? 'checked="checked"' : ''; ?> > Enable
										</label>
										<label class="radio-inline">
										  	<input type="radio" name="user_dashboard_activ" value="no" <?php echo ( $user_dashboard_activ ) ? 'checked="checked"' : ''; ?> > Disable
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="fullname">Account Dashboard File Manager:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Enable or Disable the User Dashboard File Manager "></i></label>
									<div class="col-md-6 col-sm-6">
										<label class="radio-inline">
										 	<input type="radio" name="user_dashboard_file_manager" value="yes" <?php echo ( !$user_dashboard_file_manager ) ? 'checked="checked"' : ''; ?> > Enable
										</label>
										<label class="radio-inline">
										  	<input type="radio" name="user_dashboard_file_manager" value="no" <?php echo ( $user_dashboard_file_manager ) ? 'checked="checked"' : ''; ?> > Disable
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="fullname">Account Dashboard - Blog Module:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Enable or Disable the Blog App Section in the User Dashboard"></i></label>
									<div class="col-md-6 col-sm-6">
										<label class="radio-inline">
										 	<input type="radio" name="user_dashboard_blog" value="yes" <?php echo ( !$user_dashboard_blog ) ? 'checked="checked"' : ''; ?> > Enable
										</label>
										<label class="radio-inline">
										  	<input type="radio" name="user_dashboard_blog" value="no" <?php echo ( $user_dashboard_blog ) ? 'checked="checked"' : ''; ?> > Disable
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="fullname">Account Dashboard - Booking Events Module:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Enable or Disable the Booking Events App Section in the User Dashboard"></i></label>
									<div class="col-md-6 col-sm-6">
										<label class="radio-inline">
										 	<input type="radio" name="user_dashboard_booking_events" value="yes" <?php echo ( !$user_dashboard_booking_events ) ? 'checked="checked"' : ''; ?> > Enable
										</label>
										<label class="radio-inline">
										  	<input type="radio" name="user_dashboard_booking_events" value="no" <?php echo ( $user_dashboard_booking_events ) ? 'checked="checked"' : ''; ?> > Disable
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="fullname">Account Dashboard - Booking Rooms Module:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Enable or Disable the Booking Rooms App Section in the User Dashboard"></i></label>
									<div class="col-md-6 col-sm-6">
										<label class="radio-inline">
										 	<input type="radio" name="user_dashboard_booking_rooms" value="yes" <?php echo ( !$user_dashboard_booking_rooms ) ? 'checked="checked"' : ''; ?> > Enable
										</label>
										<label class="radio-inline">
										  	<input type="radio" name="user_dashboard_booking_rooms" value="no" <?php echo ( $user_dashboard_booking_rooms ) ? 'checked="checked"' : ''; ?> > Disable
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="fullname">Account Dashboard - Booking Memberships Module:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Enable or Disable the Booking Memberships App Section in the User Dashboard"></i></label>
									<div class="col-md-6 col-sm-6">
										<label class="radio-inline">
										 	<input type="radio" name="user_dashboard_booking_memberships" value="yes" <?php echo ( !$user_dashboard_booking_memberships ) ? 'checked="checked"' : ''; ?> > Enable
										</label>
										<label class="radio-inline">
										  	<input type="radio" name="user_dashboard_booking_memberships" value="no" <?php echo ( $user_dashboard_booking_memberships ) ? 'checked="checked"' : ''; ?> > Disable
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="fullname">Account Dashboard - Classifieds Module:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Enable or Disable the Classifieds App Section in the User Dashboard"></i></label>
									<div class="col-md-6 col-sm-6">
										<label class="radio-inline">
										 	<input type="radio" name="user_dashboard_classifieds" value="yes" <?php echo ( !$user_dashboard_classifieds ) ? 'checked="checked"' : ''; ?> > Enable
										</label>
										<label class="radio-inline">
										  	<input type="radio" name="user_dashboard_classifieds" value="no" <?php echo ( $user_dashboard_classifieds ) ? 'checked="checked"' : ''; ?> > Disable
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="fullname">Account Dashboard - Forums Module:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Enable or Disable the Forum App Section in the User Dashboard"></i></label>
									<div class="col-md-6 col-sm-6">
										<label class="radio-inline">
										 	<input type="radio" name="user_dashboard_forum" value="yes" <?php echo ( !$user_dashboard_forum ) ? 'checked="checked"' : ''; ?> > Enable
										</label>
										<label class="radio-inline">
										  	<input type="radio" name="user_dashboard_forum" value="no" <?php echo ( $user_dashboard_forum ) ? 'checked="checked"' : ''; ?> > Disable
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="fullname">Account Dashboard - Online Store Module:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Enable or Disable the Online Store App Section in the User Dashboard"></i></label>
									<div class="col-md-6 col-sm-6">
										<label class="radio-inline">
										 	<input type="radio" name="user_dashboard_ecommerce" value="yes" <?php echo ( !$user_dashboard_ecommerce ) ? 'checked="checked"' : ''; ?> > Enable
										</label>
										<label class="radio-inline">
										  	<input type="radio" name="user_dashboard_ecommerce" value="no" <?php echo ( $user_dashboard_ecommerce ) ? 'checked="checked"' : ''; ?> > Disable
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="fullname">Account Dashboard - Photo Gallery Module:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Enable or Disable the Photo Gallery App Section in the User Dashboard"></i></label>
									<div class="col-md-6 col-sm-6">
										<label class="radio-inline">
										 	<input type="radio" name="user_dashboard_photogallery" value="yes" <?php echo ( !$user_dashboard_photogallery ) ? 'checked="checked"' : ''; ?> > Enable
										</label>
										<label class="radio-inline">
										  	<input type="radio" name="user_dashboard_photogallery" value="no" <?php echo ( $user_dashboard_photogallery ) ? 'checked="checked"' : ''; ?> > Disable
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="fullname">Account Dashboard - Audio Streaming Module:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Enable or Disable the Audio Player App Section in the User Dashboard"></i></label>
									<div class="col-md-6 col-sm-6">
										<label class="radio-inline">
										 	<input type="radio" name="user_dashboard_audioplayer" value="yes" <?php echo ( !$user_dashboard_audioplayer ) ? 'checked="checked"' : ''; ?> > Enable
										</label>
										<label class="radio-inline">
										  	<input type="radio" name="user_dashboard_audioplayer" value="no" <?php echo ( $user_dashboard_audioplayer ) ? 'checked="checked"' : ''; ?> > Disable
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="fullname">Account Dashboard - Video Streaming Module:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Enable or Disable the VideoTube App Section in the User Dashboard"></i></label>
									<div class="col-md-6 col-sm-6">
										<label class="radio-inline">
										 	<input type="radio" name="user_dashboard_videotube" value="yes" <?php echo ( !$user_dashboard_videotube ) ? 'checked="checked"' : ''; ?> > Enable
										</label>
										<label class="radio-inline">
										  	<input type="radio" name="user_dashboard_videotube" value="no" <?php echo ( $user_dashboard_videotube ) ? 'checked="checked"' : ''; ?> > Disable
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="fullname">Account Dashboard - Custom Pages Section Name:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Account Sidebar custom page section name"></i></label>
									<div class="col-md-8 col-sm-8">
										<input type="text" class="form-control" style="width:100% !important" name="account_pages_section_name" value="<?php echo $account_pages_section_name; ?>" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="loginoption">Member Can Login with:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Limit how Members login or both ways with Username & Email"></i></label>
									<div class="col-md-8 col-sm-8">
										<label class="radio-inline">
										 	<input type="radio" name="user_login_option" value="username" <?php echo ( $user_login_option == 'username') ? 'checked="checked"' : ''; ?> > Username Only
										</label>
										<label class="radio-inline">
										  	<input type="radio" name="user_login_option" value="email" <?php echo ( $user_login_option == 'email' ) ? 'checked="checked"' : ''; ?> > Email Only
										</label><br/>
										<label class="radio-inline">
										  	<input type="radio" name="user_login_option" value="both" <?php echo ( $user_login_option == 'both' ) ? 'checked="checked"' : ''; ?> >Both Username and Email
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="fullname">Member Account Deletion:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Allows a registered user to delete their account but not content they may have created e.g. blog posts"></i></label>
									<div class="col-md-6 col-sm-6">
										<label class="radio-inline">
										 	<input type="radio" name="user_account_deletion" value="yes" <?php echo ( !$user_account_deletion ) ? 'checked="checked"' : ''; ?> > Yes
										</label>
										<label class="radio-inline">
										  	<input type="radio" name="user_account_deletion" value="no" <?php echo ( $user_account_deletion ) ? 'checked="checked"' : ''; ?> > No
										</label>
									</div>
								</div>														

								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4"></label>
									<div class="col-md-6 col-sm-6">
										<button id="submit_btn" type="submit" class="btn btn-primary">Save Account Dashboard Settings</button>
									</div>
								</div>
                        </div>
                    </div>
                    <!-- end panel -->
			        <!-- begin panel -->
                    <div class="panel panel-white">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            </div>
                            <h4 class="panel-title">Account Dashboard - Sign-Up / Registration</h4>
                        </div>
                        <div class="panel-body panel-form">
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="websitetitle">Account Login Page - Title:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Title Text on the Login Page for Members"></i></label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" value="<?php echo $builderengine->get_option("login_title");?>" id="websitetitle" name="login_title" placeholder="Enter Default Login Title" data-parsley-required="true" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="websitetitle">Account Login Page - Description:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Description Text on the Login Page for Members"></i></label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" value="<?php echo $builderengine->get_option("login_description");?>" id="websitetitle" name="login_description" placeholder="Enter Default Login Description" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="websitetitle">Account Registration Page Title:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Title Text on the Registration/Sign-up Page for Members"></i></label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" value="<?php echo $builderengine->get_option("register_title");?>" id="websitetitle" name="register_title" placeholder="Enter Default Register Title" data-parsley-required="true" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="websitetitle">Account Registration Page Description:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Description Text on the Registration/Sign-up Page for Members"></i></label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" value="<?php echo $builderengine->get_option("register_description");?>" id="websitetitle" name="register_description" placeholder="Enter Default Register Description" />
									</div>
								</div>
								<link href="<?php echo get_theme_path()?>assets/css/titatoggle.css" rel="stylesheet" />
		                        <div class="form-group">
		                            <label class="control-label col-md-4 col-sm-4" for="fullname">Account Login Background Image:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Select an Background Image for the User Login Page"></i></label>
		                            <div class="col-md-6 col-sm-6">
										<style>
											.file_preview {
												max-height: 110px;
												max-width:110px;
												margin-top: 10px;
											}
											.profile-avatar img{
												width:110px !important;
												max-height:110px;
											}
										</style>
										<span class="btn btn-success fileinput-button">
		                                    <i class="fa fa-plus"></i>
		                                    <span>Add image...</span>
		                                    <input id="f" type="file" name="user_login_background_img" rel="file_manager" file_value="<?=$builderengine->get_option("user_login_background_img")?>">
		                                </span>
										<?php $login_background_img = $builderengine->get_option("user_login_background_img");?>
										<?php if(!empty($login_background_img)):?>
											<div class="col-md-12" style="margin-top:15px !important;padding-left:0px !important;">
												<div class="checkbox checkbox-slider--b-flat checkbox-slider-danger" style="padding-top:0px;">
													<label>
														<input type="checkbox" name="user_login_background_img" value="" ><span>Remove</span>
													</label>
												</div>
											</div>					
										<?php endif;?>								
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <label class="control-label col-md-4 col-sm-4" for="fullname">Account Registration Background Image:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Select an Background Image for the User Registration Page"></i></label>
		                            <div class="col-md-6 col-sm-6">
										<span class="btn btn-success fileinput-button">
		                                    <i class="fa fa-plus"></i>
		                                    <span>Add image...</span>
		                                    <input id="e" type="file" name="user_register_background_img" rel="file_manager" file_value="<?=$builderengine->get_option("user_register_background_img")?>">
		                                </span>
										<?php $register_background_img = $builderengine->get_option("user_register_background_img");?>
										<?php if(!empty($register_background_img)):?>
										<div class="col-md-12" style="margin-top:15px !important;padding-left:0px !important;">
											<div class="checkbox checkbox-slider--b-flat checkbox-slider-danger" style="padding-top:0px;">
												<label>
													<input type="checkbox" name="user_register_background_img" value="" ><span>Remove</span>
												</label>
											</div>
										</div>		
										<?php endif;?>								
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <label class="control-label col-md-4 col-sm-4" for="fullname">Logo:<br/> (best fit: 200 x 30 px)
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Select your Logo Image for the User Dashboard"></i></label>
		                            <div class="col-md-6 col-sm-6">
										<span class="btn btn-success fileinput-button">
		                                    <i class="fa fa-plus"></i>
		                                    <span>Add image...</span>
		                                    <input id="d" type="file" name="logo_img" rel="file_manager" file_value="<?=$builderengine->get_option("logo_img")?>">
		                                </span>
										<?php $logo_img = $builderengine->get_option("logo_img");?>
										<?php if(!empty($logo_img)):?>
										<div class="col-md-12" style="margin-top:15px !important;padding-left:0px !important;">
											<div class="checkbox checkbox-slider--b-flat checkbox-slider-danger" style="padding-top:0px;">
												<label>
													<input type="checkbox" name="logo_img" value="" ><span>Remove</span>
												</label>
											</div>
										</div>	
										<?php endif;?>										
		                            </div>
		                        </div>
							<!--	<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="fullname">User Dashboard Forum:</label>
									<div class="col-md-6 col-sm-6">
										<label class="radio-inline">
										 	<input type="radio" name="user_dashboard_forum" value="yes" <?php// echo ( !$user_dashboard_forum ) ? 'checked="checked"' : ''; ?> > Yes
										</label>
										<label class="radio-inline">
										  	<input type="radio" name="user_dashboard_forum" value="no" <?php// echo ( $user_dashboard_forum ) ? 'checked="checked"' : ''; ?> > No
										</label>
									</div>
								</div> -->
								<!-- <div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="fullname">User Created Posts:</label>
									<div class="col-md-6 col-sm-6">
										<label class="radio-inline">
										 	<input type="radio" name="user_created_posts" value="yes" <?php //echo ( !$user_created_posts ) ? 'checked="checked"' : ''; ?> > Yes
										</label>
										<label class="radio-inline">
										  	<input type="radio" name="user_created_posts" value="no" <?php //echo ( $user_created_posts ) ? 'checked="checked"' : ''; ?> > No
										</label>
									</div>
								</div> -->
								<!-- <div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="fullname">User Created Categories:</label>
									<div class="col-md-6 col-sm-6">
										<label class="radio-inline">
										 	<input type="radio" name="user_created_categories" value="yes" <?php //echo ( !$user_created_categories ) ? 'checked="checked"' : ''; ?> > Yes
										</label>
										<label class="radio-inline">
										  	<input type="radio" name="user_created_categories" value="no" <?php// echo ( $user_created_categories ) ? 'checked="checked"' : ''; ?> > No
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="website">Default User Post Category:</label>
									<div class="form-group">
										<div class="col-md-8 col-sm-8">
						                    <ul id="default_user_post_category">
												<?php //foreach($default_user_post_category as $value):?>
												 	<li value="<?=$value?>"><?=$value?></li>
												<?php //endforeach?>
						                    </ul>
										</div>
									</div>
								</div> -->

								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4"></label>
									<div class="col-md-6 col-sm-6">
										<button id="submit_btn" type="submit" class="btn btn-primary">Save Account Login/Register Settings</button>
									</div>
								</div>
                        </div>
                    </div>
                    <!-- end panel -->
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
					<h4 class="sidebar-right-main-title">Account Dashboard</h4>
					<li class="nav-widget">
                        <div class="panel-group m-b-0" id="accordion">
							<div class="panel panel-grey panel-bg-buttons">
                                <div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('user/registration/index');?>" class="btn btn-sm btn-block btn-success btn-r-sidebar">
                                            <i class="fa fa-user pull-right text-white"></i>
											<b>Account Dashboard</b>
                                        </a>
                                    </h3>
                                </div>
								<div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('user/registration/index');?>" class="btn btn-sm btn-block btn-warning btn-r-sidebar">
                                            <i class="fa fa-sign-in pull-right text-white"></i>
											<b>Registration Page</b>
                                        </a>
                                    </h3>
                                </div>
								<div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('user/main/userLogin');?>" class="btn btn-sm btn-block btn-warning btn-r-sidebar">
                                            <i class="fa fa-sign-in pull-right text-white"></i>
											<b>Account Login Page</b>
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
                                        Adjust settings for your users (members) Account Dashboard, where they can access their account information & permissions.<br><br>
										Turn on/off what your members can do in their accounts across all modules used, turn off any not needed.
										
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
										<div class="todolist-title">Account Dashboard</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Enable / Disable Account Dashboard</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Enable / Disable Modules Access</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Account Login Type</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Allow Deletion of Accounts</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Login/Register Pages</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">View Account Pages</div>
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
<?php $categories = new Category();?>
<script>
    $(document).ready(function (){
	    $('#default_user_post_category').tagit({
	        fieldName: "default_user_post_category",
	        singleField: true,
	        showAutocompleteOnFocus: true,
	        availableTags: [ <?php foreach ($categories->get() as $category): ?>"<?php echo $category->name?>", <?php endforeach;?>]
	    });
		$("#f").click(function(e){
		   e.preventDefault();
		});
		$("#e").click(function(e){
		   e.preventDefault();
		});
		$("#d").click(function(e){
		   e.preventDefault();
		});
	});
</script>