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
		<section class="topbargallery">
			<div class="container">
				<div class=" post-author-details pull-left gallerywhite">
				 <?php if($gallery_option == 'open'): ?>
					 <?php if($this->user->is_logged_in()):?>
						 <?php $active_user = new User($this->user->get_id());?>
							<div class="post-author-img pull-left">
								<h4 style="margin-top:5px;"><img class="img-circle" width="30" alt="user" src="<?=$active_user->avatar?>"> <?=$active_user->first_name?> <?=$active_user->last_name?></h4>
							</div>
						<?php endif;?>
				 <?php endif;?>
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
			</div>
		</section>
		<?php	if($owner_settings->background_img){
					$class = '';
					$rule = 'background-image:url('.$owner_settings->background_img.');background-size: 100% 100%;background-repeat: no-repeat;'; 
				}
				else{
					$class = 'dark-bg';
					$rule ='';
				}?>
		<?php if($gallery_option == 'open'):?>
		<section class="<?=$class?>  galleryprofileheight1" style="<?=$rule?>">	 
			<div class="container">
				
				<div class="post-author">
					<div class="post-author-img pull-left">
						<a href="<?=base_url('videotube/channel/'.$channel_owner->username.'')?>"><img alt="author" src="<?=$channel_owner->avatar?>"></a>
					</div>
					<div class="post-author-details pull-left" style="background:#000;opacity:0.7;color:#fff !important;border-radius:5px;padding:5px;">
						<a href="<?=base_url('videotube/channel/'.$channel_owner->username.'')?>"><h4 style="color:#fff;margin-bottom:3px;line-height:20px;"><?=$channel_owner->first_name.' '.$channel_owner->last_name?></h4></a>
						<div class="post-meta"><span> <?=($followers == 1)?$followers.' Follower':$followers.' Followers';?></span></div>
						<div class="post-meta"><span><?=($num_owners_videos ==1)?$num_owners_videos.' Video':$num_owners_videos.' Videos';?></span></div>
						<div class="post-meta"><a href="<?=base_url('videotube/channel/'.$channel_owner->username.'/about')?>"><i class="fa fa-info"></i><span><strong> About</strong></span></a></div>
					</div>
				</div>
				<?php 
					if($followed=='yes')
					{
						$class = 'btn-danger';
						$text ='Following';
					}
					else
					{
						$class = 'btn-color-line';
						$text ='Follow';
					}
				?>			
				<div class="pull-right">
				<a id="follow2" href="#" class="btn btn-md <?=$class?> <?=($this->user->get_id() == $channel_owner->id)?'disabled':'';?>" style="background:#000;opacity:0.7;"><i class="fa fa-user left"></i><?=$text?></a>
				<div class="post-meta gallerylocation1"><!--<span>Galway, Ireland</span></div>-->
				</div>
			</div>
		</section>
		<?php endif;?>
        <!-- Work Detail Section -->
        <section class="ptb">
            <div class="container">
                <!-- work Filter -->
                <div class="row">
                    <ul class="container-filter categories-filter">
							<li><a class="categories active" data-filter="*">All Albums</a></li>					
						<?php foreach($albums as $album):?>
							<?php if($album->status != 'private' || ($album->status == 'private' && $this->user->get_id() == $album->user_id)):?>
								<li><a class="categories" data-filter=".<?=$album->name?>"><?=$album->name?></a></li>
							<?php endif;?>
						<?php endforeach;?>
                    </ul>
                </div>
                <!-- End work Filter -->
                <div class="container-masonry nf-col-3" style="">
					<?php foreach($videos as $video):?>
					<?php $video_album = new VideoTubeAlbum($video->album_id);?>
					<?php if($video_album->status != 'private' || ($video_album->status == 'private' && $this->user->get_id() == $video_album->user_id)):?>
                    <div class="nf-item <?=$video_album->name?> galleryboxspace" style="padding-left:3px;padding-bottom:2px;">
                        <div class="item-box">
                            <a href="<?=base_url('videotube/video/'.$video->id.'')?>">
									<video width="100%" style="margin-bottom:5px;" src="<?=checkImagePath($video->file)?>" class="img-responsive" controls>
										<source src="<?=checkImagePath($video->file)?>" type="video/mp4">
										<source src="<?=checkImagePath($video->file)?>" type="video/ogg">
										Your browser does not support HTML5 video.
									</video>
                                <div class="item-mask">
                                    <div class="item-caption">
                                        <h6 class="white"><?=$video->title?></h6>
										<p class="white"><?=$channel_owner->first_name.' '.$channel_owner->last_name?></p>
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
		
		<hr />

        <!-- Work Next Prev Bar -->
        <section class="space60">
            <div class="container">
                <div class="item-nav">
				<?php 	
					$user_galleries = array();
					$galleries = new User();
					foreach($galleries->get() as $gallery)
					{
						$video_user = new VideoTubeUserSettings();
						$video_user = $video_user->where('user_id',$gallery->id)->get();
						if($channel_owner->id != $gallery->id && $gallery->id == $video_user->user_id)
						{
							array_push($user_galleries,$gallery->username);
						}
					}
				?>
                    <a class="item-prev" href="<?=(!empty($user_galleries))?base_url('videotube/channel/'.$user_galleries[0].''):base_url('videotube/channel/'.$author->id.'')?>">
                        <div class="prev-btn"><i class="fa fa-angle-left"></i></div>
                        <div class="item-prev-text xs-hidden">
                            <h6>Prev Gallery</h6>
                        </div>
                    </a>
                    <a href="<?=base_url('videotube/channel/'.$channel_owner->username.'');?>" class="item-all-view">
                        <h6><?=$channel_owner->first_name.' '.$channel_owner->last_name?> Gallery</h6>
                    </a>
                    <a class="item-next" href="<?=(!empty($user_galleries))?base_url('videotube/channel/'.end($user_galleries).''):base_url('videotube/channel/'.$author->id.'')?>">
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
	<script>
	$(document).ready(function() {
		$('#follow2').click(function(){
			var permission = "<?=($this->session->userdata('user_id'))?'true':'false'?>";
			if(permission == 'true'){		
				<?php $logged_in_user = new User($this->user->id);?>
				follower_id = '<?=$logged_in_user->id;?>';
				following_id = '<?=$channel_owner->id;?>';
				if(follower_id == following_id){
					location.reload(true);
				}
				var $this = $(this);
				setTimeout(function(){
					$.get('<?=base_url()?>videotube/ajax/toggle_follow/' + follower_id + '/' + following_id, function(data){
						data = $.parseJSON(data);
						if(data.class == 'btn-color-line' && $this.hasClass('btn-color-line')){
							$this.removeClass(data.class);
							$this.hide().empty().text(data.text).addClass(data.activeclass).fadeIn('fast');
						}
						else{
							$this.removeClass(data.activeclass);
							$this.hide().empty().text(data.text).addClass(data.class).fadeIn('fast');
						}
					});
				}, 500);
			}
			else
				window.location.replace("<?=base_url('videotube/login')?>");		
		});
	});	
	</script>