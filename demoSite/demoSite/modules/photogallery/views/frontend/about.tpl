
<link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />
<section id="preloader">
	<div class="loader" id="loader">
		<div class="loader-img"></div>
	</div>
</section>
<div class="wrapper">
	{block type='page' name="photogallery-about"}
		{block type='row' class="" name="photogallery-about-row-1"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="photogallery-about-row-1-col-1"}
				{block type='photogallery_top_bar' name="photogallery-about-row-1-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="" name="photogallery-about-row-2"}
			{block type='column' class="" name="photogallery-about-row-2-col-1"}
				{block type='photogallery_channel_profile_bar' name="photogallery-about-row-2-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="ptb container" name="photogallery-about-row-3"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ptb" name="photogallery-about-row-3-col-1"}
				{block type='photogallery_about' name="photogallery-about-row-3-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="ptb container photogallery-row-nocontainer" name="photogallery-about-row-4"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 space60" name="photogallery-about-row-4-col-1"}
				{block type='photogallery_bottom_slider' name="photogallery-about-row-4-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
	{/block}
</div>