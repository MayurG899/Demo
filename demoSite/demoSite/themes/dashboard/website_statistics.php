<?php echo get_header() ?>

<?php echo get_sidebar() ?>
<?
function array_sort($array, $on, $order=SORT_DESC){

    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
                break;
            case SORT_DESC:
                arsort($sortable_array);
                break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}
?>
<!-- begin #content -->
<div id="content" class="content page-with-two-sidebar content-two-sidebars" style="min-height:800px">

			<!-- begin row -->
			<div class="row">
                <!-- begin col-8 -->
			    <div class="col-md-12">
					<div class="row">
					 <!-- begin col-3 -->
			   	<div class="col-md-6 col-sm-6">
			        <div class="widget widget-stats bg-blue">
			            <div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
			            <div class="stats-title">TODAY'S VISITS</div>
			            <div class="stats-number" id="todaysVisitorsCount"><?php echo $todayvisitorscount; ?></div>
			            <div class="stats-progress progress">
                            <?php
                                $p = 0;
                                if(intval($todayvisitorscount) != 0){
                                    $p = 100 - intval($lastweekvisitorscount) / intval($todayvisitorscount) * 100;
                                }
                                $p = intval($p);
                            ?>
                            <div class="progress-bar" style="width: <?php echo ($p >= 0) ? $p : (1)*$p;
                            ?>%;"></div>
                        </div>
                        <div class="stats-desc">
                            <?php
                            echo ($p >= 0)? $p."% Better then last week"  : (-1)*$p."% Worse than last week";
                            ?>
                        </div>
			        </div>
			    </div>
			    <!-- end col-3 -->
			    <!-- begin col-3 -->
			   	<div class="col-md-3 col-sm-3">
			        <div class="widget widget-stats bg-blue">
			            <div class="stats-icon stats-icon-lg"><i class="fa fa-users fa-fw"></i></div>
			            <div class="stats-title">TOTAL ACTIVE MEMBERS</div>
			            <div class="stats-number" id="userAccounts"><?=$statistics['total_users_count']?></div>
                        <div class="stats-progress progress"></div>
                        <div class="stats-desc"><a href="<?=base_url('admin/user/search')?>">View all members</a></div>
			        </div>
			    </div>
			   	<div class="col-md-3 col-sm-3">
			        <div class="widget widget-stats bg-blue">
			            <div class="stats-icon stats-icon-lg"><i class="fa fa-users fa-fw"></i></div>
			            <div class="stats-title">TOTAL SUBSCRIPTIONS</div>
						<?	$subscriptions = 0;
							$u = new User;
							foreach($u->get() as $usr){
								if($usr->subscribed->get()->exists())
									$subscriptions += $usr->subscribed->count();
							}
						?>
			            <div class="stats-number" id="userAccounts"><?=$subscriptions?></div>
                        <div class="stats-progress progress"></div>
                        <div class="stats-desc"><a href="<?=base_url('admin/user/subscriptions')?>">View all Subscriptions</a></div>
			        </div>
			    </div>
			    <!-- end col-3 -->
				<div class="col-md-6">
			        <div class="panel panel-inverse">
			            <div class="panel-heading">
			                <h4 class="panel-title">
			                    Visitors Origin
			                </h4>
			            </div>
			            <div id="visitors-map" class="bg-black" style="height: 281px;"></div>
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
				<div class="col-md-6">
							<!-- begin panel -->
							<div class="panel panel-inverse" data-sortable-id="index-5">
								<div class="panel-heading">
									<div class="panel-heading-btn">
										<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
										<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
										<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
									</div>
									<h4 class="panel-title">Server Load</h4>
								</div>
								<div class="panel-body">
									<div class="text-center" style="padding:20px;">
										<canvas id="foo"></canvas>
									</div>
									<div id="preview-textfield" class="text-center" style="font-size: 38px;"></div>
								</div>
							</div>
							<!-- end panel -->
						</div>
				
			    <div class="col-md-12">
			        <div class="widget-chart with-sidebar bg-black">
			            <div class="widget-chart-content">
			                <h4 class="chart-title">
			                    Visitors Analytics
			                    <small>Where do our visitors come from</small>
			                </h4>
			                <div id="visitors-line-chart" class="morris-inverse" style="height: 260px;"></div>
			            </div>
			            <div class="widget-chart-sidebar bg-black-darker">
			                <div class="chart-number">
			                	<font id="allVisitors">0</font>
			                    <small>visitors</small>
			                </div>
			                <div id="visitors-donut-chart" style="height: 160px"></div>
			                <ul class="chart-legend">
			                    <li><i class="fa fa-circle-o fa-fw text-success m-r-5"></i> <font id="newVisitors">0.0</font>% <span>New Visitors</span></li>
			                    <li><i class="fa fa-circle-o fa-fw text-primary m-r-5"></i><font id="returnVisitors">0.0</font>% <span>Return Visitors</span></li>
			                </ul>
			            </div>
			        </div>
			    </div>
			</div>
			<!-- end row -->
					<div class="row">
						<div class="col-md-6">
							<!-- begin panel -->
							<div class="panel panel-inverse" data-sortable-id="index-1">
								<div class="panel-heading">
									<div class="panel-heading-btn">
										<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
										<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
										<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
									</div>
									<h4 class="panel-title">Visitors User Agent</h4>
								</div>
								<div class="panel-body">
									<?if(count($user_agents) > 0):?>
										<div id="user-agents" class="height-sm"></div>
									<?else:?>
										<h4 class="text-center"><i class="fa fa-info-circle"></i> No stats available!</h4>
									<?endif;?>
								</div>
							</div>
							<!-- end panel -->
						</div>
						<div class="col-md-6">
							<!-- begin panel -->
							<div class="panel panel-inverse" data-sortable-id="index-2">
								<div class="panel-heading">
									<div class="panel-heading-btn">
										<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
										<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
										<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
									</div>
									<h4 class="panel-title">Visitors Platform</h4>
								</div>
								<div class="panel-body">
									<?if(count($platforms) > 0):?>
										<div id="user-os" class="height-sm"></div>
									<?else:?>
										<h4 class="text-center"><i class="fa fa-info-circle"></i> No stats available!</h4>
									<?endif;?>
								</div>
							</div>
							<!-- end panel -->
						</div>
						<div class="col-md-6">
							<!-- begin panel -->
							<div class="panel panel-inverse" data-sortable-id="index-3">
								<div class="panel-heading">
									<div class="panel-heading-btn">
										<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
										<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
										<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
									</div>
									<h4 class="panel-title">Visitors Device</h4>
								</div>
								<div class="panel-body">
									<?if(count($devices) > 0):?>
										<div id="user-device" class="height-sm"></div>
									<?else:?>
										<h4 class="text-center"><i class="fa fa-info-circle"></i> No stats available!</h4>
									<?endif;?>
								</div>
							</div>
							<!-- end panel -->
						</div>
						<div class="col-md-6">
							<!-- begin panel -->
							<div class="panel panel-inverse" data-sortable-id="index-4">
								<div class="panel-heading">
									<div class="panel-heading-btn">
										<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
										<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
										<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
									</div>
									<h4 class="panel-title">Online Visitors</h4>
								</div>
								<div class="panel-body">
									<div class="text-center" style="padding:20px;margin-left:60px">
										<img src="<?=base_url('builderengine/public/img/avatar.png')?>" class="img-responsive img-circle" width="150px" height="150px" /><br/>
									</div>
									<div id="site-visitors" class="text-center" style="font-size: 38px;"></div>
								</div>
							</div>
							<!-- end panel -->
						</div>
						
						<div class="col-md-12">
							<!-- begin panel -->
							<div class="panel panel-inverse" data-sortable-id="index-6">
								<div class="panel-heading">
									<div class="panel-heading-btn">
										<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
										<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
										<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
									</div>
									<h4 class="panel-title">Top 5 Referrers <span class="btn btn-xs btn-primary"  data-toggle="modal" data-target="#myModal" style="margin-left:10px;">View All</span></h4>
								</div>
								<div class="panel-body">
									<?if(count($referrers) > 0):?>
										<table class="table table-striped table-responsive table-bordered table-hover">
											<thead>
												<th>#</th>
												<th>Referral Link</th>
												<th>Hits</th>
											</thead>
											<tbody>
												<?
												$i = 1;
												$referrers = array_sort($referrers, 'data');
												foreach($referrers as $referrer):?>
													<?if(($referrer['label'] != NULL || $referrer['label'] != '') && $i <= 5):?>
														<tr>
															<td><?=$i?></td>
															<td><a href="<?=$referrer['label']?>" target="_blank"><?=$referrer['label']?></a></td>
															<td>(<?=$referrer['data']?>)</td>
														</tr>
														<?$i++;?>
													<?endif;?>
												<?endforeach;?>
											</tbody>
										</table>
									<?else:?>
										<h4 class="text-center"><i class="fa fa-info-circle"></i> No stats available!</h4>
									<?endif;?>
								</div>
							</div>
							<!-- end panel -->
						</div>
					</div>
                </div>
            </div>
            <!-- end row -->
			
			<!-- begin #sidebar-right -->
		<div id="sidebar-right" class="sidebar sidebar-right">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav m-t-10">
					<h4 class="sidebar-right-main-title">Website Statistics</h4>
					<li class="nav-widget">
                        <div class="panel-group m-b-0" id="accordion">
                            <div class="panel panel-grey">
                                <div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseQuide">
                                            <i class="fa fa-plus-circle pull-right text-blue"></i> 
                                            Quick Tutorial
                                        </a>
                                    </h3>
                                </div>
                                <div id="collapseQuide" class="panel-collapse collapse">
                                    <div class="panel-body panel-body-2">
                                        Review the statistics shown & make adjustments to your pages to improve your website.
										
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-grey">
                                <div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseLinks">
                                            <i class="fa fa-plus-circle pull-right text-blue"></i> 
                                            Help & Support
                                        </a>
                                    </h3>
                                </div>
                                <div id="collapseLinks" class="panel-collapse collapse">
                                    <div class="panel-body panel-body-2">
										<td><a href="#modal-guides" class="btn btn-sm btn-block btn-inverse" data-toggle="modal">Guides & Tutorials</a></td>
										<td><a href="#modal-forums" class="btn btn-sm btn-block btn-inverse" data-toggle="modal">Community Forums</a></td>
										<td><a href="#modal-tickets" class="btn btn-sm btn-block btn-inverse" data-toggle="modal">Support Tickets</a></td>
										<td><a href="#modal-cloudlogin" class="btn btn-sm btn-block btn-inverse" data-toggle="modal">My Account</a></td>
                                    </div>
                                </div>
                            </div>
                        </div>
					</li>
					<li class="nav-widget text-white">
						<div class="panel panel-grey">
						<div class="panel-heading panel-heading-2">
							<h3 class="panel-title title-14">
								<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseList">
									<i class="fa fa-question-circle pull-right" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Checklist to Configure Your Website"></i>
                                    To Do List
								</a>
							</h3>
						</div>
						<div id="collapseList" class="panel-collapse collapse">
						<div class="panel-body p-0">
							<ul class="todolist">
								<li class="active">
									<a href="javascript:;" class="todolist-container active" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Website Statistics</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Review Statistics</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Adjust Pages on Data</div>
									</a>
								</li>
							</ul>
						</div>
						</div>
					</div>

				    </li>
				</ul>
				<!-- end sidebar user -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg sidebar-right"></div>
		<!-- end #sidebar-right -->
							<!-- #modal-dialog -->
							<div class="modal fade" id="modal-forums">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">BuilderEngine Support Forums</h4>
										</div>
										<div class="modal-body">
											You are about to leave your Administration Control Panel, click Continue to view page.
										</div>
										<div class="modal-footer">
											<a href="" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
											<a href="https://builderengine.com/forum/all_topics" target="_blank" class="btn btn-sm btn-success">Continue</a>
										</div>
									</div>
								</div>
							</div>
							<div class="modal fade" id="modal-guides">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">BuilderEngine Tutorials/Guides</h4>
										</div>
										<div class="modal-body">
											You are about to leave your Administration Control Panel, click Continue to view page.
										</div>
										<div class="modal-footer">
											<a href="" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
											<a href="https://builderengine.com/guides/all_posts" target="_blank" class="btn btn-sm btn-success">Continue</a>
										</div>
									</div>
								</div>
							</div>
							<div class="modal fade" id="modal-tickets">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">BuilderEngine Support Tickets</h4>
										</div>
										<div class="modal-body">
											You are about to leave your Administration Control Panel, click Continue to view page.
										</div>
										<div class="modal-footer">
											<a href="" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
											<a href="https://builderengine.com/support" target="_blank" class="btn btn-sm btn-success">Continue</a>
										</div>
									</div>
								</div>
							</div>
							<div class="modal fade" id="modal-cloudlogin">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">BuilderEngine Account Login</h4>
										</div>
										<div class="modal-body">
											You are about to leave your Administration Control Panel, click Continue to view page.
										</div>
										<div class="modal-footer">
											<a href="" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
											<a href="https://builderengine.com/account/dashboard" target="_blank" class="btn btn-sm btn-success">Continue</a>
										</div>
									</div>
								</div>
							</div>	
							<!-- end sidebar -->
		</div>
		<!-- end #content -->
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<?if(count($referrers) > 0):?>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title text-center" id="myModalLabel"><i class="fa fa-link"></i> All Referrer Links</h4>
		  </div>
		  <div class="modal-body">
			<table class="table table-striped table-responsive table-bordered table-hover">
				<thead>
					<th>#</th>
					<th>Referral Link</th>
					<th>Hits</th>
				</thead>
				<tbody>
					<?
					$i = 1;
					$referrers = array_sort($referrers, 'data');
					foreach($referrers as $referrer):?>
						<?if(($referrer['label'] != NULL || $referrer['label'] != '')):?>
							<tr>
								<td><?=$i?></td>
								<td><a href="<?=$referrer['label']?>" target="_blank"><?=$referrer['label']?></a></td>
								<td>(<?=$referrer['data']?>)</td>
							</tr>
							<?$i++;?>
						<?endif;?>
					<?endforeach;?>
				</tbody>
			</table>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
		  </div>
		</div>
	  </div>
	</div>
	<?endif;?>
	<!-- end page container -->
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
<!-- ================== END BASE JS ================== -->
<script src="<?=get_theme_path()?>assets/plugins/gauge/gauge.js"></script>

<?if($this->BuilderEngine->get_option('admin_theme_color_pattern') && $this->BuilderEngine->get_option('admin_theme_color_pattern') != 'default'):?>
	<link href="<?=base_url('themes/dashboard/assets/css/color_patterns/'.$BuilderEngine->get_option('admin_theme_color_pattern'))?>.css" rel="stylesheet">
<?endif;?>
<!-- ================== BEGIN BASE JS ================== -->
<script>
	var blue		= '#348fe2',
		blueLight	= '#5da5e8',
		blueDark	= '#000099',
		aqua		= '#49b6d6',
		aquaLight	= '#6dc5de',
		aquaDark	= '#3a92ab',
		green		= '#00acac',
		greenLight	= '#33bdbd',
		greenDark	= '#008a8a',
		orange		= '#f59c1a',
		orangeLight	= '#f7b048',
		orangeDark	= '#c47d15',
		dark		= '#2d353c',
		grey		= '#b6c2c9',
		purple		= '#727cb6',
		purpleLight	= '#8e96c5',
		purpleDark	= '#5b6392',
		red         = '#ff5b57';
	var handleDonutChart = function () {
		"use strict";
		if ($('#user-agents').length !== 0) {
			var donutData = [
				<?
				$colors = array(
					0 => 'blue',
					1 => 'blueLight', 
					2 => 'blueDark', 
					3 => 'aqua', 
					4 => 'aquaLight', 
					5 => 'aquaDark', 
					6 => 'green', 
					7 => 'greenLight', 
					8 => 'greenDark',
					9 => 'orange',
					10 => 'orangeLight',
					11 => 'orangeDark',
					12 => 'dark',
					13 => 'grey',
					14 => 'purple',
					15 => 'purpleLight',
					16 => 'purpleDark',
					17 => 'red'
				);
				$i = 0;
				foreach($user_agents as $u){
					echo '{"label":"'.$u['label'].'","data":'.$u['data'].',"color":'.$colors[$i].'},';
					$i++;
				}
				?>
			];
			$.plot('#user-agents', donutData, {
				series: {
					pie: {
						innerRadius: 1.5,
						show: true,
						label: {
							show: true
						}
					}
				},
				legend: {
					show: true
				}
			});
		}

		if ($('#user-os').length !== 0) {
			var donutData = [
				<?
				$i = 17;
				foreach($platforms as $u){
					echo '{"label":"'.$u['label'].'","data":'.$u['data'].',"color":'.$colors[$i].'},';
					$i--;
				}
				?>
			];
			$.plot('#user-os', donutData, {
				series: {
					pie: {
						innerRadius: 1.5,
						show: true,
						label: {
							show: true
						}
					}
				},
				legend: {
					show: true
				}
			});
		}

		if ($('#user-device').length !== 0) {
			var donutData = [
				<?
				$i = 5;
				foreach($devices as $u){
					echo '{"label":"'.ucfirst($u['label']).'","data":'.$u['data'].',"color":'.$colors[$i].'},';
					$i++;
				}
				?>
			];
			$.plot('#user-device', donutData, {
				series: {
					pie: {
						innerRadius: 0.5,
						show: true,
						label: {
							show: true
						}
					}
				},
				legend: {
					show: true
				}
			});
		}
	};
    $(document).ready(function (){
		var load_data;

		$.get("<?=base_url('admin/ajax/get_server_load')?>", function(data){
			load_data = data;
			$('#preview-textfield').html(load_data + '%');
		});
		$.get("<?=base_url('admin/ajax/get_site_visitors')?>", function(data){
			if(data == '1')
				data = data + ' User';
			else
				data = data + ' Users';
			$('#site-visitors').html(data);
		});

		var opts = {
		  angle: 0.15, // The span of the gauge arc
		  lineWidth: 0.44, // The line thickness
		  radiusScale: 0.8, // Relative radius
		  pointer: {
			length: 0.6, // // Relative to gauge radius
			strokeWidth: 0.035, // The thickness
			color: '#000000' // Fill color
		  },
		  limitMax: false,     // If false, max value increases automatically if value > maxValue
		  limitMin: false,     // If true, the min value of the gauge will be fixed
		  colorStart: '#6FADCF',   // Colors
		  colorStop: '#8FC0DA',    // just experiment with them
		  strokeColor: '#E0E0E0',  // to see which ones work best for you
		  generateGradient: true,
		  highDpiSupport: true     // High resolution support
		};
		var target = document.getElementById('foo'); // your canvas element
		var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
		gauge.maxValue = 100; // set max gauge value
		gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
		gauge.animationSpeed = 38; // set animation speed (32 is default value)
		gauge.set(load_data); // set actual value

		handleDonutChart();

		$('#preview-textfield').html(20 + '%');

		setInterval(function() {
			$.get("<?=base_url('admin/ajax/get_server_load')?>", function(data){
				$('#preview-textfield').html(data + '%');
				gauge.set(data);
			});
			$.get("<?=base_url('admin/ajax/get_site_visitors')?>", function(data){
				if(data == '1')
					data = data + ' User';
				else
					data = data + ' Users';
				$('#site-visitors').html(data);
			});
		}, 2500);
	});
</script>

<script src="<?php echo get_theme_path()?>assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/jquery-jvectormap/jquery-jvectormap-world-merc-en.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?php echo get_theme_path()?>assets/js/dashboard-v2.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/js/apps.min.js"></script>
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

		<?if($this->BuilderEngine->get_option('admin_left_sidebar_minimized') && $this->BuilderEngine->get_option('admin_left_sidebar_minimized') == 'on'):?>
			$('.sidebar-minify-btn').click();
		<?endif;?>
    });
</script>
