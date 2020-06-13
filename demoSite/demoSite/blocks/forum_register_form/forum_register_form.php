<?php
class forum_register_form_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Forum";
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
		//require_once('assets_loader.php');

		global $active_controller;
		$user = &$active_controller->user;		
        $CI = & get_instance();
        $CI->load->module('forum');
		$CI->load->model('users');
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$this->load_generic_styles();
		$single_element = '';
		$count = count($segments);
		$data = $segments[$count-1];
		
        $error = '';
		if($_POST)
		{
			if(isset($_POST['password']) && isset($_POST['password_re'])){
				if($_POST['password'] != $_POST['password_re'])
					$error = 'password';
				else
				{
					$created = $CI->users->register_user($_POST);
					if($created != false)
					{
					   // if(isset($_GET['token']) && $_GET['token'] != '')
						redirect(base_url('/forum/login/approval'), 'location');
					}
					else
						$error = 'exists';
				}
			}
		}
		$forum_terms = $CI->BuilderEngine->get_option('forum_terms');
		$forum_terms = (!empty($forum_terms))?$forum_terms:'';
		
		//View
        $output ='
						<div id="forums-register-form-container-'.$this->block->get_id().'">
						<form class="form-vertical" method="post">
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-12" >
                                        <div class="well forums-login-area">
										<h4>Account Creation</h4>
                                            <div class="form-group">
                                                <label for="fname">First name</label>
                                                <input type="text" name="first_name" class="form-control" id="fname" placeholder="Your first name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="faname">Last name</label>
                                                <input type="text" name="last_name" class="form-control" id="lname" placeholder="Your last name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email address</label>
                                                <input type="email" name="email" class="form-control" id="email" placeholder="Your email" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" name="username" class="form-control" id="username" placeholder="Desired username" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" class="form-control" id="password" placeholder="Your password" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="password_re">Repeat password</label>
                                                <input type="password" name="password_re" class="form-control" id="password_re" placeholder="Your password again" required>
                                            </div>';
											if(!empty($forum_terms)){
                                                $output .='<div class="checkbox">
                                                <label>
                                                    <input type="checkbox" required> Agree with <a href="'.$forum_terms.'" target="_blank" >Terms and Conditions</a>
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
                                            $output .='<br />
                                            <button type="submit" class="btn btn-sm btn-inverse">REGISTER ACCOUNT</button>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
					</div>
		';

        if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
				$menu ='with_settings_global';
			else
				$menu ='with_settings';
			if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
				return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'forums-register-form-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
			else
        return $output;
    }
}
?>