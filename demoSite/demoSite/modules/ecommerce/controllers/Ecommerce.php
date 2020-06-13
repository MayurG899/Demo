<?php
	class Ecommerce extends Module_Controller
	{
		public function product($id)
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();

			if(!isset($id))
				show_404();
			$this->load->library('cart');
			$product = new Ecommerce_product($id);
			
			$count = new Ecommerce_product();
			$count = $count->where('id',$id)->update('views',$product->views + 1);

			if(!isset($id) || !$product->exists())
				show_404();
			
			$user = new User($this->user->get_id());

//			if($_POST)
//			{
//				if(isset($_POST['review_submit']))
//				{
//					$check_reviews = new Ecommerce_review();
//					$check_reviews = $check_reviews->where('product_id', $id)->where('user', $user->username)->get();
//					$already_rated_by_user = false;
//
//					foreach ($check_reviews as $check) {
//						$already_rated_by_user = true;
//					}
//					if ($this->user_to_review_allowed() && !$already_rated_by_user) {
//						$review = new Ecommerce_review();
//						if ($this->user->is_guest()) {
//							$review->user = "guest";
//						} else {
//							$review->user = $user->username;
//						}
//						$review->rating = $_POST['review_rating'];
//						$review->content = $_POST['review_content'];
//						$review->product_id = $id;
//						$review->date_added = time();
//						$review->save();
//					}
//				}
//				else
//				{
//					$qty_in_cart = 0;
//					$cart_content = $this->cart->contents();
//					foreach($cart_content as $item){
//						if($product->id == $item['id'])
//							$qty_in_cart += $item['qty'];
//					}
//
//					if($_POST['quantity'] > $product->quantity - $qty_in_cart)
//					{
//						$data['error'] = 'quantity';
//					}
//					else
//					{
//						if(!isset($_POST['shipping_id']) || $_POST['shipping_id'] == '')
//							$_POST['shipping_id'] = 3;
//						$product_options = array();
//						if(isset($_POST['options']))
//						{
//							foreach($_POST['options'] as $option)
//							{
//								$option = explode(' ', $option);
//								$option[1] = '+'.$option[1];
//								$product_options[] = implode(' ', $option);
//							}
//						}
//						$product_info = array(
//								"id" => $product->id,
//								"qty"=> $_POST['quantity'],
//								"price" => $product->price,
//								"name" => $product->name,
//								"image" => $product->image,
//								"shipping_id" => $_POST['shipping_id'],
//								"options" => $product_options
//						);
//						$this->cart->product_name_rules = '[:print:]';
//						$this->cart->insert($product_info);
//					}
//				}
//			}

			$data['error'] = '';
			$this->load->view('frontend/product.tpl', $data);
		}

		public function category($category_name)
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();

			if(!isset($_GET['page']))
				$_GET['page'] = 1;
			if(!isset($category_name))
				show_404();
			
			$category_name = urldecode($category_name);
			if($category_name == 'all' || $category_name == 'All')
			{
				$total_pages = $this->get_total_pages('all');
				$data['title'] = 'Products';
			}
			else
			{
				$total_pages = $this->get_total_pages($category_name);
				$data['title'] = $category_name;
			}

			$data['search'] = '';
			$data['category_name'] = $category_name;

			$this->load->view('frontend/category.tpl', $data);
		}

		public function search($keyword = ' ')
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();

			if(!$this->user_allowed()) {
				redirect(base_url('ecommerce/login'), 'location');
			}
			if(isset($_POST['search_request'])) {
				redirect(base_url('ecommerce/search/'.$_POST['search_keyword']), 'location');
			}
			if($keyword == ' ') {
				redirect(base_url('ecommerce/category/All'), 'location');
			}

			$data['allowed_to_shop'] = $this->user_to_shop_allowed();
			$data['cart_calculations'] = $this->get_cart_calculations();
			$data['keyword'] = $keyword;
			$data['search'] = true;
			if(!isset($_GET['page']))
				$_GET['page'] = 1;
			$keyword = urldecode($keyword);

			$this->load->view('frontend/search.tpl', $data);
		}

		// Category / Search functions segments START
		public function get_pagination($page_content, $total_pages, $search = false, $not_in_module = false)
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();

			$data['search'] = $search;
			$data['page_content'] = $page_content;
			$data['total_pages'] = $total_pages;
			$data['not_in_module'] = $not_in_module;
			$content = $this->load->view('frontend/pagination', $data, true);

			return $content;
		}

		public function get_total_pages($keyword = '', $search = false)
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();

			$products = new Ecommerce_product();

			if($keyword == 'all' || $keyword == 'All')
				$products = $products->get_paged(1, 12);
			else if($search == true)
			{
				$products = $products->like('name', $keyword)->or_like('description', $keyword)->get_paged(1, 12);
				//$products->get_paged(1, 8);
			}
			else
			{
				$category = new Ecommerce_category();
				$cat = $category->where('name', $keyword)->get();
				if($cat->exists())
					$category = $cat;
				else
					$category = $category->get();

				if(!$category->has_children()) {
					$array_products_ids = $category->get_products();
					$products = $products->where_in('id', $array_products_ids)->where('active', 'yes');
				}
				else {
					$array_products_ids = [];

					// get parent's products
					$parent_product_ids = $category->get_products();
					foreach ($parent_product_ids as $parent_single_product_id) {
						array_push($array_products_ids, $parent_single_product_id);
					}

					// get child's products
					$child_categories = new Ecommerce_category();
					$child_categories = $child_categories->where('parent', $category->id)->get();

					foreach ($child_categories as $child_category) {
						$child_category_object = new Ecommerce_category($child_category->id);
						$child_category_products_ids = $child_category_object->get_products();
						foreach ($child_category_products_ids as $product_single_id) {
							array_push($array_products_ids, $product_single_id);
						}
					}
					$products = new Ecommerce_product();
					$products = $products->where('active', 'yes');
					if(count($array_products_ids) == 0) {
						array_push($array_products_ids, 0);
					}

					$products = $products->where_in('id', $array_products_ids)->where('active', 'yes');
				}

				$products = $products->get_paged(1, 12);
			}

			return $products->paged->total_pages;
		}

		public function get_subcategories($category_name)
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();

			if($category_name == 'all')
			{
				$categories = new Ecommerce_category();
				$data['categories'] = $categories->where('parent', 0)->get();
			}
			else
			{
				$category = new Ecommerce_category();
				$category = $category->where('name', $category_name)->get();
				$categories = new Ecommerce_category();
				$data['categories'] = $categories->where('parent', $category->id)->get();
			}

			$content = $this->load->view('frontend/subcategories', $data, true);

			return $content;
		}

		public function get_products($keyword, $page_number = 1, $search = false)
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();

			$products = new Ecommerce_product();
			$products = $products->where('active', 'yes');

			$data['allowed_to_shop'] = $this->user_to_shop_allowed();
			if($keyword == 'all')
			{
				$products->get();
			}
			else if($search == true)
			{
				$products->like('name', $keyword)->or_like('description', $keyword);
			}
			else
			{
				$category = new Ecommerce_category();
				$category = $category->where('name', $keyword)->get();

				if(!$category->has_children()) {
					$array_products_ids = $category->get_products();
					$products = $products->where_in('id', $array_products_ids)->where('active', 'yes');
				}
				else {
					$array_products_ids = [];

					// get parent's products
					$parent_product_ids = $category->get_products();
					foreach ($parent_product_ids as $parent_single_product_id) {
						array_push($array_products_ids, $parent_single_product_id);
					}

					// get child's products
					$child_categories = new Ecommerce_category();
					$child_categories = $child_categories->where('parent', $category->id)->get();

					foreach ($child_categories as $child_category) {
						$child_category_object = new Ecommerce_category($child_category->id);
						$child_category_products_ids = $child_category_object->get_products();
						foreach ($child_category_products_ids as $product_single_id) {
							array_push($array_products_ids, $product_single_id);
						}
					}
					$products = new Ecommerce_product();
					$products = $products->where('active', 'yes');
					if(count($array_products_ids) == 0) {
						array_push($array_products_ids, 0);
					}

					$products = $products->where_in('id', $array_products_ids)->where('active', 'yes');
				}
			}

			$ordered_products = $this->apply_order($products);

			$data['products'] = $ordered_products->where('active', 'yes')->get_paged($page_number, 12);
			$data['reviews'] = new Ecommerce_review();

			$content = $this->load->view('frontend/products', $data, true);

			return $content;
		}

		public function get_categories_sidebar($include_menu = true)
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();

			$categories = new Ecommerce_category();
			$data['categories_count'] = $categories->count();
			$data['categories'] = $categories;
			$data['currency'] = new Currency($this->BuilderEngine->get_option('be_ecommerce_settings_currency'));
			$data['featured_products'] = $this->get_featured_products('all');
			$data['cart_calculations'] = $this->get_cart_calculations();
			$data['include_menu'] = $include_menu;

			$content = $this->load->view('frontend/categories_sidebar', $data, true);

			return $content;
		}

		public function get_categories_horizontal_menu($id)
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();

			$category = new Ecommerce_category();
		    $data['product_category'] = $category->get_by_id($id);
			$parent = new Ecommerce_category();
			$data['parent'] = $parent->get_by_id($data['product_category']->parent);				
			$categories = new Ecommerce_category();
			$data['categories'] = $categories->get();

			$content = $this->load->view('frontend/categories_horizontal_menu', $data, true);

			return $content;
		}
		
		public function get_sorting($keyword, $search = false)
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();

			$data['keyword'] = $keyword;
			$data['search'] = $search;

			$content = $this->load->view('frontend/sorting', $data, true);

			return $content;
		}

		public function apply_order($products)
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();

			if(isset($_GET['order']))
			{
				if($_GET['order'] == "1")
					$products->order_by('name', 'ASC');
				if($_GET['order'] == "2")
					$products->order_by('name', 'DESC');
				if($_GET['order'] == "3")
					$products->order_by('price', 'ASC');
				if($_GET['order'] == "4")
					$products->order_by('price', 'DESC');
			}
			return $products;
		}
		// Category / Search functions view segments END

		public function login()
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();

			$data['error'] = false;
			if($_POST)
			{
            $userid = $this->users->verify_login($_POST['username'], $_POST['password']);

			if($userid != -1 && $userid != 0){	
				$this->user->initialize($userid);
					redirect(base_url('/ecommerce/category/All'), 'location');
				}
				else
				{
					$registered_user = new User();
					$registered_user = $registered_user->where('username',$_POST['username'])->where('password',md5($_POST['password']))->get();
					if($registered_user->id > 0 && $registered_user->verified == 'no'){
						$data['error_msg'] = 'Your account has been registered and awaiting for approval.Once approved,you will be notified by email!';
					}
					else
						$data['error_msg'] = 'Invalid username or password';
				}
			}
			$this->load->view('frontend/login', $data);
		}

		public function logout()
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();

			$this->user->logout(base_url('/ecommerce/login'));
		}

		public function register()
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();

			$data['error'] = '';

			if($_POST)
			{
				if($_POST['password'] != $_POST['password_re'])
					$data['error'] = 'password';
				else
				{
					$data['first_name'] = $_POST['first_name'];
					$data['last_name'] = $_POST['last_name'];
					$data['email'] = $_POST['email'];
					$data['username'] = $_POST['username'];
					$data['password'] = $_POST['password'];

					$user_id = $this->users->register_user($data);
					if($user_id != false)
					{
						redirect(base_url('/ecommerce/login'), 'location');
					}
					else
						$data['error'] = 'exists';
				}
			}

			$this->load->view('frontend/register', $data);
		}

		public function edit_profile()
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();

			$this->redirect_if_guest();

			$member = new User($this->user->get_id());
			if($_POST)
			{
				$member->name = $_POST['name'];
				$member->email = $_POST['email'];
				$member->save();
				unset($_POST['name']);
				unset($_POST['email']);

				$extended_info = new UserExtended($member->extended->get()->id);
				$extended_info->create($_POST);
				$member->save_extended_info($extended_info);
			}

			$data['member'] = $member;
			$this->load->view('frontend/edit_profile', $data);
		}

		public function account()
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();

			$this->redirect_if_guest();

			$data['member'] = new User($this->user->get_id());
			$this->load->view('frontend/account', $data);
		}

		public function redirect_if_guest()
		{
			if($this->user->is_guest())
				redirect(base_url('/ecommerce/login'), 'location');
		}

		public function cart()
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();

			if(!$this->user_allowed()) {
				redirect(base_url('ecommerce/login'), 'location');
			}
			$this->load->library('cart');
			$data['currency'] = new Currency($this->BuilderEngine->get_option('be_ecommerce_settings_currency'));
			$data['cart_calculations'] = $this->get_cart_calculations();

			if(isset($_POST['update_product_quantity']))
			{
				$data = array(
						'rowid' => $_POST['rowid'],
						'qty'   => $_POST['qty'],
				);
				$this->cart->product_name_rules = '[:print:]';
				$this->cart->update($data);
			}

			$data['var'] = $this->cart->contents();
			$data['id'] = $this->user->get_id();

			$this->load->view('frontend/cart', $data);
		}

		public function edit_cart_item($row_id)
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();

			$this->load->library('cart');

			if($_POST)
			{
				$data = array(
               'rowid' => $row_id,
               'qty'   => $_POST['qty']
            	);
				$this->cart->product_name_rules = '[:print:]';
				$this->cart->update($data);
			}
			
			redirect(base_url('ecommerce/cart'), 'location');
		}

		public function delete_cart_item($row_id)
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();

			$this->load->library('cart');

			$data = array(
               'rowid' => $row_id,
               'qty'   => 0
            );
			$this->cart->product_name_rules = '[:print:]';
			$this->cart->update($data);

			redirect(base_url('ecommerce/cart'), 'location');
		}

		public function checkout()
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();

			if(!$this->user_allowed()) {
				redirect(base_url('ecommerce/login'), 'location');
			}
			$this->load->library('cart');

			$count = count($this->cart->contents());

			if($count == 0) {
				redirect(base_url('ecommerce/category/All'), 'location');
			}
			//$checkout_field_country = new Checkout_field();
			//$data['checkout_country'] = $checkout_field_country->where('displayed_name', 'Country')->get();

			$data['prices'] = $this->get_total_price();
			$data['currency'] = new Currency($this->BuilderEngine->get_option('be_ecommerce_settings_currency'));
			$data['cart_calculations'] = $this->get_cart_calculations();
			$data['var']= $this->cart->contents();
			$data['id']= $this->user->get_id();

			$data['checkout_fields'] = new Checkout_field();
			$data['userinfo'] = new User($this->user->get_id());
			$member = new User($this->user->get_id());
			$data['customer'] = $member->extended->get();
			$this->load->module('builderpayment/api');
			$data['payment_methods'] = $this->api->getAvailableGateways();
			$this->load->view('frontend/checkout', $data);
		}

		public function confirm_order()
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();

			if(!$this->user_allowed()) {
				redirect(base_url('ecommerce/login'), 'location');
			}
			$this->load->library('cart');

			if($_POST)
			{
				$billing_address = $_POST['billing_address'];

				if(!isset($_POST['shipping_address'])) {
					$shipping_address_empty = true;
				} else {
					$shipping_address = $_POST['shipping_address'];
					$shipping_address_empty = false;
				}
				$this->load->module('builderpayment/api');
				$i = 1;
				foreach($this->cart->contents() as $product){
					if($i == 1){
						if(strpos($product['id'],'block') !== FALSE){
							$this->api->identifyModule($product['service_type']);
							if(isset($product['service_group_id'])){
								$_POST['service_callback'] = 'process_service';
								$_POST['custom'] = array(
									'service_group_id' => $product['service_group_id'],
									'service_period' => $product['service_period']
								);
								$_POST['payment_method'] = $product['service_payment_gateway'];
							}
						}else{
							$this->api->identifyModule("ecommerce");
						}
					}
					$i++;
				}
				$order = $this->api->createOrder();
				$order->payment_method = $_POST['payment_method'];
				if(isset($_POST['custom'])) {
					$order->custom_data = json_encode($_POST['custom']);
				}
				$currency = new Currency($this->BuilderEngine->get_option('be_ecommerce_settings_currency'));
				$order->currency = $currency->id;
				$order_ship_address = $order->createShippingAddress();
				$order_bill_address = $order->createBillingAddress();

				foreach($billing_address as $key => $value)
				{
					if($key == "address") {
						$temp_key = "address_line_1";
						$order_bill_address->$temp_key = $value;
					} else {
						$order_bill_address->$key = $value;
					}

				}
				$order_bill_address->save();

				if(!$shipping_address_empty)
				{
					foreach($shipping_address as $key => $value)
					{
						if($key == "address") {
							$temp_key = "address_line_1";
							$order_ship_address->$temp_key = $value;
						} else {
							$order_ship_address->$key = $value;
						}
					}
					$order_ship_address->save();
				} else {
					foreach($billing_address as $key => $value)
					{
						if($key == "address") {
							$temp_key = "address_line_1";
							$order_ship_address->$temp_key = $value;
						} else {
							$order_ship_address->$key = $value;
						}
					}
					$order_ship_address->save();
				}

				if(isset($_POST['custom'])) {
					$customs = $_POST['custom'];
				}

				if($this->BuilderEngine->get_option('be_ecommerce_settings_shipping_options') == 'all') {
					$final_shipping = new Ecommerce_shipping();
					$final_shipping = $final_shipping->where('name', $_POST['custom']['Shipping_Method'])->get();
				}

				$total_shipping_all = 0;
				$total_products_price = 0;
				$total_order_price = 0;

				foreach ($this->cart->contents() as $product) {
					if(isset($product['options']))
					{
						$product_options_price = $this->calculate_options_price($product['options']);
					}
					else
						$product_options_price = 0;

					$product_price = ($product['price'] + $product_options_price) * $product['qty'];

					$shipping_price = 0;
					if($this->BuilderEngine->get_option('be_ecommerce_settings_shipping_options') == 'single') {
						$product_shipping = new Ecommerce_shipping($product['shipping_id']);
						$shipping_price = $this->calculate_shipping_price($product_shipping, $product['price'], $product_options_price);
					} else {
						$product_shipping = $final_shipping;
					}

					$total_shipping_all += $shipping_price;
					$total_products_price += $product_price;
					$total_order_price += $product_price + $shipping_price;

					$order_product = $order->addProduct();
					$order_product->name = $product['name'];
					$order_product->quantity = $product['qty'];
					$order_product->price = $product['price'] + $product_options_price;

					if(!isset($product['options']))
						$product['options'] = 'none';
					if(!isset($product['color']))
						$product['color'] = 'none';
					$order_product->custom_data = json_encode(array('product_id' => $product['id'], 'product_option' => $product['options'], 'product_shipping' => $product_shipping->name, 'product_color' => $product['color']));
					$order_product->save();
				}

				$order_product = $order->addProduct();
				$order_product->name = "Shipping";
				$order_product->quantity = 1;

				if(isset($final_shipping)) {
					if($final_shipping->type == 'percent') {
						$order_product->price = ($total_order_price / 100) * $final_shipping->price;
						$total_order_price += $order_product->price;
					} else {
						$order_product->price = $final_shipping->price;
						$total_order_price += $order_product->price;
					}
				} else {
					$order_product->price = $total_shipping_all;
				}

				$order_product->save();

				$order->gross = round($total_order_price, 2);
				$order->save();

				$default_currency_id = $this->BuilderEngine->get_option('be_ecommerce_settings_currency');
				$default_currency = new Currency($default_currency_id);
				$order->currency = $default_currency->id;

				$insert_id = $this->db->insert_id();
				foreach ($this->cart->contents() as $product)
				{
					$product['price'] = $product['price'];
					$data = array(
							'product_id' => $product['id'],
							'product_title' => $product['name'],
							'product_quantity' => $product['qty'],
							'product_price' => $product['price'],
							'product_option' => 'none',
							'order_id' => $insert_id,
							'shipping_name' => $product_shipping->name
					);
				}

				$order->time_created = time();
				$order->save();
				if(isset($_POST['service_callback']))
					$order->callback = $_POST['service_callback'];
				else
					$order->callback = 'finish_order';
				$order->save();

				if($order->payment_method == 'cod'){
					$order->trans_id = 'cod_'.time();
					$order->save();
					$order->submit();
					redirect(base_url('ecommerce/finish_order/'.$order->id), 'location');
				}
				if($order->payment_method == 'paypal'){
					$order->submit();
				}
				if($order->payment_method == 'stripe'){
					$payment_details = array(
						'stripeToken' 	=> $_POST['stripeToken'],
						'stripeEmail'   	=> $_POST['stripeEmail'],
					);
					$order->submit($payment_details);
				}
			}
		}

		public function finish_order($id)
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();

			$this->load->library('cart');
			$this->load->module('builderpayment/api');
			$this->api->identifyModule("ecommerce");
			$order = $this->api->getOrderByID($id);
			if($order->payment_method != 'cod') {
				$order->status = 'paid';
				$order->time_paid = time();
				$order->paid_gross = $order->gross;
				$order->save();
			}
			foreach($order->product->get() as $order_product)
			{
				$product = new Ecommerce_product();
				$product = $product->where('name', $order_product->name)->get();
				if($product->exists())
				{
					$product->quantity = $product->quantity - $order_product->quantity;
					$product->save();
				}
			}

			$this->cart->destroy();

			redirect(base_url('ecommerce/order_complete'), 'location');
		}

		// edit for ecommerce NG
		public function order_complete()
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();

			$this->load->view('frontend/order_completed');
		}
		public function get_all_parent_categories($id)
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();

			$all_parent_categories = [];
			$category = new Ecommerce_category();
			$first_category = $category->get_by_id($id);
			array_push($all_parent_categories, $first_category);

			while($first_category->parent != 0) {
				$parent = new Ecommerce_category();
				$parent = $parent->get_by_id($first_category->parent);
				array_push($all_parent_categories, $parent);
				$first_category = $parent;
			}
			$all_parent_categories = array_reverse($all_parent_categories);
			return $all_parent_categories;
		}

		public function get_cart_calculations()
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();

			$this->load->library('cart');
			$total_shipping_all = 0;
			$total_products_price = 0;
			$total_order_price = 0;
			$different_products_count = 0;

			foreach ($this->cart->contents() as $product) {
				if(isset($product['options']))
					$product_options_price = $this->calculate_options_price($product['options']);
				else
					$product_options_price = 0;
				$product_price = ($product['price'] + $product_options_price) * $product['qty'];

				$shipping_price = 0;
				if($this->BuilderEngine->get_option('be_ecommerce_settings_shipping_options') == 'single') {
					$product_shipping = new Ecommerce_shipping($product['shipping_id']);
					$shipping_price = $this->calculate_shipping_price($product_shipping, $product['price'], $product_options_price);
				}

				$total_shipping_all += $shipping_price;
				$total_products_price += $product_price;
				$total_order_price += $product_price + $shipping_price;

				$different_products_count++;
			}
			$cart_array = array($total_shipping_all, $total_products_price, $total_order_price, $different_products_count);
			return $cart_array;
		}

		public function calculate_shipping_price($shipping, $product_price, $product_options_price)
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();
			$shipping_price = 0;
			if ($shipping->type == 'percent')
				$shipping_price = ((($product_price + $product_options_price) / 100) * $shipping->price);
			else
				$shipping_price = $shipping->price;

			return $shipping_price;
		}

		public function get_average_product_rating($id)
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();
			$reviews = new Ecommerce_review();
			$total_review_count = $reviews->where('product_id', $id)->count();
			if($total_review_count == 0) {
				return 0;
			}

			$product_reviews = $reviews->where('product_id', $id)->get();
			$sum_temp = 0;

			foreach ($product_reviews as $review) {
				$sum_temp += $review->rating;
			}
			$average = $sum_temp / $total_review_count;

			return floor($average * 10) / 10;
		}

		public function user_allowed()
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();

			$current_user_id = $this->user->get_id();
			$user = new User($current_user_id);
			$allowed_groups = explode(',', $this->BuilderEngine->get_option('be_ecommerce_access_groups'));

			if($this->user->is_guest()) {
				if(in_array("Guests", $allowed_groups)) {
					return true;
				} else {
					return false;
				}
			}

			$user_groups = $user->group->get();

			foreach ($user_groups as $group) {
				if(in_array($group->name, $allowed_groups)) {
					return true;
				}
			}

			return false;
		}

		public function user_to_shop_allowed()
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();

			$current_user_id = $this->user->get_id();
			$user = new User($current_user_id);
			$allowed_shop_groups = explode(',', $this->BuilderEngine->get_option('be_ecommerce_shop_groups'));

			if($this->user->is_guest()) {
				if(in_array("Guests", $allowed_shop_groups)) {
					return true;
				} else {
					return false;
				}
			}

			$user_groups = $user->group->get();

			foreach ($user_groups as $group) {
				if(in_array($group->name, $allowed_shop_groups) && $user->verified == 'yes') {
					return true;
				}
			}

			return false;
		}

		public function user_to_review_allowed()
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();
			$current_user_id = $this->user->get_id();
			$user = new User($current_user_id);
			$allowed_reviews_groups = explode(',', $this->BuilderEngine->get_option('be_ecommerce_reviews_groups'));

			if($this->user->is_guest()) {
				if(in_array("Guests", $allowed_reviews_groups)) {
					return true;
				} else {
					return false;
				}
			}

			$user_groups = $user->group->get();

			foreach ($user_groups as $group) {
				if(in_array($group->name, $allowed_reviews_groups) && $user->verified == 'yes') {
					return true;
				}
			}

			return false;
		}

		public function get_product_reviews_pages($id)
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();
			$reviews = new Ecommerce_review();
			$reviews = $reviews->where('product_id', $id)->order_by("date_added", "desc")->get_paged(1, 6);

			return $reviews->paged->total_pages;
		}

		public function get_reviews_pagination($id, $total_pages)
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();
			$data['total_pages'] = $total_pages;
			$data['product_id'] = $id;
			$content = $this->load->view('frontend/reviews_pagination', $data, true);

			return $content;
		}

		public function get_reviews($id, $page = 1)
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();
			$reviews = new Ecommerce_review();
			$data['product_reviews_count'] = $reviews->where('product_id', $id)->count();
			$reviews = new Ecommerce_review();
			$data['product_reviews'] = $reviews->where('product_id', $id)->order_by('date_added', 'DESC')->get_paged($page, 6);

			$content = $this->load->view('frontend/reviews', $data, true);

			return $content;
		}

		public function get_featured_products($keyword, $product_page = false, $search = false)
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();
			if($keyword != 'all' || $search == true) {
				return;
			}

			$data['allowed_to_shop'] = $this->user_to_shop_allowed();
			$products = new Ecommerce_product();
			if($product_page == false){
				$data['featured_products'] = $products->where('active', 'yes')->where('featured', 'yes')->order_by('time_created', 'DESC')->get_paged(0, 3);
			} else {
				$data['recent_products'] = $products->where('active', 'yes')->where('featured', 'yes')->order_by('time_created', 'DESC')->get_paged(0, 4);
				$data['product_page'] = true;
			}
			// edit for blocks
			$data['featured_products'] = $products->where('active', 'yes')->where('featured', 'yes')->order_by('time_created', 'DESC')->get_paged(0, 3);
			// edit for blocks end
			$data['reviews'] = new Ecommerce_review();

			$content = $this->load->view('frontend/featured_products', $data, true);

			return $content;
		}

		public function calculate_options_price($options)
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();
			$option_price = 0;
			foreach ($options as $option) {
				if (strpos($option, '+') !== FALSE) {
					$price = explode('--+', $option);
					if (isset($price[1])) {
						$option_price += $price[1];
					}
				} else {
					$price = explode(' -', $option);
					if(isset($price[1])) {
						$option_price -= $price[1];
					}
				}
			}
			return $option_price;
		}

		public function get_recent_products($keyword, $search = false)
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();
			if($keyword != 'all' || $search == true) {
				return;
			}

			$data['allowed_to_shop'] = $this->user_to_shop_allowed();
			$recent_products = new Ecommerce_product();
			$data['recent_products'] = $recent_products->where('active', 'yes')->order_by('time_created', 'DESC')->get_paged(0, 4);

			$content = $this->load->view('frontend/recent_products', $data, true);

			return $content;
		}

		public function delete_review($id)
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();
			$review = new Ecommerce_review($id);
			$review_product_id = $review->product_id;
			$review->delete();

			redirect(base_url('/ecommerce/product/'.$review_product_id));
		}

		public function get_subcategories_count($category_name)
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();
			if($category_name == 'all')
			{
				$categories = new Ecommerce_category();
				$count = $categories->where('parent', 0)->count();
			}
			else
			{
				$category = new Ecommerce_category();
				$category = $category->where('name', $category_name)->get();
				$categories = new Ecommerce_category();
				$count = $categories->where('parent', $category->id)->count();
			}

			return $count;
		}

		public function get_total_price()
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();
			$this->load->library('cart');
			$total_shipping = 0;
			$total_price = 0;
			if($this->BuilderEngine->get_option('be_ecommerce_settings_shipping_options') == 'single') {
				$total_products_price = 0;
			}
			foreach($this->cart->contents() as $product)
			{
				$option_price = 0;
				if(isset($product['options']))
				{
					foreach ($product['options'] as $option) {
						if (strpos($option, '+') !== FALSE) {
							$price = explode(' +', $option);
							if (isset($price[1])) {
								$option_price += $price[1];
							}
						} else {
							$price = explode(' -', $option);
							if(isset($price[1])) {
								$option_price -= $price[1];
							}
						}
					}
				}

				$product_total = ($product['price'] + $option_price) * $product['qty'];
				if($this->BuilderEngine->get_option('be_ecommerce_settings_shipping_options') == 'single') {
					$total_products_price += $product_total;
				}
				$total_price += $product_total;

				$shipping_price = 0;
				if($this->BuilderEngine->get_option('be_ecommerce_settings_shipping_options') == 'single') {
					$shipping_info = new Ecommerce_shipping($product['shipping_id']);

					if ($shipping_info->type == 'percent')
						$shipping_price = ((($product['price'] + $option_price) / 100) * $shipping_info->price);
					else
						$shipping_price = $shipping_info->price;
				}

				$total_shipping += $shipping_price;
				$total_price += $total_shipping;
				$total_price = $total_price;
			}
			$total_shipping = round($total_shipping, 2);
			$total_price = round($total_price, 2);
			if($this->BuilderEngine->get_option('be_ecommerce_settings_shipping_options') == 'single') {
				$total_products_price = round($total_products_price, 2);
			}
			if($this->BuilderEngine->get_option('be_ecommerce_settings_shipping_options') == 'single') {
				$prices =  array($total_price, $total_shipping, $total_products_price);
			} else {
				$prices =  array($total_price, $total_shipping);
			}
			return $prices;
		}
		
		public function show_404()
		{
			$this->load->view('frontend/404');
		}

		public function wishlist()
		{
			if($this->BuilderEngine->get_option('ecommerce_active') !== 'yes')
				show_404();
			$this->redirect_if_guest();

			$this->load->model('ecommerce_product');
			$member_id = $this->user->get_id();
			$wishlist = $this->ecommerce_product->get_wishlist($member_id);
			$data['wishes'] = $wishlist;
			
			if(isset($_GET['delete']))
			{
				$product_id = $_GET['delete'];
				$this->ecommerce_product->delete_wishlist_item($member_id, $product_id);
				redirect('ecommerce/wishlist','location');
			}
			if(isset($_GET['add']))
			{
				$insert = array(
					'member_id' => $member_id,
					'product_id' => $_GET['add']
				);
				foreach($wishlist as $item){
					if($item->id == $_GET['add'])
						redirect($_SERVER['HTTP_REFERER']);
				}
				$this->ecommerce_product->add_to_wishlist($insert);
				redirect($_SERVER['HTTP_REFERER']);
			}
			if(isset($_GET['id']))
			{
				$product = new Ecommerce_product($_GET['id']);
				$data = array(
					"id" => $_GET['id'],
					"qty"=> 1,
					"price" => $product->price,
					"name" => $product->name,
					"image" => $product->image,
					"option" => '',
					"all_options" => '',
					"shipping" => 1
					);
				$this->load->library('cart');
				$this->cart->product_name_rules = '[:print:]';
				$this->cart->insert($data);
				$this->ecommerce_product->delete_wishlist_item($member_id, $product->id);
				redirect(base_url('ecommerce/cart'),'location');
			}

			$data['currency'] = new Currency($this->BuilderEngine->get_option('be_ecommerce_settings_currency'));
			$this->load->view('frontend/wishlist', $data);
		}

		public function process_service($order_id)
		{
			$this->load->library('cart');
			$this->cart->destroy();
			$order = new BuilderPaymentOrder($order_id);
			if($order->exists()){
				$new = json_decode($order->custom_data);
				$user_id = $order->user_id;
				$group_id = $new->service_group_id;
				$period = $new->service_period;
				$data = array(
					"user_id" => $user_id,
					"group_id"=> $group_id
				);
				$this->db->insert("link_groups_users", $data);
			}
		}

		public function info()
		{
			$data = array();
			$this->load->view('frontend/info',$data);
		}
	}
?>