<?php
class Audioplayer_single_sound_details_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Audio Player";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Sound Details";
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
		$sound = new AudioPlayerMedia($segments[$count-1]);
		$author = new User($sound->user_id);
		$gallery_option = $CI->BuilderEngine->get_option('audioplayer_option');

		$followers = $CI->audioplayerfollow->where('following_id',$author->id)->count();
		$ratings = $CI->audioplayerrating->select_avg('rating')->where('media_id',$sound->id)->get();
		$num_sound_views = $CI->visits->where('page','audioplayer/sound/'.$id.'')->count();
		$allow_ratings = $CI->BuilderEngine->get_option('audioplayer_allow_ratings');
		$album = $CI->audioplayeralbum->where('id',$sound->album_id)->get();
		$likes = $sound->likes->where('status','like')->count();
		$unlikes = $sound->likes->where('status','unlike')->count();
		//View
		$output ='
		<div class="row">
				<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
						<div class="row">
							<div class="col-md-10 audiogallery-mainphoto-desc-padding">';
							if($gallery_option != 'open'){
								$output .='<h3>'.str_replace('_',' ',$sound->title).'</h3>';
							}
							$desc = ChEditorfix($sound->description);
							$output .='	<p>'.$desc.'</p>
							</div>';
							if($gallery_option != 'open'){
								$output .='
								<div class="col-md-3">
									<p class="pull-left lead"><a class="text-success" href="#"><i class="fa fa-thumbs-o-up fa-lg"></i> '.$likes.'</a></p>
									<p class="pull-right lead"><a class="text-danger " href="#"><i class="fa fa-thumbs-o-down fa-lg"></i> '.$unlikes.'</a></p>
								</div>';
							}
						$output .='
							<style>
								.show{display:block;}
								.hide{display:none}
							</style>';
							if($gallery_option == 'open'){
								$output .='
								<br><br>
								<div class="audio-gallery-sidebar-widget">
									<button id="reportPhoto" class="btn btn-sm btn-dark-grey"><i class="fa fa-exclamation-triangle fa-lg"></i> Report Audio</button>
								</div>
								<div id="reportPhotoForm" class="hide" style="border:1px solid #ddd">
									<div class="modal-header">
										<h4 class="modal-title" id="myModalLabel">Report Audio</h4>
									</div>
									<form id="reportPhotoF" method="get" action="'.base_url('audioplayer/report_sound/').'">
										<div class="modal-body">
											<input type="hidden" name="media_id" value="'.$sound->id.'">
											<p>Please describe what aspect of this audio or it\'s author you find inadequate, inappropriate or insulting</p>
											<div class="form-group">
												<textarea class="form-control" name="text" placeholder="Describe your reason for reporting this audio"></textarea>
											</div>
										</div>
										<div class="modal-footer">
											<button id="close" type="button" class="btn btn-default" style="padding:3px 3px 3px">Cancel</button>
											<button id="submitPhotoReport" type="submit" class="btn btn-danger"  style="padding:3px 3px 3px">Report</button>
										</div>
									</form>
								</div>';
							}
						$output .='</div>
					</div>
				
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 space15">
						<div class="project-detail-block audiostreaming-project-detail-block">
							<p>
								<strong class="">Album: </strong>'.str_replace('_',' ',$album->name).'
							</p>
							<p>
								<strong class="">Uploaded:</strong>'.date('d.m.Y',$sound->time_created).'
							</p>';
							if($gallery_option != 'open'){
								$output .='<p><strong class="">Views:</strong>'.number_format($num_audio_views).'</p>';
							}
							if($allow_ratings == 'yes'){
								$output .='<p><strong class="">Rating:</strong>';
								foreach($ratings as $item){
									$rate = round($item->rating);
								}
								$total_stars = 5;
								$empty_stars = $total_stars - $rate;
								
								if($rate < 1){
									for($i = 1;$i <= 5;$i++){
										$output .='<a href="'.base_url().'audioplayer/rate_sound?id='.$sound->id.'&rating='.$i.'" ><i class="fa fa-star-o"></i></a>';
									}
								}
								else{
									for($i = 1;$i<=$rate;$i++){
										$output .= '<a href="'.base_url().'audioplayer/rate_sound?id='.$sound->id.'&rating='.$i.'" ><i class="fa fa-star"></i></a>';
									}
									for($j = 1,$k = $rate + 1;$j<=$empty_stars;$j++,$k++){
										$output .= '<a href="'.base_url().'audioplayer/rate_sound?id='.$sound->id.'&rating='.$k.'" ><i class="fa fa-star-o"></i></a>';
									}
								}
								$output .='</p>';
							}
							$output .='<p>
								<strong class="">Comments:</strong>'.number_format($sound->comment->count()).'
								</p>
							<p>
								<strong class="">Followers: </strong>'.number_format($followers).'
							</p>
							<p>';
							$all = new AudioPlayerMedia();$all = $all->where('user_id',$sound->user_id)->count();
							$output .='
								<strong class="">All Audio Tracks: </strong>'.number_format($all).'
							</p>
					</div>
				</div>
			</div>
				<script>
					$(document).ready(function() {
						$(\'#reportPhoto\').click(function(event){
							$(\'#reportPhotoForm\').addClass(\'show\').fadeIn(600).addClass(\'animated fadeInLeft\');
							event.preventDefault();
						});
						$(\'#close\').click(function(event){
							$(\'#reportPhotoForm\').removeClass(\'show\').fadeOut(600);
							$(\'#reportPhotoForm\').addClass(\'hide\').fadeIn(600);				
							event.preventDefault();
						});	
						$(\'#poster\').click(function(event){
							$(\'#posted\').addClass(\'animated zoomOut\').fadeIn(600);
							$( \'#postForm\' ).submit();			
							event.preventDefault();
						});
						$(\'#submitPhotoReport\').click(function(event){
							$(\'#reportPhotoForm\').addClass(\'animated zoomOut\').fadeIn(600);
							$(\'#reportPhotoF\').submit();			
							event.preventDefault();
						});
					});
				</script>
				';

        return $output;
    }
}
?>