<div class="container" style="padding-top:120px;">
    <div class="row">
        <div class="col-md-12" style="padding-top:100px;">
			<h1 class="text-center"><span class="badge" style="background-color:#00acac"><i class="fa fa-check" style="font-size:22px;"></i></span> <?=ucfirst(str_replace('%20',' ',$bookinguser))?>, your order has been successfully processed !</h1> 
			<div class="alert alert-success" style="margin-left:5%;margin-right:5%;margin-top:5%">
				<p><i class="fa fa-info"></i> Check your email address for the order details.</p>
				<p>Thank you !</p>
			</div>
			<div class="text-center" style="padding:50px 50px 100px 50px;">
				<a class="btn btn-lg btn-success" href="<?=base_url('classifieds/view_category/All')?>"><i class="fa fa-arrow-left"></i> Back to Classifieds</a>
			</div>
        </div>
    </div>
</div>