<link href="<?=base_url('/builderengine/public/editor/css/special.css')?>" rel="stylesheet" type="text/css" />
<div class="page-content">
    <section class="shopping-cart">
        <div class="container">
            <div class="">
                <!--Items List-->
                <div class="col-lg-12 col-md-12 col-sm-12 col-sm-12">
                    <h4 class="title">Store Cart Details</h4>
                    <? $count = count($this->cart->contents());?>
                    <?if($count <= 0):?>
						<div class="alert alert-info" style="min-height:350px;padding-top:100px">
							<h3 class="text-center">You have no products in your shopping cart.</h3><br/>
							<p class="text-center"><a class="btn btn-xl btn-primary" href="<?=base_url('ecommerce/category/All')?>" class="to-all-cart"><i class="fa fa-arrow-left"></i> Back To Products</a></p>
						</div>
                    <?else:?>
                        <table class="items-list">
                            <tr>
								<th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Product Price</th>
                                <th>Quantity</th>
								<th></th>
                                <?if($this->BuilderEngine->get_option('be_ecommerce_settings_shipping_options') == 'single') :?>
                                    <th>Shipping</th>
                                <?endif;?>
                                <!--<th>Color</th>-->
                                <th>Add-On Options</th>
                                <th class="mobile-cart-td">Total Price</th>
                            </tr>
                            <!--Items-->
                            <? $total_shipping = 0;?>
                            <?$first_item = true;?>
                            <? $i = 1;?>
                            <? foreach ($this->cart->contents() as $product):?>
                                <form id="form<?=$i?>" method="post" action="<?=base_url('ecommerce/edit_cart_item/'.$product['rowid'])?>">


                                    <?
                                    $option_price = 0;
                                    if(isset($product['options']))
                                    {
                                        foreach ($product['options'] as $option) {
                                            if (strpos($option, '+') !== FALSE) {
                                                $price = explode('--+', $option);
                                                if (isset($price[1])) {
                                                    $option_price += $price[1];
                                                }
                                            } else {
                                                $price = explode(' -', $option);
                                                if(isset($price[1])) {
                                                    $option_price -= $price[1];
                                                }
                                            }
                                        }
                                    }
                                    $product_total_price = ($product['price'] + $option_price) * $product['qty'];
                                    $shipping_price = 0;
                                    if($this->BuilderEngine->get_option('be_ecommerce_settings_shipping_options') == 'single') {
                                        $product_shipping = new Ecommerce_shipping($product['shipping_id']);
                                        if ($product_shipping->type == 'percent')
                                            $shipping_price = (($product['price'] + $option_price) / 100) * $product_shipping->price;
                                        else
                                            $shipping_price = $product_shipping->price;
                                    }
                                    ?>

                                    <?if($first_item):?>
                                    <?$first_item = false;?>
                                    <tr class="item first">
                                        <?else:?>
                                    <tr class="item">
                                        <?endif;?>
										<td><?=$i;?></td>
                                        <td class="thumb"><a href="<?=base_url()?>ecommerce/product/<?=$product['id']?>"><img class="img-ecommerce-second-theme" style="width:70px;" src="<?=checkImagePath($product['image'])?>" alt="Item image"/></a></td>
                                        <td class="name"><a href="<?=base_url()?>ecommerce/product/<?=$product['id']?>"><?=$product['name']?></a></td>
                                        <td class="price" style="padding-right:10px;padding-top: 10px;">
                                            <?if($currency->symbol_position == 'before'):?>
                                                <?=$currency->symbol?><?=number_format($product['price'],2,".",",")?>
                                            <?else :?>
                                                <?=number_format($product['price'],2,".",",")?><?=$currency->symbol?>
                                            <?endif;?>
                                        </td>
                                        <td class="qnt-count">
											<span id="qtyErr<?=$i?>" style="color: red;position: absolute;bottom:120px;width:300px;background:yellow;border:1px solid red;padding:10px;display:none;"></span>
                                            <a class="incr-btn" href="#">-</a>
                                            <input id="qty-<?=$i?>" class="quantity form-control" type="text" name="qty" value="<?=$product['qty']?>">
                                            <a class="incr-btn" href="#">+</a>
                                        </td>
										<td class="delete refreshcolor"><button type="submit" style="background:transparent;border:none;"><i class="fa fa-refresh" title="Update Cart Changes"></i></button></td>

                                        <?if($this->BuilderEngine->get_option('be_ecommerce_settings_shipping_options') == 'single') :?>
                                            <td>
                                                <small>
                                                    <?if($currency->symbol_position == 'before'):?>
                                                        <?=$currency->symbol?><?=number_format($shipping_price,2,".",",")?>
                                                    <?else :?>
                                                        <?=number_format($shipping_price,2,".",",")?><?=$currency->symbol?>
                                                    <?endif;?>
                                                </small>
                                            </td>
                                        <?endif;?>
                                        <!--<td><p><small><? //if(isset($product['color'])) echo $product['color']?></small></p></td>-->
                                        <td>
                                            <?if(isset($product['options']))
                                            {
                                                foreach($product['options'] as $option)
                                                {
                                                    $option_info = explode('--+', $option);
                                                    echo '<div><small>'.$option_info[0].'</small></div>';
                                                }
                                            }?>
                                        </td>
                                        <? $totalcost = $product_total_price + $shipping_price;?>
                                        <?if($currency->symbol_position == 'before'):?>
                                            <td class="total mobile-cart-td" style="padding-right:10px;padding-top: 10px;"><?=$currency->symbol?><?=number_format($totalcost,2,".",",")?></td>
                                        <?else :?>
                                            <td class="total mobile-cart-td" style="padding-right:10px;padding-top: 10px;"><?=number_format($totalcost,2,".",",")?><?=$currency->symbol?></td>
                                        <?endif;?>
                                        <td class="delete"><a href="<?=base_url('ecommerce/delete_cart_item/'.$product['rowid'])?>"><i class="fa fa-trash-o" title="Remove Product"></i></a></td>
                                        <!-- <td class="update"><a onclick="document.getElementById('form<?=$i?>').submit();"><i class="icon-refresh"></i></a></td> -->
                                    </tr>
                                </form>
                                <? $i++;?>
                            <?endforeach;?>
                        </table>
                    <?endif;?>
                </div>
				
                <!--Sidebar-->
				<div class="col-lg-6 col-md-6 col-md-12 col-md-12">
                   
                </div>
				<?/*
                <div class="col-lg-3 col-md-3 col-md-12 col-md-12">
                    <?if($count > 0 && $this->BuilderEngine->get_option('be_ecommerce_settings_shipping_options') != 'single'):?>
                        <h3>Shipping</h3>
                        <form class="cart-sidebar" method="post">
                            <div class="cart-totals">
                                <table>
                                    <tr>
                                        <td>
                                            <div class="form-group" style="margin-left: 0px;margin-right: 0px">
                                                <div class="col-md-12" style="padding-left: 0px;padding-right: 0px">
                                                    <select id="chosen-shipping" class="form-control" name="shipping" required style="height: 44.8px">
                                                        <option value="">- Select -</option>
                                                        <?$shipping_options = new Ecommerce_shipping();?>
                                                        <?$shipping_options->get();?>
                                                        <?foreach ($shipping_options as $shipping_option) :?>
															<?if((int)$shipping_option->id !== 1):?>
																<option value="<?=$shipping_option->name?>">
																	<?
																	echo $shipping_option->name.' ';
																	if($shipping_option->type == 'flat')
																		echo $currency->symbol;
																	echo $shipping_option->price;
																	if($shipping_option->type == 'percent')
																		echo '%';
																	?>
																</option>
															<?endif;?>
                                                        <?endforeach;?>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </form>
                    <?endif;?>
                </div>
				*/?>
                <div class="col-lg-3 col-lg-offset-9 col-md-3 col-md-offset-9 col-md-12 col-md-12">
                    <?if($count > 0):?>
                        <form class="cart-sidebar" method="post">
                            <div class="cart-totals">
                                <table>
                                    <tr>
                                        <?if($this->BuilderEngine->get_option('be_ecommerce_settings_shipping_options') == 'single') :?>
                                            <td style="width:40%;"><h4> Total Price:</h4></td>
                                        <?else:?>
                                            <td style="width:40%;"><h4> Total Price:</h4><small style="font-size:12px;"> (without shipping)</small></td>
                                        <?endif;?>
                                        <?if($currency->symbol_position == 'before'):?>
                                            <td class="total total-checkout align-r" style="padding-left:30px"> <?=$currency->symbol?><?=number_format($cart_calculations[2],2,".",",")?></td>
                                        <?else :?>
                                            <td class="total total-checkout align-r" style="padding-left:30px"> <?=number_format($cart_calculations[2],2,".",",")?><?=$currency->symbol?></td>
                                        <?endif;?>
                                    </tr>
                                </table>
                                <a href="<?=base_url('ecommerce/category/All?page=1')?>" class="ecommerce-btn ecommerce-btn-black ecommerce-btn-block ecommerce-btn-block-checkout"><i class="fa fa-cart-plus"></i> Continue Shopping</a>
                                <a id="checkOut" href="<?=base_url('ecommerce/checkout')?>" class="ecommerce-btn ecommerce-btn-success ecommerce-btn-block ecommerce-btn-block-checkout"><i class="fa fa-check-square-o"></i> Checkout</a>
                            </div>
                        </form>
                    <?endif;?>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
$(document).ready(function(){
	<?$i =1;?>
	<?foreach($this->cart->contents() as $product):?>
		<? $product[$i] = new Ecommerce_product();
			$product[$i] = $product[$i]->where('id', $product['id'])->get();?>
		var stockQty = <?=$product[$i]->quantity?>;
		$( "#form<?=$i?>" ).submit(function( event ){
			if ( $( "#qty-<?=$i?>" ).val() <= stockQty ) {
				$( "#checkOut" ).removeClass('disabled');
				return;
			}
		$( "#qtyErr<?=$i?>" ).text( "Available quantity exceeded.Please order " + <?=$product[$i]->quantity?> + " or less !" ).show().fadeOut(5000);
		$( "#checkOut" ).addClass('disabled');
			event.preventDefault();
		});
		function validate<?=$i?>() {
			var ret = true;
			var maxQty = <?=$product[$i]->quantity?>;
			var val = $("#qty-<?=$i?>").val();
			if (val > maxQty) {
				$( "#checkOut" ).addClass('disabled');
				ret = false;
			}
			return ret;
		};
		<?$i++;?>
	<?endforeach;?>
	/*
    $('#checkOut').click(function()
    {
       var chosenShipping =  $('#chosen-shipping').val();
        if(chosenShipping != '' && typeof chosenShipping !== 'undefined')
            window.location.href = "<?=base_url().'ecommerce/checkout?shipping='?>" + chosenShipping;
        else
            window.location.href = "<?=base_url().'ecommerce/checkout'?>";
    });
	*/
	//Add(+/-) Button Number Incrementers
	$(".incr-btn").on("click", function(e) {
		e.preventDefault();
		var $button = $(this);
		var oldValue = $button.parent().find("input").val();
		if ($button.text() == "+") {
			var newVal = parseFloat(oldValue) + 1;
		} else {
		 // Don't allow decrementing below 1
			if (oldValue > 1) {
				var newVal = parseFloat(oldValue) - 1;
			} else {
				newVal = 1;
			}
		}
		$button.parent().find("input").val(newVal);
	});
});
</script>