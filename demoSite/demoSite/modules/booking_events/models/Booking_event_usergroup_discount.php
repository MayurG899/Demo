<?php
class Booking_event_usergroup_discount extends DataMapper 
{
	var $table = 'booking_event_usergroup_discounts';

	var $has_one = array(
		'event' => array(
			'class' => 'Booking_event',
			'other_field' => 'usergroupdiscount',
			'join_self_as' => 'usergroupdiscount',
			'join_other_as' => 'event'
		)
	);
}
?>