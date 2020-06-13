<?php
class Cp_login_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Account Dashboard";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Account Dashboard Login Page";
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
		$CI->load->model('users');
		$this->load_generic_styles();
		$fb_login = $CI->BuilderEngine->get_option('facebook_login');
		$fb_app_id = $CI->BuilderEngine->get_option('facebook_app_id');
		$fb_app_secret = $CI->BuilderEngine->get_option('facebook_app_secret');
        if (isset($_POST['forgot'])) {
            $CI->users->send_password_reset_email(urldecode($_POST['email']));
        }

		$option = $CI->BuilderEngine->get_option('user_login_option');
		if($option == 'both')
			$placeholder = 'Username or Email Address';
		if($option == 'email')
			$placeholder = 'Email Address';
		if($option == 'username')
			$placeholder = 'Username';	
		//View
        $output ='
			<div id="page-container" class="fade">
				<!-- begin login -->
				<div class="beaccount-login-main">
					<!-- begin -->
					<div class="">
						<!-- begin login-header -->
						<div class="beaccount-login-header">
							<div class="beaccount-login-title">
								<h2><i class="fa fa-user text-default"></i> '.$CI->BuilderEngine->get_option('login_title').'</h2>
								<small>'.$CI->BuilderEngine->get_option('login_description').'</small>
							</div>
						</div>
						<!-- end login-header -->
						<!-- begin login-content -->
						<div class="beaccount-login-content">
							<form action="#" method="POST" class="margin-bottom-0">
								<div class="form-group m-b-15">
									<input type="text" class="form-control form-control-be-40 input-lg" placeholder="'.$placeholder.'" id="user" />
								</div>
								<div class="form-group m-b-15">
									<input type="password" class="form-control form-control-be-40 input-lg" placeholder="Password" id="password" />
								</div>
								<div class="checkbox beaccount-login-remember">
									<label>
										<input type="checkbox" /> Remember Me
									</label>
									<label class="beaccount-login-forgot-link">
										<a id="forgot" data-toggle="modal" data-target="#recover-password" href="#recover-password">Forgot Password?</a>
									</label>
								</div>
								<div class="login-buttons beaccount-login-buttons">
									<button type="submit" class="btn btn-info btn-block btn-lg beaccount-login-buttons-text">Log In</button><br/>';
									if($fb_login == 'on' && $fb_app_id  != '' && $fb_app_secret != ''){
										$output .='
										<script src="'.base_url('modules/cp/assets/js/facebook_login.js').'"></script>
										<span id="fb-app-id" data-app-id="'.$fb_app_id.'"></span>
										<div class="text-center">
											<div onlogin="checkLoginState()" scope="public_profile,email" class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="true"></div>
										</div>';
									}
								$output .='
								</div>';
								if($CI->BuilderEngine->get_option('login_count_attempts') == 'yes'){
									$output .='
									<div id="securityAlert" class="alert alert-danger m-t-20" style="display:none">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
										$hours = (($CI->BuilderEngine->get_option('login_attempt_expire')/60)/60);
										$output .='
										<p>
											<i class="fa fa-info-circle"></i> 
											You have exceeded the number of allowed login attempts 
											and your account has been temporary suspended due to security reasons.
											Please,contact <span data-toggle="tooltip" data-placement="top" title="'.$CI->BuilderEngine->get_option('adminemail').'"><strong>Admin</strong> </span> or try again in '.$hours.' hours.
										</p>
									</div>';
								}
								$output .='
									<div id="fb_error" class="alert alert-danger" style="display:none;">
										<h4 class="text-center"><i class="fa fa-exclamation-triangle"></i> <span id="fb_status" ></span></h4>
										<p id="fb_message" class="text-center"></p>
									</div>
								 <hr>
								 
								 <div class="beaccount-login-footer-register">
									<small><a href="'.base_url('cp/register').'" class="text-success"><b>Create an Account</b></a></small>
									<small> for access to our membership dashboard.</small>
								</div>

							</form>
							<div class="modal fade" id="recover-password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog" style="z-index:100">
									<div class="modal-content beaccount-login-modalcontent">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h5 class="modal-title" id="myModalLabel">Reset Your Password</h5>
										</div>
										<form method="post">
											<div class="modal-body">
												<div class="form-group m-b-20">
													<label style="color:#242a30">Account Email: </label>
													<input style="color:#000;width:70%;background: #fff;height: 40px;" type="email" class="form-control form-control-be-40 input-lg" name="email" placeholder="Your Email Address"/>
												</div>
											</div>
											<div class="modal-footer beaccount-login-modalfooter">
												<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
												<button type="submit" name="forgot" class="btn btn-danger btn-sm">Reset Password</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<!-- end login-content -->
					</div>
					<!-- end right-container -->
				</div>
				<!-- end login -->
				<script>
					var site_root = "'.home_url("").'";
				</script>
				<script src="'.base_url('modules/cp/assets/plugins/jquery/jquery-1.9.1.min.js').'"></script>
				<script src="'.base_url('modules/cp/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js').'"></script>
				<!--[if lt IE 9]>
					<script src="'.base_url('modules/cp/assets/crossbrowserjs/html5shiv.js').'"></script>
					<script src="'.base_url('modules/cp/assets/crossbrowserjs/respond.min.js').'"></script>
					<script src="'.base_url('modules/cp/assets/crossbrowserjs/excanvas.min.js').'"></script>
				<![endif]-->
				<script src="'.base_url('modules/cp/assets/plugins/slimscroll/jquery.slimscroll.min.js').'"></script>
				<script src="'.base_url('modules/cp/assets/plugins/jquery-cookie/jquery.cookie.js').'"></script>
				<script src="'.base_url('modules/cp/assets/js/jquery.validate.min.js').'"></script>
				<!-- ================== END BASE JS ================== -->

				<!-- ================== BEGIN BuilderEngine JS ================== -->
				<script src="'.base_url('modules/cp/assets/js/login.js').'"></script>
				<!-- ================== END BuilderEngine JS ================== -->

				<!-- ================== BEGIN PAGE LEVEL JS ================== -->
				<script src="'.base_url('modules/cp/assets/js/apps.min.js').'"></script>
				<!-- ================== END PAGE LEVEL JS ================== -->
				<script>
					$(document).ready(function() {
						App.init();
						$("#user").focus();
						$("#forgot").on("click",function(){
							//$("#recover-password").modal("show");
						});
					});
				</script>
			</div>
		';

        return $output;
    }
}
?>