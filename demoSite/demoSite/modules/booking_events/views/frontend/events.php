<link href="<?=base_url('builderengine/public/fullcalendar-3.5.1/fullcalendar.min.css')?>" rel="stylesheet" />
<div class="container event-top-padding">
	<div class="row">
		<div class="pull-right event-logins">
			<?if(!$this->user->is_logged_in()):?>
				<?if($booking_permission == 'no'):?>
					<a href="<?=base_url('user/main/userLogin')?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-sign-in"></i> Sign In</a>
					<a href="<?=base_url('user/registration/index')?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-users"></i> Create Account</a>
				<?endif;?>
			<?else:?>
				<?if($booking_permission == 'no'):?>
					<a href="<?=base_url('user/main/dashboard')?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-user"></i> My Dashboard</a>
					<a href="<?=base_url('user/main/logout')?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-sign-out"></i> Logout</a>
				<?endif;?>
			<?endif;?>
		</div>
		<div class="col-md-12 col-sm-12 event-calendar-1">
			<ul class="nav nav-pills event-pills">
				<li class="<?if(isset($_GET['currentview']) && $_GET['currentview'] == 'list') echo 'active';?>"><a href="#nav-pills-tab-1" data-toggle="tab"><i class="fa fa-list"></i> EVENTS LIST</a></li>
				<li class="<?if(!isset($_GET['currentview']) || (isset($_GET['currentview']) && $_GET['currentview'] == 'tiles')) echo 'active';?>"><a href="#nav-pills-tab-2" data-toggle="tab"><i class="fa fa-th"></i> EVENTS TILES</a></li>
				<li id="calendarView" class="<?if((isset($_GET['currentview']) && $_GET['currentview'] == 'calendar') )echo 'active';?>"><a href="#nav-pills-tab-3" data-toggle="tab"><i class="fa fa-calendar"></i> CALENDAR</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade <?if(isset($_GET['currentview']) && $_GET['currentview'] == 'list') echo 'active in';?>" id="nav-pills-tab-1">
					<div class="row">
						<div class="col-md-12" style="padding:30px 15px;">
							<?foreach($events->order_by('start_date','ASC')->get() as $event):?>
								<?
									$event_categories = explode(',',$event->categories);
									$category = new Booking_event_category();
									$category = $category->where('name',$event_categories[0])->get();
								?>
								<?if($event->active == 'yes' && $event->end_date >= date('Y-m-d',time())):?>
									<div class="panel-group" id="accordion">
										<div class="panel panel-inverse overflow-hidden">
											<div class="panel-heading">
												<h3 class="panel-title">
													<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$event->id?>">
														<i class="fa fa-plus-circle pull-right"></i> 
														<?=$event->name?> (<?=date('d M Y',strtotime($event->start_date))?>)
														<span class="label label-<?if($event->capacity < 1)echo 'danger'; else echo 'success';?> pull-right" style="margin-right:20px;">
															<?if($event->capacity < 1)echo 'Booked Out'; else echo 'HIDE DETAILS';?>
														</span>
													</a>
													&nbsp;&nbsp;&nbsp;&nbsp;<span class="label <?=$category->color?>" style=""><strong><?=ucfirst($category->name)?></strong></span>
												</h3>
											</div>
											<div id="collapse<?=$event->id?>" class="">
												<div class="panel-body">
													<div class="result-container">
														<ul class="result-list">
															<li>
																<div class="result-image" style="width:25%">
																	<a href="<?=base_url('booking_events/event/'.$event->slug)?>"><img src="<?=checkImagePath($event->image)?>" alt="" /></a>
																</div>
																<div class="result-info" style="width:50%">
																	<h4 class="title"><a href="<?=base_url('booking_events/event/'.$event->slug)?>"><?=$event->name?></a></h4>
																	<p class="location"><?=$event->location?></p>
																	<p class="desc">
																	<?
																		$text_without_slashes = strip_tags(ChEditorfix($event->description));
																		if(strlen($event->description) > 100)
																			$text = substr($text_without_slashes, 0, 100).'...';
																		else
																			$text = $text_without_slashes;
																		echo $text;
																	?>
																	</p>
																	<div class="btn-row">
																	<!--
																		<a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Analytics"><i class="fa fa-fw fa-bar-chart-o"></i></a>
																		<a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Tasks"><i class="fa fa-fw fa-tasks"></i></a>
																		<a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Configuration"><i class="fa fa-fw fa-cog"></i></a>
																		<a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Performance"><i class="fa fa-fw fa-tachometer"></i></a>
																		<a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Users"><i class="fa fa-fw fa-user"></i></a>
																		-->
																	</div>
																</div>
																<div class="result-price" style="width:25%">
																		<?$currency = new Currency($event->currency_id);
																		
																			if($event->price > 0){
																				$price = $event->price;
																				$currency = $currency->symbol;
																				$info = 'PER PERSON';
																			}
																			else{
																				$price = 'FREE';
																				$currency = '';
																				$info = '';
																			}												
																		?>
																	<?=$currency.$price?><small><?=$text?></small>
																	<a href="<?=base_url('booking_events/event/'.$event->slug)?>" class="btn btn-success btn-block"><i class="fa fa-eye"></i> VIEW EVENT</a>
																</div>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?endif;?>
							<?endforeach;?>
						</div>
					</div>
				</div>
				<div class="tab-pane fade <?if(!isset($_GET['currentview']) || (isset($_GET['currentview']) && $_GET['currentview'] == 'tiles')) echo 'active in';?>" id="nav-pills-tab-2">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="row">
								<?foreach($events->order_by('start_date','ASC')->get() as $event):?>
									<?
										$currency = new Currency($event->currency_id);
										$event_categories = explode(',',$event->categories);
										$category = new Booking_event_category();
										$category = $category->where('name',$event_categories[0])->get();
									?>
									<?if($event->active == 'yes' && $event->end_date >= date('Y-m-d',time())):?>
										<div class="col-lg-3 col-md-3 col-sm-4 col-xs-4 event-tiles-padding">
											<div class="thumbnail bgwhite1 event-tiles">
												<a href="<?=base_url('booking_events/event/'.$event->slug)?>"><img src="<?=checkImagePath($event->image)?>" class="img-responsive shadow1 event-tiles-image" alt="<?=$event->name?>"></a>
												<?
													if($event->price > 0){
														$price = $event->price;
														$currency = $currency->symbol;
													}
													else{
														$price = 'FREE';
														$currency = '';
													}												
												?>
												<div class="caption">
													<h3><?=$event->name?></h3>
													<p><?=date('d M Y',strtotime($event->start_date))?></p>
													<span class="label <?=$category->color?>" style=""><strong><?=ucfirst($category->name)?></strong></span>
													<p><small>Book Now for <?=$currency.$price?></small></p>
													<div class="event-short-text">
													<?
														$text_without_slashes = strip_tags(ChEditorfix($event->description));
														if(strlen($event->description) > 100)
															$text = substr($text_without_slashes, 0, 100).'...';
														else
															$text = $text_without_slashes;
														echo $text;
													?>
													<p><?=$text?></p>
													</div>
												</div>
												<div class="caption event-titles-view-event">
													<p class="text-center">
														<a href="<?=base_url('booking_events/event/'.$event->slug)?>" class="btn btn-sm btn-danger" role="button"><i class="fa fa-eye"></i> VIEW EVENT</a>
													</p>
												</div>
											</div>
										</div>
									<?endif;?>
								<?endforeach;?>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade <?if((isset($_GET['currentview']) && $_GET['currentview'] == 'calendar') )echo 'active in';?>" id="nav-pills-tab-3">
					<div class="row">
						<div class="col-md-12 col-sm-12" style="padding:30px;">
							<div id="calendar" class="vertical-box-column p-15 calendar"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?=base_url('builderengine/public/fullcalendar-3.5.1/lib/moment.min.js')?>"></script>
<script src="<?=base_url('builderengine/public/fullcalendar-3.5.1/fullcalendar.min.js')?>"></script>
<script>
$(document).ready(function(){
	var date = new Date();
	var currentYear = date.getFullYear();
	var currentMonth = date.getMonth() + 1;
		currentMonth = (currentMonth < 10) ? '0' + currentMonth : currentMonth;

	$('#calendar').fullCalendar({
		//height:600,
		header: {
			left: 'month,agendaWeek,agendaDay',
			center: 'title',
			right: 'prev,today,next '
		},
		droppable: false, // this allows things to be dropped onto the calendar
		drop: function() {
			$(this).remove();
		},
		selectable: false,
		selectHelper: true,
		select: function(start, end) {
			var title = prompt('Event Title:');
			var eventData;
			if (title) {
				eventData = {
					title: title,
					start: start,
					end: end
				};
				$('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
			}
			$('#calendar').fullCalendar('unselect');
		},
		editable: false,
		eventLimit: true, // allow "more" link when too many events
		events: [
			<?
				$output = '';
				foreach($events->get() as $event){
					$event_categories = explode(',',$event->categories);
					$category = new Booking_event_category();
					$category = $category->where('name',$event_categories[0])->get();
					$event_color = '';
					if($category->exists()){
						if($category->color == 'be-category-bar-blue')
							$event_color = '#02C3F3';
						if($category->color == 'be-category-bar-pink')
							$event_color = '#F079AD';
						if($category->color == 'be-category-bar-yellow')
							$event_color = '#b3a300';
						if($category->color == 'be-category-bar-orange')
							$event_color = '#FB9404';
						if($category->color == 'be-category-bar-green')
							$event_color = '#C2DA66';
						if($category->color == 'be-category-bar-white')
							$event_color = '#FFFFFF';
					}
					if($event->active == 'yes'){
						$currency = new Currency($event->currency_id);
						if($event->price > 0){
							$price = $event->price;
							$currency = $currency->symbol;
						}
						else{
							$price = 'FREE';
							$currency = '';
						}
						$event_description = strip_tags(str_replace('&nbsp;',' ',$event->description));
						if(strlen($event_description) > 100)
							$decription = trim(substr($event_description,0,100)).'...';
						else
							$decription = trim($event_description);
						$title = $event->name;
						if(strlen($title) > 25)
							$title = trim(substr($title,0,25)).'...';					
						$output .= '{
							title: "'.$title.'",
							image: "'.checkImagePath($event->image).'",
							price: "'.$price.'",
							currency: "'.$currency.'",
							description: "'.$decription.'",                        
							url: "'.base_url('booking_events/event/'.$event->slug).'",
							start: "'.$event->start_date.'T'.$event->start_time.'",';
							//if($event->start_date !== $event->end_date)
								$output .= 'end: "'.$event->end_date.'T'.$event->end_time.'",';
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
		timeFormat: 'H:mm',
		eventMouseover: function(calEvent, jsEvent) {
			var tooltip ='<div class="tooltipevent" style="width:auto;max-width:250px;height:auto;background:#fff;border:1px solid #000;position:absolute;z-index:10001;padding:5px;">' +
							'<div class="row">' +
								'<div class="col-md-12" style="margin-bottom:-10px;">' +
									'<h6 style="background:#eee;padding:5px;"><b>' + calEvent.title + '</b><span class="pull-right" style="font-size:11px;">('+ calEvent.currency + calEvent.price +')</span></h6>' +
								'</div>' +
								'<div class="col-md-4">' +
									'<img src="' + calEvent.image + '" class="img-thumbnail" style="width:100%;" />' +
								'</div>' +
								'<div class="col-md-8" style="padding-left:0;">' +
									'<p style="word-break:break-all;font-size:11px;">' + calEvent.description + '<p/>' +
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
	console.log(currentYear + "-" + currentMonth +"-01");

	$('#calendarView').on('shown.bs.tab', function () {
	   $('#calendar').fullCalendar('render');
	});
});
</script>