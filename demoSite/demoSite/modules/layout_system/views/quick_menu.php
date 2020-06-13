<div class="builder-quick-menu builder-quick-menu-<?=$block_id?>">
    <?php if($type == 'style'):?>
        <div class="quick-menu-item menu-item-1 animation-<?=$block_id?>" block-name="<?=$block_name?>"><i class="btn-label fa fa-cogs"></i>&nbsp Animations </div>
        <div class="quick-menu-item menu-item-2 custom-<?=$block_id?>" block-name="<?=$block_name?>"><i class="btn-label fa fa-picture-o"></i>&nbsp Custom</div>
        <div class="quick-menu-item menu-item-3 style-<?=$block_id?>" block-name="<?=$block_name?>"><i class="btn-label fa fa-picture-o"></i>&nbsp Style </div>
    <?php elseif($type == 'advanced'):?>
        <div class="quick-menu-item menu-item-1 animation-<?=$block_id?>" block-name="<?=$block_name?>"><i class="btn-label fa fa-cogs"></i>&nbsp Animations </div>
        <div class="quick-menu-item menu-item-2 add-element-<?=$block_id?>" block-name="<?=$block_name?>"><i class="btn-label fa fa-plus-square"></i>&nbsp Add Element</div>
        <div class="quick-menu-item menu-item-3 delete-element-<?=$block_id?>" block-name="<?=$block_name?>"><i class="btn-label fa fa-times"></i>&nbsp Delete Element</div>
        <div class="quick-menu-item menu-item-4 style-<?=$block_id?>" block-name="<?=$block_name?>"><i class="btn-label fa fa-picture-o"></i>&nbsp Style </div>
        <div class="quick-menu-item menu-item-5 custom-<?=$block_id?>" block-name="<?=$block_name?>"><i class="btn-label fa fa-picture-o"></i>&nbsp Custom</div>
    <?php elseif($type == 'with_settings'):?>
        <div class="quick-menu-item menu-item-1 animation-<?=$block_id?>" block-name="<?=$block_name?>"><i class="btn-label fa fa-cogs"></i>&nbsp Animations </div>
        <div class="quick-menu-item menu-item-2 custom-<?=$block_id?>" block-name="<?=$block_name?>"><i class="btn-label fa fa-picture-o"></i>&nbsp Custom</div>
        <div class="quick-menu-item menu-item-3 style-<?=$block_id?>" block-name="<?=$block_name?>"><i class="btn-label fa fa-picture-o"></i>&nbsp Style </div>
        <div class="quick-menu-item menu-item-4 settings-<?=$block_id?>" block-name="<?=$block_name?>"><i class="btn-label fa fa-cogs"></i>&nbsp Settings </div>
    <?php elseif($type == 'add_block'):?>
		<?/*<div class="quick-menu-item menu-item-1 add-block-<?=$block_id?>"  block-name="<?=$block_name?>"><i class="btn-label fa fa-cogs"></i>&nbsp Add Block</div>*/?>
        <div class="quick-menu-item menu-item-2 custom-<?=$block_id?>" block-name="<?=$block_name?>"><i class="btn-label fa fa-picture-o"></i>&nbsp Custom</div>
        <div class="quick-menu-item menu-item-3 style-<?=$block_id?>"  block-name="<?=$block_name?>"><i class="btn-label fa fa-cogs"></i>&nbsp Style </div>
    <?php elseif($type == 'add_block_global'):?>
		<?/*<div class="quick-menu-item menu-item-1 add-block-<?=$block_id?>"  block-name="<?=$block_name?>"><i class="btn-label fa fa-cogs"></i>&nbsp Add Block</div>*/?>
        <div class="quick-menu-item menu-item-2 custom-<?=$block_id?>" block-name="<?=$block_name?>"><i class="btn-label fa fa-picture-o"></i>&nbsp Custom</div>
        <div class="quick-menu-item menu-item-3 style-<?=$block_id?>"  block-name="<?=$block_name?>"><i class="btn-label fa fa-cogs"></i>&nbsp Style </div>
        <div class="quick-menu-item menu-item-4 global_style-<?=$block_id?>" block-name="<?=$block_name?>"><i class="btn-label fa fa-picture-o"></i>&nbsp Global</div>
    <?php elseif($type == 'global_style'):?>
        <div class="quick-menu-item menu-item-1 animation-<?=$block_id?>" block-name="<?=$block_name?>"><i class="btn-label fa fa-cogs"></i>&nbsp Animations </div>
        <div class="quick-menu-item menu-item-2 custom-<?=$block_id?>" block-name="<?=$block_name?>"><i class="btn-label fa fa-picture-o"></i>&nbsp Custom</div>
        <div class="quick-menu-item menu-item-3 style-<?=$block_id?>" block-name="<?=$block_name?>"><i class="btn-label fa fa-picture-o"></i>&nbsp Style </div>
        <div class="quick-menu-item menu-item-4 global_style-<?=$block_id?>" block-name="<?=$block_name?>"><i class="btn-label fa fa-picture-o"></i>&nbsp Global</div>
    <?php elseif($type == 'advanced_global'):?>
        <div class="quick-menu-item menu-item-1 animation-<?=$block_id?>" block-name="<?=$block_name?>"><i class="btn-label fa fa-cogs"></i>&nbsp Animations </div>
        <div class="quick-menu-item menu-item-2 add-element-<?=$block_id?>" block-name="<?=$block_name?>"><i class="btn-label fa fa-plus-square"></i>&nbsp Add Element</div>
        <div class="quick-menu-item menu-item-3 delete-element-<?=$block_id?>" block-name="<?=$block_name?>"><i class="btn-label fa fa-times"></i>&nbsp Delete Element</div>
        <div class="quick-menu-item menu-item-4 custom-<?=$block_id?>" block-name="<?=$block_name?>"><i class="btn-label fa fa-picture-o"></i>&nbsp Custom</div>
        <div class="quick-menu-item menu-item-5 style-<?=$block_id?>" block-name="<?=$block_name?>"><i class="btn-label fa fa-picture-o"></i>&nbsp Style </div>
        <div class="quick-menu-item menu-item-6 global_style-<?=$block_id?>" block-name="<?=$block_name?>"><i class="btn-label fa fa-picture-o"></i>&nbsp Global</div>
    <?php elseif($type == 'with_settings_global'):?>
        <div class="quick-menu-item menu-item-1 animation-<?=$block_id?>" block-name="<?=$block_name?>"><i class="btn-label fa fa-cogs"></i>&nbsp Animations </div>
        <div class="quick-menu-item menu-item-2 custom-<?=$block_id?>" block-name="<?=$block_name?>"><i class="btn-label fa fa-picture-o"></i>&nbsp Custom</div>
        <div class="quick-menu-item menu-item-3 style-<?=$block_id?>" block-name="<?=$block_name?>"><i class="btn-label fa fa-picture-o"></i>&nbsp Style </div>
        <div class="quick-menu-item menu-item-4 settings-<?=$block_id?>" block-name="<?=$block_name?>"><i class="btn-label fa fa-cogs"></i>&nbsp Settings </div>
        <div class="quick-menu-item menu-item-5 global_style-<?=$block_id?>" block-name="<?=$block_name?>"><i class="btn-label fa fa-picture-o"></i>&nbsp Global</div>
    <?php elseif($type == 'module'):?>
        <div class="quick-menu-item menu-item-1 animation-<?=$block_id?>" block-name="<?=$block_name?>"><i class="btn-label fa fa-cogs"></i>&nbsp Animations </div>
        <div class="quick-menu-item menu-item-2 custom-<?=$block_id?>" block-name="<?=$block_name?>"><i class="btn-label fa fa-picture-o"></i>&nbsp Custom</div>
        <div class="quick-menu-item menu-item-3 style-<?=$block_id?>" block-name="<?=$block_name?>"><i class="btn-label fa fa-picture-o"></i>&nbsp Style </div>
        <div class="quick-menu-item menu-item-4 output-<?=$block_id?>"  block-name="<?=$block_name?>"><i class="btn-label fa fa-cogs"></i>&nbsp Output</div>
    <?php endif;?>
</div>