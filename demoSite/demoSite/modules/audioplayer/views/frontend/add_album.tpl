<link href="{base_url('modules/audioplayer/assets/js/plugin/upload/upload.css')}" rel="stylesheet" type="text/css" />

<section id="preloader">
	<div class="loader" id="loader">
		<div class="loader-img"></div>
	</div>
</section>
<div class="wrapper">
	{block type='page' name="audioplayer-addalbum"}
		{block type='row' class="" name="audioplayer-addalbum-row-1"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="audioplayer-addalbum-row-1-col-1"}
				{block type='audioplayer_top_bar' name="audioplayer-addalbum-row-1-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="ptb container" name="audioplayer-addalbum-row-2"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="audioplayer-addalbum-row-2-col-1"}
				{block type='audioplayer_add_album' name="audioplayer-addalbum-row-2-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
	{/block}
</div>