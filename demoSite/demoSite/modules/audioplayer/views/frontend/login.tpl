<section id="preloader">
	<div class="loader" id="loader">
		<div class="loader-img"></div>
	</div>
</section>
<div class="wrapper">
	{block type='page' name="audioplayer-login"}
		{block type='row' class="container ptb" name="audioplayer-login-row-1"}
			{block type='column' class="col-lg-6 col-md-6 col-sm-12 col-xs-12" name="audioplayer-login-row-1-col-1"}
				{block type='audioplayer_login_form' name="audioplayer-login-row-1-col-1-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
			{block type='column' class="col-lg-6 col-md-6 col-sm-12 col-xs-12" name="audioplayer-login-row-1-col-2"}
				{block type='audioplayer_login_info' name="audioplayer-login-row-1-col-2-block-1"}
					{content}
					{/content}
				{/block}
			{/block}
		{/block}
	{/block}
</div>