<div id="editModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="editBooking" method="post" data-parsley-validate="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
					<h4 id="editModalTitle" class="modal-title"></h4>
				</div>
				<div id="modalBody" class="modal-body">
					<?
						$rooms = new BookingRoomDepartment();
						$rooms = $rooms->where('active','yes')->get();
					?>
					<div class="form-group">
						<select id="editDepartmentId" name="department_id" class="form-control" required>
							<option value="">Select Room</option>
							<?foreach($rooms as $room):?>
								<option value="<?=$room->id?>"><?=$room->name?></option>
							<?endforeach;?>
						</select>
					</div>
					<div class="form-group">
						<select id="editStatus" name="status" class="form-control" required>
							<option value="">Select Status</option>
							<?if($this->users->is_admin()):?>
								<option value="pending">Pending</option>
								<option value="reserved">Reserved</option>
								<option value="approved">Approved</option>
								<option value="canceled">Canceled</option>
								<option value="completed">Completed</option>
								<option value="denied">Denied</option>
							<?else:?>
								<option value="reserved">Reserved</option>
								<option value="canceled">Canceled</option>
							<?endif;?>
						</select>
					</div>
					<?if($this->users->is_admin()):?>
						<div class="form-group">
							<select id="editUserId" name="user_id" class="form-control" required>
								<option value="">Select Client</option>
								<?$usrs = new User();$usrs = $usrs->where('verified','yes')->get();?>
								<?foreach($usrs as $u):?>
									<option value="<?=$u->id?>"><?=$u->first_name.' '.$u->last_name?></option>
								<?endforeach;?>
							</select>
						</div>
					<?else:?>
						<input id="editUserId" type="hidden" name="user_id" value="<?=$this->user->get_id()?>" />
					<?endif;?>
					<input id="editId" type="hidden" name="id" />
					<input id="editbookDate" type="hidden" name="date" />
					<input id="editStartTime" type="hidden" name="start_time" />
					<input id="editEndTime" type="hidden" name="end_time" />
					<input id="editst" type="hidden" />
					<input id="editen" type="hidden" />
				</div>
				<div class="modal-footer">
					<a id="deleteBooking" href="" class="btn btn-danger pull-left"><i class="fa fa-trash"></i> Delete</a>
					<button id="cancelR" type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
					<button id="edit" type="submit" class="btn btn-success"><i class="fa fa-edit"></i> Edit</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div id="addModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="addNewBooking" method="post" data-parsley-validate="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
					<h4 id="addModalTitle" class="modal-title"><i class="fa fa-book"></i> Book a Room</h4>
				</div>
				<div id="addModalBody" class="modal-body">
					<?
						$rooms = new BookingRoomDepartment();
						$rooms = $rooms->where('active','yes')->get();
					?>
					<div class="form-group">
						<select name="department_id" class="form-control" required>
							<option value="">Select Room</option>
							<?foreach($rooms as $room):?>
								<option value="<?=$room->id?>"><?=$room->name?></option>
							<?endforeach;?>
						</select>
					</div>
					<div class="form-group">
						<select name="status" class="form-control" required>
							<option value="">Select Status</option>
							<?if($this->users->is_admin()):?>
								<option value="pending">Pending</option>
								<option value="reserved">Reserved</option>
								<option value="approved">Approved</option>
								<option value="canceled">Canceled</option>
								<option value="denied">Denied</option>
								<option value="completed">Completed</option>
							<?else:?>
								<option value="reserved">Reserved</option>
							<?endif;?>
						</select>
					</div>
					<?if($this->users->is_admin()):?>
						<div class="form-group">
							<select name="user_id" class="form-control" required>
								<option value="">Select Client</option>
								<?$usrs = new User();$usrs = $usrs->where('verified','yes')->get();?>
								<?foreach($usrs as $u):?>
									<option value="<?=$u->id?>"><?=$u->first_name.' '.$u->last_name?></option>
								<?endforeach;?>
							</select>
						</div>
					<?else:?>
						<input id="userId" type="hidden" name="user_id" value="<?=$this->user->get_id()?>" />
					<?endif;?>
					<input id="bookDate" type="hidden" name="date" />
					<input id="StartTime" type="hidden" name="start_time" />
					<input id="EndTime" type="hidden" name="end_time" />
					<input id="st" type="hidden" />
					<input id="en" type="hidden" />
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
					<button id="save" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div id="errModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
				<h4 id="addModalTitle" class="modal-title"><i class="fa fa-exclamation-triangle"></i> Error</h4>
			</div>
			<div id="errModalBody" class="modal-body">
				<div class="alert alert-danger">
					<p class="text-center">Oops, you are trying to edit somebody else`s booking !</p>
					<p class="text-center"><i class="fa fa-smile-o" style="font-size:20px;"></i></p>
					<p class="text-center"><small>You do not have this permission !</small></p>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	$('.canceled').css('background','red').css('animation-duration','2s').addClass('animated flash infinite');
	var date = new Date();
	var currentYear = date.getFullYear();
	var currentMonth = date.getMonth() + 1;
		currentMonth = (currentMonth < 10) ? '0' + currentMonth : currentMonth;

	$('#calendarAll').fullCalendar({
		defaultView: 'agendaWeek',
		header: {
			left: 'month,agendaWeek,agendaDay,listYear,listMonth,listWeek,listDay',
			center: 'title',
			right: 'prev,today,next '
		},/*
		viewRender: (function () {
			var lastViewName;
			return function (view) {
				var view = $('#calendarAll').fullCalendar('getView');
				alert('The new title of the view is ' + view.title);
			}
		})(),*/
		views: {
			listDay: {
			  buttonText: 'list day'
			},
			listWeek: {
			  buttonText: 'list week'
			},
			listMonth: {
			  buttonText: 'list month'
			},
			listYear: {
			  buttonText: 'list year'
			}
		},
		businessHours: {
			// days of week. an array of zero-based day of week integers (0=Sunday)
			dow: [ 1, 2, 3, 4, 5, 6, 0 ], // Monday - Thursday

			start: '09:00', // a start time (10am in this example)
			end: '24:00', // an end time (6pm in this example)
		},
		eventAfterRender:function( event, element, view ) {
			$('.canceled').css('background','red').css('animation-duration','2s').addClass('animated flash infinite');
		},
		navLinks: true,
		//lazyFetching: false,
		slotDuration: '00:30:00',
		allDaySlot: false,
		minTime: "09:00:00",
		maxTime: "24:00:00",
		droppable: false,
		drop: function() {
			$(this).remove();
		},
		selectable: true,
		selectOverlap: function(event) {
			return event.rendering === 'background';
		},
		eventStartEditable: true,
		eventDrop:function( event, delta, revertFunc, jsEvent, ui, view ) {
			var st = moment(event.start).format('H:mm');
			var en = moment(event.end).format('H:mm');
			var curr_user_id = '<?=$this->user->get_id()?>';
			var bookDate = moment(event.end).format('YYYY-MM-DD');
			var admin = '<?=$admin = ($this->users->is_admin())?'true':'false';?>';
			if(event.user_id == curr_user_id || admin == 'true'){
				$('#editStatus').val(event.status.toLowerCase());
				$('#editUserId').val(event.user_id);
				$('#editDepartmentId').val(event.room_id);
				$('#editModalTitle').html(event.modalTitle);
				$('#edituserId').val(event.user_id);
				$('#editId').val(event.id);
				$('#editbookDate').val(bookDate);
				$('#editStartTime').val(st);
				$('#editEndTime').val(en);
				$('#editst').val(st);
				$('#editen').val(en);
				var link = '<?=base_url('booking_rooms/delete_booking')?>/' + event.id;
				$('#deleteBooking').attr('href',link);
				$('#editModal').modal();
				$('.canceled').css('background','red').css('animation-duration','2s').addClass('animated flash infinite');
				$('#cancelR').on('click',function(){
					revertFunc();
				});
			}else{
				$('#errModal').modal();
				revertFunc();
			}
		},
		eventResize: function(event, delta, revertFunc) {
			/*
			alert(event.title + " end is now (" + delta.asMinutes() + ")" + event.end.format());

			if (!confirm("is this okay?")) {
				revertFunc();
			}
			*/
			var st = moment(event.start).format('H:mm');
			var en = moment(event.end).format('H:mm');
			var curr_user_id = '<?=$this->user->get_id()?>';
			var admin = '<?=$admin = ($this->users->is_admin())?'true':'false';?>';
			if(event.user_id == curr_user_id || admin == 'true'){
				$('#editStatus').val(event.status.toLowerCase());
				$('#editUserId').val(event.user_id);
				$('#editDepartmentId').val(event.room_id);
				$('#editModalTitle').html(event.modalTitle);
				$('#edituserId').val(event.user_id);
				$('#editId').val(event.id);
				$('#editbookDate').val(event.bookDate);
				$('#editStartTime').val(st);
				$('#editEndTime').val(en);
				$('#editst').val(st);
				$('#editen').val(en);
				var link = '<?=base_url('booking_rooms/delete_booking')?>/' + event.id;
				$('#deleteBooking').attr('href',link);
				$('#editModal').modal();
				$('.canceled').css('background','red').css('animation-duration','2s').addClass('animated flash infinite');
				$('#cancelR').on('click',function(){
					revertFunc();
				});
			}else{
				$('#errModal').modal();
				revertFunc();
			}
		},
		selectHelper: true,
		select: function(start, end, allDay) {
			var bookDate = start.format('YYYY-MM-DD');
			var startTime = start.format('H:mm');
			var endTime = end.format('H:mm');
			var st = start.format('YYYY-MM-DD H:mm:00');
			var en = end.format('YYYY-MM-DD H:mm:00');
			$('#bookDate').val(bookDate);
			$('#StartTime').val(startTime);
			$('#EndTime').val(endTime);
			$('#st').val(st);
			$('#en').val(en);
			$('#addModal').modal('show');
		},
		editable: true,
		eventLimit: false,
		events: [
			<?
				$output = '';
				foreach($bookings as $event){
					$room = new BookingRoomDepartment($event->department_id);
					$category = new BookingRoomCategory($room->category_id);
					$usr = new User($event->user_id);
					$event_color = '';
					if($room->exists()){
						if($room->color == 'be-category-bar-blue')
							$event_color = '#02C3F3';
						if($room->color == 'be-category-bar-pink')
							$event_color = '#F079AD';
						if($room->color == 'be-category-bar-yellow')
							$event_color = '#FFFF00';
						if($room->color == 'be-category-bar-orange')
							$event_color = '#FB9404';
						if($room->color == 'be-category-bar-green')
							$event_color = '#C2DA66';
						if($room->color == 'be-category-bar-white')
							$event_color = '#FFFFFF';
						if($room->color == 'be-category-bar-purple')
							$event_color = '#9900CC';
					}
					if($room->active == 'yes'){
						$currency = new Currency($room->currency_id);
						if($room->price > 0){
							$to_time = strtotime($event->date.' '.$event->end_time.':00');
							$from_time = strtotime($event->date.' '.$event->start_time.':00');
							$price = (((int)$to_time - (int)$from_time) / 60) * $room->price;
							$currency = $currency->symbol;
						}
						else{
							$price = 'FREE';
							$currency = '';
						}
						$title = $room->name;
						if(strlen($title) > 14)
							$title = trim(substr($title,0,14));	
						$className = '';
						if($event->status == 'canceled')
							$className = 'canceled';
						$output .= '{
							id: "'.$event->id.'",
							user_id: "'.$usr->id.'",
							room_id: "'.$room->id.'",
							title: "'.$title.'",
							modalTitle: "'.$room->name.' room <small>'.$event->date.' ('.$event->start_time.' - '.$event->end_time.')</small>'.'",
							status: "'.ucfirst($event->status).'",
							image: "'.checkImagePath($usr->avatar).'",
							price: "'.$price.'",
							currency: "'.$currency.'",
							className: "'.$className.'",
							user: "'.$usr->first_name.' '.$usr->last_name.'",  
							description: "Booked <strong style=\"color:'.$event_color.'\">'.$room->name.'</strong> <br/> from: <b>'.$event->start_time.'</b> to <b>'.$event->end_time.'</b>",                        
							/*url: "'.base_url('booking_rooms/room/'.$event->slug).'",*/
							bookDate: "'.$event->date.'",
							start: "'.$event->date.'T'.$event->start_time.'",
							end: "'.$event->date.'T'.$event->end_time.'",';
							if($event->featured == 'yes')
								$output .= 'color: "#ff5b57"';
							else
								$output .= 'color: "'.$event_color.'"';
						$output .= '},';
					}
				}
				echo $output;
			?>
		],
		eventClick:  function(event, jsEvent, view) {
			var st = moment(event.start).format('H:mm');
			var en = moment(event.end).format('H:mm');
			var curr_user_id = '<?=$this->user->get_id()?>';
			var admin = '<?=$admin = ($this->users->is_admin())?'true':'false';?>';
			if(event.user_id == curr_user_id || admin == 'true'){
				$('#editStatus').val(event.status.toLowerCase());
				$('#editUserId').val(event.user_id);
				$('#editDepartmentId').val(event.room_id);
				$('#editModalTitle').html(event.modalTitle);
				$('#editId').val(event.id);
				$('#editbookDate').val(event.bookDate);
				$('#editStartTime').val(st);
				$('#editEndTime').val(en);
				$('#editst').val(st);
				$('#editen').val(en);
				var link = '<?=base_url('booking_rooms/delete_booking')?>/' + event.id;
				$('#deleteBooking').attr('href',link);
				$('#editModal').modal();
				$('.canceled').css('background','red').css('animation-duration','2s').addClass('animated flash infinite');
			}else
				$('#errModal').modal();
		},
		timeFormat: 'H:mm',
		eventMouseover: function(calEvent, jsEvent) {
			var tooltip ='<div class="tooltipevent" style="width:auto;max-width:250px;height:auto;background:#fff;border:1px #e2e2e2 solid;-webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.21);box-shadow: 0 1px 1px rgba(0,0,0,.21);padding:0px;position:absolute;z-index:10001;">' +
							'<div class="row">' +
								'<div class="col-md-12" style="margin-bottom:-10px;">' +
									'<h6 style="background:#f3f3f3;padding:5px;"><b>Booking: ' + calEvent.status + '</b><span class="pull-right" style="font-size:11px;">('+ calEvent.currency + calEvent.price +')</span></h6>' +
								'</div>' +
								'<div class="col-md-3">' +
									'<img src="' + calEvent.image + '" class="img-thumbnail" style="width:100%;margin-left:5px;" />' +
								'</div>' +
								'<div class="col-md-9" style="padding-left:0;">' +
									'<p style="word-break:break-all;font-size:12px;margin: 0px;"><strong>' + calEvent.user + '</strong></p>' +
									'<p style="word-break:break-all;font-size:12px;">' + calEvent.description + '</p>' +
								'</div>' +
							'</div>' +
						'</div>';
			$("body").append(tooltip);
			$(this).mouseover(function(e) {
				$(this).css('z-index', 10000);
				$('.tooltipevent').fadeIn('500');
				$('.tooltipevent').fadeTo('10', 1.9);
			}).mousemove(function(e) {
				$('.tooltipevent').css('top', e.pageY + 10);
				$('.tooltipevent').css('left', e.pageX + 20);
			});
		},
		eventMouseout: function(calEvent, jsEvent) {
			 $(this).css('z-index', 8);
			 $('.tooltipevent').remove();
		}
	});
	//console.log(currentYear + "-" + currentMonth +"-01");

	$('[data-click="show-main-image"]').click(function(e) {
		e.preventDefault();
		
		var targetContainer = '[data-id="main-image"]';
		var targetImage = '<img src="'+ $(this).attr('data-url') +'" />';
		var targetLi = $(this).closest('li');
		
		$(targetContainer).html(targetImage);
		$(targetLi).addClass('active');
		$('[data-click="show-main-image"]').closest('li').not(targetLi).removeClass('active');
	});


	$('#addNewBooking').on('submit', function(e){
		e.preventDefault();
		booking('add');
	});
	$('#editBooking').on('submit', function(e){
		e.preventDefault();
		booking('edit');
	});
	function booking(action){

		if(action == 'edit'){
			var $form = $('#editBooking');
			var urls = '<?=base_url('booking_rooms/ajax/room_booking/edit')?>';
			var modal = $('#editModal');
		}else{
			var $form = $('#addNewBooking');
			var urls = '<?=base_url('booking_rooms/ajax/room_booking/add')?>';
			var modal = $('#addModal');
		}
		var $inputs = $form.find('input, select, button, textarea');
		var serializedData = $form.serialize();

		$.ajax({
			url: urls,
			type: 'post',
			dataType: 'json',
			data: serializedData
		}).done(function (response, textStatus, jqXHR){
			if(response.ajax == 'success'){
				modal.modal('hide');
				if(action == 'add'){
					$('#calendarAll').fullCalendar('renderEvent',
					{
						id: response.id,
						user_id: response.user_id,
						room_id: response.room_id,
						title: response.title,
						status: response.status,
						price: response.price,
						currency: response.currency,
						image: response.image,
						user: response.user,
						bookDate: response.bookDate,
						description: response.description,
						start: new Date(response.start),
						end: new Date(response.end),
						color: response.color,
					},
					true);
				}else{
					$('#calendarAll').fullCalendar('refetchEvents');
					$('.canceled').css('background','red').css('animation-duration','2s').addClass('animated flash infinite');
					var item = $("#calendarAll").fullCalendar( 'clientEvents', response.id );
					console.log(item);
					item[0].title = response.title;
					item[0].color = response.color;
					item[0].description = response.description;
					item[0].price = response.price;
					item[0].user = response.user;
					item[0].currency = response.currency;
					item[0].user_id = response.user_id;
					item[0].status = response.status;
					item[0].bookDate = response.bookDate;
					item[0].image = response.image;
					if(response.status == 'canceled')
						item[0].className = 'canceled';
					else
						item[0].className = '';
					$('#calendarAll').fullCalendar('renderEvent',item[0]);
					$('.canceled').css('background','red').css('animation-duration','2s').addClass('animated flash infinite');
				}
			}
			if(response.ajax == 'fail'){

			}
			if(response.ajax == 'error'){

			}

		}).fail(function (response, textStatus, errorThrown){
			console.error( "The following error occurred: " + textStatus, errorThrown );
		}).always(function () {
			
		});
	}
	$('.canceled').css('background','red').css('animation-duration','2s').addClass('animated flash infinite');
	$('.calAll').on('shown.bs.tab', function () {
	   $('#calendarAll').fullCalendar('render');
	});
});
</script>