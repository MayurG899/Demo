
<div id="content" class="page-with-two-sidebar content-two-sidebars" style="min-height:800px">
<!-- begin row -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                </div>
                <h4 class="panel-title">View All Event Booking Orders</h4>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="data-table" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Event Image</th>
                            <th>Event Name</th>
							<th>Categories</th>
							<th>Start date</th>
							<th>End Date</th>
                            <th>Capacity</th>
							<th>Booked</th>
                            <th>Event Creation</th>
                            <th>Attendees Confirmed</th>
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
									<td><?=$object->booked?></td>
									<td><?=date('d-M-Y H:i:s',$object->time_created)?></td>
									<td style="text-align: center">
										<a class="btn btn-success" href="#" data-toggle="modal" data-target="#myModal<?=$object->id?>"><i class="fa fa-money"></i> View Bookings</a>
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
<script src="<?=base_url('themes/dashboard/assets/plugins/jquery/jquery-1.9.1.min.js')?>"></script>
<?foreach($objects as $event):?>
	<div class="modal fade" id="myModal<?=$event->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document" style="width:97%">
			<div class="modal-content">
				<form id="bookForm" name="" method="get" data-parsley-validate="true" action="<?=base_url('booking_events/event_checkout')?>" class="" style="margin-bottom:0">
					<div class="modal-header" style="background:#ccc;border-top-left-radius:5px;border-top-right-radius:5px;">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title text-center" id="myModalLabel"><?=$event->name?> - Booking Orders </h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<? 
									$o = new Booking_event_order();
									$orders = $o->where('event_id',$event->id)->order_by('time_created','DESC')->get();
								?>
								<?if($orders->exists()):?>
								<table  class="table table-striped table-hover table-bordered table-responsive">
									<thead>
									<tr>
										<th>Id</th>
										<th>Username</th>
										<th>Email</th>
										<th>User Group(s)</th>
										<th>Tickets</th>
										<th>Total</th>
										<th>Invoice (VAT included)</th>
										<th>Status</th>
										<th>Date Created</th>
										<th>Gateway</th>
										<th>Transaction Id</th>
										<th>Actions</th>
									</tr>
									</thead>
									<tbody>
										<?foreach($orders as $order):?>
											<?	
												$bu = new User();
												$booking_user = $bu->where('email',$order->email)->get();
												$user_groups = $this->users->get_user_group_name($booking_user->id);
												if(empty($user_groups))
													$user_groups = array('Non Members');
											?>
											<tr>
												<td><?=$order->id?></td>
												<td><?=$order->username?></td>
												<td><a href="mailto:<?=$order->email?>?Subject=Hello%20<?=ucfirst($order->username)?>"><?=$order->email?></a></td>
												<td><?
														$usergroups = '';
														foreach($user_groups as $group){
															$usergroups .= ' <span class="label label-warning">'.$group.'</span> ';
														}
														echo $usergroups;
													?>
												</td>
												<td><?=$order->tickets?></td>
												<td>
													<?
														if($order->price == 0)
															echo '<span class="badge" style="background:green;">FREE</span>';
														else
															echo $order->price;
													?>
												</td>
												<td><?=$order->paid?></td>
												<td>
													<?	if($order->payment_method == 'cod'){
															if((int)$order->price === 0){
																echo '<span class="label label-success"><i class="fa fa-check"></i> Paid</span>';
															}else{
																if($order->paid_toggle == 'yes')
																	echo '<span class="label label-success"><i class="fa fa-check"></i> Paid</span>';
																else
																	echo '<span class="onHold'.$order->id.' label label-warning"><i class="onHi'.$order->id.' fa fa-pause"></i><span class="onT'.$order->id.'"> Pending</span></span>';
															}
														}else
															echo '<span class="label label-success"><i class="fa fa-check"></i> Paid</span>';
													?>
												</td>
												<td><?=date('d/m/Y H:i:s',$order->time_created)?></td>
												<td><?=ucfirst($order->payment_method)?></td>
												<td><?=$order->trans_id?></td>
												<td>
													<?if($order->payment_method == 'cod'):?>
														<?if($order->paid_toggle == 'no'):?>
															<a id="setPaid<?=$order->id?>" class="btn btn-xs btn-success" href="#" style="margin-bottom:5px;"><i class="fa fa-check"></i> Set Paid</a>
														<?endif;?>
															<a class="btn btn-sm btn-primary" href="<?=base_url('admin/ajax/invoices/'.$order->id.'/event/'.$event->id)?>" target="_blank"><i class="fa fa-television"></i> View</a>
													<?else:?>
														<a class="btn btn-sm btn-primary" href="<?=base_url('admin/ajax/invoices/'.$order->id.'/event/'.$event->id)?>" target="_blank"><i class="fa fa-television"></i> View</a>
													<?endif;?>
												</td>
											</tr>
											<script>
												$(document).ready(function(){
													var order_id = '<?=$order->id?>';
													$('#setPaid<?=$order->id?>').on('click',function(event){
														$.ajax({
															url: '<?=base_url('admin/ajax/toggle_paid')?>',
															type: "POST",
															data: {object_id: order_id},
															dataType: "text",
															success: function (data){
																console.log(data);
																if(data == 'paid') {
																	$('.onHold<?=$order->id?>').removeClass('label-warning');
																	$('.onHold<?=$order->id?>').addClass('label-success');
																	$('.onHi<?=$order->id?>').removeClass('fa-pause');
																	$('.onHi<?=$order->id?>').addClass('fa-check');
																	$('.onT<?=$order->id?>').text(' Paid');
																	$('#setPaid<?=$order->id?>').remove();
																} else {
																	$('.onHold<?=$order->id?>').removeClass('label-success');
																	$('.onHold<?=$order->id?>').addClass('label-warning');
																	$('.onHi<?=$order->id?>').removeClass('fa-check');
																	$('.onHi<?=$order->id?>').addClass('fa-pause');
																}
															}
														});
													});
												});
											</script>
										<?endforeach;?>
									</tbody>
								</table>
								<?else:?>
									<h1 class="text-center">No Orders for this event</h1>
								<?endif;?>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<?if($orders->exists()):?>
							<a id="download-<?=$event->id?>" href="<?=base_url('files/event_attendee_list.pdf')?>" class="btn btn-sm btn-success" style="display:none" download><i class="fa fa-download animated infinite flash" style="animation-duration:1.6s"></i> Download Attendee List</a>
							<a id="print-<?=$event->id?>" href="" class="btn btn-sm btn-warning"><i class="fa fa-print"></i> Generate Attendee List</a>
							<script>
								$(document).ready(function(){
									$('#print-<?=$event->id?>').on('click',function(e){
										e.preventDefault();
										$.get( "<?=base_url('admin/module/booking_events/print_attendee_list/'.$event->id)?>", function(){});
										$(this).fadeOut('fast');
										setTimeout(function(){
											$('#download-<?=$event->id?>').fadeIn('slow');
										},200);
									});
									$('#download-<?=$event->id?>').on('click',function(){
										$(this).fadeOut('fast');
										setTimeout(function(){
											$('#print-<?=$event->id?>').fadeIn('slow');
											$.get( "<?=base_url('admin/module/booking_events/delete_attendee_list_file')?>", function(){});
										},500);
									});
								});
							</script>
						<?endif;?>
						<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
						<!--<button id="submit" type="submit" class="btn btn-lg btn-success"><i class="fa fa-check"></i> Checkout</button>-->
					</div>
				</form>
			</div>
		</div>
	</div>
<?endforeach;?>

<!-- end row -->
<!-- begin #sidebar-right -->
		<div id="sidebar-right" class="sidebar sidebar-right">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav m-t-10">
					<h4 class="sidebar-right-main-title">Booking Events</h4>
					<li class="nav-widget">
                        <div class="panel-group m-b-0" id="accordion">
							<div class="panel panel-grey panel-bg-buttons">
                                <div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('booking_events/events');?>" target="_blank" class="btn btn-sm btn-block btn-success btn-r-sidebar-2">
                                            <i class="fa fa-file-o pull-right text-white"></i>
											<b>Events Homepage</b>
                                        </a>
                                    </h3>
                                </div>
								<div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('admin/module/booking_events/add_event');?>" class="btn btn-sm btn-block btn-indigo btn-r-sidebar-2">
                                            <i class="fa fa-calendar pull-right text-white"></i>
											<b>Create Event</b>
                                        </a>
                                    </h3>
                                </div>
								<div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('admin/module/booking_events/show_events');?>" class="btn btn-sm btn-block btn-indigo btn-r-sidebar-2">
                                            <i class="fa fa-calendar pull-right text-white"></i>
											<b>View All Events</b>
                                        </a>
                                    </h3>
                                </div>
								<div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('admin/module/booking_events/show_event_orders');?>" class="btn btn-sm btn-block btn-indigo btn-r-sidebar-2">
                                            <i class="fa fa-money pull-right text-white"></i>
											<b>Event Bookings</b>
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
                                        Setup your Booking Events Website by using the module options on the left sidebar. <br><br>
										Configure your events module settings in how events will be used.
										
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
										<div class="todolist-title">Events Access</div>
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
										<div class="todolist-title">Adjust Events Settings</div>
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
										<div class="todolist-title">Add Event</div>
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
										<div class="todolist-title">Reserve Dates</div>
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