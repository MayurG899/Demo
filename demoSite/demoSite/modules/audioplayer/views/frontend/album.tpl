
<link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />

<section id="preloader">
	<div class="loader" id="loader">
		<div class="loader-img"></div>
	</div>
</section>
<div class="wrapper">
	{block type='page' name="audioplayer-album"}
		{block type='row' class="" name="audioplayer-album-row-1"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="audioplayer-album-row-1-col-1"}
				{block type='audioplayer_top_bar' name="audioplayer-album-row-1-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="" name="audioplayer-album-row-2"}
			{block type='column' class="" name="audioplayer-album-row-2-col-1"}
				{block type='audioplayer_channel_profile_bar' name="audioplayer-album-row-2-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="container ptb-audio-tracks audiostreaming-row-nocontainer" name="audioplayer-album-row-3"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="audioplayer-album-row-3-col-1"}
				{block type='audioplayer_album' name="audioplayer-album-row-3-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="container audiostreaming-row-nocontainer" name="audioplayer-album-row-4"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 space60" name="audioplayer-album-row-4-col-1"}
				{block type='audioplayer_bottom_slider' name="audioplayer-album-row-4-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
	{/block}
</div>