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
			</div>
		</section>
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
		<?php if($gallery_option == 'wideopen'):?>
		<section class="dark-bg  galleryprofileheight">
			<div class="container">
				<div class="post-author">
					<div class="post-author-img pull-left">
						<a href="<?=base_url('photogallery/channel/'.$author->username.'')?>"><img alt="author" src="<?=$author->avatar?>"></a>
					</div>
					<div class="post-author-details pull-left">
						<a href="<?=base_url('photogallery/channel/'.$author->username.'')?>"><h4><?=$author->first_name?> <?=$author->last_name?></h4></a>
						<div class="post-meta"><span> <?=($followers == 1)?$followers.' Follower':$followers.' Followers';?> </span></div>
						<div class="post-meta"><span><?=($num_authors_photos ==1)?$num_authors_photos.' Photo':$num_authors_photos.' photos';?></span></div>
					</div>
				</div>
				<div class="pull-right">
						<a id="follow1" href="#" class="btn btn-md <?=$class?> <?=($this->user->get_id() == $author->id)?'disabled':'';?>"><i class="fa fa-user left"></i><?=$text?></a>
					<div class="post-meta gallerylocation1">
						<!--<span>Galway, Ireland</span>-->
					</div>
				</div>
			</div>
		</section>		
		<?php endif;?>
		<section class="galleryimageview">
			<div class="container">
				<div class="row">				
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<!--<div class="owl-carousel image-slider o-flow-hidden galleryview1">-->
							<div class="item">
							<?php 
								$left = array();
								$right = array();
								
								foreach($photos as $related)
								{
									if($related->id != $photo->id && $related->id != 0)
									{
										if($related->id < $photo->id)
										{
											array_push($left,$related->id);
										}
										else
											array_push($right,$related->id);
									}
								}
								?>
								<?php if(!empty($left)):?>
									<a class="hackL" href="<?=base_url('photogallery/photo/'.end($left).'')?>">
										<i class="fa fa-angle-left"></i>
									</a>
								<?php endif;?>
								<?php if(!empty($right)):?>
									<a class="hackR" href="<?=base_url('photogallery/photo/'.end($right).'')?>">
										<i class="fa fa-angle-right"></i>
									</a>
								<?php endif;?>
								<img src="<?=$photo->file?>" class="img-responsive" style="width:100%" alt="<?=$photo->description?>" />
							</div>
						<!--</div>-->
					</div>
				</div>
			</div>
		</section>
		<?php if($gallery_option == 'open'):?>
		<section class="dark-bg  galleryprofileheight">
			<div class="container">
				<div class="post-author">
					<div class="post-author-img pull-left">
						<a href="<?=base_url('photogallery/channel/'.$author->username.'')?>"><img alt="author" src="<?=$author->avatar?>"></a>
					</div>
					<div class="post-author-details pull-left">
						<a href="<?=base_url('photogallery/channel/'.$author->username.'')?>"><h4><?=$author->first_name?> <?=$author->last_name?></h4></a>
						<div class="post-meta"><span> <?=($followers == 1)?$followers.' Follower':$followers.' Followers';?> </span></div>
						<div class="post-meta"><span><?=($num_authors_photos ==1)?$num_authors_photos.' Photo':$num_authors_photos.' Photos';?></span></div>
					</div>
					<div class="post-author-details pull-left">
							<a id="follow2" href="#" class="btn btn-md <?=$class?> <?=($this->user->get_id() == $author->id)?'disabled':'';?>"><i class="fa fa-user left"></i><?=$text?></a>
						<div class="post-meta gallerylocation1">
							<!--<span>Galway, Ireland</span>-->
						</div>
					</div>
					<div class="post-author-details pull-left" style="margin-left:30px;">
						<h3 style="padding-top: 0px;margin-top:-7px;" ><?=$photo->title?></h3>
					</div>
				</div>
				<div class="pull-right">
					<p class="pull-left lead"><a id="like" style="color:66ff00;"  class="text-success" href="#"><i class="fa fa-thumbs-o-up fa-lg"></i> <span id="likes" ><?=$likes?></span></a></p>&nbsp;&nbsp;&nbsp;
					<p class="pull-right lead"><a id="unlike" style="color:ff3300;" class="text-danger " href="#"><i class="fa fa-thumbs-o-down fa-lg"></i> <span id="unlikes"> <?=$unlikes?></span></a></p>
					<br/>
					<p>
						<span>Views: <strong class="post-meta"> <?=$num_photo_views?></strong></span>
					</p>					
				</div>
			</div>
		</section>
		<?php endif;?>
		<section class="galleryphotodetails">
			<div class="container">
				<div class="row">
					<div class="col-md-4 space15">
						<div class="project-detail-block">
							<p>
								<strong class="dark-color">Photo Album: </strong><?=$album->name?>
							</p>
							<p>
								<strong class="dark-color">Uploaded:</strong><?=date('d.m.Y',$photo->time_created)?>
							</p>
							<?php if($gallery_option != 'open'):?>
							<p>
								<strong class="dark-color">Views:</strong><?=$num_photo_views?>
							</p>
							<?php endif;?>
							<?php if($allow_ratings == 'yes'):?>
							<p>
								<strong class="dark-color">Rating:</strong>
								<?php foreach($ratings as $item)
								      {$rate = round($item->rating);}

								$total_stars = 5;
								$empty_stars = $total_stars - $rate;
								
								if($rate < 1)
								{
									for($i = 1;$i <= 5;$i++)
									{
										echo '<a href="'.base_url().'photogallery/rate_photo?id='.$photo->id.'&rating='.$i.'" ><i class="fa fa-star-o"></i></a>';
									}
								}
								else
								{
									for($i = 1;$i<=$rate;$i++)
									{
										echo '<a href="'.base_url().'photogallery/rate_photo?id='.$photo->id.'&rating='.$i.'" ><i class="fa fa-star"></i></a>';
									}
									for($j = 1,$k = $rate + 1;$j<=$empty_stars;$j++,$k++)
									{
										echo '<a href="'.base_url().'photogallery/rate_photo?id='.$photo->id.'&rating='.$k.'" ><i class="fa fa-star-o"></i></a>';
									}
								}?>
							</p>
							<?php endif;?>
							<p>
								<strong class="dark-color">Comments:</strong><?=$comments->count();?>
							</p>
							<style>
								.show{display:block;}
								.hide{display:none}
							</style>
							<?php if($gallery_option == 'open'):?>
							<div class="sidebar-widget">
								<button id="reportphoto" class="btn btn-md btn-black-line"><i class="fa fa-exclamation-triangle fa-lg"></i> Report Photo</button>
							</div>
							<div id="reportphotoForm" class="hide" style="border:1px solid #ddd">
								<div class="modal-header">
									<h4 class="modal-title" id="myModalLabel">Report photo</h4>
								</div>
								<form method="get" action="<?=base_url('photogallery/report_photo/')?>">
									<div class="modal-body">
										<input type="hidden" name="media_id" value="<?=$photo->id?>">
										<p>Please describe what aspect of this photo or it's author you find inadequate, inappropriate or insulting</p>
										<div class="form-group">
											<textarea class="form-control" name="text" placeholder="Describe your reason for reporting this photo"></textarea>
										</div>
									</div>
									<div class="modal-footer">
										<button id="close" type="button" class="btn btn-default" style="padding:3px 3px 3px">Cancel</button>
										<button type="submit" class="btn btn-danger"  style="padding:3px 3px 3px">Report</button>
									</div>
								</form>
							</div>
							<?php endif;?>
						</div>
					</div>
					<div class="col-md-8">
						<div class="row">
							<div class="col-md-9">
							<?php if($gallery_option != 'open'):?>
								<h3><?=$photo->title?></h3>
							<?php endif;?>
								<p><?=stripslashes(str_replace('\r\n', '',$photo->description));?></p>
							</div>
							<?php if($gallery_option != 'open'):?>
							<div class="col-md-3">
								<p class="pull-left lead"><a class="text-success" href="#"><i class="fa fa-thumbs-o-up fa-lg"></i> <?=$likes?></a></p>
								<p class="pull-right lead"><a class="text-danger " href="#"><i class="fa fa-thumbs-o-down fa-lg"></i> <?=$unlikes?></a></p>
							</div>
							<?php endif;?>
						</div>
					</div>
				</div>
			</div>
		</section>

        <hr />

        <section class="ptb">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="clearfix"></div>
						<?php if($this->BuilderEngine->get_option('photogallery_comments_private')== 'public'|| ($this->BuilderEngine->get_option('photogallery_comments_private')== 'private' && $this->user->is_logged_in())):?>
                        <div class="post-comment">
                            <h4>Comments <span class="comment-numb">(<?=$comments->count()?>)</span></h4>
                            <ul class="comment-list mt-30">
								<? $i =1;?>
								<?php foreach($comments as $comment):?>
								<?php $comment_author = new User($comment->user_id);?>
                                <li>
                                    <div class="comment-avatar">
										<?php if($comment_author->id != 0):?>
                                        <a href="<?=base_url('photogallery/channel/'.$comment_author->username.'')?>"><img src="<?=$comment_author->avatar?>" alt="Comment Author"></a>
										<?php else:?>
										<a href="#"><img src="<?=base_url('builderengine/public/img/avatar.png')?>" alt="Comment Author"></a>
										<?php endif;?>
                                    </div>
                                    <div class="">
                                        <div class="comment-detail">
                                            <a href="<?=base_url('photogallery/channel/'.$comment_author->username.'')?>"><h6><?=$comment_author->first_name?> <?=$comment_author->last_name?></h6></a>
                                            <div class="post-meta"><span><?=date('M d, Y',$comment->time_created)?></span></div>
                                            <p><?=stripslashes(str_replace('\r\n', '',$comment->text));?></p>
											<?php if($this->user->is_logged_in()):?>
											<a id="reportButton<?=$i?>" class="btn btn-xs btn-warning" style="padding:3px 3px 3px">Report</a>
											<?php endif;?>
											<?php if($this->user->is_member_of("Administrators")): ?>
												<a href="<?=base_url('photogallery/delete_comment/'.$comment->id.'')?>" class="btn btn-danger" style="padding:3px 3px 3px">Delete</a>
											<?php endif; ?>

											<div id="reportDiv<?=$i?>" class="hide" style="border:1px solid #ddd;margin-top:5px;">
												<div class="modal-header">
													<h4 class="modal-title" id="myModalLabel">Report Comment</h4>
												</div>
												<form id="reportForm<?=$i?>" method="get" action="<?=base_url('photogallery/report_comment/')?>">
													<div class="modal-body">
														<input type="hidden" name="comment_id" value="<?=$comment->id?>">
														<p>Please describe what aspect of this comment or it's author you find inadequate, inappropriate or insulting</p>
														<div class="form-group">
															<textarea class="form-control" name="text" placeholder="Describe your reason for reporting this comment"></textarea>
														</div>
													</div>
													<div class="modal-footer">
														<button id="closeForm<?=$i?>" type="button" class="btn btn-default" style="padding:3px 3px 3px">Cancel</button>
														<button id="subForm<?=$i?>" type="submit" class="btn btn-danger"  style="padding:3px 3px 3px">Report</button>
													</div>
												</form>
											</div>
											
                                        </div>
                                    </div>
                                </li>
								<?php $i++;?>
								<?php endforeach;?>
                            </ul>
                        </div>
						<?php if($allow_comments =='yes'):?>
                        <div id="posted" class="space40">
                            <h4>Leave a comment</h4>
                            <div class="row">
                                <form id="postForm" method="post">
                                    <div>
                                        <div class="col-md-12">
                                            <textarea placeholder="Message" name="message" id="message" class="form-full" required></textarea>
                                        </div>
                                        <div class="col-md-12">
											<input type="hidden" name="media_id" value="<?=$photo->id?>">
                                            <button id="poster" type="submit" class="btn btn-lg btn-black">Post</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
						<?php endif;?>
					<?php endif;?>
                    </div>
					
					<div class="col-md-4">
						<?php if($gallery_option != 'open'):?>
						<!--
						<div class="sidebar-widget">
                            <button class="btn btn-md btn-black-line"><i class="fa fa-exclamation-triangle fa-lg"></i> Report Photo</button>
                        </div>-->
						<?php endif;?>
						<div class="sidebar-widget">
                            <h5>Search</h5>
                            <div class="widget-search">
								<form class="navbar-form" method="get" action="<?=base_url('/photogallery/search')?>" >
									<input class="form-full input-lg" type="text" value="" placeholder="Search Here" name="keyword" id="wid-search">
									<input type="submit" value="" id="wid-s-sub">
								</form>
                            </div>
                        </div>
						<?php if($photo->tags != '' && $show_tags == 'yes'): ?>
						<div class="sidebar-widget">
                            <h5>Tags</h5>
                            <hr>
                            <ul class="widget-tag">
							    	<?php
										$tags = explode(',',$photo->tags);
									?>
									<?php $i = 1;?>
								    <?php foreach($tags as $tag): ?>
										<?php if($i <= $num_tags):?>
								        <li><a href="<?=base_url('photogallery/search/'.$tag)?>" > <?=$tag?></a></li>
										<?php $i++;?>
										<?php else:?>
										<?php endif;?>
									<?php endforeach; ?>
                            </ul>
                        </div>
						<?php endif; ?>
						
						<?php if($num_albums > 0):?>
							<div class="sidebar-widget">
								<h5>Albums</h5>
								<hr>
								<ul>
									<?php foreach($author_albums as $author_album):?>
										<?php if($author_album->status != 'private' || ($author_album->status == 'private' && $this->user->get_id() == $author_album->user_id)):?>
											<li><a href="<?=base_url('photogallery/channel/'.$author->username.'/album/'.$author_album->id.'');?>"><?=$author_album->name?><?=($author_album->status == 'private')?' - (Private)':'';?></a></li>
										<?php endif;?>
									<?php endforeach;?>
								</ul>
							</div>
						<?php endif;?>
                    </div>
                </div>
            </div>
        </section>

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
						$photo_user = new PhotoGalleryUserSettings();
						$photo_user = $photo_user->where('user_id',$gallery->id)->get();
						if($author->id != $gallery->id && $gallery->id == $photo_user->user_id)
						{
							array_push($user_galleries,$gallery->username);
						}
					}
				?>
                    <a class="item-prev" href="<?=(!empty($user_galleries))?base_url('photogallery/channel/'.$user_galleries[0].''):base_url('photogallery/channel/'.$author->id.'')?>">
                        <div class="prev-btn"><i class="fa fa-angle-left"></i></div>
                        <div class="item-prev-text xs-hidden">
                            <h6>Prev Gallery</h6>
                        </div>
                    </a>
                    <a href="<?=base_url('photogallery/channel/'.$author->username.'');?>" class="item-all-view">
                        <h6><?=$author->first_name.' '.$author->last_name?> Gallery</h6>
                    </a>
                    <a class="item-next" href="<?=(!empty($user_galleries))?base_url('photogallery/channel/'.end($user_galleries).''):base_url('photogallery/channel/'.$author->id.'')?>">
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
		$('#like').click(function(){
			var permission = "<?=($this->session->userdata('user_id'))?'true':'false'?>";
			if(permission == 'true'){
				<?php $logged_in_user = new User($this->user->id);?>
				user_id = '<?=$logged_in_user->id;?>';
				photo_id = '<?=$photo->id;?>';
				likes = $('#likes').html();
				status = 'like';
				setTimeout(function(){
					$.get('<?=base_url()?>photogallery/ajax/toggle_like_photo/' + user_id + '/' + photo_id + '/' + status, function(data){
						data = $.parseJSON(data);
						$('#likes').hide().empty().text(data.likes).fadeIn('fast');	
					});
				}, 500);
			}
			else
				window.location.replace("<?=base_url('photogallery/login')?>");
		});
		$('#unlike').click(function(){
			var permission = "<?=($this->session->userdata('user_id'))?'true':'false'?>";
			if(permission == 'true'){		
				<?php $logged_in_user = new User($this->user->id);?>
				user_id = '<?=$logged_in_user->id;?>';
				photo_id = '<?=$photo->id;?>';
				likes = $('#unlikes').html();
				status = 'unlike';
				setTimeout(function(){
					$.get('<?=base_url()?>photogallery/ajax/toggle_like_photo/' + user_id + '/' + photo_id + '/' + status, function(data){
						data = $.parseJSON(data);
						$('#unlikes').hide().empty().text(data.unlikes).fadeIn('fast');						
					});
				}, 500);
			}
			else
				window.location.replace("<?=base_url('photogallery/login')?>");			
		});
		$('#follow1').click(function(){
			var permission = "<?=($this->session->userdata('user_id'))?'true':'false'?>";
			if(permission == 'true'){
				<?php $logged_in_user = new User($this->user->id);?>
				follower_id = '<?=$logged_in_user->id;?>';
				following_id = '<?=$author->id;?>';
				if(follower_id == following_id){
					location.reload(true);
				}
				setTimeout(function(){
					$.get('<?=base_url()?>photogallery/ajax/toggle_follow/' + follower_id + '/' + following_id, function(data){
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
				window.location.replace("<?=base_url('photogallery/login')?>");		
		});
		$('#follow2').click(function(){
			var permission = "<?=($this->session->userdata('user_id'))?'true':'false'?>";
			if(permission == 'true'){		
				<?php $logged_in_user = new User($this->user->id);?>
				follower_id = '<?=$logged_in_user->id;?>';
				following_id = '<?=$author->id;?>';
				if(follower_id == following_id){
					location.reload(true);
				}
				var $this = $(this);
				setTimeout(function(){
					$.get('<?=base_url()?>photogallery/ajax/toggle_follow/' + follower_id + '/' + following_id, function(data){
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
				window.location.replace("<?=base_url('photogallery/login')?>");		
		});
		
		$('#reportphoto').click(function(event){
			$('#reportphotoForm').addClass('show').fadeIn(600).addClass('animated fadeInLeft');
			event.preventDefault();
		});
		$('#close').click(function(event){
			$('#reportphotoForm').removeClass('show').fadeOut(600);
			$('#reportphotoForm').addClass('hide').fadeIn(600);				
			event.preventDefault();
		});	
		$('#poster').click(function(event){
			$('#posted').addClass('animated zoomOut').fadeIn(600);
			$( "#postForm" ).submit();			
			event.preventDefault();
		});			
		<?php $i =1;?>
		<?php foreach($comments as $comment):?>
			$('#reportButton<?=$i?>').click(function(event){
				$('#reportDiv<?=$i?>').addClass('show').fadeIn(600).addClass('animated fadeInLeft');	
				event.preventDefault();
			});
			$('#subForm<?=$i?>').click(function(event){
				$('#reportDiv<?=$i?>').addClass('animated zoomOut').fadeIn( 800 );
				$('#reportForm<?=$i?>').submit();
				event.preventDefault();
			});
			$('#closeForm<?=$i?>').click(function(event){
				$('#reportDiv<?=$i?>').removeClass('show').fadeOut(1000);
				$('#reportDiv<?=$i?>').addClass('hide').fadeIn(600);				
				event.preventDefault();
			});				
		<?php $i++;?>
		<?php endforeach;?>
	});	
	</script>