<?php
class Videotube_profile_header_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "VideoTube";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Profile Header";
        $info['block_icon'] = "fa-envelope-o public";

        return $info;
    }
    public function generate_admin()
    {
		$this->show_placeholder();
    }
    public function generate_style()
    {
    }
    public function generate_content()
    {
		//Controller		
		global $active_controller;
		$user = &$active_controller->user;
        $CI = & get_instance();
        $CI->load->module('videotube');
		$this->load_generic_styles();
		$single_element = '';
		
		$num_followers = $CI->videotubefollow->where('following_id',$user->id)->count();
		$num_followers =($num_followers == 1)?number_format($num_followers).' Follower':number_format($num_followers).' Followers';
		$num_videos = $CI->videotubemedia->where('user_id',$user->id)->count();
		$num_videos =($num_videos ==1)?$num_videos.' Video':$num_videos.' Videos';
		
		//View
		$output = '		
			<div id="videotube-profile-header-container-'.$this->block->get_id().'" class="container">
			<div class="videotube-topbar-container">';
			if($user->is_logged_in()){
				$output .='
				<div class="video-post-author-channel video-post-author-channel-header">
					<div class="video-post-author-img pull-left">
						<a href="'.base_url('videotube/channel/'.$user->username.'').'"><img alt="author" src="'.$user->avatar.'" alt=""></a>
					</div>
					<div class="video-post-author-details video-post-author-details-white pull-left videotube-membername-button">
						<a href="'.base_url('videotube/channel/'.$user->username.'').'"><h4>'.$user->first_name.' '.$user->last_name.'</h4></a>
						<div class="post-meta"><span> '.$num_followers.'</span></div>
					</div>
				</div>
				
				<div class="pull-right">';
					if($CI->users->is_admin() || $CI->BuilderEngine->get_option('videotube_option') == 'open'){
						$output .='
						<a href="'.base_url('videotube/upload').'" class="video-btn btn-md video-btn-black-line-border videotube-uploadvideo-button"><i class="fa fa-upload left"></i>Upload Video</a>
						<a href="'.base_url('videotube/add_album').'" class="video-btn btn-md video-btn-black-line-border videotube-createalbum-button"><i class="fa fa-cloud left"></i>Create Album</a>';
					}
					$output .='
					<div class="btn-group video-channel-account-profile-title">
						<button type="button" class="video-btn btn-md video-btn-black-line-border video-btn-nobg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-user"></i> My Account <span class="caret"></span> 
						</button>
						<ul class="dropdown-menu videotube-header-account-dropdown-box animated fadeIn">';
						if($CI->users->is_admin() || $CI->BuilderEngine->get_option('videotube_option') == 'open'){
							$output .='
							<li class="dropdown-submenu">
								<a tabindex="-1" href="#"><i class="fa fa-plus" style="margin-right:6px"></i> Add Video</a>
								<ul class="dropdown-menu" style="left:-100%;width:100%">
									<li><a href="'.base_url('videotube/upload').'"><i class="fa fa-upload left"></i> Upload File</a></li>
									<li><a href="'.base_url('videotube/youtube').'"><i class="fa fa-youtube left"></i></i> YouTube Link</a></li>
									<!--<li><a href="#"><i class="fa fa-vimeo left"></i> Vimeo Link</a></li>-->
								</ul>
							</li>
							<li><a href="'.base_url('videotube/add_album').'"><i class="fa fa-cloud left"></i> Create Album</a></li>
							<hr>
							<li><a href="'.base_url('videotube/channel/'.$user->username.'').'"><i class="fa fa-user-plus left"></i> My Channel</a></li>
							<li><a href="'.base_url('videotube/myfeed').'"><i class="fa fa-newspaper-o left"></i> My Newsfeed</a></li>
							<li><a href="'.base_url('videotube/myvideos').'"><i class="fa fa-video-camera left"></i> My Videos</a></li>
							<li><a href="'.base_url('videotube/myalbums').'"><i class="fa fa-folder-open-o left"></i> My Albums</a></li>
							<hr>';
						}
						$output .='
							<li><a href="'.base_url('videotube/all_videos').'"><i class="fa fa-desktop left"></i> View All Videos</a></li>
							<hr>
							<li><a href="'.base_url('videotube/mysettings').'"><i class="fa fa-cogs left"></i> Channel Settings</a></li>
							<li><a href="'.base_url('cp/edit/'.$user->id.'').'"><i class="fa fa-dashboard left"></i> Edit My Account</a></li>
							<hr>
							<li><a href="'.base_url('cp/logout').'"><i class="fa fa-sign-out left"></i> Log Out</a></li>
						</ul>
					</div>
					<a href="'.base_url('cp/logout').'" type="button" class="video-btn btn-md video-btn-black-line-border videotube-logout-button"><i class="fa fa-sign-out left"></i>Log Out</a>
					<div class="post-meta gallerylocation1"><!--<span>Galway, Ireland</span>--></div>
				</div>';
			}else{
				$output .='
				<div class="pull-right">
					<div class="videochannels-headerprofile-logins">
					<a href="'.base_url('cp/register').'" class="video-btn btn-md video-btn-black-line-border"><i class="fa fa-users left"></i>Sign Up</a>
					<a href="'.base_url('cp/login').'" class="video-btn btn-md video-btn-black-line-border"><i class="fa fa-sign-in left"></i>Sign In</a>
					</div>
				</div>';
			}
			$output .='</div></div>';
			if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
				$menu ='with_settings_global';
			else
				$menu ='with_settings';
			if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
				return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'videotube-profile-header-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
			else
        return $output;
    }
}
?>