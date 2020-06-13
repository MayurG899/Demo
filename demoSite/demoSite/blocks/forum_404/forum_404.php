<?php
class forum_404_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Forum";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "404";
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
	
        $CI = & get_instance();
        $CI->load->module('forum');
		
		//View
        $output ='
			<!-- ================== END BASE CSS STYLE ================== -->
			<script type="text/javascript" src="'.base_url('modules/forum/assets/plugins/ckeditor/ckeditor.js').'"></script>
			<!-- ================== BEGIN BASE JS ================== -->	
				<div class="content">
					<h1 class="text-center" style="font-size:72px;">404</h1>
					<p class="text-center" style="font-size:50px;margin-bottom:20px;"> Oops, the forum is not active .</p>
					<br/>
					<p class="go-back text-center" style="font-size:50px;">
					Please return to our <a href="'.base_url().'">Home page</a>.
					</p>
				</div>';

        return $output;
    }
}
?>