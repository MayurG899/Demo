<?php if(!$embedded):?>
<?php echo get_header() ?>
<script>
    var site_root = "<?php echo home_url("")?>";
</script>
    <!-- Plugins stylesheets -->
<?php 
/*<link href="<?php echo get_theme_path()?>css/builderengine-theme/jquery.ui.genyx.css" rel="stylesheet" />*/?>
<!-- Plugins stylesheets -->
<link href="<?php echo get_theme_path()?>assets/plugins/upload/elfinder/css/elfinder.min.css" rel="stylesheet" />
<link href="<?php echo get_theme_path()?>assets/plugins/upload/elfinder/themes/windows-10/css/theme.css" rel="stylesheet">

<link href="<?php echo get_theme_path()?>assets/plugins/upload/plupload/jquery.plupload.queue/css/jquery.plupload.queue.css" rel="stylesheet" /> 


<style>
.elfinder-button {
    width: 24px !important;
    height: 24px !important;
}
</style>




<!-- Init plugins -->



<?php echo get_sidebar() ?>

<!-- begin #content -->
<div id="content" class="content page-with-two-sidebar content-two-sidebars" style="min-height:800px">
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
			        <h4 class="panel-title">File Manager</h4>
			    </div>
			    <div class="panel-body">
                    <div id="elfinder"></div>
			    </div>
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
					<h4 class="sidebar-right-main-title">File Manager</h4>
					<li class="nav-widget">
                        <div class="panel-group m-b-0" id="accordion">
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
                                        Manage your files and upload images / files here. Adjust images, password protect files and more.
										
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
										<div class="todolist-title">File Manager</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Add Files</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Adjust Folders</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Create Your Folders</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Adjust Images</div>
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
		
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	<!-- end page container -->
	
	<!-- The blueimp Gallery widget -->
        <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
            <div class="slides"></div>
            <h3 class="title"></h3>
            <a class="prev">‹</a>
            <a class="next">›</a>
            <a class="close">×</a>
            <a class="play-pause"></a>
            <ol class="indicator"></ol>
        </div>
		
<?php echo get_footer()?>

<script src="<?php echo get_theme_path()?>assets/plugins/upload/elfinder/js/elfinder.min.js"></script>
<script src="<?php echo get_theme_path()?>assets/plugins/upload/plupload/plupload.full.js"></script>

<script src="<?php echo get_theme_path()?>assets/plugins/upload/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<script>
$(document).ready(function () {
    setTimeout("initialize_file_manager();", 500);
});
</script>
<!-- Init plugins -->

<script src="<?php echo get_theme_path()?>assets/plugins/file_manager.js"></script>
<?php else:?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>BuilderEngine File Manager</title>
        <script>
            var site_root = "<?php echo home_url("")?>";
        </script>
        <!-- jQuery and jQuery UI (REQUIRED) -->
         <link rel="stylesheet" type="text/css" href="<?php echo home_url("/builderengine/public/js/elfinder/jquery-ui.css")?>" />
		 <script src="<?php echo home_url("/builderengine/public/js/elfinder/jquery.min.js")?>"></script>
		 <script src="<?php echo home_url("/builderengine/public/js/elfinder/jquery-ui.min.js")?>"></script>

        <!-- elFinder CSS (REQUIRED) -->
        <link href="<?php echo get_theme_path()?>assets/plugins/upload/elfinder/css/elfinder.min.css" rel="stylesheet" />
        <link href="<?php echo get_theme_path()?>assets/plugins/upload/elfinder/themes/windows-10/css/theme.css" rel="stylesheet">
        <!-- elFinder JS (REQUIRED) -->
        <script src="<?php echo get_theme_path()?>assets/plugins/upload/elfinder/js/elfinder.min.js"></script>

        <!-- elFinder initialization (REQUIRED) -->
        <script type="text/javascript" charset="utf-8">
            // Helper function to get parameters from the query string.
            function getUrlParam(paramName) {
                var reParam = new RegExp('(?:[\?&]|&amp;)' + paramName + '=([^&]+)', 'i') ;
                var match = window.location.search.match(reParam) ;

                return (match && match.length > 1) ? match[1] : '' ;
            }

            $(document).ready(function() {
                var funcNum = getUrlParam('CKEditorFuncNum');

                var elf = $('#elfinder').elfinder({
                    url : site_root + '/admin/files/connector/',
                    getFileCallback : function(file) {
                        if(typeof window.opener.CKEDITOR != "undefined")
                            window.opener.CKEDITOR.tools.callFunction(funcNum, file.url);
                        <?php if(isset($_GET['target'])):?>
                        if ( typeof window.opener.file_selected == 'function' ) {
                            window.opener.file_selected( file.url,'<?php echo $_GET['target']?>');
                        }
                        <?php endif;?>

                        window.close();
                    },
                    resizable: false
                }).elfinder('instance');
            });
        </script>


    </head>
    <body>

    <!-- Element where elFinder will be created (REQUIRED) -->
    <div id="elfinder"></div>

    </body>
    </html>
<?php endif?>
<!-- Upload plugins -->
