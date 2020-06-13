<?php
class Booking_membership_image extends DataMapper 
{
	var $table = 'booking_membership_images';

	var $has_one = array(
		'membership' => array(
			'class' => 'Booking_membership',
			'other_field' => 'additional_image',
			'join_self_as' => 'image',
			'join_other_as' => 'membership'
		)
	);
}
?>