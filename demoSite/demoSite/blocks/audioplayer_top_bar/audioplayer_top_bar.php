<?php
class Audioplayer_top_bar_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Audio Player";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Top Bar";
        $info['block_icon'] = "fa-envelope-o public";

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
    public function generate_content()
    {
		//Controller
		global $active_controller;
		$user = &$active_controller->user;
        $CI = & get_instance();
        $CI->load->module('audioplayer');
		$CI->load->model('users');
		$this->load_generic_styles();
		$gallery_option = $CI->BuilderEngine->get_option('audioplayer_option');
		$num_followers = $CI->audioplayerfollow->where('following_id',$user->id)->count();
		$num_followers =($num_followers == 1)?$num_followers.' Follower':$num_followers.' Followers';
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		if($segments[$count-1] == 'search' || $segments[$count-1] == 'all_audios' || $segments[$count-1] == 'search'){
			$page = 'search';
		}
		else{
			$page ='page';
		}
		//View
		$output ='
			<div id="audioplayer-top-bar-'.$this->block->get_id().'" class="block-column-wide-12">
			<div class="container audioplayer-topbar-container">
				<div class="audio-topbargallery">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 audio-topbargallery-bg">
						<div class="audiogallery-post-author-details pull-left gallerywhite">';
							if($user->is_logged_in()){
								$output .='
								<div class="audiogallery-post-author-img audiogallery-post-author-channel-header">
									<div class="audiogallery-post-author-img pull-left">
										<a href="'.base_url('audioplayer/channel/'.$user->username.'').'"><img alt="author" src="'.$user->avatar.'" alt=""></a>
									</div>
									<div class="audiogallery-post-author-details pull-left audiogallery-membername-button">
										<a href="'.base_url('audioplayer/channel/'.$user->username.'').'"><h4>'.$user->first_name.' '.$user->last_name.'</h4></a>
										<div class="post-meta"><span> '.$num_followers.'</span></div>
									</div>
								</div>';
							}
							$output .='
						</div>';
						$output.='
						<div class="audiogallery-post-author-channel-options-margin pull-right">';
						if(!$user->is_logged_in()){
							$output .='
								<a href="'.base_url('audioplayer/login').'" type="button" class="audiogallery-btn audiogallery-btn-md audiogallery-btn-white-line"><i class="fa fa-user left"></i>Login</a>
								<a href="'.base_url('audioplayer/register').'" type="button" class="audiogallery-btn audiogallery-btn-md audiogallery-btn-white-line"><i class="fa fa-user left"></i>Register</a>';
						}
						else{
							if($CI->users->is_admin() || $gallery_option == 'open'){
							$output .='
							<a href="'.base_url('audioplayer/upload').'" class="audiogallery-btn audiogallery-btn-md audiogallery-btn-color-line audiogallery-uploadvideo-button"><i class="fa fa-upload left"></i>Upload Audio</a>
							<a href="'.base_url('audioplayer/add_album').'" class="audiogallery-btn audiogallery-btn-md audiogallery-btn-white-line audiogallery-createalbum-button"><i class="fa fa-cloud left"></i>Create Album</a>';
							}
							$output .='
							<div class="btn-group">
								<button type="button" class="audiogallery-btn audiogallery-btn-md audiogallery-btn-color-line dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fa fa-user"></i> My Account <span class="caret"></span>
								</button>
								<ul class="dropdown-menu audiogallery-header-account-dropdown-box animated fadeIn">';
								if($CI->users->is_admin() || $gallery_option == 'open'){
									$output .='
									<li><a href="'.base_url('audioplayer/upload').'"><i class="fa fa-upload left"></i> Upload Audio</a></li>
									<li><a href="'.base_url('audioplayer/add_album').'"><i class="fa fa-cloud left"></i> Create Album</a></li>
									<hr>
									<li><a href="'.base_url('audioplayer/channel/'.$user->username.'').'"><i class="fa fa-user-plus left"></i> My Channel</a></li>
									<li><a href="'.base_url('audioplayer/myfeed').'"><i class="fa fa-newspaper-o left"></i> My Newsfeed</a></li>
									<li><a href="'.base_url('audioplayer/mysounds').'"><i class="fa fa-video-camera left"></i> My Audio Tracks</a></li>
									<li><a href="'.base_url('audioplayer/myalbums').'"><i class="fa fa-folder-open-o left"></i> My Albums</a></li>
									<hr>
									<li><a href="'.base_url('audioplayer/mysettings').'"><i class="fa fa-cogs left"></i> Channel Settings</a></li>
									<hr>';
								}
									$output .='
									<li><a href="'.base_url('cp/edit/'.$user->id.'').'"><i class="fa fa-dashboard left"></i> Edit My Account</a></li>
									<li><a href="'.base_url('audioplayer/all_audios').'"><i class="fa fa-desktop left"></i> View All Audio</a></li>
									<!--<li><a href="audioplayer/logout"><i class="fa fa-sign-out left"></i> Log Out</a></li>-->
								</ul>
							</div>
							<a href="'.base_url('audioplayer/logout').'" type="button" class="audiogallery-btn audiogallery-btn-md audiogallery-btn-white-line audiogallery-logout-button"><i class="fa fa-sign-out left"></i>Log Out</a>
							<div class="post-meta gallerylocation1"><!--<span>Galway, Ireland</span>--></div>';
						}
			$output .='</div>
					</div>
				</div>
			</div>';
			if($page == 'search' || $page == 'all_audios'){
				$output .='
				<div class="audiogallery-sidebar-widget audio-topbargallery">
					<div class="audiogallery-widget-search audiogallery-widget-search-topbar">
						<form class="navbar-form audiogallery-channel-widget-search audiogallery-topbar1-search audiogallery-channel-widget-search-padding-sidebar" method="get" action="'.base_url('audioplayer/search').'" >
							<input class="form-full input-lg" type="text" value="" placeholder="Search Here" name="keyword" id="wid-search">
							<input type="submit" value="" name="email" id="wid-s-sub">
						</form>
					</div>
				</div>';
			}
		$output .='</div>';
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='global_style';
		else
			$menu ='style';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'audioplayer-top-bar-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), $menu);
		else
			return $output;
    }
}
?>