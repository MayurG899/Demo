        <?php echo get_header() ?>
		
		<?php echo get_sidebar() ?>
		
		
		<!-- begin #content --> 
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<div class="pull-right" >
				<ol class="breadcrumb">
					<li><a href="#">Home</a></li>
					<li class="active">Online Store Dashboard</li>
				</ol>
			</div>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Store Dashboard <small>Administration Control Panel</small></h1>
			<!-- end page-header -->
			<!-- begin row -->
			<div class="row">
				<?php if(isset($subscription_status)):?>
					<?php if(isset($update_available) && $update_available == true):?>
						<div class="row-fluid col-md-12">
							<div class="alert alert-block alert-info fade in">
								<p id="update-info">Update is being installed <img style="width:50px" src="http://www.leumit.co.il/minisites/personalcare/content/images/loader01.gif"></p>
							</div>
						</div>
					<?php endif;?>
					<!-- begin col-cloud -->
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
						<div class="widget be-dashboard-widget-cloud widget-stats bg-white">
							<div class="stats-icon stats-icon-lg"><i class="fa fa-clock-o fa-fw"></i></div>
							<div class="stats-title">WEBSITE EXPIRES IN</div>
							<div class="stats-number">
								<?$remaining_days = round(($subscription_status['expiration_date'] - time()) / 86400, 0);
								if($remaining_days > 0)
									echo $remaining_days.' Days';
								else
									echo '0 - Expired';
								?>
							</div>
							<?if($subscription_status['trial'] == 'yes'):?>
								<div class="stats-link"><a href="https://www.builderengine.com/account/pricing" target="_blank">Trial - Upgrade To Keep Website</div></a>
							<?elseif($subscription_status['trial'] == 'no' && $subscription_status['expiration_date'] < time()):?>
								<div class="stats-link"><a href="https://www.builderengine.com/account/pricing" target="_blank">Expired - Upgrade Now</div></a>
							<?else:?>
								<div class="stats-link"><a href="https://www.builderengine.com/account/pricing" target="_blank">Active Subscription</div></a>
							<?endif;?>
						</div>
					</div>
				<!-- end col-cloud -->
				<!-- begin col-cloud -->
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
						<div class="widget be-dashboard-widget-cloud widget-stats bg-white">
							<div class="stats-icon stats-icon-lg be-dashboard-i-cloud"><a href="https://www.builderengine.com/account/dashboard" target="_blank"><i class="fa fa-laptop fa-fw"></i></a></div>
							<div class="stats-title">DASHBOARD</div>
							<div class="stats-number">
								My Account
							</div>
							<div class="stats-link"><a href="https://www.builderengine.com/account/dashboard" target="_blank">Website Builder Account</div></a>
						</div>
					</div>
				<!-- end col-cloud -->
				<!-- begin col-cloud -->
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
						<div class="widget be-dashboard-widget-cloud widget-stats bg-white">
							<div class="stats-icon stats-icon-lg be-dashboard-i-cloud"><a href="https://www.builderengine.com/account/view_websites" target="_blank"><i class="fa fa-list fa-fw"></i></a></div>
							<div class="stats-title">WEBSITES</div>
							<div class="stats-number">
								View Details
							</div>
							<div class="stats-link"><a href="https://www.builderengine.com/account/view_websites" target="_blank">View Websites Created</div></a>
						</div>
					</div>
				<!-- end col-cloud -->
				<!-- begin col-cloud -->
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
						<div class="widget be-dashboard-widget-cloud widget-stats bg-white">
							<div class="stats-icon stats-icon-lg be-dashboard-i-cloud"><a href="https://www.builderengine.com/account/domain_control" target="_blank"><i class="fa fa-link fa-fw"></i></a></div>
							<div class="stats-title">DOMAINS</div>
							<div class="stats-number">
								Connect
							</div>
							<div class="stats-link"><a href="https://www.builderengine.com/account/domain_control" target="_blank">Connect Your Domain</div></a>
						</div>
					</div>
				<!-- end col-cloud -->
				<!-- begin col-cloud -->
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
						<div class="widget be-dashboard-widget-cloud widget-stats bg-white">
							<div class="stats-icon stats-icon-lg be-dashboard-i-cloud"><a href="https://www.builderengine.com/account/themes_control" target="_blank"><i class="fa fa-image fa-fw"></i></a></div>
							<div class="stats-title">THEMES</div>
							<div class="stats-number">
								Install
							</div>
							<div class="stats-link"><a href="https://www.builderengine.com/account/themes_control" target="_blank">Install New Templates</div></a>
						</div>
					</div>
				<!-- end col-cloud -->
				<!-- begin col-cloud -->
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
						<div class="widget be-dashboard-widget-cloud widget-stats bg-white">
							<div class="stats-icon stats-icon-lg be-dashboard-i-cloud"><a href="https://www.builderengine.com/account/create_website" target="_blank"><i class="fa fa-rocket fa-fw"></i></a></div>
							<div class="stats-title">CREATE</div>
							<div class="stats-number">
								Website
							</div>
							<div class="stats-link"><a href="https://www.builderengine.com/account/create_website" target="_blank">Create A New Website</div></a>
						</div>
					</div>
				<!-- end col-cloud -->
				<!-- begin col-cloud -->
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
						<div class="widget be-dashboard-widget-cloud widget-stats bg-white">
							<div class="stats-icon stats-icon-lg be-dashboard-i-cloud"><a href="https://www.builderengine.com/account/module_control" target="_blank"><i class="fa fa-cube fa-fw"></i></a></div>
							<div class="stats-title">MODULES</div>
							<div class="stats-number">
								Installed
							</div>
							<div class="stats-link"><a href="https://www.builderengine.com/account/module_control" target="_blank">View Details</div></a>
						</div>
					</div>
				<!-- end col-cloud -->
				<!-- begin col-cloud -->
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
						<div class="widget be-dashboard-widget-cloud widget-stats bg-white">
							<div class="stats-icon stats-icon-lg be-dashboard-i-cloud"><a href="https://www.builderengine.com/account/pricing" target="_blank"><i class="fa fa-key fa-fw"></i></a></div>
							<div class="stats-title">UPGRADE</div>
							<div class="stats-number">
								Subscriptions
							</div>
							<div class="stats-link"><a href="https://www.builderengine.com/account/pricing" target="_blank">View Available Plans</div></a>
						</div>
					</div>
				<!-- end col-cloud -->
				<?php else:?>
					<?php if($update_available):?>
					<div class="row-fluid col-md-12">
						<div class="alert alert-block alert-info fade in">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<h4 class="alert-heading"><i class="icon24 i-info"></i>Update available!</h4>
							<p>We have an update for your website. Updates provide you with new features and security improvements. <br>We recommend you to always keep your website up to date.</p>
							<p>
								<a class="btn btn-success" href="<?=base_url('admin/update/index')?>">Update your website</a>
							</p>
						</div>
					</div>
					<?php endif;?>
				<?php endif;?>
			    
			<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 col-beadmin-12 be-dashboard-col-boxes-pad">
				<!-- begin col-2 -->
			   	<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
			        <div class="widget widget-stats bg-grey-500">
			            <div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
			            <div class="stats-title">TODAY'S VISITS</div>
			            <div class="stats-number" id="todaysVisitorsCount"><?php echo $todayvisitorscount; ?></div>
						<div class="stats-link">
							<?php
                                $p = 0;
                                if(intval($todayvisitorscount) != 0){
                                    $p = 100 - intval($lastweekvisitorscount) / intval($todayvisitorscount) * 100;
                                }
                                $p = intval($p);
                            ?>
							<a href="<?=base_url('admin/main/statistics')?>"><?php
                            echo ($p >= 0)? $p."% Better"  : (-1)*$p."% Worse";
                            ?>
							</a>
						</div>
			        </div>
			    </div>
			    <!-- end col-2 -->
			    <!-- begin col-2 -->
			   	<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
			        <div class="widget widget-stats bg-grey-500">
			            <div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
			            <div class="stats-title">TOTAL VISITORS</div>
			            <div class="stats-number" id="allVisitors">0</div>
                        <div class="stats-link"><a href="<?=base_url('admin/main/statistics')?>">View <i class="fa fa-arrow-circle-o-right"></i></a></div>
			        </div>
			    </div>
			    <!-- end col-2 -->
				<!-- begin col-2 -->
			   	<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
			        <div class="widget widget-stats bg-grey-500">
			            <div class="stats-icon stats-icon-lg"><i class="fa fa-users fa-fw"></i></div>
			            <div class="stats-title">TOTAL MEMBERS</div>
			            <div class="stats-number" id="userAccounts"><?=$statistics['total_users_count']?></div>
                        <div class="stats-link"><a href="<?=base_url('admin/user/search')?>">View <i class="fa fa-arrow-circle-o-right"></i></a></div>
			        </div>
			    </div>
			    <!-- end col-2 -->
				
				<!-- begin col-all -->
					<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
						<div class="widget widget-stats bg-grey-500">
							<div class="stats-icon stats-icon-lg be-dashboard-i-cloud"><a href="https://www.builderengine.com/page-support.html" target="_blank"><i class="fa fa-book fa-fw"></i></a></div>
							<div class="stats-title">SUPPORT</div>
							<div class="stats-number">
								Guides & Tutorials
							</div>
							<div class="stats-link"><a href="https://builderengine.org/guides/all_posts" target="_blank">Support Guides & Tutorials</div></a>
						</div>
					</div>
				<!-- end col-all -->
				<!-- begin col-all -->
					<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
						<div class="widget widget-stats bg-grey-500">
							<div class="stats-icon stats-icon-lg be-dashboard-i-cloud"><a href="https://www.builderengine.com/videotube/all_videos" target="_blank"><i class="fa fa-th fa-fw"></i></a></div>
							<div class="stats-title">DESIGN</div>
							<div class="stats-number">
								Website Themes
							</div>
							<div class="stats-link"><a href="https://builderengine.org/page-template-themes.html" target="_blank">Install New Templates</div></a>
						</div>
					</div>
				<!-- end col-all -->
				<!-- begin col-all -->
					<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
						<div class="widget widget-stats bg-grey-500">
							<div class="stats-icon stats-icon-lg be-dashboard-i-cloud"><a href="https://www.builderengine.com/support" target="_blank"><i class="fa fa-hand-paper-o fa-fw"></i></a></div>
							<div class="stats-title">TICKETS</div>
							<div class="stats-number">
								Help & Support
							</div>
							<div class="stats-link"><a href="https://www.builderengine.com/support" target="_blank">Submit Support Ticket</div></a>
						</div>
					</div>
				<!-- end col-all -->
				<!-- begin col-all -->
					<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
						<div class="widget widget-stats bg-grey-500">
							<div class="stats-icon stats-icon-lg be-dashboard-i-cloud"><a href="https://www.builderengine.com/forum/all_topics" target="_blank"><i class="fa fa-coffee fa-fw"></i></a></div>
							<div class="stats-title">FORUMS</div>
							<div class="stats-number">
								Community
							</div>
							<div class="stats-link"><a href="https://builderengine.org/forum/all_topics" target="_blank">View Community Forums</div></a>
						</div>
					</div>
				<!-- end col-all -->
				<!-- begin col-all -->
					<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
						<div class="widget widget-stats bg-grey-500">
							<div class="stats-icon stats-icon-lg be-dashboard-i-cloud"><a href="https://www.builderengine.com/account/register" target="_blank"><i class="fa fa-user fa-fw"></i></a></div>
							<div class="stats-title">REGISTER</div>
							<div class="stats-number">
								My Account
							</div>
							<div class="stats-link"><a href="https://builderengine.org/cp/register" target="_blank">Access Forums & Support</div></a>
						</div>
					</div>
				<!-- end col-all -->
				<!-- begin col-2 -->
			   	<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
			        <div class="widget widget-stats bg-orange">
			            <div class="stats-icon stats-icon-lg be-dashboard-i-cloud"><a href="https://www.builderengine.com/account/hire" target="_blank"><i class="fa fa-user-secret fa-fw"></i></a></div>
			            <div class="stats-title">LICENSED</div>
			            <div class="stats-number">Membership</div>
                        <div class="stats-link"><a href="https://builderengine.org/booking_memberships/membership/1" target="_blank">Extra Modules, Private Support & More <i class="fa fa-arrow-circle-o-right"></i></a></div>
			        </div>
			    </div>
			    <!-- end col-2 -->
				 <!-- begin col-3 -->
			   	<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
			        <div class="widget widget-stats bg-green">
			           <div class="stats-icon stats-icon-lg"><i class="fa fa-shopping-cart fa-fw"></i></div>
			            <div class="stats-title">TODAY'S STORE ORDERS</div>
			            <div class="stats-number" id="userAccounts"><?=$statistics['todays_ecommerce_orders']?></div>
                        <div class="stats-link"><a href="<?=base_url('admin/module/ecommerce/orders')?>">View More <i class="fa fa-arrow-circle-o-right"></i></a></div>
			        </div>
			    </div>
			    <!-- end col-3 -->
			    <!-- begin col-3 -->
			   	<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
			        <div class="widget widget-stats bg-green">
			            <div class="stats-icon stats-icon-lg"><i class="fa fa-dollar fa-fw"></i></div>
			            <div class="stats-title">TODAY'S STORE INCOME</div>
			            <div class="stats-number" id="userAccounts"><?=$statistics['todays_ecommerce_revenue']?></div>
                        <div class="stats-link"><a href="<?=base_url('admin/module/ecommerce/orders')?>">View More <i class="fa fa-arrow-circle-o-right"></i></a></div>
			        </div>
			    </div>
			    <!-- end col-3 -->
                <!-- begin col-3 -->
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
                    <div class="widget widget-stats bg-green">
                        <div class="stats-icon stats-icon-lg"><i class="fa fa-dollar fa-fw"></i></div>
                        <div class="stats-title">TOTAL WEBSITE INCOME</div>
                        <div class="stats-number" id="blogComments"><?=$statistics['total_ecommerce_revenue']?></div>
                        <div class="stats-link"><a href="<?=base_url('admin/module/builderpayment/sales')?>">View All Orders <i class="fa fa-arrow-circle-o-right"></i></a></div>
                    </div>
                </div>
                <!-- end col-3 -->
				
				
			</div>
				
				<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 col-beadmin-12">
			        <!-- begin panel -->
			       <ul class="nav nav-tabs nav-tabs-inverse nav-justified nav-justified-mobile">
						<li class="active"><a href="#latest-post" data-toggle="tab"><i class="fa fa-compass m-r-5"></i> <span class="hidden-xs">BuilderEngine Latest News</span></a></li>
						<li class=""><a href="#system" data-toggle="tab"><i class="fa fa-info m-r-5"></i> <span class="hidden-xs">BuilderEngine System Version</span></a></li>
					</ul>
					<div class="tab-content be-dashboard-news-content">
						<div class="tab-pane fade active in" id="latest-post">
							<div class="height-md" data-scrollbar="true">
								<ul class="media-list media-list-with-divider" id="news-feed"></ul>
							</div>
						</div>
						<div class="tab-pane fade" id="system">
							<div class="height-md" data-scrollbar="true">
								<table class="table">
									<thead>
										<tr>
											<th>Date</th>
											<th>Platform</th>
											<th>System Version</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><h5>21 / 10 / 2018</td>
											<td class="hidden-sm">
												<a href="#">
													<img src="<?=base_url('/themes/dashboard/assets/img/builderengine-icon.png')?>" alt="BuilderEngine"  />
												</a></h5>
											</td>
											<td>
												<h5><a href="#">CMS: <b><?=$this->BuilderEngine->get_option('version');?></b></a></h5>
											</td>
										</tr>
										<tr>
											<td><h5>30 / 01 / 2018</td>
											<td class="hidden-sm">
												<a href="#">
													<img src="<?=base_url('/themes/dashboard/assets/img/builderengine-icon.png')?>" alt="BuilderEngine"  />
												</a></h5>
											</td>
											<td>
												<h5><a href="#">CE Official: <b>1.x</b></a></h5>
											</td>
										</tr>
										<tr>
											<td><h5>15 / 02 / 2017</td>
											<td class="hidden-sm">
												<a href="#">
													<img src="<?=base_url('/themes/dashboard/assets/img/builderengine-icon.png')?>" alt="BuilderEngine"  />
												</a></h5>
											</td>
											<td>
												<h5><a href="#">CE Beta: <b>1.0</b></a></h5>
											</td>
										</tr>
										<tr>
											<td><h5>09 / 04 / 2015</td>
											<td class="hidden-sm">
												<a href="#">
													<img src="<?=base_url('/themes/dashboard/assets/img/builderengine-icon.png')?>" alt="BuilderEngine"  />
												</a></h5>
											</td>
											<td>
												<h5><a href="#">Alpha: <b>3.0</b></a></h5>
											</td>
										</tr>
										<tr>
											<td><h5>30 / 10 / 2013</td>
											<td class="hidden-sm">
												<a href="#">
													<img src="<?=base_url('/themes/dashboard/assets/img/builderengine-icon.png')?>" alt="BuilderEngine"  />
												</a></h5>
											</td>
											<td>
												<h5><a href="#">Alpha: <b>2.0</b></a></h5>
											</td>
										</tr>
										<tr>
											<td><h5>15 / 10 / 2012</td>
											<td class="hidden-sm">
												<a href="#">
													<img src="<?=base_url('/themes/dashboard/assets/img/builderengine-icon.png')?>" alt="BuilderEngine"  />
												</a></h5>
											</td>
											<td>
												<h5><a href="#">Alpha: <b>1.0</b></a></h5>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
			        <!-- end panel -->
				</div>
				
				
			</div>
			<!-- end row -->
			
			<!-- begin row -->
			<div class="row">
			    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
			        <div class="widget-chart with-sidebar bg-black">
			            <div class="widget-chart-content">
			                <h4 class="chart-title">
			                    Visitor Analytics
			                    <small>New & Returning Trends</small>
			                </h4>
			                <div id="visitors-line-chart" class="morris-inverse" style="height: 260px;"></div>
			            </div>
			            <div class="widget-chart-sidebar bg-black-darker">
			                <div class="chart-number">
			                	<font>Website</font>
			                    <small>Visitor Breakdown</small>
			                </div>
			                <div id="visitors-donut-chart" style="height: 160px"></div>
			                <ul class="chart-legend">
			                    <li><i class="fa fa-circle-o fa-fw text-success m-r-5"></i> <font id="newVisitors">0.0</font>% <span>New Visitors</span></li>
			                    <li><i class="fa fa-circle-o fa-fw text-primary m-r-5"></i><font id="returnVisitors">0.0</font>% <span>Return Visitors</span></li>
			                </ul>
			            </div>
			        </div>
			    </div>
			    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
			        <div class="panel panel-inverse">
			            <div class="panel-heading">
			                <h4 class="panel-title">
			                    Visitors Origin
			                </h4>
			            </div>
			            <div id="visitors-map" class="bg-black" style="height: 181px;"></div>
			            <div class="list-group" id="countries_ip">
                            <?php  $num = 1; ?>
                            <?php foreach($arrCounts as $k=>$v ):  ?>
                                <a href="#" class="list-group-item list-group-item-inverse text-ellipsis">
                                    <span class="badge badge-success"><?php echo $v; ?></span>
                                    <?php echo $num.'. '.$k; ?>
                                </a>
                                <?php  $num++; ?>
                            <?php  endforeach;  ?>
                        </div>
			        </div>
			    </div>
			</div>
			<!-- end row -->
		</div>
		<!-- end #content -->
		
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
	
<!-- ================== BEGIN BASE JS ================== -->

<script src="<?php echo get_theme_path()?>assets/plugins/jquery/jquery-1.9.1.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
<script src="<?php //echo get_theme_path()?>assets/crossbrowserjs/html5shiv.js"></script>
<script src="<?php //echo get_theme_path()?>assets/crossbrowserjs/respond.min.js"></script>
<script src="<?php //echo get_theme_path()?>assets/crossbrowserjs/excanvas.min.js"></script>
<![endif]-->
<script src="<?php echo get_theme_path()?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/jquery-cookie/jquery.cookie.js"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="<?php echo get_theme_path()?>assets/plugins/morris/raphael.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/morris/morris.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/jquery-jvectormap/jquery-jvectormap-world-merc-en.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/flot/jquery.flot.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/flot/jquery.flot.time.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/flot/jquery.flot.pie.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/sparkline/jquery.sparkline.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>


<script src="<?php echo get_theme_path()?>assets/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/masked-input/masked-input.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/password-indicator/js/password-indicator.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/bootstrap-combobox/js/bootstrap-combobox.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/js/form-plugins.demo.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/DataTables-1.10.2/js/jquery.dataTables.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/DataTables-1.10.2/js/data-table.js"></script>

<script src="<?php echo get_theme_path()?>assets/plugins/isotope/jquery.isotope.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/lightbox/js/lightbox-2.6.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/js/gallery.demo.min.js"></script>

<!--<script src="<?php //echo get_theme_path()?>assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js"></script> -->
<script src="<?php echo get_theme_path()?>assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="<?php echo get_theme_path()?>assets/js/dashboard-v2.min.js"></script>


<script src="<?php echo get_theme_path()?>assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js"></script>

<script src="<?php echo get_theme_path()?>assets/js/apps.min.js"></script>

<?if($this->BuilderEngine->get_option('admin_theme_color_pattern') && $this->BuilderEngine->get_option('admin_theme_color_pattern') != 'default'):?>
	<link href="<?=base_url('themes/dashboard/assets/css/color_patterns/'.$BuilderEngine->get_option('admin_theme_color_pattern'))?>.css" rel="stylesheet">
<?endif;?>
<!-- ================== END PAGE LEVEL JS ================== -->
<?php if(isset($subscription_status) && $update_available == true):?>
	<script>
		$(document).ready(function(){
			var intervalId = setInterval(function(){
				$.get( "/admin/cloud/show_update_load", function( data ) {
					$( "#update-info" ).html( data );
					if(data == 'Update successful')
						clearInterval(intervalId);
				});
			}, 1000);
		});
	</script>
<?php endif;?>
<script>
    function capitaliseFirstLetter(string)
    {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
<?php
$notification_timer = 0;
$notification_timer_step = 1500;

if($user)
    foreach($this->user->get_notifications() as $notification): ?>

$(window).load(function() {
    setTimeout(function() {
        $.gritter.add({
            title: capitaliseFirstLetter('<?php echo $notification['type']?>'),
            text: '<?php echo $notification['message']?>',
            image: '<?php echo $this->user->get_avatar()?>',
            sticky: false,
            time: '',
            class_name: 'my-sticky-class'
        });
    }, <?=$notification_timer?>);
});
<?php $notification_timer += $notification_timer_step ?>
<?php endforeach;?>



</script>

<script>
    $(document).ready(function() {

        handleVisitorsVectorMap(<?php  echo $countryNamesArr ?>)
        App.init();
        var total_days = 32;
        $.ajax({
            type: 'GET',
            url: site_root + '/admin/ajax/dashboard_get_visitors_graph/' + total_days,
            dataType: 'json',
            success: function(data) {
            	if(data['all'][2] != 0){
	                handleVisitorsLineChart(data);
            	}
            },
            data: {},
            async: true
        });

        $.ajax({
			url: site_root + '/admin/ajax/get_latest_news',
			dataType: 'json',
            success: function (data) {
            	$.each(data, function(i, elem){
            		var html = '<li class="media media-lg"> \
						<a href="' + elem.link[0] + '" target="_blank" class="pull-left"> \
							<img class="media-object" src="' + elem.image[0] + '" alt=""> \
						</a> \
						<div class="media-body"> \
							<h4 class="media-heading">' + elem.title[0] + '</h4> \
							' + elem.description[0] +'. \
						</div> \
					</li>';
            		$('#news-feed').append(html);
            	})
            },
            async: true
		});

		<?if($this->BuilderEngine->get_option('admin_left_sidebar_minimized') && $this->BuilderEngine->get_option('admin_left_sidebar_minimized') == 'on'):?>
			$('.sidebar-minify-btn').click();
		<?endif;?>
    });
</script>
</body>
</html>