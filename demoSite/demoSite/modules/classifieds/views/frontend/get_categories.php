<div class="col-sm-11 hidden-xs"> 
    <a class="btn btn-primary pull-right" id="regionsBtn" style="width: 100%;background-color: #e6e6e6;background-image: none;border: none;">
        Browse Categories
        <span class="caret"></span>
    </a>
</div>   
<div data-backdrop="" style="position:absolute" id="regionsModal" class="bs-countries-modal-sm  hidden-xs" tabindex="-1" role="dialog" aria-labelledby="regionsModal" aria-hidden="true">
    <div class="modal-dialog custom-modal-dialog">
        <div class="modal-content">
            <div class="directory-counties custom-directory-counties" style="height:470px">
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