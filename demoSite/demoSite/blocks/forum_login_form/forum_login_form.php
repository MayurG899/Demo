<?php
class forum_login_form_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Forum";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Login Form";
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
		if($data == 'info')
			$info = 'You must be signed in or registered user to be able to post !';
		if($data == 'approval')
			$info = 'Your account has been registered and awaiting for approval.Once approved,you will be notified by email!';
		if($data == 'password')
			$info = 'Reset token has been sent to your email address!';
		if(isset($_POST['forum'.$this->block->get_id()]))
		{
			if(isset($_POST['email']))
			{
				$CI->users->send_password_reset_email(urldecode($_POST['email']));
				redirect(base_url('forum/login/password'),'location');
			}
			if(isset($_POST['username']) && isset($_POST['password'])){
				$userid = $CI->users->verify_login($_POST['username'], $_POST['password']);

				if($userid != -1 && $userid != 0)
				{	
					$CI->user->initialize($userid);
					$userdir = 'user'.$userid;
					$url = base_url().'files/forum/'.$userdir;
					$scriptroot = str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']);
					$dir = $scriptroot.'files/forum/'.$userdir;
					if (!file_exists($dir) || !is_dir($dir))
					{
						mkdir($dir,0777);
						//$_SESSION['PGRMNGR']['user_dir'] = $dir;
						//$_SESSION['PGRMNGR']['user_url'] = $url;
						$CI->session->set_userdata('user_dir', $dir);
						$CI->session->set_userdata('user_url', $url);
					}
					else	
					{
						//$_SESSION['PGRMNGR']['user_dir'] = $dir;
						//$_SESSION['PGRMNGR']['user_url'] = $url;
						$CI->session->set_userdata('user_dir', $dir);
						$CI->session->set_userdata('user_url', $url);
					}

					redirect(base_url('forum/all_topics'), 'location');
				}
				else
				{
					$registered_user = new User();
					$registered_user = $registered_user->where('username',$_POST['username'])->where('password',md5($_POST['password']))->get();
					if($registered_user->id > 0 && $registered_user->verified == 'no')
					{
						$error_msg = 'Your account has been registered and awaiting for approval.Once approved,you will be notified by email!';
					}
					else
						$error_msg = 'Invalid username or password';
				}
			}
		}
		$errors = '';
		
		//View
        $output ='';
				$inf =(isset($info)) ? '<h2>'.$info.'</h2>' : '';
				$output .= $inf;
                    $output .='
							<div id="forums-login-form-container-'.$this->block->get_id().'">
                            <div class="well forums-login-area">
                                <h4>Account Login</h4>
                                <form role="form" method="post">
									<input type="hidden" name="forum'.$this->block->get_id().'" value="forumblock" />
                                    <div class="form-group">
                                        <label>Username or Email</label>
                                        <input type="text" class="form-control " placeholder="Enter username or email" name="username">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" placeholder="Enter password" name="password">
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> Remember me
                                        </label>
										<a data-toggle="modal" data-target="#recover-password" href="#" class="btn btn-sm btn-danger pull-right">Forgot password ?</a>
                                    </div>
									
									<br />';
                                    if(isset($error_msg)){
                                      $output .='<p style="color: red; font-weight: bold">'.$error_msg.'</p>';
                                    }                          
                                    $output .='<button type="submit" class="btn btn-sm btn-inverse">SIGN IN</button>
                                </form>
                            </div>
							</div>';
		$output .= '
					<div class="modal fade" id="recover-password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog" style="z-index:100">
							<div class="modal-content" style="width: 75%;min-height: 230px;">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Forgotten Password</h4>
								</div>
								<form method="post">
									<div class="modal-body" style="min-height: 160px;">
										<div class="form-group m-b-20">
											<label style="color:#242a30">Your Email</label>
											<input style="color:#000;width:75%;background: #fff;border: 1px solid rgba(0,0,0,0.4);" type="email" class="form-control input-lg" name="email" placeholder="Email Address"/>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
										<button type="submit" name="forgot" class="btn btn-sm btn-primary">Reset Password</button>
									</div>
								</form>
							</div>
						</div>
					</div>	
		';

        if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
				$menu ='with_settings_global';
			else
				$menu ='with_settings';
			if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
				return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'forums-login-form-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
			else
        return $output;
    }
}
?>