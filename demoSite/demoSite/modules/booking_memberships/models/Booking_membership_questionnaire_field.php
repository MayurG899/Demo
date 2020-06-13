<?php
class Booking_membership_questionnaire_field extends DataMapper
{
	var $table = 'be_booking_membership_questionnaire_fields';

	var $has_one = array(
		'membership' => array(
			'class' => 'Booking_membership',
			'other_field' => 'questionnaire_field',
			'join_self_as' => 'questionnaire_field',
			'join_other_as' => 'membership'
		)
	);

	public function create($data)
	{
		$this->membership_id = $data['membership_id'];
		$this->name = $data['name'];
		$this->type = isset($data['type'])?$data['type']:NULL;
		$this->required = $data['required'];
		$this->options = isset($data['options'])?$data['options']:NULL;
		$this->order = isset($data['order'])?$data['order']:0;
		$this->save();
	}
}
?>