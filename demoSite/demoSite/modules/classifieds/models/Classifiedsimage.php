<?
	class ClassifiedsImage extends DataMapper 
	{	
		var $table = 'classifieds_images';

		var $has_one = array(
            'item' => array(
				'class' => 'ClassifiedsItem',
				'other_field' => 'image',
				'join_self_as' => 'image',
				'join_other_as' => 'item',				
			),
		);
	}