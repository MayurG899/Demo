<?php
	class Ecommerce_category extends DataMapper
	{
		var $table = 'ecommerce_categories';

	    var $has_many = array(
			'product' => array(
						'class' => 'Ecommerce_product',
						'other_field' => 'category',
						'join_self_as' => 'category',
						'join_other_as' => 'product',
						'join_table' => 'ecommerce_products'
				),
	    	'category_field' => array(
	            'class' => 'Ecommerce_field',
	            'other_field' => 'category_field',
	            'join_self_as' => 'category',
	            'join_other_as' => 'field',
	            'join_table' => 'ecommerce_category_fields'
            ),
	    );
	    public function has_children()
	    {
	    	$all_categories = new Ecommerce_category();
	    	foreach($all_categories->where('parent', $this->id)->get() as $category)
	    	{
	    		return true;
	    	}
	    	return false;
	    }

	    public function create($data)
	    {
	    	$this->name = $data['name'];
	    	$this->image = $data['image'];
	    	$this->parent = $data['parent'];
	    	$this->save();
	    }

		public function get_products()
		{
			$products = new Ecommerce_product();
			$products_in_this_category = array();
			foreach($products->get() as $product)
			{
				$id_to_search_for = strval($this->id);
				if (strpos($product->category_id, $id_to_search_for) !== false) {
					$products_in_this_category[] = $product->id;
				}
			}

			return $products_in_this_category;
		}
	}
?>