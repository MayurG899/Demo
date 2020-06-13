<?php
class BookingRoom extends DataMapper 
{
	var $table = 'be_booking_rooms';


	var $has_one = array(
		'department' => array(
			'class' => 'BookingRoomDepartment',
			'other_field' => 'room',
			'join_self_as' => 'room',
			'join_other_as' => 'department',
		),
	);
	/*
	var $has_many = array(

	);
	*/
	public function create($data,$date = false)
	{
		if(!$date){
			$date = DateTime::createFromFormat('d/m/Y',$data['date']);
			$date = $date->format("Y-m-d");
		}
		else
			$date = $data['date'];
		$this->user_id = isset($data['user_id'])?$data['user_id']:get_active_user_id();
		$this->department_id = $data['department_id'];
		$this->date = $date;
		$this->start_time = $data['start_time'];
		$this->end_time = $data['end_time'];
		$this->recurrence_rate = isset($data['recurrence_rate'])?$data['recurrence_rate']:'';
		$this->status = isset($data['status'])?$data['status']:'booked';
		$this->time_created = time();
		$this->save();
	}
}
?>