<?php
class row_block_handler extends  block_handler{
		function info()
		{
			$info['category_name'] = "Page System";
			$info['category_icon'] = "dsf";

			$info['block_name'] = "Row";
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
                $this->block->add_css_class('boxed-row');
            }
            else
            {
                $this->block->remove_css_class('container');
                $this->block->remove_css_class('boxed-row');
                $this->block->add_css_class('container-fluid');
            }
            $this->block->save();
        }
        public function admin_option_toggle_collapse_toggle($toggled)
        {
            $this->block->force_data_modification(true);

            if($toggled)
                $this->block->add_css_class('minimized-section');
            else
                $this->block->remove_css_class('minimized-section');

            $this->block->save();
        }

        public function register_admin_options()
        {
            $this->add_class_toggle_option('test_toggle', '<i class="fa fa-arrows-h" rel="tooltip" data-placement="top" title="Boxed / Full Width"></i>', 'inverse', false);

        }
		public function generate_admin()
		{

		}
		public function generate_style($active_menu = '')
        {

        }
        public function generate_content()
        {
            global $active_controller;
            $CI = &get_instance();
            $CI->load->module('layout_system');
			$this->load_generic_styles();

            // $output = '<div class="block-move-controls"><span rel="tooltip" data-placement="top" title="" data-original-title="Move"><i class="fa fa-arrows"></i></span></div>';
            // return $output;
            /*$background_active = $this->block->data('background_active');
            $background_color = $this->block->data('background_color');
            $background_image = $this->block->data('background_image');

            $output = '<script>
                $(document).ready(function(){';
                    if($background_active == 'image')
                        $output .= '$(".row-content-styler").parent().parent().css("background-image", "url('.$background_image.')");';
                    else
                        $output .= '$(".row-content-styler").parent().parent().css("background-color", "'.$background_color.'");';
                $output .= '
                });
            </script>
            <div class="row-content-styler"></div>';

            return $output;*/

            $background_active = $this->block->data('background_active');
            $background_color = $this->block->data('background_color');
            $background_image = $this->block->data('background_image');

            $output = '
            <script>
                $(document).ready(function(){';
                    if($background_active == 'image')
                        $output .= '$("[name=\''.$this->block->name.'\']").css("background-image", "url('.$background_image.')");';
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
				return $output.$CI->layout_system->load_section_script($this->block->get_id(), $CI->BuilderEngine->get_page_path(), 'row', $this->block->get_name(), $menu);
			else
				return $output;
        }
	}
?>