<?php
class Videotube_register_info_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "VideoTube";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Register Info";
        $info['block_icon'] = "fa-envelope-o";

        return $info;
    }
    public function generate_admin()
    {
    }
    public function generate_style()
    {
    }
    public function generate_content()
    {
		//Controller
        $CI = & get_instance();
        $CI->load->module('videotube');
		$register_info = $CI->BuilderEngine->get_option('videotube_register_info');
		//View
		$output = '
		<div class="well videotube-bg-gray">
			<div class="border-box" style="margin:10px 0 10px 0;">';
				if(!empty($register_info)){
					$output .= $register_info; 
				}
				$output .='
			</div> 
		</div>';

        return $output;
    }
}
?>