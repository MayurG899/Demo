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
<link href="{home_url('')}/builderengine/public/editor/css/special.css" rel="stylesheet" type="text/css" />
{block type='page' name="2016-contentblocks-page"}
{block type='content' name="contentblocks-1-page-content-1"} 

    {block type='row' class='container boxed-row' name="2016-contentblocks-page-row-1"}
        {block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-contentblocks-page-row-1-col-1"}
            {block type='generic' name="2016-contentblocks-page-block-1"}
                {content}
                    <h2 class="content-title">The following showcases all the Content Blocks available to you.</h2>
                    <p class="content-desc">
                        Right Click on a Column in Designer Mode. Select Add Block and the right-side menu bar appears where you can now click on Content Blocks & pick any of the blocks below.
						Also each Content Block has Setting Options to change it's content and Style Options to adjust it's looks. 
                    </p>
                {/content}
            {/block}
        {/block}
	{/block}
	 {block type='row' class='' name="2016-contentblocks-page-row-2"}
		{block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-contentblocks-page-row-2-col-2"}
			{block type='generic' name="2016-contentblocks-page-block-6-0"}
                {content}
				<h2 class="content-title" style="color: #676767;font-weight: 600;text-decoration: underline;margin-left: 20px;">Home Image Block</h2>
                {/content}
            {/block}
            {block type='home_image' name="2016-contentblocks-page-block-2"}
                {content}
                {/content}
            {/block}
		{/block}
		{block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-contentblocks-page-row-2-col-2-slider"}
			{block type='generic' name="2016-contentblocks-page-block-6-4-slider"}
                {content}
				<br>
				<h2 class="content-title" style="color: #676767;font-weight: 600;text-decoration: underline;margin-left: 20px;">Slider Block</h2>
                {/content}
            {/block}
			{block type='slider' name="2016-contentblocks-page-block-7-slider"}
                {content}
                {/content}
            {/block}
		{/block}
		{block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-contentblocks-page-new-6-col-1-homeservices"}
            {block type='generic' name="2016-contentblocks-new-block-16-homeservices"}
                {content}
				<br>
				<h2 class="content-title" style="color: #676767;font-weight: 600;text-decoration: underline;margin-left: 20px;">Content Services-1 Block</h2>
				<br>
                {/content}
            {/block}
			{block type='content_services_1' name="2016-contentblocks-new-block-17-homeservices"}
				{content}
				{/content}
            {/block}
        {/block}
		{block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-contentblocks-page-row-2-col-2-carousel"}
			{block type='generic' name="2016-contentblocks-page-block-6-2-carousel"}
                {content}
				<h2 class="content-title" style="color: #676767;font-weight: 600;text-decoration: underline;">Image Carousel Block</h2>
                {/content}
            {/block}
			{block type='image_carousel' name="2016-contentblocks-page-block-4-carousel"}
                {content}
                {/content}
            {/block}
		{/block}
		{block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-contentblocks-page-row-2-col-2-quote"}
			{block type='generic' name="2016-contentblocks-page-block-6-3-quote"}
                {content}
				<h2 class="content-title" style="color: #676767;font-weight: 600;text-decoration: underline;margin-left: 20px;">Quote Block</h2>
				<br>
                {/content}
            {/block}
			{block type='quote' name="2016-contentblocks-page-block-5-quote"}
                {content}
                {/content}
            {/block}
		{/block}
		{block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-contentblocks-page-row-4-col-2-milestones"}
			{block type='generic' name="2016-contentblocks-page-block-6-5-milestones"}
                {content}
				<br>
				<h2 class="content-title" style="color: #676767;font-weight: 600;text-decoration: underline;margin-left: 20px;">Milestones Block</h2>
				<br>
                {/content}
            {/block}
			{block type='milestones' name="2016-contentblocks-page-block-8-milestones"}
                {content}
                {/content}
            {/block}
		{/block}
		{block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-contentblocks-page-row-6-col-2-actionbar"}
			{block type='generic' name="2016-contentblocks-page-block-6-9-actionbar"}
                {content}
				<h2 class="content-title" style="color: #676767;font-weight: 600;text-decoration: underline;margin-left: 20px;">Action Bar Block</h2>
				<br>
                {/content}
            {/block}
			{block type='action_bar' name="2016-contentblocks-page-block-10-actionbar"}
                {content}
                {/content}
            {/block}
		{/block}
		{block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-contentblocks-page-row-6-col-2-testimonials"}
			{block type='generic' name="2016-contentblocks-page-block-5-0-testimonials"}
                {content}
				<br>
				<h2 class="content-title" style="color: #676767;font-weight: 600;text-decoration: underline;">Testimonials Block</h2>
                {/content}
            {/block}
			{block type='testimonials' name="2016-contentblocks-page-block-3-testimonials"}
                {content}
                {/content}
            {/block}
		{/block}
		{block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-contentblocks-page-row-8-col-1-parallax"}
            {block type='generic' name="2016-contentblocks-page-block-5-3-parallax"}
                {content}
				<br>
				<h2 class="content-title" style="color: #676767;font-weight: 600;text-decoration: underline;margin-left: 20px;">Simple Parallax Scroller Block</h2>
				<br>
                {/content}
            {/block}
			{block type='simple_parallax_scroller' name="2016-contentblocks-page-block-12-parallax"}
				{content}
				{/content}
            {/block}
        {/block}
		{block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-contentblocks-page-new-2-col-1-homevideo"}
            {block type='generic' name="2016-contentblocks-new-block-4-homevideo"}
                {content}
				<br>
				<h2 class="content-title" style="color: #676767;font-weight: 600;text-decoration: underline;margin-left: 20px;">Home Video Block</h2>
				<br>
                {/content}
            {/block}
			{block type='content_home_video' name="2016-contentblocks-new-block-5-homevideo"}
				{content}
				{/content}
            {/block}
        {/block}
		{block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-contentblocks-page-new-2-col-1-mediavideo"}
            {block type='generic' name="2016-contentblocks-new-block-4-mediavideo"}
                {content}
				<br>
				<h2 class="content-title" style="color: #676767;font-weight: 600;text-decoration: underline;margin-left: 20px;">Media Video Block</h2>
				<br>
                {/content}
            {/block}
			{block type='content_home_mediaplayer_video' name="2016-contentblocks-new-block-5-mediavideo"}
				{content}
				{/content}
            {/block}
        {/block}
	{/block}
	 {block type='row' class='container boxed-row' name="2016-contentblocks-page-row-3"}
		{block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-contentblocks-page-row-3-col-2"}
			{block type='generic' name="2016-contentblocks-page-block-5-1"}
                {content}
				<h2 class="content-title" style="color: #676767;font-weight: 600;text-decoration: underline;">Navbar Block</h2>
                {/content}
            {/block}
			{block type='navbar' name="2016-contentblocks-page-block-6"}
                {content}
                {/content}
            {/block}
		{/block}
	{/block}
	{block type='row' class='container boxed-row' name="2016-contentblocks-page-row-5"}
		{block type='column' class='col-lg-6 col-md-6 col-sm-12 col-xs-12' name="2016-contentblocks-page-row-5-col-2"}
			{block type='generic' name="2016-contentblocks-page-block-6-6"}
                {content}
				<br>
				<h2 class="content-title" style="color: #676767;font-weight: 600;text-decoration: underline;">Contact Form Block</h2>
                {/content}
            {/block}
			{block type='contact_form' name="2016-contentblocks-page-block-9"}
                {content}
                {/content}
            {/block}
		{/block}
		{block type='column' class='col-lg-6 col-md-6 col-sm-12 col-xs-12' name="2016-contentblocks-page-row-7-col-2"}
			{block type='generic' name="2016-contentblocks-page-block-6-8"}
                {content}
				<br>
				<h2 class="content-title" style="color: #676767;font-weight: 600;text-decoration: underline;">Antispam Contact Block</h2>
                {/content}
            {/block}
			{block type='antispam_contact_form' name="2016-contentblocks-page-block-11"}
                {content}
                {/content}
            {/block}
		{/block}
	{/block}
	{block type='row' class='container boxed-row' name="2016-contentblocks-page-row-9"}
        {block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-contentblocks-page-row-9-col-1"}
            {block type='generic' name="2016-contentblocks-page-block-5-4"}
                {content}
				<br>
				<h2 class="content-title" style="color: #676767;font-weight: 600;text-decoration: underline;margin-left: 20px;">Image Gallery Block</h2>
				<br>
                {/content}
            {/block}
			{block type='isotope_grid' name="2016-contentblocks-page-block-13"}
				{content}
				{/content}
            {/block}
			{block type='generic' name="2016-contentblocks-page-block-6-11"}
                {content}
				<p><br></p>
                {/content}
            {/block}
        {/block}
    {/block}
	{block type='row' class='container boxed-row' name="2016-contentblocks-page-row-10"}
        {block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-contentblocks-page-row-10-col-1"}
            {block type='generic' name="2016-contentblocks-page-block-5-5"}
                {content}
				<br>
				<h2 class="content-title" style="color: #676767;font-weight: 600;text-decoration: underline;margin-left: 20px;">Logo Slider Block</h2>
				<br>
                {/content}
            {/block}
			{block type='logo_slider' name="2016-contentblocks-page-block-14"}
				{content}
				{/content}
            {/block}
			{block type='generic' name="2016-contentblocks-page-block-6-12"}
                {content}
				<p><br></p>
                {/content}
            {/block}
        {/block}
    {/block}
	
	{block type='row' class='container boxed-row' name="2016-contentblocks-new-row-1"}
        {block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-contentblocks-page-new-1-col-1"}
            {block type='generic' name="2016-contentblocks-new-block-1"}
                {content}
				<br>
				<h2 class="content-title" style="color: #676767;font-weight: 600;text-decoration: underline;margin-left: 20px;">Comparsion Chart Block</h2>
				<br>
                {/content}
            {/block}
			{block type='content_comparison_chart' name="2016-contentblocks-new-block-2"}
				{content}
				{/content}
            {/block}
			{block type='generic' name="2016-contentblocks-new-block-3"}
                {content}
				<p><br></p>
                {/content}
            {/block}
        {/block}
    {/block}
	{block type='row' class='container boxed-row' name="2016-contentblocks-new-row-3"}
        {block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-contentblocks-page-new-3-col-1"}
            {block type='generic' name="2016-contentblocks-new-block-7"}
                {content}
				<br>
				<h2 class="content-title" style="color: #676767;font-weight: 600;text-decoration: underline;margin-left: 20px;">Model Pop-Up Block</h2>
				<br>
                {/content}
            {/block}
			{block type='content_model_popup' name="2016-contentblocks-new-block-8"}
				{content}
				{/content}
            {/block}
			{block type='generic' name="2016-contentblocks-new-block-9"}
                {content}
				<p><br></p>
                {/content}
            {/block}
        {/block}
    {/block}
	{block type='row' class='container boxed-row' name="2016-contentblocks-new-row-4"}
        {block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-contentblocks-page-new-4-col-1"}
            {block type='generic' name="2016-contentblocks-new-block-10"}
                {content}
				<br>
				<h2 class="content-title" style="color: #676767;font-weight: 600;text-decoration: underline;margin-left: 20px;">Content Panel-1 Block</h2>
				<br>
                {/content}
            {/block}
			{block type='content_panel_1' name="2016-contentblocks-new-block-11"}
				{content}
				{/content}
            {/block}
			{block type='generic' name="2016-contentblocks-new-block-12"}
                {content}
				<p><br></p>
                {/content}
            {/block}
        {/block}
    {/block}
	{block type='row' class='container boxed-row' name="2016-contentblocks-new-row-5"}
        {block type='column' class='col-lg-6 col-md-6 col-sm-12 col-xs-12' name="2016-contentblocks-page-new-5-col-1"}
            {block type='generic' name="2016-contentblocks-new-block-13"}
                {content}
				<br>
				<h2 class="content-title" style="color: #676767;font-weight: 600;text-decoration: underline;margin-left: 20px;">Project Image Block</h2>
				<br>
                {/content}
            {/block}
			{block type='content_project_image' name="2016-contentblocks-new-block-14"}
				{content}
				{/content}
            {/block}
			{block type='generic' name="2016-contentblocks-new-block-15"}
                {content}
				<p><br></p>
                {/content}
            {/block}
        {/block}
		{block type='column' class='col-lg-6 col-md-6 col-sm-12 col-xs-12' name="2016-contentblocks-page-new-12-col-1"}
            {block type='generic' name="2016-contentblocks-new-block-34"}
                {content}
				<br>
				<h2 class="content-title" style="color: #676767;font-weight: 600;text-decoration: underline;margin-left: 20px;">Team Member Block</h2>
				<br>
                {/content}
            {/block}
			{block type='content_team_member' name="2016-contentblocks-new-block-35"}
				{content}
				{/content}
            {/block}
			{block type='generic' name="2016-contentblocks-new-block-36"}
                {content}
				<p><br></p>
                {/content}
            {/block}
        {/block}
    {/block}
	{block type='row' class='container boxed-row' name="2016-contentblocks-new-row-7"}
        {block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-contentblocks-page-new-7-col-1"}
            {block type='generic' name="2016-contentblocks-new-block-19"}
                {content}
				<br>
				<h2 class="content-title" style="color: #676767;font-weight: 600;text-decoration: underline;margin-left: 20px;">Content Services-2 Block</h2>
				<br>
                {/content}
            {/block}
			{block type='content_services_2' name="2016-contentblocks-new-block-20"}
				{content}
				{/content}
            {/block}
			{block type='generic' name="2016-contentblocks-new-block-21"}
                {content}
				<p><br></p>
                {/content}
            {/block}
        {/block}
    {/block}
	{block type='row' class='container boxed-row' name="2016-contentblocks-new-row-8"}
        {block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-contentblocks-page-new-8-col-1"}
            {block type='generic' name="2016-contentblocks-new-block-22"}
                {content}
				<br>
				<h2 class="content-title" style="color: #676767;font-weight: 600;text-decoration: underline;margin-left: 20px;">Content Services-3 Block</h2>
				<br>
                {/content}
            {/block}
			{block type='content_services_3' name="2016-contentblocks-new-block-23"}
				{content}
				{/content}
            {/block}
			{block type='generic' name="2016-contentblocks-new-block-24"}
                {content}
				<p><br></p>
                {/content}
            {/block}
        {/block}
    {/block}
	{block type='row' class='container boxed-row' name="2016-contentblocks-new-row-9"}
        {block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-contentblocks-page-new-9-col-1"}
            {block type='generic' name="2016-contentblocks-new-block-25"}
                {content}
				<br>
				<h2 class="content-title" style="color: #676767;font-weight: 600;text-decoration: underline;margin-left: 20px;">Content Tabs-1 Block</h2>
				<br>
                {/content}
            {/block}
			{block type='content_tabs_1' name="2016-contentblocks-new-block-26"}
				{content}
				{/content}
            {/block}
			{block type='generic' name="2016-contentblocks-new-block-27"}
                {content}
				<p><br></p>
                {/content}
            {/block}
        {/block}
    {/block}
	{block type='row' class='container boxed-row' name="2016-contentblocks-new-row-10"}
        {block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-contentblocks-page-new-10-col-1"}
            {block type='generic' name="2016-contentblocks-new-block-28"}
                {content}
				<br>
				<h2 class="content-title" style="color: #676767;font-weight: 600;text-decoration: underline;margin-left: 20px;">Content Tabs-2 Block</h2>
				<br>
                {/content}
            {/block}
			{block type='content_tabs_2' name="2016-contentblocks-new-block-29"}
				{content}
				{/content}
            {/block}
			{block type='generic' name="2016-contentblocks-new-block-30"}
                {content}
				<p><br></p>
                {/content}
            {/block}
        {/block}
    {/block}
	{block type='row' class='container boxed-row' name="2016-contentblocks-new-row-11"}
        {block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-contentblocks-page-new-11-col-1"}
            {block type='generic' name="2016-contentblocks-new-block-31"}
                {content}
				<br>
				<h2 class="content-title" style="color: #676767;font-weight: 600;text-decoration: underline;margin-left: 20px;">Team Block</h2>
				<br>
                {/content}
            {/block}
			{block type='content_team' name="2016-contentblocks-new-block-32"}
				{content}
				{/content}
            {/block}
			{block type='generic' name="2016-contentblocks-new-block-33"}
                {content}
				<p><br></p>
                {/content}
            {/block}
        {/block}
    {/block}
	{block type='row' class='container boxed-row' name="2016-contentblocks-new-row-13"}
        {block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-contentblocks-page-new-13-col-1"}
            {block type='generic' name="2016-contentblocks-new-block-37"}
                {content}
				<br>
				<h2 class="content-title" style="color: #676767;font-weight: 600;text-decoration: underline;margin-left: 20px;">Timeline Block</h2>
				<br>
                {/content}
            {/block}
			{block type='content_timeline' name="2016-contentblocks-new-block-38"}
				{content}
				{/content}
            {/block}
			{block type='generic' name="2016-contentblocks-new-block-39"}
                {content}
				<p><br></p>
                {/content}
            {/block}
        {/block}
    {/block}
	{block type='row' class='container boxed-row' name="2016-contentblocks-new-row-14"}
        {block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-contentblocks-page-new-14-col-1"}
            {block type='generic' name="2016-contentblocks-new-block-40"}
                {content}
				<br>
				<h2 class="content-title" style="color: #676767;font-weight: 600;text-decoration: underline;margin-left: 20px;">YouTube Video Block</h2>
				<br>
                {/content}
            {/block}
			{block type='content_video_youtube' name="2016-contentblocks-new-block-41"}
				{content}
				{/content}
            {/block}
			{block type='generic' name="2016-contentblocks-new-block-42"}
                {content}
				<p><br></p>
                {/content}
            {/block}
        {/block}
    {/block}
	{block type='row' class='container boxed-row' name="2016-contentblocks-new-row-15"}
		 {block type='column' class='col-lg-6 col-md-6 col-sm-12 col-xs-12' name="2016-contentblocks-page-new-16-col-1"}
            {block type='generic' name="2016-contentblocks-new-block-46"}
                {content}
				<br>
				<h2 class="content-title" style="color: #676767;font-weight: 600;text-decoration: underline;margin-left: 20px;">Services Payment Block</h2>
				<br>
                {/content}
            {/block}
			{block type='service_payment' name="2016-contentblocks-new-block-47"}
				{content}
				{/content}
            {/block}
			{block type='generic' name="2016-contentblocks-new-block-48"}
                {content}
				<p><br></p>
                {/content}
            {/block}
        {/block}
    {/block}
	{block type='row' class='container boxed-row' name="2016-contentblocks-new-row-17"}
        {block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-contentblocks-page-new-17-col-1"}
            {block type='generic' name="2016-contentblocks-new-block-50"}
                {content}
				<br>
				<h2 class="content-title" style="color: #676767;font-weight: 600;text-decoration: underline;margin-left: 20px;">General Word Editor Block</h2>
				<br>
                {/content}
            {/block}
			{block type='general' name="2016-contentblocks-new-block-51"}
				{content}
				{/content}
            {/block}
			{block type='generic' name="2016-contentblocks-new-block-52"}
                {content}
				<p><br></p>
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