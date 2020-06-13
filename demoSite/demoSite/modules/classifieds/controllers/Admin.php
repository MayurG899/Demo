<?
	class Admin extends BE_Controller
	{
		// [MenuItem ("Classifieds/Categories/Add")] 
		public function add_category()
		{
			$this->load->model('classifiedsfiles');

			if($_POST)
			{
				$category = new ClassifiedsCategory();
				$category->name = $_POST['name'];
				$category->parent = $_POST['parent'];
				//$category_image = $this->classifiedsfiles->upload_image('image', 'images','categories');
				$category->image = $_POST['image'];
				$category->image2 = $_POST['image2'];

				/*
				if($_POST['parent'] == '0')
				{
					$category_image2 = $this->classifiedsfiles->upload_image('image2', 'images','categories');
					$category->image2 = $category_image2;
				}
				*/

				$category->save();
				redirect('admin/module/classifieds/list_categories', 'location');
			}

			$category = new ClassifiedsCategory();
			$data['categories'] = $category->get();
			$data['title'] = 'Category';
			$data['current_page'] = 'classifieds';
			$data['current_child_page'] = 'Classifiedscategory';
			$this->load->view('backend/add_category', $data);
		}
		public function edit_category($id)
		{
			$this->load->model('classifiedsfiles');
			
			if($_POST)
			{
				$category = new ClassifiedsCategory($id);
				$category->name = $_POST['name'];
				$category->parent = $_POST['parent'];
				$category->image = $_POST['image'];
				$category->image2 = $_POST['image2'];
				/*
				if(isset($_FILES['image']) && $_FILES['image']['name'] != '')
				{
					$category_image = $this->classifiedsfiles->upload_image('image', 'images','categories');
					$category->image = $category_image;
				}
				if($_POST['parent'] == '0')
				{
					if(isset($_FILES['image2']) && $_FILES['image2']['name'] != '')
					{
						$category_image2 = $this->classifiedsfiles->upload_image('image2', 'images','categories');
						$category->image2 = $category_image2;
					}
					
				}
				*/

				$category->save();
				redirect('admin/module/classifieds/list_categories', 'location');
			}
			$categories = new ClassifiedsCategory();
			$data['categories'] = $categories->get();
			$data['title'] = 'Category';
			$data['category'] = new ClassifiedsCategory($id);
			$data['current_page'] = 'classifieds';
			$data['current_child_page'] = 'Classifiedscategory';
			$this->load->view('backend/edit_category', $data);
		}
		public function delete_category($id)
		{
			$category = new ClassifiedsCategory($id);
			$category->delete();
			redirect(base_url('admin/module/classifieds/list_categories'), 'location');
		}

		public function bulk_delete($object_type,$view)
		{
			if($_POST){
				foreach($_POST['id'] as $id){
					$object = new $object_type($id);
					if($object->exists())
						$object->delete();
				}
				redirect(base_url('admin/module/classifieds/'.$view),'location');
			}
		}

		// [MenuItem ("Classifieds/Categories/List")]
		public function list_categories()
		{
			$category = new ClassifiedsCategory();
			$data['categories'] = $category->get();
			$data['title'] = 'Categories';
			$data['current_page'] = 'classifieds';
			$data['current_child_page'] = 'Classifiedscategory';
			$this->load->view('backend/list_categories', $data);
		}

		// [MenuItem ("Classifieds/Items list")]
		public function items_list()
		{
			$items = new ClassifiedsItem();
			$data['items'] = $items->get();
			$data['title'] = 'Items';
			$data['current_page'] = 'classifieds';
			$data['current_child_page'] = 'Classifiedsitem';
			$this->load->view('backend/items_list', $data);
		}

		public function delete_item($id)
		{
			$item = new ClassifiedsItem($id);
			$item->delete();
			redirect(base_url('admin/module/classifieds/items_list'), 'location');
		}

		public function toggle_featured($id)
		{
			$item = new ClassifiedsItem($id);
			if ($item->featured == "yes")
				$item->featured = "no";
			else
				$item->featured = "yes";

			$item->save();
			redirect(base_url('admin/module/classifieds/items_list'), 'location');
		}
		

		// [MenuItem ("Classifieds/Members list")]
		public function members_list()
		{
			$data['members'] = new ClassifiedsMember();
			$data['title'] = 'Members';
			$data['current_page'] = 'classifieds';
			$data['current_child_page'] = 'Classifiedsmember';
			$this->load->view('backend/members_list', $data);
		}

		public function toggle_active_member($id)
		{
			$member = new ClassifiedsMember($id);
			$classifieds_member_extend = $member->classifiedsmemberextend->get();
			if($classifieds_member_extend->registration_completed == 'yes')
				$classifieds_member_extend->registration_completed = 'no';
			else
				$classifieds_member_extend->registration_completed = 'yes';
				$classifieds_member_extend->activation_token = '';
			$member->save_classifiedsmemberextend($classifieds_member_extend);

			redirect(base_url('admin/module/classifieds/members_list'), 'location');
		}

		public function edit_member($id)
		{
			$member = new ClassifiedsMember($id);
			if($_POST)
			{
				$member->username = $_POST['username'];
				$member->first_name = $_POST['first_name'];
				$member->last_name = $_POST['last_name'];
				$member->email = $_POST['email'];
				$member->save();

				$member_extend = $member->classifiedsmemberextend->get();
				$member_extend->telephone = $_POST['telephone'];
				$member_extend->country = $_POST['country'];
				$member_extend->state = $_POST['state'];
				$member_extend->city = $_POST['city'];
				$member_extend->address = $_POST['address'];
				$member->save_classifiedsmemberextend($member_extend);

				redirect(base_url('admin/module/classifieds/members_list'), 'location');
			}
			$data['member'] = $member;
			$data['title'] = 'Member';
			$data['current_page'] = 'classifieds';
			$data['current_child_page'] = 'Classifiedsmember';
			$this->load->view('backend/edit_member', $data);
		}

		public function toggle_active_ad($id)
		{
			$item = new ClassifiedsItem($id);
			if($item->ad_completed == 'yes')
				$item->ad_completed = 'no';
			else
			{
				$this->load->model('users');
				$item->activation_token = '';
				$item->ad_completed = 'yes';
				$usr = new User($item->posting_member_id);
				$subject = 'Your Ad '.$item->name.' has been approved !';
				$message = '<h2>Congratulations!</h2><br/><p>Your Ad '.$item->name.' has been approved.Its activated and you can see it here '.base_url('classifieds/view_item/'.$item->id);
				$this->users->send_custom_email_message($usr->email,$subject,$message);
			}
				
			$item->save();

			redirect(base_url('admin/module/classifieds/items_list'), 'location');
		}

		public function toggle_featured_ad($id)
		{
			$item = new ClassifiedsItem($id);
			if($item->featured == 'yes')
				$item->featured = 'no';
			else
			{
				$item->featured = 'yes';
			}
			$item->save();

			redirect(base_url('admin/module/classifieds/items_list'), 'location');
		}

		public function edit_item($id)
		{
			$item = new ClassifiedsItem($id);
			if($_POST)
			{
				$item->name = $_POST['name'];
				$item->category_id = $_POST['category_id'];
				$item->currency_id = $_POST['currency_id'];
				$item->price = $_POST['price'];
				$item->description = $_POST['description'];
				$item->phone = $_POST['phone'];
				$item->email = $_POST['email'];
				$item->email = $_POST['email'];
				$item->country = $_POST['country'];
				$item->state = $_POST['state'];
				$item->city = $_POST['city'];
				$item->address = $_POST['address'];
				$item->sold = $_POST['sold'];
				$item->save();

				redirect(base_url('admin/module/classifieds/items_list'), 'location');
			}
			$data['item'] = $item;
			$categories = new ClassifiedsCategory();
			$data['categories'] = $categories->get();
			$currencies = new Currency();
			$data['currencies'] = $currencies->get();
			$data['title'] = 'Item';
			$data['current_page'] = 'classifieds';
			$data['current_child_page'] = 'Classifiedsitem';
			$this->load->view('backend/edit_item', $data);
		}

		// [MenuItem ("Classifieds/Regions/Add")]
		public function add_region()
		{
			if($_POST)
			{
				$region = new ClassifiedsRegion();
				$region->name = $_POST['name'];
				$region->save();

				redirect(base_url('admin/module/classifieds/list_regions'), 'location');
			}
			$data['title'] = 'Region';
			$data['current_page'] = 'classifieds';
			$data['current_child_page'] = 'Classifiedsregion';
			$this->load->view('backend/add_region',$data);
		}

		public function edit_region($id)
		{
			$region = new ClassifiedsRegion($id);
			if($_POST)
			{
				$region->name = $_POST['name'];
				$region->save();

				redirect(base_url('admin/module/classifieds/list_regions'), 'location');
			}
			$data['region'] = $region;
			$data['title'] = 'Region';
			$data['current_page'] = 'classifieds';
			$data['current_child_page'] = 'Classifiedsregion';
			$this->load->view('backend/edit_region', $data);
		}

		// [MenuItem ("Classifieds/Regions/List")]
		public function list_regions()
		{
			$data['regions'] = new ClassifiedsRegion();
			$data['title'] = 'Region';
			$data['current_page'] = 'classifieds';
			$data['current_child_page'] = 'Classifiedsregion';
			$this->load->view('backend/list_regions', $data);
		}

		public function delete_region($id)
		{
			$region = new ClassifiedsRegion($id);
			$region->delete();
			redirect(base_url('admin/module/classifieds/list_regions'), 'location');
		}

		// [MenuItem ("Classifieds/Locations/Add")]
		public function add_location()
		{
			if($_POST)
			{
				$location = new ClassifiedsLocation();
				$location->name = $_POST['name'];
				$location->region_id = $_POST['region_id'];
				$location->save();

				redirect(base_url('admin/module/classifieds/list_locations'), 'location');
			}
			$data['regions'] = new ClassifiedsRegion();
			$data['title'] = 'Location';
			$data['current_page'] = 'classifieds';
			$data['current_child_page'] = 'Classifiedslocation';
			$this->load->view('backend/add_location', $data);
		}

		public function edit_location($id)
		{
			$location = new ClassifiedsLocation($id);
			if($_POST)
			{
				$location->name = $_POST['name'];
				$location->region_id = $_POST['region_id'];
				$location->save();

				redirect(base_url('admin/module/classifieds/list_locations'), 'location');
			}
			$data['regions'] = new ClassifiedsRegion();
			$data['location'] = $location;
			$data['title'] = 'Location';
			$data['current_page'] = 'classifieds';
			$data['current_child_page'] = 'Classifiedslocation';
			$this->load->view('backend/edit_location', $data);
		}

		// [MenuItem ("Classifieds/Locations/List")]
		public function list_locations()
		{
			$data['locations'] = new ClassifiedsLocation();
			$data['title'] = 'Locations';
			$data['current_page'] = 'classifieds';
			$data['current_child_page'] = 'Classifiedslocation';
			$this->load->view('backend/list_locations', $data);
		}

		public function delete_location($id)
		{
			$location = new ClassifiedsLocation($id);
			$location->delete();
			redirect(base_url('admin/module/classifieds/list_locations'), 'location');
		}

		// [MenuItem ("Classifieds/Frontend sections")]
		public function frontend_sections()
		{
			if($_POST)
			{	
				$this->BuilderEngine->set_option('be_classifieds_frontend_sections_subcategories', $_POST['subcategories']);
				$this->BuilderEngine->set_option('be_classifieds_frontend_sections_top_search', $_POST['top_search']);
				$this->BuilderEngine->set_option('be_classifieds_frontend_sections_header_search', $_POST['header_search']);
				$this->BuilderEngine->set_option('be_classifieds_frontend_sections_place_ad', $_POST['place_ad']);
			}
			$data['title'] = 'Frontend Settings';
			$data['current_page'] = 'classifieds';
			$data['current_child_page'] = 'settings';
			$this->load->view('backend/frontend_sections',$data);
		}

		// [MenuItem ("Classifieds/Website stats")]
		public function stats_page()
		{
			$data['title'] = 'Statistics';
			$data['current_page'] = 'classifieds';
			$data['current_child_page'] = 'stats';
			$this->load->view('backend/stats_page',$data);
		}

		// [MenuItem ("Classifieds/Invoice Settings")]
		public function invoice_settings() {
			if($_POST)
			{
				$this->BuilderEngine->set_option('be_classifieds_company_name', $_POST['name']);
				$this->BuilderEngine->set_option('be_classifieds_company_logo', $_POST['logo']);
				$this->BuilderEngine->set_option('be_classifieds_company_address', $_POST['address']);
				$this->BuilderEngine->set_option('be_classifieds_company_zip', $_POST['zip']);
				$this->BuilderEngine->set_option('be_classifieds_company_city', $_POST['city']);
				$this->BuilderEngine->set_option('be_classifieds_company_country', $_POST['country']);
				$this->BuilderEngine->set_option('be_classifieds_company_phone', $_POST['phone']);
				$this->BuilderEngine->set_option('be_classifieds_company_email', $_POST['email']);
				$this->BuilderEngine->set_option('be_classifieds_company_tax_vat_number', $_POST['tax_vat_number']);
				$this->BuilderEngine->set_option('be_classifieds_company_bank_account_number', $_POST['bank_account_number']);
				$this->BuilderEngine->set_option('be_classifieds_company_payment_option', $_POST['payment_option']);
				$this->BuilderEngine->set_option('be_classifieds_company_additional_info', $_POST['additional_info']);
			}
			$data['current_page'] = 'classifieds';
			$data['current_child_page'] = 'classifieds_invoice_settings';
			$this->load->view('backend/invoice_settings',$data);
		}

        // [MenuItem ("Classifieds/Reports/Ad Reports")]
        public function show_ad_reports()
        {
			$objects = new ClassifiedsAdReport();
			$data['objects'] = $objects->get();
			$data['title'] = 'Ad Reports';
			$data['current_page'] = 'classifieds';
			$data['current_child_page'] = 'ClassifiedsAdReport';
			$this->load->view('backend/list_ad_reports', $data);
        }
		
		public function delete_ad_report($id)
		{
			$id = intval($id);
			$comment = new ClassifiedsAdReport($id);
			$comment->delete();
			redirect($_SERVER['HTTP_REFERER']);
		}

		public function delete_comment($id)
		{
			$id = intval($id);
			$comment = new ClassifiedsReview($id);
			$comment->delete();
			redirect($_SERVER['HTTP_REFERER']);
		}

		public function delete_comment_report($id)
		{
			$id = intval($id);
			$comment = new ClassifiedsReviewReport($id);
			$comment->delete();
			redirect($_SERVER['HTTP_REFERER']);
		}

        // [MenuItem ("Classifieds/Reports/Comment Reports")]
        public function show_comment_reports()
        {
			$objects = new ClassifiedsReviewReport();
			$data['objects'] = $objects->get();
			$data['title'] = 'Ad Comment Reports';
			$data['current_page'] = 'classifieds';
			$data['current_child_page'] = 'ClassifiedsReviewReport';
			$this->load->view('backend/list_comment_reports', $data);
        }

		// [MenuItem ("Classifieds/Settings")]
		public function Settings()
		{
			if($_POST)
			{
				$protocol = strtolower(substr($_SERVER['SERVER_PROTOCOL'],0,strrpos($_SERVER['SERVER_PROTOCOL'],'/'))).'://';
				$link = $_POST['terms_conditions_url'];
				if(strpos($link,'http://') !== false || strpos($link,'https://') !== false/*strpos($link, $protocol) !== false*/) {
					$this->BuilderEngine->set_option('be_classifieds_settings_url', $link);
				} else {
					$this->BuilderEngine->set_option('be_classifieds_settings_url', $protocol.$link);
				}
				$this->BuilderEngine->set_option('classifieds_active', $_POST['classifieds_active']);
				$this->BuilderEngine->set_option('be_classifieds_buy_now', $_POST['buy_now']);
				$this->BuilderEngine->set_option('be_classifieds_admin_ad_approval', $_POST['admin_ad_approval']);
				$this->BuilderEngine->set_option('be_classifieds_admin_email', $_POST['admin_email']);
				$this->BuilderEngine->set_option('be_classifieds_products_per_page', $_POST['products_per_page']);
				$this->BuilderEngine->set_option('be_classifieds_default_currency', $_POST['classifieds_default_currency']);
				$this->BuilderEngine->set_option('be_classifieds_payment_methods', $_POST['payment_methods']);
				$this->BuilderEngine->set_option('be_classifieds_access_groups', $this->input->post('access_groups', true));
				$this->BuilderEngine->set_option('be_classifieds_create_ads_groups', $this->input->post('create_ads_groups', true));
				$this->BuilderEngine->set_option('be_classifieds_shop_groups', $this->input->post('shop_groups', true));
				//$this->BuilderEngine->set_option('be_classifieds_popular_items_count', $_POST['popular_products_count']);
				//$this->BuilderEngine->set_option('be_classifieds_recent_items_count', $_POST['recent_products_count']);
			}
			$currencies = new Currency();
			$data['currencies'] = $currencies->get();
			$data['title'] = 'Settings';
			$data['default_currency'] = $this->BuilderEngine->get_option('be_classifieds_default_currency');
			$data['current_page'] = 'classifieds';
			$data['current_child_page'] = 'settings';
			$this->load->view('backend/settings',$data);
		}
	}
?>