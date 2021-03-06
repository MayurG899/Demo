<?php
	class VideoTubeComment extends DataMapper 
	{
		var $table = 'be_videotube_comments';

		var $has_one = array(
		    'media' => array(
				'class' => 'VideoTubeMedia',
				'other_field' => 'comment',
				'join_self_as' => 'comment',
				'join_other_as' => 'media',
			), 
		);
		var $has_many = array(
			'report' => array(
				'class' => 'VideoTubeCommentReport',
				'other_field' => 'comment',
				'join_self_as' => 'comment',
				'join_other_as' => 'report',
			), 
		 );

    	public function create($data)
    	{
            $data = array_map('mysql_real_escape_string', $data);
            
    		$this->media_id = isset($data['media_id'])?$data['media_id']:0;
			$this->channel_owner_id = isset($data['channel_owner_id'])?$data['channel_owner_id']:0;
    		$this->user_id = $data['user_id'];			
    		$this->name = $data['name'];
    		$this->text = $data['text'];
    		$this->time_created = time();
    		$this->save();
    	}

        public function report($text = '')
        {
            $comment_report = new VideoTubeCommentReport();
            $comment_report->comment_id = $this->id;
            if($text != '')
                $comment_report->text = $text;
            $comment_report->time_of_creation = time();
            $comment_report->save();
        }

        public function delete_comment($id){
            $this->db
                ->where('id', $id)
                ->delete($this->table);
        }
	}
?>