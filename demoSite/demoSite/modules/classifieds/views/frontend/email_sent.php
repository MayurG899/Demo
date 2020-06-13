<link href="<?=base_url('modules/classifieds/assets/css/theme.css')?>" rel="stylesheet">
<link href="<?=base_url('modules/classifieds/assets/css/style.css')?>" rel="stylesheet">
<div class="classifieds-top-bar">
<div class="breadcrumb-row">
	<div class="container classifieds">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  
            <ol class="breadcrumb">
                <li><a href="<?=base_url()?>classifieds/view_category/All">Classifieds</a></li>
				<li><a href="#">Membership</a></li>
				<li class="active" style="pointer-events: none"><a href="#">Activate Your Account</a></li>
            </ol>
        </div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 classifieds-category-activename"> 
			<h2>Activation</h2>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
			<?$search = new Block('be_classifieds_search_section')?>
			<?$search->set_type('classifieds_search_section');?>
			<?$search->add_css_class('no-float-left');?>
			<?$search->show();?>
        </div>
    </div>
	</div>
</div>

<div class="container classifieds">
    
    <div class="row">
        <div class="col-sm-3  hidden-xs">
            <div class="sidebar">    
                <div class="row">
                    <div class="col-sm-11">
                        <?$user_panel = new Block('be_classifieds_category_user_panel_v1');?>
                        <?$user_panel->set_type('classifieds_user_menu');?>
                        <?$user_panel->add_css_class('no-float-left');?>
                        <?$user_panel->show();?>
                    </div>
                </div>
			</div>
		</div>
				<div class="col-sm-9 listings">
					<div class="items">
						<div class="">
							<div class="row">
							
		<div class="items">
    <div class="row" style="margin-bottom: 550px">

        <p class="label label-danger" style="text-align: center;font-size: 100%;">An activation link has been sent to the email address you have provided.</p>
        <h4 style="text-align: center; margin-bottom: 20px">In order to finish your Account Activation process, you must click the email link.</h4>

    </div>
</div>

							</div>
						</div>
					</div>
				</div>
	</div>
</div>

