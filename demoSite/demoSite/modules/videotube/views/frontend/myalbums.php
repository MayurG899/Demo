<?php require_once('assets_loader.php');?>	
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
							<li><a href="<?=base_url('videotube/upload')?>"><i class="fa fa-upload left"></i> Upload Video</a></li>
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
						<h2 class="text-center"> My Albums </h2>
						<hr>
						<div class="table-responsive videotube-tables-myvideos">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>#</th>
									<th>Album Name</th>
									<th>Album Thumbnail</th>
									<th>Album Status</th>
									<th>Options</th>
								</tr>
							</thead>
							<tbody class="videotube-tables-myvideos">
								<?php $i = 1;?>
								<?php foreach($my_albums as $my_album):?>
								<tr>
									<td><?=$i?></td>
									<td><?=str_replace('_',' ',$my_album->name)?></td>
									<td>
										<img class="img-responsive videotube-table-img-video-width" width="100" src="<?=checkImagePath($my_album->image)?>" alt="<?=$my_album->name?>">
									</td>
									<td><?=$my_album->status?></td>
									<td>
										<div class="btn-group-vertical m-r-5">
											<a href="<?=base_url('videotube/channel/'.$user->username.'/album/'.$my_album->id)?>" class="btn btn-xs btn-primary" style="margin-bottom:3px;"><i class="fa fa-eye"></i> VIEW</a>
											<a class="btn btn-xs btn-success" style="margin-bottom:3px;" data-toggle="modal" data-target="#bs-example-modal-md<?=$i?>"><i class="fa fa-pencil-square-o"></i> EDIT</a>
											<a href="<?=base_url('videotube/delete_album/'.$my_album->id)?>" class="btn btn-xs btn-danger"><i class="fa fa-times"></i> DELETE</a>
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
	<?php foreach($my_albums as $my_album):?>	
	<div id="bs-example-modal-md<?=$i?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	  <div class="modal-dialog modal-md">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="gridSystemModalLabel">Edit Album: <?=$my_album->name?></h4>
		  </div>
			<form method="post" action="<?=base_url('videotube/edit_album/'.$my_album->id)?>" enctype="multipart/form-data">
				<div class="modal-body" style="margin-left:10px;margin-right:10px;">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group" style="margin-bottom:0;">
								<label>Name:</label>
								<input type="text" class="form-control" name="name" style="margin-bottom:0;" value="<?=str_replace('_',' ',$my_album->name)?>" required>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group" style="margin-bottom:0;">
								<label>Thumbnail:</label>
								<input type="file" class="form-control" id="uploadImage<?=$i?>" name="image" onchange="PreviewImage(<?=$i?>);" style="margin-bottom:0;">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div id="preview<?=$i?>" class="form-group" style="margin-top:43px;">
								<img id="uploadPreview<?=$i?>" class="img-responsive" width="100px;" src="<?=$my_album->image?>" alt="<?=$my_album->name?>">
								<script>
									var info = '<p class="pull-left">No thumbnail</p>';
									var input = "<input type=\"hidden\" name=\"image\" value=\"<?=base_url('builderengine/public/img/video_placeholder.png')?>\">";
								</script>
								<a id="removeBtn<?=$i?>" href="#" onclick="$('#uploadPreview<?=$i?>').hide();$('#removeBtn<?=$i?>').hide();$('#uploadImage<?=$i?>').remove();$('#preview<?=$i?>').append(info);$('#preview<?=$i?>').append(input).show();" class="btn btn-xs btn-danger" style="margin-top:3px;padding:3px 3px;"><i class="fa fa-times"></i> Remove</a>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group" style="margin-bottom:0;">
								<label>Status:</label><br/>
								<select class="form-control" id="status" name="status" data-parsley-required="true">
									<option value="public" <?=$public = ($my_album->status== 'public')?'selected':'';?>>Public <i class="fa fa-chevron-down"></i></option>
									<option value="private" <?=$private = ($my_album->status== 'private')?'selected':'';?>>Private <i class="fa fa-chevron-down"></i></option>
								</select>
							</div>
						</div>
						<input type="hidden" name="groups_allowed" value="<?=$my_album->groups_allowed?>">
						<input type="hidden" name="parent_id" value="<?=$my_album->parent_id?>">
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