<?php
class content_tabs_1_block_handler extends  block_handler{
	function info()
	{
		$info['category_name'] = "Basic Blocks";
		$info['category_icon'] = "dsf";

		$info['block_name'] = "Tabs 1";
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
                <section class="beblocks-tabs1 block-colors-light block-colors-light-bg">
                        <ul class="nav nav-tabs beblocks-nav-tabs">
						<li class="active"><a href="#default-tab-1" data-toggle="tab" aria-expanded="true">Default Tab 1</a></li>
						<li class=""><a href="#default-tab-2" data-toggle="tab" aria-expanded="false">Default Tab 2</a></li>
						<li class=""><a href="#default-tab-3" data-toggle="tab" aria-expanded="false">Default Tab 3</a></li>
					</ul>
					<div class="tab-content beblocks-tab-content">
						<div class="tab-pane fade active in" id="default-tab-1">
							<h3 class="m-t-10"> Tabs Panel 1</h3>
							<p>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
								Integer ac dui eu felis hendrerit lobortis. Phasellus elementum, nibh eget adipiscing porttitor, 
								est diam sagittis orci, a ornare nisi quam elementum tortor. Proin interdum ante porta est convallis 
								dapibus dictum in nibh. Aenean quis massa congue metus mollis fermentum eget et tellus. 
								Aenean tincidunt, mauris ut dignissim lacinia, nisi urna consectetur sapien, nec eleifend orci eros id lectus.
							</p>
							<p class="text-right m-b-0">
								<a href="#" class="btn btn-grey btn-sm">Button 1</a>
								<a href="#" class="btn btn-colors btn-sm">Button 2</a>
							</p>
						</div>
						<div class="tab-pane fade" id="default-tab-2">
							<h3 class="m-t-10"><i class="fa fa-cog"></i> Tabs Panel 2</h3>
							<p>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
								Integer ac dui eu felis hendrerit lobortis. Phasellus elementum, nibh eget adipiscing porttitor, 
								est diam sagittis orci, a ornare nisi quam elementum tortor. Proin interdum ante porta est convallis 
								dapibus dictum in nibh. Aenean quis massa congue metus mollis fermentum eget et tellus. 
								Aenean tincidunt, mauris ut dignissim lacinia, nisi urna consectetur sapien, nec eleifend orci eros id lectus.
							</p>
							<p class="text-right m-b-0">
								<a href="#" class="btn btn-grey btn-sm">Button 1</a>
								<a href="#" class="btn btn-colors btn-sm">Button 2</a>
							</p>
						</div>
						<div class="tab-pane fade" id="default-tab-3">
							<h3 class="m-t-10"><i class="fa fa-cog"></i> Tabs Panel 3</h3>
							<p>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
								Integer ac dui eu felis hendrerit lobortis. Phasellus elementum, nibh eget adipiscing porttitor, 
								est diam sagittis orci, a ornare nisi quam elementum tortor. Proin interdum ante porta est convallis 
								dapibus dictum in nibh. Aenean quis massa congue metus mollis fermentum eget et tellus. 
								Aenean tincidunt, mauris ut dignissim lacinia, nisi urna consectetur sapien, nec eleifend orci eros id lectus.
							</p>
							<p class="text-right m-b-0">
								<a href="#" class="btn btn-grey btn-sm">Button 1</a>
								<a href="#" class="btn btn-colors btn-sm">Button 2</a>
							</p>
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
			<div block-editor="ckeditor" block-name="'.$this->block->get_name().'" id="tabs-1-container-'.$this->block->get_id().'" class="">
				'.$this->block->data('content').'
			</div>
		';
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='global_style';
		else
			$menu ='style';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'tabs-1-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output;
    }
}
?>