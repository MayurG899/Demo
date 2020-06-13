<?php
class Booking_membership_voucher extends DataMapper 
{
	var $table = 'booking_membership_vouchers';

	var $has_one = array(
		'membership' => array(
			'class' => 'Booking_membership',
			'other_field' => 'voucher',
			'join_self_as' => 'voucher',
			'join_other_as' => 'membership'
		)
	);
}
?>