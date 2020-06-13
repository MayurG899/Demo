<link href="<?=base_url('/builderengine/public/editor/css/special.css')?>" rel="stylesheet" type="text/css" />
<div id="wrapper">
    <div id="shop">
        <section class="container">
            <div class="row">

                <aside class="col-md-3">
                    <h3>User menu</h3>
                    <ul class="nav nav-list">
                        <li><a style="pointer-events: none; background-color: #E2E2E2;" href="<?=base_url('ecommerce/account')?>"><i class="fa fa-circle-o"></i> Account</a></li>
                        <li><a href="<?=base_url('ecommerce/edit_profile')?>"><i class="fa fa-circle-o"></i> Edit Profile</a></li>
                    </ul>
                </aside>

                <div class="col-md-7 col-md-offset-1">
                    <h2><strong>Account</strong> Info</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Name</label>
                            <p><?=$member->name?></p>
                        </div>
                        <div class="col-md-6">
                            <label>E-mail</label>
                            <p><?=$member->email?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Telephone</label>
                            <p><?=$member->extended_info->get()->telephone?></p>
                        </div>
                        <div class="col-md-6">
                            <label>Country</label>
                            <p><?=$member->extended_info->get()->country?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>State</label>
                            <p><?=$member->extended_info->get()->state?></p>
                        </div>
                        <div class="col-md-6">
                            <label>City</label>
                            <p><?=$member->extended_info->get()->city?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Address</label>
                            <p><?=$member->extended_info->get()->address?></p>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
</div>