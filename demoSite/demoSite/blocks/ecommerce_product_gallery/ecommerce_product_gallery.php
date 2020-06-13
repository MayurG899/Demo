<?php
function include_ecommerce_product_slider_scripts()
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
add_action("be_foot", "include_ecommerce_product_slider_scripts");

class ecommerce_product_gallery_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Online Store";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Product gallery";
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
        <link href="'.base_url().'modules/ecommerce/assets/js/masterslider/style/masterslider.css" rel="stylesheet" media="screen">
        
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
            /*    background-color: '.$style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] ol{
                color: ' . $style_arr['color'].' !important;
                text-align: ' . $style_arr['text-align'].' !important;
            /*    background-color: ' . $style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] li{
                color: '.$style_arr['color'].' !important;
                text-align: ' . $style_arr['text-align'].' !important;
            /*    background-color: ' . $style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] a{
            /*    color: '.$style_arr['color'].' !important; */
        }
        </style>';
    }
    public function generate_content()
    {
        global $active_controller;
        $CI = &get_instance();
        $CI->load->module('layout_system');
        $CI->load->module('ecommerce');
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

        $first_load = $block->data('first_load');
        if(strpos($this->block->get_name(),'custom-block') === false || $first_load === false)
        {
            $output = '
            <!--Product Gallery-->
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
        }
        else
        {
            $output = '
            <img src="'.$product->image.'" style="width: 60%;margin-left: 22%;">
            ';
        }
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$this->load_module_css().$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), '', $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), 'module', $module_output);
		else
			return $output.$this->load_module_css().$this->apply_custom_css();
    }
}
