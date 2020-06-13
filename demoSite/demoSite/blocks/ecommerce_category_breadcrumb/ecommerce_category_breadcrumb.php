<?php
class ecommerce_category_breadcrumb_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Online Store";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Breadcrumb";
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
        </style>';
    }
    public function generate_content()
    {
        global $active_controller;
        $CI = &get_instance();
        $CI->load->module('layout_system');
        $CI->load->module('ecommerce');
        $this->load_generic_styles();

        // Get page
        if (strpos($_SERVER['REQUEST_URI'],'search') !== false) {
            // Page is search
			$segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
			$keyword = end($segments);
            if (strpos($keyword, '?') !== false) {
                $keyword = explode('?', $keyword);
                $keyword = $keyword[0];
            }

            $output = '
                <ol class="breadcrumb" style="background:inherit;">
                    <li><a style="color:inherit;" href="' . base_url() . '">Home</a></li>
                    <li><a style="color:inherit;" href="' . base_url() . 'ecommerce/category/All?page=1">Products</a></li>
                </ol><!--Breadcrumbs Close-->';
        }
        else if (strpos($_SERVER['REQUEST_URI'],'product/') !== false) {
            // Page is product
			$segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
			$product_id = end($segments);
            if (strpos($product_id,'?') !== false) {
                $product_id = explode('?', $product_id);
                $product_id = $product_id[0];
            }
            $product = new Ecommerce_product($product_id);
            $all_parent_categories = $CI->ecommerce->get_all_parent_categories($product->category->get()->id);

            $output = '
            <ol class="breadcrumb product-page-breadcrumb" style="background:inherit !important;color:inherit !important;" >
                <li style="color:inherit !important;"><a style="color:inherit !important;" href="'.base_url().'ecommerce/category/All?page=1">View All Products</a></li>';
                for ($i=0; $i < count($all_parent_categories) ; $i++)
                {
                    if($i + 1 == count($all_parent_categories))
                    {
                        $output .= '<li style="color:inherit !important;" class="active"><a style="color:inherit !important;" href="'.base_url().'ecommerce/category/'.$all_parent_categories[$i]->name.'">'.$all_parent_categories[$i]->name.'</a></li>';
                    }
                    else
                    {
                        $output .= '<li><a style="color:inherit !important;" href="'.base_url().'ecommerce/category/'.$all_parent_categories[$i]->name.'">'.$all_parent_categories[$i]->name.'</a></li>';
                    }
                }
                $output .= '
            </ol><!--Breadcrumbs Close-->';
        }
        else
        {
            // Page is category
			$segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
			$category_name = end($segments);
            if (strpos($category_name, '?') !== false) {
                $category_name = explode('?', $category_name);
                $category_name = $category_name[0];
            }

            $output = '';
            if ($category_name == "All" || $category_name == "all")
            {
                $output .= '
                <ol class="be-breadcrumb be-onlinestore-breadcrumb">
                    <li><a href="' . base_url() . '">Home</a></li>
                    <li><a href="' . base_url() . 'ecommerce/category/All?page=1">Store Homepage</a></li>
                </ol><!--Breadcrumbs Close-->';
            }
            else
            {
                $category = new Ecommerce_category();
                $category = $category->where('name', $category_name)->get();
                $all_parent_categories = $CI->ecommerce->get_all_parent_categories($category->id);

                $output .= '
                <ol class="be-breadcrumb be-onlinestore-breadcrumb" style="background:inherit;">
                    <li><a href="'.base_url().'ecommerce/category/All?page=1">Store Homepage</a></li>';
                for ($i=0; $i < count($all_parent_categories) ; $i++)
                {
                    if ($i + 1 == count($all_parent_categories))
                        $output .= '<li class="active"><a href="' . base_url() . 'ecommerce/category/' . $all_parent_categories[$i]->name . '">' . $all_parent_categories[$i]->name . '</a></li>';
                    else
                        $output .= '<li><a href="' . base_url() . 'ecommerce/category/' . $all_parent_categories[$i]->name . '">' . $all_parent_categories[$i]->name . '</a></li>';
                }
                $output .= '
                </ol><!--Breadcrumbs Close-->';
            }
        }
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$this->load_module_css().$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), '', $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), 'style');
		else
			return $output.$this->load_module_css().$this->apply_custom_css();
    }
}
?>
