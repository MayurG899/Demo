<?php
	class VideoTubeUserSettings extends DataMapper 
	{
		var $table = 'be_videotube_user_settings';
		
    	public function create($data)
    	{
            $data = array_map('mysql_real_escape_string', $data);

            if($data['user_id'])
                $this->user_id = $data['user_id'];
            else
                $this->user_id = get_active_user_id();
    		$this->about = $data['about'];
    		$this->background_img = $data['background_img'];
			$this->channel_settings = isset($data['channel_settings'])?$data['channel_settings']:'yes';
    		$this->save();
    	}
	}
?>