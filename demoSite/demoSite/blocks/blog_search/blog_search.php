<?php
    class Blog_search_block_handler extends  block_handler{
        function info()
        {
            $info['category_name'] = "Blog";
            $info['category_icon'] = "dsf";

            $info['block_name'] = "Blog Search";
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
		public function set_initial_values_if_empty()
		{
			$content = $this->block->data('content');

			if(!is_array($content) || empty($content))
			{
				$content = array();
				$content[0] = new stdClass();
				$content[0]->title = 'Search';

				$this->block->set_data('content', $content, true);
			}
		}
        public function generate_content()
        {
            global $active_controller;
            $CI = &get_instance();
            $CI->load->module('layout_system');

			$text_color = $this->block->data('text_color');
			$this->set_initial_values_if_empty();
			$content = $this->block->data('content');
			$single_element = '';
			$this->load_generic_styles();
			$color = 'style="color:'.$text_color.' !important;"';
			if(isset($_GET['keyword']))
			{
				redirect(base_url('/blog/search/'.$_GET['keyword']), 'location');
			}
			$output = '';
			foreach($content as $key => $element)
			{
				$element = (object)$element;
				$output .= '
					<div id="blogSearch-'.$this->block->get_id().'" class="blog-search-widget block-colors-light">
						<h4 '.$color.' field_name="content-'.$key.'-title" class="designer-editable" id="searchBlogTitle-'.$this->block->get_id().'">'.$element->title.'</h4>
						<form method="get" action="'.base_url('/blog/search').'" class="input-group">
							<input type="text" class="form-control form-control-be-40" name="keyword" placeholder="Search Blogs" />
							<span class="input-group-btn">
								<button class="btn btn-lg btn-colors"><i class="fa fa-search"></i></button>
							</span>
						</form>
					</div>';
			}
			if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
				$menu ='global_style';
			else
				$menu ='style';
			if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
				return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'blogSearch-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
			else
				return $output;
        }
    }
?>