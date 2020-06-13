<?php
class photogallery_single_photo_profile_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Photo Gallery";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Photo Profile";
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
		$vid = new PhotoGalleryMedia($segments[$count-1]);
		$lik = $vid->likes->get();
		$unl = $vid->likes->get();
		$author = new User($vid->user_id);
		$username = $author->username;

		$owner = new User();
		$channel_owner = $owner->where('username',$username)->get();
		$settings = new PhotoGalleryUserSettings();
		$owner_settings = $settings->where('user_id',$channel_owner->id)->get();
		$followers = $CI->photogalleryfollow->where('following_id',$channel_owner->id)->count();
		$num_owners_photos = $CI->photogallerymedia->where('user_id',$channel_owner->id)->count();
		$gallery_option = $CI->BuilderEngine->get_option('photogallery_option');
		$num_authors_photos = $CI->photogallerymedia->where('user_id',$author->id)->count();
		$follow = new PhotoGalleryFollow();
		$followed = $follow->where('following_id',$channel_owner->id)->where('follower_id',$user->get_id())->count();
		$followers = $CI->photogalleryfollow->where('following_id',$author->id)->count();
		$followed = ($followed != 0)?'yes':'no';
		$num_photo_views = $CI->visits->where('page','photogallery/photo/'.$segments[$count-1].'')->count();
		$likes = $lik->where('status','like')->count();
		$unlikes = $unl->where('status','unlike')->count();
			if($followed=='yes'){
				$class = 'photogallery-btn-white-follow';
				$text ='Following';
			}else{
				$class = 'photogallery-btn-white-follow';
				$text ='Follow';
			}		

		$output ='';
		
		if($gallery_option == 'open'){
			$output .='
			<div id="photogallery-single-photo-profile-'.$this->block->get_id().'">
				<div class="container">
					<div class="col-lg-12">
					<div class="photogallery-post-author">
						<div class="photogallery-post-author-img photogallery-post-author-single-img pull-left">
							<a href="'.base_url('photogallery/channel/'.$author->username.'').'"><img alt="author" src="'.$author->avatar.'"></a>
						</div>
						<div class="photogallery-post-author-details pull-left">
							<a href="'.base_url('photogallery/channel/'.$author->username.'').'"><h4>'.$author->first_name.' '.$author->last_name.'</h4></a>';
							$output .='
							';
								$dis = ($user->get_id() == $author->id)?'disabled':'';
								$output .='<a id="follow2" href="#" class="btn btn-md '.$class.' '.$dis.' photogallery-follow-margin-none"><i class="fa fa-user left"></i>'.$text.'</a>
						</div>
						<div class="photogallery-post-author-details photogallery-post-author-details-title pull-left">
							<h3 class="photogallery-post-author-details-title-h3" >'.str_replace('_',' ',$vid->title).'</h3>
						</div>
					</div>
					<div class="pull-right photogalleries-likes-profile">
						<p class="pull-left lead"><a id="like" style="color:2493f3;"  class="text-primary" href="#"><i class="fa fa-thumbs-o-up fa-lg"></i> <span id="likes" >'.$likes.'</span></a></p>&nbsp;&nbsp;&nbsp;
						<p class="pull-right lead"><a id="unlike" style="color:ff3300;" class="text-danger " href="#"><i class="fa fa-thumbs-o-down fa-lg"></i> <span id="unlikes"> '.$unlikes.'</span></a></p>
						<br/>
						<p>
							<span>Views: <strong class="post-meta"> '.$num_photo_views.'</strong></span>
						</p>					
					</div>
					</div>
				</div>
			</div>';
		}

		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'photogallery-single-photo-profile-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), $menu);
		else
			return $output.$this->apply_custom_css();
    }
}
?>