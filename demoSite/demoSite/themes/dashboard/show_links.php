<?php echo get_header() ?>

<?php echo get_sidebar() ?>

<!-- begin #content -->
<div id="content" class="content page-with-two-sidebar content-two-sidebars">

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
                            <h4 class="panel-title">View All Navbar Menu Links</h4>
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Navbar Button Name</th>
                                        <th>URL Address Target</th>
                                        <th>Alt Title</th>
										<th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($this->links->get_all_links() as $link): ?>
                                    <?php if($link->parent != 0) continue?>
                                    <tr>
                                        <td><?php echo $link->name?></td>
                                        <td><?php echo $link->target?></td>
                                        <td><?php echo $link->title?></td>
                                        <td><a href="<?php echo base_url()?>admin/links/edit/<?php echo $link->id?>" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a> <a href="<?php echo base_url()?>admin/links/delete/<?php echo $link->id?>" onclick="return confirm('Are you sure you want to permanently delete this link?')" class="btn btn-inverse"><i class="fa fa-remove"></i> Delete</a></td>
                                    </tr>
									<?php $children = $this->links->link_has_children($link->id);?>
                                    <?php if(is_array($children) && !$this->links->is_child($link->id)):?>
                                        <?php foreach($children as $sub_link): ?>
											<?php $second_children = $this->links->link_has_children($sub_link->id);?>
											<?php if(is_array($second_children)):?>
												<?php foreach($second_children as $subsub_link):?>
												<tr>
													<td>^^=><?php echo $subsub_link->name?></td>
													<td><?php echo $subsub_link->target?></td>
													<td><?php echo $subsub_link->title?></td>
													<td><a href="<?php echo base_url()?>admin/links/edit/<?php echo $subsub_link->id?>" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a> <a href="<?php echo base_url()?>admin/links/delete/<?php echo $subsub_link->id?>" onclick="return confirm('Are you sure you want to permanently delete this link?')" class="btn btn-inverse"><i class="fa fa-remove"></i> Delete</a></td>												
												</tr>
												<?php endforeach;?>
											<?php endif;?>
                                            <tr>
                                                <td>^=><?php echo $sub_link->name?></td>
                                                <td><?php echo $sub_link->target?></td>
                                                <td><?php echo $sub_link->title?></td>
                                                <td><a href="<?php echo base_url()?>admin/links/edit/<?php echo $sub_link->id?>" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a> <a href="<?php echo base_url()?>admin/links/delete/<?php echo $sub_link->id?>" onclick="return confirm('Are you sure you want to permanently delete this link?')" class="btn btn-inverse"><i class="fa fa-remove"></i> Delete</a></td>
                                            </tr>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                <?php endforeach;?>
                                    
                                </tbody>
                            </table>
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
					<h4 class="sidebar-right-main-title">Navbar Menu Links</h4>
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
                                        View all the navbar menu links for your website & edit each one needed.<br><br>
										Navbar links are the buttons on your Main Menu bar of your navbar block.
										
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
										<div class="todolist-title">Navbar Links</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Edit Navbar Links</div>
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