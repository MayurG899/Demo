<?php require_once('assets_loader.php');?>
<div id="blog-wrapper">
	<div id="blog">
		<div class="container be-blog-container-responsive">
		<div class="col-md-12">
		<div class="blog-nav-title">
				<?php $cat = $categories->where('id',$post->category_id)->get();?>
				<h3><?=stripslashes(str_replace('_',' ',$cat->name))?></h3>

				<ul class="be-breadcrumb">
					<li><a href="<?=base_url()?>">Home</a></li>
                    <li><a href="<?=base_url()?>blog/all_posts">Blog</a></li>
                    <?php if($cat->parent_id > 0):?>
					<?php $parent_cat = new Category($cat->parent_id);?>
					<li><a href="<?=base_url('blog/category/'.$parent_cat->id)?>"><?=stripslashes(str_replace('_',' ',$parent_cat->name))?></a></li>
					<?php endif;?>					
					<li><a href="<?=base_url()?>blog/category/<?=$post->category_id?>"><?=stripslashes(str_replace('_',' ',$cat->name))?></a></li>
					<li class="active"><?=stripslashes(str_replace('_',' ',$post->title))?></li>
				</ul>
			</div>
		</div>
		</div>

		<section class="container be-blog-container-responsive">
			<div class="">
				<div class="col-md-9">
					<div class="blog-post-container block-colors-light block-colors-light-bg">
					<div class="blog-post">
						<h3><?=stripslashes(str_replace('_',' ',$post->title))?></h3>
						<div class="space18">
					         <?php $post_comments=array();?>
                             <?php foreach($comments as $comment)
					          {array_push($post_comments,$comment->id);}
					         ?>							
							<a href="#comments" class="scrollTo label label-colors label-md"><i class="fa fa-comment-o"></i> <?=$count = count($post_comments);?> <?=$pluralizer = ($count == 1) ? 'Comment' : 'Comments' ;?></a>
							<span class="label label-colors label-md"><b>Date:</b> <?=date('d M Y',$post->time_created)?></span> 
							<a href="<?=base_url('cp/user/'.$user->id)?>" class="label label-colors blog-post-container-label-posted pull-right"><b>Blog:</b> <?=$pub_user->first_name.' '.$pub_user->last_name;?></a>
						</div>
					</div>

					<?php if(!empty($post->image)): ?>
					<div class="blog-post-image">
						<img src="<?=checkImagePath($post->image)?>" class="img-responsive blog-post-thumbnail" alt="<?=$post->slug?>" />
					</div>
					<?php endif; ?>
					<div><?php $txt = str_replace('\"','"',ChEditorfix($post->text));?>
                        <?=str_replace('/files/be_demo',base_url('files/be_demo'),$txt)?>
					</div>

					<hr />

					<?php if($this->BuilderEngine->get_option('be_blog_show_tags') != 'no'): ?>
						<p> <b>Blog Tags: </b>
	                        <?php foreach($post as $item): ?>
	                        	<?php if($item->tags != ''): ?>
							    	<?php $tags = explode(',',$item->tags); ?>
								    <?php foreach($tags as $tag): ?>
								        <a class="label label-colors label-md" href="<?=base_url('blog/search/'.stripslashes($tag))?>" ><i class="fa fa-tags"></i> <?=stripslashes(str_replace('_',' ',$tag))?></a> 
									<?php endforeach; ?>
								<?php else: ?>
									-
								<?php endif; ?>
							<?php endforeach; ?>
							<div class="clearfix"></div>
						</p>
					<?php endif;?>


                <?php if($post->comments_allowed != 'hide' && $this->BuilderEngine->get_option('be_blog_allow_comments') == 'yes'):?>
					<div id="comments">
						<h4>Blog: <?=$count?> <?=$pluralizer?></h4>

						<?php $i = 1;?>
					 	<?php foreach($comments->all as $comment):?>
						<div class="comment">
							<span class="user-avatar">
								<?php if($comment->user_id == 0 || $comment->user_id == ''):?>
									<img class="" src="<?=get_theme_path()?>/images/avatars/no_avatar.jpg" alt="">
								<?php else:?>
									<?php $commenter = new User($comment->user_id);?>
									<?/*
									<?php $users = new Users();?>
									<?php $allow_avatar = new Setting();?>
									<?php
										if($users->is_admin_by_id($comment->user_id) || isset($allow_avatar->get_user_settings($comment->user_id)->all[0]->allow_avatar) && $allow_avatar->get_user_settings($comment->user_id)->all[0]->allow_avatar != 0)
											$allow_avatar = 1;
										else
											$allow_avatar = 0;
									?>
									<?php if((!isset($commenter->avatar) || $commenter->avatar == '') || !intval($allow_avatar)):?>
										<img class="" src="<?=get_theme_path()?>/images/avatars/no_avatar.jpg" alt="">
									<?php else:?>
										<img class="" src="<?=checkImagePath($commenter->avatar)?>" alt="">
									<?php endif;?>
									*/?>
									<?if($commenter->avatar != ''):?>
										<img class="" src="<?=checkImagePath($commenter->avatar)?>" alt="<?=$commenter->first_name.' '.$commenter->last_name;?>">
									<?else:?>
										<img class="" src="<?=get_theme_path()?>/images/avatars/no_avatar.jpg" alt="">
									<?endif;?>
								<?php endif;?>
							</span>
							<div class="btn-group pull-right" role="group">
								<a href="#commentForm" data-toggle="modal" data-target="#report<?=$i?>" class="btn btn-sm btn-warning">Report</a>
								<?php if($this->user->is_member_of("Administrators")): ?>
									<a href="javascript:;" data-id="<?=$comment->id?>" class="btn btn-sm btn-danger delete-comment">Delete</a>
								<?php endif; ?>
							</div>
							<div class="media-body be-blog-commment-name">
								<?
									if($comment->user_id != 0){
										$name = $commenter->first_name.' '.$commenter->last_name;
										$profile_link = base_url('cp/user/'.$commenter->id);
									}else{
										if($comment->name == '')
											$name = 'Guest';
										else
											$name = $comment->name;
										$profile_link = 'javascript:;';
									}
								?>
								<a href="<?=$profile_link?>"><h4 class="media-heading"><?=$name;?></h4></a>
								<small class="be-blog-comment-date">Replied: <?=date('d M Y &#9478; h:i',$comment->time_created)?></small>
								<br/>
								<p><?=stripslashes($comment->text)?></p>
							</div>

							
							<!-- Modal -->
							<div class="modal fade" id="report<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							  	<div class="modal-dialog" style="z-index:10">
							    	<div class="modal-content">
							      		<div class="modal-header">
							        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        		<h4 class="modal-title" id="myModalLabel">Report Comment</h4>
							      		</div>
							      		<form method="post" action="<?=base_url('blog/report_comment/')?>">
								      		<div class="modal-body">
								      			<input type="hidden" name="comment_id" value="<?=$comment->id?>">
								        		<p>Please describe what aspect of this comment you find inadequate or inappropriate</p>
									        	<div class="form-group">
												    <textarea class="form-control" name="text" placeholder="Describe your reason for reporting this comment"></textarea>
												</div>
								      		</div>
									      	<div class="modal-footer">
									        	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
									        	<button type="submit" name="report" class="btn btn-primary">Report Comment</button>
									      	</div>
								    	</form>
							    	</div>
							  	</div>
							</div>
						</div>
						<?php $i++;?>
					  	<?php endforeach?>
						<?php if($this->BuilderEngine->get_option('be_blog_allow_comments') =='yes' && $post->comments_allowed != 'no'):?>
					  	<?php if($this->BuilderEngine->get_option('be_blog_comments_private') == 'private'):?>
					  		<?php if(!$user->is_guest()): ?>
								<hr>
								<h4>Post Your Comment</h4>
								<form id="commentForm" class="form-horizontal" method="post">
		                            <input type="hidden" name="post_id" value="<?=$post->id?>">
									<div class="row">
										<div class="col-md-12">
											<textarea required class="form-control input-md" id="comment" name="text" rows="5" placeholder="Reply to this blog post"><?=set_value('text')?></textarea>
											<?=form_error('text')?>
										</div>
									</div>
									<br>
									<?php $check_captcha = $this->BuilderEngine->get_option('be_blog_captcha') == 'yes'; ?>
									<?php if($check_captcha): ?>
									<div class="row">
										<div class="col-md-2">
											<label>Captcha *</label>
										</div>
										<div class="col-md-3">
											<input required class="form-control input-md" type="text" name="captcha" id="captcha" />
										</div>
										<div class="col-md-4">
											<?=$captcha?>
										</div>
										<div class="clearfix"></div>
										<?=form_error('captcha')?>
									</div>
									<br>
									<?php endif; ?>
									<div class="row">
										<div class="col-md-12">
											<p><button class="btn btn-md btn-primary">Post Comment</button></p>
										</div>
									</div>
								</form>
							<?php endif; ?>
						<?php else: ?>
							<hr>
							<h4>Post Your Comment</h4>
							<form id="commentForm" class="form-horizontal" method="post">
								<div class="row">
	                             	<input type="hidden" name="post_id" value="<?=$post->id?>">
	                             	<?php if(!empty($user) && isset($user) && $user->is_guest()) :?>
										<div class="row">
											<div class="col-md-2">
											<label>Enter Name *</label>
											</div>
											<div class="col-md-4">
											<input required class="form-control input-md" type="text" name="name" placeholder="Write your name" id="author" value="<?=set_value('name')?>" />
											<?=form_error('name')?>
											</div>
										</div>
										<br>
										<?php
										/*<div class="col-md-4">
											<label>Email *</label>
											<input required class="form-control input-lg" type="text" name="author_email" id="email" value="" />
										</div>*/?>
									<?php endif; ?>
								</div>
								<div class="row">
									<div class="col-md-12">
										<textarea required class="form-control input-md" id="comment" name="text" rows="5" placeholder="Reply to this blog post"><?=set_value('text')?></textarea>
										<?=form_error('text')?>
									</div>
								</div>
								<br>
								<?php $check_captcha = $this->BuilderEngine->get_option('be_blog_captcha') == 'yes'; ?>
								<?php if($check_captcha): ?>
								<div class="row">
									<div class="col-md-2">
										<label>Captcha *</label>
									</div>
									<div class="col-md-3">
										<input required class="form-control input-md" type="text" name="captcha" id="captcha" />
									</div>
									<div class="col-md-4">
										<?=$captcha?>
									</div>
									<div class="clearfix"></div>
									<?=form_error('captcha')?>
								</div>
								<br>
								<?php endif; ?>
								<div class="row">
									<div class="col-md-12">
										<p><button class="btn btn-md btn-primary">Post Comment</button></p>
									</div>
								</div>
							</form>
						<?php endif; ?>
						<?php endif;?>
					</div>
				<?php endif;?>
				</div>
			</div>
				<!-- SIDEBAR -->
				<div class="col-md-3 block-colors-light">

					<!-- blog search -->
					<div class="blog-widget">
						<h4>Search</h4>
						<form method="get" action="<?=base_url('/blog/search')?>" class="input-group">
							<input type="text" class="form-control form-control-be-40" name="keyword" placeholder="Search Blog" />
							<span class="input-group-btn">
								<button class="btn btn-lg btn-colors"><i class="fa fa-search"></i></button>
							</span>
						</form>
					</div>

					<!-- Categories -->
					<div class="blog-widget">
						<h4>Categories</h4>
						<ul class="nav nav-list">
						  <li><a href="<?=base_url('blog/all_posts')?>"><i class="fa fa-th-large"></i>Blog Homepage</a></li>
						  <?php $i = 1;?>
						  <?php foreach($categories as $parent_category):?>
						    <?php if($parent_category->parent_id == 0):?>

						      <?php if($parent_category->has_children()):?>
						        <li id="parent<?=$i?>"><a href="<?=base_url('blog/category/'.$parent_category->id)?>"><i class="fa fa-plus-circle"></i><?=stripslashes(str_replace('_',' ',$parent_category->name))?></a></li>
						          <ul class="child<?=$i?> nav nav-list" style="display: none; margin-left: 10%">
						                <li><a href="<?=base_url('blog/category/'.$parent_category->id)?>"><i class="fa fa-th-large"></i>All Posts: <?=stripslashes(str_replace('_',' ',$parent_category->name))?></a></li>
						            <?php foreach($categories as $category):?>
						              <?php if($category->parent_id == $parent_category->id):?>
						                <li><a href="<?=base_url('blog/category/'.$category->id)?>"><i class="fa fa-arrow-circle-o-right"></i><?=stripslashes(str_replace('_',' ',$category->name))?></a></li>
						              <?php endif;?>
						            <?php endforeach;?>
						          </ul>
						      <?php else:?>
						        <li><a href="<?=base_url('blog/category/'.$parent_category->id)?>"><i class="fa fa-arrow-circle-o-right"></i><?=stripslashes(str_replace('_',' ',$parent_category->name))?></a></li>
						      <?php endif;?>

						    <?php endif;?>
						    <?php $i++;?>
						  <?php endforeach;?>
						</ul>

						<style>
						.visible-li
						{
						  display: block !important;
						}
						</style>
						<?php $number_of_parents = $categories->where('parent_id', 0)->get()->count();?>
						<script>
						$(document).ready(function()
						{
							var number = "<?=$number_of_parents?>";
							for (var i = 1; i < number; i++) 
							{
								$("#parent" + i).click( createCallback( i ) );
							}

							$('.delete-comment').click(function(e){
								e.preventDefault();
								var id = $(this).attr('data-id');
								$('#delete-comment input[name=comment_id]').val(id);
								$('#delete-comment').modal('show');
							})

						});

						function createCallback( i ){
							return function(event){
								event.preventDefault();
								if($(".child" + i).hasClass('visible-li'))
									$(".child" + i).removeClass('visible-li');
								else
									$(".child" + i).addClass('visible-li');
							}
						}
						</script>
					</div>
					<!-- recent posts -->
					<div class="blog-widget">
						<h4>Recent Posts</h4>
						<ul class="nav nav-list be-blog-recent">
						<?php
						   $all_posts = new Post();
						   $recent_posts = $all_posts->where('category_id !=',$unallocated_category->id)->order_by('time_created','desc');
						   $recent_post_limit = $this->BuilderEngine->get_option('be_blog_num_recent_posts_displayed');
                            if($recent_post_limit == '' || $recent_post_limit == 0)
                                $recent_post_limit = 5;
						   $j=1;
						?>
						<?php foreach ($recent_posts->get() as $recent_post):?>
					        <?php if($j <= $recent_post_limit):?>
							    <li><a href="<?=base_url()?>blog/post/<?=$recent_post->slug?>"><h5><i class="fa fa-caret-right"></i><?=stripslashes(str_replace('_',' ',$recent_post->title))?></h5> <small><i class="fa fa-clock-o be-blog-clock"></i><?=date('d M Y &#9478; h:i',$recent_post->time_created)?></small></a></li>
							<?php $j++?>
							<?php else:?>
                            <?php endif?>							
						<?php endforeach?>	
						</ul>
					</div>
				</aside>
				<!-- /SIDEBAR -->
			</div>
		</section>
	</div>
</div>
<!-- /WRAPPER -->
<?php if($this->user->is_member_of("Administrators")): ?>
<div class="modal fade" id="delete-comment" tabindex="-1" role="dialog" aria-hidden="true">
  	<div class="modal-dialog" style="z-index:10">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title">Delete comment</h4>
      		</div>
      		<form method="post" action="<?=base_url('blog/deleteComment')?>">
      			<div class="modal-body">
	        		<p>Are you sure you want to delete this comment?</p>
	        		<input type="hidden" name="comment_id">
	      		</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        	<button type="submit" class="btn btn-primary">Delete</button>
		      	</div>
	    	</form>
    	</div>
  	</div>
</div>
<?php endif; ?>