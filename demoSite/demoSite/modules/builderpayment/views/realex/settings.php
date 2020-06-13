 
                <script src="<?=get_theme_path()?>/js/plugins/forms/uniform/jquery.uniform.min.js"></script>
                <script src="<?=get_theme_path()?>/js/plugins/forms/validation/jquery.validate.js"></script>
                <script src="<?=get_theme_path()?>/js/plugins/forms/select2/select2.js"></script> 
                <script src="<?=get_theme_path()?>/js/pages/form-validation.js"></script><!-- Init plugins only for page -->
                <link href="<?=get_theme_path()?>/js/plugins/forms/select2/select2.css" rel="stylesheet" />


                   
				
				<!-- begin #content --><div id="content" class="" style="min-height:800px"><!-- begin breadcrumb --><ol class="breadcrumb pull-right">    
				<li><a href="/admin">Home</a></li>	
				<li><a href="#">Payment Gateways</a></li>	  <li class="active">Realex Settings</li></ol>
				<!-- end breadcrumb -->
				<!-- begin page-header -->
				<h1 class="page-header"><img src="<?php echo get_theme_path()?>assets/img/realexpayments.png" title="Realex Payments" alt="Realex Payments">  <small> Realex Payments - Modules / Apps Control Panel</small></h1>
				<!-- end page-header -->			
				<!-- begin row -->		
				<div class="row">              
				<!-- begin col-8 -->			
				<div class="col-md-8">			        
				<!-- begin panel -->                  
				<div class="panel panel-inverse">             
				<div class="panel-heading">                 
				<div class="panel-heading-btn">                  
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>   
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>            
				</div>                       
				<h4 class="panel-title">Realex Payments Settings</h4>        
                </div>                     
				<div class="panel-body panel-form">            
                <form class="form-horizontal form-bordered" method="post" data-parsley-validate="true" name="demo-form">	
				<div class="form-group">								
				<label class="control-label col-md-4 col-sm-4" for="realexid1">Realex Merchant ID:</label>		
				<div class="col-md-6 col-sm-6">																	
				<input class="form-control" type="text" value="<?=$merchant_id?>" id="realexid1" name="merchant_id" placeholder="Enter Your Realex Merchant ID Here" data-parsley-required="true" />	
				</div>							
				</div>							
				<div class="form-group">						
				<label class="control-label col-md-4 col-sm-4" for="realexsecret1">Realex Secret ID:</label>			
				<div class="col-md-6 col-sm-6">								
				<input class="form-control" type="password" value="<?=$secret?>" id="realexsecret" name="secret" placeholder="Enter Your Realex Secret ID Here" data-parsley-required="true" />		
				</div>							
				</div>							
				<div class="form-group">					
				<label class="control-label col-md-4 col-sm-4" for="activerealex">Realex Server Hosted or Remote</label>			
				<div class="form-group">								
				<div class="col-md-3 col-sm-3">                                    
				<select class="form-control" id="select-required" name="method" data-parsley-required="true">       
				<option value='hosted' <?php if($method == 'hosted') echo "selected"?>>Hosted</option>             
				<option value='remote' <?php if($method == 'remote') echo "selected"?>>Remote</option>								
				</select>									
				</div>							
				</div>							
				</div>							
				<div class="form-group">				
				<label class="control-label col-md-4 col-sm-4" for="activerealex">Active Realex Payments</label>	
				<div class="form-group">								
				<div class="col-md-2 col-sm-2">                         
				<select class="form-control" id="select-required" name="active" data-parsley-required="true">      
				<option value='yes' <?php if($active == 'yes') echo "selected"?>>Yes</option>         
				<option value='no' <?php if($active == 'no') echo "selected"?>>No</option>			
				</select>									
				</div>								
				</div>							
				</div>								
				<div class="form-group">				
				<label class="control-label col-md-4 col-sm-4"></label>		
				<div class="col-md-6 col-sm-6">							
				<button type="submit" class="btn btn-primary" value="Save Settings">Save Settings</button>		
				</div>							
				</div>                            
				</form>                
				</div>                   
				</div>                 
				<!-- end panel -->        
				</div>				      
				<!-- end col-8 -->          
				<div class="col-md-4">
			        <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
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
                                        <td>View the Community Support Forums</td>
							            <td><a href="#modal-dialog" class="btn btn-sm btn-inverse" data-toggle="modal">View</a></td>
							        </tr>
							        <tr>
							            <td>Learn How to Use BuilderEngine with Tutorials/Guides</td>
							            <td><a href="#modal-guides" class="btn btn-sm btn-inverse" data-toggle="modal">View</a></td>
							        </tr>
							        <tr>
							            <td>Get Premium and Fast Support with Tickets</td>
							            <td><a href="#modal-tickets" class="btn btn-sm btn-inverse" data-toggle="modal">View</a></td>
							        </tr>
							        <tr>
							            <td>Login to your Cloud Account on BuilderEngine.com</td>
							            <td><a href="#modal-cloudlogin" class="btn btn-sm btn-inverse" data-toggle="modal">View</a></td>
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
											<a href="http://builderengine.com/forum/all_topics" class="btn btn-sm btn-success">Continue</a>
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
											<h4 class="modal-title">Cloud Account Login</h4>
										</div>
										<div class="modal-body">
											You are about to leave your Administration Control Panel, click Continue to view page.
										</div>
										<div class="modal-footer">
											<a href="" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
											<a href="http://builderengine.com/user/main/userLogin" class="btn btn-sm btn-success">Continue</a>
										</div>
									</div>
								</div>
							</div>							
                        </div>
                    </div>
			    </div> 
       

				</div>         
				<!-- end row -->
				</div>		
				<!-- end #content -->	
				<!-- begin scroll to top btn -->		
				<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>	
				<!-- end scroll to top btn -->	</div>	<!-- end page container -->
