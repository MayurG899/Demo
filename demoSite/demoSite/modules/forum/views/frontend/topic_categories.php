<?php require_once('assets_loader.php');?>
<?php require_once('forum_helper.php');?>
    <!-- begin page-title -->
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
				<li><a href="<?=base_url('forum/area/'.$area->name.'')?>"><?=$area->name?></a></li>
                <li><a href="<?=base_url('forum/topic/'.$topic->name.'')?>"><?=$topic->name?></a></li>
                <li class="active">&nbsp;</li>
            </ul>
            <!-- end breadcrumb -->
            <h1 class="pull-left">Forum: <b><?=$topic->name?></b></h1>
			 
        </div>
        <!-- end container -->
    </div>
    <!-- end page-title -->
    
    <!-- begin content -->
    <div class="content">
        <!-- begin container -->
        <div class="container">
            <!-- begin row -->
            <div class="row">
                <!-- begin col-9 -->
                <div class="col-md-9">
                    <!-- begin pagination -->
					<div class="text-left" style="float:left;">
						<a class="btn btn-theme" href="<?=base_url('forum/new_thread/'.$topic->id.'')?>" style="margin-bottom:10px;">Create New Thread  <i class="fa fa-paper-plane"></i></a>
					</div>
                    <div class="text-right">
                        <ul class="pagination m-t-0 m-b-15">
							<?php $number_of_posts = $categories->where('topic_id',$topic->id)->count();?>
							<?php if(!$this->BuilderEngine->get_option('forum_num_categories_displayed'))
					        {
					            $posts_per_page = 6;
					        }
					        else
					            $posts_per_page = $this->BuilderEngine->get_option('forum_num_categories_displayed');?>
					        <?php $total_pages = ceil($number_of_posts / $posts_per_page);?>

					        <?php if(!isset($_GET['page']))
					        	$current_page = 1;
					       	else
					       		$current_page = $_GET['page'];?>

					       	<?php $back_page =  $current_page - 1;?>
					       	<?php if($back_page > 0):?>
								<li><a href="<?=base_url('forum/topic/'.$topic->name.'?page='.$back_page)?>"><i class="fa fa-chevron-left"></i></a></li>
							<?php endif;?>
							
					        <?php for ($i = 1; $i <= $total_pages; $i++):?>
					        	<li <?php if($i == $current_page) echo 'class="active"'?>><a href="<?=base_url('forum/topic/'.$topic->name.'?page='.$i)?>" <?php if($i == $current_page) echo 'class="active"'?>><?=$i?></a></li>
					        <?php endfor;?>

					        <?php $front_page =  $current_page + 1;?>
					       	<?php if($front_page <= $total_pages):?>
								<li class="right"><a href="<?=base_url('forum/topic/'.$topic->name.'?page='.$front_page)?>"><i class="fa fa-chevron-right"></i></a></li>
							<?php endif;?>					
                        </ul>
                    </div>
                    <!-- end pagination -->
                    <!-- begin panel-forum -->
					<?php 
					$arr =(array)$categories;
					if(!empty($arr)):?>
                    <div class="panel panel-forum">
                        <!-- begin forum-list -->
                        <ul class="forum-list forum-topic-list">
							<?php foreach($categories as $category):?>
                            <li>
                                <!-- begin media -->
                                <div class="media">
                                    <img src="<?=$category->image?>" alt="" />
                                </div>
                                <!-- end media -->
                                <!-- begin info-container -->
                                <div class="info-container">
                                    <div class="info">
                                        <h4 class="title">
											<a href="<?=base_url('forum/topic/'.$topic->name.'/category/'.$category->id.'')?>"><?=$category->name?> <?=($category->locked == 'yes')?'<span style="color:red;"> [locked] </span>':''?></a>
											<?php
											$userad = new User($this->user->get_id());
											if($this->users->is_admin())
											{
												if($category->locked == 'no')
												{
													$text = 'Lock';
													$button ='<a href="'.base_url('forum/toggle_lock_thread/'.$category->id.'').'" class="btn btn-xs btn-danger"><i class="fa fa-lock"></i> '.$text.' </a>';
												}
												else
												{
													$text = 'Unlock';
													$button ='<a href="'.base_url('forum/toggle_lock_thread/'.$category->id.'').'" class="btn btn-xs btn-success"><i class="fa fa-unlock-alt"></i> '.$text.' </a>';					
												}
												echo $button;
											}
											?>										
										</h4>
                                        <ul class="info-start-end">
											<?php $user = new User($category->user_id);?>
                                            <li>post by <?=$user->first_name.' '.$user->last_name.''?></li>
											<?php
												  $arr = array();
												  $all_posts = new Forum_thread();
												  $all_posts = $all_posts->where('category_id',$category->id)->get();
												  foreach($all_posts as $posts)
												  {array_push($arr,$posts->id);}
												  $post_id = intval(end($arr));
												  $poster_id = new Forum_thread($post_id);
												  $poster_id = $poster_id->user_id;
												  $last_poster = new User($poster_id);
											?>
                                            <li>latest reply <?=$last_poster->first_name.' '.$last_poster->last_name.'';?></li>
                                        </ul>
                                    </div>
                                    <div class="date-replies">
                                        <div class="time">
										<?php $posted = strtotime(date('Y-m-d H:i:s',$category->time_created));?>
                                        created <?=calculateTime($posted);?> ago
                                        </div>
                                        <div class="replies">
										<?php $posts = new Forum_thread();
											  $posts = $posts->where('category_id',$category->id)->count();?>
                                            <div class="total"><?=$posts;?></div>
                                            <div class="text"><?=($posts == 1)?'POST':'POSTS';?></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end info-container -->
                            </li>
						<?php endforeach;?>
                        </ul>
                        <!-- end forum-list -->
                    </div>
					<?php else:?>
					<?php endif;?>
                    <!-- end panel-forum -->
                    
                    <!-- begin pagination -->
                    <div class="text-right">
                        <ul class="pagination m-t-0">
							<?php $number_of_posts = $categories->where('topic_id',$topic->id)->count();?>
							<?php if(!$this->BuilderEngine->get_option('forum_num_categories_displayed'))
					        {
					            $posts_per_page = 6;
					        }
					        else
					            $posts_per_page = $this->BuilderEngine->get_option('forum_num_categories_displayed');?>
					        <?php $total_pages = ceil($number_of_posts / $posts_per_page);?>

					        <?php if(!isset($_GET['page']))
					        	$current_page = 1;
					       	else
					       		$current_page = $_GET['page'];?>

					       	<?php $back_page =  $current_page - 1;?>
					       	<?php if($back_page > 0):?>
								<li><a href="<?=base_url('forum/topic/'.$topic->name.'?page='.$back_page)?>"><i class="fa fa-chevron-left"></i></a></li>
							<?php endif;?>
							
					        <?php for ($i = 1; $i <= $total_pages; $i++):?>
					        	<li <?php if($i == $current_page) echo 'class="active"'?>><a href="<?=base_url('forum/topic/'.$topic->name.'?page='.$i)?>" <?php if($i == $current_page) echo 'class="active"'?>><?=$i?></a></li>
					        <?php endfor;?>

					        <?php $front_page =  $current_page + 1;?>
					       	<?php if($front_page <= $total_pages):?>
								<li class="right"><a href="<?=base_url('forum/topic/'.$topic->name.'?page='.$front_page)?>"><i class="fa fa-chevron-right"></i></a></li>
							<?php endif;?>					
                        </ul>
                    </div>
                    <!-- end pagination -->
                </div>
                <!-- end col-9 -->
                <!-- begin col-3 -->
                <div class="col-md-3">
                    <!-- begin panel-forum -->
                    <div class="panel panel-forum">
                        <div class="panel-heading">
                            <h4 class="panel-title">Recent Thread Posts</h4>
                        </div>
                        <!-- begin threads-list -->
                        <ul class="threads-list">
						 <?php 
							$threads = new Forum_thread();
							$all_post_times = array();
							$c = new Forum_category();
							$c = $c->where('topic_id',$topic->id)->get();
							foreach($c as $category)
							{
							 $threads = $threads->where('category_id',$category->id)->order_by('time_created', 'desc')->limit($num_recent_posts)->get();
									$user = new User($threads->user_id);
									array_push($all_post_times,$threads->time_created);
							}
							$all_posts_times = rsort($all_post_times);
						?>
						<?php $i=0;?>
						<?php foreach($all_post_times as $recent_post):?>
							<?php   
							    $thread = new Forum_thread();
								$categ = new Forum_category;
								$thread = $thread->where('time_created',$recent_post)->get();
								$user = $user->where('id',$thread->user_id)->get();
								$categ = $categ->where('id',$thread->category_id)->get();
							?>
								<?php if($i < $num_recent_posts):?>
								<li>
									<h4 class="title"><a href="<?=base_url('forum/topic/'.$topic->name.'/category/'.$categ->id.'')?>"><?=$categ->name?></a></h4>
									<?php $recent_post = strtotime(date('Y-m-d H:i:s',$recent_post));?>
									last reply by <a href="#"> <?=$user->first_name.' '.$user->last_name.''?> </a> <?=calculateTime($recent_post);?> ago
								</li>
								<?php $i++;?>
								<?php else:?>
								<?php endif;?>
						 <?php endforeach;?>
                        </ul>
                        <!-- end threads-list -->
                    </div>
                    <!-- end panel-forum -->
                </div>
                <!-- end col-3 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end content -->
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

