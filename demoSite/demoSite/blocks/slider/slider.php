<?php
global $flexslider_js_settings;

        function initialize_flexslider_js()
        {
            global $flexslider_js_settings;
			if(empty($flexslider_js_settings[0]))
				$flexslider_js_settings[0] = 'horizontal';
			if(empty($flexslider_js_settings[1]))
				$flexslider_js_settings[1] = 'false';
			if(empty($flexslider_js_settings[2]))
				$flexslider_js_settings[2] = 'true';
			if(empty($flexslider_js_settings[3]))
				$flexslider_js_settings[3] = 'true';
			if(empty($flexslider_js_settings[4]))
				$flexslider_js_settings[4] = '5000';
            echo "
            <script type='text/javascript' src='".base_url()."blocks/slider/js/jquery.flexslider-min.js'></script>

            <script>
                $(document).ready(function() {
                    $('.flexslider').each(function(){
                        var sliderId = $(this).attr('id');
                        $('#' + sliderId).flexslider({
                            animation: 'slide',
                            direction: '".$flexslider_js_settings[0]."',
                            controlNav: ".$flexslider_js_settings[1].",
                            directionNav: ".$flexslider_js_settings[2].",
                            pauseOnHover: ".$flexslider_js_settings[3].",
                            slideshowSpeed: ".$flexslider_js_settings[4].",
                       });
                   });
                });
            </script>
            ";
        }
        add_action("be_foot", "initialize_flexslider_js");

        class slider_block_handler extends  block_handler{
        function info()
        {
            $info['category_name'] = "Media";
            $info['category_icon'] = "dsf";

            $info['block_name'] = "Slider";
            $info['block_icon'] = "fa-envelope-o public";
            
            return $info;
        }
        public function generate_admin()
        {
            $slide_titles = $this->block->data('slide_title');
            $slide_url = $this->block->data('slide_url');
            $slide_images = $this->block->data('slide_image');
            $slide_texts = $this->block->data('slide_text');
            
            if(!is_array($slide_titles) || empty($slide_titles))
            {
                $slide_titles[0] = "Example Slide";
                $slide_url[0] = "#";
                $slide_images[0] = "#";
                $slide_texts[0] = "This is a nice new slider. Click edit to customize.";
                $slide_titles[1] = "Example Slide";
                $slide_url[1] = "#";
                $slide_images[1] = "#";
                $slide_texts[1] = "This is a nice new slider. Click edit to customize.";

            }
            $num_slides = count($slide_titles);
            end($slide_titles);
            $last_key = key($slide_titles) + 1;
            reset($slide_titles);
            ?>

            <!-- Nav tabs -->
            <script>
            var num_slides = <?=$num_slides?>;
            var new_slide_number = <?=$last_key?>;
            <?php if($num_slides == 0): ?>
            var num_slides = 1;
            <?php endif;?>

            $(document).ready(function (){
                $("#myTab a").click(function (e) {
                  e.preventDefault();
                  $(this).tab("show");
                });

                $(".delete-slide").bind("click.delete_slide",function (e) {
                    slide = $(this).attr('slide');
                    $("#slide-section-" + slide).remove();
                    $("#slide-section-tab-" + slide).remove();

                });

                $("#add-slide").click(function (e) {
                    num_slides++;
                    $("#slide-section-tabs").append('<li id="slide-section-tab-' + num_slides +'"><a class="bepopup-p-buttons" href="#slide-section-' + num_slides + '" data-toggle="tab">Slide ' + num_slides + '</a></li>');
                
                    $("#slide-sections").append('\
                        <div class="tab-pane" id="slide-section-' + num_slides + '">\
                          \
                        </div>\
                            ');
                    e.preventDefault();

                    html = $("#slide-section-template").html();
                    $("#slide-section-" + num_slides).html(html);
                    $('#slides a:last').tab('show');
                    $('#slide-section-' + num_slides).find('.delete-slide').attr('slide', num_slides);
                    $('#slide-section-' + num_slides).find('[name="test_image"]').attr('name', 'slide_image[' + (new_slide_number) + ']');
                    $('#slide-section-' + num_slides).find('[name="test_title"]').attr('name', 'slide_title[' + (new_slide_number) + ']');
                    $('#slide-section-' + num_slides).find('[name="test_url"]').attr('name', 'slide_url[' + (new_slide_number) + ']');
                    $('#slide-section-' + num_slides).find('[name="test_text"]').attr('name', 'slide_text[' + (new_slide_number) + ']');
                    $('#slide-section-' + num_slides).find('[name="test_image_old"]').attr('onclick', 'file_manager(\'slide_image[' + (new_slide_number) + ']\')');
                    $('#slide-section-' + num_slides).find('[name="test_image_old"]').attr('name', 'slide_image[' + (new_slide_number) + ']_old');
                    $(".delete-slide").unbind("click.delete_slide");
                    $(".delete-slide").bind("click.delete_slide",function (e) {
                        slide = $(this).attr('slide');
                        $("#slide-section-" + slide).remove();
                        $("#slide-section-tab-" + slide).remove();
                        $('#slides a:first').tab('show');
                    });
                    new_slide_number++;
                });
            });
            </script>
            <style>
            #settings-content .form-group
            {
                margin-left:0px !important;
                width:90% !important;
            }
            </style>
                <ul id="myTab" class="bwizard-steps" style="margin-left:-15px">
                    <li class="active"><a class="bepopup-p-buttons" href="#general" data-toggle="tab">General</a></li>
                    <li><a class="bepopup-p-buttons" href="#settings" data-toggle="tab">Settings</a></li>
                    <li><a class="bepopup-p-buttons" href="#slides" data-toggle="tab">Slides</a></li>
                </ul>
                <div class="tab-content col-lg-10 col-md-10 col-sm-12 col-xs-12">
                    <div class="tab-pane active" id="general">
                        <?php $this->admin_select('slider_type',array("flexslider" => "FlexSlider"),'Slider Type');?>
                    </div>
                    <div class="tab-pane" id="settings">
                        <div class="tabbable tabs-left">
                            <ul class="nav nav-tabs" id="slider-settings">
                                <li class="active"><a href="#slider-settings-flexslider" data-toggle="tab">FlexSlider</a></li>
                            </ul>
                            <div class="tab-content" id="settings-content" style="height: 240px; overflow-y: scroll">
                                <div class="tab-pane active" id="slider-settings-flexslider" >
                                    <?php
                                    $this->admin_select('flexslider_settings_direction',array("horizontal" => "Horizontal","vertical" => "Vertical"),'Direction');
                                    $this->admin_input('flexslider_settings_slideshowSpeed',"text",'Speed (ms)', '10000');
                                    $this->admin_select('flexslider_settings_pauseOnHover',array("true" => "Yes","false" => "No"),'Pause on hover');
                                    $this->admin_select('flexslider_settings_directionNav',array("true" => "Yes","false" => "No"),'Direction Nav');
                                    $this->admin_select('flexslider_settings_controlNav',array("true" => "Yes","false" => "No"),'Control Nav');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="slides">
                        <div class="tabbable tabs-left">
                            <ul class="bwizard-steps" id="slide-section-tabs">
                                <li><span id="add-slide" class="btn btn-lg btn-default bepopup-p-add">Add New Slide</span></li>
                                <?$i = 1;?>
                                <?php foreach($slide_titles as $key => $slide_title):?>
                                    <li class="<?php if($i == 1) echo 'active'?>" id="slide-section-tab-<?=$i?>"><a class="bepopup-p-buttons" href="#slide-section-<?=$i?>" data-toggle="tab">Slide <?=$i?></a></li>
                                    <?$i++;?>
                                <?php endforeach; ?>

                                <?php if($num_slides == 0): ?>
                                    <li class="active"><a class="bepopup-p-buttons" href="#slide-section-1" data-toggle="tab">Slide 1</a></li>
                                <?php endif;?>
                            </ul>
                            <div class="tab-content" id="slide-sections">
                                <!-- Template for creation -->
                                <div class="tab-pane" id="slide-section-template">
                                    <?php
                                    $this->admin_input('test_title','text','Title: ', '');
                                    $this->admin_input('test_url','text','Link Address: ', '');
                                    $this->admin_textarea('test_text','Slide Text: ', '');
                                    $this->admin_file('test_image','Image: ', '', 'slider1'.$this->block->get_id().$i, false );
                                    ?>
									<script>
										$("#slider1<?=$this->block->get_id().$i?>").click(function(e){
										   e.preventDefault();
										});						
									</script>									
                                    <span style="margin-left:25px" class="btn btn-danger delete-slide" slide="template">Delete This Slide</span>
                                </div>
                                <!-- /Template for creation -->
                                <?$i = 1;?>
                                <?php foreach($slide_titles as $key => $slide_title):?>
                                    <div class="tab-pane <?php if($i == 1) echo 'active'?>" id="slide-section-<?=$i?>">
                                        <?php
                                        $this->admin_input('slide_title['.$key.']','text','Title: ', $slide_titles[$key]);
                                        $this->admin_input('slide_url['.$key.']','text','Link Address: ', $slide_url[$key]);
                                        $this->admin_textarea('slide_text['.$key.']','Slide Text: ', $slide_texts[$key]);
                                        $this->admin_file('slide_image['.$key.']','Image: ', $slide_images[$key], 'slider2'.$this->block->get_id().$i, true );
                                        ?>
										<script>
											$("#slider2<?=$this->block->get_id().$i?>").click(function(e){
											   e.preventDefault();
											});						
										</script>
                                        <span style="margin-left:25px" class="btn btn-danger delete-slide" slide="<?=$i?>">Delete This Slide</span>
                                    </div>
                                    <?$i++;?>
                                <?php endforeach; ?>

                                <?php if($num_slides == 0): ?>
                                    <div class="tab-pane active" id="slide-section-1">
                                        <?php
                                        $this->admin_input('slide_title[0]','text','Title: ');
                                        $this->admin_input('slide_url[0]','text','Link Address: ');
                                        $this->admin_textarea('slide_text[0]','Slide Text: ');
                                        $this->admin_file('slide_image[0]','Image: ', '', 'slider3'.$this->block->get_id().$i, true );
                                        ?>
										<script>
											$("#slider3<?=$this->block->get_id().$i?>").click(function(e){
											   e.preventDefault();
											});						
										</script>										
                                    </div>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
			</div>
            <?php
        }
		public function generate_style()
		{
			$path = substr($_SERVER['SCRIPT_FILENAME'],0,strrpos($_SERVER['SCRIPT_FILENAME'],'/index.php'));
			include FCPATH.'/builderengine/public/animations/animations.php';
			
            $title_color = $this->block->data('title_color');
			$title_background_color = $this->block->data('text_background_color');
            $text_color = $this->block->data('text_color');		
			$text_background_color = $this->block->data('text_background_color');
			$title_animation_type = $this->block->data('title_animation_type');	  
		    $title_animation_duration = $this->block->data('title_animation_duration');
		    $title_animation_event = $this->block->data('title_animation_event');
		    $title_animation_delay = $this->block->data('title_animation_delay');
			$text_animation_type = $this->block->data('text_animation_type');	  
			$text_animation_duration = $this->block->data('text_animation_duration');
			$text_animation_event = $this->block->data('text_animation_event');
			$text_animation_delay = $this->block->data('text_animation_delay');
			$alignments = array(
                'top-left' => 'top-left',
                'top-center' => 'top-center',
                'top-right' => 'top-right',
                'center-left' => 'center-left',
                'center-middle' => 'center-middle',
                'center-right' => 'center-right',
                'bottom-left' => 'bottom-left',
                'bottom-center' => 'bottom-center',
                'bottom-right' => 'bottom-right'
            );
            $caption_text_font_size = $this->block->data('caption_text_font_size');
            $caption_title_font_size = $this->block->data('caption_title_font_size');
            $caption_align = $this->block->data('caption_align');
            $caption_width = $this->block->data('caption_width');
            $caption_height = $this->block->data('caption_height');
			?>
            <div role="tabpanel">
			
                <ul class="nav nav-tabs" role="tablist" style="margin-left: -20px;">
					<li role="presentation" class="active"><a href="#title" aria-controls="title" role="tab" data-toggle="tab">Title</a></li>
                    <li role="presentation"><a href="#text" aria-controls="text1" role="tab" data-toggle="tab">Text</a></li>
                    <li role="presentation"><a href="#customcss" aria-controls="customcss" role="tab" data-toggle="tab">Custom</a></li>
                </ul>
				
                <div class="tab-content">
                     <div role="tabpanel" class="tab-pane fade in active" id="title">
                        <?php
                        $this->admin_input('title_color','text', 'Font color: ', $title_color);
                        $this->admin_input('caption_title_font_size','text', 'Font size: ', $caption_title_font_size);
                        $this->admin_select('caption_align', $alignments,'Text box align: ',$caption_align);
                        $this->admin_input('caption_width','text', 'Text box width: ', $caption_width);
                        $this->admin_input('caption_height','text', 'Text box height: ', $caption_height);
                        $this->admin_input('title_background_color','text', 'Background color: ', $title_background_color);
					    $this->admin_select('title_animation_type', $types,'Animation type: ',$title_animation_type);
					    $this->admin_select('title_animation_duration', $durations,'Animation duration: ',$title_animation_duration);
					    $this->admin_select('title_animation_event', $events,'Animation Start: ',$title_animation_event);
					    $this->admin_select('title_animation_delay', $delays,'Animation Delay: ',$title_animation_delay);
                        ?>
                    </div>
                     <div role="tabpanel" class="tab-pane fade" id="text">
                        <?php
                        $this->admin_input('text_color','text', 'Font color: ', $text_color);
                        $this->admin_input('caption_text_font_size','text', 'Font size: ', $caption_text_font_size);
                        $this->admin_input('text_background_color','text', 'Background color: ', $text_background_color);
					    $this->admin_select('text_animation_type', $types,'Animation type: ',$text_animation_type);
					    $this->admin_select('text_animation_duration', $durations,'Animation duration: ',$text_animation_duration);
					    $this->admin_select('text_animation_event', $events,'Animation Start: ',$text_animation_event);
					    $this->admin_select('text_animation_delay', $delays,'Animation Delay: ',$text_animation_delay);
                        ?>
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
            </div>			
			<?php
		}

		public function get_images()
        {
			global $active_controller;
            $default_images = array();//array("/blocks/slider/images/block-slider-1.jpg","/blocks/slider/images/block-slider-2.jpg");
			$real_path = $_SERVER['DOCUMENT_ROOT'].'/themes/'.$active_controller->BuilderEngine->get_frontend_theme().'/blocks/slider/';
            $theme_path = str_replace(base_url(), '', get_theme_path());
            $theme_images_path = $theme_path.'blocks/slider';

            if(file_exists($real_path))
            {
                $files = scandir($real_path);
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
            global $flexslider_js_settings;

            $flexslider_js_settings[0] = $this->block->data('flexslider_settings_direction');
            $flexslider_js_settings[1] = $this->block->data('flexslider_settings_controlNav');
            $flexslider_js_settings[2] = $this->block->data('flexslider_settings_directionNav');
            $flexslider_js_settings[3] = $this->block->data('flexslider_settings_pauseOnHover');
            $flexslider_js_settings[4] = $this->block->data('flexslider_settings_slideshowSpeed');
            $flexslider_js_settings[5] = $this->block->name;

            $slide_titles = $this->block->data('slide_title');


            if(!is_array($slide_titles) || empty($slide_titles))
            {
                $this->block->force_data_modification();

                $this->block->set_data('slider_type', 'flexslider');

				$theme_images = $this->get_images();
				if(!empty($theme_images)){
					$slide_titles = array();
					$slide_urls = array();
					$slide_texts = array();
					$num_slides = count($theme_images);
					$slide_images = $theme_images;
					for($x = 1; $x <= $num_slides; $x++){
						array_push($slide_titles,'Example Slide #'.$x);
						array_push($slide_texts,'This is a slide #'.$x.'. Click edit to customize.');
						array_push($slide_urls,'#');
					}
					$this->block->set_data('slide_title', $slide_titles);
					$this->block->set_data('slide_url', $slide_urls);
					$this->block->set_data('slide_image', $slide_images);
					$this->block->set_data('slide_text', $slide_texts);
				}else{
					$this->block->set_data('slide_title', array("Example Slide","Example Slide #2"));
					$this->block->set_data('slide_url', array("#","#"));
					$this->block->set_data('slide_image', array("/blocks/slider/images/block-slider-1.jpg","/blocks/slider/images/block-slider-2.jpg"));
					$this->block->set_data('slide_text', array("This is a nice new slider. Click edit to customize.","This is a slide #2. Click edit to customize."));
				}
            }

            switch ($this->block->data('slider_type'))
            {
                case "flexslider":
                    return $this->output_flexslider();
                    break;

                default:
                    return $this->output_flexslider();
                    break;
            }
            
        }

        function output_flexslider()
        {
            global $active_controller;
            $CI = &get_instance();
            $CI->load->module('layout_system');

            $this->get_images();

            $custom_css = $this->block->data('custom_css');
            $style_arr['text'] = ';'.$custom_css;
            $this->block->set_data("style", $style_arr);

            $direction = $this->block->data('flexslider_settings_direction');
            if(!$direction)
            {
                $this->block->set_data('flexslider_settings_direction', "horizontal");
                $this->block->set_data('flexslider_settings_controlNav', "false");
                $this->block->set_data('flexslider_settings_directionNav', "true");
                $this->block->set_data('flexslider_settings_pauseOnHover', "true");
                $this->block->set_data('flexslider_settings_slideshowSpeed', "5000");
            }
			$slide_titles = $this->block->data('slide_title');
            $title_color = $this->block->data('title_color');
			$title_background_color = $this->block->data('title_background_color');
            $text_color = $this->block->data('text_color');		
			$text_background_color = $this->block->data('text_background_color');
			$title_animation_type = $this->block->data('title_animation_type');	  
		    $title_animation_duration = $this->block->data('title_animation_duration');
		    $title_animation_event = $this->block->data('title_animation_event');
		    $title_animation_delay = $this->block->data('title_animation_delay');
			$text_animation_type = $this->block->data('text_animation_type');	  
			$text_animation_duration = $this->block->data('text_animation_duration');
			$text_animation_event = $this->block->data('text_animation_event');
			$text_animation_delay = $this->block->data('text_animation_delay');

            $num_slides = count($slide_titles);
		    $settings = array();

            $i = 1;
			foreach($slide_titles as $key => $slide_title)
			{
				$title_settings[0] = 'title'.$this->block->get_id().$i;
				$title_settings[1] = $title_animation_event;
				$title_settings[2] = $title_animation_duration.' '.$title_animation_delay.' '.$title_animation_type;
				array_push($settings,$title_settings);
				$text_settings[0] = 'text'.$this->block->get_id().$i;
				$text_settings[1] = $text_animation_event;
				$text_settings[2] = $text_animation_duration.' '.$text_animation_delay.' '.$text_animation_type;
				array_push($settings,$text_settings);

                $i++;
			}
			
			add_action("be_foot", generate_animation_events($settings));
			
            $title_style = 
                'style="
                    color: '.$title_color.' !important;
					background-color: '.$title_background_color.' !important;
                "';
            $text_style = 
                'style="
                    color: '.$text_color.' !important;
					background-color: '.$text_background_color.' !important;
                "';

            // Generate styles
            $caption_text_font_size = $this->block->data('caption_text_font_size');
            $caption_title_font_size = $this->block->data('caption_title_font_size');
            $caption_align = $this->block->data('caption_align');
            $caption_width = $this->block->data('caption_width');
            $caption_height = $this->block->data('caption_height');

            if($caption_align == 'top-left')
            {
                $caption_align = 'top:0 !important;';
            }
            else if($caption_align == 'top-center')
            {
                $caption_align = 'top:0 !important;';
                $caption_align .= 'left:35% !important;';
            }
            else if($caption_align == 'top-right')
            {
                $caption_align = 'top:0 !important;';
                $caption_align .= 'left:inherit !important;';
                $caption_align .= 'right:0 !important;';
            }
            else if($caption_align == 'center-left')
            {
                $caption_align = 'top:35% !important;';
                $caption_align .= 'left:0 !important;';
            }
            else if($caption_align == 'center-middle')
            {
                $caption_align = 'top:35% !important;';
                $caption_align .= 'left:35% !important;';
            }
            else if($caption_align == 'center-right')
            {
                $caption_align = 'top:35% !important;';
                $caption_align .= 'left:inherit !important;';
                $caption_align .= 'right:0 !important;';
            }
            else if($caption_align == 'bottom-left')
            {
                $caption_align = 'top:inherit !important;';
                $caption_align .= 'bottom:0 !important;';
            }
            else if($caption_align == 'bottom-center')
            {
                $caption_align = 'top:inherit !important;';
                $caption_align .= 'left:35% !important;';
                $caption_align .= 'bottom:0 !important;';
            }
            else if($caption_align == 'bottom-right')
            {
                $caption_align = 'top:inherit !important;';
                $caption_align .= 'left:inherit !important;';
                $caption_align .= 'right:0 !important;';
                $caption_align .= 'bottom:0 !important;';
            }


            // Apply styles
            $output = '
			<style>
			.slider-caption-text-font-size-'.$this->block->get_id().' p{
				font-size: '.$caption_text_font_size.' !important;
			}
			.slider-caption-title-font-size-'.$this->block->get_id().' h3{
				font-size: '.$caption_title_font_size.' !important;
			}
			.slider-caption-align-'.$this->block->get_id().'{
				'.$caption_align.'
			}
			.slider-caption-width-'.$this->block->get_id().'{
				width: '.$caption_width.' !important;
			}
			.slider-caption-height-'.$this->block->get_id().'{
				height: '.$caption_height.' !important;
			}
			</style>
			';

            $output .= "
            <div class=\"flex-image block-column-wide-12 flexslider\" id=\"flexslider-{$this->block->name}\">
                <ul class=\"slides\">";
                    $slide_titles = $this->block->data('slide_title');
                    $slide_images = $this->block->data('slide_image');
                    $slide_texts = $this->block->data('slide_text');
                    $slide_urls = $this->block->data('slide_url');
                    $num_slides = count($slide_titles);
                    $i = 1;

                    foreach($slide_titles as $key => $slide_title)
                    {
						if($i == 1)
						{
							$output .= "<li style=\"display:list-item;\">";
							if($slide_urls[$key] != "")
								$output .="<a href=\"{$slide_urls[$key]}\">";
							else
								$output .="<a href=\"#\">";
						}
						else
						{
							$output .= "<li style=\"display:block;\">";
							if($slide_urls[$key] != "")
								$output .="<a href=\"{$slide_urls[$key]}\">";
							else
								$output .="<a href=\"#\">";
						}
						
                        $caption = "
                            <div class=\"flex-caption slider-caption-align-".$this->block->get_id()." slider-caption-width-".$this->block->get_id()." slider-caption-height-".$this->block->get_id()." slider-caption-text-font-size-".$this->block->get_id()." slider-caption-title-font-size-".$this->block->get_id()."\">
                                <!-- Title -->
                                <h3 id=\"title".$this->block->get_id()."".$i."\" ".$title_style."><span>".$slide_titles[$key]."</span></h3>
                                <!-- Para -->
                                <p id=\"text".$this->block->get_id()."".$i."\" ".$text_style.">".$slide_texts[$key]."</p>
                            </div></li>
                        ";
						if(strpos($slide_images[$key],base_url()) !== FALSE)
							$slide_images[$key] = str_replace(base_url(),'',$slide_images[$key]);
							
                        $output .="
                            <img src=\"".checkImagePath(base_url($slide_images[$key]))."\" />
                        ";
                        if($slide_texts[$key] != "" && $slide_titles[$key] != "")
                            $output .= $caption;
						else
							$output .= "</a></li>";
                        $i++;
                    }
                    $output .= "
                </ul>
            </div>

            ";
			if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
				return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), "flexslider-{$this->block->name}", $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), 'with_settings');
			else
				return $output;
        }
    }
?>