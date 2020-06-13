<?php
class forum_register_info_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Forum";
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
		//require_once('assets_loader.php');

		global $active_controller;
		$user = &$active_controller->user;		
        $CI = & get_instance();
        $CI->load->module('forum');
		$register_info = $CI->BuilderEngine->get_option('forum_register_info');
		
		//View
        $output ='
			<style> .well img{max-width:100% !important;} </style><br/><br/><br/>';
				if(!empty($register_info)){
					$output .='<div class="well" style="background:#f5f5f5;">
						'.$register_info.'
					</div> '; 
				}
        return $output;
    }
}
?>