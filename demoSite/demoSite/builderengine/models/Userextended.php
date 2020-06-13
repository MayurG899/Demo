<?php 	
	/***********************************************************
	* BuilderEngine Community Edition v1.0.0
	* ---------------------------------
	* BuilderEngine CMS Platform - BuilderEngine Limited
	* Copyright BuilderEngine Limited 2012-2017. All Rights Reserved.
	*
	* http://www.builderengine.com
	* Email: info@builderengine.com
	* Time: 2017-01-17 | File version: 1.0.0
	*
	***********************************************************/

	class UserExtended extends DataMapper 
	{
		var $table = 'be_users_extended';

		var $has_one = array(
			'user' => array(
				'class' => 'User',
				'other_field' => 'extended',
				'join_self_as' => 'extended',
				'join_other_as' => 'user',
				'join_table' => 'be_users'
			),
		);
		var $has_many = array();

		function create($data)
		{
			$this->user_id = $data['user_id'];
			$this->telephone = $data['telephone'];
			$this->address = $data['address'];
			$this->city = $data['city'];
			$this->state = $data['state'];
			$this->zip = $data['zip'];
			$this->country = $data['country'];
			$this->gender = isset($data['gender'])?$data['gender']:'male';
			$this->company = isset($data['company'])?$data['company']:NULL;
			$this->save();
		}
	}
?>