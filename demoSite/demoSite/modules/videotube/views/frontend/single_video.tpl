{literal}
<link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />
{/literal}
<section id="preloader">
	<div class="loader" id="loader">
		<div class="loader-img"></div>
	</div>
</section>
<div class="wrapper">
	{block type='page' name="videotube-single_video"}
		{block type='row' class="video-header-bg galleryprofileheight" name="videotube-single_video-row-0"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="videotube-single_video-row-0-col-1"}
				{block type='videotube_profile_header' name="videotube-single_video-row-0-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="container videochannels-row-nocontainer-2" name="videotube-single_video-row-1"}
			{block type='column' class="col-lg-9 col-md-9 col-sm-12 col-xs-12 galleryimageview videotube-video-mainvideo-nopadding-left" name="videotube-single_video-row-1-col-1"}
				{block type='videotube_single_video_file' name="videotube-single_video-row-1-col-1-block-1"}
					{content}
					{/content}
				{/block}
				{block type='videotube_single_video_profile' name="videotube-single_video-row-1-col-1-block-2"}
					{content}
					{/content}
				{/block}
				{block type='videotube_single_video_details' name="videotube-single_video-row-1-col-1-block-3"}
					{content}
					{/content}
				{/block}
			{/block}
			{block type='column' class="col-lg-3 col-md-3 col-sm-12 col-xs-12 galleryimageview" name="videotube-single_video-row-1-col-2"}
				{block type='videotube_recent_videos_vertical' name="videotube-single_video-row-1-col-2-block-1"}
					{content}
					{/content}
				{/block}
				{block type='videotube_single_video_sidebar' name="videotube-single_video-row-1-col-2-block-2"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="container videochannels-row-nocontainer-2" name="videotube-single_video-row-3"}
			{block type='column' class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ptb" name="videotube-single_video-row-3-col-1"}
				{block type='videotube_single_video_comments' name="videotube-single_video-row-3-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
			{block type='column' class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ptb" name="videotube-single_video-row-3-col-2"}
			{/block}
		{/block}
	{/block}
</div>