<?php
class Booking_event_voucher extends DataMapper 
{
	var $table = 'booking_event_vouchers';

	var $has_one = array(
		'event' => array(
			'class' => 'Booking_event',
			'other_field' => 'voucher',
			'join_self_as' => 'voucher',
			'join_other_as' => 'event'
		)
	);
}
?>