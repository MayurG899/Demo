<?php
class Videotube_single_video_comments_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "VideoTube";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Video Comments";
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
		$gallery_option = $CI->BuilderEngine->get_option('videotube_option');
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);

		$video = new VideoTubeMedia($segments[$count-1]);
		$comments = $video->comment->get();
		$allow_comments = $CI->BuilderEngine->get_option('videotube_allow_comments');
		$author = new User();
		$author = $author->where('id',$video->user_id)->get();
		
		//View
		if($allow_comments == 'yes' && $video->comments_allowed != 'hide'){

		 $output ='
		 <div class="videotube-mainvideo-comments-hr"><hr /></div><div class="clearfix"></div>';
						if($CI->BuilderEngine->get_option('videotube_comments_private')== 'public' || ($CI->BuilderEngine->get_option('videotube_comments_private')== 'private' && $user->is_logged_in())){
							$output .='<div class="videotube-comment-post-comment">
								<h4><span class="videotube-comment-comment-numb">'.number_format($video->comment->count()).'</span> Video Comments</h4>
								<ul class="videotube-comment-comment-list mt-30">';
									$i =1;
									foreach($comments as $comment){
										$comment_author = new User($comment->user_id);
										$output .='<li>
										<div class="videotube-comment-comment-avatar">';
											if($comment_author->id != 0){
												$output .='<a href="'.base_url('videotube/channel/'.$comment_author->username.'').'"><img src="'.$comment_author->avatar.'" alt="Comment Author"></a>';
											}else{
												$output .='<a href="#"><img src="'.base_url('builderengine/public/img/avatar.png').'" alt="Comment Author"></a>';
											}
										$output .='</div>
										<div class="">
											<div class="videotube-comment-comment-detail">';
												if($comment_author->id != 0){
													$output .='<a href="'.base_url('videotube/channel/'.$comment_author->username.'').'"><h6>'.$comment_author->first_name.' '.$comment_author->last_name.'</h6></a>';
												}else{
													$output .='<h6> Guest </h6>';
												}
												$output .='<div class="post-meta"><span>'.date('M d, Y',$comment->time_created).'</span></div>
												<p>'.stripslashes(str_replace('\r\n', '',$comment->text)).'</p>';
												if($user->is_logged_in()){
													$output .='<a id="reportButton'.$i.'" class="btn btn-xs btn-warning" style="padding:3px 3px 3px">Report</a>';
												}
												if($user->is_member_of("Administrators")){
													$output .='<a href="'.base_url('videotube/delete_comment/'.$comment->id.'').'" class="btn btn-danger" style="padding:3px 3px 3px">Delete</a>';
												}

												$output .='<div id="reportDiv'.$i.'" class="hide" style="border:1px solid #ddd;margin-top:5px;">
													<div class="modal-header">
														<h4 class="modal-title" id="myModalLabel">Report Comment</h4>
													</div>
													<form id="reportForm'.$i.'" method="get" action="'.base_url('videotube/report_comment/').'">
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
							if($allow_comments =='yes' && $video->comments_allowed != 'no'){
								$output .='<div id="posted" class="space40">
									<h5>Add a Public Comment</h5>
									<div class="row">
										<form id="postForm" method="post">
											<div>
												<div class="col-md-12">
													<textarea placeholder="Write Your Message Here" name="message" id="message" class="form-full" required></textarea>
												</div>
												<div class="col-md-12">
													<input type="hidden" name="media_id" value="'.$video->id.'">
													<button id="poster" type="submit" class="btn btn-lg btn-sm btn-black videochannel-post-comment-1">Post Comment</button>
												</div>
											</div>
										</form>
									</div>
								</div>';
							}
						}
						$output .='';
	$user_dir = ($CI->session->userdata('user_id'))?'true':'false';				
	$output .='
	<script>
	$(document).ready(function() {
		$(\'#like\').click(function(e){
			var permission = "'.$user_dir.'";
			if(permission == \'true\'){
				user_id = "'.$user->id.'";
				video_id = "'.$video->id.'";
				likes = $(\'#likes\').html();
				status = \'like\';
				setTimeout(function(){
					$.get("'.base_url().'videotube/ajax/toggle_like_video/'.$user->id.'/'.$video->id.'/like", function(data){
						data = $.parseJSON(data);
						$(\'#likes\').hide().empty().text(data.likes).fadeIn(\'fast\');	
					});
				}, 500);
			}
			else
				window.location.replace("'.base_url('videotube/login').'");
			e.preventDefault();
		});
		$(\'#unlike\').click(function(e){
			var permission = "'.$user_dir.'";
			if(permission == \'true\'){		
				user_id = "'.$user->id.'";
				video_id = "'.$video->id.'";
				likes = $(\'#unlikes\').html();
				status = \'unlike\';
				setTimeout(function(){
					$.get("'.base_url().'videotube/ajax/toggle_like_video/'.$user->id.'/'.$video->id.'/unlike", function(data){
						data = $.parseJSON(data);
						$(\'#unlikes\').hide().empty().text(data.unlikes).fadeIn(\'fast\');						
					});
				}, 500);
			}
			else
				window.location.replace("'.base_url('videotube/login').'");	
			e.preventDefault();
		});
		$(\'#follow1\').click(function(e){
			var permission = "'.$user_dir.'";
			if(permission == \'true\'){
				follower_id = "'.$user->id.'";
				following_id = "'.$author->id.'";
				if(follower_id == following_id){
					location.reload(true);
				}
				setTimeout(function(){
					$.get("'.base_url().'videotube/ajax/toggle_follow/'.$user->id.'/'.$author->id.'", function(data){
						data = $.parseJSON(data);
						if(data.class == \'btn-color-line\' && $this.hasClass(\'btn-color-line\')){
							$this.removeClass(data.class);
							$this.hide().empty().text(data.text).addClass(data.activeclass).fadeIn(\'fast\');
						}
						else{
							$this.removeClass(data.activeclass);
							$this.hide().empty().text(data.text).addClass(data.class).fadeIn(\'fast\');
						}
					});
				}, 500);
			}
			else
				window.location.replace("'.base_url('videotube/login').'");		
			e.preventDefault();
		});';
		if($user->id == $author->id){
			$output .= '
				$(\'#follow2\').click(function(e){
					$(\'this\').css(\'background-color\',\'#E5E7E9 !important\');
					$(\'this\').addClass(\'disabled\');
					e.preventDefault();
				});
			';
		}else{
		$output .='	
			$(\'#follow2\').click(function(e){
				var permission = "'.$user_dir.'";
				if(permission == \'true\'){		
					follower_id = "'.$user->id.'";
					following_id = "'.$author->id.'";
					if(follower_id == following_id){
						location.reload(true);
					}
					var $this = $(this);
					setTimeout(function(){
						$.get("'.base_url().'videotube/ajax/toggle_follow/'.$user->id.'/'.$author->id.'", function(data){
							data = $.parseJSON(data);
							if(data.class == \'video-btn-black-line-border\' && $this.hasClass(\'video-btn-black-line-border\')){
								$this.removeClass(data.class);
								$this.hide().empty().html(\'<i class="fa fa-users left"></i>\' + data.text).addClass(data.activeclass).fadeIn(\'fast\');
							}
							else{
								$this.removeClass(data.activeclass);
								$this.hide().empty().html(\'<i class="fa fa-check left"></i>\' + data.text).addClass(data.class).fadeIn(\'fast\');
							}
						});
					}, 500);
				}
				else
					window.location.replace("'.base_url('videotube/login').'");		
				e.preventDefault();
			});';
		}
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