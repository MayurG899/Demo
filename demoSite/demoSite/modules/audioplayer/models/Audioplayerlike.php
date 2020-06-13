<?php
	class AudioPlayerLike extends DataMapper 
	{
		var $table = 'be_audioplayer_likes';

		var $has_one = array(
		    'media' => array(
				'class' => 'AudioPlayerLike',
				'other_field' => 'like',
				'join_self_as' => 'like',
				'join_other_as' => 'media',
			), 
		);

    	public function create($data)
    	{
            $data = array_map('mysql_real_escape_string', $data);

            if($data['user_id'])
                $this->user_id = $data['user_id'];
            else
                $this->user_id = get_active_user_id();
    		$this->media_id = $data['media_id'];
			$this->status = $data['status'];
    		$this->save();
    	}
	}
?>