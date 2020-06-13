<link href="<?=base_url('modules/classifieds/assets/css/bootstrap.css')?>" rel="stylesheet">
<link href="<?=base_url('modules/classifieds/assets/css/theme.css')?>" rel="stylesheet">
<link href="<?=base_url('modules/classifieds/assets/css/style.css')?>" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

  <hr class="topbar"/>
  <div class="container">
    <div class="row">
        <div class="col-sm-12">     
            <br />
            <br />      
            <br />
            <br />
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="row">
                        <div class="col-md-11 col-sm-12">
                            <div class="well">
                                <h2>Sign in</h2>
                                <p>If you have an account with us, please log in.</p>
                                <form role="form" method="post">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control " placeholder="Enter username" name="username">
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
                                    <?if(isset($error_msg)):?>
                                      <p style="color: red; font-weight: bold"><?=$error_msg?></p>
                                    <?endif;?>                           
                                    <button type="submit" class="btn btn-primary">Sign in</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="row">
                        <div class="col-sm-12 col-md-11 pull-right">
                            <div class="well">
                                <h2>Register</h2>
                                <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p><br />
                                <a href="<?=base_url('classifieds/register')?>" class="btn btn-primary">Create an account</a>
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