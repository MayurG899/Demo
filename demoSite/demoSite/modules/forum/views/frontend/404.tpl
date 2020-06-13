
<meta charset="utf-8" />
<title>Color Admin | Support Forum Front End Theme</title>
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
<script type="text/javascript" src="{base_url('modules/forum/assets/plugins/ckeditor/ckeditor.js')}"></script>
<!-- ================== BEGIN BASE JS ================== -->
<script src="{base_url('modules/forum/assets/plugins/pace/pace.min.js')}"></script>
<!-- ================== END BASE JS ================== -->

<hr class="topbar"/>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
			{block type='page' name="forum-404"}
				{block type='row' class="container" name="forum-404-row-1"}
					{block type='column' class="col-md-12" name="forum-404-row-1-col-1"}
						{block type='forum_404' name="forum-404-row-1-col-1-block-1"}
							{content}
							{/content}
						{/block}
					{/block}
				{/block}
			{/block}
		</div>
	</div>
</div>