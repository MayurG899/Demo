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
						<a href="<?=base_url('videotube/channel/'.$user->username.'')?>"><img alt="author" src="<?=$user->avatar?>" alt=""></a>
					</div>
					<div class="post-author-details pull-left">
						<a href="<?=base_url('videotube/channel/'.$user->username.'')?>"><h4><?=$user->first_name.' '.$user->last_name?></h4></a>
						<div class="post-meta"><span> <?=($num_followers == 1)?$num_followers.' Follower':$num_followers.' Followers';?></span></div>
						<div class="post-meta"><span><?=($num_videos ==1)?$num_videos.' Video':$num_videos.' Videos';?></span></div>
					</div>
				</div>
				
				<div class="pull-right">
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
				</div>
			</div>
		</section>

        <section class="">
            <div class="container">
                <div class="">
                    <div class="col-md-8">
                        <div class="clearfix"></div>

                        <div class="post-comment">
                            <h4>Newsfeed <span class="comment-numb"></span></h4>
                            <ul class="comment-list mt-30">
							<?php foreach($followings as $following):?>
								<?php $last_videos = new VideoTubeMedia();
									  $last_videos =$last_videos->where('user_id',$following->following_id)->order_by('time_created','desc')->get();?>
								<?php foreach($last_videos as $last_video):?>
									<?php $video_author = new User($last_video->user_id);
										  $video_album = new VideoTubeAlbum($last_video->album_id);?>
								<?php if($video_album->status != 'private'):?>
                                <li>
                                    <div class="comment-avatar">
                                        <a href="<?=base_url('videotube/channel/'.$video_author->username.'')?>"><img src="<?=$video_author->avatar?>"></a>
                                    </div>
                                    <div class="">
                                        <div class="comment-detail">
                                           <span class="post-meta pull-right">Uploaded a New Video</span> <a href="<?=base_url('videotube/channel/'.$video_author->username.'')?>"><h6><?=$video_author->first_name.' '.$video_author->last_name?></h6></a>
                                            <div class="post-meta"><span><?=date('M d,Y',$last_video->time_created)?></span></div>
                                            <p><?=stripslashes(ChEditorFix($last_video->description))?></p>
											<div class="post-media">
												<a href="<?=base_url('videotube/video/'.$last_video->id.'')?>">
													<video width="45%" style="margin-bottom:5px;" src="<?=checkImagePath($last_video->file)?>" class="img-responsive" controls>
														<source src="<?=checkImagePath($last_video->file)?>" type="video/mp4">
														<source src="<?=checkImagePath($last_video->file)?>" type="video/ogg">
														Your browser does not support HTML5 video.
													</video>
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
								<form class="navbar-form" method="get" action="<?=base_url('/videotube/search')?>" >
									<input class="form-full input-lg" type="text" value="" placeholder="Search Here" name="keyword" id="wid-search">
									<input type="submit" value="" name="" id="wid-s-sub">
								</form>
                            </div>
                        </div>
						<?php if($num_albums > 0):?>
						<div class="sidebar-widget">
                            <h5>My Video Albums</h5>
                            <hr>
                            <ul>
								<?php foreach($albums as $album):?>
									<li><a href="<?=base_url('videotube/channel/'.$user->username.'/album/'.$album->id.'')?>"><?=$album->name?><?=($album->status == 'private')?' - (Private)':'';?></a></li>
								<?php endforeach;?>
                            </ul>
                        </div>
						<?php endif;?>
						<?php if($videos->tags != '' && $show_tags == 'yes'): ?>
							<div class="sidebar-widget">
								<h5>My Video Tags</h5>
								<hr>
								<ul class="widget-tag">
								<?php foreach($videos as $video):?>
								<?php $tags = explode(',',$video->tags);?>
									<?php $i = 1;?>
									<?php foreach($tags as $tag):?>
										<?php if($i <= $num_tags):?>
										<li><a href="<?=base_url('videotube/video/'.$video->id.'')?>"><?=$tag?></a></li>
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