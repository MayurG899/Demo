<?php
class quote_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Content Blocks";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Quote";
        $info['block_icon'] = "fa-envelope-o public";

        return $info;
    }
    public function generate_admin()
    {
		$author = $this->block->data('author');
		$quotation = $this->block->data('quotation');
		$from = $this->block->data('from');

		$this->admin_input('author','text', 'Author: ', $author);
		$this->admin_input('quotation','text', 'Quotation: ', $quotation);
		$this->admin_input('from','text', 'From: ', $from);
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
            $content = array();
            $content[0] = new stdClass();
            $content[0]->quotation = 'Passion leads to design, design leads to performance, performance leads to success!';
            $content[0]->from = 'BuilderEngine Inc.';
            $content[0]->author = 'John Doe';

            $this->block->set_data('content', $content, true);
        }
    }
    public function generate_content()
    {
        global $active_controller;
        $CI = &get_instance();
        $CI->load->module('layout_system');

        $this->set_initial_values_if_empty();
        $content = $this->block->data('content');
		$text_color = $this->block->data('text_color');
		$color = 'style="color:'.$text_color.' !important;"';
        $single_element = '';

		$author = $this->block->data('author');
		$quotation = $this->block->data('quotation');
		$from = $this->block->data('from');
		$quote_content = $this->block->data('quote_content');
        //generic animations
        $this->load_generic_styles();
        //

        // Generate styles
        $quotation_color = $this->block->data('quotation_color');
        $quotation_size = $this->block->data('quotation_size');
        $author_color = $this->block->data('author_color');
        $author_size = $this->block->data('author_size');
        $from_color = $this->block->data('from_color');
        $from_size = $this->block->data('from_size');
        // Apply styles
        $output = '
			<style>
			.quotation-color-'.$this->block->get_id().'{
				color: '.$quotation_color.' !important;
			}
			.quotation-size-'.$this->block->get_id().'{
				font-size: '.$quotation_size.' !important;
			}
			.author-color-'.$this->block->get_id().'{
				color: '.$author_color.' !important;
			}
			.author-size-'.$this->block->get_id().'{
				font-size: '.$author_size.' !important;
			}
			.from-color-'.$this->block->get_id().'{
				color: '.$from_color.' !important;
			}
			.from-size-'.$this->block->get_id().'{
				font-size: '.$from_size.' !important;
			}
			</style>
			';
        $output .= '';
        foreach($content as $key => $element)
        {
            $element = (object)$element;
			if(!empty($author))
				$element->author = $author;
			if(!empty($quotation))
				$element->quotation = $quotation;
			if(!empty($from))
				$element->from = $from;
			$class='';
			if($this->block->data('background_active') == 'image' && !empty($this->block->data('background_image')) || $this->block->data('background_active') == 'color' && empty($this->block->data('background-color'))){
				$class='';
			}else{
				$class='has-bg';
			}
            $output .= '
			<div id="quote-container-'.$this->block->get_id().'" class="blockcontent-quote bg-black-darker block-column-wide-12 block-colors-dark '.$class.'">
				<div class="content-bg"></div>
				<div class="" data-animation="true" data-animation-type="fadeInLeft">
					<div class="row">
						<div>
							<i class="fa fa-quote-left"></i>
							<span '.$color.' field_name="content-'.$key.'-quotation" class="designer-editable quotation-color-'.$this->block->get_id().' quotation-size-'.$this->block->get_id().'" id="quote-quotation-'.$this->block->get_id().'">
							'.$element->quotation.'
							</span>
							<i class="fa fa-quote-right"></i>
							<small>
								<div '.$color.' field_name="content-'.$key.'-author" class="designer-editable author-color-'.$this->block->get_id().' author-size-'.$this->block->get_id().'" id="quote-author-'.$this->block->get_id().'">'.$element->author.'
								<span '.$color.' field_name="content-'.$key.'-from" class="designer-editable from-color-'.$this->block->get_id().' from-size-'.$this->block->get_id().'" id="quote-from-'.$this->block->get_id().'">, '.$element->from.'</span>
								</div>
							</small>
						</div>
					</div>
				</div>
			</div>';
        }
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'quote-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output;
    }

}
?>