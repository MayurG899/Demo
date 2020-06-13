<?php
	class AudioPlayerFollow extends DataMapper 
	{
		var $table = 'be_audioplayer_follows';
/*
		var $has_many = array(
		    'user' => array(
				'class' => 'VideoGalleryFollow',
				'other_field' => 'follow',
				'join_self_as' => 'follow',
				'join_other_as' => 'user',
			), 
		);
*/
    	public function create($data)
    	{
            $data = array_map('mysql_real_escape_string', $data);

            if($data['follower_id'])
                $this->follower_id = $data['follower_id'];
            else
                $this->follower_id = get_active_user_id();
    		$this->following_id = $data['following_id'];
    		$this->save();
    	}
	}
?>