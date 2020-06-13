<?php
class Booking_event_early_discount extends DataMapper 
{
	var $table = 'booking_event_early_discounts';

	var $has_one = array(
		'event' => array(
			'class' => 'Booking_event',
			'other_field' => 'earlydiscount',
			'join_self_as' => 'earlydiscount',
			'join_other_as' => 'event'
		)
	);
}
?>