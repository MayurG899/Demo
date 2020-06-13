<?php
class Videotube_search_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "VideoTube";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Video Search";
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
        if(!$CI->BuilderEngine->get_option('videotube_num_medias_displayed')){
            $videos_per_page = 6;
        }
        else
            $videos_per_page = $CI->BuilderEngine->get_option('videotube_num_medias_displayed');

		$r = new VideoTubeMedia();
		$r = $r->get_like_name_or_description_or_tag($keyword);
		if(count($r) > 0 )
			$res = $r;
		else
			$res = array(0);
        $videos = $CI->videotubemedia->where_in('id',$res)->order_by('time_created', 'desc')->get_paged($page_number, $videos_per_page);
		
		//View
        $output ='
                <!-- work Filter -->
                <div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="videotube-sidebar-widget">
						<div class="video-channel-widget-search">
							<form class="navbar-form video-channel-widget-search video-channel-widget-search-padding-sidebar" method="get" action="'.base_url('/videotube/search').'" >
								<input class="form-full input-lg" type="text" value="" placeholder="Search Here" name="keyword" id="wid-search">
								<input type="submit" value="" id="wid-s-sub">
							</form>
						</div>
						<hr>
					</div>
					<h2 class="text-center"> Search Results... </h2>
					';
					if($videos->exists()){
						foreach($videos as $result){
							$resulting_album = new VideoTubeAlbum($result->album_id);
							if($resulting_album->status != 'private' || ($resulting_album->status == 'private' && $user->get_id() == $resulting_album->user_id)){
								$output .='
								<div class="">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 videotube-search-results-box">
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
											<span class="videotube-search-thumbnail">';
											if($result->type == 'file'){
												$output .='
												<video id="mediaplayervideo'.$result->id.$this->block->get_id().'" src="'.checkImagePath($result->file).'" class="img-responsive videotube-video-thumbnails-height-featured" controls>
													<source src="'.checkImagePath($result->file).'" type="video/mp4">
													<source src="'.checkImagePath($result->file).'" type="video/ogg">
													Your browser does not support HTML5 video.
												</video>';
											}
											if($result->type == 'youtube'){
												$output .='
												<video id="mediaplayervideo'.$result->id.$this->block->get_id().'" src="'.checkImagePath($result->file).'" class="img-responsive videotube-video-thumbnails-height-featured" controls>
													<source type="video/youtube" src="'.$result->file.'" />
												</video>';
											}
											if($result->type == 'vimeo'){
												$output .='<iframe src="https://player.vimeo.com/video/'.$result->file.'" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
											}
											$output .='
											<script>
												$(document).ready(function() {
													$("#mediaplayervideo'.$result->id.$this->block->get_id().'").mediaelementplayer({
														poster:"'.checkImagePath($result->file).'",
														videoWidth: "100%",
														videoHeight: "100%",
														showPosterWhenEnded: true,
														success: function(mediaElement, originalNode, instance) {
															//instance.load();
														}
													});
													$("#mediaplayervideo'.$result->id.$this->block->get_id().'").bind("contextmenu",function(){
														return false;
													});
													//$(".mejs__controls").append("<div class=\"mejs_button mejs__download\"><a role=\"button\" href=\"checkImagePath($sound->file)\" download><i class=\"fa fa-download\"></i></a></div>");
												});
											</script>
											</span>
										</div>
										<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
											<a href="'.base_url('videotube/video/'.$result->id.'').'"><h4>'.$result->title.'</h4>
												<p class="lead">';
													$text_without_slashes = strip_tags(ChEditorfix($result->description));
													if(strlen($result->description) > 300){
														$text = substr($text_without_slashes, 0, 300).'...';
													}
													else{
														$text = $text_without_slashes;
													}
													$output .= $text.'
												</p>
											</a>';
											$tags = explode(',',$result->tags);
											if(count($tags > 0)){
												$output .='<ul class="videotube-widget-tag" style="list-style:none">';
													foreach($tags as $tag){
														$link = $tag;
														if($tag == 'video')
															$link = '%20video';
														$output .='<li> <a href="'.base_url('videotube/search/'.$link.'').'">'.$tag.'</a> </li>';
													}
												$output .='</ul>';
											}
										$output .='</div>
									</div>
								</div>';
							}
						}
					}else{
						$output .='<h1 class="text-center" > Nothing found !</h1>';
					}
					$output .='</div>
                </div>';

        return $output;
    }
}
?>