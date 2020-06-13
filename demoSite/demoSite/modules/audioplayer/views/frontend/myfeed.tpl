<section id="preloader">
	<div class="loader" id="loader">
		<div class="loader-img"></div>
	</div>
</section>
<div class="wrapper">
	{block type='page' name="audioplayer-myfeed"}
		{block type='row' class="" name="audioplayer-myfeed-row-1"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="audioplayer-myfeed-row-1-col-1"}
				{block type='audioplayer_top_bar' name="audioplayer-myfeed-row-1-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="ptb container" name="audioplayer-myfeed-row-2"}
			{block type='column' class="col-lg-8 col-md-8 col-sm-12 col-xs-12" name="audioplayer-myfeed-row-2-col-1"}
				{block type='audioplayer_myfeed_content' name="audioplayer-myfeed-row-2-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
			{block type='column' class="col-lg-4 col-md-4 col-sm-12 col-xs-12" name="audioplayer-myfeed-row-2-col-2"}			
				{block type='audioplayer_myfeed_sidebar' name="audioplayer-myfeed-row-2-col-2-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
	{/block}
</div>