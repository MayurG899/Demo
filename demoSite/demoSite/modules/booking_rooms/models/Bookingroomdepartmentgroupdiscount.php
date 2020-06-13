<?php
class BookingRoomDepartmentGroupDiscount extends DataMapper 
{
	var $table = 'booking_room_department_group_discounts';

	var $has_one = array(
		'department' => array(
			'class' => 'BookingRoomDepartment',
			'other_field' => 'groupdiscount',
			'join_self_as' => 'groupdiscount',
			'join_other_as' => 'department'
		)
	);
}
?>