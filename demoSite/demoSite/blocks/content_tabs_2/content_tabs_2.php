<?php
class content_tabs_2_block_handler extends  block_handler{
	function info()
	{
		$info['category_name'] = "Basic Blocks";
		$info['category_icon'] = "dsf";

		$info['block_name'] = "Tabs 2";
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
                <section class="tabs1 beblocks-tabs2 block-colors-light">
                        <ul class="nav nav-pills beblocks-nav-pills">
						<li class="active"><a href="#nav-pills-tab-1" data-toggle="tab" aria-expanded="true">Button Tab 1</a></li>
						<li class=""><a href="#nav-pills-tab-2" data-toggle="tab" aria-expanded="false">Button Tab 2</a></li>
						<li class=""><a href="#nav-pills-tab-3" data-toggle="tab" aria-expanded="false">Button Tab 3</a></li>
						<li class=""><a href="#nav-pills-tab-4" data-toggle="tab" aria-expanded="false">Button Tab 4</a></li>
					</ul>
					<div class="tab-content beblocks--tabs2-tab-content">
						<div class="tab-pane fade active in" id="nav-pills-tab-1">
						    <h3 class="m-t-10">Button Tab 1</h3>
							<p>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
								Integer ac dui eu felis hendrerit lobortis. Phasellus elementum, nibh eget adipiscing porttitor, 
								est diam sagittis orci, a ornare nisi quam elementum tortor. 
								Proin interdum ante porta est convallis dapibus dictum in nibh. 
								Aenean quis massa congue metus mollis fermentum eget et tellus. 
								Aenean tincidunt, mauris ut dignissim lacinia, nisi urna consectetur sapien, 
								nec eleifend orci eros id lectus.
							</p>
						</div>
						<div class="tab-pane fade" id="nav-pills-tab-2">
						    <h3 class="m-t-10">Button Tab 2</h3>
							<p>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
								Integer ac dui eu felis hendrerit lobortis. Phasellus elementum, nibh eget adipiscing porttitor, 
								est diam sagittis orci, a ornare nisi quam elementum tortor. 
								Proin interdum ante porta est convallis dapibus dictum in nibh. 
								Aenean quis massa congue metus mollis fermentum eget et tellus. 
								Aenean tincidunt, mauris ut dignissim lacinia, nisi urna consectetur sapien, 
								nec eleifend orci eros id lectus.
							</p>
						</div>
						<div class="tab-pane fade" id="nav-pills-tab-3">
						    <h3 class="m-t-10">Button Tab 3</h3>
							<p>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
								Integer ac dui eu felis hendrerit lobortis. Phasellus elementum, nibh eget adipiscing porttitor, 
								est diam sagittis orci, a ornare nisi quam elementum tortor. 
								Proin interdum ante porta est convallis dapibus dictum in nibh. 
								Aenean quis massa congue metus mollis fermentum eget et tellus. 
								Aenean tincidunt, mauris ut dignissim lacinia, nisi urna consectetur sapien, 
								nec eleifend orci eros id lectus.
							</p>
						</div>
						<div class="tab-pane fade" id="nav-pills-tab-4">
						    <h3 class="m-t-10">Button Tab 4</h3>
							<p>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
								Integer ac dui eu felis hendrerit lobortis. Phasellus elementum, nibh eget adipiscing porttitor, 
								est diam sagittis orci, a ornare nisi quam elementum tortor. 
								Proin interdum ante porta est convallis dapibus dictum in nibh. 
								Aenean quis massa congue metus mollis fermentum eget et tellus. 
								Aenean tincidunt, mauris ut dignissim lacinia, nisi urna consectetur sapien, 
								nec eleifend orci eros id lectus.
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
			<div block-editor="ckeditor" block-name="'.$this->block->get_name().'" id="tabs-2-container-'.$this->block->get_id().'" class="">
				'.$this->block->data('content').'
			</div>
		';
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='global_style';
		else
			$menu ='style';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'tabs-2-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output;
    }
}
?>