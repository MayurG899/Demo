<section id="preloader">
	<div class="loader" id="loader">
		<div class="loader-img"></div>
	</div>
</section>
<div class="wrapper">
	{block type='page' name="photogallery-photos"}
		{block type='row' class="" name="photogallery-photos-row-1"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="photogallery-photos-row-1-col-1"}
				{block type='photogallery_top_bar' name="photogallery-photos-row-1-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="" name="photogallery-photos-row-2"}
			{block type='column' class="space40" name="photogallery-photos-row-2-col-1"}
				{block type='photogallery_channel_profile_bar' name="photogallery-photos-row-2-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="container photogallery-row-nocontainer" name="photogallery-photos-row-3"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 space15" name="photogallery-photos-row-3-col-1"}
				{block type='photogallery_all_photos_thumbnails_user' name="photogallery-photos-row-3-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="container photogallery-row-nocontainer" name="photogallery-photos-row-4"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 space60" name="photogallery-photos-row-4-col-1"}
				{block type='photogallery_bottom_slider' name="photogallery-photos-row-4-col-1-block-1"}
					{content}
					{/content}
				{/block} 
			{/block}
		{/block}
	{/block}
</div>