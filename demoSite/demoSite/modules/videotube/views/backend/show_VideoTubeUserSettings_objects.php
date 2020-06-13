<div id="content" class="page-with-two-sidebar content-two-sidebars" style="min-height:800px">
			<!-- begin row -->
<?php if($this->BuilderEngine->get_option('videotube_option') == 'open'):?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" style="width:100%;height:45px;padding:5px;margin-bottom:5px;border:1px solid #000;">
			<div class="col-md-3">
				<h5>Approve Existing Member:</h5>
			</div>
			<form id="existing" name="existing" method="post" action="<?=base_url('index.php/admin/module/videotube/approve_user')?>">
				<div class="col-md-6">
					<select class="form-control" name="user_id" style="float:left;" required>
						<?php $users = new User();?>
						<?php foreach($users->get() as $user):?>
							<?php $vg_users = new VideoTubeUserSettings();
								  $vg_user = $vg_users->where('user_id',$user->id)->get();
							?>
								<?php if($vg_user->user_id != $user->id):?>
									<option value="<?=$user->id?>"><?=$user->first_name.' '.$user->last_name.' - (username: '.$user->username.' / email: '.$user->email.')'?></option>
								<?php endif;?>
						<?php endforeach;?>
					</select>
					<input type="hidden" name="about" value="">
					<input type="hidden" name="background_img" value="">
				</div>
				<div class="col-md-3">
					<button type="submit" class="btn btn-md btn-success"><i class="fa fa-check"></i> Approve</button>
					<a href="<?=base_url('admin/module/videotube/clean_up_user_list')?>" type="button" class="btn btn-md btn-danger" data-toggle="tooltip" data-placement="top" title="Clean up inactive video gallery users"><i class="fa fa-refresh"></i> Rebuild List</a>
				</div>
			</form>
		</div>
	</div>
</div>
<?php endif;?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                </div>
                <h4 class="panel-title">Approved User Accounts To Use The Video Channels Module</h4>
            </div>
            <div class="panel-body">
				<?php if($this->BuilderEngine->get_option('videotube_option') == 'open'):?>
                <div class="table-responsive">
                    <table id="data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>UserName</th>
								<th>Avatar</th>
								<th>Name/Last Name</th>
								<th>Email</th>
                                <th>Profile Status</th>
								<th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
						<?php $i = 1;?>
                          <?php foreach($objects as $object):?>
						  <?php $videogallery_user = new User();
								$videogallery_user = $videogallery_user->where('id',$object->user_id)->get();
							?>
							<?php if($object->id > 0):?>
                            <tr class="odd gradeX">
                                <td><?=$videogallery_user->username;?></td>
								<td><img style="width:100px;height:80px;" src="<?=$videogallery_user->avatar;?>"></td>
								<td><?=$videogallery_user->first_name.' '.$videogallery_user->last_name.''?></td>
								<td><?=$videogallery_user->email?></td>
								<td><?=($object->active=='yes')?'<span class="label label-success"> Active </span>':'<span class="label label-danger"> Inactive </span>';?></td>
								<td> 
									<div class="btn-group-vertical m-r-5">
										<?php if($object->active=='no'):?>
										<a style="margin-bottom:3px;" href="<?=base_url()?>videotube/channel/<?=$videogallery_user->username?>" type="button" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i> View Profile</a>
										<a href="<?=base_url()?>admin/module/videotube/delete_object/VideoTubeUserSettings/revoke<?=$object->id?>" type="button" class="btn btn-xs btn-danger" style="margin-bottom:3px;"><i class="fa fa-ban"></i> Revoke acces</a>
										<button type="button" class="btn btn-xs btn-inverse" data-toggle="modal" data-target="#bs-example-modal-sm<?=$i?>"><i class="fa fa-times"></i> Delete </button>
										<?php else:?>
										<a style="margin-bottom:3px;" href="<?=base_url()?>videotube/channel/<?=$videogallery_user->username?>" type="button" class="btn btn-md btn-primary"><i class="fa fa-eye"></i> View Profile</a>
										<?php endif;?>
									</div>
								</td>
                            </tr>
							<?php endif;?>
							<?php $i++;?>
						  <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
				<?php else:?>
				<div class="col-md-12 col-sm-12">
					<div  class="alert alert-danger" style="margin-top:20px;">
						<i class="fa fa-exclamation-triangle"></i> This page is active if first option from the VideoTube Settings page is set to "<strong>Users can register and create their own channels</strong>" only.
					</div>
				</div>
				<?php endif;?>
            </div>
        </div>
    </div>
</div>
<?php $i = 1;?>
<?php foreach($objects as $object):?>
	<div id="bs-example-modal-sm<?=$i?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	  <div class="modal-dialog modal-sm">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="gridSystemModalLabel">Are You Sure ?</h4>
		  </div>
		  <div class="modal-body">
			<div class="row">
				<div class="col-md-12">
					<div class="alert alert-warning">
						<p><i class="fa fa-exclamation-triangle"></i> You are about to permanently delete and revoke this user`s access to all other modules and website itself !</p>
					</div>
				</div>
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-xs btn-default" data-dismiss="modal"> Cancel</button>
			<a href="<?=base_url()?>admin/module/videotube/delete_object/VideoTubeUserSettings/<?=$object->id?>" type="button" class="btn btn-xs btn-danger"><i class="fa fa-remove"></i> Delete</a>
		  </div>
		</div>
	  </div>
	</div>
	<?php $i++;?>
<?php endforeach;?>

<!-- end row -->
<!-- begin #sidebar-right -->
		<div id="sidebar-right" class="sidebar sidebar-right">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav m-t-10">
					<h4 class="sidebar-right-main-title">Video Channels</h4>
					<li class="nav-widget">
                        <div class="panel-group m-b-0" id="accordion">
							<div class="panel panel-grey panel-bg-buttons">
                                <div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('videotube/all_videos');?>" target="_blank" class="btn btn-sm btn-block btn-success btn-r-sidebar-2">
                                            <i class="fa fa-file-o pull-right text-white"></i>
											<b>Video Homepage</b>
                                        </a>
                                    </h3>
                                </div>
								<div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('videotube/register');?>" target="_blank" class="btn btn-sm btn-block btn-warning btn-r-sidebar-2">
                                            <i class="fa fa-sign-in pull-right text-white"></i>
											<b>Registration Page</b>
                                        </a>
                                    </h3>
                                </div>
								<div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('videotube/login');?>" target="_blank" class="btn btn-sm btn-block btn-warning btn-r-sidebar-2">
                                            <i class="fa fa-sign-in pull-right text-white"></i>
											<b>Video Login Page</b>
                                        </a>
                                    </h3>
                                </div>
								<div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('videotube/channel/admin');?>" target="_blank" class="btn btn-sm btn-block btn-indigo btn-r-sidebar-2">
                                            <i class="fa fa-file-o pull-right text-white"></i>
											<b>Admin Channel</b>
                                        </a>
                                    </h3>
                                </div>
								<div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('videotube/mysettings');?>" target="_blank" class="btn btn-sm btn-block btn-indigo btn-r-sidebar-2">
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
                                        Setup your Video Channels Website by using the module options on the left sidebar. <br><br>
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
										<div class="todolist-title">Video Channels</div>
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
										<div class="todolist-title">Adjust Video Settings</div>
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
										<div class="todolist-title">Add Videos</div>
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
