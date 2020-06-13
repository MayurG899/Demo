<?php
	class VideoTubeVideoReport extends DataMapper 
	{
		var $table = 'be_videotube_video_reports';

		var $has_one = array(
		    'media' => array(
				'class' => 'VideoTubeMedia',
				'other_field' => 'report',
				'join_self_as' => 'report',
				'join_other_as' => 'media',
			), 
		);
	}
?>