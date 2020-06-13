<?php echo get_header() ?>
<?php echo get_sidebar() ?>
<link href="<?=base_url('builderengine/public/fullcalendar-3.5.1/fullcalendar.min.css')?>" rel="stylesheet" />
		<!-- begin #content --> 
		<div id="content" class="content page-with-two-sidebar content-two-sidebars">

			<?/*<h3 class="page-header">Dashboard <small>Account Control Panel</small></h3>*/?>
			<div class="row">
			    <!-- begin col-4 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
			        <?/*<h3>Welcome <strong><?php echo $this->user->first_name." ".$this->user->last_name?></strong> to your Dashboard</h3>*/?>
			        <!-- end panel -->
					<div class="row">
						<?if($this->BuilderEngine->get_option('user_dashboard_activ') == 'yes'):?>
							<div class="col-md-4 col-sm-6">
								<div class="widget widget-stats bg-indigo" style="display:none">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
									<?	$orders = new BuilderPaymentOrder();
										$orders = $orders->count();
									?>
									<div class="stats-title">ALL ORDERS</div>
									<div class="stats-number" id="blogAccounts"><?=$orders?></div>
									<div class="stats-progress progress"></div>
									<div class="stats-desc"><a href="<?=base_url('')?>" style="color:#fff;">View all Orders</a></div>
								</div>
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="widget widget-stats bg-indigo" style="display:none">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-users fa-fw"></i></div>
									<div class="stats-title">USER ACCOUNTS</div>
									<? $users = new User();?>
									<div class="stats-number" id="userAccounts"><?=$users->count();?></div>
									<div class="stats-progress progress"></div>
									<div class="stats-desc"><a href="<?=base_url('admin/user/search')?>">View all members</a></div>
								</div>
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="widget widget-stats bg-indigo" style="display:none">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
									<div class="stats-title">TOTAL USER GROUPS</div>
									<div class="stats-number" id="blogAccounts"><?=count($this->user->get_group_ids())?></div>
									<div class="stats-progress progress"></div>
									<div class="stats-desc"><a href="<?=base_url('user/main/groups')?>" style="color:#fff;">View My Usergroups</a></div>
								</div>
							</div>
						<?endif;?>
						<?if(($this->users->is_admin() || $this->BuilderEngine->get_option('user_dashboard_blog') == 'yes') && $this->BuilderEngine->get_option('blog_active') == 'yes'):?>
							<div class="col-md-4 col-sm-6">
								<div class="widget widget-stats bg-cyan" style="display:none">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
									<div class="stats-title">TOTAL BLOG POSTS</div>
									<?$p = new Post();$posts = $p->get();?>
									<div class="stats-number" id="blogAccounts"><?=$p->count();?></div>
									<div class="stats-progress progress"></div>
									<div class="stats-desc"><a href="<?=base_url('user/blog/posts')?>" style="color:#fff;">View all Blog Posts</a></div>
								</div>
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="widget widget-stats bg-cyan" style="display:none">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
									<div class="stats-title">TOTAL COMMENTS</div>
									<div class="stats-number" id="blogAccounts"><?=$posts->comment->count();?></div>
									<div class="stats-progress progress"></div>
									<div class="stats-desc"><a href="<?=base_url('user/blog/posts')?>" style="color:#fff;">View Post Comments</a></div>
								</div>
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="widget widget-stats bg-cyan" style="display:none">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
									<div class="stats-title">MY BLOG CATEGORIES</div>
									<?$c = new Category();$categories = $c->count();?>
									<div class="stats-number" id="blogAccounts"><?=$categories?></div>
									<div class="stats-progress progress"></div>
									<div class="stats-desc"><a href="<?=base_url('user/blog/categories')?>" style="color:#fff;">View My Categories</a></div>
								</div>
							</div>
						<?endif;?>
						<?if(($this->users->is_admin() || $this->BuilderEngine->get_option('user_dashboard_forum') == 'yes') && $this->BuilderEngine->get_option('forum_active') == 'yes'):?>
							<div class="col-md-4 col-sm-6">
								<div class="widget widget-stats bg-blue" style="display:none">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
									<?	$fp = new Forum_thread();
										$forumPosts = $fp->count();
									?>
									<div class="stats-title">TOTAL FORUM POSTS</div>
									<div class="stats-number" id="blogAccounts"><?=$forumPosts?></div>
									<div class="stats-progress progress"></div>
									<div class="stats-desc"><a href="<?=base_url('')?>" style="color:#fff;">View Forum Posts Created</a></div>
								</div>
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="widget widget-stats bg-blue" style="display:none">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
									<?	$fc = new Forum_category();
										$forumThreads = $fc->count();
									?>
									<div class="stats-title">FORUM THREADS</div>
									<div class="stats-number" id="blogAccounts"><?=$forumThreads?></div>
									<div class="stats-progress progress"></div>
									<div class="stats-desc"><a href="<?=base_url('')?>" style="color:#fff;">View all Threads Created</a></div>
								</div>
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="widget widget-stats bg-blue" style="display:none">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
									<?	$fl = new Like();
										$forumLikes = $fl->count();
									?>
									<div class="stats-title">TOTAL FORUM LIKES</div>
									<div class="stats-number" id="blogAccounts"><?=$forumLikes?></div>
									<div class="stats-progress progress"></div>
									<div class="stats-desc"><a href="<?=base_url('')?>" style="color:#fff;">View all Threads Created</a></div>
								</div>
							</div>
						<?endif;?>
						<?if(($this->users->is_admin() || $this->BuilderEngine->get_option('user_dashboard_booking_events') == 'yes') && $this->BuilderEngine->get_option('booking_events_active') == 'yes'):?>
							<div class="col-md-4 col-sm-6">
								<div class="widget widget-stats bg-teal" style="display:none">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
									<? $be = new Booking_event();
										$bookingEvents = $be->count();
									?>
									<div class="stats-title">TOTAL EVENTS</div>
									<div class="stats-number" id="blogAccounts"><?=$bookingEvents?></div>
									<div class="stats-progress progress"></div>
									<div class="stats-desc"><a href="<?=base_url('booking_events/events')?>" style="color:#fff;">View all Events</a></div>
								</div>
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="widget widget-stats bg-teal" style="display:none">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
									<? $bo = new Booking_event_order();
										$bookingEventOrders = $bo->count();
									?>
									<div class="stats-title">TOTAL BOOKED</div>
									<div class="stats-number" id="blogAccounts"><?=$bookingEventOrders?></div>
									<div class="stats-progress progress"></div>
									<div class="stats-desc"><a href="<?=base_url('user/booking/view_booking_orders')?>" style="color:#fff;">View All Orders</a></div>
								</div>
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="widget widget-stats bg-teal" style="display:none">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
									<div class="stats-title">UPCOMING EVENTS</div>
									<div class="stats-number" id="blogAccounts"><?=$bookingEvents?></div>
									<div class="stats-progress progress"></div>
									<div class="stats-desc"><a href="<?=base_url('booking_events/events')?>" style="color:#fff;">View Upcoming Events</a></div>
								</div>
							</div>
						<?endif?>
						<?if(($this->users->is_admin() || $this->BuilderEngine->get_option('user_dashboard_ecommerce') == 'yes') && $this->BuilderEngine->get_option('ecommerce_active') == 'yes'):?>
							<div class="col-md-4 col-sm-6">
									<?	$orders = new BuilderPaymentOrder();
										$ecommerce_orders = $orders->where('module','ecommerce')->count();
										$member = new Member($this->user->get_id());
										$products = new Ecommerce_product();
									?>
								<div class="widget widget-stats bg-green" style="display:none">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
									<div class="stats-title">ONLINE STORE ORDERS</div>
									<div class="stats-number" id="blogAccounts"><?=$ecommerce_orders;?></div>
									<div class="stats-progress progress"></div>
									<div class="stats-desc"><a href="<?=base_url('user/ecommerce/view_orders')?>" style="color:#fff;">View all Orders</a></div>
								</div>
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="widget widget-stats bg-green" style="display:none">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
									<div class="stats-title">TOTAL WISHED ITEMS</div>
									<div class="stats-number" id="blogAccounts"><?=$member->wished_item->count()?></div>
									<div class="stats-progress progress"></div>
									<div class="stats-desc"><a href="<?=base_url('ecommerce/wishlist')?>" style="color:#fff;">View My Wishlist</a></div>
								</div>
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="widget widget-stats bg-green" style="display:none">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
									<div class="stats-title">PRODUCTS IN STORE</div>
									<div class="stats-number" id="blogAccounts"><?=$products->count();?></div>
									<div class="stats-progress progress"></div>
									<div class="stats-desc"><a href="<?=base_url('')?>" style="color:#fff;">View all Threads Created</a></div>
								</div>
							</div>
						<?endif;?>
						<?if(($this->users->is_admin() || $this->BuilderEngine->get_option('user_dashboard_classifieds') == 'yes') && $this->BuilderEngine->get_option('classifieds_active') == 'yes'):?>
							<div class="col-md-4 col-sm-6">
								<div class="widget widget-stats bg-purple" style="display:none">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
									<?$c = new ClassifiedsItem();
										$classifieds = $c->count();
										$sold = $c->where('sold','yes')->count();
										$active = $c->where('sold','no')->where('ad_completed','yes')->count();
									?>
									<div class="stats-title">TOTAL CLASSIFIED ADS</div>
									<div class="stats-number" id="blogAccounts"><?=$classifieds?></div>
									<div class="stats-progress progress"></div>
									<div class="stats-desc"><a href="<?=base_url('classifieds/placed_ads')?>" style="color:#fff;">View My Classifieds</a></div>
								</div>
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="widget widget-stats bg-purple" style="display:none">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
									<div class="stats-title">TOTAL SOLD ADS</div>
									<div class="stats-number" id="blogAccounts"><?=$sold?></div>
									<div class="stats-progress progress"></div>
									<div class="stats-desc"><a href="<?=base_url('')?>" style="color:#fff;">View all Threads Created</a></div>
								</div>
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="widget widget-stats bg-purple" style="display:none">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
									<div class="stats-title">TOTAL ACTIVE ADS</div>
									<div class="stats-number" id="blogAccounts"><?=$active?></div>
									<div class="stats-progress progress"></div>
									<div class="stats-desc"><a href="<?=base_url('')?>" style="color:#fff;">View all Threads Created</a></div>
								</div>
							</div>
						<?endif;?>
						<?if(($this->users->is_admin() || $this->BuilderEngine->get_option('photogallery_option') == 'open') && $this->BuilderEngine->get_option('user_dashboard_photogallery') == 'yes' && $this->BuilderEngine->get_option('photogallery_active') == 'yes'):?>
							<?
								$p = new PhotoGalleryMedia();
								$photos = $p->count();
								$alb = new PhotoGalleryAlbum();
								$photoAlbums = $alb->count();
								$pc = new PhotoGalleryComment();
								$photoComments = $pc->count();
							?>
							<div class="col-md-4 col-sm-6">
								<div class="widget widget-stats bg-pink" style="display:none">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
									<div class="stats-title">TOTAL PHOTOS</div>
									<div class="stats-number" id="blogAccounts"><?=$photos?></div>
									<div class="stats-progress progress"></div>
									<div class="stats-desc"><a href="<?=base_url('photogallery/channel/'.$this->user->username.'/photos')?>" style="color:#fff;">View all Photos</a></div>
								</div>
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="widget widget-stats bg-pink" style="display:none">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
									<div class="stats-title">TOTAL ALBUMS</div>
									<div class="stats-number" id="blogAccounts"><?=$photoAlbums?></div>
									<div class="stats-progress progress"></div>
									<div class="stats-desc"><a href="<?=base_url('photogallery/channel/'.$this->user->username.'/albums')?>" style="color:#fff;">View all Albums</a></div>
								</div>
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="widget widget-stats bg-pink" style="display:none">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
									<div class="stats-title">CHANNEL COMMENTS</div>
									<div class="stats-number" id="blogAccounts"><?=$photoComments?></div>
									<div class="stats-progress progress"></div>
									<div class="stats-desc"><a href="<?=base_url('')?>" style="color:#fff;">View Channel Comments</a></div>
								</div>
							</div>
						<?endif;?>
						<?if(($this->users->is_admin() || $this->BuilderEngine->get_option('videotube_option') == 'open') && $this->BuilderEngine->get_option('user_dashboard_videotube') == 'yes' && $this->BuilderEngine->get_option('videotube_active') == 'yes'):?>
							<?
								$v = new VideoTubeMedia();
								$videos = $v->count();
								$al = new VideoTubeAlbum();
								$albums = $al->count();
								$c = new VideoTubeComment();
								$comments = $c->count();
							?>
							<div class="col-md-4 col-sm-6">
								<div class="widget widget-stats bg-red" style="display:none">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
									<div class="stats-title">TOTAL VIDEOS</div>
									<div class="stats-number" id="blogAccounts"><?=$videos?></div>
									<div class="stats-progress progress"></div>
									<div class="stats-desc"><a href="<?=base_url('videotube/channel/'.$this->user->username.'/videos')?>" style="color:#fff;">View All Videos</a></div>
								</div>
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="widget widget-stats bg-red" style="display:none">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
									<div class="stats-title">TOTAL ALBUMS</div>
									<div class="stats-number" id="blogAccounts"><?=$albums?></div>
									<div class="stats-progress progress"></div>
									<div class="stats-desc"><a href="<?=base_url('videotube/channel/'.$this->user->username.'/albums')?>" style="color:#fff;">View All Albums</a></div>
								</div>
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="widget widget-stats bg-red" style="display:none">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
									<div class="stats-title">CHANNEL COMMENTS</div>
									<div class="stats-number" id="blogAccounts"><?=$comments?></div>
									<div class="stats-progress progress"></div>
									<div class="stats-desc"><a href="<?=base_url('videotube/channel/'.$this->user->username.'/discussion')?>" style="color:#fff;">View Channel Comments</a></div>
								</div>
							</div>
						<?endif;?>
						<?if(($this->users->is_admin() || $this->BuilderEngine->get_option('audioplayer_option') == 'open') && $this->BuilderEngine->get_option('user_dashboard_audioplayer') == 'yes' && $this->BuilderEngine->get_option('audioplayer_active') == 'yes'):?>
							<?
								$a = new AudioPlayerMedia();
								$audios = $a->count();
								$al = new AudioPlayerAlbum();
								$albums = $al->count();
								$c = new AudioPlayerComment();
								$comments = $c->count();
							?>
							<div class="col-md-4 col-sm-6">
								<div class="widget widget-stats bg-orange" style="display:none">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
									<div class="stats-title">TOTAL AUDIOS</div>
									<div class="stats-number" id="blogAccounts"><?=$audios?></div>
									<div class="stats-progress progress"></div>
									<div class="stats-desc"><a href="<?=base_url('audioplayer/channel/'.$this->user->username.'/audios')?>" style="color:#fff;">View All Audios</a></div>
								</div>
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="widget widget-stats bg-orange" style="display:none">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
									<div class="stats-title">TOTAL ALBUMS</div>
									<div class="stats-number" id="blogAccounts"><?=$albums?></div>
									<div class="stats-progress progress"></div>
									<div class="stats-desc"><a href="<?=base_url('audioplayer/channel/'.$this->user->username.'/albums')?>" style="color:#fff;">View All Albums</a></div>
								</div>
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="widget widget-stats bg-orange" style="display:none">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
									<div class="stats-title">CHANNEL COMMENTS</div>
									<div class="stats-number" id="blogAccounts"><?=$comments?></div>
									<div class="stats-progress progress"></div>
									<div class="stats-desc"><a href="<?=base_url('audioplayer/channel/'.$this->user->username.'/discussion')?>" style="color:#fff;">View Channel Comments</a></div>
								</div>
							</div>
						<?endif;?>
						<?if(($this->users->is_admin() || $this->BuilderEngine->get_option('user_dashboard_booking_rooms') == 'yes') && $this->BuilderEngine->get_option('booking_rooms_active') == 'yes'):?>
							<?
								$cat = new BookingRoomCategory();
								$depts = new BookingRoomDepartment();
								$bookings = new BookingRoom();
							?>
							<div class="col-md-4 col-sm-6">
								<div class="widget widget-stats bg-black" style="display:none">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
									<div class="stats-title">DEPT. CATEGORIES</div>
									<div class="stats-number" id="blogAccounts"><?=$cat->count()?></div>
									<div class="stats-progress progress"></div>
									<div class="stats-desc"><a href="<?=base_url('booking_rooms/category/all')?>" style="color:#fff;">View all Categories</a></div>
								</div>
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="widget widget-stats bg-black" style="display:none">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
									<div class="stats-title">TOTAL ROOMS</div>
									<div class="stats-number" id="blogAccounts"><?=$depts->count()?></div>
									<div class="stats-progress progress"></div>
									<div class="stats-desc"><a href="<?=base_url('booking_rooms/calendar')?>" style="color:#fff;">View all Rooms</a></div>
								</div>
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="widget widget-stats bg-black" style="display:none">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
									<div class="stats-title">TOTAL BOOKINGS</div>
									<div class="stats-number" id="blogAccounts"><?=$bookings->count()?></div>
									<div class="stats-progress progress"></div>
									<div class="stats-desc"><a href="<?=base_url('booking_rooms/calendar')?>" style="color:#fff;">View all Bookings</a></div>
								</div>
							</div>
						<?endif;?>
						<?/* temp disabled
						<?if(($this->users->is_admin() || $this->BuilderEngine->get_option('videostream_option') == 'open') && $this->BuilderEngine->get_option('user_dashboard_videostream') == 'yes' && $this->BuilderEngine->get_option('videostream_active') == 'yes'):?>
							<?
								$v = new VideoStreamMedia();
								$videos = $v->where('user_id',$this->user->get_id())->count();
								$al = new VideoStreamShow();
								$albums = $al->where('user_id',$this->user->get_id())->count();
								$f = new VideoStreamFavorite();
								$favorites = $f->where('user_id',$this->user->get_id())->count();
							?>
							<div class="col-md-4 col-sm-6">
								<div class="widget widget-stats bg-black" style="display:none">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
									<div class="stats-title">TOTAL STREAMS</div>
									<div class="stats-number" id="blogAccounts"><?=$videos?></div>
									<div class="stats-progress progress"></div>
									<div class="stats-desc"><a href="<?=base_url('videostream/browse')?>" style="color:#fff;">View My Streams</a></div>
								</div>
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="widget widget-stats bg-black" style="display:none">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
									<div class="stats-title">TOTAL SHOWS</div>
									<div class="stats-number" id="blogAccounts"><?=$albums?></div>
									<div class="stats-progress progress"></div>
									<div class="stats-desc"><a href="<?=base_url('')?>" style="color:#fff;">View all Albums</a></div>
								</div>
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="widget widget-stats bg-black" style="display:none">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
									<div class="stats-title">TOTAL FAVORITES</div>
									<div class="stats-number" id="blogAccounts"><?=$favorites?></div>
									<div class="stats-progress progress"></div>
									<div class="stats-desc"><a href="<?=base_url('videostream/mylist')?>" style="color:#fff;">View all Favorites</a></div>
								</div>
							</div>
						<?endif;?>
						*/?>
					</div>
			    </div>
			    <!-- end col-4 -->
			    <!-- begin col-4 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
					<div class="panel panel-white" data-sortable-id="index-10">
						<div class="panel-heading">
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
							</div>
							<h4 class="panel-title">All Events - Calendar</h4>
						</div>
						<div class="panel-body">
							<div id="calendar1" class="vertical-box-column p-15 calendar" style="height:80% !important"></div>
						</div>
					</div>
			        <!-- end panel -->
			    </div>
			    <!-- end col-4 -->
			    <!-- begin col-4 -->
			    
			    <!-- end col-4 -->
			</div>
			<!-- begin #sidebar-right -->
		<div id="sidebar-right" class="sidebar sidebar-right">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav m-t-10">
					<h4 class="sidebar-right-main-title">Modules Statistics</h4>
					<li class="nav-widget">
                        <div class="panel-group m-b-0" id="accordion">
                            <div class="panel panel-grey">
                                <div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseQuide">
                                            <i class="fa fa-plus-circle pull-right text-blue"></i> 
                                            Quick Tutorial
                                        </a>
                                    </h3>
                                </div>
                                <div id="collapseQuide" class="panel-collapse collapse">
                                    <div class="panel-body panel-body-2">
                                        Review the statistics shown & make adjustments to your modules to improve sales and member engagement.
										
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-grey">
                                <div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseLinks">
                                            <i class="fa fa-plus-circle pull-right text-blue"></i> 
                                            Help & Support
                                        </a>
                                    </h3>
                                </div>
                                <div id="collapseLinks" class="panel-collapse collapse">
                                    <div class="panel-body panel-body-2">
										<td><a href="#modal-guides" class="btn btn-sm btn-block btn-inverse" data-toggle="modal">Guides & Tutorials</a></td>
										<td><a href="#modal-forums" class="btn btn-sm btn-block btn-inverse" data-toggle="modal">Community Forums</a></td>
										<td><a href="#modal-tickets" class="btn btn-sm btn-block btn-inverse" data-toggle="modal">Support Tickets</a></td>
										<td><a href="#modal-cloudlogin" class="btn btn-sm btn-block btn-inverse" data-toggle="modal">My Account</a></td>
                                    </div>
                                </div>
                            </div>
                        </div>
					</li>
					<li class="nav-widget text-white">
						<div class="panel panel-grey">
						<div class="panel-heading panel-heading-2">
							<h3 class="panel-title title-14">
								<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseList">
									<i class="fa fa-question-circle pull-right" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Checklist to Configure Your Website"></i>
                                    To Do List
								</a>
							</h3>
						</div>
						<div id="collapseList" class="panel-collapse collapse">
						<div class="panel-body p-0">
							<ul class="todolist">
								<li class="active">
									<a href="javascript:;" class="todolist-container active" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Website Statistics</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Review Statistics</div>
									</a>
								</li>
							</ul>
						</div>
						</div>
					</div>

				    </li>
				</ul>
				<!-- end sidebar user -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg sidebar-right"></div>
		<!-- end #sidebar-right -->
							<!-- #modal-dialog -->
							<div class="modal fade" id="modal-forums">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">BuilderEngine Support Forums</h4>
										</div>
										<div class="modal-body">
											You are about to leave your Administration Control Panel, click Continue to view page.
										</div>
										<div class="modal-footer">
											<a href="" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
											<a href="https://builderengine.com/forum/all_topics" target="_blank" class="btn btn-sm btn-success">Continue</a>
										</div>
									</div>
								</div>
							</div>
							<div class="modal fade" id="modal-guides">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">BuilderEngine Tutorials/Guides</h4>
										</div>
										<div class="modal-body">
											You are about to leave your Administration Control Panel, click Continue to view page.
										</div>
										<div class="modal-footer">
											<a href="" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
											<a href="https://builderengine.com/guides/all_posts" target="_blank" class="btn btn-sm btn-success">Continue</a>
										</div>
									</div>
								</div>
							</div>
							<div class="modal fade" id="modal-tickets">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">BuilderEngine Support Tickets</h4>
										</div>
										<div class="modal-body">
											You are about to leave your Administration Control Panel, click Continue to view page.
										</div>
										<div class="modal-footer">
											<a href="" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
											<a href="https://builderengine.com/support" target="_blank" class="btn btn-sm btn-success">Continue</a>
										</div>
									</div>
								</div>
							</div>
							<div class="modal fade" id="modal-cloudlogin">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">BuilderEngine Account Login</h4>
										</div>
										<div class="modal-body">
											You are about to leave your Administration Control Panel, click Continue to view page.
										</div>
										<div class="modal-footer">
											<a href="" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
											<a href="https://builderengine.com/account/dashboard" target="_blank" class="btn btn-sm btn-success">Continue</a>
										</div>
									</div>
								</div>
							</div>	
							<!-- end sidebar -->
			
		</div>
		<!-- end #content -->		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	<!-- end page container -->
<!-- ================== BEGIN BASE JS ================== -->
<script src="<?php echo get_theme_path()?>assets/plugins/jquery/jquery-1.9.1.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
<script src="<?php echo get_theme_path()?>assets/crossbrowserjs/html5shiv.js"></script>
<script src="<?php echo get_theme_path()?>assets/crossbrowserjs/respond.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/crossbrowserjs/excanvas.min.js"></script>
<![endif]-->
<script src="<?php echo get_theme_path()?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/jquery-cookie/jquery.cookie.js"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="<?php echo get_theme_path()?>assets/plugins/morris/raphael.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/morris/morris.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/flot/jquery.flot.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/flot/jquery.flot.time.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/flot/jquery.flot.pie.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/sparkline/jquery.sparkline.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/bootstrap-daterangepicker/moment.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker-new.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/js/dashboard.js"></script>

<script src="<?php echo get_theme_path()?>assets/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/masked-input/masked-input.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/password-indicator/js/password-indicator.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/bootstrap-combobox/js/bootstrap-combobox.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/js/form-plugins.demo.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/DataTables-1.10.2/js/jquery.dataTables.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/DataTables-1.10.2/js/data-table.js"></script>

<script src="<?php echo get_theme_path()?>assets/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/jquery-file-upload/js/vendor/tmpl.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/jquery-file-upload/js/vendor/load-image.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/jquery-file-upload/js/jquery.iframe-transport.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/jquery-file-upload/js/jquery.fileupload.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/jquery-file-upload/js/jquery.fileupload-process.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/jquery-file-upload/js/jquery.fileupload-image.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/jquery-file-upload/js/jquery.fileupload-audio.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/jquery-file-upload/js/jquery.fileupload-video.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/jquery-file-upload/js/jquery.fileupload-validate.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/jquery-file-upload/js/jquery.fileupload-ui.js"></script>
<script src="<?php echo get_theme_path()?>assets/js/form-multiple-upload.demo.min.js"></script>

<script src="<?php echo get_theme_path()?>assets/plugins/isotope/jquery.isotope.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/lightbox/js/lightbox-2.6.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/js/gallery.demo.min.js"></script>

<script src="<?php echo get_theme_path()?>assets/js/apps.min.js"></script>

<?if($this->BuilderEngine->get_option('admin_theme_color_pattern') && $this->BuilderEngine->get_option('admin_theme_color_pattern') != 'default'):?>
	<link href="<?=base_url('themes/dashboard/assets/css/color_patterns/'.$BuilderEngine->get_option('admin_theme_color_pattern'))?>.css" rel="stylesheet">
<?endif;?>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    function capitaliseFirstLetter(string)
    {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
<?php
$notification_timer = 0;
$notification_timer_step = 1500;

if($user)
    foreach($this->user->get_notifications() as $notification): ?>

$(window).load(function() {
    setTimeout(function() {
        $.gritter.add({
            title: capitaliseFirstLetter('<?php echo $notification['type']?>'),
            text: '<?php echo $notification['message']?>',
            image: '<?php echo $this->user->get_avatar()?>',
            sticky: false,
            time: '',
            class_name: 'my-sticky-class'
        });
    }, <?=$notification_timer?>);
});
<?php $notification_timer += $notification_timer_step ?>
<?php endforeach;?>


$(window).load(function() {
    setTimeout(function() {
		$('.bg-indigo').show();
		$('.bg-indigo').addClass('animated slideInDown');
    },1000);
    setTimeout(function() {
		$('.bg-cyan').show();
		$('.bg-cyan').addClass('animated slideInDown');
    },900);
    setTimeout(function() {
		$('.bg-blue').show();
		$('.bg-blue').addClass('animated slideInDown');
    },800);
    setTimeout(function() {
		$('.bg-teal').show();
		$('.bg-teal').addClass('animated slideInDown');
    },700);
    setTimeout(function() {
		$('.bg-green').show();
		$('.bg-green').addClass('animated slideInDown');
    },600);
    setTimeout(function() {
		$('.bg-purple').show();
		$('.bg-purple').addClass('animated slideInDown');
    },500);
    setTimeout(function() {
		$('.bg-pink').show();
		$('.bg-pink').addClass('animated slideInDown');
    },400);
    setTimeout(function() {
		$('.bg-red').show();
		$('.bg-red').addClass('animated slideInDown');
    },300);
    setTimeout(function() {
		$('.bg-orange').show();
		$('.bg-orange').addClass('animated slideInDown');
    },200);
    setTimeout(function() {
		$('.bg-yellow').show();
		$('.bg-yellow').addClass('animated slideInDown');
    },100);
    setTimeout(function() {
		$('.bg-black').show();
		$('.bg-black').addClass('animated slideInDown');
    },50);
});
</script>
<script>
    $(document).ready(function() {
        App.init();
        FormPlugins.init();
		FormMultipleUpload.init();
		Gallery.init();
		<?if($this->BuilderEngine->get_option('admin_left_sidebar_minimized') && $this->BuilderEngine->get_option('admin_left_sidebar_minimized') == 'on'):?>
			$('.sidebar-minify-btn').click();
		<?endif;?>
    });
</script>
<script>
	/*
    $(document).ready(function() {

        App.init();
        var total_days = 32;
        $.ajax({
            type: 'GET',
            url: site_root + '/admin/ajax/dashboard_get_visitors_graph/' + total_days,
            dataType: 'json',
            success: function(data) {
                handleVisitorsLineChart(data);
            },
            data: {},
            async: false
        });

        $.ajax({
			url: site_root + '/admin/ajax/get_latest_news',
			dataType: 'json',
            success: function (data) {
            	$.each(data, function(i, elem){
            		var html = '<li class="media media-lg"> \
						<a href="' + elem.link[0] + '" target="_blank" class="pull-left"> \
							<img class="media-object" src="' + elem.image[0] + '" alt=""> \
						</a> \
						<div class="media-body"> \
							<h4 class="media-heading">' + elem.title[0] + '</h4> \
							' + elem.description[0] +'. \
						</div> \
					</li>';
            		$('#news-feed').append(html);
            	})
            },
            async: false
		})
    });
	*/
</script>
<script src="<?=base_url('builderengine/public/fullcalendar-3.5.1/lib/moment.min.js')?>"></script>
<script src="<?=base_url('builderengine/public/fullcalendar-3.5.1/fullcalendar.min.js')?>"></script>
<script>
var date = new Date();
var currentYear = date.getFullYear();
var currentMonth = date.getMonth() + 1;
	currentMonth = (currentMonth < 10) ? '0' + currentMonth : currentMonth;

$('#calendar1').fullCalendar({
	height:440,
	header: {
		left: 'month,agendaWeek,agendaDay',
		center: 'title',
		right: 'prev,today,next '
	},
	droppable: false, // this allows things to be dropped onto the calendar
	drop: function() {
		$(this).remove();
	},
	selectable: false,
	selectHelper: true,
	select: function(start, end) {
		var title = prompt('Event Title:');
		var eventData;
		if (title) {
			eventData = {
				title: title,
				start: start,
				end: end
			};
			$('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
		}
		$('#calendar').fullCalendar('unselect');
	},
	editable: false,
	eventLimit: true, // allow "more" link when too many events
	events: [
		<?
			$e = new Booking_event();
			$events = $e->where('active','yes')->get();
			$output = '';
			foreach($events as $event){
				$event_categories = explode(',',$event->categories);
				$category = new Booking_event_category();
				$category = $category->where('name',$event_categories[0])->get();
				$event_color = '';
				if($category->exists()){
					if($category->color == 'be-category-bar-blue')
						$event_color = '#02C3F3';
					if($category->color == 'be-category-bar-pink')
						$event_color = '#F079AD';
					if($category->color == 'be-category-bar-yellow')
						$event_color = '#b3a300';
					if($category->color == 'be-category-bar-orange')
						$event_color = '#FB9404';
					if($category->color == 'be-category-bar-green')
						$event_color = '#C2DA66';
					if($category->color == 'be-category-bar-white')
						$event_color = '#FFFFFF';
				}
				$currency = new Currency($event->currency_id);
				if($event->price > 0){
					$price = $event->price;
					$currency = $currency->symbol;
				}
				else{
					$price = 'FREE';
					$currency = '';
				}
				$event_description = preg_replace("/\s+/", " ", strip_tags(str_replace('&nbsp;',' ',ChEditorfix($event->description))));
				if(strlen($event_description) > 300)
					$decription = trim(substr($event_description,0,300)).'...';
				else
					$decription = trim($event_description);
				$output .= '{
					title: "'.$event->name.'",
					image: "'.$event->image.'",
					price: "'.$price.'",
					currency: "'.$currency.'",
					description: "'.$decription.'",                        
					url: "'.base_url('booking_events/event/'.$event->slug).'",
					start: "'.$event->start_date.'T'.$event->start_time.'",';
					//if($event->start_date !== $event->end_date)
						$output .= 'end: "'.$event->end_date.'T'.$event->end_time.'",';
					if($event->featured == 'yes')
						$output .= 'color: "#ff5b57"';
					else
						$output .= 'color: "'.$event_color.'"';
				$output .= '},';
			}
			echo $output;
		?>
	],
	timeFormat: 'H:mm',
	eventMouseover: function(calEvent, jsEvent) {
		var tooltip ='<div class="tooltipevent" style="width:auto;max-width:150px;height:auto;background:#fff;border:1px solid #000;position:absolute;z-index:10001;padding:5px;">' +
						'<div class="row">' +
							'<div class="col-md-12" style="margin-bottom:-10px;">' +
								'<h6 style="background:#eee;padding:5px;"><b>' + calEvent.title + '</b><span class="pull-right" style="font-size:11px;">('+ calEvent.currency + calEvent.price +')</span></h6>' +
							'</div>' +
							'<div class="col-md-4">' +
								'<img src="' + calEvent.image + '" class="img-thumbnail" style="width:100%;" />' +
							'</div>' +
							'<div class="col-md-8" style="padding-left:0;">' +
								'<p style="word-break:break-all;font-size:11px;">' + calEvent.description + '<p/>' +
							'</div>' +
						'</div>' +
					'</div>';
		$("body").append(tooltip);
		$(this).mouseover(function(e) {
			$(this).css('z-index', 10000);
			$('.tooltipevent').fadeIn('500');
			$('.tooltipevent').fadeTo('10', 1.9);
		}).mousemove(function(e) {
			$('.tooltipevent').css('top', e.pageY + 10);
			$('.tooltipevent').css('left', e.pageX + 20);
		});
	},
	eventMouseout: function(calEvent, jsEvent) {
		 $(this).css('z-index', 8);
		 $('.tooltipevent').remove();
	}
});
</script>
</body>
</html>