<?php
class Cp_header_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Account Dashboard";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Account Dashboard Header";
        $info['block_icon'] = "fa-envelope-o";

        return $info;
    }

    public function generate_admin()
    {
		$this->show_placeholder();
    }

    public function generate_content()
    {
		//Controller
		global $active_controller;
		$user = &$active_controller->user;
        $CI = & get_instance();
		$this->load_generic_styles();

		//View
        $output ='
			<!-- begin #header -->
					<div id="be-uaccount-header" class="navbar-inverse be-uaccount-navbar-inverse">
							<!-- begin mobile sidebar expand / collapse button -->
							<div class="">
								<button type="button" class="navbar-toggle be-uaccount-navbar-toggle" data-click="sidebar-toggled">
									<span><i class="fa fa-home fa-1x"></i> My Account</span>
								</button>
							</div>
							<!-- end mobile sidebar expand / collapse button -->
					</div>
			<!-- end #header -->
		';
		if(!$user->is_guest())
			return $output;
    }
}
?>