<style>
.dropdown:hover .dropdown-menu {
    display: block;
	margin:0;
	background-color:#2e363f;
 }
</style>
				<header id="page-title" style="padding:0;">
					<div class="container">

				<div class="navbar-collapse nav-main-collapse collapse">
					<nav class="nav-main mega-menu">
						<ul class="nav nav-pills nav-main scroll-menu" id="categoryMenu">
							<ul class="breadcrumb" style="margin:5px 0 0;">
							     <li><a href="<?=base_url();?>">Home</a></li>
 							     <li><a href="<?=base_url();?>ecommerce/category/All?page=1">Products</a></li>
							     <li><a href="<?=base_url();?>ecommerce/category/<?=$parent->name?>"><?=$parent->name?></a></li>
							     <li class="active"><a href="<?=base_url();?>ecommerce/category/<?=$product_category->name?>"><?=$product_category->name?></a></li>
						    </ul>
							<li class="dropdown mega-menu-item mega-menu-fullwidth pull-right">
							
								<a class="dropdown-toggle" href="#" style="padding-top:3px;padding-bottom:3px;">
									<h4 style="margin-bottom:0;">Categories <i class="fa fa-angle-down"></i></h4>
								</a>
								<ul class="dropdown-menu" id="cat" style="left:50%;">

									<li>
										<div class="mega-menu-content">
											<div class="row">
												<div class="col-md-3">	
											        <span class="mega-menu-sub-title" style="padding-left:20px;">
								                        <a href="<?=base_url('ecommerce/category/All?page=1')?>"><i class="fa fa-circle-o"></i> All Items</a>
										            </span>
										        </div>	
												  <?foreach($categories as $parent_category):?>
												  <?if($parent_category->parent == 0):?>
												<div class="col-md-3">
													<ul class="sub-menu">
														<span class="mega-menu-sub-title">
														    <a href="<?=base_url('ecommerce/category/'.$parent_category->name)?>"><i class="fa fa-circle-o"></i> <?=$parent_category->name?></a>
														</span>
															<?if($parent_category->has_children()):?>
															<ul class="sub-menu" style="/*padding-left:20%;*/">
															<?foreach($categories as $category):?>
															<?if($category->parent == $parent_category->id):?>
																<li ><a href="<?=base_url('ecommerce/category/'.$category->name)?>"> <?=$category->name?></a></li>
                                                            <?endif;?>
                                                           <?endforeach;?>
															</ul>
													      <?else:?>
                                                          <?endif;?>		
													</ul>
												</div>
												 <?endif;?>
                                                 <?endforeach;?>
											</div>
										</div>
									</li>
								</ul>
							</li>
                        </ul>
                    </nav>
                </div>

					</div>
				</header>