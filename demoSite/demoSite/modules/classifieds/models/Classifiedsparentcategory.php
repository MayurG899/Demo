<?
	class ClassifiedsParentCategory extends DataMapper 
	{	
		var $table = 'classifieds_categories';

		var $has_many = array(
			'category' => array(
				'class' => 'ClassifiedsCategory',
				'other_field' => 'parent',
				'join_self_as' => 'parent',
				'join_other_as' => 'category',					
			),
		);
	}