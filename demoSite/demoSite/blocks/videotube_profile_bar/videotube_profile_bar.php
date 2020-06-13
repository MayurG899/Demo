<?php
class Videotube_profile_bar_block_handler extends  block_handler{
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
		$active_user = &$active_controller->user;
        $CI = & get_instance();
        $CI->load->module('videotube');
		
		$user = $CI->user->where('id',$CI->user->id)->get();
		$num_followers = $CI->videotubefollow->where('following_id',$CI->user->id)->count();
		$followers = $CI->videotubefollow->where('follower_id',$CI->user->id)->get();
		$followings =$CI->videotubefollow->where('follower_id',$CI->user->id)->get();
		$num_videos = $CI->videotubemedia->where('user_id',$CI->user->id)->count();
		$num_albums = $CI->videotubealbum->where('user_id',$CI->user->id)->count();
		$num_tags = $CI->BuilderEngine->get_option('videotube_num_tags_displayed');
		$show_tags = $CI->BuilderEngine->get_option('videotube_show_tags');
		$videos = $CI->videotubemedia->where('user_id',$CI->user->id)->get();
		$albums = $CI->videotubealbum->where('user_id',$CI->user->id)->get();
		$likes = $CI->videotubelike->where('user_id',$CI->user->id)->get();
		
		if($owner_settings->background_img){
			$class = '';
			$rule = 'background-image:url('.$owner_settings->background_img.');background-size: 100% 100%;background-repeat: no-repeat;'; 
		}
		else{
			$class = 'dark-bg';
			$rule ='';
		}
		
		//View
		$output = '<section class="'.$class.'  galleryprofileheight1" style="<'.$rule.'">';
				 
			$output .='<div class="container">
				
				<div class="post-author">
					<div class="post-author-img pull-left"class="post-author-details pull-left">
						<a href="<'.base_url('videotube/channel/'.$channel_owner->username.'').'"><img alt="author" src="'.$channel_owner->avatar.'"></a>
					</div>
					<div class="post-author-details pull-left" style="background:#000;opacity:0.7;color:#fff !important;border-radius:5px;padding:5px;">
						<a href="'.base_url('videotube/channel/'.$channel_owner->username.'').'"><h4 style="color:#fff;margin-bottom:3px;line-height:20px;">'.$channel_owner->first_name.' '.$channel_owner->last_name.'</h4></a>
						<div class="post-meta"><span> '.($followers == 1)?$followers.' Follower':$followers.' Followers'.'</span></div>
						<div class="post-meta"><span>'.($num_owners_videos ==1)?$num_owners_videos.' Video':$num_owners_videos.' Videos'.'</span></div>
					</div>
				</div>';
				if($followed=='yes'){
					$class = 'btn-danger';
					$text ='Following';
				}
				else
				{
					$class = 'btn-color-line';
					$text ='Follow';
				}		
				$output .='<div class="pull-right">
				<a id="follow2" href="#" class="btn btn-md '.$class.' '.($active_user->get_id() == $channel_owner->id)?'disabled':''.'" style="background:#000;opacity:0.7;"><i class="fa fa-user left"></i>'.$text.'</a>
				<div class="post-meta gallerylocation1"><!--<span>Galway, Ireland</span></div>-->
				</div>
			</div>
		</section>';

        return $output;
    }
}
?>