<?php
class ecommerce_product_price_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Online Store";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Product price";
        $info['block_icon'] = "fa-envelope-o";

        return $info;
    }
    public function generate_admin()
    {
    }
    public function generate_style($active_menu = '')
    {
        include FCPATH.'/builderengine/public/animations/animations.php';

        $background_active = $this->block->data('background_active');
        $background_color = $this->block->data('background_color');
        $background_image = $this->block->data('background_image');

        $text_align = $this->block->data('text_align');
        $text_color = $this->block->data('text_color');
        $custom_css = $this->block->data('custom_css');
        $custom_classes = $this->block->data('custom_classes');

        $active_options = array("color" => "Color", "image" => "Image");
        $text_options = array("left" => "Left", "center" => "Center", "right" => "Right");

        $animation_type = $this->block->data('animation_type');
        $animation_duration = $this->block->data('animation_duration');
        ?>
        <div role="tabpanel">

            <ul class="nav nav-tabs" role="tablist" style="margin-left: -20px;">
                <li role="presentation" class="<?if($active_menu == 'style' || $active_menu == '') echo 'active'?>"><a href="#title" aria-controls="text" role="tab" data-toggle="tab">Background Styles</a></li>
                <li role="presentation" class="<?if($active_menu == 'custom' || $active_menu == '') echo 'active'?>"><a href="#text" aria-controls="profession" role="tab" data-toggle="tab">Custom CSS</a></li>
                <li role="presentation" class="<?if($active_menu == 'animation' || $active_menu == '') echo 'active'?>"><a href="#animations" aria-controls="animations" role="tab" data-toggle="tab">Animations</a></li>
            </ul>

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade <?if($active_menu == 'style' || $active_menu == '') echo 'in active'?>" id="title">
                    <?php
                    $this->admin_select('background_active', $active_options, 'Active background: ', $background_active);
                    $this->admin_input('background_color','text', 'Background color: ', $background_color);
                    $this->admin_file('background_image','Background image: ', $background_image);
                    $this->admin_select('text_align', $text_options, 'Text align: ', $text_align);
                    $this->admin_input('text_color','text', 'Text Color: ', $text_color);
                    ?>
                </div>
                <div role="tabpanel" class="tab-pane fade <?if($active_menu == 'custom') echo 'in active'?>" id="text">
                    <?php
                    $this->admin_textarea('custom_css','Custom CSS: ', $custom_css, 4);
                    $this->admin_textarea('custom_classes','Custom Classes: ', $custom_classes, 2);
                    ?>
                </div>
                <div role="tabpanel" class="tab-pane fade <?if($active_menu == 'animation') echo 'in active'?>" id="animations">
                    <?php
                    $this->admin_select('animation_type', $types,'Animation: ', $animation_type);
                    $this->admin_select('animation_duration', $durations,'Animation state: ', $animation_duration);
                    ?>
                </div>
            </div>

        </div>
        <?php
    }
    public function load_generic_styling()
    {
        $background_active = $this->block->data('background_active');
        $background_color = $this->block->data('background_color');
        $background_image = $this->block->data('background_image');

        $text_align = $this->block->data('text_align');
        $text_color = $this->block->data('text_color');
        $custom_css = $this->block->data('custom_css');

        $animation_type = $this->block->data('animation_type');
        $animation_duration = $this->block->data('animation_duration');

		if(!empty($animation_type)){
			$this->block->force_data_modification();
			$this->block->add_css_class('animated '.$animation_duration.' '.$animation_type);
		}

        $style_arr = $this->block->data("style");
        if($background_active != 'image')
            $style_arr['background-color'] = $background_color;
        else{
            $style_arr['background-image'] = $background_image;
			$style_arr['display'] = 'flex';
		}
        $style_arr['text-align'] = $text_align;
        $style_arr['color'] = $text_color;
        $style_arr['text'] = ';'.$custom_css;
        $this->block->set_data("style", $style_arr);
    }
    public function load_module_css()
    {
        return '
        
        ';
    }
    public function apply_custom_css()
    {
        $style_arr = $this->block->data("style");
        if(!isset($style_arr['color']))
            $style_arr['color'] = '';
        if(!isset($style_arr['text-align']))
            $style_arr['text-align'] = '';
        if(!isset($style_arr['background-color']))
            $style_arr['background-color'] = '';

        return '
        <style>
        div[name="'.$this->block->get_name().'"] h1{
                color: '.$style_arr['color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] h2{
                color: '.$style_arr['color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] h3{
                color: '.$style_arr['color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] h4{
                color: '.$style_arr['color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] h5{
                color: '.$style_arr['color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] p{
            /*    color: '.$style_arr['color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] span{
            /*    color: '.$style_arr['color'].' !important; */
                text-align: ' . $style_arr['text-align'].' !important;
            /*    background-color: ' . $style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] div{
                color: '.$style_arr['color'].' !important;
                text-align: '.$style_arr['text-align'].' !important;
            /*    background-color: '.$style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] ul{
                color: '.$style_arr['color'].' !important;
                text-align: '.$style_arr['text-align'].' !important;
                background-color: '.$style_arr['background-color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] ol{
                color: ' . $style_arr['color'].' !important;
                text-align: ' . $style_arr['text-align'].' !important;
                background-color: ' . $style_arr['background-color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] li{
                color: '.$style_arr['color'].' !important;
                text-align: ' . $style_arr['text-align'].' !important;
                background-color: ' . $style_arr['background-color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] a{
            /*    color: '.$style_arr['color'].' !important; */
        }
		.color{
			color: '.$style_arr['color'].' !important;
		}
        </style>';
    }
    public function generate_content()
    {
        global $active_controller;
		$user = &$active_controller->user;
        $CI = &get_instance();
        $CI->load->module('layout_system');
        $CI->load->module('ecommerce');
		$CI->load->model('ecommerce_product');
		$CI->load->library('cart');
        $this->load_generic_styling();

        $module_output = array(
            'module' => 'ecommerce',
            'object' => 'Ecommerce_product'
        );

        // Blocks 2.0
        $block = new Block($this->block->get_name());
        $block->load();
        $content = $block->data('output');
        // Choose output
        if(isset($content['output']) && $content['output'] != 'default')
        {
            // Custom output
            $product_id = $content['outputId'];
        }
        else
        {
            // Default output
            $current_url = urldecode($_SERVER['REQUEST_URI']);
            if (strpos($current_url, 'ecommerce/product') !== false) {
                $segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
                $product_id = end($segments);
            }
            else if(strpos($current_url,'product=') !== false)
                $product_id = $_GET['product'];
            else
            {
                $products = new Ecommerce_product();
                $product_id = $products->order_by('id', 'ASC')->limit(1)->get()->id;
            }
        }
        $product = new Ecommerce_product($product_id);
        $allowed_to_shop = $CI->ecommerce->user_to_shop_allowed();
        $product_shipping_options = $product->shipping->get();
        $currency = new Currency($CI->BuilderEngine->get_option('be_ecommerce_settings_currency'));
		if($currency->symbol == '$')
			$currency->symbol = '&#36;';
		$qty_in_cart = 0;
		$cart_content = $CI->cart->contents();
		foreach($cart_content as $item){
			if($product->id == $item['id'])
				$qty_in_cart += $item['qty'];
		}

        if(isset($_POST['quantity']) && ($_POST['quantity'] > $product->quantity - $qty_in_cart))
            $error = 'quantity';
        else
            $error = '';
			
		$average_product_rating = $CI->ecommerce->get_average_product_rating($product->id);
		// Add to cart
        if(isset($_POST['add_to_cart_submit']))
        {
            $qty_in_cart = 0;
            $cart_content = $CI->cart->contents();
            foreach($cart_content as $item){
                if($product->id == $item['id'])
                    $qty_in_cart += $item['qty'];
				if(strpos($item['id'],'block') !== FALSE){
					$CI->cart->remove($item['rowid']);
				}
            }

            if($_POST['quantity'] > $product->quantity - $qty_in_cart)
            {
                $data['error'] = 'quantity';
            }
            else
            {
                if(!isset($_POST['shipping_id']) || $_POST['shipping_id'] == '')
                    $_POST['shipping_id'] = 3;
                $product_options = array();
                if(isset($_POST['options']))
                {
                    foreach($_POST['options'] as $option)
                    {
                        $option = explode('--', $option);
                        $option[1] = '+'.$option[1];
                        $product_options[] = implode('--', $option);
                    }
                }
                $product_info = array(
                    "id" => $product->id,
                    "qty"=> $_POST['quantity'],
                    "price" => $product->price,
                    "name" => $product->name,
                    "image" => $product->image,
                    "shipping_id" => $_POST['shipping_id'],
                    "options" => $product_options
                );
                $CI->cart->product_name_rules = '[:print:]';
                $CI->cart->insert($product_info);
                redirect('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], 'refresh');
            }
        }
        // /Add to cart
        $output = '
        <form method="post">
            <div class="">
                              
				<div class="star_rating">
				<div>';
              if($average_product_rating > 0)
                  for ($i = 0; $i < round($average_product_rating); $i++) {
                      if ($i + 1 == round($average_product_rating))
                          $output .= '<span><img class="product_rating img-ecommerce-second-theme" src="' . base_url() . '/modules/ecommerce/assets/images/rating_images/full-star.png"></span>';
                      else
                          $output .= '<span><img class="product_rating img-ecommerce-second-theme" src="' . base_url() . '/modules/ecommerce/assets/images/rating_images/full-star.png"></span>';
                  }
              $output .= 
			    '</div>
            </div>
                
            </div>
			
			<div class="row be-store-product-options-shipping be-onlinestore-price-box">
				<div class="col-lg-7 col-md-7 col-sm-7 custom-store-css-addons-name">
					<h5>Product Price:</h5>		
				</div>
				<div class="col-lg-5 col-md-5 col-sm-4 col-xs-4 custom-store-css-addons-selection">';
                    if($product->old_price > 0)
                    {
						if($currency->symbol_position == 'before'){
							$output .= '
							<div class="pricename"></div>
							<div class="price productprice">
								'.$currency->symbol.'<span id="price" class="color">'.number_format($product->get_price(),2,".",",").'</span>
							</div>
							<div class="old-price">'.$currency->symbol.''.number_format($product->get_old_price(),2,".",",").'</div>
							';
						}
						else
						{
							$output .= '
							<div class="pricename"></div>
							<div class="price productprice">
								<span id="price" class="color">'.number_format($product->get_price(),2,".",",").'</span>'.$currency->symbol.'
							</div>
							<div class="old-price">'.number_format($product->get_old_price(),2,".",",").''.$currency->symbol.'</div>
							';							
						}
                    }
                    else
                    {
						if($currency->symbol_position == 'before'){
							$output .= '
							<div class="pricename"></div>
							<div class="price productprice">
								'.$currency->symbol.'<span id="price" class="color">'.number_format($product->get_price(),2,".",",").'</span>
							</div>';
						}
						else
						{
							$output .= '
							<div class="pricename"></div>
							<div class="price productprice">
								<span id="price" class="color">'.number_format($product->get_price(),2,".",",").'</span>'.$currency->symbol.'
							</div>';							
						}
                    }
        $output .= '</div>
			</div>
			
			
            
			
<div class="row be-store-product-options-shipping custom-store-css-quantity">';
                    if($product->quantity > 0)
                    {
                        if ($allowed_to_shop)
                        {
                            $output .= '
                            <div class="col-lg-7 col-md-7 col-sm-7 custom-store-css-addons-name">
								<h5>Product Quantity:</h5>		
							</div>
							
							<div class="col-lg-5 col-md-5 col-sm-4 col-xs-4 custom-store-css-addons-selection custom-store-css-left-minus">
							<div class="buttons group online-store-addcart-margin">
                                <div class="qnt-count">
                                    <a class="incr-btn qty-button-signs" href="#">-</a>
                                    <input id="quantity" name="quantity" class="form-control" type="text" value="1">
                                    <a class="incr-btn qty-button-signs" href="#">+</a>
                                </div>
                             </div>
							</div>';
                        }
                    }
                    else
                    {
                        $output .= '';
                    }
        $output .= '
</div>
			
			';
                if($product->option->get()->exists())
                {
                    foreach ($product->option->get() as $option)
                    {
                        $output .= '
					<div class="row be-store-product-options-shipping">
					   <div class="col-lg-7 col-md-7 col-sm-7 custom-store-css-addons-name">
                            <h5>'.$option->option_name.':</h5>		
						</div>';

                            $split_options = explode(', ', $option->options);
                            $split_options_prices = explode(', ', $option->options_prices);

//                        asort($split_options);
//                        $split_options = array_values($split_options);

                        $output .= '
                        <div class="col-lg-5 col-md-5 col-sm-4 col-xs-4 custom-store-css-addons-selection">
							<select class="custom-select form-control pointer less-padded-select" name="options[]">
                                <option value="default--0">- Select -</option>';
                                for ($i = 0; $i < count($split_options); $i++)
                                {
                                    $displayed_price = '';
                                    if($currency->symbol_position == 'after'){
                                        $price_with_currency = $split_options_prices[$i].''.$currency->symbol;
                                    }
                                    else
                                        $price_with_currency = $currency->symbol.''.$split_options_prices[$i];

                                    if(strpos($price_with_currency, '-') !== false)
                                    {
                                        $price_with_currency = '- '.str_replace('-', '', $price_with_currency);
                                    }
                                    else
                                        $price_with_currency = '+ '.$price_with_currency;

                                    $displayed_price = $price_with_currency;

                                    $output .= '
                                    <option value="'.$split_options[$i].'--'.$split_options_prices[$i].'">'.$split_options[$i].' '.$displayed_price.'</option>';
                                }
                        $output .= '
                            </select>
                        </div>
					</div>';
                    }
                }
        $output .= '
            </div>
			
			<div class="row be-store-product-options-shipping custom-shipping-active">';
                if($CI->BuilderEngine->get_option('be_ecommerce_settings_shipping_options') == 'single')
                {
                    $output .= '
				<div class="">
					<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 custom-store-css-addons-name">
                        <h5>Shipping Options:</h5>
					</div>
					<div class="col-lg-5 col-md-5 col-sm-5 col-xs-4 custom-store-css-addons-selection">
                        <select class="form-control pointer less-padded-select" name="shipping_id" required>
                            <option value="">- Select -</option>';
                    foreach ($product_shipping_options as $shipping)
                    {
                        if ($shipping->type == "flat")
                        {
                            if ($currency->symbol_position == "before")
                                $output .= '<option value="' . $shipping->id . '" required>' . $shipping->name . ' + ' . $currency->symbol . '' . $shipping->price . '</option>';
                            else
                                $output .= '<option value="' . $shipping->id . '" required>' . $shipping->name . ' + ' . $shipping->price . '' . $currency->symbol . '</option>';
                        }
                        else
                            $output .= '<option value="' . $shipping->id . '" required>' . $shipping->name . ' + ' . $shipping->price . '%</option>';
                    }
                    $output .= '
                     </select>
                    </div>
				</div>';
                }
        $output .= '
            </div>
			
<div class="custom-store-css-addcart-product">';
                    if($product->quantity > 0)
                    {
                        if ($allowed_to_shop)
                        {
                            $output .= '
                            <div class="buttons group online-store-addcart-margin">
                                <button class="btn btn-inverse btn-block btn-store-1 custom-store-css-button-addcart" name="add_to_cart_submit" type="submit"><i class="fa fa-shopping-cart"></i>ADD TO CART</button> <br>';
								if(in_array($product->id,$CI->ecommerce_product->get_wishlist($user->get_id(),true)))
									$output .= '<a class="btn btn-success btn-block btn-store-1 custom-store-css-addwish-product " href="'.base_url('ecommerce/wishlist').'"><i class="fa fa-check-square-o"></i> ADDED TO WISHLIST</a>';
								else
									$output .= '<a class="btn btn-outline btn-outline-store btn-block btn-store-1 custom-store-css-addwish-product " href="'.base_url('ecommerce/wishlist?add='.$product->id.'').'"><i class="fa fa-heart"></i> ADD TO WISHLIST</a>';
                                if($error != '')
                                    $output .= '<p style="color:red;font-size:13px">Available quantity exceeded. Please order '.$product->quantity.' or less.</p>';
                            $output .= '</div>';
                        }
                    }
                    else
                    {
                        $output .= '
                        <div class="buttons group">
                            <h2 class="out-of-stock-h2 color">Out of stock!</h2>
                        </div>';
                    }
        $output .= '
</div>
				
            <div class="catalog-single">';
              if($CI->BuilderEngine->get_option('be_ecommerce_display_views') == "yes")
                  $output .= '
					<hr>
					<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
						<h4>Share</h4>
					  <div class="social-links">
						<div class="addthis_inline_share_toolbox"></div>
						<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-57bb30091db34e72"></script>
					  </div>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
					  <h4>Views</h4>
					  <div class="tags">
						<span style="font-size:20px;" class="color">'.$product->views.'</span>
					  </div>
					</div>';
				else
					$output .='
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<h3 class="color">Share</h3>
					  <div class="social-links">
						<div class="addthis_inline_share_toolbox"></div>
						<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-57bb30091db34e72"></script>
					  </div>
					</div>
				';
        $output .='<br></div>
        </form>
        <script>
        $(document).ready(function(){
            $(".custom-select").change(function(){
                priceFromOptions = 0;
                $(document).find(".custom-select").each(function(){
                    var value = $(this).find(":selected").val();
                    value = value.split("--");
                    var valuePrice = parseFloat(value[1]);
                    priceFromOptions += valuePrice;
                    console.log(priceFromOptions);
                });
                var productPrice = parseFloat("'.$product->get_price().'");
                var newPrice = 0;
                newPrice = (productPrice + priceFromOptions).toFixed(2);

                $("#price").html(newPrice);
            });
        });
        </script>
        ';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$this->load_module_css().$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), '', $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), 'module', $module_output);
		else
			return $output.$this->load_module_css().$this->apply_custom_css();
    }
}