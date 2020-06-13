<?php
class Audioplayer_myfeed_content_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Audio Player";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Myfeed Content";
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
		
		$num_followers = $CI->audioplayerfollow->where('following_id',$user->id)->count();
		$followers = $CI->audioplayerfollow->where('follower_id',$user->id)->get();
		$followings =$CI->audioplayerfollow->where('follower_id',$user->id)->get();
		$num_sounds = $CI->audioplayermedia->where('user_id',$user->id)->count();
		$num_albums = $CI->audioplayeralbum->where('user_id',$user->id)->count();
		$num_tags = $CI->BuilderEngine->get_option('audioplayer_num_tags_displayed');
		$show_tags = $CI->BuilderEngine->get_option('audioplayer_show_tags');
		$sounds = $CI->audioplayermedia->where('user_id',$user->id)->get();
		$albums = $CI->audioplayeralbum->where('user_id',$user->id)->get();	
		$likes = $CI->audioplayerlike->where('user_id',$user->id)->get();
		
		//View
        $output ='
                        <div class="clearfix"></div>
						  <div class="audiogallery-comment-post-comment">
                            <h4>Followers Newsfeed <span class="audiogallery-comment-comment-numb"></span></h4>
                            <ul class="audiogallery-comment-comment-list audiogallery-comment-comment-list-myfeed mt-30">';
							foreach($followings as $following){
								$last_sounds = new AudioPlayerMedia();
								$last_sounds =$last_sounds->where('user_id',$following->following_id)->order_by('time_created','desc')->get();
								foreach($last_sounds as $last_sound){
									$sound_author = new User($last_sound->user_id);
									$sound_album = new AudioPlayerAlbum($last_sound->album_id);
									if($sound_album->status != 'private'){
									$output .='	<li>
											<div class="audiogallery-comment-comment-avatar audiogallery-myfeed-avatar">
												<a href="'.base_url('audioplayer/channel/'.$sound_author->username.'').'"><img src="'.$sound_author->avatar.'"></a>
											</div>
											<div class="panel audiogallery-header-dark">
												<div class="panel-body audiogallery-panel-body-white">
											<div class="">
												<div class="audiogallery-comment-comment-detail">
												   <span class="post-meta pull-right">Uploaded a New Audio</span> <a href="'.base_url('audioplayer/channel/'.$sound_author->username.'').'"><h6>'.$sound_author->first_name.' '.$sound_author->last_name.'</h6></a>
													<div class="post-meta"><span class="audiogallery-comment-font-italic">'.date('M d,Y',$last_sound->time_created).'</span></div>
													<p class="audiogallery-comment-desc">'.stripslashes(ChEditorFix($last_sound->description)).'</p>
													<div class="audiogallery-widget-post-media">
														<img src="'.$last_sound->cover .'" class="img-responsive" style="width:100%" alt="'.ChEditorfix($last_sound->description).'" />
														<audio id="mediaplayer-'.$last_sound->id.$this->block->get_id().'" src="'.$last_sound->file .'" controls preload="auto" style="width:100%;">
															<source src="'.$last_sound->file .'" type="audio/mpeg"></source>
															Your browser does not support the audio element.
														</audio>
														<script>
															$(document).ready(function() {
																$("#mediaplayer-'.$last_sound->id.$this->block->get_id().'").mediaelementplayer({
																	success: function(mediaElement, originalNode, instance) {
																		//instance.load();
																	}
																});
																$("#mediaplayer-'.$last_sound->id.$this->block->get_id().'").bind("contextmenu",function(){
																	return false;
																});
																//$(".mejs__controls").append("<div class=\"mejs_button mejs__download\"><a role=\"button\" href=\"checkImagePath($sound->file)\" download><i class=\"fa fa-download\"></i></a></div>");
															});
														</script>
													</div>
												</div>
											</div>
											</div>
											</div>
										</li>';
									}
								}
							}
                        $output .='</ul>
                        </div>
					</div>';

        return $output;
    }
}
?>