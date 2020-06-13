<script src="<?php echo get_theme_path()?>assets/plugins/jquery-1.8.2/jquery-1.8.2.min.js"></script>
<ol class="breadcrumb pull-right">
    <li><a href="<?=base_url();?>admin">Home</a></li>
    <li><a href="<?=base_url();?>admin/module/layout_system/show_tutorials">Tutorials</a></li>
    <li class="active">Tutorials list</li>
</ol>
<h1 class="page-header">Edit / Show Tutorials list <small>Administration Control Panel</small></h1>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Search Results for Tutorials list</h4>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="data-table" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Cancel</th>
                            <th>Display</th>
                            <th>URL</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($objects as $object): ?>
                            <tr>
                                <td><?=$object->id?></td>
                                <td><?=$object->name?></td>
                                <td><?=$object->cancel?></td>
                                <td><?=$object->display?></td>
                                <td><?=$object->url?></td>
                                <td>
                                    <div class="btn-group-vertical" style="margin-bottom:3px;">
                                        <a href="<?=base_url()?>admin/module/layout_system/modify_object/Tutorial/<?=$object->id?>" type="button" class="btn btn-primary"><i class="fa fa-eye"></i> Steps</a>
                                    </div>
                                    <div class="btn-group-vertical" style="margin-bottom:3px;">
                                        <a href="<?=base_url()?>admin/module/layout_system/modify_object/Tutorial/<?=$object->id?>" type="button" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
                                    </div>
                                    <div class="btn-group-vertical m-r-5">
                                        <a href="<?=base_url()?>admin/module/layout_system/delete_object/Tutorial/<?=$object->id?>" type="button" class="btn btn-inverse" onclick="return confirm('Are you sure you want to permanently delete this tutorial (it\'s steps will also be deleted)?')"><i class="fa fa-remove"></i> Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>