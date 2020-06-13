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
{block type='page' name="2016-allblocks-page"}
    
    {block type='row' class='container boxed-row' name="2016-allblocks-page-row-1"}
        {block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-allblocks-page-row-1-col-1"}
            {block type='generic' name="2016-allblocks-page-block-1"}
                {content}
                    <h2 class="content-title">The following showcases all available Blocks to you.</h2>
                    <p class="content-desc">
                        Right Click on a Column in Designer Mode. Select Add Block and the right-side menu bar appears where you can now click on App Blocks, then Blog & pick any of the blocks below.
						Also each Blog Block has Setting Options to change it's content and Style Options to adjust it's looks. 
                    </p>
					<br>
                {/content}
            {/block}
        {/block}
	{/block}
	 {block type='row' class='container boxed-row' name="2016-allblocks-page-row-2"}
		 {block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-allblocks-page-row-2-col-1-1"}
            {block type='generic' name="2016-allblocks-page-block-1-1"}
                {content}
                    <h2 class="content-title" style="color: #54b9e9;font-weight: 600;border-bottom: 2px solid #dadada;margin-bottom: 20px;">Blog Module / App</h2>
                {/content}
            {/block}
        {/block}
		{block type='column' class='col-lg-9 col-md-9 col-sm-12 col-xs-12' name="2016-allblocks-page-row-3-col-2"}
		{block type='generic' name="2016-allblocks-page-block-5-0"}
                {content}
				<h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Blog Post Block</h4>
                {/content}
            {/block}
		{block type='blog_posts' name="2016-allblocks-page-block-3"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-page-block-6-2"}
                {content}
				<h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Blog Tags Block</h4>
                {/content}
            {/block}
			{block type='blog_tags' name="2016-allblocks-page-block-4"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-page-block-6-12"}
                {content}
				<br>
				<h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Category Posts Block</h4>
                {/content}
            {/block}
			{block type='blog_category_posts' name="2016-allblocks-page-block-12"}
                {content}
                {/content}
            {/block}
		{/block}
		{block type='column' class='col-lg-3 col-md-3 col-sm-12 col-xs-12' name="2016-allblocks-page-row-2-col-2"}
			{block type='generic' name="2016-allblocks-page-block-6-0"}
                {content}
				<h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Categories Block</h4>
                {/content}
            {/block}
            {block type='blog_categories' name="2016-allblocks-page-block-2"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-page-block-5-1"}
                {content}
				<br>
				<h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Post List Block</h4>
                {/content}
            {/block}
			{block type='blog_posts_list' name="2016-allblocks-page-block-6"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-page-block-6-4"}
                {content}
				<br>
				<h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Search Block</h4>
                {/content}
            {/block}
			{block type='blog_search' name="2016-allblocks-page-block-7"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-page-block-6-3"}
                {content}
				<h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Recent Posts Block</h4>
                {/content}
            {/block}
			{block type='blog_recent_posts' name="2016-allblocks-page-block-5"}
                {content}
                {/content}
            {/block}
		{/block}	
		{block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-allblocks-page-row-2-col-2-2-1"}
			{block type='generic' name="2016-allblocks-page-block-6-2-1-gen"}
                {content}
				<h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Category Posts Horizontal Block</h4>
                {/content}
            {/block}
            {block type='blog_category_posts_horizontal' name="2016-allblocks-page-block-6-2-1-block"}
                {content}
                {/content}
            {/block}	
		{/block}
	{/block}
	
	{block type='row' class='container boxed-row' name="2016-allblocks-onlinestore-row-1"}
        {block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-allblocks-onlinestore-row-1-col-1"}
            {block type='generic' name="2016-allblocks-onlinestore-block-1"}
                {content}
                     <br><br>
					 <h2 class="content-title" style="color: #54b9e9;font-weight: 600;border-bottom: 2px solid #dadada;margin-bottom: 20px;">Online Store Module / App</h2>
                {/content}
            {/block}
        {/block}
	{/block}
	{block type='row' class='container boxed-row' name="2016-allblocks-onlinestore-page-row-2"}
		{block type='column' class='col-lg-3 col-md-3 col-sm-12 col-xs-12' name="2016-allblocks-onlinestore-page-row-2-col-2"}
			{block type='generic' name="2016-allblocks-onlinestore-page-block-6-0"}
                {content}
				<h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Account Login Block</h4>
                {/content}
            {/block}
            {block type='ecommerce_account_login' name="2016-allblocks-onlinestore-page-block-2"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-onlinestore-page-block-5-1"}
                {content}
				<br><br><br><br>
				<h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Category List Block</h4>
                {/content}
            {/block}
			{block type='ecommerce_category_list' name="2016-allblocks-onlinestore-page-block-6"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-onlinestore-page-block-6-3"}
                {content}
				<h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Category Sort Block</h4>
                {/content}
            {/block}
			{block type='ecommerce_category_sorting' name="2016-allblocks-onlinestore-page-block-5"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-onlinestore-page-block-10-3"}
                {content}
				<br><br>
				<h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Featured Block</h4>
                {/content}
            {/block}
			{block type='ecommerce_product_featured_products' name="2016-allblocks-onlinestore-page-block-5-10"}
                {content}
                {/content}
            {/block}
		{/block}
		{block type='column' class='col-lg-9 col-md-9 col-sm-12 col-xs-12' name="2016-allblocks-onlinestore-page-row-3-col-2"}
		{block type='generic' name="2016-allblocks-onlinestore-page-block-6-4"}
                {content}
				<h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Shopping Cart Block</h4>
                {/content}
            {/block}
			{block type='ecommerce_product_cart' name="2016-allblocks-onlinestore-page-block-7"}
                {content}
                {/content}
            {/block}
		{block type='generic' name="2016-allblocks-onlinestore-page-block-5-0"}
                {content}
				<h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Breadcrumb Block</h4>
                {/content}
            {/block}
		{block type='ecommerce_category_breadcrumb' name="2016-allblocks-onlinestore-page-block-3"}
            {content}
            {/content}
        {/block}
			{block type='generic' name="2016-allblocks-onlinestore-page-block-6-2"}
                {content}
				<br><br> 
				<h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Category Products Block</h4>
                {/content}
            {/block}
			{block type='ecommerce_category' name="2016-allblocks-onlinestore-page-block-4"}
                {block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-allblocks-onlinestore-page-block-4-1"}
                    {block type='ecommerce_category_products' name="2016-allblocks-onlinestore-page-block-4-1-1"}
                        {content}
                        {/content}
                    {/block}
                {/block}
                {block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-allblocks-onlinestore-page-block-4-2"}
                    {block type='ecommerce_category_pagination' name="2016-allblocks-onlinestore-page-block-4-2-1"}
                        {content}
                        {/content}
                    {/block}
                {/block}
            {/block}
		{/block}
	{/block}
	 {block type='row' class='container boxed-row' name="2016-allblocks-onlinestore-page-row-10"}
		{block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-allblocks-onlinestore-page-row-10-col-2"}
			{block type='generic' name="2016-allblocks-onlinestore-page-block-6-12"}
                {content}
				<br>
				<h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Product Block</h4>
                {/content}
            {/block}
			{block type='ecommerce_product' name="2016-allblocks-onlinestore-page-block-12"}
                {block type='column' class='col-lg-6 col-md-5 col-sm-12 col-xs-12' name="2016-allblocks-onlinestore-page-block-12-1"}
                    {block type='ecommerce_product_gallery' name="2016-allblocks-onlinestore-page-block-12-1-1"}
                        {content}
                        {/content}
                    {/block}
                {/block}
                {block type='column' class='col-lg-6 col-md-7 col-sm-12 col-xs-12' name="2016-allblocks-onlinestore-page-block-12-2"}
                    {block type='ecommerce_product_title' name="2016-allblocks-onlinestore-page-block-12-2-3"}
                        {content}
                        {/content}
                    {/block}
					{block type='ecommerce_product_price' name="2016-allblocks-onlinestore-page-block-12-2-2"}
                        {content}
                        {/content}
                    {/block}
                {/block}
				 {block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-allblocks-onlinestore-page-block-12-2-4"}
					{block type='ecommerce_product_desc_and_reviews' name="2016-allblocks-onlinestore-page-block-12-2-1"}
                        {content}
                        {/content}
                    {/block}
                {/block}
            {/block}
			{block type='generic' name="2016-allblocks-onlinestore-page-block-6-13"}
                {content}
				<br>
				<h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Recent Products Block</h4>
                {/content}
            {/block}
			{block type='ecommerce_category_recent_products' name="2016-allblocks-onlinestore-page-block-12-5"}
                {content}
                {/content}
            {/block}
			
			{block type='generic' name="2016-allblocks-onlinestore-page-block-10-0"}
                {content}
                {/content}
            {/block}
		{/block}
	{/block}
	
	{block type='row' class='container boxed-row' name="2016-allblocks-audioplayer-row-1"}
        {block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-allblocks-audioplayer-row-1-col-1"}
            {block type='generic' name="2016-allblocks-audioplayer-block-1"}
                {content}
                     <br>
					 <h2 class="content-title" style="color: #54b9e9;font-weight: 600;border-bottom: 2px solid #dadada;margin-bottom: 20px;">Audio Player Module / App</h2>
                {/content}
            {/block}
        {/block}
	{/block}	
	{block type='row' class='container boxed-row' name="2016-allblocks-audioplayer-row-2"}
        {block type='column' class='col-lg-3 col-md-3 col-sm-12 col-xs-12' name="2016-allblocks-audioplayer-row-2-col-1"}
            {block type='generic' name="2016-allblocks-audioplayer-block-2"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Featured Audio</h4>
                {/content}
            {/block}
			{block type='audioplayer_featured_audios' name="2016-allblocks-audioplayer-block-3"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-audioplayer-block-4"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Search Audio</h4>
                {/content}
            {/block}
			{block type='audioplayer_search_block' name="2016-allblocks-audioplayer-block-5"}
                {content}
                {/content}
            {/block}
        {/block}
		 {block type='column' class='col-lg-9 col-md-9 col-sm-12 col-xs-12' name="2016-allblocks-audioplayer-row-2-col-2"}
            {block type='generic' name="2016-allblocks-audioplayer-block-6"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Audio Track Block</h4>
                {/content}
            {/block}
			{block type='audioplayer_track' name="2016-allblocks-audioplayer-block-7"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-audioplayer-block-8"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Audio Login</h4>
                {/content}
            {/block}
			{block type='audioplayer_login_form' name="2016-allblocks-audioplayer-block-9"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-audioplayer-block-10"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Audio Register Form</h4>
                {/content}
            {/block}
			{block type='audioplayer_register_form' name="2016-allblocks-audioplayer-block-11"}
                {content}
                {/content}
            {/block}
        {/block}
		{block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-allblocks-audioplayer-row-3-col-2"}
            {block type='generic' name="2016-allblocks-audioplayer-block-12"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">All Audio Tracks</h4>
                {/content}
            {/block}
			{block type='audioplayer_all_audios_thumbnails' name="2016-allblocks-audioplayer-block-13"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-audioplayer-block-14"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Recent Audio Tracks</h4>
                {/content}
            {/block}
			{block type='audioplayer_recent_audios' name="2016-allblocks-audioplayer-block-15"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-audioplayer-block-16"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">All Audio Albums</h4>
                {/content}
            {/block}
			{block type='audioplayer_all_albums' name="2016-allblocks-audioplayer-block-17"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-audioplayer-block-18"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Audio Profile Bar</h4>
                {/content}
            {/block}
			{block type='audioplayer_top_bar' name="2016-allblocks-audioplayer-block-19"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-audioplayer-block-20"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Audio Profile Channel</h4>
                {/content}
            {/block}
			{block type='audioplayer_channel_profile_bar' name="2016-allblocks-audioplayer-block-21"}
                {content}
                {/content}
            {/block}
        {/block}
	{/block}	
	
	{block type='row' class='container boxed-row' name="2016-allblocks-bookingevents-row-1"}
        {block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-allblocks-bookingevents-row-1-col-1"}
            {block type='generic' name="2016-allblocks-bookingevents-block-1"}
                {content}
                     <br><br>
					 <h2 class="content-title" style="color: #54b9e9;font-weight: 600;border-bottom: 2px solid #dadada;margin-bottom: 20px;">Booking Events Module / App</h2>
                {/content}
            {/block}
        {/block}
	{/block}	
	{block type='row' class='container boxed-row' name="2016-allblocks-bookingevents-row-2"}
		 {block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-allblocks-bookingevents-row-2-col-2"}
            {block type='generic' name="2016-allblocks-bookingevents-block-2"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Category Upcoming Events Block</h4>
                {/content}
            {/block}
			{block type='booking_events_upcoming_category_events' name="2016-allblocks-bookingevents-block-3"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-bookingevents-block-4"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Upcoming Events Block</h4>
                {/content}
            {/block}
			{block type='booking_events_upcoming_events' name="2016-allblocks-bookingevents-block-5"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-bookingevents-block-6"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Event Block</h4>
                {/content}
            {/block}
			{block type='booking_events_event' name="2016-allblocks-bookingevents-block-7"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-bookingevents-block-8"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Event Calendar</h4>
                {/content}
            {/block}
			{block type='booking_events_calendar' name="2016-allblocks-bookingevents-block-9"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-bookingevents-block-10"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Events List</h4>
                {/content}
            {/block}
			{block type='booking_events_list' name="2016-allblocks-bookingevents-block-11"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-bookingevents-block-12"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Events User Menu</h4>
                {/content}
            {/block}
			{block type='booking_events_top_bar' name="2016-allblocks-bookingevents-block-13"}
                {content}
                {/content}
            {/block}
        {/block}
	{/block}
	
	{block type='row' class='container boxed-row' name="2016-allblocks-bookingrooms-row-1"}
        {block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-allblocks-bookingrooms-row-1-col-1"}
            {block type='generic' name="2016-allblocks-bookingrooms-block-1"}
                {content}
                     <br><br>
					 <h2 class="content-title" style="color: #54b9e9;font-weight: 600;border-bottom: 2px solid #dadada;margin-bottom: 20px;">Booking Rooms Module / App</h2>
                {/content}
            {/block}
        {/block}
	{/block}	
	{block type='row' class='container boxed-row' name="2016-allblocks-bookingrooms-row-2"}
		 {block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-allblocks-bookingrooms-row-2-col-2"}
            {block type='generic' name="2016-allblocks-bookingrooms-block-2"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Booking Calendar Block</h4>
                {/content}
            {/block}
			{block type='booking_rooms_calendar' name="2016-allblocks-bookingrooms-block-3"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-bookingrooms-block-4"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Room Department Block</h4>
                {/content}
            {/block}
			{block type='booking_rooms_department' name="2016-allblocks-bookingrooms-block-5"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-bookingrooms-block-6"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Category Departments Block</h4>
                {/content}
            {/block}
			{block type='booking_rooms_departments' name="2016-allblocks-bookingrooms-block-7"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-bookingrooms-block-8"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Categories Block</h4>
                {/content}
            {/block}
			{block type='booking_rooms_categories' name="2016-allblocks-bookingrooms-block-9"}
                {content}
                {/content}
            {/block}
        {/block}
	{/block}
	
	{block type='row' class='container boxed-row' name="2016-allblocks-classifieds-row-1"}
        {block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-allblocks-classifieds-row-1-col-1"}
            {block type='generic' name="2016-allblocks-classifieds-block-1"}
                {content}
                     <br>
					 <h2 class="content-title" style="color: #54b9e9;font-weight: 600;border-bottom: 2px solid #dadada;margin-bottom: 20px;">Classifieds Module / App</h2>
                {/content}
            {/block}
        {/block}
	{/block}	
	{block type='row' class='container boxed-row' name="2016-allblocks-classifieds-row-2"}
        {block type='column' class='col-lg-3 col-md-3 col-sm-12 col-xs-12' name="2016-allblocks-classifieds-row-2-col-1"}
            {block type='generic' name="2016-allblocks-classifieds-block-2"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Account Menu Block</h4>
                {/content}
            {/block}
			{block type='classifieds_user_menu' name="2016-allblocks-classifieds-block-3"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-classifieds-block-4"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Classifieds Listing</h4>
                {/content}
            {/block}
			{block type='classifieds_categories' name="2016-allblocks-classifieds-block-5"}
                {content}
                {/content}
            {/block}
        {/block}
		 {block type='column' class='col-lg-9 col-md-9 col-sm-12 col-xs-12' name="2016-allblocks-classifieds-row-2-col-2"}
            {block type='generic' name="2016-allblocks-classifieds-block-6"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Classifieds Directory Block</h4>
                {/content}
            {/block}
			{block type='classifieds_directories' name="2016-allblocks-classifieds-block-7"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-classifieds-block-8"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Classifieds Search Block</h4>
                {/content}
            {/block}
			{block type='classifieds_search_section' name="2016-allblocks-classifieds-block-9"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-classifieds-block-10"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Featured Classifieds</h4>
                {/content}
            {/block}
			{block type='classifieds_featured_items' name="2016-allblocks-classifieds-block-11"}
                {content}
                {/content}
            {/block}
        {/block}
		{block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-allblocks-classifieds-row-3-col-2"}
            {block type='generic' name="2016-allblocks-classifieds-block-12"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Recent Classifieds Block</h4>
                {/content}
            {/block}
			{block type='classifieds_recent_items' name="2016-allblocks-classifieds-block-13"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-classifieds-block-14"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Classifieds Ad</h4>
                {/content}
            {/block}
			{block type='classifieds_ad' name="2016-allblocks-classifieds-block-15"}
                {content}
                {/content}
            {/block}
        {/block}
	{/block}	
	
	{block type='row' class='container boxed-row' name="2016-allblocks-forums-row-1"}
        {block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-allblocks-forums-row-1-col-1"}
            {block type='generic' name="2016-allblocks-forums-block-1"}
                {content}
                     <br>
					 <h2 class="content-title" style="color: #54b9e9;font-weight: 600;border-bottom: 2px solid #dadada;margin-bottom: 20px;">Forums Module / App</h2>
                {/content}
            {/block}
        {/block}
	{/block}	
	{block type='row' class='container boxed-row' name="2016-allblocks-forums-row-2"}
        {block type='column' class='col-lg-3 col-md-3 col-sm-12 col-xs-12' name="2016-allblocks-forums-row-2-col-1"}
            {block type='generic' name="2016-allblocks-forums-block-2"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Forums Recent Posts</h4>
                {/content}
            {/block}
			{block type='forum_recent_thread_posts' name="2016-allblocks-forums-block-3"}
                {content}
                {/content}
            {/block}
        {/block}
		 {block type='column' class='col-lg-9 col-md-9 col-sm-12 col-xs-12' name="2016-allblocks-forums-row-2-col-2"}
            {block type='generic' name="2016-allblocks-forums-block-6"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Forum Topics Category Block</h4>
                {/content}
            {/block}
			{block type='forum_topic_categories' name="2016-allblocks-forums-block-7"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-forums-block-16"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Forum Login Block</h4>
                {/content}
            {/block}
			{block type='forum_login_form' name="2016-allblocks-forums-block-17"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-forums-block-18"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Forum Register Block</h4>
                {/content}
            {/block}
			{block type='forum_register_form' name="2016-allblocks-forums-block-19"}
                {content}
                {/content}
            {/block}
        {/block}
		{block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-allblocks-forums-row-3-col-2"}
            {block type='generic' name="2016-allblocks-forums-block-22"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Forum Header Block</h4>
                {/content}
            {/block}
			{block type='forum_header' name="2016-allblocks-forums-block-21"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-forums-block-12"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">All Forum Topics Block</h4>
                {/content}
            {/block}
			{block type='forum_all_topics' name="2016-allblocks-forums-block-13"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-forums-block-10"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Forums Section Block</h4>
                {/content}
            {/block}
			{block type='forum_area' name="2016-allblocks-forums-block-11"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-forums-block-14"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Forums Thread Block</h4>
                {/content}
            {/block}
			{block type='forum_category_thread' name="2016-allblocks-forums-block-15"}
                {content}
                {/content}
            {/block}
		{/block}	
	{/block}
	
	{block type='row' class='container boxed-row' name="2016-allblocks-photogallery-row-1"}
        {block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-allblocks-photogallery-row-1-col-1"}
            {block type='generic' name="2016-allblocks-photogallery-block-1"}
                {content}
                     <br>
					 <h2 class="content-title" style="color: #54b9e9;font-weight: 600;border-bottom: 2px solid #dadada;margin-bottom: 20px;">Photo Gallery Module / App</h2>
                {/content}
            {/block}
        {/block}
	{/block}	
	{block type='row' class='container boxed-row' name="2016-allblocks-photogallery-row-2"}
        {block type='column' class='col-lg-3 col-md-3 col-sm-12 col-xs-12' name="2016-allblocks-photogallery-row-2-col-1"}
            {block type='generic' name="2016-allblocks-photogallery-block-2"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Featured Photos</h4>
                {/content}
            {/block}
			{block type='photogallery_featured_photos' name="2016-allblocks-photogallery-block-3"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-photogallery-block-4"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Search Photos</h4>
                {/content}
            {/block}
			{block type='photogallery_search_block' name="2016-allblocks-photogallery-block-5"}
                {content}
                {/content}
            {/block}
        {/block}
		 {block type='column' class='col-lg-9 col-md-9 col-sm-12 col-xs-12' name="2016-allblocks-photogallery-row-2-col-2"}
            {block type='generic' name="2016-allblocks-photogallery-block-6"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Photo Block</h4>
                {/content}
            {/block}
			{block type='photogallery_single_photo_file' name="2016-allblocks-photogallery-block-7"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-photogallery-block-8"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Photo Gallery Login</h4>
                {/content}
            {/block}
			{block type='photogallery_login_form' name="2016-allblocks-photogallery-block-9"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-photogallery-block-10"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Photo Register Form</h4>
                {/content}
            {/block}
			{block type='photogallery_register_form' name="2016-allblocks-photogallery-block-11"}
                {content}
                {/content}
            {/block}
        {/block}
		{block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-allblocks-photogallery-row-3-col-2"}
            {block type='generic' name="2016-allblocks-photogallery-block-12"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">All Photos</h4>
                {/content}
            {/block}
			{block type='photogallery_all_photos_thumbnails' name="2016-allblocks-photogallery-block-13"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-photogallery-block-14"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Recent Photos Uploaded</h4>
                {/content}
            {/block}
			{block type='photogallery_recent_photos' name="2016-allblocks-photogallery-block-15"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-photogallery-block-16"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">All Photo Albums</h4>
                {/content}
            {/block}
			{block type='photogallery_all_albums' name="2016-allblocks-photogallery-block-17"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-photogallery-block-18"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Photo Profile Bar</h4>
                {/content}
            {/block}
			{block type='photogallery_top_bar' name="2016-allblocks-photogallery-block-19"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-photogallery-block-20"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Photo Profile Channel</h4>
                {/content}
            {/block}
			{block type='photogallery_channel_profile_bar' name="2016-allblocks-photogallery-block-21"}
                {content}
                {/content}
            {/block}
        {/block}
	{/block}
	
	{block type='row' class='container boxed-row' name="2016-allblocks-videotube-row-1"}
        {block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-allblocks-videotube-row-1-col-1"}
            {block type='generic' name="2016-allblocks-videotube-block-1"}
                {content}
                     <br>
					 <h2 class="content-title" style="color: #54b9e9;font-weight: 600;border-bottom: 2px solid #dadada;margin-bottom: 20px;">VideoTube Module / App</h2>
                {/content}
            {/block}
        {/block}
	{/block}	
	{block type='row' class='container boxed-row' name="2016-allblocks-videotube-row-2"}
        {block type='column' class='col-lg-3 col-md-3 col-sm-12 col-xs-12' name="2016-allblocks-videotube-row-2-col-1"}
            {block type='generic' name="2016-allblocks-videotube-block-2"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Featured Videos</h4>
                {/content}
            {/block}
			{block type='videotube_featured_videos' name="2016-allblocks-videotube-block-3"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-videotube-block-4"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Search Videos</h4>
                {/content}
            {/block}
			{block type='videotube_search_block' name="2016-allblocks-videotube-block-5"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-videotube-block-22"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Recent Videos Sidebar</h4>
                {/content}
            {/block}
			{block type='videotube_recent_videos_vertical' name="2016-allblocks-videotube-block-23"}
                {content}
                {/content}
            {/block}
        {/block}
		{block type='column' class='col-lg-9 col-md-9 col-sm-12 col-xs-12' name="2016-allblocks-videotube-row-3-col-1"}
            {block type='generic' name="2016-allblocks-videotube-block-6"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Video Block</h4>
                {/content}
            {/block}
			{block type='videotube_single_video_file' name="2016-allblocks-videotube-block-7"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-videotube-block-8"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Video Login</h4>
                {/content}
            {/block}
			{block type='videotube_login_form' name="2016-allblocks-videotube-block-9"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-videotube-block-10"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Video Register Form</h4>
                {/content}
            {/block}
			{block type='videotube_register_form' name="2016-allblocks-videotube-block-11"}
                {content}
                {/content}
            {/block}
        {/block}
	{/block}
	{block type='row' class='container boxed-row' name="2016-allblocks-videotube-row-3"}
		{block type='column' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' name="2016-allblocks-videotube-row-4-col-1"}
            {block type='generic' name="2016-allblocks-videotube-block-12"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">All Videos</h4>
                {/content}
            {/block}
			{block type='videotube_all_videos_thumbnails' name="2016-allblocks-videotube-block-13"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-videotube-block-14"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Recent Videos Uploaded</h4>
                {/content}
            {/block}
			{block type='videotube_recent_videos' name="2016-allblocks-videotube-block-15"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-videotube-block-16"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">All Video Albums</h4>
                {/content}
            {/block}
			{block type='videotube_all_albums' name="2016-allblocks-videotube-block-17"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-videotube-block-18"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Video Profile Bar</h4>
					 <br>
                {/content}
            {/block}
			{block type='videotube_profile_header' name="2016-allblocks-videotube-block-19"}
                {content}
                {/content}
            {/block}
			{block type='generic' name="2016-allblocks-videotube-block-20"}
                {content}
                     <br>
					 <h4 class="content-title" style="color: #54b9e9;font-weight: 600;text-decoration: underline;">Video Profile Channel</h4>
                {/content}
            {/block}
			{block type='videotube_channel_profile_bar' name="2016-allblocks-videotube-block-21"}
                {content}
                {/content}
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