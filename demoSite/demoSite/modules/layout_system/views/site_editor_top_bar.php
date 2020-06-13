					<!-- begin #top-menu -->
					<div id="top-menu" class="top-menu">
						<!-- begin top-menu nav -->
						<ul class="nav">
							<?if((($this->user->is_member_of('Frontend Editor') && !$this->user->is_member_of('Administrators')) || ($this->user->is_member_of('Frontend Manager') && !$this->user->is_member_of('Administrators')))):?>
								<a href="<?=base_url('cp/dashboard')?>" class="navbar-brand">
							<?else:?>
								<a href="<?=base_url('/admin')?>" class="navbar-brand">
							<?endif;?>
							  <div class="image admin-belogo-top-menu">
								   <img src="<?=base_url('/builderengine/public/editor/frontend_assets/img/BuilderEngine.png')?>" style="width: 200px;" id="the-builderengine-logo" alt="" />
							  </div>
							</a>
							<li class="has-sub dropdown navbar-user userdrop">
							   <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
									<img src="<?=$this->user->get_avatar()?>" alt="" /> <b class="caret pull-right"></b>
								</a>
								<ul class="dropdown-menu media-list animated fadeInLeft">
									<li class="dropdown-header bg-blue text-white"><?php echo $this->user->first_name." ".$this->user->last_name?> Account</li>
									<li><a <?=href("admin", "user/edit/{$this->user->get_id()}")?>><i class="fa fa-compass"></i><span class="badge badge-danger pull-right">Website</span> Edit Admin Details</a></li>
									<li><a href="https://builderengine.com/account/dashboard" target="_blank"><i class="fa fa-compass"></i><span class="badge badge-danger pull-right">Cloud</span> BuilderEngine Account</a></li>
									<li class="divider"></li>
									<li><a href="https://builderengine.org/forum/all_topics" target="_blank"><i class="fa fa-compass"></i><span class="badge badge-danger pull-right">Support</span> Community Forums</a></li>
									<li><a href="https://builderengine.com/support/" target="_blank"><i class="fa fa-compass"></i><span class="badge badge-danger pull-right">Support</span> Support Tickets</a></li>
									<li class="divider"></li>
									<li><a href="https://builderengine.com/guides/all_posts" target="_blank"><i class="fa fa-compass"></i><span class="badge badge-danger pull-right">Tutorials</span> Support Guides</a></li>
									<li><a href="https://builderengine.com/videotube/all_videos" target="_blank"><i class="fa fa-compass"></i><span class="badge badge-danger pull-right">Tutorials</span> Video Guides</a></li>
									<li class="divider"></li>
									<li><a href="<?=base_url('admin/main/logout')?>"><i class="fa fa-compass"></i>Log Out</a></li>
								</ul>
							</li>
							<li class="has-sub">
								<a href="javascript:;">
									<b class="caret pull-right"></b>
									<i class="material-icons">create</i>
									<span id="editorStatus">Page</span><span> Designer <span id="editorStatusLabel" class="label label-theme m-l-5"><span id="editorlabelStatus">IN-ACTIVE</span></span></span>
								</a>
								<ul class="sub-menu">
									<li><a id="simpleDesigner" href="#" editor-mode-switch="edit" class="designerSwitch"><i class="fa fa-compass"></i>Simple Designer <span id="sd" class="label label-danger m-l-5">OFF</span></a></li>
									<li><a id="advancedDesigner" href="#" editor-mode-switch="editv3" class="designerSwitch"><i class="fa fa-compass"></i>Standard Designer <span id="ad" class="label label-danger m-l-5">OFF</span></a></li>
									<li><a href="<?=base_url()?>"><i class="fa fa-times"></i>Exit</a></li>
								</ul>
							</li>
							<!-- <a> -->
							<span id="freeMode" style="color: #FFFFFF;" class='resetCss'><input id="change-color-switch" type="checkbox"  data-on-color="info" data-off-color="default"> <label id='freeModeText'></label></span>
							<!-- </a> -->
							<li class="has-sub">
								<a href="javascript:;">
									<b class="caret pull-right"></b>
									<i class="material-icons">devices</i>
									<span>View Devices</span>
								</a>
								<ul class="sub-menu">
									<li><a href="#" editor-size-switch="lg" editor-size-pixels="100%"><i class="fa fa-desktop"></i>Large Desktop</a></li>
									<li><a href="#" editor-size-switch="lg" editor-size-pixels="1180px"><i class="fa fa-laptop"></i>Notebook Desktop</a></li>
									<li><a href="#" editor-size-switch="md" editor-size-pixels="788px"><i class="fa fa-tablet"></i>Tablet Screen</a></li>
									<li><a href="#" editor-size-switch="sm" editor-size-pixels="340px"><i class="fa fa-mobile"></i>Mobile Screen</a></li>
								</ul>
							</li>
							<li class="has-sub undo-li" style="display:none">
								<a id="undo" href="#" undo-id="">
									<i class="fa fa-undo" style="color:#458bad"></i>
									<span>Undo</span>
								</a>
							</li>
							<li class="has-sub redo-li" style="display:none">
								<a id="redo" href="#" redo-id="">
									<i class="fa fa-repeat" style="color:#458bad"></i>
									<span>Redo</span>
								</a>
							</li>
							<li class="has-sub">
								<a href="javascript:;">
									<b class="caret pull-right"></b>
									<i class="material-icons">rotate_left</i>
									<span>Saved Versions</span>
								</a>
								<ul class="sub-menu">
									<li><a href="#" class="page-versions-button"><i class="fa fa-th"></i>Current Page Versions</a></li>
									<li><a href="#" class="layout-versions-button"><i class="fa fa-th"></i>Header & Footer Versions</a></li>
									<?php if($this->BuilderEngine->get_option('erase_content_control') == 'on'):?>					
										<li>
											<a class="" href="<?=base_url('/layout_system/erase_all_blocks')?>" onclick="return confirm('This action will erase ALL your website Content / Blocks and will revert it to the original theme files in your system. Are you sure you want to do that?') && confirm('Please confirm that this operation will erase all website content and will revert it to its initial state. There is no going back after this! Press OK or Cancel.')"><i class="fa fa-undo"></i>Revert All Content Data</a>
										</li>
										<li>
											<a class="" id="erase-page" href="<?=base_url('/layout_system/erase_page_blocks')?>" onclick="return confirm('This will erase from the Database of all your Content / Blocks on this current page only. No other Pages will be affected by this action. Are you sure you want to do that?')"><i class="fa fa-undo"></i>Revert Only This Page</a>
										</li>
									<?php else:?>
									<?php endif;?>
								</ul>
							</li>
							<li class="has-sub active">
							<?php if($versions->get_pending_page_version_id(get_page_path()) || $versions->get_pending_page_version_id("layout")):?>
								<a href="" class="fa fa-magic" id="publish-button" page="<?=get_page_path()?>">
									<i class="material-icons">toys</i>
								</a>
							<?php else: ?>
								<a href="" class="fa fa-check disabled" id="publish-button" page="<?=get_page_path()?>">
									<i class="fa fa-check disabled"></i>
									<span>LIVE</span>
								</a>
								<?php endif; ?>
							</li>
							<li class="has-sub">
								<a href="javascript:;">
									<b class="caret pull-right"></b>
									<i class="material-icons">dashboard</i>
									<span>Admin Dashboard</span>
								</a>
								<ul class="sub-menu">
									<li>
										<?if((($this->user->is_member_of('Frontend Editor') && !$this->user->is_member_of('Administrators')) || ($this->user->is_member_of('Frontend Manager') && !$this->user->is_member_of('Administrators')))):?>
											<a href="<?=base_url('cp/dashboard')?>">
										<?else:?>
											<a href="<?=base_url('/admin')?>">
										<?endif;?>
										<i class="fa fa-compass"></i>Dashboard Homepage</a>
									</li>
									<li class="has-sub">
										<a href="javascript:;"><b class="caret pull-right"></b><i class="fa fa-compass"></i>Main Settings</a>
										<ul class="sub-menu be-subsub-menu">
											<li><a href="<?=base_url('admin/main/settings')?>">Website Settings</a></li>
											<li><a href="<?=base_url('admin/files/show')?>">File Manager</a></li>
											<li><a href="<?=base_url('admin/main/seo_settings')?>">SEO Settings</a></li>
											<li><a href="<?=base_url('admin/backup/backup')?>">Backup & Restore</a></li>
										</ul>
									</li>
									<li class="has-sub">
										<a href="javascript:;"><b class="caret pull-right"></b><i class="fa fa-compass"></i>Member Accounts</a>
										<ul class="sub-menu be-subsub-menu">
											<li><a href="<?=base_url('admin/user/search')?>">View All Registered Members</a></li>
											<li><a href="<?=base_url('admin/user/register_settings')?>">Approve / Reject New Members</a></li>
											<li><a href="<?=base_url('cp/dashboard')?>">Members Account Dashboard</a></li>
										</ul>
									</li>
									<li class="has-sub">
										<a href="javascript:;"><b class="caret pull-right"></b><i class="fa fa-compass"></i>Themes & Analytics</a>
										<ul class="sub-menu be-subsub-menu">
											<li><a href="<?=base_url('admin/themes/show')?>">Installed Website Templates</a></li>
											<li><a href="<?=base_url('admin/main/statistics')?>">Website Statistics</a></li>
											<li><a href="<?=base_url('admin/main/statisticsmodules')?>">Module Statistics</a></li>
										</ul>
									</li>
								</ul>
							</li>
							<li class="has-sub">
								<a href="javascript:;">
									<b class="caret pull-right"></b>
									<i class="material-icons">insert_drive_file</i>
									<span>Website Pages</span> 
								</a>
								<ul class="sub-menu">
									<li><a href="<?=base_url('admin/module/page/add')?>"><i class="fa fa-compass"></i>Create New Page</a></li>
									<li><a href="<?=base_url('admin/module/page/show_pages')?>"><i class="fa fa-compass"></i>View Pages & Settings</a></li>
								</ul>
							</li>
							<li class="menu-control menu-control-left">
								<a href="#" data-click="prev-menu"><i class="material-icons">arrow_back</i></a>
							</li>
							<li class="menu-control menu-control-right">
								<a href="#" data-click="next-menu"><i class="material-icons">arrow_forward</i></a>
							</li>
						</ul>
						<!-- end top-menu nav -->
					</div>
					<!-- end #top-menu -->
<style>
label {
  font-weight: 500;
  color: #e0e0e0;
}
</style>