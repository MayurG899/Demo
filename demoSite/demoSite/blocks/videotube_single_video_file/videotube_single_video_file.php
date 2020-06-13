<?php
class Videotube_single_video_file_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "VideoTube";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Video File";
        $info['block_icon'] = "fa-envelope-o public";

        return $info;
    }
    public function generate_admin()
    {
		$curr_video_id = $this->block->data('video');
		$available_videos = array();
		$all_videos = new VideoTubeMedia();
		foreach($all_videos->where('status','public')->get() as $key => $value){
			$available_videos[$value->id] = stripslashes(str_replace('_',' ',$value->title));
		}
		$this->admin_select('video', $available_videos, 'Videos: ', $curr_video_id);
    }
    public function generate_style()
    {
    }
    public function generate_content()
    {
		//Controller		
        $CI = & get_instance();
        $CI->load->module('videotube');
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$this->load_generic_styles();
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		$curr_video_id = $this->block->data('video');
		if(strpos($segments[$count-1],'.html') !== FALSE || $CI->uri->total_segments() == 0 || strpos($_SERVER['REQUEST_URI_PATH'],'/layout_system/ajax/') !== FALSE){
			if(empty($curr_video_id))
				$curr_video_id = 1;
		}else{
			$curr_video_id = $segments[$count-1];
		}
		$video = new VideoTubeMedia($curr_video_id);
		$single_element = '';
		//View
        $output ='
		<div id="videotube-singlevideo-container-'.$this->block->get_id().'">
			<div class="">';
				if(is_numeric($curr_video_id)){
					$output .='				
					<div class=""> 
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
						</div>
					</div>';
				}
				else{
					$output .='
					<div class="">
						<img src="'.base_url('builderengine/public/img/video_placeholder.png').'" class="img-responsive" style="width:100%" alt="" />
					</div>';					
				}
				$output .='
			</div>
		</div>';
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'videotube-singlevideo-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output;
    }
}
?>