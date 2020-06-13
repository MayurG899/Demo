<?php
class photogallery_channel_profile_bar_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Photo Gallery";
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
			}elseif($segments[$count-2] == 'photogallery' && $segments[$count-1] == 'photo'){
				$vid = new PhotoGalleryMedia($count);
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
		$settings = new PhotoGalleryUserSettings();
		$owner_settings = $settings->where('user_id',$channel_owner->id)->get();
		$followers = $CI->photogalleryfollow->where('following_id',$channel_owner->id)->count();
		$num_owners_photos = $CI->photogallerymedia->where('user_id',$channel_owner->id)->count();
		$gallery_option = $CI->BuilderEngine->get_option('photogallery_option');
		$follow = new PhotoGalleryFollow();
		$followed = $follow->where('following_id',$channel_owner->id)->where('follower_id',$user->get_id())->count();
		$followed = ($followed != 0)?'yes':'no';
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
			$class = 'photogallery-dark-bg';
			$rule ='';
		}
		if($gallery_option == 'open'){
			$output ='
			<section id="photo-channel-profile-container-'.$this->block->get_id().'" class="'.$class.'  photogalleryprofileheight1" style="'.$rule.''.$css.'">
				<div class="photogallery-channel-main-box container photogallery-row-nocontainer-2">	
					<div class="photogallery-post-author-channel">
						<div class="photogallery-post-author-img photogallery-channel-avatar-img pull-left">
							<a href="'.base_url('photogallery/channel/'.$channel_owner->username.'').'"><img alt="author" src="'.$channel_owner->avatar.'"></a>
						</div>
						<div class="photogallery-post-author-details photogallery-postsingledetails pull-left">
							<a href="'.base_url('photogallery/channel/'.$channel_owner->username.'').'"><h4>'.$channel_owner->first_name.' '.$channel_owner->last_name.'</h4></a>';
							$followers = ($followers == 1)?$followers.' Follower':$followers.' Followers';
							$num_owners_photos = ($num_owners_photos ==1)?$num_owners_photos.'':$num_owners_photos.'';
							$output .='<div class="post-meta"><span> '.$followers.'</span></div>
						</div>
					</div>';
					if($followed=='yes'){
							$class = 'photogallery-btn-white-follow';
							$text ='Following';
					}
					else{
						$class = 'photogallery-btn-white-follow';
						$text ='Follow';
					}		
					$output .='<div class="pull-right">';
					$foll = ($user->get_id() == $channel_owner->id)?'disabled':'';
					$output .='<a id="follow2" href="#" class="photogallery-btn photogallery-btn-md '.$class.' '.$foll.'"><i class="fa fa-user left"></i>'.$text.'</a>
					<!--<div class="post-meta gallerylocation1"><span>Galway, Ireland</span></div>-->
					</div>
				</div>
			</section>
			
			<section class="photogallery-channel-bg photogallery-channel-bar-width-container">
			<div class="container photogallery-channelmenu-container photogallery-row-nocontainer-2">
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="photogallery-channel-home-options">';
					if($segments[$count-1] == $channel_owner->username || $segments[$count-1] == 'channel'){
						$channel = 'photogallery-btn-black-line';
						$photos = 'photogallery-btn-black-line-noborder';
						$albums = 'photogallery-btn-black-line-noborder';
						$discussion = 'photogallery-btn-black-line-noborder';
						$about = 'photogallery-btn-black-line-noborder';
					}
					elseif($segments[$count-1] == 'photos'){
						$channel = 'photogallery-btn-black-line-noborder';
						$photos = 'photogallery-btn-black-line';
						$albums = 'photogallery-btn-black-line-noborder';
						$discussion = 'photogallery-btn-black-line-noborder';
						$about = 'photogallery-btn-black-line-noborder';
					}
					elseif($segments[$count-1] == 'albums'){
						$channel = 'photogallery-btn-black-line-noborder';
						$photos = 'photogallery-btn-black-line-noborder';
						$albums = 'photogallery-btn-black-line';
						$discussion = 'photogallery-btn-black-line-noborder';
						$about = 'photogallery-btn-black-line-noborder';
					}
					elseif($segments[$count-1] == 'discussion'){
						$channel = 'photogallery-btn-black-line-noborder';
						$photos = 'photogallery-btn-black-line-noborder';
						$albums = 'photogallery-btn-black-line-noborder';
						$discussion = 'photogallery-btn-black-line';
						$about = 'photogallery-btn-black-line-noborder';
					}
					elseif($segments[$count-1] == 'about'){
						$channel = 'photogallery-btn-black-line-noborder';
						$photos = 'photogallery-btn-black-line-noborder';
						$albums = 'photogallery-btn-black-line-noborder';
						$discussion = 'photogallery-btn-black-line-noborder';
						$about = 'photogallery-btn-black-line';
					}
					else{
						$channel = 'photogallery-btn-black-line-noborder';
						$photos = 'photogallery-btn-black-line-noborder';
						$albums = 'photogallery-btn-black-line-noborder';
						$discussion = 'photogallery-btn-black-line-noborder';
						$about = 'photogallery-btn-black-line-noborder';
					}
					$output .='
							<a href="'.base_url('photogallery/channel/'.$channel_owner->username.'').'" class="photogallery-btn photogallery-btn-md '.$channel.'"><i class="fa fa-home left"></i>Home</a>
							<a href="'.base_url('photogallery/channel/'.$channel_owner->username.'/photos').'" class="photogallery-btn photogallery-btn-md '.$photos.'"><i class="fa fa-video-camera left"></i>Photos ('.$num_owners_photos.')</a>
							<a href="'.base_url('photogallery/channel/'.$channel_owner->username.'/albums').'" class="photogallery-btn photogallery-btn-md '.$albums.'"><i class="fa fa-cloud left"></i>Albums</a>
							<a href="'.base_url('photogallery/channel/'.$channel_owner->username.'/discussion').'" class="photogallery-btn photogallery-btn-md '.$discussion.'"><i class="fa fa-comment left"></i>Discussion</a>
							<a href="'.base_url('photogallery/channel/'.$channel_owner->username.'/about').'" class="photogallery-btn photogallery-btn-md '.$about.'"><i class="fa fa-user left"></i>About</a>
					

						<a class="photogallery-btn photogallery-btn-md photogallery-channel-search-padding photogalleries-search-profilebar"><form class="navbar-form photogallery-channel-widget-search" method="get" action="'.base_url('photogallery/search').'" >
							<input class="form-full input-md" type="text" value="" placeholder="Search Photos..." name="keyword" id="wid-search">
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
									$.get("'.base_url().'photogallery/ajax/toggle_follow/'.$user->id.'/'.$channel_owner->id.'", function(data){
										data = $.parseJSON(data);
										if(data.class == \'photogallery-btn-color-line\' && $this.hasClass(\'photogallery-btn-color-line\')){
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
								window.location.replace("'.base_url('photogallery/login').'");
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
			return $output.$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'photo-channel-profile-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output.$this->apply_custom_css();
    }
}
?>