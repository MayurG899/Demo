<?php
	class PhotoGalleryCommentReport extends DataMapper 
	{
		var $table = 'be_photo_gallery_comment_reports';

		var $has_one = array(
		    'comment' => array(
				'class' => 'PhotoGalleryComment',
				'other_field' => 'report',
				'join_self_as' => 'report',
				'join_other_as' => 'comment',
			), 
		);
	}
?>