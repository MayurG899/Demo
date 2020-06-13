<?php
class Videotube_channel_profile_bar_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "VideoTube";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Channel Profile Bar";
        $info['block_icon'] = "fa-envelope-o public";

        return $info;
    }
    public function generate_admin()
    {
		$user_profile_id = $this->block->data('user_profile_id');
		$available_users = array();
		$all_users = new User();
		foreach($all_users->where('verified','yes')->get() as $key => $value){
			$available_users[$value->id] = stripslashes($value->first_name.' '.$value->last_name);
		}
		$this->admin_select('user_profile_id', $available_users, 'Users: ', $user_profile_id);
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
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$this->load_generic_styles();
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		$user_profile_id = $this->block->data('user_profile_id');
		if(!isset($user_profile_id) || $user_profile_id == '')
			$user_profile_id = 13;
		if(strpos($segments[$count-1],'.html') !== FALSE || $CI->uri->total_segments() == 0 || strpos($_SERVER['REQUEST_URI_PATH'],'/layout_system/ajax/') !== FALSE){
			$user_profile = new User($user_profile_id);
			$username = $user_profile->username;
		}else{
			if($segments[$count-2] == 'album'){
				$username = $segments[$count-3];
			}elseif($segments[$count-1] == 'about'){
				$username = $segments[$count-2];
			}elseif($segments[$count-2] == 'videotube' && $segments[$count-1] == 'video'){
				$vid = new VideoTubeMedia($count);
				$vid = $vid->get();
				$user_profile = new User($vid->user_id);
				$username = $user_profile->username;
			}elseif($segments[$count-1]  == 'channel'){
				$user_profile = new User();
				$u = $user_profile->where('username',$segments[$count])->get();
				$username = $u->username;
			}elseif($segments[$count-3]  == 'channel'){
				$user_profile = new User();
				$u = $user_profile->where('username',$segments[$count-2])->get();
				$username = $u->username;
			}elseif($segments[$count-1] == 'myfeed'){
				$username = $user->username;
			}else{
				$username = end($segments);
			}
		}
		$owner = new User();
		$channel_owner = $owner->where('username',$username)->get();
		$settings = new VideoTubeUserSettings();
		$owner_settings = $settings->where('user_id',$channel_owner->id)->get();
		$followers = $CI->videotubefollow->where('following_id',$channel_owner->id)->count();
		$num_owners_videos = $CI->videotubemedia->where('user_id',$channel_owner->id)->count();
		$gallery_option = $CI->BuilderEngine->get_option('videotube_option');
		$follow = new VideoTubeFollow();
		$followed = $follow->where('following_id',$channel_owner->id)->where('follower_id',$user->get_id())->count();
		$followed = ($followed != 0)?'yes':'no';
		$allow_comments = $CI->BuilderEngine->get_option('videotube_allow_comments');
		$single_element = '';
		if($segments[$count-1]  == 'channel'){
			$css ='';
		}else{
			$css ='';
		}
		//View
		$output ='';
		
		if($owner_settings->background_img){
			$class = '';
			$rule = 'background-image:url('.$owner_settings->background_img.');background-repeat: no-repeat;'; 
		}
		else{
			$class = 'dark-bg';
			$rule ='';
		}
		//if($gallery_option == 'open'){
			$output ='
				<section id="videotube-channel-profile-container-'.$this->block->get_id().'" class="'.$class.' galleryprofileheight1 block-column-wide-12" style="'.$rule.''.$css.'">';
				//if($gallery_option == 'open'){
					if($user->is_logged_in()){
						$active_user = new User($user->get_id());
						$output .='
						<div class="video-post-author-details pull-right video-channel-account-profile-title">
							<li class="dropdown" style="list-style:none">
								<div class="video-post-author video-post-author-img pull-right">
									<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
										<h4 class="videotube-channel-account-profile-box">
											<img class="img-circle" width="30" alt="user" src="'.$active_user->avatar.'">
											<small class="videotube-channel-account-desc-position" style="font-size:9px;">My Account Options</small> '.$active_user->first_name.' '.$active_user->last_name.' <span class="caret"></span>
										</h4>
									</a>
									<ul class="dropdown-menu videotube-channel-account-dropdown-box animated fadeIn">
										<li class="dropdown-submenu">';
										if($CI->users->is_admin() || $gallery_option == 'open'){
											$output .='
												<a tabindex="-1" href="#"><i class="fa fa-plus" style="margin-right:6px"></i> Add Video</a>
												<ul class="dropdown-menu videotube-channel-account-dropdown-submenu" style="left:-100%;width:100%">
													<li><a href="'.base_url('videotube/upload').'"><i class="fa fa-upload left"></i> Upload File</a></li>
													<li><a href="'.base_url('videotube/youtube').'"><i class="fa fa-youtube left"></i></i> YouTube Link</a></li>
													<!--<li><a href="#"><i class="fa fa-vimeo left"></i> Vimeo Link</a></li>-->
												</ul>
											</li>
											<li><a href="'.base_url('videotube/add_album').'"><i class="fa fa-cloud left"></i> Create Album</a></li>
											<hr>
											<li><a href="'.base_url('videotube/channel/'.$active_user->username.'').'"><i class="fa fa-user-plus left"></i> My Channel</a></li>
											<li><a href="'.base_url('videotube/myfeed').'"><i class="fa fa-newspaper-o left"></i> My Newsfeed</a></li>
											<li><a href="'.base_url('videotube/myvideos').'"><i class="fa fa-video-camera left"></i> My Videos</a></li>
											<li><a href="'.base_url('videotube/myalbums').'"><i class="fa fa-folder-open-o left"></i> My Albums</a></li>
											<hr>';
										}
										$output .='
										<li><a href="'.base_url('videotube/all_videos').'"><i class="fa fa-desktop left"></i> View All Videos</a></li>
										<hr>
										<li><a href="'.base_url('videotube/mysettings').'"><i class="fa fa-cogs left"></i> Channel Settings</a></li>
										<li><a href="'.base_url('cp/edit/'.$active_user->id.'').'"><i class="fa fa-dashboard left"></i> Edit My Account</a></li>
										<hr>
										<li><a href="'.base_url('videotube/logout').'"><i class="fa fa-sign-out left"></i> Log Out</a></li>
									</ul>
								</div>
							</li>
						</div>';
					}else{
						$output .='
						<div class="pull-right">
							<a href="'.base_url('cp/register').'" class="video-btn btn-md video-btn-black-line-border"><i class="fa fa-users left"></i>Sign Up</a>
							<a href="'.base_url('cp/login').'" class="video-btn btn-md video-btn-black-line-border"><i class="fa fa-sign-in left"></i>Sign In</a>
						</div>';
					}
				//}
			$output .='
				</section>

			<section class="channel-bg galleryprofileheight videotube-channel-bar-width-container block-column-wide-12">
					<div class="container">	
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="video-post-author-channel">
						<div class="video-post-author-img pull-left">
							<a href="'.base_url('videotube/channel/'.$channel_owner->username.'').'"><img alt="author" src="'.$channel_owner->avatar.'"></a>
						</div>
						<div class="video-post-author-details pull-left">
							<a href="'.base_url('videotube/channel/'.$channel_owner->username.'').'"><h4>'.$channel_owner->first_name.' '.$channel_owner->last_name.'</h4></a>';
							$followers = ($followers == 1)?$followers.' Follower':$followers.' Followers';
							$num_owners_videos = ($num_owners_videos ==1)?$num_owners_videos.'':$num_owners_videos.'';
							$output .='<div class="post-meta"><span> '.$followers.'</span></div>
						</div>
						</div>
					</div>
					
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
					</div>
					
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<div class="">';
					if($followed=='yes'){
							$class = 'video-btn-black-line-border';
							$text ='<i class="fa fa-check left"></i> Following';
					}
					else{
						$class = 'video-btn-danger';
						$text ='<i class="fa fa-users left"></i> Follow';
					}		
					$output .='<div class="pull-right video-channel-follow-margin-top">';
					$foll = ($user->get_id() == $channel_owner->id)?'disabled':'';
					$output .='<a id="follow2" href="#" class="video-btn video-btn-follow video-btn-md '.$class.' '.$foll.'">'.$text.'</a>
					<!--<div class="post-meta gallerylocation1"><span>Galway, Ireland</span></div>-->
					</div></div>
				</div>
				<div class="videotube-channelmenu-container">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="video-channel-home-options">';
					if($segments[$count-1] == $channel_owner->username || $segments[$count-1] == 'channel'){
						$channel = 'video-btn-black-line';
						$videos = 'video-btn-black-line-noborder';
						$albums = 'video-btn-black-line-noborder';
						$discussion = 'video-btn-black-line-noborder';
						$about = 'video-btn-black-line-noborder';
					}
					elseif($segments[$count-1] == 'videos'){
						$channel = 'video-btn-black-line-noborder';
						$videos = 'video-btn-black-line';
						$albums = 'video-btn-black-line-noborder';
						$discussion = 'video-btn-black-line-noborder';
						$about = 'video-btn-black-line-noborder';
					}
					elseif($segments[$count-1] == 'albums'){
						$channel = 'video-btn-black-line-noborder';
						$videos = 'video-btn-black-line-noborder';
						$albums = 'video-btn-black-line';
						$discussion = 'video-btn-black-line-noborder';
						$about = 'video-btn-black-line-noborder';
					}
					elseif($segments[$count-1] == 'discussion'){
						$channel = 'video-btn-black-line-noborder';
						$videos = 'video-btn-black-line-noborder';
						$albums = 'video-btn-black-line-noborder';
						$discussion = 'video-btn-black-line';
						$about = 'video-btn-black-line-noborder';
					}
					elseif($segments[$count-1] == 'about'){
						$channel = 'video-btn-black-line-noborder';
						$videos = 'video-btn-black-line-noborder';
						$albums = 'video-btn-black-line-noborder';
						$discussion = 'video-btn-black-line-noborder';
						$about = 'video-btn-black-line';
					}
					else{
						$channel = 'video-btn-black-line-noborder';
						$videos = 'video-btn-black-line-noborder';
						$albums = 'video-btn-black-line-noborder';
						$discussion = 'video-btn-black-line-noborder';
						$about = 'video-btn-black-line-noborder';
					}
					$output .='
						<a href="'.base_url('videotube/channel/'.$channel_owner->username.'').'" class="video-btn video-btn-md videochannels-profile-buttons-xs '.$channel.'"><i class="fa fa-home left"></i>Home</a>
						<a href="'.base_url('videotube/channel/'.$channel_owner->username.'/videos').'" class="video-btn video-btn-md videochannels-profile-buttons-xs '.$videos.'"><i class="fa fa-video-camera left"></i>Videos ('.$num_owners_videos.')</a>
						<a href="'.base_url('videotube/channel/'.$channel_owner->username.'/albums').'" class="video-btn video-btn-md videochannels-profile-buttons-xs '.$albums.'"><i class="fa fa-cloud left"></i>Albums</a>';
						if($allow_comments == 'yes' && $owner_settings->channel_comments == 'yes')
							$output .='<a href="'.base_url('videotube/channel/'.$channel_owner->username.'/discussion').'" class="video-btn video-btn-md videochannels-profile-buttons-xs '.$discussion.'"><i class="fa fa-comment left"></i>Discussion</a>';
						$output .='<a href="'.base_url('videotube/channel/'.$channel_owner->username.'/about').'" class="video-btn video-btn-md videochannels-profile-buttons-xs '.$about.'"><i class="fa fa-user left"></i>About</a>
						<a class="video-btn video-btn-md video-channel-search-padding"><form class="navbar-form video-channel-widget-search" method="get" action="'.base_url('videotube/search').'" >
							<input class="form-full input-md" type="text" value="" placeholder="Search Videos..." name="keyword" id="wid-search">
							<input type="submit" value="" name="email" id="wid-s-sub">
						</form></a>
						<div class="post-meta gallerylocation1"><!--<span>Galway, Ireland</span>--></div></div>
					</div>
				</div>
				</div>
			</section>';
			$user_dir = ($CI->session->userdata('user_id'))?'true':'false';
			$output .='<script>
					$(document).ready(function(){
						$(\'#follow2\').click(function(e){
							var permission = "'.$user_dir.'";
							if(permission == \'true\'){		
								follower_id = "'.$user->id.'";
								following_id = "'.$channel_owner->id.'";
								if(follower_id == following_id){
									location.reload(true);
								}
								var $this = $(this);
								setTimeout(function(){
									$.get("'.base_url().'videotube/ajax/toggle_follow/'.$user->id.'/'.$channel_owner->id.'", function(data){
										data = $.parseJSON(data);
										if(data.class == \'video-btn-black-line-border\' && $this.hasClass(\'video-btn-black-line-border\')){
											$this.removeClass(data.class);
											$this.hide().empty().html(\'<i class="fa fa-users left"></i>\' + data.text).addClass(data.activeclass).fadeIn(\'fast\');
										}
										else{
											$this.removeClass(data.activeclass);
											$this.hide().empty().html(\'<i class="fa fa-check left"></i>\' + data.text).addClass(data.class).fadeIn(\'fast\');
										}
									});
								}, 500);
							}
							else
								window.location.replace("'.base_url('videotube/login').'");	
							e.preventDefault();
						});
					});
			</script>';
		//}

		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'videotube-channel-profile-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output;
    }
}
?>