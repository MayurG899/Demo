<div id="content" class="page-with-two-sidebar content-two-sidebars" style="min-height:800px">
<!-- begin row -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                </div>
                <h4 class="panel-title">All Membership Applications Submitted & Orders</h4>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="data-table" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Membership Image</th>
                            <th>Membership Plan</th>
							<th>Categories</th>
							<th>Start date</th>
							<th>End Date</th>
                            <th>Capacity</th>
							<th>Booked</th>
							<th>Active</th>
                            <th>Time of creation</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?$i = 1;?>
                        <?foreach($objects as $object): ?>
							<?//if($this->user->get_id() == $object->user_id):?>
								<tr>
									<td><?=$object->id?></td>
									<td><img src="<?=$object->image?>" class="img-responsive" style="width:80px" /></td>
									<td><?=$object->name?></td>
									<td>
										<?
											$cat = '';
											$categories = explode(',',$object->categories);
											foreach($categories as $category){
												$cat .= ' <span class="label label-success">'.$category.'</span> ';
											}
											echo $cat;
										?>
									</td>
									<td><?=date('d/m/Y',strtotime($object->start_date));?></td>
									<td><?=date('d/m/Y',strtotime($object->end_date));?></td>
									<td><?=$object->capacity?></td>
									<td>
										<?
											$booked = 0;
											$pending = 0;
											$orders = new BuilderPaymentOrder();
											$orders = $orders->where('module','booking_memberships')->get();
											if($orders->exists()){
												foreach($orders as $order){
													$custom_data = json_decode($order->custom_data);
													if(!empty($custom_data)){
														if($object->id == $custom_data->membership_id)
															$booked += 1;
														if($object->id == $custom_data->membership_id && $custom_data->reviewed == 'pending')
															$pending += 1;
													}
												}
											}
										?>
										<?=$booked?>
									</td>
									<td><span class="label label-<?=($object->active == 'yes')?'success':'danger';?>"><?=ucfirst($object->active)?></span></td>
									<td><?=date('d-M-Y H:i:s',$object->time_created)?></td>
									<td style="text-align: center">
										<a class="btn btn-success"  href="#" data-toggle="modal" data-target="#myModal<?=$object->id?>">Applications</a>
										<?if($pending > 0):?>
											<span class="badge badge-warning" style="position:relative;top:-40px;right:-48px;color:#fff"><?=$pending?></span>
										<?endif;?>
									</td>
								</tr>
								<?$i++;?>
							<?//endif;?>
                        <?endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div><!-- End .widget-content -->
        </div><!-- End .widget -->
    </div><!-- End .span12  -->
</div><!-- End .row-fluid  -->
<!-- end row -->
<!-- begin #sidebar-right -->
		<div id="sidebar-right" class="sidebar sidebar-right">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav m-t-10">
					<h4 class="sidebar-right-main-title">Booking Memberships</h4>
					<li class="nav-widget">
                        <div class="panel-group m-b-0" id="accordion">
							<div class="panel panel-grey panel-bg-buttons">
                                <div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('booking_memberships/memberships');?>" target="_blank" class="btn btn-sm btn-block btn-success btn-r-sidebar-2">
                                            <i class="fa fa-file-o pull-right text-white"></i>
											<b>Memberships Page</b>
                                        </a>
                                    </h3>
                                </div>
								<div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('admin/module/booking_memberships/add_membership');?>" class="btn btn-sm btn-block btn-indigo btn-r-sidebar-2">
                                            <i class="fa fa-calendar pull-right text-white"></i>
											<b>Add Membership</b>
                                        </a>
                                    </h3>
                                </div>
								<div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('admin/module/booking_memberships/show_memberships');?>" class="btn btn-sm btn-block btn-indigo btn-r-sidebar-2">
                                            <i class="fa fa-calendar pull-right text-white"></i>
											<b>All Memberships</b>
                                        </a>
                                    </h3>
                                </div>
								<div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('admin/module/booking_memberships/show_membership_orders');?>" class="btn btn-sm btn-block btn-indigo btn-r-sidebar-2">
                                            <i class="fa fa-money pull-right text-white"></i>
											<b>All Applications</b>
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
                                        Setup your Booking Memberships Website by using the module options on the left sidebar. <br><br>
										Allow visitors to sign-up & pay for membership or wait for approval by you.
										
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
										<div class="todolist-title">Membership Access</div>
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
										<div class="todolist-title">Adjust Membership Settings</div>
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
										<div class="todolist-title">Add Category</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Add Membership</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Add Payment Provider</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Membership Dates</div>
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

<?foreach($objects as $service):?>
	<div class="modal fade" id="myModal<?=$service->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document" style="width:97%">
			<div class="modal-content">
				<form id="bookForm" name="" method="get" data-parsley-validate="true" action="<?=base_url('booking_memberships/membership_checkout')?>" class="" style="margin-bottom:0">
					<div class="modal-header" style="background:#ccc;border-top-left-radius:5px;border-top-right-radius:5px;">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title text-center" id="myModalLabel"><b><?=$service->name?></b> - Membership Applications & Orders </h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<? 
									$order_exists = false;
									$o = new BuilderPaymentOrder();
									$orders = $o->where('module','booking_memberships')->order_by('time_created','DESC')->get();
									if($orders->exists()){
										foreach($orders as $order){
											$custom_data = json_decode($order->custom_data);
											if(!empty($custom_data)){
												if($custom_data->membership_id == $service->id)
													$order_exists = true;
											}
										}
									}
								?>
								<?if($order_exists):?>
									<table  class="table table-striped table-hover table-bordered table-responsive">
										<thead>
											<tr>
												<th>Membership Plan</th>
												<th>Order id</th>
												<th>Full Name</th>
												<th>Email</th>
												<th>Phone</th>
												<th>User Group(s)</th>
												<th>Total Price</th>
												<th>Payment Status</th>
												<th>Application Status</th>
												<th>Date Created</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
											<?foreach($orders as $order):?>
												<?$custom_data = json_decode($order->custom_data);?>
												<?if(!empty($custom_data) && $service->id == $custom_data->membership_id):?>
												<?	
													$bu = new User();
													$booking_user = $bu->where('email',$order->billingAddress->get()->email)->get();
													$user_groups = $this->users->get_user_group_name($booking_user->id);
													if(empty($user_groups))
														$user_groups = array('Non Members');
												?>
												<tr>
													<td><?=ucfirst($service->name)?></td>
													<td><?=$order->id?></td>
													<td><?=$booking_user->first_name.' '.$booking_user->last_name?></td>
													<td><a href="mailto:<?=$booking_user->email?>?Subject=Hello%20<?=ucfirst($booking_user->username)?>"><?=$booking_user->email?></a></td>
													<td><?=$booking_user->extended->get()->telephone?></td>
													<td><?
															$usergroups = '';
															$usergroup_class = 'warning';
															foreach($user_groups as $group){
																if($group == 'Non Members')
																	$usergroup_class = 'primary';
																$usergroups .= ' <span class="label label-'.$usergroup_class.'">'.$group.'</span> ';
															}
															echo $usergroups;
														?>
													</td>
													<td>
														<?
															$currency = new Currency($order->currency);
															if($order->gross == 0)
																echo '<span class="badge" style="background:green;">FREE</span>';
															else
																if($currency->symbol_position = 'before')
																	echo $currency->symbol.$order->gross;
																else
																	echo $order->gross.$currency->symbol;
														?>
													</td>
													<td>
														<?
															if($order->status == 'pending')
																echo '<span class="label label-warning animated flash infinite" style="animation-duration:1.8s"><i class="fa fa-pause"></i> Pending</span>';
															else
																if($order->status == 'paid')
																	echo '<span class="label label-success"><i class="fa fa-check"></i> Paid</span>';
																else
																	echo '<span class="label label-danger"><i class="fa fa-times"></i> Canceled</span>';
														?>
													</td>
													<td>
														<?
															if(!empty($custom_data->questionnaire))
															{
																if($custom_data->reviewed == 'pending')
																	echo '<span class="label label-warning animated flash infinite" style="animation-duration:1.8s"><i class="fa fa-pause"></i> Pending</span>';
																if($custom_data->reviewed == 'approved')
																	echo '<span class="label label-success"><i class="fa fa-check"></i> Approved</span>';
																if($custom_data->reviewed == 'rejected')
																	echo '<span class="label label-danger"><i class="fa fa-times"></i> Rejected</span>';
															}
															else
																echo '<span class="label label-info"><i class="fa fa-info-circle"></i> No Application</span>';
														?>
													</td>
													<td><?=date('d-M-Y H:i:s',$order->time_created)?></td>
													<td>
														<div style="width:130px">
															<?if(!empty($custom_data->questionnaire) || (isset($custom_data->approval) && $custom_data->approval == 'yes')):?>
																<?
																	$title = '';
																	if(!empty($custom_data->questionnaire) && $custom_data->reviewed == 'pending')
																		$title = 'Review';
																	if(empty($custom_data->questionnaire) && $custom_data->reviewed == 'pending' && isset($custom_data->approval) && $custom_data->approval == 'yes')
																		$title = 'Approve';
																	
																?>
																<?if($custom_data->reviewed == 'pending'):?>
																	<a class="btn btn-xs btn-success"  href="#" data-toggle="modal" data-target="#myDetailModal<?=$order->id?>" target="_blank" title="<?=$title?> Application"><i class="fa fa-cog"></i> <?=$title?></a>
																<?endif;?>
																<?if(!empty($custom_data->questionnaire)):?>
																	<a class="btn btn-xs btn-warning" href="<?=base_url('admin/ajax/print_application/'.$order->id)?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Print Application"><i class="fa fa-print"></i></a>
																<?endif;?>
															<?endif;?>
															<a class="btn btn-xs btn-primary" href="<?=base_url('admin/ajax/order_invoice/booking_memberships/'.$order->id)?>" target="_blank" data-toggle="tooltip" data-placement="top" title="View Order"><i class="fa fa-eye"></i></a>
															<?/*<a class="btn btn-sm btn-danger" href="<?=base_url('admin/module/booking_memberships/delete_object/Booking_membership_order/'.$order->id)?>"><i class="fa fa-trash"></i> Delete</a> */?>
														</div>
													</td>
												</tr>
												<?endif;?>
											<?endforeach;?>
										</tbody>
									</table>
								<?else:?>
									<h2 class="text-center">No submitted applications for this membership plan</h2>
								<?endif;?>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
						<!--<button id="submit" type="submit" class="btn btn-lg btn-success"><i class="fa fa-check"></i> Checkout</button>-->
					</div>
				</form>
			</div>
		</div>
	</div>
	<? 
		$o = new BuilderPaymentOrder();
		$orders = $o->where('module','booking_memberships')->order_by('time_created','DESC')->get();
	?>
	<?if($orders->exists()):?>
		<?foreach($orders as $order):?>
			<?$custom_data = json_decode($order->custom_data);?>
			<?if($service->id == $custom_data->membership_id):?>
				<div class="modal fade" id="myDetailModal<?=$order->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document" style="width:97%">
						<div class="modal-content">
							<div class="modal-header" style="background:#ccc;border-top-left-radius:5px;border-top-right-radius:5px;">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title text-center" id="myModalLabel"><?=$order->billingAddress->get()->first_name.' '.$order->billingAddress->get()->last_name.'`s'?> (<?=$order->billingAddress->get()->email?>) Application</h4>
							</div>
							<div class="modal-body">
								<div class="container">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<?if(!empty($custom_data->questionnaire)):?>
											<?foreach($custom_data->questionnaire as $key => $val):?>
												<p><b><span class="label label-inverse membership-orders-label"><?=ucfirst(str_replace('_',' ',$key))?>:</span></b></p>
												<div class="alert alert-application">
													<p><?=$val?></p>
												</div>
											<?endforeach;?>
										<?else:?>
											<h2 class="text-center">No submitted applications for this membership plan</h2>
											<?if((isset($custom_data->approval) && $custom_data->approval == 'yes') && $custom_data->reviewed == 'pending'):?>
												<h4 class="text-center"><span class="label label-warning animated flash infinite" style="animation-duration:1.8s"><i class="fa fa-info-circle"></i> Approval Required</span></h4>
											<?endif;?>
										<?endif;?>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<a class="btn btn-sm btn-grey" data-dismiss="modal" style="margin-bottom:0"><i class="fa fa-times"></i> Close</a>
								<?if(!empty($custom_data->questionnaire)):?>
									<a class="btn btn-sm btn-warning" href="<?=base_url('admin/ajax/print_application/'.$order->id)?>" target="_blank"><i class="fa fa-print"></i> Print</a>
								<?endif;?>
								<a class="btn btn-sm btn-success" href="<?=base_url('admin/module/booking_memberships/review_application/approved/'.$order->id)?>"><i class="fa fa-check"></i> Approve</a>
								<a class="btn btn-sm btn-danger" href="<?=base_url('admin/module/booking_memberships/review_application/rejected/'.$order->id)?>"><i class="fa fa-times"></i> Reject</a>
							</div>
						</div>
					</div>
				</div>
			<?endif;?>
		<?endforeach;?>
	<?endif;?>
<?endforeach;?>
