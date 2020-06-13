<link href="<?=base_url('modules/classifieds/assets/css/theme.css')?>" rel="stylesheet">
<link href="<?=base_url('modules/classifieds/assets/css/style.css')?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?=base_url('modules/classifieds/assets/js/fancybox/jquery.fancybox.css?v=2.1.5')?>" media="screen" />
<link rel="stylesheet" type="text/css" href="<?=base_url('modules/classifieds/assets/js/fancybox/helpers/jquery.fancybox-buttons.css?v=2.1.5')?>" media="screen" />

<script>
$(document).ready(function(){
    $('.department-li').click(function(){
        $('.custom-child-subcategories').find('.active').removeClass('active');
    });
    $('#open-user-panel').click(function(){
        $('#user-panel').toggle();
    });
});
</script>
<div class="container classifieds" id="listings-page">
    <div class="row breadcrumb-row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">  
            <ol class="breadcrumb">
                <li><a href="<?=base_url()?>classifieds/view_category/All">Classifieds</a></li>
                <?if(isset($parent_category)):?>
                  <?if(isset($parent_parent)):?>
                    <li><a href="<?=base_url()?>classifieds/view_category/<?=$parent_parent->id?>?page=1"><?=$parent_parent->name?></a></li>
                    <li><a href="<?=base_url()?>classifieds/view_category/<?=$parent_category->id?>?page=1"><?=$parent_category->name?></a></li>
                  <?else:?>
                    <li><a href="<?=base_url()?>classifieds/view_category/<?=$parent_category->id?>?page=1"><?=$parent_category->name?></a></li>
                  <?endif;?>
                <?endif;?>
                <li><a href="<?=base_url()?>classifieds/view_category/<?=$item_category->id?>?page=1"><?=$item_category->name?></a></li>
                <li class="active" style="pointer-events: none"><a href="#"><?=$item->name?></a></li>
            </ol>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <div class="row">
				<!-- new Category dropdown -->
				<style>
					.cat{display:block !important;}
				</style>
				<li class="dropdown cat classifieds-category-float">
					<a href="<?=base_url('classifieds/view_category/All')?>" title="" class="dropdown-toggle btn btn-sm btn-default classifieds-btn" data-toggle="dropdown" style="" aria-expanded="false">
						Categories
						<b class="caret"></b>                           
					</a>
					 
					<ul class="dropdown-menu dropdown-menu-left animated fadeIn panel classifieds-header-categories classifieds-user-dropdown-space">
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
				<!--end new category dropdown-->
            </div>  
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <div class="row">
				<div class="classifieds-user-button-margin">
                <a class="btn btn-sm btn-default classifieds-btn classifieds-btn-user" id="open-user-panel"><div class="navbar-user"><b class="caret classifieds-caret-user pull-right"></b><img src="<?=$this->user->get_avatar()?>" alt="" />Account </div></a>
                <div class="col-sm-11 classifieds-user-panel-details" id="user-panel">
                    <?$user_panel = new Block('be_classifieds_item_user_panel');?>
                    <?$user_panel->set_type('classifieds_user_menu');?>
                    <?$user_panel->add_css_class('no-float-left');?>
                    <?$user_panel->show();?>
                </div>
				</div>
			</div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 listing-wrapper listings-top listings-bottom">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<div class="row center zoom-gallery">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="panel-body classifieds-panel-body">
								<a class="fancybox" rel="group" href="<?=checkImagePath($item->img)?>">
									<? $images = $item->image->get();?>
									<?$i = 1;?>
									<?foreach($images as $img):?>
										<?if($i == 1):?>
											<img id="img_01" alt="" class="raised" src="<?=checkImagePath($img->image)?>"/>
										<?endif;?>
										<?$i++;?>
									<?endforeach;?>
								</a>
								<br />
								<br />
								<div class="row" id="gallery" >
									<?$j = 1;?>
									<?foreach($images as $image):?>
										<?if($j != 1):?>
											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"> 
												<a href="<?=checkImagePath($image->image)?>" class="fancybox thumbnail" rel="group" >
													<img alt="" src="<?=checkImagePath($image->image)?>"/>
												</a>
											</div>
										<?endif;?>
										<?$j++;?>
									<?endforeach;?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="panel classifieds-header-dark">
								<?$seller = new ClassifiedsMember($item->posting_member_id)?>
								<div class="panel-heading navbar-user-box">
									<img src="<?=$seller->avatar?>"> <?=$seller->first_name.' '.$seller->last_name;?> <br> 
									<div class="text-grey"><?=$item->region?> - Private Seller</div>
								</div>
								<div class="panel-body classifieds-panel-body-white">
									<div class="classifieds-reply-button">
										<?if($this->user->is_guest()):?>
											<a class="btn message-button" href="<?=base_url('classifieds/login')?>"><i class="fa fa-envelope-o"></i> Message Seller</a>
										<?elseif($this->user->get_id() != $item->posting_member_id):?>
											<button data-toggle="modal" data-target="#myModal" class="btn message-button" type="button"><i class="fa fa-envelope-o"></i> Message Seller</button>
										<?endif;?>
									</div>
									
									<div class="btn call-button"><i class="fa fa-phone"></i> Call: <?=$item->phone?></div>
								
									<?
									$watched = 'no';
									$followed = 'no';
									$member = new ClassifiedsMember($user->id);
									if($member->id != $item->posting_member_id)
									{
										$watchlist = $member->watchlist->where('item_id', $item->id);
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
										$following->where('followed_user', $item->posting_member_id);
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
										<a class="btn silver-button" href="<?=base_url('classifieds/login')?>"><i class="fa fa-star"></i> Add to Watch list</a>
										<a class="btn silver-button" href="<?=base_url('classifieds/login')?>"><i class="fa fa-share"></i> Follow <?=$seller->first_name.' '.$seller->last_name;?></a>
									<?else:?>
										<?if($this->user->get_id() != $item->posting_member_id):?>
											<?if($watched == 'yes'):?>
												<a class="btn call-button" href="<?=base_url('classifieds/my_watchlist')?>"><i class="fa fa-star"></i> Item watched</a>
											<?else:?>
												<a class="btn silver-button" href="<?=base_url('classifieds/add_to_watchlist/'.$item->id)?>"><i class="fa fa-star"></i> Add to Watch List</a>
											<?endif;?>

											<?if($followed == 'yes'):?>
												<a class="btn call-button" href="#"><i class="fa fa-share"></i> Following <?=$seller->first_name.' '.$seller->last_name;?></a>
											<?else:?>
												<a class="btn silver-button" href="<?=base_url('classifieds/follow_owner/'.$item->id)?>"><i class="fa fa-share"></i> Follow <?=$seller->first_name.' '.$seller->last_name;?></a>
											<?endif;?>
										<?endif;?>
									<?endif;?>
									
									<a class="btn silver-button" href="<?=base_url('classifieds/profile/'.$seller->id)?>"><i class="fa fa-bars"></i> View All Ads From This Seller</a>
								</div>
							</div>
						</div>			
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="panel classifieds-header-dark">
								<div class="panel-body classifieds-panel-body-white">
									<a class="btn silver-button" href="<?=base_url('classifieds/view_category/All')?>"><i class="fa fa-home"></i> View Classifieds Directory</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
				
			<div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12"> 
					<div class="panel classifieds-header-light">
						<div class="panel-body classifieds-panel-body-white classifieds-header-font12">
							<h2><?=$item->name?></h2>
							<p>Posted: <?=$item->how_much_time_ago()?> ago &nbsp;&nbsp; <?=$item->views?> views &nbsp;&nbsp; Location: 
							<?=$item->address?>
							<?=', '.$item->location?>
							<?=', '.$item->region?>
							</p>
							<p class="classifieds-price">
								<?if($item->currency->symbol_position == "before"):?>
									<?=$item->currency->symbol?><?=number_format($item->price,2)?>
								<?else:?>
									<?=number_format($item->price,2)?><?=$item->currency->symbol?>
								<?endif;?>
								<?if($this->BuilderEngine->get_option('be_classifieds_buy_now') == 'yes'):?>
									<a href="<?=base_url('classifieds/checkout?item='.$item->id);?>" class="btn btn-primary btn-sm"><i class="fa fa-money"></i> BUY NOW !</a>
								<?endif;?>
								<span class="pull-right">
									<a href="https://twitter.com/share" class="twitter-share-button">Tweet Ad</a>
									<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
								</span>
							</p>
						</div>
					</div>
					<div class="panel classifieds-header-light">
						<div class="panel-body classifieds-panel-body-white">
						<h4>Description</h4>
						<p><?=$item->description?></p>
						</div>
					</div>
					<div class="classifieds-report-bottom">
					<a href="<?=base_url('classifieds/create_report/'.$item->id)?>" class="btn btn-sm btn-danger">Report Ad</a>
					</div>
				</div>
                <div class="col-sm-4">
                </div>
            </div>
			
			<div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<div class="panel classifieds-header-dark">
						<div class="panel-heading navbar-user-box">Comments (<?=$item->review->count()?>)</div>
						<div class="panel-body classifieds-panel-body-white">
							<h4 style="margin-bottom:20px">Write a Comment to the Seller of this Ad</h4>
                            <form method="post" style="margin-bottom:25px">                                         
                                <?if($this->user->is_guest())
                                    echo '
                                    <div class="form-group">
                                        <label>Your Name</label>
                                        <input type="text" name="user" class="form-control">
                                    </div>';
                                else
                                    echo '<input type="hidden" name="user" value="'.$this->user->get_session_data('be_ecommerce_username').'">';
                                ?>
                                <div class="form-group">
                                    <label class="control-label" for="name" style="color: #2E363F">Your Comment</label>
                                    <textarea class="form-control" name="content" placeholder="Write your comment here"></textarea>
                                    <input type="hidden" name="product_id" value="<?=$item->id?>">
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary">Submit Comment</button>
                            </form>
                            <? if(empty($reviews))
                                echo ' <p style ="color: #2E363F">No comments exist for this Ad yet. Be the first to write one!</p>';
                            ?> 
                            <? foreach ($reviews as $review):?>
                                <div class="classifieds-review">
                                    <h5>From: <?=$review->user?></h5>
                                    <p class="rmeta"><?=$review->date?></p>
                                    <p><?=$review->content?></p>
                                    <? $review_number[]= $review->content;
                                    $review_total= count($review_number);?>
                                </div>
                            <? endforeach;?>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="panel classifieds-header-light">
						<div class="panel-heading navbar-user-box classifieds-header-dark">Latest Ads from <?=$seller->first_name.' '.$seller->last_name;?></div>
						<div class="panel-body classifieds-panel-body-seller-latest">
							<?$seller_items = new ClassifiedsItem();?>
							<?$i = 1;?>
							<?foreach ($seller_items->where('posting_member_id', $seller->id)->where('id !=', $item->id)->where('ad_completed','yes')->order_by('time_of_creation', 'DESC')->limit(4)->get() as $seller_item):?>
								<?	$item_category = new ClassifiedsCategory($seller_item->category_id);
									$item_currency = new Currency($seller_item->currency_id);
									$price = $item_currency->symbol.' '.number_format($seller_item->price,2);
								?>
								<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 other-from-seller">
									<div class="row">
										<a href="<?=base_url('classifieds/view_item/'.$seller_item->id)?>">
											<img class="recent-item-image" src="<?=checkImagePath($seller_item->img)?>">
										</a>
									</div>
									<div class="row recent-item-info-row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 classifieds-seller-latest-price-font">
													<p><a href="<?=base_url('classifieds/view_item/'.$seller_item->id)?>">
													<strong><?=$seller_item->name?></strong></a>
													</p>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 classifieds-seller-latest-price">
													<p><?=$price?></p>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
													<p style="classifieds-seller-latest-category"><a href="<?=base_url('classifieds/view_category/'.$item_category->id)?>"><?=$item_category->name?></a></p>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 classifieds-seller-latest-posted">    
													<p><?=$seller_item->how_much_time_ago()?> ago</p>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?$i++;?>
							<?endforeach;?>	
						</div>
					</div>
                </div>
            </div>
		 </div>
	</div>
		 
		 
	<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 listing-wrapper listings-top listings-bottom">
            <div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="panel classifieds-header-light recent-listings hidden-xs">
						<div class="panel-heading navbar-user-box classifieds-header-dark">Recent Ads on <?=$this->BuilderEngine->get_option('website_title')?></div>
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


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Send Message to <?=$seller->first_name.' '.$seller->last_name;?></h4>
                <p class="hidden-xs">Enquiring About Classified Ad: <b><?=$item->name?></b></p>
            </div>
            <form class="form-vertical" method="post" action="<?=base_url('classifieds/send_message?username='.$seller->username.'&item='.$item->id)?>">
                <div class="modal-body">
                    <fieldset>
                        <div class="row">  
                            <div class="col-sm-12" >
                                <div class="form-group">
                                    <label>Message</label>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <textarea name="content" class="form-control" rows="4" placeholder="Write your message to the Seller. Note: Abusive messages will not be tolerated and will result in your account being deleted."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Send Message</button>
                </div>
            </form>
        </div>
    </div>
</div>