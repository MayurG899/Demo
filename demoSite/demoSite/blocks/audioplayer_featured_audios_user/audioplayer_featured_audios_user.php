<?php
class Audioplayer_featured_audios_user_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Audio Player";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Featured User Audios";
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

		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		$author = new User();
		$author = $author->where('username',$segments[$count-1])->get();
		$sounds = $CI->audioplayermedia->where('featured','yes')->where('user_id',$author->id)->get();
        $page_number = 1;
        if(isset($_GET['page'])){
            $page_number = $_GET['page'];
        }
        if(!$CI->BuilderEngine->get_option('audioplayer_num_medias_displayed')){
            $sounds_per_page = 6;
        }
        else
            $sounds_per_page = $CI->BuilderEngine->get_option('audioplayer_num_medias_displayed');
			
		//View
        $output ='<div class="container audioplayer-topbar-container">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<p class="audiogallery-featured-title-2">Featured</p>
			</div>
			<div class="audioplayer-featured-container">';
				foreach($sounds as $sound){
					$sound_album = new AudioPlayerAlbum($sound->album_id);
					if($sound_album->status != 'private' || ($sound_album->status == 'private' && $user->get_id() == $sound_album->user_id)){
						$output .='
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="audiogallery-item-box">
								<a href="'.base_url('audioplayer/sound/'.$sound->id.'').'">
									<img src="'.$sound->cover.'" alt="'.$sound->description.'" >
									<div class="audiogallery-item-mask">
									</div>
								</a>
								<div class="audiogallery-channel-wall-caption">
									<h6 class="white">'.str_replace('_',' ',$sound->title).'</h6>
									<p class="white">By '.$author->first_name.' '.$author->last_name.'</p>
								</div>
								<audio id="mediaplayer-'.$sound->id.$this->block->get_id().'" src="'.checkImagePath($sound->file) .'" controls preload="none" style="width:100%;">
									<source src="'.checkImagePath($sound->file) .'" type="audio/mpeg" />
									Your browser does not support the audio element.
								</audio>
								<script>
									$(document).ready(function() {
										$("#mediaplayer-'.$sound->id.$this->block->get_id().'").mediaelementplayer({
											success: function(mediaElement, originalNode, instance) {
												//instance.load();
											}
										});
										$("#mediaplayer-'.$sound->id.$this->block->get_id().'").bind("contextmenu",function(){
											return false;
										});
										//$(".mejs__controls").append("<div class=\"mejs_button mejs__download\"><a role=\"button\" href=\"checkImagePath($sound->file)\" download><i class=\"fa fa-download\"></i></a></div>");
									});
								</script>
							</div>
						</div>';
					}
				}
			$output .='
				</div>
			</div>';

        return $output;
    }
}
?>