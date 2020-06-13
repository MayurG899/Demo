<?
	class ClassifiedsMemberExtend extends DataMapper 
	{	
		var $table = 'classifieds_users_extend';

		var $has_one = array(
			'member'=> array(
				'class' => 'ClassifiedsMember',
				'other_field' => 'classifiedsmemberextend',
				'join_self_as' => 'classifiedsmemberextend',
				'join_other_as' => 'member',					
			),	
		);
	}