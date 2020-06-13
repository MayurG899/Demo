<?php
	class VideoTubeMedia extends DataMapper 
	{
		var $table = 'be_videotube_medias';

		var $has_one = array(
		    'album' => array(
				'class' => 'VideoTubeAlbum',
				'other_field' => 'media',
				'join_self_as' => 'media',
				'join_other_as' => 'album',
			), 
		);

		var $has_many = array(
			'comment' => array(
				'class' => 'VideoTubeComment',
				'other_field' => 'media',
				'join_self_as' => 'media',
				'join_other_as' => 'comment',
			),
			'rating' => array(
				'class' => 'VideoTubeRating',
				'other_field' => 'media',
				'join_self_as' => 'media',
				'join_other_as' => 'rating',
			), 
			'like' => array(
				'class' => 'VideoTubeLike',
				'other_field' => 'media',
				'join_self_as' => 'media',
				'join_other_as' => 'like',
			),
			'report' => array(
				'class' => 'VideoTubeVideoReport',
				'other_field' => 'media',
				'join_self_as' => 'media',
				'join_other_as' => 'report',
			), 			
		);

    	public function create($data)
    	{
            $data = array_map('mysql_real_escape_string', $data);

            if($data['user_id'])
                $this->user_id = $data['user_id'];
            else
                $this->user_id = get_active_user_id();
			$this->title = $data['title'];
			$this->description = $data['text'];
    		$this->file = $data['media_file'];
			$this->album_id = $data['album_id'];
			$this->tags = $data['tags'];
    		$this->groups_allowed = $data['groups_allowed'];
			$this->comments_allowed = $data['comments_allowed'];
			$this->time_created = time();
			$this->status = $data['status'];
			$this->featured = $data['featured'];
			$this->type = $data['type'];
    		$this->save();
    	}
	
        public function report($text = '')
        {
            $video_report = new VideoTubeVideoReport();
            $video_report->media_id = $this->id;
            if($text != '')
                $video_report->text = $text;
            $video_report->time_of_creation = time();
            $video_report->save();
        }

		public function get_like_name_or_description_or_tag($keyword)
		{
			$this->db->select('*');
			$this->db->like('title', $keyword);
			$this->db->or_like('description', $keyword);
			$this->db->or_like('tags', $keyword);
			$query = $this->db->get('be_videotube_medias');
			$res = array();
			foreach($query->result() as $result){
				array_push($res,$result->id);
			}
			return $res;
		}
	}
?>