<?php
class Videotube_single_video_profile_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "VideoTube";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Video Profile";
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

		$video = new VideoTubeMedia($segments[$count-1]);
		$author = new User($video->user_id);

		$gallery_option = $CI->BuilderEngine->get_option('videotube_option');
		$num_video_views = $CI->visits->where('page','videotube/video/'.$video->id.'')->count();
		$likes = $video->like->where('status','like')->count();
		$unlikes = $video->like->where('status','unlike')->count();	

		$output ='';
		if($gallery_option == 'open'){
			$output .='
				<div class="">
					<div class="videotube-video-profile-mainvideo-padding-top">
						<div class="video-post-author video-post-author-nomargin-bottom">
							<div class="videotube-mainvideo-h3-left">
								<h3>'.$video->title.'</h3>
							<p class="videotube-mainvideo-views-counter"> '.number_format($num_video_views).' views
							</p>
							</div>
						</div>
						<div class="pull-right">
							<p class="pull-left lead"><a id="like"  class="text-primary" href="#"><i class="fa fa-thumbs-o-up fa-lg"></i> <span id="likes" >'.$likes.'</span></a></p>&nbsp;&nbsp;&nbsp;
							<p class="pull-right lead"><a id="unlike" class="text-danger " href="#"><i class="fa fa-thumbs-o-down fa-lg"></i> <span id="unlikes"> '.$unlikes.'</span></a></p>
						</div>
						<hr>
					</div>
				</div>';
		}
        return $output;
    }
}
?>