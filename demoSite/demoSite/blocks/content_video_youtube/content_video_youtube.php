<?php
class content_video_youtube_block_handler extends  block_handler{
	function info()
	{
		$info['category_name'] = "Basic Blocks";
		$info['category_icon'] = "dsf";

		$info['block_name'] = "Video YouTube";
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
                <div class="row">
                    <!-- begin col-12 -->
                    <div class="col-md-12 col-md-12 col-sm-12 col-xs-12">
						<div class="js-video [vimeo, widescreen]">
							<iframe width="853" height="480" src="https://www.youtube.com/embed/zyIN9nF7AMU?rel=0" frameborder="0" allowfullscreen></iframe>
						</div>
                    </div>
                </div>
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
			<div block-editor="ckeditor" block-name="'.$this->block->get_name().'" id="video-youtube-container-'.$this->block->get_id().'" class="">
				'.$this->block->data('content').'
			</div>
		';
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='global_style';
		else
			$menu ='style';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'video-youtube-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output;
    }
}
?>