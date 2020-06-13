<link href="<?=base_url('builderengine/public/dropzone/css/theme.css')?>" rel="stylesheet">
<link href="<?=base_url('modules/classifieds/assets/css/theme.css')?>" rel="stylesheet">
<link href="<?=base_url('modules/classifieds/assets/css/style.css')?>" rel="stylesheet">
<link href="<?=base_url('builderengine/public/dropzone/css/dropzone511.min.css')?>" rel="stylesheet">
<script src="<?=base_url('builderengine/public/dropzone/js/dropzone.js')?>"></script>
<script>Dropzone.autoDiscover = false;</script>
<script>
$(document).ready(function(){
    $('.department-li').click(function(){
        $('.custom-child-subcategories').find('.active').removeClass('active');
    });
});
</script>
<div class="classifieds-top-bar">
<div class="breadcrumb-row">
	<div class="container classifieds">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  
            <ol class="be-breadcrumb">
                <li><a href="<?=base_url()?>classifieds/view_category/All">Classifieds</a></li>
                <li><a href="<?=base_url('/classifieds/profile/'.$member->id)?>"><?=$member->username?></a></li>
                <li class="active" style="pointer-events: none"><a href="#">Edit Current Ad</a></li>
            </ol>
        </div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 classifieds-category-activename"> 
			<h2>Edit Ad Details</h2>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<?$search = new Block('be_classifieds_search_section')?>
			<?$search->set_type('classifieds_search_section');?>
			<?$search->add_css_class('no-float-left');?>
			<?$search->show();?>
        </div>
    </div>
	</div>
</div>

<div class="container classifieds">
    
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
            <div class="sidebar">    
                <div class="">
                    <div class="col-sm-12">
                        <?$user_panel = new Block('be_classifieds_category_user_panel_v1');?>
                        <?$user_panel->set_type('classifieds_user_menu');?>
                        <?$user_panel->add_css_class('no-float-left');?>
                        <?$user_panel->show();?>
                    </div>
                </div>
				
            </div>        
        </div>
        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 pull-right listings">
          <h3 class="classifieds-search-results-margin30">Edit Details of this Classifieds Ad</h3>
		  <link href="<?=base_url('themes/dashboard/assets/plugins/parsley/src/parsley.css')?>" rel="stylesheet" />
          <form id="myForm" class="form-vertical" method="post" data-parsley-validate="true" enctype="multipart/form-data">
            <div class="panel panel-default">
                <div class="panel-heading classifieds-create-headertitle">Change the Category of your Ad</div>
                <div class="panel-body be-classifieds-panel-create">
                    <div class="row">  
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2" style="margin-top: 10px;">
                                        <label>Category</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <select id="category" class="form-control " name="category_id" required>
                                            <option value="">Choose a category</option>
                                            <?$all_categories = new ClassifiedsCategory();?>
                                            <?foreach($all_categories->where('parent', '0')->get() as $parent_category):?>
                                                <optgroup label="<?=$parent_category->name?>">
                                                    <?$child_categories = new ClassifiedsCategory();?>
                                                    <?foreach($child_categories->where('parent !=', '0')->get() as $child_category):?>
                                                        <?if($child_category->parent == $parent_category->id):?>
                                                            <option value="<?=$child_category->id?>" <?if($child_category->id == $item->category_id) echo 'selected';?>>&nbsp;&nbsp;&nbsp;<?=$child_category->name?></option>
                                                        <?endif;?>
                                                    <?endforeach;?>
                                                </optgroup>
                                            <?endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>      
                        </div>      
                    </div>      
                </div>      
            </div>
            <div class="panel panel-default">
                <div class="panel-heading classifieds-create-headertitle">Classifieds Ad Details</div>
                <div class="panel-body be-classifieds-panel-create">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Ad Title </label>
                                <input type="text" name="name" class="form-control" value="<?=$item->name?>" required>
                            </div>
                            <?if(isset($name_error)):?>
                                <p style="font-size: 14px; color: red; margin-top: 20px; margin-bottom: 20px"><?=$name_error?></p>
                            <?endif;?>
                            <div class="col-sm-12"><br>
                                <label>Selling Price </label>
                                <input type="text" placeholder="0" min="0" max="9999999999999" step="100" data-parsley-validation-threshold="1" data-parsley-trigger="keyup" data-parsley-type="number" name="price" class="form-control" value="<?=$item->price?>" required>
                            </div>
                            <?if(isset($price_error)):?>
                                <p style="font-size: 14px; color: red; margin-top: 20px; margin-bottom: 20px"><?=$price_error?></p>
                            <?endif;?>
							<?/*
                            <div class="col-sm-12">
                                <label>Currency </label>
                                <select class="form-control" name="currency_id" required>
									<option value="">Select Currency</option>
									<?foreach($currencies as $currency):?>
									<option value="<?=$currency->id?>" <?if($currency->id == $item->currency_id) echo 'selected'?>><?=$currency->name?></option>
									<?endforeach?>
								</select>
                            </div>
							*/?>
                            <div class="col-sm-12"><br />
                                <label>Description of Ad </label>
								<script type="text/javascript" src="<?=base_url('builderengine/public/ckeditor/ckeditor.js')?>"></script>
                                <textarea id="cke" name="description" class="form-control col-sm-8 expand" rows="6" style="width: 99%" required><?=$item->description?></textarea>
								<script>CKEDITOR.replace( 'cke');</script>
                            </div>
                            <input type="hidden" name="time_of_creation" value="<?=time()?>">  
                        </div>
                    </div>
                </div>      
            </div>      
            <div class="panel panel-default">
                <div class="panel-heading">Classifieds Ad Location Details</div>
                <div class="panel-body be-classifieds-panel-create">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Region / Country</label>
                                <select id="region" class="form-control" name="region" required>
									<option value="">Select Region</option>
                                    <?$regions = new ClassifiedsRegion();?>
                                    <?foreach($regions->order_by('name','asc')->get() as $region):?>
                                        <option data-region="<?=$region->id?>" value="<?=$region->name?>" <?if($item->region == $region->name) echo 'selected';?>><?=$region->name?></option>
                                    <?endforeach;?>
                                </select>
                            </div>
                            <div id="locations" class="col-sm-12" style="margin-top:20px">
                                <label>Location Area / State</label>
								<?foreach($regions as $region):?>
									<?$locations = new ClassifiedsLocation();
									$locations = $locations->where('region_id',$region->id)->get();
									?>
									<?if($locations->exists()):?>
										<select id="location<?=$region->id?>" class="form-control location" name="location" required>
											<?foreach($locations->order_by('name','asc')->get() as $location):?>
												<?if($region->id == $location->region_id):?>
													<option value="<?=$location->name?>" <?if($item->location == $location->name) echo 'selected';?>><?=$location->name?></option>
												<?endif;?>
											<?endforeach;?>
										</select>
									<?else:?>
										<select id="location<?=$region->id?>" class="form-control location" name="location" required>
											<option value="">No Locations for this region</option>
										</select>
									<?endif;?>
								<?endforeach;?>
                            </div>
							<?$cr = new ClassifiedsRegion();
								$curr_region = $cr->where('name',$item->region)->get();
							?>
							<script>
								$(document).ready(function(){
									$('.location').hide('fast');
									$('.location').removeAttr('required');
									$('.location').attr('disabled','disabled');
									$('#location<?=$curr_region->id?>').removeAttr('disabled');
									$('#location<?=$curr_region->id?>').attr('required','required');
									$('#location<?=$curr_region->id?>').show('fast');
									$('#region').change(function(){
										$('#locations').show('fast');
										var bid = $(this).find('option:selected').attr('data-region');
										$( '.location' ).each(function( index, element ) {
											$( element ).hide();
											$( element ).attr('disabled', 'disabled');
											$( element ).removeAttr('required');
											if ( $( this ).is( '#location'+bid ) ) {
											  $(this).show();
											  $(this).removeAttr('disabled');
											  $(this).attr('required','required');
											}else{
												$(this).hide();
												$(this).attr('disabled', 'disabled');
												$(this).removeAttr('required');
											}
										});
									});
								});
							</script>
                            <div class="col-sm-12" style="margin-top:20px">
                                <label>Your Address for this Ad <small>(displayed publicly)</small></label>
                                <input type="text" name="address" class="form-control" value="<?=$item->address?>">
                            </div>
                        </div>
                        <br />
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading classifieds-create-headertitle">Contact Information <small>(you can also receive private messages if you don't want to share your number/email)</small></div>
                <div class="panel-body be-classifieds-panel-create">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Email </label>
                                <input type="text" name="email" class="form-control" value="<?=$item->email?>" required>
                            </div>
                            <div class="col-sm-12"><br>
                                <label>Phone Number </label>
                                <input type="text" name="phone" class="form-control" value="<?=$item->phone?>">
                            </div>
                        </div>
                        <br />
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading classifieds-create-headertitle">Add Photos</div>
                <div class="panel-body be-classifieds-panel-create">
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
								thumbnail = "<?=base_url('builderengine/public/img/pdf.png')?>";
							if (ext == "mov" || ext == "mp4")
								thumbnail = "<?=base_url('builderengine/public/img/video.png')?>";
							if (ext == "csv")
								thumbnail = "<?=base_url('builderengine/public/img/csv.png')?>";
							if (ext == "mp3")
								thumbnail = "<?=base_url('builderengine/public/img/mp3.png')?>";
							if (ext == "doc")
								thumbnail = "<?=base_url('builderengine/public/img/doc.png')?>";
							if (ext == "docx")
								thumbnail = "<?=base_url('builderengine/public/img/docx.png')?>";
							if (ext == "xls")
								thumbnail = "<?=base_url('builderengine/public/img/xls.png')?>";
							if (ext == "xlsx")
								thumbnail = "<?=base_url('builderengine/public/img/xlsx.png')?>";
							return thumbnail;
						};
						Dropzone.autoDiscover = false;
						var existingFiles = '<?=$numImages = $item->image->count();?>';
						var fileList = new Array;
						var i = 0;
						$("#dragNdropUpload").dropzone({
							url: "<?=base_url('classifieds/ajax/upload')?>",
							addRemoveLinks: true,
							paramName: 'image',
							uploadMultiple: true,
							parallelUploads: 1,
							maxFiles: 5 - existingFiles,
							maxFilesize: 5,
							acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg,.pdf",

							init: function() {
								var dz = this;
								var existingFileCount = 0;
								//get all existing files from server
								$.getJSON("<?=base_url('classifieds/ajax/get_uploaded_files/'.$item->id)?>", function(data) {
									//console.log('data count:'+data.length);
									if(data.length > 0){
										$.each(data, function(index, val) {
											console.log(val.name);
											var newId = val.name.replace(/\.[^/.]+$/, "");
											var mockFile = { name: val.name, size: val.size };
											dz.emit("addedfile", mockFile);
											var ext = val.name.split('.').pop();
											if (ext != 'png' && ext != 'jpg' && ext != 'jpeg' && ext != 'bmp' && ext != 'gif') {
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
											$("#myForm").prepend($('<input id="fileUpload' + newId + '" type="hidden" ' + 'name="files[]" ' + 'value="' + val.name + '">'));
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
									$("#myForm").prepend($('<input id="fileUpload' + newId + '" type="hidden" ' + 'name="files[]" ' + 'value="' + response + '">'));
									i += 1;
									//console.log(fileList);
								});
								
								this.on("removedfile", function (file){
									//console.log(fileList);
									var removeFile = "";
									var removeInput = "";
									for (var f = 0; f < fileList.length; f++) {
										if(typeof fileList[f].fileName != 'undefined'){
											if (fileList[f].fileName == file.name) {
												removeFile = fileList[f].fileName;
												fileInput = '#fileUpload' + fileList[f].fileId;
											}
										}
									}
									if (removeFile) {
										$(fileInput).remove();
										$.ajax({
											url: "<?=base_url('classifieds/ajax/remove_file')?>",
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
            <div class="panel panel-default">
                <div class="panel-heading">Complete Ad & Save Changes</div>
                <div class="panel-body be-classifieds-panel-create">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="terms" value="" data-parsley-required="true" required> I Agree to the Terms and Conditions by publishing this Ad.
                        </label>
                    </div>
                    <br />
                    <button type="submit" class="btn btn-sm btn-success pull-right"><i class="icon-ok"></i>Save Changes</button>
                </div>
            </div>
          </form>
        </div>
    </div>
</div><!-- Modal -->
<script src="<?=base_url('themes/dashboard/assets/plugins/parsley/dist/parsley.js')?>"></script>