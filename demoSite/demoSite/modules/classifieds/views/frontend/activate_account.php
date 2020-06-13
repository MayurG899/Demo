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
    <div class="row">

      <?if($error != ''):?>
        <p class="label label-danger" style="text-align: center;font-size: 100%;"> The activation token you have provided is incorrect or non-existent. Please contact customer support.</p>
      <?else:?>
        <p class="label label-success" style="text-align: center;font-size: 100%;"> Your account has been authenticated successfully! </p>
        <h4 style="text-align: center; margin-bottom: 20px"> Now you can create your own profile</h4>

        <div class="col-md-8 col-md-offset-2">
          <div class="formy well">
            <h4 class="title" style="text-align: center;">Profile information</h4>
              <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleInputEmail1">Country</label>
                    <input type="text" name="state" class="form-control " id="exampleInputEmail1" placeholder="Enter country">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">City</label>
                    <input type="text" name="lga" class="form-control " id="exampleInputEmail1" placeholder="Enter city">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Address</label>
                    <input type="text" name="Address" class="form-control " id="exampleInputEmail1" placeholder="Enter address">
                </div>
                <div class="control-group">
                  <label class="control-label" for="username2">Gender</label>
                  <div class="controls">
                    <label class="radio inline">
                      <input type="radio" name="gender" value="male" id="optionsRadios1" required>
                      Male
                    </label>
                    <label class="radio inline">
                      <input type="radio" name="gender" value="female" id="optionsRadios1" required>
                      Female
                    </label>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="username2">I am</label>
                  <div class="controls">
                    <label class="radio inline">
                      <input type="radio" name="business" value="individual" id="optionsRadios1" required>
                      An individual
                    </label>
                    <label class="radio inline">
                      <input type="radio" name="business" value="professional" id="optionsRadios1" required>
                      A Professional/Business
                    </label>
                  </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Telephone</label>
                    <input type="text" name="telephone" class="form-control " id="exampleInputEmail1" placeholder="Enter telephone">
                </div>
                <div class="form-group">
                  <label for="username2">About me</label>
                  <textarea class="form-control" rows="3" name="about_me" placeholder="Information about you"></textarea>
                </div>
                <div class="form-group">
                  <label for="username2">Interests</label>
                  <textarea class="form-control" rows="3" name="interests" placeholder="What interests you?"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">My website</label>
                    <input type="text" name="my_website" class="form-control " id="exampleInputEmail1" placeholder="Enter website">
                </div>
                <div class="control-group">
                  <label class="control-label" for="password2">Avatar</label>
                  <div class="controls">
                    <input type="file" name="avatar" class="input-large">
                  </div>
                </div>
                <div class="control-group">
                   <div class="controls">
                      <label class="checkbox inline">
                         <input type="checkbox" id="inlineCheckbox3" required> Agree with Terms and Conditions
                      </label>
                   </div>
                </div> 
                
                <!-- Buttons -->
                <div class="form-actions" style="text-align:center">
                   <!-- Buttons -->
                  <button type="submit" class="btn btn-primary">Register</button>
                </div>
              </form>
                     
          </div>
        </div>
      <?endif;?>
    </div>
</div>
							
							</div>
						</div>
					</div>
				</div>
	</div>
</div>
