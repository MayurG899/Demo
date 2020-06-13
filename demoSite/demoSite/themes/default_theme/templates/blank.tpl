{get_header()}
<head>
	{$access_groups = explode(',', $page->groups)}
	{if !$user->is_member_of_any($access_groups)}
		{redirect('/', 'location')}
	{/if}
	<meta name="description" content="{$page->meta_desc}">
	<meta name="keywords" content="{$page->meta_keywords}">
	<meta name="robots" content="{$page->seo_index} {$page->seo_follow} {$page->seo_snippet} {$page->seo_archive} {$page->seo_img_index} {$page->seo_odp}">
</head>

{block type='page' name="page-container-1"}   
	{block type='content' id="blank" name='blank-page-content-1'}
    {block type='row' class='container boxed-row' name="blank-page-row-1"}
        {block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="blank-page-row-1-col-1"}
            {block type='generic' name="blank-page-block-1"}
                {content}
					<h3 class="blank-title">Blank Page Template</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi consectetur vestibulum risus, in pulvinar ante. Etiam in velit vel ante egestas sodales. Pellentesque faucibus ut quam quis pellentesque. Nunc sit amet ultrices nisl, quis tristique velit. Duis non turpis sed purus ultricies placerat vel ut purus.</p>
					<p>&nbsp;</p>
                {/content}
            {/block}
        {/block}
    {/block}
	{/block}
{/block}	

{get_footer()}
{literal}
<script>
	$(document).ready(function(){
		$('#primary-website-title').html("{/literal}{$page->title}{literal}");
	});
</script>
{/literal}