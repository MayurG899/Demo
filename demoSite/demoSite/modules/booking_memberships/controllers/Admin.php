<?php
    class Admin extends BE_Controller
    {
        // [MenuItem ("Booking Memberships/Memberships/Add New Membership")]
        public function add_membership()
        {
            $this->modify_object('Booking_membership');
        }
        // [MenuItem ("Booking Memberships/Memberships/Show Membership")]
        public function show_memberships()
        {
            $this->show_objects('Booking_membership');
        }
        // [MenuItem ("Booking Memberships/Membership Categories/Add New Category")]
        public function add_membership_category()
        {
            $this->modify_object('Booking_membership_category');
        }
        // [MenuItem ("Booking Memberships/Membership Categories/Show Categories")]
        public function show_membership_categories()
        {
            $this->show_objects('Booking_membership_category');
        }
		// [MenuItem ("Booking Memberships/Show Orders & Applications")]
		public function show_membership_orders()
		{
			$services = new Booking_membership();
			$data['objects'] =$services->get();
			$data['current_page'] = 'booking_memberships';
			$data['current_child_page'] = 'booking_membership_orders';
            $this->load->view('backend/show_Booking_membership_order_objects',$data); 
		}

		// [MenuItem ("Booking Memberships/Active Members & Orders")]
		public function show_active_members()
		{
			$users = new User();
			$memberships = new Booking_membership();
			$data['memberships'] =$memberships->get();
			$data['results'] = $users->get();
			$data['current_page'] = 'booking_memberships';
			$data['current_child_page'] = 'booking_membership_orders';
            $this->load->view('backend/show_active_members',$data); 
		}

        public function modify_object($object_type, $object_id = -1)
        {
            $object = $this->get_object($object_type, $object_id);
            if($_POST)
            {
				if($object_type == 'Booking_membership'){
					$_POST['subscription_period'] = $this->input->post('subscription').'-'.$this->input->post('period'); 
				}
                $object->create($_POST);
                redirect(base_url('/index.php/admin/module/booking_memberships/show_objects/'.$object_type), 'location');
            }
            
            $data['view'] = $this->get_view($object_type,  $object_id);
            $data['title'] = str_replace('_',' ',ucfirst($object_type));
			$data['current_page'] = 'booking_memberships';
			$data['current_child_page'] = $object_type;
            $this->load->view('backend/modify_object', $data);
        }

		public function review_application($action,$order_id)
		{
			$order = new BuilderPaymentOrder($order_id);
			$custom_data = json_decode($order->custom_data);

			$membership_id = $custom_data->membership_id;
			$membership = new Booking_membership($membership_id);

			$custom_data->reviewed = $action;
			$checkout_link = '';
			if($action == 'approved'){
				if(!isset($custom_data->code))
					$custom_data->code = md5(uniqid(time()));
				$checkout_link = '<br/><h2 style="margin-left:100px;width:150px;background:teal !important;padding:10px !important;color:#fff !important;text-decoration;none !important;"><b><a href="'.base_url('booking_memberships/checkout/'.$membership_id.'/'.$order->id.'/'.$custom_data->code).'"> Proceed To Checkout</a></b></h2><br/><br/>';
			}
			$custom_data = json_encode($custom_data);
			$order->custom_data = $custom_data;

			$message = $this->BuilderEngine->get_option('be_booking_memberships_approval_email');
			if($membership->price > 0)
				$message = $this->BuilderEngine->get_option('be_booking_memberships_approval_email').$checkout_link;
			if($action == 'rejected'){
				$order->status = 'canceled';
				$message = $this->BuilderEngine->get_option('be_booking_memberships_rejected_email');
			}
			$order->save();

			$this->load->model('users');
			$subject = 'Your application for '.$this->BuilderEngine->get_option('be_booking_memberships_company_name');
			$this->users->send_html_email($order->billingAddress->get()->email, $subject, 'email_template', $message, false, 'booking_memberships');

			redirect(base_url('admin/module/booking_memberships/show_membership_orders'),'location');
		}

		public function set_paid($order_id)
		{
			$order = new BuilderPaymentOrder($order_id);
			$order->status = 'paid';
			$order->paid_gross = $order->gross;
			$order->save();
			$s = new UserSubscription();
			$subscriptions = $s->where('module','booking_memberships')->where('user_id',$order->user_id)->get();
			if($subscriptions->exists()){
				foreach($subscriptions as $subscription){
					$custom_data = json_decode($subscription->custom_data);
					if(isset($custom_data) && !empty($custom_data)){
						if($order->id == $custom_data->order_id){
							$this->activate_subscription($subscription->id);
						}
					}
				}
			}
			redirect(base_url('admin/module/booking_memberships/show_active_members'),'location');
		}

		public function activate_subscription($subscription_id)
		{
			$this->user->require_group("Administrators");
			$s = new UserSubscription();
			$subscription = $s->where('id',$subscription_id)->get();
			if($subscription->exists()){
				$this->load->model('users');
				$custom_data = json_decode($subscription->custom_data);
				if(isset($custom_data->note))
					$custom_data->note = $custom_data->note.'<br/> Activated by Admin on '.date('d-m-Y G:i:s',time());
				else
					$custom_data->note = 'Activated by Admin on '.date('d-m-Y G:i:s',time());
				$subscription->custom_data = json_encode($custom_data);
				$subscription->status = 'active';
				$subscription->save();

				$user = new User($subscription->user_id);
				$object_name = 'N/A';
				$membership = new Booking_membership($custom_data->membership_id);

				$this->load->module('booking_memberships');
				$this->booking_memberships->upgrade_user_to_usergroups($user->id, $membership->usergroups);
				$object_name = $membership->name;

				$message = 'Dear '.$user->first_name.' '.$user->last_name.',<br/> your subscription has been approved and activated, effective from '.date('d-m-Y G:i:s',time()).'.';
				$this->users->send_email($user->email,'Your Subscription for '.$object_name.' has been approved and activated.', $message, 'email_template', true, false, false, $subscription->module);
			}
			redirect(base_url('admin/module/booking_memberships/show_active_members'),'location');
		}

		public function terminate_subscription($subscription_id)
		{
			$s = new UserSubscription();
			$subscription = $s->where('id',$subscription_id)->get();
			if($subscription->exists()){
				$this->load->model('users');
				$custom_data = json_decode($subscription->custom_data);
				$custom_data->terminated = 'yes';
				if(isset($custom_data->note))
					$custom_data->note = $custom_data->note.'<br/> Terminated by Admin on '.date('d-m-Y G:i:s',time());
				else
					$custom_data->note = 'Terminated by Admin on '.date('d-m-Y G:i:s',time());
				$subscription->custom_data = json_encode($custom_data);
				$subscription->status = 'terminated';
				$subscription->save();
				$user = new User($subscription->user_id);
				$membership = new Booking_membership($custom_data->membership_id);
				$message = 'Dear '.$user->first_name.' '.$user->last_name.',<br/> We regret to inform you that your subscription is being terminated, effective from '.date('d-m-Y G:i:s',time()).'.<br/>This decision was reached after the completion of a full internal disciplinary process.';
				$this->users->send_email($user->email,'Your Subscription for '.$membership->name.' has been terminated.', $message, 'email_template', true, false, false, 'booking_memberships');
			}
			redirect(base_url('admin/module/booking_memberships/show_active_members'),'location');
		}

        public function delete_object($object_type, $object_id)
        {
            $object = $this->get_object($object_type, $object_id);
			if($object_type == 'Booking_membership_category'){
				// get child categories
				$categories = new $object_type();
				$categories = $categories->where('parent_id', $object_id)->get();
				$child_categories = array();
				foreach($categories as $child_category){
					array_push($child_categories,$child_category->id);
				}
				// assign category and category children objects to unallocated category
				$childObject = str_replace('_category','',$object_type);
				$childObjects = new $childObject();
				foreach($childObjects->get() as $child){
					if($child->category_id == $object_id || in_array($child->category_id,$child_categories)){
						$unallocated_category = new $object_type();
						$unallocated_category = $unallocated_category->where('name','Unallocated')->get();
						$child->category_id = $unallocated_category->id;
						$child->save();
					}
				}
				// delete all child categories
				foreach($categories as $category){
					//if($category->has_children())
					//	$this->delete_recursive($category->id);
					$category->delete();
				}

			}
			if($object_type == 'Booking_membership'){
				$as = new Booking_membership_addon_service();
				$addonServices = $as->where('membership_id',$object_id)->get();
				$addonServices->delete_all();
				$i = new Booking_membership_image();
				$additional_images = $i->where('membership_id',$object_id)->get();
				$additional_images->delete_all();
				$ed = new Booking_membership_early_discount();
				$earlyDiscounts = $ed->where('membership_id',$object_id)->get();
				$earlyDiscounts->delete_all();
				$ff = new Booking_membership_featured_field();
				$featFields = $ff->where('membership_id',$object_id)->get();
				$featFields ->delete_all();
				$gd = new Booking_membership_group_discount();
				$groupDiscounts = $gd->where('membership_id',$object_id)->get();
				$groupDiscounts->delete_all();
				$ug = new Booking_membership_usergroup_discount();
				$userGroupDiscounts = $ug->where('membership_id',$object_id)->get();
				$userGroupDiscounts->delete_all();
				$v = new Booking_membership_voucher();
				$vouchers = $v->where('membership_id',$object_id)->get();
				$vouchers->delete_all();
				$q = new Booking_membership_questionnaire_field();
				$questionnaire = $q->where('membership_id',$object_id)->get();
				$questionnaire->delete_all();
			}
            $object->delete();
			if($object_type != 'Booking_membership_order')
				redirect(base_url('admin/module/booking_memberships/show_objects/'.$object_type), 'location');
			else
				redirect(base_url('admin/module/booking_memberships/show_membership_orders'), 'location');
        }
		/*
		public function delete_recursive($id) {
			$query = mysql_query("SELECT * FROM be_blog_categories WHERE parent_id='$id'");
			if(mysql_num_rows($query) > 0) {
				while($item = mysql_fetch_array($query)){
					$this->delete_recursive($item['id']);
				}
			}

			$childObjects = new Post();
			foreach($childObjects->get() as $child){
				if($child->category_id == $id){
					$unallocated_category = new Category();
					$unallocated_category = $unallocated_category->where('name','Unallocated')->get();
					$child->category_id = $unallocated_category->id;
					$child->save();
				}
			}

			mysql_query("DELETE FROM be_blog_categories WHERE id='$id'");
		}
		*/
        public function get_object($object_type, $object_id = -1, $get = false)
        {
            $this->load->model($object_type);
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
			$data['current_page'] = 'booking_memberships';
			$data['current_child_page'] = $object_type;
            $this->load->view('backend/show_'.$object_type.'_objects', $data);
        }

		// [MenuItem ("Booking Memberships/Invoice Settings")]
		public function invoice_settings() {
			if($_POST)
			{
				$this->BuilderEngine->set_option('be_booking_memberships_company_name', $_POST['name']);
				$this->BuilderEngine->set_option('be_booking_memberships_company_logo', $_POST['logo']);
				$this->BuilderEngine->set_option('be_booking_memberships_company_address', $_POST['address']);
				$this->BuilderEngine->set_option('be_booking_memberships_company_zip', $_POST['zip']);
				$this->BuilderEngine->set_option('be_booking_memberships_company_city', $_POST['city']);
				$this->BuilderEngine->set_option('be_booking_memberships_company_country', $_POST['country']);
				$this->BuilderEngine->set_option('be_booking_memberships_company_phone', $_POST['phone']);
				$this->BuilderEngine->set_option('be_booking_memberships_company_email', $_POST['email']);
				$this->BuilderEngine->set_option('be_booking_memberships_company_tax_vat_number', $_POST['tax_vat_number']);
				$this->BuilderEngine->set_option('be_booking_memberships_company_bank_account_number', $_POST['bank_account_number']);
				$this->BuilderEngine->set_option('be_booking_memberships_company_payment_option', $_POST['payment_option']);
				$this->BuilderEngine->set_option('be_booking_memberships_company_additional_info', $_POST['additional_info']);
			}
			$data['current_page'] = 'booking_memberships';
			$data['current_child_page'] = 'booking_invoice_settings';
			$this->load->view('backend/invoice_settings',$data);
		}

        // [MenuItem ("Booking Memberships/Settings")]
        public function settings()
        {
            if($_POST)
            {
				$this->BuilderEngine->set_option('be_booking_memberships_payment_methods', $_POST['payment_methods']);
				$protocol = strtolower(substr($_SERVER['SERVER_PROTOCOL'],0,strrpos($_SERVER['SERVER_PROTOCOL'],'/'))).'://';
				$link = $_POST['terms_conditions_url'];
				if(strpos($link,'http://') !== false || strpos($link,'https://') !== false/*strpos($link, $protocol) !== false*/) {
					$this->BuilderEngine->set_option('be_booking_memberships_settings_url', $link);
				} else {
					$this->BuilderEngine->set_option('be_booking_memberships_settings_url', $protocol.$link);
				}
				$this->BuilderEngine->set_option('booking_memberships_active', $this->input->post('booking_memberships_active', true));
				$this->BuilderEngine->set_option('be_booking_memberships_shop_groups', $this->input->post('shop_groups', true));
                $this->BuilderEngine->set_option('be_booking_memberships_access_groups', $this->input->post('access_groups', true));
				$this->BuilderEngine->set_option('be_booking_memberships_add_membership_groups', $this->input->post('membership_groups', true));
				$this->BuilderEngine->set_option('be_booking_memberships_default_currency', $this->input->post('default_currency', true));
				$this->BuilderEngine->set_option('be_booking_memberships_event_block_start_date', $this->input->post('event_block_start_date', true));
				$this->BuilderEngine->set_option('be_booking_memberships_event_block_end_date', $this->input->post('event_block_end_date', true));
				$this->BuilderEngine->set_option('be_booking_memberships_approval_email', $this->input->post('approval_email', true));
				$this->BuilderEngine->set_option('be_booking_memberships_rejected_email', $this->input->post('rejected_email', true));
            }
			$data['current_page'] = 'booking_memberships';
			$data['current_child_page'] = 'settings';
            $this->load->view('backend/booking_settings',$data); 
        }
    }
?>