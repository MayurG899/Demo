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
                    <div class="col-md-6">
                        <div class="border-box">
                            <h4>Account Login</h4>
							<?=(isset($info)) ? '<h2>'.$info.'</h2>' : '';?>
                            <form method="post">
                                <div class="form-field-wrapper">
                                    <label for="login-email">Username / Email Address</label>
                                    <input type="text" required="" placeholder="Enter your Username or Email" name="username" id="login-email" class="input-sm form-full" aria-required="true">
                                </div>
                                <div class="form-field-wrapper">
                                    <label for="login-pass">Password</label>
                                    <input type="password" required="" placeholder="Enter your Password" name="password" id="login-pass" class="input-sm form-full" aria-required="true">
                                </div>
								<?php if(isset($error_msg)):?>
								  <p style="color: red; font-weight: bold"><?=$error_msg?></p>
								<?php endif;?>       
                                <button name="submit" id="form-submit" type="submit" class="btn btn-md btn-black">Sign In</button>
                                <a data-toggle="modal" data-target="#recover-password" href="#" class="float-right">Forgot password?</a>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border-box">
						<?php if(!empty($login_info)):?>
                            <?=$login_info?>
                            <a href="<?=base_url('photogallery/register')?>" class="btn btn-md btn-black">Register</a>
						<?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" name="forgot" class="btn btn-primary">Reset Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        <!-- End Login Section -->
        <!-- End CONTENT ------------------------------------------------------------------------------>
    </div>
    <!-- Site Wraper End -->