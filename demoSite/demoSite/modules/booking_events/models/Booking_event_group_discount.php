<?php
class Booking_event_group_discount extends DataMapper 
{
	var $table = 'booking_event_group_discounts';

	var $has_one = array(
		'event' => array(
			'class' => 'Booking_event',
			'other_field' => 'groupdiscount',
			'join_self_as' => 'groupdiscount',
			'join_other_as' => 'event'
		)
	);
}
?>