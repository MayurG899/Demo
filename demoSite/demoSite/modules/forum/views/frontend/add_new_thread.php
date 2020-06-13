<?php require_once('assets_loader.php');?>	
<?php require_once('forum_helper.php');?>
	<div class="page-title">
        <!-- begin container -->
        <div class="container">
			<ul class="forums-topbar pull-right">
					<li>
						<form class="navbar-form" method="get" action="<?=base_url('forum/search')?>" >
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
            <h1 class="pull-left">New Forum Thread</h1>
			 
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
                    <h4 class="panel-title"><a href="#">New Thread:</a></h4> <?=(isset($title_err))?'<span style="color:red;"><strong>'.$title_err.'</strong></span>':''?>
                </div>
                <!-- end panel-heading -->
                        <div class="panel-body">
                            <form action="" name="wysihtml5" method="POST" enctype="multipart/form-data">
								<input class="form-control" type="text" name="title" value="" placeholder="Thread Title" style="margin-bottom:15px;">
                                <textarea class="textarea form-control" name="content" id="cke" placeholder="Post text" rows="20"></textarea>
								            <script> CKEDITOR.replace( 'cke' ); </script>
								<?php if($this->BuilderEngine->get_option('forum_thread_image') == 'custom'):?>
									<label class="control-label" for="photo" style="margin-top:15px;">Thread Image:</label>
									<input class="form-control" type="file" name="photo" placeholder="Thread Thumbnail" style="margin-top:15px;margin-bottom:15px;">
								<?php endif;?>
								<span class="" style="color:#008a8a;font-size:14px;"><strong>Insert Image</strong></span>
								<input type="file" name="img" >
								<?if($this->users->is_admin()):?>
									<span class="" style="color:#008a8a;font-size:14px;"><strong>Add attachment</strong></span>
									<input type="file" name="attachment" >								
								<?endif;?>								
								<input type="hidden" name="user_id" value="<?=$user->id?>" >
                                <div class="m-t-10">
                                    <button type="submit" class="btn btn-theme">Create Thread <i class="fa fa-paper-plane"></i></button>
                                </div>
                            </form>
                        </div>

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
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
	    App.init();
	//	ForumDetailsPage.init();
	</script>	