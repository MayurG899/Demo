
<link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />

<section id="preloader">
	<div class="loader" id="loader">
		<div class="loader-img"></div>
	</div>
</section>
<div class="wrapper">
	{block type='page' name="photogallery-albums"}
		{block type='row' class="" name="photogallery-albums-row-1"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="photogallery-albums-row-1-col-1"}
				{block type='photogallery_top_bar' name="photogallery-albums-row-1-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="" name="photogallery-albums-row-2"}
			{block type='column' class="space40" name="photogallery-albums-row-2-col-1"}
				{block type='photogallery_channel_profile_bar' name="photogallery-albums-row-2-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="container photogallery-row-nocontainer" name="photogallery-albums-row-3"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 space15 container" name="photogallery-albums-row-3-col-1"}
				{block type='photogallery_all_albums_user' name="photogallery-albums-row-3-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class=" container photogallery-row-nocontainer" name="photogallery-albums-row-4"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 space60" name="photogallery-albums-row-4-col-1"}
				{block type='photogallery_bottom_slider' name="photogallery-albums-row-4-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
	{/block}
</div>