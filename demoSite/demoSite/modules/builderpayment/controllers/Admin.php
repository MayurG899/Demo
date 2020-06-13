<?php
	class Admin extends Module_Controller
	{
		public function gateway_settings()
		{
			$args = func_get_args();
			$gateway = array_shift($args);
			$function = array_shift($args);

			$handler = $gateway."Gateway";
			$this->load->module("builderpayment/paypalgateway");
			call_user_func_array(array($this->paypalgateway, $function), $args);
		}

		// [MenuItem("Payments/Orders & Invoices/All Orders")]
		public function sales()
		{
			$this->load->module("builderpayment");
			$orders = new BuilderPaymentOrder();
			$data['orders'] = $orders->get();
			$data['current_page'] = 'payments';
			$data['current_child_page'] = 'sales_orders';
			$this->load->view('sales_orders.php',$data);
		}

		public function delete_order($id)
		{
			$order = new BuilderPaymentOrder($id);

			$orderProducts = new BuilderPaymentOrderProduct();
			$orderProducts = $orderProducts->where('order_id',$id)->get();
			$orderProducts->delete_all();
			$orderAddress = new BuilderPaymentAddress();
			$orderAddress = $orderAddress->where('id',$order->billingaddress_id)->or_where('id',$order->shippingaddress_id)->get();
			$orderAddress->delete_all();

			$order->delete();

			redirect(base_url('admin/module/builderpayment/sales'),'location');
		}

		public function set_paid($order_id)
		{
			$order = new BuilderPaymentOrder($order_id);
			$order->status = 'paid';
			$order->paid_gross = $order->gross;
			$order->save();
			redirect(base_url('admin/module/builderpayment/sales'),'location');
		}
		// [MenuItem("Payments/Currencies/Currency List")]
		public function currencies()
		{
			$currencies = new Currency();
			$data['objects'] = $currencies->get();
			$data['current_page'] = 'payments';
			$data['current_child_page'] = 'currencies';
			$this->load->view('currencies',$data);
		}

		/* TODO: new currency converter
		 [MenuItem("Payments/Currencies/Currency Converter")]
		public function conversions()
		{
			$currencies = new Currency();
			if($_POST){
				$data['amount'] = $_POST['amount'];
				$data['from'] = $_POST['from'];
				$data['to'] = $_POST['to'];
				$data['result'] = convertCurrency($_POST['amount'],$_POST['from'],$_POST['to']);
			}else
				$data['result'] = '';
			$data['objects'] = $currencies->get();
			$data['current_page'] = 'payments';
			$data['current_child_page'] = 'conversions';
			$this->load->view('currency_converter',$data);
		}
		*/

		// [MenuItem("Payments/Payment Gateways/PayPal")]
		public function paypal_settings()
		{
			if($_POST)
			{
				$this->BuilderEngine->set_option('be_builderpayment_paypal_settings', json_encode($_POST));
				
			}
			$encoded_settings = $this->BuilderEngine->get_option('be_builderpayment_paypal_settings');
			if($encoded_settings == "")
			{
				$settings['paypal_address'] = "";
				$settings['active'] = 'no';
				$settings['sandbox'] = 0;
				$settings = (object)$settings;
				$this->BuilderEngine->set_option('be_builderpayment_paypal_settings', json_encode($settings));
			}else
				$settings = json_decode($encoded_settings);
			$data['settings'] = $settings;
			$data['current_page'] = 'payments';
			$data['current_child_page'] = 'paypal';
			$this->load->view('paypal/settings.php', $data);
		}

		/*
		 [MenuItem("Payments/Payment Gateways/RealEx")]
		public function realex_settings()
		{
			echo Modules::Run("builderpayment/realexgateway/admin");
			
		}
		*/

        // [MenuItem("Payments/Payment Gateways/Stripe")]
		public function stripe_settings()
		{
			if (!extension_loaded('mbstring')) {
				$data['info'] = '<i class="fa fa-exclamation-triangle"></i> Stripe needs the Multibyte String PHP extension.To enable it,you must contact your hosting provider.';
				$this->load->view('builderpayment/stripe/stripe_info', $data);
			}else
				echo Modules::Run("builderpayment/stripegateway/admin");
		}
        
		/*
         [MenuItem("Payments/Payment Gateways/Authorize.net")]
		public function authorize_settings()
		{
			echo Modules::Run("builderpayment/authorizegateway/admin");
		}
		*/

		// [MenuItem("Payments/Settings")]
		public function settings()
		{
			if($this->input->post()){
				$this->BuilderEngine->set_option('be_payments_notify_admin', $this->input->post('be_payments_notify_admin', true));
				$this->BuilderEngine->set_option('be_payments_admin_send_copy_invoice', $this->input->post('be_payments_admin_send_copy_invoice', true));
			}
			$data['current_page'] = 'payments';
			$data['current_child_page'] = 'settings';
			$this->load->view('general_settings',$data);
		}
	}
?>