<?php
class Cp_register_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Account Dashboard";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Account Dashboard Registration";
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

		//View
        $output ='
			<div id="page-container" class="fade">
			<!-- begin register -->
			<div class="beaccount-register-main">

				<!-- begin -->
				<div class="">
					<!-- begin register-header -->
					<div class="beaccount-login-header">
							<div class="beaccount-login-title">
								<h2><i class="fa fa-user text-default"></i> '.$CI->BuilderEngine->get_option('register_title').'</h2>
								<small>'.$CI->BuilderEngine->get_option('register_description').'</small>
							</div>
						</div>
					<!-- end register-header -->
					<!-- begin register-content -->
					<div class="beaccount-register-content">
						<!-- <form action="index.html" method="POST" class="margin-bottom-0"> -->
						<form class="pure-form" id="asd">
							<label class="control-label">Name</label>
							<div class="row row-space-10">
								<div class="col-md-6 m-b-15">
									<input type="text" class="form-control form-control-be-40" placeholder="First Name" id="first_name" required/>
									<div data-name="first_name"></div>
								</div>
								<div class="col-md-6 m-b-15">
									<input type="text" class="form-control form-control-be-40" placeholder="Last Name" id="last_name" required/>
									<div data-name="last_name"></div>
								</div>
							</div>
							<label class="control-label">Email</label>
							<div class="row m-b-15">
								<div class="col-md-12">
									<input type="email" class="form-control form-control-be-40" placeholder="Email Address" id="email" required/>
									<div data-name="email"></div>
								</div>
							</div>
							<label class="control-label">Password</label>
							<div class="row m-b-15">
								<div class="col-md-12">
									<input type="password" class="form-control form-control-be-40" placeholder="Create Password" name="password" id="password" required/>
									<div data-name="password"></div>
								</div>
							</div>
							<label class="control-label">Confirm Password</label>
							<div class="row m-b-15">
								<div class="col-md-12">
									<input type="password" class="form-control form-control-be-40" placeholder="Confirm Password" name="confirm_password" id="confirm_password" required/>
								</div>
							</div>';
							if($CI->BuilderEngine->get_option('extra_registration_active') == 'yes' && $CI->BuilderEngine->get_option('extra_registration_usergroups') != ''){
								$output .='
								<label class="control-label">Account Type</label>
								<div class="row m-b-15">
									<div class="col-md-12">
										<select id="account_type" class="form-control form-control-be-40" name="account_type" required/>';
											$extra_usergroups = explode(',',$CI->BuilderEngine->get_option('extra_registration_usergroups'));
											foreach($extra_usergroups as $group){
												$output .='<option value="'.$group.'">'.ucwords(str_replace('Group','',$group)).'</option>';
											}
											$output .='
										</select>
									</div>
								</div>';
							}
							$output .='
							<div class="checkbox beaccount-register-terms">
								<label>
									<input id="tc" type="checkbox" name="tc" style="-webkit-appearance:checkbox;" required /> By signing up, you agree to our <a href="'.base_url('page-terms.html').'">Terms of Use</a>, and <a href="'.base_url('page-privacy.html').'">Privacy Policy</a>.
									<div id="tcc" data-name="tc" style="color:red;"></div>
								</label>
							</div>
							<div class="registration-buttons beaccount-register-buttons">
								<button type="submit" class="btn btn-info btn-block btn-lg beaccount-register-buttons-text">Sign-Up</button>
								<div data-name=""></div>
							</div>

							<hr>
								 
								 <div class="beaccount-login-footer-register">
									<small><a href="'.base_url('cp/login').'" class="text-success">Already have an Account? <b>Login Here</b></a></small>
									<small> for access to our membership dashboard.</small>
								</div>
						</form>
					</div>
					<!-- end register-content -->
				</div>
				<!-- end right-content -->
			</div>
			<!-- end register -->
			<script>
				var site_root = "'.home_url("").'";
			</script>
			<script src="'.base_url('modules/cp/assets/plugins/jquery/jquery-1.9.1.min.js').'"></script>
			<script src="'.base_url('modules/cp/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js').'"></script>
			<script src="'.base_url('modules/cp/assets/plugins/bootstrap/js/bootstrap.min.js').'"></script>
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
			<script src="'.base_url('modules/cp/assets/js/registration.js').'"></script>
			<!-- ================== END BuilderEngine JS ================== -->

			<!-- ================== BEGIN PAGE LEVEL JS ================== -->
			<script src="'.base_url('modules/cp/assets/js/apps.min.js').'"></script>
			<!-- ================== END PAGE LEVEL JS ================== -->

			<script>
				$("#tc").change(function(){
					var c = this.checked ? "none" : "block";
					$("#tcc").css("display", c);
				});
				$(document).ready(function() {
					App.init();
					//LoginV2.init();
					$("#username").focus();
				});
			</script>
			</div>
			<!-- end page container -->
		';

        return $output;
    }
}
?>