<style type="text/css">
.hidden-element
{
    display:none !important;
}
.file_preview {
	max-height: 100px;
	margin-top: 10px;
}
.profile-avatar{
	float:none !important;
		margin-left: -14px;
}
.profile-avatar img{
	max-height:50%;
	max-width:50%;
}
</style>
<!-- begin row -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="panel panel-white">
    <div class="panel-heading">
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
        </div>
        <h4 class="panel-title"><?=$page?> Store Category For Products</h4>
    </div>
    <div class="panel-body panel-form">
        <form class="form-horizontal form-bordered" data-parsley-validate="true" method="post" enctype="multipart/form-data" name="category">
            <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-be-4" for="categoryname">Category Name:</label>
                <div class="col-md-8 col-sm-8">
                    <input class="form-control" type="text" id="categoryname" name="name" value="<?=$object->name?>" data-parsley-required="true" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-be-4" for="categoryselection">Parent or Sub-Category:</label>
                <div class="col-md-8 col-sm-8">                             
                    <select class="form-control" id="parent_id" name="parent" data-parsley-required="true">
                    <option value="0">No Parent</option>
                    <?$categories = new Ecommerce_category();?>
                    <? foreach ($categories->where('parent', 0)->get() as $parent_category):?>
                        <option value="<?=$parent_category->id?>" <?if($object->parent == $parent_category->id) echo 'selected';?>><?=$parent_category->name?></option>
                    <? endforeach;?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-be-4" for="categoryimage">Category Image:</label>
                <div class="col-md-6 col-sm-6" style="height: 100%;">
                <span class="btn btn-success fileinput-button">
                        <i class="fa fa-plus"></i>
                        <span><?=$page?> Image</span>
                        <input class="fileUpload" type="file" name="image" rel="file_manager" file_value="<?=checkImagePath($object->image)?>">
                    </span>
                </div>
            </div>
            <?if($page == 'Add'):?>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-4 col-be-4" for="categoryimage">Additional Information Fields for Products using this Category:</label>
                    <div class="col-md-6 col-sm-6">
                    <div id="fields_holder"></div>
                    <span id="create_field"  class="btn btn-success fileinput-button">
                        <i class="fa fa-plus"></i>
                        <span>Add Custom Information</span>
                        <input type="button" >
                    </span>
                    </div>
                </div>
            <?endif;?>
            <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-be-4"></label>
                <div class="col-md-6 col-sm-6">
                    <button type="submit" class="btn btn-success">Save Store Category</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php if($page == 'Edit'):?>

<div class="panel panel-white">
    <div class="panel-heading">
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
        </div>
        <h4 class="panel-title">Additional Information for Products using this Category:</h4>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <form class="form-horizontal form-bordered" data-parsley-validate="true" method="post" enctype="multipart/form-data" name="category">
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-4 col-be-4" for="categoryname">Information Name:</label>
                    <div class="col-md-8 col-sm-8">
                        <input class="form-control" type="text" id="field_name" data-parsley-required="true" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-4 col-be-4"></label>
                    <div class="col-md-6 col-sm-6">
                        <button type="button" id="add_field" class="btn btn-primary">Create New Information Option</button>
                    </div>
                </div>
                <div class="widget-content">
                    </br>
                    </br>
                </div>
                <table id="data-table" class="table table-striped table-bordered" >
                    <thead>
                        <tr>
                            <th width="150">Edit</th>
                            <th>Additional Information Name</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody id="fields_table">
                        <?php foreach($object->category_field->get() as $field):?>
                            <tr class="odd gradeX">
                                <td >
                                    <a class="edit-field-value btn btn-success" style="width:100%" field-id="<?=$field->id?>">Edit</a>
                                    <div class="btn-group btn-group-vertical input-controls hidden-element" style="width:100%">
                                        <a class="btn btn-info update-field">Update</a>
                                        <a class="btn btn-default cancel-update">Cancel</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="field-text"><?=$field->name?></div>
                                    <input type="text" class="hidden-element field-input field-input-name col-lg-12" value="<?=$field->name?>">
                                </td>
                                <td style="width: 100px">
                                    <a class="delete-field-value btn btn-danger" style="width:100%" field-id="<?=$field->id?>">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
</div>
</div>	


<?php endif;?>
<script type="text/javascript">
    $(document).ready(function (){
        var category_id = '<?=$object->id?>';
        function refresh() {
            var tableInfo = $.ajax({
                type: "GET",
                url: '<?=base_url("/ecommerce/ajax/show_category_fields_table/")?>' + '/' + category_id,
                async: false
            }).responseText;
            $('#fields_table').html(tableInfo);
        }
        var count = 1;
        $('#create_field').click(function(){
            console.log('1000000000000000');
            $('#fields_holder').append('<label><div class="input-group" ><input type="text" class="form-control" name="custom[' + count + ']" placeholder="Field Name"><div class="input-group-addon delete-field-button">&#x2715;</div></div></label>');
            count++;
        });
        $('body').on('click', 'div.delete-field-button', function() {
            $(this).parent().parent().remove();
        });
        $('#add_field').click(function (){
            var field_name = $('#field_name').val();
            $.ajax({
                type: "POST",
                url: '<?=base_url("/ecommerce/ajax/add_category_field/")?>',
                data: { name : field_name, category_id : category_id},
                async: false
            });
            $('#fields_table').html('<img style="width:200px; height: auto; margin-left: 25%" src="http://sierrafire.cr.usgs.gov/images/loading.gif">');
            refresh();
        });
        $('body').on('click', 'a.delete-field-button', function() {
            $(this).parent().parent().remove();
        });
        $('body').on('click', 'a.edit-field-value', function() {
            $(this).parent().parent().find('.field-text').addClass('hidden-element');
            $(this).parent().parent().find('.field-input').removeClass('hidden-element');
            $(this).addClass('hidden-element');
            $(this).parent().find('.input-controls').removeClass('hidden-element');
        });
        $('body').on('click', 'a.cancel-update', function() {
            $(this).parent().parent().parent().find('.field-text').removeClass('hidden-element');
            $(this).parent().parent().parent().find('.field-input').addClass('hidden-element');
            $(this).parent().addClass('hidden-element');
            $(this).parent().parent().find('.edit-field-value').removeClass('hidden-element');
        });

        $('body').on('click', 'a.delete-field-value', function() {
            var field_id = $(this).attr('field-id');
            $.ajax({
                type: "GET",
                url: '<?=base_url("/ecommerce/ajax/delete_category_field/")?>' + '/' + category_id + '/' + field_id,
                async: false
            });
            $('#fields_table').html('<img style="width:200px; height: auto; margin-left: 25%" src="http://sierrafire.cr.usgs.gov/images/loading.gif">');
            refresh();
        });
        $('body').on('click', 'a.update-field', function() {
            var field_id = $(this).parent().parent().find('.edit-field-value').attr('field-id');
            var field_name = $(this).parent().parent().parent().find('.field-input-name').val();
            $.ajax({
                type: "POST",
                url: '<?=base_url("/ecommerce/ajax/edit_category_field/")?>',
                data: { name : field_name, field_id : field_id},
                async: false
            });
            $('#fields_table').html('<img style="width:200px; height: auto; margin-left: 25%" src="http://sierrafire.cr.usgs.gov/images/loading.gif">');
            refresh();

            $(this).parent().parent().parent().find('.field-text').removeClass('hidden-element');
            $(this).parent().parent().parent().find('.field-input').addClass('hidden-element');
            $(this).parent().addClass('hidden-element');
            $(this).parent().parent().find('.edit-field-value').removeClass('hidden-element');
        });
    });
</script>
<script>
	$(".fileUpload").click(function(e){
	   e.preventDefault();
	});						
</script>