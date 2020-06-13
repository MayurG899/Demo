<?php
class testimonials_block_handler extends  block_handler{
        function info()
        {
            $info['category_name'] = "Content Blocks";
            $info['category_icon'] = "dsf";

            $info['block_name'] = "Testimonials";
            $info['block_icon'] = "fa-envelope-o public";
            
            return $info;
        }
        public function generate_admin()
        {
            $slide_author = $this->block->data('slide_author');
            $slide_author_profession = $this->block->data('slide_author_profession');
            $slide_text = $this->block->data('slide_text');
            $slide_image = $this->block->data('slide_image');
            
            if(!is_array($slide_text) || empty($slide_text))
            {
                $slide_author[0] = "John Doe";
                $slide_author_profession[0] = "Manager";
                $slide_text[0] = "Copy over your client / customer quotes to fill this important section of testimonials,<br>show new visitors why your best, why they should trust you and win them.";
                $slide_image[0] = "/blocks/testimonials/images/userp3.jpg";

                $slide_author[1] = "Joe Doe";
                $slide_author_profession[1] = "Marketing";
                $slide_text[1] = "Copy over your client / customer quotes to fill this important section of testimonials,<br>show new visitors why your best, why they should trust you and win them.";
                $slide_image[1] = "/blocks/testimonials/images/userp1.jpg";

                $slide_author[2] = "Paddy Doe";
                $slide_author_profession[2] = "QA Lead";
                $slide_text[2] = "Copy over your client / customer quotes to fill this important section of testimonials,<br>show new visitors why your best, why they should trust you and win them.";
                $slide_image[2] = "/blocks/testimonials/images/userp2.jpg";
            }
            $num_slides = count($slide_text);
            end($slide_text);
            $last_key = key($slide_text) + 1;
            reset($slide_text);
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
                        $("#slide-section-tabs").append('<li id="slide-section-tab-' + num_slides +'"><a href="#slide-section-' + num_slides + '" data-toggle="tab">Slide ' + num_slides + '</a></li>');
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
                        $('#slide-section-' + num_slides).find('[name="test_auth"]').attr('name', 'slide_author[' + (new_slide_number) + ']');
                        $('#slide-section-' + num_slides).find('[name="test_auth_proff"]').attr('name', 'slide_author_profession[' + (new_slide_number) + ']');
                        $('#slide-section-' + num_slides).find('[name="test_text"]').attr('name', 'slide_text[' + (new_slide_number) + ']');
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
                <li><span id="add-slide" class="btn btn-lg btn-default bepopup-p-add">Add New Testimonial</span></li>
                <?php $i = 1;?>
                <?php foreach($slide_text as $key => $element): ?>
                    <li class="<?php if($i == 1) echo 'active'?>" id="slide-section-tab-<?=$i?>"><a class="bepopup-p-buttons" href="#slide-section-<?=$i?>" data-toggle="tab">Testimonial <?=$i?></a></li>
                <?php $i++;?>
                <?php endforeach; ?>
                <?php if($num_slides == 0): ?>
                    <li class="active"><a class="bepopup-p-buttons" href="#slide-section-1" data-toggle="tab">Testimonial 1</a></li>
                <?php endif;?>
            </ul>
            <div class="tab-content col-lg-6 col-md-6 col-sm-12 col-xs-12" id="slide-sections">
                <!-- Template for creation -->
                <div class="tab-pane" id="slide-section-template">
                    <?php
                    $this->admin_input('test_auth','text','Author: ', '');
                    $this->admin_input('test_auth_proff','text','Author profession: ', '');
                    $this->admin_textarea('test_text','Quotation: ', '');
                    $this->admin_file('test_image','Image: ', '');
                    ?>
                    <div class="form-group">
                        <span class="btn btn-danger delete-slide" slide="template">Delete This Testimonial Option</span>
                    </div>
                </div>
                <!-- /Template for creation -->
                <?php $i = 1;?>
                <?php foreach($slide_text as $key => $element): ?>
                    <div class="tab-pane <?php if($i == 1) echo 'active'?>" id="slide-section-<?=$i?>">
                        <?php
                        $this->admin_input('slide_author['.$key.']','text','Author: ', $slide_author[$key]);
                        $this->admin_input('slide_author_profession['.$key.']','text','Author profession: ', $slide_author_profession[$key]);
                        $this->admin_textarea('slide_text['.$key.']','Quotation: ', $slide_text[$key]);
                        $this->admin_file('slide_image['.$key.']','Image: ', $slide_image[$key]);
                        ?>
                        <div class="form-group">
                            <span class="btn btn-danger delete-slide" slide="<?=$i?>">Delete This Testimonial Option</span>
                        </div>
                    </div>
                    <?php $i++;?>
                <?php endforeach; ?>


                <?php if($num_slides == 0): ?>
                    <div class="tab-pane active" id="slide-section-1">
                        <?php
                        $this->admin_input('slide_author[0]','text','Author: ');
                        $this->admin_input('slide_author_profession[0]','text','Author profession: ');
                        $this->admin_textarea('slide_text[0]','Quotation: ');
                        $this->admin_file('slide_image[0]','Image: ', '');
                        ?>
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
        public function generate_content()
        {
            global $active_controller;
            $CI = &get_instance();
            $CI->load->module('layout_system');

			$content = $this->block->data('content');
			$single_element = '';

			//generic animations
			$this->load_generic_styles();

            $slide_author = $this->block->data('slide_author');
            $slide_author_profession = $this->block->data('slide_author_profession');
            $slide_text = $this->block->data('slide_text');
            $slide_image = $this->block->data('slide_image');

            if(!is_array($slide_text) || empty($slide_text))
            {
                $slide_author[0] = "John Doe";
                $slide_author_profession[0] = "Manager";
                $slide_text[0] = "Copy over your client / customer quotes to fill this important section of testimonials,<br>show new visitors why your best, why they should trust you and win them.";
                $slide_image[0] = "/blocks/testimonials/images/userp3.jpg";

                $slide_author[1] = "Joe Doe";
                $slide_author_profession[1] = "Marketing";
                $slide_text[1] = "Copy over your client / customer quotes to fill this important section of testimonials,<br>show new visitors why your best, why they should trust you and win them.";
                $slide_image[1] = "/blocks/testimonials/images/userp1.jpg";

                $slide_author[2] = "Paddy Doe";
                $slide_author_profession[2] = "QA Lead";
                $slide_text[2] = "Copy over your client / customer quotes to fill this important section of testimonials,<br>show new visitors why your best, why they should trust you and win them.";
                $slide_image[2] = "/blocks/testimonials/images/userp2.jpg";
            }

			//$animation_type = $this->block->data('animation_type');
		    //$animation_duration = $this->block->data('animation_duration');
		    //$animation_event = $this->block->data('animation_event');
		    //$animation_delay = $this->block->data('animation_delay');

			//$settings[0][0] = 'testimonials'.$this->block->get_id();
			//$settings[0][1] = $animation_event;
			//$settings[0][2] = $animation_duration.' '.$animation_delay.' '.$animation_type;
			//add_action("be_foot", generate_animation_events($settings));
            $num_slides = count($slide_text);

            $show_image = $this->block->data('show_image');
            if($show_image == '')
                $show_image = 'yes';
            $title_text = $this->block->data('title_text');
            if($title_text == '')
                $title_text = '';
            // Generate styles
            $title_color = $this->block->data('title_color');
            $title_size = $this->block->data('title_size');
            $quotation_color = $this->block->data('quotation_color');
            $quotation_size = $this->block->data('quotation_size');
            $author_color = $this->block->data('author_color');
            $author_size = $this->block->data('author_size');
            $profession_color = $this->block->data('profession_color');
            $profession_size = $this->block->data('profession_size');
            // Apply styles
            $output = '
			<style>
			.title-color-'.$this->block->get_id().'{
				color: '.$title_color.' !important;
			}
			.title-size-'.$this->block->get_id().'{
				font-size: '.$title_size.' !important;
			}
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
			.profession-color-'.$this->block->get_id().'{
				color: '.$profession_color.' !important;
			}
			.profession-size-'.$this->block->get_id().'{
				font-size: '.$profession_size.' !important;
			}
			.testimonials-image{
			    width: 5%;
                border-radius: 100%;
                margin-left: 1%;
                margin-right: 1%;
			}
			</style>
			';

            $output .= '
			<div id="testimonials-container-'.$this->block->get_id().'" class="block-column-wide-12 block-colors-light">
			<div id="client" class="blockcontent-testimonials has-bg custom-content">
                <div class="content-bg">
                </div>
                <div data-animation="true" data-animation-type="fadeInUp">
                    <h2 id="testimonials'.$this->block->get_id().'" class="content-title title-color-'.$this->block->get_id().' title-size-'.$this->block->get_id().'" style="text-align:inherit;">'.$title_text.'</h2>
                    <div class="carousel testimonials slide" data-ride="carousel" id="testimonials-'.$this->block->get_id().'" style="text-align:inherit;">
                        <div class="carousel-inner text-center" style="color:inherit;text-align:inherit;" role="listbox">';

                        $i = 1;
                        foreach($slide_text as $key => $element)
                        {
                            $output .= '
                            <div class="item';

                            if($i == 1)
                                $output .= ' active';

                            $output .= '" style="text-align:inherit;">
                                <blockquote class="quotation-color-'.$this->block->get_id().' quotation-size-'.$this->block->get_id().'" style="text-align:inherit;">
                                    <i class="fa fa-quote-left" style=""></i>
                                    '.$slide_text[$key].'
                                    <i class="fa fa-quote-right" style=""></i>
                                </blockquote>
                                <div class="name" style="text-align:inherit;">';
                            if($show_image == 'yes')
                            {
                                $output .= '<img class="testimonials-image" src="'.$slide_image[$key].'">';
                            }
                            $output .= '
                                    <span class="text-theme author-color-'.$this->block->get_id().' author-size-'.$this->block->get_id().'" style="text-align:inherit;">'.$slide_author[$key].', </span>
                                    <span class="profession-color-'.$this->block->get_id().' profession-size-'.$this->block->get_id().'">'.$slide_author_profession[$key].'<span>
                                </div>
                            </div>';
                            $i++;
                        }

                        $output .= '
                        </div>
                        <ol class="carousel-indicators">';
                            $i = 0;
                            foreach($slide_text as $key => $element)
                            {
                                $output .= '
                                <li data-target="#testimonials-'.$this->block->get_id().'" data-slide-to="'.$i.'"';

                                if($i == 1)
                                    $output .= 'class="active"';

                                $output .= '
                                ></li>';
                                $i++;
                            }
                        $output .= '
                        </ol>
                    </div>
                </div>
            </div>
			</div>';
			if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
				$menu ='with_settings_global';
			else
				$menu ='with_settings';
			if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
				return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'testimonials-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
			else
				return $output;
        }
    }
?>