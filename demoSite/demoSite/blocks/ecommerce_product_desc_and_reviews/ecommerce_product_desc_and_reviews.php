<?php
class ecommerce_product_desc_and_reviews_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Online Store";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Product description and reviews";
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
        $this->load_generic_styling();

        $module_output = array(
            'module' => 'ecommerce',
            'object' => 'Ecommerce_product'
        );
        if(!isset($_GET['page']))
            $_GET['page'] = 1;
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
        $allowed_to_review = $CI->ecommerce->user_to_review_allowed();
        $total_pages = $CI->ecommerce->get_product_reviews_pages($product_id);
        if(!isset($_GET['page']))
            $_GET['page'] = 1;
        $product_reviews = $CI->ecommerce->get_reviews($product_id, $_GET['page']);
        $reviews_pagination = $CI->ecommerce->get_reviews_pagination($product_id, $total_pages);
        // Create review
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
        // /Create review
        $output = '
            <!--Tabs Widget-->
            <section class="tabs-widget">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs be-onlinestore-desc">
                    <li class="active"><a style="color:inherit;" class="tab-a" href="#descr" data-toggle="tab">Description</a></li>
					<li><a style="color:inherit;" class="tab-a" href="#additional" data-toggle="tab">Additional Information</a></li>
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
                                        
                                    </div>
                                </div>
                            </div>
                        <!--</div>-->
                    </div>
					<!--Tab2 (Info)-->
                    <div class="tab-pane fade" id="additional">
                        <!--<div class="container">-->
                            <div class="">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="">
                                        <div class="be-store-additional">
                                            <h4>Important Details:</h3>
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
                    <!--Tab3 (Reviews)-->
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
            <!--Tabs Widget Close-->
        ';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$this->load_module_css().$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), '', $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), 'module', $module_output);
		else
			return $output.$this->load_module_css().$this->apply_custom_css();
    }
}
