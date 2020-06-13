<?
	function initialize_classifieds_js()
	{
		$CI = &get_instance();
		$subcategories_section = $CI->BuilderEngine->get_option('be_classifieds_frontend_sections_subcategories');
		$top_search_section = $CI->BuilderEngine->get_option('be_classifieds_frontend_sections_top_search');
		$header_search_section = $CI->BuilderEngine->get_option('be_classifieds_frontend_sections_header_search');
		$place_ad_section = $CI->BuilderEngine->get_option('be_classifieds_frontend_sections_place_ad');

		echo '
			<script>
			$(document).ready(function(){
				var one = "'.$subcategories_section.'";
				var two = "'.$top_search_section.'";
				var three = "'.$header_search_section.'";
				var four = "'.$place_ad_section.'";
				if(one == \'hidden\')
				{
					$(\'#subcategories-section\').remove();
				}
				if(two == \'hidden\')
				{
					$(\'#top-search-section\').remove();
				}
				if(three == \'hidden\')
				{
					$(\'.header-search-section\').remove();
				}
				if(four == \'hidden\')
				{
					$(\'.place-ad-section\').remove();
				}
				$(\'#regionsBtn\').click(function(){
					$(\'#regionsModal\').toggle();
				});
			}); 
			</script>
			<!-- Bootstrap core JavaScript
			================================================== -->
			<!-- Placed at the end of the document so the pages load faster -->
			<script src="'.base_url().'modules/classifieds/assets/js/jquery.flot.js"></script>

			<!-- Add fancyBox main JS and CSS files -->
			<script type="text/javascript" src="'.base_url().'modules/classifieds/assets/js/fancybox/jquery.fancybox.js"></script>
			<script type="text/javascript" src="'.base_url().'modules/classifieds/assets/js/fancybox/helpers/jquery.fancybox-buttons.js"></script>
			<script type="text/javascript" src="'.base_url().'modules/classifieds/assets/js/fancybox/helpers/jquery.fancybox-media.js"></script>
			<script type="text/javascript" src="'.base_url().'modules/classifieds/assets/js/global.js"></script>
		';
	}
	add_action("be_foot", "initialize_classifieds_js");

	class Classifieds extends Module_Controller
	{
		private $conditions = array("damaged","preserved","good","very good","excellent");

		private function conditions_at_least($condition)
		{
			foreach($this->conditions as $key => $value)
			{
				if($value == $condition){
					$result = array();
					for($i = $key; $i < count($this->conditions); $i++)
					{
						array_push($result, $this->conditions[$i]);
					}
					return $result;
				}
			}
		}
		public function view_item($id)
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			if(!isset($id))
				show_404();
			$member = new User($this->user->get_id());

			$all_items = new ClassifiedsItem();
			$all_items -> where('sold', 'no');
			$data['all_items'] = $all_items->get();

			$item = new ClassifiedsItem($id);
			if(empty($item->id) || $item->sold == 'yes')
				show_404();

			$data['sold'] = '';
			if($item->sold == 'yes')
				$data['sold'] = 'yes';
			if($item->ad_completed != 'yes')
				redirect(base_url('classifieds/awaiting_approval'), 'location');

			$item->views += 1;
			$item->save();

			$data['item'] = $item;
			$data['item_category'] = $item->category->get();

			$parent_category = new ClassifiedsCategory();
			$parent_category->where('id', $data['item_category']->parent)->get();
			if($parent_category->exists())
			{
				$data['parent_category'] = $parent_category;
				$parent_parent = new ClassifiedsCategory();
				$parent_parent->where('id', $parent_category->parent)->get();
				if($parent_parent->exists())
				{
					$data['parent_parent'] = $parent_parent;
				}
			}
			/*
			if($_POST)
			{
				$review = new ClassifiedsReview();
				if($this->user->is_guest())
				{
					$review->user = $_POST['user'];
				}
				else
				{
					$review->user = $member->username;
					$review->user_id = $member->id;
				}
				$review->item_id = $id;
				$review->content = $_POST['content'];
				$review->date = date('d/m/Y');
				$review->save();
			}
			*/
			$data['member'] = $member;

			$currency = new Currency($item->currency_id);
			$data['item']->currency = $currency;
			$data['currency'] = $currency;

			$reviews = new ClassifiedsReview();
			$data['reviews'] = $reviews->where('item_id', $id)->get();

			$sections = new ClassifiedsCategory();
			$data['sections'] = $sections->where('parent', 0)->get();
			
			$categories = new ClassifiedsCategory();
			$data['categories'] = $categories->get();
			$this->load->view('frontend/view_item.tpl', $data);
		}

		public function view_category($id)
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();
			if(!isset($id))
				show_404();

			$member = new User($this->user->get_id());

			$category = new ClassifiedsCategory($id);
			$data['category'] = $category;

			$parent_category = new ClassifiedsCategory();
			$parent_category = $parent_category->where('id', $data['category']->parent)->get();
			if($parent_category->exists())
			{
				$parent_parent = new ClassifiedsCategory();
				$parent_parent = $parent_parent->where('id', $parent_category->parent)->get();
				$data['parent_category'] = $parent_category;

				if($parent_parent->exists())
				{	
					$data['parent_parent'] = $parent_parent;
				}
			}

			$child_categories = new ClassifiedsCategory();
			$child_categories = $child_categories->where('parent', $data['category']->id)->get();
			$all_items = new ClassifiedsItem();
			$i = 1;
			$n = 1;
			foreach($child_categories as $child_category)
			{
				if($child_category->exists())
				{
					$child_children = new ClassifiedsCategory();
					$child_children = $child_children->where('parent', $child_category->id)->get();
					foreach ($child_children as $child_child)
					{
						if($child_child->exists())
						{	
							if($i == 1)
							{
								$all_items->where('category_id', $child_child->id);
							}
							else
								$all_items->or_where('category_id', $child_child->id);

							$i++;
						}
						
					}

					if($i == 1)
						$all_items->where('category_id', $child_category->id);
					else
						$all_items->or_where('category_id', $child_category->id);

					$i++;
				}
				$n++;
			}

			if($n <= 1)
				$data['items'] = $data['category']->item->where('sold', 'no')->where('ad_completed', 'yes');
			else
			{
				$data['items'] = $all_items->where('sold', 'no')->where('ad_completed', 'yes');
			}
			//$data['items'] = $data['category']->item->where('sold', 'no')->where('ad_completed', 'yes')->get();
			$data['page'] = 'category';
			$items_per_page = $this->BuilderEngine->get_option('be_classifieds_products_per_page');
			if(!$items_per_page)
				$this->BuilderEngine->set_option('be_classifieds_products_per_page', 9);

			if($id == "All")
			{
				$items = new ClassifiedsItem();
				$data['items'] = $items->where('sold', 'no')->where('ad_completed', 'yes')->get();
			}
			$count = 0;
			foreach ($data['items'] as $item)
			{
				$count++;
			}
			$number_of_items = $count;
			$total_pages = ceil($number_of_items / $items_per_page);
			$data['total_pages'] = $total_pages;

			if(isset($_GET['page']))
				$data['page'] = $_GET['page'];
			else
				$data['page'] = 1;

			$data['member'] = $member;

			if($id == "All"){
				$data['query_category'] = "All";
				$items = new ClassifiedsItem();
				$items = $items->where('sold', 'no')->where('ad_completed', 'yes');
			}else{
				$category = new ClassifiedsCategory($id);
				if(empty($data['category']->id))
					show_404();

				$items = $data['category']->item->where('sold', 'no');
				$items = $data['category']->item->where('ad_completed', 'yes');
				$data['query_category'] = $data['category']->id;
			}

			if(isset($_GET['order']))
			{
				$this->user->set_session_data('be_ecommerce_sort_by', $_GET['order']);
			}
			if(isset($_GET['min_price']))
			{
				$this->user->set_session_data('be_ecommerce_min_price', $_GET['min_price']);
			}
			if(isset($_GET['max_price']))
			{
				$this->user->set_session_data('be_ecommerce_max_price', $_GET['max_price']);
			}
			if(isset($_GET['filter']))
			{
				$this->user->set_session_data('be_ecommerce_filter', $_GET['filter']);
			}

			$session_order = $this->user->get_session_data('be_ecommerce_sort_by');
			$session_min_price = $this->user->get_session_data('be_ecommerce_min_price');
			$session_max_price = $this->user->get_session_data('be_ecommerce_max_price');
			$session_filter = $this->user->get_session_data('be_ecommerce_filter');

			if($session_filter == "featured")
			{
				$data['items']->where('featured', 'yes');
			}
			if($session_filter == "only_picture")
			{
				$data['items']->where('img !=', '');
			}

			if($session_min_price != "")
			{
				$data['items']->where('price >=', $session_min_price);
			}
			if($session_max_price != "")
			{
				$data['items']->where('price <=', $session_max_price);
			}

			if($session_order == "1")
			{
				$data['items']->order_by('name', 'ASC');
			}
			if($session_order == "2")
			{
				$data['items']->order_by('name', 'DESC');
			}
			if($session_order == "3")
			{
				$data['items']->order_by('ABS(price)', 'ASC');
			}	
			if($session_order == "4")
			{
				$data['items']->order_by('ABS(price)', 'DESC');
			}

			$data['items'] = $data['items']->get_paged($data['page'], $items_per_page);
			$data['total_pages'] = $data['items']->paged->total_pages;

			$recent_items = new ClassifiedsItem();
			$recent_items->where('sold', 'no');
			$recent_items->where('ad_completed', 'yes');
			$recent_items->limit($this->BuilderEngine->get_option('be_classifieds_recent_items_count'));
			$data['recent_items'] = $recent_items;

			$featured_items = new ClassifiedsItem();
			$data['featured_items'] = $featured_items->where('sold', 'no')->get();
			$data['featured_items'] = $featured_items->where('ad_completed', 'yes')->get();

			$currencies = new Currency();
			$data['currencies'] = $currencies->get();

			$categories = new ClassifiedsCategory();
			$data['categories'] = $categories->get();

			$current_category = new ClassifiedsCategory($id);
			$data['current_category'] = $current_category;

			$sections = new ClassifiedsCategory();
			$data['sections'] = $sections->where('parent', 0)->get();

			if($id == "All" || $id == 'all')
				$this->load->view('frontend/view_all_categories.tpl', $data);
			else
				$this->load->view('frontend/view_category.tpl', $data);
		}

		public function login()
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			$this->load->model('users');
			//$this->load->model('member');


			if($_POST)
			{
				$userid = $this->users->verify_login($_POST['username'], $_POST['password']);

				if($userid != 0)
				{	
					$this->user->initialize($userid);

					redirect(base_url('classifieds/view_category/All'), 'location');
				}
				else
					$data['error_msg'] = 'invalid username or password';
			}

			$this->load->view('frontend/login');
		}

		public function logout()
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			$this->user->logout('classifieds/login');
		}

		public function register()
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			$this->load->model('users');
			//$this->load->model('member');

			if($_POST)
			{
				$data['name'] = $_POST['name'];
				$data['username'] = $_POST['username'];
				$data['password'] = $_POST['password'];
				$data['email'] = $_POST['email'];

				$user_id = $this->users->register_user($data);

				if($user_id)
				{
					$activation_token = md5(time());

					$new_member = new ClassifiedsMemberExtend();
					$new_member->member_id = $user_id;
					$new_member->activation_token = $activation_token;
					$new_member->save();

					$to = $_POST['email'];
					$title = "Account Activation Successful";
					$content = "Hello ".$_POST['name']." and thank you for joining as a member! \n \n In order to activate your account please follow this link: ".base_url('/classifieds/activate_account/'.$activation_token);

					mail($to,$title,$content);

					redirect(base_url('classifieds/email_sent'), 'location');
				}
				else
					echo 'account creation failed';
			}
			
			$this->load->view('frontend/register');
		}

		public function email_sent()
		{
			$this->load->view('frontend/email_sent');
		}
		public function my_watchlist()
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			if($this->user->is_guest())
				redirect(base_url('classifieds/login'), 'location');

			$user = new User($this->user->get_id());
			$user_extend = $user->extended->get();
			//if($user_extend->registration_completed != 'yes')
			//	redirect(base_url('classifieds/not_authenticated'), 'location');

			//$this->load->model('member');
			//$this->load->model('item');

			$member = new User($this->user->get_id());

			if(isset($_GET['delete_item_id']))
			{
				$item_id = $_GET['delete_item_id'];

				$item = new ClassifiedsItem($item_id);
				$member->delete_watchlist($item);

				redirect(base_url('classifieds/my_watchlist'), 'location');
			}
			
			$data['current_page'] = 'Watched items';
			$data['member'] = $member;
			$data['watchlist'] = $data['member']->watchlist->get();
			$categories = new ClassifiedsCategory();
			$data['categories'] = $categories;
			$this->load->view('frontend/watchlist', $data);
		}

		public function add_to_watchlist($id)
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			if($this->user->is_guest())
				redirect(base_url('classifieds/login'), 'location');

			//$this->load->model('member');
			//$this->load->model('item');

			$member = new User($this->user->get_id());

			$item = new ClassifiedsItem($id);
			$member->save_watchlist($item);

			redirect(base_url('classifieds/view_item/'.$id), 'location');
		}

		public function placed_ads()
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			if($this->user->is_guest())
				redirect(base_url('classifieds/login'), 'location');

			$user = new User($this->user->get_id());
			$user_extend = $user->extended->get();
			//if($user_extend->registration_completed != 'yes')
			//	redirect(base_url('classifieds/not_authenticated'), 'location');

			//$this->load->model('member');
			//$this->load->model('item');

			$member = new User($this->user->get_id());

			if(isset($_GET['delete_request_id']))
			{
				$item_id = $_GET['delete_request_id'];

				$item = new ClassifiedsItem($item_id);

				$to = $user->email;
				$subject = 'Ad Deletion in Classifieds';
				$content = " An Ad deletion request has been created for ".$item->name." .";
				$content .= "\n \n To view the Ad in question follow this link: ".base_url('/classifieds/view_item/'.$item->id);
				$content .= "\n \n To permanently delete this Ad follow this link: ".base_url('/classifieds/placed_ads?delete_item_id='.$item->id);
				mail($to, $subject, $content);

				redirect(base_url('classifieds/placed_ads'), 'location');
			}

			if(isset($_GET['delete_item_id']))
			{
				$item_id = $_GET['delete_item_id'];

				$item = new ClassifiedsItem($item_id);
				$item->delete();

				redirect(base_url('classifieds/placed_ads'), 'location');
			}

			if(isset($_GET['sold_item_id']))
			{
				$item_id = $_GET['sold_item_id'];

				$item = new ClassifiedsItem($item_id);
				$item->sold = 'yes';
				$item->time_of_sell = time();
				$item->save();

				redirect(base_url('classifieds/placed_ads'), 'location');
			}

			$data['current_page'] = 'Placed Ads';
			$data['member'] = $member;
			$categories = new ClassifiedsCategory();
			$data['categories'] = $categories;

			$this->load->view('frontend/placed_ads', $data);
		}

		public function choose_item_category()
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			if($this->user->is_guest())
				redirect(base_url('classifieds/login'), 'location');

			$user = new User($this->user->get_id());
			$user_extend = $user->extended->get();
			//if($user_extend->registration_completed != 'yes')
			//	redirect(base_url('classifieds/not_authenticated'), 'location');

			$categories = new ClassifiedsCategory();
			$currencies = new Currency();

			$data['all_categories'] = $categories->get();
			$data['member_extend'] = $user_extend;
			$data['currencies'] = $currencies->get();
			$data['member'] = $user;
			$this->load->view('frontend/choose_item_category', $data);
		}

		public function create_item()
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			if($this->user->is_guest())
				redirect(base_url('classifieds/login'), 'location');
			
			$user = new User($this->user->get_id());
			$user_extend = $user->extended->get();
			//if($user_extend->registration_completed != 'yes')
			//	redirect(base_url('classifieds/not_authenticated'), 'location');

			$member = new User($this->user->get_id());
			$member_extend = $member->extended->get();
			$error = false;

			if($_POST)
			{
				$created_item = new ClassifiedsItem();
				$created_item->posting_member_id = $member->id;
				$created_item->category_id = $_POST['category_id'];
				$created_item->currency_id = $this->BuilderEngine->get_option('be_classifieds_default_currency');
				$created_item->name = $_POST['name'];
				$created_item->region = $_POST['region'];
				$created_item->location = $_POST['location'];
				$created_item->address = $_POST['address'];
				if(is_numeric($_POST['price']) == true)
					$created_item->price = $_POST['price'];
				else
				{
					$data['price_error'] = 'Price can only be a number';
					$error = true;
				}

				$created_item->description = $_POST['description'];
				$created_item->country = $_POST['country'];
				$created_item->city = $_POST['city'];
				$created_item->phone = $_POST['phone'];
				$created_item->email = $_POST['email'];
				$created_item->time_of_creation = $_POST['time_of_creation'];
				$created_item->member_id = $this->user->get_id();

				if($this->BuilderEngine->get_option('be_classifieds_admin_ad_approval') != 'yes'){
					$activation_token = md5(time());
					$created_item->activation_token = $activation_token;
				}else{
					$created_item->activation_token = '';
					$created_item->ad_completed = 'no';
				}
				
				if($error == false)
					$created_item->save();
				
				if($error == false)
				{
					$created_item->save();
					if(isset($_POST['files'])){
						$i = 1;
						foreach($_POST['files'] as $file)
						{ 
							if($i == 1){
								$created_item->img = base_url('files/users/user_'.$this->user->get_id().'/classifieds/images/'.$file);
								$created_item->save();
							}
							$image = new ClassifiedsImage();
							$image->image = base_url('files/users/user_'.$this->user->get_id().'/classifieds/images/'.$file);
							$image->item_id = $created_item->id;
							$image->save();
							$i++;
						}
					}else{
						$created_item->img = base_url('files/be_demo/classifieds/images/photo_placeholder.png');
						$created_item->save();
					}

					if($this->BuilderEngine->get_option('be_classifieds_admin_ad_approval') != 'yes'){
						$to = $_POST['email'];
						$title = "New Classified Ad Creation";
						$content = "Hello ".$member->name."! In order to Publish Live your new Ad please follow this link to confirm: ".base_url('/classifieds/activate_ad/'.$activation_token);

						mail($to,$title,$content);
						redirect(base_url('classifieds/ad_activation_sent'), 'location');
					}else{
						$this->load->model('users');
						$subject = 'New Classified Ad Created on '.base_url();
						$message = '<h2>A New Classified Ad has been created !</h2><br/>Please, Log In and Approve or Deny this Ad <a href="'.base_url('admin/main/login').'">Here</a>.';

						if(!empty($this->BuilderEngine->get_option('be_classifieds_admin_email')))
							mail($this->BuilderEngine->get_option('be_classifieds_admin_email'),$subject,$message);
						else
							if(!empty($this->BuilderEngine->get_option('adminemail')))
								$this->users->notify_admin($subject,$message);
						redirect(base_url('classifieds/awaiting_approval'), 'location');
					}
				}
			}
			$currencies = new Currency();
			$makes = new ClassifiedsMake();
			$models = new ClassifiedsModel();

			$data['current_page'] = 'Create Ad';
			$data['makes'] = $makes->get();
			$data['models'] = $models->get();
			//$data['selected_category'] = $category;
			$data['member_extend'] = $member_extend;
			$data['currencies'] = $currencies->get();
			$data['member'] = $member;
			$this->load->view('frontend/create_item', $data);
		}

		public function awaiting_approval()
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			$this->load->view('frontend/awaiting_approval');
		}

		public function not_authenticated()
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			$this->load->view('frontend/not_authenticated');
		}

		public function ad_activation_sent()
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			$this->load->view('frontend/ad_activation_sent');
		}

		public function edit_item($id)
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			if(!isset($id))
				show_404();

			if($this->user->is_guest())
				redirect(base_url('classifieds/login'), 'location');

			$item = new ClassifiedsItem($id);
			if($this->user->get_id() != $item->posting_member_id)
				redirect(base_url('classifieds/profile/'.$this->user->get_id()), 'location');

			$this->load->model('classifiedsfiles');

			$member = new User($this->user->get_id());
			$member_extend = $member->extended->get();

			if($_POST)
			{
				$images = $item->image->get();
				$images->delete_all();
				$created_item = new ClassifiedsItem($id);
				$created_item->posting_member_id = $member->id;
				//$created_item->currency_id = $this->BuilderEngine->get_option('be_classifieds_default_currency');
				$created_item->name = $_POST['name'];
				$created_item->price = $_POST['price'];

					if(isset($_POST['files'])){
						$i = 1;
						foreach($_POST['files'] as $file){
							if($i == 1){
								$created_item->img = base_url('files/users/user_'.$this->user->get_id().'/classifieds/images/'.$file);
							}
							$image = new ClassifiedsImage();
							$image->image = base_url('files/users/user_'.$this->user->get_id().'/classifieds/images/'.$file);
							$image->item_id = $created_item->id;
							$image->save();
							$i++;
						}
					}else
						$created_item->img = base_url('builderengine/public/img/photo_placeholder.png');

				$created_item->category_id = $_POST['category_id'];
				$created_item->description = $_POST['description'];
				$created_item->region = $_POST['region'];
				$created_item->location = $_POST['location'];
				$created_item->address = $_POST['address'];
				$created_item->phone = $_POST['phone'];
				$created_item->email = $_POST['email'];
				$created_item->time_of_creation = $_POST['time_of_creation'];
				$created_item->condition = $_POST['condition'];
				$created_item->city = $_POST['city'];
				$created_item->seller_type = $_POST['seller_type'];
				$created_item->save();

				redirect(base_url('classifieds/placed_ads'), 'location');
			}
			
			$currencies = new Currency();
			$categories = new ClassifiedsCategory();
			$data['categories'] = $categories->get();
			$item = new ClassifiedsItem($id);

			$item_extended = new ClassifiedsExtendedItem();
			$item_extended = $item_extended->where('item_id', $item->id)->get();

			$model = new ClassifiedsModel();
			$model = $model->where('name', $item_extended->model)->get();
			$data['model_default_id'] = $model->id;

			$makes = new ClassifiedsMake();
			$data['current_page'] = 'Edit item';
			$data['makes'] = $makes->get();
			$data['item'] = $item;
			$data['member_extend'] = $member_extend;
			$data['currencies'] = $currencies->get();
			$data['member'] = $member;
			$this->load->view('frontend/edit_item', $data);
		}

		public function profile($id)
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			$this->load->model('member');
			$this->load->model('classifiedsmemberextend');
			//$this->load->model('item');
			//$this->load->model('currency');
			if($id == $this->user->get_id())
			{
				$member = new User($this->user->get_id());
			}
			elseif ($this->user->is_guest())
			{
				$member = new User($id);
			}
			else
			{
				$visitor = new User($this->user->get_id());
				$data['visitor'] = $visitor;
				$member = new User($id);
			}

			$data['member_extend'] = $member->extended->get();
			$data['member'] = $member;
			$data['current_page'] = 'Profile';
			$categories = new ClassifiedsCategory();
			$data['categories'] = $categories;
			$this->load->view('frontend/profile', $data);
		}
		/*
		public function edit_profile()
		{
			if($this->user->is_guest())
				redirect(base_url('classifieds/login'), 'location');

			$user = new ClassifiedsMember($this->user->get_id());
			$user_extend = $user->classifiedsmemberextend->get();
			if($user_extend->registration_completed != 'yes')
				redirect(base_url('classifieds/not_authenticated'), 'location');

			//$this->load->model('member');
			//$this->load->model('classifiedsmemberextend');
			//$this->load->model('item');
			//$this->load->model('currency');
			$this->load->model('classifiedsfiles');

			$member = new ClassifiedsMember($this->user->get_id());
			$member_extend = $member->classifiedsmemberextend->get();
			$currency = new Currency();
			
			if ($_POST) 
			{
				$member->first_name = $_POST['first_name'];
				$member->last_name = $_POST['last_name'];
				$member->email = $_POST['email'];
				$member->save(); 

				if(isset($_FILES['avatar']) && $_FILES['avatar']['name'] != '')
				{
					$avatar = $this->classifiedsfiles->upload_avatar('avatar', $member->username);
					$member_extend->avatar = $avatar;
				}
				
				$member_extend->telephone = $_POST['telephone'];
				$member_extend->state = $_POST['state'];
				$member_extend->country = $_POST['country'];
				$member_extend->city = $_POST['city'];
				$member_extend->address = $_POST['address'];
				$member_extend->post_code = $_POST['post_code'];
				$member_extend->member_id = $member->id;
				$member_extend->save();

				redirect(base_url('classifieds/profile/'.$member->id));
			}
			$data['current_page'] = 'Edit profile';
			$data['member_extend'] = $member_extend;
			$data['member'] = $member;
			$data['currencies'] = $currency->get();
			$categories = new ClassifiedsCategory();
			$data['categories'] = $categories;

			$this->load->view('frontend/edit_profile', $data);
		}
		*/
		public function followed_users()
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			if($this->user->is_guest())
				redirect(base_url('classifieds/login'), 'location');

			$user = new User($this->user->get_id());
			$user_extend = $user->extended->get();
			//if($user_extend->registration_completed != 'yes')
			//	redirect(base_url('classifieds/not_authenticated'), 'location');

			//$this->load->model('member');
			//$this->load->model('item');

			$member = new User($this->user->get_id());
			$following = new ClassifiedsFollowing();
			$following->where('following_user', $this->user->get_id());

			if(isset($_GET['delete_followed_id']))
			{
				$followed_user_id = $_GET['delete_followed_id'];

				$following = new ClassifiedsFollowing();
				$following->where('followed_user', $followed_user_id);
				$following->get();
				$following->delete();

				redirect(base_url('classifieds/followed_users'), 'location');
			}

			$data['current_page'] = 'Followed users';
			$data['member'] = $member;
			$data['following'] = $following->get();
			$categories = new ClassifiedsCategory();
			$data['categories'] = $categories;

			$this->load->view('frontend/followed_users', $data);
		}

		public function follow_owner($id)
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			if(!isset($id))
				show_404();

			if($this->user->is_guest())
				redirect(base_url('classifieds/login'), 'location');

			//$this->load->model('member');
			//$this->load->model('item');

			$member = new User($this->user->get_id());

			$item = new ClassifiedsItem($id);
			$followed_user = $item->posting_member->get();

			if ($member->id == $followed_user->id)
				redirect(base_url('classifieds/view_item/'.$id), 'location');

			$following = new ClassifiedsFollowing();
			$following->followed_user = $followed_user->id;
			$following->following_user = $member->id;
			$following->save();

			redirect(base_url('classifieds/view_item/'.$id), 'location');
		}

		public function follow_user($id)
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			if(!isset($id))
				show_404();

			if($this->user->is_guest())
				redirect(base_url('classifieds/login'), 'location');

			//$this->load->model('member');
			//$this->load->model('item');

			$member = new User($this->user->get_id());
			$followed_user = new Member($id);

			if ($member->id == $followed_user->id)
				redirect(base_url('classifieds/profile/'.$id), 'location');

			$following = new ClassifiedsFollowing();
			$following->followed_user = $followed_user->id;
			$following->following_user = $member->id;
			$following->save();

			redirect(base_url('classifieds/profile/'.$id), 'location');
		}

		public function users_following_me()
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			if($this->user->is_guest())
				redirect(base_url('classifieds/login'), 'location');

			$user = new User($this->user->get_id());
			$user_extend = $user->extended->get();
			//if($user_extend->registration_completed != 'yes')
			//	redirect(base_url('classifieds/not_authenticated'), 'location');

			//$this->load->model('member');
			//$this->load->model('item');

			$member = new User($this->user->get_id());
			$following = new ClassifiedsFollowing();
			$following->where('followed_user', $this->user->get_id());

			$data['member'] = $member;
			$data['following'] = $following->get();

			$this->load->view('frontend/users_following_me', $data);
		}

		public function send_message()
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			if($this->user->is_guest())
				redirect(base_url('classifieds/login'), 'location');

			$user = new User($this->user->get_id());
			$user_extend = $user->extended->get();
			//if($user_extend->registration_completed != 'yes')
			//	redirect(base_url('classifieds/not_authenticated'), 'location');

			$member = new User($this->user->get_id());

			if($_POST)
			{
				$user = new User();
				if(isset($_GET['username']))
					$to = $user->where('username', $_GET['username'])->get();
				else
					$to = $user->where('username', $_POST['username'])->get();

				$message = new ClassifiedsMessage();
				$message->from = $member->id;
				$message->to = $to->id;
				$message->content = $_POST['content'];
				$message->time_of_creation = date('H:i:s d/m/Y');

				if(isset($_GET['item']) && $_GET['item'] != '0' && $_GET['item'] != '')
					$message->linked_product_id = $_GET['item'];
				
				$message->save();
				redirect(base_url('classifieds/inbox'),'location');
			}

			if($_GET && isset($_GET['username']))
			{
				$data['username'] = $_GET['username'];
			}

			$data['member'] = $member;
			$data['current_page'] = 'Send Message';
			$categories = new ClassifiedsCategory();
			$data['categories'] = $categories;
			$this->load->view('frontend/send_message', $data);
		}

		public function inbox()
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			if($this->user->is_guest())
				redirect(base_url('classifieds/login'), 'location');

			$user = new User($this->user->get_id());
			$user_extend = $user->extended->get();
			//if($user_extend->registration_completed != 'yes')
			//	redirect(base_url('classifieds/not_authenticated'), 'location');

			$member = new User($this->user->get_id());
			$member_extend = $member->extended->get();
			$message = new ClassifiedsMessage();
			$message->where('to', $member->id);

			$messages = $message->get();
			$data['all_messages'] = $messages;

			foreach ($messages as $message)
			{
				$message->viewed = 'yes';
				$message->save();
			}

			$data['current_page'] = 'Inbox';
			$data['member'] = $member;
			$data['member_extend'] = $member_extend;
			$categories = new ClassifiedsCategory();
			$data['categories'] = $categories;

			$this->load->view('frontend/inbox', $data);
		}

		public function delete_message($id)
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			if($this->user->is_guest())
				redirect(base_url('classifieds/login'), 'location');

			$message = new ClassifiedsMessage($id);
			$message->delete();
			redirect(base_url('classifieds/inbox'));

			$this->load->view('frontend/inbox', $data);
		}

		public function search()
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			//$this->load->model('item');
			//$this->load->model('category');

			$data['items'] = new ClassifiedsItem();
			if($_POST)
			{
				redirect('classifieds/search?keyword='.$_POST['keyword'], 'location');
			}

			$items_per_page = $this->BuilderEngine->get_option('be_classifieds_products_per_page');
			if(!$items_per_page){
				$this->BuilderEngine->set_option('be_classifieds_products_per_page', 9);
				$items_per_page = 9;
			}

			if(isset($_GET['page']))
				$page = $_GET['page'];
			else
				$page = 1;

			$data['page'] = $page;

			if(isset($_GET['order']))
			{
				$this->user->set_session_data('be_ecommerce_sort_by', $_GET['order']);
			}
			if(isset($_GET['region']))
			{
				$this->user->set_session_data('be_ecommerce_region', $_GET['region']);
			}
			if(isset($_GET['location']))
			{
				$this->user->set_session_data('be_ecommerce_location', $_GET['location']);
			}
			if(isset($_GET['min_price']))
			{
				$this->user->set_session_data('be_ecommerce_min_price', $_GET['min_price']);
			}
			if(isset($_GET['max_price']))
			{
				$this->user->set_session_data('be_ecommerce_max_price', $_GET['max_price']);
			}
			if(isset($_GET['filter']))
			{
				$this->user->set_session_data('be_ecommerce_filter', $_GET['filter']);
			}
			if(isset($_GET['keyword']))
			{
				$this->user->set_session_data('be_ecommerce_keyword', $_GET['keyword']);
			}
			if(isset($_GET['category_id']))
			{
				$this->user->set_session_data('be_ecommerce_category_id', $_GET['category_id']);
			}

			$session_category_id = $this->user->get_session_data('be_ecommerce_category_id');
			$session_region = $this->user->get_session_data('be_ecommerce_region');
			$session_location = $this->user->get_session_data('be_ecommerce_location');
			$session_order = $this->user->get_session_data('be_ecommerce_sort_by');
			$session_min_price = $this->user->get_session_data('be_ecommerce_min_price');
			$session_max_price = $this->user->get_session_data('be_ecommerce_max_price');
			$session_filter = $this->user->get_session_data('be_ecommerce_filter');
			$session_keyword = $this->user->get_session_data('be_ecommerce_keyword');

			if($session_category_id != "" && $session_category_id != 'Choose Category')
			{
				$child_categories = new ClassifiedsCategory();
				$child_categories = $child_categories->where('parent', $session_category_id)->get();
				$i = 1;
				$n = 1;
				if($child_categories->exists())
				{
					foreach($child_categories as $child_category)
					{
						if($child_category->exists())
						{
							$child_children = new ClassifiedsCategory();
							$child_children = $child_children->where('parent', $child_category->id)->get();
							foreach ($child_children as $child_child)
							{
								if($child_child->exists())
								{	
									if($i == 1)
									{
										$data['items']->where('category_id', $child_child->id);
									}
									else
										$data['items']->or_where('category_id', $child_child->id);

									$i++;
								}
							}

							if($i == 1)
								$data['items']->where('category_id', $child_category->id);
							else
								$data['items']->or_where('category_id', $child_category->id);

							$i++;
						}
						$n++;
					}
				}
				else
					$data['items']->where('category_id', $session_category_id);
			}
			if($session_min_price != "")
			{
				$data['items']->where('price >=', $session_min_price);
			}
			if($session_max_price != "")
			{
				$data['items']->where('price <=', $session_max_price);
			}
			if($session_region != "" && $session_region != 'Choose Region')
			{
				$data['items']->where('region', $session_region);
			}
			if($session_location != "" && $session_location != 'Choose Location')
			{
				$data['items']->where('location', $session_location);
			}
			if($session_keyword != "")
			{
				//$data['items']->like('name', $session_keyword);
				//$data['items']->or_like('description', $session_keyword);
				$itm = new ClassifiedsItem();
				$ids = $itm->get_like_name_or_description($session_keyword);//print_r($ids);exit;
				if(!empty($ids))
					$data['items']->where_in('id',$ids);
				$data['keyword'] = $session_keyword;
			}

			if($session_order == "1")
			{
				$data['items']->order_by('name', 'ASC');
			}
			if($session_order == "2")
			{
				$data['items']->order_by('name', 'DESC');
			}
			if($session_order == "3")
			{
				$data['items']->order_by('ABS(price)', 'ASC');
			}	
			if($session_order == "4")
			{
				$data['items']->order_by('ABS(price)', 'DESC');
			}

			$data['items'] = $data['items']->where('sold', 'no')->where('ad_completed', 'yes')->get_paged($page, $items_per_page);

			$category = new ClassifiedsCategory();
			$data['all_categories'] = $category->get();

			$recent_items = new ClassifiedsItem();
			$recent_items->limit($this->BuilderEngine->get_option('be_classifieds_recent_items_count'));
			$data['recent_items'] = $recent_items->where('sold', 'no')->where('ad_completed', 'yes')->get();

			$sections = new ClassifiedsCategory();
			$data['sections'] = $sections->where('parent', 0)->get();
			
			$categories = new ClassifiedsCategory();
			$data['categories'] = $categories->get();
			
			if(!$this->user->is_guest())
				$data['member'] = new User($this->user->get_id());
			
			$currencies = new Currency();
			$data['currencies'] = $currencies->get();

			$this->load->view('frontend/items_search', $data);
		}

		public function subcategories($id)
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			//$this->load->model('category');
			//$this->load->model('item');
			//$this->load->model('currency');

			$member = new User($this->user->get_id());

			$category = new ClassifiedsCategory();
			$category->where('id', $id);
			$data['category'] = $category->get();

			$data['member'] = $member;

			$sections = new ClassifiedsCategory();
			$data['sections'] = $sections->where('parent', 0)->get();

			$recent_items = new ClassifiedsItem();
			$recent_items->limit($this->BuilderEngine->get_option('be_classifieds_recent_items_count'));
			$data['recent_items'] = $recent_items->where('sold', 'no')->get();

			$featured_items = new ClassifiedsItem();
			$data['featured_items'] = $featured_items->where('sold', 'no')->get();

			$subcategories = new ClassifiedsCategory();
			$subcategories->where('parent', $id);
			$subcategories = $subcategories->get();
			$data['subcategories'] = $subcategories;
			$data['id'] = $id;
			$this->load->view('frontend/subcategories', $data);
		}

		public function create_report($id)
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			$user_type = '';
			$data = '';
			if(!$this->user->is_guest())
			{
				$member = new User($this->user->get_id());
				$data['member'] = $member;
				$user_type = "Member";
			}
			else
				$user_type = "Guest";

				$reported_ad = new ClassifiedsItem($id);

			if($_POST)
			{
				$report = new ClassifiedsAdReport();
				$report->item_id = $id;
				$report->text = $_POST['complain'];
				$report->time_of_creation = time();
				$report->save();
				$to = $this->BuilderEngine->get_option('adminemail');
				$subject = 'Complaint filed in '.$this->BuilderEngine->get_option('website_name');
				$message = 
				"A report has been filed against an Classified Ad on ".date('d-m-Y H:i:s', time()).".".
				"\n \n Reported ad link: : ".base_url('classifieds/view_item/'.$id).
				"\n Reported ad seller: : ".base_url('classifieds/profile/'.$reported_ad->posting_member_id).
				"\n \n Report information:".
				"\n \n ".$user_type." name: ".$_POST['name'].
				"\n ".$user_type." email: ".$_POST['email'].
				"\n Complain category: ".$_POST['category'].
				"\n Complain message: ".$_POST['complain'];

				if($user_type == "Member")
					$message .= "\n Profile page of the user that filed the report - ".base_url('classifieds/profile/'.$member->id);


				mail($to, $subject, $message);
				redirect(base_url('classifieds/view_item/'.$id));
			}

			$this->load->view('frontend/create_report', $data);
		}

		public function report_comment()
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();
			if(isset($_GET['review_id'])){
				$comment_report = new ClassifiedsReviewReport();
				$comment_report->review_id = $_GET['review_id'];
				$text = '';
				if(isset($_GET['text']))
					$text = $_GET['text'];
				$comment_report->text = $text;
				$comment_report->time_of_creation = time();
				$comment_report->save();
				redirect(base_url('classifieds/view_item/'.$_GET['item_id']), 'location');
			}
		}

		public function delete_comment($id)
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();
			if(!$this->user->is_member_of("Administrators")){
				show_404();
			}
			$id = intval($id);
			$comment = new ClassifiedsReview($id);
			$item_id = $comment->item_id;
			$comment->delete();
			redirect(base_url('classifieds/view_item/'.$item_id));
		}

		public function tell_a_friend($id)
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			$user_type = '';
			$data = '';
			if(!$this->user->is_guest())
			{
				$member = new User($this->user->get_id());
				$data['member'] = $member;
				$user_type = "Member";
			}

			$item = new ClassifiedsItem($id);

			if($_POST)
			{
				$to = $_POST['friend_email'];
				$subject = 'An invitation for '.$_POST['friend_name'].' about '.$this->BuilderEngine->get_option('website_name');
				$message =
				"Your friend ".$_POST['name']." sent you an invitation to view this Classified Ad:".
				"\n \n Ad name: : ".$item->name.
				"\n Ad page: : ".base_url('classifieds/view_item/'.$id);

				if($_POST['message'])
					$message.= "\n \n A message from your friend: ".$_POST['message'];

				"\n \n Your friend's email address : ".$_POST['email'];
				
				if($user_type == "Member")
					$message .= "\n Your friend's profile page - ".base_url('classifieds/profile/'.$member->id);

				$message .= "\n \n The invitation was sent on ".date('d-m-Y H:i:s', time()).".";

				mail($to, $subject, $message);
				redirect(base_url('classifieds/view_item/'.$id));
			}

			$data['item'] = $item;
			$this->load->view('frontend/tell_a_friend', $data);
		}

		public function activate_account($token)
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			$new_member = new ClassifiedsMemberExtend();
			$new_member->where('activation_token', $token)->get();

			$this->load->model('classifiedsfiles');
			
			$data['error'] = '';
			if($new_member->exists())
			{
				if($_POST)
				{
					if($_POST['lga'] != '' && $_POST['state'] != '')
					{	
						$member = new User($new_member->member_id);
						$avatar = $this->classifiedsfiles->upload_avatar('avatar', $member->username);
						$new_member->avatar = $avatar;
						$new_member->telephone = $_POST['telephone'];
						$new_member->lga = $_POST['lga'];
							$state = new ClassifiedsState($_POST['state']);
						$new_member->state = $state->name;
						$new_member->address = $_POST['address'];
						$new_member->business = $_POST['business'];
						$new_member->gender = $_POST['gender'];
						$new_member->about_me = $_POST['about_me'];
						$new_member->interests = $_POST['interests'];
						$new_member->my_website = $_POST['my_website'];
						$new_member->registration_completed = 'yes';
						$new_member->activation_token = '';
						$new_member->save();
					}
					redirect(base_url('classifieds/login/'));
				}
			} 
			else
				$data['error'] = true;

			$this->load->view('frontend/activate_account', $data);
		}

		public function activate_ad($token)
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			$item = new ClassifiedsItem();
			$item->where('activation_token', $token)->get();

			$data['error'] = '';
			if($item->exists())
			{
				$item->activation_token = '';
				$item->ad_completed = 'yes';
				$item->save();
			} 
			else
				$data['error'] = true;

			$data['item'] = $item;
			$this->load->view('frontend/activate_ad', $data);
		}

		public function new_password()
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			$this->load->view('frontend/new_password');
		}

		public function forgotten_password()
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			$data['error_msg'] = '';

			if($_POST)
			{
				$user = new User();
				$user->where('email', $_POST['email'])->get();

				if($user->email != '')
				{
					$user_extend = new ClassifiedsMemberExtend();
					$user_extend->where('member_id', $user->id)->get();
					$user_extend->password_reset_token = md5(time());
					$user_extend->save();

					$password_reset_token = $user_extend->password_reset_token;

					$to = $_POST['email'];
					$subject = 'Account Password Reset Token';
					$message = "Hello ".$user->name.". To change your account password 
					please click this link: ".base_url('/classifieds/change_password/'.$password_reset_token);

					mail($to, $subject, $message);
					redirect(base_url('classifieds/new_password'), 'location');
				}
				else
					$data['error_msg'] = 'No user with this email exists';
			}
			$this->load->view('frontend/forgotten_password', $data);
		}

		public function change_password($token)
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			$user_extend = new ClassifiedsMemberExtend();
			$user_extend = $user_extend->where('password_reset_token', $token)->get();
			$data['error_msg'] = '';
			if($user_extend->password_reset_token != '')
			{
				if($_POST)
				{
					if($_POST['password'] == $_POST['password_repeat'])
					{
						$user = new User($user_extend->member_id);
						$user->password = md5($_POST['password']);
						$user->save();

						$user_extend->password_reset_token = '';
						$user_extend->save();

						redirect(base_url('classifieds/successful_password_change'), 'location');
					}
					else
						$data['error_msg'] = 'Entered passwords do not match';
				}
			}
			else
				redirect(base_url('/classifieds/invalid_token'), 'location');
			
			$this->load->view('frontend/change_password', $data);
		}

		public function successful_password_change()
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			$this->load->view('frontend/successful_password_change');
		}

		public function invalid_token()
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			$this->load->view('frontend/invalid_token');
		}

		public function get_categories()
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			$categories = new ClassifiedsCategory();
			$data['categories'] = $categories;

			$this->load->view('frontend/get_categories', $data);
		}

		public function renew_item($id)
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			$item = new ClassifiedsItem($id);
			$item->last_renew_time = time();
			$item->save();

			redirect(base_url('classifieds/placed_ads'), 'location');
		}

		public function checkout()
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			if(isset($_GET['item']) && !empty($_GET['item'])){
				$data['item'] = new ClassifiedsItem($_GET['item']);
				if($data['item']->exists()){
					include FCPATH.'modules/booking_events/assets/misc/country_list.php';
					$this->load->module('builderpayment/api');
					$userinfo = new User($this->user->get_id());
					if($userinfo->exists()){
						$data['userinfo'] = new User($this->user->get_id());
						$data['customer'] = $data['userinfo']->extended->get();
					}
					$data['countries'] = $countries;
					$data['payment_methods'] = $this->api->getAvailableGateways();
					$this->load->view('frontend/checkout', $data);
				}
				else
					show_404();
			}else
				show_404();
		}

		public function process_paypal()
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			if($_POST['submitAjaxFormPSC'] && $_POST['submitAjaxFormPSC'] == $this->user->get_id()){
				$this->load->module('builderpayment/api');
				$this->api->identifyModule('classifieds');
				$this->api->setGateway('paypal');

				$item = new ClassifiedsItem($_POST['item_id']);
				$order = $this->api->createOrder();
				$order->custom_data = json_encode(array('item_id' => $_POST['item_id'], 'zip' => $_POST['zip'], 'user_id' => $this->user->get_id()));
				$order->payment_method = 'paypal';
				$order->currency = $this->BuilderEngine->get_option('be_classifieds_default_currency');
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

				$product = $order->addProduct();
				$product->name = $item->name;
				$product->price = $_POST['amount'];
				$product->quantity = 1;
				$product->save();

				$order->submit();
			}
		}

		public function process_stripe_payment()
		{
			if($this->BuilderEngine->get_option('classifieds_active') !== 'yes')
				show_404();

			if($_POST){
				$this->load->module('builderpayment/Stripegateway');
				$this->stripegateway->load_config();
				$keys = json_decode($this->BuilderEngine->get_option('builderpayment-config-StripeGateway'));
				$sandbox = false;
				if((int)$keys->STRIPE_SANDBOX === 0)
					$sandbox = true;
				$currency_id = $this->BuilderEngine->get_option('be_classifieds_default_currency');
				$currency = new Currency($currency_id);
				$amount = $_POST['amount'] * 100;
				$cardname = $this->BuilderEngine->get_option('be_classifieds_company_name');
				// API credentials only need to be defined once
				define("STRIPE_TEST_API_PUBLISHABLE_KEY", $keys->STRIPE_TEST_API_PUBLISHABLE_KEY);
				define("STRIPE_LIVE_API_PUBLISHABLE_KEY", $keys->STRIPE_LIVE_API_PUBLISHABLE_KEY);
				define("STRIPE_SANDBOX", $sandbox);

				if($sandbox)
					Stripe::setApiKey($keys->STRIPE_TEST_API_SECRET_KEY);
				else
					Stripe::setApiKey($keys->STRIPE_LIVE_API_SECRET_KEY);
				$payment_time = time();
				try {
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
				}catch(Exception $e){
					$this->session->set_flashdata('error', 'Oops, '.$e->getMessage());
				}			

				if ($charge->paid){
					$_POST['method'] = 'stripe';
					$_POST['payment_method'] = 'stripe';
					$_POST['payment_time'] = $payment_time;
					$_POST['trans_id'] = $charge->id;
					$_POST['paid_toggle'] = 'yes';
					$data = $_POST;
					$this->create_order_and_send_confirmation_email($data);
					$this->session->set_flashdata('info', 'Thank You for your payment! <br/> Transaction ID: '.$charge->id.'<br/><br/><a href="'.base_url('cp/orders').'" class="btn btn-lg btn-success">View Invoice</a>');
				}

				redirect(base_url('classifieds/info'),'location');
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
				$_POST['payment_method'] = 'Cod';
				$_POST['method'] = 'cod';
				$_POST['paid_gross'] = 0;
				$data = $_POST;
				$this->create_order_and_send_confirmation_email($data);
				if($_POST['amount'] > 0)
					$this->session->set_flashdata('info', 'Your order/invoice has been generated.Please,check your email address to proceed. Thank you! <br/> Transaction ID: '.$data['trans_id'].'<br/><br/><a href="'.base_url('cp/orders').'" class="btn btn-lg btn-success">View Invoice</a>');
				else
					$this->session->set_flashdata('info', 'Your order/invoice has been created for purchase confirmation purpose only. Thank you! <br/> Transaction ID: '.$data['trans_id'].'<br/><br/><a href="'.base_url('cp/orders').'" class="btn btn-lg btn-success">View Invoice</a>');
				redirect(base_url('classifieds/info'),'location');
			}
		}

		private function create_order_and_send_confirmation_email($data)
		{
			$object = new ClassifiedsItem();
			$object = $object->where('id',$data['item_id'])->get();
			$object->sold = 'yes';
			$object->time_of_sell = time();
			$object->save();

			$this->load->module('builderpayment/api');
			$this->api->identifyModule('classifieds');
			//$this->api->setGateway($data['payment_method']);

			$order = $this->api->createOrder();
			$order->payment_method = $data['method'];
			$order->custom_data = json_encode(array('item_id' => $data['item_id'], 'zip' => $data['zip'], 'user_id' => $this->user->get_id()));
			$order->currency = $this->BuilderEngine->get_option('be_classifieds_default_currency');
			$order->callback = 'order_completed';
			$order->gross = $data['amount'];
			$order->paid_gross = ($data['method'] == 'cod')?0:$data['amount'];
			$order->user_id = $this->user->get_id();
			$order->trans_id = $data['trans_id'];
			$order->time_created = time();

			$order_product = $order->addProduct();
			$order_product->name = $object->name;
			$order_product->quantity = 1;
			$order_product->price = $data['amount'];
			$order_product->save();

			$ship = $order->createShippingAddress();
			$ship->first_name = $data['first_name'];
			$ship->last_name = $data['last_name'];
			$ship->address_line_1 = $data['address'];
			$ship->city = $data['city'];
			$ship->zip = $data['zip'];
			$ship->country = $data['country'];
			$ship->phone = $data['phone'];
			$ship->email =$data['email'];
			$ship->save();

			$bill = $order->createBillingAddress();
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
			$this->api->send_confirmation_email($order);
			//TODO: fix invoice email template styles - order_invoice
			$to      = $data['email'];
			$admin = $this->BuilderEngine->get_option('adminemail');
			$admin_subject = 'Classifieds : '.$object->name.' sold';
			$user_subject = 'Payment confirmation for classifieds ad: '.$object->name;
			$message = 'Your purchase for the ad '.$object->name.' has been successfully processed!';
			$admin_message = 'User <b>'.$data['first_name'].' '.$data['last_name'].'</b> just purchased '.$object->name;
			$headers = 'MIME-Version: 1.0' . "\r\n".
				'Content-type: text/html; charset=iso-8859-1' . "\r\n".
				'From: '.$this->BuilderEngine->get_option("adminemail") . "\r\n" .
				'Reply-To: '.$this->BuilderEngine->get_option("adminemail") . "\r\n" .
				'mailed-by: '.$this->BuilderEngine->get_option("adminemail") . "\r\n";

			$data1 = array(
				'company_name' => $this->BuilderEngine->get_option('be_classifieds_company_name'),
				'company_logo' => $this->BuilderEngine->get_option('be_classifieds_company_logo'),
				'company_address' => $this->BuilderEngine->get_option('be_classifieds_company_address'),
				'company_zip' => $this->BuilderEngine->get_option('be_classifieds_company_zip'),
				'company_city' => $this->BuilderEngine->get_option('be_classifieds_company_city'),
				'company_country' => $this->BuilderEngine->get_option('be_classifieds_company_country'),
				'company_phone' => $this->BuilderEngine->get_option('be_classifieds_company_phone'),
				'company_email' => $this->BuilderEngine->get_option('be_classifieds_company_email'),
				'company_tax_vat_number' => $this->BuilderEngine->get_option('be_classifieds_company_tax_vat_number'),
				'company_bank_account_number' => $this->BuilderEngine->get_option('be_classifieds_company_bank_account_number'),
				'payment_option' => $this->BuilderEngine->get_option('be_classifieds_company_payment_option'),
				'object' => $object,
				'order' => $order,
				'products' => $order->product->get(),
				'currency' => new Currency($order->currency),
				'custom_fields' => json_decode($order->custom_data),
				'order_bill_address' => $order->billingAddress->get(),
				'order_ship_address' => $order->shippingAddress->get()
			);

			$html_message = $this->load->view('order_invoice',$data1,true);

			//mail($to, $user_subject, $html_message, $headers);
			mail($admin, $admin_subject, $admin_message, $headers);
			if($data['payment_method'] == 'cod'){
				$subject = 'Your Order/Invoice for '.$object->name;
				$invoice = $this->load->view('event_invoice',$data1,true);
				//mail($to, $subject, $invoice, $headers);
			}
		}

		public function order_completed($id)
		{	
			$item = new ClassifiedsItem($id);
			$item->sold = 'yes';
			$item->time_of_sell = time();
			$item->save();
			redirect(base_url('builderpayment/order_success'),'location');
		}

		public function info()
		{
			$data = array();
			$this->load->view('frontend/info',$data);
		}
	}
?>