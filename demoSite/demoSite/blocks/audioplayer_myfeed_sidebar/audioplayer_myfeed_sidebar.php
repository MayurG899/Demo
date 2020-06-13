<?php
class Audioplayer_myfeed_sidebar_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Audio Player";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Myfeed Sidebar";
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
		global $active_controller;
		$user = &$active_controller->user;	
        $CI = & get_instance();
        $CI->load->module('audioplayer');

		$num_sounds = $CI->audioplayermedia->where('user_id',$user->id)->count();
		$num_albums = $CI->audioplayeralbum->where('user_id',$user->id)->count();
		$num_tags = $CI->BuilderEngine->get_option('audioplayer_num_tags_displayed');
		$show_tags = $CI->BuilderEngine->get_option('audioplayer_show_tags');
		$sounds = $CI->audioplayermedia->where('user_id',$user->id)->get();
		$albums = $CI->audioplayeralbum->where('user_id',$user->id)->get();	

		
        $output ='
			<div class="audiogallery-sidebar-widget">
				<p class="audiogallery-sidebar-widget-search-margin">Search</p>
				<div class="audiogallery-widget-search">
					<form class="navbar-form audiogallery-channel-widget-search audiogallery-channel-widget-search-padding-sidebar" method="get" action="'.base_url('/audioplayer/search').'" >
						<input class="form-full input-lg" type="text" value="" placeholder="Search Here" name="keyword" id="wid-search">
						<input type="submit" value="" name="" id="wid-s-sub">
					</form>
				</div>
			</div>';
			if($num_albums > 0){
				$output .='<div class="audiogallery-sidebar-widget">
					<p>My Audio Albums</p>
					<ul>';
						foreach($albums as $album){
							$output .='<li><a href="'.base_url('audioplayer/channel/'.$user->username.'/album/'.$album->id.'').'">'.str_replace('_',' ',$album->name).''.$album = ($album->status == 'private')?' - (Private)':''.'</a></li>';
						}
					$output .='</ul>
				</div>';
			}
			if($sounds->tags != '' && $show_tags == 'yes'){
				$output .='<div class="audiogallery-sidebar-widget">
					<p>My Audio Tags</p>
					<ul class="audiogallery-widget-tag">';
					foreach($sounds as $sound){
						$tags = explode(',',$sound->tags);
						$i = 1;
						foreach($tags as $tag){
							if($i <= $num_tags){
								$output .='<li><a href="'.base_url('audioplayer/sound/'.$sound->id.'').'">'.$tag.'</a></li>';
								$i++;
							}
						}
					}
					$output .='</ul>
				</div>';
			}						
		$output .='';

        return $output;
    }
}
?>