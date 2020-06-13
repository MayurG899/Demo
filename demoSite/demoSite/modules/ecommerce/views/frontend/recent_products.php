<?
	$currency = new Currency($this->BuilderEngine->get_option('be_ecommerce_settings_currency'));
	if($currency->symbol == '$')
		$currency->symbol = '&#36;';	
?>
<?if($recent_products->exists()):?>
    <div class="row">
        <?foreach($recent_products as $recent_product):?>

            <?if($recent_product->active == 'yes'):?>
                <!--Tile-->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile">
                        <div class="badges module-colors-bg">
                            <?if($recent_product->quantity > 0) :?>
								<?if($recent_product->label != 'None'):?>
									<span style="" class="sale"><?=$recent_product->label?></span>
								<?endif;?>
                            <?else :?>
                                <span style="" class="out-of-stock sale">Out of Stock</span>
                            <?endif;?>
                        </div>
                        <a href="<?=base_url('ecommerce/product/'.$recent_product->id)?>" class="aspect-ratio aspect-ratio-85 img-frame">
                            <img class="product-image img-ecommerce-second-theme fit-img fit-img-tight" src="<?=checkImagePath($recent_product->image)?>" alt="1"/>
                            <span class="tile-overlay"></span>
						</a>
                        <div class="footer-product120 module-colors module-colors-bg">
                            <a style="" href="<?=base_url('ecommerce/product/'.$recent_product->id)?>"><?=$recent_product->name?></a>
							<div class="">
								<?if($recent_product->old_price > 0) :?>
									<?if($currency->symbol_position == 'before'):?>
										<div class="price-label" style=""><?=$currency->symbol?><?=number_format($recent_product->get_price(),2,".",",")?></div>
										<div class="price-label old-price" style="/*color:#fff;margin:0;font-size: 1.125em;*/"<?/*if(isset($product_page)) echo 'style="margin-right: 0px; !important"';*/?>><?=$currency->symbol?><?=number_format($recent_product->get_old_price(),2,".",",")?></div>
									<?else:?>
										<div class="price-label" style=""><?=number_format($recent_product->get_price(),2,".",",")?><?=$currency->symbol?></div>
										<div class="price-label old-price" style="/*color:#fff;margin:0;font-size: 1.125em;*/"<?/*if(isset($product_page)) echo 'style="margin-right: 0px; !important"';*/?>><?=number_format($recent_product->get_old_price(),2,".",",")?><?=$currency->symbol?></div>							
									<?endif;?>
								<?else :?>
									<?if($currency->symbol_position == 'before'):?>
										<div class="price-label" style=""><?=$currency->symbol?><?=number_format($recent_product->get_price(),2,".",",")?></div>
									<?else:?>
										<div class="price-label" style=""><?=number_format($recent_product->get_price(),2,".",",")?><?=$currency->symbol?></div>
									<?endif;?>
								<?endif;?>
							</div>
							<? /*
                                <?if($recent_product->quantity > 0) :?>
                                    <?if($allowed_to_shop) :?>
                                        <form method="post" action="<?=base_url()?>ecommerce/product/<?=$recent_product->id?>">
                                            <button style="color:inherit !important;" type="submit" class="limobtn limobtn-default limobtn-cart-responsive">Add to cart</button>
                                        </form>
                                    <?endif;?>
                                <?else: ?>
                                    <h4 class="out-of-stock-h4">Out of stock!</h4>
                                <?endif;?>
							*/?>
                        </div>
                    </div>
                </div>
                <!--Tile-->
            <?endif;?>
        <?endforeach;?>
    </div>
<?else:?>
    <div class="col-lg-12">
        <p style="margin-bottom: 40%">No products met your criteria.</p>
    </div>
<?endif;?>