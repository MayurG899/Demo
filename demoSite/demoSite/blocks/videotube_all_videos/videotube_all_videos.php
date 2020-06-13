<?php
class Videotube_all_videos_block_handler extends  block_handler{
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
		$videos = $CI->videotubemedia->get();
		$albums = $CI->videotube->get_albums();
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);

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
        $output ='<!-- Work Detail Section -->
                <!-- work Filter -->
                <div class="row">
                    <ul class="container-filter categories-filter">
							<li><a class="categories active" data-filter="*">All Albums</a></li>';
							foreach($albums as $album){
								if($album->status != 'private' || ($album->status == 'private' && $user->get_id() == $album->user_id)){
									$output .='<li><a class="categories" data-filter=".'.$album->name.'">'.str_replace('_',' ',$album->name).'</a></li>';
								}
							}
         $output .='</ul>
                </div>
                <!-- End work Filter -->
                <div class="container-masonry nf-col-4">';
					foreach($videos as $video){
					    $video_album = new VideoTubeAlbum($video->album_id);
						if($video_album->status != 'private' || ($video_album->status == 'private' && $user->get_id() == $video_album->user_id)){
							$output .='<div class="nf-item '.$video_album->name.' galleryboxspace">
								<div class="item-box videochannels-play-button-hide">
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
										<div class="item-mask">
											<div class="item-caption">
												<h6 class="white">'.str_replace('_',' ',$video->title).'</h6>';
													$author = new User($video->user_id);
												$output .='<p class="white">By '.$author->first_name.' '.$author->last_name.'</p>
											</div>
										</div>
									</a>
								</div>
							</div>';
						}
					}
        $output .='</div>
        <!-- End Work Detail Section -->
        <!-- End CONTENT ------------------------------------------------------------------------------>';

        return $output;
    }
}
?>