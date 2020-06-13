<?php
class Audioplayer_channel_profile_bar_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Audio Player";
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
		$this->load_generic_styling();
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
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
			}elseif($segments[$count-2] == 'audioplayer' && $segments[$count-1] == 'sound'){
				$vid = new AudioPlayerMedia($count);
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
		$settings = new AudioPlayerUserSettings();
		$owner_settings = $settings->where('user_id',$channel_owner->id)->get();
		$followers = $CI->audioplayerfollow->where('following_id',$channel_owner->id)->count();
		$num_owners_sounds = $CI->audioplayermedia->where('user_id',$channel_owner->id)->count();
		$gallery_option = $CI->BuilderEngine->get_option('audioplayer_option');
		$follow = new AudioPlayerFollow();
		$followed = $follow->where('following_id',$channel_owner->id)->where('follower_id',$user->get_id())->count();
		$followed = ($followed != 0)?'yes':'no';
		$allow_comments = $CI->BuilderEngine->get_option('audioplayer_allow_comments');
		$single_element = '';
		if($segments[$count-1]  == 'channel'){
			$css ='';
		}else{
			$css ='';
		}
		
		//View
		$output ='';
		if(!empty($owner_settings->background_img)){
			$class = '';
			$rule = 'background-image:url('.$owner_settings->background_img.');background-repeat: no-repeat;padding-top:10px;'; 
		}
		else{
			$class = 'dark-bg';
			$rule ='';
		}
		if($gallery_option == 'open'){
			$output ='<section id="audioplayer-channel-profile-'.$this->block->get_id().'" class="'.$class.'  audiogalleryprofileheight1" style="'.$rule.''.$css.'">
					<div class="audiogallery-channel-main-box container">	
					<div class="audiogallery-post-author-channel">
						<div class="audiogallery-post-author-img audiogallery-channel-avatar-img pull-left">
							<a href="'.base_url('audioplayer/channel/'.$channel_owner->username.'').'"><img alt="author" src="'.$channel_owner->avatar.'"></a>
						</div>
						<div class="audiogallery-post-author-details pull-left">
							<a href="'.base_url('audioplayer/channel/'.$channel_owner->username.'').'"><h4>'.$channel_owner->first_name.' '.$channel_owner->last_name.'</h4></a>';
							$followers = ($followers == 1)?$followers.' Follower':$followers.' Followers';
							$num_owners_sounds = ($num_owners_sounds ==1)?$num_owners_sounds.'':$num_owners_sounds.'';
							$output .='<div class="post-meta"><span> '.$followers.'</span></div>
						</div>
					</div>';
					if($followed=='yes'){
							$class = 'audiogallery-btn-white-follow';
							$text ='Following';
					}
					else{
						$class = 'audiogallery-btn-white-follow';
						$text ='Follow';
					}		
					$output .='<div class="pull-right">';
					$foll = ($user->get_id() == $channel_owner->id)?'disabled':'';
					$output .='<a id="follow2" href="#" class="audiogallery-btn audiogallery-btn-md '.$class.' '.$foll.'"><i class="fa fa-user left"></i>'.$text.'</a>
					<!--<div class="post-meta gallerylocation1"><span>Galway, Ireland</span></div>-->
					</div>
				</div>
			</section>
			
			<section class="audiogallery-channel-bg audiogallery-channel-bar-width-container">
			<div class="container audioplayer-channelmenu-container">
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="audiogallery-channel-home-options">';
					if($segments[$count-1] == $channel_owner->username || $segments[$count-1] == 'channel'){
						$channel = 'audiogallery-btn-black-line';
						$audios = 'audiogallery-btn-black-line-noborder';
						$albums = 'audiogallery-btn-black-line-noborder';
						$discussion = 'audiogallery-btn-black-line-noborder';
						$about = 'audiogallery-btn-black-line-noborder';
					}
					elseif($segments[$count-1] == 'audios'){
						$channel = 'audiogallery-btn-black-line-noborder';
						$audios = 'audiogallery-btn-black-line';
						$albums = 'audiogallery-btn-black-line-noborder';
						$discussion = 'audiogallery-btn-black-line-noborder';
						$about = 'audiogallery-btn-black-line-noborder';
					}
					elseif($segments[$count-1] == 'albums'){
						$channel = 'audiogallery-btn-black-line-noborder';
						$audios = 'audiogallery-btn-black-line-noborder';
						$albums = 'audiogallery-btn-black-line';
						$discussion = 'audiogallery-btn-black-line-noborder';
						$about = 'audiogallery-btn-black-line-noborder';
					}
					elseif($segments[$count-1] == 'discussion'){
						$channel = 'audiogallery-btn-black-line-noborder';
						$audios = 'audiogallery-btn-black-line-noborder';
						$albums = 'audiogallery-btn-black-line-noborder';
						$discussion = 'audiogallery-btn-black-line';
						$about = 'audiogallery-btn-black-line-noborder';
					}
					elseif($segments[$count-1] == 'about'){
						$channel = 'audiogallery-btn-black-line-noborder';
						$audios = 'audiogallery-btn-black-line-noborder';
						$albums = 'audiogallery-btn-black-line-noborder';
						$discussion = 'audiogallery-btn-black-line-noborder';
						$about = 'audiogallery-btn-black-line';
					}
					else{
						$channel = 'audiogallery-btn-black-line-noborder';
						$audios = 'audiogallery-btn-black-line-noborder';
						$albums = 'audiogallery-btn-black-line-noborder';
						$discussion = 'audiogallery-btn-black-line-noborder';
						$about = 'audiogallery-btn-black-line-noborder';
					}
					$output .='
							<a href="'.base_url('audioplayer/channel/'.$channel_owner->username.'').'" class="audiogallery-btn audiogallery-btn-md '.$channel.'"><i class="fa fa-home left"></i>Home</a>
							<a href="'.base_url('audioplayer/channel/'.$channel_owner->username.'/audios').'" class="audiogallery-btn audiogallery-btn-md '.$audios.'"><i class="fa fa-video-camera left"></i>Audio Tracks ('.$num_owners_sounds.')</a>
							<a href="'.base_url('audioplayer/channel/'.$channel_owner->username.'/albums').'" class="audiogallery-btn audiogallery-btn-md '.$albums.'"><i class="fa fa-cloud left"></i>Albums</a>';
							if($allow_comments == 'yes' && $owner_settings->channel_comments == 'yes')
								$output .='<a href="'.base_url('audioplayer/channel/'.$channel_owner->username.'/discussion').'" class="audiogallery-btn audiogallery-btn-md '.$discussion.'"><i class="fa fa-comment left"></i>Discussion</a>';
							$output .='<a href="'.base_url('audioplayer/channel/'.$channel_owner->username.'/about').'" class="audiogallery-btn audiogallery-btn-md '.$about.'"><i class="fa fa-user left"></i>About</a>
					

						<a class="audiogallery-btn audiogallery-btn-md audiogallery-channel-search-padding audiostreaming-search-channel">
						<form class="navbar-form audiogallery-channel-widget-search" method="get" action="'.base_url('audioplayer/search').'" >
							<input class="form-full input-md" type="text" value="" placeholder="Search Audio..." name="keyword" id="wid-search">
							<input type="submit" value="" name="email" id="wid-s-sub">
						</form></a>


						<div class="post-meta gallerylocation1"><!--<span>Galway, Ireland</span>--></div></div>
					</div>
				</div>
			</section>
			
			
			';
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
									$.get("'.base_url().'audioplayer/ajax/toggle_follow/'.$user->id.'/'.$channel_owner->id.'", function(data){
										data = $.parseJSON(data);
										if(data.class == \'btn-color-line\' && $this.hasClass(\'btn-color-line\')){
											$this.removeClass(data.class);
											$this.hide().empty().text(data.text).addClass(data.activeclass).fadeIn(\'fast\');
										}
										else{
											$this.removeClass(data.activeclass);
											$this.hide().empty().text(data.text).addClass(data.class).fadeIn(\'fast\');
										}
									});
								}, 500);
							}
							else
								window.location.replace("'.base_url('audioplayer/login').'");
							e.preventDefault();
						});
					});
			</script>';
		}

		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'audioplayer-channel-profile-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output;
    }
}
?>