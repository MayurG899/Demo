<div id="content" class="page-with-two-sidebar content-two-sidebars" style="min-height:800px">
<!-- begin row -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                </div>
                <h4 class="panel-title">Payments - All Website Orders & Invoices</h4>
            </div>
		<div class="panel panel-default panel-with-tabs" data-sortable-id="ui-unlimited-tabs-2">
			<?
				$order_types = array();
				foreach($orders as $order){
					if(!in_array(strtolower($order->module),$order_types)){
						array_push($order_types,strtolower($order->module));
					}
				}
			?>
			<?if(count($order_types) > 0):?>
			<div class="panel-heading p-0">
				<div class="panel-heading-btn m-r-10 m-t-10">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-inverse" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				</div>
				<!-- begin nav-tabs -->
				<div class="tab-overflow">
					<ul class="nav nav-tabs">
						<li class="prev-button"><a href="javascript:;" data-click="prev-tab" class="text-inverse"><i class="fa fa-arrow-left"></i></a></li>
						<?$i = 1;?>
						<?foreach($order_types as $order_type): ?>
							<li class="<?if($i == 1)echo'active';?>"><a href="#nav-tab2-<?=$i?>" data-toggle="tab"><?=ucfirst(str_replace('_',' ',$order_type));?></a></li>
							<?$i++;?>
						<?endforeach;?>
						<li class="next-button"><a href="javascript:;" data-click="next-tab" class="text-inverse"><i class="fa fa-arrow-right"></i></a></li>
					</ul>
				</div>
			</div>
			<div class="tab-content">
				<?$j = 1;?>
				<?foreach($order_types as $order_type): ?>
					<div class="tab-pane fade <?if($j == 1)echo'active in';?>" id="nav-tab2-<?=$j?>">
						<h3 class="m-t-10"><?=ucfirst(str_replace('_',' ',$order_type));?> Orders</h3>
						<div class="table-responsive">
							<table class="data-table table table-striped table-bordered table-hover">
								<thead>
								<tr>
									<th>id</th>
									<th>Source</th>
									<th>Customer</th>
									<th>Customer Email</th>
									<th>Order Total</th>
									<th>Payment Method</th>
									<th>Time of Creation</th>
									<th>Paid</th>
									<th>Actions</th>
								</tr>
								</thead>
								<tbody>
								<?$k = 1;?>
								<?foreach($orders as $order): ?>
									<?if(strtolower($order->module) == $order_type):?>
										<tr>
											<td><?=$order->id?></td>
											<td><?=ucfirst(str_replace('_',' ',$order->module))?></td>
											<td><?=$order->billingAddress->get()->first_name.' '.$order->billingAddress->get()->last_name?></td>
											<td><?=$order->billingAddress->get()->email?></td>
											<td>
												<?
													$currency = new Currency($order->currency);
													if($order->gross == 0 && $order->paid_gross == 0)
														echo '<span class="badge" style="background:green;">FREE</span>';
													else
														if($currency->symbol_position = 'before')
															if($order->payment_method == 'cod' && $order->status == 'pending')
																echo $currency->symbol.$order->gross;
															else
																echo $currency->symbol.$order->paid_gross;
														else
															if($order->payment_method == 'cod' && $order->status == 'pending')
																echo $order->gross.$currency->symbol;
															else
																echo $currency->symbol.$order->paid_gross;
												?>
											</td>
											<td><?=$order->payment_method?></td>
											<td><?=date('d-M-Y H:i:s',$order->time_created)?></td>
											<td>
												<?	if($order->status == "paid") 
														echo '<span class="label label-success"><i class="fa fa-check"></i> Yes</span>';
													else
														echo '<span class="label label-danger"><i class="fa fa-times"></i> No</span>';?>
											</td>
											<td style="text-align: center">
												<div style="width:120px">
													<a class="btn btn-xs btn-primary" href="<?=base_url('admin/ajax/order_invoice/'.$order->module.'/'.$order->id)?>" target="_blank" data-toggle="tooltip" data-placement="top" title="View Invoice"><i class="fa fa-desktop"></i></a>
													<?if($order->payment_method == 'cod' && $order->status == 'pending'):?>
														<a class="btn btn-xs btn-success" href="<?=base_url('admin/module/builderpayment/set_paid/'.$order->id)?>" data-toggle="tooltip" data-placement="top" title="Set Paid"><i class="fa fa-check"></i></a>
													<?endif;?>
													<a class="btn btn-xs btn-danger" href="<?=base_url('admin/module/builderpayment/delete_order/'.$order->id)?>" onclick="return confirm('Are you sure you want to permanently delete this order?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
												</div>
											</td>
										</tr>
									<?endif;?>
									<?$k++;?>
								<?endforeach;?>
								</tbody>
							</table>
						</div>
					</div>
					<?$j++;?>
				<?endforeach;?>
			</div>
			<?else:?>
				<h1 class="text-center" style="padding: 30px 0">No Orders</h1>
			<?endif;?>
		</div>
    </div><!-- End .span12  -->
</div>
</div><!-- End .row-fluid  -->
<!-- end row -->
<!-- begin #sidebar-right -->
		<div id="sidebar-right" class="sidebar sidebar-right">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav m-t-10">
					<h4 class="sidebar-right-main-title">All Payment Orders</h4>
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
                                        View all orders & invoices on your website from all modules & blocks.
										
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
										<div class="todolist-title">Payment Orders</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">View Orders</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Print Invoices</div>
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