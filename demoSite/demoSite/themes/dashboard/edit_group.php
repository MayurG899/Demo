<?php echo get_header() ?>

<?php echo get_sidebar() ?>

<!-- begin #content -->
<div id="content" class="content page-with-two-sidebar content-two-sidebars" style="min-height:800px">

            <form class="form-horizontal form-bordered" data-parsley-validate="true" name="demo-form" method="post">
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
                            <h4 class="panel-title">Adjust This Usergroup Settings to Control Members</h4>
                        </div>
                        <div class="panel-body panel-form">
                                <input type="hidden" name="id" value="<?php echo $group->id?>">
                                <div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-be-4" for="fullname">Group Name:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Edit Usergroup Name"></i></label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" id="groupname" name="group" value="<?php echo $group->name?>" placeholder="Enter Name for Usergroup" data-parsley-required="true" required />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-be-4" for="fullname">Group Description:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Edit description about this Usergroup"></i></label>
									<div class="col-md-6 col-sm-6">
                                        <textarea class="form-control" placeholder="Write a Description about this Group." rows="5" name="description"><?php echo $group->description?></textarea>
									</div>
								</div>
								<!--
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="website">Group Access Allowed:</label>
									<div class="form-group">
									<div class="col-md-8 col-sm-8">
                                        <ul id="jquery-tagIt-default" class="warning">
                                            <li>Blogs Module</li>
                                            <li>Blogs Create Posts</li>
											<li>Blogs Create Categories</li>
											<li>Edit Profile</li>
											<li>Search Users</li>
											<li>View Pages</li>
											<li>Register Account</li>
											<li>Login Account</li>
                                        </ul>
										</div>
									</div>
								</div>-->
								<div class="form-group">
									<?php if(!$default_group ):?>
									<label class="control-label col-md-4 col-sm-4 col-be-4" for="fullname">Set Default For Member Registration:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="This option will set which Usergroup new members/sign-ups on your website gets added to"></i></label>
									<div class="col-md-6 col-sm-6">
										<label class="radio-inline">
										 	<input type="radio" name="default_group" value="1" <?php echo ( $default_group ) ? 'checked="checked"' : ''; ?> > Yes
										</label>
										<label class="radio-inline">
										  	<input type="radio" name="default_group" value="0" <?php echo ( !$default_group ) ? 'checked="checked"' : ''; ?> > No
										</label>
									</div>
									<?php else:?>
									<div class="col-md-12">
										<div class="alert alert-danger">
										<i class="fa fa-info-circle"></i>
											This group is set default for registrations.If you want to change it,just edit another usergroup you want to set and 
											choose "Yes" for the <strong>Set Default for Registrations</strong> option.
										</div>
									</div>
									<?php endif;?>
								</div>
								<div class="form-group">
									<?php if(!$default_group ):?>
									<label class="control-label col-md-4 col-sm-4 col-be-4"></label>
									<div class="col-md-6 col-sm-6">
										<button type="submit" class="btn btn-primary">Save Usergroup Settings</button>
									</div>
									<?php else:?>
									<div class="col-md-12 col-sm-12 text-center">
										<button type="submit" class="btn btn-primary text-center">Save Usergroup Settings</button>
									</div>
									<?php endif;?>
								</div>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>		
              
			    <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-white">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            </div>
                            <h4 class="panel-title">Blog Module - Usergroup Permissions</h4>
                        </div>
                        <div class="panel-body panel-form">
                                <input type="hidden" name="id" value="<?php echo $group->id?>">
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="fullname">Create Blog Posts:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Allow this Usergroup / Membership to Create Blog Posts in User Dashboard"></i></label>
									<div class="col-md-6 col-sm-6">
										<label class="radio-inline">
										 	<input type="radio" name="posts" value="1" <?php echo ( $group->allow_posts ) ? 'checked="checked"' : ''; ?> > Yes
										</label>
										<label class="radio-inline">
										  	<input type="radio" name="posts" value="0" <?php echo ( !$group->allow_posts ) ? 'checked="checked"' : ''; ?> > No
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="fullname">Create Categories:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Allow this Usergroup / Membership to Create Categories in User Dashboard"></i></label>
									<div class="col-md-6 col-sm-6">
										<label class="radio-inline">
										 	<input type="radio" name="categories" value="1" <?php echo ( $group->allow_categories ) ? 'checked="checked"' : ''; ?> > Yes
										</label>
										<label class="radio-inline">
										  	<input type="radio" name="categories" value="0" <?php echo ( !$group->allow_categories ) ? 'checked="checked"' : ''; ?> > No
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="fullname">User Created Categories:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Allow this Usergroup / Membership to Create Categories in User Dashboard"></i></label>
									<div class="col-md-6 col-sm-6">
										<label class="radio-inline">
										 	<input type="radio" name="use_created_categories" value="1" <?php echo ( $group->use_created_categories ) ? 'checked="checked"' : ''; ?> > Yes
										</label>
										<label class="radio-inline">
										  	<input type="radio" name="use_created_categories" value="0" <?php echo ( !$group->use_created_categories ) ? 'checked="checked"' : ''; ?> > No
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="website">Default Blog-Post Category:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="If Usergroup is Not Allowed to Create Categories but can Create Posts, Pick which Category all Usergroup Posts created is stored"></i></label>
									<div class="form-group">
										<div class="col-md-8 col-sm-8">
						                    <ul id="default_user_post_category">
												<?php foreach(explode(',',$group->default_user_post_category) as $value):?>
												 	<li value="<?=$value?>"><?=$value?></li>
												<?php endforeach?>
						                    </ul>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4"></label>
									<div class="col-md-6 col-sm-6">
										<button type="submit" class="btn btn-primary">Save Blog Permissions</button>
									</div>
								</div>
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
					<h4 class="sidebar-right-main-title">Usergroups & Roles</h4>
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
                                        Edit this usergroup that your users (members) are assigned to and control what members can & can not do.<br><br>
										Select a default usergroup your users will sign-up to with the registration form blocks.
										
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
										<div class="todolist-title">Edit Usergroup</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Pick A Default Usergroup</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Edit Usergroup Settings</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Adjust Permissions</div>
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
        </form>
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
	        availableTags: [ <?php foreach ($categories->where('name !=','Unallocated')->get() as $category): ?>"<?php echo $category->name?>", <?php endforeach;?>]
	    });
	});
</script>