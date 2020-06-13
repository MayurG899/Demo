<?
	$block_id = 1;
	$blocks = get_blocks();
	$block_holders = get_block_holders();
?>
<!-- mp-menu -->
<nav id="mp-menu" class="mp-menu">
	<div class="mp-level">
		<h2 class="icon icon-world">Builder Menu</h2>
		<ul id="pushMenuContent" class="" style="display:none">
			<li class="icon icon-arrow-left layout-blocks">
				<a href="#"><i class="fa fa-th-large"></i>&nbsp;&nbsp;&nbsp;Page Layouts</a>
				<div class="mp-level">
					<h2>Page Layouts</h2>
					<div class="col-md-8">
					<a class="mp-back" href="#">back</a>
					</div>
					<div class="col-md-4">
					<a class="pull-right blocksmenuclose" id="closeMenu" onCLick="closePushMenu();" href="#">Exit</a>
					</div>
					<br><br>
					<ul>
						<li class="be-addblocks-panel-box"><a class="be-addblocks-panel insert-block-<?=$block_id?>" block-type="row" block-class="" style="display:block;height: 38px;margin:15px;background-color: transparent !important;"><i class="fa fa-bars"></i>&nbsp;&nbsp;&nbsp;Add Row</a></li>
						<li class="icon icon-arrow-left">
							<a href="#"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;Add Column</a>
							<div class="mp-level">
								<h2 class="icon icon-display">Available Column Options</h2>
								<a class="mp-back" href="#">back</a>
								<ul>
									<li>
										<a href="#"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;Standard Width Sizes</a>
										<div class="mp-level">
											<h2 class="icon icon-display">Available Columns</h2>
											<a class="mp-back" href="#">back</a>
											<ul>
												<li class="be-addblocks-panel-box">
													<a class="be-addblocks-panel insert-block-<?=$block_id?>" block-type="column" block-class="col-lg-12" style="display:block;height: 38px;margin:15px;background-color: transparent !important;"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;Full Size Column</a>
												</li>
												<li class="be-addblocks-panel-box">
													<a class="be-addblocks-panel insert-block-<?=$block_id?>" block-type="column" block-class="col-lg-6" style="display:block;height: 38px;margin:15px;background-color: transparent !important;"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;Half Size Column</a>
												</li class="be-addblocks-panel-box"> 
												<li class="be-addblocks-panel-box">
													<a class="be-addblocks-panel insert-block-<?=$block_id?>" block-type="column" block-class="col-lg-4" style="display:block;height: 38px;margin:15px;background-color: transparent !important;"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;Third Size Column</a>
												</li>
												<li class="be-addblocks-panel-box">
													<a class="be-addblocks-panel insert-block-<?=$block_id?>" block-type="column" block-class="col-lg-3" style="display:block;height: 38px;margin:15px;background-color: transparent !important;"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;Quarter Size Column</a>
												</li>
											</ul>
										</div>
									</li>
								   <li>
										<a href="#"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;Advanced Width Sizes</a>
										<div class="mp-level">
											<h2 class="icon icon-display">Available Columns</h2>
											<a class="mp-back" href="#">back</a>
											<ul>
												<li class="be-addblocks-panel-box"><a class="be-addblocks-panel insert-block-<?=$block_id?>" block-type="column" block-class="col-lg-12" style="display:block;height: 38px;margin:15px;background-color: transparent !important;"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;12/12</a></li>
												<li class="be-addblocks-panel-box"><a class="be-addblocks-panel insert-block-<?=$block_id?>" block-type="column" block-class="col-lg-11" style="display:block;height: 38px;margin:15px;background-color: transparent !important;"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;11/12</a></li>
												<li class="be-addblocks-panel-box"><a class="be-addblocks-panel insert-block-<?=$block_id?>" block-type="column" block-class="col-lg-10" style="display:block;height: 38px;margin:15px;background-color: transparent !important;"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;10/12</a></li>
												<li class="be-addblocks-panel-box"><a class="be-addblocks-panel insert-block-<?=$block_id?>" block-type="column" block-class="col-lg-9" style="display:block;height: 38px;margin:15px;background-color: transparent !important;"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;9/12</a></li>
												<li class="be-addblocks-panel-box"><a class="be-addblocks-panel insert-block-<?=$block_id?>" block-type="column" block-class="col-lg-8" style="display:block;height: 38px;margin:15px;background-color: transparent !important;"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;8/12</a></li>
												<li class="be-addblocks-panel-box"><a class="be-addblocks-panel insert-block-<?=$block_id?>" block-type="column" block-class="col-lg-7" style="display:block;height: 38px;margin:15px;background-color: transparent !important;"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;7/12</a></li>
												<li class="be-addblocks-panel-box"><a class="be-addblocks-panel insert-block-<?=$block_id?>" block-type="column" block-class="col-lg-6" style="display:block;height: 38px;margin:15px;background-color: transparent !important;"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;6/12</a></li>
												<li class="be-addblocks-panel-box"><a class="be-addblocks-panel insert-block-<?=$block_id?>" block-type="column" block-class="col-lg-5" style="display:block;height: 38px;margin:15px;background-color: transparent !important;"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;5/12</a></li>
												<li class="be-addblocks-panel-box"><a class="be-addblocks-panel insert-block-<?=$block_id?>" block-type="column" block-class="col-lg-4" style="display:block;height: 38px;margin:15px;background-color: transparent !important;"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;4/12</a></li>
												<li class="be-addblocks-panel-box"><a class="be-addblocks-panel insert-block-<?=$block_id?>" block-type="column" block-class="col-lg-3" style="display:block;height: 38px;margin:15px;background-color: transparent !important;"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;3/12</a></li>
												<li class="be-addblocks-panel-box"><a class="be-addblocks-panel insert-block-<?=$block_id?>" block-type="column" block-class="col-lg-2" style="display:block;height: 38px;margin:15px;background-color: transparent !important;"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;2/12</a></li>
												<li class="be-addblocks-panel-box"><a class="be-addblocks-panel insert-block-<?=$block_id?>" block-type="column" block-class="col-lg-1" style="display:block;height: 38px;margin:15px;background-color: transparent !important;"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;1/12</a></li>
											</ul>
										</div>
								   </li>
								</ul>
							</div>
						</li>
						<li>
							<a href="#"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;Add Section</a>
							<div class="mp-level">
								<h2 class="icon icon-display">Available Sections</h2>
								<a class="mp-back" href="#">back</a>
								<ul>
									<li class="be-addblocks-panel-box"><a class="be-addblocks-panel insert-block-<?=$block_id?>" block-type="header" block-class="" style="display:block;height: 38px;margin:15px;background-color: transparent !important;"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;Header</a></li>
									<li class="be-addblocks-panel-box"><a class="be-addblocks-panel insert-block-<?=$block_id?>" block-type="page" block-class="" style="display:block;height: 38px;margin:15px;background-color: transparent !important;"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;Page</a></li>
									<li class="be-addblocks-panel-box"><a class="be-addblocks-panel insert-block-<?=$block_id?>" block-type="content" block-class="" style="display:block;height: 38px;margin:15px;background-color: transparent !important;"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;Content</a></li>
									<li class="be-addblocks-panel-box"><a class="be-addblocks-panel insert-block-<?=$block_id?>" block-type="footer" block-class="" style="display:block;height: 38px;margin:15px;background-color: transparent !important;"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;Footer </a></li>    
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</li>
			<li class="icon icon-arrow-left">
			<hr>
				<a href="#"><i class="fa fa-th"></i>&nbsp;&nbsp;&nbsp;Content Blocks</a>
				<div class="mp-level">
					<h2>Content Blocks</h2>
					<div class="col-md-8">
					<a class="mp-back" href="#">back</a>
					</div>
					<div class="col-md-4">
					<a class="pull-right blocksmenuclose" id="closeMenu" onClick="closePushMenu();" href="#">Exit</a>
					</div>
					<br><br>
					<ul>
						<?foreach($blocks as $category => $block):?>
							<?if($category == 'Basic Blocks'):?>
								<li class="icon icon-arrow-left">
									<a href="#"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;Add Basic Blocks</a>
									<div class="mp-level">
										<h2 class="icon icon-display">Available Basic Blocks</h2>
										<a class="mp-back" href="#">back</a>
										<ul><?ksort($block['blocks'],SORT_ASC);?>
											<?foreach($block['blocks'] as $sub_block_name => $sub_block):?>
												<?if(strpos($sub_block['icon'],'public')!== FALSE):?>
													<li class="be-addblocks-panel-box" style="padding:5px;">
														<a id="<?=$sub_block['folder']?>" class="be-addblocks-panel panel panel-inverse sidebar-blocks insert-block-<?=$block_id?>" draggable="true" sortable="true" ondragstart="drag(event)" block-type="<?=$sub_block['folder']?>" block-class="" style="background:url('<?=base_url()?>blocks/<?=$sub_block['folder']?>/preview.png') no-repeat;">
															<h4 class="panel-title text-center" style="margin-top:-30px"><i class="fa fa-edit sidefa"></i> <b><?=$sub_block_name?></b></h4>
														</a>
													</li>
												<?endif;?>
											<?endforeach;?>
										</ul>
									</div>
								</li>
							<?endif;?>
							<?if($category == 'Content Blocks'):?>
								<li>
									<a href="#"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;Add Content Blocks</a>
									<div class="mp-level">
										<h2 class="icon icon-display">Available Content Blocks</h2>
										<a class="mp-back" href="#">back</a>
										<ul><?ksort($block['blocks'],SORT_ASC);?>
											<?foreach($block['blocks'] as $sub_block_name => $sub_block):?>
												<?if(strpos($sub_block['icon'],'public')!== FALSE):?>
													<li class="be-addblocks-panel-box" style="padding:5px;">
														<a id="<?=$sub_block['folder']?>" class="be-addblocks-panel panel panel-inverse sidebar-blocks insert-block-<?=$block_id?>" draggable="true" sortable="true" ondragstart="drag(event)" block-type="<?=$sub_block['folder']?>" block-class="" style="background:url('<?=base_url()?>blocks/<?=$sub_block['folder']?>/preview.png') no-repeat;">
															<h4 class="panel-title text-center" style="margin-top:-30px"><i class="fa fa-edit sidefa"></i> <b><?=$sub_block_name?></b></h4>
														</a>
													</li>
												<?endif;?>
											<?endforeach;?>
										</ul>
									</div>
								</li>
							<?endif;?>
						<?endforeach;?>
						<hr>
						<?foreach ($blocks as $category => $block):?>
							<?if ($block['type'] == "block"):?>
								<li class="be-addblocks-panel-box" style="padding:5px;">
									<a id="<?=$block['folder']?>" class="be-addblocks-panel panel panel-inverse sidebar-blocks insert-block-<?=$block_id?>" draggable="true" sortable="true" ondragstart="drag(event)" block-type="<?=$block['folder']?>" block-class="" style="background:url('<?=base_url()?>blocks/<?=$block['folder']?>/preview.png') no-repeat;">
										<h4 class="panel-title text-center" style="margin-top:-30px"><i class="fa fa-edit sidefa" style="color: #48f002;"></i> <b style="color: #48f002;">Generic Block</b></h4>
									</a>
								</li>
							<?endif;?>
						<?endforeach;?>
					</ul>
				</div>
			</li>
			<li class="icon icon-arrow-left">
			<hr>
				<a href="#"><i class="fa fa-image"></i>&nbsp;&nbsp;&nbsp;Media & Sliders</a>
				<div class="mp-level">
					<h2>Media Engine Blocks</h2>
					<div class="col-md-8">
					<a class="mp-back" href="#">back</a>
					</div>
					<div class="col-md-4">
					<a class="pull-right blocksmenuclose" id="closeMenu" onCLick="closePushMenu();" href="#">Exit</a>
					</div>
					<br><br>
					<ul>
						<?foreach($blocks as $category => $block):?>
							<?if($category == 'Media'):?>
								<li>
									<a href="#"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;<b>Blocks:</b> Media & Sliders</a>
									<div class="mp-level">
										<h2 class="icon icon-display">Available Media Blocks</h2>
										<a class="mp-back" href="#">back</a>
								<ul><?ksort($block['blocks'],SORT_ASC);?>
								<?foreach($block['blocks'] as $sub_block_name => $sub_block):?>
									<?if(strpos($sub_block['icon'],'public')!== FALSE):?>
										<li class="be-addblocks-panel-box" style="padding:5px;">
											<a id="<?=$sub_block['folder']?>" class="be-addblocks-panel panel panel-inverse sidebar-blocks insert-block-<?=$block_id?>" draggable="true" sortable="true" ondragstart="drag(event)" block-type="<?=$sub_block['folder']?>" block-class="" style="background:url('<?=base_url()?>blocks/<?=$sub_block['folder']?>/preview.png') no-repeat;">
												<h4 class="panel-title text-center" style="margin-top:-30px"><i class="fa fa-edit sidefa"></i> <b><?=$sub_block_name?></b></h4>
											</a>
										</li>
									<?endif;?>
								<?endforeach?>
										</ul>
									</div>
								</li>
							<?endif;?>
						<?endforeach;?>
						<hr>
						<?foreach($blocks as $category => $block):?>
							<?if($category == 'Audio Player'):?>
								<li class="icon icon-arrow-left">
									<a href="#"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;<b>Module:</b> Audio Streaming</a>
									<div class="mp-level">
										<h2 class="icon icon-display">Available Audio Blocks</h2>
										<a class="mp-back" href="#">back</a>
										<ul><?ksort($block['blocks'],SORT_ASC);?>
											<?foreach($block['blocks'] as $sub_block_name => $sub_block):?>
												<?if(strpos($sub_block['icon'],'public')!== FALSE):?>
													<li class="be-addblocks-panel-box" style="padding:5px;">
														<a id="<?=$sub_block['folder']?>" class="be-addblocks-panel panel panel-inverse sidebar-blocks insert-block-<?=$block_id?>" draggable="true" sortable="true" ondragstart="drag(event)" block-type="<?=$sub_block['folder']?>" block-class="" style="background:url('<?=base_url()?>blocks/<?=$sub_block['folder']?>/preview.png') no-repeat;">
															<h4 class="panel-title text-center" style="margin-top:-30px"><i class="fa fa-edit sidefa"></i> <b><?=$sub_block_name?></b></h4>
														</a>
													</li>
												<?endif;?>
											<?endforeach?>
										</ul>
									</div>
								</li>
							<?endif;?>
							<?if($category == 'Photo Gallery'):?>
								<li>
									<a href="#"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;<b>Module:</b> Photo Galleries</a>
									<div class="mp-level">
										<h2 class="icon icon-display">Available Photo Blocks</h2>
										<a class="mp-back" href="#">back</a>
										<ul><?ksort($block['blocks'],SORT_ASC);?>
											<?foreach($block['blocks'] as $sub_block_name => $sub_block):?>
												<?if(strpos($sub_block['icon'],'public')!== FALSE):?>
													<li class="be-addblocks-panel-box" style="padding:5px;">
														<a id="<?=$sub_block['folder']?>" class="be-addblocks-panel panel panel-inverse sidebar-blocks insert-block-<?=$block_id?>" draggable="true" sortable="true" ondragstart="drag(event)" block-type="<?=$sub_block['folder']?>" block-class="" style="background:url('<?=base_url()?>blocks/<?=$sub_block['folder']?>/preview.png') no-repeat;">
															<h4 class="panel-title text-center" style="margin-top:-30px"><i class="fa fa-edit sidefa"></i> <b><?=$sub_block_name?></b></h4>
														</a>
													</li>
												<?endif;?>
											<?endforeach?>
										</ul>
									</div>
								</li>
							<?endif;?>
							<?if($category == 'VideoTube'):?>
								<li>
									<a href="#"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;<b>Module:</b> Video Channels</a>
									<div class="mp-level">
										<h2 class="icon icon-display">Available Video Blocks</h2>
										<a class="mp-back" href="#">back</a>
										<ul><?ksort($block['blocks'],SORT_ASC);?>
											<?foreach($block['blocks'] as $sub_block_name => $sub_block):?>
												<?if(strpos($sub_block['icon'],'public')!== FALSE):?>
													<li class="be-addblocks-panel-box" style="padding:5px;">
														<a id="<?=$sub_block['folder']?>" class="be-addblocks-panel panel panel-inverse sidebar-blocks insert-block-<?=$block_id?>" draggable="true" sortable="true" ondragstart="drag(event)" block-type="<?=$sub_block['folder']?>" block-class="" style="background:url('<?=base_url()?>blocks/<?=$sub_block['folder']?>/preview.png') no-repeat;">
															<h4 class="panel-title text-center" style="margin-top:-30px"><i class="fa fa-edit sidefa"></i> <b><?=$sub_block_name?></b></h4>
														</a>
													</li>
												<?endif;?>
											<?endforeach?>
										</ul>
									</div>
								</li>
							<?endif;?>
						<?endforeach;?>
					</ul>
				</div>
			</li>
			<li class="icon icon-arrow-left">
			<hr>
				<a href="#"><i class="fa fa-calendar"></i>&nbsp;&nbsp;&nbsp;Bookings & Memberships</a>
				<div class="mp-level">
					<h2>Booking Engine Blocks</h2>
					<div class="col-md-8">
					<a class="mp-back" href="#">back</a>
					</div>
					<div class="col-md-4">
					<a class="pull-right blocksmenuclose" id="closeMenu" onCLick="closePushMenu();" href="#">Exit</a>
					</div>
					<br><br>
					<ul>
						<?foreach($blocks as $category => $block):?>
							<?if($category == 'Booking Events'):?>
								<li class="icon icon-arrow-left">
									<a href="#"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;<b>Module:</b> Event Bookings</a>
									<div class="mp-level">
										<h2 class="icon icon-display">Available Event Blocks</h2>
										<a class="mp-back" href="#">back</a>
										<ul><?ksort($block['blocks'],SORT_ASC);?>
											<?foreach($block['blocks'] as $sub_block_name => $sub_block):?>
												<?if(strpos($sub_block['icon'],'public')!== FALSE):?>
													<li class="be-addblocks-panel-box" style="padding:5px;">
														<a id="<?=$sub_block['folder']?>" class="be-addblocks-panel panel panel-inverse sidebar-blocks insert-block-<?=$block_id?>" draggable="true" sortable="true" ondragstart="drag(event)" block-type="<?=$sub_block['folder']?>" block-class="" style="background:url('<?=base_url()?>blocks/<?=$sub_block['folder']?>/preview.png') no-repeat;">
															<h4 class="panel-title text-center" style="margin-top:-30px"><i class="fa fa-edit sidefa"></i> <b><?=$sub_block_name?></b></h4>
														</a>
													</li>
												<?endif;?>
											<?endforeach?>
										</ul>
									</div>
								</li>
							<?endif;?>
							<?if($category == 'Booking Rooms'):?>
								<li>
									<a href="#"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;<b>Module:</b> Meeting Rooms</a>
									<div class="mp-level">
										<h2 class="icon icon-display">Available Meeting Rooms Blocks</h2>
										<a class="mp-back" href="#">back</a>
										<ul><?ksort($block['blocks'],SORT_ASC);?>
											<?foreach($block['blocks'] as $sub_block_name => $sub_block):?>
												<?if(strpos($sub_block['icon'],'public')!== FALSE):?>
													<li class="be-addblocks-panel-box" style="padding:5px;">
														<a id="<?=$sub_block['folder']?>" class="be-addblocks-panel panel panel-inverse sidebar-blocks insert-block-<?=$block_id?>" draggable="true" sortable="true" ondragstart="drag(event)" block-type="<?=$sub_block['folder']?>" block-class="" style="background:url('<?=base_url()?>blocks/<?=$sub_block['folder']?>/preview.png') no-repeat;">
															<h4 class="panel-title text-center" style="margin-top:-30px"><i class="fa fa-edit sidefa"></i> <b><?=$sub_block_name?></b></h4>
														</a>
													</li>
												<?endif;?>
											<?endforeach?>
										</ul>
									</div>
								</li>
							<?endif;?>
							<?if($category == 'Booking Memberships'):?>
								<li>
									<a href="#"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;<b>Module:</b> Memberships</a>
									<div class="mp-level">
										<h2 class="icon icon-display">Available Membership Blocks</h2>
										<a class="mp-back" href="#">back</a>
										<ul><?ksort($block['blocks'],SORT_ASC);?>
											<?foreach($block['blocks'] as $sub_block_name => $sub_block):?>
												<?if(strpos($sub_block['icon'],'public')!== FALSE):?>
													<li class="be-addblocks-panel-box" style="padding:5px;">
														<a id="<?=$sub_block['folder']?>" class="be-addblocks-panel panel panel-inverse sidebar-blocks insert-block-<?=$block_id?>" draggable="true" sortable="true" ondragstart="drag(event)" block-type="<?=$sub_block['folder']?>" block-class="" style="background:url('<?=base_url()?>blocks/<?=$sub_block['folder']?>/preview.png') no-repeat;">
															<h4 class="panel-title text-center" style="margin-top:-30px"><i class="fa fa-edit sidefa"></i> <b><?=$sub_block_name?></b></h4>
														</a>
													</li>
												<?endif;?>
											<?endforeach?>
										</ul>
									</div>
								</li>
							<?endif;?>
						<?endforeach;?>
					</ul>
				</div>
			</li>
			<li class="icon icon-arrow-left">
			<hr>
				<a href="#"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;&nbsp;eCommerce & Store</a>
				<div class="mp-level">
					<h2>eCommerce Blocks</h2>
					<div class="col-md-8">
					<a class="mp-back" href="#">back</a>
					</div>
					<div class="col-md-4">
					<a class="pull-right blocksmenuclose" id="closeMenu" onCLick="closePushMenu();" href="#">Exit</a>
					</div>
					<br><br>
					<ul>
						<?foreach($blocks as $category => $block):?>
							<?if($category == 'Ecommerce'):?>
								<li>
									<a href="#"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;<b>Blocks:</b> eCommerce Add-On's</a>
									<div class="mp-level">
										<h2 class="icon icon-display">Available eCommerce Blocks</h2>
										<a class="mp-back" href="#">back</a>
								<ul><?ksort($block['blocks'],SORT_ASC);?>
								<?foreach($block['blocks'] as $sub_block_name => $sub_block):?>
									<?if(strpos($sub_block['icon'],'public')!== FALSE):?>
										<li class="be-addblocks-panel-box" style="padding:5px;">
											<a id="<?=$sub_block['folder']?>" class="be-addblocks-panel panel panel-inverse sidebar-blocks insert-block-<?=$block_id?>" draggable="true" sortable="true" ondragstart="drag(event)" block-type="<?=$sub_block['folder']?>" block-class="" style="background:url('<?=base_url()?>blocks/<?=$sub_block['folder']?>/preview.png') no-repeat;">
												<h4 class="panel-title text-center" style="margin-top:-30px"><i class="fa fa-edit sidefa"></i> <b><?=$sub_block_name?></b></h4>
											</a>
										</li>
									<?endif;?>
								<?endforeach?>
										</ul>
									</div>
								</li>
							<?endif?>
						<?endforeach;?>
						<hr>
						<?foreach($blocks as $category => $block):?>
							<?if($category == 'Online Store'):?>
								<li class="icon icon-arrow-left">
									<a href="#"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;<b>Module:</b> Online Store</a>
									<div class="mp-level">
										<h2 class="icon icon-display">Available Store Blocks</h2>
										<a class="mp-back" href="#">back</a>
										<ul><?ksort($block['blocks'],SORT_ASC);?>
											<?foreach($block['blocks'] as $sub_block_name => $sub_block):?>
												<?if($sub_block['folder'] == 'ecommerce_category' ||
													$sub_block['folder'] == 'ecommerce_category_pagination' ||
													$sub_block['folder'] == 'ecommerce_category_products' ||
													$sub_block['folder'] == 'ecommerce_category_sidebar' ||
													$sub_block['folder'] == 'ecommerce_category_categories_sidebar' ||
													$sub_block['folder'] == 'ecommerce_product_desc_and_reviews' ||
													$sub_block['folder'] == 'ecommerce_product_gallery' ||
													$sub_block['folder'] == 'ecommerce_product_price' ||
													$sub_block['folder'] == 'ecommerce_product_title' ||
													$sub_block['folder'] == 'ecommerce_sidebar' ||
													$sub_block['folder'] == 'ecommerce_product')
												continue;?>
												<?if(strpos($sub_block['icon'],'public')!== FALSE):?>
													<li class="be-addblocks-panel-box" style="padding:5px;">
														<a id="<?=$sub_block['folder']?>" class="be-addblocks-panel panel panel-inverse sidebar-blocks insert-block-<?=$block_id?>" draggable="true" sortable="true" ondragstart="drag(event)" block-type="<?=$sub_block['folder']?>" block-class="" style="background:url('<?=base_url()?>blocks/<?=$sub_block['folder']?>/preview.png') no-repeat;">
															<h4 class="panel-title text-center" style="margin-top:-30px"><i class="fa fa-edit sidefa"></i> <b><?=$sub_block_name?></b></h4>
														</a>
													</li>
												<?endif;?>
											<?endforeach;?>
											<?foreach($block_holders as $block_holder):?>
												<?if(strpos($block_holder, strtolower('ecommerce')) !== false):?>
													<?if($block_holder == 'ecommerce_product')
														continue;
													?>
													<li class="be-addblocks-panel-box" style="padding:5px;">
														<a id="<?=$block_holder?>" class="be-addblocks-panel panel panel-inverse sidebar-blocks insert-block-<?=$block_id?>" draggable="true" sortable="true" ondragstart="drag(event)" block-type="<?=$block_holder?>" block-class="block-holder" style="background:url('<?=base_url()?>blocks/<?=$block_holder?>/preview.png') no-repeat;">
															<h4 class="panel-title text-center" style="margin-top:-30px"><i class="fa fa-edit sidefa"></i> <b>
																<?
																$block_holder_name = str_replace(strtolower($category).'_', '', $block_holder);
																echo str_replace('_', ' ', ucfirst($block_holder_name));
																?></b>
															</h4>
														</a>
													</li>
												<?endif;?>
											<?endforeach;?>
										</ul>
									</div>
								</li>
							<?endif;?>
							<?if($category == 'Classifieds'):?>
								<li>
									<a href="#"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;<b>Module:</b> Classifieds</a>
									<div class="mp-level">
										<h2 class="icon icon-display">Available Classifieds Blocks</h2>
										<a class="mp-back" href="#">back</a>
										<ul><?ksort($block['blocks'],SORT_ASC);?>
											<?foreach($block['blocks'] as $sub_block_name => $sub_block):?>
												<?if(strpos($sub_block['icon'],'public')!== FALSE):?>
													<li class="be-addblocks-panel-box" style="padding:5px;">
														<a id="<?=$sub_block['folder']?>" class="be-addblocks-panel panel panel-inverse sidebar-blocks insert-block-<?=$block_id?>" draggable="true" sortable="true" ondragstart="drag(event)" block-type="<?=$sub_block['folder']?>" block-class="" style="background:url('<?=base_url()?>blocks/<?=$sub_block['folder']?>/preview.png') no-repeat;">
															<h4 class="panel-title text-center" style="margin-top:-30px"><i class="fa fa-edit sidefa"></i> <b><?=$sub_block_name?></b></h4>
														</a>
													</li>
												<?endif;?>
											<?endforeach?>
										</ul>
									</div>
								</li>
							<?endif;?>
						<?endforeach;?>
					</ul>
				</div>
			</li>
			<li class="icon icon-arrow-left">
			<hr>
				<a href="#"><i class="fa fa-users"></i>&nbsp;&nbsp;&nbsp;Social & Community</a>
				<div class="mp-level">
					<h2>Social Engine Blocks</h2>
					<div class="col-md-8">
					<a class="mp-back" href="#">back</a>
					</div>
					<div class="col-md-4">
					<a class="pull-right blocksmenuclose" id="closeMenu" onCLick="closePushMenu();" href="#">Exit</a>
					</div>
					<br><br>
					<ul>
						<?foreach($blocks as $category => $block):?>
							<?if($category == 'Blog'):?>
								<li class="icon icon-arrow-left">
									<a href="#"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;<b>Module:</b> Blog</a>
									<div class="mp-level">
										<h2 class="icon icon-display">Available Blog Blocks</h2>
										<a class="mp-back" href="#">back</a>
										<ul><?ksort($block['blocks'],SORT_ASC);?>
											<?foreach($block['blocks'] as $sub_block_name => $sub_block):?>
												<?if(strpos($sub_block['icon'],'public')!== FALSE):?>
													<li class="be-addblocks-panel-box" style="padding:5px;">
														<a id="<?=$sub_block['folder']?>" class="be-addblocks-panel panel panel-inverse sidebar-blocks insert-block-<?=$block_id?>" draggable="true" sortable="true" ondragstart="drag(event)" block-type="<?=$sub_block['folder']?>" block-class="" style="background:url('<?=base_url()?>blocks/<?=$sub_block['folder']?>/preview.png') no-repeat;">
															<h4 class="panel-title text-center" style="margin-top:-30px"><i class="fa fa-edit sidefa"></i> <b><?=$sub_block_name?></b></h4>
														</a>
													</li>
												<?endif;?>
											<?endforeach?>
										</ul>
									</div>
								</li>
							<?endif;?>
							<?if($category == 'Forum'):?>
								<li>
									<a href="#"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;<b>Module:</b> Forums</a>
									<div class="mp-level">
										<h2 class="icon icon-display">Available Forum Blocks</h2>
										<a class="mp-back" href="#">back</a>
										<ul><?ksort($block['blocks'],SORT_ASC);?>
											<?foreach($block['blocks'] as $sub_block_name => $sub_block):?>
												<?if(strpos($sub_block['icon'],'public')!== FALSE):?>
													<li class="be-addblocks-panel-box" style="padding:5px;">
														<a id="<?=$sub_block['folder']?>" class="be-addblocks-panel panel panel-inverse sidebar-blocks insert-block-<?=$block_id?>" draggable="true" sortable="true" ondragstart="drag(event)" block-type="<?=$sub_block['folder']?>" block-class="" style="background:url('<?=base_url()?>blocks/<?=$sub_block['folder']?>/preview.png') no-repeat;">
															<h4 class="panel-title text-center" style="margin-top:-30px"><i class="fa fa-edit sidefa"></i> <b><?=$sub_block_name?></b></h4>
														</a>
													</li>
												<?endif;?>
											<?endforeach?>
										</ul>
									</div>
								</li>
							<?endif;?>
						<?endforeach;?>
					</ul>
				</div>
			</li>
			<li class="icon icon-arrow-left">
			<hr>
				<a href="#"><i class="fa fa-laptop"></i>&nbsp;&nbsp;&nbsp;Account Dashboard</a>
				<div class="mp-level">
					<h2>Account Blocks</h2>
					<div class="col-md-8">
					<a class="mp-back" href="#">back</a>
					</div>
					<div class="col-md-4">
					<a class="pull-right blocksmenuclose" id="closeMenu" onCLick="closePushMenu();" href="#">Exit</a>
					</div>
					<br><br>
					<ul>
						<?foreach($blocks as $category => $block):?>							
							<?if($category == 'Account Dashboard'):?>
								<li>
									<a href="#"><i class="fa fa-square-o"></i>&nbsp;&nbsp;&nbsp;<b>Blocks:</b> Account Menu Bars</a>
									<div class="mp-level">
										<h2 class="icon icon-display">Available Account Blocks</h2>
										<a class="mp-back" href="#">back</a>
										<ul><?ksort($block['blocks'],SORT_ASC);?>
											<?foreach($block['blocks'] as $sub_block_name => $sub_block):?>
												<?if(strpos($sub_block['icon'],'public')!== FALSE):?>
													<li class="be-addblocks-panel-box" style="padding:5px;">
														<a id="<?=$sub_block['folder']?>" class="be-addblocks-panel panel panel-inverse sidebar-blocks insert-block-<?=$block_id?>" draggable="true" sortable="true" ondragstart="drag(event)" block-type="<?=$sub_block['folder']?>" block-class="" style="background:url('<?=base_url()?>blocks/<?=$sub_block['folder']?>/preview.png') no-repeat;">
															<h4 class="panel-title text-center" style="margin-top:-30px"><i class="fa fa-edit sidefa"></i> <b><?=$sub_block_name?></b></h4>
														</a>
													</li>
												<?endif;?>
											<?endforeach?>
										</ul>
									</div>
								</li>
							<?endif;?>
						<?endforeach;?>
					</ul>
				</div>
			</li>
			<li class="icon icon-arrow-left">
			<hr>
				<a id="closeMenu" onCLick="closePushMenu();" href="#"><i class="fa fa-window-close"></i>&nbsp;&nbsp;&nbsp;Exit Block Menu</a>
			</li>
		</ul>
			
	</div>
</nav>
<!-- /mp-menu -->
<script>
	$('.be-addblocks-panel').on('click',function(){
		if(!$('#pushMenuContent').hasClass('advanced')){
			var block_type = $(this).attr('block-type');
			var child = $(this).attr('data-identifier');
			var parent = $("iframe").contents().find('#'+child).closest('.block-children').first();
			var container = parent.attr('block-name');
			var data_class = $(this).attr('block-class');
			//console.log('blocktype:'+block_type+'parent:'+parent+'child:'+child+'dataclass:'+data_class+'trigger: click');
			runFunction('addBlock', [block_type,container,child,data_class,'click']);
		}else{
			var block_type = $(this).attr('block-type');
			var child = $(this).attr('data-identifier');
			var parent = $("iframe").contents().find('#'+child).closest('.block').find('.block-children').first();
			var container = parent.attr('block-name');
			var data_class = $(this).attr('block-class');
			//console.log('blocktype:'+block_type+'parent:'+parent+'container:'+container+'child:'+child+'dataclass:'+data_class+'trigger: click-advanced');
			runFunction('addBlock', [block_type,container,child,data_class,'click-advanced']);
		}
	});

	function allowDrop(ev){
		ev.preventDefault();
	}

	var element;
	var dragovered_element;

	function drag(ev){

		setTimeout(
			function(){
				closePushMenu();
			},300
		);
		//console.log(ev.target.id);
		//var dragovered_element;
		element = ev.target;
		$(element).css('border','2px dashed red');

		$("#content-frame").contents().find("body").bind('dragstart',function(e){
			var dragged_element = e.target;
			//console.log('dragged start element: '+dragged_element);
		});
		$("#content-frame").contents().find("body").bind('dragover',function(e){
			e.preventDefault();
			console.log('dragged over: '+e.target.className);
			var dragover_element = e.target;
			dragovered_element = dragover_element;/*
			if ($(dragover_element).hasClass("be-column-block")){
				$(dragover_element).css('border','2px dashed red');
				$(dragover_element).css('padding-top','50px');
				$(dragover_element).css('padding-bottom','50px');
				$(dragover_element).css('padding-left','50px');
				$(dragover_element).css('padding-right','50px');
			}*/
			if($(dragover_element).hasClass("blockOverLay") || $(dragover_element).hasClass("be-empty-column-fill")){
				var col = $(dragover_element).closest(".be-column-block");
				$(col).css('border','2px dashed red');
				//$(col).css('padding-top','50px');
				//$(col).css('padding-bottom','50px');
				//$(col).css('padding-left','50px');
				//$(col).css('padding-right','50px');
			}
		});
		$("#content-frame").contents().find("body").bind('dragleave',function(e){
			var dragleave_element = e.target;
			/*
			if ($(dragleave_element).hasClass(".be-column-block")){
				$(dragleave_element).css('border','none');
				$(dragleave_element).css('padding-top','0px');
				$(dragleave_element).css('padding-bottom','0px');
				$(dragleave_element).css('padding-left','15px');
				$(dragleave_element).css('padding-right','15px');
			}*/
			if($(dragleave_element).hasClass("blockOverLay") || $(dragleave_element).hasClass("be-empty-column-fill")){
				var col = $(dragleave_element).closest(".be-column-block");
				$(col).css('border','none');
				$(col).css('padding-top','0px');
				$(col).css('padding-bottom','0px');
				$(col).css('padding-left','15px');
				$(col).css('padding-right','15px');
			}
		});
		$("#content-frame").contents().find("body").bind('dragend',function(e){
			var dragend_element = e.target;
			$(element).css('border','none');
			$(this).off('dragstart dragover dragleave dragend drop');
		});
		$("#content-frame").contents().find("body").bind('drop',function(e){
			e.preventDefault();
			dropped_element = e.target;
			block_type = $(element).attr('block-type');
			if ($(dropped_element).hasClass(" be-column-block ")){
				//alert(dropped_element+' target found!');
				$(element).css('border','none');
				$(dragovered_element).css('padding-top','0px');
				$(dragovered_element).css('padding-bottom','0px');
				$(dragovered_element).css('padding-left','15px');
				$(dragovered_element).css('padding-right','15px');
				$(dragovered_element).css('border','none');
				$(dragovered_element).addClass('animated pulse 2s');
				
				var child = $(dropped_element).find('*[id*=trigger]').attr('id');
				var parent = $(this).contents().find('#'+child).closest('.block-children').first();
				var container = parent.attr('block-name');
				var data_class = $(element).attr('block-class');
				//console.log('parent:'+$(parent).attr('block-name')+',child:'+child+'container:'+container+' drop');
				runFunction('addBlock', [block_type,container,child,data_class,'drop']);
			}
			if($(dropped_element).hasClass("blockOverLay") || $(dropped_element).hasClass("be-empty-column-fill")){
				var col = $(dropped_element).closest(".be-column-block");
				$(element).css('border','none');
				$(col).css('padding-top','0px');
				$(col).css('padding-bottom','0px');
				$(col).css('padding-left','15px');
				$(col).css('padding-right','15px');
				$(col).css('border','none');
				$(col).addClass('animated pulse 2s');
				
				var child = $(e.target).find('*[id*=trigger]').attr('id');
				var parent = $(this).contents().find('#'+child).closest('.block-children').first();
				var container = parent.attr('block-name');
				var data_class = $(element).attr('block-class');
				//console.log('blocktype: '+block_type+' parent:'+$(parent).attr('block-name')+', child: '+child+' container: '+container+' drop: '+e.target.className);
				runFunction('addBlock', [block_type,container,child,data_class,'drop']);
			}
			$(this).off('dragstart dragover dragleave dragend drop');
			$(element).css('border','none');
			$(this).find(".be-column-block").css('border','none');
		});
	}
</script>