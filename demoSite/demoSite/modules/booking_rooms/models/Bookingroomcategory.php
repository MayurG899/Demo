<?php
	class BookingRoomCategory extends DataMapper 
	{
		var $table = 'booking_room_categories';

	    var $has_many = array(
			'department' => array(
				'class' => 'BookingRoomDepartment',
				'other_field' => 'category',
				'join_self_as' => 'category',
				'join_other_as' => 'department',
			),
    	);

        public function has_children()
        {
            $all_categories = new BookingRoomCategory();
            foreach($all_categories->where('parent_id', $this->id)->get() as $category)
            {
                return true;
            }
            return false;
        }

    	public function create($data)
    	{
            $data = array_map('mysql_real_escape_string', $data);

            if($data['user_id'])
                $this->user_id = $data['user_id'];
            else
                $this->user_id = get_active_user_id();
            $this->parent_id = $data['parent_id'];
    		$this->name = $data['name'];
			$this->description = $data['description'];
    		$this->image = !empty($data['image'])?$data['image']:base_url('builderengine/public/img/photo_placeholder.png');
			$this->time_created = time();
    		$this->groups_allowed = $data['groups_allowed'];
    		$this->save();
    	}
	}
?>