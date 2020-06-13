<?php
class Cp_user_profile_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Account Dashboard";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Account Dashboard User Profile";
        $info['block_icon'] = "fa-envelope-o";

        return $info;
    }

    public function generate_admin()
    {
		$this->show_placeholder();
    }

    public function generate_content()
    {
		//Controller
		global $active_controller;
		$user = &$active_controller->user;
		$active_user = new User($user->get_id());
        $CI = & get_instance();
		$this->load_generic_styles();
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		$user_profile_id = $segments[$count-1];
		$user_profile = new User($user_profile_id);
		if(!$user_profile->exists())
			show_404();
			//redirect(base_url('cp/info?error=profile_unavailable'),'location');
		
		
        $CI->load->module('videotube');
		$user_profile_id = $this->block->data('user_profile_id');
		if(!isset($user_profile_id) || $user_profile_id == '')
			$user_profile_id = 13;
		if(strpos($segments[$count-1],'.html') !== FALSE || strpos($_SERVER['REQUEST_URI_PATH'],'/layout_system/ajax/') !== FALSE){
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
		$forum_posts = new Forum_thread();
		$forum_posts = $forum_posts->where('user_id',$user_profile->id)->count();
		$blog_posts = new Post();
		$blog_posts = $blog_posts->where('user_id',$user_profile->id)->count();
		$blog_comments = new Comment();
		$blog_comments = $blog_comments->where('user_id',$user_profile->id)->count();
		$views = $CI->visits->where('page','cp/user/'.$user_profile->id)->count();
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
			$rule ='background-image:url('.$owner_settings->background_img.');background:#707070;';
		}
		//View
        $output ='			
		<!-- begin #content -->
	<div class="beaccount-dashboard be-uaccount-profile-pad">
			<!-- begin #content --> 
			<div class="row">
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 beaccount-main-page animated fadeIn">
				<div id="account_infopage">
					<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<section id="videotube-channel-profile-container-'.$this->block->get_id().'" class="'.$class.'  beaccount-channel-banner" style="'.$rule.''.$css.'">
						</section>
						<div class="cover-photo">
							<a class="example-image-link" href="'.(''.$user_profile->avatar.'').'" data-lightbox="example-1"><img src="'.$user_profile->avatar.'" class="profile-photo img-thumbnail"></a>
							<div class="cover-name">'.$user_profile->first_name. ' '.$user_profile->last_name.'</div>
						</div> 
						<div class="beaccount-userprofile-profile-menu">
							<div class="panel-options">
								<div class="navbar navbar-default navbar-userprofile-profile-menu">
								<div class="">

						<div class="be-uaccount-profile-menu-links" id="navbar-userprofile-profile-menu">
							<ul class="nav navbar-nav be-uaccount-profile-navbar-margin">
								<li class="active"><a href="'.base_url('cp/user/'.$user_profile->id.'').'"><i class="fa fa-user"></i>Profile</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
        </div>
						
						</div>
					</div>
				<div class="row">
					<div class="">
						<div class="">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="panel-body beaccount-profile-body">
							
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 beaccount-profile-col-left">
								<div class="panel panel-weblist-white"> 
									<div class="panel-weblist-white-inner beaccount-weblist-body-shadow"> 
										<div class="panel-body panel-weblist-white beaccount-userprofile-profile-info">
											<p><b>Name:</b> '.ucfirst($user_profile->first_name). ' '.ucfirst($user_profile->last_name).'</p>';
											$label = 'success';
											$icon = 'user';
											if($user_profile->level == 'Administrator'){
												$label = 'danger';
												$icon = 'cog fa-spin';
											}
											$output .='
											<p><b>Role:</b> <small><span class="label label-'.$label.'"><i class="fa fa-'.$icon.'"></i> '.$user_profile->level.'</span></small></p>';
											if($user_profile->extended->get()->company != '')
												$output .='<p><b>Company:</b> '.$user_profile->extended->get()->company.'</p>';
											$output .='
											<p><b>Joined:</b> '.date('d/m/Y',$user_profile->date_registered).'</p>
											<p><b>Country:</b> '.$user_profile->extended->get()->country.'</p>
											<p><b>Profile Views:</b> '.$views.'</p>
										</div>
									</div>
								</div>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 beaccount-profile-col-right">
								<div class="panel panel-weblist-white"> 
									<div class="panel-weblist-white-inner beaccount-weblist-body-shadow"> 
										<div class="panel-body panel-weblist-white">
										
					<div class="">
						<div class="panel-heading">
							<div class="panel-heading-btn">
							</div>
							
							
							
						</div>
						<div class="panel-body beaccount-domain-infoguide">

						</div>
					</div>
							<!-- end panel -->
										
										</div>
									</div>
								</div>
							</div>
							</div>
						</div>
						</div>
					</div>
					</div>
				
				</div>	
			</div>
			<!-- end col-10 -->

	</div>
</div>
			<!-- end #content -->	
		';
		if(!$user->is_guest())
			return $output;
    }
}
?>