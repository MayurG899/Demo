<link href="<?=base_url()?>themes/dashboard/assets/plugins/parsley/src/parsley.css" rel="stylesheet" />
<div class="container" style="padding-top:120px;">
	<div class="row">
		<h1 class="text-center">PorterShed Virtual Office</h1>
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
							<img src="<?=base_url('themes/portershed_theme/images/ss_be_3.jpg')?>" class="img-thumbnail" style="margin-bottom:50px;" />
						</div>
					</div>
				</div>
				<div class="col-md-8 col-sm-8" style="margin-bottom:50px;">
					<form method="post" data-parsley-validate="true" class="">
						<div class="form-group">
							<label class="" for="name1">What is your company name? *</label>
							<div class="">
								<input type="text" name="companyname" data-parsley-pattern="^[a-zA-Z0-9\s]*$" class="form-control" id="name1" required />
							</div>
						</div>
						<div class="form-group">
							<label class="" for="name1">What is your contact name? *</label>
							<div class="">
								<input type="text" name="contactname" class="form-control" id="name1" required />
							</div>
						</div>
						<div class="form-group">
							<label class="" for="name1">What is your phone number? *</label>
							<div class="">
								<input type="text" name="phone" class="form-control" id="name1" required />
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
							<label class="" for="name1">If your company has a website URL please provide it below.</label>
							<div class="">
								<input type="text" name="companywebsite" data-parsley-type="url" class="form-control" id="name1" />
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