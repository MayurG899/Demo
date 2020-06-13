<?php
	class Admin extends BE_Controller
	{
		// [MenuItem ("Online Store/Products/Add New Product")]
		public function add_product()
		{
			$this->modify_object('Ecommerce_product');
		}
		// [MenuItem ("Online Store/Products/Show All Products")]
		public function show_products()
		{
			$this->show_objects('Ecommerce_product');
		}
		// [MenuItem ("Online Store/Categories/Add New Category")]
		public function add_category()
		{
			$this->modify_object('Ecommerce_category');
		}
		// [MenuItem ("Online Store/Categories/Show All Categories")]
		public function show_categories()
		{
			$this->show_objects('Ecommerce_category');
		}
		
		// [MenuItem ("Online Store/Sales & Orders")]
		public function orders()
		{
			$this->load->module('builderpayment/api');
			$this->api->identifyModule('ecommerce');

			$data['orders'] = $this->api->getOrders();
			$data['current_page'] = 'ecommerce';
			$data['current_child_page'] = 'ecommerce_orders';
			$this->load->view('backend/orders', $data);
		}

		public function delete_order($id)
		{
			$this->load->module('builderpayment/api');
			$this->api->identifyModule('ecommerce');

			$order = new BuilderPaymentOrder($id);
			$order_products = new BuilderPaymentOrderProduct();
			foreach($order_products->get() as $product)
			{
				if($product->order_id == $id)
					$product->delete();
			}
			$order->delete();

			redirect(base_url('/index.php/admin/module/ecommerce/orders'), 'location');
		}

		public function view_invoice($order_id)
		{
			$this->load->module('builderpayment/api');
			$this->api->identifyModule('ecommerce');

			$order = $this->api->getOrderByID($order_id);

			$data['order'] = $order;
			$data['currency'] = new Currency($order->currency);
			$data['custom_fields'] = json_decode($order->custom_data);
			$data['order_bill_address'] = $order->billingAddress->get();
			$data['order_ship_address'] = $order->shippingAddress->get();
			$this->load->view('backend/view_invoice', $data);

			$content = $this->load->view('backend/view_invoice', $data, true);
			$headers = "From: retail@builderengine.com" . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
//			mail('gorqshtjiraf11@abv.bg', 'test email', $content, $headers);
		}
		
		// [MenuItem ("Online Store/Shipping Options/Add New Shipping Option")]
		public function add_shipping()
		{
			$this->modify_object('Ecommerce_shipping');
		}
		// [MenuItem ("Online Store/Shipping Options/Show All Shipping Options")]
		public function show_shippings()
		{
			$this->show_objects('Ecommerce_shipping');
		}

		public function modify_object($object_type, $object_id = -1)
		{
			$object = $this->get_object($object_type, $object_id);
			
			if($_POST)
			{
				$object->create($_POST);
				if($object_type == 'Ecommerce_product')
				{
					$this->add_product_custom_fields($_POST['custom'], $object->id);
					$this->add_product_category_fields($_POST['category'], $object->id);
					$this->add_product_options($_POST['option'], $object->id);

					$shippping_type = $this->BuilderEngine->get_option('be_ecommerce_settings_shipping_options');
					if($shippping_type == 'single')
						$this->add_product_shippings($_POST['shippings'], $object->id);
				}
				else if($object_type == 'Ecommerce_category'){
					$this->add_category_custom_fields($_POST['custom'], $object->id);
				}
				redirect(base_url('/admin/module/ecommerce/show_objects/'.$object_type), 'location');
			}

			$data['current_page'] = 'ecommerce';
			$data['current_child_page'] = $object_type;
			$data['view'] = $this->get_view($object_type,  $object_id);
			$data['title'] = ucfirst($object_type);
			$this->load->view('backend/modify_object', $data);
		}

		public function add_product_shippings($shippings, $product_id)
		{
			$product = new Ecommerce_product($product_id);
			foreach($product->shipping->get() as $shipping)
			{
				$product->delete_shipping($shipping);
			}
			$product_shippings = explode(',', $shippings);
			foreach ($product_shippings as $product_shipping) {
				$shippings = new Ecommerce_shipping();
				$shippings = $shippings->where('name', $product_shipping)->get();
				foreach ($shippings as $shipping) {
					$product->save_shipping($shipping);
				}
			}
		}

		public function add_product_options($select_array, $product_id)
		{
			$existing_options = new Ecommerce_option();
			$existing_options = $existing_options->where('product_id',$product_id)->get();
			$existing_options->delete_all();
			$product = new Ecommerce_product($product_id);
			foreach($select_array as $select)
			{
				$options_string = '';
				$prices_string = '';
				$product_option = new Ecommerce_option();
				$product_option->product_id = $product->id;
				$product_option->option_name = $select['name'];
				foreach($select as $key => $option)
				{
					if($key != 'name')
					{
						$options_string .= $option['name'].', ';
						if($option['price'] == '')
							$option['price'] = 0;
						if($option['operand'] == 'subtract')
							$option['price'] = $option['price'] * -1;
						$option['price'] = rtrim($option['price']);
						$prices_string .= $option['price'].', ';
					}
					$product_option->options = rtrim($options_string, ', ');
					$product_option->options_prices = rtrim($prices_string, ', ');
				}
				$product_option->save();
			}
		}

		public function add_product_custom_fields($fields_array, $product_id)
		{
			$product = new Ecommerce_product($product_id);
			foreach($fields_array as $key => $field_info)
			{
				if (strpos($key, 'name') !== FALSE)
				{
					$field = new Ecommerce_field();
					$field->name = $field_info;
					$field->type = 'custom';
					$field->save();
				}
				else
					$product->add_field($field->id, $field_info);
			}
		}

		public function add_product_category_fields($fields_array, $product_id)
		{
			$product = new Ecommerce_product($product_id);
			$category = new Ecommerce_category($product->category->get()->id);
			foreach($category->category_fields->get() as $category_field)
			{
				foreach($fields_array as $key => $field)
				{
					$item_field = new Ecommerce_field();
					$item_field = $item_field->where('name', str_replace('_', ' ', $key))->where('id', $category_field->id)->get();
					if($item_field->exists())
						$this->add_or_edit_field_value($product_id, $category_field->id, $field);
				}
			}
		}

		public function add_or_edit_field_value($product_id, $field_id, $value)
		{
			$product_value = new product_value();
			$product_value = $product_value->where('product_id', $product_id)->where('field_id', $field_id)->get();
			if(!$product_value->exists())
			{
				$product_value = new product_value();
				$product_value->product_id = $product_id;
				$product_value->field_id = $field_id;
				$product_value->type = 'category';
			}

			$product_value->value = $value;
			$product_value->save();
		}

		public function add_category_custom_fields($fields_array, $category_id)
		{
			$category = new Ecommerce_category($category_id);
			foreach($fields_array as $field_name)
			{
				$field = new Ecommerce_field();
				$field->name = $field_name;
				$field->type = 'category';
				$field->save();

				$category->save_category_field($field);
			}
		}

		public function delete_object($object_type, $object_id)
		{
			$object = $this->get_object($object_type, $object_id);
			if($object_type == 'Ecommerce_product'){
				$imgs = new Ecommerce_product_image();
				$additional_images = $imgs->where('product_id',$object_id)->get();
				$additional_images->delete_all();
			}
			$object->delete();
			redirect(base_url('/index.php/admin/module/ecommerce/show_objects/'.$object_type), 'location');
		}

		public function bulk_delete($object_type, $view)
		{
			if($_POST){
				foreach($_POST['id'] as $id){
					$object = new $object_type($id);
					if($object_type == 'Ecommerce_product'){
						$imgs = new Ecommerce_product_image();
						$additional_images = $imgs->where('product_id',$id)->get();
						$additional_images->delete_all();
					}
					$object->delete();
				}
				redirect(base_url('admin/module/ecommerce/'.$view), 'location');
			}
		}

		public function get_object($object_type, $object_id = -1, $get = false)
		{
			$object = new $object_type($object_id);

			if($get == true)
				return $object->get();
			else
				return $object;
		}

		public function get_view($object_type, $object_id = -1)
		{
            $view_name = 'add_'.$object_type;

            if($object_id == -1)
                $data['page'] = 'Add';
            else
                $data['page'] = 'Edit';

            $data['object'] = $this->get_object($object_type, $object_id);
            $view = $this->load->view('backend/'.$view_name, $data, true);
            return $view;
		}

		public function show_objects($object_type)
		{
			$data['objects'] = $this->get_object($object_type, '', true);
			$data['current_page'] = 'ecommerce';
			$data['current_child_page'] = $object_type;			
			$this->load->view('backend/show_'.$object_type.'_objects', $data);
		}
		
		//  [MenuItem ("Online Store/Checkout Options")]
		public function checkout_fields()
		{
			if ($_POST) {
				foreach ($_POST['checkout'] as $field) {
					$checkout_field = new Checkout_field();
					$checkout_field->create_or_edit($field);
				}
			}
			$data['current_page'] = 'ecommerce';
			$data['current_child_page'] = 'ecommerce_checkout_fields';
			$this->load->view('backend/checkout_fields', $data);
		}
		
		//  [MenuItem ("Online Store/Invoice Settings")]
		public function invoice_settings() {
			if($_POST)
			{
				$this->BuilderEngine->set_option('be_ecommerce_company_name', $_POST['name']);
				$this->BuilderEngine->set_option('be_ecommerce_company_logo', $_POST['logo']);
				$this->BuilderEngine->set_option('be_ecommerce_company_address', $_POST['address']);
				$this->BuilderEngine->set_option('be_ecommerce_company_zip', $_POST['zip']);
				$this->BuilderEngine->set_option('be_ecommerce_company_city', $_POST['city']);
				$this->BuilderEngine->set_option('be_ecommerce_company_country', $_POST['country']);
				$this->BuilderEngine->set_option('be_ecommerce_company_phone', $_POST['phone']);
				$this->BuilderEngine->set_option('be_ecommerce_company_email', $_POST['email']);
				$this->BuilderEngine->set_option('be_ecommerce_company_tax_vat_number', $_POST['tax_vat_number']);
				$this->BuilderEngine->set_option('be_ecommerce_company_bank_account_number', $_POST['bank_account_number']);
				$this->BuilderEngine->set_option('be_ecommerce_company_payment_option', $_POST['payment_option']);
				$this->BuilderEngine->set_option('be_ecommerce_company_additional_info', $_POST['additional_info']);
			}
			$data['current_page'] = 'ecommerce';
			$data['current_child_page'] = 'invoice_settings';
			$this->load->view('backend/invoice_settings',$data);
		}

		//  [MenuItem ("Online Store/Settings")]
		public function general_settings() {
			if($_POST)
			{
				$this->BuilderEngine->set_option('ecommerce_active', $_POST['ecommerce_active']);
				$this->BuilderEngine->set_option('be_ecommerce_payment_methods', $_POST['payment_methods']);
				$this->BuilderEngine->set_option('be_ecommerce_settings_currency', $_POST['currency']);
				$this->BuilderEngine->set_option('be_ecommerce_settings_log_in_info', $_POST['log_in_info']);
				$this->BuilderEngine->set_option('be_ecommerce_settings_register_info', $_POST['register_info']);
				$this->BuilderEngine->set_option('be_ecommerce_display_views', $_POST['views']);
				$this->BuilderEngine->set_option('be_ecommerce_settings_shipping_options', $_POST['shipping_options']);
				if(isset($_POST['shippings'])) {
					$checkout_field = new Checkout_field();
					$checkout_field = $checkout_field->where('input_name', 'shipping')->get();
					$checkout_field->options = $_POST['shippings'];
					$checkout_field->save();
				}
				$protocol = strtolower(substr($_SERVER['SERVER_PROTOCOL'],0,strrpos($_SERVER['SERVER_PROTOCOL'],'/'))).'://';
				$link = $_POST['terms_conditions_url'];
				if(strpos($link,'http://') !== false || strpos($link,'https://') !== false/*strpos($link, $protocol) !== false*/) {
					$this->BuilderEngine->set_option('be_ecommerce_settings_url', $link);
				} else {
					$this->BuilderEngine->set_option('be_ecommerce_settings_url', $protocol.$link);
				}
				$this->BuilderEngine->set_option('be_ecommerce_shop_groups', $_POST['shop_groups']);
				$this->BuilderEngine->set_option('be_ecommerce_reviews_groups', $_POST['reviews_groups']);
				$this->BuilderEngine->set_option('be_ecommerce_access_groups', $_POST['access_groups']);
			}
			$data['current_page'] = 'ecommerce';
			$data['current_child_page'] = 'ecommerce_settings';
			$this->load->view('backend/general_settings',$data);
		}
	}
?>