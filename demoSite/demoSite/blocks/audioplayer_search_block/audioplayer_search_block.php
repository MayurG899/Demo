<?php
class Audioplayer_search_block_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Audio Player";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Audio Search Block";
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
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);

		$num_albums = $CI->audioplayeralbum->where('user_id',$user->id)->count();
		$num_tags = $CI->BuilderEngine->get_option('audioplayer_num_tags_displayed');
		$show_tags = $CI->BuilderEngine->get_option('audioplayer_show_tags');
		$gallery_option = $CI->BuilderEngine->get_option('audioplayer_option');

		$sound = new AudioPlayerMedia();
		$sound = $sound->where('id',$segments[$count-1])->get();

		$author = new User();
		$author = $author->where('id',$sound->user_id)->get();
		$author_albums = $CI->audioplayeralbum->where('user_id',$author->id)->get();
		
		$output ='<div id="audioplayer-search-block-'.$this->block->get_id().'">';
					if($gallery_option != 'open'){                     
						$output .='<!--<div class="audiogallery-sidebar-widget">
						<button class="btn btn-md btn-black-line"><i class="fa fa-exclamation-triangle fa-lg"></i> Report sound</button>
						</div>-->';
					}
					$output .='<div class="audiogallery-sidebar-widget">
						 <p class="audiogallery-sidebar-widget-search-margin">Search</p>
						<div class="audiogallery-widget-search">
							<form class="navbar-form audiogallery-channel-widget-search audiogallery-channel-widget-search-padding-sidebar" method="get" action="'.base_url('/audioplayer/search').'" >
								<input class="form-full input-lg" type="text" value="" placeholder="Search Here" name="keyword" id="wid-search">
								<input type="submit" value="" id="wid-s-sub">
							</form>
						</div>
					</div>';
		$output .='</div>';

		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='global_style';
		else
			$menu ='style';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'audioplayer-search-block-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), $menu);
		else
			return $output;
    }
}
?>