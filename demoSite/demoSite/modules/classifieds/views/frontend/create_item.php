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
                <li class="active" style="pointer-events: none"><a href="#">Post New Ad</a></li>
            </ol>
        </div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 classifieds-category-activename"> 
			<h2>Post New Ad</h2>
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
          <h3 class="classifieds-search-results-margin30">Create New Classifieds Ad</h3>
		  <link href="<?=base_url('themes/dashboard/assets/plugins/parsley/src/parsley.css')?>" rel="stylesheet" />
          <form id="myForm" class="form-vertical" method="post" data-parsley-validate="true" enctype="multipart/form-data">
            <div class="panel panel-default">
                <div class="panel-heading classifieds-create-headertitle">Choose Category For Your New Ad</div>
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
                                                            <option value="<?=$child_category->id?>">&nbsp;&nbsp;&nbsp;<?=$child_category->name?></option>
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
                                <input type="text" name="name" class="form-control" placeholder="Enter the Name of this Ad" required>
                            </div>
                            <?if(isset($name_error)):?>
                                <p class="classifieds-create-error"><?=$name_error?></p>
                            <?endif;?>
                            <div class="col-sm-12"><br />
                                <label>Selling Price </label>
                                <input type="text" placeholder="0" min="0" max="9999999999999999999" step="100" data-parsley-validation-threshold="1" data-parsley-trigger="keyup" data-parsley-type="number" name="price" class="form-control" required>
                            </div>
                            <?if(isset($price_error)):?>
                                <p class="classifieds-create-error"><?=$price_error?></p>
                            <?endif;?>
							<?/*
                            <div class="col-sm-12">
                                <label>Currency </label>
                                <select class="form-control" name="currency_id" required>
									<option value="">Select Currency</option>
									<?foreach($currencies as $currency):?>
									<option value="<?=$currency->id?>"><?=$currency->name?></option>
									<?endforeach?>
								</select>
                            </div>
							*/?>
                            <div class="col-sm-12"><br />
                                <label>Description of Ad </label>
								<script type="text/javascript" src="<?=base_url('builderengine/public/ckeditor/ckeditor.js')?>"></script>
                                <textarea id="cke" name="description" class="form-control col-sm-8 expand" rows="6" placeholder="Enter the Description Details of this Ad" style="width: 99%" required></textarea>
								<script>CKEDITOR.replace( 'cke');</script>
                            </div>
                            <input type="hidden" name="time_of_creation" value="<?=time()?>">  
                        </div>
                    </div>
                </div>      
            </div>      
            <div class="panel panel-default">
                <div class="panel-heading classifieds-create-headertitle">Classifieds Ad Location Details</div>
                <div class="panel-body be-classifieds-panel-create">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Region / Country</label>
                                <select id="region" class="form-control" name="region" required>
									<option value="">Select Region</option>
                                    <?$regions = new ClassifiedsRegion();?>
                                    <?foreach($regions->order_by('name','asc')->get() as $region):?>
                                        <option data-region="<?=$region->id?>" value="<?=$region->name?>"><?=$region->name?></option>
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
													<option value="<?=$location->name?>"><?=$location->name?></option>
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
							<script>
								$(document).ready(function(){
									$('#locations').hide('fast');
									$('.location').hide('fast');
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
                                <input type="text" name="address" class="form-control" value="<?=$member_extend->address?>">
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
                                <input type="text" name="email" class="form-control" data-parsley-required="true" value="<?=$member->email?>" required>
                            </div>
                            <div class="col-sm-12"><br>
                                <label>Phone Number </label>
                                <input type="text" name="phone" class="form-control" value="<?=$member_extend->telephone?>">
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
							<span>Drag and Drop Your Files Here</span><br/>
							<span><i class="fa fa-cloud-download" style="font-size:24px;color:#aaa"></i><br/>
							<span>(or click to open file browser)</span>
						</div>
					</div>
					<script>
					$(document).ready(function () {
						Dropzone.autoDiscover = false;
						var fileList = new Array;
						var i = 0;
						$("#dragNdropUpload").dropzone({
							url: "<?=base_url('classifieds/ajax/upload')?>",
							addRemoveLinks: true,
							paramName: 'image',
							uploadMultiple: true,
							parallelUploads: 1,
							maxFiles: 5,
							maxFilesize: 5,
							acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg,.pdf",

							init: function() {

								this.on("maxfilesexceeded", function(file){
									alert("You can not upload any more files.");
									this.removeFile(file);
								});

								this.on("success", function (file, response) {
									//console.log(response);
									var newId = response.replace(/\.[^/.]+$/, "");
									fileList[i] = {
										"fileName": file.name,
										"newName" : response,
										"fileId" : newId,
									};
									$("#myForm").prepend($('<input id="fileUpload' + newId + '" type="hidden" ' + 'name="files[]" ' + 'value="' + response + '">'));
									i += 1;
								});

								this.on("removedfile", function (file){
									var removeFile = "";
									var removeInput = "";
									for (var f = 0; f < fileList.length; f++) {
										if (fileList[f].fileName == file.name) {
											removeFile = fileList[f].newName;
											fileInput = '#fileUpload' + fileList[f].fileId;
										}
									}
									if (removeFile) {
										$(fileInput).remove();
										$.ajax({
											url: "<?=base_url('classifieds/ajax/remove_file')?>",
											type: "POST",
											data: { "fileName" : removeFile },
											
										}).done(function(data) {
										//	console.log(data);
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
                <div class="panel-heading classifieds-create-headertitle">Complete Ad & Publish Live</div>
                <div class="panel-body be-classifieds-panel-create">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="terms" value="" data-parsley-required="true" required> I Agree to the Terms and Conditions by publishing this Ad.
                        </label>
                    </div>
                    <br />
                    <button id="submitBtn" type="submit" class="btn btn-sm btn-success pull-right"><i class="icon-ok"></i>Publish New Ad</button>
                </div>
            </div>
          </form>
        </div>
    </div>
</div><!-- Modal -->
<script src="<?=base_url('themes/dashboard/assets/plugins/parsley/dist/parsley.js')?>"></script>
