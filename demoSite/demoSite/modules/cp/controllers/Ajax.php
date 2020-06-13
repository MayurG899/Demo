<?php

class Ajax extends Module_Controller {

    protected function check_login()
    {
        if(!$this->user->is_logged_in())
            redirect(base_url('cp/login'), 'location');
	}

    public function registration()
    {
        if($this->input->post()){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'Email', 'trim|strtolower|required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|alpha_numeric_spaces|required');
            $this->form_validation->set_rules('last_name', 'Second Name', 'trim|alpha_numeric_spaces|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|alpha_numeric|matches[confirm_password]');
            $this->form_validation->set_rules('confirm_password', 'Password', 'trim|required|min_length[6]|alpha_numeric');
			$this->form_validation->set_rules('tc', 'tc', 'required|min_length[3]');

            if($this->form_validation->run()){

                $this->load->model('builderengine');
				$this->load->model('options');

				$_POST['username'] = strtolower($this->input->post('first_name')).'-'.strtolower($this->input->post('last_name')).'-'.uniqid();
                if($this->builderengine->get_option('sign_up_verification') == 'admin')
                {
                    $this->load->model('options');
                    $_POST['groups'] = $this->options->get_option_by_name('default_registration_group')->value;
                    $new_user = $this->users->register_user($this->input->post());
                    echo 'register with admin';
                }elseif ($this->builderengine->get_option('sign_up_verification') == 'email') {
                    $this->load->model('options');
                    $_POST['groups'] = $this->options->get_option_by_name('default_registration_group')->value;
                    $new_user = $this->users->register_user($this->input->post());
                    $this->user->notify('success', "User created successfully!");
                    //$this->users->send_registration_email($this->input->post('email'),$new_user);
                    echo 'register with email';
                }

            }else{
                $error['username'] = form_error('username');
                $error['email'] = form_error('email');
                $error['first_name'] = form_error('first_name');
                $error['last_name'] = form_error('last_name');
                $error['password'] = form_error('password');
				$error['tc'] = 'You must agree with our terms and conditions !';
                echo json_encode($error);
            }
        }
    }

	public function upload()
	{
		$this->check_login();
		$user_id = $this->user->get_id();
		if(!is_dir("files/users"))
			mkdir("files/users");
		if(!is_dir("files/users/user_".$user_id))
			mkdir("files/users/user_".$user_id);
		 if(!is_dir("files/users/user_".$user_id."/avatars"))
			mkdir("files/users/user_".$user_id."/avatars");
		//print_r($_FILES);exit;
		$files = $this->_reArrangeFiles($_FILES['avatar']);

		foreach ($files as $file) {
			//echo 'File Name: ' . $file['name'];
			//echo 'File Type: ' . $file['type'];
			//echo 'File Size: ' . $file['size'];
			$newUniqueFileName = md5(uniqid());
			$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
			$newFileName = $_SERVER['DOCUMENT_ROOT'].'/files/users/user_'.$user_id.'/avatars/'.$newUniqueFileName.'.'.$ext;
			move_uploaded_file($file['tmp_name'], $newFileName);
			echo $newUniqueFileName.'.'.$ext;
		}
	}

	public function remove_file()
	{
		$this->check_login();
		if(isset($_POST['fileName'])){
			$fileName = $_POST['fileName'];
			$file = $_SERVER['DOCUMENT_ROOT'].'/files/users/user_'.$this->user->get_id().'/avatars/'.$_POST['fileName'];
			if(file_exists($file)){
				unlink($file);
				echo 'file deleted: '.$fileName;
			}else
				echo 'file deletion for : '.$fileName.' failed!';	
		}else
			echo 'No file to delete!';
	}

	public function _reArrangeFiles(&$file_post) {

		$this->check_login();
		$file_array = array();
		$file_count = count($file_post['name']);
		$file_keys = array_keys($file_post);

		for ($i=0; $i<$file_count; $i++) {
			foreach ($file_keys as $key) {
				$file_array[$i][$key] = $file_post[$key][$i];
			}
		}
		return $file_array;
	}

	public function get_uploaded_files($item_id)
	{
		$this->check_login();
		$ad = new User($item_id);
		$images = array();
		if($ad->exists()){
			if(!empty($ad->avatar)){
				if(strpos($ad->avatar,'be_demo') !== FALSE || strpos($ad->avatar,'builderengine/public/img/avatar.png') !== FALSE){
					$user_id = $this->user->get_id();
					if(!is_dir("files/users"))
						mkdir("files/users");
					if(!is_dir("files/users/user_".$user_id))
						mkdir("files/users/user_".$user_id);
					 if(!is_dir("files/users/user_".$user_id."/avatars"))
						mkdir("files/users/user_".$user_id."/avatars");
					if(strpos($ad->avatar,'be_demo') !== FALSE){
						$img = base_url().$ad->avatar;
						copy($_SERVER['DOCUMENT_ROOT'].$ad->avatar,$_SERVER['DOCUMENT_ROOT'].'/files/users/user_'.$user_id.'/avatars/'.basename($img));
					}
					if(strpos($ad->avatar,'builderengine/public/img/avatar.png') !== FALSE){
						$img = $ad->avatar;
						copy($_SERVER['DOCUMENT_ROOT'].'/builderengine/public/img/'.basename($img),$_SERVER['DOCUMENT_ROOT'].'/files/users/user_'.$user_id.'/avatars/'.basename($img));
					}
					$ad->avatar = base_url().'files/users/user_'.$user_id.'/avatars/'.basename($img);
				}
				$image = array(
					'name' => basename($ad->avatar),
					'size' => filesize(str_replace(base_url(),$_SERVER['DOCUMENT_ROOT'].'/',$ad->avatar)),
					'url' => checkImagePath($ad->avatar),
					'path' => str_replace(base_url(),$_SERVER['DOCUMENT_ROOT'].'/',$ad->avatar)
				);
				array_push($images,$image);
				echo json_encode($images);
			}
		}
	}

	public function order_invoice($module,$order_id)
	{
		$this->check_login();
		$this->load->module('builderpayment/api');
		$this->api->identifyModule($module);
		$order = $this->api->getOrderByID($order_id);
		$data = array(
			'company_name' => $this->BuilderEngine->get_option('be_'.$module.'_company_name'),
			'company_logo' => $this->BuilderEngine->get_option('be_'.$module.'_company_logo'),
			'company_address' => $this->BuilderEngine->get_option('be_'.$module.'_company_address'),
			'company_zip' => $this->BuilderEngine->get_option('be_'.$module.'_company_zip'),
			'company_city' => $this->BuilderEngine->get_option('be_'.$module.'_company_city'),
			'company_country' => $this->BuilderEngine->get_option('be_'.$module.'_company_country'),
			'company_phone' => $this->BuilderEngine->get_option('be_'.$module.'_company_phone'),
			'company_email' => $this->BuilderEngine->get_option('be_'.$module.'_company_email'),
			'company_tax_vat_number' => $this->BuilderEngine->get_option('be_'.$module.'_company_tax_vat_number'),
			'company_bank_account_number' => $this->BuilderEngine->get_option('be_'.$module.'_company_bank_account_number'),
			'payment_option' => $this->BuilderEngine->get_option('be_'.$module.'_company_payment_option'),
			'additional_info' => $this->BuilderEngine->get_option('be_'.$module.'_company_additional_info'),
			'order' => $order,
			'products' => $order->product->get(),
			'currency' => new Currency($order->currency),
			'custom_fields' => json_decode($order->custom_data),
			'order_bill_address' => $order->billingAddress->get(),
			'order_ship_address' => $order->shippingAddress->get()
		);
		$this->load->view('order_invoice', $data);
	}

	public function invoices($order_id,$object_type,$object_id = null)
	{
		//$company = new Booking_company();
		$this->check_login();
		if($object_type == 'event'){
			$object = new Booking_event($object_id);
			$order = new Booking_event_order($order_id);
			$company = 'booking_'.$object_type;
		}
		if($object_type == 'service'){
			$object = new Booking_service($object_id);
			$order = new Booking_service_order($order_id);
			$company = 'booking_'.$object_type;
		}
		if($object_type == 'room'){
			$object = new Booking_room($object_id);
			$order = new Booking_room_order($order_id);
			$company = 'booking_'.$object_type;
		}
		//$data['company'] = $company->get();
		$data = array(
			'company_name' => $this->BuilderEngine->get_option('be_'.$company.'s_company_name'),
			'company_logo' => $this->BuilderEngine->get_option('be_'.$company.'s_company_logo'),
			'company_address' => $this->BuilderEngine->get_option('be_'.$company.'s_company_address'),
			'company_zip' => $this->BuilderEngine->get_option('be_'.$company.'s_company_zip'),
			'company_city' => $this->BuilderEngine->get_option('be_'.$company.'s_company_city'),
			'company_country' => $this->BuilderEngine->get_option('be_'.$company.'s_company_country'),
			'company_phone' => $this->BuilderEngine->get_option('be_'.$company.'s_company_phone'),
			'company_email' => $this->BuilderEngine->get_option('be_'.$company.'s_company_email'),
			'company_tax_vat_number' => $this->BuilderEngine->get_option('be_'.$company.'s_company_tax_vat_number'),
			'company_bank_account_number' => $this->BuilderEngine->get_option('be_'.$company.'s_company_bank_account_number'),
			'payment_option' => $this->BuilderEngine->get_option('be_'.$company.'s_company_payment_option'),
			'object_type' => $object_type,
			'object' => $object,
			'order' => $order
		);
		$this->load->view($object_type.'_invoice', $data);
	}
}