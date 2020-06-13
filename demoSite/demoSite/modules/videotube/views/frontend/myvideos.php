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
    <div class="wrapper" style="margin-top: -20px;">
        <!-- CONTENT --------------------------------------------------------------------------------->
        <!-- Work Detail Section -->
		<section class="video-header-bg galleryprofileheight">
			<div class="container">
				<div class="video-post-author-channel video-post-author-channel-header">
					<div class="video-post-author-img pull-left">
						<a href="<?=base_url('videotube/channel/'.$user->username.'')?>"><img alt="author" src="<?=$user->avatar?>" alt=""></a>
					</div>
					<div class="video-post-author-details pull-left videotube-membername-button">
						<a href="<?=base_url('videotube/channel/'.$user->username.'')?>"><h4><?=$user->first_name.' '.$user->last_name?></h4></a>
						<div class="post-meta"><span> <?=($num_followers == 1)?$num_followers.' Follower':$num_followers.' Followers';?></span></div>						
					</div>
				</div>
				
				<div class="pull-right">
					<a href="<?=base_url('videotube/upload')?>" class="video-btn btn-md video-btn-black-line-border videotube-uploadvideo-button"><i class="fa fa-upload left"></i>Upload Video</a>
					<a href="<?=base_url('videotube/add_album')?>" class="video-btn btn-md video-btn-black-line-border videotube-createalbum-button"><i class="fa fa-cloud left"></i>Create Album</a>
					<div class="btn-group video-channel-account-profile-title">
						<button type="button" class="video-btn btn-md video-btn-black-line-border video-btn-nobg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-user"></i> My Account <span class="caret"></span>
						</button>
						<ul class="dropdown-menu videotube-header-account-dropdown-box animated fadeIn">
							<li class="dropdown-submenu">
								<a tabindex="-1" href="#"><i class="fa fa-plus" style="margin-right:6px"></i> Add Video</a>
								<ul class="dropdown-menu" style="left:-100%;width:100%">
									<li><a href="<?=base_url('videotube/upload')?>"><i class="fa fa-upload left"></i> Upload File</a></li>
									<li><a href="<?=base_url('videotube/youtube')?>"><i class="fa fa-youtube left"></i></i> YouTube Link</a></li>
									<!--<li><a href="#"><i class="fa fa-vimeo left"></i> Vimeo Link</a></li>-->
								</ul>
							</li>
							<li><a href="<?=base_url('videotube/add_album')?>"><i class="fa fa-cloud left"></i> Create Album</a></li>
							<hr>
							<li><a href="<?=base_url('videotube/channel/'.$user->username.'')?>"><i class="fa fa-user-plus left"></i> My Channel</a></li>
							<li><a href="<?=base_url('videotube/myfeed')?>"><i class="fa fa-newspaper-o left"></i> My Newsfeed</a></li>
							<li><a href="<?=base_url('videotube/myvideos')?>"><i class="fa fa-video-camera left"></i> My Videos</a></li>
							<li><a href="<?=base_url('videotube/myalbums')?>"><i class="fa fa-folder-open-o left"></i> My Albums</a></li>
							<hr>
							<li><a href="<?=base_url('videotube/all_videos')?>"><i class="fa fa-desktop left"></i> View All Videos</a></li>
							<hr>
							<li><a href="<?=base_url('videotube/mysettings')?>"><i class="fa fa-cogs left"></i> Channel Settings</a></li>
							<li><a href="<?=base_url('cp/edit/'.$user->id.'')?>"><i class="fa fa-dashboard left"></i> Edit My Account</a></li>
							<hr>
							<li><a href="cp/logout"><i class="fa fa-sign-out left"></i> Log Out</a></li>
						</ul>
					</div>
					<a href="<?=base_url('videotube/logout')?>" type="button" class="video-btn btn-md video-btn-black-line-border videotube-logout-button"><i class="fa fa-sign-out left"></i>Log Out</a>
					<div class="post-meta gallerylocation1"><!--<span>Galway, Ireland</span>--></div>
				</div>
			</div>
		</section>

        <section class="">
            <div class="container">
                <div class="">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<h2 class="text-center"> My Videos </h2>
						<hr>
						<div class="table-responsive videotube-tables-myvideos">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Video Name</th>
									<th>Preview</th>
									<th>Album</th>
									<th>Description</th>
									<th>Tags</th>
									<th>Comments</th>
									<th>Created</th>
									<th>Options</th>
								</tr>
							</thead>
							<tbody class="videotube-tables-myvideos">
								<?php $i = 1;?>
								<?php foreach($my_videos->order_by('time_created', 'desc') as $my_video):?>
								<tr>
									<td class="videotube-table-cell-width"><?=$my_video->title?></td>
									<td>
										<?
											if($my_video->type == 'file'){
												$output ='
												<video id="mediaplayerstream'.$my_video->id.'" src="'.checkImagePath($my_video->file).'" width="200px" height="170px" class="" controls>
													<source src="'.checkImagePath($my_video->file).'" type="video/mp4">
													<source src="'.checkImagePath($my_video->file).'" type="video/ogg">
													Your browser does not support HTML5 video.
												</video>';
											}
											if($my_video->type == 'youtube'){
												$output ='
												<video id="mediaplayerstream'.$my_video->id.'" src="'.checkImagePath($my_video->file).'" width="200px" height="170px" controls>
													<source type="video/youtube" src="'.$my_video->file.'" />
												</video>';
											}
											if($my_video->type == 'vimeo'){
												$output ='<iframe src="https://player.vimeo.com/video/'.$my_video->file.'" width="200px" height="170px" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
											}
											
										?>
										<?=$output;?>
										<script>
											$(document).ready(function() {
												$("#mediaplayerstream<?=$my_video->id?>").mediaelementplayer({
													poster: "<?=$my_video->file?>",
													showPosterWhenEnded: true,
													videoWidth: "200px",
													videoHeight: "170px",
													success: function(mediaElement, originalNode, instance) {
														instance.load();
													}
												});
												$("#mediaplayerstream<?=$my_video->id?>").bind("contextmenu",function(){
													return false;
												});
												//$(".mejs__controls").append("<div class=\"mejs_button mejs__download\"><a role=\"button\" href=\"checkImagePath($sound->file)\" download><i class=\"fa fa-download\"></i></a></div>");
											});
										</script>
									</td>
									<td>
										<?php $album = new VideoTubeAlbum($my_video->album_id);?>
										<?=str_replace('_',' ',$album->name)?>
									</td>
									<td><?=ChEditorfix($my_video->description)?></td>
									<td>
										<?php $tags = explode(',', $my_video->tags);?>
										<?php foreach($tags as $tag):?>
											<span class="label label-primary" style="display:block;margin-bottom:2px;margin-right:2px;float:left;"> <?=$tag?> </span>
										<?php endforeach?>
									</td>
									<td>
										<?php 
											if($my_video->comments_allowed == 'yes')
												echo 'Enabled';
											if($my_video->comments_allowed == 'no')
												echo 'Disabled,showing existing';
											if($my_video->comments_allowed == 'hide')
												echo 'Disabled,Hidden';
										?>
									</td>
									<td><?=date('d.m.Y',$my_video->time_created)?></td>
									<td>
										<div class="btn-group-vertical m-r-5">
											<a href="<?=base_url('videotube/video/'.$my_video->id)?>" class="btn btn-xs btn-primary" style="margin-bottom:3px;"><i class="fa fa-eye"></i> VIEW</a>
											<a class="btn btn-xs btn-success" style="margin-bottom:3px;" data-toggle="modal" data-target="#bs-example-modal-md<?=$i?>"><i class="fa fa-pencil-square-o"></i> EDIT</a>
											<a href="<?=base_url('videotube/delete_video/'.$my_video->id)?>" class="btn btn-xs btn-danger"><i class="fa fa-times"></i> DELETE</a>
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
	<?php foreach($my_videos as $my_video):?>	
	<div id="bs-example-modal-md<?=$i?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	  <div class="modal-dialog modal-md">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="gridSystemModalLabel">Edit Video: <?=$my_video->title?></h4>
		  </div>
			<form id="myForm<?=$i?>" method="post" action="<?=base_url('videotube/edit_video/'.$my_video->id)?>" enctype="multipart/form-data">
				<div class="modal-body" style="margin-left:10px;margin-right:10px;">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group" style="margin-bottom:0;">
								<label>Title:</label>
								<input type="text" class="form-control" name="title" style="margin-bottom:0;" value="<?=str_replace('_',' ',$my_video->title)?>" required>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group" style="margin-bottom:0;">
								<label>Type:</label>
								<select id="type-<?=$i?>" class="form-control" name="type">
									<option value="file" <?if($my_video->type == 'file') echo 'selected';?>>File</option>
									<option value="youtube" <?if($my_video->type == 'youtube') echo 'selected';?>>YouTube</option>
									<?/*<option value="vimeo" <?if($my_video->type == 'vimeo') echo 'selected';?>>Vimeo</option>*/?>
								</select>
							</div>
						</div>
						<?
							if($my_video->type == 'file'){
								$link_style = 'style="display:none"';
								$file_style = 'style="display:block"';
							}
							if($my_video->type == 'youtube' || $my_video->type == 'vimeo'){
								$link_style = 'style="display:block"';
								$file_style = 'style="display:none"';
							}
						?>
						<div id="link-<?=$i?>" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" <?=$link_style?>>
							<div class="form-group" style="margin-bottom:0;">
								<label>Video File:</label>
								<?if($my_video->type != 'file'):?>
									<input id="fileLink<?=$i?>" type="text" name="file" style="margin-bottom:0;" class="form-control" placeholder="YouTube or Vimeo Link" value="<?=$my_video->file?>" />
								<?else:?>
									<input id="fileLink<?=$i?>" type="text" name="file" style="margin-bottom:0;" class="form-control" placeholder="YouTube or Vimeo Link" value="" />
								<?endif;?>
							</div>
						</div>
						<div id="file-<?=$i?>" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" <?=$file_style?>>
							<div class="form-group" style="margin-bottom:0;">
								<label>Video File:</label>
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
										url: "<?=base_url('videotube/ajax/upload')?>",
										addRemoveLinks: true,
										paramName: 'file',
										uploadMultiple: true,
										parallelUploads: 1,
										maxFiles: 1,
										maxFilesize: 20,
										acceptedFiles: ".avi,.mp4,.flv,.mpg,.mpeg",
										timeout: 1800000, //milliseconds

										init: function() {
											var dz = this;
											var existingFileCount = 2;
											//get all existing files from server
											<?if($my_video->type == 'file'):?>
												$.getJSON("<?=base_url('videotube/ajax/get_uploaded_files/'.$my_video->id)?>", function(data) {
													//console.log('data count:'+data.length);
													if(data.length > 0){
														$.each(data, function(index, val) {
															console.log(val.name);
															var newId = val.name.replace(/\.[^/.]+$/, "");
															var mockFile = { name: val.name, size: val.size };
															dz.emit("addedfile", mockFile);
															dz.emit("thumbnail", mockFile, thumbnail);
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
											<?endif;?>
											

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
														url: "<?=base_url('videotube/ajax/remove_file')?>",
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
						<script>
							$(document).ready(function(){
								<?if($my_video->type == 'file'):?>
									$('#fileLink<?=$i?>').attr('disabled',true);
								<?endif;?>
								$('#type-<?=$i?>').on('change',function(){
									if($(this).val() == 'file'){
										$('#file-<?=$i?>').show();
										$('#link-<?=$i?>').hide();
										$('#fileLink<?=$i?>').attr('disabled',true);
									}else{
										$('#link-<?=$i?>').show();
										$('#file-<?=$i?>').hide();
										$('#fileLink<?=$i?>').attr('disabled',false);
									}
								});
							});
						</script>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group" style="margin-bottom:0;">
								<label>Album:</label><br/>
								<?php $albums = new VideoTubeAlbum();?>
								<select class="form-control" name="album_id" style="margin-bottom:0;" required>
									<?php foreach($albums->get() as $album):?>
										<?php if($album->id == $my_video->album_id):?>
										<option value="<?=$album->id?>" selected><?=str_replace('_',' ',$album->name)?> <i class="fa fa-chevron-down"></i></option>
										<?php else:?>
										<option value="<?=$album->id?>"><?=str_replace('_',' ',$album->name)?> <i class="fa fa-chevron-down"></i></option>
										<?php endif;?>
									<?php endforeach;?>
								</select>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group" style="margin-bottom:0;">
								<label>Description:</label>
								<script type="text/javascript" src="<?=base_url('builderengine/public/ckeditor/ckeditor.js')?>"></script>
                                <textarea class="textarea form-control" name="description" id="cke<?=$i?>" placeholder="Description" rows="20"><?=ChEditorfix($my_video->description)?></textarea>
								<script>CKEDITOR.replace( 'cke<?=$i?>');</script>
							</div>
						</div>
						<input type="hidden" name="status" value="Public" >
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group" style="margin-bottom:0;">
								<label>Allow Comments:</label>
								<select class="form-control" id="comments" name="comments_allowed" data-parsley-required="true">
									<option value="yes" <?=$allowed = ($my_video->comments_allowed == 'yes')?'selected':'';?>>Yes <i class="fa fa-chevron-down"></i></option>
									<option value="no" <?=$notallowed = ($my_video->comments_allowed == 'no')?'selected':'';?>>Disable and show existing if any<i class="fa fa-chevron-down"></i></option>
									<option value="hide" <?=$hide = ($my_video->comments_allowed == 'hide')?'selected':'';?>>Disable and hide all<i class="fa fa-chevron-down"></i></option>
								</select>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group" style="margin-bottom:0;">
								<label>Tags:</label>
								<ul id="tags" class="white">
									<?php $tags = explode(',', $my_video->tags);?>
									<?php foreach($tags as $tag):?>
										<li><?=$tag?></li>
									<?php endforeach?>
								</ul>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group" style="margin-bottom:0;">
								<label>Featured:</label>
								<select class="form-control" id="comments" name="featured" data-parsley-required="true">
									<option value="yes" <?=$allowed = ($my_video->featured == 'yes')?'selected':'';?>>Yes</option>
									<option value="no" <?=$notallowed = ($my_video->featured == 'no')?'selected':'';?>>No</option>
								</select>
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
<script type="text/javascript">
    function PreviewImage(no) {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage"+no).files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview"+no).src = oFREvent.target.result;
        };
    }
</script>