<?=get_header() ?>
<?=get_sidebar() ?>
<link href="<?=base_url('themes/dashboard/assets/css/titatoggle.css')?>" rel="stylesheet">
<div id="content" class="content page-with-two-sidebar content-two-sidebars" style="min-height:800px">
	<!-- begin row -->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-white">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					</div>
					<h4 class="panel-title">Permissions - Website Usergroup Permission Control Panel </h4>
				</div>
				<div class="panel panel-default panel-with-tabs" data-sortable-id="ui-unlimited-tabs-2">
					<div class="panel-heading p-0">
						<div class="tab-overflow">
							<ul class="nav nav-tabs">
								<li class="prev-button"><a href="javascript:;" data-click="prev-tab" class="text-inverse"><i class="fa fa-arrow-left"></i></a></li>
								<?$i = 1;?>
								<?foreach($groups as $group): ?>
									<li class="<?if($i == 1)echo'active';?>"><a href="#nav-tab2-<?=$i?>" data-toggle="tab"><?=ucfirst(str_replace('_',' ',$group->name));?></a></li>
									<?$i++;?>
								<?endforeach;?>
								<li class="next-button"><a href="javascript:;" data-click="next-tab" class="text-inverse"><i class="fa fa-arrow-right"></i></a></li>
							</ul>
						</div>
					</div>
					<style>
						.fieldLabel{
							font-size:11px;
						}
						.fieldOption{
							padding:15px;
						}
						.contentRow{
							border-top:1px solid #eee;
						}
						.form-group{
							border-bottom:1px solid #eee !important;
						}
						.tagIt{
							width: 100% !important;
						}
						.ico{
							display:block;
							position:absolute;
							right:70px;
							border-radius:50%;
							padding:4px 6px;
						}
						.icoTag{
							display:block;
							position:absolute;
							top:35px;
							left:-10px;
							border-radius:50%;
							padding:4px 6px;
						}
					</style>
					<div class="tab-content">
						<?$j = 1;?>
						<?foreach($groups as $group): ?>
							<div class="tab-pane fade <?if($j == 1)echo'active in';?>" id="nav-tab2-<?=$j?>">
								<h3 class="m-t-10"><?=ucfirst(str_replace('_',' ',$group->name));?> </h3>
								<div class="row contentRow">
									<?foreach($modules as $module):?>
										<?if($module->folder != 'page' && $module->folder != 'layout_system'):?>
											<form id="form-<?=$module->id.'-'.$group->id;?>" class="form-horizontal form-bordered" data-parsley-validate="true" name="permission-form" method="post">
												<div class="form-group">
													<label class="control-label col-md-2 col-sm-2" for="fullname"><?=$module->name?></label>
													<div class="col-md-10 col-sm-10">
														<div class="row">
															<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
																<div class="fieldLabel">Can View/Access Frontend</div>
																<div class="fieldOption">
																	<div class="checkbox checkbox-slider--b-flat checkbox-slider-success" style="padding-top:0px;">
																		<label>
																			<?
																				$access = $this->modules_db->get_by_folder($module->folder);
																				$access_frontend_groups = $access->permissions['frontend']['names'];
																				$checked = '';
																				if(in_array($group->name,$access_frontend_groups))
																					$checked = 'checked="checked"';
																			?>
																			<input class="checkBox" type="checkbox" name="frontend" data-group="<?=$group->id?>" data-module="<?=$module->id?>" value="" <?=$checked?>><span></span>
																		</label>
																	</div>
																</div>
															</div>
															<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
																<div class="fieldLabel">Can View/Access Backend</div>
																<div class="fieldOption">
																	<div class="checkbox checkbox-slider--b-flat checkbox-slider-success" style="padding-top:0px;">
																		<label>
																			<?
																				$access = $this->modules_db->get_by_folder($module->folder);
																				$access_backend_groups = $access->permissions['backend']['names'];
																				$checked = '';
																				if(in_array($group->name,$access_backend_groups))
																					$checked = 'checked="checked"';
																			?>
																			<input class="checkBox" type="checkbox" name="backend" data-group="<?=$group->id?>" data-module="<?=$module->id?>" value="" <?=$checked?>><span></span>
																		</label>
																	</div>
																</div>
															</div>
															<?if($module->folder == 'audioplayer'):?>

															<?endif;?>
															<?if($module->folder == 'blog'):?>
																<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
																	<div class="fieldLabel">Can Create Posts</div>
																	<div class="fieldOption">
																		<div class="checkbox checkbox-slider--b-flat checkbox-slider-success" style="padding-top:0px;">
																			<label>
																				<?
																					$posts = ( $group->allow_posts ) ? 'checked="checked"' : '';
																				?>
																				<input class="checkBox" type="checkbox" name="allow_posts" data-group="<?=$group->id?>" data-module="<?=$module->id?>" value="<?=$group->allow_posts?>" <?=$posts?>><span></span>
																			</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
																	<div class="fieldLabel">Can Create Post Categories</div>
																	<div class="fieldOption">
																		<div class="checkbox checkbox-slider--b-flat checkbox-slider-success" style="padding-top:0px;">
																			<label>
																				<?
																					$categories = ( $group->allow_categories ) ? 'checked="checked"' : '';
																				?>
																				<input class="checkBox" type="checkbox" name="allow_categories" data-group="<?=$group->id?>" data-module="<?=$module->id?>" value="<?=$group->allow_categories?>" <?=$categories?>><span></span>
																			</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
																	<div class="fieldLabel">User Created Categories</div>
																	<div class="fieldOption">
																		<div class="checkbox checkbox-slider--b-flat checkbox-slider-success" style="padding-top:0px;">
																			<label>
																				<?
																					$user_categories = ( $group->use_created_categories ) ? 'checked="checked"' : '';
																				?>
																				<input class="checkBox" type="checkbox" name="use_created_categories" data-group="<?=$group->id?>" data-module="<?=$module->id?>" value="<?=$group->use_created_categories?>" <?=$user_categories;?>><span></span>
																			</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
																	<div class="fieldLabel">Default Blog-Post Category</div>
																	<div class="fieldOption">
																		<ul id="default_user_post_category-<?=$module->folder.$group->id?>" class="tagIt" data-group="<?=$group->id?>" data-module="<?=$module->id?>">
																			<?php foreach(explode(',',$group->default_user_post_category) as $value):?>
																				<li class="tagItValue" value="<?=$value?>"><?=$value?></li>
																			<?php endforeach?>
																		</ul>
																	</div>
																</div>
															<?endif;?>
															<?if($module->folder == 'booking_events'):?>
																<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
																	<div class="fieldLabel">Can Book An Event</div>
																	<div class="fieldOption">
																		<div class="checkbox checkbox-slider--b-flat checkbox-slider-success" style="padding-top:0px;">
																			<label>
																				<?
																					$book_events = explode(',',$this->BuilderEngine->get_option('be_booking_events_shop_groups'));
																					$checked = '';
																					if(in_array($group->name,$book_events))
																						$checked = 'checked="checked"';
																				?>
																				<input class="checkBox" type="checkbox" name="be_booking_events_shop_groups" value="" data-group="<?=$group->id?>" data-module="<?=$module->id?>" <?=$checked?>><span></span>
																			</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
																	<div class="fieldLabel">Can Create An Event</div>
																	<div class="fieldOption">
																		<div class="checkbox checkbox-slider--b-flat checkbox-slider-success" style="padding-top:0px;">
																			<label>
																				<?
																					$add_events = explode(',',$this->BuilderEngine->get_option('be_booking_events_add_event_groups'));
																					$checked = '';
																					if(in_array($group->name,$add_events))
																						$checked = 'checked="checked"';
																				?>
																				<input class="checkBox" type="checkbox" name="be_booking_events_add_event_groups" value="" data-group="<?=$group->id?>" data-module="<?=$module->id?>" <?=$checked?>><span></span>
																			</label>
																		</div>
																	</div>
																</div>
															<?endif;?>
															<?if($module->folder == 'booking_memberships'):?>
																<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
																	<div class="fieldLabel">Can Book A Membership</div>
																	<div class="fieldOption">
																		<div class="checkbox checkbox-slider--b-flat checkbox-slider-success" style="padding-top:0px;">
																			<label>
																				<?
																					$book_memberships = explode(',',$this->BuilderEngine->get_option('be_booking_memberships_shop_groups'));
																					$checked = '';
																					if(in_array($group->name,$book_memberships))
																						$checked = 'checked="checked"';
																				?>
																				<input class="checkBox" type="checkbox" name="be_booking_memberships_shop_groups" value="" data-group="<?=$group->id?>" data-module="<?=$module->id?>" <?=$checked?>><span></span>
																			</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
																	<div class="fieldLabel">Can Create A Membership</div>
																	<div class="fieldOption">
																		<div class="checkbox checkbox-slider--b-flat checkbox-slider-success" style="padding-top:0px;">
																			<label>
																				<?
																					$add_memberships = explode(',',$this->BuilderEngine->get_option('be_booking_memberships_add_membership_groups'));
																					$checked = '';
																					if(in_array($group->name,$add_memberships))
																						$checked = 'checked="checked"';
																				?>
																				<input class="checkBox" type="checkbox" name="be_booking_memberships_add_membership_groups" value="" data-group="<?=$group->id?>" data-module="<?=$module->id?>" <?=$checked?>><span></span>
																			</label>
																		</div>
																	</div>
																</div>
															<?endif;?>
															<?if($module->folder == 'booking_rooms'):?>
																<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
																	<div class="fieldLabel">Can Book A Room</div>
																	<div class="fieldOption">
																		<div class="checkbox checkbox-slider--b-flat checkbox-slider-success" style="padding-top:0px;">
																			<label>
																				<?
																					$book_rooms = explode(',',$this->BuilderEngine->get_option('be_booking_rooms_shop_groups'));
																					$checked = '';
																					if(in_array($group->name,$book_rooms))
																						$checked = 'checked="checked"';
																				?>
																				<input class="checkBox" type="checkbox" name="be_booking_rooms_shop_groups" value="" data-group="<?=$group->id?>" data-module="<?=$module->id?>" <?=$checked?>><span></span>
																			</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
																	<div class="fieldLabel">Can Create A Room</div>
																	<div class="fieldOption">
																		<div class="checkbox checkbox-slider--b-flat checkbox-slider-success" style="padding-top:0px;">
																			<label>
																				<?
																					$add_rooms = explode(',',$this->BuilderEngine->get_option('be_booking_rooms_add_room_groups'));
																					$checked = '';
																					if(in_array($group->name,$add_rooms))
																						$checked = 'checked="checked"';
																				?>
																				<input class="checkBox" type="checkbox" name="be_booking_rooms_add_room_groups" value="" data-group="<?=$group->id?>" data-module="<?=$module->id?>" <?=$checked?>><span></span>
																			</label>
																		</div>
																	</div>
																</div>
															<?endif;?>
															<?if($module->folder == 'builderpayment'):?>
															
															<?endif;?>
															<?if($module->folder == 'classifieds'):?>
																<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
																	<div class="fieldLabel">Can Buy</div>
																	<div class="fieldOption">
																		<div class="checkbox checkbox-slider--b-flat checkbox-slider-success" style="padding-top:0px;">
																			<label>
																				<?
																					$buy_ads = explode(',',$this->BuilderEngine->get_option('be_classifieds_shop_groups'));
																					$checked = '';
																					if(in_array($group->name,$buy_ads))
																						$checked = 'checked="checked"';
																				?>
																				<input class="checkBox" type="checkbox" name="be_classifieds_shop_groups" value="" data-group="<?=$group->id?>" data-module="<?=$module->id?>" <?=$checked?>><span></span>
																			</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
																	<div class="fieldLabel">Can Create Ads</div>
																	<div class="fieldOption">
																		<div class="checkbox checkbox-slider--b-flat checkbox-slider-success" style="padding-top:0px;">
																			<label>
																				<?
																					$add_ads = explode(',',$this->BuilderEngine->get_option('be_classifieds_create_ads_groups'));
																					$checked = '';
																					if(in_array($group->name,$add_ads))
																						$checked = 'checked="checked"';
																				?>
																				<input class="checkBox" type="checkbox" name="be_classifieds_create_ads_groups" value="" data-group="<?=$group->id?>" data-module="<?=$module->id?>" <?=$checked?>><span></span>
																			</label>
																		</div>
																	</div>
																</div>
															<?endif;?>
															<?if($module->folder == 'cp'):?>

															<?endif;?>
															<?if($module->folder == 'ecommerce'):?>
																<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
																	<div class="fieldLabel">Can Shop</div>
																	<div class="fieldOption">
																		<div class="checkbox checkbox-slider--b-flat checkbox-slider-success" style="padding-top:0px;">
																			<label>
																				<?
																					$buy_ads = explode(',',$this->BuilderEngine->get_option('be_ecommerce_shop_groups'));
																					$checked = '';
																					if(in_array($group->name,$buy_ads))
																						$checked = 'checked="checked"';
																				?>
																				<input class="checkBox" type="checkbox" name="be_ecommerce_shop_groups" value="" data-group="<?=$group->id?>" data-module="<?=$module->id?>" <?=$checked?>><span></span>
																			</label>
																		</div>
																	</div>
																</div>
																<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
																	<div class="fieldLabel">Can Add reviews</div>
																	<div class="fieldOption">
																		<div class="checkbox checkbox-slider--b-flat checkbox-slider-success" style="padding-top:0px;">
																			<label>
																				<?
																					$add_ads = explode(',',$this->BuilderEngine->get_option('be_ecommerce_reviews_groups'));
																					$checked = '';
																					if(in_array($group->name,$add_ads))
																						$checked = 'checked="checked"';
																				?>
																				<input class="checkBox" type="checkbox" name="be_ecommerce_reviews_groups" value="" data-group="<?=$group->id?>" data-module="<?=$module->id?>" <?=$checked?>><span></span>
																			</label>
																		</div>
																	</div>
																</div>
															<?endif;?>
														</div>
													</div>
												</div>
											</form>
										<?endif;?>
									<?endforeach;?>
								</div>
							</div>
							<?$j++;?>
						<?endforeach;?>
					</div>
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
				<h4 class="sidebar-right-main-title">Permissions</h4>
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
									View all permissions.
									
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
	<div class="sidebar-bg sidebar-right">
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
</div>
<!-- end #content -->
<?=get_footer();?>
<script>
$(document).ready(function(){
	$(".checkBox").on('change click', function() {
		$(this).closest('.fieldOption').prepend('<span class="ico badge badge-success animated fadeOutRight"><i class="fa fa-check"></i></span>');
		setTimeout(function(){
			$('.checkBox').closest('.fieldOption').find('.ico').fadeOut('fast');
		},250);
		var val;
		if($(this).is(':checked')){
			val = 1;
		}else{
			val = 0;
		}
		var module_id = $(this).attr('data-module');
		var group_id = $(this).attr('data-group');
		var field_name = $(this).attr('name');
		$.post("<?=base_url('admin/ajax/update_usergroup_permissions')?>",
			{
				group_id: group_id,
				module_id: module_id,
				field_name: field_name,
				field_value: val
			}
		);
	});
});
</script>
<?foreach($groups as $group): ?>
	<?foreach($modules as $module):?>
		<?if($module->folder != 'page' && $module->folder != 'layout_system'):?>
			<?if($module->folder == 'blog'):?>
				<?$categories = new Category();?>
				<script>
					$(document).ready(function (){
						var tags = [ <?php foreach ($categories->where('name !=','Unallocated')->get() as $category): ?>"<?php echo $category->name?>", <?php endforeach;?>];
						$('#default_user_post_category-<?=$module->folder.$group->id?>').tagit({
							fieldName: "default_user_post_category",
							singleField: true,
							allowDuplicates: false,
							showAutocompleteOnFocus: true,
							availableTags: [ <?php foreach ($categories->where('name !=','Unallocated')->get() as $category): ?>"<?php echo $category->name?>", <?php endforeach;?>],
							afterTagAdded: function(event, ui) {
								if ($.inArray(ui.tagLabel, tags) == -1) {
									$('#default_user_post_category-<?=$module->folder.$group->id?>').tagit("removeTagByLabel", ui.tagLabel);
								}else{
									var module_id = $(this).attr('data-module');
									var group_id = $(this).attr('data-group');
									$.post("<?=base_url('admin/ajax/update_usergroup_permissions')?>",
										{
											action: 'add',
											field_name: 'default_user_post_category',
											field_value: ui.tagLabel,
											group_id: group_id,
											module_id: module_id,
										}
									);
									$(this).closest('.fieldOption').prepend('<span class="icoTag badge badge-success animated pulse"><i class="fa fa-check"></i></span>');
									setTimeout(function(){
										$('.tagIt').closest('.fieldOption').find('.icoTag').fadeOut('fast');
									},250);
								}
							},
							afterTagRemoved: function(event, ui){
									var module_id = $(this).attr('data-module');
									var group_id = $(this).attr('data-group');
									$.post("<?=base_url('admin/ajax/update_usergroup_permissions')?>",
										{
											action: 'remove',
											field_name: 'default_user_post_category',
											field_value: ui.tagLabel,
											group_id: group_id,
											module_id: module_id,
										}
									);
								$(this).closest('.fieldOption').prepend('<span class="icoTag badge badge-success animated pulse"><i class="fa fa-check"></i></span>');
								setTimeout(function(){
									$('.tagIt').closest('.fieldOption').find('.icoTag').fadeOut('fast');
								},250);
							}
						});
					});
				</script>
			<?endif;?>
		<?endif;?>
	<?endforeach;?>
<?endforeach;?>