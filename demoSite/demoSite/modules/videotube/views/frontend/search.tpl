{literal}
<link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />
{/literal}
<section id="preloader">
	<div class="loader" id="loader">
		<div class="loader-img"></div>
	</div>
</section>
<div class="wrapper">
	{block type='page' name="videotube-search"}
		{block type='row' class="video-header-bg galleryprofileheight" name="videotube-search-row-1"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="videotube-search-row-1-col-1"}
				{block type='videotube_profile_header' name="videotube-search-row-1-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="container" name="videotube-search-row-2"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ptb" name="videotube-search-row-2-col-1"}
				{block type='videotube_search' name="videotube-search-row-2-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
	{/block}
</div>