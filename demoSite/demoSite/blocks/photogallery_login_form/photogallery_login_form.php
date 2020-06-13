<?php
class photogallery_login_form_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Photo Gallery";
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
    public function apply_custom_css()
    {
        $style_arr = $this->block->data("style");
        if(!isset($style_arr['color']))
            $style_arr['color'] = '';
        if(!isset($style_arr['text-align']))
            $style_arr['text-align'] = '';
        if(!isset($style_arr['background-color']))
            $style_arr['background-color'] = '';

        return '
        <style>
        div[name="'.$this->block->get_name().'"] h1{
                color: '.$style_arr['color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] h2{
                color: '.$style_arr['color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] h3{
                color: '.$style_arr['color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] h4{
                color: '.$style_arr['color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] h5{
                color: '.$style_arr['color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] p{
            /*    color: '.$style_arr['color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] span{
            /*    color: '.$style_arr['color'].' !important; */
                text-align: ' . $style_arr['text-align'].' !important;
            /*    background-color: ' . $style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] div{
                color: '.$style_arr['color'].' !important;
                text-align: '.$style_arr['text-align'].' !important;
            /*    background-color: '.$style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] ul{
                color: '.$style_arr['color'].' !important;
                text-align: '.$style_arr['text-align'].' !important;
            /*    background-color: '.$style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] ol{
                color: ' . $style_arr['color'].' !important;
                text-align: ' . $style_arr['text-align'].' !important;
             /*   background-color: ' . $style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] li{
                color: '.$style_arr['color'].' !important;
                text-align: ' . $style_arr['text-align'].' !important;
            /*    background-color: ' . $style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] a{
            /*    color: '.$style_arr['color'].' !important; */
        }
		.bckgrd{
			background-color: '.$style_arr['background-color'].' !important;
		}
        </style>';
    }
    public function generate_content()
    {
 		//Controller
		global $active_controller;
		$user = &$active_controller->user;		
        $CI = & get_instance();
		$this->load_generic_styles();
        $CI->load->module('photogallery');
		$CI->load->model('users');
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
		/*
		if($_POST){
			if (isset($_POST['email'])){
				$CI->users->send_password_reset_email(urldecode($_POST['email']));
				redirect(base_url('photogallery/login/password'),'location');
			}
            $userid = $CI->users->verify_login($_POST['username'], $_POST['password']);
			$photo_user = new PhotoGalleryUserSettings();
			$photo_user = $photo_user->where('user_id',$userid)->get();
			if($userid != -1 && $userid != 0 && $photo_user->user_id == $userid){	
				$user->initialize($userid);
				$userdir = 'user'.$userid;
				$url = base_url().'files/photogallery/'.$userdir;
				$scriptroot = str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']);
				$photogallery = $scriptroot.'files/photogallery/';
				$userdirectory = $scriptroot.'files/photogallery/'.$userdir;

				if (!file_exists($userdirectory) || !is_dir($userdirectory)){
					mkdir($photogallery,0777,true);
					mkdir($userdirectory,0777,true);
					$CI->session->set_userdata('user_dir', $userdirectory);
					$CI->session->set_userdata('user_url', $url);
				}
				else{
					$CI->session->set_userdata('user_dir', $userdirectory);
					$CI->session->set_userdata('user_url', $url);
				}
				if($CI->builderengine->get_option('photogallery_option')=='open')
					redirect(base_url('/photogallery/myfeed'), 'location');
				else
					redirect(base_url('/photogallery/all_photos'), 'location');
			}
			else{
				$registered_user = new User();
				$registered_user = $registered_user->where('username',$_POST['username'])->where('password',md5($_POST['password']))->get();
				if($registered_user->id > 0 && $registered_user->verified == 'no'){
					$error_msg = 'Your account has been registered and awaiting for approval.Once approved,you will be notified by email!';
				}
				elseif($registered_user->id > 0 && $registered_user->verified == 'yes'){
					$error_msg = 'In order to get permission for photo gallery ,please contact your <a href="mailto:'.$CI->BuilderEngine->get_option('adminemail').'?Subject=Photo%20Gallery%20access%20request">admin</a> !';
				}
				else
					$error_msg = 'Invalid username or password';
			}
			
		}
		*/
		//View
        $output ='
			<div id="photogallery-login-form-'.$this->block->get_id().'">
				<div class="well photogallery-login-area">
				<div class="border-box" style="margin:10px 0 10px 0;">
					<h4>Account Login</h4>';
					$info = (!empty($info)) ? '<h2>'.$info.'</h2>' : '';
					$output .= $info.'
					<form method="post">
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
						$output .='<button name="submit" id="form-submit" type="submit" class="btn btn-sm btn-inverse">SIGN IN</button>
						<a data-toggle="modal" data-target="#recover-password" href="#" class="btn btn-sm btn-danger float-right">Forgot password?</a>
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
                                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" name="forgot" class="btn btn-sm btn-primary">Reset Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
			</div>';

		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'photogallery-login-form-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), $menu);
		else
			return $output.$this->apply_custom_css();
    }
}
?>