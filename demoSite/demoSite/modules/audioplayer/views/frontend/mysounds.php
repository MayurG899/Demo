<?php require_once('assets_loader.php');?>
<link href="<?=base_url()?>themes/dashboard/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
<link href="<?=base_url()?>themes/dashboard/assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
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
		<section class="audiogallery-post-author-details gallerywhite">
			<div class="col-md-12 audio-topbargallery">
				<div class="audiogallery-post-author-img audiogallery-post-author-channel-header">
					<div class="audiogallery-post-author-img pull-left">
						<a href="<?=base_url('audioplayer/channel/'.$user->username.'')?>"><img alt="author" src="<?=$user->avatar?>" alt=""></a>
					</div>
					<div class="audiogallery-post-author-details pull-left">
						<a href="<?=base_url('audioplayer/channel/'.$user->username.'')?>"><h4><?=$user->first_name.' '.$user->last_name?></h4></a>
						<div class="post-meta"><span> <?=($num_followers == 1)?$num_followers.' Follower':$num_followers.' Followers';?></span></div>					
					</div>
				</div>
				<div class="audiogallery-post-author-channel-options-margin pull-right">
					<a href="<?=base_url('audioplayer/upload')?>" class="audiogallery-btn audiogallery-btn-md audiogallery-btn-color-line"><i class="fa fa-upload left"></i>Upload Photo</a>
					<a href="<?=base_url('audioplayer/add_album')?>" class="audiogallery-btn audiogallery-btn-md audiogallery-btn-white-line"><i class="fa fa-cloud left"></i>Create Album</a>
					<div class="btn-group">
						<button type="button" class="audiogallery-btn audiogallery-btn-md audiogallery-btn-color-line dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-user"></i> My Account <span class="caret"></span>
						</button>
						<ul class="dropdown-menu audiogallery-header-account-dropdown-box animated fadeIn">
								<li><a href="<?=base_url('audioplayer/upload')?>"><i class="fa fa-upload left"></i> Upload Audio</a></li>
								<li><a href="<?=base_url('audioplayer/add_album')?>"><i class="fa fa-cloud left"></i> Create Album</a></li>
								<hr>
								<li><a href="<?=base_url('audioplayer/channel/'.$user->username.'')?>"><i class="fa fa-user-plus left"></i> My Channel</a></li>
								<li><a href="<?=base_url('audioplayer/myfeed')?>"><i class="fa fa-newspaper-o left"></i> My Newsfeed</a></li>
								<li><a href="<?=base_url('audioplayer/mysounds')?>"><i class="fa fa-video-camera left"></i> My Audio Tracks</a></li>
								<li><a href="<?=base_url('audioplayer/myalbums')?>"><i class="fa fa-folder-open-o left"></i> My Albums</a></li>
								<hr>
								<li><a href="<?=base_url('audioplayer/all_audios')?>"><i class="fa fa-desktop left"></i> View All Audio</a></li>
								<hr>
								<li><a href="<?=base_url('audioplayer/mysettings')?>"><i class="fa fa-cogs left"></i> Channel Settings</a></li>
								<li><a href="<?=base_url('cp/edit/'.$user->id.'')?>"><i class="fa fa-dashboard left"></i> Edit My Account</a></li>
								<hr>
								<!--<li><a href="audioplayer/logout"><i class="fa fa-sign-out left"></i> Log Out</a></li>-->
							</ul>
					</div>
					<a href="<?=base_url('audioplayer/logout')?>" type="button" class="audiogallery-btn audiogallery-btn-md audiogallery-btn-white-line"><i class="fa fa-sign-out left"></i>Log Out</a>
					<div class="post-meta gallerylocation1"><!--<span>Galway, Ireland</span>--></div>
				</div>
			</div>
		</section>

        <section class="ptb">
            <div class="container">
                <div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<br>
						<h2 class="text-center"> My Audio Tracks </h2>
						<hr>
						<div class="table-responsive audiogallery-tables-myvideos">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Title</th>
									<th>Audio with Cover</th>
									<th>Album</th>
									<th>Description</th>
									<th>Tags</th>
									<th>Comments</th>
									<th>Created</th>
									<th>Options</th>
								</tr>
							</thead>
							<tbody class="audiogallery-tables-myvideos">
								<?php $i = 1;?>
								<?php foreach($my_sounds->order_by('time_created', 'desc') as $my_sound):?>
								<tr>
									<td><?=str_replace('_',' ',$my_sound->title)?></td>
									<td>
										<img class="img-responsive" style="width:500px;" src="<?=checkImagePath($my_sound->cover)?>" alt="<?=$my_sound->name?>">
										<audio id="mediaplayer-<?=$my_sound->id?>" preload="none" src="<?=$my_sound->file?>" controls preload="auto" style="width:100%;">
											<source src="<?=$my_sound->file?>" type="audio/mpeg"></source>
											Your browser does not support the audio element.
										</audio>
										<script>
											$(document).ready(function() {
												$("#mediaplayer-<?=$my_sound->id?>").mediaelementplayer({
													success: function(mediaElement, originalNode, instance) {
														//instance.load();
													}
												});
												$("#mediaplayer-<?=$my_sound->id?>").bind("contextmenu",function(){
													return false;
												});
												//$(".mejs__controls").append("<div class=\"mejs_button mejs__download\"><a role=\"button\" href=\"<?=checkImagePath($my_sound->file)?>\" download><i class=\"fa fa-download\"></i></a></div>");
											});
										</script>
									</td>
									<td>
										<?php $album = new AudioPlayerAlbum($my_sound->album_id);?>
										<?=str_replace('_',' ',$album->name)?>
									</td>
									<td><?=ChEditorfix($my_sound->description)?></td>
									<td>
										<?php $tags = explode(',', $my_sound->tags);?>
										<?php foreach($tags as $tag):?>
											<span class="label label-primary" style="display:block;margin-bottom:2px;margin-right:2px;float:left;"> <?=$tag?> </span>
										<?php endforeach?>
									</td>
									<td>
										<?php 
											if($my_sound->comments_allowed == 'yes')
												echo 'Enabled';
											if($my_sound->comments_allowed == 'no')
												echo 'Disabled,showing existing';
											if($my_sound->comments_allowed == 'hide')
												echo 'Disabled,Hidden';
										?>
									</td>
									<td><?=date('d.m.Y',$my_sound->time_created)?></td>
									<td>
										<div class="btn-group-vertical m-r-5">
											<a href="<?=base_url('audioplayer/sound/'.$my_sound->id)?>" class="btn btn-xs btn-primary" style="margin-bottom:3px;"><i class="fa fa-music"></i> LISTEN</a>
											<a class="btn btn-xs btn-success" style="margin-bottom:3px;" data-toggle="modal" data-target="#bs-example-modal-md<?=$i?>"><i class="fa fa-pencil-square-o"></i> EDIT</a>
											<a href="<?=base_url('audioplayer/delete_sound/'.$my_sound->id)?>" class="btn btn-xs btn-danger"><i class="fa fa-times"></i> DELETE</a>
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
	<?php foreach($my_sounds as $my_sound):?>	
	<div id="bs-example-modal-md<?=$i?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	  <div class="modal-dialog modal-md">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="gridSystemModalLabel">Edit Sound: <?=str_replace('_',' ',$my_sound->title)?></h4>
		  </div>
			<form method="post" action="<?=base_url('audioplayer/edit_sound/'.$my_sound->id)?>" enctype="multipart/form-data">
				<div class="modal-body" style="margin-left:10px;margin-right:10px;">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group" style="margin-bottom:0;">
								<label>Title:</label>
								<input type="text" class="form-control" name="title" style="margin-bottom:0;" value="<?=str_replace('_',' ',$my_sound->title)?>" required>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group" style="margin-bottom:0;">
								<label>Album:</label><br/>
								<?php $albums = new AudioPlayerAlbum();?>
								<select class="form-control" name="album_id" style="margin-bottom:0;" required>
									<?php foreach($albums->get() as $album):?>
										<?php if($album->id == $my_sound->album_id):?>
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
                                <textarea class="textarea form-control" name="description" id="cke<?=$i?>" placeholder="Description" rows="20"><?=ChEditorfix($my_sound->description)?></textarea>
								<script>CKEDITOR.replace( 'cke<?=$i?>');</script>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group" style="margin-bottom:0;">
								<label>Cover Thumbnail:</label>
								<input type="file" class="form-control" id="uploadImage<?=$i?>" name="cover" onchange="PreviewImage(<?=$i?>);" style="margin-bottom:0;">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div id="preview<?=$i?>" class="form-group" style="margin-top:43px;">
								<img id="uploadPreview<?=$i?>" class="img-responsive" width="100px;" src="<?=$my_sound->cover?>" alt="<?=$my_sound->name?>">
								<script>
									var info = '<p class="pull-left">No thumbnail</p>';
									var input = "<input type=\"hidden\" name=\"cover\" value=\"<?=base_url('builderengine/public/img/no_preview.png')?>\">";
								</script>
								<a id="removeBtn<?=$i?>" href="#" onclick="$('#uploadPreview<?=$i?>').hide();$('#removeBtn<?=$i?>').hide();$('#uploadImage<?=$i?>').remove();$('#preview<?=$i?>').append(info);$('#preview<?=$i?>').append(input).show();" class="btn btn-xs btn-danger" style="margin-top:3px;padding:3px 3px;"><i class="fa fa-times"></i> Remove</a>
							</div>
						</div>
						<input type="hidden" name="status" value="Public">
						
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group" style="margin-bottom:0;">
								<label>Allow Comments:</label>
								<select class="form-control" id="comments" name="comments_allowed" data-parsley-required="true">
									<option value="yes" <?=$allowed = ($my_sound->comments_allowed == 'yes')?'selected':'';?>>Yes <i class="fa fa-chevron-down"></i></option>
									<option value="no" <?=$notallowed = ($my_sound->comments_allowed == 'no')?'selected':'';?>>Disable and show existing if any<i class="fa fa-chevron-down"></i></option>
									<option value="hide" <?=$hide = ($my_sound->comments_allowed == 'hide')?'selected':'';?>>Disable and hide all<i class="fa fa-chevron-down"></i></option>
								</select>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group" style="margin-bottom:0;">
								<label>Tags:</label>
								<ul id="tags" class="white">
									<?php $tags = explode(',', $my_sound->tags);?>
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
<script type="text/javascript">
    function PreviewImage(no) {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage"+no).files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview"+no).src = oFREvent.target.result;
        };
    }
</script>