
	<meta charset="utf-8" />
	<title>Forum</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="{base_url('modules/forum/assets/plugins/bootstrap/css/bootstrap.min.css')}" rel="stylesheet" />
	<link href="{base_url('modules/forum/assets/plugins/font-awesome/css/font-awesome.min.css')}" rel="stylesheet" />
	<link href="{base_url('modules/forum/assets/css/animate.min.css')}" rel="stylesheet" />
	<link href="{base_url('modules/forum/assets/css/style.css')}" rel="stylesheet" />
	<link href="{base_url('modules/forum/assets/css/style-responsive.css')}" rel="stylesheet" />
	<link href="{base_url('modules/forum/assets/css/theme/default.css')}" id="theme" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
	<script type="text/javascript" href="{base_url('modules/forum/assets/plugins/ckeditor/ckeditor.js')}"></script>
	<!-- ================== BEGIN BASE JS ================== -->
	<script href="{base_url('modules/forum/assets/plugins/pace/pace.min.js')}"></script>
	<!-- ================== END BASE JS ================== -->

<hr class="topbar"/>

{block type='page' name="forum-login"}
	{block type='row' class="container" name="forum-login-row-1"}
		{block type='column' class="col-lg-6 col-md-6 col-sm-12 col-xs-12" name="forum-login-row-1-col-1"}
			{block type='forum_login_form' name="forum-login-row-1-col-1-block-1"}
				{content}
				{/content}
			{/block}
		{/block}
		{block type='column' class="col-lg-6 col-md-6 col-sm-12 col-xs-12" name="forum-login-row-1-col-2"}
			{block type='forum_login_info' name="forum-login-row-1-col-2-block-1"}
				{content}
				{/content}
			{/block}
		{/block}
	{/block}
{/block}
