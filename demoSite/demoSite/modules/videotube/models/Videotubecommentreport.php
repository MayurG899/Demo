<?php
	class VideoTubeCommentReport extends DataMapper 
	{
		var $table = 'be_videotube_comment_reports';

		var $has_one = array(
		    'comment' => array(
				'class' => 'VideoTubeComment',
				'other_field' => 'report',
				'join_self_as' => 'report',
				'join_other_as' => 'comment',
			), 
		);
	}
?>