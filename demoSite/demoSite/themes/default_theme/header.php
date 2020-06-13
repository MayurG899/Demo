<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="description" content="{$BuilderEngine->get_option('website_description')}">
	<meta name="keywords" content="{$BuilderEngine->get_option('website_keywords')}">
	<meta name="author" content="BuilderEngine">

    <title id="primary-website-title">{$BuilderEngine->get_option('website_title')}</title>

	<!-- Stylesheets -->
	<link href="{get_theme_path()}css/bootstrap.min.css" rel="stylesheet">
	{$BuilderEngine->handle_head()}
	<!-- Favicon -->
	<link rel="shortcut icon" href="{get_theme_path()}images/favicon/favicon.png">
	<!-- Custom Styles -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="{get_theme_path()}css/styles.css" rel="stylesheet">

</head>
			    {block type='header' class='themes-header-section' name="default2018-header" global="true"}				 
                    {block type='row' class='container boxed-row themes-header' global="true" name="default2018-header-row-3"}
                        {block type='column' class='col-lg-4 col-md-3 col-sm-12 col-xs-12 column' global="true" name="default2018-header-row-3-col-1"}
                            {block type='generic' global="true" name="default2018-header-block-3"}
                                {content}
									<p class="themes-logo">
									<a href="{base_url("")}">
                                        <img src="{get_theme_path()}images/logo.png" alt="" />
                                    </a>
									</p>
                                {/content}
                            {/block}
                        {/block}
                        {block type='column' class='col-lg-8 col-md-9 col-sm-12 col-xs-12 column' global="true" name="default2018-header-row-3-col-2"}
							{block type='navbar' style="margin-bottom:0px" global="true" name="default2018-header-block-4"}
								{content}
								{/content}
							{/block}
						{/block}
					{/block} 
				{/block}

{literal}
<script>
	var site_root = "{/literal}{home_url("")}{literal}";
</script>
{/literal}