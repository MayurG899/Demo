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
			<h2>Watched Ads</h2>
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
                <div class="">
                    <div class="col-sm-12">
                        <div class="panel classifieds-header-light">
                            <div class="panel-heading navbar-user-box classifieds-header-dark">Page Listing Filters</div>
                            <div class="panel-body classifieds-panel-body-user-dropdown">
                                <form class="form-inline mini" method="get" style="margin-bottom: 0px;">
                                    <fieldset>        
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h5>Sort by</h5>
                                            </div>
                                            <div class="col-sm-8">
                                                <select name="order" class=" form-control">
                                                    <option value='0' selected>No Sorting</option>
                                                    <option value='1' <? if (isset($_GET['order']) && $_GET['order'] == 1) echo 'selected';?>>Name (A-Z)</option>
                                                    <option value='2' <? if (isset($_GET['order']) && $_GET['order'] == 2) echo 'selected';?>>Name (Z-A)</option>
                                                    <option value='3' <? if (isset($_GET['order']) && $_GET['order'] == 3) echo 'selected';?>>Price (Low-High)</option>
                                                    <option value='4' <? if (isset($_GET['order']) && $_GET['order'] == 4) echo 'selected';?>>Price (High-Low)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row filter-row">
                                            <div class="col-sm-12">
                                                <h5>Price range</h5>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">$</span>
                                                    <input name="min_price" type="text" class="form-control price-input" placeholder="min" value="<?if(isset($_GET['min_price'])) echo $_GET['min_price']?>"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">$</span>
                                                    <input name="max_price" type="text" class="form-control price-input" placeholder="max" value="<?if(isset($_GET['max_price'])) echo $_GET['max_price']?>"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row filter-row">
                                            <div class="col-sm-12">
                                                <h5>Search only:</h5>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="filter" value="featured" <?if(isset($_GET['filter']) && $_GET['filter'] == 'featured') echo 'checked';?>>
                                                        Featured ads
                                                    </label>
                                                </div><br />
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="filter" value="only_picture" <?if(isset($_GET['filter']) && $_GET['filter'] == 'only_picture') echo 'checked';?>>
                                                        Only ads with pictures
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row filter-row">  
                                            <div class="col-sm-2 pull-right" style="margin-top: 10px;">
                                                <button class="btn btn-sm btn-inverse pull-right" type="submit">Update Results</button>
                                            </div>
                                        </div>            
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 pull-right listings">
		<div class="tabbable classifieds-category"> <!-- Only required for left/right tabs -->
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab1" data-toggle="tab">List view</a></li>
            <li><a href="#tab2" data-toggle="tab">Grid view</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab1">
			<?if($watchlist->exists()):?>
                <?foreach($watchlist as $item):?>
                <?$item_category = new ClassifiedsCategory($item->category_id);?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 classifieds-category-paddings">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 <?if($item->featured == 'yes') echo 'premium'?> listing-row">
				<a class="classifieds-category" href="<?=base_url('classifieds/view_item/'.$item->id)?>">
                    <?if($item->featured == 'yes'):?>
                        <div class="ribbon-wrapper-red">
                            <div class="ribbon-red">
                                &nbsp;<span>Featured</span>
                            </div>
                        </div>
                    <?endif;?>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <span class="thumbnail">
                            <img src="<?=checkImagePath($item->img)?>">
                        </span>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <h3>
                                <?=$item->name?>  
                                <span class="price-text">
									<?$currency = new Currency($item->currency_id);?>
                                    <?if($currency->symbol_position == "before"):?>
                                        <?=$currency->symbol?><?=number_format($item->price,2)?>
                                    <?else:?>
                                        <?=number_format($item->price,2)?><?=$currency->symbol?>
                                    <?endif;?>
                                </span>
                        </h3>
                        <p class="muted">Located in 
                            <strong>
							<?=$item->location?>
                            <?=', '.$item->region?>
                            </strong>
                        </p>
						<?$seller = new ClassifiedsMember($item->posting_member_id)?>
                        <p class="muted">Posted <?=$item->how_much_time_ago()?> ago. From: <?=$seller->first_name.' '.$seller->last_name;?></p>
                        <p class="classifieds-category-p"><?=$item->description?></p></a>
                        <a href="<?=base_url('classifieds/view_category/'.$item_category->id)?>"><strong>Category Listing: <?=$item_category->name?></strong></a>
                    </div>
					</a>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <div style="text-align: center">
                                <a style="border-radius:0px" class="btn btn-sm btn-danger grouped-button" href="<?=base_url('classifieds/my_watchlist?delete_item_id='.$item->id)?>">Remove</a>
								<br><br>
                                <a style="border-radius:0px" class="btn btn-sm btn-inverse grouped-button" href="<?=base_url('classifieds/view_item/'.$item->id)?>">View Ad</a>
                            </div>
                    </div>
                </div>
			</div>
            <?endforeach;?>
            <?else:?>
                <h4> You have no products in your Watch List.</h4>
            <?endif;?>
			</div>
            <div class="tab-pane" id="tab2">
			<?if($watchlist->exists()):?>
                <?foreach($watchlist as $item):?>
                <?$item_category = new ClassifiedsCategory($item->category_id);?>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 classifieds-category-paddings">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 <?if($item->featured == 'yes') echo 'premium'?> listing-row grid-listing-row">
				<a class="classifieds-category" href="<?=base_url('classifieds/view_item/'.$item->id)?>">
                    <?if($item->featured == 'yes'):?>
                        <div class="ribbon-wrapper-red">
                            <div class="ribbon-red">
                                &nbsp;<span>Featured</span>
                            </div>
                        </div>
                    <?endif;?>
                    <div class="grid-thumbnail">
                        <span class="">
                            <img src="<?=checkImagePath($item->img)?>">
                        </span>
                    </div>
                    <div class="grid-box-padding">
                        <h3>
                          <?=$item->name?>  
                        </h3>
                        <p class="grid-classifieds-category">
							<?=$item->location?>
                            <?=', '.$item->region?>
                        </p>
						<?$seller = new ClassifiedsMember($item->posting_member_id)?>
                        <p class="grid-classifieds-category-posted">Posted <?=$item->how_much_time_ago()?> ago.</p>
						
								<span class="grid-price-text">
									<?$currency = new Currency($item->currency_id);?>
                                    <?if($currency->symbol_position == "before"):?>
                                        <?=$currency->symbol?><?=number_format($item->price,2)?>
                                    <?else:?>
                                        <?=number_format($item->price,2)?><?=$currency->symbol?>
                                    <?endif;?>
                                </span>
						</a>
						
                        <a class="grid-float-right" href="<?=base_url('classifieds/view_category/'.$item_category->id)?>"><?=$item_category->name?></a>
                    </div>
					</a>
                </div>
			</div>
            <?endforeach;?>
            <?else:?>
                <h4> You have no products in your Watch List.</h4>
            <?endif;?>
		</div>
	</div>
</div>
				
        </div>
    </div>
</div>