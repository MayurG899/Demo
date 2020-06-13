<?php
class Audioplayer_album_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Audio Player";
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
        $CI->load->module('audioplayer');

		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		$username = $segments[$count-3];
		$album_id = $segments[$count-1];
		$owner = new User();
		$channel_owner = $owner->where('username',$username)->get();	
		$albums = $CI->audioplayeralbum->where('user_id',$channel_owner->id)->get();
		$sounds = $CI->audioplayermedia->where('album_id',$album_id)->get();
		$alb = $CI->audioplayeralbum->where('id',$album_id)->get();
		
		//View
        $output ='       
		<!-- Work Detail Section -->
        <section class="">
            <div class="container">
                <!-- work Filter -->
                <div class="row audiogallery-category-albums-thumbnail-container">
                    <ul class="container-filter categories-filter">
							<!--<li><a class="categories btn btn-colors btn-sm active" data-filter="*">All Albums</a>--></li>';				
							foreach($albums as $album){
								if($user->get_id() == $album->user_id){
									$output .='<li><a class="categories btn btn-colors btn-sm" data-filter=".'.$album->name.'">'.str_replace('_',' ',$album->name).'</a></li>';
								}
								else{
									if($album->status != 'private'){
										$output .='<li><a class="categories btn btn-colors btn-sm" data-filter=".'.$album->name.'">'.str_replace('_',' ',$album->name).'</a></li>';
									}
									else{
										$output .='<li><a class="categories btn btn-colors btn-sm" data-filter=".'.str_replace('_',' ',$album->name).'">Private album</a></li>';
									}
								}
							}
            $output .='</ul>
                </div>
                <!-- End work Filter -->
                <div class="container-masonry nf-col-3" style="">';
					foreach($sounds as $sound){
					 $album = new AudioPlayerAlbum($sound->album_id);
					    if($album->status != 'private' || ($album->status == 'private' && $user->get_id() == $album->user_id)){
							$output .='<div class="nf-item '.$album->name.' audiogallery-galleryboxspace">
							<div class="audiogallery-item-box">
								<a href="'.base_url('audioplayer/sound/'.$sound->id.'').'">
									<img alt="" src="'.checkImagePath($sound->cover).'" class="item-container">
									<div class="audiogallery-item-mask">
									</div>
								</a>
										<div class="audiogallery-channel-wall-caption">
											<h6 class="white">'.str_replace('_',' ',$sound->title).'</h6>
											<p class="white">'.$channel_owner->first_name.' '.$channel_owner->last_name.'</p>
										</div>
									<audio id="mediaplayer-'.$sound->id.$this->block->get_id().'" src="'.checkImagePath($sound->file) .'" controls preload="none" style="width:100%;">
									    <source src="'.checkImagePath($sound->file) .'" type="audio/mpeg" />
										Your browser does not support the audio element.
									</audio>
									<script>
										$(document).ready(function() {
											$("#mediaplayer-'.$sound->id.$this->block->get_id().'").mediaelementplayer({
												success: function(mediaElement, originalNode, instance) {
													instance.load();
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
            $output .='</div>
            </div>
        </section>
        <!-- End Work Detail Section -->';

        return $output;
    }
}
?>