<section id="preloader">
	<div class="loader" id="loader">
		<div class="loader-img"></div>
	</div>
</section>
<div class="wrapper">
	{block type='page' name="videotube-all_videos"}
		{block type='row' class="video-header-bg galleryprofileheight" name="videotube-all_videos-row-1"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="videotube-all_videos-row-1-col-1"}
				{block type='videotube_profile_header' name="videotube-all_videos-row-1-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="ptb-2 container videochannels-row-nocontainer-3" name="videotube-all_videos-row-2"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="videotube-all_videos-row-2-col-1"}
				{block type='videotube_featured_videos' name="videotube-all_videos-row-2-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="container videochannels-row-nocontainer" name="videotube-all_videos-row-3"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="videotube-all_videos-row-3-col-1"}
				{block type='videotube_recent_videos' name="videotube-all_videos-row-3-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="container videochannels-row-nocontainer" name="videotube-all_videos-row-4"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="videotube-all_videos-row-4-col-1"}
				{block type='videotube_all_albums' name="videotube-all_videos-row-4-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="container videochannels-row-nocontainer" name="videotube-all_videos-row-5"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ptb" name="videotube-all_videos-row-5-col-1"}
				{block type='videotube_all_videos_thumbnails' name="videotube-all_videos-row-5-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
	{/block}
</div>