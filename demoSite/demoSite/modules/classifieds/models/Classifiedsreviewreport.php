<?php
	class ClassifiedsReviewReport extends DataMapper 
	{
		var $table = 'classifieds_review_reports';

		var $has_one = array(
		    'review' => array(
				'class' => 'ClassifiedsReview',
				'other_field' => 'report',
				'join_self_as' => 'report',
				'join_other_as' => 'review',
			), 
		);
	}
?>