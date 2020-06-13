<section id="preloader">
	<div class="loader" id="loader">
		<div class="loader-img"></div>
	</div>
</section>
<div class="wrapper">
	{block type='page' name="audioplayer-channel"}
		{block type='row' class="" name="audioplayer-channel-row-1"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="audioplayer-channel-row-1-col-1"}
				{block type='audioplayer_top_bar' name="audioplayer-channel-row-1-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="" name="audioplayer-channel-row-2"}
			{block type='column' class="" name="audioplayer-channel-row-2-col-1"}
				{block type='audioplayer_channel_profile_bar' name="audioplayer-channel-row-2-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="ptb-audio-channels container audiostreaming-row-nocontainer" name="audioplayer-channel-row-3"}
			{block type='column' class="col-lg-6 col-md-6 col-sm-12 col-xs-12" name="audioplayer-channel-row-4-col-1"}
				{block type='audioplayer_recent_audios_user' name="audioplayer-channel-row-4-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
			{block type='column' class="col-lg-6 col-md-6 col-sm-12 col-xs-12" name="audioplayer-channel-row-3-col-1"}
				{block type='audioplayer_featured_audios_user' name="audioplayer-channel-row-3-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="ptb container audiostreaming-row-nocontainer" name="audioplayer-channel-row-5"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="audioplayer-channel-row-5-col-1"}
				{block type='audioplayer_channel' name="audioplayer-channel-row-5-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="container audiostreaming-row-nocontainer" name="audioplayer-channel-row-6"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 space60" name="audioplayer-channel-row-6-col-1"}
				{block type='audioplayer_bottom_slider' name="audioplayer-channel-row-6-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
	{/block}
</div>