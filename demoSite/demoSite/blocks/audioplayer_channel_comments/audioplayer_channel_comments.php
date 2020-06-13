<?php
class Audioplayer_channel_comments_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Audio Player";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Channel Comments";
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
		$gallery_option = $CI->BuilderEngine->get_option('audioplayer_option');
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		$username = $segments[$count-2];
		$author = new User();
		$author = $author->where('username',$username)->get();
		$author_settings = $CI->audioplayerusersettings->where('user_id',$author->id)->get();
		$author_albums = $CI->audioplayeralbum->where('user_id',$author->id)->get();
		$allow_comments = $CI->BuilderEngine->get_option('audioplayer_allow_comments');
		$show_tags = $CI->BuilderEngine->get_option('audioplayer_show_tags');
		$num_albums = $CI->audioplayeralbum->where('user_id',$author->id)->count();
		$num_tags = $CI->BuilderEngine->get_option('audioplayer_num_tags_displayed');
		$comments = $CI->audioplayercomment->where('channel_owner_id',$author->id)->get();
		$comments_count = $CI->audioplayercomment->where('channel_owner_id',$author->id)->count();
		
		//View
		if($allow_comments == 'yes' && $author_settings->channel_comments == 'yes'){

		 $output ='
			<div class="clearfix"></div>';
						if($CI->BuilderEngine->get_option('audioplayer_comments_private')== 'public' || ($CI->BuilderEngine->get_option('audioplayer_comments_private')== 'private' && $user->is_logged_in())){
							$output .='<div class="videotube-comment-post-comment">
								<h4><span class="videotube-comment-comment-numb">'.number_format($comments_count).'</span> Channel Comments</h4>
								<ul class="videotube-comment-comment-list mt-30">';
									$i =1;
									foreach($comments as $comment){
										$comment_author = new User($comment->user_id);
										$output .='<li>
										<div class="videotube-comment-comment-avatar">';
											if($comment_author->id != 0){
												$output .='<a href="'.base_url('audioplayer/channel/'.$comment_author->username.'').'"><img src="'.$comment_author->avatar.'" alt="Comment Author"></a>';
											}else{
												$output .='<a href="#"><img src="'.base_url('builderengine/public/img/avatar.png').'" alt="Comment Author"></a>';
											}
										$output .='</div>
										<div class="">
											<div class="videotube-comment-comment-detail">';
												if($comment_author->id != 0){
													$output .='<a href="'.base_url('audioplayer/channel/'.$comment_author->username.'').'"><h6>'.$comment_author->first_name.' '.$comment_author->last_name.'</h6></a>';
												}else{
													$output .='<h6> Guest </h6>';
												}
												$output .='<div class="post-meta"><span class="videotube-comment-font-italic ">'.date('M d, Y',$comment->time_created).'</span></div>
												<p class="videotube-comment-desc">'.stripslashes(str_replace('\r\n', '',$comment->text)).'</p>';
												if($user->is_logged_in()){
													$output .='<a id="reportButton'.$i.'" class="btn btn-xs btn-warning" style="padding:3px 3px 3px">Report</a>';
												}
												if($user->is_member_of("Administrators")){
													$output .='<a href="'.base_url('audioplayer/delete_comment/'.$comment->id.'').'" class="btn btn-danger" style="padding:3px 3px 3px">Delete</a>';
												}

												$output .='<div id="reportDiv'.$i.'" class="hide" style="border:1px solid #ddd;margin-top:5px;">
													<div class="modal-header">
														<h4 class="modal-title" id="myModalLabel">Report Comment</h4>
													</div>
													<form id="reportForm'.$i.'" method="get" action="'.base_url('audioplayer/report_comment/'.$author->username).'">
														<div class="modal-body">
															<input type="hidden" name="comment_id" value="'.$comment->id.'">
															<p>Please describe what aspect of this comment or it\'s author you find inadequate, inappropriate or insulting</p>
															<div class="form-group">
																<textarea class="form-control" name="text" placeholder="Describe your reason for reporting this comment"></textarea>
															</div>
														</div>
														<div class="modal-footer">
															<button id="closeForm'.$i.'" type="button" class="btn btn-default" style="padding:3px 3px 3px">Cancel</button>
															<button id="subForm'.$i.'" type="submit" class="btn btn-danger"  style="padding:3px 3px 3px">Report</button>
														</div>
													</form>
												</div>
												
											</div>
										</div>
									 </li>';
									 $i++;
									}
								$output .='</ul>
							</div>';
							if($allow_comments =='yes' && $author_settings->channel_comments != 'no'){
								$output .='<div id="posted" class="space40">
									<h4>Add a public comment</h4>
									<div class="row">
										<form id="postForm" method="post">
											<div>
												<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
													<textarea placeholder="Write Your Message Here" name="message" id="message" class="form-full" required></textarea>
												</div>
												<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 audiostreaming-comment-button">
													<input type="hidden" name="channel_owner_id" value="'.$author->id.'">
													<button id="poster" type="submit" class="btn btn-sm btn-inverse">Post Comment</button>
												</div>
											</div>
										</form>
									</div>
								</div>';
							}
						}
						$output .='</div>';
						
			$user_dir = ($CI->session->userdata('user_id'))?'true':'false';				
			$output .='
			<script>
				$(document).ready(function() {';
					$i =1;
					foreach($comments as $comment){
						$output .=' $(\'#reportButton'.$i.'\').click(function(event){
							$(\'#reportDiv'.$i.'\').addClass(\'show\').fadeIn(600).addClass(\'animated fadeInLeft\');	
							event.preventDefault();
						});
						$(\'#subForm'.$i.'\').click(function(event){
							$(\'#reportDiv'.$i.'\').addClass(\'animated zoomOut\').fadeIn( 800 );
							$(\'#reportForm'.$i.'\').submit();
							event.preventDefault();
						});
						$(\'#closeForm'.$i.'\').click(function(event){
							$(\'#reportDiv'.$i.'\').removeClass(\'show\').fadeOut(1000);
							$(\'#reportDiv'.$i.'\').addClass(\'hide\').fadeIn(600);				
							event.preventDefault();
						});';		
						$i++;
					}
					$output .='
				});	
			</script>';
		}else{
			$output = '';
			
		}
        return $output;
    }
}
?>