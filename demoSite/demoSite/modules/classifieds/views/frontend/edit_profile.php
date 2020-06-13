<link href="<?=base_url('modules/classifieds/assets/css/bootstrap.css')?>" rel="stylesheet">
<link href="<?=base_url('modules/classifieds/assets/css/theme.css')?>" rel="stylesheet">
<link href="<?=base_url('modules/classifieds/assets/css/style.css')?>" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

<?$search = new Block('be_classifieds_search_section')?>
<?$search->set_type('classifieds_search_section');?>
<?$search->add_css_class('no-float-left');?>
<?$search->show();?>
<script>
$(document).ready(function(){
    $('.department-li').click(function(){
        $('.custom-child-subcategories').find('.active').removeClass('active');
    });
});
</script>

<div class="container">
    <br />
    <div class="row">
        <div class="col-sm-12">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="<?=base_url('/classifieds/profile/'.$member->id)?>"><?=$member->username?></a></li>
                <li class="active" style="pointer-events: none"><a href="#"><?=$current_page?></a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4  hidden-xs">
            <div class="sidebar">    
                <div class="row">
                    <div class="col-sm-11 hidden-xs"> 
                        <a class="btn btn-primary pull-right" id="regionsBtn" style="width: 100%">
                            Categories
                            <span class="caret"></span>
                        </a>
                    </div>   
                    <div data-backdrop="" id="regionsModal" class="bs-countries-modal-sm  hidden-xs" tabindex="-1" role="dialog" aria-labelledby="regionsModal" aria-hidden="true">
                        <div class="modal-dialog custom-modal-dialog">
                            <div class="modal-content">
                                <div class="directory-counties custom-directory-counties">
                                    <div class="col-sm-12">
                                        <ul class="nav nav-pills nav-stacked" id="myTab">
                                            <?foreach($categories->where('parent', 0)->get() as $department_category):?>
                                                <li><a class="category-element department-li" data-toggle="tab" href="#<?=$department_category->id?>"><?=$department_category->name?></a></li>
                                            <?endforeach;?>
                                        </ul>
                                        <div class="tab-content custom-subcategories" id="myTabContent">
                                            <?foreach($categories->where('parent', 0)->get() as $subcategory):?>
                                                <div id="<?=$subcategory->id?>" class="tab-pane custom-tab-pane counties-pane">
                                                    <div class="col-sm-12">
                                                        <?$child_categories = new ClassifiedsCategory();?>
                                                        <ul class="nav nav-pills nav-stacked" style="margin-top: 18px">
                                                            <?foreach($child_categories->where('parent', $subcategory->id)->get() as $child_category):?>
                                                                <li><a class="category-element" data-toggle="tab" href="#child<?=$child_category->id?>"><?=$child_category->name?></a></li>
                                                            <?endforeach;?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            <?endforeach;?>
                                        </div>
                                        <div class="tab-content custom-child-subcategories">
                                            <?foreach($categories->where('parent !=', 0)->get() as $subsubcategory):?>
                                                <div id="child<?=$subsubcategory->id?>" class="tab-pane custom-tab-pane counties-pane">
                                                    <div class="col-sm-12">
                                                        <?$child_categories = new ClassifiedsCategory();?>
                                                        <ul class="nav nav-pills nav-stacked" style="margin-top: 18px">
                                                            <?foreach($child_categories->where('parent', $subsubcategory->id)->get() as $child_category):?>
                                                                <li><a class="category-element" href="<?=base_url('classifieds/view_category/'.$child_category->id.'?page=1')?>"><?=$child_category->name?></a></li>
                                                            <?endforeach;?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            <?endforeach;?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>        
                <br />
                <div class="row">
                    <div class="col-sm-11">
                        <?$user_panel = new Block('be_classifieds_inbox_user_panel');?>
                        <?$user_panel->set_type('classifieds_user_menu');?>
                        <?$user_panel->add_css_class('no-float-left');?>
                        <?$user_panel->show();?>
                    </div>
                </div>
            </div>        
        </div>
        <div class="col-sm-8 pull-right listings">
            <h1 style="margin-bottom: 30px">Edit profile</h1>
            <form class="form-vertical" method="post" enctype="multipart/form-data">
                <fieldset>
                    <div class="row">  
                        <div class="col-sm-12" >
                            <div class="well">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Avatar</label>
                                    <input type="file" name="avatar" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">First name</label>
                                    <input type="text" name="first_name" class="form-control" placeholder="Enter first name" value="<?=$member->first_name?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Last name</label>
                                    <input type="text" name="last_name" class="form-control" placeholder="Enter last name" value="<?=$member->last_name?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Telephone</label>
                                    <input type="text" name="telephone" class="form-control" placeholder="Phone number" value="<?=$member_extend->telephone?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter email" value="<?=$member->email?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Country</label>
                                    <input type="text" name="country" class="form-control" placeholder="Country name" value="<?=$member_extend->country?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">State</label>
                                    <input type="text" name="state" class="form-control" placeholder="State name" value="<?=$member_extend->state?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">City</label>
                                    <input type="text" name="city" class="form-control" placeholder="City name" value="<?=$member_extend->city?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Address</label>
                                    <input type="text" name="address" class="form-control" placeholder="Enter address" value="<?=$member_extend->address?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Post code</label>
                                    <input type="text" name="post_code" class="form-control" placeholder="Enter post code" value="<?=$member_extend->post_code?>">
                                </div>
                                <br />
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div><!-- Modal -->