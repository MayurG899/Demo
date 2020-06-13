<?php
class Booking_membership_early_discount extends DataMapper 
{
	var $table = 'booking_membership_early_discounts';

	var $has_one = array(
		'membership' => array(
			'class' => 'Booking_membership',
			'other_field' => 'earlydiscount',
			'join_self_as' => 'earlydiscount',
			'join_other_as' => 'membership'
		)
	);
}
?>