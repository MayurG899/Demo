<?php
class Booking_membership extends DataMapper 
{
	var $table = 'be_booking_memberships';

	/*
	var $has_one = array(
		''
	);
	*/
	var $has_many = array(
		'additional_image' => array(
			'class' => 'Booking_membership_image',
			'other_field' => 'membership',
			'join_self_as' => 'membership',
			'join_other_as' => 'image'
		),
		'earlydiscount' => array(
			'class' => 'Booking_membership_early_discount',
			'other_field' => 'membership',
			'join_self_as' => 'membership',
			'join_other_as' => 'earlydiscount'
		),
		'groupdiscount' => array(
			'class' => 'Booking_membership_group_discount',
			'other_field' => 'membership',
			'join_self_as' => 'membership',
			'join_other_as' => 'groupdiscount',
		),
		'voucher' => array(
			'class' => 'Booking_membership_voucher',
			'other_field' => 'membership',
			'join_self_as' => 'membership',
			'join_other_as' => 'voucher',
		),
		'addonservice' => array(
			'class' => 'Booking_membership_addon_service',
			'other_field' => 'membership',
			'join_self_as' => 'membership',
			'join_other_as' => 'addonservice'
		),
		'usergroupdiscount' => array(
			'class' => 'Booking_membership_usergroup_discount',
			'other_field' => 'membership',
			'join_self_as' => 'membership',
			'join_other_as' => 'usergroupdiscount',
		),		
		'featured_field' => array(
			'class' => 'Booking_membership_featured_field',
			'other_field' => 'membership_field',
			'join_self_as' => 'membership',
			'join_other_as' => 'field',
			'join_table' => 'booking_membership_featured_fields'
		),
		'questionnaire_field' => array(
			'class' => 'Booking_membership_questionnaire_field',
			'other_field' => 'membership',
			'join_self_as' => 'membership',
			'join_other_as' => 'field',
			'join_table' => 'booking_membership_questionnaire_fields'
		),
	);

	public function create($data, $edit = false)
	{
		$data['early_discount'] = 'no';
		$data['available_days'] = '';
		$start_date = DateTime::createFromFormat('m/d/Y',$data['start_date']);
		$start_date = $start_date->format("Y-m-d");

		$end_date = DateTime::createFromFormat('m/d/Y',$data['end_date']);
		$end_date = $end_date->format("Y-m-d");

		$this->user_id = get_active_user_id();
		$this->name = $data['name'];
		$this->slug = $data['slug'];
		$this->description = ChEditorfix($data['description']);
		$this->image = !empty($data['image'])?$data['image']:base_url('builderengine/public/img/photo_placeholder.png');
		$this->categories = $data['categories'];
		$this->price = $data['price'];
		$this->currency_id = $data['currency_id'];
		$this->vat = $data['vat'];
		$this->show_vat = $data['show_vat'];
		$this->start_date = $start_date;
		$this->end_date = $end_date;
		$this->capacity = $data['capacity'];
		$this->featured = $data['featured'];
		$this->active = $data['active'];
		$this->usergroups = $data['usergroups'];
		$this->subscription_period = $data['subscription_period'];
		$this->pro_rata = $data['pro_rata'];
		$this->recurrence_rate = isset($data['recurrence_rate'])?$data['recurrence_rate']:'';
		$this->early_discount = $data['early_discount'];
		$this->voucher_discount = $data['voucher_discount'];
		$this->group_discount = $data['group_discount'];
		$this->usergroup_discount = $data['usergroup_discount'];
		$this->addon_service = $data['addon_service'];
		$this->questionnaire = $data['questionnaire'];
		$this->approval = $data['approval'];
		$this->time_created = time();
		$this->save();
		if($data['edit'] == 'Edit')
			$edit = true;
		if(isset($data['images']))
			$this->add_images($data['images'], $edit);
		//if($data['early_discount'] == 'yes')
			$this->add_early_discount($data['early_discount'], $data['eDays'], $data['eDiscount'], $data['eOpt'], $edit);
		//if($data['group_discount'] == 'yes')
			$this->add_group_discount($data['group_discount'], $data['gName'], $data['gNum'], $data['gDiscount'], $data['gOpt'], $edit);
		//if($data['voucher_discount'] == 'yes')
			$this->add_voucher_discount($data['voucher_discount'], $data['vName'], $data['vCode'], $data['vEndDate'], $data['vDiscount'], $data['vOpt'], $edit);
		//if($data['addon_service'] == 'yes')
			$this->add_service($data['addon_service'], $data['aName'], $data['aPrice'], $data['aOpt'], $edit);
		//if($data['usergroup_discount'] == 'yes')
			$this->add_usergroup_discount($data['usergroup_discount'], $data['ugName'], $data['ugDiscount'], $data['ugOpt'], $edit);
		//if($data['questionnaire'] == 'yes')
			$this->add_questionnaire_fields($data['questionnaire'], $data['qName'], $data['qType'], $data['qRequired'], $data['qOptions'], $data['qOrder'], $edit);
	}

	public function add_images($images, $edit = false)
	{
		if($edit == true)
		{
			$current_images = new Booking_membership_image();
			$current_images = $current_images->where('membership_id', $this->id)->get();
			$current_images->delete_all();
		}
		foreach($images as $image)
		{
			$membership_image = new Booking_membership_image();
			$membership_image = $membership_image->where('membership_id', $this->id)->where('url', $image)->get();
			if(!$membership_image->exists())
			{
				$membership_image = new Booking_membership_image();
				$membership_image->membership_id = $this->id;
				$membership_image->url = $image;
				$membership_image->save();
			}
		}
	}

	public function add_early_discount($earlyDiscount, $eDays, $eDiscount, $eOpt, $edit = false)
	{
		if($edit == true)
		{
			$current_early_discount = new Booking_membership_early_discount();
			$current_early_discount = $current_early_discount->where('membership_id', $this->id)->get();
			$current_early_discount->delete_all();
		}
		$early_discount = new Booking_membership_early_discount();
		$early_discount = $early_discount->where('membership_id', $this->id)->get();
		if($earlyDiscount == 'yes' && !$early_discount->exists())
		{
			$early_discount = new Booking_membership_early_discount();
			$early_discount->membership_id = $this->id;
			$early_discount->num_days = $eDays;
			$early_discount->price = $eDiscount;
			$early_discount->price_opt = $eOpt;
			$early_discount->save();
		}
	}

	public function add_group_discount($groupDiscount, $gName, $gNumPersons, $gDiscount, $gOpt, $edit = false)
	{
		if($edit == true)
		{
			$current_group_discount = new Booking_membership_group_discount();
			$current_group_discount = $current_group_discount->where('membership_id', $this->id)->get();
			$current_group_discount->delete_all();
		}
		$group_discount = new Booking_membership_group_discount();
		$group_discount = $group_discount->where('membership_id', $this->id)->get();
		if($groupDiscount == 'yes' && !$group_discount->exists())
		{
			$group_discount = new Booking_membership_group_discount();
			$group_discount->membership_id = $this->id;
			$group_discount->name = $gName;
			$group_discount->num_persons = $gNumPersons;
			$group_discount->price = $gDiscount;
			$group_discount->price_opt = $gOpt;
			$group_discount->save();
		}
	}

	public function add_voucher_discount($voucherDiscount, $vName, $vCode, $vEndDate, $vDiscount, $vOpt, $edit = false)
	{
		if($edit == true)
		{
			$current_voucher_discount = new Booking_membership_voucher();
			$current_voucher_discount = $current_voucher_discount->where('membership_id', $this->id)->get();
			$current_voucher_discount->delete_all();
		}
		$voucher_discount = new Booking_membership_voucher();
		$voucher_discount = $voucher_discount->where('membership_id', $this->id)->get();
		if($voucherDiscount == 'yes' && !$voucher_discount->exists())
		{
			$count = count($vName);
			if($count > 0){
				foreach($vName as $k => $v){
					$expiryDate = DateTime::createFromFormat('m/d/Y',$vEndDate[$k]);
					$expiryDate = $expiryDate->format("Y-m-d");

					$voucher_discount = new Booking_membership_voucher();
					$voucher_discount->membership_id = $this->id;
					$voucher_discount->name = $vName[$k];
					$voucher_discount->code = $vCode[$k];
					$voucher_discount->expiry_date = $expiryDate;
					$voucher_discount->price = $vDiscount[$k];
					$voucher_discount->price_opt = $vOpt[$k];
					$voucher_discount->save();
				}
			}
		}
	}

	public function add_service($addonService, $aName, $aDiscount, $aOpt, $edit = false)
	{
		if($edit == true)
		{
			$current_service = new Booking_membership_addon_service();
			$current_service = $current_service->where('membership_id', $this->id)->get();
			$current_service->delete_all();
		}
		$service = new Booking_membership_addon_service();
		$service = $service->where('membership_id', $this->id)->get();
		if($addonService == 'yes' && !$service->exists())
		{
			$count = count($aName);
			if($count > 0){
				foreach($aName as $k => $v){
					$service = new Booking_membership_addon_service();
					$service->membership_id = $this->id;
					$service->name = $aName[$k];
					$service->price = $aDiscount[$k];
					$service->price_opt = $aOpt[$k];
					$service->save();
				}
			}
		}
	}

	public function add_usergroup_discount($userGroupDiscount, $ugName, $ugDiscount, $ugOpt, $edit = false)
	{
		if($edit == true)
		{
			$current_usergroup_discount = new Booking_membership_usergroup_discount();
			$current_usergroup_discount = $current_usergroup_discount->where('membership_id', $this->id)->get();
			$current_usergroup_discount->delete_all();
		}
		$usergroup_discount = new Booking_membership_usergroup_discount();
		$usergroup_discount = $usergroup_discount->where('membership_id', $this->id)->get();
		if($userGroupDiscount == 'yes' && !$usergroup_discount->exists())
		{
			$count = count($ugName);
			if($count > 0){
				foreach($ugName as $k => $v){
					$usergroup_discount = new Booking_membership_usergroup_discount();
					$usergroup_discount->membership_id = $this->id;
					$usergroup_discount->usergroup_name = $ugName[$k];
					$usergroup_discount->price = $ugDiscount[$k];
					$usergroup_discount->price_opt = $ugOpt[$k];
					$usergroup_discount->save();
				}
			}
		}
	}

	public function add_questionnaire_fields($questionnaire, $qName, $qType, $qRequired, $qOptions, $qOrder, $edit = false)
	{
		if($edit == true)
		{
			$current_questionnaire = new Booking_membership_questionnaire_field();
			$current_questionnaire = $current_questionnaire->where('membership_id', $this->id)->get();
			$current_questionnaire->delete_all();
		}
		$new_questionnaire = new Booking_membership_questionnaire_field();
		$new_questionnaire = $new_questionnaire->where('membership_id', $this->id)->get();
		if($questionnaire == 'yes' && !$new_questionnaire->exists())
		{
			$count = count($qName);
			if($count > 0){
				foreach($qName as $k => $v){
					$new_questionnaire = new Booking_membership_questionnaire_field();
					$new_questionnaire->membership_id = $this->id;
					$new_questionnaire->name = $qName[$k];
					$new_questionnaire->type = $qType[$k];
					$new_questionnaire->required = $qRequired[$k];
					$new_questionnaire->options = $qOptions[$k];
					$new_questionnaire->order = $qOrder[$k];
					$new_questionnaire->save();
				}
			}
		}
	}

	public function get_questionnaire_fields()
	{
		$output = '';
		$fields = $this->questionnaire_field->order_by('order','asc')->get();
		if($fields->exists())
		{
			foreach($fields as $field)
			{
				if($field->type == 'select')
				{
					$asterisk = ($field->required == 'yes')?'*':'';
					$required = ($field->required == 'yes')?' required':'';
					$label = '<label class="" for="'.str_replace(' ','_',$field->name).'">'.ucfirst($field->name).' '.$asterisk.'</label>';
					$generated_field = '
						<select id="'.$field->type.$field->id.'" class="form-control form-control-be-40" name="'.str_replace(' ','_',$field->name).'" '.$required.'>
							<option value="">Select</option>
						';
						$options = explode(',',$field->options);
						foreach($options as $option){
							$generated_field .= '<option value="'.$option.'">'.ucfirst($option).'</option>';
						}
					$generated_field .= 
						'</select>';
					$template = '
						<div class="form-group booking-membership-application-form-group">
								'.$label.'
							<div class="test-class">
								'.$generated_field.'
							</div>
						</div>
					';
					$output .= $template;
				}
				if($field->type == 'text' || $field->type == 'number' || $field->type == 'email' || $field->type == 'url')
				{
					$custom_data = '';
					$asterisk = ($field->required == 'yes')?'*':'';
					$required = ($field->required == 'yes')?' required':'';
					$label = '<label class="" for="'.str_replace(' ','_',$field->name).'">'.ucfirst($field->name).' '.$asterisk.'</label>';
					if($field->type == 'url'){
						$field->type = 'text';
						$custom_data = 'data-parsley-type="url"';
					}
					$generated_field = '
						<input id="'.$field->type.$field->id.'" type="'.$field->type.'" class="form-control form-control-be-40" name="'.str_replace(' ','_',$field->name).'" '.$custom_data.' '.$required.'/>';
					$template = '
						<div class="form-group booking-membership-application-form-group">
								'.$label.'
							<div class="test-class">
								'.$generated_field.'
							</div>
						</div>
					';
					$output .= $template;
				}
				if($field->type == 'textarea')
				{
					$asterisk = ($field->required == 'yes')?'*':'';
					$required = ($field->required == 'yes')?' required':'';
					$label = '<label class="" for="'.str_replace(' ','_',$field->name).'">'.ucfirst($field->name).' '.$asterisk.'</label>';
					$generated_field = '
						<textarea id="'.$field->type.$field->id.'" type="'.$field->type.'" class="form-control" cols="7" rows="5" name="'.str_replace(' ','_',$field->name).'" '.$required.'/></textarea>';
					$template = '
						<div class="form-group booking-membership-application-form-group">
								'.$label.'
							<div class="test-class">
								'.$generated_field.'
							</div>
						</div>
					';
					$output .= $template;
				}
				/*
				if($field->type == 'checkbox')
				{

				}
				*/
			}
			return $output;
		}
	}
}
?>