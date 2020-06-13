<?php
class Videotube_featured_videos_user_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "VideoTube";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Featured User Videos";
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
		$username = end($segments);
		$usr = new User();
		$channel_owner = $usr->where('username',$username)->get();
		$videos = $CI->videotubemedia->where('featured','yes')->where('user_id',$channel_owner->id)->get();
        $page_number = 1;
        if(isset($_GET['page'])){
            $page_number = $_GET['page'];
        }
        if(!$CI->BuilderEngine->get_option('videotube_num_medias_displayed')){
            $videos_per_page = 6;
        }
        else
            $videos_per_page = $CI->BuilderEngine->get_option('videotube_num_medias_displayed');

		//View
        $output ='
                <div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
				if($videos->exists())
					$output .='<p class="videotube-featured-title">Featured Videos</p>';
				$output .='</div>';
				$i = 1;
					foreach($videos as $video){
						$num_video_views = $CI->visits->where('page','videotube/video/'.$video->id.'')->count();
						if($i <= 4){
							$video_album = new VideoTubeAlbum($video->album_id);
							if($video_album->status != 'private' || ($video_album->status == 'private' && $user->get_id() == $video_album->user_id)){
								$output .='
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="videotube-video-item-box">';
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
														poster:"'.checkImagePath($video->file).'",
														videoWidth: "100%",
														videoHeight: "100%",
														showPosterWhenEnded: true,
														success: function(mediaElement, originalNode, instance) {
															instance.load();
														}
													});
													$("#mediaplayervideo'.$video->id.$this->block->get_id().'").bind("contextmenu",function(){
														return false;
													});
													//$(".mejs__controls").append("<div class=\"mejs_button mejs__download\"><a role=\"button\" href=\"checkImagePath($sound->file)\" download><i class=\"fa fa-download\"></i></a></div>");
												});
											</script>
										<div class="">
											<div class="videotube-video-item-caption">
											</div>
										</div>
										<div class="videotube-video-allvideos-box">
										<p><span class="videotube-video-text-dark">'.$video->title.'</span></p>
										<p class="videotube-video-text-gray"><span>'.number_format($num_video_views).' </span>Views <span> &nbsp;•&nbsp; </span> <span>Uploaded: </span>'.date('d.m.Y',$video->time_created).'</p>
										</div>
										</a>
									</div>
								</div>';
							}
						}
						$i++;
					}
        $output .='</div>';

        return $output;
    }
}
?>