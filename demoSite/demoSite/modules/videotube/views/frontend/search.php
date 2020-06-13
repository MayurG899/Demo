<?php require_once('assets_loader.php');?>	
    <!-- Preloader -->
    <section id="preloader">
        <div class="loader" id="loader">
            <div class="loader-img"></div>
        </div>
    </section>
    <!-- End Preloader -->
    <!-- Site Wraper -->
    <div class="wrapper" style="margin-top:-25px;">
        <!-- CONTENT --------------------------------------------------------------------------------->
		<section class="dark-bg  galleryprofileheight">
            <div class="container">
				<div class="post-author">
					<div class="post-author-details pull-left">
						<a href="<?=base_url('videotube/all_videos')?>"><h4>All Videos</h4></a>
					</div>
				</div>
				<?php if($gallery_option == 'open'):?>
				<div class="pull-right">
					<?php $user = new User();?>
					<?php if(!$this->user->is_logged_in()):?>
						<a href="<?=base_url('videotube/login')?>" type="button" class="btn btn-md btn-white-line"><i class="fa fa-user left"></i>Login</a>
						<a href="<?=base_url('videotube/register')?>" type="button" class="btn btn-md btn-white-line"><i class="fa fa-user left"></i>Register</a>
					<?php else:?>				
					<a href="<?=base_url('videotube/upload')?>" class="btn btn-md btn-color-line"><i class="fa fa-upload left"></i>Upload Video</a>
					<a href="<?=base_url('videotube/add_album')?>" class="btn btn-md btn-white-line"><i class="fa fa-cloud left"></i>Create Album</a>
					<div class="btn-group">
						<button type="button" class="btn btn-md btn-color-line dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-user"></i> My Profile <span class="caret"></span>
						</button>
						<ul class="dropdown-menu" style="min-width:147px;width:170px;border:3px solid #128fdc;background:#ddd;">
							<li><a href="<?=base_url('videotube/myvideos')?>" style="padding:3px 10px;"><i class="fa fa-video-camera"></i> My Videos</a></li>
							<li><a href="<?=base_url('videotube/myalbums')?>" style="padding:3px 10px;"><i class="fa fa-folder-open-o"></i> My Albums</a></li>
							<li><a href="<?=base_url('videotube/myfeed')?>" style="padding:3px 10px;"><i class="fa fa-newspaper-o left"></i> My Newsfeed</a></li>
							<li><a href="<?=base_url('videotube/mysettings')?>" style="padding:3px 10px;"><i class="fa fa-cogs left"></i> My Settings</a></li>
						</ul>
					</div>
					<a href="<?=base_url('videotube/logout')?>" type="button" class="btn btn-md btn-white-line"><i class="fa fa-sign-out left"></i>Log Out</a>
					<div class="post-meta gallerylocation1"><!--<span>Galway, Ireland</span>--></div>
					<?php endif;?>
				</div>
				<?php endif;?>
				<div class="sidebar-widget">
					<h5>Search</h5>
					<div class="widget-search">
						<form class="navbar-form" method="get" action="<?=base_url('/videotube/search')?>" >
							<input class="form-full input-lg" type="text" value="" placeholder="Search Here" name="keyword" id="wid-search">
							<input type="submit" value="" name="email" id="wid-s-sub">
						</form>
					</div>
				</div>
			</div>
		</section>
        <!-- Work Detail Section -->
        <section class="ptb">
            <div class="container">
                <!-- work Filter -->
                <div class="row">
					<div class="col-md-12">
						<?php $total = count((array)$videos->id);?>
						<?php if($total > 0):?>
						<?php foreach($videos as $result):?>
						<?php $resulting_album = new VideoTubeAlbum($result->album_id);?>
						<?php if($resulting_album->status != 'private' || ($resulting_album->status == 'private' && $this->user->get_id() == $resulting_album->user_id)):?>
						<a href="<?=base_url('videotube/video/'.$result->id.'')?>"><h4><?=$result->title?></h4></a>
							<p class="lead">
							<?php
							$text_without_slashes = strip_tags(ChEditorfix($result->description));
							if(strlen($result->description) > 300)
							{
								$text = substr($text_without_slashes, 0, 300).'...';
							}
							else{
								$text = $text_without_slashes;
							}
							?>
							<?=$text?>
							</p>
						<?php endif;?>
						<?php endforeach;?>
						<?else:?>
						<h1 class="text-center" > Nothing found !</h1>
						<?php endif;?>
					</div>
                </div>
            </div>
        </section>
        <!-- End Work Detail Section -->
        <!-- End CONTENT ------------------------------------------------------------------------------>
    </div>
    <!-- Site Wraper End -->