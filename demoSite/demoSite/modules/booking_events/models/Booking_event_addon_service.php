<?php
class Booking_event_addon_service extends DataMapper 
{
	var $table = 'booking_event_addon_services';

	var $has_one = array(
		'event' => array(
			'class' => 'Booking_event',
			'other_field' => 'addonservice',
			'join_self_as' => 'addonservice',
			'join_other_as' => 'event'
		)
	);
}
?>