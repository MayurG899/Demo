<?php
class Cp_side_bar_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Account Dashboard";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Account Dashboard Sidebar";
        $info['block_icon'] = "fa-envelope-o";

        return $info;
    }

    public function generate_admin()
    {
		$this->show_placeholder();
    }
	
	 public function generate_style($active_menu = '')
    {
        
    }
    public function load_generic_styling()
    {
       
    }
	
	public function set_initial_values_if_empty()
    {
        $content = $this->block->data('content');

        if(!is_array($content) || empty($content))
        {
            $content = array();
            $content[0] = new stdClass();
            $content[0]->text = "Default Text";

            $this->block->set_data('content', $content, true);
        }
    }
	
    public function generate_content()
    {
		//Controller
		global $active_controller;
		$user = &$active_controller->user;
        $CI = & get_instance();
		$CI->load->model('users');
		$CI->load->model('pages');
		$this->load_generic_styles();
		$CI->load->module('cp');
		$user->is_verified();

		$this->block->set_data("editorEnabled", 1);
		$CI->load->module('layout_system');
		$this->set_initial_values_if_empty();
		$content = $this->block->data('content');
		$account_pages = $CI->pages->get_by_type('cp');
        $single_element = '';
		$groups_name = $CI->users->get_user_group_name(get_active_user_id());
        //generic animations
        $this->load_generic_styles();
        //
		
		$location_cache_id = "be_visitor_location_" . $_SERVER['REMOTE_ADDR'];
		$location = $CI->cache->fetch($location_cache_id);
		if ($location == null) {
			$location = $CI->cp->getLocation($_SERVER['REMOTE_ADDR']);
			$CI->cache->insert($location_cache_id, $location, 2678400);
		}
		$output = '';
        if(strpos($this->block->get_name(), 'custom-block-')  !== false)
        {
            $block_name = explode('-', $this->block->get_name());
            $block_id = $block_name[2];
        }
        else
            $block_id = $this->block->get_id();
        $output ='
		';
		foreach($content as $key => $element)
        {
			$suspended = false;
			$element = (object)$element;//echo'<pre>';print_r($groups_name);echo'</pre>';exit;
			$output .='
			<div block-editor="ckeditor" block-name="'.$this->block->get_name().'" id="usersidebar-container-'.$this->block->get_id().'">
				<div id="be-uaccount-page-container" class="fade page-sidebar-fixed page-header-fixed">
					
					<div class="be-uaccount-sidebar-pad">
						<!-- begin #sidebar -->
						<div id="be-uaccount-sidebar" class="be-uaccount-sidebar">
							<!-- begin sidebar scrollbar -->
							<div data-scrollbar="true" data-height="100%">
								<!-- begin sidebar account -->
								<ul class="nav">
									<li class="has-sub nav-profile">
									   <a href="#" data-toggle="nav-profile">
											<div class="image">
												<img src="'.$user->get_avatar().'" alt="" />
											</div>
											<div class="info">
												<b class="caret pull-right"></b>
												'.$user->first_name.' '.$user->last_name.'
												<small>'.$user->email.'</small>
											</div>
										</a>';
										$trig1 = '';
										if(isset($current_page) && ($current_page == '' || $current_page == ''))
											$trig1 ='style="display:block"';
										$output .= '
										<ul class="sub-menu nav-profile sidebarpro1" '.$trig1.'>
											<li><a href="'.base_url('cp/edit/'.$user->get_id()).'"><i class="fa fa-edit"></i> Edit Profile</a></li>
											<li><a href="'.base_url('cp/user/'.$user->get_id()).'" ><i class="fa fa-user"></i> View Profile</a></li>
											<li class="divider"></li>
											<li><a href="'.base_url('cp/logout').'"><i class="fa fa-sign-out"></i> Account Logout</a></li>
										</ul>
									</li>
								</ul>
								<!-- end sidebar user -->
								<!-- begin sidebar nav -->
								<ul class="nav">
									<li class="nav-header">Account Control Panel</li>
									<li class="has-sub active">
										<a href="'.base_url('login').'">
											<b class="pull-right"></b>
											<i class="fa fa-laptop"></i>
											<span>Dashboard</span>
										</a>
									</li>';
									if($CI->users->is_admin()){
										$output .='
										<li class="has-sub">
											<a href="'.base_url('admin').'">
												<b class="pull-right"></b>
												<i class="fa fa-cog"></i>
												<span>Admin Dashboard</span>
											</a>
										</li>';
									}
									$output .='
									<li class="has-sub">
										<a href="javascript:;">
											<b class="caret pull-right"></b>
											<i class="fa fa-user"></i>
											<span>My Account</span>
										</a>';
										$trig2 = '';
										if(isset($current_page) && ($current_page == 'account' || $current_page == 'groups'))
											$trig2 = 'style="display:block"';
										$output .='
										<ul class="sub-menu" '.$trig2.'>
											<li><a href="'.base_url('cp/edit/'.$user->get_id()).'" >Edit Account Details</a></li>
											<li><a href="'.base_url('cp/user/'.$user->get_id()).'" >View My Profile</a></li>
											<li class="divider"></li>
											<li><a href="'.base_url('cp/orders').'" >Billing & Orders</a></li>
											<li><a href="'.base_url('cp/subscriptions/').'" >View My Subscriptions</a></li>
										</ul>
									</li>
									<li class="nav-header">Account Options</li>';
									foreach($account_pages as $cp_page){
										$allowed_cp_page = false;
										$allowed_usergroups = explode(',',$cp_page->groups);
										foreach($groups_name as $g){
											if(in_array($g,$allowed_usergroups))
												$allowed_cp_page = true;
										}
									}
									if(!empty($account_pages) && ($CI->users->is_admin() || $allowed_cp_page)){
										$output .= '
										<li class="has-sub">
											<a href="javascript:;">
												<b class="caret pull-right"></b>
												<i class="fa fa-file"></i>';
												if($CI->BuilderEngine->get_option('account_pages_section_name'))
													$output .= '<span>'.$CI->BuilderEngine->get_option('account_pages_section_name').'</span>';
												else
													$output .= '<span>Account Pages</span>';
												$output .='
											</a>
											<ul class="sub-menu">';
												foreach($account_pages as $cp_page){
													$allowed_cp_page = false;
													$allowed_usergroups = explode(',',$cp_page->groups);
													foreach($groups_name as $g){
														if(in_array($g,$allowed_usergroups))
															$allowed_cp_page = true;
													}
													if($CI->users->is_admin() || $allowed_cp_page)
														$output .= '<li><a href="'.base_url('page-'.$cp_page->slug.'.html').'" >'.$cp_page->title.'</a></li>';
												}
												$output .='
											</ul>
										</li>';
									}
									$groups = array();
									$user_created_posts = '';
									$user_created_categories = '';
									foreach ($groups_name as $key => $value) {
										$group = $CI->users->get_groups($value);

										if($group[0]->allow_posts)
											$user_created_posts = 1;

										if($group[0]->allow_categories)
											$user_created_categories = 1;

										$groups[] = $group[0];
									}
									if($CI->BuilderEngine->get_option('user_dashboard_audioplayer') == 'yes' && $CI->BuilderEngine->get_option('audioplayer_active') == 'yes'){
										$output .='
										<li class="has-sub">
											<a href="javascript:;">
												<b class="caret pull-right"></b>
												<i class="fa fa-play"></i>
												<span>Audio Player</span>
											</a>
											<ul class="sub-menu">';
												if($CI->users->is_admin() || $CI->BuilderEngine->get_option('audioplayer_option') == 'open'){
													$output .='
													<li><a href="'.base_url('audioplayer/upload').'"><i class="fa fa-upload left"></i> Upload Audio</a></li>
													<li><a href="'.base_url('audioplayer/add_album').'"><i class="fa fa-cloud left"></i> Create Album</a></li>
													<li><a href="'.base_url('audioplayer/channel/'.$user->username.'').'"><i class="fa fa-user-plus left"></i> My Channel</a></li>
													<li><a href="'.base_url('audioplayer/myfeed').'"><i class="fa fa-newspaper-o left"></i> My Newsfeed</a></li>
													<li><a href="'.base_url('audioplayer/mysounds').'"><i class="fa fa-play left"></i> My Audios</a></li>
													<li><a href="'.base_url('audioplayer/myalbums').'"><i class="fa fa-folder-open-o left"></i> My Albums</a></li>
													<li><a href="'.base_url('audioplayer/mysettings').'"><i class="fa fa-cogs left"></i> Channel Settings</a></li>';
												}
												$output .='
												<li><a href="'.base_url('audioplayer/all_audios').'"><i class="fa fa-desktop left"></i> View All Audios</a></li>
											</ul>
										</li>';
									}
									if($CI->BuilderEngine->get_option('user_dashboard_blog') == 'yes' && $user_created_posts){
										$output .='
										<li class="has-sub">
											<a href="javascript:;">
												<b class="caret pull-right"></b>
												<i class="fa fa-comment"></i>
												<span>Blog Publishing</span>
											</a>
											<ul class="sub-menu" ';if($CI->uri->segment(2) == 'blog')$output .= 'style="display:block;"';$output .='>';
											if($user_created_posts){
												$output .='<li><a href="'.base_url('cp/blog/add_post/add').'" >Add New Blog Post</a></li>';
											}
											$output .='
												<li><a href="'.base_url('cp/blog/posts').'" >View Published Posts</a></li>
												<div class="be-uaccount-divider"></div>';
												if($user_created_categories){
													$output .='<li><a href="'.base_url('cp/blog/add_category/add').'" >Add Blog Category</a></li>
													<li><a href="'.base_url('cp/blog/categories').'" >View Blog Categories</a></li>';
												}
												$output .='
											</ul>
										</li>';
									}
									if($CI->BuilderEngine->get_option('user_dashboard_booking_events') == 'yes' && $CI->BuilderEngine->get_option('booking_events_active') == 'yes'){
										$allow_event = false;
										foreach($groups_name as $group){
											if(in_array($group,explode(',',$CI->BuilderEngine->get_option('be_booking_events_add_event_groups'))))
												$allow_event = true;
										}
										$output .='
										<li class="has-sub">
											<a href="javascript:;">
												<b class="caret pull-right"></b>
												<i class="fa fa-calendar"></i>
												<span>Event Bookings</span>
											</a>
											<ul class="sub-menu" ';if($CI->uri->segment(3) == 'events')$output .= 'style="display:block;"';$output .='>';
												if($allow_event || $CI->users->is_admin()){
													$output.='
													<li><a href="'.base_url('cp/booking/events/add').'">Add New Event</a></li>
													<li><a href="'.base_url('cp/booking/events/list').'">View My Event List</a></li>
													<li><a href="'.base_url('cp/booking/events/mycalendar').'">View My Event Calendar</a></li>';
												}
												$output .='
												<li><a href="'.base_url('cp/booking/events/orders').'">View My Orders</a></li>';
												if(!$allow_event)
													$output .='<li><a href="'.base_url('cp/booking/events/calendar').'">View Event Calendar</a></li>';
												$output .='
											</ul>
										</li>';
									}
									if($CI->BuilderEngine->get_option('user_dashboard_booking_rooms') == 'yes' && $CI->BuilderEngine->get_option('booking_rooms_active') == 'yes'){
										$allow_room = false;
										foreach($groups_name as $group){
											if(in_array($group,explode(',',$CI->BuilderEngine->get_option('be_booking_rooms_add_room_groups'))))
												$allow_room = true;
										}
										$output .='
										<li class="has-sub">
											<a href="javascript:;">
												<b class="caret pull-right"></b>
												<i class="fa fa-calendar-plus-o"></i>
												<span>Booking Rooms</span>
											</a>
											<ul class="sub-menu" ';if($CI->uri->segment(3) == 'rooms')$output .= 'style="display:block;"';$output .='>';
												if($allow_room || $CI->users->is_admin()){
													$output .='<li><a href="'.base_url('cp/booking/rooms/calendar').'">Book A Room</a></li>';
												}
												$output .='
												<li><a href="'. base_url('cp/booking/rooms/calendar').'">View All Rooms</a></li>
											</ul>
										</li>';
									}
									if($CI->BuilderEngine->get_option('user_dashboard_booking_memberships') == 'yes' && $CI->BuilderEngine->get_option('booking_memberships_active') == 'yes'){
										$allow_memberships = false;
										foreach($groups_name as $group){
											if(in_array($group,explode(',',$CI->BuilderEngine->get_option('be_booking_memberships_add_membership_groups'))))
												$allow_memberships = true;
										}
										$output .='
										<li class="has-sub">
											<a href="javascript:;">
												<b class="caret pull-right"></b>
												<i class="fa fa-users"></i>
												<span>Memberships</span>
											</a>
											<ul class="sub-menu" ';if($CI->uri->segment(3) == 'memberships')$output .= 'style="display:block;"';$output .='>';
												/*
												if($allow_memberships || $CI->users->is_admin()){
													$output .='<li><a href="'.base_url('cp/booking/memberships/add').'">Add New Membership</a></li>';
												}
												*/
												$output .='
												<li><a href="'.base_url('booking_memberships/memberships').'">Available Memberships</a></li>
												<li><a href="'.base_url('cp/orders').'">My Membership Orders</a></li>
												<li><a href="'.base_url('cp/subscriptions').'">My Membership Subscriptions</a></li>
											</ul>
										</li>';
									}
									if($CI->BuilderEngine->get_option('user_dashboard_booking_services') == 'yes' && $CI->BuilderEngine->get_option('booking_services_active') == 'yes'){
										$allow_services = false;
										foreach($groups_name as $group){
											if(in_array($group,explode(',',$CI->BuilderEngine->get_option('be_booking_services_add_service_groups'))))
												$allow_services = true;
										}
										$output .='
										<li class="has-sub">
											<a href="javascript:;">
												<b class="caret pull-right"></b>
												<i class="fa fa-credit-card-alt"></i>
												<span>Service Orders</span>
											</a>
											<ul class="sub-menu" ';if($CI->uri->segment(3) == 'services')$output .= 'style="display:block;"';$output .='>';
												/*
												if($allow_services || $CI->users->is_admin()){
													$output .='<li><a href="'.base_url('cp/booking/services/add').'">Add New Service</a></li>';
												}
												*/
												$output .='
												<li><a href="'.base_url('booking_services/services').'">Available Services</a></li>
												<li><a href="'.base_url('cp/orders').'">My Paid Orders</a></li>
												<li><a href="'.base_url('cp/subscriptions').'">My Bookings & Subscriptions</a></li>
											</ul>
										</li>';
									}
									if($CI->BuilderEngine->get_option('user_dashboard_classifieds') == 'yes' && $CI->BuilderEngine->get_option('classifieds_active') == 'yes'){
										$output .='
										<li class="has-sub">
											<a href="javascript:;">
												<b class="caret pull-right"></b>
												<i class="fa fa-tags"></i>
												<span>Classifieds</span>
											</a>
											<ul class="sub-menu">';
												$allow_create_ads = false;
												foreach($groups_name as $group){
													if(in_array($group,explode(',',get_option('be_classifieds_create_ads_groups'))))
														$allow_create_ads = true;
												}
												if($allow_create_ads || $CI->users->is_admin()){
													$output .='
													<li><a href="'.base_url('classifieds/create_item').'" >Create New Ad</a></li>
													<li><a href="'.base_url('classifieds/placed_ads').'" >My Ads</a></li>';
												}
												$output .='
												<li><a href="'.base_url('classifieds/my_watchlist').'" >My Watchlist</a></li>
												<li><a href="'.base_url('classifieds/followed_users').'" >Followed Users</a></li>
												<li><a href="'.base_url('classifieds/send_message').'" >Send Message</a></li>
												<li><a href="'.base_url('classifieds/inbox').'" >Inbox</a></li>
											</ul>
										</li>';
									}
									if($CI->BuilderEngine->get_option('user_dashboard_forum') == 'yes' && $CI->BuilderEngine->get_option('forum_active') == 'yes'){
										$output .='
										<li class="has-sub">
											<a href="javascript:;">
												<b class="caret pull-right"></b>
												<i class="fa fa-coffee"></i>
												<span>Forums</span>
											</a>
											<ul class="sub-menu">
												<li><a href="'.base_url('forum/all_topics').'">Forums</a></li>
											</ul>
										</li>';
									}
									if($CI->BuilderEngine->get_option('user_dashboard_ecommerce') == 'yes' && $CI->BuilderEngine->get_option('ecommerce_active') == 'yes'){
										$output .='
										<li class="has-sub">
											<a href="javascript:;">
												<b class="caret pull-right"></b>
												<i class="fa fa-money"></i>
												<span>Online Store</span>
											</a>
											<ul class="sub-menu" ';if($CI->uri->segment(2) == 'ecommerce')$output .= 'style="display:block;"';$output .='>
												<li><a href="'.base_url('cp/ecommerce/orders').'">View Orders</a></li>
												<li><a href="'.base_url('cp/ecommerce/mywishlist').'">View Wishlist</a></li>
											</ul>
										</li>';
									}
									if($CI->BuilderEngine->get_option('user_dashboard_photogallery') == 'yes' && $CI->BuilderEngine->get_option('photogallery_active') == 'yes'){
										$output .='
										<li class="has-sub">
											<a href="javascript:;">
												<b class="caret pull-right"></b>
												<i class="fa fa-camera"></i>
												<span>Photo Gallery</span>
											</a>
											<ul class="sub-menu">';
												if($CI->users->is_admin() || $CI->BuilderEngine->get_option('photogallery_option') == 'open'){
													$output .='
													<li><a href="'.base_url('photogallery/upload').'"><i class="fa fa-upload left"></i> Upload Photo</a></li>
													<li><a href="'.base_url('photogallery/add_album').'"><i class="fa fa-cloud left"></i> Create Album</a></li>
													<li><a href="'.base_url('photogallery/channel/'.$user->username.'').'"><i class="fa fa-user-plus left"></i> My Channel</a></li>
													<li><a href="'.base_url('photogallery/myfeed').'"><i class="fa fa-newspaper-o left"></i> My Newsfeed</a></li>
													<li><a href="'.base_url('photogallery/myphotos').'"><i class="fa fa-camera left"></i> My Photos</a></li>
													<li><a href="'.base_url('photogallery/myalbums').'"><i class="fa fa-folder-open-o left"></i> My Albums</a></li>
													<li><a href="'.base_url('photogallery/mysettings').'"><i class="fa fa-cogs left"></i> Channel Settings</a></li>';
												}
												$output .='
												<li><a href="'.base_url('photogallery/all_photos').'"><i class="fa fa-desktop left"></i> View All Photos</a></li>
											</ul>
										</li>';
									}
									if($CI->BuilderEngine->get_option('user_dashboard_videotube') == 'yes' && $CI->BuilderEngine->get_option('videotube_active') == 'yes'){
										$output .='
										<li class="has-sub">
											<a href="javascript:;">
												<b class="caret pull-right"></b>
												<i class="fa fa-film"></i>
												<span>VideoTube</span>
											</a>
											<ul class="sub-menu">';
												if($CI->users->is_admin() || $CI->BuilderEngine->get_option('videotube_option') == 'open'){
													$output .='
													<li><a href="'.base_url('videotube/upload').'"><i class="fa fa-upload left"></i> Upload Videos</a></li>
													<li><a href="'.base_url('videotube/youtube').'"><i class="fa fa-youtube left"></i></i>Add YouTube Link</a></li>
													<li><a href="'.base_url('videotube/add_album').'"><i class="fa fa-cloud left"></i> Create Album</a></li>
													<li><a href="'.base_url('videotube/channel/'.$user->username.'').'"><i class="fa fa-user-plus left"></i> My Channel</a></li>
													<li><a href="'.base_url('videotube/myfeed').'"><i class="fa fa-newspaper-o left"></i> My Newsfeed</a></li>
													<li><a href="'.base_url('videotube/myvideos').'"><i class="fa fa-film left"></i> My Videos</a></li>
													<li><a href="'.base_url('videotube/myalbums').'"><i class="fa fa-folder-open-o left"></i> My Albums</a></li>
													<li><a href="'.base_url('videotube/mysettings').'"><i class="fa fa-cogs left"></i> Channel Settings</a></li>';
												}
												$output .='
												<li><a href="'.base_url('videotube/all_videos').'"><i class="fa fa-desktop left"></i> View All Videos</a></li>
											</ul>
										</li>';
									}
									if(file_exists($_SERVER['DOCUMENT_ROOT'].'/blocks/cp_side_bar/cp_side_bar_custom.php'))
										require_once('cp_side_bar_custom.php');
									$output .='
									<!-- begin sidebar minify button -->
									<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
									<!-- end sidebar minify button -->

								</ul>
								<!-- end sidebar nav -->
							</div>
							<!-- end sidebar scrollbar -->
						</div>
						<div class="be-uaccount-sidebar-bg"></div>
						<!-- end #sidebar -->
					</div>
				</div>
				<script>
					$(".sidebar-minify-btn").on("click",function(){
						setTimeout(function(){
							if($("#be-uaccount-page-container").hasClass("page-sidebar-minified"))
								$(".be-uaccount-sidebar-column").addClass("be-uaccount-sidebar-column-2-hide");
							else
								$(".be-uaccount-sidebar-column").removeClass("be-uaccount-sidebar-column-2-hide");
						},50);
					});
				</script>
			</div>';
        }
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='global_style';
		else
			$menu ='style';
		if(!$user->is_guest()){
			if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
				return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'usersidebar-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
			else
				return $output;
		}
    }
}