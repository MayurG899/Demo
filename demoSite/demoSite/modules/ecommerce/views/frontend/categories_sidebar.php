<!--Filters-->
<div class="filters-mobile col-lg-12 col-md-12 col-sm-12 bckgrd">
	<?/*
	<div class="shop-filters">
		<section class="filter-section">
		  <h3>Filter by price</h3>
		  <form method="get" name="price-filters">

			<a style="color:inherit !important;" href="<?=base_url()?>ecommerce/category/all" class="clear" id="clearPrice" >Clear price</a>
			<div class="price-slider">
			  <div id="price-range" class="">
			  </div>
			  <div class="values group">
				<span class="labels"><?=$currency->symbol?></span>
				<input style="color:inherit !important;" class="form-control" name="minVal" id="minVal" type="text" data-min-val="0" value="<?if(isset($_GET['minVal'])) echo $_GET['minVal']; else echo 0;?>">
				<span style="color:inherit !important;" class="labels"> &nbsp;&nbsp; - &nbsp;&nbsp; </span> <span style="color:inherit !important;" class="labels"><?=$currency->symbol?></span>
				<input style="color:inherit !important;" class="form-control" name="maxVal" id="maxVal" type="text" data-max-val="2500" value="<?if(isset($_GET['maxVal'])) echo $_GET['maxVal']; else echo 2500;?>">

			  </div>
			  <input style="color:inherit !important;" class="limobtn limobtn-default limobtn-sm" type="submit" value="Filter">
			</div>
		  </form>
		</section>
	</div>
	*/?>
	<?/*
    <!--Categories Section-->
	<div class="shop-filters">
		<section class="filter-section">
		  <h2>Categories</h2>
		  <ul class="categories">
			<li><a style="color:inherit !important;" href="<?=base_url()?>ecommerce/category/All">All</a></li>

			<?foreach ($categories->where('parent', 0)->get() as $category) :?>
			  <?if($category->has_children()) :?>
				<li class="has-subcategory"><a><?=$category->name?></a>
				  <ul class="subcategory">
					<?$categories_first_level = new Ecommerce_category();?>
					<?foreach ($categories_first_level->where('parent', $category->id)->get() as $first_level_category) :?>
					  <?if($first_level_category->has_children()) :?>
						<li class="has-subcategory"><a><?=$first_level_category->name?></a>
						  <ul class="subcategory">
							<?$categories_second_level = new Ecommerce_category();?>
							<?foreach ($categories_second_level->where('parent', $first_level_category->id)->get() as $second_level_category) :?>
							  <li><a style="color:inherit !important;" href="<?=base_url()?>ecommerce/category/<?=$second_level_category->name?>"><?=$second_level_category->name?></a></li>
							<?endforeach;?>
						  </ul>
						</li>
					  <?else: ?>
						<li><a style="color:inherit !important;" href="<?=base_url()?>ecommerce/category/<?=$first_level_category->name?>"><?=$first_level_category->name?></a></li>
					  <?endif;?>
					<?endforeach;?>
				  </ul>
				</li>
			  <?else: ?>
				<li><a style="color:inherit !important;" href="<?=base_url()?>ecommerce/category/<?=$category->name?>"><?=$category->name?></a></li>
			  <?endif;?>
			<?endforeach;?>
		  </ul>
		</section>
	</div>
	*/?>
	
  </div>
  <div class="col-lg-12 col-md-12 col-sm-12">
    <h2 style="margin-left: -14px; margin-bottom: 0px;">
      Featured
    </h2>
      <?=$featured_products?>
  </div>
</div>