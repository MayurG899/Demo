<?php
class Audioplayer_recent_audios_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Audio Player";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Recent Audios";
        $info['block_icon'] = "fa-envelope-o public";

        return $info;
    }
    public function generate_admin()
    {
		$this->show_placeholder();
    }
	public function generate_style($active_menu = '')
	{
		
	}
	public function load_generic_styling()
	{
		
	}
    public function generate_content()
    {
		//Controller
		global $active_controller;
		$user = &$active_controller->user;
        $CI = & get_instance();
        $CI->load->module('audioplayer');
		$this->load_generic_styles();
		$sounds = $CI->audioplayermedia->order_by('time_created','desc')->get();
		$albums = $CI->audioplayer->get_albums();
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);

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
        $output ='
		<div id="audioplayer-recent-audios-'.$this->block->get_id().'">
		<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<p class="audiogallery-recent-title">Recently Uploaded</p>
				</div>
				<div class="audioplayer-container">';
		$i = 1;
		foreach($sounds as $sound){
			if($i <= 4){
				$sound_album = new AudioPlayerAlbum($sound->album_id);
				if($sound_album->status != 'private' || ($sound_album->status == 'private' && $user->get_id() == $sound_album->user_id)){
					$output .='
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 audiogallery-recent-paddings">
						<div class="audiogallery-item-box">
							<a href="'.base_url('audioplayer/sound/'.$sound->id.'').'">
								<img src="'.checkImagePath($sound->cover).'" alt="'.$sound->description.'" >
								<div class="audiogallery-item-mask">
								</div>
							</a>
							<div class="audiogallery-channel-wall-caption">
								<h6 class="white2">'.$sound->title.'</h6>';
								$author = new User($sound->user_id);
								$output .='<p class="white2">By '.$author->first_name.' '.$author->last_name.'</p>
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
			$i++;
		}
        $output .='</div>
				</div>
			</div>';

		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='global_style';
		else
			$menu ='style';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'audioplayer-recent-audios-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), $menu);
		else
			return $output;
    }
}
?>