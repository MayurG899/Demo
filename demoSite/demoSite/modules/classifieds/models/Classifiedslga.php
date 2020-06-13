<?
	class ClassifiedsLga extends DataMapper 
	{	
		var $table = 'classifieds_lga';

		var $has_one = array(
			'state' => array(
				'class' => 'ClassifiedsState',
				'other_field' => 'lga',
				'join_self_as' => 'lga',
				'join_other_as' => 'state',				
			),
		);
	}