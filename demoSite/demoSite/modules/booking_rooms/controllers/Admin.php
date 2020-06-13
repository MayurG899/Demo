<?php
    class Admin extends BE_Controller
    {		
        // [MenuItem ("Booking Rooms/Bookings/Add New Booking")]
        public function add_room()
        {
            $this->modify_object('BookingRoom');
        }
        // [MenuItem ("Booking Rooms/Bookings/Show Bookings")]
        public function show_rooms()
        {
            $this->show_objects('BookingRoom');
        }
        // [MenuItem ("Booking Rooms/Rooms/Add New Room")]
        public function add_room_department()
        {
            $this->modify_object('BookingRoomDepartment');
        }
        // [MenuItem ("Booking Rooms/Rooms/Show Rooms")]
        public function show_room_departments()
        {
            $this->show_objects('BookingRoomDepartment');
        }
        // [MenuItem ("Booking Rooms/Categories/Add New Category")]
        public function add_room_category()
        {
            $this->modify_object('BookingRoomCategory');
        }
        // [MenuItem ("Booking Rooms/Categories/Show Categories")]
        public function show_room_categories()
        {
            $this->show_objects('BookingRoomCategory');
        }

        public function modify_object($object_type, $object_id = -1)
        {
            $object = $this->get_object($object_type, $object_id);
            
            if($_POST)
            {
				
				if($object_type == 'BookingRoomDepartment'){
					if(empty($_POST['start_date']))
						$_POST['start_date'] = '01/01/2017';
					if(empty($_POST['end_date']))
						$_POST['end_date'] = '01/01/2050';
				}
				//if($object_type == 'BookingRoom'){
					//if(!empty($_POST['zip']))
					//	$_POST['location'] = str_replace(',',' ',$_POST['address']).', '.$_POST['city'].', '.$_POST['zip'].', '.$_POST['country'];
					//else
					//	$_POST['location'] = str_replace(',',' ',$_POST['address']).', '.$_POST['city'].', '.$_POST['country'];
				//}
				
                $object->create($_POST);
                redirect(base_url('admin/module/booking_rooms/show_objects/'.$object_type), 'location');
            }
            
            $data['view'] = $this->get_view($object_type,  $object_id);
            $data['title'] = str_replace('_',' ',ucfirst($object_type));
			$data['current_page'] = 'booking_rooms';
			$data['current_child_page'] = $object_type;
            $this->load->view('backend/modify_object', $data);
        }
		
        public function delete_object($object_type, $object_id)
        {
            $object = $this->get_object($object_type, $object_id);
			if($object_type == 'BookingRoomCategory'){
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

			if($object_type == 'BookingRoomDepartment'){
				$as = new BookingRoomDepartmentAddonservice();
				$addonServices = $as->where('department_id',$object_id)->get();
				$addonServices->delete_all();
				$i = new BookingRoomDepartmentImage();
				$additional_images = $i->where('department_id',$object_id)->get();
				$additional_images->delete_all();
				$ed = new BookingRoomDepartmentEarlyDiscount();
				$earlyDiscounts = $ed->where('department_id',$object_id)->get();
				$earlyDiscounts->delete_all();
				$gd = new BookingRoomDepartmentGroupDiscount();
				$groupDiscounts = $gd->where('department_id',$object_id)->get();
				$groupDiscounts->delete_all();
				$ug = new BookingRoomDepartmentUsergroupDiscount();
				$userGroupDiscounts = $ug->where('department_id',$object_id)->get();
				$userGroupDiscounts->delete_all();
				$v = new BookingRoomDepartmentVoucher();
				$vouchers = $v->where('department_id',$object_id)->get();
				$vouchers->delete_all();
			}
            $object->delete();
            redirect(base_url('admin/module/booking_rooms/show_objects/'.$object_type), 'location');
        }

        public function bulk_delete($object_type, $view)
        {
			if($_POST){
				foreach($_POST['id'] as $id){
					$object = new $object_type($id);
					if($object_type == 'BookingRoomCategory'){
						// get child categories
						$categories = new $object_type();
						$categories = $categories->where('parent_id', $id)->get();
						$child_categories = array();
						foreach($categories as $child_category){
							array_push($child_categories,$child_category->id);
						}
						// assign category and category children objects to unallocated category
						$childObject = str_replace('_category','',$object_type);
						$childObjects = new $childObject();
						foreach($childObjects->get() as $child){
							if($child->category_id == $id || in_array($child->category_id,$child_categories)){
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
					if($object_type == 'BookingRoomDepartment'){
						$as = new BookingRoomDepartmentAddonservice();
						$addonServices = $as->where('department_id',$object_id)->get();
						$addonServices->delete_all();
						$i = new BookingRoomDepartmentImage();
						$additional_images = $i->where('department_id',$object_id)->get();
						$additional_images->delete_all();
						$ed = new BookingRoomDepartmentEarlyDiscount();
						$earlyDiscounts = $ed->where('department_id',$object_id)->get();
						$earlyDiscounts->delete_all();
						$gd = new BookingRoomDepartmentGroupDiscount();
						$groupDiscounts = $gd->where('department_id',$object_id)->get();
						$groupDiscounts->delete_all();
						$ug = new BookingRoomDepartmentUsergroupDiscount();
						$userGroupDiscounts = $ug->where('department_id',$object_id)->get();
						$userGroupDiscounts->delete_all();
						$v = new BookingRoomDepartmentVoucher();
						$vouchers = $v->where('department_id',$object_id)->get();
						$vouchers->delete_all();
					}
					$object->delete();
				}
				redirect(base_url('admin/module/booking_rooms/'.$view), 'location');
			}
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
			$data['current_page'] = 'booking_rooms';
			$data['current_child_page'] = $object_type;
            $this->load->view('backend/show_'.$object_type.'_objects', $data);
        }

		// [MenuItem ("Booking Rooms/Invoice Settings")]
		public function invoice_settings() {
			if($_POST)
			{
				$this->BuilderEngine->set_option('be_booking_rooms_company_name', $_POST['name']);
				$this->BuilderEngine->set_option('be_booking_rooms_company_logo', $_POST['logo']);
				$this->BuilderEngine->set_option('be_booking_rooms_company_address', $_POST['address']);
				$this->BuilderEngine->set_option('be_booking_rooms_company_zip', $_POST['zip']);
				$this->BuilderEngine->set_option('be_booking_rooms_company_city', $_POST['city']);
				$this->BuilderEngine->set_option('be_booking_rooms_company_country', $_POST['country']);
				$this->BuilderEngine->set_option('be_booking_rooms_company_phone', $_POST['phone']);
				$this->BuilderEngine->set_option('be_booking_rooms_company_email', $_POST['email']);
				$this->BuilderEngine->set_option('be_booking_rooms_company_tax_vat_number', $_POST['tax_vat_number']);
				$this->BuilderEngine->set_option('be_booking_rooms_company_bank_account_number', $_POST['bank_account_number']);
				$this->BuilderEngine->set_option('be_booking_rooms_company_payment_option', $_POST['payment_option']);
				$this->BuilderEngine->set_option('be_booking_rooms_company_additional_info', $_POST['additional_info']);
			}
			$data['current_page'] = 'booking_rooms';
			$data['current_child_page'] = 'booking_invoice_settings';
			$this->load->view('backend/invoice_settings',$data);
		}

        // [MenuItem ("Booking Rooms/Settings")]
        public function settings()
        {
            if($_POST)
            {
				$this->BuilderEngine->set_option('be_booking_rooms_payment_methods', $_POST['payment_methods']);
				$protocol = strtolower(substr($_SERVER['SERVER_PROTOCOL'],0,strrpos($_SERVER['SERVER_PROTOCOL'],'/'))).'://';
				$link = $_POST['terms_conditions_url'];
				if(strpos($link,'http://') !== false || strpos($link,'https://') !== false/*strpos($link, $protocol) !== false*/) {
					$this->BuilderEngine->set_option('be_booking_rooms_settings_url', $link);
				} else {
					$this->BuilderEngine->set_option('be_booking_rooms_settings_url', $protocol.$link);
				}
				$this->BuilderEngine->set_option('booking_rooms_active', $_POST['booking_rooms_active']);
				$this->BuilderEngine->set_option('booking_rooms_permission', $_POST['booking_rooms_permission']);
				$this->BuilderEngine->set_option('be_booking_rooms_shop_groups', $_POST['shop_groups']);
                $this->BuilderEngine->set_option('be_booking_rooms_access_groups', $this->input->post('access_groups', true));
				$this->BuilderEngine->set_option('be_booking_rooms_add_room_groups', $_POST['room_groups']);
				//$this->BuilderEngine->set_option('be_booking_rooms_add_service_groups', $_POST['service_groups']);
				//$this->BuilderEngine->set_option('be_booking_rooms_add_room_groups', $_POST['room_groups']);
				$this->BuilderEngine->set_option('be_booking_rooms_default_currency', $this->input->post('default_currency', true));
				$this->BuilderEngine->set_option('be_booking_room_block_start_date', $this->input->post('room_block_start_date', true));
				$this->BuilderEngine->set_option('be_booking_room_block_end_date', $this->input->post('room_block_end_date', true));
				//$this->BuilderEngine->set_option('be_booking_settings_log_in_info', $this->input->post('log_in_info', true));
				//$this->BuilderEngine->set_option('be_booking_settings_register_info', $this->input->post('register_info', true));
            }
			$data['current_page'] = 'booking_rooms';
			$data['current_child_page'] = 'booking_settings';
            $this->load->view('backend/booking_settings',$data); 
        }
    }
?>