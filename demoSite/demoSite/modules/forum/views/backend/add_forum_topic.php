<div class="panel panel-white">
    <div class="panel-heading">
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
        </div>
        <h4 class="panel-title"><?=$page?> Forum Topic</h4>
    </div>
    <div class="panel-body panel-form">
        <form class="form-horizontal form-bordered" data-parsley-validate="true" method="post" enctype="multipart/form-data" name="album">
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="categoryname">Topic Title:</label>
				<div class="col-md-8 col-sm-8">
					<input class="form-control" type="text" id="categoryname" name="name" value="<?=stripslashes($object->name)?>" data-parsley-required="true" required />
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="description">Topic Description:</label>
				<div class="col-md-8 col-sm-8">
					<input class="form-control" type="text" id="description" name="description" value="<?=$object->description?>" data-parsley-required="true" />
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="avatar">Topic Thumbnail:</label>
				<div class="col-md-8 col-sm-8">
					<label class="radio-inline">
						<input type="radio" name="switch" checked >
						Icon
					</label>
					<label class="radio-inline">
						<input type="radio" name="switch"  >
						Image
					</label>
				</div>
			</div>
			<div class="form-group switch" id="icon_thumb" style="display:block;">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="avatar">Icon:</label>
				<div class="col-md-8 col-sm-8">
				<?php $icons = new Icon();?>
					<select name="icon"> 
						<option value="http://placehold.it/64x64">No Icon</option>
					  <?php foreach($icons->get() as $icon):?>
							<option value="<?=base_url('modules/forum/assets/img/'.$icon->image.'')?>" data-class="avatar" data-style="background-image:url(&apos;<?=base_url('modules/forum/assets/img/'.$icon->image.'')?>&apos;);background-repeat:no-repeat; padding-left:55px;margin:5px 0;" required> <?=$icon->name?> </option>
					  <?php endforeach;?>
					</select>
				</div>
			</div>
			<div class="form-group switch" id="image_thumb" style="display:none;">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="categoryimage">Image:</label>
				<div class="col-md-6 col-sm-6">
			<span class="btn btn-success fileinput-button">
                <i class="fa fa-plus"></i>
                <span><?=$page?> Image</span>
				<style>
					.file_preview {
						max-height: 100px;
						margin-top: 10px;
					}
					.profile-avatar{
						float:none !important;
						    margin-left: -14px;
					}
					.profile-avatar img{
						width:50%;
					}
				</style>
                <input id="f" type="file" name="image" rel="file_manager" file_value="<?=$object->image?>">
            </span>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="categoryselection">Area:</label>
				<div class="col-md-8 col-sm-8">	
	                    <?php 
							$areas = new Area();
							$arr = array();
							foreach($areas->get() as $area)
							{array_push($arr,$area->id);}
							$count = count($arr);
						?>	
					<?php if($count > 0):?>						
					<select class="form-control" id="area_id" name="area_id" data-parsley-required="true">				
	                    <?php if($page == 'add'):?>
		                    <?php foreach ($areas->get() as $area):?>
			                    <option value="<?=$area->id?>"><?=stripslashes($area->name)?></option>
							<?php endforeach;?>
						<?php else:?>
							<?php foreach ($areas->get() as $area):?>
			                    <option value="<?=$area->id?>"><?=stripslashes($area->name)?></option>
						    <?php endforeach;?>
						<?php endif;?>
					</select>
					<?php else:?>
						<a href="<?=base_url('admin/module/forum/add_area')?>" class="btn btn-danger">Add Area First !</a>
					<?php endif;?>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="website">Groups (Accounts) Access Allowed:</label>
				<div class="form-group">
					<div class="col-md-8 col-sm-8">
	                    <ul id="access-groups">
	                    <?if($page != 'Add'):?>
							<?$groups = explode(',',$object->groups_allowed);?>
							<?foreach($groups as $group):?>
								<li value="<?=$group?>"><?=$group?></li>
							<?endforeach?>
						<?else:?>
							<li>Guests</li>
							<li>Members</li>
						<?endif;?>
	                    </ul>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4"></label>
				<div class="col-md-6 col-sm-6">
					<button type="submit" class="btn btn-primary <?=($count == 0)?'disabled':''?>"><?=$page?> Forum Topic</button>
				</div>
			</div>
        </form>
    </div>
</div>
<?php $groups = new Group;?>
<script>
    $(document).ready(function (){
	    $('#access-groups').tagit({
	        fieldName: "groups_allowed",
	        singleField: true,
	        showAutocompleteOnFocus: true,
	        availableTags: [ <?php foreach ($groups->get() as $group): ?>"<?php echo $group->name?>", <?php endforeach;?>]
	    });

		$("#f").click(function(e){
		   e.preventDefault();
		});
	});
	
	$("input[name='switch']").change(function() {
			$('.switch').toggle();
	});
</script>