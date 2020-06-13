<?php
	class PhotoGalleryPhotoReport extends DataMapper 
	{
		var $table = 'be_photo_gallery_photo_reports';

		var $has_one = array(
		    'media' => array(
				'class' => 'PhotoGalleryMedia',
				'other_field' => 'report',
				'join_self_as' => 'report',
				'join_other_as' => 'media',
			), 
		);
	}
?>