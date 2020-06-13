<?php
	class Like extends DataMapper 
	{
		var $table = 'be_forum_likes';
/*		
	    var $has_many = array(
        	'forum_topic'
    	);
		*/
    	public function create($data)
    	{
            $data = array_map('mysql_real_escape_string', $data);
    		$this->user_id = $data['user_id'];
    		$this->post_id = $data['post_id'];
    		$this->save();
    	}
	}
?>