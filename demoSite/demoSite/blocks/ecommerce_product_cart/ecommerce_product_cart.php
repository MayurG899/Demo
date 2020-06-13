<?php
class ecommerce_product_cart_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Online Store";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Shopping cart";
        $info['block_icon'] = "fa-envelope-o public";

        return $info;
    }
    public function generate_admin()
    {
    }
    public function generate_style($active_menu = '')
    {
       
    }
    public function load_generic_styling()
    {
       
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
                background-color: ' . $style_arr['background-color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] div{
                color: '.$style_arr['color'].' !important;
                text-align: '.$style_arr['text-align'].' !important;
                background-color: '.$style_arr['background-color'].' !important;
        }
		div[name="'.$this->block->get_name().'"] td{
                color: '.$style_arr['color'].' !important;
                text-align: '.$style_arr['text-align'].' !important;
                background-color: '.$style_arr['background-color'].' !important;
        }
		div[name="'.$this->block->get_name().'"] th{
                color: '.$style_arr['color'].' !important;
                text-align: '.$style_arr['text-align'].' !important;
                background-color: '.$style_arr['background-color'].' !important;
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
                color: '.$style_arr['color'].' !important;
        }
		div[name="'.$this->block->get_name().'"] b{
                color: '.$style_arr['color'].' !important;
        }
        </style>';
    }
    public function generate_content()
    {
        global $active_controller;
        $CI = & get_instance();
        $CI->load->module('layout_system');
        $CI->load->module('ecommerce');
        $CI->load->library('cart');

        $this->load_generic_styles();
        $button_position = $this->block->data('button_position');
        $float = 'float:right !important;';
        if($button_position == 'left')
            $float = 'float:left !important;';
        if($button_position == 'center')
            $float = 'float:none !important;margin-left:50% !important;margin-right:50% !important;';
        if($button_position == 'right')
            $float = 'float:right !important;';

        // 3.5.2 fixes
        $background_active = $this->block->data('background_active');
        $background_color = $this->block->data('background_color');
        $background_image = $this->block->data('background_image');
        $text_align = $this->block->data('text_align');

        // button styles
        $button_styles = '
            .cart-explicit-styles-'.$this->block->get_id().'{
            ';
        if(!empty($text_align))
        {
            $button_styles .= 'float: '.$text_align.';';
        }
        if($background_active == 'color')
        {
            $button_styles .= 'background-color: '.$background_color.';';
        }
        $button_styles .= '}';

        // dropdown styles
        if(empty($background_image))
            $background_image = base_url().'files/blogimage.jpg';
        if($background_active == 'image')
        {
            $dropdown_styles = '
            .cart-explicit-styles-'.$this->block->get_id().' .cart-dropdown{
                    background-image: url('.$background_image.');
                    background-size: cover;
                    background-repeat: no-repeat;
            }
            .cart-explicit-styles-'.$this->block->get_id().' .cart-dropdown .footer{
                background: none !important;
            }
            ';
        }
        else if ($background_active == 'color'){
            $dropdown_styles = '
            .cart-explicit-styles-'.$this->block->get_id().' .cart-dropdown{
                    background-color: '.$background_color.';
            }
            .cart-explicit-styles-'.$this->block->get_id().' .cart-dropdown .footer{
                background: none !important;
            }
            ';
        }
        else
            $dropdown_styles = '';

        //

        $currency = new Currency($CI->BuilderEngine->get_option('be_ecommerce_settings_currency'));
		if($currency->symbol == '$')
			$currency->symbol = '&#36;';
        $cart_calculations = $CI->ecommerce->get_cart_calculations();
        // Output
        $output = '
        <style>
        '.$button_styles.'
        '.$dropdown_styles.'
        </style>
		<div class="custom-store-special-cart-1">
        <div class="cart-explicit-styles-'.$this->block->get_id().' cart-btn">';
        if($currency->symbol_position == 'before')
            $output .= '<a style="color:inherit;" class="btn btn-outlined-invert" href="'.base_url('ecommerce/cart').'"><i class="fa fa-shopping-cart"></i><span>'.count($CI->cart->contents()).'</span><b>'.$currency->symbol.''.number_format($cart_calculations[2],2,".",",").'</b></a>';
        else
            $output .= '<a style="color:inherit;" class="btn btn-outlined-invert" href="'.base_url('ecommerce/cart').'"><i class="fa fa-shopping-cart" ></i><span>'.count($CI->cart->contents()).'</span><b style="margin-left:-10px;">'.number_format($cart_calculations[2],2,".",",").''.$currency->symbol.'</b></a>';
        $output .= '<!--Cart Dropdown-->
            <div class="cart-dropdown">
              <span></span><!--Small rectangle to overlap Cart button-->
              <div class="body">
                <table class="mini-cart">
                  <tr>
                    <th>Products</th>
                    <th>Qty</th>
                    <th>Price</th>
                  </tr>';
                  foreach ($CI->cart->contents() as $product_in_cart) {
                      $output .= '<tr class="item">
                      <td><a href="' . base_url('ecommerce/delete_cart_item/' . $product_in_cart['rowid']) . '" ><div class="delete"></div></a><a href="'.base_url('ecommerce/product/'.$product_in_cart['id']).'">' . $product_in_cart['name'] . '</a></td>
                      <td><input type="text" disabled value="' . $product_in_cart['qty'] . '"></td>';

                      $option_price = 0;
                      if (isset($product_in_cart['options']))
                      {
                          foreach ($product_in_cart['options'] as $option) {
                              if (strpos($option, '+') !== FALSE) {
                                  $price = explode('--+', $option);
                                  if (isset($price[1])) {
                                      $option_price += $price[1];
                                  }
                              } else {
                                  $price = explode(' -', $option);
                                  if (isset($price[1])) {
                                      $option_price -= $price[1];
                                  }
                              }
                          }
                      }
                      $product_total_price = ($product_in_cart['price'] + $option_price) * $product_in_cart['qty'];
                      $shipping_price = 0;
                      if($CI->BuilderEngine->get_option('be_ecommerce_settings_shipping_options') == 'single') {
                        $product_shipping = new Ecommerce_shipping($product_in_cart['shipping_id']);
                        if ($product_shipping->type == 'percent')
                          $shipping_price = (($product_in_cart['price'] + $option_price) / 100) * $product_shipping->price;
                        else
                          $shipping_price = $product_shipping->price;
                      }
                      $product_total_price = $product_total_price + $shipping_price;
                      if($currency->symbol_position == 'before')
                        $output .= '<td class="price">'.$currency->symbol.''.number_format($product_total_price,2,".",",").'</td>';
                      else
                        $output .= '<td class="price">'.number_format($product_total_price,2,".",",").''.$currency->symbol.'</td>';

                      $output .= '
                      </tr>';
                  }
                $output .= '
                <tr>
                  <td></td>
                  <td></td>';
                  if($currency->symbol_position == 'before')
                    $output .= '<td><div class="total label label-colors"><strong>Total: '.$currency->symbol.''.number_format($cart_calculations[2],2,".",",").'</strong></div></td>';
                  else
                    $output .= '<td><div class="total label label-colors"><strong>Total: '.number_format($cart_calculations[2],2,".",",").''.$currency->symbol.'</strong></div></td>';
                $output .= '
                </tr>
                </table>
              </div>
              <div class="footer group">
                <div class="buttons">
                  <a class="ecommerce-btn ecommerce-btn-outlined-invert btn-outlined-invert-to-cart-left" href="'.base_url().'ecommerce/cart"><i class="fa fa-cart-plus"></i>Shopping Cart Details</a>
				<a class="ecommerce-btn ecommerce-btn-outlined-invert btn-outlined-invert-to-cart" href="'.base_url().'ecommerce/checkout"><i class="fa fa-shopping-basket"></i>Checkout Now</a>
				</div>
              </div>
            </div><!--Cart Dropdown Close-->
        </div>
          <!--Shopping Cart Message-->
          <section class="cart-message">
            <i class="fa fa-check-square"></i>
            <p class="p-style3">The product was successfully added to your cart.</p>
            <a style="color:inherit;" class="ecommerce-btn-outlined-invert ecommerce-btn-black ecommerce-btn-sm" href="'.base_url().'ecommerce/cart">View cart</a>
          </section><!--Shopping Cart Message Close-->
		  </div>
        ';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$this->load_module_css().$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), '', $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), 'style');
		else
			return $output.$this->load_module_css().$this->apply_custom_css();
    }
}
?>
