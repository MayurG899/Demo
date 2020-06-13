<?php

echo get_header() ?>

<?php echo get_sidebar() ?>

<!-- begin #content -->
<div id="content" class="content page-with-two-sidebar content-two-sidebars"> 

    <!-- begin row -->
    <div class="row">
        <!-- begin col-+1 -->
        <div class="col-md-8">
            <!-- begin panel -->
            <div class="panel panel-white">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    </div>
                    <h4 class="panel-title">Restore Website Files & Database</h4>
                </div>
                <div class="panel-body panel-form">

                    <h2 class="text-center">Restore Website Options</h2>
                    <p class="text-center">
					<?php if(!empty($update)):?>
                        Restore Points are available for your Website.
					<?php else:?>
						You haven`t backed up your website yet. Please go to the Backups page.
					<?php endif;?>
                    </p>

                    <div id="zone_progressbar" class="hidden">
                        <div id="status_message" class="text-center"></div>
                        <?=get_progress()?>
                    </div>
                    <div class="panel-body panel-form">
                        <form class="form-horizontal form-bordered" method="post" data-parsley-validate="true" name="demo-form">
                            <?php foreach ($update as $key => $value) : ?>
                                <?php if($value != '.' && $value != '..') : ?>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4" for="websitetitle"><?= date("F j, Y, g:i a",$value) ?>:</label>
                                        <div class="col-md-8 col-sm-8">
                                                <button data-time="<?=$value?>" type="button" class="btn_file btn btn-warning">Restore All Files</button>
                                                <button data-time="<?=$value?>" type="button" class="btn_sql btn btn-warning">Restore Database</button>
                                                <button data-time="<?=$value?>" type="button" class="btn_block btn btn-primary">Restore Content Blocks</button>
                                        </div>
                                    </div>
                                <?php endif;?>
                            <?php endforeach;?>
                        </form>
                    </div>

 
                </div>
            </div>
            <!-- end panel -->
        </div>
        <!-- end col -->

        <!-- begin col-+1 -->
        <div class="col-md-4">
            <!-- begin panel -->
            <div class="panel panel-white">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    </div>
                    <h4 class="panel-title">Restore Information</h4>
                </div>
                <div class="panel-body panel-form">

                    <h3 class="text-center">Restore Details</h3>
                    <div id="updatezone_detail"><br></div>

                </div>
            </div>
            <!-- end panel -->
        </div>
        <!-- end col -->
		<!-- begin #sidebar-right -->
		<div id="sidebar-right" class="sidebar sidebar-right">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav m-t-10">
					<h4 class="sidebar-right-main-title">Restore Website Files</h4>
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
                                       Restore All Files (only), Database (only) or Content Blocks (only)
										
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
										<div class="todolist-title">Backup Website</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Restore Backup</div>
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
    <!-- end row -->








    <!-- begin scroll to top btn -->
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
    <!-- end scroll to top btn -->
</div>
<!-- end page container -->
<!-- end #content -->
<?php echo get_footer()?>

<script type="text/javascript">
    var http_root = "<?php echo home_url("")?>", updates;
    var do_backup = false;
    var files = [];
    var asked_files = [];

    set_progress = function(payload){
        $('#zone_progressbar > .progress > .progress-bar').attr({
            style: "min-width: 2em; width: " +payload+ "%;",
            "aria-valuenow": payload
        });

        $('#zone_progressbar > .progress > .progress-bar').text(payload+'%');
        $('#zone_progressbar > .progress > .progress-bar').addClass( 'progress-bar-striped' );
    };

    window.onload = function(){

        $('.btn_sql').click(function(){
            $(this).prop( "disabled", true );
            $('#zone_progressbar').removeClass( "hidden" ).addClass( "show" );
            set_progress(0);
            var _this = $(this);

            $('#status_message').html(
                $('<p>', {text: 'Initiating process... please wait...'})
            );

            var time = $(this).attr('data-time');

            $.get( site_root + '/admin/backup/restore_sql', 
            {
                time : time
            },
            function (data) {
                if(data.result){
                    set_progress(100);
                    $('#status_message').html(
                        $('<p>', {text: 'Database MySQL Restore Completed.'})
                    );
                    _this.prop( "disabled", false );
                }
            }, 'json');
        });

        $('.btn_block').click(function(){
            $(this).prop( "disabled", true );
            $('#zone_progressbar').removeClass( "hidden" ).addClass( "show" );
            set_progress(0);
            var _this = $(this);

            $('#status_message').html(
                $('<p>', {text: 'Initiating process... please wait...'})
            );

            var time = $(this).attr('data-time');

            $.get( site_root + '/admin/backup/restore_sql/be_blocks/be_blocks', 
            {
                time : time
            },
            function (data) {
                if(data.result){
                    set_progress(100);
                    $('#status_message').html(
                        $('<p>', {text: 'Content Blocks Restore Completed.'})
                    );
                    _this.prop( "disabled", false );
                }
            }, 'json');
        });

        $('.btn_file').click(function(){
            $(this).prop( "disabled", true );
            $('#zone_progressbar').removeClass( "hidden" ).addClass( "show" );
            set_progress(0);
            var _this = $(this);

            $('#status_message').html(
                $('<p>', {text: 'Initiating process... please wait...'})
            );

            var time = $(this).attr('data-time');

            $.get( site_root + '/admin/backup/restore_files', 
            {
                time : time
            },
            function (data) {
                if(data.result){
                    set_progress(100);
                    $('#status_message').html(
                        $('<p>', {text: 'All Files Restore Completed.'})
                    );
                    _this.prop( "disabled", false );
                }
            }, 'json');
        });
    };
</script>

    