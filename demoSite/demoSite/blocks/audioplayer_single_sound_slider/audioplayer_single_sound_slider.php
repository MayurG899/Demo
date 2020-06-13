<?php
class Audioplayer_single_sound_slider_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Audio Player";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Sound Slider";
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
		$id = $segments[$count-1];
        $vid = new AudioPlayerMedia();
		$vid = $vid->where('id',$id)->get();
		$author = new User();
		$author = $author->where('id',$vid->user_id)->get();
		
		$output ='       
		<hr />
        <!-- Work Next Prev Bar -->
                <div class="item-nav">';	
						$user_galleries = array();
						$galleries = new User();
						foreach($galleries->get() as $gallery){
							$sound_user = new AudioPlayerUserSettings();
							$sound_user = $sound_user->where('user_id',$gallery->id)->get();
							if($author->id != $gallery->id && $gallery->id == $sound_user->user_id){
								array_push($user_galleries,$gallery->username);
							}
						}
						$usr = (!empty($user_galleries))?base_url('audioplayer/channel/'.$user_galleries[0].''):base_url('audioplayer/channel/'.$author->username.'');
                    $output .='<a class="item-prev" href="'.$usr.'">
                        <div class="prev-btn"><i class="fa fa-angle-left"></i></div>
                        <div class="item-prev-text xs-hidden">
                            <h6>Previous Profile</h6>
                        </div>
                    </a>
                    <a href="'.base_url('audioplayer/channel/'.$author->username.'').'" class="item-all-view">
                        <h4>'.$author->first_name.' '.$author->last_name.' Member Profile</h4>
                    </a>';
					$usr= (!empty($user_galleries))?base_url('audioplayer/channel/'.end($user_galleries).''):base_url('audioplayer/channel/'.$author->username.'');
                    $output .='<a class="item-next" href="'.$usr.'">
                        <div class="next-btn"><i class="fa fa-angle-right"></i></div>
                        <div class="item-next-text xs-hidden">
                            <h6>Next Member Profile</h6>
                        </div>
                    </a>
                </div>
        <!-- End Work Next Prev Bar -->
        <!-- End CONTENT ------------------------------------------------------------------------------>';

        return $output;
    }
}
?>