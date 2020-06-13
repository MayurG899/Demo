<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cp extends Module_Controller
{
	/*
	private $method;

	public function __construct()
	{
		parent::__construct();

		if($this->uri->segment(1) === 'cp')
		{
			$modules = new Module();

			foreach($modules->get() as $module)
			{
				if($this->uri->segment(1) === 'cp' && $this->uri->segment(2) === $module->folder && $this->uri->segment(3) !== FALSE)
				{
					$subClass = 'Cp_'.$module->folder;
					$function = $this->uri->segment(3);
					$args = $this->uri->segment(4);
					$this->load->module('cp/cp_'.$subClass);
					if(method_exists($subClass, $function) && is_callable(array($subClass, $function)))
					{
						if($args !== FALSE)
							$this->$subClass->$function($args);
						else
							$this->$subClass->$function();
					}else
						show_404();
				}
			}
		}
	}
	
	public function __call($method, $args)
	{
		if(property_exists($this, $method))
		{
			if(is_callable($this->$method))
			{
			   return call_user_func_array($this->$method, $args);
			}
		}
	}
	*/
    protected function check_login()
    {
        if(!$this->user->is_logged_in())
            redirect(base_url('cp/login'), 'location');
	}

	public function login()
	{
		if($this->user->is_logged_in())
			redirect(base_url('cp/dashboard'),'location');
		else
			$this->load->view('frontend/login.tpl');
	}

    public function logout()
    {
        $this->user->logout(base_url('cp/login'),'location');
    }

    public function register()
    {
        if($this->user->is_logged_in())
            redirect(base_url('cp/dashboard'), 'location');
		else
			$this->load->view('frontend/register.tpl');
    }

    public function getLocation($ip)
    {
        $url = "http://ip-api.com/json/" . $ip;
        $json = file_get_contents($url);

        $ip_data = json_decode($json, true);
        return $ip_data;
    }

	public function dashboard()
	{
		$this->check_login();
		$this->load->view('frontend/dashboard.tpl');
	}

	public function info()
	{
		$this->check_login();
		$this->load->view('frontend/info.tpl');
	}

	public function user($user_id = null)
	{
		$this->check_login();
		if(!isset($user_id))
			show_404();
		$this->load->view('frontend/user_profile.tpl');
	}

    public function recover_password($token = FALSE)
    {

        $this->users->validate_password_reset_token($token);
        if (!$token)
		{
            redirect(base_url('/'), 'location');
        }
		
        $data['error'] = false;
		
        if ($_POST && $token)
		{
            if ($_POST['password'] == $_POST['password_re'])
			{
                $this->users->reset_password($token, $_POST['password']);
                redirect(base_url('cp/login'), 'location');
            }
			else
				$data['error'] = true;
        }

        $this->load->model("builderengine");
        $data['builderengine'] = &$this->builderengine;
        if($data['builderengine']->get_option('user_login_background_img'))
            $url = $data['builderengine']->get_option('user_login_background_img');
        else
            $url = base_url('files/be_demo/basic/images/green-forest-road.jpg');

        $data['url'] = $url;
        $data['token'] = $token;
        $this->load->view('frontend/reset_password',$data);
    }

	#################### User Management #####################################

    public function edit($user_id = null)
    {
		$this->check_login();
		if(!isset($user_id))
			show_404();
		if(!$this->user->is_member_of(1) && $user_id != $this->user->get_id())
			show_404();
		$this->load->view('frontend/edit_user.tpl');
    }

    public function settings()
    {
        $this->check_login();
		$this->load->view('frontend/edit_user_settings.tpl');
    }

    public function approve_account($token = false)
    {
		$this->load->model('users');
        $this->users->validate_registration_token($token);
        if (!$token) {
            redirect(base_url('/'), 'location');
        }
        $user = $this->users->activation_account($token);
		$this->users->approve_module_access($user->id);
        $this->user->initialize($user->id);
        redirect(base_url('cp/login'), 'location');
    }

	public function orders()
	{
		$this->check_login();
		$this->load->view('frontend/orders.tpl');
	}

	public function subscriptions()
	{
		$this->check_login();
		$this->load->view('frontend/subscriptions.tpl');
	}

	public function cancel_subscription($id)
	{
		$this->check_login();
		$u = new UserSubscription();
		$subscription = $u->where('id',$id)->get();
		if($subscription->exists())
			$subscription->cancel();
		redirect(base_url('cp/subscriptions'), 'location');
	}
	############### Blog ################################

	public function blog($function,$param = null)
	{
		$this->check_login();
		$this->load->module('cp/cp_blog');
		if(method_exists('Cp_blog', $function) && is_callable(array('Cp_blog', $function))){
			if($param)
				$this->cp_blog->$function($param);
			else
				$this->cp_blog->$function();
		}else
			show_404();
	}
	############### Booking Events,Rooms and Memberships ################################

	public function booking($function,$param = null)
	{
		$this->check_login();
		$this->load->module('cp/cp_booking');
		if(method_exists('Cp_booking', $function) && is_callable(array('Cp_booking', $function))){
			if($param)
				$this->cp_booking->$function($param);
			else
				$this->cp_booking->$function();
		}else
			show_404();
	}
	############### Booking Ecommerce ################################

	public function ecommerce($function,$param = null)
	{
		$this->check_login();
		$this->load->module('cp/cp_ecommerce');
		if(method_exists('Cp_ecommerce', $function) && is_callable(array('Cp_ecommerce', $function))){
			if($param)
				$this->cp_ecommerce->$function($param);
			else
				$this->cp_ecommerce->$function();
		}else
			show_404();
	}

	public function x($function,$param = null)
	{
		$this->check_login();
		if(file_exists($_SERVER['DOCUMENT_ROOT'].'/modules/cp/controllers/Cp_x.php')){
			$this->load->module('cp/cp_x');
			if(method_exists('Cp_x', $function) && is_callable(array('Cp_x', $function))){
				if($param)
					$this->cp_x->$function($param);
				else
					$this->cp_x->$function();
			}
		}else
			show_404();
	}
}