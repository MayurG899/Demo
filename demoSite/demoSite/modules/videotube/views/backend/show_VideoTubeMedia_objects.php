<div id="content" class="page-with-two-sidebar content-two-sidebars" style="min-height:800px">
<script src="<?php echo get_theme_path()?>assets/plugins/jquery/jquery-1.9.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url('builderengine/public/mediaplayer/build/mediaelementplayer.css')?>" />
<script src="<?=base_url('builderengine/public/mediaplayer/build/mediaelement-and-player.js')?>"></script>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                </div>
                <h4 class="panel-title">View All Videos</h4>
            </div>
            <div class="panel-body">
				<form id="deleteForm" action="<?=base_url('admin/module/videotube/bulk_delete/VideoTubeMedia/show_media')?>" method="POST">
					<a href="<?=base_url('admin/module/videotube/add_media')?>" class="btn btn-sm btn-success m-r-10" style="float:left"><i class="fa fa-plus"></i> Add New Video</a>
					<button type="submit" id="deleteChecked" name="bulkDelete" class="btn btn-sm btn-danger" style="display:none" ><i class="fa fa-trash"></i> Delete Video(s)</button>
					<br/><br/>
					<div class="table-responsive">
						<table id="data-table-checkbox" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th> <br/><input name="select_all" value="1" type="checkbox"></th>
									<th>Video Title</th>
									<th>Type</th>
									<th>Thumbnail</th>
									<th>Author</th>
									<th>Album</th>
									<th>Comments</th>
									<th>Date Created</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
							   <?php foreach($objects as $object):?>
								<tr class="odd gradeX" data-id="<?=$object->id?>">
									<td></td>
									<td><?=str_replace('_',' ',$object->title);?></td>
									<td><?=ucfirst($object->type)?></td>
									<td>
									<?
										if($object->type == 'file'){
											$output ='
											<video id="mediaplayervideo'.$object->id.'" src="'.checkImagePath($object->file).'" style="width:200px !important;height:100px !important" controls>
												<source src="'.checkImagePath($object->file).'" type="video/mp4">
												<source src="'.checkImagePath($object->file).'" type="video/ogg">
												Your browser does not support HTML5 video.
											</video>';
										}
										if($object->type == 'youtube'){
											$output ='
											<style>#mediaplayervideo'.$object->id.'_youtube_iframe{width:200px !important;height:100px !important;}</style>
											<video id="mediaplayervideo'.$object->id.'" src="'.checkImagePath($object->file).'" style="width:200px;height:100px" controls>
												<source type="video/youtube" src="'.$object->file.'" />
											</video>';
										}
										if($object->type == 'vimeo'){
											$output ='<iframe src="https://player.vimeo.com/video/'.$object->file.'" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
										}
										$output .='
										<script>
											//$(document).ready(function() {
												$("#mediaplayervideo'.$object->id.'").mediaelementplayer({
													poster:"'.checkImagePath($object->file).'",
													videoWidth: "200px",
													videoHeight: "100px",
													showPosterWhenEnded: true,
													success: function(mediaElement, originalNode, instance) {
														instance.load();
													}
												});
												$("#mediaplayervideo'.$object->id.'").bind("contextmenu",function(){
													return false;
												});
												//$(".mejs__controls").append("<div class=\"mejs_button mejs__download\"><a role=\"button\" href=\"checkImagePath($sound->file)\" download><i class=\"fa fa-download\"></i></a></div>");
											//});
										</script>';
										?>
										<?=$output;?>
									</td>
									<td>
										<?php $user = new User($object->user_id);?>
										<?=$user->username?>
									</td>
									<?php $albums = new VideoTubeAlbum();?>
									<?php foreach($albums->get() as $album):?>
									<?php if($album->id == $object->album_id):?>
									<td><?=str_replace('_',' ',$album->name);?></td>
									<?php endif?>
									<?php endforeach?>
									<td>
										<?php 
											if($object->comments_allowed == 'yes')
												echo 'Enabled';
											if($object->comments_allowed == 'no')
												echo 'Disabled,showing existing';
											if($object->comments_allowed == 'hide')
												echo 'Disabled,Hidden';
										?>								
									</td>
									<td><?=date('d.m.Y',$object->time_created)?></td>
									<td>
										<div class="btn-group-vertical m-r-5">
											<a  style="margin-bottom:3px;" href="<?=base_url()?>videotube/video/<?=$object->id?>" type="button" class="btn btn-sm btn-primary" target="_blank"><i class="fa fa-eye"></i> View</a>
											<a  style="margin-bottom:3px;" href="<?=base_url()?>admin/module/videotube/modify_object/VideoTubeMedia/<?=$object->id?>" type="button" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a>
											<a href="<?=base_url()?>admin/module/videotube/delete_object/VideoTubeMedia/<?=$object->id?>" type="button" class="btn btn-sm btn-inverse"><i class="fa fa-remove"></i> Delete</a>
										</div>
									</td>
								</tr>
							  <?php endforeach;?>
							</tbody>
						</table>
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
