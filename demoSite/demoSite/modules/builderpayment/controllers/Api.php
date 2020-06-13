<?php
	class Api extends Module_Controller
	{
		private $module = null;
		private $order = null;
		public $gateway = null;
		private $shippingAddress = null;
		private $billingAddress = null;
		private $products = array();
		public function initialize()
		{
			//die("Forbidden");
		}
		public function test_email($id)
		{
			$order = new BuilderPaymentOrder($id);
			$this->send_confirmation_email($order);
		}

		public function send_confirmation_email($order,$receipt = false)
		{
			if($order->user_id == 0)
				return;

			$this->load->model('users');
			$module = $order->module;
			$data = array(
				'company_name' => $this->BuilderEngine->get_option('be_'.$module.'_company_name'),
				'company_logo' => $this->BuilderEngine->get_option('be_'.$module.'_company_logo'),
				'company_address' => $this->BuilderEngine->get_option('be_'.$module.'_company_address'),
				'company_zip' => $this->BuilderEngine->get_option('be_'.$module.'_company_zip'),
				'company_city' => $this->BuilderEngine->get_option('be_'.$module.'_company_city'),
				'company_country' => $this->BuilderEngine->get_option('be_'.$module.'_company_country'),
				'company_phone' => $this->BuilderEngine->get_option('be_'.$module.'_company_phone'),
				'company_email' => $this->BuilderEngine->get_option('be_'.$module.'_company_email'),
				'company_tax_vat_number' => $this->BuilderEngine->get_option('be_'.$module.'_company_tax_vat_number'),
				'company_bank_account_number' => $this->BuilderEngine->get_option('be_'.$module.'_company_bank_account_number'),
				'payment_option' => $this->BuilderEngine->get_option('be_'.$module.'_company_payment_option'),
				'additional_info' => $this->BuilderEngine->get_option('be_'.$module.'_company_additional_info'),
				'order' => $order,
				'products' => $order->product->get(),
				'currency' => new Currency($order->currency),
				'custom_fields' => json_decode($order->custom_data),
				'order_bill_address' => $order->billingAddress->get(),
				'order_ship_address' => $order->shippingAddress->get()
			);
			$subject = 'Your Invoice from '.$this->BuilderEngine->get_option('website_title');
			$message = 'Invoice attached.<br/>Thank you for your purchase !<br/>'.$this->BuilderEngine->get_option('website_title');
			$html = $this->load->view('invoice/order_invoice', $data, true);
			$attachment = PDF($_SERVER['DOCUMENT_ROOT'].'/files/Invoice#'.$order->id, $html, 'F');
			$this->users->send_email($order->billingAddress->get()->email, $subject, $message, 'email_template', true, $attachment, false, $module);
			$send_copy_to_admin = ($this->BuilderEngine->get_option('be_payments_notify_admin') && $this->BuilderEngine->get_option('be_payments_notify_admin') == 'yes')?true:false;
			if($send_copy_to_admin){
				$attach_invoice = ($this->BuilderEngine->get_option('be_payments_admin_send_copy_invoice') && $this->BuilderEngine->get_option('be_payments_admin_send_copy_invoice') == 'yes')?$attachment:false;
				$this->users->send_email($this->BuilderEngine->get_option('adminemail'), 'New Order Created', 'New '.ucwords(str_replace('_',' ',$order->module)).' Order Created by '.$order->billingAddress->get()->email, 'email_template', true, $attach_invoice, false, $module);
			}
			unlink($attachment);
			/*
			#### Old Invoice ####
			$message = $this->load->view('invoice/old_invoice.php', $data, true);

			$user = new User($order->user_id);
			
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From: <'.$user->email.'>' . "\r\n";

			#################################### Order Receipt ###############################################
			$data1 = array(
				'company_logo' => $this->BuilderEngine->get_option('be_'.$order->module.'_company_logo'),
				'order' => $order
			);
			$html_message = $this->load->view('order_receipt_email',$data1,true);
			$html_headers = 'MIME-Version: 1.0' . "\r\n".
				'Content-type: text/html; charset=iso-8859-1' . "\r\n".
				'From: <'.$this->BuilderEngine->get_option("adminemail").'>' . "\r\n" .
				'Reply-To: '.$this->BuilderEngine->get_option("adminemail") . "\r\n" .
				'mailed-by: '.$this->BuilderEngine->get_option("adminemail") . "\r\n";

			if($receipt)
				mail($user->email, "Order receipt from ".str_replace('_',' ',$this->BuilderEngine->get_option('be_'.$order->module.'_company_name')), $html_message, $html_headers);
			else
				mail($user->email, "Your Invoice", $message, $headers);
			*/
		}
		public function getAvailableGateways()
		{
			$gateways = array("paypal", 'cod', 'stripe');

			$available_gateways = array();
			foreach($gateways as $gate_name)
			{
				$gateway_controller = $gate_name.'gateway';
				$this->load->module('builderpayment/'.$gateway_controller);
				if(!$gateway_info = $this->$gateway_controller->is_available())
					continue;
				$gateway_info = $this->$gateway_controller->details();
				if(!isset($gateway_info['icon']))
					$gateway_info['icon'] = false;
				$gateway_info['id'] = $gate_name;
				array_push($available_gateways, (object)$gateway_info);
				
			}
			return $available_gateways;
		}

		public function submitOrder($order,$payment_details = null)
		{
			$this->gateway = $this->getGatewayByID($order->payment_method);

			if($this->gateway == null )
				throw new Exception("No payment method specified.", 1);
			if($payment_details){
				$_POST = $payment_details;
				$this->gateway->process_payment($order->id);
			}
			else
				$this->gateway->process($order);
		}
		public function setGateway($gatewayID)
		{
			$this->gateway = $this->getGatewayByID($gatewayID);
			$this->gateway->api = $this;
		}
		public function getGatewayByID($gatewayID)
		{
			$gateway_controller = $gatewayID.'gateway';
			$this->load->module('builderpayment/'.$gateway_controller);
			return $this->$gateway_controller;
		}
		public function test_available_gateways()
		{
			foreach($this->get_available_gateways() as $gateway)
			{
				echo "<img src='{$gateway->icon}'>";
			}
		}
		public function identifyModule($module)
		{
			$this->module = $module;
		}
		public function getOrderByID($id)
		{
			$order = new BuilderPaymentOrder($id);
			$order->set_api($this);
			return $order;
		}
		public function getOrders()
		{
			if($this->module == null)
				throw new Exception('Module identification not provided. Please identify by using API::identifyModule($module_name).', 1);

			$orders = new BuilderPaymentOrder();
			return $orders->where('module', $this->module)->get();
		}
		public function createOrder()
		{
			if($this->module == null)
				throw new Exception('Module identification not provided. Please identify by using API::identifyModule($module_name).', 1);

			$order = new BuilderPaymentOrder();
			$order->module = $this->module;
			$order->api = $this;
			$order->time_created = time();
			$order->save();
			return $order;
		}
		
		public function createShippingAddress()
		{
			return $this->shippingAddress = new BuilderPaymentAddress();
		}
		public function createBillingAddress()
		{
			return $this->billingAddress = new BuilderPaymentAddress();
		}
		
		public function test_order()
		{
			$this->identifyModule("page");
			$this->setGateway("realex");
			$order = $this->createOrder();
			$order->currency = "USD";
			$order->callback = "page/callback";
			$order->save();
			$ship = $order->createShippingAddress();
			$ship->first_name = "Dimitar";
			$ship->middle_name = "Todorov";
			$ship->last_name = "Krastev";
			$ship->save();

			$bill = $order->createBillingAddress();
			$bill->first_name = "Alfonso";
			$bill->save();

			$product = $order->addProduct();
			$product->name = "iPhone 5s Super";
			$product->price = 123;
			$product->quantity = 3;
			$product->save();
			$order->submit();
		}

		public function test()
		{
			$this->load->model('BuilderPaymentOrder');

			$order				= new BuilderPaymentOrder();
			$shippingAddress	= new BuilderPaymentAddress();

			$relation = array(
				'class' 		=> 'BuilderPaymentAddress',
				'join_table' 	=> 'be_builderpayment_link_ship_user',
				'join_self_as'	=> 'user',
				'join_other_as'	=> 'shippingAddress',
				'other_field'	=> "shipped_user"
			);
			$this->user->has_many('shippingAddress', $relation);


			$order->first_name = "Dimitar";
			$order->save();

			$shippingAddress->first_name = "Another Dimitar";
			$shippingAddress->save();

			
			echo $shippingAddress->id;
			$this->user->save_shippingAddress($shippingAddress);

			foreach ($this->user->shippingAddress->get() as $address)
			{
				echo $address->first_name;

			}
		}

		public function blah()
		{
			sleep(1);
			echo "manja";
		}
		public function process_paid_order($order)
		{
			if($order->callback != "")
				Modules::run($order->module."/".$order->callback, $order->id);
		}
	}
?>