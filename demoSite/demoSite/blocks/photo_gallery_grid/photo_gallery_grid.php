<?php	
class Photo_gallery_grid_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Media";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Photo Gallery Grid";
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
			$slide_titles[0] = "2";
			$slide_url[0] = "#";
			$slide_images[0] = base_url()."blocks/photo_gallery_grid/images/ss_be_1.jpg";
			$slide_texts[0] = "Gallery Image #1";
			$slide_titles[1] = "4";
			$slide_url[1] = "#";
			$slide_images[1] = base_url()."blocks/photo_gallery_grid/images/ss_be_2.jpg";
			$slide_texts[1] = "Gallery Image #2";
			$slide_titles[2] = "3";
			$slide_url[2] = "#";
			$slide_images[2] = base_url()."blocks/photo_gallery_grid/images/ss_be_3.jpg";
			$slide_texts[2] = "Gallery Image #3";
			$slide_titles[3] = "1";
			$slide_url[3] = "#";
			$slide_images[3] = base_url()."blocks/photo_gallery_grid/images/ss_be_4.jpg";
			$slide_texts[3] = "Gallery Image #4";
			$slide_titles[4] = "2";
			$slide_url[4] = "#";
			$slide_images[4] = base_url()."blocks/photo_gallery_grid/images/ss_be_5.jpg";
			$slide_texts[4] = "Gallery Image #5";
			$slide_titles[5] = "4";
			$slide_url[5] = "#";
			$slide_images[5] = base_url()."blocks/photo_gallery_grid/images/ss_be_6.jpg";
			$slide_texts[5] = "Gallery Image #6";
			$slide_titles[6] = "3";
			$slide_url[6] = "#";
			$slide_images[6] = base_url()."blocks/photo_gallery_grid/images/ss_be_7.jpg";
			$slide_texts[6] = "Gallery Image #7";
			$slide_titles[7] = "1";
			$slide_url[7] = "#";
			$slide_images[7] = base_url()."blocks/photo_gallery_grid/images/ss_be_8.jpg";
			$slide_texts[7] = "Gallery Image #8";
			$slide_titles[8] = "1";
			$slide_url[8] = "#";
			$slide_images[8] = base_url()."blocks/photo_gallery_grid/images/ss_be_9.jpg";
			$slide_texts[8] = "Gallery Image #9";
			$slide_titles[9] = "4";
			$slide_url[9] = "#";
			$slide_images[9] = base_url()."blocks/photo_gallery_grid/images/ss_be_10.jpg";
			$slide_texts[9] = "Gallery Image #10";
			$slide_titles[10] = "3";
			$slide_url[10] = "#";
			$slide_images[10] = base_url()."blocks/photo_gallery_grid/images/ss_be_11.jpg";
			$slide_texts[10] = "Gallery Image #11";
			$slide_titles[11] = "2";
			$slide_url[11] = "#";
			$slide_images[11] = base_url()."blocks/photo_gallery_grid/images/ss_be_12.jpg";
			$slide_texts[11] = "Gallery Image #12";
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

		$(document).ready(function(){

			$('.delete-slide').bind('click.delete_slide',function(e){
				var slide = $(this).attr('slide');
				$('#slide-section-' + slide).remove();
				$("#image-selection option[value='slide-section-" + slide + "']").remove();
				$('#image-selection').val($('#image-selection option:first').val()).change();
			});

			$('#add-slide').click(function(e){
				num_slides++;
				$('#image-selection').append('<option value="slide-section-' + num_slides + '">Image ' + num_slides + '</option>');
				$('#slide-sections').append('<div class="results" id="slide-section-' + num_slides + '"></div>');
				e.preventDefault();
				console.log(num_slides);
				var template = $('#slide-section-template').html();
				$('#slide-section-' + num_slides).html(template);
				$('#slide-section-' + num_slides).find('.delete-slide').attr('slide', num_slides);
				$('#slide-section-' + num_slides).find('[name="test_image"]').attr('name', 'slide_image[' + (num_slides) + ']');
				$('#slide-section-' + num_slides).find('[name="test_title"]').attr('name', 'slide_title[' + (num_slides) + ']');
				$('#slide-section-' + num_slides).find('[name="test_url"]').attr('name', 'slide_url[' + (num_slides) + ']');
				$('#slide-section-' + num_slides).find('[name="test_text"]').attr('name', 'slide_text[' + (num_slides) + ']');
				$('#slide-section-' + num_slides).find('[name="test_image_old"]').attr('onclick', 'file_manager(\'slide_image[' + (num_slides) + ']\')');
				$('#slide-section-' + num_slides).find('[name="test_image_old"]').attr('name', 'slide_image[' + (num_slides) + ']_old');
				$('.results').hide();
				$('#slide-section-' + num_slides).show();
				$('.delete-slide').unbind('click.delete_slide');
				$('.delete-slide').bind('click.delete_slide',function(e){
					var slide = $(this).attr('slide');
					$('#slide-section-' + slide).remove();
					$("#image-selection option[value='slide-section-" + slide + "']").remove();
					$('#image-selection').val($('#image-selection option:first').val()).change();
				});
				$('#image-selection').val('slide-section-' + (num_slides++));
				new_slide_number++;
			});

			$('#image-selection').on('change',function(){
				console.log($(this).val());
				$('.results').hide();
				$('#' + $(this).val()).show();
			}).change();

		});
		</script>
		<style>
		#settings-content .form-group
		{
			margin-left:0px !important;
			width:90% !important;
		}
		.hide{
			display:none;
		}
		.active{
			display:block;
		}

		.left{
			width:50%;
			float:left;
		}
		.left .form-group{
			width:90% !important;
		}
		.right{
			width:50%;
			float:left;
		}
		.results{
			margin-top:10px;
		}
		#block-admin-save{
			position:absolute;
			bottom:150px;
			right:100px;
			z-index:20000;
		}
		.del-image{
			position: absolute !important;
			top: -35px !important;
			right: 280px !important;
		}
		.fileinput-button{
			margin-top:20px !important;
		}
		.profile-avatar{
			width:350px !important;
			max-width: 350px !important;
			margin-left:-12px !important;
		}
		.profile-avatar img{
			width:400px !important;
		}
		</style>
		<span id="add-slide" class="btn btn-lg btn-success bepopup-p-add" style="width:200px;width: 200px;display:block;float:left;margin-top: 15px;"><i class="fa fa-plus"></i> Add New Image</span>
		<?$i = 1;?>
		<div class="col-lg-6" style="width:20%;float:left;">
			<label>Slide Selection</label>
			<select id="image-selection" class="form-control" name="slides">
				<?php foreach($slide_titles as $key => $slide_title):?>
					<option value="slide-section-<?=$i?>">Image <?=$i?></option>
					<?$i++;?>
				<?php endforeach; ?>
			</select>		
		</div>
		<div class="tab-content col-lg-6 col-md-6 col-sm-12 col-xs-12" id="slide-sections">
			<!-- Template for creation -->
			<div class="results" id="slide-section-template">
				<div class="left">
					<?php
					$this->admin_input('test_title','text','Category: ', '');
					$this->admin_file('test_image','Image: ', '','test',false);
					?>
				</div>
				<div class="right">
					<div class="form-group del-image">
						<span style="margin-left:25px" class="btn btn-danger delete-slide" slide="template"><i class="fa fa-trash"></i> Delete This Image</span>
					</div>
					<?
					$this->admin_input('test_url','text','Link Address (disabled): ', '');
					$this->admin_textarea('test_text','Image Description: ', '');
					?>
				</div>
			</div>
			<!-- /Template for creation -->
			<?$i = 1;?>
			<?php foreach($slide_titles as $key => $slide_title):?>
				<div class="results " style="<?php if($i == 1) echo 'display:block;';else echo 'display:none;';?>" id="slide-section-<?=$i?>">
					<div class="left">
						<?php
						$this->admin_input('slide_title['.$key.']','text','Category: ', $slide_titles[$key]);
						$this->admin_file('slide_image['.$key.']','Image: ', $slide_images[$key],'isotope-grid'.$this->block->get_id().$i, true);
						?>
					</div>
					<div class="right">
						<div class="form-group del-image">
							<span style="margin-left:25px" class="btn btn-danger delete-slide" slide="<?=$i?>"><i class="fa fa-trash"></i> Delete This Image</span>
						</div>
						<?
						$this->admin_input('slide_url['.$key.']','text','Link Address (disabled): ', $slide_url[$key]);
						$this->admin_textarea('slide_text['.$key.']','Image description: ', $slide_texts[$key]);
						?>
					</div>
					<script>
						$("#isotope-grid<?=$this->block->get_id().$i?>").click(function(e){
							e.preventDefault();
						});
					</script>
				</div>
				<?$i++;?>
			<?php endforeach; ?>

			<?php if($num_slides == 0): ?>
				<div class="tab-pane active" id="slide-section-1">
					<?php
					$this->admin_input('slide_title[0]','text','Category: ');
					$this->admin_input('slide_url[0]','text','Link Address (disabled): ');
					$this->admin_textarea('slide_text[0]','Image Description: ');
					$this->admin_file('slide_image[0]','Image: ', '');
					?>
				</div>
			<?php endif;?>
		</div>

		<?php
    }
	public function generate_style()
	{
		$path = substr($_SERVER['SCRIPT_FILENAME'],0,strrpos($_SERVER['SCRIPT_FILENAME'],'/index.php'));
		include FCPATH.'/builderengine/public/animations/animations.php';

		$controls_color = $this->block->data('controls_color');
		$background_color = $this->block->data('background_color');
		$controls_alignment = $this->block->data('controls_alignment');
		$controls_animation_type = $this->block->data('controls_animation_type');
		$controls_animation_duration = $this->block->data('controls_animation_duration');
		$controls_animation_event = $this->block->data('controls_animation_event');
		$controls_animation_delay = $this->block->data('controls_animation_delay');

		$images_animation_type = $this->block->data('images_animation_type');
		$images_animation_duration = $this->block->data('images_animation_duration');
		$images_animation_event = $this->block->data('images_animation_event');
		$images_animation_delay = $this->block->data('images_animation_delay');
		$alignments = array('left' => 'left','right' => 'right');
		?>
		<div role="tabpanel">

			<ul class="nav nav-tabs" role="tablist" style="margin-left: -20px;">
				<li role="presentation" class="active"><a href="#controls" aria-controls="title" role="tab" data-toggle="tab">Controls</a></li>
				<li role="presentation"><a href="#images" aria-controls="text1" role="tab" data-toggle="tab">Images</a></li>
				<li role="presentation"><a href="#customcss" aria-controls="customcss" role="tab" data-toggle="tab">Custom</a></li>
			</ul>

			<div class="tab-content">
				<div role="tabpanel" class="tab-pane fade in active" id="controls">
					<?php
					$this->admin_input('controls_color','text', 'Font color: ', $controls_color);
					$this->admin_input('background_color','text', 'Background color: ', $background_color);
					$this->admin_select('controls_alignment', $alignments,'Alignment: ',$controls_alignment);
					$this->admin_select('controls_animation_type', $types,'Animation type: ',$controls_animation_type);
					$this->admin_select('controls_animation_duration', $durations,'Animation duration: ',$controls_animation_duration);
					$this->admin_select('controls_animation_event', $events,'Animation Start: ',$controls_animation_event);
					$this->admin_select('controls_animation_delay', $delays,'Animation Delay: ',$controls_animation_delay);
					?>
				</div>
				<div role="tabpanel" class="tab-pane fade" id="images">
					<?php
					$this->admin_select('images_animation_type', $types,'Animation type: ',$images_animation_type);
					$this->admin_select('images_animation_duration', $durations,'Animation duration: ',$images_animation_duration);
					$this->admin_select('images_animation_event', $events,'Animation Start: ',$images_animation_event);
					$this->admin_select('images_animation_delay', $delays,'Animation Delay: ',$images_animation_delay);
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

	public function load_generic_styling()
	{
		$background_color = $this->block->data('background_color');

		$style_arr = $this->block->data("style");
		$style_arr['background-color'] = $background_color;
		$this->block->set_data("style", $style_arr);
	}

	public function get_images()
	{
		global $active_controller;
		$default_images = array();
		$real_path = $_SERVER['DOCUMENT_ROOT'].'/themes/'.$active_controller->BuilderEngine->get_frontend_theme().'/blocks/photo_gallery_grid/';
		$theme_path = str_replace(base_url(), '', get_theme_path());
		$theme_images_path = $theme_path.'blocks/photo_gallery_grid';

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
		$slide_titles = $this->block->data('slide_title');
		if(!is_array($slide_titles) || empty($slide_titles))
		{
			$base_url = base_url();
			$this->block->force_data_modification();

			$theme_images = $this->get_images();
			if(!empty($theme_images)){
				$slide_titles = array();
				$slide_urls = array();
				$slide_images = array();
				$slide_texts = array();
				$num_slides = count($theme_images);
				$slide_images = $theme_images;
				for($x = 1; $x <= $num_slides; $x++){
					if($x >= 1 && $x <= 2)
						$num = 1;
					if($x >= 3 && $x <= 4)
						$num = 2;
					if($x >= 5 && $x <= 6)
						$num = 3;
					if($x > 6)
						$num = 4;
					array_push($slide_titles, $num);
					array_push($slide_texts, 'Gallery Image #'.$x);
					array_push($slide_urls, '#');
				}
				$this->block->set_data('slide_title', $slide_titles);
				$this->block->set_data('slide_url', $slide_urls);
				$this->block->set_data('slide_image', $slide_images);
				$this->block->set_data('slide_text', $slide_texts);
			}else{
				$this->block->set_data('slide_title', array("2","4","3","1","2","4","3","1","1","4","3","2"));
				$this->block->set_data('slide_url', array("#","#","#","#","#","#","#","#","#","#","#","#"));
				$this->block->set_data('slide_image', array($base_url."blocks/photo_gallery_grid/images/ss_be_1.jpg",$base_url."blocks/photo_gallery_grid/images/ss_be_2.jpg",$base_url."blocks/photo_gallery_grid/images/ss_be_3.jpg",$base_url."blocks/photo_gallery_grid/images/ss_be_4.jpg",$base_url."blocks/photo_gallery_grid/images/ss_be_5.jpg",$base_url."blocks/photo_gallery_grid/images/ss_be_6.jpg",$base_url."blocks/photo_gallery_grid/images/ss_be_7.jpg",$base_url."blocks/photo_gallery_grid/images/ss_be_8.jpg",$base_url."blocks/photo_gallery_grid/images/ss_be_9.jpg",$base_url."blocks/photo_gallery_grid/images/ss_be_10.jpg",$base_url."blocks/photo_gallery_grid/images/ss_be_11.jpg",$base_url."blocks/photo_gallery_grid/images/ss_be_12.jpg"));
				$this->block->set_data('slide_text', array("Gallery Image #1","Gallery Image #2","Gallery Image #3","Gallery Image #4","Gallery Image #5","Gallery Image #6","Gallery Image #7","Gallery Image #8","Gallery Image #9","Gallery Image #10","Gallery Image #11","Gallery Image #12"));
			}
		}
		return $this->output_isotope_grid();
	}
	
    public function output_isotope_grid()
    {
		global $active_controller;
		$CI = &get_instance();
		$CI->load->module('layout_system');

		$custom_css = $this->block->data('custom_css');
		$style_arr['text'] = ';'.$custom_css;
		$this->block->set_data("style", $style_arr);

		$this->load_generic_styling();
		$controls_color = $this->block->data('controls_color');
		$controls_alignment = $this->block->data('controls_alignment');

		$controls_animation_type = $this->block->data('controls_animation_type');
		$controls_animation_duration = $this->block->data('controls_animation_duration');
		$controls_animation_event = $this->block->data('controls_animation_event');
		$controls_animation_delay = $this->block->data('controls_animation_delay');

		$images_animation_type = $this->block->data('images_animation_type');
		$images_animation_duration = $this->block->data('images_animation_duration');
		$images_animation_event = $this->block->data('images_animation_event');
		$images_animation_delay = $this->block->data('images_animation_delay');

		$slide_titles = $this->block->data('slide_title');
		$slide_url = $this->block->data('slide_url');
		$slide_images = $this->block->data('slide_image');
		$slide_texts = $this->block->data('slide_text');

		$settings = array();

		$i = 1;
		foreach($slide_titles as $key => $slide_title)
		{
			$controls_settings[0] = 'controls'.$this->block->get_id();
			$controls_settings[1] = $controls_animation_event;
			$controls_settings[2] = $controls_animation_duration.' '.$controls_animation_delay.' '.$controls_animation_type;
			array_push($settings,$controls_settings);
			$images_settings[0] = 'ajax-isotope-grid-'.$this->block->get_id();
			$images_settings[1] = $images_animation_event;
			$images_settings[2] = $images_animation_duration.' '.$images_animation_delay.' '.$images_animation_type;
			array_push($settings,$images_settings);

			$i++;
		}

		add_action("be_foot", generate_animation_events($settings));

		$controls_style =
				'style="
                    color: '.$controls_color.' !important;
                "';
		$controls_holder_style =
				'style="
					float: '.$controls_alignment.' !important;
                "';

		//$slide_images = $this->get_images();

		$output = '
		<div class="photo-gallery-container-'.$this->block->get_id().'">
			<link href="'.base_url('builderengine/public/filterizr_lightbox/lightbox.css').'" rel="stylesheet">
			<div class="">
				<div class="col-md-12">
					<div class="gallerymenu">
						<ul class="simplefilter" '.$controls_holder_style.' id="controls'.$this->block->get_id().'">
							<li '.$controls_style.' class="active btn-success radius gallerybuttons" data-filter="all">Show All</li>
							<li '.$controls_style.' class="btn-colors radius gallerybuttons" data-filter="1">Gallery #1</li>
							<li '.$controls_style.' class="btn-colors radius gallerybuttons" data-filter="2">Gallery #2</li>
							<li '.$controls_style.' class="btn-colors radius gallerybuttons" data-filter="3">Gallery #3</li>
							<li '.$controls_style.' class="btn-colors radius gallerybuttons" data-filter="4">Gallery #4</li>
						</ul>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12" style="padding:10px;">
					<div class="filtr-container" id="isotope-grid-'.$this->block->get_id().'">';
						$i = 1;
						foreach($slide_titles as $key => $slide_title){
							$output .='
							<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 filtr-item radius" data-category="'.$slide_titles[$key].'">
								<div class="image available-themes gallery-group-5">
									<div class="image-inner">
										<a href="'.checkImagePath($slide_images[$key]).'" data-lightbox="'.$slide_texts[$key].'" data-title="'.$slide_texts[$key].'">
											<img class="img-responsive gallerythumbnails" src="'.checkImagePath($slide_images[$key]).'" />
										</a>
									</div>
								</div>
							</div>';
							$i++;
						}
						$output .='
						</div>
					</div>
				</div>
			</div>
			<script src="'.base_url('builderengine/public/filterizr_lightbox/filterizr.js').'"></script>
				<script src="'.base_url('builderengine/public/filterizr_lightbox/lightbox.js').'"></script>
				<script type="text/javascript">
					$(function(){
						$(".filtr-container").each(function(){
							var elementId = $(this).attr("id");
							$("#" + elementId).filterizr();
						});
					});
					lightbox.option({
					  "resizeDuration": 200,
					  "wrapAround": true,
					  "disableScrolling": true,
					  "maxWidth":1600,
					  "maxHeight":880,
					  "fitImagesInViewport": true,
					  //"positionFromTop":30
					});	
			</script>
		</div>
		';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'photo-gallery-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), 'with_settings');
		else
			return $output;
    }
}
?>