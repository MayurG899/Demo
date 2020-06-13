<?php
	class Icon extends DataMapper 
	{
		var $table = 'be_forum_icons';
/*		
	    var $has_many = array(
        	'forum_topic'
    	);
		*/
    	public function create($data)
    	{
            $data = array_map('mysql_real_escape_string', $data);
    		$this->name = $data['name'];
    		$this->image = $data['image'];
    		$this->save();
    	}
	}
?>