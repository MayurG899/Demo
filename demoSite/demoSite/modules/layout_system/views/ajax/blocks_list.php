<?foreach ($blocks as $category => $block):?>
    <?if ($block['type'] == "block"):?>
        <li><a class="insert-block-<?=$block_id?>" block-type="<?=$block['folder']?>" block-class="" style="color: #48f002;"><i class="fa fa-edit sidefa"></i> Generic Block</a></li>
	<?endif;?>
<?endforeach;?>
<hr>
<li>
    <a class="editor-sidebar-block-category" style="font-weight: 800;"><i class="fa fa-th-large sidefa"></i> Page System</a>
    <ul class="nav nav-pills nav-stacked blocks-category-holder">
        <li><a class="insert-block-<?=$block_id?>" block-type="row" block-class=""><i class="fa fa-bars sidefa"></i> Add Row</a></li>
			<?if($block_type == 'row'):?>
				<li>
					<a class="editor-sidebar-block-category"><i class="fa fa-th sidefa"></i> Add Column</a>
					<ul class="nav nav-pills nav-stacked blocks-category-holder">
						<li>
							<a class="editor-sidebar-block-category">Simple Width Size</a>
							<ul class="nav nav-pills nav-stacked blocks-category-holder">
								<li><a class="insert-block-<?=$block_id?>" block-type="column" block-class="col-lg-12">Full</a></li>
								<li><a class="insert-block-<?=$block_id?>" block-type="column" block-class="col-lg-6">Half</a></li>
								<li><a class="insert-block-<?=$block_id?>" block-type="column" block-class="col-lg-4">Third </a></li>
								<li><a class="insert-block-<?=$block_id?>" block-type="column" block-class="col-lg-3">Quarter</a></li>
							</ul>
						</li>
						<li>
							<a class="editor-sidebar-block-category">Advanced Width Size</a>
							<ul class="nav nav-pills nav-stacked blocks-category-holder">
								<li><a class="insert-block-<?=$block_id?>" block-type="column" block-class="col-lg-12">12/12</a></li>
								<li><a class="insert-block-<?=$block_id?>" block-type="column" block-class="col-lg-11">11/12</a></li>
								<li><a class="insert-block-<?=$block_id?>" block-type="column" block-class="col-lg-10">10/12</a></li>
								<li><a class="insert-block-<?=$block_id?>" block-type="column" block-class="col-lg-9">9/12</a></li>
								<li><a class="insert-block-<?=$block_id?>" block-type="column" block-class="col-lg-8">8/12</a></li>
								<li><a class="insert-block-<?=$block_id?>" block-type="column" block-class="col-lg-7">7/12</a></li>
								<li><a class="insert-block-<?=$block_id?>" block-type="column" block-class="col-lg-6">6/12</a></li>
								<li><a class="insert-block-<?=$block_id?>" block-type="column" block-class="col-lg-5">5/12</a></li>
								<li><a class="insert-block-<?=$block_id?>" block-type="column" block-class="col-lg-4">4/12</a></li>
								<li><a class="insert-block-<?=$block_id?>" block-type="column" block-class="col-lg-3">3/12</a></li>
								<li><a class="insert-block-<?=$block_id?>" block-type="column" block-class="col-lg-2">2/12</a></li>
								<li><a class="insert-block-<?=$block_id?>" block-type="column" block-class="col-lg-1">1/12</a></li>
							</ul>
						</li>
					</ul>
				</li>
			<?endif;?>      
        <li>
            <a class="editor-sidebar-block-category"><i class="fa fa-file-o sidefa"></i> Main Sections</a>
            <ul class="nav nav-pills nav-stacked blocks-category-holder">
                <li><a class="insert-block-<?=$block_id?>" block-type="header" block-class=""> Header</a></li>
                <li><a class="insert-block-<?=$block_id?>" block-type="page" block-class=""> Page</a></li>
				<li><a class="insert-block-<?=$block_id?>" block-type="content" block-class=""> Content</a></li>
                <li><a class="insert-block-<?=$block_id?>" block-type="footer" block-class=""> Footer </a></li>
            </ul>
        </li>
    </ul>
</li>
<hr>
<li>
	<a class="editor-sidebar-block-category"><i class="fa fa-cubes"></i> Apps Blocks</a>
	<ul class="nav nav-pills nav-stacked blocks-category-holder">
		<li>
			<?	$ctgs = array();
				foreach ($blocks as $category => $block){
					array_push($ctgs,$category);					
				}?>
			<?if(in_array('Forum',$ctgs) || in_array('Photo Gallery',$ctgs) || 
			     in_array('VideoTube',$ctgs) || in_array('Audio Player',$ctgs) || in_array('VideoStream',$ctgs) ||
				 in_array('Online Store',$ctgs) || in_array('Blog',$ctgs) || in_array('Booking Events',$ctgs) ||
				 in_array('Realestate',$ctgs) || in_array('Classifieds',$ctgs) || in_array('Booking Rooms',$ctgs)):?>
				<?foreach ($blocks as $category => $block):?>
						<?if($category == 'Page System' || $category == 'Generic' || $category == 'Content Blocks' || $category == 'Basic Blocks')
							continue;?>
						<li>
							<a class="editor-sidebar-block-category" style="background-color: #337ab7;border-top: 1px solid;border-bottom: 1px solid;"><i class="fa fa-cube sidefa"></i> <?=$category?></a>
							<ul class="nav nav-pills nav-stacked blocks-category-holder" style="background-color: #1d1d1d;border-top: 1px solid;border-bottom: 1px solid;">
							<?foreach($block['blocks'] as $sub_block_name => $sub_block):?>
								<?if(strpos($sub_block['icon'],'public')!== FALSE):?>
									<li style="border-bottom: 1px solid #ffffff;"><a class="gray1 insert-block-<?=$block_id?>" block-type="<?=$sub_block['folder']?>" block-class="" style="color: #ffffff;font-size: 16px;margin-left: -20px;font-weight: 600;padding-top: 20px;padding-bottom: 20px;"><i class="fa fa-compass sidefa2" style="color: #48f002;"></i> <span style="color: #48f002;">Block:</span> <?=$sub_block_name?></a></li>
								<?endif;?>
							<?endforeach;?>
							<?if($category == 'Online Store'):?>
								<?foreach($block_holders as $block_holder):?>
									<?if(strpos($block_holder, strtolower('ecommerce')) !== false):?>
										<?if($block_holder == 'ecommerce_product')
											continue;
										?>
										<li>
											<a class="insert-block-<?=$block_id?>" block-type="<?=$block_holder?>" block-class="block-holder" style="color: #ffffff;font-size: 16px;margin-left: -20px;font-weight: 600;padding-top: 20px;padding-bottom: 20px;"><i class="fa fa-compass sidefa2" style="color: #48f002;"></i> <span style="color: #48f002;">Block:</span>
												<?
												$block_holder_name = str_replace(strtolower($category).'_', '', $block_holder);
												echo str_replace('_', ' ', ucfirst($block_holder_name));
												?>
											</a>
										</li>
									<?endif;?>
								<?endforeach;?>
							<?endif;?>
							</ul>
						</li>
				<?endforeach;?>
			<?endif;?>
		</li>
	</ul>
</li>
<?foreach ($blocks as $category => $block):?>
	<?if($category == 'Page System' || $category == 'Blog' || 
		 $category == 'Generic' || $category == 'Forum' || 
		 $category == 'Photo Gallery' || $category == 'VideoTube' || $category == 'VideoStream' ||
		 $category == 'Audio Player' || $category == 'Online Store' || $category == 'Booking Events' ||
		 $category == 'Realstate' || $category == 'Classifieds' || $category == 'Booking Rooms')
		continue;?>
	<li>
		<a class="editor-sidebar-block-category"><i class="fa fa-cube sidefa"></i> <?=$category?></a>
		<ul class="nav nav-pills nav-stacked blocks-category-holder">
		<?foreach($block['blocks'] as $sub_block_name => $sub_block):?>
			<li><a class="gray1 insert-block-<?=$block_id?>" block-type="<?=$sub_block['folder']?>" block-class="" style="color: #ffffff;font-size: 16px;margin-left: -20px;font-weight: 600;padding-top: 20px;padding-bottom: 20px;"><i class="fa fa-compass sidefa2" style="color: #48f002;"></i> <span style="color: #48f002;">Block:</span> <?=$sub_block_name?></a></li>
		<?endforeach;?>
		</ul>
	</li>
<?endforeach;?>

<script>
    $(document).ready(function(){
        $('.editor-sidebar-block-category').click(function(){
           $(this).parent().find('.blocks-category-holder').first().toggle();
        });
    });
</script>
