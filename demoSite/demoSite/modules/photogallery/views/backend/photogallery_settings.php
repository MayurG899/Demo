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
                <h4 class="panel-title">Photo Galleries Main Settings</h4>
            </div>
            <div class="panel-body panel-form">
                <form class="form-horizontal form-bordered" method="post" data-parsley-validate="true" name="demo-form">
					<div class="form-group" id="visible">
						<label class="control-label col-md-4 col-sm-4 col-be-4" for="forum_active">PhotoGallery Module Active:</label>
						<div class="col-md-6 col-sm-6">
							<?php if($this->BuilderEngine->get_option('photogallery_active') == 'yes')
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
                                <input type="radio" name="photogallery_active" id="disabled" value="yes" <?=$check1?>/>
                                Yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="photogallery_active" id="active" value="no" <?=$check2?>/>
                               No
                            </label>
						</div>
					</div>
					<div class="form-group" id="visible">
						<label class="control-label col-md-4 col-sm-4 col-be-4" for="photogallery_option">User Accounts Option:</label>
						<div class="col-md-7 col-sm-7">
							<?php if($this->BuilderEngine->get_option('photogallery_option') == 'open')
						   	{
						   		$check1 = 'checked'; 
						   		$check2 = '';
								$display = 'none';
						   	}
						   	else
						   	{
						   		$check1 = ''; 
						   		$check2 = 'checked';
								$display = 'block';
						   	}
							?>									
							<label class="radio-inline">
                                <input type="radio" name="photogallery_option" id="public" value="open" <?=$check1?>/>
                                Users can register and create their own channels
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="photogallery_option" id="private" value="closed" <?=$check2?>/>
                                My Photo Gallery only
                            </label>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-be-4" for="gallerytype">Allow ratings:</label>
						<div class="col-md-6 col-sm-6">
							<?php if($this->BuilderEngine->get_option('photogallery_allow_ratings') == 'yes')
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
                                <input type="radio" name="photogallery_allow_ratings" value="yes" <?=$check1?>/>
                                Yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="photogallery_allow_ratings" value="no" <?=$check2?>/>
                                No Ratings
                            </label>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-be-4" for="websitetitle">Allow Comments:</label>
						<div class="col-md-6 col-sm-6">
							<?php if($this->BuilderEngine->get_option('photogallery_allow_comments') == 'yes')
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
                                <input type="radio" name="photogallery_allow_comments" value="yes" <?=$check1?>/>
                                Yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="photogallery_allow_comments" value="no" <?=$check2?>/>
                                No Comments
                            </label>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-be-4" for="websitekeywords">Public / Private Comments:</label>
						<div class="col-md-8 col-sm-8">
							<?php if($this->BuilderEngine->get_option('photogallery_comments_private') == 'public')
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
                                <input type="radio" name="photogallery_comments_private" value="public" <?=$check1?>/>
                                Everyone Can Comment (Public)
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="photogallery_comments_private" value="private" <?=$check2?> />
                                Only Registered Users Can Comment (Private)
                            </label>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-be-4" for="websitetitle">Show Tags:</label>
						<div class="col-md-6 col-sm-6">
							<?php if($this->BuilderEngine->get_option('photogallery_show_tags') != 'no')
							{
								$check1 = 'checked';
								$check2 = '';
								$show = '';
								$placeholder = '';
							}
							else
							{
								$check1 = '';
								$check2 = 'checked';
								$show = 'readonly';
								$placeholder = 'placeholder=" 10 , 20 , 50 etc."';
                            }
							?>										
							<label class="radio-inline">
                                <input type="radio" name="photogallery_show_tags" value="yes" <?=$check1?> />
                                Yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="photogallery_show_tags" value="no" <?=$check2?>/>
                                Hide Tags
                            </label>
						</div>
					</div>
					<?/*
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4" for="adminemail">Number of Tags Displayed On Photo Gallery Sidebar:</label>
						<div class="col-md-6 col-sm-6">
					  	    <?php $tags = $this->BuilderEngine->get_option('photogallery_num_tags_displayed');?>
							<?php if(empty($tags))
								$tags = 0;
							?>
							<input class="form-control" type="text" name="photogallery_num_tags_displayed" <?=$placeholder?> value="<?=$tags?>" <?=$show?>/>
						</div>
					</div>		
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4" for="adminemail">Number of Recent Photos Displayed On Photo Gallery Sidebar:</label>
						<div class="col-md-6 col-sm-6">
					  	    <?php $recent_posts = $this->BuilderEngine->get_option('photogallery_num_recent_medias_displayed');?>
							<?php if(empty($recent_posts))
								$recent_posts = 0;
							?>
							<input class="form-control" type="text" name="photogallery_num_recent_medias_displayed" value="<?=$recent_posts?>" />
						</div>
					</div>				
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4" for="photogallery_medias_per_page">Number of Photos per Page:</label>
						<div class="col-md-6 col-sm-6">
							<input class="form-control" type="text" name="photogallery_medias_per_page" value="<?=$media = $this->BuilderEngine->get_option('photogallery_medias_per_page');?>"/>
						</div>
					</div>					
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4" for="adminemail">How Many Photos Displayed On Main Page:</label>
						<div class="col-md-6 col-sm-6">
							<input class="form-control" type="text" name="photogallery_num_medias_displayed" value="<?=$media = $this->BuilderEngine->get_option('photogallery_num_medias_displayed');?>"/>
						</div>
					</div>
					*/?>
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-be-4" for="website">Module Default Registration Group(s):<br>
							<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Allows a group membership policy to be defined for users registering by way of this Modules registration page, that takes precedence over the system default user group."></i>
						</label>
						<div class="form-group">
						<div class="col-md-8 col-sm-8">
                            <ul id="access-groups">
		                      <?php $groups = explode(',', $this->BuilderEngine->get_option('photogallery_access_groups'));?>
		                      <?php foreach($groups as $group):?>
		                      	<li ><?=$group?></li>
		                      <?php endforeach?>
							</div>
							</ul>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-be-4" for="forum_num_posts_displayed">Terms and Conditions url:</label>
						<div class="col-md-6 col-sm-6">
							<input class="form-control" type="text" name="photogallery_terms" value="<?=$this->BuilderEngine->get_option('photogallery_terms')?>" />
						</div>
					</div>
					<div class="form-group">
						<div class="text-center">Register page additional info text:</div>
						<div class="col-md-12 col-sm-12">
							<textarea class="ckeditor" id="editor1" name="register_info" rows="10" cols="70"><?=$this->BuilderEngine->get_option("photogallery_register_info");?></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="text-center">Login page additional info text:</div>
						<div class="col-md-12 col-sm-12">
							<textarea class="ckeditor" id="editor2" name="login_info" rows="10" cols="70"><?=$this->BuilderEngine->get_option("photogallery_login_info");?></textarea>
						</div>
					</div>	
					<div class="form-group">
						<div class="col-md-12 col-sm-12">
							<div class="text-center">
								<button type="submit" class="btn btn-primary">Save Settings</button>
							</div>
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
					<h4 class="sidebar-right-main-title">Photo Galleries</h4>
					<li class="nav-widget">
                        <div class="panel-group m-b-0" id="accordion">
							<div class="panel panel-grey panel-bg-buttons">
                                <div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('photogallery/all_photos');?>" target="_blank" class="btn btn-sm btn-block btn-success btn-r-sidebar-2">
                                            <i class="fa fa-file-o pull-right text-white"></i>
											<b>Photos Homepage</b>
                                        </a>
                                    </h3>
                                </div>
								<div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('photogallery/register');?>" target="_blank" class="btn btn-sm btn-block btn-warning btn-r-sidebar-2">
                                            <i class="fa fa-sign-in pull-right text-white"></i>
											<b>Registration Page</b>
                                        </a>
                                    </h3>
                                </div>
								<div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('photogallery/login');?>" target="_blank" class="btn btn-sm btn-block btn-warning btn-r-sidebar-2">
                                            <i class="fa fa-sign-in pull-right text-white"></i>
											<b>Photos Login Page</b>
                                        </a>
                                    </h3>
                                </div>
								<div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('photogallery/channel/admin');?>" target="_blank" class="btn btn-sm btn-block btn-indigo btn-r-sidebar-2">
                                            <i class="fa fa-file-o pull-right text-white"></i>
											<b>Admin Channel</b>
                                        </a>
                                    </h3>
                                </div>
								<div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('photogallery/mysettings');?>" target="_blank" class="btn btn-sm btn-block btn-indigo btn-r-sidebar-2">
                                            <i class="fa fa-cogs pull-right text-white"></i>
											<b>Channel Settings</b>
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
                                        Setup your Photo Galleries Website by using the module options on the left sidebar. <br><br>
										This module contains (frontend pages) control options to upload content, & extra settings. <br><br>
										Use the frontend controls to add your media & channel management instead of here. Click the <b>Admin Channel</b> button
										
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
										<div class="todolist-title">Photo Module</div>
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
										<div class="todolist-title">Adjust Photo Settings</div>
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
										<div class="todolist-title">Add Photo Tracks</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Add Albums</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Manage Channels</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">View Channel Settings</div>
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

		
