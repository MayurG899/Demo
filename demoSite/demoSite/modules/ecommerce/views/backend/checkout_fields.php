<script src="<?php echo get_theme_path()?>assets/plugins/jquery/jquery-1.9.1.min.js"></script>
<style type="text/css">
    .delete-checkout
    {
        font-size: 25px;
        color: red;
        margin-left: 1%;
        cursor: pointer;
        text-decoration: none;
    }
    .delete-checkout:hover
    {
        text-decoration: none;
        color: rgb(252, 121, 121);
    }
</style>
<div id="content" class="page-with-two-sidebar content-two-sidebars" style="min-height:800px">
<!-- begin row -->
<div class="row">
	<!-- begin col-8 -->
	<div class="col-md-12">
	<!-- begin panel -->
        <div class="panel panel-white">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				</div>
				<h4 class="panel-title">Store Custom Checkout Options</h4>
			</div>
            <div class="panel-body panel-form">
                <form class="form-horizontal form-bordered" data-parsley-validate="true" method="post" enctype="multipart/form-data" name="post">
                    <?$i = 1;?>
                    <?$checkout_fields = new Checkout_field();?>
                    <?foreach ($checkout_fields->get() as $field) :?>
                        <div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-be-4" for="required">Field Name:</label>
                                <div class="col-md-5 col-sm-5">
                                    <input type="text" name="checkout[field<?=$i?>][displayed_name]" class="required form-control" value="<?=$field->displayed_name?>" >
                                    <input type="hidden" name="checkout[field<?=$i?>][id]" class="required form-control" value="<?=$field->id?>" >
                                    <input type="hidden" name="checkout_ids[]" class="required form-control" value="<?=$field->id?>" >
                                </div>
                                <div class="col-md-1 col-sm-1" style="border-left: none;">
                                    <a class="delete-checkout" field-id="<?=$field->id?>">&#x2715;</a>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-be-4" for="tags">Type:</label>
                                <div class="col-md-2 col-sm-2">
                                    <select class="form-control input-type" name="checkout[field<?=$i?>][type]" >
                                        <option value='text' <?if($field->type == 'text') echo 'selected';?>>Text</option>
                                        <option value='textarea' <?if($field->type == 'textarea') echo 'selected';?>>Long Text</option>
                                        <option value='select' <?if($field->type == 'select') echo 'selected';?>>Dropdown</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group options-placeholder">
                                <?if($field->type == 'select'):?>
                                    <label class="control-label col-md-4 col-sm-4 col-be-4" for="required">Options for dropdown(separated by ","):</label>
                                    <div class="col-md-5 col-sm-5">
                                        <input type="text" name="checkout[field<?=$i?>][options]" class="required form-control" value="<?=$field->options?>" >
                                    </div>
                                <?endif;?>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-be-4" for="required">Required:</label>
                                <div class="col-md-2 col-sm-2">
                                    <select class="form-control" name="checkout[field<?=$i?>][required]" >
                                        <option value='yes' <?if($field->required == 'yes') echo 'selected';?>>Yes</option>
                                        <option value='no' <?if($field->required == 'no') echo 'selected';?>>No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" style="border-bottom: 5px solid #eee;">
                                <label class="control-label col-md-4 col-sm-4 col-be-4" for="required">Active:</label>
                                <div class="col-md-2 col-sm-2">
                                    <select class="form-control" name="checkout[field<?=$i?>][active]" >
                                        <option value='yes' <?if($field->active == 'yes') echo 'selected';?>>Yes</option>
                                        <option value='no' <?if($field->active == 'no') echo 'selected';?>>No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?$i ++;?>
                    <?endforeach;?>

                    <div id="fields_holder">
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-be-4"></label>
                        <div class="col-md-6 col-sm-6">
                            <a id="add_field" class="btn btn-success controls controls-row">Add Checkout Field</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-be-4"></label>
                        <div class="col-md-6 col-sm-6">
                            <input type="submit" class="btn btn-primary" value="Save Checkout Options">
                        </div>
                    </div>
                </form>
            </div><!-- End .widget-content -->
        </div>
    </div>
</div>
<!-- end row -->
<!-- begin #sidebar-right -->
		<div id="sidebar-right" class="sidebar sidebar-right">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav m-t-10">
					<h4 class="sidebar-right-main-title">Online Store</h4>
					<li class="nav-widget">
                        <div class="panel-group m-b-0" id="accordion">
							<div class="panel panel-grey panel-bg-buttons">
                                <div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('ecommerce/category/All');?>" target="_blank" class="btn btn-sm btn-block btn-success btn-r-sidebar-2">
                                            <i class="fa fa-file-o pull-right text-white"></i>
											<b>Store Homepage</b>
                                        </a>
                                    </h3>
                                </div>
								<div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('ecommerce/register');?>" target="_blank" class="btn btn-sm btn-block btn-warning btn-r-sidebar-2">
                                            <i class="fa fa-sign-in pull-right text-white"></i>
											<b>Registration Page</b>
                                        </a>
                                    </h3>
                                </div>
								<div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('ecommerce/login');?>" target="_blank" class="btn btn-sm btn-block btn-warning btn-r-sidebar-2">
                                            <i class="fa fa-sign-in pull-right text-white"></i>
											<b>Store Login Page</b>
                                        </a>
                                    </h3>
                                </div>
								<div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('admin/module/ecommerce/add_product');?>" class="btn btn-sm btn-block btn-indigo btn-r-sidebar-2">
                                            <i class="fa fa-plus pull-right text-white"></i>
											<b>Add Store Product</b>
                                        </a>
                                    </h3>
                                </div>
								<div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('admin/module/ecommerce/show_products');?>" class="btn btn-sm btn-block btn-indigo btn-r-sidebar-2">
                                            <i class="fa fa-shopping-basket pull-right text-white"></i>
											<b>View All Products</b>
                                        </a>
                                    </h3>
                                </div>
								<div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
										<a href="<?= base_url('admin/module/ecommerce/orders');?>" class="btn btn-sm btn-block btn-indigo btn-r-sidebar-2">
                                            <i class="fa fa-money pull-right text-white"></i>
											<b>View All Orders</b>
                                        </a>
                                    </h3>
                                </div>
                            </div>
                            <div class="panel panel-grey">
                                <div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseQuide">
                                            <i class="fa fa-plus-circle pull-right text-blue"></i> 
                                            Quick Tutorial
                                        </a>
                                    </h3>
                                </div>
                                <div id="collapseQuide" class="panel-collapse collapse">
                                    <div class="panel-body panel-body-2">
                                        Setup your Online Store Website by using the module options on the left sidebar. <br><br>
										Configure your store module settings, shipping & payments to go live.
										
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-grey">
                                <div class="panel-heading panel-heading-2">
                                    <h3 class="panel-title title-14">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseLinks">
                                            <i class="fa fa-plus-circle pull-right text-blue"></i> 
                                            Help & Support
                                        </a>
                                    </h3>
                                </div>
                                <div id="collapseLinks" class="panel-collapse collapse">
                                    <div class="panel-body panel-body-2">
										<td><a href="#modal-guides" class="btn btn-sm btn-block btn-inverse" data-toggle="modal">Guides & Tutorials</a></td>
										<td><a href="#modal-forums" class="btn btn-sm btn-block btn-inverse" data-toggle="modal">Community Forums</a></td>
										<td><a href="#modal-tickets" class="btn btn-sm btn-block btn-inverse" data-toggle="modal">Support Tickets</a></td>
										<td><a href="#modal-cloudlogin" class="btn btn-sm btn-block btn-inverse" data-toggle="modal">My Account</a></td>
                                    </div>
                                </div>
                            </div>
                        </div>
					</li>
					<li class="nav-widget text-white">
						<div class="panel panel-grey">
						<div class="panel-heading panel-heading-2">
							<h3 class="panel-title title-14">
								<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseList">
									<i class="fa fa-question-circle pull-right" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Checklist to Configure Your Website"></i>
                                    To Do List
								</a>
							</h3>
						</div>
						<div id="collapseList" class="panel-collapse collapse">
						<div class="panel-body p-0">
							<ul class="todolist">
								<li class="active">
									<a href="javascript:;" class="todolist-container active" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Store Access</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Enable/Disable This Module</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Adjust Store Settings</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Add Store Categories</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Add Store Products</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Shipping Settings</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Add Payment Provider</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Invoice Details</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Usergroup Access</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Custom Checkout Options</div>
									</a>
								</li>
							</ul>
						</div>
						</div>
					</div>

				    </li>
				</ul>
				<!-- end sidebar user -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg sidebar-right"></div>
		<!-- end #sidebar-right -->
							<!-- #modal-dialog -->
							<div class="modal fade" id="modal-forums">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">BuilderEngine Support Forums</h4>
										</div>
										<div class="modal-body">
											You are about to leave your Administration Control Panel, click Continue to view page.
										</div>
										<div class="modal-footer">
											<a href="" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
											<a href="https://builderengine.com/forum/all_topics" target="_blank" class="btn btn-sm btn-success">Continue</a>
										</div>
									</div>
								</div>
							</div>
							<div class="modal fade" id="modal-guides">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">BuilderEngine Tutorials/Guides</h4>
										</div>
										<div class="modal-body">
											You are about to leave your Administration Control Panel, click Continue to view page.
										</div>
										<div class="modal-footer">
											<a href="" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
											<a href="https://builderengine.com/guides/all_posts" target="_blank" class="btn btn-sm btn-success">Continue</a>
										</div>
									</div>
								</div>
							</div>
							<div class="modal fade" id="modal-tickets">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">BuilderEngine Support Tickets</h4>
										</div>
										<div class="modal-body">
											You are about to leave your Administration Control Panel, click Continue to view page.
										</div>
										<div class="modal-footer">
											<a href="" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
											<a href="https://builderengine.com/support" target="_blank" class="btn btn-sm btn-success">Continue</a>
										</div>
									</div>
								</div>
							</div>
							<div class="modal fade" id="modal-cloudlogin">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">BuilderEngine Account Login</h4>
										</div>
										<div class="modal-body">
											You are about to leave your Administration Control Panel, click Continue to view page.
										</div>
										<div class="modal-footer">
											<a href="" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
											<a href="https://builderengine.com/account/dashboard" target="_blank" class="btn btn-sm btn-success">Continue</a>
										</div>
									</div>
								</div>
							</div>	
							<!-- end sidebar -->
		</div>
		<!-- end #content -->

<script type="text/javascript">
    var i = "<?php echo $i; ?>";
    $('body').on('change', 'select.input-type', function(){
        if($(this).val() == 'select'){
            var appendedFieldName = $(this).attr('name');
            appendedFieldName = appendedFieldName.replace('type', 'options');
            $(this).parent().parent().parent().find('.options-placeholder').append(
                '<label class="control-label col-md-4 col-sm-4" for="required">Options for select(separated by ","):</label>' +
                '<div class="col-md-5 col-sm-5">' +
                '<input type="text" name="' + appendedFieldName + '" class="required form-control">' +
                '</div>'
            );
        }
        else{
            $(this).parent().parent().parent().find('.options-placeholder').html("");
        }
    });
    $('body').on('click', 'a.delete-checkout', function() {
        var id = $(this).attr('field-id');
        if (typeof id !== "undefined") {
            var result = confirm("Want to delete?");
            if (result) {
                $.ajax({
                    type: "GET",
                    url: '<?=base_url("/ecommerce/ajax/delete_checkout_field/")?>' + '/' + id,
                    async: false
                });
                $(this).parent().parent().parent().remove();
            }
        }
        else
            $(this).parent().parent().parent().remove();
    });
    $('#add_field').click(function(){
        $('#fields_holder').append(
            '<div>' +
            '<div class="form-group">' +
            '<label class="control-label col-md-4 col-sm-4 col-be-4" for="required">Field Name:</label>' +
            '<div class="col-md-5 col-sm-5">' +
            '<input type="text" name="checkout[field' + i + '][displayed_name]" class="required form-control">' +
            '</div>' +
            '<div class="col-md-1 col-sm-1" style="border-left: none;">' +
            '<a class="delete-checkout">&#x2715;</a>' +
            '</div>' +
            '</div>' +

            '<div class="form-group">' +
            '<label class="control-label col-md-4 col-sm-4 col-be-4" for="tags">Type:</label>' +
            '<div class="col-md-2 col-sm-2">' +
            '<select class="form-control input-type" name="checkout[field' + i + '][type]">' +
            '<option value="text">Text</option>' +
            '<option value="textarea">Long Text</option>' +
            '<option value="select">Dropdown</option>' +
            '</select>' +
            '</div>' +
            '</div>' +

            '<div class="form-group options-placeholder"></div>' +

            '<div class="form-group">' +
            '<label class="control-label col-md-4 col-sm-4 col-be-4" for="required">Required:</label>' +
            '<div class="col-md-2 col-sm-2">' +
            '<select class="form-control" name="checkout[field' + i + '][required]">' +
            '<option value="yes">Yes</option>' +
            '<option value="no">No</option>' +
            '</select>' +
            '</div>' +
            '</div>' +

            '<div class="form-group" style="border-bottom: 5px solid #eee;">' +
            '<label class="control-label col-md-4 col-sm-4 col-be-4" for="required">Active:</label>' +
            '<div class="col-md-2 col-sm-2">' +
            '<select class="form-control" name="checkout[field' + i + '][active]">' +
            '<option value="yes">Yes</option>' +
            '<option value="no">No</option>' +
            '</select>' +
            '</div>' +
            '</div>' +
            '</div>'
        );
        i++;
    });
</script>