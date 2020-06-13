<?php
/***********************************************************
* BuilderEngine Community Edition v1.0.0
* ---------------------------------
* BuilderEngine CMS Platform - BuilderEngine Limited
* Copyright BuilderEngine Limited 2012-2017. All Rights Reserved.
*
* http://www.builderengine.com
* Email: info@builderengine.com
* Time: 2017-01-17 | File version: 1.0.0
*
***********************************************************/

	class Block_handler {
		protected $block = array();
        protected $options = array();

		function info()
		{
			return array();
		}
        function save()
        {
            $this->block->set_data('admin_options', $this->options, true);
            $this->block->save();
        }
        function admin_option_toggle($option_name, $toggled)
        {
            $this->options[$option_name]['toggled'] = $toggled == 'true';
            $this->save();
            $function = "admin_option_toggle_".$option_name;
            $this->$function($toggled == true || $toggled == "true");

        }
        function admin_option_select($option_name, $option_choice)
        {
            $this->options[$option_name]['selected'] = $option_choice;
            $this->save();
            $function = "admin_option_select_".$option_name;
            $this->$function($option_choice);

        }
        function add_class_toggle_option($option_name, $display_text, $class_name, $default_toggled = false)
        {
            $option['type']         = 'class_toggle';
            $option['name']         = $option_name;
            $option['display_text'] = $display_text;
            $option['class_name']   = $class_name;
            $option['toggled']      = $default_toggled;
            $this->options[$option_name] = $option;
        }
        function add_select_option($option_name, $display_text, $options, $default_toggled = false)
        {
            $option['type']         = 'select';
            $option['name']         = $option_name;
            $option['display_text'] = $display_text;
            $option['options']   = $options;
            $option['selected']      = $default_toggled;
            $this->options[$option_name] = $option;
        }
        function register_admin_options()
        {

        }
        function output_admin_options()
        {
            $output = "";
            foreach($this->options as $option)
            {
                $function_name = "output_admin_option_".$option['type'];
                $output .= $this->$function_name($option);
            }
            return $output;
        }
        function output_admin_option_class_toggle($option)
        {
            $active_class = "";

            if($option['toggled'])
                $active_class = "active";

            $output = '<a class="btn btn-xs btn-white toggle-class '.$active_class.'" toggle-option="'.$option['name'].'" href="#" rel="navbar-inverse">'.$option['display_text'].'</a>';
            return $output;
        }
        function output_admin_option_select($option)
        {
        	$output = '<span class="btn-group btn-group-xs">
				<a style="font-size: 11px !important" class="btn btn-xs btn-white dropdown-toggle btn-white" data-toggle="dropdown" href="#">'.$option['display_text'].' <span class="caret"></span></a>
				<ul class="dropdown-menu block-select-options" data-option-name="'.$option['name'].'">';
							
			foreach($option['options'] as $opt_name => $opt)
			{
				$active = '';
				if($option['selected'] == $opt_name)
					$active = 'active';

				$output .= '<li class="'.$active.'"><a href="#" rel="" class="block-select-option" data-option-choice="'.$opt_name.'">'.$opt['display_name'].'</a></li>';
			}			
			$output .='			</ul>
			</span>';
        	return $output;
        }
		function admin_textarea($var, $title, $value = "")
		{
			if($this->block->data($var) != "")
				$value = $this->block->data($var);

	        echo'
			<link href="'.get_theme_path().'css/bootstrap.min.css" rel="stylesheet">
            <div class="form-group">
                <label>'.$title.'</label>
                <textarea name="'.$var.'" class="form-control" ng-model="'.$var.'">'.$value.'</textarea>
            </div>';
		}

		function admin_input($var, $type, $title, $value = "", $block_id = null)
		{

			if($this->block->data($var) != "")
				$value = $this->block->data($var);
			if($type == 'checkbox'){
				$id = 'id="checkbox-'.$block_id.'"';
				if($value != '')
					$checked = 'checked';
				else
					$checked = '';
			}else{
				if($block_id)
					$id = 'id="'.$var.$block_id.'"';
				else
					$id = '';

				$checked = '';
			}
			echo'
			<link href="'.get_theme_path().'css/bootstrap.min.css" rel="stylesheet">
            <div class="form-group">
                <label>'.$title.'</label>
                <input '.$id.' type="'.$type.'" name="'.$var.'" class="form-control" value="'.$value.'" ng-model="'.$var.'" placeholder="'.$title.'" '.$checked.'>
            </div>';

			/*echo"
			<div class=\"control-group\">
	            <label class=\"control-label\" for=\"required\" style='width: 80px'><b>$title</b></label>
	            <div class=\"controls controls-row\" style='margin-left: 85px'>
	                <input type=\"$type\" name=\"$var\" class=\"span11\" value='$value' ng-model='$var'>
	            </div>
	        </div><!-- End .control-group  -->
	        ";*/
		}

		function admin_input_readonly($var, $type, $title, $value = "", $block_id = null)
		{

			if($this->block->data($var) != "")
				$value = $this->block->data($var);
			if($type == 'checkbox'){
				$id = 'id="checkbox-'.$block_id.'"';
				if($value != '')
					$checked = 'checked';
				else
					$checked = '';
			}else{
				$id = '';
				$checked = '';
			}
			echo'
			<link href="'.get_theme_path().'css/bootstrap.min.css" rel="stylesheet">
            <div class="form-group">
                <label>'.$title.'</label>
                <input '.$id.' type="'.$type.'" name="'.$var.'" class="form-control" value="'.$value.'" ng-model="'.$var.'" placeholder="'.$title.'" '.$checked.' readonly />
            </div>';
		}

		function admin_file($var, $title, $value = "", $id = "",$button = false)
		{
			if($value == "")
				$value = $this->block->data($var);
			if($button){
				$button_style = '
					<style>		
						.file_preview {
							max-height: 100px;
							max-width:100px;
							margin-top: 2px;
							/*margin-left:-175px;*/
						}
						label.file_label{
							width:100%;
							height:40px;
						}
						#'.$id.'{
							display:none;
						}
					</style>';
				echo'
					<span class="btn btn-success fileinput-button" style="height:35px;width:190px;margin-left:-15px;margin-right:15px;">
						<link href="'.get_theme_path().'css/bootstrap.min.css" rel="stylesheet">
						'.$button_style.'
						<div class="form-group">
							<label for="'.$id.'" class="file_label">'.$title.'</label>
							<input type="file" id="'.$id.'" name="'.$var.'" class="form-control" rel="file_manager" file_value="'.$value.'" ng-model="'.$var.'">
						</div>
					</span>
				';					
			}else{
				$button_style = '';
				echo'
					<link href="'.get_theme_path().'css/bootstrap.min.css" rel="stylesheet">
					<div class="form-group">
						<label for="'.$id.'" class="file_label">'.$title.'</label>
						<input type="file" id="'.$id.'" name="'.$var.'" class="form-control" rel="file_manager" file_value="'.$value.'" ng-model="'.$var.'">
					</div>
				';
			}
		}

		function admin_select($var, $options, $title, $value = "", $block_id = null)
		{
			if($block_id)
				$id = 'id="'.$var.$block_id.'"';
			else
				$id = '';
			echo'
			<link href="'.get_theme_path().'css/bootstrap.min.css" rel="stylesheet">
			<div class="form-group">
				<label>'.$title.'</label>
				<select '.$id.' name='.$var.' class="form-control">';
				foreach($options as $val => $name)
                {
                	if($value == $val)
                		echo '<option selected value='.$val.'>'.$name.'</option>';
                	else
                		echo '<option value='.$val.'>'.$name.'</option>';
                }
	            echo'
				</select>
			</div>
			';

			/*echo"
			<div class=\"control-group\">
	            <label class=\"control-label\" for=\"required\" style='width: 80px'><b>$title</b></label>
	            <div class=\"controls controls-row\" style='margin-left: 85px'>
	                <select name=\"$var\" class=\"span12\" >
	                ";
	                foreach($options as $val => $name)
	                {
	                	if($value == $val)
	                		echo "<option selected value='$val'>$name</option>";
	                	else
	                		echo "<option value='$val'>$name</option>";
	                }
	                echo"
	                </select>
	            </div>
	        </div><!-- End .control-group  -->
	        ";*/
		}
        function load_options()
        {
            $this->register_admin_options();
            $options = $this->block->data('admin_options');
            if($options != null)
                $this->options = $options;

            if(empty($this->options))
            {
                $this->options = array();
                PC::admin_options("Initialize ".$this->block->name);
            }
        }
		function set_block($block)
		{
			$this->block = &$block;
            $this->load_options();
		}
        protected function createCaptcha($block_id)
        {
            $CI = & get_instance();
            $CI->load->library('session');
            $CI->load->helper(array('form', 'url','captcha'));

            $original_string = array_merge(range(0,9), range('a','z'), range('A', 'Z'));
            $original_string = implode("", $original_string);
            $captcha = substr(str_shuffle($original_string), 0, 6);

             // Field validation failed.  User redirected to login page
            $vals = array(
                'word' => $captcha,
                'img_path' => './files/captcha/',
                'img_url' => base_url('files/captcha').'/',
                'font_path' => BASEPATH.'fonts/texb.ttf',
                'img_width' => 150,
                'img_height' => 45,
                'expiration' => 7200
            );

            $cap = create_captcha($vals);

            if(isset($this->session->userdata['image']))
                if(file_exists(BASEPATH."../files/captcha/".$CI->session->userdata['image']))
                    unlink(BASEPATH."../files/captcha/".$CI->session->userdata['image']);

            $CI->session->set_userdata(array(
                'captcha'.$block_id => $cap['word'],
                'image' => $cap['time'].'.jpg'
            ));

            return $cap['image'];
        }

		function generate_styles($active_menu = '')
		{
			include FCPATH.'/builderengine/public/animations/animations.php';

			$background_active = $this->block->data('background_active');
			$background_color = $this->block->data('background_color');
			$background_image = $this->block->data('background_image');

			$text_align = $this->block->data('text_align');
			$text_color = $this->block->data('text_color');
			$custom_css = $this->block->data('custom_css');
			$custom_classes = $this->block->data('custom_classes');

			$active_options = array("color" => "Use color background", "image" => "Use image background");
			$text_options = array("left" => "Left", "center" => "Center", "right" => "Right");

			$animation_type = $this->block->data('animation_type');
			$animation_duration = $this->block->data('animation_duration');
			//$animation_event = $this->block->data('animation_event');
			//$animation_delay = $this->block->data('animation_delay');
			$style = '
			<div role="tabpanel">
				<ul class="bwizard-steps" role="tablist" style="margin-left: -20px;">
					<li role="presentation" class="';if($active_menu == 'style' || $active_menu == '') $style .= 'active';$style .='"><a class="bepopup-p-buttons" href="#title" aria-controls="text" role="tab" data-toggle="tab">Background Styles</a></li>
					<li role="presentation" class="';if($active_menu == 'custom' || $active_menu == '') $style .= 'active';$style .='"><a class="bepopup-p-buttons" href="#text" aria-controls="profession" role="tab" data-toggle="tab">Custom</a></li>
					<li role="presentation" class="';if($active_menu == 'animation' || $active_menu == '') $style .= 'active';$style .='"><a class="bepopup-p-buttons" href="#animations" aria-controls="animations" role="tab" data-toggle="tab">Animations</a></li>';
					echo $style;
					if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1){
						$style ='<li role="presentation" class="';if($active_menu == 'global_style' || $active_menu == '') $style .= 'active';$style .='"><a class="bepopup-p-buttons" href="#global" aria-controls="global" role="tab" data-toggle="tab">Global</a></li>';
						echo $style;
					}
				$style ='
				</ul>
				<div class="tab-content col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div role="tabpanel" class="tab-pane fade ';if($active_menu == 'style' || $active_menu == '') $style .= 'in active';$style .='" id="title">';
						echo $style;
						$this->admin_input('text_color','text', 'Font Color: ', $text_color);
						$this->admin_select('text_align', $text_options, 'Text align: ', $text_align);
						$this->admin_select('background_active', $active_options, 'Background option: ', $background_active);
						$this->admin_input('background_color','text', 'Background color: ', $background_color);
						$this->admin_file('background_image','Background image: ', $background_image, 'button'.$this->block->get_id(), true );
						
						$style ='
						<script>
							$("#membership-payment-'.$this->block->get_id().'").click(function(e){
								e.preventDefault();
							});
						</script>
					</div>
					<div role="tabpanel" class="tab-pane fade ';if($active_menu == 'custom') $style .= 'in active';$style .='" id="text">';
						echo $style;
						$this->admin_textarea('custom_css','Custom CSS: ', $custom_css, 4);
						$this->admin_textarea('custom_classes','Custom Classes: ', $custom_classes, 2);
					$style ='	
					</div>
					<div role="tabpanel" class="tab-pane fade ';if($active_menu == 'animation') $style .= 'in active';$style .='" id="animations">';
						echo $style;
						$this->admin_select('animation_type', $types,'Animation: ', $animation_type);
						$this->admin_select('animation_duration', $durations,'Animation state: ', $animation_duration);
						//$this->admin_select('animation_event', $events,'Animation Start: ',$animation_event);
						//$this->admin_select('animation_delay', $delays,'Animation Delay: ',$animation_delay);
					$style ='	
					</div>';
					echo $style;
					if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1){
						$style ='
						<div role="tabpanel" class="tab-pane fade ';if($active_menu == 'global_style') $style .= 'in active';$style .='" id="global">';
							echo $style;
							$global_options = array ('true' => 'Yes','false' => 'No');
							$global = $this->block->data('globaltype');
							if(empty($global))
								$global = 'false';
							$this->admin_select('globaltype', $global_options, 'Global (Replicate on all pages) :', $global);
						$style .='	
						</div>';
						echo $style;
					}
				$style ='
				</div>
			</div>';
			echo $style;
			//return $style;
		}

		function load_generic_styles()
		{
			$background_active = $this->block->data('background_active');
			$background_color = $this->block->data('background_color');
			$background_image = $this->block->data('background_image');

			$text_align = $this->block->data('text_align');
			$text_color = $this->block->data('text_color');
			$custom_css = $this->block->data('custom_css');

			$animation_type = $this->block->data('animation_type');
			$animation_duration = $this->block->data('animation_duration');
			//$animation_event = $this->block->data('animation_event');
			//$animation_delay = $this->block->data('animation_delay');

			if(!empty($animation_type)){
				$this->block->force_data_modification();
				$this->block->add_css_class('animated '.$animation_duration.' '.$animation_type);
			}
			//$settings[0][0] = 'new-container-'.$this->block->get_id();
			//$settings[0][1] = $animation_event;
			//$settings[0][2] = $animation_duration.' '.$animation_delay.' '.$animation_type;
			//add_action("be_foot", generate_animation_events($settings));
			
			$style_arr = $this->block->data("style");
			if($background_active == 'color')
				$style_arr['background-color'] = $background_color;
			else
				$style_arr['background-image'] = $background_image;
			$style_arr['text-align'] = $text_align;
			$style_arr['color'] = $text_color;
			$style_arr['text'] = ';'.$custom_css;
			$this->block->set_data("style", $style_arr);
		}

		function show_placeholder()
		{
			echo '<h2 class="text-center" style="color:#ffffff;"><i class="fa fa-info-circle"></i> This Block Contains No Settings</h2>';
		}
	}

?>