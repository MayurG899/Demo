<?php
class Audioplayer_single_sound_profile_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Audio Player";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Sound Profile";
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
        $CI->load->module('audioplayer');
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		$vid = new AudioPlayerMedia($segments[$count-1]);
		$lik = $vid->likes->get();
		$unl = $vid->likes->get();
		$author = new User($vid->user_id);
		$username = $author->username;

		$owner = new User();
		$channel_owner = $owner->where('username',$username)->get();
		$settings = new AudioPlayerUserSettings();
		$owner_settings = $settings->where('user_id',$channel_owner->id)->get();
		$followers = $CI->audioplayerfollow->where('following_id',$channel_owner->id)->count();
		$num_owners_sounds = $CI->audioplayermedia->where('user_id',$channel_owner->id)->count();
		$gallery_option = $CI->BuilderEngine->get_option('audioplayer_option');
		$num_authors_sounds = $CI->audioplayermedia->where('user_id',$author->id)->count();
		$follow = new AudioPlayerFollow();
		$followed = $follow->where('following_id',$channel_owner->id)->where('follower_id',$user->get_id())->count();
		$followers = $CI->audioplayerfollow->where('following_id',$author->id)->count();
		$followed = ($followed != 0)?'yes':'no';
		$num_sound_views = $CI->visits->where('page','audioplayer/sound/'.$segments[$count-1].'')->count();
		$likes = $lik->where('status','like')->count();
		$unlikes = $unl->where('status','unlike')->count();
			if($followed=='yes'){
				$class = 'btn-white';
				$text ='Following';
			}else{
				$class = 'btn-white';
				$text ='Follow';
			}		

		$output ='';
		
		if($gallery_option == 'open'){
			$output .='
					<div class="container">
					<div class="audiogallery-post-author">
						<div class="audiogallery-post-author-img audiogallery-post-author-img-small pull-left">
							<a href="'.base_url('audioplayer/channel/'.$author->username.'').'"><img alt="author" src="'.$author->avatar.'"></a>
						</div>
						<div class="audiogallery-post-author-details pull-left">
							<a href="'.base_url('audioplayer/channel/'.$author->username.'').'"><h4>'.$author->first_name.' '.$author->last_name.'</h4></a>';
							$fols = ($followers == 1)?$followers.' Follower':$followers.' Followers';
							$nums = ($num_authors_sounds ==1)?$num_authors_sounds.' Audio':$num_authors_sounds.' Audios';
							$output .='';
								$dis = ($user->get_id() == $author->id)?'disabled':'';
								$output .='<a id="follow2" href="#" class="btn btn-sm audio-follow-fullwidth '.$class.' '.$dis.'"><i class="fa fa-user left"></i>'.$text.'</a>
						</div>
						<div class="audiogallery-post-author-details pull-left">
							<div class="post-meta gallerylocation1">
								<!--<span>Galway, Ireland</span>-->
							</div>
						</div>
						<div class="audiogallery-post-author-details audiogallery-post-single-details pull-left" style="margin-left:30px;">
							<h3>'.str_replace('_',' ',$vid->title).'</h3>
						</div>
					</div>
					<div class="pull-right">
						<p class="pull-left lead"><a id="like" style="color:2493f3;"  class="text-primary" href="#"><i class="fa fa-thumbs-o-up fa-lg"></i> <span id="likes" >'.$likes.'</span></a></p>&nbsp;&nbsp;&nbsp;
						<p class="pull-right lead"><a id="unlike" style="color:ff3300;" class="text-danger " href="#"><i class="fa fa-thumbs-o-down fa-lg"></i> <span id="unlikes"> '.$unlikes.'</span></a></p>
						<br/>
						<p>
							<span>Views: <strong class="post-meta"> '.$num_sound_views.'</strong></span>
						</p>					
					</div>
				</div>';
		}

        return $output;
    }
}
?>