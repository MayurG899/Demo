<?php
	class Member_extend extends DataMapper 
	{
		var $table = 'ecommerce_users_extend';

		var $has_one = array(
	        'member' => array(
	            'class' => 'member',
	            'other_field' => 'extended_info',
	            'join_self_as' => 'extended_info',
	            'join_other_as' => 'member',
	            'join_table' => 'ecommerce_member_extended_info_links'
	        )
	    );

	    public function create($data)
	    {
	    	$this->telephone = $data['telephone'];
	    	$this->address = $data['address'];
	    	$this->country = $data['country'];
	    	$this->state = $data['state'];
	    	$this->city = $data['city'];
	    	$this->save();
	    }
	}
?>