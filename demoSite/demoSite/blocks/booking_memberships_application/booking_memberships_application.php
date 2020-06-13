<?php
class Booking_memberships_application_block_handler extends  block_handler{
	function info()
	{
		$info['category_name'] = "Booking Memberships";
		$info['category_icon'] = "dsf";

		$info['block_name'] = "Membership Application";
		$info['block_icon'] = "fa-envelope-o public";
		
		return $info;
	}
	public function generate_admin()
	{
		$curr_membership_id = $this->block->data('membership_id');
		$available_memberships = array();
		$all_memberships = new Booking_membership();
		foreach($all_memberships->where('active','yes')->get() as $key => $value){
			$available_memberships[$value->id] = stripslashes(str_replace('_',' ',$value->name));
		}
		$this->admin_select('membership_id', $available_memberships, 'Memberships: ', $curr_membership_id);
	}
	public function generate_style($active_menu = '')
	{
		
	}
	public function load_generic_styling()
	{
		
	}
    public function apply_custom_css()
    {
        $style_arr = $this->block->data("style");
        if(!isset($style_arr['color']))
            $style_arr['color'] = '';
        if(!isset($style_arr['text-align']))
            $style_arr['text-align'] = '';
        if(!isset($style_arr['background-color']))
            $style_arr['background-color'] = '';

        return '
        <style>
        div[name="'.$this->block->get_name().'"] h1{
                color: '.$style_arr['color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] h2{
                color: '.$style_arr['color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] h3{
                color: '.$style_arr['color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] h4{
                color: '.$style_arr['color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] h5{
                color: '.$style_arr['color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] p{
            /*    color: '.$style_arr['color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] span{
            /*    color: '.$style_arr['color'].' !important; */
                text-align: ' . $style_arr['text-align'].' !important;
            /*    background-color: ' . $style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] div{
                color: '.$style_arr['color'].' !important;
                text-align: '.$style_arr['text-align'].' !important;
            /*    background-color: '.$style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] ul{
                color: '.$style_arr['color'].' !important;
                text-align: '.$style_arr['text-align'].' !important;
            /*    background-color: '.$style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] ol{
                color: ' . $style_arr['color'].' !important;
                text-align: ' . $style_arr['text-align'].' !important;
             /*   background-color: ' . $style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] li{
                color: '.$style_arr['color'].' !important;
                text-align: ' . $style_arr['text-align'].' !important;
            /*    background-color: ' . $style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] a{
            /*    color: '.$style_arr['color'].' !important; */
        }
		.bckgrd{
			background-color: '.$style_arr['background-color'].' !important;
		}
        </style>';
    }
	public function generate_content()
	{
		global $active_controller;
		$user = &$active_controller->user;
		$CI = &get_instance();
		$CI->load->module('layout_system');
		$this->load_generic_styles();
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		$curr_membership_id = $this->block->data('membership_id');

		$membership = new Booking_membership();
		if(strpos($_SERVER['REQUEST_URI_PATH'],'booking_memberships/application/') !== FALSE)
			$membership = $membership->where('id',$segments[$count-1])->get();
		else{
			if(empty($curr_membership_id))
				$membership = $membership->where('id',1)->get();
			else
				$membership = $membership->where('id',$curr_membership_id)->get();
		}
		$default_payment_method = $CI->BuilderEngine->get_option('be_booking_memberships_payment_methods');
		if($default_payment_method == 'Cash on Delivery')
			$payment_method = 'cod';
		if($default_payment_method == 'Stripe')
			$payment_method = 'stripe';
		if($default_payment_method == 'PayPal')
			$payment_method = 'paypal';
		$groups_allowed_to_book = explode(',',$CI->BuilderEngine->get_option('be_booking_memberships_shop_groups'));

		if($CI->input->post('password') && $CI->input->post('confirm_password'))
		{
			$CI->load->model('users');
			$CI->load->module('booking_memberships');
			$CI->load->module('builderpayment/api');

			if(isset($_POST['new_email']))
			{
				$new_user_email = $_POST['new_email'];
				unset($_POST['new_email']);
				unset($_POST['password']);
				unset($_POST['confirm_password']);
				unset($_POST['tc']);
				$user = new User();
				$user = $user->where('email',$new_user_email)->get();
			}
			unset($_POST[0]);

			if($membership->price > 0)
				if($membership->vat > 0)
					$membership->price = ($membership->price + (($membership->price * $membership->vat) / 100));

			$CI->api->identifyModule('booking_memberships');
			$order = $CI->api->createOrder();
			$order->payment_method = $payment_method;
			$order->currency = $membership->currency_id;
			$order->status = 'pending';
			$order->user_id = $user->id;
			$order->gross = $membership->price;

			$order_bill_address = $order->createBillingAddress();
			$order_bill_address->first_name = ucfirst($user->first_name);
			$order_bill_address->last_name = ucfirst($user->last_name);
			if($user->verified == 'yes'){
				$order_bill_address->address_line_1 = $user->extended->get()->address;
				$order_bill_address->country = $user->extended->get()->country;
				$order_bill_address->city = $user->extended->get()->city;
				$order_bill_address->state = $user->extended->get()->state;
				$order_bill_address->zip = $user->extended->get()->zip;
				$order_bill_address->phone = $user->extended->get()->telephone;
			}
			$order_bill_address->email = $user->email;
			$order_bill_address->save();

			$order_item = $order->addProduct();
			$order_item->name = $membership->name.' Subscription';
			$order_item->quantity = 1;
			$order_item->price = $membership->price;
			$order_item->save();

			$form = '';
			$application['questionnaire'] = array();
			$application['membership_id'] = $membership->id;
			$application['description'] = $membership->description;

			if($membership->approval == 'yes')
			{
				$application['approval'] = 'yes';
				$application['reviewed'] = 'pending';
			}
			else
			{
				$application['approval'] = 'no';
				$application['reviewed'] = 'pending';
			}

			if($membership->questionnaire == 'yes')
			{
				foreach($CI->input->post() as $k => $v)
				{
					$application['questionnaire'][$k] = $v;
				}
				$form = $CI->booking_memberships->get_email_application($application['questionnaire']);
			}
			$application['code'] = md5(uniqid(time())); 
			$order->custom_data = json_encode($application);
			$order->save();

			if($membership->approval == 'yes')
			{
				$to = $user->email;
				$admin = $CI->BuilderEngine->get_option('adminemail');
				$company_name = $CI->BuilderEngine->get_option('be_booking_memberships_company_name');
				$subject = $company_name .' Membership Application';
				$_POST['order_id'] = $order->id;
				$message = "Thank you ".$CI->input->post('companyname')."!<br/><br/>". "\r\n".
					"Your application for the ".$company_name." ".$membership->name." has been received.<br/>". "\r\n" .
					"Someone from ".$company_name." will contact you shortly!<br/><br/>"."\r\n".$form;
				$admin_message = "A new Application has been sent by <b>".$user->email."</b> for the ".$membership->name." service.<br/>". "\r\n" .
				"Please log into the Admin Dashboard to review the details.<br/><br/>". "\r\n". base_url('admin/main/login')."<br/><br/>". "\r\n".$form;

				$CI->users->send_html_email($admin, $subject, 'email_template', $admin_message, false, 'booking_memberships');
				$CI->users->send_html_email($to, $subject, 'email_template', $message, false, 'booking_memberships');
				redirect(base_url('booking_memberships/service_completed/'.trim($user->first_name)),'location');
			}
			else
			{
				if($user->verified == 'yes')
					redirect(base_url('booking_memberships/checkout/'.$membership->id.'/'.$order->id.'/'.$application['code']),'location');
				else
				{
					$CI->session->set_flashdata('guest_user', $user->id);
					$CI->session->set_flashdata('guest_order', $order->id);
					$CI->session->set_flashdata('guest_order_code', $application['code']);
					redirect(base_url('booking_memberships/checkout/'.$membership->id),'location');
				}
			}
		}

		$output = '
			<div id="booking-memberships-application-container-'.$this->block->get_id().'" class="booking-membership-application-container module-colors">
				<link href="'.base_url().'themes/dashboard/assets/plugins/parsley/src/parsley.css" rel="stylesheet" />
				<div class="booking-membership-application-form-box module-colors-bg">
					<h3>'.$membership->name.'</h3>
					<div class="booking-membership-application-form">';
					if($membership->exists() && $membership->active == 'yes')
					{
						if($user->is_member_of_any($groups_allowed_to_book))
						{
							$output .='
							<form id="app" method="post" data-parsley-validate="true" class="">';
								if($membership->questionnaire == 'yes')
									$output .= $membership->get_questionnaire_fields().'<hr>';
								if(!$user->is_logged_in())
								{
									$output .='
									<div class="booking-membership-application-form-mandatory">
										<label class="control-label">Name</label>
										<div class="row row-space-10">
											<div class="col-md-6 m-b-15">
												<input type="text" class="form-control form-control-be-40" placeholder="First Name" id="first_name" required/>
												<div data-name="first_name"></div>
											</div>
											<div class="col-md-6 m-b-15">
												<input type="text" class="form-control form-control-be-40" placeholder="Last Name" id="last_name" required/>
												<div data-name="last_name"></div>
											</div>
										</div>
										<label class="control-label">Email</label>
										<div class="row m-b-15">
											<div class="col-md-12">
												<input type="email" class="form-control form-control-be-40" placeholder="Email Address" id="email" required/>
												<div data-name="email"></div>
											</div>
										</div>
										<label class="control-label">Password</label>
										<div class="row m-b-15">
											<div class="col-md-12">
												<input type="password" class="form-control form-control-be-40" placeholder="Create Password" name="password" id="password" required/>
												<div data-name="password"></div>
											</div>
										</div>
										<label class="control-label">Confirm Password</label>
										<div class="row m-b-15">
											<div class="col-md-12">
												<input type="password" class="form-control form-control-be-40" placeholder="Confirm Password" name="confirm_password" id="confirm_password" required/>
											</div>
										</div>
									</div>
									<div class="checkbox beaccount-register-terms">
										<label>
											<input id="tc" type="checkbox" name="tc" style="-webkit-appearance:checkbox;" required /> By signing up, you agree to our <a href="'.base_url('page-terms.html').'">Terms of Use</a>, and <a href="'.base_url('page-privacy.html').'">Privacy Policy</a>.
											<div id="tcc" data-name="tc" style="color:red;"></div>
										</label>
									</div>';
									if($membership->approval == 'yes')
									{
										$output .='
										<div class="alert alert-info">
											<p>
												<i class="fa fa-info-circle"></i> This membership requires our approval. Once reviewed, you will be notified by your email address.</b>
											</p>
											<br/>
										</div>';
									}
									$output .='
									<div class="form-group">
										<div class="registration-buttons">
											<button class="btn btn-colors btn-block btn-lg" type="submit" ><i class="fa fa-check"></i>Register Account & Submit Membership Application</button>
										</div>
									</div>
									<hr>
									<div class="beaccount-login-footer-register">
										<small><a href="'.base_url('cp/login').'" class="text-success">Already have an Account? <b>Login Here</b></a></small>
										<small> for access to our membership dashboard.</small>
									</div>
									<script>
										var site_root = "'.home_url("").'";
									</script>
									<script src="'.base_url('modules/cp/assets/plugins/jquery/jquery-1.9.1.min.js').'"></script>
									<script src="'.base_url('modules/cp/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js').'"></script>
									<script src="'.base_url('modules/cp/assets/plugins/bootstrap/js/bootstrap.min.js').'"></script>
									<!--[if lt IE 9]>
										<script src="'.base_url('modules/cp/assets/crossbrowserjs/html5shiv.js').'"></script>
										<script src="'.base_url('modules/cp/assets/crossbrowserjs/respond.min.js').'"></script>
										<script src="'.base_url('modules/cp/assets/crossbrowserjs/excanvas.min.js').'"></script>
									<![endif]-->
									<script src="'.base_url('modules/cp/assets/plugins/slimscroll/jquery.slimscroll.min.js').'"></script>
									<script src="'.base_url('modules/cp/assets/plugins/jquery-cookie/jquery.cookie.js').'"></script>
									<script src="'.base_url('modules/cp/assets/js/jquery.validate.min.js').'"></script>
									<!-- ================== END BASE JS ================== -->

									<!-- ================== BEGIN BuilderEngine JS ================== -->
									<script src="'.base_url('modules/booking_memberships/assets/js/registration.js').'"></script>
									<!-- ================== END BuilderEngine JS ================== -->

									<!-- ================== BEGIN PAGE LEVEL JS ================== -->
									<script src="'.base_url('modules/cp/assets/js/apps.min.js').'"></script>
									<!-- ================== END PAGE LEVEL JS ================== -->

									<script>
										$("#tc").change(function(){
											var c = this.checked ? "none" : "block";
											$("#tcc").css("display", c);
										});
										$(document).ready(function() {
											App.init();
										});
									</script>';
								}
								else
								{
									if($membership->approval == 'yes')
									{
										$output .='
										<input type="hidden" name="tc" value="fake" />
										<div class="alert alert-info">
											<p>
												<i class="fa fa-info-circle"></i> Dear <i>'.$user->first_name.' '.$user->last_name.'</i>, membership requires our approval. Once reviewed, you will be notified by your email address: <b>'.$user->email.'</b>
											</p>
											<br/>
										</div>
										<div class="form-group">
											<div class="">
												<button class="btn btn-colors btn-block btn-lg" type="submit" ><i class="fa fa-check"></i> Submit Membership Application</button>
											</div>
										</div>
										';
									}
									else
									{
										if($membership->questionnaire == 'yes')
										{
											$output .='
											<input type="hidden" name="tc" value="fake" />
											<div class="form-group">
												<div class="">
													<button class="btn btn-colors btn-block btn-lg" type="submit" ><i class="fa fa-check"></i> Submit Membership Application and Proceed to Checkout</button>
												</div>
											</div>';
										}
										else
											$output .='<a class="btn btn-colors btn-block btn-lg" href="'.base_url('booking_memberships/checkout/'.$membership->id).'" ><i class="fa fa-check"></i> Proceed To Checkout</a>';
									}
								}
								$output .=
							'</form>';
						}else{
							$output .= '
								<a class="btn btn-md btn-block btn-colors" href="javascript:;">SORRY,YOU ARE NOT ALLOWED TO BOOK A MEMBERSHIP.PLEASE CONTACT ADMIN</a>
								<br/><p class="text-center">or</p>
								<a class="btn btn-md btn-block btn-colors" href="'.base_url('cp/register').'">Create an Account</a>
							';
						}
					}else
						$output .='<h1 class="text-center">No Such Membership </h1>';
					$output .='
					</div>
				</div>
				<script src="'.base_url().'themes/dashboard/assets/plugins/parsley/dist/parsley.js"></script>
			</div>
		';
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'booking-memberships-application-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), $menu);
		else
			return $output.$this->apply_custom_css();
	}
}
?>