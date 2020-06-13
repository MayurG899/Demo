<?php
class Audioplayer_single_sound_sidebar_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Audio Player";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Sound Sidebar";
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

		$num_albums = $CI->audioplayeralbum->where('user_id',$user->id)->count();
		$num_tags = $CI->BuilderEngine->get_option('audioplayer_num_tags_displayed');
		$show_tags = $CI->BuilderEngine->get_option('audioplayer_show_tags');
		$gallery_option = $CI->BuilderEngine->get_option('audioplayer_option');

		$sound = new AudioPlayerMedia();
		$sound = $sound->where('id',$segments[$count-1])->get();

		$author = new User();
		$author = $author->where('id',$sound->user_id)->get();
		$author_albums = $CI->audioplayeralbum->where('user_id',$author->id)->get();
		
			$output ='';
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
							if($sound->tags != '' && $show_tags == 'yes'){						
								$output .='<div class="audiogallery-sidebar-widget ptb-audio-sidebar">
									<p>My Audio Tags</p>
									<ul class="audiogallery-widget-tag">';
										$tags = explode(',',$sound->tags);
										$i = 1;
										foreach($tags as $tag){
											if($i <= $num_tags){
												$output .='<li><a href="'.base_url('audioplayer/search/'.$tag).'" > '.$tag.'</a></li>';
												$i++;
											}
										}
									$output .='</ul>
								</div>';
							}
							if($num_albums > 0){
								$output .='<div class="audiogallery-sidebar-widget ptb-audio-sidebar">
									<p>My Audio Albums</p>
									<ul>';
								foreach($author_albums as $author_album){
									if($author_album->status != 'private' || ($author_album->status == 'private' && $user->get_id() == $author_album->user_id)){
										$status = ($author_album->status == 'private')?' - (Private)':'';
										$output .='<li><a href="'.base_url('audioplayer/channel/'.$author->username.'/album/'.$author_album->id.'').'">'.str_replace('_',' ',$author_album->name).''.$status.'</a></li>';
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