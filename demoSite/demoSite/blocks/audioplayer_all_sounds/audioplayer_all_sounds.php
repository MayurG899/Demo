<?php
class Audioplayer_all_sounds_block_handler extends  block_handler{
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
		$sounds = $CI->audioplayermedia->get();
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
					foreach($sounds as $sound){
					    $sound_album = new AudioPlayerAlbum($sound->album_id);
						if($sound_album->status != 'private' || ($sound_album->status == 'private' && $user->get_id() == $sound_album->user_id)){
							$output .='<div class="nf-item '.str_replace('_',' ',$sound_album->name).' galleryboxspace">
							<div class="item-box">
								<a href="'.base_url('audioplayer/sound/'.$sound->id.'').'">
									<img src="'.checkImagePath($sound->cover).'" alt="'.$sound->description.'" >
									<div class="item-mask">
										<div class="item-caption">
											<h6 class="white">'.str_replace('_',' ',$sound->title).'</h6>';
											$author = new User($sound->user_id);
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