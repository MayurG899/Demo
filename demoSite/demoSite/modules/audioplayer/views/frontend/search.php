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
						<a href="<?=base_url('photogallery/all_photos')?>"><h4>All Photos</h4></a>
					</div>
				</div>
				<div class="pull-right">
				<?php if($gallery_option == 'open'): ?>
					<?php if(!$this->user->is_logged_in()):?>
						<a href="<?=base_url('photogallery/login')?>" type="button" class="btn btn-md btn-white-line"><i class="fa fa-user left"></i>Login</a>
						<a href="<?=base_url('photogallery/register')?>" type="button" class="btn btn-md btn-white-line"><i class="fa fa-user left"></i>Register</a>
					<?php else:?>
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
					<?php endif;?>
				<?php endif;?>
				</div>
				<div class="sidebar-widget">
					<h5>Search</h5>
					<div class="widget-search">
						<form class="navbar-form" method="get" action="<?=base_url('/photogallery/search')?>" >
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
					<?php $total = count((array)$photos->id);?>
					<?php if($total > 0):?>
					<?php foreach($photos as $result):?>
						<?php $resulting_album = new PhotoGalleryAlbum($result->album_id);?>
						<?php if($resulting_album->status != 'private' || ($resulting_album->status == 'private' && $this->user->get_id() == $resulting_album->user_id)):?>
							<a href="<?=base_url('photogallery/photo/'.$result->id.'')?>"><h4><?=$result->title?></h4></a>
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