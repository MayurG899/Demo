<?php
class BookingRoomDepartmentImage extends DataMapper 
{
	var $table = 'booking_room_department_images';

	var $has_one = array(
		'department' => array(
			'class' => 'BookingRoomDepartment',
			'other_field' => 'additional_image',
			'join_self_as' => 'image',
			'join_other_as' => 'department'
		)
	);
}
?>