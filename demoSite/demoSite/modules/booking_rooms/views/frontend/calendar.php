<link href="<?=base_url('builderengine/public/fullcalendar-3.5.1/fullcalendar.min.css')?>" rel="stylesheet" />
<script src="<?=base_url('builderengine/public/fullcalendar-3.5.1/lib/moment.min.js')?>"></script>
<script src="<?=base_url('builderengine/public/fullcalendar-3.5.1/fullcalendar.min.js')?>"></script>
<link href="<?=base_url()?>themes/dashboard/assets/plugins/parsley/src/parsley.css" rel="stylesheet" />

<div class="container bookingrooms-container">
	<div class="row">
		<div class="pull-right event-logins" style="margin-bottom:20px;margin-right:15px;">
			<?if(!$this->user->is_logged_in()):?>
				<a href="<?=base_url('user/main/userLogin')?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-sign-in"></i> Sign In</a>
				<a href="<?=base_url('user/registration/index')?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-users"></i> Create Account</a>
			<?else:?>
				<a href="<?=base_url('user/main/dashboard')?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-user"></i> My Dashboard</a>
				<a href="<?=base_url('user/main/logout')?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-sign-out"></i> Logout</a>
			<?endif;?>
		</div>
		<div class="col-md-12 col-sm-12" style="margin-bottom:20px;">
			<div class="panel panel-default panel-with-tabs" data-sortable-id="ui-unlimited-tabs-2" style="background-color:#fff;border:none">
				<?if($departments->exists()):?>
					<div class="panel-heading p-0" style="background-color:#fff;border:none">
						<div class="tab-overflow">
							<ul class="nav nav-tabs">
								<li class="prev-button"><a href="javascript:;" data-click="prev-tab" class="text-inverse"><i class="fa fa-arrow-left"></i></a></li>
								<li class="<?if(!isset($_GET['room']))echo'active';?>"><a class="calAll" href="#nav-tab2-0" data-toggle="tab">All Meeting Areas</a></li>
								<?foreach($departments as $department):?>
									<li class="<?if(isset($_GET['room']) && $_GET['room'] == $department->id) echo 'active';?>"><a class="cal" href="#nav-tab2-<?=$department->id?>" data-toggle="tab"><?=$department->name?></a></li>
								<?endforeach;?>
								<li class="next-button"><a href="javascript:;" data-click="next-tab" class="text-inverse"><i class="fa fa-arrow-right"></i></a></li>
							</ul>
						</div>
					</div>
					<div class="tab-content">
						<div class="tab-pane fade <?if(!isset($_GET['room']))echo'active in';?>" id="nav-tab2-0" style="padding:10px">
							<h4 class="m-t-10"><i class="fa fa-caret-right"></i> All Meeting Areas</h4>
							<div id="calendarAll" class="vertical-box-column p-15 calendar bookingrooms-style"></div>
						</div>
						<?foreach($departments as $department):?>
						<div class="tab-pane fade <?if(isset($_GET['room']) && $_GET['room'] == $department->id) echo 'active in';?>" id="nav-tab2-<?=$department->id?>" style="padding:10px">
							<h4 class="m-t-10">
								<?if(!empty($department->image)):?>
									<img src="<?=$department->image?>" class="img-responsive bookingrooms-calendar-logo"/>
								<?endif;?>
								<i class="fa fa-caret-right"></i> <?=$department->name?> <a href="<?=base_url('booking_rooms/department/'.$department->slug)?>" class="btn btn-xs btn-warning" style="font-size:10px;padding:3px 5px"><i class="fa fa-info-circle"></i> Info</a>
							</h4>
							<div id="calendar<?=$department->id?>" class="vertical-box-column p-15 calendar bookingrooms-style"></div>
						</div>
						<?endforeach;?>
					</div>
				<?else:?>
					<h1 class="text-center">No Active Departments</h1>
				<?endif;?>
			</div>
		</div>
	</div>
</div>
<?require_once('calendar_all_script.php');?>
<?require_once('calendar_room_script.php');?>
<script src="<?=base_url()?>themes/dashboard/assets/plugins/parsley/dist/parsley.js"></script>	
<script src="<?=base_url('modules/booking_rooms/assets/js/unlimited_tabs.js')?>"></script>
<script>
	$(document).ready(function(){
		handleUnlimitedTabsRender();
	});
</script>