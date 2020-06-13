<?
	class ClassifiedsReview extends DataMapper 
	{	
		var $table = 'classifieds_reviews';

		var $has_one = array(
            'item' => array(
				'class' => 'ClassifiedsItem',
				'other_field' => 'review',
				'join_self_as' => 'review',
				'join_other_as' => 'item',			
			),
		);
	}