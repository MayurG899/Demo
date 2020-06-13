<?php
class Content_block_handler extends  block_handler{
		function info()
		{
			$info['category_name'] = "Page System";
			$info['category_icon'] = "dsf";

			$info['block_name'] = "Content";
			$info['block_icon'] = "fa-envelope-o public";
			
			return $info;
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

	        $this->block->force_data_modification();

	        $style_arr = $this->block->data("style");

            $style_arr['padding-left'] = '0';
            $style_arr['padding-right'] = '0';
	        $this->block->set_data("style", $style_arr);
	        //$output = $this->block->data('content');
			$output = $this->block->data('text');
            $background_active = $this->block->data('background_active');
            $background_color = $this->block->data('background_color');
            $background_image = $this->block->data('background_image');

            $output .= '
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
				return $output.$CI->layout_system->load_section_script($this->block->get_id(), $CI->BuilderEngine->get_page_path(), 'content', $this->block->get_name(), $menu);
			else
				return $output;
		}
	}
?>