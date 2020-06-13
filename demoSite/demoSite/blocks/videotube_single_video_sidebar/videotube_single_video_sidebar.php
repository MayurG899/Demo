<?php
class Videotube_single_video_sidebar_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "VideoTube";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Video Sidebar";
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
					$output .='<!--<div class="sidebar-widget">
					<button class="btn btn-md btn-black-line"><i class="fa fa-exclamation-triangle fa-lg"></i> Report Video</button>
					</div>-->';
				}
				$output .='
					<div class="videotube-sidebar-widget">
					<hr>
						<p class="videotube-sidebar-widget-search-margin">Search</p>
						<div class="video-channel-widget-search">
							<form class="navbar-form video-channel-widget-search video-channel-widget-search-padding-sidebar" method="get" action="'.base_url('/videotube/search').'" >
								<input class="form-full input-lg" type="text" value="" placeholder="Search Here" name="keyword" id="wid-search">
								<input type="submit" value="" id="wid-s-sub">
							</form>
						</div>
					</div>';
				if($video->tags != '' && $show_tags == 'yes'){						
					$output .='<div class="videotube-sidebar-widget">
						<p>Video Tags</p>
						<ul class="videotube-widget-tag">';
							$tags = explode(',',$video->tags);
							$i = 1;
							foreach($tags as $tag){
								if($i <= $num_tags){
									$output .='<li><a href="'.base_url('videotube/search/'.$tag).'" > '.$tag.'</a></li>';
									$i++;
								}
							}
						$output .='</ul>
					</div>';
				}
				if($num_albums > 0){
					$output .='<div class="videotube-sidebar-widget">
						<p>Video Albums</p>
						<ul>';
					foreach($author_albums as $author_album){
						if($author_album->status != 'private' || ($author_album->status == 'private' && $user->get_id() == $author_album->user_id)){
							$status = ($author_album->status == 'private')?' - (Private)':'';
							$output .='<li><a href="'.base_url('videotube/channel/'.$author->username.'/album/'.$author_album->id.'').'">'.str_replace('_',' ',$author_album->name).''.$status.'</a></li>';
						}
					}
					$output .='	</ul>
					</div>';
				}
			$output .='';

        return $output;
    }
}
?>