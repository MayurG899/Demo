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


class User_booking extends BE_Controller
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
        if($this->builderengine->get_option('user_dashboard_booking_events') != 'yes')
            redirect("user/main/dashboard", 'location');
		*/
		if($this->user->is_logged_in())
			redirect(base_url("cp/dashboard"), 'location');
		else
			redirect(base_url("cp/login"), 'location');
    }

    public function view_booking_orders()
    {
        if(!$this->user->is_logged_in())
            redirect("/user/main/userLogin", 'location');
        else{
			$this->load->module('builderpayment/api');
			$this->api->identifyModule('booking_events');
			$o = new Booking_event_order();
			$data['orders'] = $o->where('user_id',$this->user->get_id())->order_by('time_created','DESC')->get();
			//$data['orders'] = $this->api->getOrders();
			//$o = new Booking_event_order();
			//$data['orders'] = $o->get();
			$data['current_page'] = 'booking';
			$data['current_child_page'] = 'booking_orders';
            $this->show->set_user_backend();
            $this->show->user_backend('booking_events/booking_orders',$data);
        }
    }

	public function view_event_invoice($order_id)
	{
        if(!$this->user->is_logged_in())
            redirect("/user/main/userLogin", 'location');

		$this->load->module('builderpayment/api');
		$this->api->identifyModule('booking_events');

		$order = $this->api->getOrderByID($order_id);

		$data['order'] = $order;
		$data['currency'] = new Currency($order->currency);
		$data['custom_fields'] = json_decode($order->custom_data);
		$data['order_bill_address'] = $order->billingAddress->get();
		$data['order_ship_address'] = $order->shippingAddress->get();
		$this->show->set_user_backend();
		$this->show->user_backend('booking_events/view_booking_invoice',$data);
	}

	public function add_event($event_id = false)
	{
		$user_id = $this->user->get_id();
		if($event_id){
			$data['page'] = 'Edit';
			$event = new Booking_event($event_id);
		}else{
			$data['page'] = 'Add';
			$event = new Booking_event();
		}
		if($_POST){
			if(isset($_FILES['image']) && !empty($_FILES['image']['name']) )
			{
				$file_name = $_FILES['image']['name'];
				$file_size =$_FILES['image']['size'];
				$file_tmp = $_FILES['image']['tmp_name'];
				$file_type = $_FILES['image']['type'];   
				$file_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
				$extensions = array("jpeg","jpg","png"); 

				if(in_array($file_ext,$extensions )=== false)
					$errors[] ="This extension is not allowed, please choose a JPEG,JPG or PNG file.";
				if($file_size > 1000000)
					$errors[] ='File size must be less than 1 MB';	
				if(empty($errors)==true){
					if(!is_dir("files/users"))
						mkdir("files/users");
					if(!is_dir("files/users/user_".$user_id))
						mkdir("files/users/user_".$user_id);
					 if(!is_dir("files/users/user_".$user_id."/booking_events"))
						mkdir("files/users/user_".$user_id."/booking_events");
					 if(!is_dir("files/users/user_".$user_id."/booking_events/images"))
						mkdir("files/users/user_".$user_id."/booking_events/images");
					move_uploaded_file($file_tmp, $_SERVER['DOCUMENT_ROOT']."/files/users/user_".$user_id."/booking_events/images/".$file_name);
				
					$_POST['image'] = base_url()."files/users/user_".$user_id."/booking_events/images/".$file_name;
					unset($_FILES['image']);
				}
			}
			elseif(isset($_POST['image1']))
			{
				$_POST['image'] = $_POST['image1'];
			}
			else
				$_POST['image'] = $event->image;
			
			/*
			if(!empty($_POST['zip']))
				$_POST['location'] = $_POST['address'].', '.$_POST['city'].', '.$_POST['zip'].', '.$_POST['country'];
			else
				$_POST['location'] = $_POST['address'].', '.$_POST['city'].', '.$_POST['country'];
			*/
			$event->create($_POST);
			redirect(base_url('user/booking/view_events/'), 'location');
		}
		$data['title'] = 'Add/Edit event';
		$data['current_page'] = 'booking';
		$data['current_child_page'] = 'add_event';
		$data['object'] = $event; 
		$this->show->set_user_backend();
		$this->show->user_backend('booking_events/add_booking_event',$data);		
	}

	public function delete_event($event_id)
	{
		$event = new Booking_event($event_id);
		$as = new Booking_event_addon_service();
		$addonServices = $as->where('event_id',$event_id)->get();
		$addonServices->delete_all();
		$i = new Booking_event_image();
		$additional_images = $i->where('event_id',$event_id)->get();
		$additional_images->delete_all();
		$ed = new Booking_event_early_discount();
		$earlyDiscounts = $ed->where('event_id',$event_id)->get();
		$earlyDiscounts->delete_all();
		$ff = new Booking_event_featured_field();
		$featFields = $ff->where('event_id',$event_id)->get();
		$featFields ->delete_all();
		$gd = new Booking_event_group_discount();
		$groupDiscounts = $gd->where('event_id',$event_id)->get();
		$groupDiscounts->delete_all();
		$ug = new Booking_event_usergroup_discount();
		$userGroupDiscounts = $ug->where('event_id',$event_id)->get();
		$userGroupDiscounts->delete_all();
		$v = new Booking_event_voucher();
		$vouchers = $v->where('event_id',$event_id)->get();
		$vouchers->delete_all();

		$event->delete();
		redirect(base_url('user/booking/view_events'), 'location');
	}

	public function view_events()
	{
		
		$events = new Booking_event();
		$data['events'] = $events->where('user_id',$this->user->get_id())->get();
		$data['current_page'] = 'booking';
		$data['current_child_page'] = 'view_events';
		$this->show->set_user_backend();
		$this->show->user_backend('booking_events/view_booking_events',$data);		
	}

	public function view_my_events()
	{
		
		$events = new Booking_event();
		$data['events'] = $events->where('user_id',$this->user->get_id())->get();
		$data['current_page'] = 'booking';
		$data['current_child_page'] = 'view_events';
		$this->show->set_user_backend();
		$this->show->user_backend('booking_events/my_events_calendar',$data);		
	}

}
/* End of file user_ecommerce.php */
/* Location: ./application/controllers/user_ecommerce.php */