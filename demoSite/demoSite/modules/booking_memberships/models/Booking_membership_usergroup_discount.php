<?php
class Booking_membership_usergroup_discount extends DataMapper 
{
	var $table = 'booking_membership_usergroup_discounts';

	var $has_one = array(
		'membership' => array(
			'class' => 'Booking_membership',
			'other_field' => 'usergroupdiscount',
			'join_self_as' => 'usergroupdiscount',
			'join_other_as' => 'membership'
		)
	);
}
?>