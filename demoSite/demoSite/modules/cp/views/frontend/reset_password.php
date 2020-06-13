
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->

	<div class="login-cover">
	    <div class="login-cover-image"><img src="<?php echo $url?>" data-id="login-cover-image" alt="" /></div>
	    <div class="login-cover-bg"></div>
	</div>
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin login -->
		<div id="passReset" class="modal fade in bs-example-modal-md" tabindex="-1" role="dialog" data-pageload-addclass="animated flipInX" aria-labelledby="mySmallModalLabel" style="display:block">
			<div class="modal-dialog modal-md" role="document" style="margin-top:15%;">
				<div class="modal-content" style="padding:20px">
					<div class="login-header" style="padding:0;">
						<div class="brand">
							<h1 class="text-center"><i class="fa fa-key"></i> Password Reset Page</h1>
						</div>
					</div>
					<!-- end brand -->
					<div class="login-content">
						<form action="<?=base_url('cp/recover_password/'.$token.'')?>" method="POST" class="margin-bottom-0" id="asd">
							<div class="form-group m-b-20">
								<input type="password" class="form-control input-lg" placeholder="New Password" name="password" id="password" required />
							</div>
							<div class="form-group m-b-20">
								<input type="password" class="form-control input-lg" placeholder="Confirm New Password" name="password_re" id="password_re" required />
							</div>
									<?php if($error == true):?>
										<h3 style="color:red;margin-left:30px;"><strong> Passwords do not match !</strong></h3>
									<?php endif;?>
							<div class="reset-buttons">
								<button type="submit" class="btn btn-success btn-block btn-lg">Save New Password</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

        <!-- end login -->
	</div>
	<!-- end page container -->
    <script src="<?=base_url('modules/cp/assets/js/jquery.validate.min.js')?>"></script>
    <script src="<?=base_url('modules/cp/assets/js/reset_password.js')?>"></script>
