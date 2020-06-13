<link href="<?=base_url()?>themes/dashboard/assets/plugins/parsley/src/parsley.css" rel="stylesheet" />
<div class="container" style="padding-top:120px;">
	<div class="row">
		<h1 class="text-center"><?=$service->name?></h1>
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
						<?=$service->get_questionnaire_fields();?>
						<div class="mandatory" style="background:#ccc;padding:10px;border:2px solid #000;border-radius:5px;margin:15px">
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
						</div>
						<div class="form-group">
							<div class="">
								<button class="btn btn-success btn-lg" type="submit" ><i class="fa fa-check"></i> Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?=base_url()?>themes/dashboard/assets/plugins/parsley/dist/parsley.js"></script>