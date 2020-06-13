<?php
	class Booking_event_order extends DataMapper
	{
		var $table = 'be_booking_event_orders';

		public function create($data)
		{
			$this->user_id = $data['user_id'];
			$this->event_id = $data['event_id'];
			$this->price = $data['price'];
			$this->paid = $data['paid'];
			$this->tickets = $data['tickets'];
			$this->paid_toggle = $data['paid_toggle'];
			$this->username = $data['username'];
			$this->email = $data['email'];
			$this->phone = $data['phone'];
			$this->address = $data['address'];
			$this->city = $data['city'];
			$this->country = $data['country'];
			$this->zip = $data['zip'];
			$this->payment_method = $data['payment_method'];
			$this->time_created = time();
			$this->time_paid = $data['time_paid'];
			$this->trans_id = $data['trans_id'];
			$this->save();
		}
	}
?>