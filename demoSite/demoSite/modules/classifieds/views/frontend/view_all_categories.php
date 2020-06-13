

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
				<ol class="breadcrumb">
					<li><a href="<?=base_url()?>classifieds/view_category/All">Classifieds</a></li>
					<li class="active" style="pointer-events: none"><a href="#">Directory</a></li>
				</ol>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 classifieds-category-activename"> 
				<h2>Classified Directory</h2>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
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
        <div class="col-sm-3  hidden-xs">
            <div class="sidebar">    
                <div class="row">
                    <div class="col-sm-11">
                        <?$user_panel = new Block('be_classifieds_category_user_panel_v1');?>
                        <?$user_panel->set_type('classifieds_user_menu');?>
                        <?$user_panel->add_css_class('no-float-left');?>
                        <?$user_panel->show();?>
                    </div>
                </div>
            </div>        
        </div>
        <div class="col-sm-9 listings">
			<?$search = new Block('be_classifieds_directories')?>
			<?$search->set_type('classifieds_directories');?>
			<?$search->add_css_class('no-float-left');?>
			<?$search->show();?>

		</div>	
		<div class="col-sm-12">
		<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 listing-wrapper listings-top listings-bottom">
            <div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="panel classifieds-header-light classifieds-recent-listings hidden-xs">
						<div class="panel-heading navbar-user-box classifieds-header-dark">Recent Ads on <?=$BuilderEngine->get_option('website_title')?></div>
						<div class="panel-body classifieds-panel-body-seller-latest">
							<?
                            $limit = $this->BuilderEngine->get_option("be_classifieds_recent_items_count");
                            $recent_items = new ClassifiedsItem();
                            $recent_items->order_by('time_of_creation', "DESC");
                            $recent_items->limit($limit);
                            $recent_items->where('sold', 'no');
                            $recent_items->where('ad_completed', 'yes');
                            $recent_items = $recent_items->get();
                            ?>

                            <? foreach($recent_items as $single_item):?>
                                <div class="row listing-row">
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                        <a href="<?=base_url('classifieds/view_item/'.$single_item->id)?>" class="thumbnail" ><img src="<?=checkImagePath($single_item->img)?>"></a>
                                    </div>   
                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 classifieds-recent-ads-paddingtop">
                                        <div class="row">
                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                                                <h3><a href="<?=base_url('classifieds/view_item/'.$single_item->id)?>"><?=$single_item->name?></a></h3>
                                            </div>                    
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                <h3 class="price-text">
                                                    <strong>
														<?$currency = new Currency($single_item->currency_id);?>
                                                        <?if($currency->symbol_position == "before"):?>
                                                            <?=$currency->symbol?><?=$single_item->price?>
                                                        <?else:?>
                                                            <?=$single_item->price?><?=$currency->symbol?>
                                                        <?endif;?>
                                                    </strong>
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <p class="muted">Located in 
                                                    <strong>
														<?=$single_item->address?>
														<?=', '.$single_item->location?>
                                                        <?=', '.$single_item->region?>
                                                    </strong>
                                                </p>
												<?$seller = new ClassifiedsMember($single_item->posting_member_id);?>
                                                <p class="muted">
													Posted <?=$single_item->how_much_time_ago()?> ago. 
													From: <a href="<?=base_url('classifieds/profile/'.$seller->id)?>"><?=$seller->first_name.' '.$seller->last_name;?></a>
												</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            <?endforeach;?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>		 
    </div>
    </div>
</div><!-- Modal -->