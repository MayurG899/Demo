<?php
global $logoslider_js_settings;

        function initialize_logoslider_js()
        {
            global $logoslider_js_settings;
            echo '
			<script type="text/javascript" src="'.base_url('blocks/logo_slider/owl-carousel/owl.carousel.min.js').'"></script>
            <script>
				$(document).ready(function() {
				  $(".logoslider").each(function(){
                    var elementId = $(this).attr("id");
                    $("#" + elementId).owlCarousel({
                        items : 4,
                        itemsDesktop : [1000,4],
                        itemsDesktopSmall : [900,4],
                        itemsTablet: [600,2],
                        itemsMobile : [480,1],
                        pagination: false,
                        responsive: true,
                        margin: 5,
                        autoPlay: 5500,
                        stopOnHover: true,
                    });
				  });
				});
            </script>
            ';
        }
        add_action("be_foot", "initialize_logoslider_js");

        class logo_slider_block_handler extends  block_handler{
        function info()
        {
            $info['category_name'] = "Media";
            $info['category_icon'] = "dsf";

            $info['block_name'] = "Logo Slider";
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
                $slide_images[0] = base_url()."/blocks/logo_slider/images/gallery_logo1.png";
                $slide_texts[0] = "This is a nice new slider. Click edit to customize.";
                $slide_titles[1] = "Example Slide";
                $slide_url[1] = "#";
                $slide_images[1] = base_url()."/blocks/logo_slider/images/gallery_logo2.png";
                $slide_texts[1] = "This is a nice new slider. Click edit to customize.";
                $slide_titles[2] = "Example Slide";
                $slide_url[2] = "#";
                $slide_images[2] = base_url()."/blocks/logo_slider/images/gallery_logo3.png";
                $slide_texts[2] = "This is a nice new slider. Click edit to customize.";
				$slide_titles[3] = "Example Slide";
                $slide_images[3] = base_url()."/blocks/logo_slider/images/gallery_logo4.png";
				$slide_titles[4] = "Example Slide";
                $slide_images[4] = base_url()."/blocks/logo_slider/images/gallery_logo5.png";
				$slide_titles[4] = "Example Slide";
                $slide_images[4] = base_url()."/blocks/logo_slider/images/gallery_logo6.png";
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
                    $("#slide-section-tabs").append('<li id="slide-section-tab-' + num_slides +'"><a class="bepopup-p-buttons" href="#slide-section-' + num_slides + '" data-toggle="tab">Logo ' + num_slides + '</a></li>');
                
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
                        <?php $this->admin_select('slider_type',array("logoslider" => "FlexSlider"),'Slider Type');?>
                    </div>
                    <div class="tab-pane" id="settings">
                        <div class="tabbable tabs-left">
                            <ul class="nav nav-tabs" id="slider-settings">
                                <li class="active"><a href="#slider-settings-logoslider" data-toggle="tab">FlexSlider</a></li>
                            </ul>
                            <div class="tab-content" id="settings-content" style="height: 240px; overflow-y: scroll">
                                <div class="tab-pane active" id="slider-settings-logoslider" >
                                    <?php
                                    $this->admin_select('logoslider_settings_direction',array("horizontal" => "Horizontal","vertical" => "Vertical"),'Direction');
                                    $this->admin_input('logoslider_settings_slideshowSpeed',"text",'Speed (ms)', '10000');
                                    $this->admin_select('logoslider_settings_pauseOnHover',array("true" => "Yes","false" => "No"),'Pause on hover');
                                    $this->admin_select('logoslider_settings_directionNav',array("true" => "Yes","false" => "No"),'Direction Nav');
                                    $this->admin_select('logoslider_settings_controlNav',array("true" => "Yes","false" => "No"),'Control Nav');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="slides">
                        <div class="tabbable tabs-left">
                            <ul class="bwizard-steps" id="slide-section-tabs">
                                <li><span id="add-slide" class="btn btn-lg btn-default bepopup-p-add">Add New Logo</span></li>
                                <?$i = 1;?>
                                <?php foreach($slide_titles as $key => $slide_title):?>
                                    <li class="<?php if($i == 1) echo 'active'?>" id="slide-section-tab-<?=$i?>"><a class="bepopup-p-buttons" href="#slide-section-<?=$i?>" data-toggle="tab">Logo <?=$i?></a></li>
                                    <?$i++;?>
                                <?php endforeach; ?>

                                <?php if($num_slides == 0): ?>
                                    <li class="active"><a class="bepopup-p-buttons" href="#slide-section-1" data-toggle="tab">Logo 1</a></li>
                                <?php endif;?>
                            </ul>
                            <div class="tab-content" id="slide-sections">
                                <!-- Template for creation -->
                                <div class="tab-pane" id="slide-section-template">
                                    <?php
                                    $this->admin_input('test_title','text','Title: ', '');
                                    $this->admin_input('test_url','text','Link Address: ', '');
                                    $this->admin_textarea('test_text','Slide Text: ', '');
                                    $this->admin_file('test_image','Image: ', '', 'slider1'.$this->block->get_id().$i, false);
                                    ?>
									<script>
										$("#slider1<?=$this->block->get_id().$i?>").click(function(e){
										   e.preventDefault();
										});						
									</script>									
                                    <span style="margin-left:25px" class="btn btn-danger delete-slide" slide="template">Delete Slide</span>
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
                                        <span style="margin-left:25px" class="btn btn-danger delete-slide" slide="<?=$i?>">Delete Slide</span>
                                    </div>
                                    <?$i++;?>
                                <?php endforeach; ?>

                                <?php if($num_slides == 0): ?>
                                    <div class="tab-pane active" id="slide-section-1">
                                        <?php
                                        $this->admin_input('slide_title[0]','text','Title: ');
                                        $this->admin_input('slide_url[0]','text','Link Address: ');
                                        $this->admin_textarea('slide_text[0]','Slide Text: ');
                                        $this->admin_file('slide_image[0]','Image: ', '', 'logoslider'.$this->block->get_id().$i, false );
                                        ?>
										<script>
											$("#logoslider<?=$this->block->get_id().$i?>").click(function(e){
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

            $background_color = $this->block->data('background_color');
            $animation_type = $this->block->data('animation_type');
            $animation_duration = $this->block->data('animation_duration');
            $animation_event = $this->block->data('animation_event');
            $animation_delay = $this->block->data('animation_delay');
            ?>
            <div role="tabpanel">

                <ul class="nav nav-tabs" role="tablist" style="margin-left: -20px;">
                    <li role="presentation" class="active"><a href="#images" aria-controls="title" role="tab" data-toggle="tab">Images</a></li>
                    <li role="presentation"><a href="#customcss" aria-controls="customcss" role="tab" data-toggle="tab">Custom</a></li>
                </ul>

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="images">
                        <?php
                        $this->admin_input('background_color','text', 'Background color: ', $background_color);
                        $this->admin_select('animation_type', $types,'Animation type: ',$animation_type);
                        $this->admin_select('animation_duration', $durations,'Animation duration: ',$animation_duration);
                        $this->admin_select('animation_event', $events,'Animation Start: ',$animation_event);
                        $this->admin_select('animation_delay', $delays,'Animation Delay: ',$animation_delay);
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
			$default_images = array();
			$real_path = $_SERVER['DOCUMENT_ROOT'].'/themes/'.$active_controller->BuilderEngine->get_frontend_theme().'/blocks/logo_slider/';
			$theme_path = str_replace(base_url(), '', get_theme_path());
			$theme_images_path = $theme_path.'blocks/logo_slider';

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
            global $logoslider_js_settings;

            $logoslider_js_settings[0] = $this->block->data('logoslider_settings_direction');
            $logoslider_js_settings[1] = $this->block->data('logoslider_settings_controlNav');
            $logoslider_js_settings[2] = $this->block->data('logoslider_settings_directionNav');
            $logoslider_js_settings[3] = $this->block->data('logoslider_settings_pauseOnHover');
            $logoslider_js_settings[4] = $this->block->data('logoslider_settings_slideshowSpeed');
            $logoslider_js_settings[5] = $this->block->get_name();

            $slide_titles = $this->block->data('slide_title');


            if(!is_array($slide_titles) || empty($slide_titles))
            {
                $this->block->force_data_modification();

				$theme_images = $this->get_images();
				if(!empty($theme_images)){
					$slide_titles = array();
					$slide_urls = array();
					$slide_texts = array();
					$num_slides = count($theme_images);
					$slide_images = $theme_images;
					for($x = 1; $x <= $num_slides; $x++){
						array_push($slide_titles,'Example Slide #'.$x);
						array_push($slide_texts,'This is a nice new logo slide #'.$x);
						array_push($slide_urls,'#');
					}
					$this->block->set_data('slide_title', $slide_titles);
					$this->block->set_data('slide_url', $slide_urls);
					$this->block->set_data('slide_image', $slide_images);
					$this->block->set_data('slide_text', $slide_texts);
				}else{
					$this->block->set_data('slide_title', array("Example Slide","Example Slide #2","Example Slide #2","Example Slide #2","Example Slide #2","Example Slide #2"));
					$this->block->set_data('slide_url', array("#","#","#","#","#","#"));
					$this->block->set_data('slide_image', array(base_url()."/blocks/logo_slider/images/gallery_logo1.png",base_url()."/blocks/logo_slider/images/gallery_logo2.png",base_url()."/blocks/logo_slider/images/gallery_logo3.png",base_url()."/blocks/logo_slider/images/gallery_logo4.png",base_url()."/blocks/logo_slider/images/gallery_logo5.png",base_url()."/blocks/logo_slider/images/gallery_logo6.png"));
					$this->block->set_data('slide_text', array("This is a nice new logo slide.","This is a nice new logo slide.","This is a nice new logo slide.","This is a nice new logo slide.","This is a nice new logo slide.","This is a nice new logo slide."));
				}
				$this->block->set_data('slider_type', 'logoslider');
            }
            switch ($this->block->data('slider_type'))
            {
                case "logoslider":
                    return $this->output_logoslider();
                    break;

                default:
                    return $this->output_logoslider();
                    break;
            }
            
        }

        function output_logoslider()
        {
            global $active_controller;
            $CI = &get_instance();
            $CI->load->module('layout_system');

            $custom_css = $this->block->data('custom_css');
            $style_arr['text'] = ';'.$custom_css;
            $this->block->set_data("style", $style_arr);

            $direction = $this->block->data('logoslider_settings_direction');
            if(!$direction)
            {
                $this->block->set_data('logoslider_settings_direction', "horizontal");
                $this->block->set_data('logoslider_settings_controlNav', "false");
                $this->block->set_data('logoslider_settings_directionNav', "true");
                $this->block->set_data('logoslider_settings_pauseOnHover', "true");
                $this->block->set_data('logoslider_settings_slideshowSpeed', "5000");
            }
            $background_color = $this->block->data('background_color');
            $animation_type = $this->block->data('animation_type');
            $animation_duration = $this->block->data('animation_duration');
            $animation_event = $this->block->data('animation_event');
            $animation_delay = $this->block->data('animation_delay');

            $slide_titles = $this->block->data('slide_title');
            $settings = array();

            $i = 1;
            foreach($slide_titles as $key => $slide_title)
            {
                $images_settings[0] = 'logoslider-'.$this->block->get_name();
                $images_settings[1] = $animation_event;
                $images_settings[2] = $animation_duration.' '.$animation_delay.' '.$animation_type;
                array_push($settings,$images_settings);

                $i++;
            }

			add_action("be_foot", generate_animation_events($settings));
			
            $block_style =
                'style="
					background-color: '.$background_color.' !important;
                "';

            $output = "
			<div id=\"logoslider-{$this->block->get_name()}\" class=\"logopadding\" ".$block_style.">
				<link href=\"".base_url()."builderengine/public/animations/css/animate.min.css\" rel=\"stylesheet\" />
				<link href=\"".base_url()."blocks/logo_slider/owl-carousel/owl.carousel.css\" rel=\"stylesheet\" />
				<link href=\"".base_url()."blocks/logo_slider/owl-carousel/owl.theme.css\" rel=\"stylesheet\" />
				<link href=\"".base_url()."blocks/logo_slider/js/google-code-prettify/prettify.css\" rel=\"stylesheet\" />
				<style>
					.owl-item{
						background:'.$background_color.' !important;
					}
					#logoslider-{$this->block->get_name()} .owl-wrapper-outer{
					}
					.editor-mode-active .background-fixer{
						position: absolute;
						width: 100%;
						height: 100%;
						z-index: 1312312312312312312312312312;
						background: transparent;
					}
				</style>
			    <div class='background-fixer'></div>
				<div id=\"logo-slider-".$this->block->get_id()."\" class=\"logoslider owl-carousel owl-theme logosliderheight\" style=\"\">";
					$slide_titles = $this->block->data('slide_title');
					$slide_url = $this->block->data('slide_url');
					$slide_images = $this->block->data('slide_image');
					$slide_texts = $this->block->data('slide_text');
                    $slide_images = $this->block->data('slide_image');

					$i = 1;
					foreach($slide_titles as $key => $slide_title){
						$output .= "
							<div class=\"imgItem imgitemstyle\">
								<img class=\"img-responsive\" src=\"".checkImagePath($slide_images[$key])."\" />
							</div>			
						";
						$i++;
					}
				$output .="
				</div>
			</div>
				";
			if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
				return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), "logoslider-{$this->block->get_name()}", $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), 'with_settings');
			else
				return $output;
        }
    }
?>