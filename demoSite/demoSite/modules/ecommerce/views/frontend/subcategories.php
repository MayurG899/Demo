<?foreach($categories as $category):?>
    <div class="col-md-3 col-sm-6 hover-department">
        <a class="white-row-a" href="<?=base_url('ecommerce/category/'.$category->name)?>">
            <div class="white-row orange-subcategory">
                <?if(strlen($category->name) > 11 && strlen($category->name) <= 17):?>
                    <h4 style="font-size: 15px"><strong><?=$category->name?></strong></h4>
                <?elseif(strlen($category->name) > 17):?>
                    <h4 style="font-size: 12px"><strong><?=$category->name?></strong></h4>
                <?else:?>
                    <h4><strong><?=$category->name?></strong></h4>
                <?endif;?>
            </div>
        </a>
    </div>
<?endforeach;?>