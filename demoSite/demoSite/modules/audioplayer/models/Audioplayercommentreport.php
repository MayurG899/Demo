<?php
	class AudioPlayerCommentReport extends DataMapper 
	{
		var $table = 'be_audioplayer_comment_reports';

		var $has_one = array(
		    'comment' => array(
				'class' => 'AudioPlayerComment',
				'other_field' => 'report',
				'join_self_as' => 'report',
				'join_other_as' => 'comment',
			), 
		);
	}
?>