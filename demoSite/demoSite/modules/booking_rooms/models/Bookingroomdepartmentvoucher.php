<?php
class BookingRoomDepartmentVoucher extends DataMapper 
{
	var $table = 'booking_room_department_vouchers';

	var $has_one = array(
		'department' => array(
			'class' => 'BookingRoomDepartment',
			'other_field' => 'voucher',
			'join_self_as' => 'voucher',
			'join_other_as' => 'department'
		)
	);
}
?>