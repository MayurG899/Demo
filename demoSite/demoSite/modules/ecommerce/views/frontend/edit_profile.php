<link rel="stylesheet" type="text/css" href="<?=base_url()?>modules/ecommerce/assets/css/ecommerce_styles.css">

<div id="wrapper">

    <div id="shop">

        <section class="container">

            <div class="row">

                <!-- REGISTER -->
                <aside class="col-md-3">
                    <h3>User menu</h3><!-- h3 - have no margin-top -->
                    <ul class="nav nav-list">
                        <li><a href="<?=base_url('ecommerce/account')?>"><i class="fa fa-circle-o"></i> Account</a></li>
                        <li><a style="pointer-events: none; background-color: #E2E2E2;" href="#"><i class="fa fa-circle-o"></i> Edit Profile</a></li>
                    </ul>
                </aside>
                <div class="col-md-7 col-md-offset-1">

                    <h2><strong>Edit</strong> Profile</h2>

                    <form class="white-row" method="post">

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="<?=$member->name?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label>E-mail</label>
                                    <input type="text" name="email" class="form-control" value="<?=$member->email?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label>Telephone</label>
                                    <input type="text" name="telephone" class="form-control" value="<?=$member->extended_info->get()->telephone?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label>Country</label>
                                    <input type="text" name="country" class="form-control" value="<?=$member->extended_info->get()->country?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label>State</label>
                                    <input type="text" name="state" class="form-control" value="<?=$member->extended_info->get()->state?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label>City</label>
                                    <input type="text" name="city" class="form-control" value="<?=$member->extended_info->get()->city?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control" value="<?=$member->extended_info->get()->address?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="submit" value="Save Changes" class="limobtn limobtn-primary pull-right push-bottom" data-loading-text="Loading...">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </section>

    </div>
</div>