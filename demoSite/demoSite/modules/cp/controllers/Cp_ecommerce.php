<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cp_ecommerce extends Module_Controller
{

    protected function check_login()
    {
        if(!$this->user->is_logged_in())
            redirect(base_url('cp/login'), 'location');
	}

	public function orders()
	{
		$this->check_login();
		$this->load->view('frontend/ecommerce_orders.tpl');
	}

	public function mywishlist()
	{
		$this->check_login();
		$this->load->view('frontend/ecommerce_wishlist.tpl');
	}
}