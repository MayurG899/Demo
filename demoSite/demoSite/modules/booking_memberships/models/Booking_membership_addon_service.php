<?php
class Booking_membership_addon_service extends DataMapper 
{
	var $table = 'booking_membership_addon_services';

	var $has_one = array(
		'membership' => array(
			'class' => 'Booking_membership',
			'other_field' => 'addonservice',
			'join_self_as' => 'addonservice',
			'join_other_as' => 'membership'
		)
	);
}
?>