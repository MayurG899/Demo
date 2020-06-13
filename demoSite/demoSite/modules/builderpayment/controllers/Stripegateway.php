<?php
	require_once('Paymentgateway.php');
    require_once('stripe/lib/Stripe.php');
    class StripeGateway extends PaymentGateway
	{
		public function process($order)
		{
			$this->load_config();
			$data['config'] = $this->m_config;
			$data['order'] = $order;

			$this->load->view('stripe/stripe_credit_card', $data);

		}

        public function process_payment($order_id)
		{
            error_reporting(0);
			$order = $this->api->getOrderByID($order_id);
			$this->load_config();
            $sandbox = true;
            if($this->m_config['STRIPE_SANDBOX'])
                $sandbox = false;

            // Get the set currency signature (e.g. EUR, USD...)
            $currency = new Currency($order->currency);
            $amount = $order->gross*100;
			$cardname = $this->BuilderEngine->get_option('be_ecommerce_company_name');
			// API credentials only need to be defined once
            define("STRIPE_TEST_API_PUBLISHABLE_KEY", $this->m_config['STRIPE_TEST_API_PUBLISHABLE_KEY']);
            define("STRIPE_LIVE_API_PUBLISHABLE_KEY", $this->m_config['STRIPE_LIVE_API_PUBLISHABLE_KEY']);
            define("STRIPE_SANDBOX", $sandbox);

            if($sandbox)
                Stripe::setApiKey($this->m_config['STRIPE_TEST_API_SECRET_KEY']);
            else
                Stripe::setApiKey($this->m_config['STRIPE_LIVE_API_SECRET_KEY']);

			try{
				$stripe_customer = Stripe_Customer::create(array(
					'email' => $this->input->post('stripeEmail'),
					'source'  => $this->input->post('stripeToken'),
				));
				$charge = Stripe_Charge::create(array(
					'customer' => $stripe_customer->id,
					"amount" => $amount,
					"currency" => strtolower($currency->signature),
					"description" => "Charge for ".$cardname,
				));

			}
			catch(Exception $e){
				$this->session->set_flashdata('error', 'Oops, '.$e->getMessage());
				redirect(base_url($order->module.'/info'),'location');
			}			

			if ($charge->paid){
				$order->trans_id = $charge->id;
				$order->save();
				$order->paid();
			}
		}

		public function details()
		{
			return array(
			    "id"			=> "stripe",
				"name"			=> "Stripe",
				"logo_big"		=> "https://resourcecentre.realexpayments.com/templates/realex/images/logo.gif",
				"logo_small"	=> "",
				"icon"			=> base_url("/modules/builderpayment/img/gateways/stripe/stripe.png")
			);
		}

		public function default_config()
		{
			$this->config_set('stripe', '');
			$this->config_set('STRIPE_TEST_API_PUBLISHABLE_KEY', '');
            $this->config_set('STRIPE_TEST_API_SECRET_KEY', '');
            $this->config_set('STRIPE_LIVE_API_PUBLISHABLE_KEY', '');
            $this->config_set('STRIPE_LIVE_API_SECRET_KEY', '');
            $this->config_set('STRIPE_SANDBOX', 0);
            $this->config_set('active', 'no');
		}

		public function get_config()
		{
		}

		public function is_available()
		{
			return true;
			$encoded_settings = $this->BuilderEngine->get_option('be_builderpayment_stripe_settings');
			if($encoded_settings == '')
				return false;
			$settings = json_decode($encoded_settings);
			return strlen($settings->STRIPE_TEST_API_PUBLISHABLE_KEY) > 3 || strlen($settings->STRIPE_LIVE_API_PUBLISHABLE_KEY) > 3 && $settings->active == 'yes';
		}

		public function test($var)
		{
			echo $var;
		}

		public function admin()
		{
			$this->load->module("builderpayment/stripegateway");
			$stripe = new StripeGateway();
			$stripe->load_config();
			if($_POST)
			{
				$stripe->config_set('STRIPE_TEST_API_PUBLISHABLE_KEY', $_POST['STRIPE_TEST_API_PUBLISHABLE_KEY']);
                $stripe->config_set('STRIPE_TEST_API_SECRET_KEY', $_POST['STRIPE_TEST_API_SECRET_KEY']);
                $stripe->config_set('STRIPE_LIVE_API_PUBLISHABLE_KEY', $_POST['STRIPE_LIVE_API_PUBLISHABLE_KEY']);
                $stripe->config_set('STRIPE_LIVE_API_SECRET_KEY', $_POST['STRIPE_LIVE_API_SECRET_KEY']);
				$stripe->config_set('active', $_POST['active']);
				$stripe->config_set('STRIPE_SANDBOX', $_POST['STRIPE_SANDBOX']);
				$stripe->save_config();
			}
			$data['STRIPE_TEST_API_PUBLISHABLE_KEY'] = $stripe->config_get('STRIPE_TEST_API_PUBLISHABLE_KEY');
            $data['STRIPE_TEST_API_SECRET_KEY'] = $stripe->config_get('STRIPE_TEST_API_SECRET_KEY');
			$data['STRIPE_LIVE_API_PUBLISHABLE_KEY'] = $stripe->config_get('STRIPE_LIVE_API_PUBLISHABLE_KEY');
            $data['STRIPE_LIVE_API_SECRET_KEY'] = $stripe->config_get('STRIPE_LIVE_API_SECRET_KEY');
			$data['STRIPE_SANDBOX'] = $stripe->config_get('STRIPE_SANDBOX');
			$data['active'] = $stripe->config_get('active');
			$data['current_page'] = 'payments';
			$data['current_child_page'] = 'stripe';
			$this->load->view('stripe/settings.php', $data);
		}
	}
?>
