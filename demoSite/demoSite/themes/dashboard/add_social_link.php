<?php echo get_header() ?>
<?php echo get_sidebar() ?>
<?include(APPPATH."/config/getfontawesome.php");?>
<!-- begin #content -->
<div id="content" class="content">
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="/admin">Home</a></li>
	 <li><a href="#">Social Links</a></li>
	  <li class="active">Add New Social Link</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Add New Social Link <small>Website Settings Control Panel</small></h1>
<!-- end page-header -->
			<!-- begin row -->
			<div class="row">
                <!-- begin col-8 -->
			    <div class="col-md-8">
					<form class="form-horizontal form-bordered" data-parsley-validate="true" name="demo-form" method="post" enctype="multipart/form-data">
						<!-- begin panel -->
						<div class="panel panel-inverse">
							<div class="panel-heading">
								<div class="panel-heading-btn">
									<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
									<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
								</div>
								<h4 class="panel-title">Create New Social Link</h4>
							</div>
							<div class="panel-body panel-form">
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="fullname"><b>Name:</b>
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Create Name"></i></label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" id="name" name="name" placeholder="Required" data-parsley-required="true" required />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="fullname"><b>URL:</b>
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Create Url"></i></label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" id="url" name="url" placeholder="Required" data-parsley-required="true" required />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="fullname"><b>Image:</b>
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Add Social Network Photo"></i></label>
									<div class="col-md-6 col-sm-6">
										<span class="btn btn-success fileinput-button">
											<i class="fa fa-plus"></i>
											<span>Add image...</span>
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
											<input type="file" name="image" rel="file_manager" id="f">
										</span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="email"><b>Font Awesome Icon:</b>
									<i class="fa fa-question-circle" style="font-size:16px;color: #AFAFAF;" data-toggle="tooltip" data-placement="top" title="Enter Icon Font Awesome html"></i></label>
									<div class="col-md-4 col-sm-4">
										<select id="icon" name="icon" class="form-control">
											<?foreach($get_fontawesome_classes as $class):?>
												<option value="<?=$class?>"><?=$class?></option>
											<?endforeach;?>
										</select>
									</div>
									<div class="col-md-2 col-sm-2">
										<i class="fa " id="demo" style="font-size:24px;"></i>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4"></label>
									<div class="col-md-6 col-sm-6">
										<button type="submit" class="suBtn btn btn-primary">Create New Social Link</button>
									</div>
								</div>
							</div>
						</div>
						<!-- end panel -->
					</form>
                </div>
				
                <!-- end col-8 -->
				<div class="col-md-4">
			        <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            </div>
                            <h4 class="panel-title">Need Help? View The Create New Users Video Tutorial</h4>
                        </div>
                        <div class="panel-body">
                           
						   <iframe width="100%" height="315" src="https://www.youtube.com/embed/xORPeEAmmus" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
			    </div> 
            </div>
            <!-- end row -->
		</div>
		<!-- end #content -->
		
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
<?php echo get_footer()?>
<script>
	$("#f").click(function(e){
	   e.preventDefault();
	});
	$('#icon').on('change',function(){
		var icon = this.value;
		//$('#demo').removeClass(icon);
		$('#demo').replaceWith('<i class="fa ' + icon + '" id="demo" style="font-size:24px;"></i>');
	});
</script>