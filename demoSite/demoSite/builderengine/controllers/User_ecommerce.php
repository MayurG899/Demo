<?php
/***********************************************************
 * BuilderEngine Community Edition v1.0.0
 * ---------------------------------
 * BuilderEngine CMS Platform - BuilderEngine Limited
 * Copyright BuilderEngine Limited 2012-2017. All Rights Reserved.
 *
 * http://www.builderengine.com
 * Email: info@builderengine.com
 * Time: 2017-01-17 | File version: 1.0.0
 *
 ***********************************************************/

if (!defined('BASEPATH')) exit('No direct script access allowed');


class User_ecommerce extends BE_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
    */
    function __construct()
    {
        parent::__construct();
		/*
        $this->user->is_verified();
        $this->load->model('builderengine');
        if($this->builderengine->get_option('user_dashboard_activ') != 'yes')
            redirect("/", 'location');
        if($this->builderengine->get_option('user_dashboard_ecommerce') != 'yes')
            redirect("user/main/dashboard", 'location');
		*/
		if($this->user->is_logged_in())
			redirect(base_url("cp/dashboard"), 'location');
		else
			redirect(base_url("cp/login"), 'location');
    }

    public function view_orders()
    {
        if(!$this->user->is_logged_in())
            redirect("/user/main/userLogin", 'location');
        else{
			$this->load->module('builderpayment/api');
			$this->api->identifyModule('ecommerce');

			$data['orders'] = $this->api->getOrders();
			$data['current_page'] = 'ecommerce';
			$data['current_child_page'] = 'ecommerce_orders';
            $this->show->set_user_backend();
            $this->show->user_backend('ecommerce/orders',$data);
        }
    }

	public function view_invoice($order_id)
	{
        if(!$this->user->is_logged_in())
            redirect("/user/main/userLogin", 'location');

		$this->load->module('builderpayment/api');
		$this->api->identifyModule('ecommerce');

		$order = $this->api->getOrderByID($order_id);

		$data['order'] = $order;
		$data['currency'] = new Currency($order->currency);
		$data['custom_fields'] = json_decode($order->custom_data);
		$data['order_bill_address'] = $order->billingAddress->get();
		$data['order_ship_address'] = $order->shippingAddress->get();
		$this->show->set_user_backend();
		$this->show->user_backend('ecommerce/view_invoice',$data);
	}

	public function view_wishlist()
	{
		$this->load->model('ecommerce_product');
		$member_id = $this->user->get_id();
		$wishlist = $this->ecommerce_product->get_wishlist($member_id);
		$data['wishes'] = $wishlist;
		$data['currency'] = new Currency($this->BuilderEngine->get_option('be_ecommerce_settings_currency'));
		$data['current_page'] = 'ecommerce';
		$data['current_child_page'] = 'ecommerce_wishlist';
		$this->show->set_user_backend();
		$this->show->user_backend('ecommerce/wishlist',$data);		
	}
}
/* End of file user_ecommerce.php */
/* Location: ./application/controllers/user_ecommerce.php */