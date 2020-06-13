<?php
class Videotube_single_video_slider_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "VideoTube";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Video Slider";
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
        $CI->load->module('videotube');
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		$id = $segments[$count-1];
        $vid = new VideoTubeMedia();
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
							$video_user = new VideoTubeUserSettings();
							$video_user = $video_user->where('user_id',$gallery->id)->get();
							if($author->id != $gallery->id && $gallery->id == $video_user->user_id){
								array_push($user_galleries,$gallery->username);
							}
						}
						$usr = (!empty($user_galleries))?base_url('videotube/channel/'.$user_galleries[0].''):base_url('videotube/channel/'.$author->username.'');
                    $output .='<a class="item-prev" href="'.$usr.'">
                        <div class="prev-btn"><i class="fa fa-angle-left"></i></div>
                        <div class="item-prev-text xs-hidden">
                            <h6>Prev Gallery</h6>
                        </div>
                    </a>
                    <a href="'.base_url('videotube/channel/'.$author->username.'').'" class="item-all-view">
                        <h6>'.$author->first_name.' '.$author->last_name.' Gallery</h6>
                    </a>';
					$usr= (!empty($user_galleries))?base_url('videotube/channel/'.end($user_galleries).''):base_url('videotube/channel/'.$author->username.'');
                    $output .='<a class="item-next" href="'.$usr.'">
                        <div class="next-btn"><i class="fa fa-angle-right"></i></div>
                        <div class="item-next-text xs-hidden">
                            <h6>Next Gallery</h6>
                        </div>
                    </a>
                </div>
        <!-- End Work Next Prev Bar -->
        <!-- End CONTENT ------------------------------------------------------------------------------>';

        return $output;
    }
}
?>