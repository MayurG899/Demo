<?php
class Videotube_all_videos_thumbnails_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "VideoTube";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "All Video Thumbnails";
        $info['block_icon'] = "fa-envelope-o public";

        return $info;
    }
    public function generate_admin()
    {
		$this->show_placeholder();
    }
    public function generate_style()
    {
    }
    public function generate_content()
    {
		//Controller
		global $active_controller;
		$user = &$active_controller->user;
		$this->load_generic_styles();
		$single_element = '';
        $CI = & get_instance();
        $CI->load->module('videotube');
		$videos = $CI->videotubemedia->get();

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
				<div id="videotube-all-videos-container-'.$this->block->get_id().'">
                <div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<p class="videotube-featured-title-2">Public Videos</p>
				</div>';
					foreach($videos as $video){
						$num_video_views = $CI->visits->where('page','videotube/video/'.$video->id.'')->count();
					    $video_album = new VideoTubeAlbum($video->album_id);
						if($video_album->status != 'private' || ($video_album->status == 'private' && $user->get_id() == $video_album->user_id)){
							$output .='
							<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
								<div class="videotube-video-item-box videochannels-play-button-hide">
									<a href="'.base_url('videotube/video/'.$video->id.'').'">
										<div class="videotube-video-allvideos-outline">';
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
										</div>
									</a>
								</div>
							</div>';
						}
					}
        $output .='</div></div>';
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
				$menu ='with_settings_global';
			else
				$menu ='with_settings';
			if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
				return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'videotube-all-videos-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
			else
        return $output;
    }
}
?>