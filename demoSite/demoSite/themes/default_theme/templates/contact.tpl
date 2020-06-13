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
    {block type='content' id="contact" name='contact-page-content-1'}
			{block type='row' class="container boxed-row" name="contact-page-row-1"}
				{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="contact-page-row-1-col-1"}
					{block type='generic' name="contact-page-block-1"}
						{content}
							<div class="contact-desc">
							<h2>Contact Us</h2>
							<p>Welcome to the Contact Form, we are always happy to hear from you and please send us your comments.</p>
							<br>
							<br>
							</div>
						{/content}
					{/block}
				{/block}
				{block type='column' class="col-lg-6 col-md-6 col-sm-12 col-xs-12" name="contact-page-row-1-col-2"}
					{block type='generic' name="contact-page-block-2"}
						{content}
							<h4>Say hello and get in touch with us.</h4>
							<p>Please use the contact form to send us a message and we will reply to you.</p>
							
							<address>
							<strong>Business Inc.</strong><br>
							1234 Example Street<br>
							San Francisco, CA 94107<br>
							<abbr title="Phone"><strong>P:</strong></abbr> (123) 456-7890
							</address>

							<address>
							<strong>Email Address</strong><br>
							<a href="mailto:#">hello@mysite.com</a>
							</address>
							
							<p>&nbsp;</p>
						{/content}
					{/block}
				{/block}
				{block type='column' class="col-lg-6 col-md-6 col-sm-12 col-xs-12" name="contact-page-row-1-col-3"}
					{block type='antispam_contact_form' name="contact-page-block-3"}
						{content}
						{/content}
					{/block}
				{/block}
				{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="contact-page-row-1-col-4"}
					{block type='generic' name="contact-page-block-4"}
						{content}
						<br><br><br>
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