  <hr class="topbar"/>
  <div class="container" style="padding-top:20px;">
    <div class="row">
        <div class="col-md-12">     
            <br />
				<?=(isset($info)) ? '<h2>'.$info.'</h2>' : '';?>
            <br />
            <br />
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="row">
                        <div class="col-md-11 col-sm-12">
                            <div class="well">
                                <h2>Sign In</h2>
                                <p>If you have an account with us, please log in.</p>
                                <form role="form" method="post">
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
										<a data-toggle="modal" data-target="#recover-password" href="#" class="pull-right">Forgot password ?</a>
                                    </div>
									
									<br />
                                    <?php if(isset($error_msg)):?>
                                      <p style="color: red; font-weight: bold"><?=$error_msg?></p>
                                    <?php endif;?>                           
                                    <button type="submit" class="btn btn-primary">Sign in</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="row">
                        <div class="col-sm-12 col-md-11 pull-right">
						<?php if(!empty($login_info)):?>
                            <div class="well">
								<?=$login_info?>
								<a href="<?=base_url('booking_events/register')?>" class="btn btn-primary">Create an account</a>
                            </div>  
						<?php endif;?>
                        </div>      
                    </div>      
                </div>      
            </div>
            <br />
            <br />      
            <br />
            <br />
        </div>
    </div>
</div>
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