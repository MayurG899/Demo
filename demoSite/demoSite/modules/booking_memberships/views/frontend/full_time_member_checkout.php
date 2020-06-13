<link href="<?=base_url()?>themes/dashboard/assets/plugins/parsley/src/parsley.css" rel="stylesheet" />
<div class="container" style="padding-top:120px;">
	<div class="row">
		<h1 class="text-center">PorterShed Full Time Membership</h1>
		<div class="col-md-12" style="padding:20px;margin-bottom:50px;">
			<div class="row">
				<div class="col-md-4 col-sm-4 hidden-xs">
					<div class="row">
						<div class="col-md-12">
							<img src="<?=base_url('themes/portershed_theme/images/portershed-logo-final-45.png')?>" class="img-thumbnail" style="margin-bottom:50px;" />
						</div>
						<div class="col-md-12">
							<img src="<?=base_url('themes/portershed_theme/images/ss_be_1.jpg')?>" class="img-thumbnail" style="margin-bottom:50px;" />
						</div>
						<div class="col-md-12">
							<img src="<?=base_url('themes/portershed_theme/images/mocks.png')?>" class="img-thumbnail" style="margin-bottom:50px;" />
						</div>
						<div class="col-md-12">
							<img src="<?=base_url('themes/portershed_theme/images/ss_be_3.jpg')?>" class="img-thumbnail" style="margin-bottom:50px;" />
						</div>
						<div class="col-md-12">
							<img src="<?=base_url('themes/portershed_theme/images/qaservices.png')?>" class="img-thumbnail" style="margin-bottom:50px;" />
						</div>
						<div class="col-md-12">
							<img src="<?=base_url('themes/portershed_theme/images/ss_be_9.jpg')?>" class="img-thumbnail" style="margin-bottom:50px;" />
						</div>
						<div class="col-md-12">
							<img src="<?=base_url('themes/portershed_theme/images/privity.png')?>" class="img-thumbnail" style="margin-bottom:50px;" />
						</div>
						<div class="col-md-12">
							<img src="<?=base_url('themes/portershed_theme/images/ss_be_11.jpg')?>" class="img-thumbnail" style="margin-bottom:50px;" />
						</div>
						<div class="col-md-12">
							<img src="<?=base_url('themes/portershed_theme/images/propylon.png')?>" class="img-thumbnail" style="margin-bottom:50px;" />
						</div>
						<div class="col-md-12">
							<img src="<?=base_url('themes/portershed_theme/images/ss_be_11.jpg')?>" class="img-thumbnail" style="margin-bottom:50px;" />
						</div>
						<div class="col-md-12">
							<img src="<?=base_url('themes/portershed_theme/images/reverbeo.png')?>" class="img-thumbnail" style="margin-bottom:50px;" />
						</div>
						<div class="col-md-12">
							<img src="<?=base_url('themes/portershed_theme/images/map.jpg')?>" class="img-thumbnail" style="margin-bottom:50px;" />
						</div>
						<div class="col-md-12">
							<img src="<?=base_url('themes/portershed_theme/images/nuigje.png')?>" class="img-thumbnail" style="margin-bottom:50px;" />
						</div>
					</div>
				</div>
				<div class="col-md-8 col-sm-8" style="margin-bottom:50px;">
					<form method="post" data-parsley-validate="true" class="">
						<div class="form-group">
							<label class="" for="name1">What is your company name?*</label>
							<div class="">
								<input type="text" name="companyname" data-parsley-pattern="^[a-zA-Z0-9\s]*$" class="form-control" id="name1" required />
							</div>
						</div>
						<div class="form-group">
							<label class="" for="name1">What is your email address? *</label>
							<div class="">
								<input type="email" name="email" data-parsley-type="email" class="form-control" id="name1" required />
							</div>
						</div>
						<div class="form-group">
							<label class="" for="name1">What is your address information? *</label>
							<div class="">
								<textarea  name="companyaddress" cols="7" rows="5" class="form-control" id="name1" required /></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="" for="name1">What is your phone number? *</label>
							<div class="">
								<input type="text" name="phone" class="form-control" id="name1" required />
							</div>
						</div>
						<div class="form-group">
							<label class="" for="name1">Please provide a link to a 2-3 minute video pitch as to why your company should be in the space.</label>
							<div class="">
								<input type="text" name="videolink" class="form-control" id="name1" />
							</div>
						</div>
						<div class="form-group">
							<label class="" for="name1">Please provide a link to a slide deck about your company.</label>
							<div class="">
								<input type="text" name="companylink" class="form-control" id="name1" />
							</div>
						</div>
						<div class="form-group">
							<label class="" for="name1">If your company has a website URL please provide it below.</label>
							<div class="">
								<input type="text" name="website" class="form-control" id="name1" />
							</div>
						</div>
						<div class="form-group">
							<label class="" for="name1">In one sentence tell us what your company does. *</label>
							<div class="">
								<textarea  name="companybusiness" class="form-control" id="name1" cols="7" rows="5" required /></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="" for="name1">Which industry are you involved in? *</label>
							<div class="">
								<input type="text" name="companyindustry" class="form-control" id="name1" required />
							</div>
						</div>
						<div class="form-group">
							<label class="" for="name1">Outline who your customers are and why you are targeting them.</label>
							<div class="">
								<textarea  name="companycustomers" class="form-control" id="name1" cols="7" rows="5" /></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="" for="name1">What customer problem does your product/service solve?</label>
							<div class="">
								<textarea  name="customerproblem" class="form-control" id="name1" cols="7" rows="5" /></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="" for="name1">Describe your product in detail and the key customer benefits.</label>
							<div class="">
								<textarea  name="companyproduct" class="form-control" id="name1" cols="7" rows="5" /></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="" for="name1">What size is your team? *</label>
							<div >
								<select class="form-control" name="companyteam" required>
									<option value="">Select Option</option>
									<option value="onetwo">1 - 2</option>
									<option value="threefour">3 - 4</option>
									<option value="fiveeight">5 - 8</option>
									<option value="ninefifteen">9 - 15</option>
									<option value="over">Over 15</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="" for="name1">How many desks are you looking for now? *</label>
							<div class="">
								<input type="number" name="desks" data-parsley-type="number" class="form-control" id="name1" required />
							</div>
						</div>
						<div class="form-group">
							<label class="" for="name1">How many desks do you expect to need by mid 2017? *</label>
							<div class="">
								<input type="number" name="desks2017" data-parsley-type="number" class="form-control" id="name1" required />
							</div>
						</div>
						<div class="form-group">
							<label class="" for="name1">What is your planned growth (for your team) over the next three years?</label>
							<div class="">
								<input type="text" name="companygrowth" class="form-control" id="name1" />
							</div>
						</div>
						<div class="form-group">
							<label class="" for="name1">Describe the makeup of your team.</label>
							<div class="">
								<textarea  name="companymakeup" class="form-control" id="name1" cols="7" rows="5" /></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="" for="name1">How long has the founding team worked together?</label>
							<div class="">
								<input type="text" name="companyfoundingteam" class="form-control" id="name1" />
							</div>
						</div>
						<div class="form-group">
							<label class="" for="name1">Select your company's stage of development.</label>
							<div>
								<select class="form-control" name="companydevstage">
									<option value="">Select Option</option>
									<option value="concept">Concept Only</option>
									<option value="productdev">Product in Development</option>
									<option value="prototype">Prototype Ready</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="" for="name1">Please provide growth targets for next three years, including total sales numbers, total revenue.</label>
							<div class="">
								<textarea  name="companygrowthtarget" class="form-control" id="name1" cols="7" rows="5" /></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="" for="name1">Enter any previous capital you have raised.</label>
							<div class="">
								<input type="text" name="companycapital" class="form-control" id="name1"/>
							</div>
						</div>
						<div class="form-group">
							<label class="" for="name1">How do you see your company being part of the startup community and/or tech community in the PorterShed, in Galway City, and the West of Ireland? *</label>
							<div class="">
								<textarea  name="startupestimation" class="form-control" id="name1" cols="7" rows="5" required /></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="" for="name1">How much of your time could you see you and your employees giving back to the community, in terms of running events, mentoring, and other pro bono activities? *</label>
							<div>
								<select class="form-control" name="companytimeframe" required>
									<option value="">Select Option</option>
									<option value="one">1%</option>
									<option value="five">5%</option>
									<option value="ten">10%</option>
									<option value="twenty">20%</option>
									<option value="over">Over 20%</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="" for="name1">Any other special requirements or work habits that you would like to tell us about?</label>
							<div class="">
								<textarea  name="companyspecialrequirements" class="form-control" id="name1" cols="7" rows="5" /></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="">
								<button class="btn btn-success btn-lg" type="subit" name="" ><i class="fa fa-check"></i> Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?=base_url()?>themes/dashboard/assets/plugins/parsley/dist/parsley.js"></script>