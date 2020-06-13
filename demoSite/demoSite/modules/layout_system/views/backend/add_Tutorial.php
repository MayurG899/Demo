<style>
    .url-base{
        float: left;
        width: 16.2%;
        margin-top: 7px;
        font-size: 15px;
    }
    .url-input{
        width: 83.8% !important;
        padding-left: 0px !important;
    }
    .steps-label{
        height: 100%;
        font-size: 20px;
        text-align: left !important;
        color: #555;
    }
    .remove-step-icon{
        position: absolute;
        top: 42px;
        left: 92px;
        color: red;
        font-size: 29px;
        cursor:pointer;
    }
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
    }
    .profile-avatar img{
        min-height: 100%;
    }
</style>
<form data-parsley-validate="true" method="post" enctype="multipart/form-data" name="post">
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title"><?=$page?> Tutorial</h4>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <div class="form-horizontal form-bordered" data-parsley-validate="true" method="post" enctype="multipart/form-data" name="post">
                    <input type="hidden" name="edit" value="<?=$page?>">
                    <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1" for="name">Name:</label>
                        <div class="col-md-11 col-sm-11">
                            <input class="form-control" type="text" id="name" name="name" value="<?=$object->name?>" data-parsley-required="true" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1" for="cancel">Cancel:</label>
                        <div class="col-md-11 col-sm-11">
                            <select class="form-control" id="cancel" name="cancel" data-parsley-required="true">
                                <option value='yes' <?php if($object->cancel == 'yes') echo 'selected';?>>Yes</option>
                                <option value='no' <?php if($object->cancel == 'no') echo 'selected';?>>No</option>
                                <option value='confirm' <?php if($object->cancel == 'confirm') echo 'selected';?>>Require Confirmation</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1" for="display">Display:</label>
                        <div class="col-md-11 col-sm-11">
                            <select class="form-control" id="display" name="display" data-parsley-required="true">
                                <option value='always' <?php if($object->display == 'always') echo 'selected';?>>Always</option>
                                <option value='first_load' <?php if($object->display == 'first_load') echo 'selected';?>>On First Load Only</option>
                                <option value='discreet_notification' <?php if($object->display == 'discreet_notification') echo 'selected';?>>Discreet Notification</option>
                                <option value='important_notification' <?php if($object->display == 'important_notification') echo 'selected';?>>Important Notification</option>
                                <option value='hidden' <?php if($object->display == 'hidden') echo 'selected';?>>Hidden</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1" for="url">URL:</label>
                        <div class="col-md-11 col-sm-11">
                            <span class="url-base">http://<?=$_SERVER['HTTP_HOST']?></span>
                            <input class="form-control url-input" type="text" id="url" name="url" value="<?=$object->url?>" data-parsley-required="true" />
                        </div>
                    </div>
                    <div class="form-group" style="height:65px;">
                        <label class="control-label col-md-1 col-sm-1" style="height:100%"></label>
                        <label class="control-label steps-label col-md-11 col-sm-11">Steps</label>
                    </div>
                    <div id="steps_holder"></div>
                    <?php if($page == 'Add'):?>
                        <div class="form-group">
                            <label class="control-label col-md-1 col-sm-1"></label>
                            <div class="control-group col-md-11 col-sm-11">
                                <a id="create_step" class="btn btn-success controls controls-row">Add a Step</a>
                            </div>
                        </div>
                    <?php endif;?>
                    <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1"></label>
                        <div class="col-md-11 col-sm-11">
                            <input type="submit" class="btn btn-primary" value="<?=$page?> Tutorial">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function(){
        currentStep = 1;
        $('#create_step').click(function(){
            $('#steps_holder').append('<div class="form-group"><label class="control-label col-md-1 col-sm-1">Step<i class="fa fa-times remove-step-icon" aria-hidden="true"></i></label> <div class="col-md-11 col-sm-11"> <div class="row"> <div class="col-md-12"> <textarea class="form-control" type="text" name="steps[' + currentStep + '][content]" data-parsley-required="true" /></textarea> </div> </div> <div class="row" style="margin-top: 15px;"> <div class="col-md-2 col-sm-2"> <select class="form-control" name="steps[' + currentStep + '][position_type]" data-parsley-required="true"> <option>- Position Type -</option> <option value="absolute">Absolute</option> <option value="element">Element</option> <option value="window_border">Window</option> </select> </div> <div class="col-md-6 col-sm-6"> <input class="form-control" type="text" name="steps[' + currentStep + '][position]" placeholder="Absolute: x,y | Element: #example-id,top/left/right/bottom | Window: top-left/bottom-center/bottom-right etc." data-parsley-required="true" /> </div> <div class="col-md-4 col-sm-4"> <input class="form-control" type="text" name="steps[' + currentStep + '][highlighter]" placeholder="Additional highlighted element: #example-id or .example-class" data-parsley-required="true" /> </div> </div> </div> </div>');
            currentStep += 1;
        });
        $('body').on('click', '.remove-step-icon', function(){
           $(this).parent().parent().remove();
        });
    });
</script>