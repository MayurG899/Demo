<?php
class Google_adsense_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Content Blocks";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Google Adsense";
        $info['block_icon'] = "fa-envelope-o";

        return $info;
    }

    public function generate_admin()
    {
		$google_code = $this->block->data('google_code');
		$this->admin_textarea('google_code', 'Paste here Google Adsense code:', $google_code);
    }

    public function generate_content()
    {
		//Controller
		global $active_controller;
		$user = &$active_controller->user;
        $CI = & get_instance();
		$this->load_generic_styles();
		$google_code = $this->block->data('google_code');
		//View
        $output ='
			<div id="google-adsense-container-'.$this->block->get_id().'">
				'.$google_code.'
			</div>
		';

		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'google-adsense-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), $menu);
		else
			return $output;
    }
}
?>