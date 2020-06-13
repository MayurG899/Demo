<?
	class ClassifiedsMember extends DataMapper 
	{	
		var $table = 'users';

		var $has_one = array(
			'classifiedsmemberextend' => array(
				'class' => 'ClassifiedsMemberExtend',
				'other_field' => 'member',
				'join_self_as' => 'member',
				'join_other_as' => 'classifiedsmemberextend',				
			),
		);
		var $has_many = array(
			'watchlist' => array(			// in the code, we will refer to this relation by using the object name 'book'
	            'class' => 'ClassifiedsItem',
	            'other_field' => 'watching_member',
	            'join_table' => 'be_classifieds_user_watchlist',
	            'join_self_as' => 'member',
	            'join_other_as' => 'item'
	            ),
			'posted_item' => array(			// in the code, we will refer to this relation by using the object name 'book'
	            'class' => 'ClassifiedsItem',
	            'other_field' => 'posting_member',
	            ),
			'currency'			
		);
	}