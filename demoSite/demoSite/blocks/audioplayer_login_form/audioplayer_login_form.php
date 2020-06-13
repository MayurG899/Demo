<?php
class Audioplayer_login_form_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Audio Player";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Login Form";
        $info['block_icon'] = "fa-envelope-o public";

        return $info;
    }
    public function generate_admin()
    {
		$this->show_placeholder();
    }
	public function generate_style($active_menu = '')
	{
		
	}
	public function load_generic_styling()
	{
		
	}
    public function generate_content()
    {
 		//Controller
		global $active_controller;
		$user = &$active_controller->user;		
        $CI = & get_instance();
        $CI->load->module('audioplayer');
		$CI->load->model('users');
		$this->load_generic_styles();
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		$data = end($segments);
		if($data =='info')
			$info = 'You must be signed in or registered user to be able to post !';
		elseif($data == 'approval')
			$info = 'Your account has been registered and awaiting for approval.Once approved,you will be notified by email!';
		elseif($data == 'password')
			$info = 'Reset token has been sent to your email address!';
		elseif($data == 'login')
			$info = '';
		else
			$data ='';
		
		if(isset($_POST['audioplayer'.$this->block->get_id()])){
			if (isset($_POST['email'])){
				$CI->users->send_password_reset_email(urldecode($_POST['email']));
				redirect(base_url('audioplayer/login/password'),'location');
			}
            $userid = $CI->users->verify_login($_POST['username'], $_POST['password']);
			$sound_user = new PhotoGalleryUserSettings();
			$sound_user = $sound_user->where('user_id',$userid)->get();
			if($userid != -1 && $userid != 0 && $sound_user->user_id == $userid){	
				$user->initialize($userid);
				if($CI->builderengine->get_option('audioplayer_option')=='open')
					redirect(base_url('/audioplayer/myfeed'), 'location');
				else
					redirect(base_url('/audioplayer/all_audios'), 'location');
			}
			else{
				$registered_user = new User();
				$registered_user = $registered_user->where('username',$_POST['username'])->where('password',md5($_POST['password']))->get();
				if($registered_user->id > 0 && $registered_user->verified == 'no'){
					$error_msg = 'Your account has been registered and awaiting for approval.Once approved,you will be notified by email!';
				}
				elseif($registered_user->id > 0 && $registered_user->verified == 'yes'){
					$error_msg = 'In order to get permission for sound gallery ,please contact your <a href="mailto:'.$CI->BuilderEngine->get_option('adminemail').'?Subject=Photo%20Gallery%20access%20request">admin</a> !';
				}
				else
					$error_msg = 'Invalid username or password';
			}
		}
		
		//View
        $output ='
			<div id="audioplayer-login-form-'.$this->block->get_id().'">
			<div class="well audioplayer-login-area">
				<div class="border-box" style="margin:10px 0 10px 0;">
					<h4>Account Login</h4>';
					$info = (!empty($info)) ? '<h2>'.$info.'</h2>' : '';
					$output .= $info.'
					<form method="post">
						<input type="hidden" name="audioplayer'.$this->block->get_id().'" value="apblock" />
						<div class="form-field-wrapper">
							<label for="login-email">Username / Email Address</label>
							<input type="text" required="" placeholder="Enter your Username or Email" name="username" id="login-email" class="input-sm form-full" aria-required="true">
						</div>
						<div class="form-field-wrapper">
							<label for="login-pass">Password</label>
							<input type="password" required="" placeholder="Enter your Password" name="password" id="login-pass" class="input-sm form-full" aria-required="true">
						</div>';
						if(isset($error_msg)){
						  $output .='<p style="color: red; font-weight: bold">'.$error_msg.'</p>';
						}       
						$output .='<button name="submit" id="form-submit" type="submit" class="btn audiogallery-btn btn-sm btn-inverse">Sign In</button>
						<a data-toggle="modal" data-target="#recover-password" href="#" class="btn btn-sm btn-danger float-right">Forgot Password?</a>
					</form>
				</div>
			</div>';
		$output .='
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
                                    <button type="button" class="btn audiogallery-btn btn-sm btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" name="forgot" class="btn audiogallery-btn btn-sm btn-primary">Reset Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
			</div>';

		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='global_style';
		else
			$menu ='style';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'audioplayer-login-form-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), $menu);
		else
			return $output;
    }
}
?>