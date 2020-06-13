
<link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />

<section id="preloader">
	<div class="loader" id="loader">
		<div class="loader-img"></div>
	</div>
</section>
<div class="wrapper">
	{block type='page' name="photogallery-all_photos"}
		{block type='row' class="" name="photogallery-all_photos-row-1"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="photogallery-all_photos-row-1-col-1"}
				{block type='photogallery_top_bar' name="photogallery-all_photos-row-1-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="container photogallery-row-nocontainer" name="photogallery-all_photos-row-2"}
			{block type='column' class="col-lg-5 col-md-5 col-sm-12 col-xs-12" name="photogallery-all_photos-row-2-col-1"}
				{block type='photogallery_featured_photos' name="photogallery-all_photos-row-2-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
			{block type='column' class="col-lg-7 col-md-7 col-sm-12 col-xs-12" name="photogallery-all_photos-row-2-col-2"}
				{block type='photogallery_all_albums' name="photogallery-all_photos-row-2-col-2-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="container photogallery-row-nocontainer" name="photogallery-all_photos-row-3"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 space40" name="photogallery-all_photos-row-3-col-1"}
				{block type='photogallery_recent_photos' name="photogallery-all_photos-row-3-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="container photogallery-row-nocontainer" name="photogallery-all_photos-row-5"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 space20" name="photogallery-all_photos-row-5-col-1"}
				{block type='photogallery_all_photos_thumbnails' name="photogallery-all_photos-row-5-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="container photogallery-row-nocontainer" name="photogallery-all_photos-row-6"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 space40" name="photogallery-all_photos-row-6-col-1"}
				{block type='photogallery_bottom_slider' name="photogallery-all_photos-row-6-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
	{/block}
</div>