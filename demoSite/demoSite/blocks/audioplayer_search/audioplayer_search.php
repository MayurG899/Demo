<?php
class Audioplayer_search_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Audio Player";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "sound Search";
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
		$search = $segments[$count-2];
		if($search != 'search'){
			$keyword = '';
		}else{
			$keyword = end($segments);
		}
		$keyword = urldecode($keyword);
        $page_number = 1;
        if(isset($_GET['page'])){
            $page_number = $_GET['page'];
        }
        if(!$CI->BuilderEngine->get_option('audioplayer_num_medias_displayed')){
            $sounds_per_page = 6;
        }
        else
            $sounds_per_page = $CI->BuilderEngine->get_option('audioplayer_num_medias_displayed');
			
		$r = new AudioPlayerMedia();
		$r = $r->get_like_name_or_description_or_tag($keyword);
		if(count($r) > 0 )
			$res = $r;
		else
			$res = array(0);
        $sounds = $CI->audioplayermedia->where_in('id',$res)->order_by('time_created', 'desc')->get_paged($page_number, $sounds_per_page);
		
		//View
        $output ='
                <!-- work Filter -->
               <div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="audiogallery-sidebar-widget">
							<div class="audiogallery-channel-widget-search">
								<form class="navbar-form audiogallery-channel-widget-search audiogallery-channel-widget-search-padding-sidebar" method="get" action="'.base_url('/audioplayer/search').'" >
									<input class="form-full input-lg" type="text" value="" placeholder="Search Here" name="keyword" id="wid-search">
									<input type="submit" value="" id="wid-s-sub">
								</form>
							</div>
							<hr>
						</div>
						<h2 class="text-center"> Search Results... </h2>
					';
					if($sounds->exists()){
						foreach($sounds as $result){
							$resulting_album = new AudioPlayerAlbum($result->album_id);
							if($resulting_album->status != 'private' || ($resulting_album->status == 'private' && $user->get_id() == $resulting_album->user_id)){
								$output .='
								<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 audiogallery-search-results-box">
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<span class="audiogallery-search-thumbnail">
											<a href="'.base_url('audioplayer/sound/'.$result->id.'').'">
												<img src="'.checkImagePath($result->cover).'" alt="'.$result->description.'" >
											</a>
											<audio id="mediaplayer-'.$result->id.$this->block->get_id().'" src="'.checkImagePath($result->file) .'" controls preload="none" style="width:100%;">
												<source src="'.checkImagePath($result->file) .'" type="audio/mpeg" />
												Your browser does not support the audio element.
											</audio>
											<script>
												$(document).ready(function() {
													$("#mediaplayer-'.$result->id.$this->block->get_id().'").mediaelementplayer({
														success: function(mediaElement, originalNode, instance) {
															//instance.load();
														}
													});
													$("#mediaplayer-'.$result->id.$this->block->get_id().'").bind("contextmenu",function(){
														return false;
													});
													//$(".mejs__controls").append("<div class=\"mejs_button mejs__download\"><a role=\"button\" href=\"checkImagePath($sound->file)\" download><i class=\"fa fa-download\"></i></a></div>");
												});
											</script>
										</span>
									</div>
								<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<a href="'.base_url('audioplayer/sound/'.$result->id.'').'"><h4>'.str_replace('_',' ',$result->title).'</h4>
								<p class="lead">';
								$text_without_slashes = strip_tags(ChEditorfix($result->description));
								if(strlen($result->description) > 300){
									$text = substr($text_without_slashes, 0, 300).'...';
								}
								else{
									$text = $text_without_slashes;
								}
							}
							$output .= $text.'</p></a></div></div></div>';
						}
					}else{
						$output .='<h1 class="text-center" > Nothing Found !</h1>';
					}
					$output .='</div>
                </div>';

        return $output;
    }
}
?>