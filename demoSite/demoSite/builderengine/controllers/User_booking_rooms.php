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


class User_booking_rooms extends BE_Controller
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
        if($this->builderengine->get_option('user_dashboard_booking_rooms') != 'yes')
            redirect("user/main/dashboard", 'location');
		*/
		if($this->user->is_logged_in())
			redirect(base_url("cp/dashboard"), 'location');
		else
			redirect(base_url("cp/login"), 'location');
    }

	public function calendar()
	{
		$bookings = new BookingRoom();
		$departments = new BookingRoomDepartment();
		$data['bookings'] = $bookings->get();
		$data['departments'] = $departments->where('active','yes')->order_by('name','asc')->get();
		$data['current_page'] = 'booking_rooms';
		$data['current_child_page'] = 'calendar';
		$this->show->set_user_backend();
		$this->show->user_backend('booking_rooms/calendar',$data);
	}

	public function delete_booking($id)
	{
		$booking = new BookingRoom($id);
		$booking->delete();
		redirect(base_url('user/booking_rooms/calendar'),'location');
	}
}
/* End of file user_ecommerce.php */
/* Location: ./application/controllers/user_ecommerce.php */