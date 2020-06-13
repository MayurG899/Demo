<?php
class BookingRoomDepartment extends DataMapper 
{
	var $table = 'be_booking_room_departments';

	/*
	var $has_one = array(

	);
	*/
	var $has_many = array(
		'additional_image' => array(
			'class' => 'BookingRoomDepartmentImage',
			'other_field' => 'department',
			'join_self_as' => 'department',
			'join_other_as' => 'image'
		),
		'earlydiscount' => array(
			'class' => 'BookingRoomDepartmentEarlyDiscount',
			'other_field' => 'department',
			'join_self_as' => 'department',
			'join_other_as' => 'earlydiscount'
		),
		'groupdiscount' => array(
			'class' => 'BookingRoomDepartmentGroupDiscount',
			'other_field' => 'department',
			'join_self_as' => 'department',
			'join_other_as' => 'groupdiscount',
		),
		'voucher' => array(
			'class' => 'BookingRoomDepartmentVoucher',
			'other_field' => 'department',
			'join_self_as' => 'department',
			'join_other_as' => 'voucher',
		),
		'addonservice' => array(
			'class' => 'BookingRoomDepartmentAddonservice',
			'other_field' => 'department',
			'join_self_as' => 'department',
			'join_other_as' => 'addonservice'
		),
		'usergroupdiscount' => array(
			'class' => 'BookingRoomDepartmentUsergroupDiscount',
			'other_field' => 'department',
			'join_self_as' => 'department',
			'join_other_as' => 'usergroupdiscount',
		),
	);

	public function create($data, $edit = false)
	{
		if($data['edit'] == 'Edit')
			$edit = true;
		$start_date = DateTime::createFromFormat('d/m/Y',$data['start_date']);
		$start_date = $start_date->format("Y-m-d");

		$end_date = DateTime::createFromFormat('d/m/Y',$data['end_date']);
		$end_date = $end_date->format("Y-m-d");

		$this->user_id = get_active_user_id();
		$this->category_id = $data['category_id'];
		$this->name = $data['name'];
		$this->slug = $data['slug'];
		$this->image = !empty($data['image'])?$data['image']:base_url('builderengine/public/img/photo_placeholder.png');
		$this->description = ChEditorfix($data['description']);
		$this->price = $data['price'];
		$this->currency_id = $data['currency_id'];
		$this->vat = $data['vat'];
		$this->color = $data['color'];
		$this->start_date = $start_date;
		$this->end_date = $end_date;
		$this->start_time = $data['start_time'];
		$this->end_time = $data['end_time'];
		$this->capacity = $data['capacity'];
		$this->featured = $data['featured'];
		$this->active = $data['active'];
		$this->available_days = $data['available_days'];
		$this->early_discount = $data['early_discount'];
		$this->voucher_discount = $data['voucher_discount'];
		$this->group_discount = $data['group_discount'];
		$this->usergroup_discount = $data['usergroup_discount'];
		$this->addon_service = $data['addon_service'];
		$this->time_created = time();
		$this->default_view = $data['default_view'];
		$this->save();

		//if(isset($data['images']))
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
	}

	public function add_images($images, $edit = false)
	{
		if($edit == true)
		{
			$current_images = new BookingRoomDepartmentImage();
			$current_images = $current_images->where('department_id', $this->id)->get();
			$current_images->delete_all();
		}
		foreach($images as $image)
		{
			$department_image = new BookingRoomDepartmentImage();
			$department_image = $department_image->where('department_id', $this->id)->where('url', $image)->get();
			if(!$department_image->exists())
			{
				$department_image = new BookingRoomDepartmentImage();
				$department_image->department_id = $this->id;
				$department_image->url = $image;
				$department_image->save();
			}
		}
	}

	public function add_early_discount($earlyDiscount, $eDays, $eDiscount, $eOpt, $edit = false)
	{
		if($edit == true)
		{
			$current_early_discount = new BookingRoomDepartmentEarlyDiscount();
			$current_early_discount = $current_early_discount->where('department_id', $this->id)->get();
			$current_early_discount->delete_all();
		}
		$early_discount = new BookingRoomDepartmentEarlyDiscount();
		$early_discount = $early_discount->where('department_id', $this->id)->get();
		if($earlyDiscount == 'yes' && !$early_discount->exists())
		{
			$early_discount = new BookingRoomDepartmentEarlyDiscount();
			$early_discount->department_id = $this->id;
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
			$current_group_discount = new BookingRoomDepartmentGroupDiscount();
			$current_group_discount = $current_group_discount->where('department_id', $this->id)->get();
			$current_group_discount->delete_all();
		}
		$group_discount = new BookingRoomDepartmentGroupDiscount();
		$group_discount = $group_discount->where('department_id', $this->id)->get();
		if($groupDiscount == 'yes' && !$group_discount->exists())
		{
			$group_discount = new BookingRoomDepartmentGroupDiscount();
			$group_discount->department_id = $this->id;
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
			$current_voucher_discount = new BookingRoomDepartmentVoucher();
			$current_voucher_discount = $current_voucher_discount->where('department_id', $this->id)->get();
			$current_voucher_discount->delete_all();
		}
		$voucher_discount = new BookingRoomDepartmentVoucher();
		$voucher_discount = $voucher_discount->where('department_id', $this->id)->get();
		if($voucherDiscount == 'yes' && !$voucher_discount->exists())
		{
			$count = count($vName);
			if($count > 0){
				foreach($vName as $k => $v){
					$expiryDate = DateTime::createFromFormat('d/m/Y',$vEndDate[$k]);
					$expiryDate = $expiryDate->format("Y-m-d");

					$voucher_discount = new BookingRoomDepartmentVoucher();
					$voucher_discount->department_id = $this->id;
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
			$current_service = new BookingRoomDepartmentAddonservice();
			$current_service = $current_service->where('department_id', $this->id)->get();
			$current_service->delete_all();
		}
		$service = new BookingRoomDepartmentAddonservice();
		$service = $service->where('department_id', $this->id)->get();
		if($addonService == 'yes' && !$service->exists())
		{
			$count = count($aName);
			if($count > 0){
				foreach($aName as $k => $v){
					$service = new BookingRoomDepartmentAddonservice();
					$service->department_id = $this->id;
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
			$current_usergroup_discount = new BookingRoomDepartmentUsergroupDiscount();
			$current_usergroup_discount = $current_usergroup_discount->where('department_id', $this->id)->get();
			$current_usergroup_discount->delete_all();
		}
		$usergroup_discount = new BookingRoomDepartmentUsergroupDiscount();
		$usergroup_discount = $usergroup_discount->where('department_id', $this->id)->get();
		if($userGroupDiscount == 'yes' && !$usergroup_discount->exists())
		{
			$count = count($ugName);
			if($count > 0){
				foreach($ugName as $k => $v){
					$usergroup_discount = new BookingRoomDepartmentUsergroupDiscount();
					$usergroup_discount->department_id = $this->id;
					$usergroup_discount->usergroup_name = $ugName[$k];
					$usergroup_discount->price = $ugDiscount[$k];
					$usergroup_discount->price_opt = $ugOpt[$k];
					$usergroup_discount->save();
				}
			}
		}
	}
}
?>