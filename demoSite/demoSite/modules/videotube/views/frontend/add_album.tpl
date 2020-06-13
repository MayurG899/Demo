{literal}
<link href="{base_url('modules/videotube/assets/js/plugin/upload/upload.css')}" rel="stylesheet" type="text/css" />
{/literal}
<section id="preloader">
	<div class="loader" id="loader">
		<div class="loader-img"></div>
	</div>
</section>
<div class="wrapper">
	{block type='page' name="videotube-addalbum"}
		{block type='row' class="video-header-bg galleryprofileheight" name="videotube-addalbum-row-1"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="videotube-addalbum-row-1-col-1"}
				{block type='videotube_profile_header' name="videotube-addalbum-row-1-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="ptb container" name="videotube-addalbum-row-2"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="videotube-addalbum-row-2-col-1"}
				{block type='videotube_add_album' name="videotube-addalbum-row-2-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
	{/block}
</div>