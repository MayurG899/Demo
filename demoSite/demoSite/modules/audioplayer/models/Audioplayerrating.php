<?php
	class AudioPlayerRating extends DataMapper 
	{
		var $table = 'be_audioplayer_ratings';

		var $has_one = array(
		    'media' => array(
				'class' => 'AudioPlayerMedia',
				'other_field' => 'rating',
				'join_self_as' => 'rating',
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
			$this->rating = $data['rating'];
    		$this->save();
    	}
	}
?>