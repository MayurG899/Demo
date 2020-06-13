<?php
class BookingRoomDepartmentEarlyDiscount extends DataMapper 
{
	var $table = 'booking_room_department_early_discounts';

	var $has_one = array(
		'department' => array(
			'class' => 'BookingRoomDepartment',
			'other_field' => 'earlydiscount',
			'join_self_as' => 'earlydiscount',
			'join_other_as' => 'department'
		)
	);
}
?>