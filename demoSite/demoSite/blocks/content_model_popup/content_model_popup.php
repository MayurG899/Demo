<?php
class content_model_popup_block_handler extends  block_handler{
	function info()
	{
		$info['category_name'] = "Basic Blocks";
		$info['category_icon'] = "dsf";

		$info['block_name'] = "Model Pop-Up";
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
                <section class="">
                        <a href="#modal-dialog" class="btn btn-lg btn-colors" data-toggle="modal">Modal Pop-Up</a>
						<!-- #modal-dialog -->
							<div class="modal fade" id="modal-dialog" style="display: none;">
								<div class="modal-dialog">
									<div class="modal-content block-colors-light block-colors-light-bg">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">Modal Pop-Up</h4>
										</div>
										<div class="modal-body">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed enim arcu. 
									Ut posuere in ligula quis ultricies. In in justo turpis. Donec ut dui at massa gravida 
									interdum nec vitae justo. Quisque ullamcorper vehicula dictum. Nullam hendrerit interdum eleifend. 
									Aenean luctus sed arcu laoreet scelerisque. Vivamus non ullamcorper mauris, id sagittis lorem. 
									Proin tincidunt mauris et dolor mattis imperdiet. Sed facilisis mattis diam elementum adipiscing.
										</div>
										<div class="modal-footer">
											<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
											<a href="#" class="btn btn-sm btn-primary">Action Page</a>
										</div>
									</div>
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
			<div block-editor="ckeditor" block-name="'.$this->block->get_name().'" id="model-popup-container-'.$this->block->get_id().'" class="">
				'.$this->block->data('content').'
			</div>
		';
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='global_style';
		else
			$menu ='style';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'model-popup-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output;
    }
}
?>