<?php
class Videotube_search_block_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "VideoTube";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Photos Search Block";
        $info['block_icon'] = "fa-envelope-o public";

        return $info;
    }
    public function generate_admin()
    {
		$this->show_placeholder();
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
		$this->load_generic_styles();
		$single_element = '';
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);

		$num_albums = $CI->videotubealbum->where('user_id',$user->id)->count();
		$num_tags = $CI->BuilderEngine->get_option('videotube_num_tags_displayed');
		$show_tags = $CI->BuilderEngine->get_option('videotube_show_tags');
		$gallery_option = $CI->BuilderEngine->get_option('videotube_option');

		$video = new VideoTubeMedia();
		$video = $video->where('id',$segments[$count-1])->get();

		$author = new User();
		$author = $author->where('id',$video->user_id)->get();
		$author_albums = $CI->videotubealbum->where('user_id',$author->id)->get();
		
			$output ='';
							if($gallery_option != 'open'){                     
							    $output .='
								<div id="videotube-search-form-container-'.$this->block->get_id().'">
								<!--<div class="videotube-sidebar-widget">
								<button class="btn btn-md btn-black-line"><i class="fa fa-exclamation-triangle fa-lg"></i> Report sound</button>
								</div>-->';
							}
							$output .='<div class="videotube-sidebar-widget">
								 <p class="videotube-sidebar-widget-search-margin">Search</p>
								<div class="video-channel-widget-search">
									<form class="navbar-form video-channel-widget-search video-channel-widget-search-padding-sidebar" method="get" action="'.base_url('videotube/search').'" >
										<input class="form-full input-lg" type="text" value="" placeholder="Search Here" name="keyword" id="wid-search">
										<input type="submit" value="" id="wid-s-sub">
									</form>
								</div>
							</div>';
							
                    $output .='</div>';

        if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
				$menu ='with_settings_global';
			else
				$menu ='with_settings';
			if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
				return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'videotube-search-form-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
			else
        return $output;
    }
}
?>