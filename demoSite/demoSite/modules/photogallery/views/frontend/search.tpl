
<link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />

<section id="preloader">
	<div class="loader" id="loader">
		<div class="loader-img"></div>
	</div>
</section>
<div class="wrapper">
	{block type='page' name="photogallery-search"}
		{block type='row' class="" name="photogallery-search-row-1"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="photogallery-search-row-1-col-1"}
				{block type='photogallery_top_bar' name="photogallery-search-row-1-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="container" name="photogallery-search-row-2"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ptb" name="photogallery-search-row-2-col-1"}
				{block type='photogallery_search' name="photogallery-search-row-2-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="ptb container" name="photogallery-search-row-3"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 space60" name="photogallery-search-row-3-col-1"}
				{block type='photogallery_bottom_slider' name="photogallery-search-row-3-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
	{/block}
</div>