<?php
class Audioplayer_single_sound_comments_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Audio Player";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Sound Comments";
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

		$sound = new AudioPlayerMedia($segments[$count-1]);
		$comments = $sound->comment->get();
		$allow_comments = $CI->BuilderEngine->get_option('audioplayer_allow_comments');
		$author = new User();
		$author = $author->where('id',$sound->user_id)->get();
		//View
		if($allow_comments == 'yes' && $sound->comments_allowed != 'hide'){
		$output ='
					<div class="clearfix"></div>';
						if($CI->BuilderEngine->get_option('audioplayer_comments_private')== 'public' || ($CI->BuilderEngine->get_option('audioplayer_comments_private')== 'private' && $user->is_logged_in())){
							$output .='<div class="audiogallery-comment-post-comment">
								<h4>Comments <span class="audiogallery-comment-comment-numb">('.$comments->count().')</span></h4>
								<ul class="audiogallery-comment-comment-list mt-30">';
									$i =1;
									foreach($comments as $comment){
										$comment_author = new User($comment->user_id);
										$output .='<li>
										<div class="audiogallery-comment-comment-avatar">';
											if($comment_author->id != 0){
												$output .='<a href="'.base_url('audioplayer/channel/'.$comment_author->username.'').'"><img src="'.$comment_author->avatar.'" alt="Comment Author"></a>';
											}else{
												$output .='<a href="#"><img src="'.base_url('builderengine/public/img/avatar.png').'" alt="Comment Author"></a>';
											}
										$output .='</div>
										<div class="">
											<div class="audiogallery-comment-comment-detail">';
												if($comment_author->id != 0){
													$output .='<a href="'.base_url('audioplayer/channel/'.$comment_author->username.'').'"><h6>'.$comment_author->first_name.' '.$comment_author->last_name.'</h6></a>';
												}else{
													$output .='<h6> Guest </h6>';
												}
												$output .='<div class="post-meta"><span class="audiogallery-comment-font-italic ">'.date('M d, Y',$comment->time_created).'</span></div>
												<p class="audiogallery-comment-desc">'.stripslashes(str_replace('\r\n', '',$comment->text)).'</p>';
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
													<form id="reportForm'.$i.'" method="get" action="'.base_url('audioplayer/report_comment/').'">
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
							if($allow_comments =='yes' && $sound->comments_allowed != 'no'){
								$output .='<div id="posted" class="space40">
									<h4>Write Your Comment</h4>
									<div class="row">
										<form id="postForm" method="post">
											<div>
												<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
													<textarea placeholder="Post Your Message Here" name="message" id="message" class="form-full" required></textarea>
												</div>
												<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 audiostreaming-comment-button">
													<input type="hidden" name="media_id" value="'.$sound->id.'">
													<button id="poster" type="submit" class="btn btn-sm btn-inverse">Post Comment</button>
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
				sound_id = "'.$sound->id.'";
				likes = $(\'#likes\').html();
				status = \'like\';
				setTimeout(function(){
					$.get("'.base_url().'audioplayer/ajax/toggle_like_sound/'.$user->id.'/'.$sound->id.'/like", function(data){
						data = $.parseJSON(data);
						$(\'#likes\').hide().empty().text(data.likes).fadeIn(\'fast\');	
					});
				}, 500);
			}
			else
				window.location.replace("'.base_url('audioplayer/login').'");
			e.preventDefault();
		});
		$(\'#unlike\').click(function(e){
			var permission = "'.$user_dir.'";
			if(permission == \'true\'){		
				user_id = "'.$user->id.'";
				sound_id = "'.$sound->id.'";
				likes = $(\'#unlikes\').html();
				status = \'unlike\';
				setTimeout(function(){
					$.get("'.base_url().'audioplayer/ajax/toggle_like_sound/'.$user->id.'/'.$sound->id.'/unlike", function(data){
						data = $.parseJSON(data);
						$(\'#unlikes\').hide().empty().text(data.unlikes).fadeIn(\'fast\');						
					});
				}, 500);
			}
			else
				window.location.replace("'.base_url('audioplayer/login').'");
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
					$.get("'.base_url().'audioplayer/ajax/toggle_follow/'.$user->id.'/'.$author->id.'", function(data){
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
				window.location.replace("'.base_url('audioplayer/login').'");
			e.preventDefault();
		});
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
					$.get("'.base_url().'audioplayer/ajax/toggle_follow/'.$user->id.'/'.$author->id.'", function(data){
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
				window.location.replace("'.base_url('audioplayer/login').'");
			e.preventDefault();
		});';
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