<?php
class action_bar_block_handler extends  block_handler{
		function info()
		{
			$info['category_name'] = "Content Blocks";
			$info['category_icon'] = "dsf";

			$info['block_name'] = "Action Bar";
			$info['block_icon'] = "fa-envelope-o public";
			
			return $info;
		}
		public function generate_admin()
		{
			$title = $this->block->data('title');
            $text = $this->block->data('text');
            $button_text = $this->block->data('button_text');
            $button_link = $this->block->data('button_link');
            $icon = $this->block->data('icon');
            $actionbar_content = $this->block->data('actionbar_content');

			$this->admin_select('actionbar_content',array("default" => "Default Content","custom" => "Custom Content"),'Action bar Content',$actionbar_content);			
            $this->admin_input('title','text', 'Title: ', $title);
            $this->admin_input('text','text', 'Text: ', $text);
            $this->admin_input('button_text','text', 'Button text: ', $button_text);
            $this->admin_input('button_link','text', 'Button link: ', $button_link);
            $this->admin_input('icon', 'text', 'Font-Awesome code:<a href="https://fortawesome.github.io/Font-Awesome/icons" target="_blank"> View </a>' , $icon);
		}
		public function generate_style($active_menu = '')
		{
			
        }
		public function generate_content()
		{
			global $active_controller;
			$CI = &get_instance();
			$CI->load->module('layout_system');
			$this->load_generic_styles();

			$custom_css = $this->block->data('custom_css');
			$style_arr['text'] = ';'.$custom_css;
			$this->block->set_data("style", $style_arr);

			$title = $this->block->data('title');
            $text = $this->block->data('text');
            $button_text = $this->block->data('button_text');
            $button_link = $this->block->data('button_link');
            $icon = $this->block->data('icon');
			$actionbar_content = $this->block->data('actionbar_content');

            $icon_font_color = $this->block->data('icon_font_color');
            $icon_font_size = $this->block->data('icon_font_size');
			$icon_font_weight = $this->block->data('icon_font_weight');
			$icon_animation = $this->block->data('icon_animation');
			$icon_animation_state = $this->block->data('icon_animation_state');
			$icon_animation_type = $this->block->data('icon_animation_type');	  
			$icon_animation_duration = $this->block->data('icon_animation_duration');
			$icon_animation_event = $this->block->data('icon_animation_event');
			$icon_animation_delay = $this->block->data('icon_animation_delay');
			
            $title_font_color = $this->block->data('title_font_color');
            $title_font_weight = $this->block->data('title_font_weight');
            $title_font_size = $this->block->data('title_font_size');
			$title_animation = $this->block->data('title_animation');
			$title_animation_state = $this->block->data('title_animation_state');
			$title_animation_type = $this->block->data('title_animation_type');	  
		    $title_animation_duration = $this->block->data('title_animation_duration');
		    $title_animation_event = $this->block->data('title_animation_event');
		    $title_animation_delay = $this->block->data('title_animation_delay');
			
            $subtitle_font_color = $this->block->data('subtitle_font_color');
            $subtitle_font_weight = $this->block->data('subtitle_font_weight');
            $subtitle_font_size = $this->block->data('subtitle_font_size');
			$subtitle_animation = $this->block->data('subtitle_animation');
			$subtitle_animation_state = $this->block->data('subtitle_animation_state');
			$subtitle_animation_type = $this->block->data('subtitle_animation_type');	  
			$subtitle_animation_duration = $this->block->data('subtitle_animation_duration');
			$subtitle_animation_event = $this->block->data('subtitle_animation_event');
			$subtitle_animation_delay = $this->block->data('subtitle_animation_delay');
			
			$button_animation_type = $this->block->data('button_animation_type');	  
			$button_animation_duration = $this->block->data('button_animation_duration');
			$button_animation_event = $this->block->data('button_animation_event');
			$button_animation_delay = $this->block->data('button_animation_delay');	
			
			$background_color = $this->block->data('background_color');
            $background_image = $this->block->data('background_image');
			$background_option = $this->block->data('background_option');

			$settings[0][0] = 'icon'.$this->block->get_id();
			$settings[0][1] = $icon_animation_event;
			$settings[0][2] = $icon_animation_duration.' '.$icon_animation_delay.' '.$icon_animation_type;
			$settings[1][0] = 'title'.$this->block->get_id();
			$settings[1][1] = $title_animation_event;
			$settings[1][2] = $title_animation_duration.' '.$title_animation_delay.' '.$title_animation_type;
			$settings[2][0] = 'subtitle'.$this->block->get_id();
			$settings[2][1] = $subtitle_animation_event;
			$settings[2][2] = $subtitle_animation_duration.' '.$subtitle_animation_delay.' '.$subtitle_animation_type;
			$settings[3][0] = 'button'.$this->block->get_id();
			$settings[3][1] = $button_animation_event;
			$settings[3][2] = $button_animation_duration.' '.$button_animation_delay.' '.$button_animation_type;

			add_action("be_foot", generate_animation_events($settings));
				
            if($background_option == 'color'){
				if($actionbar_content != 'custom'){
					$background_style = 
					'background:#000; !important;
					';
				}else{
					$background_style = 
					'background:'.$background_color.'; !important;
					';				
				}
			}
			else{
				if($actionbar_content != 'custom'){
					$background_image = base_url().'';
					$background_style = '';
				}else{
					$background_style = 
					'background: url('.$background_image.') no-repeat; !important;
					 background-size:cover !important;
					';				
				}
			}
            if($actionbar_content != 'custom'){
            	$title = 'DOWNLOAD THE WEB ENGINE';
            	$text = 'BuilderEngine Community Edition is Open Source platform and Website Builder.';
            	$button_text = 'Download Here';
            	$button_link = 'https://builderengine.com/page-cms-platform.html';
            	$icon = 'fa-star';
			}
            $icon_style = 
                'style="
                    color: '.$icon_font_color.' !important;
                    font-size: '.$icon_font_size.' !important;
                "';
            $title_style = 
                'style="
                    color: '.$title_font_color.' !important;
                    font-weight: '.$title_font_weight.' !important;
                    font-size: '.$title_font_size.' !important;
                "';
            $subtitle_style = 
                'style="
                    color: '.$subtitle_font_color.' !important;
                    font-weight: '.$subtitle_font_weight.' !important;
                    font-size: '.$subtitle_font_size.' !important;
                "';

			$output = '
			<div id="action-bar-container-'.$this->block->get_id().'" class="block-column-wide-12 block-colors-dark">
			<div id="action-box" class="blockcontent-action has-bg custom-content" style="'.$background_style.'">
	            <div class="content-bg" id="action-container-'.$this->block->get_id().'">
	                
	            </div>
	            <div class="row action-box" id="action_box" data-animation="true" data-animation-type="fadeInRight">
	                <div class="container">
	                    <!-- Column & Block -->
	                    <div class="col-md-9 col-sm-9">
	                        <div class="icon-large" id="icon'.$this->block->get_id().'">
	                            <i '.$icon_style.' class="fa '.$icon.'"></i>
	                        </div> 
	                        <h3 id="title'.$this->block->get_id().'" '.$title_style.'>'.$title.'</h3>
	                        <p id="subtitle'.$this->block->get_id().'" '.$subtitle_style.'>
	                           '.$text.'
	                        </p>
	                    </div>
	                    <div class="col-md-3 col-sm-3">
	                        <a id="button'.$this->block->get_id().'" href="'.$button_link.'" class="btn btn-outline-colors btn-xl btn-block">'.$button_text.'</a>
	                    </div>
	                </div>
	            </div>
	        </div>
			</div>
            ';
			$this->block->add_css_class('');
			if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
				$menu ='with_settings_global';
			else
				$menu ='with_settings';
			if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
				return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'action-bar-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), $menu);
			else
				return $output;
		}
	}
?>