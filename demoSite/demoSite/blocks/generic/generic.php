<?php
/**
 * BE Generic Block
 */

class generic_block_handler extends  block_handler{
    function info()
    {

        return array();
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
        $this->add_class_toggle_option('test_toggle', '<i class="fa fa-arrows-h" rel="tooltip" data-placement="bottom" title="Boxed / Full Width"></i>', 'inverse', true);
        $this->add_class_toggle_option('collapse_toggle', '<i class="fa fa-minus collapse-section" rel="tooltip" data-placement="bottom" title="Hide Block"></i>', 'inverse', false);
        $this->add_select_option('position', '<i class="fa fa-arrows-v" rel="tooltip" data-placement="bottom" title="Position Type"></i>', array('default' => array('display_name' => 'Default'),'fixed_top' => array('display_name' => 'Fixed Top')), false);
    }
    public function generate_admin()
    {

    }
    public function save_content($content)
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
       $style_arr['color'] = $text_color;
       $style_arr['text'] = ';'.$custom_css;
       $this->block->set_data("style", $style_arr);
	   
	    $output = '
	    <div block-editor="ckeditor" block-name="'.$this->block->get_name().'">'
	        .$this->block->data('content').'
        </div>';
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='global_style';
		else
			$menu ='style';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'generic-block-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), $menu);
		else
			return $output;
    }
}
?>

