<?php require_once('assets_loader.php');?>	
<?php require_once('forum_helper.php');?>
	<div class="forums-page-title">
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
					<li><a href="<?=base_url('user/main/dashboard')?>" type="button" class="btn btn-default">My account</a></li>
					<?php endif;?>
        </ul>
            <!-- begin breadcrumb -->
            <ul class="breadcrumb">
                <li><a href="<?=base_url('forum/all_topics')?>">Forum</a></li>
                <li class="active">&nbsp;</li>
            </ul>
            <!-- end breadcrumb -->
            <h1 class="pull-left">Forums</h1>
			 
        </div>
        <!-- end container -->
    </div>
	
    
    <!-- begin content -->
    <div class="content">
        <!-- begin container -->
        <div class="container">
            <!-- begin panel-forum -->
			<?php //$areas = new Area();?>
			<?php foreach($areas as $area):?>
            <div class="panel panel-forum">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="<?=base_url('forum/area/'.$area->name.'')?>"><?=$area->name?></a></h4>
                </div>
                <!-- end panel-heading -->
                <!-- begin forum-list -->

                <ul class="forum-list">
				<?php foreach($topics->where('area_id',$area->id)->get() as $topic):?>
                    <li>
                        <!-- begin media -->
                        <div class="media">
                            <img src="<?=$topic->image?>" alt="" />
                        </div>
                        <!-- end media -->
                        <!-- begin info-container -->
                        <div class="info-container">
                            <div class="info">
                                <h4 class="title"><a href="<?=base_url('forum/topic/'.$topic->name.'')?>"><?=$topic->name?></a></h4>
                                <p class="desc">
                                   <?=str_replace('\r\n','',$topic->description)?>
                                </p>
                            </div>
                            <div class="total-count">
							<?php $categories = new Forum_category();
								  $threads = new Forum_thread();
								  $num_categories = $categories->where('topic_id',$topic->id)->count();
								  $topic_cats = $categories->where('topic_id',$topic->id)->get();
								  $num_posts = 0;
								  $topic_posts=array();
								  foreach($topic_cats as $cat)
								  {
									$posts= $threads->where('category_id',$cat->id)->count();
									$cat_posts = $threads->where('category_id',$cat->id)->get();
									foreach($cat_posts as $cat_post)
									{
										array_push($topic_posts,$cat_post->time_created);
									}
									$num_posts = $num_posts + $posts;
								  }
								  sort($topic_posts);
								  $recent_time_created = end($topic_posts);
								  $recent_thread = $threads->where('time_created',$recent_time_created)->get();
								  $recent_user = $user->where('id',$recent_thread->user_id)->get();
								  $c = new Forum_category();
								  $recent_category = $c->where('id',$recent_thread->category_id)->get();
							?>
                                Threads: <span class="total-post"><?=$num_categories?></span> <span class="divider"><br></span> Posts: <span class="total-post"><?=$num_posts?></span>
                            </div>
                            <div class="latest-post">
                                <h4 class="title"><a href="<?=base_url('forum/topic/'.$topic->name.'/category/'.$recent_category->id.'')?>"><?=$recent_category->name?></a></h4>
								<?php if(!empty($recent_time_created)):?>
                                <p class="time">last post <?=calculateTime($recent_time_created);?> ago by<a href="#" class="user"> <?=$recent_user->first_name.' ' .$recent_user->last_name.'';?></a></p>
								<?php else:?>
								<?php endif;?>
                            </div>
                        </div>
                        <!-- end info-container -->
                    </li>
					<?php endforeach;?>
                </ul>
                <!-- end forum-list -->
            </div>
			<?php endforeach;?>
            <!-- end panel-forum -->
        </div>
        <!-- end container -->
    </div>
    <!-- end content -->
    
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?=base_url('modules/forum/assets/plugins/jquery/jquery-1.9.1.min.js')?>"></script>
	<script src="<?=base_url('modules/forum/assets/plugins/jquery/jquery-migrate-1.1.0.min.js')?>"></script>
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

