<?php
class Booking_membership_group_discount extends DataMapper 
{
	var $table = 'booking_membership_group_discounts';

	var $has_one = array(
		'membership' => array(
			'class' => 'Booking_membership',
			'other_field' => 'groupdiscount',
			'join_self_as' => 'groupdiscount',
			'join_other_as' => 'membership'
		)
	);
}
?>