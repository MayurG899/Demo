<?php
class photogallery_single_photo_sidebar_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Photo Gallery";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Photo Sidebar";
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
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		$id = $segments[$count-1];
		$num_photos = $CI->photogallerymedia->where('user_id',$user->id)->count();
		$num_albums = $CI->photogalleryalbum->where('user_id',$user->id)->count();
		$num_tags = $CI->BuilderEngine->get_option('photogallery_num_tags_displayed');
		$show_tags = $CI->BuilderEngine->get_option('photogallery_show_tags');
		$photos = $CI->photogallerymedia->where('user_id',$user->id)->get();
		$albums = $CI->photogalleryalbum->where('user_id',$user->id)->get();	
		$gallery_option = $CI->BuilderEngine->get_option('photogallery_option');
		$photo = new PhotoGalleryMedia();
		$photo = $photo->where('id',$id)->get();
		$author = new User();
		$author = $author->where('id',$photo->user_id)->get();
		$author_albums = $CI->photogalleryalbum->where('user_id',$author->id)->get();
		
			$output ='<div id="photogallery-single-photo-sidebar-'.$this->block->get_id().'">';
							if($gallery_option != 'open'){                     
							    $output .='<!--<div class="photogallery-sidebar-widget">
								<button class="btn btn-md btn-black-line"><i class="fa fa-exclamation-triangle fa-lg"></i> Report Photo</button>
								</div>-->';
							}
							$output .='<div class="photogallery-sidebar-widget photogallery-sidebar-widget-extraspace">
								<p class="photogallery-sidebar-widget-search-margin">Search</p>
								<div class="photogallery-widget-search">
									<form class="navbar-form photogallery-channel-widget-search photogallery-channel-widget-search-padding-sidebar" method="get" action="'.base_url('/photogallery/search').'" >
										<input class="form-full input-lg" type="text" value="" placeholder="Search Here" name="keyword" id="wid-search">
										<input type="submit" value="" id="wid-s-sub">
									</form>
								</div>
							</div>';
							if($photo->tags != '' && $show_tags == 'yes'){						
								$output .='<div class="photogallery-sidebar-widget photogallery-sidebar-widget-extraspace">
									<p>Photo Tags</p>
									<ul class="photogallery-widget-tag">';
										$tags = explode(',',$photo->tags);
										$i = 1;
										foreach($tags as $tag){
											if($i <= $num_tags){
												$output .='<li><a href="'.base_url('photogallery/search/'.$tag).'" > '.$tag.'</a></li>';
												$i++;
											}
										}
									$output .='</ul>
								</div>';
							}
							if($num_albums > 0){
								$output .='<div class="photogallery-sidebar-widget photogallery-sidebar-widget-extraspace">
									<p>Photo Albums</p>
									<ul>';
								foreach($author_albums as $author_album){
									if($author_album->status != 'private' || ($author_album->status == 'private' && $user->get_id() == $author_album->user_id)){
										$status = ($author_album->status == 'private')?' - (Private)':'';
										$output .='<li><a href="'.base_url('photogallery/channel/'.$author->username.'/album/'.$author_album->id.'').'">'.str_replace('_',' ',$author_album->name).''.$status.'</a></li>';
									}
								}
								$output .='	</ul>
								</div>';
							}
                    $output .='</div>';

		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'photogallery-single-photo-sidebar-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), $menu);
		else
			return $output.$this->apply_custom_css();
    }
}
?>