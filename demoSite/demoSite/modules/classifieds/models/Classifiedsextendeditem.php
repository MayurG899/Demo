<?
	class ClassifiedsExtendedItem extends DataMapper 
	{	
		var $table = 'classifieds_items_extend';

		var $has_one = array(
            'item' => array(
				'class' => 'ClassifiedsItem',
				'other_field' => 'extendeditem',
				'join_self_as' => 'extendeditem',
				'join_other_as' => 'item',			
			),
		);
		
	}
?>	