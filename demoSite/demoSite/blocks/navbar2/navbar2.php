<?php
class navbar2_block_handler extends  block_handler{
	function info()
	{
		$info['category_name'] = "Content Blocks";
		$info['category_icon'] = "dsf";

		$info['block_name'] = "Navbar 2";
		$info['block_icon'] = "fa-envelope-o public";

		return $info;
	}
	public function generate_admin()
	{
		?>
		<style>
			#block-admin-save
			{
				display:none;
			}
			.navbar-dashboard-link
			{
				color: #3A80A1 !important;
				text-decoration: none;
				transition:all 0.5s ease;
			}
			.navbar-dashboard-link:hover
			{
				color: #60C4F3 !important;
			}
		</style>
		<h2 style="color: #fff;"> To edit the contents of this navbar click <a class="navbar-dashboard-link" href="<?=base_url('/admin/links/show')?>">here</a></h2>
		<?php
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
					$this->admin_input('text_color','text', 'Main Menu Text Color: ', $text_color);
					$this->admin_input('dropdown_color','text', 'Dropdown Text Color: ', $dropdown_color);
					$this->admin_input('text_size','text', 'Main Menu Text Size: ', $text_size);
					$this->admin_input('dropdown_size','text', 'Dropdown Text Size: ', $dropdown_size);
					$this->admin_select('text_align', $text_options, 'Text align: ', $text_align);
					$this->admin_select('background_active', $active_options, 'Background option: ', $background_active);
					$this->admin_input('background_color','text', 'Background color: ', $background_color);
					$this->admin_input('dropdown_background_color','text', 'Dropdown Background color: ', $dropdown_background_color);
					$this->admin_input('dropdown_background_color_hover','text', 'Dropdown Background color on mouseover: ', $dropdown_background_color_hover);
					$this->admin_file('background_image','Background image: ', $background_image, 'navbar'.$this->block->get_id(), true );
					?>
					<script>
						$("#navbar<?=$this->block->get_id()?>").click(function(e){
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

		if(!empty($animation_type)){
			$this->block->force_data_modification();
			$this->block->add_css_class('animated '.$animation_duration.' '.$animation_type);
		}

		$style_arr = $this->block->data("style");
		if($background_active == 'color')
			$style_arr['background-color'] = $background_color;
		else
			$style_arr['background-image'] = $background_image;
		$style_arr['text-align'] = $text_align;
		$style_arr['text'] = ';'.$custom_css;
		$this->block->set_data("style", $style_arr);
	}
	public function generate_content()
	{
		global $active_controller;
		$CI = &get_instance();
		$CI->load->module('layout_system');
		$CI->load->model('links');
		$content = $this->block->data('content');
		$single_element = '';

		//generic animations
		$this->load_generic_styling();
		/*
        $animation_type = $this->block->data('animation_type');
        $animation_duration = $this->block->data('animation_duration');
        $animation_event = $this->block->data('animation_event');
        $animation_delay = $this->block->data('animation_delay');

        $settings[0][0] = 'header-navbar-'.$this->block->get_id();
        $settings[0][1] = $animation_event;
        $settings[0][2] = $animation_duration.' '.$animation_delay.' '.$animation_type;
        add_action("be_foot", generate_animation_events($settings));
        */
		// Generate styles
		$text_color = $this->block->data('text_color');
		$text_size = $this->block->data('text_size');
		$dropdown_color = $this->block->data('dropdown_color');
		$dropdown_size = $this->block->data('dropdown_size');
		$dropdown_background_color = $this->block->data('dropdown_background_color');
		$dropdown_background_color_hover = $this->block->data('dropdown_background_color_hover');
		// Apply styles
		$output = '
			<style>
			.text-color-'.$this->block->get_id().'{
				color: '.$text_color.' !important;
			}
			.text-size-'.$this->block->get_id().'{
				font-size: '.$text_size.' !important;
			}
			.dropdown-color-'.$this->block->get_id().'{
				color: '.$dropdown_color.' !important;
			}
			.dropdown-size-'.$this->block->get_id().'{
				font-size: '.$dropdown_size.' !important;
			}
			.dropdown-background-color-'.$this->block->get_id().'{
				background-color: '.$dropdown_background_color.' !important;
			}
			.dropdown-background-color-hover-'.$this->block->get_id().' a:hover{
				background-color: '.$dropdown_background_color_hover.' !important;
			}
			.navbar2-block{
				display: inline-block !important;
    			width: 100% !important;
			}
			</style>
			';

		$output .= '
				<style>
					.dropdown-submenu {
					  position: relative;
					}
					.dropdown-submenu > .dropdown-menu {
					  top: 0;
					  left: 100%;
					  margin-top: -6px;
					  margin-left: -1px;
					}
					.dropdown-submenu:hover > .dropdown-menu {
					  display: block;
					}
					.dropdown-submenu:hover > a:after {
					  border-left-color: #fff;
					}
					.dropdown-submenu.pull-left {
					  float: none;
					}
					.dropdown-submenu.pull-left > .dropdown-menu {
					  left: -100%;
					  margin-left: 10px;
					}
				</style>

				<div id="navbar-container-'.$this->block->get_id().'">
					<div class="nav-mobile nav-bar-icon">
						<span></span>
					</div>

					<div class="nav-menu" id="header-navbar">
						<ul class="nav-menu-inner" id="header-navbar-'.$this->block->get_id().'">';
		//print_r($CI->links->get_all_links());exit;
		foreach($CI->links->get_all_links() as $link)
		{
			$output .= '
			<li>';
			$children = $CI->links->link_has_children($link->id);
			if(is_array($children) && !$CI->links->is_child($link->id))
			{
				$output .= '
				<a href="'.checkLink($link->target,$link->tags).'" title="'.$link->title.'" class="menu-has-sub text-color-'.$this->block->get_id().' text-size-'.$this->block->get_id().'">
					'.$link->name.'
					<i class="fa fa-angle-down"></i>
				</a>
				<ul class="sub-dropdown dropdownn dropdown-background-color-'.$this->block->get_id().'">';
				foreach($children as $sub_link)
				{
					$output .= '<li class="dropdown-background-color-hover-'.$this->block->get_id().'">';
					$second_children = $CI->links->link_has_children($sub_link->id);
					if(is_array($second_children))
					{
						$output .= '
						<a href="'.checkLink($link->target,$link->tags).'" title="'.$sub_link->title.'" class="menu-has-sub dropdown-color-'.$this->block->get_id().' dropdown-size-'.$this->block->get_id().'">
							'.$sub_link->name.'
							<i class="fa fa-angle-down"></i>
						</a>
						<ul class="sub-dropdown dropdown-background-color-'.$this->block->get_id().'">';
						foreach($second_children as $subsub_link){
							$output .= '<li><a href="'.checkLink($subsub_link->target,$subsub_link->tags).'" class="dropdown-color-'.$this->block->get_id().' dropdown-size-'.$this->block->get_id().'" title="'.$subsub_link->title.'">'.$subsub_link->name.'</a></li>';
						}
						$output .=
						'</ul>';
						$output .=
						'</li>';
					}
					else
						$output .= '<a href="'.checkLink($sub_link->target,$sub_link->tags).'" class="dropdown-color-'.$this->block->get_id().' dropdown-size-'.$this->block->get_id().'" title="'.$sub_link->title.'">'.$sub_link->name.'</a></li>';
				}
				$output .=
				'</ul>';
			}
			else
				if(!$CI->links->is_child($link->id))
					$output .= '<a class="text-color-'.$this->block->get_id().' text-size-'.$this->block->get_id().'" href="'.checkLink($link->target,$link->tags).'" title="'.$link->title.'">'.$link->name.'</a>';
			$output .= '
			</li>';
		}
		$output .= '
				</ul>
			</div>
		</div>';
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'navbar-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output;
	}
}
?>