<script src="<?php echo get_theme_path()?>assets/plugins/jquery/jquery-1.9.1.min.js"></script>
<ol class="breadcrumb pull-right">
    <li><a href="<?=base_url()?>">Home</a></li>
    <li class="active">License</li>
</ol>
<?
//$var1 = 'var2';
//$var2 = 'actual value here!';
//echo $$var1;
?>
<h1 class="page-header">License Information <small>Administration Control Panel</small></h1>
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">License Status</h4>
            </div>
            <div class="panel-body panel-form">
                <?if($license == ''):?>
                    <h4 style="padding-left:20px !important;">No active license. To use all of the  Online Store's features please register for a license <a href="http://builderengine.com/user/client/cms_subscriptions">here</a>.</h4>
                <?elseif($license > time()):?>
                    <div class="widget widget-stats">
                        <div class="stats-icon stats-icon-lg"><i class="fa fa-clock-o fa-fw"></i></div>
                        <div class="stats-title">License Expires in</div>
                        <div class="stats-number">
                            <?$remaining_days = round(($license - time()) / 86400, 0);
                            if($remaining_days > 0)
                                echo $remaining_days.' days';
                            else
                                echo '0 days';
                            ?>
                        </div>
                    </div>
                <?else:?>
                    <h4 style="padding-left:20px !important;">License has expired. Click <a href="http://builderengine.com/user/client/cms_subscriptions">here</a> to renew.</h4>
                <?endif?>
            </div>
        </div>
    </div>
    <div class="col-md-4">

        <div class="panel panel-inverse">

            <div class="panel-heading">

                <div class="panel-heading-btn">

                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>

                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>

                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>

                </div>

                <h4 class="panel-title">Support Builder</h4>

            </div>

            <div class="panel-body">

                <table class="table">

                    <thead>

                    <tr>

                        <th>Description</th>

                        <th>Action</th>

                    </tr>

                    </thead>

                    <tbody>

                    <tr>

                        <td>BuilderEngine Support Forums</td>

                        <td><a href="#modal-dialog" class="btn btn-sm btn-primary" data-toggle="modal">View</a></td>

                    </tr>

                    <tr>

                        <td>BuilderEngine Tutorials/Guides</td>

                        <td><a href="#modal-guides" class="btn btn-sm btn-primary" data-toggle="modal">View</a></td>

                    </tr>

                    <tr>

                        <td>BuilderEngine Support Tickets</td>

                        <td><a href="#modal-tickets" class="btn btn-sm btn-primary" data-toggle="modal">View</a></td>

                    </tr>

                    <tr>

                        <td>BuilderEngine.com Account Login</td>

                        <td><a href="#modal-cloudlogin" class="btn btn-sm btn-success" data-toggle="modal">View</a></td>

                    </tr>

                    </tbody>

                </table>

                <!-- #modal-dialog -->

                <div class="modal fade" id="modal-dialog">

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

                                <a href="http://builderengine.com/forums/" class="btn btn-sm btn-success">Continue</a>

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

                                <a href="http://builderengine.com/page-support.html" class="btn btn-sm btn-success">Continue</a>

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

                                <a href="http://builderengine.com/page-support.html" class="btn btn-sm btn-success">Continue</a>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal fade" id="modal-cloudlogin">

                    <div class="modal-dialog">

                        <div class="modal-content">

                            <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                <h4 class="modal-title">BuilderEngine.com Account Login</h4>

                            </div>

                            <div class="modal-body">

                                You are about to leave your Administration Control Panel, click Continue to view page.

                            </div>

                            <div class="modal-footer">

                                <a href="" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>

                                <a href="http://builderengine.com/client/login" class="btn btn-sm btn-success">Continue</a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>
<style>
    .stats-title, .stats-number, .stats-desc{
        color:#000 !important;
    }
    .widget{
        margin-bottom:0px !important;
    }
</style>