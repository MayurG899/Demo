<?php
class Photogallery_channel_comments_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Photo Gallery";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Channel Comments";
        $info['block_icon'] = "fa-envelope-o";

        return $info;
    }
    public function generate_admin()
    {
    }
	public function generate_style($active_menu = '')
	{
		include FCPATH.'/builderengine/public/animations/animations.php';

		$background_active = $this->block->data('background_active');
		$background_color = $this->block->data('background_color');
		$background_image = $this->block->data('background_image');

		$text_align = $this->block->data('text_align');
		$text_color = $this->block->data('text_color');
		$custom_css = $this->block->data('custom_css');
		$custom_classes = $this->block->data('custom_classes');

		$active_options = array("color" => "Use color background", "image" => "Use image background");
		$text_options = array("left" => "Left", "center" => "Center", "right" => "Right");

		$animation_type = $this->block->data('animation_type');
		$animation_duration = $this->block->data('animation_duration');
		//$animation_event = $this->block->data('animation_event');
		//$animation_delay = $this->block->data('animation_delay');
		?>
		<div role="tabpanel">
			<ul class="nav nav-tabs" role="tablist" style="margin-left: -20px;">
				<li role="presentation" class="<?if($active_menu == 'style' || $active_menu == '') echo 'active'?>"><a href="#title" aria-controls="text" role="tab" data-toggle="tab">Background Styles</a></li>
				<li role="presentation" class="<?if($active_menu == 'custom' || $active_menu == '') echo 'active'?>"><a href="#text" aria-controls="profession" role="tab" data-toggle="tab">Custom</a></li>
				<li role="presentation" class="<?if($active_menu == 'animation' || $active_menu == '') echo 'active'?>"><a href="#animations" aria-controls="animations" role="tab" data-toggle="tab">Animations</a></li>
				<?php if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1):?>
					<li role="presentation" class="<?if($active_menu == 'global_style' || $active_menu == '') echo 'active'?>"><a href="#global" aria-controls="global" role="tab" data-toggle="tab">Global</a></li>
				<?php endif;?>
			</ul>
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane fade <?if($active_menu == 'style' || $active_menu == '') echo 'in active'?>" id="title">
					<?php
					$this->admin_input('text_color','text', 'Font Color: ', $text_color);
					$this->admin_select('text_align', $text_options, 'Text align: ', $text_align);
					$this->admin_select('background_active', $active_options, 'Background option: ', $background_active);
					$this->admin_input('background_color','text', 'Background color: ', $background_color);
					$this->admin_file('background_image','Background image: ', $background_image, 'categoryposts'.$this->block->get_id(), true );
					?>
					<script>
						$("#categoryposts<?=$this->block->get_id()?>").click(function(e){
							e.preventDefault();
						});
					</script>
				</div>
				<div role="tabpanel" class="tab-pane fade <?if($active_menu == 'custom') echo 'in active'?>" id="text">
					<?php
					$this->admin_textarea('custom_css','Custom CSS: ', $custom_css, 4);
					$this->admin_textarea('custom_classes','Custom Classes: ', $custom_classes, 2);
					?>
				</div>
				<div role="tabpanel" class="tab-pane fade <?if($active_menu == 'animation') echo 'in active'?>" id="animations">
					<?php
					$this->admin_select('animation_type', $types,'Animation: ', $animation_type);
					$this->admin_select('animation_duration', $durations,'Animation state: ', $animation_duration);
					//$this->admin_select('animation_event', $events,'Animation Start: ',$animation_event);
					//$this->admin_select('animation_delay', $delays,'Animation Delay: ',$animation_delay);
					?>
				</div>
				<?php if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1):?>
				<div role="tabpanel" class="tab-pane fade <?if($active_menu == 'global_style') echo 'in active'?>" id="global">
					<?php
					$global_options = array ('true' => 'Yes','false' => 'No');
					$global = $this->block->data('globaltype');
					if(empty($global))
						$global = 'false';
					$this->admin_select('globaltype', $global_options, 'Global (Replicate on all pages) :', $global);
					?>
				</div>
				<?php endif;?>
			</div>
		</div>
		<?php
	}
	public function load_generic_styling()
	{
		$background_active = $this->block->data('background_active');
		$background_color = $this->block->data('background_color');
		$background_image = $this->block->data('background_image');

		$text_align = $this->block->data('text_align');
		$text_color = $this->block->data('text_color');
		$custom_css = $this->block->data('custom_css');

		$animation_type = $this->block->data('animation_type');
		$animation_duration = $this->block->data('animation_duration');
		//$animation_event = $this->block->data('animation_event');
		//$animation_delay = $this->block->data('animation_delay');

		if(!empty($animation_type)){
			$this->block->force_data_modification();
			$this->block->add_css_class('animated '.$animation_duration.' '.$animation_type);
		}
		//$settings[0][0] = 'new-container-'.$this->block->get_id();
		//$settings[0][1] = $animation_event;
		//$settings[0][2] = $animation_duration.' '.$animation_delay.' '.$animation_type;
		//add_action("be_foot", generate_animation_events($settings));
		
		$style_arr = $this->block->data("style");
		if($background_active == 'color')
			$style_arr['background-color'] = $background_color;
		else
			$style_arr['background-image'] = $background_image;
		$style_arr['text-align'] = $text_align;
		$style_arr['color'] = $text_color;
		$style_arr['text'] = ';'.$custom_css;
		$this->block->set_data("style", $style_arr);
	}
    public function apply_custom_css()
    {
        $style_arr = $this->block->data("style");
        if(!isset($style_arr['color']))
            $style_arr['color'] = '';
        if(!isset($style_arr['text-align']))
            $style_arr['text-align'] = '';
        if(!isset($style_arr['background-color']))
            $style_arr['background-color'] = '';

        return '
        <style>
        div[name="'.$this->block->get_name().'"] h1{
                color: '.$style_arr['color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] h2{
                color: '.$style_arr['color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] h3{
                color: '.$style_arr['color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] h4{
                color: '.$style_arr['color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] h5{
                color: '.$style_arr['color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] p{
            /*    color: '.$style_arr['color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] span{
            /*    color: '.$style_arr['color'].' !important; */
                text-align: ' . $style_arr['text-align'].' !important;
            /*    background-color: ' . $style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] div{
                color: '.$style_arr['color'].' !important;
                text-align: '.$style_arr['text-align'].' !important;
            /*    background-color: '.$style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] ul{
                color: '.$style_arr['color'].' !important;
                text-align: '.$style_arr['text-align'].' !important;
            /*    background-color: '.$style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] ol{
                color: ' . $style_arr['color'].' !important;
                text-align: ' . $style_arr['text-align'].' !important;
             /*   background-color: ' . $style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] li{
                color: '.$style_arr['color'].' !important;
                text-align: ' . $style_arr['text-align'].' !important;
            /*    background-color: ' . $style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] a{
            /*    color: '.$style_arr['color'].' !important; */
        }
		.bckgrd{
			background-color: '.$style_arr['background-color'].' !important;
		}
        </style>';
    }
    public function generate_content()
    {
		//Controller
		global $active_controller;
		$user = &$active_controller->user;
        $CI = & get_instance();
        $CI->load->module('photogallery');
		$this->load_generic_styling();
		$gallery_option = $CI->BuilderEngine->get_option('photogallery_option');
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		$username = $segments[$count-2];
		$author = new User();
		$author = $author->where('username',$username)->get();
		$author_settings = $CI->photogalleryusersettings->where('user_id',$author->id)->get();
		$author_albums = $CI->photogalleryalbum->where('user_id',$author->id)->get();
		$allow_comments = $CI->BuilderEngine->get_option('photogallery_allow_comments');
		$show_tags = $CI->BuilderEngine->get_option('photogallery_show_tags');
		$num_albums = $CI->photogalleryalbum->where('user_id',$author->id)->count();
		$num_tags = $CI->BuilderEngine->get_option('photogallery_num_tags_displayed');
		$comments = $CI->photogallerycomment->where('channel_owner_id',$author->id)->get();
		$comments_count = $CI->photogallerycomment->where('channel_owner_id',$author->id)->count();
		
		//View
		if($allow_comments == 'yes' && $author_settings->channel_comments == 'yes'){

		 $output ='
			<div id="photogallery-channel-comment-'.$this->block->get_id().'">
				<div class="clearfix"></div>';
						if($CI->BuilderEngine->get_option('photogallery_comments_private')== 'public' || ($CI->BuilderEngine->get_option('photogallery_comments_private')== 'private' && $user->is_logged_in())){
							$output .='<div class="photogallery-comment-post-comment">
								<h4><span class="photogallery-comment-comment-numb">'.$comments_count.'</span> Public Comments</h4>
								<ul class="photogallery-comment-comment-list mt-30">';
									$i =1;
									foreach($comments as $comment){
										$comment_author = new User($comment->user_id);
										$output .='<li>
										<div class="photogallery-comment-comment-avatar">';
											if($comment_author->id != 0){
												$output .='<a href="'.base_url('photogallery/channel/'.$comment_author->username.'').'"><img src="'.$comment_author->avatar.'" alt="Comment Author"></a>';
											}else{
												$output .='<a href="#"><img src="'.base_url('builderengine/public/img/avatar.png').'" alt="Comment Author"></a>';
											}
										$output .='</div>
										<div class="">
											<div class="photogallery-comment-comment-detail">';
												if($comment_author->id != 0){
													$output .='<a href="'.base_url('photogallery/channel/'.$comment_author->username.'').'"><h6>'.$comment_author->first_name.' '.$comment_author->last_name.'</h6></a>';
												}else{
													$output .='<h6> Guest </h6>';
												}
												$output .='<div class="post-meta"><span class="photogallery-comment-font-italic ">'.date('M d, Y',$comment->time_created).'</span></div>
												<p class="photogallery-comment-desc">'.stripslashes(str_replace('\r\n', '',$comment->text)).'</p>';
												if($user->is_logged_in()){
													$output .='<a id="reportButton'.$i.'" class="btn btn-xs btn-warning" style="padding:3px 3px 3px">Report</a>';
												}
												if($user->is_member_of("Administrators")){
													$output .='<a href="'.base_url('photogallery/delete_comment/'.$comment->id.'').'" class="btn btn-danger" style="padding:3px 3px 3px">Delete</a>';
												}

												$output .='
												<div id="reportDiv'.$i.'" class="hide" style="border:1px solid #ddd;margin-top:5px;">
													<div class="modal-header">
														<h4 class="modal-title" id="myModalLabel">Report Comment</h4>
													</div>
													<form id="reportForm'.$i.'" method="get" action="'.base_url('photogallery/report_comment/'.$author->username).'">
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
								$output .='
								<div id="posted" class="space40">
									<h4>Add a public comment</h4>
									<div class="row">
										<form id="postForm" method="post">
											<div>
												<div class="col-md-12">
													<textarea placeholder="Write Your Message Here" name="message" id="message" class="form-full" required></textarea>
												</div>
												<div class="col-md-12">
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
					$output .=' 
					$(\'#reportButton'.$i.'\').click(function(event){
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
				</script>
			</div>';
		}else{
			$output = '<div id="photogallery-channel-comment-'.$this->block->get_id().'"></div>';
		}
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'photogallery-channel-comment-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), $menu);
		else
			return $output.$this->apply_custom_css();
    }
}
?>