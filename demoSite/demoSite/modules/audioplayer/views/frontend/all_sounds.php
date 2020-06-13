<?php require_once('assets_loader.php');?>	
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
		<section class="dark-bg  galleryprofileheight">
            <div class="container">
				<div class="post-author">
					<div class="post-author-details pull-left">
						<h4>All Photos</h4>
					</div>
				</div>
				<?php if($gallery_option == 'open'):?>
				<div class="pull-right">
					<?php $user = new User();?>
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
				</div>
				<?php endif;?>
				<div class="sidebar-widget">
					<h5>Search</h5>
					<div class="widget-search">
						<form class="navbar-form" method="get" action="<?=base_url('/photogallery/search')?>" >
							<input class="form-full input-lg" type="text" value="" placeholder="Search Here" name="keyword" id="wid-search">
							<input type="submit" value="" name="" id="wid-s-sub">
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
                    <ul class="container-filter categories-filter">
                        <li><a class="categories active" data-filter="*">All</a></li>
						<?php foreach($albums as $album):?>
							<?php if($album->status != 'private' || ($album->status == 'private' && $this->user->get_id() == $album->user_id)):?>
							<li><a class="categories" data-filter=".<?=$album->name?>"><?=$album->name?></a></li>
							<?php endif;?>
						<?php endforeach;?>
                    </ul>
                </div>
                <!-- End work Filter -->
                <div class="container-masonry nf-col-4">
					<?php foreach($photos as $photo):?>
					<?php $photo_album = new PhotoGalleryAlbum($photo->album_id)?>
					<?php if($photo_album->status != 'private' || ($photo_album->status == 'private' && $this->user->get_id() == $photo_album->user_id)):?>
                    <div class="nf-item <?=$photo_album->name?> galleryboxspace">
                        <div class="item-box">
                            <a href="<?=base_url('photogallery/photo/'.$photo->id.'')?>">
								<img src="<?=$photo->file?>" alt="<?=$photo->description?>" >
                                <div class="item-mask">
                                    <div class="item-caption">
                                        <h6 class="white"><?=$photo->title?></h6>
										<?php $author = new User($photo->user_id);?>
										<p class="white">By <?=$author->first_name.' '.$author->last_name;?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
					<?php endif;?>
					<?php endforeach;?>
                </div>
            </div>
        </section>
        <!-- End Work Detail Section -->
        <!-- End CONTENT ------------------------------------------------------------------------------>
    </div>
    <!-- Site Wraper End -->