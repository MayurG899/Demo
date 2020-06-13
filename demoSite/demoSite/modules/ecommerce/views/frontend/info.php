<div class="container">
    <div class="row">
        <div class="col-md-12" style="padding-top:50px;">
			<?if($this->session->flashdata('error')):?>
				<h1 class="text-center"><span class="badge" style="background-color:#00acac"><i class="fa fa-check" style="font-size:22px;"></i></span> <?if($this->user->is_guest())echo 'Sorry';else echo ucfirst($user->first_name);?>, there is an error occured with you payment !</h1> 
				<div class="col-md-12">
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<div class="brand-logo">
							<img src="<?=$this->BuilderEngine->get_option('be_ecommerce_company_logo')?>" alt="">
						</div><br/>
						<p class="text-center"><b> <?=$this->session->flashdata('error')?> !</b></p>
					</div>
				</div>
			<?elseif($this->session->flashdata('warning')):?>
				<h1 class="text-center"><span class="badge" style="background-color:#00acac"><i class="fa fa-check" style="font-size:22px;"></i></span> <?if($this->user->is_guest())echo 'Please note';else echo ucfirst($user->first_name);?>, following warning has been raised!</h1> 
				<div class="col-md-12">
					<div class="alert alert-warning">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<div class="brand-logo">
							<img src="<?=$this->BuilderEngine->get_option('be_ecommerce_company_logo')?>" alt="">
						</div><br/>
						<p class="text-center"><b> <?=$this->session->flashdata('warning')?></b></p>
					</div>
				</div>
			<?elseif($this->session->flashdata('info')):?>
				<h1 class="text-center"><span class="badge" style="background-color:#00acac"><i class="fa fa-check" style="font-size:22px;"></i></span> <?if($this->user->is_guest())echo 'Congrats';else echo ucfirst($user->first_name);?>, your order has been successfully processed !</h1> 
				<div class="col-md-12">
					<div class="alert alert-info">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<div class="brand-logo">
							<img src="<?=$this->BuilderEngine->get_option('be_ecommerce_company_logo')?>" alt="">
						</div><br/>
						<p class="text-center"><b> <?=$this->session->flashdata('info')?></b></p>
					</div>
				</div>
			<?else:?>
				<div class="col-md-12">
					<div class="alert alert-info">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<div class="brand-logo">
							<img src="<?=$this->BuilderEngine->get_option('be_ecommerce_company_logo')?>" alt="">
						</div><br/>
						<p class="text-center"><b> No Info</b></p>
					</div>
				</div>
			<?endif;?>
			<div class="text-center" style="padding:50px 50px 100px 50px;">
				<a class="btn btn-lg btn-success" href="<?=base_url('ecommerce/category/All')?>"><i class="fa fa-arrow-left"></i> Back to Online Store</a>
			</div>
        </div>
    </div>
</div>