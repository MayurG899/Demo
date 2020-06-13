<?php
class Videotube_myfeed_content_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "VideoTube";
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
        $CI->load->module('videotube');
		$followings =$CI->videotubefollow->where('follower_id',$user->id)->get();
		//View
        $output ='
			<div class="clearfix"></div>
			  <div class="videotube-comment-post-comment">
				<h4>Followers Newsfeed <span class="videotube-comment-comment-numb"></span></h4>
				<ul class="videotube-comment-comment-list videotube-comment-comment-list-myfeed mt-30">';
				foreach($followings as $following){
					$last_videos = new VideoTubeMedia();
					$last_videos =$last_videos->where('user_id',$following->following_id)->order_by('time_created','desc')->get();
					foreach($last_videos as $last_video){
						$video_author = new User($last_video->user_id);
						$video_album = new VideoTubeAlbum($last_video->album_id);
						if($video_album->status != 'private'){
						$output .='	<li>
								<div class="videotube-comment-comment-avatar videotube-myfeed-avatar">
									<a href="'.base_url('videotube/channel/'.$video_author->username.'').'"><img src="'.checkImagePath($video_author->avatar).'"></a>
								</div>
								<div class="panel videotube-header-dark">
									<div class="panel-body videotube-panel-body-white">
								<div class="">
									<div class="videotube-comment-comment-detail">
									   <span class="post-meta pull-right">Uploaded a New Video</span> <a href="'.base_url('videotube/channel/'.$video_author->username.'').'"><h6>'.$video_author->first_name.' '.$video_author->last_name.'</h6></a>
										<div class="post-meta"><span class="videotube-comment-font-italic">'.date('M d,Y',$last_video->time_created).'</span></div>
										<p class="videotube-comment-desc">'.stripslashes(ChEditorFix($last_video->description)).'</p>
										<div class="videotube-widget-post-media">
											<a href="'.base_url('videotube/video/'.$last_video->id.'').'">';
												if($video->type == 'file'){
													$output .='
													<video id="mediaplayervideo'.$video->id.$this->block->get_id().'" src="'.checkImagePath($video->file).'" class="img-responsive videotube-video-thumbnails-height-featured" controls>
														<source src="'.checkImagePath($video->file).'" type="video/mp4">
														<source src="'.checkImagePath($video->file).'" type="video/ogg">
														Your browser does not support HTML5 video.
													</video>';
												}
												if($video->type == 'youtube'){
													$output .='
													<video id="mediaplayervideo'.$video->id.$this->block->get_id().'" src="'.checkImagePath($video->file).'" class="img-responsive videotube-video-thumbnails-height-featured" controls>
														<source type="video/youtube" src="'.$video->file.'" />
													</video>';
												}
												if($video->type == 'vimeo'){
													$output .='<iframe src="https://player.vimeo.com/video/'.$video->file.'" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
												}
												$output .='
												<script>
													$(document).ready(function() {
														$("#mediaplayervideo'.$last_video->id.$this->block->get_id().'").mediaelementplayer({
															success: function(mediaElement, originalNode, instance) {
																//instance.load();
															}
														});
														$("#mediaplayervideo'.$last_video->id.$this->block->get_id().'").bind("contextmenu",function(){
															return false;
														});
														//$(".mejs__controls").append("<div class=\"mejs_button mejs__download\"><a role=\"button\" href=\"checkImagePath($sound->file)\" download><i class=\"fa fa-download\"></i></a></div>");
													});
												</script>
											</a>
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