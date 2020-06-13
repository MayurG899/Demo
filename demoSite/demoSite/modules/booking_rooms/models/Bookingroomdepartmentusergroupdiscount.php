<?php
class BookingRoomDepartmentUsergroupDiscount extends DataMapper 
{
	var $table = 'booking_room_department_usergroup_discounts';

	var $has_one = array(
		'department' => array(
			'class' => 'BookingRoomDepartment',
			'other_field' => 'usergroupdiscount',
			'join_self_as' => 'usergroupdiscount',
			'join_other_as' => 'department'
		)
	);
}
?>