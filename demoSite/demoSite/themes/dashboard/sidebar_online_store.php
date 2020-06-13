<!-- begin #sidebar -->
<div id="sidebar" class="sidebar">
<!-- begin sidebar scrollbar -->
<div data-scrollbar="true" data-height="100%">
<!-- begin sidebar user -->
<a href="<?=base_url('/editor')?>" style="text-decoration: none;">
<ul class="nav">
    <li class="nav-profile">
        <div class="image">
            <i class="fa fa-edit"></i>
        </div>
        <div class="info">
            <b>Frontend Editor</b>
            <small>Edit Website Pages</small>
        </div>
    </li>
</ul>
</a>
<!-- end sidebar user -->
<!-- begin sidebar nav -->
<ul class="nav">
    <li class="nav-header">Online Store Control Panel</li>
    <li class="has-sub active">
        <a href="<?php echo home_url('admin')?>">
            <b class="pull-right"></b>
            <i class="fa fa-laptop"></i>
            <span>Store Dashboard</span>
        </a>
    </li>
	
	<li class="has-sub">
		<a <?php echo href("admin", "module/ecommerce/orders")?>>
			<i class="fa fa-money"></i>
			<span>Sales & Customer Orders</span></span>
		</a>
	</li>
	<li class="has-sub">
        <a href="javascript:;">
            <b class="caret pull-right"></b>
            <i class="fa fa-shopping-basket"></i>
            <span>Store Products</span>
        </a>
        <ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'onlinestore' || $current_page == 'ecommerce' && isset($current_child_page) && $current_child_page == 'Ecommerce_product') echo 'style="display:block"';?>>
            <li><a <?php echo href("admin", "module/ecommerce/add_product")?>>Add New Store Product</a></li>
            <li><a <?php echo href("admin", "module/ecommerce/show_products")?>>Show All Store Products</a></li>
        </ul>
    </li>
	<li class="has-sub">
        <a href="javascript:;">
            <b class="caret pull-right"></b>
            <i class="fa fa-list-ul"></i>
            <span>Store Categories</span>
        </a>
        <ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'onlinestore' || $current_page == 'ecommerce' && isset($current_child_page) && $current_child_page == 'Ecommerce_category') echo 'style="display:block"';?>>
            <li><a <?php echo href("admin", "module/ecommerce/add_category")?>>Add New Store Category</a></li>
            <li><a <?php echo href("admin", "module/ecommerce/show_categories")?>>Show All Store Categories</a></li>
        </ul>
    </li>
	<li class="has-sub">
        <a href="javascript:;">
            <b class="caret pull-right"></b>
            <i class="fa fa-truck"></i>
            <span>Shipping Options</span>
        </a>
        <ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'onlinestore' || $current_page == 'ecommerce' && isset($current_child_page) && $current_child_page == 'Ecommerce_shipping') echo 'style="display:block"';?>>
            <li><a <?php echo href("admin", "module/ecommerce/add_shipping")?>>Add New Shipping Method</a></li>
            <li><a <?php echo href("admin", "module/ecommerce/show_shippings")?>>Available Shipping Options</a></li>
        </ul>
    </li>
	<li class="has-sub">
        <a href="javascript:;">
            <b class="caret pull-right"></b>
            <i class="fa fa-credit-card"></i>
            <span>Payment Options</span>
        </a>
        <ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'onlinestore' || $current_page == 'ecommerce' && isset($current_child_page) && $current_child_page == 'ecommerce_checkout_fields') echo 'style="display:block"';?>>
            <li><a <?php echo href("admin", "module/ecommerce/checkout_fields")?>>Store Checkout Settings</a></li>
			<li><a <?php echo href("admin", "module/ecommerce/invoice_settings")?>>Store Invoice Details</a></li>
			<li><a <?php echo href("admin", "module/builderpayment/stripe_settings")?>>Stripe Payments</a></li>
            <li><a <?php echo href("admin", "module/builderpayment/paypal_settings")?>>PayPal Payments</a></li>
        </ul>
    </li>
	<li class="has-sub">
        <a <?php echo href("admin", "module/ecommerce/general_settings")?>>
            <i class="fa fa-wrench"></i>
            <span>Store General Settings</span></span>
        </a>
    </li>
</ul>	

<ul class="nav">
	 <li class="nav-header">Administration Control Panel</li>
	<li class="has-sub beweboptions">
        <a href="javascript:;">
            <b class="caret pull-right"></b>
            <i class="fa fa-cog"></i>
            <span>Settings & Statistics</span>
        </a>
		<ul class="sub-menu beweboptions-sub" <?php if(isset($current_page) && $current_page == 'websitesettings' || $current_page == 'settings' || $current_page == 'analytics') echo 'style="display:block"';?>>
	<li class="has-sub">
        <a href="javascript:;">
            <b class="caret pull-right"></b>
            <i class="fa fa-cogs"></i>
            <span>Website Settings</span>
        </a>
        <ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'settings') echo 'style="display:block"';?>>
            <li><a <?php echo href("admin", "main/settings")?>>Website Settings & Security</a></li>
            <li><a <?php echo href("admin", "modules/show")?>>Installed Modules</a></li>
            <li><a <?php echo href("admin", "backup/backup")?>>Backup Website</a></li>
            <li><a <?php echo href("admin", "backup/restore")?>>Restore Files & Data</a></li>
			<?/* temp disabled 
			<li class="has-sub">
				<a href="javascript:;">
					<span>Social Links</span>
				</a>
				<ul class="sub-menu">
					<li><a <?php echo href("admin", "main/add_social_link")?>>Add New Social Link</a></li>
					<li><a <?php echo href("admin", "main/show_social_links")?>>Edit & Show Social Links</a></li>
				</ul>
			</li>
			*/?>
        </ul>
    </li>
	
	<li class="has-sub">
        <a href="javascript:;">
            <b class="caret pull-right"></b>
            <i class="fa fa-bar-chart"></i>
            <span>Analytics & Statistics</span>
        </a>
        <ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'analytics') echo 'style="display:block"';?>>
			<li><a <?php echo href("admin", "main/seo_settings")?>>SEO Engine Settings</a></li>
			<li><a <?php echo href("admin", "main/statistics")?>>Website Visitor Statistics</a></li>
			<li><a <?php echo href("admin", "main/statisticsmodules")?>>Orders & Modules Statistics</a></li>
        </ul>
    </li>

		</ul>
	</li>
</ul>		

<ul class="nav">
	<li class="has-sub beweboptions">
        <a href="javascript:;">
            <b class="caret pull-right"></b>
            <i class="fa fa-dashboard"></i>
            <span>Frontend & Pages</span>
        </a>
		<ul class="sub-menu beweboptions-sub" <?php if(isset($current_page) && $current_page == 'frontend' || $current_page == 'navigation' || $current_page == 'webpages'|| $current_page == 'templates') echo 'style="display:block"';?>>
	<li class="has-sub">
        <a href="javascript:;">
            <b class="caret pull-right"></b>
            <i class="fa fa-link"></i>
            <span>Navbar Menu Links</span>
        </a>
        <ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'navigation') echo 'style="display:block"';?>>
            <li><a <?php echo href("admin", "links/add")?>>Add New Navbar Link</a></li>
            <li><a <?php echo href("admin", "links/show")?>>View Navbar Structure & Links</a></li>
        </ul>
    </li>
	
	<?php
    $links = get_admin_links();
    foreach($links as $key => $menu):
        $module = $key;
        $module[0] = strtoupper($module[0]);
        ?>
        <?php if($module == 'Pages'):?>
            <li class="has-sub">
                <a href="#">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-file-o"></i>
                    <span>Website Pages</span>
                </a> 
                <ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'webpages') echo 'style="display:block"';?>>
                    <?php foreach( $links[$key] as $sub_key => $link):

                        ?>
                            <?php if(is_array($links[$key][$sub_key])): ?>
                        <li class="has-sub">
                            <a href="javascript:;">
                                <?php else: ?>
                        <li>
                        <?php // echo $link;?>
                                <a href="<?php echo $link?>">
                                    <?php endif;?>
                                    <?php echo $sub_key?>
                                </a>
                                <?php if(is_array($links[$key][$sub_key])): ?>
                                    <ul class="sub">
                                        <?php foreach($links[$key][$sub_key] as $sub_sub_key => $link): ?>
                                            <li>
                                                <a href="<?php echo $link?>">
                                                    <?php echo $sub_sub_key?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                        </li>
                    <?php endforeach; ?>

                </ul>
            </li>
        <?php endif;?>
    <?php endforeach; ?>
	
	<li class="has-sub">
        <a href="javascript:;">
            <b class="caret pull-right"></b>
            <i class="fa fa-th"></i>
            <span>Templates</span>
        </a>
        <ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'templates') echo 'style="display:block"';?>>
            <li><a <?php echo href("admin", "themes/show")?>>Themes Installed & Settings</a></li>
			<li><a href="https://builderengine.com/account/themes_control" target="_blank">New Themes From Marketplace</a></li>
        </ul>
    </li>
	
	<li class="has-sub">
        <a <?php echo href("admin", "files/show")?>>
            <i class="fa fa-floppy-o"></i>
            <span>File Manager</span></span>
        </a>
    </li>
		</ul>
	</li>
</ul>	

<ul class="nav">
	<li class="has-sub beweboptions">
        <a href="javascript:;">
            <b class="caret pull-right"></b>
            <i class="fa fa-user"></i>
            <span>Members Management</span>
        </a>
		<ul class="sub-menu beweboptions-sub" <?php if(isset($current_page) && $current_page == 'members' || $current_page == 'users' || $current_page == 'accountdashboard') echo 'style="display:block"';?>>
	<li class="has-sub">
        <a href="javascript:;">
            <b class="caret pull-right"></b>
            <i class="fa fa-user"></i>
            <span>Member Accounts</span>
			<? 
				$num = array();
				$new_users = new User();
				$new_users = $new_users->where('verified','no')->get();
				foreach($new_users as $usr){
					array_push($num,$usr->id);
				}
			?>
			<?if($new_users->exists()):?>
				<span class="badge " style="background:orange;margin-left:5px;font-size:10px;"><?=count($num);?></span>
			<?endif;?>
        </a>
        <ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'users') echo 'style="display:block"';?>>
            <li><a <?php echo href("admin", "user/add")?>>Add New Member Account</a></li>
            <li><a <?php echo href("admin", "user/search")?>>Show All Active Accounts</a></li>
			<li><a <?php echo href("admin", "user/subscriptions")?>>Show Member Subscriptions</a></li>
			<li><a <?php echo href("admin", "user/register_settings")?>  <?if($new_users->exists())echo 'style="color:orange;"';?>>Members Verification Approval</a></li>
        </ul>
    </li>
	<li class="has-sub">
        <a href="javascript:;">
            <b class="caret pull-right"></b>
            <i class="fa fa-users"></i>
            <span>Member Groups & Roles</span>
        </a>
        <ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'groups') echo 'style="display:block"';?>>
            <li class="has-sub">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    Membership Group
                </a>
                <ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'groups') echo 'style="display:block"';?>>
                    <li><a <?php echo href("admin", "user/add_group")?>>Add New Membership Group</a></li>
                    <li><a <?php echo href("admin", "user/groups")?>>Show All Membership Groups</a></li>
                </ul>
            </li>
			<li><a <?php echo href("admin", "user/permissions")?>>Group Roles & Permissions</a></li>
        </ul>
    </li>
	<li class="has-sub">
        <a href="javascript:;">
            <b class="caret pull-right"></b>
            <i class="fa fa-laptop"></i>
            <span>Members Dashboard</span>
        </a>
        <ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'accountdashboard') echo 'style="display:block"';?>>
			<li><a <?php echo href("admin", "user/user_dashboard_settings")?>>Account Dashboard Settings</a></li>
			<li class="has-sub">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    Account Registrations
                </a>
                <ul class="sub-menu" <?php if(isset($current_child_page) && $current_child_page == 'register') echo 'style="display:block"';?>>
                    <li><a <?php echo href("admin", "user/register_email_settings")?>>Accounts Email Messages</a></li>
                    <li><a <?php echo href("admin", "user/register_glogbal_settings")?>>Registration Settings</a></li>
                </ul>
            </li>
        </ul>
    </li>	
		</ul>
	</li>
</ul>
<!-- end sidebar nav -->

<?php
	$audioR = new AudioPlayerSoundReport();
	$audioCR = new AudioPlayerCommentReport();
	$videoR = new VideoTubeVideoReport();
	$videoCR = new VideoTubeCommentReport();
	$photoR = new PhotoGalleryPhotoReport();
	$photoCR = new PhotoGalleryCommentReport();
	//$streamR = new VideoStreamMediaReport();
	//$streamCR = new VideoStreamCommentReport();
	//$streamTR = new VideoStreamMediaTrailerReport();
	$classAR = new ClassifiedsAdReport();
	$classCR = new ClassifiedsReviewReport();
	$orders = new BuilderPaymentOrder();

	$unreviewed_membership_apps = 0;
	$membership_orders = $orders->where('module','booking_memberships')->get();
	foreach($membership_orders as $m_order){
		$data = json_decode($m_order->custom_data);
		if(isset($data->reviewed) && $data->reviewed == 'pending')
			$unreviewed_membership_apps += 1;
	}
	$unreviewed_service_apps = 0;
	$service_orders = $orders->where('module','booking_services')->get();
	foreach($service_orders as $m_order){
		$data = json_decode($m_order->custom_data);
		if(isset($data->reviewed) && $data->reviewed == 'pending')
			$unreviewed_service_apps += 1;
	}
?>
<ul class="nav">
<li class="nav-header">Modules & Apps Control Panel</li>
	<li class="has-sub beweboptions">
        <a href="javascript:;">
            <b class="caret pull-right"></b>
            <i class="fa fa-credit-card-alt"></i>
            <span>Payments & Orders</span>
        </a>
		<ul class="sub-menu beweboptions-sub" <?php if(isset($current_page) && $current_page == 'payments') echo 'style="display:block"';?>>
			<li class="has-sub">
				<a href="javascript:;">
					<b class="caret pull-right"></b>
					<i class="fa fa-dollar"></i>
					<span>Payment Providers</span>
				</a>
				<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'payments' && isset($current_child_page) && ($current_child_page == 'stripe' || $current_child_page == 'paypal')) echo 'style="display:block"';?>>
					<hr>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-cc-stripe"></i>
							<span>Stripe Payments</span>
						</a>
						<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'payments' && isset($current_child_page) && $current_child_page == 'stripe') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/builderpayment/stripe_settings")?>>Stripe Setup & Settings</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-paypal"></i>
							<span>PayPal</span>
						</a>
						<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'payments' && isset($current_child_page) && $current_child_page == 'paypal') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/builderpayment/paypal_settings")?>>PayPal Setup & Settings</a></li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="has-sub">
				<a href="javascript:;">
					<b class="caret pull-right"></b>
					<i class="fa fa-money"></i>
					<span>Sales & Options</span>
				</a>
				<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'payments' && isset($current_child_page) && ($current_child_page == 'currencies' || $current_child_page == 'sales_orders')) echo 'style="display:block"';?>>
					<hr>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-money"></i>
							<span>Orders & Invoices</span>
						</a>
						<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'payments' && isset($current_child_page) && $current_child_page == 'sales_orders') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/builderpayment/sales")?>>View All Sales & Invoices</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-globe"></i>
							<span>Currencies</span>
						</a>
						<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'payments' && isset($current_child_page) && $current_child_page == 'currencies') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/builderpayment/currencies")?>>Payment Currency List</a></li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="has-sub">
				<a <?php echo href("admin", "module/builderpayment/settings")?>>
					<i class="fa fa-wrench"></i>
					<span>Payments Settings</span></span>
				</a>
			</li>
		</ul>
	</li>
</ul>
<!-- end sidebar nav -->
<ul class="nav">
	<li class="has-sub beweboptions">
        <a href="javascript:;">
            <b class="caret pull-right"></b>
            <i class="fa fa-dollar 
			<?
				if($classAR->count() > 0 || $classCR->count() > 0)
					echo 'animated infinite flash'
			?>" style="animation-duration:1.8s"></i>
            <span>eCommerce Modules</span>
        </a>
		
		<ul class="sub-menu beweboptions-sub" <?php if(isset($current_page) && ($current_page == 'ecommerce' || $current_page == 'classifieds')) echo 'style="display:block"';?>>
			<li class="has-sub">
				<a href="javascript:;">
					<b class="caret pull-right"></b>
					<i class="fa fa-address-card-o"></i>
					<span>Classifieds</span>
					<?if($classAR->count() > 0):?>
						<span class="badge " style="background:red;margin-left:3px;font-size:8px;"><?=$classAR->count()?></span>
					<?endif;?>
					<?if($classCR->count() > 0):?>
						<span class="badge " style="background:orange;margin-left:3px;font-size:8px;"><?=$classCR->count()?></span>
					<?endif;?>
				</a>
				<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'classifieds') echo 'style="display:block"';?>>
					<hr>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-vcard"></i>
							<span>Classified Ads</span>
						</a>
						<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'classifieds' && isset($current_child_page) && $current_child_page == 'Classifiedsitem') echo 'style="display:block"';?>>
							<li><a href="<?=base_url('classifieds/create_item')?>">Add New Classified Ad</a></li>
							<li><a <?php echo href("admin", "module/classifieds/items_list")?>>Show All Classified Ads Created</a></li>
							<li><a href="<?=base_url('classifieds/placed_ads')?>">My Active & Sold Ads</a></li>
							<li><a href="<?=base_url('classifieds/inbox')?>">My Inbox Messages</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-list-ul"></i>
							<span>Classified Categories</span>
						</a>
						<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'classifieds' && isset($current_child_page) && $current_child_page == 'Classifiedscategory') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/classifieds/add_category")?>>Add New Classified Category</a></li>
							<li><a <?php echo href("admin", "module/classifieds/list_categories")?>>Show All Classified Categories</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-map-marker"></i>
							<span>Classified Regions</span>
						</a>
						<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'classifieds' && isset($current_child_page) && $current_child_page == 'Classifiedsregion') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/classifieds/add_region")?>>Add New Classified Region</a></li>
							<li><a <?php echo href("admin", "module/classifieds/list_regions")?>>Active Classified Regions</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-map-marker"></i>
							<span>Classified Locations</span>
						</a>
						<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'classifieds' && isset($current_child_page) && $current_child_page == 'Classifiedslocation') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/classifieds/add_location")?>>Add New Classified Location</a></li>
							<li><a <?php echo href("admin", "module/classifieds/list_locations")?>>Active Classified Locations</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-credit-card"></i>
							<span>Payment Options</span>
						</a>
						<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'classifieds' && isset($current_child_page) && $current_child_page == 'classifieds_invoice_settings') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/classifieds/invoice_settings")?>>Classified Invoice Details</a></li>
							<li><a <?php echo href("admin", "module/builderpayment/stripe_settings")?>>Stripe Payments</a></li>
							<li><a <?php echo href("admin", "module/builderpayment/paypal_settings")?>>PayPal Payments</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;" <?if($classAR->count() > 0 || $classCR->count() > 0)echo 'style="color:yellow;"';?>>
							<b class="caret pull-right"></b>
							<i class="fa fa-users"></i>
							<span>Members & Reports</span>
						</a>
						<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'audioplayer' && isset($current_child_page) && ($current_child_page == 'ClassifiedsReviewReport' || $current_child_page == 'ClassifiedsAdReport' || $current_child_page == 'Classifiedsmember')) echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/classifieds/members_list")?>>Active Classified Members</a></li>
							<li><a <?php echo href("admin", "module/classifieds/show_ad_reports")?> <?if($classAR->count() > 0)echo 'style="color:red;"';?>>Classifieds Ad Reports</a></li>
							<li><a <?php echo href("admin", "module/classifieds/show_comment_reports")?> <?if($classCR->count() > 0)echo 'style="color:orange;"';?>>Classifieds Comment Reports</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a <?php echo href("admin", "module/classifieds/stats_page")?>>
							<i class="fa fa-bar-chart"></i>
							<span>Classified Statistics</span></span>
						</a>
					</li>
					<li class="has-sub">
						<a <?php echo href("admin", "module/classifieds/frontend_sections")?>>
							<i class="fa fa-desktop"></i>
							<span>Classified Frontend Settings</span></span>
						</a>
					</li>
					<li class="has-sub">
						<a <?php echo href("admin", "module/classifieds/Settings")?>>
							<i class="fa fa-wrench"></i>
							<span>Classified General Settings</span></span>
						</a>
					</li>
				</ul>
			</li>
		</ul>
	</li>
</ul>
<ul class="nav">
	<li class="has-sub beweboptions">
        <a href="javascript:;">
            <b class="caret pull-right"></b>
            <i class="fa fa-calendar-check-o 
			<?if($unreviewed_membership_apps > 0)
				echo 'animated infinite flash'?>" style="animation-duration:1.8s"></i>
            <span>Booking Modules</span>
        </a>
		<ul class="sub-menu beweboptions-sub" <?php if(isset($current_page) && ($current_page == 'booking_events' || $current_page == 'booking_rooms' || $current_page == 'booking_services' || $current_page == 'booking_memberships')) echo 'style="display:block"';?>>
			<li class="has-sub">
				<a href="javascript:;">
					<b class="caret pull-right"></b>
					<i class="fa fa-ticket"></i>
					<span>Event Bookings</span>
				</a>
				<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'booking_events') echo 'style="display:block"';?>>
					<hr>
					<li class="has-sub">
						<a <?php echo href("admin", "module/booking_events/show_event_orders")?>>
							<i class="fa fa-money"></i>
							<span>Event Orders & Attendees</span></span>
						</a>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-calendar-o"></i>
							<span>Events</span>
						</a>
						<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'booking_events' && isset($current_child_page) && $current_child_page == 'Booking_event') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/booking_events/add_event")?>>Add New Event</a></li>
							<li><a <?php echo href("admin", "module/booking_events/show_events")?>>Show All Events Created</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-list-ul"></i>
							<span>Event Categories</span>
						</a>
						<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'booking_events' && isset($current_child_page) && $current_child_page == 'Booking_category') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/booking_events/add_event_category")?>>Add New Event Category</a></li>
							<li><a <?php echo href("admin", "module/booking_events/show_event_categories")?>>Show All Event Categories</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-credit-card"></i>
							<span>Payment Options</span>
						</a>
						<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'booking_events' && isset($current_child_page) && $current_child_page == 'booking_invoice_settings') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/booking_events/invoice_settings")?>>Event Invoice Details</a></li>
							<li><a <?php echo href("admin", "module/builderpayment/stripe_settings")?>>Stripe Payments</a></li>
							<li><a <?php echo href("admin", "module/builderpayment/paypal_settings")?>>PayPal Payments</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a <?php echo href("admin", "module/booking_events/settings")?>>
							<i class="fa fa-wrench"></i>
							<span>Events General Settings</span></span>
						</a>
					</li>
				</ul>
			</li>
			<li class="has-sub">
				<a href="javascript:;">
					<b class="caret pull-right"></b>
					<i class="fa fa-calendar"></i>
					<span>Meeting Rooms</span>
				</a>
				<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'booking_rooms') echo 'style="display:block"';?>>
					<hr>
					<li class="has-sub">
						<li><a href="<?=base_url('booking_rooms/calendar')?>">
							<i class="fa fa-calendar"></i>
							<span>Meeting Rooms Calendar</span></span>
						</a>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-calendar-plus-o"></i>
							<span>Room Bookings</span>
						</a>
						<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'booking_rooms' && isset($current_child_page) && $current_child_page == 'BookingRoom') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/booking_rooms/add_room")?>>Schedule New Booking</a></li>
							<li><a href="<?=base_url('booking_rooms/calendar')?>">Book Room By Calendar</a></li>
							<li><a <?php echo href("admin", "module/booking_rooms/show_rooms")?>>Show All Bookings Created</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-key"></i>
							<span>Meeting Rooms</span>
						</a>
						<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'booking_rooms' && isset($current_child_page) && $current_child_page == 'BookingRoomDepartment') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/booking_rooms/add_room_department")?>>Add New Meeting Room</a></li>
							<li><a <?php echo href("admin", "module/booking_rooms/show_room_departments")?>>Show All Meeting Rooms</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-list-ul"></i>
							<span>Room Departments</span>
						</a>
						<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'booking_rooms' && isset($current_child_page) && $current_child_page == 'BookingRoomCategory') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/booking_rooms/add_room_category")?>>Add Meeting Room Department</a></li>
							<li><a <?php echo href("admin", "module/booking_rooms/show_room_categories")?>>Show All Departments</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-credit-card"></i>
							<span>Payment Options</span>
						</a>
						<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'booking_rooms' && isset($current_child_page) && $current_child_page == 'booking_invoice_settings') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/booking_rooms/invoice_settings")?>>Bookings Invoice Details</a></li>
							<li><a <?php echo href("admin", "module/builderpayment/stripe_settings")?>>Stripe Payments</a></li>
							<li><a <?php echo href("admin", "module/builderpayment/paypal_settings")?>>PayPal Payments</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a <?php echo href("admin", "module/booking_rooms/settings")?>>
							<i class="fa fa-wrench"></i>
							<span>Meeting Room Settings</span></span>
						</a>
					</li>
				</ul>
			</li>
			<li class="has-sub">
				<a href="javascript:;">
					<b class="caret pull-right"></b>
					<i class="fa fa-users"></i>
					<span>Membership Apps</span>
					<?if($unreviewed_membership_apps > 0):?>
						<span class="badge " style="background:orange;font-size:8px;"><?=$unreviewed_membership_apps?></span>
					<?endif;?>
				</a>
				<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'booking_memberships') echo 'style="display:block"';?>>
					<hr>
					<li class="has-sub">
						<a <?php echo href("admin", "module/booking_memberships/show_membership_orders")?> <?if($unreviewed_membership_apps > 0)echo 'style="color:yellow;"';?>>
							<i class="fa fa-user"></i>
							<span>Applications List & Orders</span>
						</a>
					</li>
					<li class="has-sub">
						<a <?php echo href("admin", "module/booking_memberships/show_active_members")?>>
							<i class="fa fa-money"></i>
							<span>Subscription & Active Users</span></span>
						</a>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-file-text"></i>
							<span>Memberships</span>
						</a>
						<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'booking_memberships' && isset($current_child_page) && $current_child_page == 'Booking_membership') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/booking_memberships/add_membership")?>>Add New Membership Plan</a></li>
							<li><a <?php echo href("admin", "module/booking_memberships/show_memberships")?>>Show All Membership Plans</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-list-ul"></i>
							<span>Membership Categories</span>
						</a>
						<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'booking_memberships' && isset($current_child_page) && $current_child_page == 'Booking_membership_category') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/booking_memberships/add_membership_category")?>>Add New Category</a></li>
							<li><a <?php echo href("admin", "module/booking_memberships/show_membership_categories")?>>Show All Categories Created</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-credit-card"></i>
							<span>Payment Options</span>
						</a>
						<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'booking_memberships' && isset($current_child_page) && $current_child_page == 'booking_invoice_settings') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/booking_memberships/invoice_settings")?>>Membership Invoice Details</a></li>
							<li><a <?php echo href("admin", "module/builderpayment/stripe_settings")?>>Stripe Payments</a></li>
							<li><a <?php echo href("admin", "module/builderpayment/paypal_settings")?>>PayPal Payments</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a <?php echo href("admin", "module/booking_memberships/settings")?>>
							<i class="fa fa-wrench"></i>
							<span>Membership Settings</span></span>
						</a>
					</li>
				</ul>
			</li>
			<?
				$modules = new Module();
				$services = $modules->where('folder','booking_services')->get();
				if($services->exists()):
			?>
			<li class="has-sub">
				<a href="javascript:;">
					<b class="caret pull-right"></b>
					<i class="fa fa-credit-card-alt"></i>
					<span>Service Bookings</span>
					<?if($unreviewed_service_apps > 0):?>
						<span class="badge " style="background:orange;font-size:8px;"><?=$unreviewed_service_apps?></span>
					<?endif;?>
				</a>
				<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'booking_services') echo 'style="display:block"';?>>
					<hr>
					<li class="has-sub">
						<a <?php echo href("admin", "module/booking_services/show_service_orders")?> <?if($unreviewed_service_apps > 0)echo 'style="color:yellow;"';?>>
							<i class="fa fa-dollar"></i>
							<span>Service Orders & Details</span>
						</a>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-file-text"></i>
							<span>Service Plans</span>
						</a>
						<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'booking_services' && isset($current_child_page) && $current_child_page == 'Booking_membership') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/booking_services/add_service")?>>Add New Service Plan</a></li>
							<li><a <?php echo href("admin", "module/booking_services/show_services")?>>Show All Service Plans</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-list-ul"></i>
							<span>Service Categories</span>
						</a>
						<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'booking_services' && isset($current_child_page) && $current_child_page == 'Booking_membership_category') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/booking_services/add_service_category")?>>Add New Category</a></li>
							<li><a <?php echo href("admin", "module/booking_services/show_service_categories")?>>Show All Categories Created</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-credit-card"></i>
							<span>Payment Options</span>
						</a>
						<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'booking_services' && isset($current_child_page) && $current_child_page == 'booking_invoice_settings') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/booking_services/invoice_settings")?>>Service Invoice Details</a></li>
							<li><a <?php echo href("admin", "module/builderpayment/stripe_settings")?>>Stripe Payments</a></li>
							<li><a <?php echo href("admin", "module/builderpayment/paypal_settings")?>>PayPal Payments</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a <?php echo href("admin", "module/booking_services/show_active_members")?>>
							<i class="fa fa-money"></i>
							<span>Subscription & Active Users</span></span>
						</a>
					</li>
					<li class="has-sub">
						<a <?php echo href("admin", "module/booking_services/settings")?>>
							<i class="fa fa-wrench"></i>
							<span>Service Settings</span></span>
						</a>
					</li>
				</ul>
			</li>
			<?endif;?>
		</ul>
	</li>
</ul>
<!-- end sidebar nav -->
<ul class="nav">
	<li class="has-sub beweboptions">
        <a href="javascript:;">
            <b class="caret pull-right"></b>
            <i class="fa fa-play 
			<?if(
				$audioR->count() > 0 || 
				$audioCR->count() > 0 || 
				$photoR->count() > 0 || 
				$photoCR->count() > 0 || 
				$videoR->count() > 0 ||
				$videoCR->count() > 0)
				echo 'animated infinite flash'?>" style="animation-duration:1.8s"></i>
            <span>Media Modules</span>
        </a>
		<ul class="sub-menu beweboptions-sub" <?php if(isset($current_page) && ($current_page == 'photogallery' || $current_page == 'audioplayer' || $current_page == 'videotube')) echo 'style="display:block"';?>>
			<li class="has-sub">
				<a href="javascript:;">
					<b class="caret pull-right"></b>
					<i class="fa fa-volume-up"></i>
					<span>Audio Streaming</span>
					<?if($audioR->count() > 0):?>
						<span class="badge " style="background:red;margin-left:3px;font-size:8px;"><?=$audioR->count()?></span>
					<?endif;?>
					<?if($audioCR->count() > 0):?>
						<span class="badge " style="background:orange;margin-left:3px;font-size:8px;"><?=$audioCR->count()?></span>
					<?endif;?>
				</a>
				<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'audioplayer') echo 'style="display:block"';?>>
					<hr>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-music"></i>
							<span>Audio Tracks</span>
						</a>
						<ul class="sub-menu sub-menu-modules" <?php if(isset($current_page) && $current_page == 'audioplayer' && isset($current_child_page) && $current_child_page == 'AudioPlayerMedia') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/audioplayer/add_media")?>>Add New Audio Track</a></li>
							<li><a <?php echo href("admin", "module/audioplayer/show_media")?>>All Audio Tracks Uploaded</a></li>
							<hr>
							<li><a href="<?=base_url('/audioplayer/upload')?>">Upload My Audio Tracks</a></li>
							<li><a href="<?=base_url('/audioplayer/mysounds')?>">My Audio Tracks Uploaded</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-folder"></i>
							<span>Audio Albums</span>
						</a>
						<ul class="sub-menu sub-menu-modules" <?php if(isset($current_page) && $current_page == 'audioplayer' && isset($current_child_page) && $current_child_page == 'AudioPlayerAlbum') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/audioplayer/add_album")?>>Add New Album</a></li>
							<li><a <?php echo href("admin", "module/audioplayer/show_albums")?>>Show All Albums Created</a></li>
							<hr>
							<li><a href="<?=base_url('audioplayer/add_album')?>">Create My Audio Album</a></li>
							<li><a href="<?=base_url('audioplayer/myalbums')?>">My Audio Albums Created</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-headphones"></i>
							<span>Audio Channels</span>
						</a>
						<ul class="sub-menu">
							<li><a href="<?=base_url('audioplayer/channel/'.$user->username.'')?>">My Audio Streaming Channel</a></li>
							<li><a href="<?=base_url('audioplayer/myfeed')?>">My Audio Follower Newsfeed</a></li>
							<li><a href="<?=base_url('audioplayer/mysettings')?>">My Channel Settings</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;" <?if($audioR->count() > 0 || $audioCR->count() > 0)echo 'style="color:yellow;"';?>>
							<b class="caret pull-right"></b>
							<i class="fa fa-users"></i>
							<span>Members & Reports</span>
						</a>
						<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'audioplayer' && isset($current_child_page) && ($current_child_page == 'AudioPlayerUserSettings' || $current_child_page == 'AudioPlayerSoundReport' || $current_child_page == 'AudioPlayerCommentReport')) echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/audioplayer/show_user_profiles")?>>Active Audio Streaming Members</a></li>
							<li><a <?php echo href("admin", "module/audioplayer/show_sound_reports")?> <?if($audioR->count() > 0)echo 'style="color:red;"';?>>Uploaded Audio Reports</a></li>
							<li><a <?php echo href("admin", "module/audioplayer/show_comment_reports")?> <?if($audioCR->count() > 0)echo 'style="color:orange;"';?>>Member Comment Reports</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a <?php echo href("admin", "module/audioplayer/settings")?>>
							<i class="fa fa-wrench"></i>
							<span>Audio Streaming Settings</span></span>
						</a>
					</li>
				</ul>
			</li>
			<li class="has-sub">
				<a href="javascript:;">
					<b class="caret pull-right"></b>
					<i class="fa fa-camera"></i>
					<span>Photo Galleries</span>
					<?if($photoR->count() > 0):?>
						<span class="badge " style="background:red;margin-left:3px;font-size:8px;"><?=$photoR->count()?></span>
					<?endif;?>
					<?if($photoCR->count() > 0):?>
						<span class="badge " style="background:orange;margin-left:3px;font-size:8px;"><?=$photoCR->count()?></span>
					<?endif;?>
				</a>
				<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'photogallery') echo 'style="display:block"';?>>
					<hr>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-image"></i>
							<span>Photos</span>
						</a>
						<ul class="sub-menu sub-menu-modules" <?php if(isset($current_page) && $current_page == 'photogallery' && isset($current_child_page) && $current_child_page == 'PhotoGalleryMedia') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/photogallery/add_media")?>>Add New Photo</a></li>
							<li><a <?php echo href("admin", "module/photogallery/show_media")?>>All Photos Uploaded</a></li>
							<hr>
							<li><a href="<?=base_url('photogallery/upload')?>">Upload My Photos & Images</a></li>
							<li><a href="<?=base_url('photogallery/myphotos')?>">My Photos Uploaded</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-folder"></i>
							<span>Photo Albums</span>
						</a>
						<ul class="sub-menu sub-menu-modules" <?php if(isset($current_page) && $current_page == 'photogallery' && isset($current_child_page) && $current_child_page == 'PhotoGalleryAlbum') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/photogallery/add_album")?>>Add New Album</a></li>
							<li><a <?php echo href("admin", "module/photogallery/show_albums")?>>Show All Albums Created</a></li>
							<hr>
							<li><a href="<?=base_url('photogallery/add_album')?>">Create My Photo Album</a></li>
							<li><a href="<?=base_url('photogallery/myalbums')?>">My Photo Albums Created</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-th"></i>
							<span>Photo Channels</span>
						</a>
						<ul class="sub-menu">
							<li><a href="<?=base_url('photogallery/channel/'.$user->username.'')?>">My Photo Gallery Channel</a></li>
							<li><a href="<?=base_url('photogallery/myfeed')?>">My Photo Follower Newsfeed</a></li>
							<li><a href="<?=base_url('photogallery/mysettings')?>">My Channel Settings</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;"  <?if($photoR->count() > 0 || $photoCR->count() > 0)echo 'style="color:yellow;"';?>>
							<b class="caret pull-right"></b>
							<i class="fa fa-users"></i>
							<span>Members & Reports</span>
						</a>
						<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'photogallery' && isset($current_child_page) && ($current_child_page == 'PhotoGalleryUserSettings' || $current_child_page == 'PhotoGalleryPhotoReport' || $current_child_page == 'PhotoGalleryCommentReport')) echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/photogallery/show_user_profiles")?>>Active Photo Gallery Members</a></li>
							<li><a <?php echo href("admin", "module/photogallery/show_photo_reports")?> <?if($photoR->count() > 0)echo 'style="color:red;"';?>>Uploaded Photo Reports</a></li>
							<li><a <?php echo href("admin", "module/photogallery/show_comment_reports")?>  <?if($photoCR->count() > 0)echo 'style="color:orange;"';?>>Member Comment Reports</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a <?php echo href("admin", "module/photogallery/settings")?>>
							<i class="fa fa-wrench"></i>
							<span>Photo Gallery Settings</span></span>
						</a>
					</li>
				</ul>
			</li>
			<li class="has-sub">
				<a href="javascript:;">
					<b class="caret pull-right"></b>
					<i class="fa fa-video-camera"></i>
					<span>Video Channels</span>
					<?if($videoR->count() > 0):?>
						<span class="badge " style="background:red;margin-left:3px;font-size:8px;"><?=$videoR->count()?></span>
					<?endif;?>
					<?if($videoCR->count() > 0):?>
						<span class="badge " style="background:orange;margin-left:3px;font-size:8px;"><?=$videoCR->count()?></span>
					<?endif;?>
				</a>
				<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'videotube') echo 'style="display:block"';?>>
					<hr>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-caret-square-o-right"></i>
							<span>Videos</span>
						</a>
						<ul class="sub-menu sub-menu-modules" <?php if(isset($current_page) && $current_page == 'videotube' && isset($current_child_page) && $current_child_page == 'VideoTubeMedia') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/videotube/add_media")?>>Add New Video</a></li>
							<li><a <?php echo href("admin", "module/videotube/show_media")?>>All Videos Uploaded</a></li>
							<hr>
							<li><a href="<?=base_url('/videotube/upload')?>">Upload My Videos</a></li>
							<li><a href="<?=base_url('/videotube/myvideos')?>">My Videos Uploaded</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-folder"></i>
							<span>Video Albums</span>
						</a>
						<ul class="sub-menu sub-menu-modules" <?php if(isset($current_page) && $current_page == 'videotube' && $current_child_page == 'VideoTubeAlbum') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/videotube/add_album")?>>Add New Album</a></li>
							<li><a <?php echo href("admin", "module/videotube/show_albums")?>>Show All Albums Created</a></li>
							<hr>
							<li><a href="<?=base_url('videotube/add_album')?>">Create My Video Album</a></li>
							<li><a href="<?=base_url('videotube/myalbums')?>">My Video Albums Created</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-television"></i>
							<span>Video Channels</span>
						</a>
						<ul class="sub-menu">
							<li><a href="<?=base_url('videotube/channel/'.$user->username.'')?>">My Video Channel</a></li>
							<li><a href="<?=base_url('videotube/myfeed')?>">My Video Follower Newsfeed</a></li>
							<li><a href="<?=base_url('videotube/mysettings')?>">My Channel Settings</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;" <?if($photoR->count() > 0 || $photoCR->count() > 0)echo 'style="color:yellow;"';?>>
							<b class="caret pull-right"></b>
							<i class="fa fa-users"></i>
							<span>Members & Reports</span>
						</a>
						<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'videotube' && ($current_child_page == 'VideoTubeUserSettings' || $current_child_page == 'VideoTubeVideoReport' || $current_child_page == 'VideoTubeCommentReport')) echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/videotube/show_user_profiles")?>>Active Video Channel Members</a></li>
							<li><a <?php echo href("admin", "module/videotube/show_video_reports")?> <?if($videoR->count() > 0)echo 'style="color:red;"';?>>Uploaded Video Reports</a></li>
							<li><a <?php echo href("admin", "module/videotube/show_comment_reports")?> <?if($videoCR->count() > 0)echo 'style="color:orange;"';?>>Member Comment Reports</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a <?php echo href("admin", "module/videotube/settings")?>>
							<i class="fa fa-wrench"></i>
							<span>Video Channels Settings</span></span>
						</a>
					</li>
				</ul>
			</li>
		</ul>
	</li>
</ul>
<!-- end sidebar nav -->
<ul class="nav">
	<li class="has-sub beweboptions">
        <a href="javascript:;">
            <b class="caret pull-right"></b>
            <i class="fa fa-comments"></i>
            <span>Social Modules</span>
        </a>
		<ul class="sub-menu beweboptions-sub" <?php if(isset($current_page) && ($current_page == 'blog' || $current_page == 'forum')) echo 'style="display:block"';?>>
			<li class="has-sub">
				<a href="javascript:;">
					<b class="caret pull-right"></b>
					<i class="fa fa-book"></i>
					<span>Blog</span>
				</a>
				<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'blog') echo 'style="display:block"';?>>
					<hr>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-commenting"></i>
							<span>Blog Posts</span>
						</a>
						<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'blog' && isset($current_child_page) && $current_child_page == 'post') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/blog/add_post")?>>Add New Blog Post</a></li>
							<li><a <?php echo href("admin", "module/blog/show_posts")?>>All Blog Posts Published</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-folder"></i>
							<span>Blog Categories</span>
						</a>
						<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'blog' && isset($current_child_page) && $current_child_page == 'category') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/blog/add_category")?>>Add New Category</a></li>
							<li><a <?php echo href("admin", "module/blog/show_categories")?>>Show All Blog Categories</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-balance-scale"></i>
							<span>Content Reports</span>
						</a>
						<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'blog' && isset($current_child_page) && $current_child_page == 'comment_report') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/blog/show_comment_reports")?>>Blog Comment Reports</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a <?php echo href("admin", "module/blog/settings")?>>
							<i class="fa fa-wrench"></i>
							<span>Blog General Settings</span></span>
						</a>
					</li>
				</ul>
			</li>
			<li class="has-sub">
				<a href="javascript:;">
					<b class="caret pull-right"></b>
					<i class="fa fa-list-alt"></i>
					<span>Forums</span>
				</a>
				<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'forum') echo 'style="display:block"';?>>
					<hr>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-th-large"></i>
							<span>Forum Areas</span>
						</a>
						<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'forum' && isset($current_child_page) && $current_child_page == 'area') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/forum/add_area")?>>Add New Forum Area</a></li>
							<li><a <?php echo href("admin", "module/forum/show_area")?>>All Forum Areas Created</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-th"></i>
							<span>Forum Topics</span>
						</a>
						<ul class="sub-menu" <?php if(isset($current_page) && $current_page == 'forum' && isset($current_child_page) && $current_child_page == 'forum_topic') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/forum/add_topic")?>>Add New Forum Topic</a></li>
							<li><a <?php echo href("admin", "module/forum/show_topics")?>>All Forum Topics Created</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-list-alt"></i>
							<span>Forum Threads</span>
						</a>
						<ul class="sub-menu sub-menu-modules" <?php if(isset($current_page) && $current_page == 'forum' && isset($current_child_page) && $current_child_page == 'forum_category') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/forum/add_category")?>>Add New Forum Thread</a></li>
							<li><a <?php echo href("admin", "module/forum/show_categories")?>>All Forum Threads Created</a></li>
							<hr>
							<li><a href="<?=base_url('forum/all_topics')?>">Create Thread on Forum</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-comment"></i>
							<span>Forum Posts</span>
						</a>
						<ul class="sub-menu sub-menu-modules" <?php if(isset($current_page) && $current_page == 'forum' && isset($current_child_page) && $current_child_page == 'forum_thread') echo 'style="display:block"';?>>
							<li><a <?php echo href("admin", "module/forum/add_thread")?>>Add New Post Comment</a></li>
							<li><a <?php echo href("admin", "module/forum/show_threads")?>>All Forum Posts Published</a></li>
							<hr>
							<li><a href="<?=base_url('forum/all_topics')?>">Post Comment on Forums</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a <?php echo href("admin", "module/forum/settings")?>>
							<i class="fa fa-wrench"></i>
							<span>Forums General Settings</span></span>
						</a>
					</li>
				</ul>
			</li>
		</ul>
	</li>
</ul>
<!-- end sidebar nav -->
    <!-- begin sidebar minify button -->
    <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
    <!-- end sidebar minify button -->

</ul>
<!-- end sidebar nav -->
</div>
<!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->