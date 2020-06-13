<?php
class content_comparison_chart_block_handler extends  block_handler{
	function info()
	{
		$info['category_name'] = "Basic Blocks";
		$info['category_icon'] = "dsf";

		$info['block_name'] = "Comparison Chart";
		$info['block_icon'] = "fa-envelope-o public";
		
		return $info;
	}
    public function generate_admin()
    {
		$this->show_placeholder();
    }
    public function generate_style($active_menu = '')
    {
       
    }
    public function load_generic_styling()
    {
        
    }
    public function set_initial_values_if_empty()
    {
        $content = $this->block->data('content');

        if(!is_array($content) || empty($content))
        {
			$content ='
                    <div class="block-colors-light">
                <section class="comparison">
					<div class="table-responsive">
<table class="table table-bordered block-colors-light-bg">
<tbody>
</tbody><thead>
<tr>
<th style="border: 0px;">&nbsp;<h4>Comparison Chart</h4></th>
<th class="compare_header"><h5>BuilderEngine Website Builder</h5></th>
<th class="compare_header"><h5>BuilderEngine CMS Platform</h5></th>
<th class="compare_header"><h5>#1 Cloud Website Builder</h5></th>
<th class="compare_header"><h5>Other Cloud Website Builders</h5></th>
<th class="compare_header"><h5>Top #3 Open Source CMSs</h5></th>
</tr>
</thead>
<tbody><tr class="">
<td class="compare_subheader" colspan="6"><h4>System Features</h4></td>
</tr>
<tr>
<td><h5>Advanced Builders / Editors</h5></td>
<td><span class="comparison-icon comparison-icon-yes fa fa-check"><i class=""></i></span></td>
<td><span class="comparison-icon comparison-icon-yes fa fa-check"><i class=""></i></span></td>
<td><span class="comparison-icon comparison-icon-no fa fa-close"><i class=""></i></span></td>
<td><span class="comparison-icon comparison-icon-no fa fa-close"><i class=""></i></span></td>
<td><span class="comparison-icon comparison-icon-no fa fa-close"><i class=""></i></span></td>
</tr>
<tr>
<td><h5>Simple Builders / Editors</h5></td>
<td><span class="comparison-icon comparison-icon-yes fa fa-check"><i class=""></i></span></td>
<td><span class="comparison-icon comparison-icon-yes fa fa-check"><i class=""></i></span></td>
<td><span class="comparison-icon comparison-icon-yes fa fa-check"><i class=""></i></span></td>
<td><span class="comparison-icon comparison-icon-yes fa fa-check"><i class=""></i></span></td>
<td><span class="comparison-icon comparison-icon-no fa fa-close"><i class=""></i></span></td>
</tr>
<tr>
<td><h5>WYSIWYG Page Building</h5></td>
<td><span class="comparison-icon comparison-icon-yes fa fa-check"><i class=""></i></span></td>
<td><span class="comparison-icon comparison-icon-yes fa fa-check"><i class=""></i></span></td>
<td><span class="comparison-icon comparison-icon-yes fa fa-check"><i class=""></i></span></td>
<td><span class="comparison-icon comparison-icon-yes fa fa-check"><i class=""></i></span></td>
<td><span class="comparison-icon comparison-icon-no fa fa-close"><i class=""></i></span></td>
</tr>
<tr>
<td><h5>Full Bootstrap Support</h5></td>
<td><span class="comparison-icon comparison-icon-yes fa fa-check"><i class=""></i></span></td>
<td><span class="comparison-icon comparison-icon-yes fa fa-check"><i class=""></i></span></td>
<td><span class="comparison-icon comparison-icon-no fa fa-close"><i class=""></i></span></td>
<td><span class="comparison-icon comparison-icon-no fa fa-close"><i class=""></i></span></td>
<td><span class="comparison-icon comparison-icon-no fa fa-close"><i class=""></i></span></td>
</tr>
<tr>
<td><h5>Multiple Responsive States</h5></td>
<td><span class="comparison-icon comparison-icon-yes fa fa-check"><i class=""></i></span></td>
<td><span class="comparison-icon comparison-icon-yes fa fa-check"><i class=""></i></span></td>
<td><span class="comparison-icon comparison-icon-no fa fa-close"><i class=""></i></span></td>
<td><span class="comparison-icon comparison-icon-no fa fa-close"><i class=""></i></span></td>
<td><span class="comparison-icon comparison-icon-yes fa fa-check"><i class=""></i></span></td>
</tr>
<tr>
<td><h5>Multiple Free Themes</h5></td>
<td><span class="comparison-icon comparison-icon-yes fa fa-check"><i class=""></i></span></td>
<td><span class="comparison-icon comparison-icon-yes fa fa-check"><i class=""></i></span></td>
<td><span class="comparison-icon comparison-icon-yes fa fa-check"><i class=""></i></span></td>
<td><span class="comparison-icon comparison-icon-yes fa fa-check"><i class=""></i></span></td>
<td><span class="comparison-icon comparison-icon-yes fa fa-check"><i class=""></i></span></td>
</tr>
<tr>
<td><h5>Cloud Hosting</h5></td>
<td><span class="comparison-icon comparison-icon-yes fa fa-check"><i class=""></i></span></td>
<td><span class="comparison-icon comparison-icon-yes fa fa-check"><i class=""></i></span></td>
<td><span class="comparison-icon comparison-icon-yes fa fa-check"><i class=""></i></span></td>
<td><span class="comparison-icon comparison-icon-yes fa fa-check"><i class=""></i></span></td>
<td><span class="comparison-icon comparison-icon-no fa fa-close"><i class=""></i></span></td>
</tr>

</tbody>
</table>

</div>
					</section>
				</div>
					';
            $this->block->set_data('content', $content, true);
        }
    }
    public function save_content($content)
    {
		$this->block->set_data('content', $content, true);
    }
    public function generate_content()
    {	$this->block->set_data("editorEnabled", 1);
        global $active_controller;
        $CI = &get_instance();
        $CI->load->module('layout_system');

		if($this->block->is_new())
			$this->set_initial_values_if_empty();

        $content = $this->block->data('content');

        $single_element = '';

        //generic animations
        $this->load_generic_styles();

		$output = '
			<div block-editor="ckeditor" block-name="'.$this->block->get_name().'" id="comparison_chart-container-'.$this->block->get_id().'" class="">
				'.$this->block->data('content').'
			</div>
		';
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='global_style';
		else
			$menu ='style';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'comparison_chart-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output;
    }
}
?>