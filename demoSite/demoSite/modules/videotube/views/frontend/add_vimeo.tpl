<section id="preloader">
	<div class="loader" id="loader">
		<div class="loader-img"></div>
	</div>
</section>
<div class="wrapper">
	{block type='page' name="videotube-upload"}
		{block type='row' class="video-header-bg galleryprofileheight" name="videotube-upload-row-1"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="videotube-upload-row-1-col-1"}
				{block type='videotube_profile_header' name="videotube-upload-row-1-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="ptb container" name="videotube-upload-row-2"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="videotube-upload-row-2-col-1"}
				{block type='videotube_add_vimeo' name="videotube-upload-row-2-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
	{/block}
</div>