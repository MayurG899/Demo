<?php

function initialize_category_list()
{
    echo "
            <script>
                $(document).ready(function() {
                    $('.has-subcategory').click(function(){
                        var subcategories = $(this).find('.subcategory');
                        if(subcategories.hasClass('open-subcategories'))
                            subcategories.removeClass('open-subcategories');
                        else
                            subcategories.addClass('open-subcategories');
                    });
                });
            </script>
            ";
}
add_action("be_foot", "initialize_category_list");

class ecommerce_category_list_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Online Store";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Category list";
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
            /*    background-color: '.$style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] ol{
                color: ' . $style_arr['color'].' !important;
                text-align: ' . $style_arr['text-align'].' !important;
             /*   background-color: ' . $style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] li{
                color: '.$style_arr['color'].' !important;
                text-align: ' . $style_arr['text-align'].' !important;
            /*    background-color: ' . $style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] a{
            /*    color: '.$style_arr['color'].' !important; */
        }
		.bckgrd{
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
        $this->load_generic_styles();
		$categories = new Ecommerce_category();
        if(isset($_GET['category']))
            $url = base_url().'?category=';
        else
            $url = base_url().'ecommerce/category/';
		
		$output = '
		<div class="be-onlinestore-category-list module-colors">
		  <div class="shop-filters">
			<!--Categories Section-->
			<section class="filter-section">
			  <h3>Store Categories</h3>
			  <ul class="categories">
				<li><a href="'.$url.'All"><i class="fa fa-home"></i> Store Homepage</a></li>';
				foreach ($categories->where('parent', 0)->get() as $category){
					if($category->has_children()){
						$output .='<li class="has-subcategory"><a>'.$category->name.'</a>
						  <ul class="subcategory">';
						$categories_first_level = new Ecommerce_category();
						foreach ($categories_first_level->where('parent', $category->id)->get() as $first_level_category){
							if($first_level_category->has_children()){
								$output .='<li class="has-subcategory"><a>'.$first_level_category->name.'</a>
								  <ul class="subcategory">';
									$categories_second_level = new Ecommerce_category();
									foreach ($categories_second_level->where('parent', $first_level_category->id)->get() as $second_level_category){
									   $output .='<li><a style="/*color:inherit !important;*/" href="'.$url.$second_level_category->name.'">&nbsp;<i class="fa fa-caret-right"></i>  '.$second_level_category->name.'</a></li>';
									}
									$output .='  </ul>
									</li>';
							}
							else{
								$output .='<li><a style="/*color:inherit !important;*/" href="'.$url.$first_level_category->name.'">&nbsp;<i class="fa fa-caret-right"></i>  '.$first_level_category->name.'</a></li>';
							}
						}
						$output .='  </ul>
						</li>';
					}
					else{
					   $output .=' <li><a style="/*color:inherit !important;*/" href="'.$url.$category->name.'">&nbsp;<i class="fa fa-caret-right"></i>&nbsp;  '.$category->name.'</a></li>';
					}
				}
					$output .= '  </ul>
					</section>
				  </div>
				</div>';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$this->load_module_css().$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), '', $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), 'style');
		else
			return $output.$this->load_module_css().$this->apply_custom_css();
    }
}
