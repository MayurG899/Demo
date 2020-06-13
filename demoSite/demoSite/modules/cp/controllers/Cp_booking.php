<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cp_booking extends Module_Controller
{

    protected function check_login()
    {
        if(!$this->user->is_logged_in())
            redirect(base_url('cp/login'), 'location');
	}

	public function events($type = '', $id = null)
	{
		$this->check_login();
		if($type == 'list')
			$this->load->view('frontend/booking_events.tpl');
		if($type == 'calendar')
			$this->load->view('frontend/booking_events_calendar.tpl');
		if($type == 'mycalendar')
			$this->load->view('frontend/booking_events_my_calendar.tpl');
		if($type == 'add' || $type =='edit')
			$this->load->view('frontend/booking_events_add_edit.tpl');
		if($type == 'orders')
			$this->load->view('frontend/booking_events_orders.tpl');
	}

	public function rooms($type = '', $id = null)
	{
		$this->check_login();
		if($type == 'list')
			$this->load->view('frontend/booking_rooms.tpl');
		if($type == 'calendar')
			$this->load->view('frontend/booking_rooms_calendar.tpl');
		if($type == 'add' || $type =='edit')
			$this->load->view('frontend/booking_rooms_add_edit.tpl');
		if($type == 'orders')
			$this->load->view('frontend/booking_rooms_orders.tpl');
	}

	public function memberships($type = '', $id = null)
	{
		$this->check_login();
		if($type == 'list')
			$this->load->view('frontend/booking_memberships.tpl');
		if($type == 'add' || $type =='edit')
			$this->load->view('frontend/booking_memberships_add_edit.tpl');
		if($type == 'orders')
			$this->load->view('frontend/booking_memberships_orders.tpl');
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
		redirect(base_url('cp/booking/events/list'), 'location');
	}

	public function delete_room($id)
	{
		$booking = new BookingRoom($id);
		$booking->delete();
		redirect(base_url('cp/booking/rooms/calendar'),'location');
	}

	public function delete_membership($id)
	{
		$booking = new BookingMembership($id);
		$booking->delete();
		redirect(base_url('cp/booking/memberships/list'),'location');
	}

}