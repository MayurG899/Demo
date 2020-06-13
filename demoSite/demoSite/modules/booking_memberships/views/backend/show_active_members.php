

<!-- begin #content -->
<div id="content" class="page-with-two-sidebar content-two-sidebars">
	<!-- begin row -->
	<div class="row">
		<!-- begin col-12 -->
		<div class="col-md-12">
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
						<button type="submit" id="deleteChecked" name="bulkDelete" class="btn btn-sm btn-danger" style="display:none" ><i class="fa fa-trash"></i> Delete Account(s)</button>
						<br/><br/>
						<div class="table-responsive">
							<table id="data-table-checkbox" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th><br/><input name="select_all" value="1" type="checkbox"></th>
										<th>Name</th>
										<th>Surname</th>
										<th>Email</th>
										<th>Status</th>
										<th>Orders & Apps</th>
										<th>Subscriptions</th>
										<th>Group Level</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($results as $result):?>
										<?
											$subscription = $result->subscribed->get();
											$orders = new BuilderPaymentOrder();
											$orders = $orders->where('module','booking_memberships')->where('user_id',$result->id)->get();
										?>
										<?if($subscription->exists() && $subscription->module == 'booking_memberships'):?>
											<?$custom_data = json_decode($subscription->custom_data);?>
											<tr class="odd gradeX" data-id="<?=$result->id?>">
												<td></td>
												<td><?php echo $result->first_name?></td>
												<td><?php echo $result->last_name?></td>
												<td><?php echo $result->email?></td>
												<td>
													<span class="label <?if($result->banned == 1) echo 'label-danger animated flash infinite';else if($result->verified =='yes') echo 'label-success';else echo 'label-warning';?>" style="animation-duration:2s;"><?if($result->banned == 1) echo 'Suspended';else if($result->verified == 'yes') echo 'Active User'; else echo 'Unverified User';?></span><br/><br/> 
													<?php echo date("G:i:s d-m-Y", $result->date_registered)?>
												</td>
												<td>
													<?if($orders->where('module','booking_memberships')->where('user_id',$result->id)->count() > 0):?>
														<a class="btn btn-xs btn-success" href="#" data-toggle="modal" data-target="#myOrder<?=$result->id?>"><i class="fa fa-eye"></i> View (<?=$orders->where('module','booking_memberships')->where('user_id',$result->id)->count();?>)</a>
													<?else:?>
														N/A
													<?endif;?>
												</td>
												<td>
													<a class="btn btn-xs btn-primary" href="#" data-toggle="modal" data-target="#myModal<?=$result->id?>"><i class="fa fa-eye"></i> View (<?=$subscription->count();?>)</a>
												</td>
												<td>
													<?php 
														$usr = new User($result->id);
														$str = "";
														foreach($usr->group->get() as $group) $str .= $group->name.", ";
														$str = trim($str, ', ');
														echo $str;
													?>
												</td>
												<td>
													<div class="" style="width:80px">
														<a <?php echo href("admin", "user/edit/{$result->id}")?>class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
														<?if($result->banned == 1):?>
															<a href="<?=base_url('admin/user/unban_user/'.$result->id)?>" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Unban User"><i class="fa fa-check-square-o"></i></a>
														<?else:?>
															<?$reason = 'Account suspended by admin';?>
															<a href="<?=base_url('admin/user/ban_user/'.$result->id.'/'.$reason)?>" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="Ban User"><i class="fa fa-pause"></i></a>
														<?endif;?>
														<a id="deleteUser<?=$result->id?>" <?php echo href("admin", "user/delete/{$result->id}")?> class="btn btn-xs btn-danger deleteButton" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
														<?if($result->banned == 1):?>
															<p style="font-size:10px;"><?=$result->ban_reason?></p>
														<?endif;?>
													</div>
												</td>
											</tr>
										<?endif;?>
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
	<?php foreach($results as $result):?>
		<?
			$subscriptions = $result->subscribed->get();
			$orders = new BuilderPaymentOrder();
			$orders = $orders->where('module','booking_memberships')->where('user_id',$result->id)->get();
		?>
		<?if($subscriptions->exists()):?>
			<div class="modal fade" id="myModal<?=$result->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document" style="width:97%">
					<div class="modal-content">
						<div class="modal-header" style="background:#ccc;border-top-left-radius:5px;border-top-right-radius:5px;">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title text-center" id="myModalLabel"><b><?=$result->first_name.' '.$result->last_name?>`s</b> Subscriptions </h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-12">
									<table  class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>Id</th>
												<th>Membership</th>
												<th>Type</th>
												<th>Status</th>
												<th>Start date</th>
												<th>Expiry Date</th>
												<th>Note</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
											<?foreach($subscriptions as $subscription):?>
												<?if($subscription->module == 'booking_memberships'):?>
													<?
														$custom_data = json_decode($subscription->custom_data);
														$membership = new Booking_membership($custom_data->membership_id);
													?>
													<tr>
														<td><?=$subscription->id?></td>
														<td><?=$membership->name?></td>
														<td><?=ucfirst($subscription->type)?></td>
														<td>
															<?
																$label = '';
																$icon = '';
																if($subscription->status == 'active'){
																	$label = 'success';
																	$icon = 'check';
																}
																if($subscription->status == 'pending'){
																	$label = 'warning';
																	$icon = 'pause';
																}
																if($subscription->status == 'expired' || $subscription->status == 'terminated' || $subscription->status == 'canceled'){
																	$label = 'danger';
																	$icon = 'times';
																	if($subscription->status == 'terminated')
																		$icon = 'trash';
																}
															?>
															<span class="label label-<?=$label?>"><i class="fa fa-<?=$icon?>"></i> <?=ucfirst($subscription->status)?></span>
														</td>
														<td><?=date('d-m-Y G:i:s',$subscription->time_created)?></td>
														<td><?=date('d-m-Y G:i:s',$subscription->expiry_time)?></td>
														<td>
															<?if(isset($custom_data->note)):?>
																<?=$custom_data->note?>
															<?else:?>
																N/A
															<?endif;?>
														</td>
														<td>
															<?if($subscription->status == 'pending'):?>
																<a href="<?=base_url('admin/module/booking_memberships/activate_subscription/'.$subscription->id)?>" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Activate Subscription"><i class="fa fa-check"></i></a>
															<?endif;?>
															<?if(!isset($custom_data->terminated) || (isset($custom_data->terminated) && $custom_data->terminated == 'no')):?>
																<a href="<?=base_url('admin/module/booking_memberships/terminate_subscription/'.$subscription->id)?>" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Terminate Subscription"><i class="fa fa-trash"></i></a>
															<?endif;?>
														</td>
													</tr>
												<?endif;?>
											<?endforeach;?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?endif;?>
		<?if($orders->exists()):?>
			<div class="modal fade" id="myOrder<?=$result->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document" style="width:97%">
					<div class="modal-content">
						<div class="modal-header" style="background:#ccc;border-top-left-radius:5px;border-top-right-radius:5px;">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title text-center" id="myModalLabel"><b><?=$result->first_name.' '.$result->last_name?>`s</b> Orders </h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-12">
									<table  class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>No.</th>
												<th>Membership</th>
												<th>Payment Method</th>
												<th>Status</th>
												<th>Total</th>
												<th>Total Paid</th>
												<th>Time Created</th>
												<th>Time Paid</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
											<?foreach($orders as $order):?>
												<?
													$custom_data = json_decode($order->custom_data);
													$membership = new Booking_membership($custom_data->membership_id);
													$currency = new Currency($order->currency);
												?>
												<tr>
													<td><?=$order->id?></td>
													<td><?=$membership->name?></td>
													<td><?=ucfirst($order->payment_method)?></td>
													<td><?=ucfirst($order->status)?></td>
													<td>
														<?if($currency->symbol_position == 'before'):?>
															<?=$currency->symbol . number_format($order->gross,2,',','.')?>
														<?else:?>
															<?=number_format($order->gross,2,',','.') . $currency->symbol;?>
														<?endif;?>
													</td>
													<td>
														<?if($currency->symbol_position == 'before'):?>
															<?=$currency->symbol . number_format($order->paid_gross,2,',','.')?>
														<?else:?>
															<?=number_format($order->paid_gross,2,',','.') . $currency->symbol;?>
														<?endif;?>
													</td>
													<td>
														<?if($order->time_created > 0):?>
															<?=date('d-m-Y G:i:s',$order->time_created)?>
														<?else:?>
															N/A
														<?endif;?>
													</td>
													<td>
														<?if($order->time_paid > 0):?>
															<?=date('d-m-Y G:i:s',$order->time_paid)?>
														<?else:?>
															N/A
														<?endif;?>
													</td>
													<td>
														<?if($order->exists):?>
															<a href="<?=base_url('admin/ajax/order_invoice/booking_memberships/'.$order->id)?>"target="_blank" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="View Invoice"><i class="fa fa-file"></i></a>
														<?endif;?>
														<?if($order->payment_method =='cod' && $order->status == 'pending'):?>
															<a href="<?=base_url('admin/module/booking_memberships/set_paid/'.$order->id)?>" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Set Paid"><i class="fa fa-check"></i></a>
														<?endif;?>
														<?if(!empty($custom_data->questionnaire)):?>
															<a class="btn btn-xs btn-warning" href="#" data-toggle="modal" data-target="#myApps<?=$order->id?>" title="View Application"><i class="fa fa-eye"></i></a>
														<?endif;?>
													</td>
												</tr>
											<?endforeach;?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?foreach($orders as $order):?>
				<?$application = json_decode($order->custom_data);?>
				<div class="modal fade" id="myApps<?=$order->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document" style="width:97%">
						<div class="modal-content">
							<div class="modal-header" style="background:#ccc;border-top-left-radius:5px;border-top-right-radius:5px;">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title text-center" id="myModalLabel"><b><?=$result->first_name.' '.$result->last_name?>`s</b> Application </h4>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-md-12">
										<?if(isset($application->questionnaire)):?>
											<table  class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>Question</th>
														<th>Answer</th>
													</tr>
												</thead>
												<tbody>
													<?foreach($application->questionnaire as $question => $answer):?>
													<tr>
														<td><?=ucfirst(str_replace('_',' ',$question))?></td>
														<td><?=$answer?></td>
													</tr>
													<?endforeach;?>
												</tbody>
											</table>
										<?else:?>
											<h2 class="text-center"> No Application </h2>
										<?endif;?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?endforeach;?>
		<?endif;?>
	<?endforeach;?>
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
<script src="<?php echo get_theme_path()?>assets/plugins/jquery/jquery-1.9.1.min.js"></script>
<?php foreach($results as $result): ?>
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