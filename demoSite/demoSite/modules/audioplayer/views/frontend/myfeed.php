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
                    <div class="col-md-8">
                        <div class="clearfix"></div>

                        <div class="post-comment">
                            <h4>Newsfeed <span class="comment-numb"></span></h4>
                            <ul class="comment-list mt-30">
							<?php foreach($followings as $following):?>
								<?php $last_photos = new PhotoGalleryMedia();
									  $last_photos =$last_photos->where('user_id',$following->following_id)->order_by('time_created','desc')->get();?>
								<?php foreach($last_photos as $last_photo):?>
									<?php $photo_author = new User($last_photo->user_id);
										  $photo_album = new PhotoGalleryAlbum($last_photo->album_id);?>
								<?php if($photo_album->status != 'private'):?>									
                                <li>
                                    <div class="comment-avatar">
                                        <a href="<?=base_url('photogallery/channel/'.$photo_author->username.'')?>"><img src="<?=$photo_author->avatar?>"></a>
                                    </div>
                                    <div class="">
                                        <div class="comment-detail">
                                           <span class="post-meta pull-right">Uploaded a New Photo</span> <a href="<?=base_url('photogallery/channel/'.$photo_author->username.'')?>"><h6><?=$photo_author->first_name.' '.$photo_author->last_name?></h6></a>
                                            <div class="post-meta"><span><?=date('M d,Y',$last_photo->time_created)?></span></div>
                                            <p><?=stripslashes(ChEditorFix($last_photo->description))?></p>
											<div class="post-media">
												<a href="<?=base_url('photogallery/photo/'.$last_photo->id.'')?>">
													<img alt="" src="<?=$last_photo->file?>">
												</a>
											</div>
                                        </div>
                                    </div>
                                </li>
								<?php endif;?>
								<?php endforeach;?>
							<?php endforeach;?>
                            </ul>
                        </div>

                    </div>
					
					<div class="col-md-4">
						
						<div class="sidebar-widget">
                            <h5>Search</h5>
                            <div class="widget-search">
								<form class="navbar-form" method="get" action="<?=base_url('/photogallery/search')?>" >
									<input class="form-full input-lg" type="text" value="" placeholder="Search Here" name="keyword" id="wid-search">
									<input type="submit" value="" name="" id="wid-s-sub">
								</form>
                            </div>
                        </div>
						<?php if($num_albums > 0):?>
						<div class="sidebar-widget">
                            <h5>My Photo Albums</h5>
                            <hr>
                            <ul>
								<?php foreach($albums as $album):?>
									<li><a href="<?=base_url('photogallery/channel/'.$user->username.'/album/'.$album->id.'')?>"><?=$album->name?><?=($album->status == 'private')?' - (Private)':'';?></a></li>
								<?php endforeach;?>
                            </ul>
                        </div>
						<?php endif;?>
						<?php if($photos->tags != '' && $show_tags == 'yes'): ?>						
						<div class="sidebar-widget">
                            <h5>My photo Tags</h5>
                            <hr>
                            <ul class="widget-tag">
							<?php foreach($photos as $photo):?>
							<?php $tags = explode(',',$photo->tags);?>
								<?php $i = 1;?>
                                <?php foreach($tags as $tag):?>
									<?php if($i <= $num_tags):?>
									<li><a href="<?=base_url('photogallery/photo/'.$photo->id.'')?>"><?=$tag?></a></li>
									<?php $i++;?>
									<?php else:?>
									<?php endif;?>
								<?php endforeach;?>
							<?php endforeach;?>
                            </ul>
                        </div>
						<?php endif; ?>						
						
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