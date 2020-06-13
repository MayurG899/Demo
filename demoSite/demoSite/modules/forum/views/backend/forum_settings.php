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
<!-- begin #content -->
<div id="content" class="page-with-two-sidebar content-two-sidebars" style="min-height:800px">

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                </div>
                <h4 class="panel-title">Forums Main Settings</h4>
            </div>
            <div class="panel-body panel-form">
                <form class="form-horizontal form-bordered" method="post" data-parsley-validate="true" name="demo-form">
					<div class="form-group" id="visible">
						<label class="control-label col-md-4 col-sm-4 col-be-4" for="forum_active">Forum Module Active:</label>
						<div class="col-md-6 col-sm-6">
							<?php if($this->BuilderEngine->get_option('forum_active') == 'yes')
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
                                <input type="radio" name="forum_active" id="disabled" value="yes" <?=$check1?>/>
                                Yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="forum_active" id="active" value="no" <?=$check2?>/>
                               No
                            </label>
						</div>
					</div>
					<div class="form-group" id="visible">
						<label class="control-label col-md-4 col-sm-4 col-be-4" for="forum_visibility">Forum Visibility:</label>
						<div class="col-md-6 col-sm-6">
							<?php if($this->BuilderEngine->get_option('forum_visibility') == 'public')
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
                                <input type="radio" name="forum_visibility" id="public" value="public" <?=$check1?>/>
                                Public
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="forum_visibility" id="private" value="private" <?=$check2?>/>
                                Private
                            </label>
						</div>
					</div>
				<!--	<div class="form-group user_groups" id="user_groups" style="display:<?php /*=$display;*/?>;">
						<label class="control-label col-md-4 col-sm-4" for="website">Default Group Access Allowed for Forum:</label>
						<div class="form-group">
						<div class="col-md-8 col-sm-8">
                            <ul id="access-groups">
		                      <?php /*$groups = explode(',', $this->BuilderEngine->get_option('forum_access_groups'));*/?>
		                      <?php /*foreach($groups as $group):*/?>
		                      	<li ><?php /*=$group*/?></li>
		                      <?php /*endforeach*/?>
							</div>
						</div>
					</div>-->
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-be-4" for="forum_num_categories_displayed">Number of Topic Forums Displayed:</label>
						<div class="col-md-6 col-sm-6">
					  	    <?php $num_categs = $this->BuilderEngine->get_option('forum_num_categories_displayed');?>
							<input class="form-control" type="text" name="forum_num_categories_displayed" value="<?=(empty($num_categs))? 10:$num_categs;?>" />
						</div>
					</div>	
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-be-4" for="forum_num_posts_displayed">Number of Posts Displayed in forum threads:</label>
						<div class="col-md-6 col-sm-6">
					  	    <?php $num_posts = $this->BuilderEngine->get_option('forum_num_posts_displayed');?>
							<input class="form-control" type="text" name="forum_num_posts_displayed" value="<?=(empty($num_posts))? 10:$num_posts;?>" />
						</div>
					</div>	
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-be-4" for="forum_num_recent_posts_displayed">Number of Recent Posts Displayed:</label>
						<div class="col-md-6 col-sm-6">
					  	    <?php $num_r_posts = $this->BuilderEngine->get_option('forum_num_recent_posts_displayed');?>
							<input class="form-control" type="text" name="forum_num_recent_posts_displayed" value="<?=(empty($num_r_posts))? 3:$num_r_posts;?>" />
						</div>
					</div>
					<style>
					.hide{display:none;}
					.show{display:block;}
					</style>
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-be-4" for="forum_thread_image">New Thread Thumbnail:</label>
						<div class="col-md-6 col-sm-6">
							<?php if($this->BuilderEngine->get_option('forum_thread_image') == 'custom')
								{$check1 = 'checked';$check2 ='';$check3='';$display='none';}
								elseif($this->BuilderEngine->get_option('forum_thread_image') == 'admin')
								{$check1 = '';$check2 ='checked';$check3='';$display='block';}
								else
								    if($this->BuilderEngine->get_option('forum_thread_image') == 'avatar')
										{$check1 = '';$check2 ='checked';$check3='checked';$display='none';}
									else 
										{$check1 = '';$check2 ='checked';$check3='block';}
							?>
							<label class="radio-inline">
                                <input type="radio" name="forum_thread_image" id="custom" value="custom" <?=$check1?>/>
                                Custom User Image
                            </label>
							<label class="radio-inline">
                                <input type="radio" name="forum_thread_image" id="admin" value="admin" <?=$check2?>/>
                                Admin`s Default Image
                            </label>
							<label class="radio-inline">
                                <input type="radio" name="forum_thread_image" id="avatar" value="avatar" <?=$check3?>/>
                                User`s Avatar Image
                            </label>
						</div>
					</div>
					<div class="form-group switch" id="image_thumb" style="display:<?=$display;?>">
						<label class="control-label col-md-4 col-sm-4 col-be-4" for="categoryimage">Image:</label>
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
							<span>Add Image</span>
							<input id="f" type="file" name="image" rel="file_manager" file_value="<?=$this->BuilderEngine->get_option('forum_thread_admin_image')?>">
						</span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-be-4" for="website">Module Default Registration Group(s):<br>
							<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Allows a group membership policy to be defined for users registering by way of this Modules registration page, that takes precedence over the system default user group."></i>
						</label>
						<div class="form-group">
						<div class="col-md-8 col-sm-8">
                            <ul id="access-groups">
		                      <?php $groups = explode(',', $this->BuilderEngine->get_option('forum_access_groups'));?>
		                      <?php foreach($groups as $group):?>
		                      	<li ><?=$group?></li>
		                      <?php endforeach;?>
							</div>
							</ul>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-be-4" for="forum_num_posts_displayed">Terms and Conditions url:</label>
						<div class="col-md-6 col-sm-6">
							<input class="form-control" type="text" name="forum_terms" value="<?=$this->BuilderEngine->get_option('forum_terms')?>" />
						</div>
					</div>
					<div class="form-group">
						<div class="text-center">Register page additional info text:</div>
						<div class="col-md-12 col-sm-12">
							<textarea class="ckeditor" id="editor1" name="register_info" rows="10" cols="70"><?=$this->BuilderEngine->get_option("forum_register_info");?></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="text-center">Login page additional info text:</div>
						<div class="col-md-12 col-sm-12">
							<textarea class="ckeditor" id="editor2" name="login_info" rows="10" cols="70"><?=$this->BuilderEngine->get_option("forum_login_info");?></textarea>
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
					<h4 class="sidebar-right-main-title">Forums</h4>
					<li class="nav-widget">
                        <div class="panel-group m-b-0" id="accordion">
							<div class="panel panel-grey panel-bg-buttons">
                                <div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('forum/all_topics');?>" target="_blank" class="btn btn-sm btn-block btn-success btn-r-sidebar-2">
                                            <i class="fa fa-file-o pull-right text-white"></i>
											<b>Forums Homepage</b>
                                        </a>
                                    </h3>
                                </div>
								<div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('forum/register');?>" target="_blank" class="btn btn-sm btn-block btn-warning btn-r-sidebar-2">
                                            <i class="fa fa-sign-in pull-right text-white"></i>
											<b>Registration Page</b>
                                        </a>
                                    </h3>
                                </div>
								<div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('forum/login');?>" target="_blank" class="btn btn-sm btn-block btn-warning btn-r-sidebar-2">
                                            <i class="fa fa-sign-in pull-right text-white"></i>
											<b>Forums Login Page</b>
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
                                        Setup your Forums Website by using the module options on the left sidebar. <br><br>
										This module contains (frontend pages) control options to Post Comments, Threads, & Lock Threds. <br><br>
										Use the frontend controls to post content instead of here. Click the <b>Forums Homepage</b> button
										
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
										<div class="todolist-title">Forums Access</div>
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
										<div class="todolist-title">Adjust Forums Settings</div>
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
										<div class="todolist-title">Add Areas</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Add Forum Topics</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Manage Threads</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Post New Comments</div>
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
	        fieldName: "forum_access_groups",
	        singleField: true,
	        showAutocompleteOnFocus: true,
	        availableTags: [ <?php foreach ($groups->get() as $group): ?>"<?php echo $group->name?>", <?php endforeach;?>]
	    });
	});

	$("input[name='forum_visibility']").change(function() {
			$('.user_groups').toggle();
	});
	$("input[id='custom']").click(function() {
			$('#image_thumb').removeClass('show');
			$('#image_thumb').addClass('hide');
	});
	$("input[id='admin']").click(function() {
			$('#image_thumb').removeClass('hide');
			$('#image_thumb').addClass('show');
	});
	$("input[id='avatar']").click(function() {
			$('#image_thumb').removeClass('show');
			$('#image_thumb').addClass('hide');
	});

	$("#f").click(function(e){
	   e.preventDefault();
	});
</script>

		
