<div class="panel panel-white">
    <div class="panel-heading">
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
        </div>
        <h4 class="panel-title"><?=$page?> Post Thread</h4>
    </div>
    <div class="panel-body panel-form">
        <form class="form-horizontal form-bordered" data-parsley-validate="true" method="post" enctype="multipart/form-data" name="album">	
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="categoryname">Thread Title:</label>
				<div class="col-md-8 col-sm-8">
					<input class="form-control" type="text" id="categoryname" name="name" value="<?=stripslashes($object->name)?>" data-parsley-required="true" required />
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="description">Thread Description:</label>
				<div class="col-md-8 col-sm-8">
					<input class="form-control" type="text" id="description" name="description" value="<?=$object->description?>" data-parsley-required="true" />
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="categoryimage">Thread Image:</label>
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
			<?php 
				$forums = new Forum_topic();
				$arr = array();
				foreach($forums->get() as $forum)
				{array_push($arr,$forum->id);}
				$count = count($arr);
			?>
			<div class="form-group">
				<label class="control-label col-md-4 col-sm-4 col-be-4" for="categoryselection">Forum Topic:</label>
				<div class="col-md-8 col-sm-8">	
					<?php if($count > 0):?>
					<select class="form-control" id="topic_id" name="topic_id" data-parsley-required="true" required>
	                    <?php $topics = new Forum_topic();?>
	                    <?php if($page == 'add'):?>
		                    <?php foreach ($topics->get() as $topic):?>
			                    <option value="<?=$topic->id?>"><?=stripslashes($topic->name)?></option>
						<?php endforeach;?>
						<?php else:?>
							<?php $current_topic = new Forum_topic($object->topic_id);?>
								<option value="<?=$current_topic->id?>" selected><?=stripslashes($current_topic->name)?></option>
						<?php $topics = new Forum_topic();?>
							<?php foreach ($topics->get() as $topic):?>
								<?php if($topic->id != $current_topic->id):?>
			                        <option value="<?=$topic->id?>"><?=stripslashes($topic->name)?></option>
			                    <?php endif?> 
						<?php endforeach;?>
						<?php endif;?>
					</select>
					<?php else:?>
						<a href="<?=base_url('admin/module/forum/add_topic')?>" class="btn btn-danger">Add Forum First !</a>
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
					<button type="submit" class="btn btn-primary <?=($count == 0)?'disabled':''?>"><?=$page?> Thread</button>
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
</script>