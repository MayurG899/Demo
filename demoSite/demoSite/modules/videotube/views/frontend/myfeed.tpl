<section id="preloader">
	<div class="loader" id="loader">
		<div class="loader-img"></div>
	</div>
</section>
<div class="wrapper">
	{block type='page' name="videotube-myfeed"}
		{block type='row' class="" name="videotube-myfeed-row-1"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="videotube-myfeed-row-1-col-1"}
				{block type='videotube_channel_profile_bar' name="videotube-myfeed-row-1-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="ptb container" name="videotube-myfeed-row-2"}
			{block type='column' class="col-lg-8 col-md-8 col-sm-12 col-xs-12" name="videotube-myfeed-row-2-col-1"}
				{block type='videotube_myfeed_content' name="videotube-myfeed-row-2-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
			{block type='column' class="col-lg-4 col-md-4 col-sm-12 col-xs-12" name="videotube-myfeed-row-2-col-2"}			
				{block type='videotube_myfeed_sidebar' name="videotube-myfeed-row-2-col-2-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
	{/block}
</div>