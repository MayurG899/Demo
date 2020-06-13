<?php
	global $carousel_js_settings;

        function initialize_custom_carousel_js()
        {
            global $carousel_js_settings;

            echo "
				<script type=\"text/javascript\" src=\"".base_url('blocks/image_carousel/js/owl.carousel.js')."\"></script>
				<script>
					$(document).ready(function() {
						$('.image-carousel').each(function(){
                        	var carouselId = $(this).attr('id');
						  	$('#' + carouselId).owlCarousel({
							  	autoPlay:true,
							  	navigation : {$carousel_js_settings[0]}, // Show next and prev buttons
							  	slideSpeed : {$carousel_js_settings[1]},
							  	paginationSpeed : {$carousel_js_settings[2]},
							  	singleItem:true,
						  	});
						});
					});
				</script>
            ";
        }
		add_action("be_foot", "initialize_custom_carousel_js");

    class image_carousel_block_handler extends block_handler
	{
        function info()
        {
            $info['category_name'] = "Media";
            $info['category_icon'] = "dsf";

            $info['block_name'] = "Image Carousel";
            $info['block_icon'] = "fa-envelope-o public";
            
            return $info;
        }
		
		public function generate_admin()
		{
			$slide_image = $this->block->data('slide_image');

			global $carousel_js_settings;
			$carousel_js_settings[0] = $this->block->data('carousel_navigation');
			$carousel_js_settings[1] = $this->block->data('carousel_speed');
			$carousel_js_settings[2] = $this->block->data('carousel_pagination_speed');
			/*
			if(!is_array($slide_image) || empty($slide_image))
			{
				$slide_image[0] = base_url()."blocks/slider/images/block-slider-1.jpg";
				$slide_image[1] = base_url()."blocks/slider/images/block-slider-2.jpg";
				$slide_image[2] = base_url()."blocks/slider/images/block-slider-1.jpg";
			}
			*/
			$num_slides = count($slide_image);
			end($slide_image);
			$last_key = key($slide_image) + 1;
			reset($slide_image);
			?>
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

			<ul class="bwizard-steps" id="slide-section-tabs" style="margin-left:-15px">
				<li><span id="add-slide" class="btn btn-md btn-default bepopup-p-add">Add New Slide</span></li>
				<li><a href="#settings" data-toggle="tab">Carousel Settings</a></li>
				<?php $i = 1;?>
				<?php foreach($slide_image as $key => $element): ?>
					<li class="<?php if($i == 1) echo 'active'?>" id="slide-section-tab-<?=$i?>"><a class="bepopup-p-buttons" href="#slide-section-<?=$i?>" data-toggle="tab">Slide <?=$i?></a></li>
					<?php $i++;?>
				<?php endforeach; ?>
				<?php if($num_slides == 0): ?>
					<li class="active"><a class="bepopup-p-buttons" href="#slide-section-1" data-toggle="tab">Slide 1</a></li>
				<?php endif;?>
			</ul>
			<div class="tab-content col-lg-6 col-md-6 col-sm-12 col-xs-12" id="slide-sections">
				<!-- Template for creation -->
				<div class="tab-pane" id="slide-section-template">
					<?php
					$this->admin_file('test_image','Image: ', '','carousel-image-temp'.$this->block->get_id(),false);
					?>
					<script>
						$("#carousel-image-temp<?=$this->block->get_id()?>").click(function(e){
						   e.preventDefault();
						});						
					</script>
					<div class="form-group">
						<span class="btn btn-danger delete-slide" slide="template">Delete This Slide</span>
					</div>
				</div>
				<!-- /Template for creation -->
				<div class="tab-pane" id="settings">
					<?php
					$this->admin_select('carousel_type',array("custom" => "Image Carousel"),'Carousel Type');
					$this->admin_select('carousel_navigation',array("true" => "Show Navigation","false" => "Hide Navigation"),'Controls: ');
					$this->admin_select('carousel_speed',array("300" => "300 (ms)", "600" => "600 (ms)"),'Slide Speed (ms)');
					$this->admin_select('carousel_pagination_speed',array("300" => "300 (ms)", "600" => "600 (ms)"),'Pagination Speed (ms)');
					?>
					<style>
						.btn{height:35px !important;width:140px !important;}
					</style>
				</div>
				<?php $i = 1;?>
				<?php foreach($slide_image as $key => $element): ?>
					<div class="tab-pane <?php if($i == 1) echo 'active'?>" id="slide-section-<?=$i?>">
						<?php
						$this->admin_file('slide_image['.$key.']','Image: ', $slide_image[$key],'carousel-image'.$this->block->get_id().$i, true);
						?>
						<script>
							$("#carousel-image<?=$this->block->get_id().$i?>").click(function(e){
							   e.preventDefault();
							});						
						</script>
						<div class="form-group">
							<span class="btn btn-danger delete-slide" slide="<?=$i?>">Delete This Slide</span>
						</div>
					</div>
					<?php $i++;?>
				<?php endforeach; ?>


				<?php if($num_slides == 0): ?>
					<div class="tab-pane active" id="slide-section-1">
						<?php
						$this->admin_file('slide_image[0]','Image: ', '','carouselimage'.$this->block->get_id().$i,false);
						?>
						<script>
							$("#carouselimage<?=$this->block->get_id().$i?>").click(function(e){
							   e.preventDefault();
							});						
						</script>
					</div>
				<?php endif;?>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			</div>
			<?php
		}
		
        public function generate_style($active_menu = '')
        {
			
        }
		public function load_generic_styling()
		{
			
		}
		public function get_images()
		{
			global $active_controller;
			$default_images = array();
			$real_path = $_SERVER['DOCUMENT_ROOT'].'/themes/'.$active_controller->BuilderEngine->get_frontend_theme().'/blocks/image_carousel/';
			$theme_path = str_replace(base_url(), '', get_theme_path());
			$theme_images_path = $theme_path.'blocks/image_carousel';

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
			global $carousel_js_settings;
			$this->load_generic_styles();

			$image1 = $this->block->data('image1');
			$image2 = $this->block->data('image2');
			$image3 = $this->block->data('image3');
			/*
			$image1_animation_type = $this->block->data('image1_animation_type');	  
		    $image1_animation_duration = $this->block->data('image1_animation_duration');
		    $image1_animation_event = $this->block->data('image1_animation_event');
		    $image1_animation_delay = $this->block->data('image1_animation_delay');

			$image2_animation_type = $this->block->data('image2_animation_type');	  
		    $image2_animation_duration = $this->block->data('image2_animation_duration');
		    $image2_animation_event = $this->block->data('image2_animation_event');
		    $image2_animation_delay = $this->block->data('image2_animation_delay');

			$image3_animation_type = $this->block->data('image3_animation_type');	  
		    $image3_animation_duration = $this->block->data('image3_animation_duration');
		    $image3_animation_event = $this->block->data('image3_animation_event');
		    $image3_animation_delay = $this->block->data('image3_animation_delay');

			$settings[0][0] = 'imgcrs1'.$this->block->get_id();
			$settings[0][1] = $image1_animation_event;
			$settings[0][2] = $image1_animation_duration.' '.$image1_animation_delay.' '.$image1_animation_type;
			$settings[1][0] = 'imgcrs2'.$this->block->get_id();
			$settings[1][1] = $image2_animation_event;
			$settings[1][2] = $image2_animation_duration.' '.$image2_animation_delay.' '.$image2_animation_type;
			$settings[2][0] = 'imgcrs3'.$this->block->get_id();
			$settings[2][1] = $image3_animation_event;
			$settings[2][2] = $image3_animation_duration.' '.$image3_animation_delay.' '.$image3_animation_type;
			add_action("be_foot", generate_animation_events($settings));
			*/
			$carousel_js_settings[0] = $this->block->data('carousel_navigation');
			$carousel_js_settings[1] = $this->block->data('carousel_speed');
			$carousel_js_settings[2] = $this->block->data('carousel_pagination_speed');
			if(empty($carousel_js_settings[0]))
				$carousel_js_settings[0] = 'true';
			if(empty($carousel_js_settings[1]))
				$carousel_js_settings[1] = '300';
			if(empty($carousel_js_settings[2]))
				$carousel_js_settings[2] = '300';		
				
            switch ($this->block->data('carousel_type'))
            {
                case "custom":
                    return $this->output_custom_carousel();
                    break;
                default:
                    return $this->output_custom_carousel();
                    break;
            }
		}
		
		public function output_custom_carousel()
		{
			global $active_controller;
			$CI = &get_instance();
			$CI->load->module('layout_system');

			$content = $this->block->data('content');
			$single_element = '';
			//generic animations
			$this->load_generic_styling();

			$slide_image = $this->block->data('slide_image');

			if(!is_array($slide_image) || empty($slide_image))
			{
				$theme_images = $this->get_images();
				if(!empty($theme_images)){
					$slide_image = $theme_images;
				}else{
					$slide_image[0] = base_url()."blocks/slider/images/block-slider-1.jpg";
					$slide_image[1] = base_url()."blocks/slider/images/block-slider-2.jpg";
					$slide_image[2] = base_url()."blocks/slider/images/block-slider-1.jpg";
				}
			}

			$output ='
				<div class="block-column-wide-12" id="image-carousel-container-'.$this->block->get_id().'">
					<div class="owl-container">
						<div id="demo-one-'.$this->block->get_id().'">
							<div id="owl-'.$this->block->get_id().'" class="image-carousel">';
			$i = 1;
			foreach($slide_image as $key => $element)
			{
				$output .= '<div id="imgcrs-'.$key.'-'.$this->block->get_id().'" class="item"><img src="'.$slide_image[$key].'" alt="Image"></div>';
			}

			$output .='</div>
						</div>
					</div>
				</div>';

			if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
				$menu ='with_settings_global';
			else
				$menu ='with_settings';
			if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
				return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'image-carousel-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
			else
				return $output;
		}

    }
?>