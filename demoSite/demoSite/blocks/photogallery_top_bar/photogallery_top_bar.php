<?php
class photogallery_top_bar_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Photo Gallery";
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
    public function apply_custom_css()
    {
        $style_arr = $this->block->data("style");
        if(!isset($style_arr['color']))
            $style_arr['color'] = '';
        if(!isset($style_arr['text-align']))
            $style_arr['text-align'] = '';
        if(!isset($style_arr['background-color']))
            $style_arr['background-color'] = '';

        return '
        <style>
        div[name="'.$this->block->get_name().'"] h1{
                color: '.$style_arr['color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] h2{
                color: '.$style_arr['color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] h3{
                color: '.$style_arr['color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] h4{
                color: '.$style_arr['color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] h5{
                color: '.$style_arr['color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] p{
            /*    color: '.$style_arr['color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] span{
            /*    color: '.$style_arr['color'].' !important; */
                text-align: ' . $style_arr['text-align'].' !important;
            /*    background-color: ' . $style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] div{
                color: '.$style_arr['color'].' !important;
                text-align: '.$style_arr['text-align'].' !important;
            /*    background-color: '.$style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] ul{
                color: '.$style_arr['color'].' !important;
                text-align: '.$style_arr['text-align'].' !important;
            /*    background-color: '.$style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] ol{
                color: ' . $style_arr['color'].' !important;
                text-align: ' . $style_arr['text-align'].' !important;
             /*   background-color: ' . $style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] li{
                color: '.$style_arr['color'].' !important;
                text-align: ' . $style_arr['text-align'].' !important;
            /*    background-color: ' . $style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] a{
            /*    color: '.$style_arr['color'].' !important; */
        }
		.bckgrd{
			background-color: '.$style_arr['background-color'].' !important;
		}
        </style>';
    }
    public function generate_content()
    {
		//Controller
		global $active_controller;
		$user = &$active_controller->user;
        $CI = & get_instance();
        $CI->load->module('photogallery');
		$this->load_generic_styles();
		$gallery_option = $CI->BuilderEngine->get_option('photogallery_option');
		$num_followers = $CI->photogalleryfollow->where('following_id',$CI->user->id)->count();
		$followers = $CI->photogalleryfollow->where('follower_id',$CI->user->id)->get();
		$followings =$CI->photogalleryfollow->where('follower_id',$CI->user->id)->get();
		$num_followers =($num_followers == 1)?$num_followers.' Follower':$num_followers.' Followers';
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		if($segments[$count-1] == 'search' || $segments[$count-1] == 'all_photos' || $segments[$count-1] == 'search'){
			$pg = 'search';
		}
		else{
			$pg ='page';
		}
		
		//View
		$output ='
		<div id="photogallery-top-bar-'.$this->block->get_id().'" class="block-column-wide-12">
		<div class="container photogallery-topbar-container">
			<div class="photo-topbargallery">
				<div class="col-md-12 photo-topbargallery-bg">
				<div class="photogallery-post-author-details pull-left gallerywhite">';
				if($gallery_option == 'open'){
					if($user->is_logged_in()){
						$active_user = new User($user->get_id());
						$output .='
					<div class="photogallery-post-author-img photogallery-post-author-channel-header">
						<div class="photogallery-post-author-img pull-left">
							<a href="'.base_url('photogallery/channel/'.$user->username.'').'"><img alt="author" src="'.$user->avatar.'" alt=""></a>
						</div>
						<div class="photogallery-post-author-details pull-left photogallery-membername-button">
							<a href="'.base_url('photogallery/channel/'.$user->username.'').'"><h4>'.$user->first_name.' '.$user->last_name.'</h4></a>
						<div class="post-meta"><span> '.$num_followers.'</span></div>
					</div>
				</div>';
					}
				}
				$output .='</div>';
				if($gallery_option == 'open'){
						$output.='<div class="photogallery-post-author-channel-options-margin pull-right">';
					if(!$user->is_logged_in()){
						$output .='<a href="'.base_url('cp/login').'" type="button" class="photogallery-btn photogallery-btn-md photogallery-btn-white-line"><i class="fa fa-user left"></i>Login</a>
							<a href="'.base_url('cp/register').'" type="button" class="photogallery-btn photogallery-btn-md photogallery-btn-white-line"><i class="fa fa-user left"></i>Register</a>';
					}
					else{				
						$output .='
							<a href="'.base_url('photogallery/upload').'" class="photogallery-btn photogallery-btn-md photogallery-btn-color-line photogallery-uploadvideo-button"><i class="fa fa-upload left"></i>Upload Photo</a>
							<a href="'.base_url('photogallery/add_album').'" class="photogallery-btn photogallery-btn-md photogallery-btn-white-line photogallery-createalbum-button"><i class="fa fa-cloud left"></i>Create Album</a>
						<div class="btn-group">
							<button type="button" class="photogallery-btn photogallery-btn-md photogallery-btn-color-line dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-user"></i> My Account <span class="caret"></span>
							</button>
							<ul class="dropdown-menu photogallery-header-account-dropdown-box animated fadeIn">
								<li><a href="'.base_url('photogallery/upload').'"><i class="fa fa-upload left"></i> Upload Photo</a></li>
								<li><a href="'.base_url('photogallery/add_album').'"><i class="fa fa-cloud left"></i> Create Album</a></li>
								<hr>
								<li><a href="'.base_url('photogallery/channel/'.$active_user->username.'').'"><i class="fa fa-user-plus left"></i> My Channel</a></li>
								<li><a href="'.base_url('photogallery/myfeed').'"><i class="fa fa-newspaper-o left"></i> My Newsfeed</a></li>
								<li><a href="'.base_url('photogallery/myphotos').'"><i class="fa fa-video-camera left"></i> My Photos</a></li>
								<li><a href="'.base_url('photogallery/myalbums').'"><i class="fa fa-folder-open-o left"></i> My Albums</a></li>
								<hr>
								<li><a href="'.base_url('photogallery/all_photos').'"><i class="fa fa-desktop left"></i> View All Photos</a></li>
								<hr>
								<li><a href="'.base_url('photogallery/mysettings').'"><i class="fa fa-cogs left"></i> Channel Settings</a></li>
								<li><a href="'.base_url('cp/edit/'.$active_user->id.'').'"><i class="fa fa-dashboard left"></i> Edit My Account</a></li>
								<hr>
								<li><a href="'.base_url('cp/logout').'"><i class="fa fa-sign-out left"></i> Log Out</a></li>
							</ul>
						</div>
						<a href="'.base_url('cp/logout').'" type="button" class="photogallery-btn photogallery-btn-md photogallery-btn-white-line photogallery-logout-button"><i class="fa fa-sign-out left"></i>Log Out</a>
						<div class="post-meta gallerylocation1"><!--<span>Galway, Ireland</span>--></div>';
					}
					$output .='</div>
					</div>
				</div>
			</div>';
				}
				if($pg == 'search' || $pg == 'all_photos'){
				$output .='
				<div class="photogallery-sidebar-widget photo-topbargallery">
					<div class="photogallery-widget-search photogallery-widget-search-topbar">
						<form class="navbar-form photogallery-channel-widget-search photogallery-channel-widget-search-padding-sidebar" method="get" action="'.base_url('/photogallery/search').'" >
							<input class="form-full input-lg" type="text" value="" placeholder="Search Here" name="keyword" id="wid-search">
							<input type="submit" value="" name="email" id="wid-s-sub">
						</form>
					</div>
				</div>';			
				}
			$output .='</div>';	

		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'photogallery-top-bar-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), $menu);
		else
			return $output.$this->apply_custom_css();
    }
}
?>