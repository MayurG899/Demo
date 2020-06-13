<?php
class forum_login_info_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Forum";
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
		//require_once('assets_loader.php');

		global $active_controller;
		$user = &$active_controller->user;		
        $CI = & get_instance();
        $CI->load->module('forum');
		$login_info = $CI->BuilderEngine->get_option('forum_login_info');
		
		//View
        $output ='<style> .well img{max-width:100% !important;} </style>';
			if(!empty($login_info)){
				$output .='<div class="well" style="background:#f5f5f5;">
					'.$login_info.'
					<a href="'.base_url('forum/register').'" class="btn btn-primary">Create an account</a>
				</div>  ';
			}
        return $output;
    }
}
?>