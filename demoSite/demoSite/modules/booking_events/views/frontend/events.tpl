<div class="container event-top-padding">
	{block type='page' name="booking-events-events"}
		{block type='row' class="" name="booking-events-events-row-1"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="booking-events-events-row-1-col-1"}
				{block type='booking_events_top_bar' name="booking-events-events-row-1-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 event-calendar-1" name="booking-events-events-row-1-col-2"}
				{block type='booking_events_calendar' name="booking-events-events-row-1-col-2-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
	{/block}
</div>