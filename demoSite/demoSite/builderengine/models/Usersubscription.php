<?php 	/***********************************************************
 * BuilderEngine v3.1.0
 * ---------------------------------
 * BuilderEngine CMS Platform - Radian Enterprise Systems Limited
 * Copyright Radian Enterprise Systems Limited 2012-2015. All Rights Reserved.
 *
 * http://www.builderengine.com
 * Email: info@builderengine.com
 * Time: 2015-08-31 | File version: 3.1.0
 *
 ***********************************************************/

class UserSubscription extends DataMapper
{
    var $table = 'be_user_subscriptions';

	var $has_one = array(
		'user' => array(
			'class' => 'User',
			'other_field' => 'subscribed',
			'join_self_as' => 'subscribed',
			'join_other_as' => 'user',
		),
	);

	var $has_many = array();

	function create($data)
	{
		$this->user_id = isset($data['user_id'])?$data['user_id']:get_active_user_id();
		$this->module = isset($data['module'])?$data['module']:NULL;
		$this->custom_data = isset($data['custom_data'])?$data['custom_data']:NULL;
		$this->type = isset($data['type'])?$data['type']:'onetime';
		$this->status = isset($data['status'])?$data['status']:'active';
		$this->time_created = time();
		$this->expiry_time = isset($data['expiry_time'])?$data['expiry_time']:NULL;
		$this->save();
	}

	function check()
	{
		foreach($this->get() as $subscription)
		{
			if($subscription->status == 'active' || $subscription->status == 'canceled')
			{
				if($subscription->module == 'booking_memberships')
				{
					$CI =& get_instance();
					$new_data = '';
					$custom_data = json_decode($subscription->custom_data);
					$membership = new Booking_membership($custom_data->membership_id);
					$subscription_period = explode('-',$membership->subscription_period);
					$period = 'day';
					if(($subscription_period[1] == 'day' && $subscription_period[0] <= 6) || ($subscription_period[1] == 'hour' && $subscription_period[0] > 6))
						$period = 'hour';
					if($subscription_period[1] == 'hour' && $subscription_period[0] <= 6)
						$period = 'minute';
					$last_day_before_expire = strtotime(date('d-m-Y H:i:s',$subscription->expiry_time).'-1 '.$period);
					$two_days_before_expire = strtotime(date('d-m-Y H:i:s',$subscription->expiry_time).'-2 '.$period);
					$five_days_before_expire = strtotime(date('d-m-Y H:i:s',$subscription->expiry_time).'-5 '.$period);
					$six_days_before_expire = strtotime(date('d-m-Y H:i:s',$subscription->expiry_time).'-6 '.$period);

					$subject =  ucfirst($membership->name).' Subscription Expiry Notification';
					$email = $this->user->get()->email;
					$name = ucwords($this->user->get()->first_name.' '.$this->user->get()->first_name);

					if(time() > $six_days_before_expire && time() <= $five_days_before_expire && !isset($custom_data->first_reminder_sent))
					{
						$message = 'Dear '.$name.',<br/> Your <b>'.ucfirst($membership->name).'</b> subscription will expire in 5 '.$period.'s.(on '.date('d-m-Y H:i:s',$subscription->expiry_time).')';
						$this->notify_subscriber($email, $subject, $message, $subscription);
						$custom_data->first_reminder_sent = 'yes';
						$new_data = '<i class="fa fa-info-circle"></i> First expiration reminder sent to user on '.date('d-m-Y G:i:s',time()).'<br/>';
					}
					if(time() > $two_days_before_expire && time() <= $last_day_before_expire && !isset($custom_data->second_reminder_sent))
					{
						$at = ($period == 'day')?'tomorrow at':' at';
						$message = 'Dear '.$name.',<br/> Your <b>'.ucfirst($membership->name).'</b> subscription will expire '.$at.' '.date('H:i:s',$subscription->expiry_time).'.<br/>Please,renew today.';
						$this->notify_subscriber($email, $subject, $message, $subscription);
						$custom_data->second_reminder_sent = 'yes';
						$new_data = '<i class="fa fa-info-circle"></i> Second expiration reminder sent to user on '.date('d-m-Y G:i:s',time()).'<br/>';
					}
					if($subscription->expiry_time <= time() && !isset($custom_data->expire_notification_sent))
					{
						$subscription->expire();
						$CI->load->module('booking_memberships');
						$CI->booking_memberships->downgrade_user_from_usergroups($this->user->get()->id, $membership->usergroups, 'a8f5f167f44f4964e6c998dee827110c');
						$message = 'Dear '.$name.',<br/> Your <b>'.ucfirst($membership->name).'</b> subscription has expired.<br/>Please,renew today.';
						$this->notify_subscriber($email, $subject, $message, $subscription);
						$custom_data->expire_notification_sent = 'yes';
						$new_data = '<i class="fa fa-exclamation-triangle"></i> Subscription Expired on '.date('d-m-Y G:i:s',time()).'<br/>';
					}
					if(isset($custom_data->note))
						$custom_data->note = $custom_data->note.$new_data;
					else
						$custom_data->note = $new_data;
					$subscription->custom_data = json_encode($custom_data);
					$subscription->save();
				}
				if($subscription->module == 'booking_services')
				{
					$CI =& get_instance();
					$new_data = '';
					$custom_data = json_decode($subscription->custom_data);
					$service = new Booking_service($custom_data->service_id);
					$subscription_period = explode('-',$service->subscription_period);
					$period = 'day';
					if(($subscription_period[1] == 'day' && $subscription_period[0] <= 6) || ($subscription_period[1] == 'hour' && $subscription_period[0] > 6))
						$period = 'hour';
					if($subscription_period[1] == 'hour' && $subscription_period[0] <= 6)
						$period = 'minute';
					$last_day_before_expire = strtotime(date('d-m-Y H:i:s',$subscription->expiry_time).'-1 '.$period);
					$two_days_before_expire = strtotime(date('d-m-Y H:i:s',$subscription->expiry_time).'-2 '.$period);
					$five_days_before_expire = strtotime(date('d-m-Y H:i:s',$subscription->expiry_time).'-5 '.$period);
					$six_days_before_expire = strtotime(date('d-m-Y H:i:s',$subscription->expiry_time).'-6 '.$period);

					$subject =  ucfirst($service->name).' Subscription Expiry Notification';
					$email = $this->user->get()->email;
					$name = ucwords($this->user->get()->first_name.' '.$this->user->get()->first_name);

					if(time() > $six_days_before_expire && time() <= $five_days_before_expire && !isset($custom_data->first_reminder_sent))
					{
						$message = 'Dear '.$name.',<br/> Your <b>'.ucfirst($service->name).'</b> subscription will expire in 5 '.$period.'s.(on '.date('d-m-Y H:i:s',$subscription->expiry_time).')';
						$this->notify_subscriber($email, $subject, $message, $subscription);
						$custom_data->first_reminder_sent = 'yes';
						$new_data = '<i class="fa fa-info-circle"></i> First expiration reminder sent to user on '.date('d-m-Y G:i:s',time()).'<br/>';
					}
					if(time() > $two_days_before_expire && time() <= $last_day_before_expire && !isset($custom_data->second_reminder_sent))
					{
						$at = ($period == 'day')?'tomorrow at':' at';
						$message = 'Dear '.$name.',<br/> Your <b>'.ucfirst($service->name).'</b> subscription will expire '.$at.' '.date('H:i:s',$subscription->expiry_time).'.<br/>Please,renew today.';
						$this->notify_subscriber($email, $subject, $message, $subscription);
						$custom_data->second_reminder_sent = 'yes';
						$new_data = '<i class="fa fa-info-circle"></i> Second expiration reminder sent to user on '.date('d-m-Y G:i:s',time()).'<br/>';
					}
					if($subscription->expiry_time <= time() && !isset($custom_data->expire_notification_sent))
					{
						$subscription->expire();
						$CI->load->module('booking_services');
						$CI->booking_services->downgrade_user_from_usergroups($this->user->get()->id, $service->usergroups, 'a8f5f167f44f4964e6c998dee827110c');
						$message = 'Dear '.$name.',<br/> Your <b>'.ucfirst($service->name).'</b> subscription has expired.<br/>Please,renew today.';
						$this->notify_subscriber($email, $subject, $message, $subscription);
						$custom_data->expire_notification_sent = 'yes';
						$new_data = '<i class="fa fa-exclamation-triangle"></i> Subscription Expired on '.date('d-m-Y G:i:s',time()).'<br/>';
					}
					if(isset($custom_data->note))
						$custom_data->note = $custom_data->note.$new_data;
					else
						$custom_data->note = $new_data;
					$subscription->custom_data = json_encode($custom_data);
					$subscription->save();
				}
			}
		}
	}

	function notify_subscriber($email, $subject, $message, $subscription)
	{
		$CI =& get_instance();
		$CI->load->model('users');
		$CI->users->send_email($email, $subject, $message, 'email_template', false, false, false, $subscription->module);
	}

	function expire()
	{
		$this->status = 'expired';
		$this->save();
	}

	function cancel()
	{
		$custom_data = json_decode($this->custom_data);
		if(!isset($custom_data->terminated) || (isset($custom_data->terminated) && $custom_data->terminated == 'no')){
			if(isset($custom_data->note))
				$custom_data->note = $custom_data->note.'<br/><i class="fa fa-times"></i> Canceled by User on '.date('d-m-Y G:i:s',time());
			else
				$custom_data->note = '<i class="fa fa-times"></i> Canceled by User on '.date('d-m-Y G:i:s',time());
			$this->custom_data = json_encode($custom_data);
			$this->type = 'onetime';
			$this->status = 'canceled';
			$this->save();
		}
	}

	function renew()
	{
		// TODO
		$this->status = 'active';
		$this->save();
	}
}
?>