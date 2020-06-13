
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="panel panel-white">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				</div>
				<h4 class="panel-title">View All Booking Orders</h4>
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
									<td><?=$object->booked?></td>
									<td><?=date('d-M-Y H:i:s',$object->time_created)?></td>
									<td style="text-align: center">
										<a class="btn btn-success" href="#" data-toggle="modal" data-target="#myModal<?=$object->id?>"><i class="fa fa-desktop"></i> View Booking</a>
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
									$o = new BookingRoomOrder();
									$orders = $o->where('department_id',$event->id)->order_by('time_created','DESC')->get();
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
									<h1 class="text-center">No Orders for this room</h1>
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
<?endforeach;?>
