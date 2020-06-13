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
    {block type='content' id="contact" name='about-page-content-1'}
			{block type='row' class="container boxed-row" name="about-page-row-1"}
				{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="about-page-row-1-col-1"}
					{block type='generic' name="about-page-block-1"}
						{content}
							<div class="contact-desc">
							<h2>About Us</h2>
							<p>Discover more about us and our professional team members.</p>
							<p>You cant connect the dots looking forward; you can only connect them looking backwards. So you have to trust that the dots will somehow connect in your future. You have to trust in something - your gut, destiny, life, or karma.</p>
							</div>
							<p>&nbsp;</p>
						{/content}
					{/block}
				{/block}
				{block type='column' class="col-lg-3 col-md-3 col-sm-6 col-xs-12" name="about-page-row-1-col-2"}
					{block type='generic' name="about-page-block-2"}
						{content}
						 <!-- begin team -->
								<div class="beblock-team-item-box fixed-box">
									<figure>
										<img class="" src="{base_url()}blocks/content_team/images/profile1.jpg" alt="">
									</figure>
									<div class="beblock-team-item-box-desc block-colors-light-bg">
										<h4>John Doe</h4>
										<small>CEO</small>
										<p>Enter a nice description for this person / staff member here or use this to highlight projects instead of people.</p>
										<div class="socials">
											<a class="social1 fa fa-facebook" href="#"><i class="social1"></i></a>
											<a class="social1 fa fa-twitter" href="#"><i class="social1"></i></a>
											<a class="social1 fa fa-linkedin" href="#"><i class="social1"></i></a>
										</div>
									</div>
								</div>
                        <!-- end team -->
						{/content}
					{/block}
				{/block}
				{block type='column' class="col-lg-3 col-md-3 col-sm-6 col-xs-12" name="about-page-row-1-col-3"}
					{block type='generic' name="about-page-block-3"}
						{content}
						<!-- begin team -->
								<div class="beblock-team-item-box fixed-box">
									<figure>
										<img class="" src="{base_url()}blocks/content_team/images/profile2.jpg" alt="">
									</figure>
									<div class="beblock-team-item-box-desc block-colors-light-bg">
										<h4>James Doe</h4>
										<small>CTO</small>
										<p>Enter a nice description for this person / staff member here or use this to highlight projects instead of people.</p>
										<div class="socials">
											<a class="social1 fa fa-facebook" href="#"><i class="social1"></i></a>
											<a class="social1 fa fa-twitter" href="#"><i class="social1"></i></a>
											<a class="social1 fa fa-linkedin" href="#"><i class="social1"></i></a>
										</div>
									</div>
								</div>
                        <!-- end team -->
						{/content}
					{/block}
				{/block}
				{block type='column' class="col-lg-3 col-md-3 col-sm-6 col-xs-12" name="about-page-row-1-col-4"}
					{block type='generic' name="about-page-block-4"}
						{content}
						<!-- begin team -->
								<div class="beblock-team-item-box fixed-box">
										<figure>
										<img class="" src="{base_url()}blocks/content_team/images/profile3.jpg" alt="">
									</figure>
									<div class="beblock-team-item-box-desc block-colors-light-bg">
										<h4>Ace Doe</h4>
										<small>COO</small>
										<p>Enter a nice description for this person / staff member here or use this to highlight projects instead of people.</p>
										<div class="socials">
											<a class="social1 fa fa-facebook" href="#"><i class="social1"></i></a>
											<a class="social1 fa fa-twitter" href="#"><i class="social1"></i></a>
											<a class="social1 fa fa-linkedin" href="#"><i class="social1"></i></a>
										</div>
									</div>
								</div>
                        <!-- end team -->
						{/content}
					{/block}
				{/block}
				{block type='column' class="col-lg-3 col-md-3 col-sm-6 col-xs-12" name="about-page-row-1-col-5"}
					{block type='generic' name="about-page-block-5"}
						{content}
						<!-- begin team -->
								<div class="beblock-team-item-box fixed-box">
									<figure>
										<img class="" src="{base_url()}blocks/content_team/images/profile4.jpg" alt="">
									</figure>
									<div class="beblock-team-item-box-desc block-colors-light-bg">
										<h4>Carol Doe</h4>
										<small>CFO</small>
										<p>Enter a nice description for this person / staff member here or use this to highlight projects instead of people.</p>
										<div class="socials">
											<a class="social1 fa fa-facebook" href="#"><i class="social1"></i></a>
											<a class="social1 fa fa-twitter" href="#"><i class="social1"></i></a>
											<a class="social1 fa fa-linkedin" href="#"><i class="social1"></i></a>
										</div>
									</div>
								</div>
                        <!-- end team -->
						{/content}
					{/block}
				{/block}
				{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="about-page-row-1-col-6"}
					{block type='generic' name="about-page-block-6"}
						{content}
						<br><br>
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