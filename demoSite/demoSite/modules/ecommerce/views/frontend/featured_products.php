<?$currency = new Currency($this->BuilderEngine->get_option('be_ecommerce_settings_currency'));
if($currency->symbol == '$')
	$currency->symbol = '&#36;';
?>

<?if($featured_products->exists()):?>
    
        <?foreach($featured_products as $featured_product):?>
            <?if($featured_product->active == 'yes'):?>
			<section class="catalog-grid">
				<!--Tile-->
                <div class="">
                    <div class="tile module-colors-bg">
                        <div class="badges">
                            <?if($featured_product->quantity > 0) :?>
								<?if($featured_product->label != 'None'):?>
									<span class="sale"><?=$featured_product->label?></span>
								<?endif;?>
                            <?else :?>
                                <span class="out-of-stock sale">Out of Stock</span>
                            <?endif;?>
                        </div>
                        <a href="<?=base_url('ecommerce/product/'.$featured_product->id)?>" class="aspect-ratio aspect-ratio-1-1 img-frame">
                            <img class="product-image img-ecommerce-second-theme fit-img fit-img-tight" src="<?=checkImagePath($featured_product->image)?>" alt="1"/>
                            <span class="tile-overlay"></span>
                        </a>
                        <div class="footer-product120 module-colors module-colors-bg">
                            <a style="" href="<?=base_url('ecommerce/product/'.$featured_product->id)?>"><?=$featured_product->name?></a>
                            <?$average_product_rating = $reviews->get_average_product_rating($featured_product->id);?>
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
                                        <img class="product_rating_all img-ecommerce-second-theme" src="<?=base_url()?>modules/ecommerce/assets/images/rating_images/half-star.png">
                                    <?else:?>
                                        <img class="product_rating_all img-ecommerce-second-theme" src="<?=base_url()?>modules/ecommerce/assets/images/rating_images/full-star.png">
                                    <?endif;?>
                                <?else:?>
                                    <img class="product_rating_all img-ecommerce-second-theme" src="<?=base_url()?>modules/ecommerce/assets/images/rating_images/full-star.png">
                                <?endif;?>
                            <?endfor;?>
                                <?else:?>
                                <span class="stars-products">
                                    <?for($i = 0; $i < 5; $i++): ?>
                                        <img class="product_rating_all img-ecommerce-second-theme" src="<?=base_url()?>modules/ecommerce/assets/images/rating_images/empty-star.png">
                                    <?endfor;?>
                                    <?endif;?>
								</span>
                                <?if($featured_product->quantity > 0) :?>
                                    <?if($allowed_to_shop) :?>
                                    <?endif;?>
                                <?else: ?>
                                    <h4 class="out-of-stock-h4">Out of stock!</h4>
                                <?endif;?>
						<div class="">
                        <?if($featured_product->old_price > 0) :?>
                            <div class="price-label"><?=$currency->symbol?><?=number_format($featured_product->get_price(),2,".",",")?></div>
                            <div class="price-label old-price" style=""><?=$currency->symbol?><?=number_format($featured_product->get_old_price(),2,",",".")?></div>
                        <?else :?>
                            <div class="price-label"><?=$currency->symbol?><?=number_format($featured_product->get_price(),2,".",",")?></div>
                        <?endif;?>
						</div>
                        </div>
                    </div>
                </div>
                <!--Tile-->
			</section>	
            <?endif;?>
        <?endforeach;?>
    
<?else:?>
    <div class="col-lg-12">
        <p style="margin-bottom: 40%">No products met your criteria.</p>
    </div>
<?endif;?>