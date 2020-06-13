<?php
class Videotube_top_bar_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "VideoTube";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Top Bar";
        $info['block_icon'] = "fa-envelope-o";

        return $info;
    }
    public function generate_admin()
    {
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
		$gallery_option = $CI->BuilderEngine->get_option('videotube_option');
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		if($segments[$count-1] == 'search' || $segments[$count-1] == 'all_videos' || $segments[$count-1] == 'search'){
			$page = 'search';
		}
		else{
			$page ='page';
		}
		
		//View
		$output ='
				<div class=" post-author-details pull-left gallerywhite">';
				if($gallery_option == 'open'){
					if($user->is_logged_in()){
						$active_user = new User($user->get_id());
						$output .='<div class="post-author post-author-img pull-left">
							<h4 style="margin-top:5px;"><img class="img-circle" width="30" alt="user" src="'.$active_user->avatar.'"> '.$active_user->first_name.' '.$active_user->last_name.'</h4>
						</div>';
					}
				}
				$output .='</div>';
				if($gallery_option == 'open'){
						$output.='<div class="pull-right">';
					if(!$user->is_logged_in()){
						$output .='<a href="'.base_url('videotube/login').'" type="button" class="btn btn-md btn-white-line"><i class="fa fa-user left"></i>Login</a>
							<a href="'.base_url('videotube/register').'" type="button" class="btn btn-md btn-white-line"><i class="fa fa-user left"></i>Register</a>';
					}
					else{				
						$output .='
							<a href="'.base_url('videotube/upload').'" class="btn btn-md btn-color-line"><i class="fa fa-upload left"></i>Upload Video</a>
							<a href="'.base_url('videotube/add_album').'" class="btn btn-md btn-white-line"><i class="fa fa-cloud left"></i>Create Album</a>
						<div class="btn-group">
							<button type="button" class="btn btn-md btn-color-line dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-user"></i> My Profile <span class="caret"></span>
							</button>
							<ul class="dropdown-menu" style="min-width:147px;width:170px;border:3px solid #128fdc;background:#ddd;">
								<li><a href="'.base_url('videotube/myvideos').'" style="padding:3px 10px;"><i class="fa fa-video-camera"></i> My Videos</a></li>
								<li><a href="'.base_url('videotube/myalbums').'" style="padding:3px 10px;"><i class="fa fa-folder-open-o"></i> My Albums</a></li>
								<li><a href="'.base_url('videotube/myfeed').'" style="padding:3px 10px;"><i class="fa fa-newspaper-o left"></i> My Newsfeed</a></li>
								<li><a href="'.base_url('videotube/mysettings').'" style="padding:3px 10px;"><i class="fa fa-cogs left"></i> My Settings</a></li>
							</ul>
						</div>
						<a href="'.base_url('videotube/logout').'" type="button" class="btn btn-md btn-white-line"><i class="fa fa-sign-out left"></i>Log Out</a>
						<div class="post-meta gallerylocation1"><!--<span>Galway, Ireland</span>--></div>';
					}
					$output .='</div>';
				}
				if($page == 'search' || $page == 'all_videos'){
				$output .='<br/>
				<div class="sidebar-widget">
					<h5>Search</h5>
					<div class="widget-search">
						<form class="navbar-form" method="get" action="'.base_url('/videotube/search').'" >
							<input class="form-full input-lg" type="text" value="" placeholder="Search Here" name="keyword" id="wid-search">
							<input type="submit" value="" name="email" id="wid-s-sub">
						</form>
					</div>
				</div>';			
				}
			$output .='';	

        return $output;
    }
}
?>