<?php
class Booking_event_image extends DataMapper 
{
	var $table = 'booking_event_images';

	var $has_one = array(
		'event' => array(
			'class' => 'Booking_event',
			'other_field' => 'additional_image',
			'join_self_as' => 'image',
			'join_other_as' => 'event'
		)
	);
}
?>