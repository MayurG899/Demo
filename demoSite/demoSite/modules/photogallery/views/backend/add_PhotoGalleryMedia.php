		<?php 
			$albums = new PhotoGalleryAlbum();
			$arr = array();
			foreach($albums->get() as $album)
			{array_push($arr,$album->id);}
			$count = count($arr);
		?>
<?php if($count > 0):?>
<script src="<?=base_url('builderengine/public/js/editor/ckeditor.js')?>"></script>
<script type="text/javascript">
    $(document).ready(function (){
        CKEDITOR.replace( 'editor1' );
    });
// $(document).ready( function () {
//     $( '#post_contents').ckeditor({
//         toolbarGroups: [
//             { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },

//             { name: 'forms' },
//             '/',

//             { name: 'styles' },
//             { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
//             { name: 'insert' },
//             '/',
//             { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
//             { name: 'colors' },
//             { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
            
//             { name: 'links' },
//         ]

//     });

// });
</script>
<?endif;?>
<div class="panel panel-white">
    <div class="panel-heading">
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
        </div>
        <h4 class="panel-title"><?=$page?> New Photo</h4>
    </div>
    <div class="panel-body panel-form">
        <form class="form-horizontal form-bordered" data-parsley-validate="true" method="post" enctype="multipart/form-data" name="media">
		<?php if($count > 0):?>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="title">Photo Title:</label>
				<div class="col-md-8 col-sm-8">
					<input class="form-control" type="text" id="title" name="title" value="<?=$object->title?>" data-parsley-required="true" required />
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="media_file">Photo File:</label>
				<div class="col-md-6 col-sm-6">
					<span style="margin-right: 50%;" class="btn btn-success fileinput-button">
						<i class="fa fa-plus"></i>
						<span><?=$page?> Photo File</span>

						<input id="f" type="file" name="media_file" rel="file_manager" file_value="<?=$object->file?>">
					</span>
					<!--
					<span><img style="width:50px;height:50px;" src="<?//=base_url()?><?//=$object->media_file?>" /></span>
					-->

					</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="album_id">Album Selection:</label>
				<div class="col-md-8 col-sm-8">								
					<select class="form-control" id="album" name="album_id" data-parsley-required="true" required>
					<?
						$albums = new PhotoGalleryAlbum();
						$albums = $albums->where('user_id',$object->user_id)->or_where('user_id',$this->user->get_id())->get();
					?>
					<?foreach($albums->get() as $album):?>
						<option value="<?=$album->id?>" <?if($album->id == $object->photogalleryalbum_id) echo 'selected';?>><?=str_replace('_',' ',$album->name)?></option>
					<?endforeach;?>
					</select>
				</div>
			</div>
			<input type="hidden" name="status" value="Public">
	
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="fullname">Allow Comments:</label>
				<div class="col-md-6 col-sm-6">
					<label class="radio-inline">
						<?php if($object->comments_allowed == 'yes') 
					    {  
					    	$check1 = 'checked';  
					    	$check2 = '';
							$check3 = '';
					    }
					   	elseif($object->comments_allowed == 'no')
					    {  
					    	$check1 = ''; 
					    	$check2 = 'checked';
							$check3 = '';
					    }
						else{
					    	$check1 = ''; 
					    	$check2 = '';
							$check3 = 'checked';
						}?>
                      	<input type="radio" name="comments_allowed" value="yes" <?=$check1?>/>Yes
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="comments_allowed" value="no" <?=$check2?>/>Disable,Show existing
                    </label><br/>
                    <label class="radio-inline">
                        <input type="radio" name="comments_allowed" value="hide" <?=$check3?>/>Disable,Hide all
                    </label>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="website">Featured:</label>
				<div class="form-group">
					<div class="col-md-8 col-sm-8">
						<select name="featured" class="form-control">
							<option value="no" <?if($object->featured == 'no')echo'selected';?>>No</option>
							<option value="yes" <?if($object->featured == 'yes')echo'selected';?>>Yes</option>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="website">Add Tags:</label>
				<div class="form-group">
					<div class="col-md-8 col-sm-8">
	                    <ul id="tags" class="white">
	                    	<?php if($page == 'Edit'):?>
								<?php $tags = explode(',', $object->tags);?>
								<?php foreach($tags as $tag):?>
								 	<li><?=$tag?></li>
								<?php endforeach?>
							<?php endif;?>
	                    </ul>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="website">Groups (Accounts) Access Allowed:</label>
				<div class="form-group">
					<div class="col-md-8 col-sm-8">
	                    <ul id="access-groups">
	                    	<?if($page == 'Edit'):?>
								<?$groups = explode(',', $object->groups_allowed);?>
								<?foreach($groups as $group):?>
								 	<li><?=$group?></li>
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
				<label class="control-label col-md-4 col-sm-4 col-ck-4" for="blogname">Description:</label>
				<div class="col-md-8 col-sm-8 col-ck-8">
					<div class="panel-body panel-form">
			        <textarea class="ckeditor" id="editor1" name="text" rows="20"><?=Cheditorfix($object->description)?></textarea>
				</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4"></label>
				<div class="col-md-6 col-sm-6">
					<button type="submit" class="btn btn-primary"><?=$page?> Photo</button>
				</div>
			</div>
			<input type="hidden" name="user_id" id="user_id" value="<?=$object->user_id?>">
		<?php else:?>
			<div class="form-group">
				<div class="col-md-12 col-sm-12 text-center">
					<a href="<?=base_url('admin/module/photogallery/register_admin/'.$this->user->id.'')?>" class="btn btn-danger">You must create an Album First !</a>
				</div>
			</div>
		<?php endif;?>
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
	    $('#tags').tagit({
	        fieldName: "tags",
	        singleField: true,
	        showAutocompleteOnFocus: true
	    });
	});
</script>
<script>
    function convertToSlug(Text)
    {
        return Text
            .toLowerCase()
            .replace(/ /g,'-')
            .replace(/[^\w-]+/g,'')
            ;
    }
    $(document).ready(function (){
        $("#title").keyup(function() {
            $("#slug").val($("#title").val());
            $("#slug").change();
        });

        $("#slug").keyup(function() {
            $("#slug").change();
        });
        $("#slug").change(function() {
            $("#slug").val(convertToSlug($("#slug").val()));
        });

		$("#f").click(function(e){
		   e.preventDefault();
		});

    });
</script>