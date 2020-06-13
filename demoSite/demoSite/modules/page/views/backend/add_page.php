<script src="<?php echo get_theme_path()?>assets/plugins/jquery/jquery-1.9.1.min.js"></script>

<!-- begin #content -->
<div id="content" class="page-with-two-sidebar content-two-sidebars">

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            </div>
            <h4 class="panel-title">Add New Website Page</h4>
        </div>
        <div class="panel-body panel-form">
            <form class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-4 col-be-4" for="title">
						<i class="fa fa-question-circle" style="font-size:16px;" data-toggle="tooltip" data-placement="top" title="Page Name"></i>
						Page Title:
					</label>
                    <div class="col-md-6 col-sm-6">
                        <input class="form-control" type="text" id="title" name="title" placeholder="Page Name / Title"/>
						<?=(isset($_GET['error']))?'<span class="label label-danger">Page title already exists !':''?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-4 col-be-4" for="slug">
					<i class="fa fa-question-circle" style="font-size:16px;" data-toggle="tooltip" data-placement="top" title="Page URL Slug"></i>
					URL Slug:
					</label>
                    <div class="col-md-6 col-sm-6">
                        <input class="form-control" type="text" id="slug" name="slug" placeholder="URL Address Link"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-4 col-be-4" for="type">
						<i class="fa fa-question-circle" style="font-size:16px;" data-toggle="tooltip" data-placement="top" title="Page Type"></i>
						Page Type:
					</label>
                    <div class="col-md-6 col-sm-6">                             
                        <select class="form-control" id="type" name="type">
							<option value="default">Default</option>
							<option value="cp">Account Dashboard</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-4 col-be-4" for="template">
						<i class="fa fa-question-circle" style="font-size:16px;" data-toggle="tooltip" data-placement="top" title="Page Template"></i>
						Page Template:
					</label>
                    <div class="col-md-6 col-sm-6">                             
                        <select class="form-control" id="template" name="template">
                            <?php foreach($theme_pages as $theme_page): ?>
                                <option value="<?=$theme_page?>"><?=$theme_page?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-4 col-be-4" for="pagemeta">
						<i class="fa fa-question-circle" style="font-size:16px;" data-toggle="tooltip" data-placement="top" title="Page SEO Description"></i>
						Page Meta Description:
					</label>
                    <div class="col-md-6 col-sm-6">
                        <input class="form-control" type="text" id="pagemeta" name="meta_desc" placeholder="SEO Page Description" data-parsley-required="true" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-4 col-be-4" for="pagemetakeywords">
						<i class="fa fa-question-circle" style="font-size:16px;" data-toggle="tooltip" data-placement="top" title="Page SEO Keywords"></i>
						Page Meta Keywords:
					</label>
                    <div class="col-md-6 col-sm-6">
                        <input class="form-control" type="text" id="pagemetakeywords" name="meta_keywords" placeholder="SEO Page Keywords" data-parsley-required="true" />
                    </div>
                </div> 
               <!--
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-4" for="fullname">Add to Site Map:</label>
                    <div class="col-md-6 col-sm-6">
                        <label class="radio-inline">
                            <input type="radio" name="sitemap1" value="option1" checked />
                            Add to Site Map
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="sitemap1" value="option2" />
                            Do Not Add / Hide
                        </label>
                        </div>
                </div>
				-->
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-4 col-be-4" for="pagemetakeywords">
						<i class="fa fa-question-circle" style="font-size:16px;" data-toggle="tooltip" data-placement="top" title="SEO Restrictions"></i>
						SEO Restrictions:
					</label>
                    <div class="col-md-8 col-sm-8">
                        <label class="checkbox-inline">
                            <input type="checkbox" name="seo_index" value="" />
                            No Index
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="seo_follow" value="" />
                            No Follow
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="seo_snippet" value="" />
                            No Snippet
                        </label><br/>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="seo_archive" value="" />
                            No Archive
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="seo_img_index" value="" />
                            No Image Index
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="seo_odp" value="" />
                            No ODP
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-4 col-be-4" for="fullname">
						<i class="fa fa-question-circle" style="font-size:16px;" data-toggle="tooltip" data-placement="top" title="Create a new Navigation Link for this page"></i>
						Add to Navigation:
					</label>
                    <div class="col-md-8 col-sm-8">
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<label class="radio-inline">
									<input type="radio" name="add_to_nav" value="no" checked />
									Do Not Add
								</label>
								<label class="radio-inline">
									<input type="radio" name="add_to_nav" value="yes" />
									Add Link
								</label>
							</div>
						</div>
						<div class="row">
							<div class="col-md-9 col-sm-9" style="margin-top:10px;">
								 <select class="form-control" id="select-required" name="link" data-parsley-required="true">
									<option value="0">No Parent / No Drop-Down</option>
									<?php foreach($links as $db_link): ?>
									   <option value="<?php echo $db_link->id?>"><?php echo $db_link->name?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-4 col-be-4" for="website">
						<i class="fa fa-question-circle" style="font-size:16px;" data-toggle="tooltip" data-placement="top" title="Only members of groups selected will see this webpage"></i>
						Group Access Policy:
					</label>
                    <div class="form-group">
                    <div class="col-md-6 col-sm-6">
                        <ul id="access-groups">
                            <li>Guests</li>
                            <li>Members</li>
                        </ul>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-4 col-be-4 ui-sortable"></label>
                    <div class="col-md-8 col-sm-8 ui-sortable">
                        <input type="submit" class="btn btn-primary" value="Add Page">
                    </div>
                </div>
            </form>
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
					<h4 class="sidebar-right-main-title">Website Pages</h4>
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
                                        Add a new page to your website, selecting a pre-designed template and adjust usegroups & seo options.
										
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
										<div class="todolist-title">Website Pages</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Add New Page</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Usegroup Access</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">SEO Settings</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Navbar Options</div>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="todolist-container" data-click="todolist">
										<div class="todolist-input"><i class="fa fa-square-o"></i></div>
										<div class="todolist-title">Template Selection</div>
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
<?php $groups = new Group();
$groups = $groups->get();?>

<script>
$(document).ready(function (){
    $('#access-groups').tagit({
        fieldName: "groups",
        singleField: true,
        showAutocompleteOnFocus: true,
        availableTags: [ <?php foreach ($groups as $group): ?>"<?php echo $group->name?>", <?php endforeach;?>]
    });
});
</script>
<script>
function convertToSlug(Text)
{
    return Text
        .toLowerCase()
        .replace(/ /g,'-')
        .replace(/[^\w-]+/g,'')
        ;
}
$(document).ready(function (){
    $("#title").keyup(function() {
        $("#slug").val($("#title").val());
        $("#slug").change();
    });     
    
    $("#slug").keyup(function() {
        $("#slug").change();
    });
    $("#slug").change(function() {
        $("#slug").val(convertToSlug($("#slug").val()));
    });
});
</script>