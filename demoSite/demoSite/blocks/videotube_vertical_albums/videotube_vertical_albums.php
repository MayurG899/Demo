<?php
class Videotube_vertical_albums_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "VideoTube";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Vertical Albums";
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
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		$username = $segments[$count-2];
		$owner = new User();
		$channel_owner = $owner->where('username',$username)->get();	
		$albums = new VideoTubeAlbum();
		$albums = $albums->where('user_id',$channel_owner->id)->get();
		//View
        $output ='
			<div class="row>';
				foreach($albums as $album){
					if($album->status != 'private'){
						$output .='	
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="item-box videochannels-play-button-hide videochannels-play-albums-hide">
								<a href="'.base_url('videotube/channel/'.$channel_owner->username.'/album/'.$album->id).'">';
								$videos = new VideoTubeMedia();
								$videos = $videos->where('album_id',$album->id)->get();
								$i = 1;
								foreach($videos as $video){
									if($i == 1){
										$video = $video;
									}
									$i++;
								}
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
											$("#mediaplayervideo'.$video->id.$this->block->get_id().'").mediaelementplayer({
												success: function(mediaElement, originalNode, instance) {
													//instance.load();
												}
											});
											$("#mediaplayervideo'.$video->id.$this->block->get_id().'").bind("contextmenu",function(){
												return false;
											});
											//$(".mejs__controls").append("<div class=\"mejs_button mejs__download\"><a role=\"button\" href=\"checkImagePath($sound->file)\" download><i class=\"fa fa-download\"></i></a></div>");
										});
									</script>
									<div class="item-mask">
										<div class="item-caption">
											<h6 class="white">'.str_replace('_',' ',$album->name).'</h6>
											<p class="white">'.$channel_owner->first_name.' '.$channel_owner->last_name.'</p>
										</div>
									</div>
								</a>
							</div>
						</div>';
					}
				}
		$output .='</div>';

        return $output;
    }
}
?>