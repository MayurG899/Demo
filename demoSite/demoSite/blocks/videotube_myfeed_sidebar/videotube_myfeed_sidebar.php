<?php
class Videotube_myfeed_sidebar_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "VideoTube";
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
        $CI->load->module('videotube');

		$num_albums = $CI->videotubealbum->where('user_id',$user->id)->count();
		$num_tags = $CI->BuilderEngine->get_option('videotube_num_tags_displayed');
		$show_tags = $CI->BuilderEngine->get_option('videotube_show_tags');
		$videos = $CI->videotubemedia->where('user_id',$user->id)->get();
		$albums = $CI->videotubealbum->where('user_id',$user->id)->get();

        $output ='
				<div class="videotube-sidebar-widget">
					<p class="videotube-sidebar-widget-search-margin">Search</p>
						<div class="video-channel-widget-search">
							<form class="navbar-form video-channel-widget-search video-channel-widget-search-padding-sidebar" method="get" action="'.base_url('/videotube/search').'" >
								<input class="form-full input-lg" type="text" value="" placeholder="Search Here" name="keyword" id="wid-search">
								<input type="submit" value="" id="wid-s-sub">
							</form>
						</div>
				</div>';
				if($num_albums > 0){
					$output .='<div class="videotube-sidebar-widget">
						<p>My Video Albums ('.number_format($num_albums).')</p>
						<ul>';
							foreach($albums as $album){
								$output .='<li><a href="'.base_url('videotube/channel/'.$user->username.'/album/'.$album->id.'').'">'.str_replace('_',' ',$album->name).''.$album = ($album->status == 'private')?' - (Private)':''.'</a></li>';
							}
						$output .='</ul>
					</div>';
				}
				if($videos->tags != '' && $show_tags == 'yes'){
					$output .='<div class="videotube-sidebar-widget">
						<p>My Video Tags</p>
						<ul class="videotube-widget-tag">';
						foreach($videos as $video){
							$tags = explode(',',$video->tags);
							$i = 1;
							foreach($tags as $tag){
								if($i <= $num_tags){
									$output .='<li><a href="'.base_url('videotube/video/'.$video->id.'').'">'.$tag.'</a></li>';
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