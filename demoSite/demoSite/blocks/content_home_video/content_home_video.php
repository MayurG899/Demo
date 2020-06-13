<?php
class content_home_video_block_handler extends  block_handler{
	function info()
	{
		$info['category_name'] = "Basic Blocks";
		$info['category_icon'] = "dsf";

		$info['block_name'] = "Home Video";
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
        <div class="block-column-wide-12 block-colors-dark">
            <section id="html5vid-intro" class="html5vid-intro-fullscreen html5vid-bg-image" data-background-img="'.base_url('blocks/content_home_video/images/globevid.jpg').'">
               <div class="html5vid-intro-caption-waper html5vid-dark-bg">
                    <div class="intro-full-height container">
                        <div class="html5vid-intro-content">
                            <div class="html5vid-intro-content-inner">

                                <h3 class="page-title-alt mb-30">Building Better Connections</h3>

                                <h1 class="html5vid-intro-title mb-30">You Can Make It Happen
                                </h1>

                                <a class="btn btn-colors btn-lg scroll-down" href="/cp/login">Account Login</a>
                            </div>
                        </div>
                    </div>
                </div>
                <video class="video" autoplay loop muted style="width:100%;height:auto;">
					<source src="'.base_url('blocks/content_home_video/images/Globe.mp4').'" type="video/mp4">
					<source src="'.base_url('blocks/content_home_video/images/Globe.mp4').'" type="video/webm">
				</video>
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
			<div block-editor="ckeditor" block-name="'.$this->block->get_name().'" id="home-video-container-'.$this->block->get_id().'" class="">
				'.$this->block->data('content').'
			</div>
		';
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='global_style';
		else
			$menu ='style';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'home-video-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output;
    }
}
?>