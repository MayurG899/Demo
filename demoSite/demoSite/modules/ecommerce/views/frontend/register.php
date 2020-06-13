<link href="<?=base_url('/builderengine/public/editor/css/special.css')?>" rel="stylesheet" type="text/css" />
<style>
    .account-type-button{
        font-size: 23px;
        padding: 16px 32px;
    }
</style>
<hr class="topbar"/>
<div class="container">
    <br />
    <div class="row">
            <div class="col-md-12">
                <h1>Register New Store Account</h1>
                <hr />
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <form class="form-vertical" method="post">
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-12" >
                                        <div class="well">
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
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" required> Agree with <a style="color:#348fe2" href="<?=$this->BuilderEngine->get_option('be_ecommerce_settings_url')?>" target="_blank">Terms and Conditions</a>
                                                </label>
                                            </div>
                                            <?if($error == 'password'):?>
                                                <br />
                                                <h3 style="color:red;font-weight:bold">Entered passwords do not match</h3>
                                            <?endif;?>
                                            <?if($error == 'exists'):?>
                                                <br />
                                                <h3 style="color:red;font-weight:bold">Username or email taken</h3>
                                            <?endif;?>
                                            <br />
                                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-users" aria-hidden="true"></i> Create Account</button>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <div class="col-md-6 col-sm-12 account-sidebar hidden-sm">
                        <?=$this->BuilderEngine->get_option("be_ecommerce_settings_register_info");?>
                    </div>
                </div>

            </div>
        </div>
    </div>
<script>
	$(document).ready(function() {
		$('#fname').focus();
	});
</script>