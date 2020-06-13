<?
	class Booking_rooms extends Module_Controller
	{
		public function calendar()
		{
			if($this->BuilderEngine->get_option('booking_rooms_active') !== 'yes')
				show_404();
			if(!$this->user->is_logged_in())
				redirect(base_url('cp/login'),'location');
			$bookings = new BookingRoom();
			$departments = new BookingRoomDepartment();
			$data['bookings'] = $bookings->get();
			$data['departments'] = $departments->where('active','yes')->order_by('name','asc')->get();
			$this->load->view('frontend/calendar.tpl', $data);
		}

		public function departments($category_id)
		{
			if($this->BuilderEngine->get_option('booking_rooms_active') !== 'yes')
				show_404();
			$rooms = new BookingRoomDepartment();
			$data['rooms'] = $rooms->where('category_id',$category_id)->get();
			if(!isset($category_id) || !$data['rooms']->exists())
				show_404();
			$data['booking_permission'] = $this->BuilderEngine->get_option('booking_rooms_permission');
			$this->load->view('frontend/departments.tpl', $data);
		}

		public function department($slug)
		{
			if($this->BuilderEngine->get_option('booking_rooms_active') !== 'yes')
				show_404();

			$department = new BookingRoomDepartment();
			$department = $department->where('slug',$slug)->get();
			if(!isset($slug) || !$department->exists())
				show_404();
			$data['department'] = $department;
			$data['booking_permission'] = $this->BuilderEngine->get_option('booking_rooms_permission');
			$this->load->view('frontend/department.tpl', $data);
		}

		public function category($id)
		{
			if($this->BuilderEngine->get_option('booking_rooms_active') !== 'yes')
				show_404();
			$category = new BookingRoomCategory();
			if(isset($id)){
				if($id == 'all')
					$data['categories'] = $category->get();
				else{
					$category = $category->where('id',$id)->get();
					if($category->exists())
						$data['categories'] = $category;
					else
						show_404();
				}
				$data['booking_permission'] = $this->BuilderEngine->get_option('booking_rooms_permission');
				$this->load->view('frontend/categories.tpl', $data);
			}else
				show_404();
		}

		public function order_completed($id)
		{	
			if($id){
				$this->load->module('builderpayment/api');
				$order = $this->api->getOrderByID($id);
				$bill = $order->billingAddress->get();
				$custom = json_decode($order->custom_data);
				$department = new BookingRoomDepartment();
				$department = $department->where('id',$custom->department_id)->get();
				$department->booked = $department->booked + $custom->tickets;
				$department->save();
				$booking_order = new BookingRoomOrder();
				$booking_order->user_id = $custom->user_id;
				$booking_order->department_id = $department->id;
				$booking_order->price = $department->price;
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

		public function department_checkout()
		{
			if($this->BuilderEngine->get_option('booking_rooms_active') !== 'yes')
				show_404();

			$this->load->module('builderpayment/api');
			include FCPATH.'modules/booking_rooms/assets/misc/country_list.php';
			$object = new BookingRoomDepartment($_GET['department_id']);

			$userinfo = new User($this->user->get_id());
			if($userinfo->exists()){
				$data['userinfo'] = new User($this->user->get_id());
				$data['customer'] = $data['userinfo']->extended->get();
			}
			$data['object'] = $object;
			$data['department_id'] = $_GET['department_id'];
			$data['countries'] = $countries;
			$data['payment_methods'] = $this->api->getAvailableGateways();
			$data['booking_permission'] = $this->BuilderEngine->get_option('booking_rooms_permission');
			$this->load->view('frontend/checkout',$data);
		}

		public function process_paypal()
		{
			if($this->BuilderEngine->get_option('booking_rooms_active') !== 'yes')
				show_404();

			if($_POST['submitAjaxFormPSC'] && $_POST['submitAjaxFormPSC'] == $this->user->get_id()){
				$this->load->module('builderpayment/api');
				$this->api->identifyModule('booking_rooms');
				$this->api->setGateway('paypal');

				$order = $this->api->createOrder();
				$order->custom_data = json_encode(array('department_id' => $_POST['department_id'], 'zip' => $_POST['zip'], 'user_id' => $this->user->get_id()));
				$order->payment_method = 'paypal';
				$order->currency = $this->BuilderEngine->get_option('be_booking_rooms_default_currency');
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
				
				$department = new BookingRoomDepartment((int)$_POST['department_id']);
				$product = $order->addProduct();
				$product->name = $department->name;
				$product->price = $_POST['amount'];
				$product->quantity = $_POST['tickets'];
				$product->save();

				$order->submit();
			}
		}

		public function delete_booking($id)
		{
			if(!$this->user->is_logged_in())
				redirect(base_url('cp/login'),'location');

			$booking = new BookingRoom($id);
			$booking->delete();

			redirect(base_url('booking_rooms/calendar'),'location');
		}
	}