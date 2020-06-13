<?
	class Booking_events extends Module_Controller
	{
		public function events()
		{
			if($this->BuilderEngine->get_option('booking_events_active') !== 'yes')
				show_404();

			$events = new Booking_event();
			$data['events'] = $events->get();
			$data['booking_permission'] = $this->BuilderEngine->get_option('booking_events_permission');
			$this->load->view('frontend/events.tpl', $data);
		}

		public function event($slug)
		{
			if($this->BuilderEngine->get_option('booking_events_active') !== 'yes')
				show_404();

			$event = new Booking_event();
			$event = $event->where('slug',$slug)->get();
			if(!isset($slug) || !$event->exists())
				show_404();
			$data['event'] = $event;
			$data['booking_permission'] = $this->BuilderEngine->get_option('booking_events_permission');
			$this->load->view('frontend/event.tpl', $data);
		}

		public function event_category($id = null)
		{
			if($this->BuilderEngine->get_option('booking_events_active') !== 'yes')
				show_404();
			if(!isset($id))
				show_404();
			$category = new Booking_event_category();
			$data['category'] = $category->where('id',$id)->where('active','yes')->get();
			$data['booking_permission'] = $this->BuilderEngine->get_option('booking_events_permission');
			$this->load->view('frontend/event_category', $data);			
		}

		public function event_categories()
		{
			if($this->BuilderEngine->get_option('booking_events_active') !== 'yes')
				show_404();
			$categories = new Booking_event_category();
			$data['categories'] = $categories->where('active','yes')->get();
			$this->load->view('frontend/event_categories', $data);			
		}

		public function order_completed($id)
		{	
			if($id){
				$this->load->module('builderpayment/api');
				$order = $this->api->getOrderByID($id);
				$bill = $order->billingAddress->get();
				$custom = json_decode($order->custom_data);
				$event = new Booking_event();
				$event = $event->where('id',$custom->event_id)->get();
				$event->booked = $event->booked + $custom->tickets;
				$event->save();
				$booking_order = new Booking_event_order();
				$booking_order->user_id = $custom->user_id;
				$booking_order->event_id = $event->id;
				$booking_order->price = $event->price;
				$booking_order->tickets = $custom->tickets;
				$booking_order->paid = $order->paid_gross;
				$booking_order->paid_toggle = 'yes';
				$booking_order->username = $bill->first_name.' '.$bill->last_name;
				$booking_order->email = $bill->email;
				$booking_order->phone = $bill->phone;
				$booking_order->address = $bill->address_line_1;
				$booking_order->city = $bill->city;
				$booking_order->zip = $bill->zip;
				$booking_order->country = $bill->country;
				$booking_order->payment_method = $order->payment_method;
				$booking_order->time_created = $order->time_created;
				$booking_order->time_paid = $order->time_paid;
				$booking_order->trans_id = $order->trans_id;
				$booking_order->save();
				redirect(base_url('builderpayment/order_success'),'location');
			}
		}

		public function event_checkout()
		{
			if($this->BuilderEngine->get_option('booking_events_active') !== 'yes')
				show_404();

			$this->load->module('builderpayment/api');
			include FCPATH.'modules/booking_events/assets/misc/country_list.php';
			$object = new Booking_event($_GET['event_id']);

			$userinfo = new User($this->user->get_id());
			if($userinfo->exists()){
				$data['userinfo'] = new User($this->user->get_id());
				$data['customer'] = $data['userinfo']->extended->get();
			}
			$data['object'] = $object;
			$data['event_id'] = $_GET['event_id'];
			$data['countries'] = $countries;
			$data['payment_methods'] = $this->api->getAvailableGateways();
			$data['booking_permission'] = $this->BuilderEngine->get_option('booking_events_permission');
			$this->load->view('frontend/checkout',$data);
		}

		public function process_paypal()
		{
			if($this->BuilderEngine->get_option('booking_events_active') !== 'yes')
				show_404();

			if($_POST['submitAjaxFormPSC'] && $_POST['submitAjaxFormPSC'] == $this->user->get_id()){
				$this->load->module('builderpayment/api');
				$this->api->identifyModule('booking_events');
				$this->api->setGateway('paypal');

				$order = $this->api->createOrder();
				$order->custom_data = json_encode(array('event_id' => $_POST['event_id'], 'tickets' => $_POST['tickets'], 'zip' => $_POST['zip'], 'user_id' => $this->user->get_id()));
				$order->payment_method = 'paypal';
				$order->currency = $this->BuilderEngine->get_option('be_booking_events_default_currency');
				$order->callback = 'order_completed';
				$order->save();

				$ship = $order->createShippingAddress();
				$ship->first_name = $_POST['first_name'];
				$ship->last_name = $_POST['last_name'];
				$ship->address_line_1 = $_POST['address'];
				$ship->city = $_POST['city'];
				$ship->zip = $_POST['zip'];
				$ship->country = $_POST['country'];
				$ship->phone = $_POST['phone'];
				$ship->email =$_POST['email'];
				$ship->save();

				$bill = $order->createBillingAddress();
				$bill->first_name = $_POST['first_name'];
				$bill->last_name = $_POST['last_name'];
				$bill->address_line_1 = $_POST['address'];
				$bill->city = $_POST['city'];
				$bill->zip = $_POST['zip'];
				$bill->country = $_POST['country'];
				$bill->phone = $_POST['phone'];
				$bill->email =$_POST['email'];
				$bill->save();
				
				$event = new Booking_event((int)$_POST['event_id']);
				$product = $order->addProduct();
				$product->name = $event->name;
				$product->price = $_POST['amount'];
				$product->quantity = $_POST['tickets'];
				$product->save();

				$order->submit();
			}
		}

		public function process_stripe_payment()
		{
			if($this->BuilderEngine->get_option('booking_events_active') !== 'yes')
				show_404();

			if($_POST){
				$this->load->module('builderpayment/Stripegateway');
				$this->stripegateway->load_config();
				$keys = json_decode($this->BuilderEngine->get_option('builderpayment-config-StripeGateway'));
				$sandbox = false;
				if((int)$keys->STRIPE_SANDBOX === 0)
					$sandbox = true;
				$currency_id = $this->BuilderEngine->get_option('be_booking_events_default_currency');
				$currency = new Currency($currency_id);
				$amount = $_POST['amount'] * 100;
				$cardname = $this->BuilderEngine->get_option('be_booking_events_company_name');
				// API credentials only need to be defined once
				define("STRIPE_TEST_API_PUBLISHABLE_KEY", $keys->STRIPE_TEST_API_PUBLISHABLE_KEY);
				define("STRIPE_LIVE_API_PUBLISHABLE_KEY", $keys->STRIPE_LIVE_API_PUBLISHABLE_KEY);
				define("STRIPE_SANDBOX", $sandbox);

				if($sandbox)
					Stripe::setApiKey($keys->STRIPE_TEST_API_SECRET_KEY);
				else
					Stripe::setApiKey($keys->STRIPE_LIVE_API_SECRET_KEY);
				$payment_time = time();

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
				}			

				if ($charge->paid){
					$_POST['payment_time'] = $payment_time;
					$_POST['trans_id'] = $charge->id;
					$_POST['paid_toggle'] = 'yes';
					$data = $_POST;
					$this->create_order_and_send_confirmation_email($data);
					$this->session->set_flashdata('info', 'Thank You for your payment! <br/> Transaction ID: '.$charge->id.'<br/><br/><a href="'.base_url('cp/booking/events/orders').'" class="btn btn-lg btn-success">View Invoice</a>');
				}

				redirect(base_url('booking_events/info'),'location');
			}
		}

		public function process_cod_payment()
		{
			if($this->BuilderEngine->get_option('booking_events_active') !== 'yes')
				show_404();

			if($_POST){
				$_POST['trans_id'] = 'cod_'.time();
				$_POST['paid_toggle'] = 'no';
				if($_POST['amount'] == 0)
					$_POST['paid_toggle'] = 'yes';
				$_POST['paid'] = 0;
				$_POST['payment_time'] = time();
				$data = $_POST;
				$this->create_order_and_send_confirmation_email($data);
				if($_POST['amount'] > 0)
					$this->session->set_flashdata('info', 'Your order/invoice has been generated.Please,check your email address to proceed. Thank you! <br/> Transaction ID: '.$data['trans_id'].'<br/><br/><a href="'.base_url('cp/booking/events/orders').'" class="btn btn-lg btn-success">View Invoice</a>');
				else
					$this->session->set_flashdata('info', 'Your order/invoice has been created for event confirmation purpose only. Thank you! <br/> Transaction ID: '.$data['trans_id'].'<br/><br/><a href="'.base_url('cp/booking/events/orders').'" class="btn btn-lg btn-success">View Invoice</a>');
				redirect(base_url('booking_events/info'),'location');
			}
		}

		private function create_order_and_send_confirmation_email($data)
		{
			$id = (int)$data['event_id'];
			$object = new Booking_event();
			$object = $object->where('id',$id)->get();

			$order = new Booking_event_order();
			$order->user_id = (!$this->user->is_guest())?$this->user->get_id():0;
			$order->event_id = $object->id;
			$order->price = $object->price;
			$order->paid = $data['amount'];
			$order->tickets = $data['tickets'];
			$order->paid_toggle = $data['paid_toggle'];
			$order->username = $data['first_name'].' '.$data['last_name'];
			$order->email = $data['email'];
			$order->phone = $data['phone'];
			$order->address = $data['address'];
			$order->city = $data['city'];
			$order->country = $data['country'];
			$order->zip = $data['zip'];
			$order->payment_method = $data['payment_method'];
			$order->time_created = time();
			$order->time_paid = $data['payment_time'];
			$order->trans_id = $data['trans_id'];
			$order->save();

			$object->booked = $object->booked + $data['tickets'];
			$object->save();
			$user = new User($this->user->get_id());
			if($user->exists())
				$username = $user->username;
			else
				$username = $data['first_name'].' '.$data['last_name'];
			$to      = $data['email'];
			$admin = $this->BuilderEngine->get_option('adminemail');
			$admin_subject = 'New Booking Reservation for '.$object->name.' event';
			$user_subject = 'Your Booking Reservation confirmation for '.$object->name;
			$tickets = $data['tickets'];
			$pluralizer = ($tickets == 1)?'':'s';
			$message = 'Your reservation for '.$object->name.' event has been successfully processed!';
			$admin_message = 'User <b>'.$username.'</b> has booked '.$tickets.' ticket'.$pluralizer.' for '.$object->name.' event';
			$headers = 'MIME-Version: 1.0' . "\r\n".
				'Content-type: text/html; charset=iso-8859-1' . "\r\n".
				'From: '.$this->BuilderEngine->get_option("adminemail") . "\r\n" .
				'Reply-To: '.$this->BuilderEngine->get_option("adminemail") . "\r\n" .
				'mailed-by: '.$this->BuilderEngine->get_option("adminemail") . "\r\n";

			$data1 = array(
				'company_name' => $this->BuilderEngine->get_option('be_booking_events_company_name'),
				'company_logo' => $this->BuilderEngine->get_option('be_booking_events_company_logo'),
				'company_address' => $this->BuilderEngine->get_option('be_booking_events_company_address'),
				'company_zip' => $this->BuilderEngine->get_option('be_booking_events_company_zip'),
				'company_city' => $this->BuilderEngine->get_option('be_booking_events_company_city'),
				'company_country' => $this->BuilderEngine->get_option('be_booking_events_company_country'),
				'company_phone' => $this->BuilderEngine->get_option('be_booking_events_company_phone'),
				'company_email' => $this->BuilderEngine->get_option('be_booking_events_company_email'),
				'company_tax_vat_number' => $this->BuilderEngine->get_option('be_booking_events_company_tax_vat_number'),
				'company_bank_account_number' => $this->BuilderEngine->get_option('be_booking_events_company_bank_account_number'),
				'payment_option' => $this->BuilderEngine->get_option('be_booking_events_company_payment_option'),
				'object_type' => 'Booking_event',
				'object' => $object,
				'order' => $order
			);
			$html_message = $this->load->view('email_e2_invoice',$data1,true);

			mail($to, $user_subject, $html_message, $headers);
			mail($admin, $admin_subject, $admin_message, $headers);
			if($data['payment_method'] == 'cod'){
				$subject = 'Your Order/Invoice for '.$object->name.' event';
				$invoice = $this->load->view('event_invoice',$data1,true);
				mail($to, $subject, $invoice, $headers);
			}
		}

		public function info()
		{
			$data = array();
			$this->load->view('frontend/info',$data);
		}
	}