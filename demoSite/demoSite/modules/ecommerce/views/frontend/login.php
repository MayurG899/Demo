<link href="<?=base_url('/builderengine/public/editor/css/special.css')?>" rel="stylesheet" type="text/css" />
<hr class="topbar"/>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <br />
            <br />
            <?=(isset($info)) ? '<h2>'.$info.'</h2>' : '';?>
            <br />
            <br />
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="row">
                        <div class="col-md-11 col-sm-12">
                            <div class="well">
                                <h2>Account Login</h2>
                                <p>If you have an account with us, please log in.</p>
                                <form role="form" method="post">
                                    <div class="form-group">
                                        <label>Username or Email</label>
                                        <input type="text" class="form-control " id="user" placeholder="Enter username or email" name="username">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" placeholder="Enter password" name="password">
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> Remember me
                                        </label>
                                    </div><br />
                                    <?php if(isset($error_msg)):?>
                                        <p style="color: red; font-weight: bold"><?=$error_msg?></p>
                                    <?php endif;?>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-sign-in" aria-hidden="true"></i> Sign in</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="row">
                        <div class="col-sm-12 col-md-11 pull-right">
                            <div class="well">
                                <?=$this->BuilderEngine->get_option("be_ecommerce_settings_log_in_info");?>
                                <a href="<?=base_url('ecommerce/register')?>" class="btn btn-primary btn-sm"><i class="fa fa-users" aria-hidden="true"></i> Create an account</a>
                            </div>
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
<script>
	$(document).ready(function() {
		$('#user').focus();
	});
</script>