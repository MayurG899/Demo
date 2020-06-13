<?php echo get_header() ?>

<?php echo get_sidebar() ?>

<?php if (isset($groups)): ?>
	
<script>
	$(document).ready(function() {
		$("#groups").select2({tags:[ <?php foreach ($groups as $group): ?>"<?php echo $group->name?>", <?php endforeach;?>]});
		$("#tags").select2({tags:[]});
	});
</script>
<?php endif ?>
<!-- begin #content -->
<div id="content" class="content page-with-two-sidebar content-two-sidebars" style="min-height:800px">

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
                            <h4 class="panel-title">Website Themes Installed</h4>
                        </div>
                        <div class="panel-body">
                            <ul class="nav nav-tabs nav-tabs-inverse nav-justified nav-justified-mobile">
						<li class="active"><a href="#latest-post" data-toggle="tab"><i class="fa fa-picture-o m-r-5"></i> <span class="hidden-xs">Currently Active Theme</span></a></li>
						<li class=""><a href="#system" data-toggle="tab"><i class="fa fa-shopping-cart m-r-5"></i> <span class="hidden-xs">Available Themes Installed</span></a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade active in" id="latest-post">
							<div class="height-sm" data-scrollbar="true">
								<ul class="media-list media-list-with-divider">
									<li class="media media-lg">
										<a href="javascript:;" class="pull-left">
											<img class="media-object becms-themes-img" src="<?php echo base_url().$active_theme['screenshot_url']?>" alt="" />
										</a>
										<div class="media-body"><br>
											<h3 class="media-heading" style="text-transform: uppercase;"><?=str_replace('_',' ',$active_theme['name'])?></h3><br>
											<p style="display:inline"><?php echo $active_theme['description']?></p>
											<!---->
											<form class="form-horizontal" method="get">
					                        	<div class="form-group becms-themes-margintop1">
					                            	<label class="control-label" for="fullname"><h4 style="margin-top: 0px;">Available Theme Colors</h4></label>
					                            	<div class="col-md-4 col-sm-4">
						                                <select class="form-control form-control-100" name="color_pattern"/>
						                                <?php $colors = scandir('themes/'.$BuilderEngine->get_option("active_frontend_theme").'/css/color_patterns');?>
															<?php if(!in_array('default.css',$colors)):?>
						                                	<option value="default">Default</option>
															<?php endif;?>
															<?php foreach($colors as $color):?>
																<?php if($color != '.' && $color != '..'):?>
																	<?php $color_name = str_replace('.css', '', $color);?>
																	<option value="<?=$color_name?>" <?if($BuilderEngine->get_option('theme_color_pattern') == $color_name) echo 'selected';?>><?=ucfirst($color_name)?></option>
																<?php endif;?>
															<?php endforeach;?>
															<?php
															/*<option value="red" <?php if($BuilderEngine->get_option('theme_color_pattern') == 'red') echo 'selected';?>>Red</option>
															<option value="blue" <?php if($BuilderEngine->get_option('theme_color_pattern') == 'blue') echo 'selected';?>>Blue</option>*/?>
						                            	</select>
					                            	</div>
					                        	</div>
					                        	<div class="form-group">
					                        		<label class="control-label" for="fullname"></label>
					                            	<div class="col-md-12 col-sm-12">
						                                <button type="submit" class="btn btn-primary">Apply Theme Color</button>
					                            	</div>
					                        	</div>
					                        </form>
					                        <!---->
										</div>
									</li>
								</ul>
							</div>
						</div>
						<div class="tab-pane fade" id="system">
							<div class="height-lg" data-scrollbar="true">
								<ul class="media-list media-list-with-divider">
								<?php foreach($themes as $theme):?>
									<li class="media media-lg">
										<a href="javascript:;" class="pull-left">
											<img class="media-object becms-themes-img" src="<?php echo base_url().$theme['screenshot_url']?>" alt="" />
										</a>
										<div class="media-body"><br>
											<h3 class="media-heading" style="text-transform: uppercase;"><?=str_replace('_',' ',$theme['name'])?></h3>
											<?php echo $theme['description']?>
										</div>
										<p></p>
										<div class="col-md-6 col-sm-6">
										<form action='' method='post'>
                                            <input type="hidden" name="theme" value="<?php echo $theme['name']?>">
                                        <?php if($theme['name'] == $active_theme['name']):?>
                                            <button class="btn btn-default disabled" disabled> Already Active </button>
                                        <?php else:?>
                                            <input type=submit class="btn btn-warning " value="Activate">  
                                        <?php endif;?>
                                        </form>
											</div>
										</li>
								<?php endforeach;?>
								</ul>
							</div>
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
					<h4 class="sidebar-right-main-title">Website Themes</h4>
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
                                        View all installed themes and activate the theme you want. Change color settings per theme. <br><br>
										Go to the Marketplace to install new themes for your website.
										
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
										<div class="todolist-title">Theme Settings</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Activate Theme</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Select Theme Colors</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Marketplace New Themes</div>
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