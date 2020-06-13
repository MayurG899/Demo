<?php
class Videotube_register_form_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "VideoTube";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Register Form";
        $info['block_icon'] = "fa-envelope-o public";

        return $info;
    }
    public function generate_admin()
    {
		$this->show_placeholder();
    }
    public function generate_style()
    {
    }
    public function generate_content()
    {
 		//Controller
        $CI = & get_instance();
        $CI->load->module('videotube');
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$this->load_generic_styles();
		$single_element = '';
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		$error = $segments[$count-1];
		
		if($error == 'register')
			$error = '';
		
		$videotube_terms = $CI->BuilderEngine->get_option('videotube_terms');
		
        $output ='	<div id="videotube-register-form-container-'.$this->block->get_id().'">
					<div class="well videotube-bg-gray">
					<div class="border-box" style="margin:10px 0 10px 0;">
						<h4>Account Creation</h4>
						<form method="post">
							<div class="form-field-wrapper">
								<label for="login-username">Choose Username</label>
								<input type="text" required="" placeholder="Enter your Username" name="username" id="signup-username" class="input-sm form-full" aria-required="true">
							</div>
							<div class="form-field-wrapper">
								<label for="login-email">Email Address</label>
								<input type="email" required="" placeholder="Enter your Name" name="email" id="signup-name" class="input-sm form-full" aria-required="true">
							</div>
							<div class="form-field-wrapper">
								<label for="login-first-name">First Name</label>
								<input type="text" required="" placeholder="Enter your First Name" name="first_name" id="signup-first-name" class="input-sm form-full" aria-required="true">
							</div>
							<div class="form-field-wrapper">
								<label for="login-last-name">Last Name</label>
								<input type="text" required="" placeholder="Enter your Last Name" name="last_name" id="signup-last-name" class="input-sm form-full" aria-required="true">
							</div>
							<div class="form-field-wrapper">
								<label for="signup-pass">Choose Password</label>
								<input type="password" required="" placeholder="Enter Password" name="password" id="signup-pass" class="input-sm form-full" aria-required="true">
							</div>
							<div class="form-field-wrapper">
								<label for="signup-pass">Re-enter Password</label>
								<input type="password" required="" placeholder="Enter Re-enter Password" name="password_re" id="signup-re-pass" class="input-sm form-full" aria-required="true">
							</div>';
							if(!empty($videotube_terms)){
								$output .='<div class="checkbox">
									<label>
										<input type="checkbox" style="-webkit-appearance:checkbox;" required> Agree with <a href="'.$videotube_terms.'" target="_blank" >Terms and Conditions</a>
									</label>
								</div>';
							}
							if($error == 'password'){
								$output .='<br />
								<h3 style="color:red;font-weight:bold">Entered passwords do not match</h3>';
							}
							if($error == 'exists'){
								$output .='<br />
								<h3 style="color:red;font-weight:bold">Username or email taken</h3>';
							}
							$output .='<button name="submit" id="form-submit" type="submit" class="btn btn-sm btn-inverse">Register Account</button>
						</form>
					</div>
				</div></div>';
				if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
				$menu ='with_settings_global';
			else
				$menu ='with_settings';
			if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
				return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'videotube-register-form-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
			else
        return $output;
    }
}
?>