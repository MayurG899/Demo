<?php
class Cp_login_button_block_handler extends  block_handler{
	function info()
	{
		$info['category_name'] = "Account Dashboard";
		$info['category_icon'] = "dsf";

		$info['block_name'] = "Account Login Button";
		$info['block_icon'] = "fa-envelope-o public";
		
		return $info;
	}
    public function generate_admin()
    {
		$this->show_placeholder();
    }

    public function generate_content()
    {
		global $active_controller;
		$user = &$active_controller->user;
        $CI = & get_instance();
		$this->load_generic_styles();
		$CI->load->module('cp');

		if($user->is_logged_in())
		{
			$link = base_url('cp/logout');
			$text = 'Log Out';
		}
		else
		{
			$link = base_url('cp/login');
			$text = 'Log In';
		}
		$output ='
				<div id="cp-login-button-'.$this->block->get_name().'">
					<div class="collapse navbar-collapse" id="account-login">
						<ul class="nav navbar-nav" id="header-navbar-7">
							<li>
								<a href="'.$link.'" title="" class="menu-has-sub text-color-7 text-size-7">
									'.$text.'
									<i class="fa fa-angle-down"></i>
								</a>
								<ul class="sub-dropdown dropdown-menu dropdown-menu-left dropdown-background-color-7" style="display: none;">';
									$output .='<li class="dropdown-submenu account-login-dropdown dropdown-background-color-hover-7"><a href="'.$link.'" class="dropdown-color-7 dropdown-size-7" title="">Account '.$text.'</a></li>';
								if($user->is_logged_in())
									$output .='<li class="dropdown-submenu account-login-dropdown dropdown-background-color-hover-7"><a href="'.base_url('cp/dashboard').'" class="dropdown-color-7 dropdown-size-7" title="">My Account Dashboard</a></li>';
								if(!$user->is_logged_in())
									$output .='<li class="dropdown-submenu account-login-dropdown dropdown-background-color-hover-7"><a href="'.base_url('cp/register').'" class="dropdown-color-7 dropdown-size-7" title="">Register Account</a></li></ul>';
							$output .='
							</li>
						</ul>
					</div>
				</div>
		';
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='global_style';
		else
			$menu ='style';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'cp-login-button-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), $menu);
		else
			return $output;
    }
}
?>