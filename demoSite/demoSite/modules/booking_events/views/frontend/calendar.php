<link href="<?=base_url('builderengine/public/fullcalendar-3.5.1/fullcalendar.min.css')?>" rel="stylesheet" />
<div class="container event-top-padding">
	<div class="row">
		<div class="col-md-12 col-sm-12" style="margin-bottom:20px;">
			<div id="calendar" class="vertical-box-column p-15 calendar"></div>
		</div>
	</div>
</div>
<script src="<?=base_url('builderengine/public/fullcalendar-3.5.1/lib/moment.min.js')?>"></script>
<script src="<?=base_url('builderengine/public/fullcalendar-3.5.1/fullcalendar.min.js')?>"></script>	
<script>
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
				$begin = new DateTime($object->start_date);
				$end = new DateTime($object->end_date);
				$interval = DateInterval::createFromDateString('1 day');
				$period = new DatePeriod($begin, $interval, $end);
				foreach($period as $date){
					if($object->active == 'yes'){
						$dt = $date->format('Y-m-d');
						$currency = new Currency($object->currency_id);
						if($object->price > 0){
							$price = $object->price;
							$currency = $currency->symbol;
						}
						else{
							$price = 'FREE';
							$currency = '';
						}
						$object_description = strip_tags(str_replace('&nbsp;',' ',$object->description));
						if(strlen($object_description) > 60)
							$decription = trim(substr($object_description,0,60)).'...';
						else
							$decription = trim($object_description);
						$title = $object->name;
						if(strlen($title) > 25)
							$title = trim(substr($title,0,25)).'...';					
						$output .= '{
							title: "Available:'.$object->capacity.'",
							image: "'.$object->image.'",
							price: "'.$price.'",
							currency: "'.$currency.'",
							description: "'.$decription.'",                        
							url: "'.base_url('booking_events/checkout?object='.$type.'&id='.$object->id.'&tickets='.$_GET['tickets'].'&date='.$dt).'",
							start: "'.$dt.'",';
							//if($object->start_date !== $object->end_date)
								//$output .= 'end: "'.$object->end_date.'",';
							if($object->featured == 'yes')
								$output .= 'color: "#ff5b57"';
							else
								$output .= 'color: "#00acac"';
						$output .= '},';
					}
				}
				echo $output;
			?>
		],
		eventMouseover: function(calEvent, jsEvent) {
			var tooltip ='<div class="tooltipevent" style="width:auto;max-width:250px;height:auto;background:#fff;border:1px solid #000;position:absolute;z-index:10001;padding:5px;">' +
							'<div class="row">' +
								'<div class="col-md-12" style="margin-bottom:-10px;">' +
									'<h6 style="background:#eee;padding:5px;"><b>Click to Book now !</b><span class="pull-right" style="font-size:11px;">('+ calEvent.currency + calEvent.price +')</span></h6>' +
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

    $('[data-click="show-main-image"]').click(function(e) {
        e.preventDefault();
        
        var targetContainer = '[data-id="main-image"]';
        var targetImage = '<img src="'+ $(this).attr('data-url') +'" />';
        var targetLi = $(this).closest('li');
        
        $(targetContainer).html(targetImage);
        $(targetLi).addClass('active');
        $('[data-click="show-main-image"]').closest('li').not(targetLi).removeClass('active');
    });
</script>