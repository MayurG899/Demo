
			{block type='footer'  class='footer-section footer-colors' name="default2018-footer" global="true"}
                {block type='row' class='container boxed-row footer-section' global="true" name="default2018-footer-row-1"}
                    {block type='column' class='col-lg-3 col-md-3 col-sm-6 col-xs-12 footer-section' global="true" name="default2018-footer-row-1-col-1"}
                        {block type='generic' global="true" class="footer-section" name="default2018-footer-block-1"}
                            {content}
                                <div class="widget">
                                    <span class="footer-logo" ><img class="img-responsive" src="{get_theme_path()}images/logo.png" alt=""></span>
                                    <p>Setting goals is the first step in turning the invisible into the visible.</p>
                                    
                                    <div class="social-icons social-icons-bg social-icons-bg-hover social-icons-circle">
                                         <a href="https://www.facebook.com/BuilderEngine" class="social-icon icon-facebook" title="Facebook" target="_blank">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                        <a href="https://twitter.com/BuilderEngine" class="social-icon icon-twitter" title="Twitter" target="_blank">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                        <a href="https://plus.google.com/101215485566251524943/posts" class="social-icon icon-google-plus" title="Google Plus" target="_blank">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                        <a href="https://www.youtube.com/channel/UC_0wZs05_T4uBobDUSb-0hg" class="social-icon icon-youtube" title="YouTube" target="_blank">
                                            <i class="fa fa-youtube"></i>
                                        </a>
                                    </div>
									<br>
								</div>
                            {/content}
                        {/block}
					{/block}

                    {block type='column' class='col-lg-3 col-md-3 col-sm-3 col-xs-12 footer-section' global="true" name="default2018-footer-row-1-col-2"}
                        {block type='generic' global="true" class="footer-section" name="default2018-footer-block-2"}
                            {content}
							<div class="widget">
                                <h4>Website Builder</h4>
                                <ul class="links">
                                    <li><a href="/">Homepage</a></li>
                                    <li><a href="/page-about.html">About Us</a></li>
                                    <li><a href="/page-contact.html">Contact Us</a></li>
                                    <li><a href="/blog/all_posts">Latest News</a></li>
                                </ul>
                            </div>                        
                            {/content}
                        {/block}						
					{/block}
					{block type='column' class='col-lg-3 col-md-3 col-sm-3 col-xs-12 footer-section' global="true" name="default2018-footer-row-1-col-2-5232"}
                        {block type='generic' global="true" class="footer-section" name="default2018-footer-block-2-325256"}
                            {content}
							<div class="widget">
                                <h4>CMS Platform</h4>
                                <ul class="links">
                                    <li><a href="/ecommerce/category/All">Online Store</a></li>
                                    <li><a href="/classifieds/view_category/All">Classifieds</a></li>
                                    <li><a href="/booking_events/events">Booking Events</a></li>
                                    <li><a href="/booking_rooms/calendar">Meeting Rooms</a></li>
                                </ul>
                            </div>                                
                            {/content}
                        {/block}						
					{/block}
					
					{block type='column' class='col-lg-3 col-md-3 col-sm-12 col-xs-12 footer-section' global="true" name="default2018-footer-row-1-col-3"}
                        {block type='generic' global="true" class="footer-section" name="default2018-footer-block-4"}
                            {content}
                            <div class="widget">
                                <h4>The Web Engine</h4>
                                <ul class="links">
                                    <li><a href="/forum/all_topics">Forums</a></li>
                                    <li><a href="/videotube/all_videos">Video Channels</a></li>
                                    <li><a href="/photogallery/all_photos">Photo Galleries</a></li>
                                    <li><a href="/audioplayer/all_audios">Audio Channels</a></li>
                                </ul>
                            </div>
                            {/content}
                        {/block}
					{/block}
				{/block}
			
			
			{block type='content' id="footer-bottom" global="true" name="default2018-footer-content-1"}
			{block type='row' class="container boxed-row" global="true" name="default2018-footer-row-2"}
				{block type='column' class="col-lg-6 col-md-6 col-sm-6 col-xs-12" global="true" name="default2018-footer-row-2-col-1"}
					{block type='generic' class="work" global="true" name="default2018-footer-block-6"}
						{content}
						<p class="copyright">Powered by <a href="https://www.builderengine.com" target="_blank">BuilderEngine</a>.  &copy; 2018 <a href="/">{get_option("website_title")}</a></p>
						{/content}
					{/block}
				{/block}
				{block type='column' class="col-lg-6 col-md-6 col-sm-6 col-xs-12" global="true" name="default2018-footer-row-2-col-2"}
					{block type='generic' class="work" global="true" name="default2018-footer-block-7"}
						{content}
							<ul class="footer-menu">
                                <li><a href="https://builderengine.com/page-website-builder.html" target="_blank">The Web Engine</a></li>
                                <li><a href="https://builderengine.com/page-website-modules.html" target="_blank">Web Engine Features</a></li>
                                <li><a href="https://builderengine.com/page-about-builderengine.html" target="_blank">About BuilderEngine</a></li>
                            </ul>
						{/content}
					{/block}
				{/block}
			{/block}
	{/block}
	{/block}

{$BuilderEngine->get_option('google_analytics_code')}
<!-- JS -->
<!-- BuilderEngine JS -->
{$BuilderEngine->handle_foot()}

<script src="{get_theme_path()}js/bootstrap.min.js"></script>
<script src="{get_theme_path()}js/jquery.cookie.js"></script>

<!-- BE Plugins JS -->
<script src="{get_theme_path()}js/custom.js"></script>

<!-- BE CSS Custom Overrides -->

{if {$BuilderEngine->get_option('theme_color_pattern')} != ''}
		<link href="{get_theme_path()}css/color_patterns/{$BuilderEngine->get_option('theme_color_pattern')}.css" rel="stylesheet">
	{else}
		<link href="{get_theme_path()}css/color_patterns/default.css" rel="stylesheet">
	{/if}

<!-- JS Scripts -->
{literal}
<script>
	CKEDITOR.on('instanceReady',
	   	function( evt ) {
	   		setTimeout(function(){
	      		$('#ck-loading').fadeOut();
	      	}, 100);
	   	}
	);
    $(document).ready(function() {
        Loader.init();
    });
</script>
{/literal}
   </body>
</html>