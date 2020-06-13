<?php
class ecommerce_category_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Online Store";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Category";
        $info['block_icon'] = "fa-envelope-o";

        return $info;
    }
    public function admin_option_toggle_test_toggle($toggled)
    {
        $this->block->force_data_modification(true);
        PC::toggled($toggled);

        if($toggled){
            $this->block->remove_css_class('container-fluid');
            $this->block->add_css_class('container');
            $this->block->add_css_class('boxed-row');
        }
        else
        {
            $this->block->remove_css_class('container');
            $this->block->remove_css_class('boxed-row');
            $this->block->add_css_class('container-fluid');
        }
        $this->block->save();
    }
    public function admin_option_toggle_collapse_toggle($toggled)
    {
        $this->block->force_data_modification(true);

        if($toggled)
            $this->block->add_css_class('minimized-section');
        else
            $this->block->remove_css_class('minimized-section');

        $this->block->save();
    }
    public function register_admin_options()
    {
    }
    public function generate_admin()
    {
    }
    public function generate_style()
    {
    }
    public function generate_content()
    {
        global $active_controller;
        $CI = &get_instance();
        $CI->load->module('layout_system');
    }
}
?>