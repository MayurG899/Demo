<?php
class Cp_booking_events_add_event_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Account Dashboard";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Account Dashboard Booking Events Add";
        $info['block_icon'] = "fa-envelope-o";

        return $info;
    }

    public function generate_admin()
    {
		$this->show_placeholder();
    }

    public function generate_content()
    {
		//Controller
		global $active_controller;
		$user = &$active_controller->user;
        $CI = & get_instance();
		$this->load_generic_styles();
		$CI->load->module('cp');

		$user_id = $user->id;
		$event_id = $CI->uri->segment(5);
		if($event_id){
			$page = 'Edit';
			$event = new Booking_event($event_id);
		}else{
			$page = 'Add';
			$event = new Booking_event();
		}
		$object = $event;

		if($_POST){//echo '<pre>';print_r($_POST);echo'<br/>';print_r($_FILES);echo '</pre>';exit;
			if(isset($_FILES['image']) && !empty($_FILES['image']['name']) )
			{
				$file_name = $_FILES['image']['name'];
				$file_size =$_FILES['image']['size'];
				$file_tmp = $_FILES['image']['tmp_name'];
				$file_type = $_FILES['image']['type'];   
				$file_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
				$extensions = array("jpeg","jpg","png"); 

				if(in_array($file_ext,$extensions )=== false)
					$errors[] ="This extension is not allowed, please choose a JPEG,JPG or PNG file.";
				if($file_size > 1000000)
					$errors[] ='File size must be less than 1 MB';	
				if(empty($errors)==true){
					if(!is_dir("files/users"))
						mkdir("files/users");
					if(!is_dir("files/users/user_".$user_id))
						mkdir("files/users/user_".$user_id);
					 if(!is_dir("files/users/user_".$user_id."/booking_events"))
						mkdir("files/users/user_".$user_id."/booking_events");
					 if(!is_dir("files/users/user_".$user_id."/booking_events/images"))
						mkdir("files/users/user_".$user_id."/booking_events/images");
					move_uploaded_file($file_tmp, $_SERVER['DOCUMENT_ROOT']."/files/users/user_".$user_id."/booking_events/images/".$file_name);
				
					$_POST['image'] = base_url()."files/users/user_".$user_id."/booking_events/images/".$file_name;
					unset($_FILES['image']);
				}
			}
			elseif(isset($_POST['image1']))
			{
				$_POST['image'] = $_POST['image1'];
			}
			else
				$_POST['image'] = $event->image;
			if(isset($_POST['images'])){
				foreach($_POST['images'] as $k => $v){
					$_POST['images'][$k] = base_url()."files/users/user_".$user_id."/booking_events/images/".$v;
				}
			}

			if(!empty($_POST['zip']))
				$_POST['location'] = $_POST['address'].', '.$_POST['city'].', '.$_POST['zip'].', '.$_POST['country'];
			else
				$_POST['location'] = $_POST['address'].', '.$_POST['city'].', '.$_POST['country'];

			//echo '<pre>';print_r($_POST);echo'<br/>';echo '</pre>';exit;
			$event->create($_POST);
			redirect(base_url('cp/booking/events/list'), 'location');
		}
		//View

			$output ='
			<!-- Start col-10 -->
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<script src="'.base_url('modules/cp/assets/plugins/jquery/jquery-1.9.1.min.js').'"></script>
				<script src="'.base_url('builderengine/public/js/editor/ckeditor.js').'"></script>
				<link href="'.base_url().'modules/cp/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
				<link href="'.base_url().'modules/cp/assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
				<link href="'.base_url().'modules/cp/assets/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" />
				<link href="'.base_url().'modules/cp/assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
				<link href="'.base_url().'modules/cp/assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />
				<link href="'.base_url('modules/booking_events/assets/css/titatoggle.css').'" rel="stylesheet">
				<link href="'.base_url('modules/cp/assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css').'" rel="stylesheet" />
				<link href="'.base_url('modules/cp/assets/plugins/bootstrap-datepicker/css/datepicker.css').'" rel="stylesheet" />
				<link href="'.base_url('modules/cp/assets/plugins/bootstrap-datepicker/css/datepicker3.css').'" rel="stylesheet" />
				<link href="'.base_url('modules/cp/assets/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css').'" rel="stylesheet" />
				<link href="'.base_url('modules/cp/assets/plugins/parsley/src/parsley.css').'" rel="stylesheet" />
				<link href="'.base_url('builderengine/public/dropzone/css/theme.css').'" rel="stylesheet">
				<link href="'.base_url('builderengine/public/dropzone/css/dropzone511.min.css').'" rel="stylesheet">
				<script src="'.base_url('builderengine/public/dropzone/js/dropzone.js').'"></script>
				<script>Dropzone.autoDiscover = false;</script>';
				include('modules/booking_events/assets/misc/country_list.php');
				$output .='
				<style>.red{color:red;margin-top:10px;}</style>
				<script type="text/javascript">
					$(document).ready(function (){
						CKEDITOR.replace("editor1");
					});
				</script>
				<style>.prices{margin-bottom:5px;}</style>
				<div class="be-uaccount-main-pad">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-cp-account">
								<div class="panel-heading">
									<div class="panel-heading-btn"></div>
									<h4 class="panel-title">'.$page.' Booking Event</h4>
									<br>
									<!--
									<div class="alert alert-info beaccount-domains-i-pad">
									</div>-->
								</div>
								<div class="panel-body">
									<form id="bookEventForm" class="form-horizontal form-bordered" data-parsley-validate="true" method="post" enctype="multipart/form-data" name="post">
										<input type="hidden" name="edit" value="'.$page.'">
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3" for="name">
												<b>Name:</b>
												<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Event Name"></i></label>
											<div class="col-md-9 col-sm-9">
												<input class="form-control" type="text" id="name" name="name" value="'.stripslashes($object->name).'" data-parsley-required="true" required />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3" for="slug">
												<b>URL Slug:</b>
												<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Event URL Slug"></i></label>
											<div class="col-md-9 col-sm-9">
												<input class="form-control" type="text" id="slug" name="slug" placeholder="URL Address Link" value="'.$object->slug.'" data-parsley-required="true" required />					
											</div>
										</div>';
										$required = 'required';
										if($CI->users->is_admin())
											$required = '';
										$output .='
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-be-3" for="link">
												<b>Book Now Link:</b>
												<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Event Book Now Link to point to another event"></i></label>
											<div class="col-md-9 col-sm-9 col-be-9">
												<input class="form-control form-control-100" type="text" id="link" name="link" placeholder="Book Now URL Address Link to external event (leave empty if none)" value="'.$object->link.'" '.$required.'/>					
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3" for="website">
											<b>Event Categories:</b>
											<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" data-parsley-required="true" title="Booking Event categories"></i></label>

												<div class="col-md-9 col-sm-9">
													<ul id="categories">';
														if($page == 'Edit'){
															$event_categories = explode(',', $object->categories);
															foreach($event_categories as $eventCategory){
																$output .='<li>'.stripslashes($eventCategory).'</li>';
															}
														}
													$output .='
													</ul>
													<span class="label label-danger" id="categs" style="color:#fff;font-size:12px;font-weight:600;margin-top:10px;"></span><br/>
												</div>

										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3" for="blogimage">Post Image:</label>
											<div class="col-md-9 col-sm-9">
												<span class="btn btn-success fileinput-button" style="height:35px !important">
													<i class="fa fa-plus"></i>
													<span>'.$page.' Image</span>
														<input type="file" name="image" id="uploadImage1" value="';if($page == 'Edit')$output .= $object->image; $output .='" onchange="PreviewImage(1);$(\'#avat\').show();$(\'#plc\').remove();"><br/>
												</span>
												<br/>
												<div id="avat" class="alert" style="display: block;width:130px;margin-top:10px;margin-bottom:10px;"> 
												<script>var input = "<input type=\"hidden\" name=\"image1\" value=\"'.base_url('builderengine/public/img/photo_placeholder.png').'\">";</script>
													<a class="close" onclick="$(\'#avat\').hide();$(\'#plc\').append(input).show();$(\'#uploadImage1\').remove();">×</a>';
													if($page =='Add') 
														$image = base_url('builderengine/public/img/photo_placeholder.png');
													else
														$image = $object->image;
													$output .='
													<img id="uploadPreview1" src="'.$image.'" width="80"/> 
												</div>
												<div id="plc" class="alert" style="display: none;width:130px;margin-top:10px;margin-bottom:10px;"> 
													<!--<a class="close" onclick="$(\'#plc\').hide();$(\'#avat\').show();">×</a> -->
													<img id="uploadPreview1" src="'.base_url('builderengine/public/img/photo_placeholder.png').'" width="80"/> 
												</div>
											</div>
										</div>
										<div class="form-group" style="">
											<label class="control-label col-md-3 col-sm-3" for="blogimage"><b>Additional Images:</b></label>
											<div class="col-md-9 col-sm-9 additional-images">
												<div id="dragNdropUpload" class="dropzone" style="border:2px dashed #aaa">
													<div class="dz-default dz-message">
														<span>Drag and Drop Your Files here</span><br/>
														<span><i class="fa fa-cloud-download" style="font-size:24px;color:#aaa"></i><br/>
														<span>(or click to open file browser)</span>
													</div>
												</div>
												<script>
												$(document).ready(function () {
													function generateThumbnail(ext){
														var thumbnail;
														if (ext == "pdf")
															thumbnail = "'.base_url('builderengine/public/img/pdf.png').'";
														if (ext == "mov" || ext == "mp4")
															thumbnail = "'.base_url('builderengine/public/img/video.png').'";
														if (ext == "csv")
															thumbnail = "'.base_url('builderengine/public/img/csv.png').'";
														if (ext == "mp3")
															thumbnail = "'.base_url('builderengine/public/img/mp3.png').'";
														if (ext == "doc")
															thumbnail = "'.base_url('builderengine/public/img/doc.png').'";
														if (ext == "docx")
															thumbnail = "'.base_url('builderengine/public/img/docx.png').'";
														if (ext == "xls")
															thumbnail = "'.base_url('builderengine/public/img/xls.png').'";
														if (ext == "xlsx")
															thumbnail = "'.base_url('builderengine/public/img/xlsx.png').'";
														return thumbnail;
													};
													Dropzone.autoDiscover = false;
													var existingFiles = "'.$numImages = $object->additional_image->count().'";
													var fileList = new Array;
													var i = 0;
													$("#dragNdropUpload").dropzone({
														url: "'.base_url('booking_events/ajax/upload').'",
														addRemoveLinks: true,
														paramName: "images",
														uploadMultiple: true,
														parallelUploads: 1,
														maxFiles: 25 - existingFiles,
														maxFilesize: 5,
														acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg,.pdf",

														init: function() {
															var dz = this;
															var existingFileCount = 0;
															//get all existing files from server
															$.getJSON("'.base_url('booking_events/ajax/get_uploaded_files/'.$object->id).'", function(data) {
																//console.log(\'data count:\'+data.length);
																if(data.length > 0){
																	$.each(data, function(index, val) {
																		console.log(val.name);
																		var newId = val.name.replace(/\.[^/.]+$/, "");
																		var mockFile = { name: val.name, size: val.size };
																		dz.emit("addedfile", mockFile);
																		var ext = val.name.split(\'.\').pop();
																		if (ext != "png" && ext != "jpg" && ext != "jpeg" && ext != "bmp" && ext != "gif") {
																			var thumbnail = generateThumbnail(ext);
																			dz.emit("thumbnail", mockFile, thumbnail);
																		}else{
																			dz.emit("thumbnail", mockFile, val.url);
																		}
																		dz.emit("complete", mockFile);
																		fileList[i] = {
																			"fileName": val.name,
																			"fileId" : newId
																		};
																		$("#bookEventForm").prepend($(\'<input id="fileUpload\' + newId + \'" type="hidden" \' + \'name="images[]" \' + \'value="\' + val.name + \'">\'));
																		i += 1;
																	});
																}
															});
															dz.options.maxFiles = dz.options.maxFiles - existingFileCount;

															this.on("maxfilesexceeded", function(file){
																alert("You can not upload any more files.");
																this.removeFile(file);
															});
															//i++;
															this.on("success", function (file, response) {
																var newId = response.replace(/\.[^/.]+$/, "");
																fileList[i] = {
																	"fileName": file.name,
																	"newName" : response,
																	"fileId" : newId,
																};
																$("#bookEventForm").prepend($(\'<input id="fileUpload\' + newId + \'" type="hidden" \' + \'name="images[]" \' + \'value="\' + response + \'">\'));
																i += 1;
																//console.log(fileList);
															});
															
															this.on("removedfile", function (file){
																//console.log(fileList);
																var removeFile = "";
																var removeInput = "";
																for (var f = 0; f < fileList.length; f++) {
																	if(typeof fileList[f].fileName != "undefined"){
																		if (fileList[f].fileName == file.name) {
																			removeFile = fileList[f].fileName;
																			fileInput = \'#fileUpload\' + fileList[f].fileId;
																		}
																	}
																}
																if (removeFile) {
																	$(fileInput).remove();
																	$.ajax({
																		url: "'.base_url('booking_events/ajax/remove_file').'",
																		type: "POST",
																		data: { "fileName" : file.name },
																		
																	}).done(function(data) {
																		//console.log(data);
																	}).fail(function(data){
																		alert("Deletion failed.Try again!");
																	});
																}
															});
														}
													});
												});
												</script>
											</div>
										</div>
										<div class="form-group" style="">
											<label class="control-label col-md-3 col-sm-3" for="Location">
												<b>Location:</b>
												<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Event Location"></i></label>
											<div class="col-md-9 col-sm-9">
												<div class="row">';
													$location = explode(',',$object->location);
													$address = '';
													$city = '';
													$zip = '';
													$currentCountry = '';
													
													$opt = count($location);
													if($opt == 3){
														$address = $location[0];
														$city = $location[1];
														$zip = '';
														$currentCountry = trim($location[2]);
													}
													if($opt == 4){
														$address = $location[0];
														$city = $location[1];
														$zip = $location[2];
														$currentCountry = trim($location[3]);
													}
													$output .='
													<div class="col-md-12 col-sm-12">
														<input class="form-control prices" type="text" name="address" value="'.$address.'" placeholder="Street Address" data-parsley-required="true" required />
													</div>
													<div class="col-md-9 col-sm-9">
														<input class="form-control prices" type="text" name="city" value="'.$city.'" placeholder="City" data-parsley-required="true" required />
													</div>
													<div class="col-md-3 col-sm-3">
														<input class="form-control prices" type="text" name="zip" value="'.$zip.'" placeholder="Zip" />
													</div>
													<div class="col-md-12 col-sm-12">
														<select class="form-control prices" name="country" id="country" placeholder="Select Country">
															<option value="">Select Country</option>';
															foreach ($countries as $country){
																$output .='<option value="'.$country.'" '; if ($currentCountry == $country) $output .='selected';$output .='>'.$country.'</option>';
															}
															$output .='
														</select>
													</div>
												</div>
											</div>					
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3" for="active">
												<b>Booking Dates:</b>
												<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Dates"></i>
											</label>
											<div class="col-md-9 col-sm-9">
												<!--
													<div class="form-group">
														<label class="control-label col-md-4">Linked Pickers</label>
														<div class="col-md-8">
															<div class="row row-space-10">
																<div class="col-md-6">
																	<input type="text" class="form-control"  id="datetimepicker3" placeholder="Min Date" />
																</div>
																<div class="col-md-6">
																	<input type="text" class="form-control" id="datetimepicker4" placeholder="Max Date" />
																</div>
															</div>
														</div>
													</div>	-->					
													<div class="row">
														<label class="col-md-4">Available From:
																<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Event Start Date"></i>
														</label>
														<div class="col-md-4">
															<input type="text" class="form-control prices" name="start_date" value="';if($page == 'Edit') $output .= date("d/m/Y", strtotime($object->start_date));$output .='" id="bookingEventStartDate" placeholder="Start date" required />
														</div>
													</div>
													<div class="row">
														<label class="col-md-4">Available To:
															<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Event End Date"></i>
														</label>
														<div class="col-md-4">
															<input type="text" class="form-control prices" name="end_date" value="';if($page == 'Edit') $output .= date("d/m/Y", strtotime($object->end_date));$output .='" id="bookingEventEndDate" placeholder="End date" required />
														</div>
													</div>
													<div class="row">
														<label class="col-md-4">Start at:
															<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Event Time Start"></i>
														</label>
														<div class="col-md-4">
															<div class="input-group date prices" id="datetimepickerStart">
																<input type="text" name="start_time" value="'.$object->start_time.'" class="form-control" required />
																<span class="input-group-addon">
																	<i class="fa fa-clock-o"></i>
																</span>
															</div>
														</div>
													</div>
													<div class="row">
														<label class="col-md-4">Ends at:
															<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Event Time Ends"></i>
														</label>
														<div class="col-md-4">
															<div class="input-group date" id="datetimepickerEnd">
																<input type="text" name="end_time" value="'.$object->end_time.'" class="form-control" required />
																<span class="input-group-addon">
																	<i class="fa fa-clock-o"></i>
																</span>
															</div>
														</div>
													</div>
													<div class="row" style="margin-top:10px;">
														<label class="col-md-4">Available Days: 
															<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Event Available Days"></i>
														</label>
													</div>
													<div class="row">
														<div class="col-md-12">
															<ul id="availableDays">';
																if($page == 'Edit'){
																	$event_days = explode(',', $object->available_days);
																	foreach($event_days as $day){
																		$output .= '<li>'.$day.'</li>';
																	}
																}else{
																	$output .='
																	<li>Sunday</li>
																	<li>Monday</li>
																	<li>Tuesday</li>
																	<li>Wednesday</li>
																	<li>Thursday</li>
																	<li>Friday</li>
																	<li>Saturday</li>';
																}
																$output .='
															</ul>
														</div>
													</div>						
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3" for="active">
												<b>Payment Details:</b>
												<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Event Payment Details"></i>
											</label>
											<div class="col-md-9 col-sm-9">
												<div class="prices input-group">
													<input class="form-control required" type="text" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" id="price" name="price" value="'.$object->price.'" placeholder="Ticket Price" data-parlsey-type="digits" data-parsley-required="true" />';
													$currency = new Currency($CI->BuilderEngine->get_option('be_booking_events_default_currency'));
													$output .='
													<div class="input-group-addon">'.$currency->signature.'</div>
												</div>
												<div class="prices input-group">
													<input class="form-control prices" type="text" id="vat" name="vat" placeholder="Price VAT" value="'.$object->vat.'" data-parlsey-type="digits" data-parsley-required="true" required />
													<div class="input-group-addon">%</div>
												</div>
												<input class="form-control prices" type="text" id="capacity" name="capacity" placeholder="Capacity" value="'.$object->capacity.'" data-parlsey-type="digits" data-parsley-required="true" required />
												<div class="row">
													<label class="col-md-3 col-sm-3" for="required" style="margin-top:5px">
														<b>Currency:</b>
														<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Event Currency Selection"></i>
													</label>
													<div class="col-md-9 col-sm-9 prices">
														<select class="form-control" name="currency_id">';
															$currencies = new Currency();
															foreach ($currencies->get() as $currency){
																if($object->currency_id == $currency->id){
																	$output .='<option value="'.$currency->id.'" selected="selected">'.$currency->name.' - '.$currency->signature; if($currency->id == $CI->BuilderEngine->get_option('be_booking_events_default_currency')) $output.= ' - (Default)';$output.='</option>';
																}else{
																	$output .='<option value="'.$currency->id.'">'.$currency->name.' - '.$currency->signature; if($currency->id == $CI->BuilderEngine->get_option('be_booking_events_default_currency')) $output .= ' - (Default)';$output .='</option>';
																}
															}
															$output .='
														</select>
													</div>
												</div>
												<div class="row earlyContainer" style="background:#eee;margin:10px 0;padding:15px 5px;">
													<div class="early">
														<label class="col-md-5 col-sm-5" for="early_discount">
															<b>Early Booking Discount:</b>
															<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Early Booking Event Discount"></i>
														</label>
														<div class="col-md-3 col-sm-3">
															<select class="form-control prices" id="early_discount" name="early_discount" data-parsley-required="true">
																<!--<option value="">Select Option</option>-->
																<option value="yes" '; if($page == 'Edit') {if($object->early_discount == 'yes') $output .= 'selected';}$output .='>Yes</option>
																<option value="no" '; if($page == 'Edit') {if($object->early_discount == 'no') $output .= 'selected';}else $output .= 'selected';$output .='>No</option>
															</select>
														</div>';
														if($object->early_discount == 'yes'){
															$earlyDiscount = $object->earlydiscount->get();
															$output .='
															<div class="eDiscount controls controls-row input-group" style="width:100%;margin-bottom:5px;">
																<div class="col-md-5 col-sm-5"><input type="text" name="eDays" value="'.$earlyDiscount->num_days.'" class="form-control" placeholder="Days before EndDate" data-parlsey-type="digits" data-parsley-required="true" /></div>
																<div class="col-md-3 col-sm-3"><input class="form-control" type="text" name="eDiscount" value="'.$earlyDiscount->price.'" placeholder="Discount" data-parlsey-type="digits" data-parsley-required="true" /></div>
																<div class="col-md-4 col-sm-4"><select class="form-control" name="eOpt" ><option value="flat" '; if($earlyDiscount->price_opt == 'flat')$output .= 'selected';$output.='>Minus Price</option><option value="percent" '; if($earlyDiscount->price_opt == 'percent')$output .= 'selected';$output .='>Percent</option></select></div>
															</div>';					
														}
														$output .='
													</div>
												</div>
												<script>
													$("#early_discount").change(function() {
														var early_discount = $(this).val();								
														if (early_discount == "yes") {
															$(".early").append(
																"<div class=\"eDiscount controls controls-row input-group\" style=\"width:100%;margin-bottom:5px;\">" +
																	"<div class=\"col-md-5 col-sm-5\"><input type=\"text\" name=\"eDays\" value=\"\" class=\"form-control\" placeholder=\"Days before EndDate\" data-parlsey-type=\"digits\" data-parsley-required=\"true\" /></div>" +
																	"<div class=\"col-md-3 col-sm-3\"><input class=\"form-control\" type=\"text\" name=\"eDiscount\" placeholder=\"Discount\" data-parlsey-type=\"digits\" data-parsley-required=\"true\"></div>" +
																	"<div class=\"col-md-4 col-sm-4\"><select class=\"form-control\" name=\"eOpt\" ><option value=\"flat\">Minus Price</option><option value=\"percent\">Percent</option></select></div>" +
																"</div>"
															);
														} else {
															$(".eDiscount").remove();
														}
													});
												</script>';
												/* temp disabled
												<div class="row groupContainer" style="margin:10px 0;padding:15px 5px;">
													<div class="group">
														<label class="control-label col-md-6 col-sm-6" for="group_discount">
															<b>Group Prices:</b>
															<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Event Group Discount"></i></label>
														<div class="col-md-6 col-sm-6">
															<select class="form-control prices" id="group_discount" name="group_discount" data-parsley-required="true">
																<!--<option value="">Select Option</option>-->
																<option value="yes" <?if($page == 'Edit') {if($object->group_discount == 'yes') echo 'selected';}?>>Yes</option>
																<option value="no" <?if($page == 'Edit') {if($object->group_discount == 'no') echo 'selected';}else echo 'selected';?>>No</option>
															</select>
														</div>
														<?if($object->group_discount == 'yes'):?>
															<?$groupDiscount = $object->groupdiscount->get();?>								
															<div class="gDiscount controls controls-row input-group" style="width:100%;margin-bottom:5px;">
																<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;"><input type="text" name="gName" value="<?=$groupDiscount->name?>" class="form-control" placeholder="Group Name" data-parlsey-type="digits" data-parsley-required="true" /></div>
																<div class="col-md-2 col-sm-2" style="padding-left:2px;padding-right:2px;"><input class="form-control" type="text" name="gNum" value="<?=$groupDiscount->num_persons?>" placeholder="Persons" data-parlsey-type="digits" data-parsley-required="true" /></div>
																<div class="col-md-2 col-sm-2" style="padding-left:2px;padding-right:2px;"><input class="form-control" type="text" name="gDiscount" value="<?=$groupDiscount->price?>" placeholder="Discount" data-parlsey-type="digits" data-parsley-required="true" /></div>
																<div class="col-md-4 col-sm-4" style="padding-left:2px;"><select class="form-control" name="gOpt" ><option value="flat" <?if($groupDiscount->price_opt == 'flat')echo 'selected';?>>Minus Price</option><option value="percent" <?if($groupDiscount->price_opt == 'percent')echo 'selected';?>>Percent</option></select></div>
															</div>
														<?endif;?>
													</div>
												</div>
												<script>
													$('#group_discount').change(function() {
														var group_discount = $(this).val();								
														if (group_discount == 'yes') {
															$('.group').append(
																'<div class="gDiscount controls controls-row input-group" style="width:100%;margin-bottom:5px;">' +
																	'<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;"><input type="text" name="gName" value="" class="form-control" placeholder="Group Name" data-parlsey-type="digits" data-parsley-required="true" /></div>' +
																	'<div class="col-md-2 col-sm-2" style="padding-left:2px;padding-right:2px;"><input class="form-control" type="text" name="gNum" placeholder="Persons" data-parlsey-type="digits" data-parsley-required="true" /></div>' +
																	'<div class="col-md-2 col-sm-2" style="padding-left:2px;padding-right:2px;"><input class="form-control" type="text" name="gDiscount" placeholder="Discount" data-parlsey-type="digits" data-parsley-required="true" /></div>' +
																	'<div class="col-md-4 col-sm-4" style="padding-left:2px;"><select class="form-control" name="gOpt" ><option value="flat">Minus Price</option><option value="percent">Percent</option></select></div>' +
																'</div>'
															);
														} else {
															$('.gDiscount').remove();
														}
													});
												</script>
												<div class="row userGroupContainer" style="background:#eee;margin:10px 0;padding:15px 5px;">
													<div class="userGroup">
														<label class="control-label col-md-6 col-sm-6" for="usergroup_discount">
															<b>UserGroup Discount:</b>
															<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Event UserGroup Discount"></i></label>
														<div class="col-md-6 col-sm-6">
															<select class="form-control prices" id="usergroup_discount" name="usergroup_discount" data-parsley-required="true">
																<!--<option value="">Select Option</option>-->
																<option value="yes" <?if($page == 'Edit') {if($object->usergroup_discount == 'yes') echo 'selected';}?>>Yes</option>
																<option value="no" <?if($page == 'Edit') {if($object->usergroup_discount == 'no') echo 'selected';}else echo 'selected';?>>No</option>
															</select>
														</div>
														<?if($object->usergroup_discount == 'yes'):?>
															<?$usergroups = $object->usergroupdiscount->get();?>	
															<?$u = 0;?>
															<?$groups = new Group();?>
															<?foreach($usergroups as $usergroup):?>
																<div class="ugDiscount controls controls-row input-group" style="width:100%;margin-bottom:5px;">
																	<div class="col-md-12 col-sm-12" style="padding-left:2px;padding-right:2px;">
																		<select name="ugName[<?=$u?>]" class="form-control" style="margin-bottom:5px;">
																			<?foreach($groups->get() as $group):?>
																				<option value="<?=$group->name?>" <?if($group->name == $usergroup->usergroup_name) echo 'selected';?>><?=$group->name?></option>
																			<?endforeach;?>
																		</select>
																	</div>
																	<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;"><input class="form-control" type="text" name="ugDiscount[<?=$u?>]" value="<?=$usergroup->price?>" data-parlsey-type="digits" data-parsley-required="true" placeholder="Discount"></div>
																	<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;"><select class="form-control" name="ugOpt[<?=$u?>]"><option value="flat" <?if($usergroup->price_opt == 'flat')echo 'selected';?>>Minus Price</option><option value="percent" <?if($usergroup->price_opt == 'percent')echo 'selected';?>>Percent</option></select></div>
																	<div class="col-md-1 col-sm-1"><a class="delete-user-group"><i class="fa fa-times red"></i></a></div>
																</div>
																<?$u++;?>
															<?endforeach;?>
														<?endif;?>
													</div>
													<a class="btn btn-xs btn-primary uClone" style="display:none;"><i class="fa fa-plus"></i> Add New</a>
													<?if($page == 'Edit' && $object->usergroup_discount == 'yes'):?>
														<script>$('.uClone').show();</script>	
													<?endif;?>
												</div>
												<script>
													<?if($page == 'Edit' && $object->usergroup_discount == 'yes'):?>
														var countUserGroup = <?=$u+1;?>;
													<?else:?>
														var countUserGroup = 0;
													<?endif;?>
													<?$usergroups = new Group();?>
													var usergroups = [ <?php foreach ($usergroups->get() as $uGroup): ?>"<?php echo $uGroup->name?>", <?php endforeach;?>];
													$('#usergroup_discount').change(function() {
														var usergroup_discount = $(this).val();								
														if (usergroup_discount == 'yes') {
															$('.uClone').show();
															$('.userGroup').append(
																'<div class="ugDiscount controls controls-row input-group" style="width:100%;margin-bottom:5px;">' +
																	'<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;"><input class="form-control" type="text" name="ugDiscount[' + countUserGroup + ']" data-parlsey-type="digits" data-parsley-required="true" placeholder="Discount"></div>' +
																	'<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;"><select class="form-control" name="ugOpt[' + countUserGroup + ']"><option value="flat">Minus Price</option><option value="percent">Percent</option></select></div>' +
																	'<div class="col-md-1 col-sm-1"><a class="delete-user-group"><i class="fa fa-times red"></i></a></div>' +
																'</div>'
															);
															var sel = $('<select name="ugName[' + countUserGroup + ']" class="form-control" style="margin-bottom:5px;">').prependTo('.ugDiscount:last-child');
															$(usergroups).each(function() {
																sel.append($("<option>").attr('value',this).text(this));
															});
															countUserGroup++;
														} else {
															$('.uClone').hide();
															$('.ugDiscount').remove();
														}
													});
													$('.uClone').click(function(){
														$('.userGroup').append(
															'<div class="ugDiscount controls controls-row input-group" style="width:100%;margin-bottom:5px;">' +
																'<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;"><input class="form-control" type="text" name="ugDiscount[' + countUserGroup + ']" data-parlsey-type="digits" data-parsley-required="true" placeholder="Discount"></div>' +
																'<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;"><select class="form-control" name="ugOpt[' + countUserGroup + ']"><option value="flat">Minus Price</option><option value="percent">Percent</option></select></div>' +
																'<div class="col-md-1 col-sm-1"><a class="delete-user-group"><i class="fa fa-times red"></i></a></div>' +
															'</div>'
														);
														var sel = $('<select name="ugName[' + countUserGroup + ']" class="form-control" style="margin-bottom:5px;">').prependTo('.ugDiscount:last-child');
														$(usergroups).each(function() {
															sel.append($("<option>").attr('value',this).text(this));
														});
														countUserGroup++;									
													});
												</script>
												*/
												$output .='
												<div class="row voucherContainer" style="margin:10px 0;padding:15px 5px;">
													<div class="voucher">
														<label class="col-md-4 col-sm-4" for="voucher_discount">
															<b>Voucher Discount:</b>
															<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Event Voucher Discount"></i></label>
														<div class="col-md-3 col-sm-3">
															<select class="form-control prices" id="voucher_discount" name="voucher_discount" data-parsley-required="true">
																<!--<option value="">Select Option</option>-->
																<option value="yes" '; if($page == 'Edit') {if($object->voucher_discount == 'yes') $output.= 'selected';}$output.='>Yes</option>
																<option value="no" '; if($page == 'Edit') {if($object->voucher_discount == 'no') $output.= 'selected';}else $output.= 'selected';$output.='>No</option>
															</select>
														</div>';
														if($object->voucher_discount == 'yes'){
															$vouchers = $object->voucher->get();
															$i = 0;
															foreach($vouchers as $voucher){
																$output .='
																<div class="vDiscount controls controls-row input-group" style="width:100%;margin-bottom:5px;">
																	<div class="col-md-7 col-sm-7" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><input type="text" name="vName['.$i.']" value="'.$voucher->name.'" class="form-control" placeholder="Voucher Name" data-parsley-required="true" /></div>
																	<div class="col-md-5 col-sm-5" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><input class="form-control" type="text" name="vCode['.$i.']" value="'.$voucher->code.'" data-parlsey-type="digits" data-parsley-required="true" placeholder="Voucher Code"></div>
																	<div class="col-md-4 col-sm-5" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><input class="form-control endDate" type="text" name="vEndDate['.$i.']" value="'.date("d/m/Y", strtotime($voucher->expiry_date)).'" data-parsley-required="true" placeholder="End Date"></div>
																	<div class="col-md-3 col-sm-3" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><input class="form-control" type="text" name="vDiscount['.$i.']" value="'.$voucher->price.'" data-parlsey-type="digits" data-parsley-required="true" placeholder="Price"></div>
																	<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><select class="form-control" name="vOpt['.$i.']"><option value="flat" '; if($voucher->price_opt == 'flat')$output.= 'selected';$output.='>Minus Price</option><option value="percent" '; if($voucher->price_opt == 'percent')$output.= 'selected';$output.='>Percent</option></select></div>
																	<div class="col-md-1 col-sm-1"><a class="delete-voucher"><i class="fa fa-times red"></i></a></div>
																</div>';
																$i++;
															}
														}
														$output.='
													</div>
													<a class="btn btn-xs btn-primary vClone" style="display:none;"><i class="fa fa-plus"></i> Add New</a>';
													if($page == 'Edit' && $object->voucher_discount == 'yes'){
														$output.='<script>$(".vClone").show();</script>';	
													}
													$output.='
												</div>
												<script>';
													if($page == 'Edit' && $object->voucher_discount == 'yes'){
														$output .= 'var count = '.$i+1 .';';
													}else{
														$output .=' var count = 0;';
													}
													$output .='
													$("#voucher_discount").change(function() {
														var voucher_discount = $(this).val();								
														if (voucher_discount == "yes") {
															$(".vClone").show();
															$(".voucher").append(
																\'<div class="vDiscount controls controls-row input-group" style="width:100%;margin-bottom:5px;">\' +
																	\'<div class="col-md-7 col-sm-7" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><input type="text" name="vName[\" + count + \"]" value="" class="form-control" data-parsley-required="true" placeholder="Voucher Name" /></div>\' +
																	\'<div class="col-md-5 col-sm-5" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><input class="form-control" type="text" name="vCode[\" + count + \"]" data-parlsey-type="digits" data-parsley-required="true" placeholder="Voucher Code"></div>\' +
																	\'<div class="col-md-4 col-sm-5" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><input class="form-control endDate" type="text" name="vEndDate[\" + count + \"]" data-parsley-required="true" placeholder="End Date"></div>\' +
																	\'<div class="col-md-3 col-sm-3" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><input class="form-control" type="text" name="vDiscount[\" + count + \"]" data-parlsey-type="digits" data-parsley-required="true" placeholder="Price"></div>\' +
																	\'<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><select class="form-control" name="vOpt[\" + count + \"]"><option value="flat">Minus Price</option><option value="percent">Percent</option></select></div>\' +
																	\'<div class="col-md-1 col-sm-1"><a class="delete-voucher"><i class="fa fa-times red"></i></a></div>\' +
																\'</div>\'
															);
															count++;
															$(".endDate").datepicker({
																format: "dd/mm/yyyy",
																todayHighlight:true,
																autoclose:true
															});
														} else {
															$(".vClone").hide();
															$(".vDiscount").remove();
														}
													});
													$(".vClone").click(function(){
														$(".voucher").append(
															\'<div class="vDiscount controls controls-row input-group" style="width:100%;margin-bottom:5px;">\' +
																\'<div class="col-md-7 col-sm-7" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><input type="text" name="vName[\" + count + \"]" value="" class="form-control" data-parsley-required="true" placeholder="Voucher Name" /></div>\' +
																\'<div class="col-md-5 col-sm-5" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><input class="form-control" type="text" name="vCode[\" + count + \"]" data-parlsey-type="digits" data-parsley-required="true" placeholder="Voucher Code"></div>\' +
																\'<div class="col-md-4 col-sm-5" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><input class="form-control endDate" type="text" name="vEndDate[\" + count + \"]" data-parsley-required="true" placeholder="End Date"></div>\' +
																\'<div class="col-md-3 col-sm-3" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><input class="form-control" type="text" name="vDiscount[\" + count + \"]" data-parlsey-type="digits" data-parsley-required="true" placeholder="Price"></div>\' +
																\'<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><select class="form-control" name="vOpt[\" + count + \"]"><option value="flat">Minus Price</option><option value="percent">Percent</option></select></div>\' +
																\'<div class="col-md-1 col-sm-1"><a class="delete-voucher"><i class="fa fa-times red"></i></a></div>\' +
															\'</div>\'
														);
														count++;
														$(".endDate").datepicker({
															format: "dd/mm/yyyy",
															todayHighlight:true,
															autoclose:true
														});
													});
												</script>';
												/*
												<div class="row addonContainer" style="background:#eee;margin:10px 0;padding:15px 5px;">
													<div class="addOn">
														<label class="control-label col-md-6 col-sm-6" for="addon_service">
															<b>Addon Service:</b>
															<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Event Add-on Services"></i>
														</label>
														<div class="col-md-6 col-sm-6">
															<select class="form-control prices" id="addon_service" name="addon_service" data-parsley-required="true">
																<!--<option value="">Select Option</option>-->
																<option value="yes" <?if($page == 'Edit') {if($object->addon_service == 'yes') echo 'selected';}?>>Yes</option>
																<option value="no" <?if($page == 'Edit') {if($object->addon_service == 'no') echo 'selected';}else echo 'selected';?>>No</option>
															</select>
														</div>
														<?if($object->addon_service == 'yes'):?>
															<?$services = $object->addonservice->get();?>	
															<?$j = 0;?>
															<?foreach($services as $service):?>
																<div class="addContainer controls controls-row input-group" style="width:100%;margin-bottom:5px;">
																	<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;"><input type="text" name="aName[]" value="<?=$service->name?>" class="form-control" data-parsley-required="true" placeholder="Addon Name" /></div>
																	<div class="col-md-3 col-sm-3" style="padding-left:2px;padding-right:2px;"><input class="form-control" type="text" name="aPrice[]" value="<?=$service->price?>" data-parlsey-type="digits" data-parsley-required="true" placeholder="Price"></div>
																	<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><select class="form-control" name="aOpt[]"><option value="flat" <?if($service->price_opt == 'flat') echo 'selected';?>>Price</option><option value="percent" <?if($service->price_opt == 'percent') echo 'selected';?>>Percent</option></select></div>										
																	<div class="col-md-1 col-sm-1"><a class="delete-addon"><i class="fa fa-times red"></i></a></div>						
																</div>
																<?$j++;?>
															<?endforeach;?>
														<?endif;?>
													</div>
													<a class="btn btn-xs btn-primary aClone" style="display:none;"><i class="fa fa-plus"></i> Add New</a>
													<?if($page == 'Edit' && $object->addon_service == 'yes'):?>
														<script>$('.aClone').show();</script>	
													<?endif;?>
												</div>
												<script>
													<?if($page == 'Edit' && $object->addon_service == 'yes'):?>
														var countService = <?=$j+1;?>;
													<?else:?>
														var countService = 0;
													<?endif;?>
													$('#addon_service').change(function(){
														var addon_service = $(this).val();								
														if (addon_service == 'yes') {
															$('.aClone').show();
															$('.addOn').append(
																'<div class="addContainer controls controls-row input-group" style="width:100%;margin-bottom:5px;">' +
																	'<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;"><input type="text" name="aName[' + countService + ']" value="" class="form-control" data-parsley-required="true" placeholder="Addon Name" /></div>' +
																	'<div class="col-md-3 col-sm-3" style="padding-left:2px;padding-right:2px;"><input class="form-control" type="text" name="aPrice[' + countService + ']" data-parlsey-type="digits" data-parsley-required="true" placeholder="Price"></div>' +
																	'<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><select class="form-control" name="aOpt[' + countService + ']"><option value="flat">Price</option><option value="percent">Percent</option></select></div>' +												
																	'<div class="col-md-1 col-sm-1"><a class="delete-addon"><i class="fa fa-times red"></i></a></div>' +							
																'</div>'
															);
															countService++;
														} else {
															$('.addContainer').remove();
															$('.aClone').hide();
														}
													});
													$('.aClone').click(function(){
														$('.addOn').append(
															'<div class="addContainer controls controls-row input-group" style="width:100%;margin-bottom:5px;">' +
																'<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;"><input type="text" name="aName[' + countService + ']" value="" data-parsley-required="true" class="form-control" placeholder="Addon Name" /></div>' +
																'<div class="col-md-3 col-sm-3" style="padding-left:2px;padding-right:2px;"><input class="form-control" type="text" name="aPrice[' + countService + ']" data-parlsey-type="digits" data-parsley-required="true" placeholder="Price"></div>' +
																'<div class="col-md-4 col-sm-4" style="padding-left:2px;padding-right:2px;margin-bottom:5px;"><select class="form-control" name="aOpt[' + countService + ']"><option value="flat">Price</option><option value="percent">Percent</option></select></div>' +
																'<div class="col-md-1 col-sm-1"><a class="delete-addon"><i class="fa fa-times red"></i></a></div>' +							
															'</div>'
														);
														countService++;
													});
												</script>
												*/
												$output .='
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3" for="active">
												<b>Show Capacity:</b>
												<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Display events remaining tickets number"></i></label>
											<div class="col-md-9 col-sm-9">
												<div class="row">
													<div class="col-md-3 col-sm-3">
														<select class="form-control" id="show_capacity" name="show_capacity" data-parsley-required="true">
															<!--<option value="">Select Option</option>-->
															<option value="yes" '; if($page == 'Edit') {if($object->show_capacity == 'yes') $output .= 'selected';}else $output.= 'selected';$output.='>Yes</option>
															<option value="no" '; if($page == 'Edit') {if($object->show_capacity == 'no') $output.= 'selected';}$output.='>No</option>
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3" for="featured">
												<b>Featured Event:</b>
												<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Featured Booking Event"></i></label>
											<div class="col-md-9 col-sm-9 featured">
												<div class="row">
													<div class="col-md-3 col-sm-3">
														<select class="form-control" id="featured" name="featured" data-parsley-required="true">
															<!--<option value="">Select Option</option>-->
															<option value="yes" '; if($page == 'Edit') {if($object->featured == 'yes') $output.= 'selected';}$output.='>Yes</option>
															<option value="no" '; if($page == 'Edit') {if($object->featured == 'no') $output.= 'selected';}else $output.= 'selected';$output.='>No</option>
														</select>
													</div>
												</div>
												<!--<div class="row" style="margin-top:10px;">
													<script>
														$("#featured").change(function() {
															var selection = $(this).val();								
															if (selection == "yes") {
																$(".featured").append(
																	\'<div class="featuredFields controls controls-row input-group">\' +
																		\'<div class="col-md-10 col-sm-10"><input class="form-control" type="text" name="featured_fields[]" placeholder="Featured Field"></div>\' +
																		\'<div class="col-md-2 col-sm-2"><a class="delete-select-option"><i class="fa fa-times red"></i></a></div>\' +
																		\'<div class="col-md-10 col-sm-10"><input class="form-control" type="text" name="featured_fields[]" placeholder="Featured Field"></div>\' +
																		\'<div class="col-md-2 col-sm-2"><a class="delete-select-option"><i class="fa fa-times red"></i></a></div>\' +
																		\'<div class="col-md-10 col-sm-10"><input class="form-control" type="text" name="featured_fields[]" placeholder="Featured Field"></div>\' +
																		\'<div class="col-md-2 col-sm-2"><a class="delete-select-option"><i class="fa fa-times red"></i></a></div>\' +
																		\'<div class="col-md-10 col-sm-10"><input class="form-control" type="text" name="featured_fields[]" placeholder="Featured Field"></div>\' +
																		\'<div class="col-md-2 col-sm-2"><a class="delete-select-option"><i class="fa fa-times red"></i></a></div>\' +
																		\'<div class="col-md-10 col-sm-10"><input class="form-control" type="text" name="featured_fields[]" placeholder="Featured Field"></div>\' +
																		\'<div class="col-md-2 col-sm-2"><a class="delete-select-option"><i class="fa fa-times red"></i></a></div>\' +
																		\'<div class="col-md-10 col-sm-10"><input class="form-control" type="text" name="featured_fields[]" placeholder="Featured Field"></div>\' +
																		\'<div class="col-md-2 col-sm-2"><a class="delete-select-option"><i class="fa fa-times red"></i></a></div>\' +
																	\'</div>\'
																);
															} else {
																$(".featuredFields").remove();
															}
														});
													</script>
												</div>-->
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3" for="active">
												<b>Event Status:</b>
												<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Booking Event Status"></i></label>
											<div class="col-md-9 col-sm-9">
												<div class="row">
													<div class="col-md-3 col-sm-3">
														<select class="form-control" id="active" name="active" data-parsley-required="true">
															<!--<option value="">Select Option</option>-->
															<option value="yes" '; if($page == 'Edit') {if($object->active == 'yes') $output.= 'selected';}else $output.= 'selected';$output.='>Active</option>
															<option value="no" '; if($page == 'Edit') {if($object->active == 'no') $output.= 'selected';}$output.='>Inactive</option>
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-12 col-sm-12" for="blogname">
												<div style="text-align: left;"><b>Description:</b>
												<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="This is where you add your main Booking Event description"></i>
												</div>
											</label>
											<div class="col-md-12 col-sm-12">
												<div class="panel-body panel-form">
												<style>
													.demo1{
														line-height: 20.8px;
														text-align: center ;
													}
													.demo2{
														width: 50px;
														height: 50px;
													}
													.demo3{
														width: 50px;
														height: 50px; 
													}
													.demo4{
														margin-left:15px;
														width: 350px;
														height: 350px;
													}
													.demo5{
														line-height: 20.8px;
														text-align: center;						
													}
													.demo6{
														margin-left: 200px;
														
													}
												</style>';
												$txt = ChEditorfix($object->description);
												$output.='
												<textarea class="ckeditor" id="editor1" name="description" rows="20">'.str_replace('/files/be_demo',base_url('files/be_demo'),$txt).'</textarea>
											</div>
											</div>
										</div>
										<div class="form-group">
											<div class="text-center">
												<span class="label label-danger" id="catName" style="color:#fff;font-weight:600;margin-bottom:10px;"></span><br/>
												<button type="submit" class="btn btn-primary" style="margin-top:5px;" ><i class="fa fa-check"></i> Save Event</button>
											</div>
										</div>
										<input type="hidden" name="user_id" id="user_id" value="'.$user->id.'">
									</form>';
								$output.='
								</div><!-- End .widget-content -->
							</div><!-- End .widget -->
						</div><!-- End .span12  -->
					</div><!-- End .row-fluid  -->
				</div
				<!-- end col-10 -->

				<script src="'.base_url().'modules/cp/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
				<script src="'.base_url().'modules/cp/assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>
				<script type="text/javascript">';
					$booking_categories = new Booking_event_category();
					$output .='
					$(document).ready(function (){
						$("#categories").tagit({
							fieldName: "categories",
							singleField: true,
							showAutocompleteOnFocus: true,
							availableTags: [ '; foreach ($booking_categories->get() as $category){$output .='"'.$category->name.'",'; } $output .=']
						});

						$("#availableDays").tagit({
							fieldName: "available_days",
							singleField: true,
							showAutocompleteOnFocus: true,
							availableTags: [ "Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]
						});
					});

					function convertToSlug(Text)
					{
						return Text
							.toLowerCase()
							.replace(/ /g,\'-\')
							.replace(/[^\w-]+/g,\'\')
							;
					}
					$(document).ready(function (){
						$("#name").keyup(function() {
							$("#slug").val($("#name").val());
							$("#slug").change();
						});

						$("#slug").keyup(function() {
							$("#slug").change();
						});
						$("#slug").change(function() {
							$("#slug").val(convertToSlug($("#slug").val()));
						});
						
						$("#f").click(function(e){
						   e.preventDefault();
						});
						$("body").on("click", "a.delete-addon", function() {
							$(this).parent().parent().remove();
						});
						$("body").on("click", "a.delete-voucher", function() {
							$(this).parent().parent().remove();
						});
						$("body").on("click", "a.delete-user-group", function() {
							$(this).parent().parent().remove();
						});
					}); 
					';
					$events = new Booking_event();
					$output .='
					$("form").submit(function(event){
						var name = $("#name").val();';
						if($page == 'Edit'){
							$output .='var array = [ '; foreach ($events->where('name !=',$event->name)->get() as $event){$output .='"'.$event->name.'",';}$output .='];';
						}else{
							$output .='var array = [ '; foreach ($events->get() as $event){$output .='"'. $event->name.'", ';}$output .='];';
						}
						$output .='
						if(array.indexOf(name) == -1) {
							return;
						}
						$("#catName").text( "This booking event name already exists! Please,choose another !" ).show().fadeOut(4000);
						event.preventDefault();
					});

					var cats = $("#categories");
					$("form").on("submit", function () {
						if (cats.find("li").length <= 1) {
							$("#categs").text( "This field is mandatory! You need to add at least one category!" ).show().fadeOut(4000);
							return false; 
						}
					});

				   function PreviewImage(no) {
						var oFReader = new FileReader();
						oFReader.readAsDataURL(document.getElementById("uploadImage"+no).files[0]);
						oFReader.onload = function (oFREvent) {
							document.getElementById("uploadPreview"+no).src = oFREvent.target.result;
						};
					};
				</script>
			</div>
			<!-- end #content -->';
		if(!$user->is_guest())
			return $output;
    }
}
?>