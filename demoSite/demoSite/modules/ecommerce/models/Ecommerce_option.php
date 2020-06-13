<?php
	class Ecommerce_option extends DataMapper
	{
		var $table = 'ecommerce_product_options';

		var $has_one = array(
			'product' => array(
					'class' => 'Ecommerce_product',
					'other_field' => 'option',
					'join_self_as' => 'option',
					'join_other_as' => 'product',
					'join_table' => 'ecommerce_products'
			),
	    );
	}
?>