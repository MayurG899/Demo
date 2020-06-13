<?php
class Audioplayer_single_sound_file_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Audio Player";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Sound File";
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
        $CI = & get_instance();
        $CI->load->module('audioplayer');
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		$id = $segments[$count-1];
		$sound = new AudioPlayerMedia($id);
		$sounds = $CI->audioplayermedia->where('album_id',$sound->album_id)->get();
		
		//View
        $output ='
		<section class="audiogalleryimageview">
			<div class="">
				<div class="row">				
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<!--<div class="owl-carousel image-slider o-flow-hidden galleryview1">-->
							<div class="item">';
								$left = array();
								$right = array();

								foreach($sounds as $related)
								{
									if($related->id != $sound->id && $related->id != 0)
									{
										if($related->id < $sound->id)
										{
											array_push($left,$related->id);
										}
										else
											array_push($right,$related->id);
									}
								}
								if(!empty($left)){
									$output .='<a class="hackL" href="'.base_url('audioplayer/sound/'.end($left).'').'">
										<i class="fa fa-angle-left"></i>
									</a>';
								}
								if(!empty($right)){
									$output .='<a class="hackR" href="'.base_url('audioplayer/sound/'.end($right).'').'">
										<i class="fa fa-angle-right"></i>
									</a>';
								}
								if(is_numeric($id)){
									$output .='
									<img src="'.$sound->cover .'" class="img-responsive" style="width:100%" alt="'.ChEditorfix($sound->description).'" />
									<audio  id="mediaplayer-'.$this->block->get_id().'" src="'.checkImagePath($sound->file) .'" controls preload="none" style="width:100%;">
									    <source src="'.checkImagePath($sound->file) .'" type="audio/mpeg" />
										Your browser does not support the audio element.
									</audio>
									<script>
										$(document).ready(function() {
											$("#mediaplayer-'.$this->block->get_id().'").mediaelementplayer({
												success: function(mediaElement, originalNode, instance) {
													instance.load();
												}
											});
											$("#mediaplayer-'.$this->block->get_id().'").bind("contextmenu",function(){
												return false;
											});
											//$(".mejs__controls").append("<div class=\"mejs_button mejs__download\"><a role=\"button\" href=\"checkImagePath($sound->file)\" download><i class=\"fa fa-download\"></i></a></div>");
										});
									</script>
									';
								}
								else{
									$output .='<img src="'.base_url('builderengine/public/img/sound_placeholder.png') .'" class="img-responsive" style="width:100%" alt="'.ChEditorfix($sound->description).'" />';
								}
							$output .='</div>
						<!--</div>-->
					</div>
				</div>
			</div>
		</section>';

        return $output;
    }
}
?>