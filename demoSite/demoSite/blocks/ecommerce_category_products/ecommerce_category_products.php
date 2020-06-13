<?php
class ecommerce_category_products_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Online Store";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Category products";
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

            <ul class="bwizard-steps" role="tablist" style="margin-left: -20px;">
                <li role="presentation" class="<?if($active_menu == 'style' || $active_menu == '') echo 'active'?>"><a class="bepopup-p-buttons" href="#title" aria-controls="text" role="tab" data-toggle="tab">Background Styles</a></li>
                <li role="presentation" class="<?if($active_menu == 'custom' || $active_menu == '') echo 'active'?>"><a class="bepopup-p-buttons" href="#text" aria-controls="profession" role="tab" data-toggle="tab">Custom CSS</a></li>
                <li role="presentation" class="<?if($active_menu == 'animation' || $active_menu == '') echo 'active'?>"><a class="bepopup-p-buttons" href="#animations" aria-controls="animations" role="tab" data-toggle="tab">Animations</a></li>
            </ul>

            <div class="tab-content col-lg-6 col-md-6 col-sm-12 col-xs-12">
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
             /*   background-color: ' . $style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] a{
            /*    color: '.$style_arr['color'].' !important; */
        }
		.catprodbck{
			background-color: '.$style_arr['background-color'].' !important;			
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
            'object' => 'Ecommerce_category'
        );

        // Blocks 2.0
        if(!isset($_GET['page']))
            $_GET['page'] = 1;
        $block = new Block($this->block->get_name());
        $block->load();
        $content = $block->data('output');
        // Choose output
        if(isset($content['output']) && $content['output'] != 'default')
        {
            // Custom output
            $category_id = $content['outputId'];
            $category = new Ecommerce_category($category_id);
            $category_name = $category->name;

            $products = $CI->ecommerce->get_products($category_name, $_GET['page']);
        }
        else if (strpos($_SERVER['REQUEST_URI'],'ecommerce/search') !== false)
        {
            // Page is search
			$segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
			$keyword = end($segments);
            if (strpos($keyword, '?') !== false) {
                $keyword = explode('?', $keyword);
                $keyword = $keyword[0];
            }

            $products = $CI->ecommerce->get_products($keyword, $_GET['page'], true);
        }
        else if (strpos($_SERVER['REQUEST_URI'],'ecommerce/category') !== false)
        {
            // Page is category
			$segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
			$category_name = end($segments);
            if (strpos($category_name, '?') !== false) {
                $category_name = explode('?', $category_name);
                $category_name = $category_name[0];
            }
            else
                $category_name = urldecode($category_name);

            if($category_name == 'all' || $category_name == 'All')
                $products = $CI->ecommerce->get_products('all', $_GET['page']);
            else
                $products = $CI->ecommerce->get_products($category_name, $_GET['page']);
        }
        else
        {
            $current_url = urldecode($_SERVER['REQUEST_URI']);
            if(strpos($current_url,'category=') !== false)
                $products = $CI->ecommerce->get_products(urldecode($_GET['category']), $_GET['page']);
            else
                $products = $CI->ecommerce->get_products('all', $_GET['page']);
        }


        $output = $products;
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$this->load_module_css().$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), '', $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), 'module', $module_output);
		else
			return $output.$this->load_module_css().$this->apply_custom_css();
    }
}
