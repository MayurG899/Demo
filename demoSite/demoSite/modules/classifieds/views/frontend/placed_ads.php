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
                <li class="active" style="pointer-events: none"><a href="#">Posted & Sold Ads</a></li>
            </ol>
        </div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 classifieds-category-activename"> 
			<h2>Posted Ads</h2>
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
        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 pull-right listings">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel classifieds-header-light">
                <div class="panel-heading navbar-user-box classifieds-header-dark be-classifieds-posted-ads-panel-title" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Sold / Closed Ads
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body classifieds-panel-body-user-dropdown">
                        <?$items = $member->posted_item->where('sold', 'yes')->where('ad_completed', 'yes')->get();?>
                        <?if($items->exists()):?>
                            <? foreach ($items as $item):?>
                                <div class="row listing-row" style="opacity: 0.5; pointer-events: none">
                                    <div class="col-sm-3">
                                        <a href="#" class="thumbnail" >
                                            <img alt="" src="<?=checkImagePath($item->img)?>">
                                        </a>
                                    </div>
                                    <div class="col-sm-9">
                                        <h3>
                                            <a href="#">
                                                <?=$item->name?> - 
                                                <strong>
													<?$currency = new Currency($item->currency_id);?>
                                                    <?if($currency->symbol_position == "before"):?>
                                                        <?=$currency->symbol?><?=number_format($item->price,2)?>
                                                    <?else:?>
                                                        <?=number_format($item->price,2)?><?=$currency->symbol?>
                                                    <?endif;?>
                                                </strong>
                                            </a>
                                        </h3><br>
                                        <p class="muted">Located in 
                                            <strong>
                                                <?=$item->region?>
                                                <?=', '.$item->location?>
                                            </strong>
                                        </p>
                                        <p class="muted">Posted on <?=date('H:i:s d-m-Y ', $item->time_of_creation)?></p>
										<br>
                                        <p><a style="text-decoration: none;" href="#"><?=$item->description?></a></p>
                                    </div>
                                </div>
                            <? endforeach;?>  
                        <?else:?>
                            <h4> You haven't sold any items yet.</h4>
                        <?endif;?>
                    </div>
                </div>
                <div class="panel-heading navbar-user-box classifieds-header-dark be-classifieds-posted-ads-panel-title" role="tab" id="headingTwo">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        Posted items
                        </a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body classifieds-panel-body-user-dropdown">
                        <?$items = $member->posted_item->where('sold', 'no')->where('ad_completed', 'yes')->get();?>
                        <?if($items->exists()):?>
                            <? foreach ($items as $item):?>
                                <div class="row listing-row classifieds-postedads-padding">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <div class="row">
                                            <a href="<?=base_url('/classifieds/view_item/'.$item->id)?>" class="thumbnail " >
                                                <img alt="" src="<?=checkImagePath($item->img)?>">
                                            </a>
                                        </div>
                                        <div class="row">
                                            <?$time_renewable = $item->last_renew_time + 36000;?>
                                            <?if(time() >= $time_renewable):?>
                                                <a class="btn btn-sm btn-success classsifieds-posted-ads-renewbutton" href="<?=base_url('/classifieds/renew_item/'.$item->id)?>">Renew Ad</a>
                                            <?else:?>
                                                <?$time_left = $time_renewable - time();?>
                                                <a class="btn btn-sm btn-warning" style="width:100%; pointer-events: none" href="#"><?=round($time_left / 3600, 0)?> Hours to Next Renewal</a>
                                            <?endif;?>
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-5 col-xs-12">
                                        <h3>
                                            <a href="<?=base_url('/classifieds/view_item/'.$item->id)?>">
                                                <?=$item->name?> - 
                                                <strong>
													<?$currency = new Currency($item->currency_id);?>
                                                    <?if($currency->symbol_position == "before"):?>
                                                        <?=$currency->symbol?><?=number_format($item->price,2)?>
                                                    <?else:?>
                                                        <?=number_format($item->price,2)?><?=$currency->symbol?>
                                                    <?endif;?>
                                                </strong>
                                            </a>
                                        </h3><br>
                                        <p class="muted">Located in 
                                            <strong>
                                                <?=$item->region?>
                                                <?=', '.$item->location?>
                                            </strong>
                                        </p>
                                        <p class="muted">Posted on <?=date('H:i:s d-m-Y ', $item->time_of_creation)?></p>
										<br>
                                        <p><a style="text-decoration: none;" href="<?=base_url('/classifieds/view_item/'.$item->id)?>"><?=$item->description?></a></p>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                                        <div style="text-align: center">
                                            <a class="btn silver-button grouped-button" href="<?=base_url('/classifieds/view_item/'.$item->id)?>">View Ad</a>
                                            <a style="border-top:0px" class="btn silver-button grouped-button" href="/classifieds/edit_item/<?=$item->id?>">Edit Details</a>
                                            <a style="border-top:0px" class="btn silver-button grouped-button" href="/classifieds/placed_ads?sold_item_id=<?=$item->id?>">Mark As Sold</a>
                                            <a style="border-top:0px" class="btn silver-button grouped-button" href="/classifieds/placed_ads?delete_request_id=<?=$item->id?>" onclick="return confirm('In order to delete this Ad an email confirmation will be sent to your email address. Continue?');">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            <? endforeach;?>  
                        <?else:?>
                            <h4> You haven't posted any items yet.</h4>
                        <?endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>