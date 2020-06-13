<section id="preloader">
	<div class="loader" id="loader">
		<div class="loader-img"></div>
	</div>
</section>
<div class="wrapper">
	{block type='page' name="audioplayer-channel-discussion"}
		{block type='row' class="" name="audioplayer-channel-discussion-row-1"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="audioplayer-channel-discussion-row-1-col-1"}
				{block type='audioplayer_top_bar' name="audioplayer-channel-discussion-row-1-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="" name="audioplayer-channel-discussion-row-2"}
			{block type='column' class="" name="audioplayer-channel-discussion-row-2-col-1"}
				{block type='audioplayer_channel_profile_bar' name="audioplayer-channel-discussion-row-2-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="ptb container" name="audioplayer-channel-discussion-row-3"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="audioplayer-channel-discussion-row-3-col-1"}
				{block type='audioplayer_channel_comments' name="audioplayer-channel-discussion-row-3-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
	{/block}
</div>