<style>
    .add-image-success{
        display: block;
        float: none;
        width: 36%;
        border-bottom-left-radius: 0px;
        border-bottom-right-radius: 0px;
    }
    .delete-image-danger{
        float: none;
        display: block;
        width: 36%;
        border-top-left-radius: 0px;
        border-top-right-radius: 0px;
    }
</style>
<script>
    $(document).ready(function (){
        var product_id = '<?=$object->id?>';
        var category_id = '<?=$object->category->get()->id?>';
        function refresh() {
            var tableInfo = $.ajax({
                type: "GET",
                url: '<?=base_url("/ecommerce/ajax/show_product_fields_table/")?>' + '/' + product_id + '/' + category_id,
                async: false
            }).responseText;
            $('#fields_table').html(tableInfo);
        }

		<?php if($page == 'Edit'):?>
			var select_count = 1 + <?=$object->option->count();?>;
		<?php else:?>
			var select_count = 1;
		<?php endif;?>
        var option_count = 0;
        $('#create_option').click(function(){
            $('#options_holder').append(
                '<div class="row" style="margin-bottom:30px">' +
                    '<label style="display:inline-block;float:left">' +
                        '<div class="col-md-10 col-sm-10 control-group" style="padding-left:10px">' +
                            '<div class="controls controls-row input-group">' + 
                                '<div class="col-md-10 col-sm-10" style="padding-left:0px"><input class="form-control" type="text" name="option[select' + select_count + '][name]" placeholder="Option Name"></div>' +
                                '<div class="col-md-2 col-sm-2"><a class="delete-select">&#x2715;</a></div>' +
                            '</div>' +
                        '</div>' +
                    '</label>' +
                    '<label style="display:inline-block;float:left">' +
                        '<div class="col-md-12 col-sm-12  control-group">' +
                            '<div class="controls controls-row input-group">' + 
                                '<div class="col-md-4 col-sm-4"><input class="form-control option-input"  type="text" name="option[select' + select_count + '][option' + 1 + '][name]" option-number="1" placeholder="Option 1"></div>' +
                                '<div class="col-md-4 col-sm-4"><select class="form-control" name="option[select' + select_count + '][option' + 1 + '][operand]"><option value="add">Add to price</option><option value="subtract">Subtract from price</option></select></div>' +
                                '<div class="col-md-2 col-sm-2"><input class="form-control"   type="text" placeholder="0" min="0" max="2000000" step="100" data-parsley-validation-threshold="1" data-parsley-type="number"  name="option[select' + select_count + '][option' + 1 + '][price]" placeholder="Price"></div>' +
                                '<div class="col-md-2 col-sm-2"><a class="delete-select-option">&#x2715;</a></div>' +
                            '</div>' +
                            '<div class="controls controls-row input-group">' + 
                                '<div class="col-md-4 col-sm-4"><input class="form-control option-input" type="text" name="option[select' + select_count + '][option' + 2 + '][name]" option-number="2" placeholder="Option 2"></div>' +
                                '<div class="col-md-4 col-sm-4"><select class="form-control" name="option[select' + select_count + '][option' + 2 + '][operand]"><option value="add">Add to price</option><option value="subtract">Subtract from price</option></select></div>' +
                                '<div class="col-md-2 col-sm-2"><input class="form-control"  type="text" placeholder="0" min="0" max="2000000" step="100" data-parsley-validation-threshold="1" data-parsley-type="number"  name="option[select' + select_count + '][option' + 2 + '][price]" placeholder="Price"></div>' +
                                '<div class="col-md-2 col-sm-2"><a class="delete-select-option">&#x2715;</a></div>' +
                            '</div>' +
                            '<div class="controls controls-row input-group">' +
                                '<div class="col-md-4 col-sm-4"><input class="form-control option-input" type="text" name="option[select' + select_count + '][option' + 3 + '][name]" option-number="3" placeholder="Option 3"></div>' +
                                '<div class="col-md-4 col-sm-4"><select class="form-control" name="option[select' + select_count + '][option' + 3 + '][operand]"><option value="add">Add to price</option><option value="subtract">Subtract from price</option></select></div>' +
                                '<div class="col-md-2 col-sm-2"><input class="form-control"  type="text" placeholder="0" min="0" max="2000000" step="100" data-parsley-validation-threshold="1" data-parsley-type="number"  name="option[select' + select_count + '][option' + 3 + '][price]" placeholder="Price"></div>' +
                                '<div class="col-md-2 col-sm-2"><a class="delete-select-option">&#x2715;</a></div>' +
                            '</div>' +
                            '<div class="controls controls-row input-group">' +
                                '<div class="col-md-4 col-sm-4"><input class="form-control option-input" type="text" name="option[select' + select_count + '][option' + 4 + '][name]" option-number="4" placeholder="Option 4"></div>' +
                                '<div class="col-md-4 col-sm-4"><select class="form-control" name="option[select' + select_count + '][option' + 4 + '][operand]"><option value="add">Add to price</option><option value="subtract">Subtract from price</option></select></div>' +
                                '<div class="col-md-2 col-sm-2"><input class="form-control"  type="text" placeholder="0" min="0" max="2000000" step="100" data-parsley-validation-threshold="1" data-parsley-type="number"  name="option[select' + select_count + '][option' + 4 + '][price]" placeholder="Price"></div>' +
                                '<div class="col-md-2 col-sm-2"><a class="delete-select-option">&#x2715;</a></div>' +
                            '</div>' +
                        '</div>' +
						'<a class="btn btn-primary btn-xs add-variant" style="margin:5px 0 0 30px"><i class="fa fa-plus"></i> Add Another Variant</a>' +
                    '</label>' +
                '</div>');
            select_count++;
            option_count = 0;
        });
        var count = 1;
        // '<label>
        //     <div class="input-group" >
        //         <input type="text" class="form-control" name="custom[' + count + ']" placeholder="Field Name">
        //         <div class="input-group-addon delete-field-button">&#x2715;</div>
        //     </div>
        // </label>'
        $('#create_field').click(function(){
            $('#fields_holder').append('<label>'+
				'<div class="col-md-10 col-sm-10 control-group">'+
					'<div class="controls controls-row input-group">'+
						'<div class="col-md-5 col-sm-5"><input class="form-control" type="text" name="custom[name' + count + ']" placeholder="Field Name"></div>'+
						'<div class="col-md-5 col-sm-5"><input class="form-control" type="text" name="custom[value' + count + ']" placeholder="Field Value"></div>'+
						'<div class="col-md-2 col-sm-2">'+
							'<a class="delete-field-button">&#x2715;</a>'+
						'</div>'+
					'</div>'+
				'</div>'+
			'</label>');
            count++;
        });
        $('body').on('click', 'a.add-variant', function() {
			var name = $(this).closest('div').find('.form-control').last().attr('name');
			var num = parseInt(name.replace(/[^0-9\.]/g, ''), 10);
			var nums = num.toString(10).split('');
            var opt_num = $(this).closest('div').find('.option-input').last().attr('option-number');
            opt_num = parseInt(opt_num) + 1;
            $(this).closest('div').find('.col-md-12').append(
				'<div class="controls controls-row input-group">' +
					'<div class="col-md-4 col-sm-4"><input class="form-control option-input" type="text" name="option[select' + nums[0] + '][option' + opt_num + '][name]" option-number="' + opt_num + '" placeholder="Option ' + opt_num + '"></div>' +
                    '<div class="col-md-4 col-sm-4"><select class="form-control" name="option[select' + nums[0] + '][option' + opt_num + '][operand]"><option value="add">Add to price</option><option value="subtract">Subtract from price</option></select></div>' +
                    '<div class="col-md-2 col-sm-2"><input class="form-control" type="number" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" name="option[select' + nums[0] + '][option' + opt_num + '][price]" placeholder="Price"></div>' +
					'<div class="col-md-2 col-sm-2"><a class="delete-select-option">&#x2715;</a></div>' +
				'</div>'
			);
        });
        $('body').on('click', 'a.delete-field-button', function() {
            $(this).parent().parent().parent().parent().remove();
        });
        $('body').on('click', 'a.delete-select', function() {
            $(this).parents().get(4).remove();
        });
        $('body').on('click', 'a.delete-select-option', function() {
            var numberOfOptions = $(this).parent().parent().parent().children().length;
            console.log(numberOfOptions);
            if(numberOfOptions != 1)
                $(this).parents().get(1).remove();
            else
                $(this).parents().get(4).remove();
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

        $('#add_field').click(function (){
            var field_name = $('#field_name').val();
            var field_value = $('#field_value').val();
            $.ajax({
                type: "POST",
                url: '<?=base_url("/ecommerce/ajax/add_product_field/")?>',
                data: { name : field_name, value : field_value , product_id : product_id},
                async: false
            });
            $('#fields_table').html('<img style="width:200px; height: auto; margin-left: 25%" src="http://sierrafire.cr.usgs.gov/images/loading.gif">');
            refresh();
        });
        $('body').on('click', 'a.delete-field-value', function() {
            var field_id = $(this).attr('field-id');
            $.ajax({
                type: "GET",
                url: '<?=base_url("/ecommerce/ajax/delete_product_field/")?>' + '/' + product_id + '/' + field_id,
                async: false
            });
            $('#fields_table').html('<img style="width:200px; height: auto; margin-left: 25%" src="http://sierrafire.cr.usgs.gov/images/loading.gif">');
            refresh();
        });
        $('body').on('click', 'a.update-field', function() {
            var field_id = $(this).parent().parent().find('.edit-field-value').attr('field-id');
            var field_name = $(this).parent().parent().parent().find('.field-input-name').val();
            var field_value = $(this).parent().parent().parent().find('.field-input-value').val();
            $.ajax({
                type: "POST",
                url: '<?=base_url("/ecommerce/ajax/edit_product_field/")?>',
                data: { name : field_name, value : field_value , product_id : product_id, field_id : field_id},
                async: false
            });
            $('#fields_table').html('<img style="width:200px; height: auto; margin-left: 25%" src="http://sierrafire.cr.usgs.gov/images/loading.gif">');
            refresh();

            $(this).parent().parent().parent().find('.field-text').removeClass('hidden-element');
            $(this).parent().parent().parent().find('.field-input').addClass('hidden-element');
            $(this).parent().addClass('hidden-element');
            $(this).parent().parent().find('.edit-field-value').removeClass('hidden-element');
        });

        // $('#category-select').change(function(){
        //     var category_id = $(this).val();
        //     $.get('<?=base_url("/ecommerce/ajax/get_category_fields/")?>' + '/' + category_id, function(data){
        //         $('#category-fields').html(data);
        //     });
        // });
        $.get('<?=base_url("/ecommerce/ajax/get_category_fields/")?>' + '/' + category_id + '/' + product_id, function(data){
            $('#category-fields-edit').prepend(data);
        });
    });
</script>
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
<style>
.delete-field-button
{
    font-size: 25px;
    color: red;
    margin-left: 1%;
    cursor: pointer;
    text-decoration: none;
}
.delete-field-button:hover
{
    text-decoration: none;
    color: rgb(252, 121, 121);
}
.delete-select
{
    font-size: 25px;
    color: red;
    margin-left: 1%;
    cursor: pointer;
    text-decoration: none;
}
.delete-select:hover
{
    text-decoration: none;
    color: rgb(252, 121, 121);
}
.delete-select-option
{
    font-size: 25px;
    color: red;
    margin-left: 1%;
    cursor: pointer;
    text-decoration: none;
}
.delete-select-option:hover
{
    text-decoration: none;
    color: rgb(252, 121, 121);
}
.edit-field-value
{
    cursor: pointer;
}
.delete-field-value
{
    cursor: pointer;
}
.visible-element
{
    display:block !important;
}
.hidden-element
{
    display:none !important;
}
.field-input
{
    margin-bottom:0px !important;
    margin-top: 10px;
}
.profile-avatar{
    height:66%;
	margin-bottom: 10px;
}
.profile-avatar img{
    min-height: 100%;
}
.file_preview{
    max-height: 250px !important;
}
</style>

		<!-- begin row -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<form data-parsley-validate="true" method="post" enctype="multipart/form-data" name="post">
<div class="panel panel-white">
    <div class="panel-heading">
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
        </div>
        <h4 class="panel-title"><?=$page?> Store Product</h4>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <div class="form-horizontal form-bordered" data-parsley-validate="true" method="post" enctype="multipart/form-data" name="post">
                <input type="hidden" name="edit" value="<?=$page?>">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-be-3" for="name"><b>Product Name:</b></label>
                    <div class="col-md-9 col-sm-9">
                        <input class="form-control" type="text" id="name" name="name" value="<?=$object->name?>" data-parsley-required="true" />
                    </div>
                </div>
				<div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-be-3" for="price"><b>Price:</b></label>
                    <div class="col-md-9 col-sm-9">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 input-group">
                                <input class="form-control form-control-100 required" type="text" placeholder="0" min="0" max="1000000000000" step="100" data-parsley-validation-threshold="1" data-parsley-trigger="keyup" data-parsley-type="number" id="price" name="price" value="<?=$object->price?>" data-parsley-required="true" />
                                <?$currency = new Currency($this->BuilderEngine->get_option('be_ecommerce_settings_currency'));?>
                                <div class="input-group-addon"><?=$currency->signature?></div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-be-3" for="quantity"><b>Stock Quantity:</b></label>
                    <div class="col-md-9 col-sm-9">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 input-group">
                                <input class="form-control required" type="number" min="0" step="1" data-number-to-fixed="2" data-number-stepfactor="1" id="quantity" name="quantity" value="<?=$object->quantity?>" data-parsley-required="true" />
                            </div>
                        </div>
                    </div>
                </div>
				<?/*<div class="form-group">
                    <label class="control-label col-md-3 col-sm-3" for="price"><b>Add Product to Category:</b></label>
                    <div class="col-md-9 col-sm-9">
                            <?php
                                $this->load->model('category');
                                $categories = new Ecommerce_category();
                            ?>
                        <select class="form-control" id="category-select" name="category_id" data-parsley-required="true">
                            <?php foreach($categories->get() as $category):?>
                                <option value='<?=$category->id?>' <?php if($object->category_id == $category->id) echo 'selected';?>><?=$category->name?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>*/?>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-be-3" for="website"><b>Product Categories:</b></label>
                    <div class="col-md-9 col-sm-9">
                        <ul id="categories">
                            <?php foreach($object->get_categories() as $category):?>
                                <li><?=$category->name?></li>
                            <?php endforeach?>
                        </ul>
                    </div>
                </div>
				<div class="form-group" style="">
                    <label class="control-label col-md-3 col-sm-3 col-be-3" for="blogimage"><b>Main Product Image:</b> <br/>best fit(550px x 484px)</label>
                    <div class="col-md-9 col-sm-9" style="">
                        <span class="btn btn-success fileinput-button">
                            <i class="fa fa-plus"></i>
                            <span>Browse</span>
                            <input class="fileUpload" type="file" name="image" rel="file_manager" file_value="<?=checkImagePath($object->image)?>">
                        </span>
                    </div>
                </div>
				<div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-ck-3" for="blogname"><b>Description:</b></label>
                    <div class="col-md-9 col-sm-9 col-ck-9">
					<?php $txt = ChEditorfix($object->text);?>
                        <textarea class="ckeditor" id="editor1" id="description" name="description" rows="3"><?=$object->description?></textarea>
                    </div>
                </div>
                <div class="form-group" style="">
                    <label class="control-label col-md-3 col-sm-3 col-be-3" for="blogimage"><b>Additional Images:</b></label>
                    <div class="col-md-9 col-sm-9 additional-images">
                        <?$i = 1;?>
                        <?foreach($object->additional_images->get() as $image):?>
                            <div style="float: left;">
                                <span class="btn btn-success fileinput-button add-image-success" style="float: left;margin: 5px;margin-top: 0px;">
                                    <i class="fa fa-plus"></i>
                                    <span>Browse</span>
                                <input class="fileUpload" type="file" name="images[image-<?=$i?>]"  rel="file_manager" file_value="<?=checkImagePath($image->url)?>">
                                </span>
                                <span class="btn btn-danger fileinput-button delete-image-danger" style="margin: 5px;margin-top: 0px;">
                                    <i class="fa fa-remove"></i>
                                    <span>Delete</span>
                                </span>
                            </div>
                            <?$i++;?>
                        <?endforeach;?>
                        <div class="add-image-btn-holder">
                            <button type="button" id="add-image" class="btn btn-primary" style="display: block;"><i class="fa fa-plus"></i> Add Additional Image</button>
                        </div>
                    </div>
                </div>
                <?$shippping_type = $this->BuilderEngine->get_option('be_ecommerce_settings_shipping_options');?>
                <?if($shippping_type == 'single'):?>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-be-3" for="website" style="padding-top: 36px;"><b>Shipping Options:</b></label>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9">
                                <ul id="shippings">
                                    <?php foreach($object->shipping->get() as $shipping):?>
                                        <li><?=$shipping->name?></li>
                                    <?php endforeach?>
                            </div>
                        </div>
                    </div>
                <?endif;?>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-be-3" for="required"><b>Promotional Labels:</b></label>
                    <div class="col-md-9 col-sm-9">
                        <select id="prom-labels" class="form-control" name="label">
							<option value='None' <?if($object->label == 'None') echo 'selected';?>>None</option>
                            <option value='Sale' <?if($object->label == 'Sale') echo 'selected';?>>Sale</option>
                            <option value='New' <?if($object->label == 'New') echo 'selected';?>>New</option>
                            <option value='Special Offer' <?if($object->label == 'Special Offer') echo 'selected';?>>Special Offer</option>
                            <option value='Discounted' <?if($object->label == 'Discounted') echo 'selected';?>>Discounted</option>
                        </select>
                    </div>
                </div>
                <div class="form-group" id="old-price-input">
                    <label class="control-label col-md-3 col-sm-3 col-be-3" for="adminemail"><b>Old Price:</b></label>
                    <div class="col-md-9 col-sm-9">
                        <input id="prom-label-discounted" type="text" placeholder="0" min="0" max="10000000000" step="100" data-parsley-validation-threshold="1" name="old_price" value="<?=$object->old_price?>" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-be-3" for="price"><b>Add Product to Featured Block:</b></label>
                    <div class="col-md-9 col-sm-9">
                        <select class="form-control" id="featured" name="featured" data-parsley-required="true">
                            <option value='no' <?php if($object->featured == 'no') echo 'selected';?>>No</option>
                            <option value='yes' <?php if($object->featured == 'yes') echo 'selected';?>>Yes</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-be-3" for="price"><b>Active Product:</b></label>
                    <div class="col-md-9 col-sm-9">
                        <select class="form-control" id="active" name="active" data-parsley-required="true">
                            <option value='yes' <?php if($object->active == 'yes') echo 'selected';?>>Yes</option>
                            <option value='no' <?php if($object->active == 'no') echo 'selected';?>>No, Hide Product from Store</option>
                        </select>
                    </div>
                </div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-be-3" for="price"></label>
					<div class="control-group col-md-9 col-sm-9">
						<div id="options_holder">
							<?php if($page == 'Edit'):?>
								<?php $c=1;?>
								<?php foreach($object->option->get() as $option):?>
									<div class="row" style="margin-bottom:30px">
										<label style="display:inline-block;float:left">
											<div class="col-md-10 col-sm-10 control-group" style="padding-left:10px">
												<div class="controls controls-row input-group">
													<div class="col-md-10 col-sm-10" style="padding-left:0px"><input class="form-control" type="text" name="option[select<?=$c?>][name]" value="<?=$option->option_name?>" placeholder="Option Name"></div>
													<div class="col-md-2 col-sm-2"><a class="delete-select">&#x2715;</a></div>
												</div>
											</div>
										</label>
										<label style="display:inline-block;float:left">
											<div class="col-md-12 col-sm-12  control-group">
												<?php 
													$option_names = explode(',',$option->options);
													$option_prices = explode(',',$option->options_prices);
												?>
												<?php for ($i = 0; $i < count($option_names); $i++):?>
													<div class="controls controls-row input-group"> 
														<div class="col-md-4 col-sm-4"><input class="form-control option-input"  type="text" name="option[select<?=$c?>][option<?=$i+1?>][name]"  option-number="<?=$i+1?>" value="<?=$option_names[$i]?>" placeholder="Option 1"></div>
                                                        <div class="col-md-4 col-sm-4"><select class="form-control" name="option[select<?=$c?>][option<?=$i+1?>][operand]"><option value="add">Add to price</option><option value="subtract" <?if($option_prices[$i] < 0) echo 'selected'?>>Subtract from price</option></select></div>
                                                        <div class="col-md-2 col-sm-2"><input class="form-control" type="text" placeholder="0" min="0" max="2000000" step="100" data-parsley-validation-threshold="1" data-parsley-type="number" name="option[select<?=$c?>][option<?=$i+1?>][price]" value="<?if($option_prices[$i] < 0) echo trim(rtrim($option_prices[$i] *= -1)); else echo trim(rtrim($option_prices[$i]))?>" placeholder="Price"></div>
														<div class="col-md-2 col-sm-2"><a class="delete-select-option">&#x2715;</a></div>
													</div>
												<?php endfor;?>
											</div>
											<a class="btn btn-primary btn-xs add-variant" style="margin:5px 0 0 30px"><i class="fa fa-plus"></i> Add Another Variant</a>
										</label>
									</div>
									<?php $c++;?>
								<?php endforeach;?>
							<?php endif;?>
						</div>
						<a id="create_option" class="btn btn-warning controls controls-row">New Additional Prices & Extra Add-On Options</a>
					</div>
				</div>
                <?php if($page == 'Add'):?>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-be-3" for="price"></label>
                        <div class="control-group col-md-9 col-sm-9">
                            <div id="fields_holder"></div>
                            <a id="create_field" class="btn btn-success controls controls-row">Add Another Field</a>
                        </div>
                    </div>
                <?php endif;?>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-be-3"></label>
                    <div class="col-md-9 col-sm-9">
                        <input type="submit" class="btn btn-primary" value="Save Product Details">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?$category_id = $object->category->get()->id;
$category = new Ecommerce_category($category_id);?>
<?php if($page == 'Edit' && $category->category_fields->get()->exists()):?>
    <div class="panel panel-white">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            </div>
            <h4 class="panel-title">Additional Product Information</h4>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <div id="category-fields-edit" class="form-horizontal form-bordered">
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2"></label>
                        <div class="col-md-6 col-sm-6">
                            <input type="submit" class="btn btn-primary" value="Save Additional Details">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif;?>
</form>
<?php if($page == 'Edit'):?>
<div class="panel panel-white">
    <div class="panel-heading">
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
        </div>
        <h4 class="panel-title">Custom Product Fields</h4>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <form id="add_product" class="form-horizontal form-bordered" data-parsley-validate="true" method="post" enctype="multipart/form-data" >
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2" for="categoryname">Field Name:</label>
                    <div class="col-md-8 col-sm-8">
                        <input class="form-control" name="name" type="text" id="field_name" data-parsley-required="true" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2" for="categoryname">Field Value:</label>
                    <div class="col-md-8 col-sm-8">
                        <input class="form-control" name="name" type="text" id="field_value" data-parsley-required="true" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2"></label>
                    <div class="col-md-6 col-sm-6">
                        <a id="add_field" class="btn btn-primary">Create Field</a>
                    </div>
                </div>
                <div class="widget-content">
                    </br>
                    </br>
                </div>

                <table id="data-table" class="table table-striped table-bordered" >
                    <thead>
                        <tr>
                            <th>Edit</th>
                            <th>Field Name</th>
                            <th>Field Value</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody id="fields_table">
                        <?php $category = new Ecommerce_category($object->category->id);
                        $product_fields_array = array();
                        foreach($object->product_field->get() as $field)
                        {
                            $product_fields_array[] = $field->id;
                        }
                        $category_fields_array = array();
                        foreach($category->category_field->get() as $field)
                        {
                            $category_fields_array[] = $field->id;
                        }
                        $differences_array = array_diff($product_fields_array, $category_fields_array);?>

                        <?php foreach($object->product_field->get() as $field):?>
                            <?php foreach($differences_array as $diff):?>
                                <?php if($field->id == $diff):?>
                                    <tr>
                                        <td style="width: 100px">
                                            <a class="edit-field-value btn btn-success" style="width:100%" field-id="<?=$field->id?>">Edit</a>
                                            <div class="btn-group btn-group-vertical input-controls hidden-element" style="width:100%">
                                                <a class="btn btn-info update-field">Update</a>
                                                <a class="btn btn-default cancel-update">Cancel</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="field-text"><?=$field->name?></div>
                                            <input type="text" class="hidden-element field-input field-input-name" value="<?=$field->name?>">
                                        </td>
                                        <td>
                                            <div class="field-text"><?=$field->get_value($object->id)?></div>
                                            <textarea cols="70" rows="5" type="text" class="hidden-element field-input field-input-value"><?=$field->get_value($object->id)?></textarea>
                                        </td>
                                        <td style="width: 100px">
                                            <a class="delete-field-value btn btn-danger" style="width:100%" field-id="<?=$field->id?>">Delete</a>
                                        </td>
                                    </tr>
                                <?php endif;?>
                            <?php endforeach;?>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
</div>
</div>	
<!-- end row -->

				
<?php endif;?>
<script type="text/javascript">
    $('#prom-labels').on('change',function(){
        var selection = $(this).val();
        switch(selection){
            case "Discounted":
                $("#prom-label-discounted").parent().parent().show();
                $("#prom-label-discounted").prop('disabled', false);
				$("#prom-label-discounted").addClass('required');
                break;
            default:
                $("#prom-label-discounted").prop('disabled', true);
                $("#prom-label-discounted").parent().parent().hide();
				$("#prom-label-discounted").removeClass('required');
        }
    });
    $('document').ready(function(){
        imageCount = <?=$i?>;
        $('#add-image').click(function(){
            var newFileInput = ('<div style="float: left;"><span class="btn btn-success fileinput-button add-image-success" style="width:inherit;float: left;margin: 5px;margin-top: 0px;"><i class="fa fa-plus"></i><span> Browse</span><input class="fileUpload" type="file" name="images[image-' + imageCount + ']"  rel="file_manager"></span><span class="btn btn-danger fileinput-button delete-image-danger" style="width:inherit;margin: 5px;margin-top: 0px;"> <i class="fa fa-remove"></i> <span> Delete</span></div>');
            $(newFileInput).insertBefore($(this).parent().parent().find('.add-image-btn-holder').last());
			$(".fileUpload").bind('click',function(e){
			   e.preventDefault();
			});	
            imageCount++;
            init_fm();
        });
        $('body').on('click', '.delete-image-danger', function(){
           $(this).parent().remove();
        });
    });
    function init_fm(){
        $(document).find('input:file').each(function() {
            if($(this).attr('rel') != "file_manager")
                return;
            $(this).attr('onClick','file_manager(\'' + this.name + '\')');
            file = $(this).attr('file_value');
            if(!$(this).parent().find('input[type="hidden"]').length > 0){
                $("<input type='hidden' />").attr({ value: $(this).attr('file_value'), name: this.name  }).insertBefore(this);
                this.name = this.name + "_old";
            }

            if(file != "" && typeof file !== 'undefined')
            {
                var file_name_string = file;

                var file_name_array = file_name_string.split(".");
                var file_extension = file_name_array[file_name_array.length - 1];

                if(!$('[name="'+this.name + '"]').parent().parent().find('.profile-avatar').length > 0){
                    $('[name="'+this.name + '"]').parent().parent().append('<div class="profile-avatar" style=""><img style="max-height: 154px;margin-top: -10px;margin-left: 20px;" class="file_preview" src="" alt="No Image" ></div>');
                }
                $('[name="'+this.name + '"]').parent().parent().find(".file_preview").attr('src', file);
            }
            $(this).attr('onclick', $(this).attr('onclick').replace('_old', ''));
        });
    }
</script>
<?php $shippings = new Ecommerce_shipping();?>
<script>
    $(document).ready(function (){
        $('#shippings').tagit({
            fieldName: "shippings",
            singleField: true,
            showAutocompleteOnFocus: true,
            availableTags: [ <?php foreach ($shippings->get() as $shipping): ?>"<?php echo $shipping->name?>", <?php endforeach;?>]
        });
    });
</script>
<?$categories = new Ecommerce_category();
$categories->get();
$categories_array = array();
foreach($categories as $category)
{
    $categories_array[] = $category->name;
}
?>
<script>
    $(document).ready(function (){
        $('#categories').tagit({
            fieldName: "category_id",
            singleField: true,
            showAutocompleteOnFocus: true,
            availableTags: [ <?php foreach ($categories_array as $category): ?>"<?php echo $category?>", <?php endforeach;?>]
        });
        $('body').find('.ui-autocomplete-input').attr('readonly', 'readonly');
    });
</script>
<script>
	$(".fileUpload").click(function(e){
	   e.preventDefault();
	});						
</script>