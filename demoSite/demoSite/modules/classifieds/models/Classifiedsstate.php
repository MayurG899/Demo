<?
	class ClassifiedsState extends DataMapper 
	{	
		var $table = 'classifieds_states';

		var $has_many = array(
			'lga' => array(
				'class' => 'ClassifiedsLga',
				'other_field' => 'state',
				'join_self_as' => 'state',
				'join_other_as' => 'lga',				
			),
		);
	}