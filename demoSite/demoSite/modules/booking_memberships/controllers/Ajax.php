<?php
	class Ajax extends Module_Controller
	{
		public function registration()
		{
			if($this->input->post()){
				$this->load->library('form_validation');
				//$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric_spaces|is_unique[users.username]');
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
				$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|alpha_numeric_spaces');
				$this->form_validation->set_rules('last_name', 'Second Name', 'trim|required|alpha_numeric_spaces');
				$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|alpha_numeric|matches[confirm_password]');
				$this->form_validation->set_rules('confirm_password', 'Password', 'trim|required|min_length[6]|alpha_numeric');
				$this->form_validation->set_rules('tc', 'tc', 'required|min_length[3]');

				if($this->form_validation->run()){
					$this->load->model('builderengine');
					$_POST['username'] = $this->input->post('first_name').'_'.$this->input->post('last_name').uniqid();
					if($this->builderengine->get_option('sign_up_verification') == 'admin')
					{
						$this->load->model('options');
						$_POST['groups'] = 'Guests';//$this->options->get_option_by_name('default_registration_group')->value;
						$new_user = $this->users->register_user($this->input->post());
						echo 'register with admin';
					}elseif ($this->builderengine->get_option('sign_up_verification') == 'email') {
						$this->load->model('options');
						$_POST['groups'] = 'Guests';//$this->options->get_option_by_name('default_registration_group')->value;
						$new_user = $this->users->register_user($this->input->post());
						$this->user->notify('success', "User created successfully!");
						//$this->users->send_registration_email($this->input->post('email'),$new_user);
						echo 'register with email';
					}
				}else{
					$error['email'] = form_error('email');
					$error['first_name'] = form_error('first_name');
					$error['last_name'] = form_error('last_name');
					$error['password'] = form_error('password');
					$error['tc'] = 'You must agree with our terms and conditions !';
					echo json_encode($error);
				}
			}
		}

		public function check_voucher_code($membership_id)
		{
			$result['status'] = 'false';
			if($this->input->post('voucher_code'))
			{
				$membership = new Booking_membership($membership_id);
				if($membership->exists()){
					$vouchers = $membership->voucher->get();
					if($vouchers->exists()){
						foreach($vouchers as $voucher){
							if($voucher->code == $this->input->post('voucher_code') && $voucher->id == $this->input->post('voucher_id')){
								$result['status'] = 'true';
								if(date('Y-m-d', strtotime($voucher->expiry_date)) >= date("Y-m-d",time()))
									$result['expired'] = 'false';
								else
									$result['expired'] = 'true';
								$result['price'] = $voucher->price;
								$result['price_opt'] = $voucher->price_opt;
							}
						}
					}
				}
			}
			echo json_encode($result);
		}
	}
