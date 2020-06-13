<?php 	class antispam_contact_form_block_handler extends  block_handler{
		function info()
		{
			$info['category_name'] = "Content Blocks";
			$info['category_icon'] = "dsf";

			$info['block_name'] = "Antispam Contact Form";
			$info['block_icon'] = "fa-envelope-o public";
			
			return $info;
		}
		public function generate_admin()
		{
            $field1_name = $this->block->data('field1_name');
            $field1_active = $this->block->data('field1_active');
            $field1_required = $this->block->data('field1_required');

            $field2_name = $this->block->data('field2_name');
            $field2_active = $this->block->data('field2_active');
            $field2_required = $this->block->data('field2_required');

            $field3_name = $this->block->data('field3_name');
            $field3_active = $this->block->data('field3_active');
            $field3_required = $this->block->data('field3_required');

            $field4_name = $this->block->data('field4_name');
            $field4_active = $this->block->data('field4_active');
            $field4_required = $this->block->data('field4_required');

            $email_destination = $this->block->data('email_destination');
            $email_title = $this->block->data('email_title');
            $email_active = $this->block->data('email_active');

            ?>
            <link href="<?=get_theme_path()?>css/bootstrap.min.css" rel="stylesheet">
            <div role="tabpanel">

                <ul class="bwizard-steps" role="tablist" style="margin-left: -20px;">
                    <li role="presentation" class="active"><a class="bepopup-p-buttons" href="#field_1" aria-controls="field_1" role="tab" data-toggle="tab">Field 1</a></li>
                    <li role="presentation"><a class="bepopup-p-buttons" href="#field_2" aria-controls="field_2" role="tab" data-toggle="tab">Field 2</a></li>
                    <li role="presentation"><a class="bepopup-p-buttons" href="#field_3" aria-controls="field_3" role="tab" data-toggle="tab">Field 3</a></li>
                    <li role="presentation"><a class="bepopup-p-buttons" href="#field_4" aria-controls="field_4" role="tab" data-toggle="tab">Field 4</a></li>
                    <li role="presentation"><a class="bepopup-p-buttons" href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Contact Settings</a></li>
                </ul>

                <div class="tab-content col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <?php
                    $bool_options = array(
                        "yes" => "Yes",
                        "no" => "No"
                        );
                    ?>
                    <div role="tabpanel" class="tab-pane fade in active" id="field_1">
                        <?php
                        $this->admin_input('field1_name','text', 'Name: ', $field1_name);
                        $this->admin_select('field1_active', $bool_options, 'Active: ', $field1_active);
                        $this->admin_select('field1_required', $bool_options, 'Required: ', $field1_required);
                        ?>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="field_2">
                        <?php
                        $this->admin_input('field2_name','text', 'Name: ', $field2_name);
                        $this->admin_select('field2_active', $bool_options, 'Active: ', $field2_active);
                        $this->admin_select('field2_required', $bool_options, 'Required: ', $field2_required);
                        ?>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="field_3">
                        <?php
                        $this->admin_input('field3_name','text', 'Name: ', $field3_name);
                        $this->admin_select('field3_active', $bool_options, 'Active: ', $field3_active);
                        $this->admin_select('field3_required', $bool_options, 'Required: ', $field3_required);
                        ?>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="field_4">
                        <?php
                        $this->admin_input('field4_name','text', 'Name: ', $field4_name);
                        $this->admin_select('field4_active', $bool_options, 'Active: ', $field4_active);
                        $this->admin_select('field4_required', $bool_options, 'Required: ', $field4_required);
                        ?>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="settings">
                        <?php
                        $this->admin_input('email_destination','text', 'Destination email: ', $email_destination);
                        $this->admin_input('email_title','text', 'Email title: ', $email_title);
                        $this->admin_select('email_active', $bool_options, 'Contact form active: ', $email_active);
                        ?>
                    </div>
                </div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				</div>
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
			
			$single_element = '';
			//generic animations
			$this->load_generic_styling();

            $field1_name = $this->block->data('field1_name');
            $field1_active = $this->block->data('field1_active');
            $field1_required = $this->block->data('field1_required');

            $field2_name = $this->block->data('field2_name');
            $field2_active = $this->block->data('field2_active');
            $field2_required = $this->block->data('field2_required');

            $field3_name = $this->block->data('field3_name');
            $field3_active = $this->block->data('field3_active');
            $field3_required = $this->block->data('field3_required');

            $field4_name = $this->block->data('field4_name');
            $field4_active = $this->block->data('field4_active');
            $field4_required = $this->block->data('field4_required');

            $email_destination = $this->block->data('email_destination');
            $email_title = $this->block->data('email_title');
            $email_active = $this->block->data('email_active');

			//$form_animation_type = $this->block->data('form_animation_type');	  
		    //$form_animation_duration = $this->block->data('form_animation_duration');
		    //$form_animation_event = $this->block->data('form_animation_event');
		    //$form_animation_delay = $this->block->data('form_animation_delay');
			//$settings[0][0] = 'form'.$this->block->get_id();
			//$settings[0][1] = $form_animation_event;
			//$settings[0][2] = $form_animation_duration.' '.$form_animation_delay.' '.$form_animation_type;
			//add_action("be_foot", generate_animation_events($settings));
			
            if($field1_name == '')
                $field1_name = 'Name';
            if($field2_name == '')
                $field2_name = 'Email';
            if($field3_name == '')
                $field3_name = 'Phone';
            if($field4_name == '')
                $field4_name = 'Message';
            if($email_title == '')
                $email_title = 'Message submitted in '.base_url().' contact form';


			$error = '';
			$info = '';
			$code = '';
			$data = uniqid(microtime(), true);

			if (function_exists('hash')) {
				$code = hash('sha256', $data);
			} else {
				$code = sha1($data);
			}

			$_SESSION['code'.$this->block->get_id()] = $code;
			$str_num1 = rand(1,20);
			$str_num2 = rand(1,20);
			$_SESSION['answer'.$this->block->get_id()] = $str_num1 + $str_num2;

			$output = '
				<div id="antispam-contact-form-container-'.$this->block->get_id().'" class="block-colors-light">
				<div class="row">
				<div id="form'.$this->block->get_id().'" style="" class="col-md-12 form-col" data-animation="true" data-animation-type="fadeInRight">
                    <form id="forms'.$this->block->get_id().'" class="form-horizontal be-block-contact-horizontal" method="post">
						<input id="code'.$this->block->get_id().'" type="text" name="'.$code.'" value="" style="display:none">';
                    if($field1_active != 'no')
                    {
                        $output .= '
                        <div class="form-group">
                            <label style="" class="control-label col-md-3">'.$field1_name;
                            if($field1_required == 'yes')
                                $output .= ' <span class="text-theme">*</span>';
                            $output .= '
                            </label>
                            <div class="col-md-9">
                                <input id="'.$field1_name.$this->block->get_id().'" type="text" name="'.strtolower(str_replace(' ', '_', $field1_name)).'" class="form-control form-control-be-40"';
                            if($field1_required == 'yes')
                                $output .= ' required';
                            $output .= ' />
                            </div>
                        </div>';
                    }
                    if($field2_active != 'no')
                    {
                        $output .= '
                        <div class="form-group">
                            <label style="" class="control-label col-md-3">'.$field2_name;
                            if($field2_required == 'yes')
                                $output .= ' <span class="text-theme">*</span>';
                            $output .= '
                            </label>
                            <div class="col-md-9">
                                <input id="'.$field2_name.$this->block->get_id().'" type="email" name="'.strtolower(str_replace(' ', '_', $field2_name)).'" class="form-control form-control-be-40"';
                            if($field2_required == 'yes')
                                $output .= ' required';
                            $output .= ' />
                            </div>
                        </div>';
                    }
                    if($field3_active != 'no')
                    {
                        $output .= '
                        <div class="form-group">
                            <label style="" class="control-label col-md-3">'.$field3_name;
                            if($field3_required == 'yes')
                                $output .= ' <span class="text-theme">*</span>';
                            $output .= '
                            </label>
                            <div class="col-md-9">
                                <input id="'.$field3_name.$this->block->get_id().'" type="text" name="'.strtolower(str_replace(' ', '_', $field3_name)).'" class="form-control form-control-be-40"';
                            if($field3_required == 'yes')
                                $output .= ' required';
                            $output .= ' />
                            </div>
                        </div>';
                    }
                    if($field4_active != 'no')
                    {
                        $output .= '
                        <div class="form-group">
                            <label style="" class="control-label col-md-3">'.$field4_name;
                            if($field4_required == 'yes')
                                $output .= ' <span class="text-theme">*</span>';
                            $output .= '
                            </label>
                            <div class="col-md-9">
                                <textarea id="'.$field4_name.$this->block->get_id().'" class="form-control form-control-be-40" name="'.strtolower(str_replace(' ', '_', $field4_name)).'" rows="5"';
                            if($field4_required == 'yes')
                                $output .= ' required ';
                            $output .= '
                            ></textarea>
                            </div>
                        </div>';
                    }
					$link = base_url();
					if(isset($_SERVER['HTTP_REFERER']))
						$link = $_SERVER['HTTP_REFERER'];
						$output .='
						<div class="form-group">
							<label class="control-label col-md-3">
								'.$str_num1.' + '.$str_num2.' = <span class="text-theme">*</span>
							</label>
							<div class="col-md-9">
								<input type="text" id="answer'.$this->block->get_id().'" name="answer'.$this->block->get_id().'" class="form-control form-control-be-40" value="" required />
							</div>
						</div>

						<div id="error'.$this->block->get_id().'" class="alert alert-warning alert-dismissible col-md-9 col-md-offset-3" role="alert" style="display:none;margin-left:25.5%;">
						  <!--<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
						  <i class="fa fa-info-circle" style="font-size:18px;"></i> <strong> Oops,wrong Answer !</strong>
						  <a href="'.$link.'" class="btn btn-xs btn-colors animated flipInX"><i class="fa fa-refresh"></i> Reload the form </a>&nbsp;&nbsp;
						</div>
						<div id="info'.$this->block->get_id().'" class="alert alert-success alert-dismissible col-md-9 col-md-offset-3 animated fadeInRight" role="alert" style="display:none;margin-left:25.5%;">
						  <!--<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
						  <i class="fa fa-info-circle" style="font-size:18px;"></i> <strong> Message Sent Successfully ! </strong>
						</div>

						<input type="hidden" name="emailDestination" value="'.$email_destination.'" />
						<input type="hidden" name="emailTitle" value="'.$email_title.'" />
						<input type="hidden" name="emailActive" value="'.$email_active.'" />
						<input type="hidden" name="bid" value="'.$this->block->get_id().'" />
                        <div class="form-group">
                            <label style="" class="control-label col-md-3"></label>
                            <div class="col-md-9 text-left">
                                <button id="submit'.$this->block->get_id().'" name="antispamcontactform'.$this->block->get_id().'" type="submit" class="btn btn-colors btn-xl btn-block"';
                                if($email_active == 'no')
                                    $output .= 'style="pointer-events:none !important; background: rgb(165, 164, 164);border: 1px solid rgb(165, 164, 164);"';
                                $output .= '>Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
			</div>
			
			<script>
			$(function () {
				$("#submit'.$this->block->get_id().'").click( function (e) {
				  e.preventDefault();
					var first = $.trim($("#'.$field1_name.$this->block->get_id().'").val());
					var firstReq = "'.$field1_required.'";
					var second = $.trim($("#'.$field2_name.$this->block->get_id().'").val());
					var secondReq = "'.$field2_required.'";
					var third = $.trim($("#'.$field3_name.$this->block->get_id().'").val());
					var thirdReq = "'.$field3_required.'";
					var fourth = $.trim($("#'.$field4_name.$this->block->get_id().'").val());
					var fourthReq = "'.$field4_required.'";
					var answer = $.trim($("#answer'.$this->block->get_id().'").val());
					
					if (first  === "" && firstReq === "yes") {
						alert("'.$field1_name.' field is empty.");
						return false;
					}
					if (second  === "" && secondReq === "yes") {
						alert("'.$field2_name.' field is empty.");
						return false;
					}
					if (third  === "" && thirdReq === "yes") {
						alert("'.$field3_name.' field is empty.");
						return false;
					}
					if (fourth  === "" && fourthReq === "yes") {
						alert("'.$field4_name.' field is empty.");
						return false;
					}
					if (answer === "") {
						alert("You must answer the question.");
						return false;
					}

				  $.ajax({
					type: "post",
					url: "'.base_url('/admin/ajax/send_antispam_email').'",
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
						$("#code'.$this->block->get_id().'").val("contactform");
						$(":input").prop("disabled", true);
					}
				  });
				});
			});
			</script>
			</div>
	        ';
			if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
				$menu ='with_settings_global';
			else
				$menu ='with_settings';
			if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
				return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'antispam-contact-form-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
			else
				return $output;
		}
	}
?>