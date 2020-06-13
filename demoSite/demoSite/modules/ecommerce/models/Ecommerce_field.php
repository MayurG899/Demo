<?php
	class Ecommerce_field extends DataMapper
	{
		var $table = 'ecommerce_fields';

	    var $has_many = array(
        	'category_field' => array(
	            'class' => 'Ecommerce_category',
	            'other_field' => 'category_field',
	            'join_self_as' => 'field',
	            'join_other_as' => 'category',
	            'join_table' => 'ecommerce_category_fields'
            ),
            'product_field' => array(
	            'class' => 'Ecommerce_product',
	            'other_field' => 'product_field',
	            'join_self_as' => 'field',
	            'join_other_as' => 'product',
	            'join_table' => 'ecommerce_product_fields'
            )
    	);

    	public function get_value($product_id)
    	{
			$product_field = new Product_value();
			$product_field = $product_field->where('product_id', $product_id)->where('field_id', $this->id)->get();
			return $product_field->value;
    	}
	}
?>