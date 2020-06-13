<section id="preloader">
	<div class="loader" id="loader">
		<div class="loader-img"></div>
	</div>
</section>
<div class="wrapper">
	{block type='page' name="videotube-register"}
		{block type='row' class="container ptb" name="videotube-register-row-1"}
			{block type='column' class="col-md-6" name="videotube-register-row-1-col-1"}
				{block type='videotube_register_form' name="videotube-register-row-1-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
			{block type='column' class="col-md-6" name="videotube-register-row-1-col-2"}
				{block type='videotube_register_info' name="videotube-register-row-1-col-2-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
	{/block}
</div>