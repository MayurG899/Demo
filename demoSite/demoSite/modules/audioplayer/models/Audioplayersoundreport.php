<?php
	class AudioPlayerSoundReport extends DataMapper 
	{
		var $table = 'be_audioplayer_sound_reports';

		var $has_one = array(
		    'media' => array(
				'class' => 'AudioPlayerMedia',
				'other_field' => 'report',
				'join_self_as' => 'report',
				'join_other_as' => 'media',
			), 
		);
	}
?>