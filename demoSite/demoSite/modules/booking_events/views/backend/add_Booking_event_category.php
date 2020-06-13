
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="panel panel-white">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				</div>
				<h4 class="panel-title"><?=$page?> Event Category</h4>
			</div>
			<div class="panel-body panel-form">
				<form id="categoryForm" class="form-horizontal form-bordered" data-parsley-validate="true" method="post" enctype="multipart/form-data" name="category">
					<?if($page == 'Edit'):?>
						<input type="hidden" name="object_id" value="<?=$object->id?>" />
					<?endif;?>
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
							Calendar Color For Category:
							<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Event Category Calendar Bar Color"></i></label>
						<div class="col-md-8 col-sm-8">	
							<style type="text/css">
								.be-category-bar-blue {background-color: #02C3F3;}
								.be-category-bar-pink {background-color: #F079AD;}
								.be-category-bar-yellow {background-color: #FFF37A;}
								.be-category-bar-orange {background-color: #FB9404;}
								.be-category-bar-green {background-color: #C2DA66;}
								.be-category-bar-white {background-color: #FFFFFF;}
							</style>						
							<select class="form-control" id="color" name="color" data-parsley-required="true">
								<option value="">Select Calendar Color</option>
								<option class="be-category-bar-blue" value="be-category-bar-blue" <?if($object->color == 'be-category-bar-blue')echo 'selected';?>>Blue</option>
								<option class="be-category-bar-green" value="be-category-bar-green" <?if($object->color == 'be-category-bar-green')echo 'selected';?>>Green</option>
								<option class="be-category-bar-orange" value="be-category-bar-orange" <?if($object->color == 'be-category-bar-orange')echo 'selected';?>>Orange</option>
								<option class="be-category-bar-pink" value="be-category-bar-pink" <?if($object->color == 'be-category-bar-pink')echo 'selected';?>>Pink</option>
								<option class="be-category-bar-yellow" value="be-category-bar-yellow" <?if($object->color == 'be-category-bar-yellow')echo 'selected';?>>Yellow</option>
								<option class="be-category-bar-white" value="be-category-bar-white" <?if($object->color == 'be-category-bar-white')echo 'selected';?>>White</option>
							</select>
							<script>
							$(document).ready(function(){
								<?if(!empty($object->color)):?>
									$('#color').addClass('<?=$object->color?>');
								<?endif;?>
								$('#color').on('change',function(){
									var selected = this.value;
									$(this).removeClass().addClass('form-control').addClass(selected );
								});
							});
							</script>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-be-4" for="categoryselection">
							Parent Category:
							<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Parent Category (if applicable)"></i></label>
						<div class="col-md-8 col-sm-8">								
							<select class="form-control" id="parent_id" name="parent_id" data-parsley-required="true">
								<option value="0">No Parent</option>						
								<?php $categories = new Booking_event_category();?>
								<?php if($page == 'Add'):?>
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
							<button id="submit" type="submit" class="btn btn-primary"><?=$page?> Event Category</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php $groups = new Group;?>
<script>
	<?php $categories = new Booking_event_category();?>
	$("form").submit(function(event){
		var name = $('#categoryname').val();
		<?php if($page == 'Edit'):?>
		var array = [ <?php foreach ($categories->where('name !=',$object->name)->get() as $category): ?>"<?php echo $category->name?>", <?php endforeach;?>];
		<?php else:?>
		var array = [ <?php foreach ($categories->get() as $category): ?>"<?php echo $category->name?>", <?php endforeach;?>];		
		<?php endif;?>
		if(array.indexOf(name) == -1) {
			return;
		}
		$('#catName').html( "<i class='fa fa-exclamation-triangle'></i> Category name \"" + name + "\" already exists! Please,choose another !" ).show().delay(2500).fadeOut(500);
		event.preventDefault();
	});
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