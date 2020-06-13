<?php
class page_block_handler extends  block_handler{
		function info()
		{
			$info['category_name'] = "Page System";
			$info['category_icon'] = "dsf";

			$info['block_name'] = "Page";
			$info['block_icon'] = "fa-envelope-o public";
			
			return $info;
		}
		public function admin_option_toggle_test_toggle($toggled)
        {
            $this->block->force_data_modification(true);
            PC::toggled($toggled);

            if($toggled){
                $this->block->remove_css_class('container-fluid');
                $this->block->add_css_class('container');
                PC::toggled("truee");
            }
            else
            {
                $this->block->remove_css_class('container');
                $this->block->add_css_class('container-fluid');
                PC::toggled("falsee");
            }
            $this->block->save();
        }
        public function admin_option_toggle_collapse_toggle($toggled)
        {
            $this->block->force_data_modification(true);
            PC::toggled($toggled);

            if($toggled){
                $this->block->add_css_class('minimized-section');
                PC::toggled("truee");
            }
            else
            {
                $this->block->remove_css_class('minimized-section');
                PC::toggled("falsee");
            }
            $this->block->save();
        }
        public function admin_option_select_position($choice)
        {
            $this->block->force_data_modification(true);
            switch($choice)
            {
                case 'default':
                    $this->block->remove_css_class('be-position-fixed-top');
                    break;
                case 'fixed_top':
                    echo '<Br>putting fixed top<br>';
                    $this->block->add_css_class('be-position-fixed-top');
                    break;
            }
            $this->block->save();
        }

        public function register_admin_options()
        {
            $this->add_class_toggle_option('test_toggle', '<i class="fa fa-arrows-h" rel="tooltip" data-placement="top" title="Boxed / Full Width"></i>', 'inverse', false);
            $this->add_class_toggle_option('collapse_toggle', '<i class="fa fa-minus collapse-section" rel="tooltip" data-placement="top" title="Hide Block"></i>', 'inverse', false);
        }
		public function generate_admin()
		{

		}
		public function generate_style($active_menu = '')
        {
            $font_test_link = $this->block->data('font_test_link');
            $font_family = $this->block->data('font_family');
            $font_size = $this->block->data('font_size');

            $background_active = $this->block->data('background_active');
            $background_color = $this->block->data('background_color');
            $background_image = $this->block->data('background_image');

			$text_align = $this->block->data('text_align');
			$text_color = $this->block->data('text_color');
			$custom_css = $this->block->data('custom_css');
			$custom_classes = $this->block->data('custom_classes');

			$active_options = array("color" => "Use color background", "image" => "Use image background");
			$text_options = array("left" => "Left", "center" => "Center", "right" => "Right");
			?>
			<div role="tabpanel">
				<ul class="nav nav-tabs" role="tablist" style="margin-left: -20px;">
					<li role="presentation" class="<?if($active_menu == 'style' || $active_menu == '') echo 'active'?>"><a href="#title" aria-controls="text" role="tab" data-toggle="tab">Background Styles</a></li>
					<li role="presentation" class="<?if($active_menu == 'custom' || $active_menu == '') echo 'active'?>"><a href="#text" aria-controls="profession" role="tab" data-toggle="tab">Custom</a></li>
					<?php if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1):?>
						<li role="presentation" class="<?if($active_menu == 'global_style' || $active_menu == '') echo 'active'?>"><a href="#global" aria-controls="global" role="tab" data-toggle="tab">Global</a></li>
					<?php endif;?>
				</ul>
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane fade <?if($active_menu == 'style' || $active_menu == '') echo 'in active'?>" id="title">
						<?php
						$this->admin_input('font_test_link','text', 'Font link: ', $font_test_link);
						$this->admin_input('font_family','text', 'Font family: ', $font_family);
						$this->admin_input('font_size','text', 'Font size: ', $font_size);
						$this->admin_input('text_color','text', 'Font Color: ', $text_color);
						$this->admin_select('text_align', $text_options, 'Text align: ', $text_align);
						$this->admin_select('background_active', $active_options, 'Background option: ', $background_active);
						$this->admin_input('background_color','text', 'Background color: ', $background_color);
						$this->admin_file('background_image','Background image: ', $background_image, 'page'.$this->block->get_id(), true );
						?>
						<script>
							$("#page<?=$this->block->get_id()?>").click(function(e){
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
        public function generate_content()
        {
            global $active_controller;
            $CI = &get_instance();
            $CI->load->module('layout_system');

            /*$background_active = $this->block->data('background_active');
            $background_color = $this->block->data('background_color');
            $background_image = $this->block->data('background_image');

            $output = '
            <script>
                $(document).ready(function(){';
                    if($background_active == 'image')
                        $output .= '$("#page-content-styler").parent().parent().css("background-image", "url('.$background_image.')");';
                    else
                        $output .= '$("#page-content-styler").parent().parent().css("background-color", "'.$background_color.'");';
                $output .= '
                });
            </script>
            <div id="page-content-styler"></div>';

            return $output;*/
            $background_active = $this->block->data('background_active');
            $background_color = $this->block->data('background_color');
            $background_image = $this->block->data('background_image');
            $font_test_link = $this->block->data('font_test_link');
            $font_family = $this->block->data('font_family');
            $font_size = $this->block->data('font_size');

            $output = '
            <script>
                $(document).ready(function(){
                    $("head").append("'.$font_test_link.'");
                    $("[name=\''.$this->block->name.'\']").css("font-family", "'.$font_family.'");
                    $("[name=\''.$this->block->name.'\']").css("font-size", "'.$font_size.'");';
                    if($background_active == 'image')
                        $output .= '$("[name=\''.$this->block->name.'\']").css({"background-image" : "url('.$background_image.')", "background-repeat" : " no-repeat","background-attachment":"fixed","background-size":"cover"});';
                    else
                        $output .= '$("[name=\''.$this->block->name.'\']").css("background-color", "'.$background_color.'");';
                $output .= '
                });
            </script>';
			if($this->block->has_class_css('header-section') == 1)
				$menu ='header';
			elseif($this->block->has_class_css('footer-section') == 1)
				$menu ='footer';
			else
				$menu = '';
			if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
				return $output.$CI->layout_system->load_section_script($this->block->get_id(), $CI->BuilderEngine->get_page_path(), 'page', $this->block->get_name(), $menu);
			else
				return $output;
        }
	}
?>