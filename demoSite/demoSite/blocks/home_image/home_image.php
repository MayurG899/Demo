<?php
class home_image_block_handler extends  block_handler{
	function info()
	{
		$info['category_name'] = "Content Blocks";
		$info['category_icon'] = "dsf";

		$info['block_name'] = "Home_image";
		$info['block_icon'] = "fa-envelope-o public";

		return $info;
	}
	public function generate_admin()
	{
		$title = $this->block->data('title');
		$subtitle = $this->block->data('subtitle');
		$text = $this->block->data('text');
		$button_1_text = $this->block->data('button_1_text');
		$button_1_link = $this->block->data('button_1_link');
		$button_2_text = $this->block->data('button_2_text');
		$button_2_link = $this->block->data('button_2_link');
		$endtext = $this->block->data('endtext');

		$this->admin_input('title','text', 'Title: ', $title);
		$this->admin_input('subtitle','text', 'Subtitle: ', $subtitle);
		$this->admin_input('text','text', 'Text: ', $text);
		$this->admin_input('button_1_text','text', 'Button 1 text: ', $button_1_text);
		$this->admin_input('button_1_link','text', 'Button 1 link: ', $button_1_link);
		$this->admin_input('button_2_text','text', 'Button 2 text: ', $button_2_text);
		$this->admin_input('button_2_link','text', 'Button 2 link: ', $button_2_link);
		$this->admin_input('endtext','text', 'End text: ', $endtext);
	}
	public function generate_style()
	{
		$path = substr($_SERVER['SCRIPT_FILENAME'],0,strrpos($_SERVER['SCRIPT_FILENAME'],'/index.php'));
		include FCPATH.'/builderengine/public/animations/animations.php';

		$title_font_color = $this->block->data('title_font_color');
		$title_font_weight = $this->block->data('title_font_weight');

		$subtitle_font_color = $this->block->data('subtitle_font_color');
		$subtitle_font_weight = $this->block->data('subtitle_font_weight');

		$text_font_color = $this->block->data('text_font_color');
		$text_font_weight = $this->block->data('text_font_weight');

		$endtext_font_color = $this->block->data('endtext_font_color');
		$endtext_font_weight = $this->block->data('endtext_font_weight');

		$background_color = $this->block->data('background_color');
		$background_image = $this->block->data('background_image');
		$background_option = $this->block->data('background_option');

		$title_animation_type = $this->block->data('title_animation_type');
		$title_animation_duration = $this->block->data('title_animation_duration');
		$title_animation_event = $this->block->data('title_animation_event');
		$title_animation_delay = $this->block->data('title_animation_delay');

		$subtitle_animation_type = $this->block->data('subtitle_animation_type');
		$subtitle_animation_duration = $this->block->data('subtitle_animation_duration');
		$subtitle_animation_event = $this->block->data('subtitle_animation_event');
		$subtitle_animation_delay = $this->block->data('subtitle_animation_delay');

		$text_animation_type = $this->block->data('text_animation_type');
		$text_animation_duration = $this->block->data('text_animation_duration');
		$text_animation_event = $this->block->data('text_animation_event');
		$text_animation_delay = $this->block->data('text_animation_delay');

		$endtext_animation_type = $this->block->data('endtext_animation_type');
		$endtext_animation_duration = $this->block->data('endtext_animation_duration');
		$endtext_animation_event = $this->block->data('endtext_animation_event');
		$endtext_animation_delay = $this->block->data('endtext_animation_delay');
		?>
		<div role="tabpanel">

			<ul class="bwizard-steps" role="tablist" style="margin-left: -20px;">
				<li role="presentation" class="active"><a class="bepopup-p-buttons" href="#title" aria-controls="title" role="tab" data-toggle="tab">Title</a></li>
				<li role="presentation"><a class="bepopup-p-buttons" href="#subtitle" aria-controls="subtitle" role="tab" data-toggle="tab">Subtitle</a></li>
				<li role="presentation"><a class="bepopup-p-buttons" href="#text" aria-controls="text" role="tab" data-toggle="tab">Text</a></li>
				<li role="presentation"><a class="bepopup-p-buttons" href="#end_text" aria-controls="end_text" role="tab" data-toggle="tab">End text</a></li>
				<li role="presentation"><a class="bepopup-p-buttons" href="#background" aria-controls="background" role="tab" data-toggle="tab">Background</a></li>
				<li role="presentation"><a class="bepopup-p-buttons" href="#customcss" aria-controls="customcss" role="tab" data-toggle="tab">Custom</a></li>
			</ul>

			<div class="tab-content col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div role="tabpanel" class="tab-pane fade in active" id="title">
					<?php
					$this->admin_input('title_font_color','text', 'Font color: ', $title_font_color);
					$this->admin_input('title_font_weight','text', 'Font weight: ', $title_font_weight);
					$this->admin_select('title_animation_type', $types,'Animation type: ',$title_animation_type);
					$this->admin_select('title_animation_duration', $durations,'Animation duration: ',$title_animation_duration);
					$this->admin_select('title_animation_event', $events,'Animation Start: ',$title_animation_event);
					$this->admin_select('title_animation_delay', $delays,'Animation Delay: ',$title_animation_delay);
					?>
				</div>
				<div role="tabpanel" class="tab-pane fade" id="subtitle">
					<?php
					$this->admin_input('subtitle_font_color','text', 'Font color: ', $subtitle_font_color);
					$this->admin_input('subtitle_font_weight','text', 'Font weight: ', $subtitle_font_weight);
					$this->admin_select('subtitle_animation_type', $types,'Animation type: ',$subtitle_animation_type);
					$this->admin_select('subtitle_animation_duration', $durations,'Animation duration: ',$subtitle_animation_duration);
					$this->admin_select('subtitle_animation_event', $events,'Animation Start: ',$subtitle_animation_event);
					$this->admin_select('subtitle_animation_delay', $delays,'Animation Delay: ',$subtitle_animation_delay);
					?>
				</div>
				<div role="tabpanel" class="tab-pane fade" id="text">
					<?php
					$this->admin_input('text_font_color','text', 'Font color: ', $text_font_color);
					$this->admin_input('text_font_weight','text', 'Font weight: ', $text_font_weight);
					$this->admin_select('text_animation_type', $types,'Animation type: ',$text_animation_type);
					$this->admin_select('text_animation_duration', $durations,'Animation duration: ',$text_animation_duration);
					$this->admin_select('text_animation_event', $events,'Animation Start: ',$text_animation_event);
					$this->admin_select('text_animation_delay', $delays,'Animation Delay: ',$text_animation_delay);
					?>
				</div>
				<div role="tabpanel" class="tab-pane fade" id="end_text">
					<?php
					$this->admin_input('endtext_font_color','text', 'Font color: ', $endtext_font_color);
					$this->admin_input('endtext_font_weight','text', 'Font weight: ', $endtext_font_weight);
					$this->admin_select('endtext_animation_type', $types,'Animation type: ',$endtext_animation_type);
					$this->admin_select('endtext_animation_duration', $durations,'Animation duration: ',$endtext_animation_duration);
					$this->admin_select('endtext_animation_event', $events,'Animation Start: ',$endtext_animation_event);
					$this->admin_select('endtext_animation_delay', $delays,'Animation Delay: ',$endtext_animation_delay);
					?>
				</div>
				<div role="tabpanel" class="tab-pane fade" id="background">
					<?php
					$this->admin_select('background_option', array("image" => "Use image background","color" => "Use Color Background"),'Background Option',$background_option);
					$this->admin_input('background_color','text', 'Background color: ', $background_color);
					$this->admin_file('background_image','Add Background image ', $background_image , 'homeimage'.$this->block->get_id(), true );
					?>
					<script>
						$("#homeimage<?=$this->block->get_id()?>").click(function(e){
							e.preventDefault();
						});
					</script>
				</div>
				<div role="tabpanel" class="tab-pane fade" id="customcss">
					<?php
					$custom_css = $this->block->data('custom_css');
					$custom_classes = $this->block->data('custom_classes');
					$this->admin_textarea('custom_css','Custom CSS: ', $custom_css, 4);
					$this->admin_textarea('custom_classes','Custom Classes: ', $custom_classes, 2);
					$global_options = array ('true' => 'Yes','false' => 'No');
					$global = $this->block->data('globaltype');
					if(empty($global))
						$global = 'false';
					$this->admin_select('globaltype', $global_options, 'Replicate Accross All Webpages:', $global);
					?>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			</div>
		</div>
		<?php
	}
	public function get_images()
	{
		$default_images = array(base_url().'/blocks/home_image/images/be_bg.jpg');

		$theme_path = str_replace('http://'.$_SERVER['HTTP_HOST'].'/', '', get_theme_path());
		$block = new Block($this->block->get_name());
		$block->load();
		$theme_images_path = $theme_path.'blocks/'.$block->type();

		if (file_exists($theme_images_path))
		{
			$files = scandir($theme_images_path);
			array_shift($files);
			array_shift($files);

			foreach($files as $key => $file)
			{
				$files[$key] = $theme_images_path.'/'.$file;
			}
			return $files;
		}
		else
			return $default_images;
	}
	public function generate_content()
	{
		global $active_controller;
		$CI = &get_instance();
		$CI->load->module('layout_system');

		$custom_css = $this->block->data('custom_css');
		$style_arr['text'] = ';'.$custom_css;
		$this->block->set_data("style", $style_arr);

		$title = $this->block->data('title');
		$subtitle = $this->block->data('subtitle');
		$text = $this->block->data('text');
		$button_1_text = $this->block->data('button_1_text');
		$button_1_link = $this->block->data('button_1_link');
		$button_2_text = $this->block->data('button_2_text');
		$button_2_link = $this->block->data('button_2_link');
		$endtext = $this->block->data('endtext');

		// Style options
		$title_font_color = $this->block->data('title_font_color');
		$title_font_weight = $this->block->data('title_font_weight');

		$subtitle_font_color = $this->block->data('subtitle_font_color');
		$subtitle_font_weight = $this->block->data('subtitle_font_weight');

		$text_font_color = $this->block->data('text_font_color');
		$text_font_weight = $this->block->data('text_font_weight');

		$endtext_font_color = $this->block->data('endtext_font_color');
		$endtext_font_weight = $this->block->data('endtext_font_weight');

		$background_color = $this->block->data('background_color');
		$background_image = $this->block->data('background_image');
		$background_option = $this->block->data('background_option');

		$title_animation_type = $this->block->data('title_animation_type');
		$title_animation_duration = $this->block->data('title_animation_duration');
		$title_animation_event = $this->block->data('title_animation_event');
		$title_animation_delay = $this->block->data('title_animation_delay');

		$subtitle_animation_type = $this->block->data('subtitle_animation_type');
		$subtitle_animation_duration = $this->block->data('subtitle_animation_duration');
		$subtitle_animation_event = $this->block->data('subtitle_animation_event');
		$subtitle_animation_delay = $this->block->data('subtitle_animation_delay');

		$text_animation_type = $this->block->data('text_animation_type');
		$text_animation_duration = $this->block->data('text_animation_duration');
		$text_animation_event = $this->block->data('text_animation_event');
		$text_animation_delay = $this->block->data('text_animation_delay');

		$endtext_animation_type = $this->block->data('endtext_animation_type');
		$endtext_animation_duration = $this->block->data('endtext_animation_duration');
		$endtext_animation_event = $this->block->data('endtext_animation_event');
		$endtext_animation_delay = $this->block->data('endtext_animation_delay');

		$settings[0][0] = 'text'.$this->block->get_id();
		$settings[0][1] = $text_animation_event;
		$settings[0][2] = $text_animation_duration.' '.$text_animation_delay.' '.$text_animation_type;
		$settings[1][0] = 'title'.$this->block->get_id();
		$settings[1][1] = $title_animation_event;
		$settings[1][2] = $title_animation_duration.' '.$title_animation_delay.' '.$title_animation_type;
		$settings[2][0] = 'subtitle'.$this->block->get_id();
		$settings[2][1] = $subtitle_animation_event;
		$settings[2][2] = $subtitle_animation_duration.' '.$subtitle_animation_delay.' '.$subtitle_animation_type;
		$settings[3][0] = 'endtext'.$this->block->get_id();
		$settings[3][1] = $endtext_animation_event;
		$settings[3][2] = $endtext_animation_duration.' '.$endtext_animation_delay.' '.$endtext_animation_type;

		add_action("be_foot", generate_animation_events($settings));

		if($title_font_color == '')
			$title_font_color = '#fff';
		if($title_font_weight == '')
			$title_font_weight = '600';

		if($subtitle_font_color == '')
			$subtitle_font_color = '#fff';
		if($subtitle_font_weight == '')
			$subtitle_font_weight = '300';

		if($text_font_color == '')
			$text_font_color = '#DEDEDE';
		if($text_font_weight == '')
			$text_font_weight = 'normal';

		if($endtext_font_color == '')
			$endtext_font_color = '#DEDEDE';
		if($endtext_font_weight == '')
			$endtext_font_weight = 'normal';

		if($background_image == '')
		{
			$background_images = $this->get_images();
			$background_image = $background_images[0];
		}


		if($background_option == '')
			$background_option = 'image';

		if($title == '')
			$title = 'Building Better Connections';
		if($subtitle == '')
			$subtitle = 'You Can Make It Happen';
		if($text == '')
			$text = 'No matter how many goals you have achieved, you must set your sights on a higher one.';
		if($button_1_text == '')
			$button_1_text = 'Account Login';
		if($button_1_link == '')
			$button_1_link = '/cp/login';
		if($button_2_text == '')
			$button_2_text = 'Sign-Up Today';
		if($button_2_link == '')
			$button_2_link = base_url('/cp/register');
		if($endtext == '')
			$endtext = 'Become A Member Today';

		$title_style =
				'style="
                    
                "';
		$subtitle_style =
				'style="
                    
                "';
		$text_style =
				'style="
                    
                "';
		$endtext_style =
				'style="
                    
                "';
		$background_style =
				'style="
					background:'.$background_color.' !important;
					content:none;"
				';
		if($background_option == 'image')
			$background_style = '';
		$output = '
			<div id="home" class="blockcontent-homeimage has-bg home custom-content block-big-image block-column-wide-12 block-colors-dark" '.$background_style.'>';
		if($background_option == 'image'){
			$output .='
						<div class="content-bg">
							<img style="width:100%" src="'.$background_image.'" alt="Home" />
						</div>
					';
		}else{
			$output .='
						<div class="" '.$background_style.'>

						</div>';
		}
		$output .='<div class="container home-content" id="home-image-'.$this->block->get_id().'">
	                <h1 id="title'.$this->block->get_id().'" '.$title_style.'>'.$title.'</h1>
	                <h3 id="subtitle'.$this->block->get_id().'" '.$subtitle_style.'>'.$subtitle.'</h3>
	                <p id="text'.$this->block->get_id().'" '.$text_style.'>
	                    '.$text.'
	                </p>
	                <a href="'.$button_1_link.'" class="btn btn-lg btn-colors home_image_text">'.$button_1_text.'</a>
	                <a href="'.$button_2_link.'" class="btn btn-lg btn-default home_image_text">'.$button_2_text.'</a><br />
	                <br />
	                <div id="endtext'.$this->block->get_id().'" '.$endtext_style.'>
	                '.$endtext.'
	                </div>
	            </div>
	        </div>';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'home-image-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), 'with_settings');
		else
			return $output;
	}
}
?>