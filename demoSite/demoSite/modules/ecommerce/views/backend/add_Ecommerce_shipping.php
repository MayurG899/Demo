
<!-- begin row -->
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="panel panel-white">
    <div class="panel-heading">
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
        </div>
        <h4 class="panel-title"><?=$page?> Store Shipping Options</h4>
    </div>
    <div class="panel-body panel-form">
        <form id="add_brand" class="form-horizontal form-bordered" data-parsley-validate="true" method="post" enctype="multipart/form-data" name="post">

            <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-be-4" for="required">Shipping Name:</label>
                <div class="col-md-6 col-sm-6">
                    <input type="text" name="name" class="required form-control" required value="<?=$object->name?>">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-be-4" for="required">Shipping Price/Percent:</label>
                    <div class="col-md-2 col-sm-2">
                        <input required type="number" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" name="price" class="required col-md-1 col-sm-1 form-control" value="<?=$object->price?>">
                    </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-be-4" for="tags">Shipping Type:</label>
                <div class="col-md-2 col-sm-2">
                    <select class="form-control form-control-100" name="type">
                        <option value='flat' <?if($object->type == 'flat') echo 'selected'?>>Flat</option>
                        <option value='percent' <?if($object->type == 'percent') echo 'selected'?>>Percent</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-be-4"></label>
                <div class="col-md-6 col-sm-6">
                    <input type="submit" class="btn btn-primary" value="Save Shipping Option">
                </div>
            </div>
        </form>
    </div><!-- End .widget-content -->
</div>
</div>
</div>	