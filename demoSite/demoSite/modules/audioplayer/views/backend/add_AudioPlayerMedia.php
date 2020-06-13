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

<div class="panel panel-white">
    <div class="panel-heading">
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
        </div>
        <h4 class="panel-title"><?=$page?> Audio Track</h4>
    </div>
    <div class="panel-body panel-form">
		<?php 
			$albums = new AudioPlayerAlbum();
			$arr = array();
			foreach($albums->get() as $album)
			{array_push($arr,$album->id);}
			$count = count($arr);
		?>
        <form class="form-horizontal form-bordered" data-parsley-validate="true" method="post" enctype="multipart/form-data" name="media">
		<?php if($count > 0):?>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="title">Audio Title:</label>
				<div class="col-md-8 col-sm-8">
					<input class="form-control" type="text" id="title" name="title" value="<?=$object->title?>" data-parsley-required="true" required />
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="media_file">Audio File:</label>
				<div class="col-md-6 col-sm-6">
					<?php if($page == 'Add'):?>
					<span style="margin-right: 50%;margin-bottom:15px;" id="addBtn" class="btn btn-success fileinput-button">
						<i class="fa fa-plus"></i>
						<span><?=$page?> Audio</span>
							<style>
								.file_preview {
									max-height: 100px;
									margin-top: 10px;
								}
							</style>
						<input type="file" name="media_file" id="vf" onchange="previewFile();$('#avat').show();$('#addBtn').css('z-index','-1');" required>
					</span>
						<div id="avat" class="alert" style="display:none;width:130px;margin-top:10px;margin-bottom:10px;">
							<audio id="audio" width="100%" style="width:200px;margin-left:-15px;" controls>
								<source src="<?=$object->file?>" type="audio/mp3">
								<source src="<?=$object->file?>" type="audio/ogg">
								Your browser does not support HTML5 audio.
							</audio>
							<a href="<?=base_url('admin/module/audioplayer/add_media')?>" class="btn btn-xs btn-danger" style="margin-left:50px;"><i class="fa fa-times"></i> Remove</a>
						</div><br/>
					<?php else:?>
						<input type="hidden" name="media_file" value="">
						<audio width="28%" controls>
							<source src="<?=$object->file?>" type="audio/mp3">
							<source src="<?=$object->file?>" type="audio/ogg">
							Your browser does not support HTML5 audio.
						</audio>				
					<?php endif;?>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="categoryimage">Album Cover:</label>
				<div class="col-md-6 col-sm-6">
					<span class="btn btn-success fileinput-button">
						<i class="fa fa-plus"></i>
						<span> <?=$page?>  Sound Cover</span>
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
						<input id="ff" type="file" name="cover" rel="file_manager" file_value="<?=$object->cover?>">
					</span>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="album_id">Album Selection:</label>
				<div class="col-md-8 col-sm-8">								
					<select class="form-control" id="album" name="album_id" data-parsley-required="true" required>
					<?
						$albums = new AudioPlayerAlbum();
						$albums = $albums->where('user_id',$object->user_id)->or_where('user_id',$this->user->get_id())->get();
					?>
					<?foreach($albums->get() as $album):?>
						<option value="<?=$album->id?>" <?if($album->id == $object->audioplayeralbum_id) echo 'selected';?>><?=str_replace('_',' ',$album->name)?></option>
					<?endforeach;?>
					</select>
				</div>
			</div>
			<input type="hidden" name="status" value="public">
	
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
						}
						?>
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
		<!--	<div class="form-group">
				<label class="control-label col-md-4 col-sm-4" for="website">Groups (Accounts) Access Allowed:</label>
				<div class="form-group">
					<div class="col-md-8 col-sm-8">
	                    <ul id="access-groups">
	                    	<?php /*if($page == 'Edit'):*/?>
								<?php /*$groups = explode(',', $object->groups_allowed);*/?>
								<?php /*foreach($groups as $group):*/?>
								 	<li><?php /*$group*/?></li>
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
					<button type="submit" class="btn btn-primary"><?=$page?> Sound</button>
				</div>
			</div>
			<input type="hidden" name="user_id" id="user_id" value="<?=$object->user_id?>">
		<?php else:?>
			<div class="form-group">
				<div class="col-md-12 col-sm-12 text-center">
					<a href="<?=base_url('admin/module/audioplayer/register_admin/'.$this->user->id.'')?>" class="btn btn-danger">You must create an Album First !</a>
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

		$("#vf").click(function(e){
		   e.preventDefault();
		});
		$("#ff").click(function(e){
		   e.preventDefault();
		});
	});
	
	function previewFile() {
	  var preview = document.querySelector('#audio');
	  var file    = document.querySelector('input[type=file]').files[0];
	  var reader  = new FileReader();

	  reader.onloadend = function () {
		preview.src = reader.result;
	  }

	  if (file) {
		reader.readAsDataURL(file);
	  } else {
		preview.src = "";
	  }
	}
	
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
    });
</script>