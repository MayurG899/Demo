<?php
class content_services_1_block_handler extends  block_handler{
	function info()
	{
		$info['category_name'] = "Basic Blocks";
		$info['category_icon'] = "dsf";

		$info['block_name'] = "Services 1";
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
                <div class="block-column-wide-12">
                    <section id="hubinfo" class="services1-red services1-bgcontent">
					<div class="row" class="slider-bottom-row hubdetails">
                    <!-- begin col-12 -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- begin logo -->
						<div class="logo2">
							<a href="#">
								<img src="'.base_url('blocks/content_services_1/images/logo.png').'" />
							</a>
							</div>
							<br>
							<h2><span class="services1-white">Even though the future seems far away, it is actually beginning right now.</span></h2>
							<hr>
							<p></p><br><br>
						<!-- end logo -->
                    </div>
					<!-- end col-12 -->
					<!-- begin col-4 -->
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <!-- begin service -->
						<div class="box1">
							<span class="border-circle hubinfo fa fa-cloud">
								<i class=""></i>
							</span>
							<h2><span class="services1-white">SERVICE #1</span></h2>
							<p>You cant connect the dots looking forward; you can only connect them looking backwards. So you have to trust that the dots will somehow connect in your future. You have to trust in something - your gut, destiny, life, or karma</p>
							<hr>
							</div>
						<!-- end service -->
                    </div>
					<!-- end col-4 -->
					<!-- begin col-4 -->
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <!-- begin service -->
						<div class="box1">
							<span class="border-circle hubinfo fa fa-cloud">
								<i class=""></i>
							</span>
							<h2><span class="services1-white">SERVICE #2</span></h2>
							<p>You cant connect the dots looking forward; you can only connect them looking backwards. So you have to trust that the dots will somehow connect in your future. You have to trust in something - your gut, destiny, life, or karma</p>
							<hr>
							</div>
						<!-- end service -->
                    </div>
					<!-- end col-4 -->
					<!-- begin col-4 -->
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <!-- begin service -->
						<div class="box1">
							<span class="border-circle hubinfo fa fa-cloud">
								<i class=""></i>
							</span>
							<h2><span class="services1-white">SERVICE #3</span></h2>
							<p>You cant connect the dots looking forward; you can only connect them looking backwards. So you have to trust that the dots will somehow connect in your future. You have to trust in something - your gut, destiny, life, or karma</p>
							<hr>
							</div>
						<!-- end service -->
                    </div>
					<!-- end col-4 -->
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
			<div block-editor="ckeditor" block-name="'.$this->block->get_name().'" id="services-1-container-'.$this->block->get_id().'" class="block-colors-light block-colors-light-bg">
				'.$this->block->data('content').'
			</div>
		';
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='global_style';
		else
			$menu ='style';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'services-1-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output;
    }
}
?>