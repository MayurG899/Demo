<?php echo get_header() ?>

<?php echo get_sidebar() ?>

<!-- begin #content -->
<div id="content" class="content page-with-two-sidebar content-two-sidebars">
	<!-- begin row -->
	<div class="row">
		<!-- begin col-12 -->
		<div class="col-md-12">
		<div class="result-container">
				<div class="input-group m-b-20">
					<input type="text" class="form-control input-white" placeholder="Enter keywords here..." />
					<div class="input-group-btn">
						<button type="button" class="btn btn-inverse"><i class="fa fa-search"></i> Search</button>
					</div>
				</div>
			  </div>
			<!-- begin panel -->
			<div class="panel panel-white">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					</div>
					<h4 class="panel-title">All Active User Accounts</h4>
				</div>
				<div class="panel-body">
					<form id="deleteForm" action="<?=base_url('admin/user/bulk_delete')?>" method="POST">
						<a href="<?=base_url('admin/user/add')?>" class="btn btn-sm btn-success m-r-10" style="float:left"><i class="fa fa-plus"></i> Add New User Account</a>
						<button type="submit" id="deleteChecked" name="bulkDelete" class="btn btn-sm btn-danger" style="display:none" ><i class="fa fa-trash"></i> Delete Account(s)</button>
						<br/><br/>
						<div class="table-responsive">
							<table id="data-table-checkbox" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th><br/><input name="select_all" value="1" type="checkbox"></th>
										<th>Username</th>
										<th>Avatar</th>
										<th>Name</th>
										<th>Surname</th>
										<th>Email</th>
										<th>Status</th>
										<th>Group Level</th>
										<th>Account</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($search_results as $result): ?>
									<tr class="odd gradeX" data-id="<?=$result->id?>">
										<td></td>
										<td><?php echo $result->username?></td>
										<td><?php echo '<img src="'.$result->avatar.'" class="img-responsive" width="80">';?></td>
										<td><?php echo $result->first_name?></td>
										<td><?php echo $result->last_name?></td>
										<td><?php echo $result->email?></td>
										<td><span class="label <?if($result->banned == 1) echo 'label-danger animated flash infinite';else if($result->verified =='yes') echo 'label-success';else echo 'label-warning';?>" style="animation-duration:2s;"><?if($result->banned == 1) echo 'Suspended';else if($result->verified == 'yes') echo 'Active User'; else echo 'Unverified User';?></span><br/><br/> 
										<?php echo date("G:i:s d-m-Y", $result->date_registered)?></td>
										<td><?php $usr = new User($result->id);
											$str = "";
											foreach($usr->group->get() as $group) $str .= $group->name.", ";
											$str = trim($str, ', ');
											echo $str;
											?>
										</td>
										<td>
											<div style="width:80px">
												<a <?php echo href("admin", "user/edit/{$result->id}")?>class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Edit User"><i class="fa fa-edit"></i></a>
											<?if($result->banned == 1):?>
												<a href="<?=base_url('admin/user/unban_user/'.$result->id)?>" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Unsuspend User Account"><i class="fa fa-check-square-o"></i></a>
											<?else:?>
												<?$reason = 'Account suspended by Admin';?>
												<a href="<?=base_url('admin/user/ban_user/'.$result->id.'/'.$reason)?>" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="Suspend User Account" ><i class="fa fa-pause"></i></a>
											<?endif;?>
												<a id="deleteUser<?=$result->id?>" <?php echo href("admin", "user/delete/{$result->id}")?> class="btn btn-xs btn-danger deleteButton" data-toggle="tooltip" data-placement="top" title="Delete User Account"><i class="fa fa-trash"></i></a>
											</div>
											<?if($result->banned == 1):?>
												<div class="alert alert-danger m-t-5" style="padding:5px">
													<p style="font-size:10px;"><i class="fa fa-exclamation-triangle"></i> <?=$result->ban_reason?></p>
												</div>
											<?endif;?>
										</td>
									</tr>
									<?php endforeach; ?>

								</tbody>
							</table>
						</div>
					</form>
				</div>
			</div>
			<!-- end panel -->
		</div>
		<!-- end col-12 -->
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
                                        View all users (members) on your website and edit their accounts or ban & delete them.
										
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
										<div class="todolist-title">Delete User Account</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Ban User Account</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Edit User Account</div>
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
<?php foreach($search_results as $result): ?>
	<script>
		//bulk delete
		$('#deleteUser<?=$result->id?>').on('click',function(e){
			e.preventDefault();

			swal({
			  title: "Are you sure?",
			  text: "You will not be able to recover <?=$result->first_name.' '.$result->last_name?> user anymore!",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonColor: "#DD6B55",
			  confirmButtonText: "Yes, delete <?=$result->first_name.' '.$result->last_name?>!",
			  cancelButtonText: "No, cancel please!",
			  closeOnConfirm: true,
			  closeOnCancel: true
			},
			function(isConfirm){
				if (isConfirm) {
					//swal("Deleted!", "Your data will be permanently deleted.", "success");
					$('#deleteForm').submit();
				} else {
					// swal("Cancelled", "Your data is safe :)", "error");
					return false;
				}
			});
		});
	</script>
<?php endforeach;?>