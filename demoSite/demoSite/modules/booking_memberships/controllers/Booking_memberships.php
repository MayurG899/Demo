<?
	class Booking_memberships extends Module_Controller
	{
		public function membership($id)
		{
			if($this->BuilderEngine->get_option('booking_memberships_active') !== 'yes')
				show_404();
			$services = new Booking_membership($id);
			if(!$services->exists())
				show_404();
			$data['membership'] = $services;
			$this->load->view('frontend/membership.tpl', $data);	
		}

		public function memberships()
		{
			if($this->BuilderEngine->get_option('booking_memberships_active') !== 'yes')
				show_404();
			$services = new Booking_membership();
			$data['memberships'] = $services->get();
			$this->load->view('frontend/memberships.tpl', $data);			
		}

		public function application($id)
		{
			if($this->BuilderEngine->get_option('booking_memberships_active') !== 'yes')
				show_404();
			$service = new Booking_membership($id);
			if(!$service->exists())
				show_404();
			$data['service'] = $service;
			$this->load->view('frontend/application_form.tpl',$data);
		}

		public function checkout($id,$order_id = false,$code = false)
		{
			if($this->BuilderEngine->get_option('booking_memberships_active') !== 'yes')
				show_404();

			$s = new Booking_membership();
			$membership = $s->where('id',$id)->get();

			if(!$membership->exists())
				show_404();
			$groups_allowed_to_book = explode(',',$this->BuilderEngine->get_option('be_booking_memberships_shop_groups'));
			$this->load->module('builderpayment/api');

			if(($this->session->flashdata('guest_user') != null && $this->session->flashdata('guest_order') != null) || $order_id)
			{
				if($this->session->flashdata('guest_order') != null)
					$id = $this->session->flashdata('guest_order');
				else
					$id = $order_id;
				$order = new BuilderPaymentOrder($id);
				if($order->exists() && ($this->session->flashdata('guest_user') == $order->user_id || $order_id)){
					$data['order'] = $order;
					$usr = new User();
					$usr = $usr->where('id',$order->user_id)->get();
					$data['usr'] = $usr;
				}
			}
			include('modules/booking_memberships/assets/misc/country_list.php');
			$data['order_id'] = $order_id;
			$data['order_code'] = $code;
			$data['membership'] = $membership;
			$data['currency'] = new Currency($membership->currency_id);
			$data['countries'] = $countries;
			$data['groups_allowed_to_book'] = $groups_allowed_to_book;
			$data['payment_methods'] = $this->api->getAvailableGateways();
			$this->load->view('frontend/checkout',$data);
		}

		public function order_completed($user)
		{
			$data['bookinguser'] = $user;
			$this->load->view('frontend/order_completed',$data);
		}

		public function service_completed($user)
		{
			$data['bookinguser'] = $user;
			$this->load->view('frontend/service_completed',$data);
		}

		public function get_email_application($data)
		{
			$data['questionnaire'] = $data;
			return $this->load->view('frontend/application_email',$data,true);
		}

		public function process_paypal()
		{
			if($this->BuilderEngine->get_option('booking_memberships_active') !== 'yes')
				show_404();

			if($_POST['submitAjaxFormPSC'] && $_POST['submitAjaxFormPSC'] == $this->user->get_id()){

				$id = (int)$_POST['membership_id'];
				$membership = new Booking_membership();
				$membership = $membership->where('id',$id)->get();

				$this->load->module('builderpayment/api');
				$this->api->identifyModule('booking_memberships');
				$this->api->setGateway('paypal');

				if(!isset($_POST['order_id']))
				{
					$order = $this->api->createOrder();
					$order->custom_data = json_encode(
						array(
							'membership_id' => $membership->id,
							'description' => $membership->description,
							'membership_groups' => $membership->usergroups,
							'reviewed' => 'approved',
							'zip' => $_POST['zip'], 
							'user_id' => $_POST['user_id']
						)
					);
					$order_item = $order->addProduct();
					$order_item->name = $membership->name.' Subscription';
					$order_item->quantity = 1;
					$order_item->price = $_POST['amount'];
					$order_item->save();
				}else{
					$order = new BuilderPaymentOrder($_POST['order_id']);
					$custom_data = json_decode($order->custom_data);
					$custom_data->reviewed = 'approved';
					$custom_data->membership_groups = $membership->usergroups;
					$custom_data = json_encode($custom_data);
					$order->custom_data = $custom_data;
				}
				$order->payment_method = 'paypal';
				$order->currency = $this->BuilderEngine->get_option('be_booking_memberships_default_currency');
				$order->callback = 'order_completed';
				$order->user_id = $_POST['user_id'];
				$order->save();

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

				$order->submit();
			}
		}

		public function upgrade_user_to_usergroups($user_id, $membership_usergroups, $code = false)
		{
			if(!$code || ($code && $code !== 'a8f5f167f44f4964e6c998dee827110c'))
				$this->user->require_group("Administrators");
			$this->load->model('users');
			$user_groups = $this->users->get_user_group_name($user_id);
			$membership_usergroups = explode(',',$membership_usergroups);
			foreach($membership_usergroups as $membership_usergroup){
				if(!in_array($membership_usergroup,$user_groups))
					array_push($user_groups,$membership_usergroup);
			}
			$user_groups = implode(',',$user_groups);
			$this->users->set_user_groups_by_name($user_id, $user_groups);
		}

		public function downgrade_user_from_usergroups($user_id, $membership_usergroups, $code = false)
		{
			if(!$code || ($code && $code !== 'a8f5f167f44f4964e6c998dee827110c'))
				$this->user->require_group("Administrators");
			$this->load->model('users');
			$user_groups = $this->users->get_user_group_name($user_id);
			$membership_usergroups = explode(',',$membership_usergroups);
			foreach($membership_usergroups as $membership_usergroup){
				if (($key = array_search($membership_usergroup, $user_groups)) !== false) {
					unset($user_groups[$key]);
				}
			}
			$user_groups = implode(',',$user_groups);
			$this->users->set_user_groups_by_name($user_id, $user_groups);
		}

		public function process_stripe_payment()
		{
			$this->load->module('builderpayment/Stripegateway');
			$this->stripegateway->load_config();
			$keys = json_decode($this->BuilderEngine->get_option('builderpayment-config-StripeGateway'));
            $sandbox = false;
            if((int)$keys->STRIPE_SANDBOX === 0)
                $sandbox = true;
			$currency_id = $this->BuilderEngine->get_option('be_booking_memberships_default_currency');
			$currency = new Currency($currency_id);
            $amount = $_POST['amount'] * 100;
			$cardname = $this->BuilderEngine->get_option('be_booking_memberships_company_name');
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
				$_POST['status'] = 'paid';
				$_POST['gateway'] = 'stripe';
				$data = $_POST;
				$this->create_order_and_send_confirmation_email($data);
				$this->session->set_flashdata('info', 'Thank You for your payment! <br/> Transaction ID: '.$charge->id.'<br/><br/><a href="'.base_url('cp/orders').'" class="btn btn-lg btn-success">View Invoice</a>');
			}

			redirect(base_url('booking_memberships/info'),'location');
		}

		public function process_cod_payment()
		{
			$_POST['trans_id'] = 'cod_'.time();
			$_POST['status'] = 'pending';
			$_POST['gateway'] = 'cod';
			$data = $_POST;
			$this->create_order_and_send_confirmation_email($data);
			if($_POST['amount'] > 0)
				$this->session->set_flashdata('info', 'Your order/invoice has been generated.Please,check your email address to proceed. Thank you! <br/> Transaction ID: '.$data['trans_id'].'<br/><br/><a href="'.base_url('cp/orders').'" class="btn btn-lg btn-success">View Invoice</a>');
			else
				$this->session->set_flashdata('info', 'Your order/invoice has been created for event confirmation purpose only. Thank you! <br/> Transaction ID: '.$data['trans_id'].'<br/><br/><a href="'.base_url('cp/orders').'" class="btn btn-lg btn-success">View Invoice</a>');
			redirect(base_url('booking_memberships/info'),'location');
		}

		private function create_order_and_send_confirmation_email($data)
		{
			$id = (int)$data['membership_id'];
			$membership = new Booking_membership();
			$membership = $membership->where('id',$id)->get();

			$this->load->module('builderpayment/api');

			if(!isset($data['order_id']))
			{
				$this->api->identifyModule('booking_memberships');
				$order = $this->api->createOrder();
				$order->custom_data = json_encode(
					array(
						'membership_id' => $membership->id,
						'description' => $membership->description,
						'membership_groups' => $membership->usergroups,
						'reviewed' => 'approved',
						'zip' => $data['zip'], 
						'user_id' => $data['user_id']
					)
				);
				$order_item = $order->addProduct();
				$order_item->name = $membership->name.' Subscription';
				$order_item->quantity = 1;
				$order_item->price = $membership->price;
				$order_item->save();
			}
			else
			{
				$order = new BuilderPaymentOrder($data['order_id']);
				$custom_data = json_decode($order->custom_data);
				$custom_data->reviewed = 'approved';
				$custom_data->membership_groups = $membership->usergroups;
				$custom_data = json_encode($custom_data);
				$order->custom_data = $custom_data;
			}
			$order->payment_method = $data['gateway'];
			$order->status = $data['status'];
			$order->currency = $this->BuilderEngine->get_option('be_booking_memberships_default_currency');
			$order->callback = 'order_completed';
			$order->user_id = $data['user_id'];
			$order->gross = $membership->price;
			if(isset($data['payment_time']))
				$order->time_paid = $data['payment_time'];
			$order->trans_id = $data['trans_id'];
			$order->save();

			if(!isset($data['order_id']))
				$bill = $order->createBillingAddress();
			else
				$bill = $order->billingAddress->get();
			$bill->first_name = $data['first_name'];
			$bill->last_name = $data['last_name'];
			$bill->address_line_1 = $data['address'];
			$bill->city = $data['city'];
			$bill->zip = $data['zip'];
			$bill->country = $data['country'];
			$bill->phone = $data['phone'];
			$bill->email =$data['email'];
			$bill->save();

			$order->save();

			$this->update_user_extended_info($data);
			$this->save_extra_order_data_and_calculate_paid_gross($membership,$order,$data);
			$this->create_membership_subscription($membership,$order,$data);
			if($order->payment_method != 'cod')
				$this->upgrade_to_usergroups($order->user_id,$membership->usergroups);
			$this->api->send_confirmation_email($order);
		}

		private function upgrade_to_usergroups($user_id, $membership_usergroups)
		{
			$this->load->model('users');
			$user_groups = $this->users->get_user_group_name($user_id);
			$membership_usergroups = explode(',',$membership_usergroups);
			foreach($membership_usergroups as $membership_usergroup){
				if(!in_array($membership_usergroup,$user_groups))
					array_push($user_groups,$membership_usergroup);
			}
			$user_groups = implode(',',$user_groups);
			$this->users->set_user_groups_by_name($user_id, $user_groups);
		}

		private function save_extra_order_data_and_calculate_paid_gross($membership,$order,$data)
		{
			$custom_data = json_decode($order->custom_data);
			if(isset($custom_data->code))
				unset($custom_data->code);
			$custom_data->total_discount = 0.00;
			$custom_data->addons_total = 0.00;
			# Check and save Addons #
			if(isset($data['add_on_ids']) and !empty($data['add_on_ids']))
			{
				$i = 0;
				$addons_data = array();
				foreach($membership->addonservice->get() as $addon){
					if(in_array($addon->id,$data['add_on_ids'])){
						$addons_data[$i] = array(
							'id' => $addon->id,
							'name' => $addon->name,
							'price' => $addon->price,
							'charged' => ($addon->price_opt == 'flat')?$addon->price:(number_format((($membership->price * $addon->price)/100),2,'.',',')),
							'price_opt' => $addon->price_opt,
						);
					}
					$i++;
				}
				$custom_data->addons = $addons_data;
				$custom_data->addons_total = $data['add_on_value'];
			}

			# Check and save Vouchers #
			if(isset($data['voucher_id']) && isset($data['voucher_code']) && isset($data['voucher_value']))
			{
				$i = 0;
				$vouchers_data = array();
				foreach($membership->voucher->get() as $voucher){
					if($voucher->id == $data['voucher_id'] && $voucher->code == $data['voucher_code'] && date('Y-m-d', strtotime($voucher->expiry_date)) >= date("Y-m-d",time())){
						$vouchers_data[$i] = array(
							'id' => $voucher->id,
							'name' => $voucher->name,
							'code' => $voucher->code,
							'expiry_date' => $voucher->expiry_date,
							'price' => $voucher->price,
							'price_opt' => $voucher->price_opt,
							'discount' => $data['voucher_value'],
						);
					}
					$i++;
				}
				$custom_data->vouchers = $vouchers_data;
				$custom_data->voucher_total_discount = $data['voucher_value'];
				$custom_data->total_discount += $data['voucher_value'];
			}

			# Check and save UserGroup Discounts #
			if(isset($data['usergroupdiscount_id']) && isset($data['usergroup_discount_value']) && isset($data['uid']))
			{
				$usergroup_data = array();
				foreach($membership->usergroupdiscount->get() as $usergroup){
					if($usergroup->id == $data['uid']){
						$usergroup_data[$i] = array(
							'id' => $usergroup->id,
							'name' => $usergroup->usergroup_name,
							'price' => $usergroup->price,
							'price_opt' => $usergroup->price_opt,
							'discount' => $data['usergroup_discount_value']
						);
					}
				}
				$custom_data->usergroups = $usergroup_data;
				$custom_data->usergroup_total_discount = $data['usergroup_discount_value'];
				$custom_data->total_discount += $data['usergroup_discount_value'];
			}
			# Calculate and store order total amounts #
			$custom_data->subtotal = round((($membership->price + $custom_data->addons_total) + $custom_data->total_discount),2);
			$custom_data->vat_rate = $membership->vat;
			$custom_data->vat_amount = $membership->vat;
			if($membership->vat > 0)
				$custom_data->vat_amount = round((($custom_data->subtotal * $membership->vat) / 100),2);
			$custom_data->total = round(($custom_data->subtotal + $custom_data->vat_amount),2);

			$order->gross = $custom_data->total;
			if($order->payment_method != 'cod')
				$order->paid_gross = $custom_data->total;
			$order->custom_data = json_encode($custom_data);
			$order->save();
		}

		private function create_membership_subscription($membership,$order,$data)
		{
			$data['status'] = 'active';
			$expiry_time = explode('-',$membership->subscription_period);
			if($expiry_time[0] == '1')
				$expiry_time[1] = str_replace('s','',$expiry_time[1]);
			$subscription = new UserSubscription();
			$subscription->user_id = $data['user_id'];
			$subscription->module = 'booking_memberships';
			$subscription->custom_data = json_encode(array('order_id' => $order->id,'membership_id' => $membership->id));
			$subscription->type = isset($data['recurring'])?'recurring':'onetime';
			if($data['gateway'] == 'cod')
				$subscription->status = 'pending';
			$subscription->time_created = time();
			$subscription->expiry_time = strtotime('now +'.$expiry_time[0].' '.$expiry_time[1]);
			$subscription->save();
		}

		private function update_user_extended_info($data)
		{
			$this->load->model('users');
			$data['telephone'] = $data['phone'];
			if($data['zip'] == '')
				$data['zip'] = 'none';
			if($data['state'] == '')
				$data['state'] = 'none';
			$u = new User($data['user_id']);
			if($u->exists())
			{
				$profile = $u->extended->get();
				if($profile->telephone == 'none' || $profile->address == 'none' || $profile->city == 'none' || $profile->country == '')
					$this->users->extended_info('update',$data);
			}
		}

		public function info()
		{
			$data = array();
			$this->load->view('frontend/info',$data);
		}

	}