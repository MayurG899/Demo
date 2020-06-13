<?
	class ClassifiedsWatchlist extends DataMapper 
	{	
		var $table = 'be_classifieds_user_watchlist';

		var $has_one = array(
            'member' => array(
				'class' => 'ClassifiedsMember',
				'other_field' => 'watchlist',
				'join_self_as' => 'watchlist',
				'join_other_as' => 'member',				
			),
		);
		var $has_many = array(
            'item' => array(
				'class' => 'ClassifiedsItem',
				'other_field' => 'watchlist',
				'join_self_as' => 'watchlist',
				'join_other_as' => 'item',				
			),
		);
	}