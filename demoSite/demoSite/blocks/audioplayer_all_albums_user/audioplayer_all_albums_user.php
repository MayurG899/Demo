<?php
class Audioplayer_all_albums_user_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Audio Player";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "All Albums User Channel";
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
		$username = $segments[$count-2];
		$owner = new User();
		$channel_owner = $owner->where('username',$username)->get();	
		$albums = $CI->audioplayeralbum->where('user_id',$channel_owner->id)->get();
		$audios = $CI->audioplayermedia->where('user_id',$channel_owner->id)->get();
		//View
        $output ='
			<div class="row">
				<div class="audioplayer-container">';
				foreach($albums as $album){
					if($album->status != 'private'){
						$output .='	
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 audiogallery-recent-paddings">
							<div class="audiogallery-item-box">
								<div class="audiogallery-allvideos-outline">
								<a href="'.base_url('audioplayer/channel/'.$channel_owner->username.'/album/'.$album->id).'">';
									$audios = new AudioPlayerMedia();
									$audios = $audios->where('album_id',$album->id)->get();
									$i = 1;
									foreach($audios as $audio){
										if($i == 1){
											$audio = $audio;
										}
										$i++;
									}
									$output .=' 
									<img src="'.checkImagePath($audio->cover).'" alt="'.$audio->description.'" >
									<div class="audiogallery-item-mask audiogallery-item-mask-albums">
										<div class="audiogallery-item-caption">
											<h4 class="white">View Tracks</h4>
										</div>
									</div>
									<div class="audiogallery-allvideos-box module-colors module-colors-bg">
										<p><span class="audiogallery-text-dark">'.str_replace('_',' ',$album->name).'</span></p>
										<p class="audiogallery-text-gray"><span>By: '.$channel_owner->first_name.' '.$channel_owner->last_name.'</span></p>
									</div>
								</a>
								</div>
							</div>
						</div>';
					}
				}
		$output .='</div>
				</div>';

        return $output;
    }
}
?>