<?php
class ecommerce_account_login_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Online Store";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Account Login";
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
		$user = &$active_controller->user;
        $CI = &get_instance();
        $CI->load->module('layout_system');
        $CI->load->module('ecommerce');
        $this->load_generic_styles();
		
		$output = '

			<!--Price Section-->';
			if($user->is_guest()){
			  $output .='
			<div class="be-onlinestore-logins">
				<div class="shop-filters">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<div class="price-btns be-onlinestore-logins-buttons">
					   <a style="" href="'.base_url().'ecommerce/login" class="btn btn-inverse btn-sm"><i class="fa fa-user"></i> Login</a>   
					</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<div class="price-btns">
					   <a style="" href="'.base_url().'ecommerce/register" class="btn btn-inverse btn-sm"><i class="fa fa-users"></i> Register</a>
					</div>
				</div>
				</div>
			</div>';
			}
			else{
			  $output .='
			<div class="be-onlinestore-logins">
				<div class="shop-filters"> 
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="price-btns be-onlinestore-logins-buttons">
					   <a style="" href="'.base_url().'ecommerce/logout" class="btn btn-inverse btn-sm"><i class="fa fa-user"></i> Logout</a>   
					</div>
					</div>
				</div>
			</div>
			';
			}
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$this->load_module_css().$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), '', $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), 'style');
		else
			return $output.$this->load_module_css().$this->apply_custom_css();
    }
}
