<?php
class Cp_edit_user_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Account Dashboard";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Account Dashboard Edit User";
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
		$active_user = new User($user->get_id());
        $CI = & get_instance();
		$this->load_generic_styles();

		$CI->load->helper('form');
		$CI->load->model('users');
		$user_id = $user->get_id();
		$CI->load->model('setting');			

		$account = 0;
		$account_deletion_enabled = $CI->BuilderEngine->get_option('user_account_deletion');

		if(isset($_POST['account']) && $_POST['account'] == 1)
		{
			$CI->users->send_email_message($user->email,'goodbye_email','Goodbye');
			$CI->users->delete($user->get_id());
			$user->logout(base_url('cp/login'));
		}

		if(isset($_POST['id']))
		{
			if(isset($_POST['avatar'])){
				$_POST['avatar'] = base_url().'files/users/user_'.$user->get_id().'/avatars/'.$_POST['avatar'];
			}elseif(isset($_POST['avatar1'])){
				$_POST['avatar'] = $_POST['avatar1'];
			}
			else
				$_POST['avatar'] = $user->avatar;

			$groups = array();
			$groups_id = $user->groups;
			foreach ($groups_id as $key => $value) {
				array_push($groups, $CI->users->get_group_name_by_id($value));
			}
			$_POST['groups'] = implode(",", $groups);

			$data = array(
				'telephone' => $_POST['telephone'],
				'address' => $_POST['address'],
				'country' => $_POST['country'],
				'city' => $_POST['city']
			);
			$_POST['user_id'] = $user_id;
			$CI->users->extended_info('update',$_POST);
			unset($_POST['user_id']);
			unset($_POST['telephone']);
			unset($_POST['address']);
			unset($_POST['country']);
			unset($_POST['city']);
			unset($_POST['company']);
			$_POST['username'] = $user->username;
			$CI->users->edit($_POST);
			unset($_POST['username']);
			$CI->users->update_extended_info($user_id,$data); #delete#
			$user->notify('success', "User edited successfully!");
			header( "refresh:1;url=".base_url('cp/dashboard'));
		}

		$member = new User($user->get_id());
		$user_data = $CI->users->get_by_id($user->get_id());
		$groups = $CI->users->get_groups();
		include('modules/ecommerce/assets/misc/country_list.php');
		//View
        $output ='

				<div class="be-uaccount-edit-pad">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-cp-account">
							<div class="panel-heading">
								<h4 class="panel-title">Change Account Details for: <b> '.$user_data->first_name.' '.$user_data->last_name.'</b></h4>
							</div>
						<div class="row">
							<div class="panel-body beaccount-weblist-body">
							
							<link href="'.base_url('builderengine/public/dropzone/css/theme.css').'" rel="stylesheet">
							<link href="'.base_url('builderengine/public/dropzone/css/dropzone511.min.css').'" rel="stylesheet">
							<script src="'.base_url('builderengine/public/dropzone/js/dropzone.js').'"></script>
							<script>Dropzone.autoDiscover = false;</script>
			
				<form id="myForm" class="form-horizontal form-bordered" enctype="multipart/form-data" data-parsley-validate="true" name="demo-form" method="post">			
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 beaccount-onebox-col">
								<div class="panel panel-weblist-white"> 
									<div class="panel-editacc-white-inner beaccount-weblist-body-shadow"> 
										<div class="panel-heading panel-weblist-white panel-editacc-white-title-center">
											<h4 class="panel-title">Account Details</h4>
										</div>
							<div class="panel-body panel-form panel-weblist-white">
										
								<input type="hidden" name="id" value="'.$user_data->id.'">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="fullname">First Name:</label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control form-control-be-40 form-control-uaccount" type="text"  value="'.$user_data->first_name.'" id="firstname" name="first_name" placeholder="First Name" data-parsley-required="true" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="fullname">Surname:</label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control form-control-be-40 form-control-uaccount" type="text" id="surname"  value="'.$user_data->last_name.'" name="last_name" placeholder="Surname Name" data-parsley-required="true" />
									</div>
								</div>
								<div class="form-group" style="margin-bottom:0;">
									<label class="control-label col-md-3 col-sm-3">Avatar:</label>
									<div class="col-md-6 col-sm-6">
										<div id="dragNdropUploadAvatar" class="dropzone" style="border:2px dashed #aaa">
											<div class="dz-default dz-message">
												<span>Drag and Drop Your Files here</span><br/>
												<span><i class="fa fa-cloud-download" style="font-size:24px;color:#aaa"></i><br/>
												<span>(or click to open file browser)</span>
											</div>
										</div><br/>
										<script>
										$(document).ready(function(){';
										if($user_data->avatar == '')
											$output .='var thumbnail = "'.base_url('builderengine/public/img/photo_placeholder.png').'";';
										else
											$output .='var thumbnail = "'.$user_data->avatar.'";';
										$output .='
											Dropzone.autoDiscover = false;
											var fileList = new Array;
											var i = 0;
											$("#dragNdropUploadAvatar").dropzone({
												url: "'.base_url('cp/ajax/upload').'",
												addRemoveLinks: true,
												paramName: "avatar",
												uploadMultiple: true,
												parallelUploads: 1,
												maxFiles: 1,
												maxFilesize: 20,
												acceptedFiles: ".gif, .png, .PNG, .jpg, .JPG, .jpeg, .JPEG",
												timeout: 1800000, //milliseconds

												init: function() {
													var dz = this;
													var existingFileCount = 2;
													//get all existing files from server
													$.getJSON("'.base_url('cp/ajax/get_uploaded_files/'.$user->get_id()).'", function(data) {
														if(data.length > 0){
															$.each(data, function(index, val) {
																var newId = val.name.replace(/\.[^/.]+$/, "");
																var mockFile = { name: val.name, size: val.size };
																dz.emit("addedfile", mockFile);
																dz.emit("thumbnail", mockFile, thumbnail);
																dz.emit("complete", mockFile);
																fileList[i] = {
																	"fileName": val.name,
																	"fileId" : newId
																};
																$("#myForm").prepend($(\'<input id="fileUpload\' + newId + \'" type="hidden" \' + \'name="avatar" \' + \'value="\' + val.name + \'">\'));
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
														$("#myForm>").prepend($(\'<input id="fileUpload\' + newId + \'" type="hidden" \' + \'name="avatar" \' + \'value="\' + response + \'">\'));
														i += 1;
														console.log(fileList);
													});
													
													this.on("removedfile", function (file){
														//console.log(fileList);
														var removeFile = "";
														var removeInput = "";
														for (var f = 0; f < fileList.length; f++) {
															if(typeof fileList[f].fileName != "undefined"){
																if (fileList[f].fileName == file.name) {
																	removeFile = fileList[f].fileName;
																	fileInput = "#fileUpload" + fileList[f].fileId;
																}
															}
														}
														if (removeFile) {
															dz.options.maxFiles = 1;
															$(fileInput).remove();
															$.ajax({
																url: "'.base_url('cp/ajax/remove_file').'",
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
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="email">Email:</label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control form-control-be-40 form-control-uaccount" type="text" id="email"  value="'.$user_data->email.'" name="email" data-parsley-type="email" placeholder="Email" data-parsley-required="true" />
										<br/>
										<div id="emailError" class="alert alert-danger" style="display:none">
											<p><i class="fa fa-exclamation-triangle"></i> Email already taken, please choose another!</p>
										</div>
									</div>
								</div>
								<div class="form-group">
									<link href="'.base_url('themes/dashboard/assets/plugins/password-indicator/css/password-indicator.css').'" rel="stylesheet" />
									<label class="control-label col-md-3 col-sm-3" for="fullname">Password:</label>
									<div class="form-group">
										<div class="col-md-6 col-sm-6 beaccount-editacc-pwgen-3">
											<input type="text" name="password" id="password-indicator-visible" class="form-control form-control-be-40 form-control-uaccount beaccount-editacc-pwgen" />
											<div id="passwordStrengthDiv2" class="is0 beaccount-editacc-pwgen-2"></div>
										</div>
									</div>
									<script src="'.base_url('themes/dashboard/assets/plugins/password-indicator/js/password-indicator.js').'"></script>
									<script>
										$("#password-indicator-default").passwordStrength();
										$("#password-indicator-visible").passwordStrength({targetDiv: "#passwordStrengthDiv2"});
									</script>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3"></label>
									<div class="col-md-6 col-sm-6">
										<button type="submit" class="btn suBtn btn-primary">Save Changes</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- end panel -->
						
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 beaccount-onebox-col">
								<div class="panel panel-weblist-white"> 
									<div class="panel-editacc-white-inner beaccount-weblist-body-shadow"> 
										<div class="panel-heading panel-weblist-white panel-editacc-white-title-center">
											<h4 class="panel-title">Account & Profile Details</h4>
										</div>
										<div class="panel-body panel-form panel-weblist-white">
								
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="address"><b>Address:</b>
									<i class="fa fa-question-circle beaccount-editacc-helpi" data-toggle="tooltip" data-placement="top" title="Enter Billing Address"></i></label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control form-control-be-40 form-control-uaccount" type="text" id="address" name="address" value="'.$member->extended->get()->address.'" placeholder="Billing Address" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="city"><b>City:</b>
									<i class="fa fa-question-circle beaccount-editacc-helpi" data-toggle="tooltip" data-placement="top" title="Enter City"></i></label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control form-control-be-40 form-control-uaccount" type="text" id="city" name="city" value="'.$member->extended->get()->city.'" placeholder="City" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="city"><b>State:</b>
									<i class="fa fa-question-circle beaccount-editacc-helpi" data-toggle="tooltip" data-placement="top" title="Enter State"></i></label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control form-control-be-40 form-control-uaccount" type="text" id="state" name="state" value="'.$member->extended->get()->state.'" placeholder="State" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="zip"><b>Zip Code:</b>
									<i class="fa fa-question-circle beaccount-editacc-helpi" data-toggle="tooltip" data-placement="top" title="Enter Zip Code"></i></label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control form-control-be-40 form-control-uaccount" type="text" id="zip" name="zip" value="'.$member->extended->get()->zip.'" placeholder="Zip Code" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="country"><b>Country:</b>
									<i class="fa fa-question-circle beaccount-editacc-helpi" data-toggle="tooltip" data-placement="top" title="Select your country"></i></label>
									<div class="col-md-6 col-sm-6">
										<select class="form-control form-control-be-40 form-control-uaccount" name="country" id="country" placeholder="Select Country">
											<option value="">Select Country</option>';
											foreach ($countries as $country){
												$output .='<option value="'.$country.'"'; if ($member->extended->country == $country) $output .= 'selected';$output .='>'.$country.'</option>';
											}
										$output .='
										</select>
									</div>
								</div>	
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="telephone"><b>Phone:</b>
									<i class="fa fa-question-circle beaccount-editacc-helpi" data-toggle="tooltip" data-placement="top" title="Enter Your Phone Number"></i></label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control form-control-be-40 form-control-uaccount" type="text" id="telephone" name="telephone" value="'.$member->extended->get()->telephone.'" placeholder="Enter Your Phone Number" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="gender"><b>Gender:</b>
									<i class="fa fa-question-circle beaccount-editacc-helpi" data-toggle="tooltip" data-placement="top" title="Select your gender"></i></label>
									<div class="col-md-6 col-sm-6">
										<select class="form-control form-control-be-40 form-control-uaccount" name="gender" id="gender" placeholder="Select Gender">
											<option value="male"';if($member->extended->get()->gender == 'male')$output .= ' selected';$output .='>Male</option>
											<option value="female"';if($member->extended->get()->gender == 'female')$output .= ' selected';$output .='>Female</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-be-3" for="telephone"><b>Company:</b>
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Enter Your Company Name"></i></label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control form-control-be-40 form-control-uaccount" type="text" id="company" name="company" value="'.$member->extended->get()->company.'" placeholder="Enter Your Company Name" />
									</div>
								</div>								
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3"></label>
									<div class="col-md-6 col-sm-6">
										<button type="submit" class="btn suBtn btn-primary">Save Details</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				</form>';
					if($account_deletion_enabled == 'yes'){
						$output .='
						<!-- account settings -->
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 beaccount-onebox-col">
							<div class="panel panel-weblist-white"> 
								<div class="panel-editacc-white-inner beaccount-weblist-body-shadow"> 
									<div class="panel-heading panel-weblist-white panel-editacc-white-title-center">
										<h4 class="panel-title">Account Deletion</h4>
									</div>
									<div class="panel-body panel-form panel-weblist-white">
										<form id="account" class="form-horizontal form-bordered" method="post" data-parsley-validate="true" name="demo-form">
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3" for="websitetitle">Delete My Account:</label>
												<div class="col-md-6 col-sm-6">
													<label class="radio-inline">
														<input type="radio" name="account" value="1" '; if($account) $output .=' checked="checked"';else $output .= ''; $output .=' > Yes
													</label>
													<label class="radio-inline">
														<input type="radio" name="account" value="0" '; if(!$account) $output .=' checked="checked"';else $output .= ''; $output .=' > No
													</label>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3" for="websitetitle"></label>
												<div class="col-md-8 col-sm-8">
													<p style="color:red;"><b><i class="fa fa-exclamation-triangle"></i> Warning:</b><br/>
														<b style="font-size:13px;" >Performing this action will permanently delete your account</b>
													</p>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3"></label>
												<div class="col-md-6 col-sm-6">
													<button id="save" type="submit" class="btn suBtn btn-danger">Delete Account</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade" id="myModal">
							<div class="modal-dialog modal-sm">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
										<h4 class="modal-title">Delete Account</h4>
									</div>
									<div class="modal-body">
										Are you sure you want to delete your account permanently?
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
										<a id="confirm" type="button" href="#" class="btn btn-sm btn-danger"><i id="ico" class="fa fa-trash"></i> <span id="delText">Delete Account</span></a> 
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->	
						
						<script>
							$(document).ready(function(){
								var user_id = $("#user_id").val();
								var email = $("#email").val();
								$("#email").on("blur keyup change click",function(event){
									var email = this.value;
									$.ajax({
										url: "'.base_url('admin/ajax/check_if_email_exists').'",
										type: "POST",
										data: {id: user_id, email: email},
										aync: false,
										success: function (data){
											console.log(data);
											if(data == "true" || email == this.value) {
												$("#emailError").show();
												$(".suBtn").attr("disabled",true);
											} else {
												$("#emailError").hide();
												$(".suBtn").attr("disabled",false);
											}
										}
									});
								});
							});
							$("#save").click(function(event){
								if ($(\'[name="account"]:checked\').val() === \'1\') {
									$(\'#myModal\').modal(\'show\');
								}
								else{
									return;
								}
								event.preventDefault();
							});
							$(\'#confirm\').on(\'click\',function(event){
								$("#account").submit();
								$("a").bind("click", function() { return false; });
								$("button").bind("click", function() { return false; });
								$("#ico").removeClass("fa-trash");
								$("#ico").addClass("fa-cog fa-spin fa-fw");
								$("#delText").text("Deleting....");
							});
						</script>
						<!-- end panel -->';
					}
				$output .='
				</div>
				
							</div>
							</div>
						</div>
					</div>
				</div>
			
				
<!-- end col-10 -->

		';
		if(!$user->is_guest())
			return $output;
    }
}
?>