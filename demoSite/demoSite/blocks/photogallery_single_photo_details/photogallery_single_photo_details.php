<?php
class photogallery_single_photo_details_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Photo Gallery";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Photo Details";
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
		$CI->load->model('visits');
		$this->load_generic_styling();
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		$id = $segments[$count-1];
		$vid = new PhotoGalleryMedia($segments[$count-1]);
		$author = new User($vid->user_id);
		$username = $author->username;
		$gallery_option = $CI->BuilderEngine->get_option('photogallery_option');
		$photo = $CI->photogallerymedia->where('id',$id)->get();
		$comments = $CI->photogallerycomment->where('media_id',$photo->id)->get();
		$num_comments = $CI->photogallerycomment->where('media_id',$photo->id)->count();
		$ratings = $CI->photogalleryrating->select_avg('rating')->where('media_id',$photo->id)->get();
		$num_photo_views = $CI->visits->where('page','photogallery/photo/'.$id.'')->count();
		$allow_ratings = $CI->BuilderEngine->get_option('photogallery_allow_ratings');
		$album = $CI->photogalleryalbum->where('id',$photo->album_id)->get();
		$likes = $photo->likes->where('status','like')->count();
		$unlikes = $photo->likes->where('status','unlike')->count();
		$followers = $CI->photogalleryfollow->where('following_id',$author->id)->count();
		$followers = $CI->photogalleryfollow->where('following_id',$author->id)->count();
		$fols = ($followers == 1)?$followers.'':$followers.'';
		$num_authors_photos = $CI->photogallerymedia->where('user_id',$author->id)->count();
		$num_photo_views = $CI->visits->where('page','photogallery/photo/'.$segments[$count-1].'')->count();
		//View
		$output ='
			<div id="photogallery-single-photo-details-'.$this->block->get_id().'">
				<div class="row">
				<div class="col-lg-9 col-md-9 col-sm-7 col-xs-12">
						<div class="">
							<div class="col-md-10 photogallery-mainphoto-desc-padding">';
							if($gallery_option != 'open'){
								$output .='<h3>'.str_replace('_',' ',$photo->title).'</h3>';
							}
							$desc = ChEditorfix($photo->description);
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
								<div class="photo-gallery-sidebar-widget">
									<button id="reportPhoto" class="btn btn-sm btn-dark-grey"><i class="fa fa-exclamation-triangle fa-lg"></i> Report Photo</button>
								</div>
								<div id="reportPhotoForm" class="hide" style="border:1px solid #ddd">
									<div class="modal-header">
										<h4 class="modal-title" id="myModalLabel">Report Photo</h4>
									</div>
									<form id="reportPhotoF" method="get" action="'.base_url('photogallery/report_photo/').'">
										<div class="modal-body">
											<input type="hidden" name="media_id" value="'.$photo->id.'">
											<p>Please describe what aspect of this photo or it\'s author you find inadequate, inappropriate or insulting</p>
											<div class="form-group">
												<textarea class="form-control" name="text" placeholder="Describe your reason for reporting this photo"></textarea>
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
				
					<div class="col-lg-3 col-md-3 col-sm-5 col-xs-12 space15">
						<div class="project-detail-block">
							<p>
								<strong class="dark-color">Album: </strong>'.str_replace('_',' ',$album->name).'
							</p>
							<p>
								<strong class="dark-color">Uploaded:</strong>'.date('d.m.Y',$photo->time_created).'
							</p>';
							if($gallery_option != 'open'){
								$output .='<p><strong class="dark-color">Views:</strong>'.$num_photo_views.'</p>';
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
										$output .='<a href="'.base_url().'photogallery/rate_photo?id='.$photo->id.'&rating='.$i.'" ><i class="fa fa-star-o"></i></a>';
									}
								}
								else{
									for($i = 1;$i<=$rate;$i++){
										$output .= '<a href="'.base_url().'photogallery/rate_photo?id='.$photo->id.'&rating='.$i.'" ><i class="fa fa-star"></i></a>';
									}
									for($j = 1,$k = $rate + 1;$j<=$empty_stars;$j++,$k++){
										$output .= '<a href="'.base_url().'photogallery/rate_photo?id='.$photo->id.'&rating='.$k.'" ><i class="fa fa-star-o"></i></a>';
									}
								}
								$output .='</p>';
							}
							$output .='<p>
								<strong class="dark-color">Comments:</strong>'.number_format($num_comments).'
								</p>
							<p>
								<strong class="dark-color">Followers: </strong>'.$fols.'
							</p>
							<p>';
							$nums = ($num_authors_photos ==1)?$num_authors_photos.'':$num_authors_photos.'';
							$output .='
								<strong class="dark-color">All Photos: </strong>'.$nums.'
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
		</div>';

		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'photogallery-single-photo-details-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), $menu);
		else
			return $output.$this->apply_custom_css();
    }
}
?>