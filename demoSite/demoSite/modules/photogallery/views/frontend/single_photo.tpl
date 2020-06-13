
<link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />

<section id="preloader">
	<div class="loader" id="loader">
		<div class="loader-img"></div>
	</div>
</section>
<div class="wrapper">
	{block type='page' name="photogallery-single_photo"}
		{block type='row' class="" name="photogallery-single_photo-row-1"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="photogallery-single_photo-row-1-col-1"}
				{block type='photogallery_top_bar' name="photogallery-single_photo-row-1-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
	{/block}
	{block type='page' class="photogallery-galleryimageview-page" name="photogallery-single_photo-2"}
		{block type='row' class="container" name="photogallery-single_photo-row-2"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 photogallery-galleryimageview" name="photogallery-single_photo-row-2-col-1"}
				{block type='photogallery_single_photo_file' name="photogallery-single_photo-row-2-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
	{/block}
	{block type='page' name="photogallery-single_photo-3"}
		{block type='row' class="" name="photogallery-single_photo-row-3"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 photogallery-dark-bg  photogallery-galleryprofileheight" name="photogallery-single_photo-row-3-col-1"}
				{block type='photogallery_single_photo_profile' name="photogallery-single_photo-row-3-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="container photogallery-row-nocontainer-3" name="photogallery-single_photo-row-4"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 photogallery-galleryphotodetails" name="photogallery-single_photo-row-4-col-1"}
				{block type='photogallery_single_photo_details' name="photogallery-single_photo-row-4-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="container photogallery-row-nocontainer-3" name="photogallery-single_photo-row-5"}
			{block type='column' class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ptb" name="photogallery-single_photo-row-5-col-1"}
				{block type='photogallery_single_photo_comments' name="photogallery-single_photo-row-5-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
			{block type='column' class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ptb-photo-sidebar" name="photogallery-single_photo-row-5-col-2"}
				{block type='photogallery_single_photo_sidebar' name="photogallery-single_photo-row-5-col-2-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
		{block type='row' class="container photogallery-row-nocontainer" name="photogallery-single_photo-row-6"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 space60" name="photogallery-single_photo-row-6-col-1"}
				{block type='photogallery_single_photo_slider' name="photogallery-single_photo-row-6-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
	{/block}
</div>