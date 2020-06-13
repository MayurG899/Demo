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
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="panel panel-white">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				</div>
				<h4 class="panel-title"><?=$page?> Blog Post</h4>
			</div>
    <div class="panel-body panel-form">
        <form class="form-horizontal form-bordered" data-parsley-validate="true" method="post" enctype="multipart/form-data" name="post">
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="title">
					<b>Blog Title:</b>
					<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Blog Post Name"></i></label>
				<div class="col-md-8 col-sm-8">
					<input class="form-control" type="text" id="title" name="title" value="<?=stripslashes($object->title)?>" data-parsley-required="true" required />
				</div>
			</div>
            <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-be-4" for="slug">
					<b>URL Slug:</b>
					<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Blog Post URL Slug"></i></label>
                <div class="col-md-8 col-sm-8">
                    <input class="form-control" type="text" id="slug" name="slug" placeholder="URL Address Link" value="<?=$object->slug?>" required />
                </div>
            </div>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="blogimage">
					<b>Blog Image:</b>
					<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Blog Post Image"></i></label>
				<div class="col-md-6 col-sm-6">
					<span class="btn btn-success fileinput-button">
                <i class="fa fa-plus"></i>
                <span><?=$page?> Image</span>
				
                <input id="f" type="file" name="image" rel="file_manager" file_value="<?=checkImagePath($object->image)?>">
            </span>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="categoryselection">
					<b>Category Selection:</b>
					<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Blog Category for Post (Mandatory)"></i></label>
				<div class="col-md-8 col-sm-8">								
					<select class="form-control" id="select-required" name="category_id" data-parsley-required="true" required>
						<option value="">Select Category</option>					 
                        <?php $categories = new Category();?>
						<?php foreach($categories->get() as $category):?>
							<option value="<?=$category->id?>" <?php if($category->id == $object->category_id) echo 'selected'?>><?=stripslashes($category->name)?></option>
                        <?php endforeach?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="fullname">
					<b>Allow Comments:</b>
					<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Allow Comments"></i></label>
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
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="comments_allowed" value="hide" <?=$check3?>/>Disable,Hide all
                    </label>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="website">
					<b>Add Tags:</b>
					<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Tags for Blog Post Content"></i></label>
				<div class="form-group">
					<div class="col-md-8 col-sm-8">
	                    <ul id="tags" class="white">
	                    	<?php if($page == 'Edit'):?>
								<?php $tags = explode(',', $object->tags);?>
								<?php foreach($tags as $tag):?>
								 	<li><?=stripslashes($tag)?></li>
								<?php endforeach?>
							<?php endif;?>
	                    </ul>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="website">
				<b>Groups Access Policy:</b>
				<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Only members of groups selected will see this Post"></i></label>
				<div class="form-group">
					<div class="col-md-8 col-sm-8">
	                    <ul id="access-groups">
	                    	<?php if($page == 'Edit'):?>
								<?php $groups = explode(',', $object->groups_allowed);?>
								<?php foreach($groups as $group):?>
								 	<li><?=$group?></li>
								<?php endforeach ?>
							<?php else:?>
								<li>Guests</li>
                            	<li>Members</li>
							<?php endif;?>
	                    </ul>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-12 col-sm-12" for="blogname">
					<div style="text-align: left;"><b>Write Your Blog Content:</b>
					<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="This is where you add your main Blog Content"></i>
					</div>
				</label>
				<div class="col-md-12 col-sm-12">
					<div class="panel-body panel-form">
					<style>
						.demo1{
							line-height: 20.8px;
							text-align: center ;
						}
						.demo2{
							width: 50px;
							height: 50px;
						}
						.demo3{
							width: 50px;
							height: 50px; 
						}
						.demo4{
							margin-left:15px;
							width: 350px;
							height: 350px;
						}
						.demo5{
							line-height: 20.8px;
							text-align: center;						
						}
						.demo6{
							margin-left: 200px;
							
						}
					</style>
					<?php $txt = ChEditorfix($object->text);?>
			        <textarea class="ckeditor" id="editor1" name="text" rows="20"><?=str_replace('/files/be_demo',base_url('files/be_demo'),$txt)?></textarea>
				</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4">
				</label>
				<div class="col-md-6 col-sm-6">
				<span class="label label-danger" id="catName" style="color:#fff;font-weight:600;margin-bottom:10px;"></span><br/>
					<button type="submit" class="btn btn-primary" style="margin-top:5px;" ><?=$page?> Blog Post</button>
				</div>
			</div>
			<input type="hidden" name="user_id" id="user_id" value="<?=$this->user->id?>">
        </form>
    </div>
</div>
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
	<?php $posts = new Post();?>
	$("form").submit(function(event){
		var title = $('#title').val();
		<?php if($page == 'Edit'):?>
		var array = [ <?php foreach ($posts->where('title !=',$object->title)->get() as $post): ?>"<?php echo $post->title?>", <?php endforeach;?>];
		<?php else:?>
		var array = [ <?php foreach ($posts->get() as $post): ?>"<?php echo $post->title?>", <?php endforeach;?>];		
		<?php endif;?>
		if(array.indexOf(title) == -1) {
			return;
		}
		$('#catName').text( "This blog title already exists! Please,choose another !" ).show().fadeOut(4000);
		event.preventDefault();
	});
</script>