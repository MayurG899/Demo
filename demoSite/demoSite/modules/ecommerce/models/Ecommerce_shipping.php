<?php
	class Ecommerce_shipping extends DataMapper
	{
		var $table = 'ecommerce_shippings';

	    var $has_many = array(
        'product' => array(
            'class' => 'Ecommerce_product',
            'other_field' => 'shipping',
            'join_self_as' => 'shipping',
            'join_other_as' => 'product',
            'join_table' => 'ecommerce_product_shipping_links'
            )
    	);

    	public function create($data)
	    {
	    	$this->name = $data['name'];
	    	$this->price = $data['price'];
	    	$this->type = $data['type'];
	    	$this->save();
	    }
	}
?>