<?php
	class Forum_category extends DataMapper 
	{
		var $table = 'be_forum_categories';
/*
		var $has_one = array(
			'topic'
		);
	    var $has_many = array(
        	'forum_thread'
    	);
*/
    	public function create($data)
    	{
            $data = array_map('mysql_real_escape_string', $data);

            if($data['user_id'])
                $this->user_id = $data['user_id'];
            else
                $this->user_id = get_active_user_id();
            $this->topic_id = $data['topic_id'];
    		$this->name = $data['name'];
			$this->description = $data['description'];
    		$this->image = $data['image'];
    		$this->groups_allowed = $data['groups_allowed'];
			$this->time_created = time();
			$this->locked = (isset($data['locked'])) ? $data['locked'] : 'no';
    		$this->save();
    	}
	}
?>