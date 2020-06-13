<?php echo get_header() ?>

<?php echo get_sidebar() ?>

<!-- begin #content -->
<div id="content" class="content">
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="/admin">Home</a></li>
	 <li><a href="#">Social Links</a></li>
	  <li class="active">Show SOcial Links</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Search / Edit Social Links <small>Administration Control Panel</small></h1>
<!-- end page-header -->
			<!-- begin row -->
			<div class="row">
			    <!-- begin col-12 -->
			    <div class="col-md-12">
				<div class="result-container">
			            <div class="input-group m-b-20">
                            <input type="text" class="form-control input-white" placeholder="Enter keywords here..." />
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-inverse"><i class="fa fa-search"></i> Search</button>
                            </div>
                        </div>
                      </div>
			        <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            </div>
                            <h4 class="panel-title">Search Results</h4>
                        </div>
                        <div class="panel-body">
							<br/>
							<a href="<?=base_url('admin/main/add_social_link')?>" class="btn btn-sm btn-success" style="margin-bottom:10px;"><i class="fa fa-plus"></i> Add New Social Link</a>
                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
											<th>Image</th>
											<th>URL</th>
                                            <th>Icon</th>
											<th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($social_links as $result): ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $result->name?></td>
											<td><?php echo '<img src="'.$result->image.'" class="img-responsive" width="80">';?></td>
                                            <td><?php echo $result->url?></td>
                                            <td><i class="fa <?=$result->icon?>" id="demo" style="font-size:24px;"></i></td>
											<td>
												<div class="btn-group-vertical">
													<a <?php echo href("admin", "main/edit_social_link/{$result->id}")?>class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
												</div>
												<div class="btn-group-vertical m-r-5">
													<a <?php echo href("admin", "main/delete_social_link/{$result->id}")?> class="btn btn-danger" onclick="return confirm('Are you sure you want to permanently delete this Social Link?')"><i class="fa fa-remove"></i> Delete</a>
												</div>
											</td>
                                        </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
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