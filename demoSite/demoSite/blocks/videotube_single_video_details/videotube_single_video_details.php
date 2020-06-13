<?php
class Videotube_single_video_details_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "VideoTube";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Video Details";
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

		$video = new VideoTubeMedia($segments[$count-1]);
		$author = new User($video->user_id);
		$gallery_option = $CI->BuilderEngine->get_option('videotube_option');

		$followers = $CI->videotubefollow->where('following_id',$author->id)->count();
		$follow = new VideoTubeFollow();
		$followed = $follow->where('following_id',$author->id)->where('follower_id',$user->get_id())->count();
		$followed = ($followed != 0)?'yes':'no';

		$num_authors_videos = $CI->videotubemedia->where('user_id',$author->id)->count();

		$ratings = $CI->videotuberating->select_avg('rating')->where('media_id',$video->id)->get();
		$num_video_views = $CI->visits->where('page','videotube/video/'.$video->id.'')->count();
		$allow_ratings = $CI->BuilderEngine->get_option('videotube_allow_ratings');
		$album = $CI->videotubealbum->where('id',$video->album_id)->get();
		//View
		$output ='
				<div class="">';
					if($followed == 'yes'){
							$class = 'video-btn-black-line-border';
							$text = '<i class="fa fa-check left"></i> Following';
					}
					else{
						$class = 'video-btn-danger';
						$text = '<i class="fa fa-users left"></i> Follow';
					}		
					$output .='<div class="pull-right">';
					$foll = ($user->get_id() == $author->id)?'disabled':'';
					$output .='<a id="follow2" href="#" class="video-btn video-btn-md '.$class.' '.$foll.'">'.$text.'</a>
					<!--<div class="post-meta gallerylocation1"><span>Galway, Ireland</span></div>-->
					</div></div>
					<div class="video-post-author">
						<div class="video-post-author-img pull-left">
							<a href="'.base_url('videotube/channel/'.$author->username.'').'"><img alt="author" src="'.$author->avatar.'"></a>
						</div>
						<div class="video-post-author-details pull-left space15 videotube-mainvideo-author">
							<a href="'.base_url('videotube/channel/'.$author->username.'').'"><span class="videotube-mainvideo-author-name-1">'.$author->first_name.' '.$author->last_name.'</span></a>';
							$output .='<div class="post-meta"><span><small>Published on: '.date('d.m.Y',$video->time_created).'</small> </span></div>
						</div>
					</div>
				</div>
						<div class="col-md-10">
						<div class="row">
							<div class="col-md-12">';
							if($gallery_option != 'open'){
								$output .='<h3>'.$video->title.'</h3>';
							}
							$desc = ChEditorfix($video->description);
							$output .='	<p>'.$desc.'</p>
							<br>
							<div class="videotube-project-detail-block">
							<p>
								<strong class="dark-color">Followers:</strong>'.number_format($followers).'
							</p>
							<p>
								<strong class="dark-color">Video Album: </strong>'.str_replace('_',' ',$album->name).'
							</p>
							<p>
								<strong class="dark-color">Total Videos: </strong>'.number_format($num_authors_videos).'
							</p>
							<p>
								<strong class="dark-color">Uploaded:</strong>'.date('d.m.Y',$video->time_created).'
							</p>';
							if($gallery_option != 'open'){
								$output .='<p><strong class="dark-color">Views:</strong>'.number_format($num_video_views).'</p>';
							}
							if($allow_ratings == 'yes'){
								$output .='<p><strong class="dark-color">Rating:</strong>';
								foreach($ratings as $item){
									$rate = round($item->rating);
								}
								$total_stars = 5;
								$empty_stars = $total_stars - $rate;
								
								if($rate < 1){
									for($i = 1;$i <= 5;$i++){
										$output .='<a href="'.base_url().'videotube/rate_video?id='.$video->id.'&rating='.$i.'" ><i class="fa fa-star-o"></i></a>';
									}
								}
								else{
									for($i = 1;$i<=$rate;$i++){
										$output .= '<a href="'.base_url().'videotube/rate_video?id='.$video->id.'&rating='.$i.'" ><i class="fa fa-star"></i></a>';
									}
									for($j = 1,$k = $rate + 1;$j<=$empty_stars;$j++,$k++){
										$output .= '<a href="'.base_url().'videotube/rate_video?id='.$video->id.'&rating='.$k.'" ><i class="fa fa-star-o"></i></a>';
									}
								}
								$output .='</p>';
							}
							$output .='<p>
								<strong class="dark-color">Comments:</strong>'.number_format($video->comment->count()).'
							</p>
							<div class="sidebar-widget">
									<button id="reportVideo" class="btn btn-sm btn-dark-grey"><i class="fa fa-exclamation-triangle fa-lg"></i> Report Video</button>
								</div>
								<div id="reportVideoForm" class="hide" style="border:1px solid #ddd">
									<div class="modal-header">
										<h4 class="modal-title" id="myModalLabel">Report Video</h4>
									</div>
									<form id="reportVideoF" method="get" action="'.base_url('videotube/report_video/').'">
										<div class="modal-body">
											<input type="hidden" name="media_id" value="'.$video->id.'">
											<p>Please describe what aspect of this video or it\'s author you find inadequate, inappropriate or insulting</p>
											<div class="form-group">
												<textarea class="form-control" name="text" placeholder="Describe your reason for reporting this video"></textarea>
											</div>
										</div>
										<div class="modal-footer">
											<button id="close" type="button" class="btn btn-default" style="padding:3px 3px 3px">Cancel</button>
											<button id="submitVideoReport" type="submit" class="btn btn-danger"  style="padding:3px 3px 3px">Report</button>
										</div>
									</form>
								</div>
								
								</div>';
						$output .='</div>
					</div>
						<div class="col-md-2">
							
							<style>
								.show{display:block;}
								.hide{display:none}
							</style>';
							if($gallery_option == 'open'){
								$output .='
								';
							}
						$output .='</div>
		<script>
		$(document).ready(function() {
			$(\'#reportVideo\').click(function(event){
				$(\'#reportVideoForm\').addClass(\'show\').fadeIn(600).addClass(\'animated fadeInLeft\');
				event.preventDefault();
			});
			$(\'#close\').click(function(event){
				$(\'#reportVideoForm\').removeClass(\'show\').fadeOut(600);
				$(\'#reportVideoForm\').addClass(\'hide\').fadeIn(600);				
				event.preventDefault();
			});	
			$(\'#poster\').click(function(event){
				$(\'#posted\').addClass(\'animated zoomOut\').fadeIn(600);
				$( \'#postForm\' ).submit();			
				event.preventDefault();
			});
			$(\'#submitVideoReport\').click(function(event){
				$(\'#reportVideoForm\').addClass(\'animated zoomOut\').fadeIn(600);
				$(\'#reportVideoF\').submit();			
				event.preventDefault();
			});
		});
		</script>'
				;

        return $output;
    }
}
?>