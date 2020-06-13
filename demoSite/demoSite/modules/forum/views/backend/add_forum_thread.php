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
        <h4 class="panel-title"><?=$page?> New Post</h4>
    </div>
    <div class="panel-body panel-form">
        <form class="form-horizontal form-bordered" data-parsley-validate="true" method="post" enctype="multipart/form-data" name="media">
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="title">Post Title:</label>
				<div class="col-md-8 col-sm-8">
					<input class="form-control" type="text" id="title" name="title" value="<?=stripslashes($object->title)?>" data-parsley-required="true" />
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="categoryimage">Post Image:</label>
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
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="category_id">Thread Selection:</label>
				<div class="col-md-8 col-sm-8">	
					<?php 
						$threads = new Forum_category();
						$arr = array();
						foreach($threads->get() as $thread)
						{array_push($arr,$thread->id);}
						$count = count($arr);
					?>
					<?php if($count > 0):?>
					<select class="form-control" id="album" name="category_id" data-parsley-required="true" required >
					  <?php $category = new Forum_category;?>
					  <?php if($page == 'Edit'):?>
					  <?php $category = $category->get_by_id($object->category_id);?>
					  <option value="<?=$category->id?>" selected><?=stripslashes($category->name)?></option>
					  <?php else:?>
					  <?php foreach($category->get() as $cat):?>
					  <option value="<?=$cat->id?>"><?=stripslashes($cat->name)?></option>
					  <?php endforeach;?>
					  <?php endif;?>
					</select>
					<?php else:?>
						<a href="<?=base_url('admin/module/forum/add_category')?>" class="btn btn-danger">Create Thread First !</a>
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
				<label class="control-label col-md-4 col-sm-4 col-ck-4" for="blogname">Text:</label>
				<div class="col-md-8 col-sm-8 col-ck-8">
					<div class="panel-body panel-form">
			        <textarea class="ckeditor" id="editor1" name="text" rows="20"><?=stripslashes($object->text)?></textarea>
				</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="blogname">Add Attachment:</label>
				<div class="col-md-8 col-sm-8">
					<div class="panel-body panel-form">
			        <input id="e" type="file" name="attachment">
				</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4"></label>
				<div class="col-md-6 col-sm-6">
					<button type="submit" class="btn btn-primary <?=($count == 0)?'disabled':''?>"><?=$page?> Post</button>
				</div>
			</div>
			<input type="hidden" name="user_id" id="user_id" value="<?=$this->user->id?>">
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
	});
</script>

