<?
	class ClassifiedsWatchlistqwerty extends DataMapper 
	{	
		var $table = 'classifieds_watchlist';

		var $has_one = array(
            'member' => array(
				'class' => 'ClassifiedsMember',
				'other_field' => 'watchlistquery',
				'join_self_as' => 'watchlistquery',
				'join_other_as' => 'member',				
			),
		);
		var $has_many = array(
            'item' => array(
				'class' => 'ClassifiedsItem',
				'other_field' => 'watchlistquery',
				'join_self_as' => 'watchlistquery',
				'join_other_as' => 'item',				
			),
		);
	}
?>	