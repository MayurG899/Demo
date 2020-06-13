<section id="preloader">
	<div class="loader" id="loader">
		<div class="loader-img"></div>
	</div>
</section>
<div class="wrapper">
	{block type='page' name="audioplayer-all_sounds"}
		{block type='row' class="" name="audioplayer-all_sounds-row-1"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="audioplayer-all_sounds-row-1-col-1"}
				{block type='audioplayer_top_bar' name="audioplayer-all_sounds-row-1-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="container audiostreaming-row-nocontainer" name="audioplayer-all_sounds-row-2"}
			{block type='column' class="col-lg-8 col-md-8 col-sm-12 col-xs-12 audio-ptb" name="audioplayer-all_sounds-row-3-col-1"}
				{block type='audioplayer_all_albums' name="audioplayer-all_sounds-row-3-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
			{block type='column' class="col-lg-4 col-md-4 col-sm-12 col-xs-12 audio-ptb" name="audioplayer-all_sounds-row-2-col-1"}
				{block type='audioplayer_featured_audios' name="audioplayer-all_sounds-row-2-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="container audiostreaming-row-nocontainer" name="audioplayer-all_sounds-row-4"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 audio-ptb" name="audioplayer-all_sounds-row-4-col-1"}
				{block type='audioplayer_recent_audios' name="audioplayer-all_sounds-row-4-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="container audiostreaming-row-nocontainer" name="audioplayer-all_sounds-row-5"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 audio-ptb" name="audioplayer-all_sounds-row-5-col-1"}
				{block type='audioplayer_all_audios_thumbnails' name="audioplayer-all_sounds-row-5-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="container audiostreaming-row-nocontainer" name="audioplayer-all_sounds-row-6"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 space60" name="audioplayer-all_sounds-row-6-col-1"}
				{block type='audioplayer_bottom_slider' name="audioplayer-all_sounds-row-6-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
	{/block}
</div>