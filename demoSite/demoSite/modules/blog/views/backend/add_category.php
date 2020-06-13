
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="panel panel-white">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				</div>
				<h4 class="panel-title"><?=$page?> Blog Category</h4>
			</div>
			<div class="panel-body panel-form">
				<form id="categoryForm" class="form-horizontal form-bordered" data-parsley-validate="true" method="post" enctype="multipart/form-data" name="category">
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-be-4" for="categoryname">
							Category Title:
							<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Category Name"></i></label>
						<div class="col-md-8 col-sm-8">
							<input class="form-control" type="text" id="categoryname" name="name" value="<?=stripslashes($object->name)?>" data-parsley-required="true" />
							<span id="catName" style="color:red;font-weight:600;"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-be-4" for="categoryimage">
							Category Image:
							<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Category Image"></i></label>
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
						<input id="f" type="file" name="image" rel="file_manager" file_value="<?=checkImagePath($object->image)?>">
					</span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-be-4" for="categoryselection">
							Parent Category:
							<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Parent Category (if applicable)"></i></label>
						<div class="col-md-8 col-sm-8">								
							<select class="form-control" id="parent_id" name="parent_id" data-parsley-required="true">
								<option value="0">No Parent</option>						
								<?php $categories = new Category();?>
								<?php if($page == 'add'):?>
									<?php foreach ($categories->get() as $parent_category):?>
										<?php if($parent_category->name != 'Unallocated'):?>
										<option value="<?=$parent_category->id?>"><?=stripslashes($parent_category->name)?></option>
										<?php endif;?>
								<?php endforeach;?>
								<?php else:?>
									<?php foreach ($categories->get() as $parent_category):?>
										<?php if($parent_category->id != $object->id && $parent_category->name != 'Unallocated'):?>
											<option value="<?=$parent_category->id?>" <?php if($object->parent_id == $parent_category->id) echo 'selected';?>><?=stripslashes($parent_category->name)?></option>
										<?php endif?> 
								<?php endforeach;?>
								<?php endif;?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-be-4" for="website">
							Group Access Policy:
							<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Only members of groups selected will see this category"></i></label>
						<div class="form-group">
							<div class="col-md-8 col-sm-8">
								<ul id="access-groups">
								<?php if($page != 'Add'):?>
										<?php $groups = explode(',',$object->groups_allowed);?>
										<?php foreach($groups as $group):?>
											<li value="<?=$group?>"><?=$group?></li>
										<?php endforeach?>
									<?php else:?>
										<li>Guests</li>
										<li>Members</li>
									<?php endif;?>
								</ul>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-be-4"></label>
						<div class="col-md-6 col-sm-6">
							<button id="submit" type="submit" class="btn btn-primary"><?=$page?> Blog Category</button>
						</div>
					</div>
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

		$("#f").click(function(e){
		   e.preventDefault();
		});
		
	});

	$("form").submit(function(event){
		if ($('#categoryname').val() != "Unallocated") {
			return;
		}
		$('#catName').text( "This category name is reserved.Please,choose another !" ).show().fadeOut(3000);
		event.preventDefault();
	});
</script>