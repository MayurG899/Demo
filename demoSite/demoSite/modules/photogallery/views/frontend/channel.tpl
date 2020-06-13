<section id="preloader">
	<div class="loader" id="loader">
		<div class="loader-img"></div>
	</div>
</section>
<div class="wrapper">
	{block type='page' name="photogallery-channel"}
		{block type='row' class="" name="photogallery-channel-row-1"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="photogallery-channel-row-1-col-1"}
				{block type='photogallery_top_bar' name="photogallery-channel-row-1-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="" name="photogallery-channel-row-2"}
			{block type='column' class="space20" name="photogallery-channel-row-2-col-1"}
				{block type='photogallery_channel_profile_bar' name="photogallery-channel-row-2-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="container photogallery-row-nocontainer" name="photogallery-channel-row-3"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 space15" name="photogallery-channel-row-3-col-1"}
				{block type='photogallery_recent_photos_user' name="photogallery-channel-row-3-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="container photogallery-row-nocontainer" name="photogallery-channel-row-4"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="photogallery-channel-row-4-col-1"}
				{block type='photogallery_channel' name="photogallery-channel-row-4-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="container photogallery-row-nocontainer" name="photogallery-channel-row-5"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 space60" name="photogallery-channel-row-5-col-1"}
				{block type='photogallery_bottom_slider' name="photogallery-channel-row-5-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
	{/block}
</div>