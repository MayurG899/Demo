<div class="panel panel-white">
    <div class="panel-heading">
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
        </div>
        <h4 class="panel-title"><?=$page?> Audio Album</h4>
    </div>
    <div class="panel-body panel-form">
        <form class="form-horizontal form-bordered" data-parsley-validate="true" method="post" enctype="multipart/form-data" name="album">		
			<input type="hidden" name="user_id" value="<?=$object->user_id?>">
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="categoryname">Album Title:</label>
				<div class="col-md-8 col-sm-8">
					<input class="form-control" type="text" id="categoryname" name="name" value="<?=$object->name?>" data-parsley-required="true" required />
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="categoryimage">Album Image:</label>
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
						width:100px !important;
						max-height:50%;
						max-width:50%;
					}
				</style>
                <input id="ff" type="file" name="image" rel="file_manager" file_value="<?=$object->image?>">
            </span>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="categoryselection">Parent Album:</label>
				<div class="col-md-8 col-sm-8">								
					<select class="form-control" id="parent_id" name="parent_id" data-parsley-required="true">
						<option value="0">No Parent</option>						
	                    <?php $albums = new AudioPlayerAlbum();?>
	                    <?php if($page == 'add'):?>
		                    <?php foreach ($albums->get() as $parent_album):?>
			                    <option value="<?=$parent_album->id?>"><?=$parent_album->name?></option>
						<?php endforeach;?>
						<?php else:?>
							<?php foreach ($albums->get() as $parent_album):?>
								<?php if($parent_album->id != $object->id):?>
			                        <option value="<?=$parent_album->id?>" <?php if($object->parent_id == $parent_album->id) echo 'selected';?>><?=$parent_album->name?></option>
			                    <?php endif?> 
						<?php endforeach;?>
						<?php endif;?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="status">Status:</label>
				<div class="col-md-8 col-sm-8">								
					<select class="form-control" id="status" name="status" data-parsley-required="true">
					  <?php if($page == 'Edit'):?>
							<option value="public" <?=$public = ($object->status== 'public')?'selected':'';?>>Public</option>
							<option value="private" <?=$private = ($object->status== 'private')?'selected':'';?>>Private</option>
					  <?php else:?>
					  <option value="public">Public</option>
					  <option value="private">Private</option>
					  <?php endif;?>
					</select>
				</div>
			</div>
	<!--		<div class="form-group">
				<label class="control-label col-md-4 col-sm-4" for="website">Groups (Accounts) Access Allowed:</label>
				<div class="form-group">
					<div class="col-md-8 col-sm-8">
	                    <ul id="access-groups">
	                    <?php /*if($page != 'Add'):*/?>
								<?php /*$groups = explode(',',$object->groups_allowed);*/?>
								<?php /*foreach($groups as $group):*/?>
								 	<li value="<?php /*=$group*/?>"><?php /*=$group*/?></li>
								<?php /*endforeach*/?>
							<?php /*else:*/?>
								<li>Guests</li>
                            	<li>Members</li>
							<?php /*endif;*/?>
	                    </ul>
					</div>
				</div>
			</div>-->
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4"></label>
				<div class="col-md-6 col-sm-6">
					<button type="submit" class="btn btn-primary"><?=$page?> Album</button>
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

		$("#ff").click(function(e){
		   e.preventDefault();
		});
	});
</script>