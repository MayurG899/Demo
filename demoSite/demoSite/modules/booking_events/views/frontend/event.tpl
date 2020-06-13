<section id="preloader">
	<div class="loader" id="loader">
		<div class="loader-img"></div>
	</div>
</section>
	{block type='page' name="booking-events-event"}
		{block type='row' class="container" name="booking-events-event-row-1"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 event-container" name="booking-events-event-row-1-col-2"}
				{block type='booking_events_event' name="booking-events-event-row-1-col-2-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="container" name="booking-events-event-row-2"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 container" name="booking-events-event-row-2-col-3"}
				{block type='booking_events_upcoming_events' name="booking-events-event-row-2-col-3-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
	{/block}
