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
			<h2>Followed Sellers</h2>
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
		<div class="tabbable classifieds-category"> <!-- Only required for left/right tabs -->
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab1" data-toggle="tab">Sellers Your Following</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab1">
			<?if($following->exists()):?>
                <? $collapse = 0;?>
                <? foreach($following as $follow):?>
                    <? $followed_member = new ClassifiedsMember($follow->followed_user);
                        $followed_member_extend = $followed_member->classifiedsmemberextend->get();
                        ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 classifieds-category-paddings">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 <?//if($item->featured == 'yes') echo 'premium';?> listing-row">
				<a class="classifieds-category" href="<?=base_url('classifieds/profile/'.$followed_member->id);?>">
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <span class="thumbnail">
                            <img src="<?=checkImagePath($followed_member->avatar)?>">
                        </span>
                    </div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                       <h2><?=$followed_member->username?></h2>
                    </div>
					</a>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div style="text-align: center">
                                <a style="border-radius:0px" class="btn btn-sm btn-primary grouped-button" href="<?=base_url('classifieds/profile/'.$followed_member->id);?>">View Profile</a>
								<br><br>
                                <a style="border-radius:0px" class="btn btn-sm btn-success grouped-button" href="<?=base_url('classifieds/send_message?username='.$followed_member->username)?>">Send Message</a>
								<br><br>
                                <a style="border-radius:0px" class="btn btn-sm btn-danger grouped-button" href="<?=base_url('classifieds/followed_users?delete_followed_id='.$followed_member->id);?>">Stop Following Seller</a>
                            </div>
                    </div>
                </div>
			</div>
			<? $collapse++;?>
            <?endforeach;?>
            <?else:?>
                <h4>You Are Not Following Any Sellers.</h4>
            <?endif;?>  
			</div>
            <div class="tab-pane" id="tab2">
		</div>
	</div>
</div>
		
        </div>
    </div>
</div><!-- Modal -->