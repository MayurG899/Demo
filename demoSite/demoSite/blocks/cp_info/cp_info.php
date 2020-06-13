<?php
class Cp_info_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Account Dashboard";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Account Dashboard Info";
        $info['block_icon'] = "fa-envelope-o";

        return $info;
    }

    public function generate_admin()
    {
		$this->show_placeholder();
    }

    public function generate_content()
    {
		//Controller
		global $active_controller;
		$user = &$active_controller->user;
		$active_user = new User($user->get_id());
        $CI = & get_instance();
		$this->load_generic_styles();

		$output = '
		<!-- begin #content -->
		<div class="beaccount-dashboard">
			<audio id="ping" controls >
				<source src="'.base_url('blocks/account_info/ping.mp3').'" type="audio/mpeg">
			</audio>
			<script>
				$(document).ready(function(){';
				if($CI->session->flashdata('info'))
				{	
					$output .='
					$("#ping")[0].volume = 0.2;
					$("#ping")[0].play();';
				}
				$output .='
				});
			</script>
			<!-- begin #content --> 
			<div class="col-lg-2 col-md-3 col-sm-12 col-xs-12 beaccount-col-page">
				<div id="account_sidebar">
					<div class="row">
						<div class="panel panel-white">
							<div class="account_sidebar-websitepanel-title">
							<!-- Websites display --><!-- end panel -->
						<div class="subscription-information">
							<p>
								<a href="javascript:;" class="btn btn-lg btn-inverse-subinfo">
									<i class="fa fa-key fa-2x pull-left beaccount-icon-sub"></i>
									<span><b>Account:</b> Basic</span><br>
								</a>
							</p>
							<p class="subscription-type green-info"></p>
						</div>
						
							</div>
						</div>
						<div class="panel panel-white account_sidebar-websitepanels-text">
						   <div class="account_sidebar-websitepanel-title">
								<p><b>My Websites</b></p>
								<hr>
							</div>
							<div class="panel-body account_sidebar-websitepanel-hr">
								<p>no info</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-lg-10 col-md-9 col-sm-12 col-xs-12 beaccount-main-page beaccount-dashboard-box-pages">
				<div id="account_infopage">
					<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<h3 class="page-header-account-title">Subscription Payment <small> Website Builder Dashboard</small></h3>
						</div>
					</div>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-inverse">
							<div class="panel-heading">
								<h4 class="panel-title">Website Builder Payment Status</h4>
							</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="panel-body beaccount-weblist-body">
							
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 beaccount-twobox-col-1">
								<div class="panel panel-weblist-white"> 
									<div class="panel-weblist-white-inner beaccount-weblist-body-shadow"> 
										<div class="panel-heading panel-weblist-white">
										</div>
										<div class="panel-body panel-weblist-white">';
											if($CI->session->flashdata('error')){
												//View
												$output .='
													<div class="col-md-12">
														<div class="alert alert-danger beaccount-stripepay-info-msg">
															<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
															<div class="brand-logo">
																<img src="'.base_url('themes/becom_theme/images/logo.png').'" alt="">
															</div>
															<p class="text-center"><b> '.$CI->session->flashdata('error').' !</b></p>
														</div>
													</div>
												';
											}
											elseif($CI->session->flashdata('warning')){
												//View
												$output .='
													<div class="col-md-12">
														<div class="alert alert-warning beaccount-stripepay-info-msg">
															<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
															<div class="brand-logo">
																<img src="'.base_url('themes/becom_theme/images/logo.png').'" alt="">
															</div>
															<p class="text-center"><b> '.$CI->session->flashdata('warning').'</b></p>
														</div>
													</div>
												';
											}
											elseif($CI->session->flashdata('info')){
												//View
												$output .='
													<div class="col-md-12">
														<div class="alert alert-info beaccount-stripepay-info-msg">
															<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
															<div class="brand-logo">
																<img src="'.base_url('themes/becom_theme/images/logo.png').'" alt="">
															</div>
															<p class="text-center"><b> '.$CI->session->flashdata('info').'</b></p>
														</div>
													</div>
												';
											}else{
												$output .='
													<div class="col-md-12">
														<div class="alert alert-info beaccount-stripepay-info-msg">
															<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
															<div class="brand-logo">
																<img src="'.base_url('themes/becom_theme/images/logo.png').'" alt="">
															</div>
															<p class="text-center"><b> No Info</b></p>
														</div>
													</div>
												';
											}
											$output .= '
											<div class="">
												<div class="panel-body beaccount-domain-infoguide">
													<div class="payment-logo">
														<img src="/files/be-stripe.png" alt="">
													</div>
													<div class="beaccount-subscription-cc-div">
													<i class="fab beaccount-subscription-cc fa-cc-visa"></i>
													<i class="fab beaccount-subscription-cc fa-cc-mastercard"></i>
													<i class="fab beaccount-subscription-cc fa-cc-amex"></i>
													<i class="fab beaccount-subscription-cc fa-cc-discover"></i>
													<i class="fab beaccount-subscription-cc fa-cc-jcb"></i>
													</div>
												</div>
											</div>
											<!-- end panel -->
										</div>
									</div>
								</div>
							</div>
						
							</div>
						</div>
						</div>
					</div>
					</div>
				
				</div>	
			</div>
			<!-- end col-10 -->
		</div>
			<!-- end #content -->	
		';
		if(!$user->is_guest())
			return $output;
    }
}
?>