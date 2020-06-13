<?if($products->exists()):?>
<?	$currency = new Currency($this->BuilderEngine->get_option('be_ecommerce_settings_currency'));
	if($currency->symbol == '$')
		$currency->symbol = '&#36;';	
?>
<section class="catalog-grid"> 
    <div class="row">
        <div class="catprodbck">
            <?foreach($products as $product):?>
                <?if($product->active == 'yes'):?>
                    <!--Tile-->
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="tile module-colors-bg">
                            <div class="badges">
                                <?if($product->quantity > 0) :?>
									<?if($product->label != 'None'):?>
										<span class="sale"><?=$product->label?></span>
									<?endif;?>
                                <?else :?>
                                    <span class="sale">Out of Stock</span>
                                <?endif;?>
                            </div>
                            <a href="<?=base_url('ecommerce/product/'.$product->id)?>" class="aspect-ratio aspect-ratio-85 img-frame">
                                <img class="product-image img-ecommerce-second-theme fit-img fit-img-tight" src="<?=checkImagePath($product->image)?>" alt="1"/>
                                <span style="" class="tile-overlay"></span>
                            </a>
                            <div class="footer-product module-colors module-colors-bg">
                                <a style="" href="<?=base_url('ecommerce/product/'.$product->id)?>"><?=$product->name?></a>
                                <?$average_product_rating = $reviews->get_average_product_rating($product->id);?>
                                <?if($average_product_rating > 0):?>
                                <?
                                $end_with_halfstar = false;
                                if(round($average_product_rating) > $average_product_rating){
                                    $end_with_halfstar = true;
                                }
                                ?>
                                <span class="stars-products">
                            <?for($i = 0; $i < round($average_product_rating); $i++): ?>
                                <?if($i + 1 == round($average_product_rating)):?>
                                    <?if($end_with_halfstar):?>
                                        <img class="product_rating_all img-ecommerce-second-theme" src="<?=base_url('modules/ecommerce/assets/images/rating_images/half-star.png')?>">
                                    <?else:?>
                                        <img class="product_rating_all img-ecommerce-second-theme" src="<?=base_url('modules/ecommerce/assets/images/rating_images/full-star.png')?>">
                                    <?endif;?>
                                <?else:?>
                                    <img class="product_rating_all img-ecommerce-second-theme" src="<?=base_url('modules/ecommerce/assets/images/rating_images/full-star.png')?>">
                                <?endif;?>
                            <?endfor;?>
                                    <?else:?>
                                    <span class="stars-products">
                                    <?for($i = 0; $i < 5; $i++): ?>
                                        <img class="product_rating_all img-ecommerce-second-theme" src="<?=base_url('modules/ecommerce/assets/images/rating_images/empty-star.png')?>">
                                    <?endfor;?>
                                        <?endif;?>
									</span>
								<div class="">
									<?if($product->old_price > 0) :?>
										<?if($currency->symbol_position == 'before'):?>
											<div class="price-label"><?=$currency->symbol?><?=number_format($product->get_price(),2,".",",")?></div>
											<div class="price-label old-price" style="margin:0;"><?=$currency->symbol?><?=number_format($product->get_old_price(),2,",",".")?></div>
										<?else:?>
											<div class="price-label"><?=number_format($product->get_price(),2,".",",")?><?=$currency->symbol?></div>
											<div class="price-label old-price" style="margin:0;"><?=number_format($product->get_old_price(),2,",",".")?><?=$currency->symbol?></div>								
										<?endif;?>
									<?else :?>
										<?if($currency->symbol_position == 'before'):?>
												<div class="price-label"><?=$currency->symbol?><?=number_format($product->get_price(),2,".",",")?></div>
										<?else:?>
												<div class="price-label"><?=number_format($product->get_price(),2,".",",")?><?=$currency->symbol?></div>
										<?endif;?>
									<?endif;?>
								</div>
                            </div>
                        </div>
                    </div>
                    <!--Tile-->
                <?endif;?>
            <?endforeach;?>
        </div>
    </div>
</section>	
<?else:?>
    <div class="col-lg-4 col-md-6 col-sm-12">
        <p style="margin-bottom: 40%">No products met your criteria.</p>
    </div>
<?endif;?>