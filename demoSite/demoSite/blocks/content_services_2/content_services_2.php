<?php
class content_services_2_block_handler extends  block_handler{
	function info()
	{
		$info['category_name'] = "Basic Blocks";
		$info['category_icon'] = "dsf";

		$info['block_name'] = "Services 2";
		$info['block_icon'] = "fa-envelope-o public";
		
		return $info;
	}
    public function generate_admin()
    {
		$this->show_placeholder();
    }
    public function generate_style($active_menu = '')
    {
       
    }
    public function load_generic_styling()
    {
        
    }
    public function set_initial_values_if_empty()
    {
        $content = $this->block->data('content');

        if(!is_array($content) || empty($content))
        {
			$content ='
            <div>
                <section class="services-2-padding">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
                        <div class="page-icon-top fa fa-edit"><i class=""></i></div>
                        <h4>VISUAL DESIGN</h4>
                        <p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem.</p>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
                        <div class="page-icon-top fa fa-cogs"><i class=""></i></div>
                        <h4>DEVELOPMENT</h4>
                        <p>Donec sodales sagittis magna. hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus, augue velit cursus nunc.</p>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
                        <div class="page-icon-top fa fa-desktop"><i class=""></i></div>
                        <h4>MOBILE APPS</h4>
                        <p>Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales.</p>
                    </div>
                </div>		
			</section>
		</div>
					';
            $this->block->set_data('content', $content, true);
        }
    }
    public function save_content($content)
    {
		$this->block->set_data('content', $content, true);
    }
    public function generate_content()
    {	$this->block->set_data("editorEnabled", 1);
        global $active_controller;
        $CI = &get_instance();
        $CI->load->module('layout_system');

		if($this->block->is_new())
			$this->set_initial_values_if_empty();

        $content = $this->block->data('content');

        $single_element = '';

        //generic animations
        $this->load_generic_styles();

		$output = '
			<div block-editor="ckeditor" block-name="'.$this->block->get_name().'" id="services-2-container-'.$this->block->get_id().'" class="">
				'.$this->block->data('content').'
			</div>
		';
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='global_style';
		else
			$menu ='style';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'services-2-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output;
    }
}
?>