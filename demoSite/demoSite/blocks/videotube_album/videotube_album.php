<?php
class Videotube_album_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "VideoTube";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Album Content";
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
		$username = $segments[$count-3];
		$album_id = $segments[$count-1];
		$owner = new User();
		$channel_owner = $owner->where('username',$username)->get();	
		$album = $CI->videotubealbum->where('user_id',$channel_owner->id)->where('id',$album_id)->get();
		$videos = $CI->videotubemedia->where('album_id',$album->id)->get();
		
		//View
        $output ='       
		<!-- Work Detail Section -->
        <section class="ptb">
            <div class="">
                <!-- work Filter -->
                <div class="row videotube-category-albums-thumbnail-container">
                    <ul class="container-filter categories-filter">
						<!--<li><a class="categories btn btn-colors btn-sm active" data-filter="*">All Albums</a>--></li>';				
						if($user->get_id() == $album->user_id){
							$private = '';
							if($album->status == 'private')
								$private = '(Private)';
							$output .='<li><a class="categories btn btn-colors btn-sm" data-filter=".'.$album->name.'">'.str_replace('_',' ',$album->name).' '.$private.'</a></li>';
						}
						else{
							if($album->status != 'private')
								$output .='<li><a class="categories btn btn-colors btn-sm" data-filter=".'.$album->name.'">'.str_replace('_',' ',$album->name).'</a></li>';
						}
            $output .='</ul>
                </div>
                <!-- End work Filter -->
                <div class="container-masonry nf-col-4" style="">';
					foreach($videos as $video){
						$num_video_views = $CI->visits->where('page','videotube/video/'.$video->id.'')->count();
						$album = new VideoTubeAlbum($video->album_id);
					    if($album->status != 'private' || ($album->status == 'private' && $user->get_id() == $album->user_id)){
							$output .='<div class="nf-item '.$album->name.' galleryboxspace" style="padding-left:3px;padding-bottom:2px;">
							<div class="videotube-video-item-box videotube-video-item-box-90 videochannels-play-button-hide">
								<a href="'.base_url('videotube/video/'.$video->id.'').'">';
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
									<div class="videotube-video-item-mask">
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
            $output .='</div>
            </div>
        </section>
        <!-- End Work Detail Section -->';

        return $output;
    }
}
?>