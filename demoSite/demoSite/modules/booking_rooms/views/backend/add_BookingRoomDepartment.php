<script src="<?=base_url('builderengine/public/js/editor/ckeditor.js')?>"></script>
<link href="<?=base_url('modules/booking_rooms/assets/css/titatoggle.css')?>" rel="stylesheet">
<?include('modules/booking_rooms/assets/misc/country_list.php');?>
<style>.red{color:red;margin-top:10px;}</style>
<script type="text/javascript">
    $(document).ready(function (){
        CKEDITOR.replace( 'editor1' );
    });

</script>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="panel panel-white">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				</div>
				<h4 class="panel-title"><?=$page?> Booking Room or Venue</h4>
			</div>
			<div class="panel-body panel-form">
				<form id="bookEventForm" class="form-horizontal form-bordered" data-parsley-validate="true" method="post" enctype="multipart/form-data" name="post">
					<input type="hidden" name="edit" value="<?=$page?>">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-be-3" for="name">
							<b>Name:</b>
							<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Room Name"></i></label>
						<div class="col-md-9 col-sm-9 col-be-9">
							<input class="form-control" type="text" id="name" name="name" value="<?=stripslashes($object->name)?>" data-parsley-required="true" required />
							<span id="catName" style="color:red;font-weight:600;"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-be-3" for="slug">
							<b>URL Slug:</b>
							<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Room URL Slug"></i></label>
						<div class="col-md-9 col-sm-9 col-be-9">
							<input class="form-control" type="text" id="slug" name="slug" placeholder="URL Address Link" value="<?=$object->slug?>" data-parsley-required="true" required />					
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-be-3" for="website">
						<b>Add Room To Department:</b>
						<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" data-parsley-required="true" title="Booking Room Department"></i></label>
						<div class="form-group">
							<div class="col-md-9 col-sm-9 col-be-9">
								<select name="category_id" class="form-control" required>
									<option value="">Select Department for this Room</option>
									<?$categories = new BookingRoomCategory();?>
									<?foreach($categories->get() as $category):?>
										<option value="<?=$category->id?>" <?if($category->id == $object->category_id)echo 'selected';?>><?=$category->name?></option>
									<?endforeach?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-be-3" for="categoryselection">
							Calendar Color:
							<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Room Calendar Bar Color"></i></label>
						<div class="col-md-9 col-sm-9 col-be-9">	
							<style type="text/css">
								.be-category-bar-blue {background-color: #02C3F3;}
								.be-category-bar-pink {background-color: #F079AD;}
								.be-category-bar-yellow {background-color: #FFF37A;}
								.be-category-bar-orange {background-color: #FB9404;}
								.be-category-bar-green {background-color: #C2DA66;}
								.be-category-bar-white {background-color: #FFFFFF;}
								.be-category-bar-purple {background-color: #9900CC;}
							</style>						
							<select class="form-control" id="color" name="color" data-parsley-required="true">
								<option value="">Select Room Color for the Calendar</option>
								<option class="be-category-bar-purple" value="be-category-bar-purple" <?if($object->color == 'be-category-bar-purple')echo 'selected';?>>Purple</option>
								<option class="be-category-bar-blue" value="be-category-bar-blue" <?if($object->color == 'be-category-bar-blue')echo 'selected';?>>Blue</option>
								<option class="be-category-bar-green" value="be-category-bar-green" <?if($object->color == 'be-category-bar-green')echo 'selected';?>>Green</option>
								<option class="be-category-bar-orange" value="be-category-bar-orange" <?if($object->color == 'be-category-bar-orange')echo 'selected';?>>Orange</option>
								<option class="be-category-bar-pink" value="be-category-bar-pink" <?if($object->color == 'be-category-bar-pink')echo 'selected';?>>Pink</option>
								<option class="be-category-bar-yellow" value="be-category-bar-yellow" <?if($object->color == 'be-category-bar-yellow')echo 'selected';?>>Yellow</option>
								<option class="be-category-bar-white" value="be-category-bar-white" <?if($object->color == 'be-category-bar-white')echo 'selected';?>>White</option>
							</select>
							<script>
							$(document).ready(function(){
								<?if(!empty($object->color)):?>
									$('#color').addClass('<?=$object->color?>');
								<?endif;?>
								$('#color').on('change',function(){
									var selected = this.value;
									$(this).removeClass().addClass('form-control').addClass(selected );
								});
							});
							</script>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-be-3" for="blogimage">
							<b>Image:</b>
							<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Room Image"></i></label>
						<div class="col-md-6 col-sm-6">
							<span class="btn btn-sm btn-success fileinput-button">
								<i class="fa fa-plus"></i>
								<span><?=$page?> Main Image</span>
								<style>
									.file_preview {
										max-height: 100px;
										margin-top: 10px;
									}
									.profile-avatar{
										float:none !important;
											margin-left: -14px;
									}
									.profile-avatar img{
										width:100px !important;
										max-height:50%;
										max-width:50%;
									}
									.price{margin-bottom:5px;}
								</style>
								<input id="f" type="file" name="image" rel="file_manager" file_value="<?=checkImagePath($object->image)?>" />
							</span>
						</div>
					</div>
					<div class="form-group" style="">
						<label class="control-label col-md-3 col-sm-3 col-be-3" for="blogimage"><b>Additional Images:</b></label>
						<div class="col-md-9 col-sm-9 col-be-9 additional-images">
							<?$g = 1;?>
							<?foreach($object->additional_image->get() as $image):?>
								<div style="float: left;">
									<span class="btn btn-sm btn-success fileinput-button add-image-success" style="float: left;margin: 5px;margin-top: 0px;">
										<i class="fa fa-plus"></i>
										<span>Browse</span>
									<input type="file" name="images[image-<?=$g?>]"  rel="file_manager" file_value="<?=checkImagePath($image->url)?>">
									</span>
									<span class="btn btn-sm btn-danger fileinput-button delete-image-danger" style="margin: 5px;margin-top: 0px;">
										<i class="fa fa-remove"></i>
										<span>Delete</span>
									</span>
								</div>
								<?$g++;?>
							<?endforeach;?>
							<div class="add-image-btn-holder">
								<button type="button" id="add-image" class="btn btn-sm btn-primary" style="display: block;"><i class="fa fa-plus"></i> Add Additional Image</button>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-be-3" for="active">
							<b>Booking Dates:</b>
							<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Dates"></i>
						</label>
						<div class="col-md-9 col-sm-9 col-be-9">
							<!--
								<div class="form-group">
									<label class="control-label col-md-4">Linked Pickers</label>
									<div class="col-md-8">
										<div class="row row-space-10">
											<div class="col-md-6">
												<input type="text" class="form-control"  id="datetimepicker3" placeholder="Min Date" />
											</div>
											<div class="col-md-6">
												<input type="text" class="form-control" id="datetimepicker4" placeholder="Max Date" />
											</div>
										</div>
									</div>
								</div>	-->		
							<div class="row">
								<label class="col-md-4">Available From:
										<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Room Start Date"></i>
								</label>
								<div class="col-md-4">
									<input type="text" class="form-control form-control-100 price" name="start_date" value="<?php if($page == 'Edit') echo date("d/m/Y", strtotime($object->start_date));?>" id="bookingEventStartDate" placeholder="Start date" />
								</div>
							</div>
							<div class="row">
								<label class="col-md-4">Available To:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Room End Date"></i>
								</label>
								<div class="col-md-4">
									<input type="text" class="form-control form-control-100 price" name="end_date" value="<?php if($page == 'Edit') echo date("d/m/Y", strtotime($object->end_date));?>" id="bookingEventEndDate" placeholder="End date" />
								</div>
							</div>
							<div class="row">
								<label class="col-md-4">Start at:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Room Time Start"></i>
								</label>
								<div class="col-md-4">
									<div class="input-group date price" id="datetimepickerStart">
										<input type="text" name="start_time" value="<?=$object->start_time?>" class="form-control" required />
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-time"></span>
										</span>
									</div>
								</div>
							</div>
							<div class="row">
								<label class="col-md-4">Ends at:
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Room Time Ends"></i>
								</label>
								<div class="col-md-4">
									<div class="input-group date" id="datetimepickerEnd">
										<input type="text" name="end_time" value="<?=$object->end_time?>" class="form-control" required />
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-time"></span>
										</span>
									</div>
								</div>
							</div>
							<div class="row" style="margin-top:10px;">
								<label class="col-md-4">Available Days: 
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Room Available Days"></i>
								</label>
							</div>
							<div class="row">
								<div class="col-md-12">
									<ul class="tagit-100" id="availableDays">
										<?php if($page == 'Edit'):?>
											<?php $event_days = explode(',', $object->available_days);?>
											<?php foreach($event_days as $day):?>
												<li><?=$day?></li>
											<?php endforeach ?>
										<?php else:?>
											<li>Sunday</li>
											<li>Monday</li>
											<li>Tuesday</li>
											<li>Wednesday</li>
											<li>Thursday</li>
											<li>Friday</li>
											<li>Saturday</li>
										<?php endif;?>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-be-3" for="active">
							<b>Payment Details:</b>
							<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Room Payment Details"></i>
						</label>
						<div class="col-md-9 col-sm-9 col-be-9">
							<div class="price input-group">
                                <input class="form-control required" type="text" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" id="price" name="price" value="<?=$object->price?>" placeholder="Room Price (per minute) or 0.00 for Free Booking" data-parlsey-type="digits" data-parsley-required="true" />
                                <?php $currency = new Currency($this->BuilderEngine->get_option('be_booking_rooms_default_currency'));?>
                                <div class="input-group-addon"><?=$currency->signature?></div>
							</div>
							<div class="price input-group">
								<input class="form-control price" type="text" id="vat" name="vat" placeholder="Price VAT or Tax. Type 0.00 for No Add-On Price" value="<?=$object->vat?>" data-parlsey-type="digits" data-parsley-required="true" required />
								<div class="input-group-addon">%</div>
							</div>
							<input class="form-control price" type="text" id="capacity" name="capacity" placeholder="Room / Venue Seating Capacity" value="<?=$object->capacity?>" data-parlsey-type="digits" data-parsley-required="true" required />
							<div class="row">
								<label class="col-md-3 col-sm-3 col-be-3" for="required" style="margin-top:5px">
									<b>Currency:</b>
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Room Currency Selection"></i>
								</label>
								<div class="col-md-9 col-sm-9 col-be-9 price">
									<? $currencies = new Currency();?>
									<select class="form-control" name="currency_id">
										<?foreach ($currencies->get() as $currency) :?>
											<?if($object->currency_id == $currency->id):?>
												<option value="<?=$currency->id?>" selected="selected"><?=$currency->name?> - <?=$currency->signature?><?php if($currency->id == $this->BuilderEngine->get_option('be_booking_rooms_default_currency')) echo ' - (Default)';?></option>
											<?else:?>
												<option value="<?=$currency->id?>"><?=$currency->name?> - <?=$currency->signature?><?php if($currency->id == $this->BuilderEngine->get_option('be_booking_rooms_default_currency')) echo ' - (Default)';?></option>
											<?endif;?>
										<?endforeach;?>
									</select>
								</div>
							</div>
							<div class="row earlyContainer" style="background:#eee;margin:10px 0;padding:15px 5px;">
								<div class="early">
									<label class="col-md-5 col-sm-5" for="early_discount">
										<b>Early Booking Discount:</b>
										<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Early Booking Room Discount"></i>
									</label>
									<div class="col-md-3 col-sm-3 col-be-3">
										<select class="form-control form-control-100 price" id="early_discount" name="early_discount" data-parsley-required="true">
											<!--<option value="">Select Option</option>-->
											<option value="yes" <? if($page == 'Edit') {if($object->early_discount == 'yes') echo 'selected';}?>>Yes</option>
											<option value="no" <? if($page == 'Edit') {if($object->early_discount == 'no') echo 'selected';}else echo 'selected';?>>No</option>
										</select>
									</div>
									<?if($object->early_discount == 'yes'):?>
										<?$earlyDiscount = $object->earlydiscount->get();?>
										<div class="eDiscount controls controls-row input-group" style="width:100%;margin-bottom:5px;">
											<div class="col-md-5 col-sm-5"><input type="text" name="eDays" value="<?=$earlyDiscount->num_days?>" class="form-control" placeholder="Days before EndDate" data-parlsey-type="digits" data-parsley-required="true" /></div>
											<div class="col-md-3 col-sm-3"><input class="form-control" type="text" name="eDiscount" value="<?=$earlyDiscount->price?>" placeholder="Discount" data-parlsey-type="digits" data-parsley-required="true" /></div>
											<div class="col-md-4 col-sm-4"><select class="form-control" name="eOpt" ><option value="flat" <?if($earlyDiscount->price_opt == 'flat')echo 'selected';?>>Minus Price</option><option value="percent" <?if($earlyDiscount->price_opt == 'percent')echo 'selected';?>>Percent</option></select></div>
										</div>							
									<?endif;?>
								</div>
							</div>
							<script>
								$('#early_discount').change(function() {
									var early_discount = $(this).val();								
									if (early_discount == 'yes') {
										$('.early').append(
											'<div class="eDiscount controls controls-row input-group" style="width:100%;margin-bottom:5px;">' +
												'<div class="col-md-5 col-sm-5"><input type="text" name="eDays" value="" class="form-control" placeholder="Days before EndDate" data-parlsey-type="digits" data-parsley-required="true" /></div>' +
												'<div class="col-md-3 col-sm-3"><input class="form-control" type="text" name="eDiscount" placeholder="Discount" data-parlsey-type="digits" data-parsley-required="true"></div>' +
												'<div class="col-md-4 col-sm-4"><select class="form-control" name="eOpt" ><option value="flat">Minus Price</option><option value="percent">Percent</option></select></div>' +
											'</div>'
										);
									} else {
										$('.eDiscount').remove();
									}
								});
							</script>
							<?/* temp disabled
							<div class="row groupContainer" style="margin:10px 0;padding:15px 5px;">
								<div class="group">
									<label class="control-label col-md-6 col-sm-6" for="group_discount">
										<b>Group Prices:</b>
										<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Room Group Discount"></i></label>
									<div class="col-md-6 col-sm-6">
										<select class="form-control price" id="group_discount" name="group_discount" data-parsley-required="true">
											<!--<option value="">Select Option</option>-->
											<option value="yes" <?if($page == 'Edit') {if($object->group_discount == 'yes') echo 'selected';}?>>Yes</option>
											<option value="no" <?if($page == 'Edit') {if($object->group_discount == 'no') echo 'selected';}else echo 'selected';?>>No</option>
										</select>
									</div>
									<?if($object->group_discount == 'yes'):?>
										<?$groupDiscount = $object->groupdiscount->get();?>								
										<div class="gDiscount controls controls-row input-group" style="width:100%;margin-bottom:5px;">
											<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;"><input type="text" name="gName" value="<?=$groupDiscount->name?>" class="form-control" placeholder="Group Name" data-parlsey-type="digits" data-parsley-required="true" /></div>
											<div class="col-md-2 col-sm-2" style="padding-left:2px;padding-right:2px;"><input class="form-control" type="text" name="gNum" value="<?=$groupDiscount->num_persons?>" placeholder="Persons" data-parlsey-type="digits" data-parsley-required="true" /></div>
											<div class="col-md-2 col-sm-2" style="padding-left:2px;padding-right:2px;"><input class="form-control" type="text" name="gDiscount" value="<?=$groupDiscount->price?>" placeholder="Discount" data-parlsey-type="digits" data-parsley-required="true" /></div>
											<div class="col-md-4 col-sm-4" style="padding-left:2px;"><select class="form-control" name="gOpt" ><option value="flat" <?if($groupDiscount->price_opt == 'flat')echo 'selected';?>>Minus Price</option><option value="percent" <?if($groupDiscount->price_opt == 'percent')echo 'selected';?>>Percent</option></select></div>
										</div>
									<?endif;?>
								</div>
							</div>
							<script>
								$('#group_discount').change(function() {
									var group_discount = $(this).val();								
									if (group_discount == 'yes') {
										$('.group').append(
											'<div class="gDiscount controls controls-row input-group" style="width:100%;margin-bottom:5px;">' +
												'<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;"><input type="text" name="gName" value="" class="form-control" placeholder="Group Name" data-parlsey-type="digits" data-parsley-required="true" /></div>' +
												'<div class="col-md-2 col-sm-2" style="padding-left:2px;padding-right:2px;"><input class="form-control" type="text" name="gNum" placeholder="Persons" data-parlsey-type="digits" data-parsley-required="true" /></div>' +
												'<div class="col-md-2 col-sm-2" style="padding-left:2px;padding-right:2px;"><input class="form-control" type="text" name="gDiscount" placeholder="Discount" data-parlsey-type="digits" data-parsley-required="true" /></div>' +
												'<div class="col-md-4 col-sm-4" style="padding-left:2px;"><select class="form-control" name="gOpt" ><option value="flat">Minus Price</option><option value="percent">Percent</option></select></div>' +
											'</div>'
										);
									} else {
										$('.gDiscount').remove();
									}
								});
							</script>
							<div class="row userGroupContainer" style="background:#eee;margin:10px 0;padding:15px 5px;">
								<div class="userGroup">
									<label class="control-label col-md-6 col-sm-6" for="usergroup_discount">
										<b>UserGroup Discount:</b>
										<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Room UserGroup Discount"></i></label>
									<div class="col-md-6 col-sm-6">
										<select class="form-control price" id="usergroup_discount" name="usergroup_discount" data-parsley-required="true">
											<!--<option value="">Select Option</option>-->
											<option value="yes" <?if($page == 'Edit') {if($object->usergroup_discount == 'yes') echo 'selected';}?>>Yes</option>
											<option value="no" <?if($page == 'Edit') {if($object->usergroup_discount == 'no') echo 'selected';}else echo 'selected';?>>No</option>
										</select>
									</div>
									<?if($object->usergroup_discount == 'yes'):?>
										<?$usergroups = $object->usergroupdiscount->get();?>	
										<?$u = 0;?>
										<?$groups = new Group();?>
										<?foreach($usergroups as $usergroup):?>
											<div class="ugDiscount controls controls-row input-group" style="width:100%;margin-bottom:5px;">
												<div class="col-md-12 col-sm-12" style="padding-left:2px;padding-right:2px;">
													<select name="ugName[<?=$u?>]" class="form-control" style="margin-bottom:5px;">
														<?foreach($groups->get() as $group):?>
															<option value="<?=$group->name?>" <?if($group->name == $usergroup->usergroup_name) echo 'selected';?>><?=$group->name?></option>
														<?endforeach;?>
													</select>
												</div>
												<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;"><input class="form-control" type="text" name="ugDiscount[<?=$u?>]" value="<?=$usergroup->price?>" data-parlsey-type="digits" data-parsley-required="true" placeholder="Discount"></div>
												<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;"><select class="form-control" name="ugOpt[<?=$u?>]"><option value="flat" <?if($usergroup->price_opt == 'flat')echo 'selected';?>>Minus Price</option><option value="percent" <?if($usergroup->price_opt == 'percent')echo 'selected';?>>Percent</option></select></div>
												<div class="col-md-1 col-sm-1"><a class="delete-user-group"><i class="fa fa-times red"></i></a></div>
											</div>
											<?$u++;?>
										<?endforeach;?>
									<?endif;?>
								</div>
								<a class="btn btn-xs btn-primary uClone" style="display:none;"><i class="fa fa-plus"></i> Add New</a>
								<?if($page == 'Edit' && $object->usergroup_discount == 'yes'):?>
									<script>$('.uClone').show();</script>	
								<?endif;?>
							</div>
							<script>
								<?if($page == 'Edit' && $object->usergroup_discount == 'yes'):?>
									var countUserGroup = <?=$u+1;?>;
								<?else:?>
									var countUserGroup = 0;
								<?endif;?>
								<?$usergroups = new Group();?>
								var usergroups = [ <?php foreach ($usergroups->get() as $uGroup): ?>"<?php echo $uGroup->name?>", <?php endforeach;?>];
								$('#usergroup_discount').change(function() {
									var usergroup_discount = $(this).val();								
									if (usergroup_discount == 'yes') {
										$('.uClone').show();
										$('.userGroup').append(
											'<div class="ugDiscount controls controls-row input-group" style="width:100%;margin-bottom:5px;">' +
												'<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;"><input class="form-control" type="text" name="ugDiscount[' + countUserGroup + ']" data-parlsey-type="digits" data-parsley-required="true" placeholder="Discount"></div>' +
												'<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;"><select class="form-control" name="ugOpt[' + countUserGroup + ']"><option value="flat">Minus Price</option><option value="percent">Percent</option></select></div>' +
												'<div class="col-md-1 col-sm-1"><a class="delete-user-group"><i class="fa fa-times red"></i></a></div>' +
											'</div>'
										);
										var sel = $('<select name="ugName[' + countUserGroup + ']" class="form-control" style="margin-bottom:5px;">').prependTo('.ugDiscount:last-child');
										$(usergroups).each(function() {
											sel.append($("<option>").attr('value',this).text(this));
										});
										countUserGroup++;
									} else {
										$('.uClone').hide();
										$('.ugDiscount').remove();
									}
								});
								$('.uClone').click(function(){
									$('.userGroup').append(
										'<div class="ugDiscount controls controls-row input-group" style="width:100%;margin-bottom:5px;">' +
											'<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;"><input class="form-control" type="text" name="ugDiscount[' + countUserGroup + ']" data-parlsey-type="digits" data-parsley-required="true" placeholder="Discount"></div>' +
											'<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;"><select class="form-control" name="ugOpt[' + countUserGroup + ']"><option value="flat">Minus Price</option><option value="percent">Percent</option></select></div>' +
											'<div class="col-md-1 col-sm-1"><a class="delete-user-group"><i class="fa fa-times red"></i></a></div>' +
										'</div>'
									);
									var sel = $('<select name="ugName[' + countUserGroup + ']" class="form-control" style="margin-bottom:5px;">').prependTo('.ugDiscount:last-child');
									$(usergroups).each(function() {
										sel.append($("<option>").attr('value',this).text(this));
									});
									countUserGroup++;									
								});
							</script>
							*/?>
							<div class="row voucherContainer" style="margin:10px 0;padding:15px 5px;">
								<div class="voucher">
									<label class="col-md-4 col-sm-4" for="voucher_discount">
										<b>Voucher Discount:</b>
										<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Room Voucher Discount"></i></label>
									<div class="col-md-3 col-sm-3">
										<select class="form-control form-control-100 price" id="voucher_discount" name="voucher_discount" data-parsley-required="true">
											<!--<option value="">Select Option</option>-->
											<option value="yes" <?if($page == 'Edit') {if($object->voucher_discount == 'yes') echo 'selected';}?>>Yes</option>
											<option value="no" <?if($page == 'Edit') {if($object->voucher_discount == 'no') echo 'selected';}else echo 'selected';?>>No</option>
										</select>
									</div>
									<?if($object->voucher_discount == 'yes'):?>
										<?$vouchers = $object->voucher->get();?>	
										<?$i = 0;?>
										<?foreach($vouchers as $voucher):?>
											<div class="vDiscount controls controls-row input-group" style="width:100%;margin-bottom:5px;">
												<div class="col-md-7 col-sm-7" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><input type="text" name="vName[<?=$i?>]" value="<?=$voucher->name?>" class="form-control" placeholder="Voucher Name" data-parsley-required="true" /></div>
												<div class="col-md-5 col-sm-5" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><input class="form-control" type="text" name="vCode[<?=$i?>]" value="<?=$voucher->code?>" data-parlsey-type="digits" data-parsley-required="true" placeholder="Voucher Code"></div>
												<div class="col-md-4 col-sm-5" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><input class="form-control endDate" type="text" name="vEndDate[<?=$i?>]" value="<?=date("d/m/Y", strtotime($voucher->expiry_date))?>" data-parsley-required="true" placeholder="End Date"></div>
												<div class="col-md-3 col-sm-3" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><input class="form-control" type="text" name="vDiscount[<?=$i?>]" value="<?=$voucher->price?>" data-parlsey-type="digits" data-parsley-required="true" placeholder="Price"></div>
												<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><select class="form-control" name="vOpt[<?=$i?>]"><option value="flat" <?if($voucher->price_opt == 'flat')echo 'selected';?>>Minus Price</option><option value="percent" <?if($voucher->price_opt == 'percent')echo 'selected';?>>Percent</option></select></div>
												<div class="col-md-1 col-sm-1"><a class="delete-voucher"><i class="fa fa-times red"></i></a></div>
											</div>
											<?$i++;?>
										<?endforeach;?>
									<?endif;?>
								</div>
								<a class="btn btn-xs btn-primary vClone" style="display:none;"><i class="fa fa-plus"></i> Add New Voucher</a>
								<?if($page == 'Edit' && $object->voucher_discount == 'yes'):?>
									<script>$('.vClone').show();</script>	
								<?endif;?>
							</div>
							<script>
								<?if($page == 'Edit' && $object->voucher_discount == 'yes'):?>
									var count = <?=$i+1;?>;
								<?else:?>
									var count = 0;
								<?endif;?>
								$('#voucher_discount').change(function() {
									var voucher_discount = $(this).val();								
									if (voucher_discount == 'yes') {
										$('.vClone').show();
										$('.voucher').append(
											'<div class="vDiscount controls controls-row input-group" style="width:100%;margin-bottom:5px;">' +
												'<div class="col-md-7 col-sm-7" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><input type="text" name="vName[' + count + ']" value="" class="form-control" data-parsley-required="true" placeholder="Voucher Name" /></div>' +
												'<div class="col-md-5 col-sm-5" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><input class="form-control" type="text" name="vCode[' + count + ']" data-parlsey-type="digits" data-parsley-required="true" placeholder="Voucher Code"></div>' +
												'<div class="col-md-4 col-sm-5" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><input class="form-control endDate" type="text" name="vEndDate[' + count + ']" data-parsley-required="true" placeholder="End Date"></div>' +
												'<div class="col-md-3 col-sm-3" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><input class="form-control" type="text" name="vDiscount[' + count + ']" data-parlsey-type="digits" data-parsley-required="true" placeholder="Price"></div>' +
												'<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><select class="form-control" name="vOpt[' + count + ']"><option value="flat">Minus Price</option><option value="percent">Percent</option></select></div>' +
												'<div class="col-md-1 col-sm-1"><a class="delete-voucher"><i class="fa fa-times red"></i></a></div>' +
											'</div>'
										);
										count++;
										$(".endDate").datepicker({
											format: 'dd/mm/yyyy',
											todayHighlight:true,
											autoclose:true
										});
									} else {
										$('.vClone').hide();
										$('.vDiscount').remove();
									}
								});
								$('.vClone').click(function(){
									$('.voucher').append(
										'<div class="vDiscount controls controls-row input-group" style="width:100%;margin-bottom:5px;">' +
											'<div class="col-md-7 col-sm-7" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><input type="text" name="vName[' + count + ']" value="" class="form-control" data-parsley-required="true" placeholder="Voucher Name" /></div>' +
											'<div class="col-md-5 col-sm-5" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><input class="form-control" type="text" name="vCode[' + count + ']" data-parlsey-type="digits" data-parsley-required="true" placeholder="Voucher Code"></div>' +
											'<div class="col-md-4 col-sm-5" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><input class="form-control endDate" type="text" name="vEndDate[' + count + ']" data-parsley-required="true" placeholder="End Date"></div>' +
											'<div class="col-md-3 col-sm-3" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><input class="form-control" type="text" name="vDiscount[' + count + ']" data-parlsey-type="digits" data-parsley-required="true" placeholder="Price"></div>' +
											'<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><select class="form-control" name="vOpt[' + count + ']"><option value="flat">Minus Price</option><option value="percent">Percent</option></select></div>' +
											'<div class="col-md-1 col-sm-1"><a class="delete-voucher"><i class="fa fa-times red"></i></a></div>' +
										'</div>'
									);
									count++;
									$(".endDate").datepicker({
										format: 'dd/mm/yyyy',
										todayHighlight:true,
										autoclose:true
									});
								});
							</script>
							<?/*
							<div class="row addonContainer" style="background:#eee;margin:10px 0;padding:15px 5px;">
								<div class="addOn">
									<label class="control-label col-md-6 col-sm-6" for="addon_service">
										<b>Addon Service:</b>
										<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Room Add-on Services"></i>
									</label>
									<div class="col-md-6 col-sm-6">
										<select class="form-control price" id="addon_service" name="addon_service" data-parsley-required="true">
											<!--<option value="">Select Option</option>-->
											<option value="yes" <?if($page == 'Edit') {if($object->addon_service == 'yes') echo 'selected';}?>>Yes</option>
											<option value="no" <?if($page == 'Edit') {if($object->addon_service == 'no') echo 'selected';}else echo 'selected';?>>No</option>
										</select>
									</div>
									<?if($object->addon_service == 'yes'):?>
										<?$services = $object->addonservice->get();?>	
										<?$j = 0;?>
										<?foreach($services as $service):?>
											<div class="addContainer controls controls-row input-group" style="width:100%;margin-bottom:5px;">
												<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;"><input type="text" name="aName[]" value="<?=$service->name?>" class="form-control" data-parsley-required="true" placeholder="Addon Name" /></div>
												<div class="col-md-3 col-sm-3" style="padding-left:2px;padding-right:2px;"><input class="form-control" type="text" name="aPrice[]" value="<?=$service->price?>" data-parlsey-type="digits" data-parsley-required="true" placeholder="Price"></div>
												<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><select class="form-control" name="aOpt[]"><option value="flat" <?if($service->price_opt == 'flat') echo 'selected';?>>Price</option><option value="percent" <?if($service->price_opt == 'percent') echo 'selected';?>>Percent</option></select></div>										
												<div class="col-md-1 col-sm-1"><a class="delete-addon"><i class="fa fa-times red"></i></a></div>						
											</div>
											<?$j++;?>
										<?endforeach;?>
									<?endif;?>
								</div>
								<a class="btn btn-xs btn-primary aClone" style="display:none;"><i class="fa fa-plus"></i> Add New</a>
								<?if($page == 'Edit' && $object->addon_service == 'yes'):?>
									<script>$('.aClone').show();</script>	
								<?endif;?>
							</div>
							<script>
								<?if($page == 'Edit' && $object->addon_service == 'yes'):?>
									var countService = <?=$j+1;?>;
								<?else:?>
									var countService = 0;
								<?endif;?>
								$('#addon_service').change(function(){
									var addon_service = $(this).val();								
									if (addon_service == 'yes') {
										$('.aClone').show();
										$('.addOn').append(
											'<div class="addContainer controls controls-row input-group" style="width:100%;margin-bottom:5px;">' +
												'<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;"><input type="text" name="aName[' + countService + ']" value="" class="form-control" data-parsley-required="true" placeholder="Addon Name" /></div>' +
												'<div class="col-md-3 col-sm-3" style="padding-left:2px;padding-right:2px;"><input class="form-control" type="text" name="aPrice[' + countService + ']" data-parlsey-type="digits" data-parsley-required="true" placeholder="Price"></div>' +
												'<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><select class="form-control" name="aOpt[' + countService + ']"><option value="flat">Price</option><option value="percent">Percent</option></select></div>' +												
												'<div class="col-md-1 col-sm-1"><a class="delete-addon"><i class="fa fa-times red"></i></a></div>' +							
											'</div>'
										);
										countService++;
									} else {
										$('.addContainer').remove();
										$('.aClone').hide();
									}
								});
								$('.aClone').click(function(){
									$('.addOn').append(
										'<div class="addContainer controls controls-row input-group" style="width:100%;margin-bottom:5px;">' +
											'<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;"><input type="text" name="aName[' + countService + ']" value="" data-parsley-required="true" class="form-control" placeholder="Addon Name" /></div>' +
											'<div class="col-md-3 col-sm-3" style="padding-left:2px;padding-right:2px;"><input class="form-control" type="text" name="aPrice[' + countService + ']" data-parlsey-type="digits" data-parsley-required="true" placeholder="Price"></div>' +
											'<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><select class="form-control" name="aOpt[' + countService + ']"><option value="flat">Price</option><option value="percent">Percent</option></select></div>' +
											'<div class="col-md-1 col-sm-1"><a class="delete-addon"><i class="fa fa-times red"></i></a></div>' +							
										'</div>'
									);
									countService++;
								});
							</script>
							*/?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-be-3" for="featured">
							<b>Default Calendar Room View:</b>
							<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Default Calendar View"></i></label>
						<div class="col-md-9 col-sm-9 col-be-9 featured">
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<select class="form-control" id="featured" name="default_view" data-parsley-required="true">
										<option value="">Select Option</option>
										<option value="month" <?if($page == 'Edit') {if($object->default_view == 'month') echo 'selected';}?>>Calendar Month</option>
										<option value="agendaWeek" <?if($page == 'Edit') {if($object->default_view == 'agendaWeek') echo 'selected';}else echo 'selected';?>>Calendar Week</option>
										<option value="agendaDay" <?if($page == 'Edit') {if($object->default_view == 'agendaDay') echo 'selected';}else echo 'selected';?>>Calendar Day</option>
										<option value="listYear" <?if($page == 'Edit') {if($object->default_view == 'listYear') echo 'selected';}else echo 'selected';?>>List Year</option>
										<option value="listMonth" <?if($page == 'Edit') {if($object->default_view == 'listMonth') echo 'selected';}else echo 'selected';?>>List Month</option>
										<option value="listWeek" <?if($page == 'Edit') {if($object->default_view == 'listWeek') echo 'selected';}else echo 'selected';?>>List Week</option>
										<option value="listDay" <?if($page == 'Edit') {if($object->default_view == 'listDay') echo 'selected';}else echo 'selected';?>>List Day</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-be-3" for="featured">
							<b>Featured Room:</b>
							<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Featured Booking Room"></i></label>
						<div class="col-md-9 col-sm-9 col-be-9 featured">
							<div class="row">
								<div class="col-md-3 col-sm-3">
									<select class="form-control" id="featured" name="featured" data-parsley-required="true">
										<!--<option value="">Select Option</option>-->
										<option value="yes" <?if($page == 'Edit') {if($object->featured == 'yes') echo 'selected';}?>>Yes</option>
										<option value="no" <?if($page == 'Edit') {if($object->featured == 'no') echo 'selected';}else echo 'selected';?>>No</option>
									</select>
								</div>
							</div>
							<!--<div class="row" style="margin-top:10px;">
								<script>
									$('#featured').change(function() {
										var selection = $(this).val();								
										if (selection == 'yes') {
											$('.featured').append(
												'<div class="featuredFields controls controls-row input-group">' +
													'<div class="col-md-10 col-sm-10"><input class="form-control" type="text" name="featured_fields[]" placeholder="Featured Field"></div>' +
													'<div class="col-md-2 col-sm-2"><a class="delete-select-option"><i class="fa fa-times red"></i></a></div>' +
													'<div class="col-md-10 col-sm-10"><input class="form-control" type="text" name="featured_fields[]" placeholder="Featured Field"></div>' +
													'<div class="col-md-2 col-sm-2"><a class="delete-select-option"><i class="fa fa-times red"></i></a></div>' +
													'<div class="col-md-10 col-sm-10"><input class="form-control" type="text" name="featured_fields[]" placeholder="Featured Field"></div>' +
													'<div class="col-md-2 col-sm-2"><a class="delete-select-option"><i class="fa fa-times red"></i></a></div>' +
													'<div class="col-md-10 col-sm-10"><input class="form-control" type="text" name="featured_fields[]" placeholder="Featured Field"></div>' +
													'<div class="col-md-2 col-sm-2"><a class="delete-select-option"><i class="fa fa-times red"></i></a></div>' +
													'<div class="col-md-10 col-sm-10"><input class="form-control" type="text" name="featured_fields[]" placeholder="Featured Field"></div>' +
													'<div class="col-md-2 col-sm-2"><a class="delete-select-option"><i class="fa fa-times red"></i></a></div>' +
													'<div class="col-md-10 col-sm-10"><input class="form-control" type="text" name="featured_fields[]" placeholder="Featured Field"></div>' +
													'<div class="col-md-2 col-sm-2"><a class="delete-select-option"><i class="fa fa-times red"></i></a></div>' +
												'</div>'
											);
										} else {
											$('.featuredFields').remove();
										}
									});
								</script>
							</div>-->
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-be-3" for="active">
							<b>Room Status:</b>
							<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Room Status"></i></label>
						<div class="col-md-9 col-sm-9 col-be-9">
							<div class="row">
								<div class="col-md-3 col-sm-3">
									<select class="form-control" id="active" name="active" data-parsley-required="true">
										<!--<option value="">Select Option</option>-->
										<option value="yes" <?if($page == 'Edit') {if($object->active == 'yes') echo 'selected';}else echo 'selected';?>>Active</option>
										<option value="no" <?if($page == 'Edit') {if($object->active == 'no') echo 'selected';}?>>Inactive</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-12 col-sm-12" for="blogname">
							<div style="text-align: left;"><b>Description:</b>
							<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="This is where you add your main Booking Room description"></i>
							</div>
						</label>
						<div class="col-md-12 col-sm-12">
							<div class="panel-body panel-form">
							<style>
								.demo1{
									line-height: 20.8px;
									text-align: center ;
								}
								.demo2{
									width: 50px;
									height: 50px;
								}
								.demo3{
									width: 50px;
									height: 50px; 
								}
								.demo4{
									margin-left:15px;
									width: 350px;
									height: 350px;
								}
								.demo5{
									line-height: 20.8px;
									text-align: center;						
								}
								.demo6{
									margin-left: 200px;
									
								}
							</style>
							<?php $txt = ChEditorfix($object->description);?>
							<textarea class="ckeditor" id="editor1" name="description" rows="20"><?=str_replace('/files/be_demo',base_url('files/be_demo'),$txt)?></textarea>
						</div>
						</div>
					</div>
					<div class="form-group">
						<div class="text-center">
							<span class="label label-danger" id="catName" style="color:#fff;font-weight:600;margin-bottom:10px;"></span><br/>
							<button type="submit" class="btn btn-primary" style="margin-top:5px;" ><i class="fa fa-check"></i> Save Room Details</button>
						</div>
					</div>
					<input type="hidden" name="user_id" id="user_id" value="<?=$this->user->id?>">
				</form>
			</div>
		</div>
	</div>
</div> 
<script type="text/javascript">
    $('document').ready(function(){
        imageCount = <?=$g?>;
        $('#add-image').click(function(){
            var newFileInput = ('<div style="float: left;"><span class="btn btn-sm btn-success fileinput-button add-image-success" style="float: left;margin: 5px;margin-top: 0px;"><i class="fa fa-plus"></i><span>Browse</span><input type="file" class="browse" name="images[image-' + imageCount + ']"  rel="file_manager"></span><span class="btn btn-sm btn-danger fileinput-button delete-image-danger" style="margin: 5px;margin-top: 0px;"> <i class="fa fa-remove"></i> <span>Delete</span></div>');
            $(newFileInput).insertBefore($(this).parent().parent().find('.add-image-btn-holder').last());
            imageCount++;
            init_fm();
			$('.browse').on('click',function(e){
			   e.preventDefault();
			});
        });
        $('body').on('click', '.delete-image-danger', function(){
           $(this).parent().remove();
        });
    });
    function init_fm(){
        $(document).find('input:file').each(function() {
            if($(this).attr('rel') != "file_manager")
                return;
            $(this).attr('onClick','file_manager(\'' + this.name + '\')');
            file = $(this).attr('file_value');
            if(!$(this).parent().find('input[type="hidden"]').length > 0){
                $("<input type='hidden' />").attr({ value: $(this).attr('file_value'), name: this.name  }).insertBefore(this);
                this.name = this.name + "_old";
            }

            if(file != "" && typeof file !== 'undefined')
            {
                var file_name_string = file;

                var file_name_array = file_name_string.split(".");
                var file_extension = file_name_array[file_name_array.length - 1];

                if(!$('[name="'+this.name + '"]').parent().parent().find('.profile-avatar').length > 0){
                    $('[name="'+this.name + '"]').parent().parent().append('<div class="profile-avatar" style=""><img style="max-height: 154px;margin-top: -10px;margin-left: 20px;" class="file_preview" src="" alt="No Image" ></div>');
                }
                $('[name="'+this.name + '"]').parent().parent().find(".file_preview").attr('src', file);
            }
            $(this).attr('onclick', $(this).attr('onclick').replace('_old', ''));
        });
    }
</script>
<script>
    $(document).ready(function (){
	    $('#availableDays').tagit({
	        fieldName: "available_days",
	        singleField: true,
	        showAutocompleteOnFocus: true,
	        availableTags: [ "Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]
	    });
	});
</script>
<script>
    function convertToSlug(Text)
    {
        return Text
            .toLowerCase()
            .replace(/ /g,'-')
            .replace(/[^\w-]+/g,'')
            ;
    }
    $(document).ready(function (){
        $("#name").keyup(function() {
            $("#slug").val($("#name").val());
            $("#slug").change();
        });

        $("#slug").keyup(function() {
            $("#slug").change();
        });
        $("#slug").change(function() {
            $("#slug").val(convertToSlug($("#slug").val()));
        });
		
		$("#f").click(function(e){
		   e.preventDefault();
		});
        $('body').on('click', 'a.delete-addon', function() {
			$(this).parent().parent().remove();
        });
        $('body').on('click', 'a.delete-voucher', function() {
			$(this).parent().parent().remove();
        });
        $('body').on('click', 'a.delete-user-group', function() {
			$(this).parent().parent().remove();
        });
    });
	<?php $rooms = new BookingRoomDepartment();?>
	$("form").submit(function(event){
		var name = $('#name').val();
		<?php if($page == 'Edit'):?>
			var array = [ <?php foreach ($rooms->where('name !=',$object->name)->get() as $event): ?>"<?php echo $event->name?>", <?php endforeach;?>];
		<?php else:?>
			var array = [ <?php foreach ($rooms->get() as $event): ?>"<?php echo $event->name?>", <?php endforeach;?>];		
		<?php endif;?>
		if(array.indexOf(name) == -1) {
			return;
		}
		$('#catName').text( "This booking room name already exists! Please,choose another !" ).show().fadeOut(4000);
		event.preventDefault();
	});
</script>