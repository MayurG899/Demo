<?php require_once('assets_loader.php');?>	
<link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />
<link href="<?=base_url('modules/photogallery/assets/js/plugin/upload/upload.css')?>" rel="stylesheet" type="text/css" />
    <!-- Preloader -->
    <section id="preloader">
        <div class="loader" id="loader">
            <div class="loader-img"></div>
        </div>
    </section>
    <!-- End Preloader -->
    <!-- Site Wraper -->
    <div class="wrapper">
        <!-- CONTENT --------------------------------------------------------------------------------->
        <!-- Work Detail Section -->
		<section class="dark-bg  galleryprofileheight">
			<div class="container">
				<div class="post-author">
					<div class="post-author-img pull-left">
						<a href="<?=base_url('photogallery/channel/'.$user->username.'')?>"><img alt="author" src="<?=$user->avatar?>" alt=""></a>
					</div>
					<div class="post-author-details pull-left">
						<a href="<?=base_url('photogallery/channel/'.$user->username.'')?>"><h4><?=$user->first_name.' '.$user->last_name?></h4></a>
						<div class="post-meta"><span> <?=($num_followers == 1)?$num_followers.' Follower':$num_followers.' Followers';?></span></div>
						<div class="post-meta"><span><?=($num_photos ==1)?$num_photos.' Photo':$num_photos.' Photos';?></span></div>
					</div>
				</div>
				
				<div class="pull-right">
					<a href="<?=base_url('photogallery/upload')?>" class="btn btn-md btn-color-line"><i class="fa fa-upload left"></i>Upload Photo</a>
					<a href="<?=base_url('photogallery/add_album')?>" class="btn btn-md btn-white-line"><i class="fa fa-cloud left"></i>Create Album</a>
					<div class="btn-group">
						<button type="button" class="btn btn-md btn-color-line dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-user"></i> My Profile <span class="caret"></span>
						</button>
						<ul class="dropdown-menu" style="min-width:147px;width:170px;border:3px solid #128fdc;background:#ddd;">
							<li><a href="<?=base_url('photogallery/myphotos')?>" style="padding:3px 10px;"><i class="fa fa-picture-o"></i> My Photos</a></li>
							<li><a href="<?=base_url('photogallery/myalbums')?>" style="padding:3px 10px;"><i class="fa fa-folder-open-o"></i> My Albums</a></li>
							<li><a href="<?=base_url('photogallery/myfeed')?>" style="padding:3px 10px;"><i class="fa fa-newspaper-o left"></i> My Newsfeed</a></li>
							<li><a href="<?=base_url('photogallery/mysettings')?>" style="padding:3px 10px;"><i class="fa fa-cogs left"></i> My Settings</a></li>
						</ul>
					</div>
					<a href="<?=base_url('photogallery/logout')?>" type="button" class="btn btn-md btn-white-line"><i class="fa fa-sign-out left"></i>Log Out</a>
					<div class="post-meta gallerylocation1"><!--<span>Galway, Ireland</span>--></div>
				</div>
			</div>
		</section>

        <section class="ptb">
			<div class="container">
					<div class="row">		
						<h2 class="text-center">Upload new photo</h2>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<form id="uploadP" class="upload" method="post" action="<?=base_url('photogallery/upload_photo')?>" enctype="multipart/form-data">
								<div id="dropP">
									Drop Here
									<a>Browse</a>
									<input type="file" name="uplo"/>
								</div>
								<ul>
									<!-- The file uploads will be shown here -->
								</ul>
							</form>
						</div>
					</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div id="uploadFormP" class="dark-bg" style="width:100%;height:500px;display:none;padding-top:10px;color;#fff;border-radius:5px;">
							<?php if($num_albums > 0):?>
							<form method="post" id="forsP" style="">
							<?php endif;?>
								<input id="uploadedFileP" type="hidden" name="media_file" >
								<style>.control-label{color:#fff;}</style>
								<div class="form-group">
								<?php if($num_albums > 0):?>
								<?php $disabled = '';?>
								<label class="control-label col-md-4 col-sm-4" for="fullname">Select Album:</label>
									<div class="col-md-8 col-sm-8">
											<select name="album_id" style="width:100%;appearance:select;" required>
												<option value="" required>Select Album</option>
												<?php foreach($albums as $album):?>
													<option value="<?=$album->id?>"><?=$album->name?></option>
												<?php endforeach;?>
											</select>
									</div>
									<?php else:?>
									<?php $disabled = 'disabled';?>
									<label class="control-label col-md-4 col-sm-4" for="fullname"></label>
									<div class="col-md-8 col-sm-8">
										<a href="<?=base_url('photogallery/add_album/first')?>" class="btn btn-md btn-white-line animated infinite flash" style="margin-bottom:15px;"><i class="fa fa-cloud left"></i>Click here to Create an Album</a>
									</div>
								<?php endif;?>
								</div>							
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="fullname">Photo Title:</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="text" id="title" name="title" placeholder="Photo title" data-parsley-required="true" required />
									</div>
								</div>
								<div class="form-group">
								<label class="control-label col-md-4 col-sm-4" for="fullname">Description:</label>
									<div class="col-md-8 col-sm-8">
										<textarea class="form-control" name="text" placeholder="Description" rows="5"></textarea>
									</div>
								</div>
								<div class="form-group">
								<label class="control-label col-md-4 col-sm-4" for="fullname">Tags:</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="text" id="tags" name="tags" placeholder="Tags (comma separated)" data-parsley-required="true" required />
									</div>
								</div>
								<div class="form-group">
									<input type="hidden" name="groups_allowed" value="Administrators,Members,Guests">
								   <label class="control-label col-md-4 col-sm-4" for="status">Photo Status:</label>
									<div class="col-md-8 col-sm-8">
										<select id="user-groups-select" name="status">
											<option value="public">Public</option>
											<option value="private">Private</option>
										</select>
									</div>
									<label class="control-label col-md-4 col-sm-4" for="fullname">Allow Comments:</label>
									<div class="col-md-8 col-sm-8">
										<input type="checkbox" name="comments_allowed" style="appearance:checkbox;-webkit-appearance:checkbox;">
									</div>
								</div>	
								<div class="form-group">
								<label class="control-label col-md-4 col-sm-4" for="fullname"></label>
									<div class="col-md-8 col-sm-8">
										<button type="submit" class="btn btn-md btn-color-line <?=$disabled?>" name="submit"><i class="fa fa-floppy-o"></i> Save</button>
									</div>
								</div>
							</form>
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
    <!-- Site Wraper End -->