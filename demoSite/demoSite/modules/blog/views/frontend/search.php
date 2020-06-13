<?php require_once('assets_loader.php');?>

<div id="blog-wrapper">
	<div id="blog">
		
		<div class="container be-blog-container-responsive">
		<div class="col-md-12">
		<div class="blog-nav-title">
				<h3>Search Results for <b>"<?=$keyword?>"</b></h3>

				<ul class="be-breadcrumb">
					<li><a href="<?=base_url()?>">Home</a></li>
                    <li><a href="<?=base_url()?>blog/all_posts">Blog</a></li>
                    <li class="active">Search Blog Posts</li>
				</ul>
				
				<!-- blog search -->
					<div class="blog-widget">
						<form method="get" action="<?=base_url('/blog/search')?>" class="input-group">
							<input type="text" class="form-control form-control-be-40" name="keyword" placeholder="Search Blog" />
							<span class="input-group-btn">
								<button class="btn btn-lg btn-colors"><i class="fa fa-search"></i></button>
							</span>
						</form>
					</div>	
				</div>
			</div>
		</div>

		<section class="container be-blog-container-responsive masonry-sidebar block-colors-light">
			<div class="">
				<div class="col-md-9">
                    
					<ul class="masonry-list block-colors-light">
					<?php $total = count((array)$posts->id);?>
					<?php if($total > 0):?>
                     <?php foreach($posts as $post):?>
						<?php if($post->category_id != $unallocated_category->id):?>
							<li class="masonry-item block-colors-light-bg">
								<div class="item">
									<div class="item-title">
										<h3><a href="<?=base_url()?>blog/post/<?=$post->slug?>"> <?=stripslashes(str_replace('_',' ',$post->title))?></a></h3>
									    <?php $post_author = new User($post->user_id)?>
										<a href="<?=base_url('cp/user/'.$user->id)?>" class="label label-colors"><?=$post_author->first_name.' '.$post_author->last_name;?></a>
									        <?php $post_comments = array();
											      $comments = new Comment;
				                                   foreach($comments->where('post_id',$post->id)->get() as $comment)
									                {array_push($post_comments,$comment->id);}
											      $num_comments = count($post_comments);
											      $pluralizer = ($num_comments == 1) ? 'Comment' : 'Comments' ;
									        ?>											
										<a href="<?=base_url('blog/post').'/'.$post->slug?>#comments" class="label label-colors"><i class="fa fa-comment-o"></i>&nbsp; <?=$num_comments?> <?=$pluralizer?></a>
										<span class="label label-colors"><b>Date:</b> <?=date('M d, Y', $post->time_created)?></span> 
									</div>
									<?php if($post->image != ''): ?>
									<figure>
										<a href="<?=base_url()?>blog/post/<?=$post->slug?>"><img src="<?=checkImagePath($post->image)?>" class="img-responsive" alt="<?=$post->slug?>" /></a>
									</figure>
									<?php endif; ?>
									<?php
									$text_without_slashes = strip_tags(ChEditorfix($post->text));
                                    if(strlen($post->text) > 300)
                                    {
                                        $text = substr($text_without_slashes, 0, 300).'...';
                                    }
                                    else{
                                        $text = $text_without_slashes;
                                    }
									?>
									<?=$text?>
									<p>
									<a href="<?=base_url('blog/post').'/'.$post->slug?>" class="btn btn-colors btn-sm pull-right"><i class="fa fa-caret-right"></i> READ MORE</a>
									</p>
								</div>
							<br/>
                            <div class="divider"></div>
							</li>
						<?php endif;?>
                      <?php endforeach?>
					  <?php else:?>
						<h4 class="text-center be-blog-no-results"> Nothing Found for <b>"<?=$keyword?>"</b> <br>Please Search Again</h4>
					  <?php endif;?>
					</ul>

					<div class="clearfix"></div>

					<!-- PAGINATION -->
					<div class="text-center">
						<ul class="be-pagination">
							<?php $number_of_posts = $posts->count()?>
							<?php if(!$this->BuilderEngine->get_option('be_blog_num_posts_displayed'))
					        {
					            $posts_per_page = 6;
					        }
					        else
					            $posts_per_page = $this->BuilderEngine->get_option('be_blog_num_posts_displayed');?>
					        <?php $total_pages = ceil($number_of_posts / $posts_per_page);?>

					        <?php if(!isset($_GET['page']))
					        	$current_page = 1;
					       	else
					       		$current_page = $_GET['page'];?>

					       	<?php $back_page =  $current_page - 1;?>
					       	<?php if($back_page > 0):?>
								<li><a href="<?=base_url('blog/all_posts/?page='.$back_page)?>"><i class="fa fa-chevron-left"></i></a></li>
							<?php endif;?>
							
					        <?php for ($i = 1; $i <= $total_pages; $i++):?>
					        	<li><a href="<?=base_url('blog/all_posts/?page='.$i)?>" <?php if($i == $current_page) echo 'class="active"'?>><?=$i?></a></li>
					        <?php endfor;?>

					        <?php $front_page =  $current_page + 1;?>
					       	<?php if($front_page <= $total_pages):?>
								<li><a href="<?=base_url('blog/all_posts/?page='.$front_page)?>"><i class="fa fa-chevron-right"></i></a></li>
							<?php endif;?>
						</ul>
					</div>
					<!-- /PAGINATION -->

				</div>

				<div class="col-md-3">

                    <!-- TAGS -->
                    <?php if($this->BuilderEngine->get_option('be_blog_show_tags') != 'no'):?>
                        <div class="blog-widget">
							<h4>Tags Search Results</h4>
                            <?php
                            $available_tags = array();
                            $set_limit = $this->BuilderEngine->get_option('be_blog_num_tags_displayed');
                            if($set_limit == '' || $set_limit == 0)
                                $set_limit = 120;
                            foreach($posts as $post)
                            {
                                $tags = explode(',',$post->tags);
                                foreach($tags as $tag)
                                {
                                    array_push($available_tags,$tag);
                                }
                            }
                            $available_tags = array_unique($available_tags);
                            $available_tags = array_slice($available_tags,0,$set_limit);
                            ?>
                            <?php foreach($available_tags as $tag):?>
                                <a class="label label-colors label-md" href="<?=base_url('blog/search/'.$tag)?>"><i class="fa fa-tags"></i> <?=stripslashes(str_replace('_',' ',$tag))?></a>
                            <?php endforeach?>
                            <div class="clearfix"></div>
                        </div>
                    <?php endif;?>
			
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

				</div>

			</div>
		</section>

	</div>
</div>
<!-- /WRAPPER -->