<?php
class content_timeline_block_handler extends  block_handler{
	function info()
	{
		$info['category_name'] = "Basic Blocks";
		$info['category_icon'] = "dsf";

		$info['block_name'] = "Timeline";
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
                <section class="">
                        <!-- begin timeline -->
			<ul class="timeline">
			    <li>
			        <!-- begin timeline-time -->
			        <div class="timeline-time">
			            <span class="date">1st January 2017</span>
			            <span class="time">12:20</span>
			        </div>
			        <!-- end timeline-time -->
			        <!-- begin timeline-icon -->
			        <div class="timeline-icon">
			            <a href="javascript:;" class="fa fa-star timeline-icon-fa"><i class=""></i></a>
			        </div>
			        <!-- end timeline-icon -->
			        <!-- begin timeline-body -->
			        <div class="timeline-body block-colors-light-bg">
			            <div class="timeline-header">
			                <span class="userimage"><img class="" src="'.base_url('blocks/content_team/images/profile1.jpg').'" alt=""></span>
			                <span class="username">Timeline Info 1</span>
			                <span class="pull-right">BuilderEngine</span>
			            </div>
			            <div class="timeline-content">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc faucibus turpis quis tincidunt luctus.
                                Nam sagittis dui in nunc consequat, in imperdiet nunc sagittis.
                            </p>
			            </div>
			            <div class="timeline-footer">
			                <a href="#" target="_blank" class="btn btn-colors btn-sm"> Website</a>
							<a href="#" target="_blank" class="btn btn-colors btn-sm"> View More</a>
			            </div>
			        </div>
			        <!-- end timeline-body -->
			    </li>
			    <li>
			        <!-- begin timeline-time -->
			        <div class="timeline-time">
			             <span class="date">20th December 2016</span>
			            <span class="time">10:30</span>
			        </div>
			        <!-- end timeline-time -->
			        <!-- begin timeline-icon -->
			        <div class="timeline-icon">
			            <a href="javascript:;" class="fa fa-star timeline-icon-fa"><i class=""></i></a>
			        </div>
			        <!-- end timeline-icon -->
			        <!-- begin timeline-body -->
			        <div class="timeline-body block-colors-light-bg">
			            <div class="timeline-header">
			                <span class="userimage"><img class="" src="'.base_url('blocks/content_team/images/profile2.jpg').'" alt=""></span>
			                <span class="username">Timeline Info 2</span>
			                <span class="pull-right">BuilderEngine</span>
			            </div>
			            <div class="timeline-content">
                            <h4 class="template-title">
			                    Title Text To Input Here
			                </h4>
			                <p>In hac habitasse platea dictumst. Pellentesque bibendum id sem nec faucibus. Maecenas molestie, augue vel accumsan rutrum, massa mi rutrum odio, id luctus mauris nibh ut leo.</p>
                            <p class="m-t-20">
                                <img class="" src="'.base_url('blocks/content_timeline/images/timeline1.jpg').'" alt="">
                            </p>
                        </div>
			            <div class="timeline-footer">
			                <a href="#" target="_blank" class="btn btn-colors btn-sm"> Website</a>
							<a href="#" target="_blank" class="btn btn-colors btn-sm"> View More</a>
			            </div>
			        </div>
			        <!-- end timeline-body -->
			    </li>
			    <li>
			        <!-- begin timeline-time -->
			        <div class="timeline-time">
			            <span class="date">15th October 2016</span>
			            <span class="time">16:00</span>
			        </div>
			        <!-- end timeline-time -->
			        <!-- begin timeline-icon -->
			        <div class="timeline-icon">
			           <a href="javascript:;" class="fa fa-star timeline-icon-fa"><i class=""></i></a>
			        </div>
			        <!-- end timeline-icon -->
			        <!-- begin timeline-body -->
			        <div class="timeline-body block-colors-light-bg">
			            <div class="timeline-header">
			                <span class="userimage"><img class="" src="'.base_url('blocks/content_team/images/profile3.jpg').'" alt=""></span>
			                <span class="username">Timeline Info 3</span>
			                <span class="pull-right">BuilderEngine</span>
			            </div>
			            <div class="timeline-content">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc faucibus turpis quis tincidunt luctus.
                                Nam sagittis dui in nunc consequat, in imperdiet nunc sagittis.
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc faucibus turpis quis tincidunt luctus.
                                Nam sagittis dui in nunc consequat, in imperdiet nunc sagittis.
                            </p>
			            </div>
			            <div class="timeline-footer">
			                <a href="#" target="_blank" class="btn btn-colors btn-sm"> Website</a>
							<a href="#" target="_blank" class="btn btn-colors btn-sm"> View More</a>
			            </div>
			        </div>
			        <!-- end timeline-body -->
			    </li>
			    <li>
			        <!-- begin timeline-time -->
			        <div class="timeline-time">
			            <span class="date">01st June 2016</span>
			            <span class="time">20:43</span>
			        </div>
			        <!-- end timeline-time -->
			        <!-- begin timeline-icon -->
			        <div class="timeline-icon">
			            <a href="javascript:;" class="fa fa-star timeline-icon-fa"><i class=""></i></a>
			        </div>
			        <!-- end timeline-icon -->
			        <!-- begin timeline-body -->
			        <div class="timeline-body block-colors-light-bg">
			            <div class="timeline-header">
			                <span class="userimage"><img class="" src="'.base_url('blocks/content_team/images/profile4.jpg').'" alt=""></span>
			                <span class="username">Timeline Info 4</span>
			                <span class="pull-right">BuilderEngine</span>
			            </div>
			            <div class="timeline-content">
                            <h4 class="template-title">
			                    Title Text To Input Here
			                </h4>
			                <p>In hac habitasse platea dictumst. Pellentesque bibendum id sem nec faucibus. Maecenas molestie, augue vel accumsan rutrum, massa mi rutrum odio, id luctus mauris nibh ut leo.</p>
                            <p class="m-t-20">
                                <img class="" src="'.base_url('blocks/content_timeline/images/timeline2.jpg').'" alt="">
                            </p>
                        </div>
			            <div class="timeline-footer">
			                <a href="#" target="_blank" class="btn btn-colors btn-sm"> Website</a>
							<a href="#" target="_blank" class="btn btn-colors btn-sm"> View More</a>
			            </div>
			        </div>
			        <!-- end timeline-body -->
			    </li>
			</ul>
			<!-- end timeline -->
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
			<div block-editor="ckeditor" block-name="'.$this->block->get_name().'" id="timeline-container-'.$this->block->get_id().'" class="">
				'.$this->block->data('content').'
			</div>
		';
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='global_style';
		else
			$menu ='style';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'timeline-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output;
    }
}
?>