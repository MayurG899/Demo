<?php
class button_block_handler extends  block_handler{
	function info()
	{
		$info['category_name'] = "Basic Blocks";
		$info['category_icon'] = "dsf";

		$info['block_name'] = "Button";
		$info['block_icon'] = "fa-envelope-o public";
		
		return $info;
	}
    public function generate_admin()
    {
		$button_text = $this->block->data('text');
		$button_action = $this->block->data('action');
		$button_type = $this->block->data('button_type');

		$button_types = array(
			"default" => "Default Button",
			"primary" => "Primary Button",
			"success" => "Success Button",
			"info" => "Info Button",
			"warning" => "Warning Button",
			"inverse" => "Inverse Button",
			"outline" => "Outline Button",
			"danger" => "Danger Button"
		);

		$this->admin_select('button_type', $button_types, 'Button Types: ', $button_type);
		$this->admin_input('text','text', 'Text: ', $button_text);
		$this->admin_input('action','text', 'Action url (with http:// , https:// or ftp:// prefix): ', $button_action);		
    }
    public function generate_style($active_menu = '')
    {
       
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

    public function load_generic_styling()
    {
       
    }
    public function set_initial_values_if_empty()
    {
        $content = $this->block->data('content');

        if(!is_array($content) || empty($content))
        {
            $content = array();
            $content[0] = new stdClass();
            $content[0]->link = "http://builderengine.com";
            $content[0]->text = "New Button";
            $content[0]->type = "success";			

            $this->block->set_data('content', $content, true);
        }
    }
    public function generate_content()
    {
        global $active_controller;
        $CI = &get_instance();
        $CI->load->module('layout_system');

        $this->set_initial_values_if_empty();
        $content = $this->block->data('content');
        $single_element = '';
        //generic animations
        $this->load_generic_styles();
        //
		$button_text = $this->block->data('text');
		$button_action = $this->block->data('action');
		$button_type = $this->block->data('button_type');
		
        $output = '';
        foreach($content as $key => $element)
        {
            $element = (object)$element;
			if(!empty($button_type))
				$element->type = $button_type;
			if(!empty($button_text))
				$element->text = $button_text;
			if(!empty($button_action))
				$element->link = $button_action;
            $output .= '
				<div id="button-container-'.$this->block->get_id().'">
					<a field_name="content-'.$key.'-button" href="'.$element->link.'" id="button-'.$this->block->get_id().'" role="button" class="designer-editable btn btn-'.$element->type.'" >'.$element->text.'</a>
            	</div>';
        }
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'button-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output.$this->apply_custom_css();
    }
}
?>