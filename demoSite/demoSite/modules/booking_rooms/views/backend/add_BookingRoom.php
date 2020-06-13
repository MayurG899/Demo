
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="panel panel-white">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				</div>
				<h4 class="panel-title"><?=$page?> Booking</h4>
			</div>
			<div class="panel-body panel-form">
				<form id="categoryForm" class="form-horizontal form-bordered" data-parsley-validate="true" method="post" enctype="multipart/form-data" name="category">
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-be-4" for="categoryname">
							Select Room:
							<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Select Room to Book"></i></label>
						<div class="col-md-8 col-sm-8">
							<select name="department_id" class="form-control" required>
								<option value="">Select Room or Venue For This Booking</option>
								<?$rooms = new BookingRoomDepartment();
									$rooms = $rooms->where('active','yes')->get();
								?>
								<?foreach($rooms as $room):?>
									<option value="<?=$room->id?>" <?if($room->id == $object->department_id)echo'selected';?>><?=$room->name?></option>
								<?endforeach?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-be-4">Select Member Account:
							<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Client"></i>
						</label>
						<div class="col-md-4">
							<select name="user_id" class="form-control" required>
								<option value="">Book for this Member Account</option>
								<?$users = new User();$users = $users->where('verified','yes')->get();?>
								<?foreach($users as $user):?>
									<option value="<?=$user->id?>" <?if($object->user_id == $user->id)echo 'selected';?>><?=$user->first_name.' '.$user->last_name?></option>
								<?endforeach?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-be-4">Booking Date:
							<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Date"></i>
						</label>
						<div class="control-label col-md-4 col-sm-4">
							<input type="text" class="form-control endDate" name="date" value="<?php if($page == 'Edit') echo date("d/m/Y", strtotime($object->date));?>" id="date" placeholder="Date" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-be-4">Start at:
							<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Event Time Start"></i>
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
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-be-4">Ends at:
							<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Event Time Ends"></i>
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
					<?/*
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4s">Status:
							<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Status"></i>
						</label>
						<div class="col-md-4">
							<select name="status" class="form-control" required>
								<option value="">Select Status</option>
								<option value="pending" <?if($object->status == 'pending')echo'selected';?>>Pending</option>
								<option value="reserved" <?if($object->status == 'reserved')echo'selected';?>>Reserved</option>
								<option value="approved" <?if($object->status == 'approved')echo'selected';?>>Approved</option>
								<option value="canceled" <?if($object->status == 'canceled')echo'selected';?>>Canceled</option>
								<option value="denied" <?if($object->status == 'denied')echo'selected';?>>Denied</option>
								<option value="completed" <?if($object->status == 'completed')echo'selected';?>>Completed</option>
							</select>
						</div>
					</div>
					*/?>
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-be-4"></label>
						<div class="col-md-6 col-sm-6">
							<button id="submit" type="submit" class="btn btn-primary"><?=$page?> Room Booking</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php $groups = new Group;?>
<script>
	<?php $categories = new BookingRoomCategory();?>
	$("form").submit(function(event){
		var name = $('#categoryname').val();
		<?php if($page == 'Edit'):?>
		var array = [ <?php foreach ($categories->where('name !=',$object->name)->get() as $category): ?>"<?php echo $category->name?>", <?php endforeach;?>];
		<?php else:?>
		var array = [ <?php foreach ($categories->get() as $category): ?>"<?php echo $category->name?>", <?php endforeach;?>];		
		<?php endif;?>
		if(array.indexOf(name) == -1) {
			return;
		}
		$('#catName').html( "<i class='fa fa-exclamation-triangle'></i> Category name \"" + name + "\" already exists! Please,choose another !" ).show().delay(2500).fadeOut(500);
		event.preventDefault();
	});
    $(document).ready(function (){
	    $('#access-groups').tagit({
	        fieldName: "groups_allowed",
	        singleField: true,
	        showAutocompleteOnFocus: true,
	        availableTags: [ <?php foreach ($groups->get() as $group): ?>"<?php echo $group->name?>", <?php endforeach;?>]
	    });

		$("#f").click(function(e){
		   e.preventDefault();
		});
		
	});

	$("form").submit(function(event){
		if ($('#categoryname').val() != "Unallocated") {
			return;
		}
		$('#catName').text( "This category name is reserved.Please,choose another !" ).show().fadeOut(3000);
		event.preventDefault();
	});
</script>