<link href="<?=base_url('modules/classifieds/assets/css/theme.css')?>" rel="stylesheet">
<link href="<?=base_url('modules/classifieds/assets/css/style.css')?>" rel="stylesheet">
<script>
$(document).ready(function(){
    $('.department-li').click(function(){
        $('.custom-child-subcategories').find('.active').removeClass('active');
    });
});
</script>
<div class="classifieds-top-bar">
<div class="breadcrumb-row">
	<div class="container classifieds">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  
            <ol class="be-breadcrumb">
                <li><a href="<?=base_url()?>classifieds/view_category/All">Classifieds</a></li>
                <li><a href="<?=base_url('/classifieds/profile/'.$member->id)?>"><?=$member->username?></a></li>
                <li class="active" style="pointer-events: none"><a href="#"><?=$current_page?></a></li>
            </ol>
        </div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 classifieds-category-activename"> 
			<h2>Seller Profile</h2>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<?$search = new Block('be_classifieds_search_section')?>
			<?$search->set_type('classifieds_search_section');?>
			<?$search->add_css_class('no-float-left');?>
			<?$search->show();?>
        </div>
    </div>
	</div>
</div>
	
<div class="container classifieds">
    
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
            <div class="sidebar">    
                <div class="">
                    <div class="col-sm-12">
                        <?$user_panel = new Block('be_classifieds_category_user_panel_v1');?>
                        <?$user_panel->set_type('classifieds_user_menu');?>
                        <?$user_panel->add_css_class('no-float-left');?>
                        <?$user_panel->show();?>
                    </div>
                </div>
				<div class="">
                <!-- new Category dropdown -->
		<div class="col-lg-12 col-md-12 col-sm-11 col-xs-12">		
		<style>
			.cat{display:block !important;}
		</style>
		<li class="dropdown cat classifieds-category-listing-list">			 
			<ul class="dropdown-menu dropdown-menu-left animated fadeIn panel classifieds-header-categories classifieds-user-dropdown-space classifieds-category-listing-open">
                <div id="user-panel-heading" class="panel-heading navbar-user-box classifieds-header-categories-dark">Classifieds Listing</div>
				<div class="classifieds-panel-body-category-dropdown">
				<?foreach($categories->where('parent', 0)->get() as $department_category):?>
					<?if($department_category->has_children()):?>
					<li class="dropdown-submenu classifieds-category-submenu classifieds-panel-body-user-dropdown">
						<a href="<?=base_url('classifieds/view_category/'.$department_category->id)?>" class="dropdown-color-17 dropdown-size-17" title="" style=""><?=$department_category->name?></a>
						<ul class="dropdown-menu">
							<?foreach($categories->where('parent', $department_category->id)->get() as $subcategory):?>
								<?if($subcategory->has_children()):?>
									<li class="dropdown-submenu classifieds-panel-body-user-dropdown">
										<a tabindex="-1" href="<?=base_url('classifieds/view_category/'.$subcategory->id)?>"><?=$subcategory->name?></a>
										<ul class="dropdown-menu classifieds-panel-body-user-dropdown">
											<?foreach($categories->where('parent', $subcategory->id)->get() as $subsubcategory):?>
											<li><a href="<?=base_url('classifieds/view_category/'.$subsubcategory->id)?>"><?=$subsubcategory->name?></a></li>
											<?endforeach?>
										</ul>
									</li>
								<?else:?>
									<li><a href="<?=base_url('classifieds/view_category/'.$subcategory->id)?>"><?=$subcategory->name?></a></li>
								<?endif;?>
							<?endforeach;?>
						</ul>
					</li>
					<?else:?>
						<li class="dropdown-submenu classifieds-category-submenu classifieds-panel-body-user-dropdown">
							<a href="<?=base_url('classifieds/view_category/'.$department_category->id)?>" class="dropdown-color-17 dropdown-size-17" title="" style=""><?=$department_category->name?></a>
						</li>
					<?endif;?>
				<?endforeach;?>
				</div>  
			</ul>
		</li>
		</div>
		<!--end new category dropdown-->
            </div>     
            </div>        
        </div>
        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
            <div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 classifieds-profile-box">
                       <span class="thumbnail">
							<img src="<?=checkImagePath($member->avatar)?>">
						</span>
						<div class="panel classifieds-header-light">
							<?if($this->user->get_id() != $member->id):?>
								<div class="panel-body classifieds-profile-body-follow">
									<?
										$seller = new User($member->id);
										$watched = 'no';
										$followed = 'no';
										if($member->id != $visitor->id)
										{
											//$watchlist = $member->watchlist->where('item_id', $item->id);
											$watchlist = $member->watchlist->get();
											$i = 0;
											foreach ($watchlist as $watched)
											{
												$i++;
											}
											if($i > 0)
												$watched = 'yes';

											$following = new ClassifiedsFollowing();
											$following->where('following_user', $this->user->get_id());
											$following->where('followed_user', $member->id);
											$following->get();
											$i = 0;
											foreach ($following as $follow)
											{
												$i++;
											}
											if($i > 0)
												$followed = 'yes';
										}
									?>
									<?if($this->user->is_guest()):?>
										<a class="btn silver-button" href="<?=base_url('/classifieds/login')?>"><i class="fa fa-share"></i> Follow <?=$seller->first_name.' '.$seller->last_name;?></a>
									<?else:?>
										<?if($followed == 'yes'):?>
											<a class="btn call-button" href="#"><i class="fa fa-share"></i> Following <?=$seller->username?></a>
										<?else:?>
											<a class="btn silver-button" href="<?=base_url('/classifieds/follow_user/'.$member->id)?>"><i class="fa fa-share"></i> Follow <?=$seller->first_name.' '.$seller->last_name;?></a>
										<?endif;?>
									<?endif;?>
								</div>
							<?endif;?>
						</div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
						<div class="panel classifieds-header-light">
							<div class="panel-body classifieds-profile-body-info">
							<h4><?=$member->first_name.' '.$member->last_name?></h4>
							<? $i = 0?>
									<? foreach ($member->posted_item->get() as $item)
									{
									  $i++;
									}
									?>
							<p><b>Registered:</b> <?=date('d-m-Y ', $member->date_registered)?> <span class="classifieds-profile-postedads"><b>Ads Posted:</b> <?=$i?></span></p>
							</div>
						</div>
						

						<div class="panel classifieds-header-light">
							<div class="panel-body classifieds-profile-body-info">
							<h5><b>Email:</b> <?=$member->email?></h5>
							<p><b>Phone Number:</b> <?=$member_extend->telephone?></p>
							</div>
						</div>
						
						<div class="panel classifieds-header-light">
							<div class="panel-body classifieds-profile-body-info">
							<h5><b>Address:</b> <?=$member_extend->address?></h5>
							<h5><b>City:</b> <?=$member_extend->city?></h5>
							<p><b>Country:</b> <?=$member_extend->country?></p>
							</div>
						</div>
					</div>
                </div>
                <div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 listings">
						<div class="panel classifieds-header-light">
						<div class="panel-body classifieds-profile-body-info">
						<?if($this->user->is_guest()):?>
							<a class="btn message-button" href="<?=base_url('cp/login')?>">Login to Send Message</a>
						<?elseif($this->user->get_id() != $member->id):?>
							<h3 class="classifieds-search-results-margin30">Send Message</h3>
							<form method="post" action="<?=base_url('classifieds/send_message?username='.$member->username)?>">                                   
							<div class="form-group">
								<label>Message:</label>
								<textarea class="form-control" name="content" placeholder="Write your message to the Seller. Note: Abusive messages will not be tolerated and will result in your account being deleted." style="height:130px" required></textarea>
							</div>
							<button type="submit" class="classifieds-sendmessage-messagereply-right btn btn-success">Send Message</button>
							<button type="reset" class="classifieds-sendmessage-messagereply-right btn btn-inverse">Reset Text</button>
							</form>
						<?endif;?>
					</div>
					</div>
					</div>
				</div> 
            </div>
            <div class="panel-heading navbar-user-box classifieds-header-dark">Ads Posted by Seller</div>
			<div class="panel-body classifieds-panel-body-seller-latest">
			<?$items = $member->posted_item->where('sold', 'no')->where('ad_completed', 'yes')->get();?>
            <?if($items->exists()):?>
                <? foreach ($items as $item):?>
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 classifieds-profileother-from-seller">
                                    <div class="row">
										<a href="<?=base_url('/classifieds/view_item/'.$item->id)?>">
											<img class="recent-item-image" src="<?=$item->img?>">
										</a>
                                    </div>
								<div class="col-lg-12 recent-item-info-row">
                                                        <div class="">
                                                            <div class="">
                                                                <div class="classifieds-seller-latest-price-font">
																	 <p><a href="<?=base_url('/classifieds/view_item/'.$item->id)?>">
																		<strong><?=$item->name?></strong>
																	</a> </p>
                                                                </div>
                                                            </div>
                                                            <div class="">
                                                                <div class="classifieds-seller-latest-price">
                                                                    <p>
																		<?$currency = new Currency($item->currency_id);
																		if($currency->symbol_position == "before"):?>
																			<?=$currency->symbol?><?=$item->price?>
																		<?else:?>
																			<?=$item->price?><?=$currency->symbol?>
																		<?endif;?>
																	</p>
                                                                </div>
                                                            </div>
                                                            <div class="">
                                                                <div class="">    
                                                                    <p style="classifieds-seller-latest-category"><a class="classifieds-profile-desc" href="<?=base_url('/classifieds/view_item/'.$item->id)?>"><?=$item->description?></a></p>
                                                                </div>
                                                            </div>
                                                            <div class="">
                                                                <div class="classifieds-seller-latest-posted">    
                                                                    <p><?=$item->how_much_time_ago()?> ago</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
			<? endforeach;?>
            <?else:?>
                <h4> Seller has not posted any Classified Ads.</h4>
            <?endif;?>
			</div>
            
        </div>
    </div>
</div><!-- Modal -->