<?php
class Audioplayer_login_info_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Audio Player";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Login Info";
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
		global $active_controller;
		$user = &$active_controller->user;		
        $CI = & get_instance();
        $CI->load->module('audioplayer');
		$login_info = $CI->BuilderEngine->get_option('audioplayer_login_info');
		
		//View
        $output ='<div class="well audioplayer-login-area">
		<div class="border-box" style="margin:10px 0 10px 0;">';
					if(!empty($login_info)){
						$output .= $login_info;
						$output .='<a href="'.base_url('audioplayer/register').'" class="btn btn-sm btn-success">CREATE NEW ACCOUNT</a>';
					}
        $output .='</div></div>';

        return $output;
    }
}
?>