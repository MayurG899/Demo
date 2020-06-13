<script src="<?=base_url('themes/dashboard/assets/plugins/jquery/jquery-1.9.1.min.js')?>"></script>
<div class="row">
	<?$event = new Booking_event($event_id);?>
	<h2 class="text-center"><?=$event->name?> Event Attendee List</h2>
	<div class="col-md-12">
		<? 
			$o = new Booking_event_order();
			$orders = $o->where('event_id',$event_id)->order_by('time_created','DESC')->get();
		?>
		<?if($orders->exists()):?>
		<table  class="table table-striped table-hover table-bordered table-responsive">
			<thead>
			<tr>
				<th>Id</th>
				<th>Full Name</th>
				<th>Email</th>
				<th>Tickets</th>
				<th>Invoice Total Amount</th>
				<th>Status</th>
				<th>Date Created</th>
				<th>Payment Method</th>
				<th>Presence - Tick off</th>
			</tr>
			</thead>
			<tbody>
				<?foreach($orders as $order):?>
					<?	
						$currency = new Currency($event->currency_id);
						$bu = new User();
						$booking_user = $bu->where('email',$order->email)->get();
						$user_groups = $this->users->get_user_group_name($booking_user->id);
						if(empty($user_groups))
							$user_groups = array('Non Members');
					?>
					<tr>
						<td style="padding:5px;border:1px solid black;"><?=$order->id?></td>
						<td style="padding:5px;border:1px solid black;"><?=$order->username?></td>
						<td style="padding:5px;border:1px solid black;"><a href="mailto:<?=$order->email?>?Subject=Hello%20<?=ucfirst($order->username)?>"><?=$order->email?></a></td>
						<td style="padding:5px;border:1px solid black;"><?=$order->tickets?></td>
						<td style="padding:5px;border:1px solid black;"><?=$currency->symbol.$order->paid?></td>
						<td style="padding:5px;border:1px solid black;">
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
						<td style="padding:5px;border:1px solid black;"><?=date('d/m/Y H:i:s',$order->time_created)?></td>
						<td style="padding:5px;border:1px solid black;"><?=ucfirst($order->payment_method)?></td>
						<td style="border:2px solid black;padding:10px;width:40px;height:40px;margin-bottom:5px;"></td>
					</tr>
				<?endforeach;?>
			</tbody>
		</table>
		<?else:?>
			<h1 class="text-center">No Orders for this event</h1>
		<?endif;?>
	</div>
</div>
