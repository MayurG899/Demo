<?php
	class AudioPlayerAlbum extends DataMapper 
	{
		var $table = 'be_audioplayer_albums';

		var $has_many = array(
			'media' => array(
				'class' => 'AudioPlayerMedia',
				'other_field' => 'album',
				'join_self_as' => 'album',
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
            $this->parent_id = $data['parent_id'];
    		$this->name = $data['name'];
    		$this->image = $data['image'];
    		$this->groups_allowed = $data['groups_allowed'];
			$this->status = $data['status'];
    		$this->save();
    	}
	}
?>