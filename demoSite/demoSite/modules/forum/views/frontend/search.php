<?php require_once('assets_loader.php');?>	
<?php require_once('forum_helper.php');?>
	<div class="page-title">
        <!-- begin container -->
        <div class="container">
			<ul class="forums-topbar pull-right">
					<li>
						<form class="navbar-form" method="get" action="<?=base_url('/forum/search')?>" >
							<div class="form-group">
								<input type="text" class="form-control" name="keyword" placeholder="Enter Keywords..." />
								<button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
							</div>
						</form>
					</li>
					<?php $user = new User();?>
					<?php if(!$this->user->is_logged_in()):?>
                    <li><a href="<?=base_url('forum/login')?>" type="button" class="btn btn-default">Sign In</a></li>
					<li><a href="<?=base_url('forum/register')?>" type="button" class="btn btn-default">Create Account</a></li>
					<?php else:?>
					<li><a href="<?=base_url('forum/logout')?>" type="button" class="btn btn-default">Log Out</a></li>
					<?php endif;?>
            </ul>
            <!-- begin breadcrumb -->
            <ul class="breadcrumb">
                <li><a href="<?=base_url('forum/all_topics')?>">Forum</a></li>
                <li class="active">&nbsp;</li>
            </ul>
            <!-- end breadcrumb -->
            <h1 class="pull-left">Forum Search</h1>
			 
        </div>
        <!-- end container -->
    </div>
    <!-- begin content -->
    <div class="content">
        <!-- begin container -->
        <div class="container">
            <!-- begin panel-forum -->
			<div class="panel panel-forum">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="#">Search results:</a></h4>
                </div>
                <!-- end panel-heading -->
                <!-- begin forum-list -->                   
					<ul class="forum-list">
						<?php foreach($posts as $post):?>
							<li>
                                <div class="media">
								<?php if(($post->image == '') || ($post->image == 'image')):?>
								<img src="http://placehold.it/64x64" alt="" />
								<?php else:?>
                                    <img src="<?=$post->image?>" alt="" />
								
								<?php endif;?>
                                </div>
								<div class="info-container">
									<div class="info">
										<? $user = new User($post->user_id);
										   $post_category = new Forum_category();
										   $post_category = $post_category->where('id',$post->category_id)->get();
										   $post_topic = new Forum_topic();
										   $post_topic = $post_topic->where('id',$post_category->topic_id)->get();
										   $post_area = new Area();
										   $post_area = $post_area->where('id',$post_topic->area_id)->get();
										   ?>
										<h4 class="title"><a href="<?=base_url('forum/topic/'.$post_topic->name.'/category/'.$post->category_id.'#'.$user->username.'/'.$post->time_created.'/'.$post->id.'')?>"> <?=$post_area->name.'/'.$post_topic->name.'/'.$post_category->name.''?></a></h4>
										<ul class="info-start-end">
											<li style="list-style-type:none;"><i>Post by: </i> <a> <?=$user->first_name.' '.$user->last_name.'';?></a></li>
											<li style="list-style-type:none;"><i>Posted: </i> <?=date('d M, Y', $post->time_created)?></li> 
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
										</ul>
									</div>
									<div class="date-replies">
									<p class="text-center">Text:</p>s
										<?=$text?>
									</div>
									<div class="date-replies pull-right">
										<a href="<?=base_url('forum/topic/'.$post_topic->name.'/category/'.$post->category_id.'#'.$user->username.'/'.$post->time_created.'/'.$post->id.'')?>" class=""><i class="fa fa-sign-out"></i>READ MORE</a>
									</div>
								</div>
							</li>
						<?php endforeach?>
					</ul>
					<!-- PAGINATION -->
					<div class="text-center">
						<ul class="pagination">
							<?php $number_of_posts = $posts->count();?>
							<?php if(!$this->BuilderEngine->get_option('forum_num_posts_displayed'))
					        {
					            $posts_per_page = 6;
					        }
					        else
					            $posts_per_page = $this->BuilderEngine->get_option('forum_num_posts_displayed');?>
					        <?php $total_pages = ceil($number_of_posts / $posts_per_page);?>

					        <?php if(!isset($_GET['page']))
					        	$current_page = 1;
					       	else
					       		$current_page = $_GET['page'];?>

					       	<?php $back_page =  $current_page - 1;?>
					       	<?php if($back_page > 0):?>
								<li><a href="<?=base_url('forum/search/?page='.$back_page)?>"><i class="fa fa-chevron-left"></i></a></li>
							<?php endif;?>
							
					        <?php for ($i = 1; $i <= $total_pages; $i++):?>
					        	<li><a href="<?=base_url('forum/search/?page='.$i)?>" <?php if($i == $current_page) echo 'class="active"'?>><?=$i?></a></li>
					        <?php endfor;?>

					        <?php $front_page =  $current_page + 1;?>
					       	<?php if($front_page <= $total_pages):?>
								<li><a href="<?=base_url('forum/search/?page='.$front_page)?>"><i class="fa fa-chevron-right"></i></a></li>
							<?php endif;?>
						</ul>
					</div>
					<!-- /PAGINATION -->
			</div>
		</div>
	</div>
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?=base_url('modules/forum/assets/plugins/jquery/jquery-1.9.1.min.js')?>"></script>
	<script src="<?=base_url('modules/forum/assets/plugins/jquery/jquery-migrate-1.1.0.min.js')?>"></script>
	<script src="<?=base_url('modules/forum/assets/plugins/bootstrap/js/bootstrap.min.js')?>"></script>
	<!--[if lt IE 9]>
		<script src="<?=base_url('modules/forum/assets/crossbrowserjs/html5shiv.js')?>"></script>
		<script src="<?=base_url('modules/forum/assets/crossbrowserjs/respond.min.js')?>"></script>
		<script src="<?=base_url('modules/forum/assets/crossbrowserjs/excanvas.min.js')?>"></script>
	<![endif]-->
	<script src="<?=base_url('modules/forum/assets/plugins/jquery-cookie/jquery.cookie.js')?>"></script>
	<script src="<?=base_url('modules/forum/assets/js/apps.js')?>"></script>
	<!-- ================== END BASE JS ================== -->
	
	<script>    
	    $(document).ready(function() {
	        App.init();
	    });
	</script>