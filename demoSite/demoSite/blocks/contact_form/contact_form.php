<?php 	class contact_form_block_handler extends  block_handler{
		function info()
		{
			$info['category_name'] = "Content Blocks";
			$info['category_icon'] = "dsf";

			$info['block_name'] = "Contact Form";
			$info['block_icon'] = "fa-envelope-o public";
			
			return $info;
		}
		public function generate_admin()
		{
            $field_name = $this->block->data('field_name');
            $field_required = $this->block->data('field_required');

            $email_destination = $this->block->data('email_destination');
            $email_title = $this->block->data('email_title');
            $email_active = $this->block->data('email_active');
            $captcha_active = $this->block->data('captcha_active');

            if(!is_array($field_name) || empty($field_name))
            {
                $field_name[0] = "Name";
                $field_required[0] = "yes";

                $field_name[1] = "Email";
                $field_required[1] = "yes";

                $field_name[2] = "Phone";
                $field_required[2] = "yes";

                $field_name[3] = "Message";
                $field_required[3] = "yes";
            }
            $num_slides = count($field_name);
            end($field_name);
            $last_key = key($field_name) + 1;
            reset($field_name);
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
                        $("#slide-section-tabs").append('<li id="slide-section-tab-' + num_slides +'"><a class="bepopup-p-buttons" href="#slide-section-' + num_slides + '" data-toggle="tab">Field ' + num_slides + '</a></li>');
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
                        $('#slide-section-' + num_slides).find('[name="test_name"]').attr('name', 'field_name[' + (new_slide_number) + ']');
                        $('#slide-section-' + num_slides).find('[name="test_required"]').attr('name', 'field_required[' + (new_slide_number) + ']');
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
                <li><span id="add-slide" class="btn btn-lg btn-default bepopup-p-add">Add New Field Option</span></li>
                <li><a class="bepopup-p-buttons" href="#settings" data-toggle="tab">Contact Settings</a></li>
                <?php $i = 1;?>
                <?php foreach($field_name as $key => $element): ?>
                    <li class="<?php if($i == 1) echo 'active'?>" id="slide-section-tab-<?=$i?>"><a class="bepopup-p-buttons" href="#slide-section-<?=$i?>" data-toggle="tab">Field <?=$i?></a></li>
                <?php $i++;?>
                <?php endforeach; ?>
                <?php if($num_slides == 0): ?>
                    <li class="active"><a class="bepopup-p-buttons" href="#slide-section-1" data-toggle="tab">Field 1</a></li>
                <?php endif;?>
            </ul>
            <div class="tab-content col-lg-6 col-md-6 col-sm-12 col-xs-12" id="slide-sections">
                <!-- Template for creation -->
                <div class="tab-pane" id="slide-section-template">
                    <?php
                    $this->admin_input('test_name','text','Field name: ', '');
                    $this->admin_input('test_required','text','Field required: ', '');
                    ?>
                    <div class="form-group">
                        <span class="btn btn-danger delete-slide" slide="template">Delete This Field Option</span>
                    </div>
                </div>
                <!-- /Template for creation -->
                <div class="tab-pane" id="settings">
                    <?php
                    $bool_options = array(
                        "yes" => "Yes",
                        "no" => "No"
                    );
                    $this->admin_input('email_destination','text', 'Destination email: ', $email_destination);
                    $this->admin_input('email_title','text', 'Email title: ', $email_title);
                    $this->admin_select('email_active', $bool_options, 'Contact form active: ', $email_active);
                    $this->admin_select('captcha_active', $bool_options, 'Captcha: ', $captcha_active);
                    ?>
                </div>
                <?php $i = 1;?>
                <?php foreach($field_name as $key => $element): ?>
                    <div class="tab-pane <?php if($i == 1) echo 'active'?>" id="slide-section-<?=$i?>">
                        <?php
                        $this->admin_input('field_name['.$key.']','text','Field name: ', $field_name[$key]);
                        $this->admin_input('field_required['.$key.']','text','Field required: ', $field_required[$key]);
                        ?>
                        <div class="form-group">
                            <span class="btn btn-danger delete-slide" slide="<?=$i?>">Delete This Field Option</span>
                        </div>
                    </div>
                    <?php $i++;?>
                <?php endforeach; ?>


                <?php if($num_slides == 0): ?>
                    <div class="tab-pane active" id="slide-section-1">
                        <?php
                        $this->admin_input('field_name[0]','text','Field name: ');
                        $this->admin_input('field_required[0]','text','Field required: ');
                        ?>
                    </div>
                <?php endif;?>
            </div>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			</div>
            <?php


            ?>
            <?/*<link href="<?=get_theme_path()?>css/bootstrap.min.css" rel="stylesheet">
            <div role="tabpanel">

                <ul class="nav nav-tabs" role="tablist" style="margin-left: -20px;">
                    <li role="presentation" class="active"><a href="#field_1" aria-controls="field_1" role="tab" data-toggle="tab">Field 1</a></li>
                    <li role="presentation"><a href="#field_2" aria-controls="field_2" role="tab" data-toggle="tab">Field 2</a></li>
                    <li role="presentation"><a href="#field_3" aria-controls="field_3" role="tab" data-toggle="tab">Field 3</a></li>
                    <li role="presentation"><a href="#field_4" aria-controls="field_4" role="tab" data-toggle="tab">Field 4</a></li>
                    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
                </ul>

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade" id="settings">

                    </div>
                </div>

            </div>*/?>
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

			$single_element = '';
			//generic animations
			$this->load_generic_styles();

            $field_name = $this->block->data('field_name');
            $field_required = $this->block->data('field_required');

            $email_destination = $this->block->data('email_destination');
            $email_title = $this->block->data('email_title');
            $email_active = $this->block->data('email_active');
            $captcha_active = $this->block->data('captcha_active');

            if(!is_array($field_name) || empty($field_name))
            {
                $field_name[0] = "Name";
                $field_required[0] = "yes";

                $field_name[1] = "Email";
                $field_required[1] = "yes";

                $field_name[2] = "Phone";
                $field_required[2] = "yes";

                $field_name[3] = "Message";
                $field_required[3] = "yes";
            }


            if($email_title == '')
                $email_title = 'Message submitted in '.base_url().' contact form';


			$error = '';
			$info = '';

            if(isset($_POST['contactform'.$this->block->get_id()]))
            {
				unset($_POST['contactform'.$this->block->get_id()]);
                if($email_active != 'no')
                {
                    $to = $email_destination;
                    $title = $email_title;
                    $message = "
                    Contact form message received:";
                    $count = 1;
					if($captcha_active == 'yes' && isset($_POST['captcha'])){
						if($_POST['captcha'] == $_SESSION['captcha'.$this->block->get_id()]){
							unset($_SESSION['captcha'.$this->block->get_id()]);
							unset($_POST['captcha']);
							foreach ($_POST as $field_name => $field_value)
							{
								if($field_value == '')
									$field_value = '[empty]';
								if($count == 1)
									$message .= "\n\n".str_replace('_', ' ', ucwords($field_name)). ": ".$field_value;
								else
									$message .= "\n".str_replace('_', ' ', ucwords($field_name)). ": ".$field_value;

								$count++;
							}
							$message .= "\n\n".base_url();

							mail($to, $title, $message);
							$info = 'Message Sent Successfully !';
						}else{
							$error = 'Wrong captcha ! ';
						}
					}else{
						foreach ($_POST as $field_name => $field_value)
						{
							if($field_value == '')
								$field_value = '[empty]';
							if($count == 1)
								$message .= "\n\n".str_replace('_', ' ', ucwords($field_name)). ": ".$field_value;
							else
								$message .= "\n".str_replace('_', ' ', ucwords($field_name)). ": ".$field_value;

							$count++;
						}
						$message .= "\n\n".base_url();

						mail($to, $title, $message);
						$info = 'Message Sent Successfully !';
					}
                }
            }

			$output = '
				<div id="contact-form-container-'.$this->block->get_id().'">
				<div class="row">
				<div id="form'.$this->block->get_id().'" style="" class="col-md-12 form-col" data-animation="true" data-animation-type="fadeInRight">
                    <form id="forms'.$this->block->get_id().'" class="form-horizontal be-block-contact-horizontal" method="post">';

                $i = 1;
                foreach($field_name as $key => $element)
                {
                        $output .= '
                            <div class="form-group">
                                <label style="" class="control-label col-md-3">' . $field_name[$key];
                        if ($field_required[$key] == 'yes')
                            $output .= ' <span class="text-theme">*</span>';
                        $output .= '
                                </label>
                                <div class="col-md-9">
                                    <input id="' . str_replace(' ', '_', $field_name[$key]) . $this->block->get_id() . '" type="text" name="' . strtolower(str_replace(' ', '_', $field_name[$key])) . '" class="form-control form-control-be-40"';
                        if ($field_required[$key] == 'yes')
                            $output .= ' required';
                        $output .= ' />
                                </div>
                            </div>';
                }
                    if($captcha_active != 'no'){
                        $output .= '
                            <div class="form-group">
                                <div class="col-md-3 control-label">
                                    <label style="" class="control-label capup">Captcha <span class="text-theme">*</span></label>
                                </div>
                                <div class="col-md-4">
                                    <input required class="form-control form-control-be-40 input-lg" type="text" name="captcha" id="captcha" />
                                </div>
                                <div class="col-md-5">
                                    <span class="captchaImg" id="captchaImg'.$this->block->get_id().'">'.$this->createCaptcha($this->block->get_id()).'</span>
                                </div>
							</div>';
							$output .='
							<div id="error'.$this->block->get_id().'" class="alert alert-warning alert-dismissible col-md-9 col-md-offset-3" role="alert" style="display:none;margin-left:25.5%;">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  <i class="fa fa-info-circle" style="font-size:18px;"></i> <strong> Wrong Captcha !</strong>
							</div>
							';
                    }

						$output .='
						<div id="info'.$this->block->get_id().'" class="alert alert-success alert-dismissible col-md-9 col-md-offset-3" role="alert" style="display:none;margin-left:25.5%;">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  <i class="fa fa-info-circle" style="font-size:18px;"></i> <strong> Message Sent Successfully ! </strong>
						</div>
						';

                        $output .= '
						<input type="hidden" name="cap" value="'.$this->block->get_id().'" />
						<input type="hidden" name="emailDestination" value="'.$email_destination.'" />
						<input type="hidden" name="emailTitle" value="'.$email_title.'" />
						<input type="hidden" name="captchaActive" value="'.$captcha_active.'" />
						<input type="hidden" name="emailActive" value="'.$email_active.'" />
                        <div class="form-group">
                            <label style="" class="control-label col-md-3"></label>
                            <div class="col-md-9 text-left">
                                <button id="submit'.$this->block->get_id().'" name="contactform'.$this->block->get_id().'" type="submit" class="btn btn-colors btn-xl btn-block"';
                                if($email_active == 'no')
                                    $output .= 'style="pointer-events:none !important; background: rgb(165, 164, 164);border: 1px solid rgb(165, 164, 164);"';
                                $output .= '>Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
			</div>
			</div>
			<script>
			$(function () {
				$("#submit'.$this->block->get_id().'").click( function (e) {
				  e.preventDefault();';
                    foreach($field_name as $key => $element)
                    {
                        $output .= '
                        var field_'.$key.'_name = $.trim($("#'.str_replace(' ', '_', $field_name[$key]).$this->block->get_id().'").val());
					    var field_'.$key.'_required = "'.$field_required[$key].'";';
                    }
                    foreach($field_name as $key => $element)
                    {
                        $output .= '
                        if (field_'.$key.'_name  === "" && field_'.$key.'_required === "yes") {
                            alert("'.$field_name[$key].' field is empty.");
                            return false;
                        }
                        ';
                    }
            $output .= '

				  $.ajax({
					type: "post",
					url: "'.base_url('/admin/ajax/send_email').'",
					data: $("#forms'.$this->block->get_id().'").serialize(),
					success: function (data) {
					    if(data == "true"){
							$("#error'.$this->block->get_id().'").css("display","none");
							$("#info'.$this->block->get_id().'").show();
					    }else{
							$("#info'.$this->block->get_id().'").css("display","none");
							$("#error'.$this->block->get_id().'").show();
						}
						$("#forms'.$this->block->get_id().'")[0].reset();						
					}
				  });
				});
			});
			</script>
	        ';
			if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
				$menu ='with_settings_global';
			else
				$menu ='with_settings';
			if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
				return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'contact-form-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
			else
				return $output;
		}
	}
?>