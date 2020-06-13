<?php
class Audioplayer_track_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Audio Player";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Audio Track";
        $info['block_icon'] = "fa-envelope-o public";

        return $info;
    }
    public function generate_admin()
    {
		$curr_track_id = $this->block->data('track');
		$available_tracks = array();
		$all_tracks = new AudioPlayerMedia();
		foreach($all_tracks->where('status','public')->get() as $key => $value){
			$available_tracks[$value->id] = stripslashes(str_replace('_',' ',$value->title));
		}
		$this->admin_select('track', $available_tracks, 'Audio Tracks: ', $curr_track_id);
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
        $CI = & get_instance();
        $CI->load->module('audioplayer');
		$this->load_generic_styles();
		$curr_track_id = $this->block->data('track');
		if(empty($curr_track_id))
			$curr_track_id = 1;
		$sound = new AudioPlayerMedia($curr_track_id);
		$sounds = $CI->audioplayermedia->where('album_id',$sound->album_id)->get();
		$single_element = '';
		//View
        $output ='
		<section id="audioplayer-track-'.$this->block->get_id().'" class="audiogalleryimageview">
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
								if(is_numeric($curr_track_id)){
									$output .='
									<img src="'.$sound->cover .'" class="img-responsive" style="width:100%" alt="'.ChEditorfix($sound->description).'" />
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

		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'audioplayer-track-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output;
    }
}
?>