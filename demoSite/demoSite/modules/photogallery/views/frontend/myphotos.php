<?php require_once('assets_loader.php');?>
<link href="<?=base_url()?>themes/dashboard/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
<link href="<?=base_url()?>themes/dashboard/assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
<link href="<?=base_url('builderengine/public/dropzone/css/theme.css')?>" rel="stylesheet">
<link href="<?=base_url('builderengine/public/dropzone/css/dropzone511.min.css')?>" rel="stylesheet">
<script src="<?=base_url('builderengine/public/dropzone/js/dropzone.js')?>"></script>
<script>Dropzone.autoDiscover = false;</script>
    <!-- Preloader -->
    <section id="preloader">
        <div class="loader" id="loader">
            <div class="loader-img"></div>
        </div>
    </section>
    <!-- End Preloader -->
    <!-- Site Wraper -->
    <div class="wrapper" style="margin-top:-20px;">
        <!-- CONTENT --------------------------------------------------------------------------------->
        <!-- Work Detail Section -->
		<section class="photogallery-post-author-details photo-topbargallery gallerywhite">
			<div class="col-md-12 photo-topbargallery-bg">
				<div class="photogallery-post-author-img photogallery-post-author-channel-header">
					<div class="photogallery-post-author-img pull-left">
						<a href="<?=base_url('photogallery/channel/'.$user->username.'')?>"><img alt="author" src="<?=$user->avatar?>" alt=""></a>
					</div>
					<div class="photogallery-post-author-details pull-left photogallery-membername-button">
						<a href="<?=base_url('photogallery/channel/'.$user->username.'')?>"><h4><?=$user->first_name.' '.$user->last_name?></h4></a>
						<div class="post-meta"><span> <?=($num_followers == 1)?$num_followers.' Follower':$num_followers.' Followers';?></span></div>					
					</div>
				</div>
				<div class="photogallery-post-author-channel-options-margin pull-right">
					<a href="<?=base_url('photogallery/upload')?>" class="photogallery-btn photogallery-btn-md photogallery-btn-color-line photogallery-uploadvideo-button"><i class="fa fa-upload left"></i>Upload Photo</a>
					<a href="<?=base_url('photogallery/add_album')?>" class="photogallery-btn photogallery-btn-md photogallery-btn-white-line photogallery-createalbum-button"><i class="fa fa-cloud left"></i>Create Album</a>
					<div class="btn-group">
						<button type="button" class="photogallery-btn photogallery-btn-md photogallery-btn-color-line dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-user"></i> My Account <span class="caret"></span>
						</button>
						<ul class="dropdown-menu photogallery-header-account-dropdown-box animated fadeIn">
								<li><a href="<?=base_url('photogallery/upload')?>"><i class="fa fa-upload left"></i> Upload Photo</a></li>
								<li><a href="<?=base_url('photogallery/add_album')?>"><i class="fa fa-cloud left"></i> Create Album</a></li>
								<hr>
								<li><a href="<?=base_url('photogallery/channel/'.$user->username.'')?>"><i class="fa fa-user-plus left"></i> My Channel</a></li>
								<li><a href="<?=base_url('photogallery/myfeed')?>"><i class="fa fa-newspaper-o left"></i> My Newsfeed</a></li>
								<li><a href="<?=base_url('photogallery/myphotos')?>"><i class="fa fa-video-camera left"></i> My Photos</a></li>
								<li><a href="<?=base_url('photogallery/myalbums')?>"><i class="fa fa-folder-open-o left"></i> My Albums</a></li>
								<hr>
								<li><a href="<?=base_url('photogallery/all_photos')?>"><i class="fa fa-desktop left"></i> View All Photos</a></li>
								<hr>
								<li><a href="<?=base_url('photogallery/mysettings')?>"><i class="fa fa-cogs left"></i> Channel Settings</a></li>
								<li><a href="<?=base_url('cp/edit/'.$user->id.'')?>"><i class="fa fa-dashboard left"></i> Edit My Account</a></li>
								<hr>
								<!--<li><a href="photogallery/logout"><i class="fa fa-sign-out left"></i> Log Out</a></li>-->
							</ul>
					</div>
					<a href="<?=base_url('photogallery/logout')?>" type="button" class="photogallery-btn photogallery-btn-md photogallery-btn-white-line photogallery-logout-button"><i class="fa fa-sign-out left"></i>Log Out</a>
					<div class="post-meta gallerylocation1"><!--<span>Galway, Ireland</span>--></div>
				</div>
			</div>
		</section>

        <section class="ptb">
            <div class="container">
                <div class="">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<br>
						<h2 class="text-center"> My Photos </h2>
						<hr>
						<div class="table-responsive photogallery-tables-myvideos">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Title</th>
									<th>Preview</th>
									<th>Album</th>
									<th>Description</th>
									<th>Tags</th>
									<th>Comments</th>
									<th>Created</th>
									<th>Options</th>
								</tr>
							</thead>
							<tbody class="photogallery-tables-myvideos">
								<?php $i = 1;?>
								<?php foreach($my_photos->order_by('time_created', 'desc') as $my_photo):?>
								<tr>
									<td><?=str_replace('_',' ',$my_photo->title)?></td>
									<td>
										<img class="img-responsive" width="100" src="<?=$my_photo->file?>" alt="<?=$my_photo->title?>">
									</td>
									<td>
										<?php $album = new PhotoGalleryAlbum($my_photo->album_id);?>
										<?=str_replace('_',' ',$album->name)?>
									</td>
									<td><?=ChEditorfix($my_photo->description)?></td>
									<td>
										<?php $tags = explode(',', $my_photo->tags);?>
										<?php foreach($tags as $tag):?>
											<span class="label label-primary" style="display:block;margin-bottom:2px;margin-right:2px;float:left;"> <?=$tag?> </span>
										<?php endforeach?>
									</td>
									<td>
										<?php 
											if($my_photo->comments_allowed == 'yes')
												echo 'Enabled';
											if($my_photo->comments_allowed == 'no')
												echo 'Disabled,showing existing';
											if($my_photo->comments_allowed == 'hide')
												echo 'Disabled,Hidden';
										?>
									</td>
									<td><?=date('d.m.Y',$my_photo->time_created)?></td>
									<td>
										<div class="btn-group-vertical m-r-5">
											<a href="<?=base_url('photogallery/photo/'.$my_photo->id)?>" class="btn btn-xs btn-primary" style="margin-bottom:3px;"><i class="fa fa-eye"></i> VIEW</a>
											<a class="btn btn-xs btn-success" style="margin-bottom:3px;" data-toggle="modal" data-target="#bs-example-modal-md<?=$i?>"><i class="fa fa-pencil-square-o"></i> EDIT</a>
											<a href="<?=base_url('photogallery/delete_photo/'.$my_photo->id)?>" class="btn btn-xs btn-danger"><i class="fa fa-times"></i> DELETE</a>
										</div>
									</td>
								</tr>
								<?php $i++;?>
								<?php endforeach;?>
							</tbody>
						</table>
						</div>
					</div>
                </div>
            </div>
        </section>

        <hr />

        <!-- Work Next Prev Bar -->
		<!--
        <section class="space60">
            <div class="container">
                <div class="item-nav">
                    <a class="item-prev" href="">
                        <div class="prev-btn"><i class="fa fa-angle-left"></i></div>
                        <div class="item-prev-text xs-hidden">
                            <h6>Prev Gallery</h6>
                        </div>
                    </a>

                    <a href="gallery_album_view_page.html" class="item-all-view">
                        <h6>John Doe Gallery</h6>
                    </a>

                    <a class="item-next" href="">
                        <div class="next-btn"><i class="fa fa-angle-right"></i></div>
                        <div class="item-next-text xs-hidden">
                            <h6>Next Gallery</h6>
                        </div>
                    </a>
                </div>
            </div>
        </section>
        <!-- End Work Next Prev Bar -->

        <!-- End CONTENT ------------------------------------------------------------------------------>
    </div>
	<?php $i = 1;?>
	<?php foreach($my_photos as $my_photo):?>	
	<div id="bs-example-modal-md<?=$i?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	  <div class="modal-dialog modal-md">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="gridSystemModalLabel">Edit Photo: <?=str_replace('_',' ',$my_photo->title)?></h4>
		  </div>
			<form id="myForm<?=$i?>" method="post" action="<?=base_url('photogallery/edit_photo/'.$my_photo->id)?>" enctype="multipart/form-data">
				<div class="modal-body" style="margin-left:10px;margin-right:10px;">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group" style="margin-bottom:0;">
								<label>Title:</label>
								<input type="text" class="form-control" name="title" style="margin-bottom:0;" value="<?=str_replace('_',' ',$my_photo->title)?>" required>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group" style="margin-bottom:0;">
								<label>Photo File:</label>
								<div id="dragNdropUpload<?=$i?>" class="dropzone" style="border:2px dashed #aaa">
									<div class="dz-default dz-message">
										<span>Drag and Drop Your Files here</span><br/>
										<span><i class="fa fa-cloud-download" style="font-size:24px;color:#aaa"></i><br/>
										<span>(or click to open file browser)</span>
									</div>
								</div>
								<script>
								$(document).ready(function () {
									Dropzone.autoDiscover = false;
									var fileList = new Array;
									var i = 0;
									var thumbnail = "<?=base_url('builderengine/public/img/video.png')?>";
									$("#dragNdropUpload<?=$i?>").dropzone({
										url: "<?=base_url('photogallery/ajax/upload')?>",
										addRemoveLinks: true,
										paramName: 'file',
										uploadMultiple: true,
										parallelUploads: 1,
										maxFiles: 1,
										maxFilesize: 5,
										acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
										timeout: 300000,//milliseconds

										init: function() {
											var dz = this;
											var existingFileCount = 2;
											//get all existing files from server
											$.getJSON("<?=base_url('photogallery/ajax/get_uploaded_files/'.$my_photo->id)?>", function(data) {
												//console.log('data count:'+data.length);
												if(data.length > 0){
													$.each(data, function(index, val) {
														console.log(val.name);
														var newId = val.name.replace(/\.[^/.]+$/, "");
														var mockFile = { name: val.name, size: val.size };
														dz.emit("addedfile", mockFile);
														dz.emit("thumbnail", mockFile, val.url);
														dz.emit("complete", mockFile);
														fileList[i] = {
															"fileName": val.name,
															"fileId" : newId
														};
														$("#myForm<?=$i?>").prepend($('<input id="fileUpload<?=$i?>' + newId + '" type="hidden" ' + 'name="file" ' + 'value="' + val.name + '">'));
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
												$("#myForm<?=$i?>").prepend($('<input id="fileUpload<?=$i?>' + newId + '" type="hidden" ' + 'name="file" ' + 'value="' + response + '">'));
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
															fileInput = '#fileUpload<?=$i?>' + fileList[f].fileId;
														}
													}
												}
												if (removeFile) {
													dz.options.maxFiles = 1;
													$(fileInput).remove();
													$.ajax({
														url: "<?=base_url('photogallery/ajax/remove_file')?>",
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
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group" style="margin-bottom:0;">
								<label>Album:</label><br/>
								<?php $albums = new PhotoGalleryAlbum();?>
								<select class="form-control" name="album_id" style="margin-bottom:0;" required>
									<?php foreach($albums->get() as $album):?>
										<?php if($album->id == $my_photo->album_id):?>
										<option value="<?=$album->id?>" selected><?=str_replace('_',' ',$album->name)?> <i class="fa fa-chevron-down"></i></option>
										<?php else:?>
										<option value="<?=$album->id?>"><?=$album->name?> <i class="fa fa-chevron-down"></i></option>
										<?php endif;?>
									<?php endforeach;?>
								</select>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group" style="margin-bottom:0;">
								<label>Description:</label>
								<script type="text/javascript" src="<?=base_url('builderengine/public/ckeditor/ckeditor.js')?>"></script>
                                <textarea class="textarea form-control" name="description" id="cke<?=$i?>" placeholder="Description" rows="20"><?=ChEditorfix($my_photo->description)?></textarea>
								<script>CKEDITOR.replace( 'cke<?=$i?>');</script>
							</div>
						</div>
						<input type="hidden" name="status" value="Public" >
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group" style="margin-bottom:0;">
								<label>Comments allowed:</label>
								<select class="form-control" id="comments" name="comments_allowed" data-parsley-required="true">
									<option value="yes" <?=$allowed = ($my_photo->comments_allowed == 'yes')?'selected':'';?>>Yes <i class="fa fa-chevron-down"></i></option>
									<option value="no" <?=$notallowed = ($my_photo->comments_allowed == 'no')?'selected':'';?>>Disable and show existing if any<i class="fa fa-chevron-down"></i></option>
									<option value="hide" <?=$hide = ($my_photo->comments_allowed == 'hide')?'selected':'';?>>Disable and hide all<i class="fa fa-chevron-down"></i></option>
								</select>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group" style="margin-bottom:0;">
								<label>Tags:</label>
								<ul id="tags" class="white">
									<?php $tags = explode(',', $my_photo->tags);?>
									<?php foreach($tags as $tag):?>
										<li><?=$tag?></li>
									<?php endforeach?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-xs btn-default" data-dismiss="modal"> Cancel</button>
					<button type="submit" class="btn btn-xs btn-success" style="margin-bottom:3px;"><i class="fa fa-check"></i> Save</button>
				</div>
			</form>
		</div>
	  </div>
	</div>
	<?php $i++;?>
	<?php endforeach;?>
    <!-- Site Wraper End -->