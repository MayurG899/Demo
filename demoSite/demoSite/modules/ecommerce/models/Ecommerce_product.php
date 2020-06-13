<?php
	class Ecommerce_product extends DataMapper
	{
		var $table = 'be_ecommerce_products';

	    var $has_one = array(
			'category' => array(
					'class' => 'Ecommerce_category',
					'other_field' => 'product',
					'join_self_as' => 'product',
					'join_other_as' => 'category',
					'join_table' => 'ecommerce_categories'
			),
	    );

	    var $has_many = array(
		'option' => array(
				'class' => 'Ecommerce_option',
				'other_field' => 'product',
				'join_self_as' => 'product',
				'join_other_as' => 'option',
				'join_table' => 'ecommerce_options'
		),
        'wishing_member' => array(
            'class' => 'member',
            'other_field' => 'wished_item',
            'join_self_as' => 'product',
            'join_other_as' => 'member',
            'join_table' => 'ecommerce_wishlist'
            ),
        'shipping' => array(
            'class' => 'Ecommerce_shipping',
            'other_field' => 'product',
            'join_self_as' => 'product',
            'join_other_as' => 'shipping',
            'join_table' => 'ecommerce_product_shipping_links'
            ),
        'product_field' => array(
	            'class' => 'Ecommerce_field',
	            'other_field' => 'product_field',
	            'join_self_as' => 'product',
	            'join_other_as' => 'field',
	            'join_table' => 'ecommerce_product_fields'
            ),
        'review' => array(
	            'class' => 'Ecommerce_review',
	            'other_field' => 'product',
	            'join_self_as' => 'product',
	            'join_other_as' => 'review'
            ),
		'additional_image' => array(
				'class' => 'Ecommerce_product_image',
				'other_field' => 'product',
				'join_self_as' => 'product',
				'join_other_as' => 'image'
			)
    	);

    	public function create($data, $edit = false)
	    {
			$this->set_multiple_categories($data['category_id']);
	    	$this->name = $data['name'];
	    	$this->description = $data['description'];
	    	$this->image = $data['image'];
	    	$this->price = $data['price'];
	    	$this->featured = $data['featured'];
	    	$this->active = $data['active'];
			$this->label = $data['label'];
			$this->old_price = (!empty($data['old_price']))?$data['old_price']:0;
	    	$this->quantity = $data['quantity'];
	    	$this->time_created = time();
	    	$this->save();
			if($data['edit'] == 'Edit')
				$edit = true;

			$this->add_images($data['images'], $edit);
	    }

		public function set_multiple_categories($categories_names)
		{
			$categories_names_array = explode(',', $categories_names);
			$categories_ids = array();
			foreach($categories_names_array as $category_name)
			{
				$category = new Ecommerce_category();
				$category->where('name', $category_name)->get();
				$categories_ids[] = $category->id;
			}
			$categories_ids = implode(',', $categories_ids);
			$this->category_id = $categories_ids;
		}

		public function get_categories()
		{
			$categories_ids_array = explode(',', $this->category_id);
			$categories = array();
			foreach($categories_ids_array as $category_id)
			{
				$category = new Ecommerce_category($category_id);
				$categories[] = $category;
			}

			return $categories;
		}

		public function add_images($images, $edit = false)
		{
			if($edit == true)
			{
				$current_images = new Ecommerce_product_image();
				$current_images = $current_images->where('product_id', $this->id)->get();
				$current_images->delete_all();
			}
			foreach($images as $image)
			{
				$product_image = new Ecommerce_product_image();
				$product_image = $product_image->where('product_id', $this->id)->where('url', $image)->get();
				if(!$product_image->exists())
				{
					$product_image = new Ecommerce_product_image();
					$product_image->product_id = $this->id;
					$product_image->url = $image;
					$product_image->save();
				}
			}
		}

		public function get_old_price()
		{
			$price = $this->old_price;
			$default_currency_id = $this->get_default_currency();
			$user_currency_id = $this->get_user_currency();
			$currency_id = $default_currency_id;
			if($user_currency_id != false)
			{
				$price = $this->get_price_in_user_currency($default_currency_id, $user_currency_id, $this->price);
				$currency_id = $user_currency_id;
			}

			$currency = new Currency($currency_id);

			return $price;
		}

	    public function get_price()
		{
			$price = $this->price;
			$default_currency_id = $this->get_default_currency();
			$user_currency_id = $this->get_user_currency();
			$currency_id = $default_currency_id;
			if($user_currency_id != false)
			{
				$price = $this->get_price_in_user_currency($default_currency_id, $user_currency_id, $this->price);
				$currency_id = $user_currency_id;
			}

			$currency = new Currency($currency_id);

			return $price;
		}

		public function get_default_currency()
		{
			global $active_controller;
			$this->BuilderEngine = $active_controller->get_builderengine();

			$default_currency_id = $this->BuilderEngine->get_option('be_default_currency');
			if($default_currency_id == '')
			{
				$this->BuilderEngine->set_option('be_default_currency', 1);
				$default_currency_id = $this->BuilderEngine->get_option('be_default_currency');
			}

			return $default_currency_id;
		}

		public function get_user_currency()
		{
			global $active_controller;
			$this->user = $active_controller->user;
			$member = new Member($this->user->get_id());

			if($member->exists())
			{
				$member_currency = new Currency($member->extended_info->get()->currency_id);
				if($member_currency->exists())
					return $member_currency->id;
			}
			return false;
		}

		public function get_price_in_user_currency($currency_one_id, $currency_two_id, $price)
		{
			$exchange_rate = new Exchange_rate();
			$exchange_rate = $exchange_rate->where('currency_one', $currency_one_id)->where('currency_two', $currency_two_id)->get()->rate;
			$price *= $exchange_rate;

			return round($price, 2);
		}

		public function add_field($field_id, $value)
		{
			$CI = & get_instance();
			$CI->load->model('Ecommerce_field');
			$field = new Ecommerce_field($field_id);
			$this->save_product_field($field);
			$product_field = new Product_value();
			$product_field = $product_field->where('product_id', $this->id)->where('field_id', $field->id)->get();
			$product_field->type = 'custom';
			$product_field->value = $value;
			$product_field->save();
		}

		public function add_to_wishlist($data)
		{
			$this->db->insert('ecommerce_wishlist', $data);
		}

		public function get_wishlist($member_id,$ids = false)
		{
			$this->db->select('*');
			$this->db->from('ecommerce_wishlist');
			$this->db->join('ecommerce_products', 'ecommerce_products.id = ecommerce_wishlist.product_id');
			$this->db->where('member_id', $member_id);
			$query = $this->db->get();
			$results = $query->result();
			if($ids){
				$wishlist_product_ids = array();
				foreach($results as $result){
					array_push($wishlist_product_ids,$result->id);
				}
				return $wishlist_product_ids;
			}
			else
				return $results;
		}

		public function delete_wishlist_item($member_id,$product_id)
		{
            $this->db->where('member_id', $member_id)->where('product_id', $product_id)->delete('ecommerce_wishlist');
        }
	}
?>