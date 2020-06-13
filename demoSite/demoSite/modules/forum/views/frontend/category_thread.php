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
				<?php $category = new Forum_category($cat_id);?>
            <!-- begin breadcrumb -->
            <ul class="breadcrumb">
                <li><a href="<?=base_url('forum/all_topics')?>">Forum</a></li>
				<li><a href="<?=base_url('forum/area/'.$area->name.'')?>"><?=$area->name?></a></li>
                <li><a href="<?=base_url('forum/topic/'.$topic->name.'')?>"><?=$topic->name?></a></li>
				<li><?=$category->name?></li>
                <li class="active">&nbsp;</li>
            </ul>
            <!-- end breadcrumb -->
            <h1 class="pull-left">Thread: <b><?=$category->name?></b>
				<?php $userad = new User($this->user->get_id());?>
				<?=($category->locked == 'yes')?'<span style="color:red;"> [locked] </span>':''?>
				<?php if($this->users->is_admin())
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
			</h1>
			
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
                <!-- begin col-12 -->
                <div class="col-md-12">
                    <!-- begin pagination -->
                    <div class="text-right">
                        <ul class="pagination m-t-0 m-b-15">
							<?php $threads_num = new Forum_thread();?>
							<?php $threads_num = $threads_num->where('category_id',$category->id)->count();?>
							<?php $number_of_posts = $threads_num;?>
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
								<li><a href="<?=base_url('forum/topic/'.$topic->name.'/category/'.$category->id.'?page='.$back_page)?>"><i class="fa fa-chevron-left"></i></a></li>
							<?php endif;?>
							
					        <?php for ($i = 1; $i <= $total_pages; $i++):?>
					        	<li <?php if($i == $current_page) echo 'class="active"'?>><a href="<?=base_url('forum/topic/'.$topic->name.'/category/'.$category->id.'?page='.$i)?>" <?php if($i == $current_page) echo 'class="active"'?>><?=$i?></a></li>
					        <?php endfor;?>

					        <?php $front_page =  $current_page + 1;?>
					       	<?php if($front_page <= $total_pages):?>
								<li class="right"><a href="<?=base_url('forum/topic/'.$topic->name.'/category/'.$category->id.'?page='.$front_page)?>"><i class="fa fa-chevron-right"></i></a></li>
							<?php endif;?>					
                        </ul>
                    </div>
                    <!-- end pagination -->
                    
                    <!-- begin forum-list -->
                    <ul class="forum-list forum-detail-list">
					<?php $i=0;?>
						<?php foreach($threads as $thread):?>
                        <li>
                            <!-- begin media -->
                            <div class="media">
							<?php $user = new User($thread->user_id);
								  $setting = new Setting();
								  $setting = $setting->where('user_id',$user->id)->get()?>
								<?php if($user->avatar == null || $setting->allow_avatar == 0):?>
								<img src="<?=$thread->image?>" alt="" />
								<?php else:?>
                                <img src="<?=$user->avatar?>" alt="" />
								<?php endif;?>
								<?php $groups = $user->group->get();?>
								<?php 
								foreach($groups as $g){
									if($g->id == 1){
										$user->level = 'Administrator';
									}
								}
								?>
                                <span class="label label-<?=getLabel($user->level)?>">
								<?php if($user->level =='Administrator'):?>
								<?php echo 'Admin';?>
								<?php else:?>
								<?=$user->level?>
								<?php endif;?>
								</span>
                            </div>
                            <!-- end media -->
                            <!-- begin info-container -->
                            <div class="info-container" id="<?=$user->username.'/'.$thread->time_created.'/'.$thread->id;?>" >
                                <div class="post-user"><a href="#"> <?=$user->first_name.' '.$user->last_name.''?> </a> <small><?=($category->user_id == $thread->user_id)?'Author':'Reply';?></small></div>
                                <div class="post-content">
									<span id="text<?=$i?>" style="display:block;"><?=$thread->text;?></span>
									<?php $logged_in_user = new User($this->user->id);?>
									<?php if($logged_in_user->id == $thread->user_id || $this->users->is_admin()):?>
										<a href="#" id="edit_post<?=$i?>" class="btn btn-xs btn-success <?=($category->locked == 'yes')?'disabled':'';?> pull-right" style="display:block;margin-right:5px;">Edit</a>
										<a href="<?=base_url('forum/delete_post/'.$thread->id.'')?>" id="delete_post<?=$i?>" class="btn btn-xs btn-<?=($this->users->is_admin() && $logged_in_user->id == $thread->user_id)?'default':'danger'?> <?=($category->locked == 'yes')?'disabled':'';?> pull-right" style="display:block;margin-right:5px">Delete</a>
										<div class="" style="display:none;" id="edit_div<?=$i?>" >
											<form action="" name="edit" method="POST">
												<textarea id="cke1<?=$i;?>" type="text" name="text" > <?=$thread->text;?> </textarea>
												<script> CKEDITOR.replace( 'cke1<?=$i?>' ); </script>
												<input id="post<?=$i?>" type="hidden" name="thread_id" value="<?=$thread->id?>">
												<button href="#" id="save<?=$i?>" type="submit" class="btn btn-xs btn-success" style="display:none;"><i class="fa fa-check"></i></button>
												<a href="#" id="cancel<?=$i?>" class="btn btn-xs btn-success" style="display:none;"><i class="fa fa-times"></i></a>
											</form>
										</div>
									<?php endif;?>								
                                </div>
								<?php $posted = strtotime(date('Y-m-d H:i:s',$thread->time_created));?>
                                <div class="post-time"><span class=""><?=($thread->edited == 'yes')?'(edited)':'';?></span> <?=calculateTime($posted);?> ago </div>
								<?php if($this->user->is_logged_in()):?>
									<div class="row">
										<div class="col-md-12">
											<?php $likes = new Like();
												  $likes = $likes->where('post_id',$thread->id)->get();
												  $num_of_likes = $likes->count();
											?>
											<p style="float:left;margin-left:-7px;padding-top:2px;"><a href="<?=($this->user->is_logged_in()==false)? base_url('forum/login'):'#'?>" id="like<?=$thread->id?>" class="btn btn-xs"><i class="fa fa-thumbs-up" style="font-size:16px;border:1px solid #ccc;border-radius:5px;padding:3px 3px;"></i></a></p>
											<p id="likes<?=$i;?>" style="margin-top:4px;background:#fff;border:1px solid #ccc;border-radius:5px;padding:3px 3px;margin-left:26px;padding:1px 4px;">
												<?php foreach($likes as $like):?>
												  <?php $user_liked = new User($like->user_id);?>
													<span> <?=$user_liked->first_name.' '.$user_liked->last_name.''?> </span>
												<?php endforeach;?>
											</p>
										</div>
									</div>
								<?php endif;?>
                            </div>
                            <!-- end info-container -->
                        </li>
						<?php $i++;?>
						<?php endforeach;?>
                    </ul>
                    <!-- end forum-list -->
                    
                    <!-- begin pagination -->
                    <div class="text-right">
                        <ul class="pagination m-t-0">
							<?php $number_of_posts = $threads_num;?>
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
								<li><a href="<?=base_url('forum/topic/'.$topic->name.'/category/'.$category->id.'?page='.$back_page)?>"><i class="fa fa-chevron-left"></i></a></li>
							<?php endif;?>
							
					        <?php for ($i = 1; $i <= $total_pages; $i++):?>
					        	<li <?php if($i == $current_page) echo 'class="active"'?>><a href="<?=base_url('forum/topic/'.$topic->name.'/category/'.$category->id.'?page='.$i)?>" <?php if($i == $current_page) echo 'class="active"'?>><?=$i?></a></li>
					        <?php endfor;?>

					        <?php $front_page =  $current_page + 1;?>
					       	<?php if($front_page <= $total_pages):?>
								<li class="right"><a href="<?=base_url('forum/topic/'.$topic->name.'/category/'.$category->id.'?page='.$front_page)?>"><i class="fa fa-chevron-right"></i></a></li>
							<?php endif;?>					
                        </ul>
                    </div>
                    <!-- end pagination -->
                    
                    <!-- begin comment-section -->
					<?php if($this->user->is_logged_in() && $category->locked == 'no'):?>
                    <div class="panel panel-forum">
                        <div class="panel-heading">
                            <h4 class="panel-title">Post <?=(!is_array($threads))?'':'Reply';?> to Thread</h4>
                        </div>
                        <div class="panel-body">
                            <form action="" name="wysihtml5" method="POST" enctype="multipart/form-data">
                                <textarea class="textarea form-control" name="content" id="cke" placeholder="Enter text ..." rows="20" ></textarea>
								<script> CKEDITOR.replace( 'cke' ); </script>
								<input type="hidden" name="category_id" value="<?=$category->id?>" >
								<input type="hidden" name="title" value="<?=$category->name?>" >
								<input type="hidden" name="user_id" value="<?=$user->id?>" >
								<span class="" style="color:#008a8a;font-size:14px;"><strong>Insert Image</strong></span>
								<input type="file" name="img" >
								<?if($this->users->is_admin()):?>
									<span class="" style="color:#008a8a;font-size:14px;"><strong>Add attachment</strong></span>
									<input type="file" name="attachment" >								
								<?endif;?>
                                <div class="m-t-10">
                                    <button type="submit" id="submit<?=$i;?>" class="btn btn-theme">Post Comment <i class="fa fa-paper-plane"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
					<?php else:?>
						<?php if($category->locked == 'no'):?>
							<div class="comment-banner-msg">
								Posting to the forum is only allowed for members with active accounts. 
								Please <a href="<?=base_url('forum/login')?>">sign in</a> or <a href="<?=base_url('forum/register')?>">sign up</a> to post.
							</div>
						<?php else:?>
						<?php endif;?>
					<?php endif;?>
                    <!-- end comment-section -->
                </div>
                <!-- end col-12 -->
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
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<!-- ================== END PAGE LEVEL JS ================== -->
	<script>
	<?php $i=0;?>
	<?php foreach($threads as $thread):?>
	$("#edit_post<?=$i;?>").click(function () {
			$("#edit_div<?=$i;?>").addClass('animated bounceInRight');
			$("#edit_div<?=$i;?>").toggle();
			$("#edit_post<?=$i;?>").toggle();
			$("#delete_post<?=$i;?>").toggle();
			$("#save<?=$i;?>").toggle();
			$("#cancel<?=$i;?>").toggle();
			$("#text<?=$i;?>").toggle();
		});
	$("#cancel<?=$i;?>").click(function () {
			$("#edit_div<?=$i;?>").removeClass('animated bounceInRight');
			$("#edit_div<?=$i;?>").addClass('animated bounceOutRight');
			$("#edit_div<?=$i;?>").toggle().fadeOut('slow');
			$("#edit_post<?=$i;?>").toggle();
			$("#delete_post<?=$i;?>").toggle();
			$("#cancel<?=$i;?>").toggle();
			$("#save<?=$i;?>").toggle();
			$("#text<?=$i;?>").toggle();
			$("#edit_div<?=$i;?>").removeClass('animated bounceOutRight');

		});

	$(document).ready(function() {
		$('#like<?=$thread->id?>').click(function(e){
			e.preventDefault();
			<?php $logged_in_user = new User($this->user->id);?>
			user_id = '<?=$logged_in_user->id;?>';
			post_id = '<?=$thread->id;?>';
			likes = $('#likes<?=$i;?>').html();
			setTimeout(function(){
				$.get( site_root + '/forum/ajax/toggle_like/' + user_id + '/' + post_id , function(data){
					if(data != ''){
						$('#likes<?=$i;?>').hide().append(data).fadeIn('fast');
					}
					else{
						$('#likes<?=$i;?>:contains("<?=$logged_in_user->first_name.' '.$logged_in_user->last_name.''?>")').each(function(){
							$(this).html($(this).html().split("<?=$logged_in_user->first_name.' '.$logged_in_user->last_name.''?>").join(""));
						});
					}						
				});
			}, 500);
		});
	});
	
	<?php $i++;?>
	<?php endforeach;?>
		App.init();
		//ForumDetailsPage.init();
	</script>