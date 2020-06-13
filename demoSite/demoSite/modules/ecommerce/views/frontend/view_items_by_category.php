<style>
.orange-subcategory
{
  background-color: rgb(234,168,36)
}
</style>
<script>
$(document).ready( function () {
  $("#products-order-by").change( 
    function(){ 
      if($(this).val() == 0)
        return;
      <? if($page == 'search'):?>
      window.location.href = '<?=base_url()?>ecommerce/search/<?=$category_name?>/?order=' + $(this).val();
      <?else:?>
      window.location.href = '<?=base_url()?>ecommerce/category/<?=$category_name?>/?order=' + $(this).val();
      <?endif;?>
    } 
  );
});
</script>
<div id="wrapper">
<section class="container">
<div class="row">
<div class="col-md-9">
<h1 style="margin-left: 1%">
  <?if($category_name == "All"):?>
    <strong>Departments</strong>
  <?elseif($page == 'search'):?>
    <strong><?=$category_title?></strong>
  <?else:?>
    <strong><?=$category_name?></strong>
  <?endif;?>
    <?if($category_info != '' && ($category_info->parent == 0 || $category_info->parent == -1)):?>
      department
    <?endif;?>
</h1>

<?if($category_info != '' && $this->categories->has_children($category_info->id)):?>
  <?foreach($categories as $category):?>
    <?if($category->parent == $category_info->id):?>
      <div class="col-md-3 col-sm-6 hover-department">
        <a class="white-row-a" href="<?=base_url('ecommerce/category/'.$category->name)?>">
            <div class="white-row orange-subcategory">
                <h4><strong><?=$category->name?></strong></h4>
            </div>
        </a>
      </div>
    <?endif;?>
  <?endforeach;?>
<?elseif($category_name == 'All'):?>
  <?foreach($categories as $category):?>
    <?if($category->parent == 0 || $category->parent == -1):?>
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
    <?endif;?>
  <?endforeach;?>
<?endif;?>

<div id="shop">
<?if($category_info != '' && $this->categories->has_children($category_info->id)):?>
  <div class="row top-shop-option">
      <div class=" col-sm-6 col-md-6">
          <select class="pointer fsize13 pull-right" id="products-order-by">
              <option value='0'<?if(isset($_GET['page']) && $_GET['page'] == 0) echo 'selected';?>>Sort By</option>
              <option value='1'<?if(isset($_GET['page']) && $_GET['page'] == 1) echo 'selected';?>>Name (A-Z)</option>
              <option value='2'<?if(isset($_GET['page']) && $_GET['page'] == 2) echo 'selected';?>>Name (Z-A)</option>
              <option value='3'<?if(isset($_GET['page']) && $_GET['page'] == 3) echo 'selected';?>>Price (Low-High)</option>
              <option value='4'<?if(isset($_GET['page']) && $_GET['page'] == 4) echo 'selected';?>>Price (High-Low)</option>
              <option value='5'<?if(isset($_GET['page']) && $_GET['page'] == 5) echo 'selected';?>>Ratings</option>
          </select>
      </div>
  </div>
<?endif;?>
<!-- items -->

<?if(empty($products)):?>
  <div class="col-lg-12"?>
    <p style="margin-bottom: 40%">No products met your criteria.</p>
  </div>
<?elseif($category_info != '' && $this->categories->has_products($category_info->id)):?>
  <div class="row">
    <?foreach($products as $product):?>
      <div class="col-sm-6 col-md-3 col-xs-6"><!-- item -->
          <div class="item-box">
              <figure>
                  <a class="item-hover" href="<?=base_url('ecommerce/product/'.$product->id)?>">
                      <span class="overlay color2"></span>
                      <span class="inner">
                          <span class="block fa fa-plus fsize20"></span>
                          <strong><?=$product->short_description?></strong>
                      </span>
                  </a>
                  <a href="shop_cart.php?action=cart_add&amp;product_id=1&amp;product_color=red&amp;product_size=l&amp;product_qty=1"
                     class="limobtn limobtn-primary add_to_cart"><i class="fa fa-shopping-cart"></i> ADD TO CART</a>
                  <img class="img-responsive" src="<?=checkImagePath($product->image)?>" width="260" height="260" alt="product">
              </figure>
              <div class="item-box-desc">
                  <h4><?=$product->title?></h4>
                  <small class="styleColor"><?=$this->currencies->get_price_in_user_currency($product->price)?></small>
              </div>
          </div>
      </div>
    <?endforeach;?>

  </div>
<?elseif($category_name == 'All'):?>
  <div class="row">
    <?foreach($products as $product):?>
      <div class="col-sm-6 col-md-3 col-xs-6"><!-- item -->
          <div class="item-box">
              <figure>
                  <a class="item-hover" href="<?=base_url('ecommerce/product/'.$product->id)?>">
                      <span class="overlay color2"></span>
                      <span class="inner">
                          <span class="block fa fa-plus fsize20"></span>
                          <strong><?=$product->short_description?></strong>
                      </span>
                  </a>
                  <a href="shop_cart.php?action=cart_add&amp;product_id=1&amp;product_color=red&amp;product_size=l&amp;product_qty=1"
                     class="limobtn limobtn-primary add_to_cart"><i class="fa fa-shopping-cart"></i> ADD TO CART</a>
                  <img class="img-responsive" src="<?=checkImagePath($product->image)?>" width="260" height="260" alt="product">
              </figure>
              <div class="item-box-desc">
                  <h4><?=$product->title?></h4>
                  <small class="styleColor"><?=$this->currencies->get_price_in_user_currency($product->price)?></small>
              </div>
          </div>
      </div>
    <?endforeach;?>
  </div>
<?elseif($page == 'search'):?>
<div class="row">
  <?foreach($products as $product):?>
    <div class="col-sm-6 col-md-3 col-xs-6"><!-- item -->
        <div class="item-box">
            <figure>
                <a class="item-hover" href="<?=base_url('ecommerce/product/'.$product->id)?>">
                    <span class="overlay color2"></span>
                    <span class="inner">
                        <span class="block fa fa-plus fsize20"></span>
                        <strong><?=$product->short_description?></strong>
                    </span>
                </a>
                <a href="shop_cart.php?action=cart_add&amp;product_id=1&amp;product_color=red&amp;product_size=l&amp;product_qty=1"
                   class="limobtn limobtn-primary add_to_cart"><i class="fa fa-shopping-cart"></i> ADD TO CART</a>
                <img class="img-responsive" src="<?=checkImagePath($product->image)?>" width="260" height="260" alt="product">
            </figure>
            <div class="item-box-desc">
                <h4><?=$product->title?></h4>
                <small class="styleColor"><?=$this->currencies->get_price_in_user_currency($product->price)?></small>
            </div>
        </div>
    </div>
  <?endforeach;?>
</div>
<?endif;?>

<div class="row">
    <!-- PAGINATION -->
    <div class="text-center">
        <ul class="pagination">
            <?if(isset($_GET['page']) && $_GET['page'] > 1 && $page != 'search'):?>
              <li><a href="<?=base_url()?>ecommerce/category/<?=$category_name?>?page=<?=$_GET['page'] - 1?>"><i class="fa fa-chevron-left"></i></a></li>
            <?elseif(isset($_GET['page']) && $_GET['page'] > 1 && $page == 'search'):?>
              <li><a href="<?=base_url()?>ecommerce/search/<?=$category_name?>?page=<?=$_GET['page'] - 1?>"><i class="fa fa-chevron-left"></i></a></li>
            <?else:?>
              <li><a style="pointer-events: none" href="#"><i style="color: #bbb" class="fa fa-chevron-left"></i></a></li>
            <?endif;?>

            <?for ($i=1; $i<=$total_pages;$i++)
            {
              if($page == "search")
              {
                if(!isset($_GET['page']) && $i == 1)
                  echo '<li class="active"><a href="'.base_url().'ecommerce/search/'.$category_name.'?page='.$i.'">'.$i.'</a></li>';
                else if(isset($_GET['page']) && $_GET['page'] == $i)
                  echo '<li class="active"><a href="'.base_url().'ecommerce/search/'.$category_name.'?page='.$i.'">'.$i.'</a></li>';
                else
                  echo '<li><a href="'.base_url().'ecommerce/search/'.$category_name.'?page='.$i.'">'.$i.'</a></li>';
              }
              else
              {
                if(!isset($_GET['page']) && $i == 1)
                  echo '<li class="active"><a href="'.base_url().'ecommerce/category/'.$category_name.'?page='.$i.'">'.$i.'</a></li>';
                else if(isset($_GET['page']) && $_GET['page'] == $i)
                  echo '<li class="active"><a href="'.base_url().'ecommerce/category/'.$category_name.'?page='.$i.'">'.$i.'</a></li>';
                else
                  echo '<li><a href="'.base_url().'ecommerce/category/'.$category_name.'?page='.$i.'">'.$i.'</a></li>';
              }
            }?>

            <?if(isset($_GET['page']) && $_GET['page'] < $total_pages && $page != 'search'):?>
              <li><a href="<?=base_url()?>ecommerce/category/<?=$category_name?>?page=<?=$_GET['page'] + 1?>"><i class="fa fa-chevron-right"></i></a></li>
            <?elseif(isset($_GET['page']) && $_GET['page'] < $total_pages && $page == 'search'):?>
              <li><a href="<?=base_url()?>ecommerce/search/<?=$category_name?>?page=<?=$_GET['page'] + 1?>"><i class="fa fa-chevron-right"></i></a></li>
            <?elseif(!isset($_GET['page']) && $page != 'search'):?>
              <li><a style="pointer-events: none" href="<?=base_url()?>ecommerce/category/<?=$category_name?>?page=2"><i style="color: #bbb" class="fa fa-chevron-right"></i></a></li>
            <?elseif(!isset($_GET['page']) && $page == 'search'):?>
              <li><a style="pointer-events: none" href="<?=base_url()?>ecommerce/search/<?=$category_name?>?page=2"><i style="color: #bbb" class="fa fa-chevron-right"></i></a></li>
            <?else:?>
              <li><a style="pointer-events: none" href="#"><i style="color: #bbb" class="fa fa-chevron-right"></i></a></li>
            <?endif;?>
        </ul>
    </div>

</div>
<!-- items -->

</div>
</div>
<aside class="col-md-3">
    <h3>CATEGORIES</h3><!-- h3 - have no margin-top -->

    <ul class="nav nav-list">
      <li><a href="<?=base_url('ecommerce/category/All?page=1')?>"><i class="fa fa-circle-o"></i>All Items</a></li>
      <?$i = 1;?>
      <?foreach($categories as $parent_category):?>
        <?if($parent_category->parent == 0 || $parent_category->parent == -1):?>

          <?if($this->categories->has_children($parent_category->id)):?>
            <li id="parent<?=$i?>"><a href="<?=base_url('ecommerce/category/'.$parent_category->name)?>"><i class="fa fa-circle-o"></i><?=$parent_category->name?></a></li>
              <ul class="child<?=$i?> nav nav-list" style="display: none; margin-left: 10%">
                    <li><a href="<?=base_url('ecommerce/category/'.$parent_category->name)?>"><i class="fa fa-arrow-circle-o-up"></i><?=$parent_category->name?></a></li>
                <?foreach($categories as $category):?>
                  <?if($category->parent == $parent_category->id):?>
                    <li><a href="<?=base_url('ecommerce/category/'.$category->name)?>"><i class="fa fa-arrow-circle-o-right"></i><?=$category->name?></a></li>
                  <?endif;?>
                <?endforeach;?>
              </ul>
          <?else:?>
            <li><a href="<?=base_url('ecommerce/category/'.$parent_category->name)?>"><i class="fa fa-circle-o"></i><?=$parent_category->name?></a></li>
          <?endif;?>

        <?endif;?>
        <?$i++;?>
      <?endforeach;?>
    </ul>

</aside>

</div>
</section>
</div>

<style>
.visible-li
{
  display: block !important;
}
</style>
<?$parent_category_number = $this->categories->count_parent_categories();?>
<script>
$(document).ready(function()
{
  var number = "<?=$parent_category_number?>";
  
  for (var i = 1; i < number; i++) 
  {
    $("#parent" + i).click( createCallback( i ) );
  }
 
});

function createCallback( i ){
  return function(){
    event.preventDefault();
      if($(".child" + i).hasClass('visible-li'))
        $(".child" + i).removeClass('visible-li');
      else
        $(".child" + i).addClass('visible-li');
  }
}
</script>