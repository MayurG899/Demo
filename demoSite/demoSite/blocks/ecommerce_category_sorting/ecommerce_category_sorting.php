<?php
global $sorting_js_page;

function initialize_sorting_js()
{
    global $sorting_js_page;
    echo '
    <script>
    $(document).ready( function () {
      $("#products-order-by").change(
        function(){
          var page = "'.base_url().$sorting_js_page.'";
          if($(this).val() == 0)
            return;
          window.location.href = page + $(this).val();
        }
      );
    });
    </script>
    ';
}
add_action("be_foot", "initialize_sorting_js");
class ecommerce_category_sorting_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Online Store";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Sort by";
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
             /*   color: '.$style_arr['color'].' !important; */
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

        global $sorting_js_page;
        // determine sorting origin page so to redirect properly
        $current_url = urldecode($_SERVER['REQUEST_URI']);
        $current_url = substr($current_url, 1);

        if(strpos($current_url,'order=') !== false)
        {
            $new_url = $current_url;
            for($i = 0; $i < 8; $i++)
            {
                $new_url = str_replace('order='.$i, 'order=', $new_url);
            }
            $sorting_js_page = $new_url;
        }
        else
            $sorting_js_page = $current_url.'?order=';
        // /determine sorting origin page so to redirect properly

        $output = '
        <div class="sorting">
            <select class="pointer fsize13 pull-right form-control form-control-be-40" id="products-order-by" style="float:left !important;">';
                $output .= '
                <option value="0"';
                if(isset($_GET['order']) && $_GET['order'] == 0)
                    $output .= 'selected';
                $output .= '>Sort By
                </option>';
                $output .= '
                <option value="1"';
                if(isset($_GET['order']) && $_GET['order'] == 0)
                    $output .= 'selected';
                $output .= '>Name (A-Z)
                </option>';
                $output .= '
                <option value="2"';
                if(isset($_GET['order']) && $_GET['order'] == 0)
                    $output .= 'selected';
                $output .= '>Name (Z-A)
                </option>';
                $output .= '
                <option value="3"';
                if(isset($_GET['order']) && $_GET['order'] == 0)
                    $output .= 'selected';
                $output .= '>Price (Low-High)
                </option>';
                $output .= '
                <option value="4"';
                if(isset($_GET['order']) && $_GET['order'] == 0)
                    $output .= 'selected';
                $output .= '>Price (High-Low)
                </option>';
                $output .= '
                <option value="5"';
                if(isset($_GET['order']) && $_GET['order'] == 0)
                    $output .= 'selected';
                $output .= '>Date Added(Last-First)
                </option>';
                $output .= '
                <option value="6"';
                if(isset($_GET['order']) && $_GET['order'] == 0)
                    $output .= 'selected';
                $output .= '>Date Added(First-Last)
                </option>';
                $output .= '
                <option value="7"';
                if(isset($_GET['order']) && $_GET['order'] == 0)
                    $output .= 'selected';
                $output .= '>Most Popular
                </option>';

        $output .= '
            </select>
        </div>
        ';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$this->load_module_css().$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), '', $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), 'style');
		else
			return $output.$this->load_module_css().$this->apply_custom_css();
    }
}
?>
