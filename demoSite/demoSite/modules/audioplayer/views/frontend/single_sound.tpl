
<link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />

<section id="preloader">
	<div class="loader" id="loader">
		<div class="loader-img"></div>
	</div>
</section>
<div class="wrapper">
	{block type='page' name="audioplayer-single_sound"}
		{block type='row' class="" name="audioplayer-single_sound-row-1"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " name="audioplayer-single_sound-row-1-col-1"}
				{block type='audioplayer_top_bar' name="audioplayer-single_sound-row-1-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
	{/block}
	{block type='page' class="audiostreaming-galleryimageview-page" name="audioplayer-single_sound-2"}
		{block type='row' class="container" name="audioplayer-single_sound-row-2"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 audiogalleryimageview containter" name="audioplayer-single_sound-row-2-col-1"}
				{block type='audioplayer_single_sound_file' name="audioplayer-single_sound-row-2-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
	{/block}
	{block type='page' name="audioplayer-single_sound-3"}
		{block type='row' class="" name="audioplayer-single_sound-row-3"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 audiogallerydark-bg  galleryprofileheight" name="audioplayer-single_sound-row-3-col-1"}
				{block type='audioplayer_single_sound_profile' name="audioplayer-single_sound-row-3-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="container" name="audioplayer-single_sound-row-4"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 galleryphotodetails" name="audioplayer-single_sound-row-4-col-1"}
				{block type='audioplayer_single_sound_details' name="audioplayer-single_sound-row-4-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="container" name="audioplayer-single_sound-row-5"}
			{block type='column' class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ptb" name="audioplayer-single_sound-row-5-col-1"}
				{block type='audioplayer_single_sound_comments' name="audioplayer-single_sound-row-5-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
			{block type='column' class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ptb-audio-sidebar" name="audioplayer-single_sound-row-5-col-2"}
				{block type='audioplayer_single_sound_sidebar' name="audioplayer-single_sound-row-5-col-2-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="container audiostreaming-row-nocontainer" name="audioplayer-single_sound-row-6"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 space60" name="audioplayer-single_sound-row-6-col-1"}
				{block type='audioplayer_single_sound_slider' name="audioplayer-single_sound-row-6-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
	{/block}
</div>