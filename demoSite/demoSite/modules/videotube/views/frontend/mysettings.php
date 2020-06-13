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
							<li class="dropdown-submenu">
								<a tabindex="-1" href="#"><i class="fa fa-plus" style="margin-right:6px"></i> Add Video</a>
								<ul class="dropdown-menu" style="left:-100%;width:100%">
									<li><a href="<?=base_url('videotube/upload')?>"><i class="fa fa-upload left"></i> Upload File</a></li>
									<!--<li><a href="#"><i class="fa fa-youtube left"></i></i> YouTube Link</a></li>
									<li><a href="#"><i class="fa fa-vimeo left"></i> Vimeo Link</a></li>-->
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
							<li><a href="<?=base_url('cp/logout')?>"><i class="fa fa-sign-out left"></i> Log Out</a></li>
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
				<h2 class="text-center"> My Video Account Settings </h2>
				<hr>
				<form class="userProfileForm" name="settings" method="post" enctype="multipart/form-data">
					<input type="hidden" name="user_id" value="<?=$user->id?>">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						  <div class="form-group">
							<label>Allow Channel Comments</label>
							<select name="channel_comments" style="-webkit-appearance: menulist-button;">
								<option value="yes" <?if($user_settings->channel_comments == 'yes')echo 'selected';?>>Yes</option>
								<option value="no" <?if($user_settings->channel_comments == 'no')echo 'selected';?>>No</option>
							</select>
						  </div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						  <div class="form-group">
						  </div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						  <div class="form-group">
							<label>First Name</label>
							<input type="text" class="form-control" name="first_name" id="firstname" value="<?=$user->first_name?>" required>
						  </div>
						  <br>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						  <div class="form-group">
							<label>Last Name</label>
							<input type="text" class="form-control" name="last_name" id="lastname" value="<?=$user->last_name?>" required>
						  </div>
						  <br>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						  <div class="form-group">
							<label>Username / Channel</label>
							<input type="text" class="form-control" name="username" id="username" value="<?=$user->username?>" required readonly>
						  </div>
						  <br>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						  <div class="form-group">
							<label>Email address</label>
							<input type="email" class="form-control" name="email" id="email" value="<?=$user->email?>" required>
						  </div>
						  <br>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						  <div class="form-group">
							<label>Avatar</label>
							<input type="file" class="form-control" name="avatar" id="avatar" placeholder="Avatar" id="uploadImage1" onchange="PreviewImage(1);$('#avat').show();$('#plc').hide();">
						  </div>
							<div id="avat" class="alert" style="display: block;width:130px;margin-top:10px;margin-bottom:10px;"> 
								<a class="close" onclick="$('#avat').hide();$('#plc').show();">×</a>  
								  <img id="uploadPreview1" src="<?=($user->avatar != null)?$user->avatar:base_url().'builderengine/public/img/avatar.png';?>"  width="80"/> 
							</div>
							<div id="plc" class="alert" style="display: none;width:130px;margin-top:10px;margin-bottom:10px;"> 
								<a class="close" onclick="$('#plc').hide();$('#avat').show();">×</a>  
								  <img id="uploadPreview1" src="<?=base_url('builderengine/public/img/avatar.png')?>"  width="80"/> 
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						  <div class="form-group">
							<label>Header Background Image</label>
							<input type="file" class="form-control" name="background_img" id="background_img" placeholder="Background Image" id="uploadImage4" onchange="PreviewImage(4);$('#bck').show();$('#npi').hide();">
						  </div>
							<div id="bck" class="alert" style="display: block;width:130px;margin-top:10px;margin-bottom:10px;"> 
								<a class="close" onclick="$('#bck').hide();$('#npi').show();">×</a>  
								  <img id="uploadPreview4" src="<?=($user_settings->background_img != null)?$user_settings->background_img:base_url().'builderengine/public/img/no_preview.png';?>"  width="100"/> 
							</div>
							<div id="npi" class="alert" style="display: none;width:130px;margin-top:10px;margin-bottom:10px;"> 
								<a class="close" onclick="$('#npi').hide();$('#bck').show();">×</a>  
								  <img id="uploadPreview4" src="<?=base_url('builderengine/public/img/no_preview.png')?>"  width="100"/> 
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						  <div class="form-group">
							<label>About me:</label>
								<script type="text/javascript" src="<?=base_url('builderengine/public/ckeditor/ckeditor.js')?>"></script>
                                <textarea class="textarea form-control" name="about" id="cke" placeholder="Post text" rows="20"><?=$user_settings->about?></textarea>
								<script>CKEDITOR.replace( 'cke');</script>
						  </div>
						  <br>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						  <div class="form-group">
						  </div>
						</div><br/><br/>
					</div>	
						<button type="submit" class="btn btn-sm btn-color-line"> <i class="fa fa-floppy-o"></i> Save Settings </button>
						<button type="button" class="btn btn-sm btn-danger pull-right" data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-times"></i> Delete Account</button>
				</form>
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
	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	  <div class="modal-dialog modal-sm">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="gridSystemModalLabel">Are You Sure ?</h4>
		  </div>
		  <div class="modal-body">
			<div class="row">
				<div class="col-md-12">
					<p>You are about to permanently delete all your:</p>
					<ol>
						<li> videos</li>
						<li> comments</li>
						<li> likes</li>
						<li> follows</li>
						<li> profile</li>
					</ol>
				</div>
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-xs btn-default" data-dismiss="modal"> Cancel</button>
			<a href="<?=base_url('videotube/delete_profile/'.$user->id.'')?>" class="btn btn-xs btn-danger"><i class="fa fa-times"></i> Delete</a>
		  </div>
		</div>
	  </div>
	</div>	
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