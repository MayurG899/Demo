<?php require_once('assets_loader.php');?>	
    <!-- Preloader -->
    <section id="preloader">
        <div class="loader" id="loader">
            <div class="loader-img"></div>
        </div>
    </section>
    <!-- End Preloader -->
    <!-- Site Wraper -->
    <div class="wrapper">
        <!-- CONTENT --------------------------------------------------------------------------------->
        <!-- Login Section -->
        <section id="Pricing" class="ptb">
            <div class="container">
                <div class="row">
                    <div class="col=lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="border-box">
                            <h4>Create an Account</h4>
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
                                    <label for="signup-pass">Choose Password</label>
                                    <input type="password" required="" placeholder="Enter Password" name="password" id="signup-pass" class="input-sm form-full" aria-required="true">
                                </div>
                                <div class="form-field-wrapper">
                                    <label for="signup-pass">Re-enter Password</label>
                                    <input type="password" required="" placeholder="Enter Re-enter Password" name="password_re" id="signup-re-pass" class="input-sm form-full" aria-required="true">
                                </div>
								<?php if(!empty($photogallery_terms)):?>
								<div class="checkbox">
									<label>
										<input type="checkbox" style="-webkit-appearance:checkbox;" required> Agree with <a href="<?=$photogallery_terms?>" target="_blank" >Terms and Conditions</a>
									</label>
								</div>
								<?php endif;?>
								<?php if($error == 'password'):?>
									<br />
									<h3 style="color:red;font-weight:bold">Entered passwords do not match</h3>
								<?php endif;?>
								<?php if($error == 'exists'):?>
									<br />
									<h3 style="color:red;font-weight:bold">Username or email taken</h3>
								<?php endif;?>
                                <button name="submit" id="form-submit" type="submit" class="btn btn-md btn-black">Register Account</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<?php if(!empty($register_info)):?>
                            <div class="well">
								<?=$register_info?>
                            </div>  
						<?php endif;?>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Login Section -->
        <!-- End CONTENT ------------------------------------------------------------------------------>
    </div>
    <!-- Site Wraper End -->