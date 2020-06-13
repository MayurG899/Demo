<?php
class BookingRoomDepartmentAddonservice extends DataMapper 
{
	var $table = 'booking_room_department_addon_services';

	var $has_one = array(
		'department' => array(
			'class' => 'BookingRoomDepartment',
			'other_field' => 'addonservice',
			'join_self_as' => 'addonservice',
			'join_other_as' => 'department'
		)
	);
}
?>