<section id="preloader">
	<div class="loader" id="loader">
		<div class="loader-img"></div>
	</div>
</section>
<div class="wrapper">
	{block type='page' name="videotube-channel"}
		{block type='row' class="" name="videotube-channel-row-2"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="videotube-channel-row-2-col-1"}
				{block type='videotube_channel_profile_bar' name="videotube-channel-row-2-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="videochannels-ptb-20 container videochannels-row-nocontainer-3" name="videotube-channel-row-3"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="videotube-channel-row-3-col-1"}
				{block type='videotube_featured_videos_user' name="videotube-channel-row-3-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="container videochannels-row-nocontainer" name="videotube-channel-row-3-1"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="videotube-channel-row-3-1-col-2"}
				{block type='videotube_recent_videos_user' name="videotube-channel-row-3-1-col-2-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="ptb container videochannels-row-nocontainer" name="videotube-channel-row-3-2"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="videotube-channel-row-3-2-col-3"}
				{block type='videotube_channel' name="videotube-channel-row-3-2-col-3-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
	{/block}
</div>