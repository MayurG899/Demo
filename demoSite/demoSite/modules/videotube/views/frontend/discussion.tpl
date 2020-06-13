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
		{block type='row' class="ptb container" name="videotube-channel-row-3"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="videotube-channel-row-3-col-1"}
				{block type='videotube_channel_comments' name="videotube-channel-row-3-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
	{/block}
</div>