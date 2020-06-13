<?php
function include_ecommerce_general_product_slider_scripts()
{
    echo '
    <script src="'.base_url().'modules/ecommerce/assets/js/plugins/smoothscroll.js"></script>

    <script src="'.base_url().'modules/ecommerce/assets/js/libs/modernizr.custom.js"></script>
    <script src="'.base_url().'modules/ecommerce/assets/js/plugins/respond.js"></script>

    <script src="'.base_url().'modules/ecommerce/assets/js/libs/jquery-ui-1.10.4.custom.min.js"></script>
    <script src="'.base_url().'modules/ecommerce/assets/js/libs/jquery.easing.min.js"></script>
    <!--<script src="modules/ecommerce/assets/js/plugins/bootstrap.min.js"></script>-->
    <script src="'.base_url().'modules/ecommerce/assets/js/plugins/jquery.validate.min.js"></script>
    <script src="'.base_url().'modules/ecommerce/assets/js/plugins/icheck.min.js"></script>
    <script src="'.base_url().'modules/ecommerce/assets/js/plugins/jquery.placeholder.js"></script>
    <script src="'.base_url().'modules/ecommerce/assets/js/plugins/jquery.stellar.min.js"></script>
    <script src="'.base_url().'modules/ecommerce/assets/js/plugins/jquery.touchSwipe.min.js"></script>
    <script src="'.base_url().'modules/ecommerce/assets/js/plugins/jquery.shuffle.min.js"></script>
    <script src="'.base_url().'modules/ecommerce/assets/js/plugins/lightGallery.min.js"></script>
    <!--<script src="modules/ecommerce/assets/js/plugins/owl.carousel.min.js"></script>-->
    <script src="'.base_url().'modules/ecommerce/assets/js/plugins/masterslider.min.js"></script>
    <script src="'.base_url().'modules/ecommerce/assets/js/plugins/jquery.nouislider.min.js"></script>
    <script src="'.base_url().'modules/ecommerce/assets/js/mailer/mailer.js"></script>
    <script src="'.base_url().'modules/ecommerce/assets/js/scripts.js"></script>';
}
add_action("be_foot", "include_ecommerce_general_product_slider_scripts");

class Ecommerce_general_product_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Online Store";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "General Product";
        $info['block_icon'] = "fa-envelope-o public";

        return $info;
    }
    public function generate_admin()
    {
		$product_id = $this->block->data('product_id');
		$available_products = array();
		$all_products = new Ecommerce_product();
		foreach($all_products->get() as $key => $value){
			$available_products[$value->id] = stripslashes(str_replace('_',' ',$value->name));
		}
		$this->admin_select('product_id', $available_products, 'All Products: ', $product_id);
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
                background-color: '.$style_arr['background-color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] ol{
                color: ' . $style_arr['color'].' !important;
                text-align: ' . $style_arr['text-align'].' !important;
                background-color: ' . $style_arr['background-color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] li{
                color: '.$style_arr['color'].' !important;
                background-color: ' . $style_arr['background-color'].' !important;
        }
		div[name="'.$this->block->get_name().'"] p{
                color: '.$style_arr['color'].' !important;
                text-align: ' . $style_arr['text-align'].' !important;
                background-color: ' . $style_arr['background-color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] a{
            /*    color: '.$style_arr['color'].' !important; */
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
		$product_id = $this->block->data('product_id');

		if($product_id == null || $product_id == '')
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

        if(!isset($_GET['page']))
            $_GET['page'] = 1;
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

        if(isset($_POST['review_submit']))
        {
            $check_reviews = new Ecommerce_review();
            $check_reviews = $check_reviews->where('product_id', $product->id)->where('user', $user->username)->get();
            /*
			$already_rated_by_user = false;

            foreach ($check_reviews as $check) {
                $already_rated_by_user = true;
            }
			*/
			if($check_reviews->exists())
				$already_rated_by_user = true;
			else
				$already_rated_by_user = false;
            if ($CI->ecommerce->user_to_review_allowed() && !$already_rated_by_user) {
                $review = new Ecommerce_review();
                if ($user->is_guest()) {
                    $review->user = "guest";
                } else {
                    $review->user = $user->username;
                }
                $review->rating = $_POST['review_rating'];
                $review->content = $_POST['review_content'];
                $review->product_id = $product->id;
                $review->date_added = time();
                $review->save();
            }
			redirect(base_url('ecommerce/product/'.$product->id),'location');
        }

		$output = '
			<div id="ecommerce-general-container-'.$this->block->get_id().'" class="ecommerce-product catalog-single">
				<div class="row">
					<!-- Product Gallery -->
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<link href="'.base_url().'modules/ecommerce/assets/js/masterslider/style/masterslider.css" rel="stylesheet" media="screen">';
						$output .= '
							<div class="prod-gal master-slider prod-gal-'.$this->block->get_id().'" id="prod-gal-'.$this->block->get_id().'" bg-white-ecom>';
						if (!empty($product->image))
						{
							$output .= '
									<div class="ms-slide" >
										<img class="img-ecommerce-second-theme" src = "'.base_url().'modules/ecommerce/assets/js/masterslider/blank.gif" data-src="'.checkImagePath($product->image).'" alt="" />
										<img class="ms-thumb img-ecommerce-second-theme" src = "'.checkImagePath($product->image).'" alt = "" />
									</div >';
						}
						foreach($product->additional_image->get() as $image)
						{
							$output .= '
									<div class="ms-slide" >
										<img class="img-ecommerce-second-theme" src = "'.base_url().'modules/ecommerce/assets/js/masterslider/blank.gif" data-src="'.checkImagePath($image->url).'" alt="" />
										<img class="ms-thumb img-ecommerce-second-theme" src = "'.checkImagePath($image->url).'" alt = "" />
									</div >';
						}
						$output .= '
							</div>
						';
					$output .='
					</div>
					<!-- End Product Gallery -->

					<!-- Product Title and Price -->
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">';
						$output .='
						<div class="row">
							<div class="catalog-single bg-white-ecom">
								<div class="product_title">
								  <h1>'.$product->name.'</h1>
								</div>
							</div>
						</div>';
						$output .= '
						<form method="post">
							<div class="">
								<div class="be-onlinestore-price-box">';
									if($product->old_price > 0)
									{
										if($currency->symbol_position == 'before'){
											$output .= '
											<div class="pricename"></div>
											<div class="price">
												'.$currency->symbol.'<span id="price" class="color">'.number_format($product->get_price(),2,".",",").'</span>
											</div>
											<div class="old-price">'.$currency->symbol.''.number_format($product->get_old_price(),2,".",",").'</div>
											';
										}
										else
										{
											$output .= '
											<div class="pricename"></div>
											<div class="price">
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
											<div class="price">
												'.$currency->symbol.'<span id="price" class="color">'.number_format($product->get_price(),2,".",",").'</span>
											</div>';
										}
										else
										{
											$output .= '
											<div class="pricename"></div>
											<div class="price">
												<span id="price" class="color">'.number_format($product->get_price(),2,".",",").'</span>'.$currency->symbol.'
											</div>';							
										}
									}
						$output .= '
								</div>
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
								<div class="">';
									if($product->quantity > 0)
									{
										if ($allowed_to_shop)
										{
											$output .= '
											<div class="buttons group online-store-addcart-margin">
												<div class="qnt-count">
													<a class="incr-btn" href="#">-</a>
													<input id="quantity" name="quantity" class="form-control" type="text" value="1">
													<a class="incr-btn" href="#">+</a>
												</div>
												<button class="btn btn-success btn-md btn-store-1" name="add_to_cart_submit" type="submit"><i class="fa fa-shopping-cart"></i>ADD TO CART</button>';
												if(in_array($product->id,$CI->ecommerce_product->get_wishlist($user->get_id(),true)))
													$output .= '<a class="btn btn-inverse btn-md btn-store-1" href="'.base_url('ecommerce/wishlist').'"><i class="fa fa-check-square-o"></i> ADDED TO WISHLIST</a>';
												else
													$output .= '<a class="btn btn-warning btn-md btn-store-1" href="'.base_url('ecommerce/wishlist?add='.$product->id.'').'"><i class="fa fa-heart"></i> ADD TO WISHLIST</a>';
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
							</div>
							<div class="col-lg-12 be-store-product-options-shipping">';
								if($CI->BuilderEngine->get_option('be_ecommerce_settings_shipping_options') == 'single')
								{
									$output .= '
									<hr>
								<div class="">
									<div class="col-lg-5 col-md-5 col-sm-6 col-xs-6">
										<h5>Shipping Options:</h5>
									</div>
									<div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
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
							
							<div>';
								if($product->option->get()->exists())
								{
									foreach ($product->option->get() as $option)
									{
										$output .= '
									<div class="col-lg-12 be-store-product-options-shipping">
									   <div class="col-lg-5 col-md-5 col-sm-5">
											<h5>'.$option->option_name.':</h5>		
										</div>';

											$split_options = explode(', ', $option->options);
											$split_options_prices = explode(', ', $option->options_prices);

				//                        asort($split_options);
				//                        $split_options = array_values($split_options);

										$output .= '
										<div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
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
										<span style="padding-left:20px;font-size:20px;" class="color">'.$product->views.'</span>
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
					$output .='
					</div>
					<!-- End Product Title and Price -->

					<!-- Product Reviews -->
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
						$allowed_to_review = $CI->ecommerce->user_to_review_allowed();
						$total_pages = $CI->ecommerce->get_product_reviews_pages($product_id);
						if(!isset($_GET['page']))
							$_GET['page'] = 1;
						$product_reviews = $CI->ecommerce->get_reviews($product_id, $_GET['page']);
						$reviews_pagination = $CI->ecommerce->get_reviews_pagination($product_id, $total_pages);
						$output .= '
						<!--Tabs Widget-->
						<section class="tabs-widget">
							<!-- Nav tabs -->
							<ul class="nav nav-tabs be-onlinestore-desc">
								<li class="active"><a style="color:inherit;" class="tab-a" href="#descr" data-toggle="tab">Description</a></li>
								<li><a style="color:inherit;" class="tab-a" href="#review" data-toggle="tab">Reviews</a></li>
							</ul>
							<div class="tab-content">
								<!--Tab1 (Description)-->
								<div class="tab-pane fade active in" id="descr">
									<!--<div class="container">-->
										<div class="">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<p class="be-store-p">' . $product->description . '</p>
												<div class="">
													<div class="be-store-additional">
														<h4>Additional Information:</h3>
														<ul>';
															foreach ($product->product_field->order_by('type','ASC')->get() as $field)
															{
																$output .= '<li class="additionalinfo"><b>' . $field->name . ':</b> ' . $field->get_value($product->id) . '</li>';
															}
															$output .= '
														</ul>
													</div>
												</div>
											</div>
										</div>
									<!--</div>-->
								</div>
								<!--Tab2 (Reviews)-->
								<div class="tab-pane fade" id="review">
									<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									' . $product_reviews . '
									' . $reviews_pagination . '
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">';
										if ($allowed_to_review)
										{
											$output .= '
											<form method="post">
												<div class="row">
													<div class="col-md-8 col-md-8 col-sm-8 col-xs-8">
														<label for="review_coment">Write Your Review:</label>
													</div>
													<div class="col-md-4 col-md-4 col-sm-4 col-xs-4">
														<label for="review_rating"><b>Rate Product</b>:</label>
													</div>
												</div>
												<div class="row">
													<div class="col-md-8 col-md-8 col-sm-8 col-xs-8">
														<textarea style="width: 100%; border-radius: 5px; height: 90px; border:1px solid #b6c2c9; " type="textarea" paceholder="Your comment" name="review_content"></textarea>
													</div>
													<div class="col-md-4 col-md-4 col-sm-4 col-xs-4">
														<div class="row">
															<div class="col-md-9">
																<select style="font-family: FontAwesome" name="review_rating">
																	<option value="1" required>&#xf005;</option>
																	<option value="2" required>&#xf005; &#xf005;</option>
																	<option value="3" required>&#xf005; &#xf005; &#xf005;</option>
																	<option value="4" required>&#xf005; &#xf005; &#xf005; &#xf005;</option>
																	<option value="5" required selected="selected">&#xf005; &#xf005; &#xf005; &#xf005; &#xf005;</option>
																</select>
															</div>
														</div>
														<div class="row">
															<div class="col-md-12 col-md-12 col-sm-12 col-xs-12">
																<input style="margin-top:10px;" type="submit" class="btn btn-inverse btn-block" name="review_submit" value="Submit">
															</div>
														</div>
													</div>
												</div>
											</form>';
										}
										else
											$output .= '<h4 class="reviews-message-color">You are not allowed to add reviews</h4>';
										$output .= '
										</div>
									</div>
								</div>
							</div>
						</section>
						<!--Tabs Widget Close-->';
					$output .='
					</div>
					<!-- End Product Reviews -->
				</div>
			</div>
		';
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$this->load_module_css().$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'ecommerce-general-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), $menu);
		else
			return $output.$this->load_module_css().$this->apply_custom_css();
    }
}
?>