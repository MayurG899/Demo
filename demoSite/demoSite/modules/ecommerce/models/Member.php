<?php
	class Member extends DataMapper 
	{
		var $table = 'users';

		var $has_one = array(
	        'extended_info' => array(
	            'class' => 'member_extend',
	            'other_field' => 'member',
	            'join_self_as' => 'member',
	            'join_other_as' => 'extended_info',
	            'join_table' => 'ecommerce_member_extended_info_links'
	        )
	    );

	    var $has_many = array(
        	'wished_item' => array(
	            'class' => 'Ecommerce_product',
	            'other_field' => 'wishing_member',
	            'join_self_as' => 'member',
	            'join_other_as' => 'product',
	            'join_table' => 'ecommerce_wishlist'
            )
    	);
	}
?>