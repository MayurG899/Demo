<?php
	class Forum_topic extends DataMapper 
	{
		var $table = 'be_forum_topics';
/*
	    var $has_many = array(
        	'forum_category'
    	);
*/
    	public function create($data)
    	{
            $data = array_map('mysql_real_escape_string', $data);

            if($data['user_id'])
                $this->user_id = $data['user_id'];
            else
                $this->user_id = get_active_user_id();
			if(!empty($data['image']))
				$image = $data['image'];
			else
				$image = $data['icon'];

			$this->area_id = $data['area_id'];
    		$this->name = $data['name'];
			$this->description = $data['description'];
    		$this->image = $image;
    		$this->groups_allowed = $data['groups_allowed'];
			$this->time_created = time();
    		$this->save();
    	}
	}
?>