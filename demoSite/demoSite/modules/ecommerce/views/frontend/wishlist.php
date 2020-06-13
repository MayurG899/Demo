<? $wish_num = (array)$wishes;?>
<?if(count($wish_num) > 0):?>
<section class="wishlist">
    <div class="container" style="min-height:400px;">
		<div class="row">
			<!--Items List-->
          	<div class="col-lg-12 col-md-12">
            	<h2 class="title">Wishlist</h2>
            	<table class="items-list">
					<thead>
						<th style="padding-right:10px;">#</th>
						<th>Product Image</th>
						<th>Product name</th>
						<th>Product price</th>
						<th>Buy Now</th>
						<th>Action</th>
					</thead>
					<!--Item-->
					<tbody>
					<?$i=1;?>
					<?foreach($wishes as $product):?>
						<tr class="item first">
							<td><?=$i;?></td>
						    <td class="thumb"><a href="<?=base_url('ecommerce/product/'.$product->id)?>"><img src="<?=checkImagePath($product->image)?>" style="max-width:30%;" alt="<?=$product->name?>"/></a></td>
						    <td class="name" style="width:45%;"><a href="<?=base_url('ecommerce/product/'.$product->id)?>"><?=$product->name?></a></td>
						    <td class="price">
							    <?if($currency->symbol_position == 'before'):?>
							        <?=$currency->symbol?><?=number_format($product->price,2,".",",")?>
								<?else:?>
									<?=number_format($product->price,2,".",",")?><?=$currency->symbol?>
								<?endif;?>
						    </td>
						    <td class="button"><a class="ecommerce-btn ecommerce-btn-addcart ecommerce-btn-sm" href="<?=base_url('ecommerce/wishlist?id='.$product->id)?>"><i class="fa fa-shopping-cart"></i>ADD TO CART</a></td>
						    <td class="delete"><a href="<?=base_url('ecommerce/wishlist?delete='.$product->id)?>" class="ecommerce-btn ecommerce-btn-danger" style="background:none;"><i class="fa fa-trash-o"></i></a></td>
						</tr>
						<?$i++;?>
					<?endforeach;?>
					</tbody>
                </table>
            </div>
		</div>
    </div>
</section>
<?else:?>
<? add_action('be_foot', "init_404")?>
<?
	function init_404()
	{
		echo'
			<script src="'.base_url().'modules/ecommerce/assets/js/libs/modernizr.custom.js"></script>
			<script src="'.base_url('modules/ecommerce/assets/js/plugins/jquery.placeholder.js').'"></script>
			<script src="'.base_url('modules/ecommerce/assets/js/plugins/smoothscroll.js').'"></script>
			<script src="'.base_url('modules/ecommerce/assets/js/404.js').'"></script>		
		';
	}	
?>
<!--Adding Media Queries Support for IE8-->
<!--[if lt IE 9]>
  <script src="js/plugins/respond.js"></script>
<![endif]-->
	<div class="page-404">
		<div class="content">
			<div class="inner">
			<div class="block">
				<p>You have no products in your Wish List.</p>
				<a class="limobtn limobtn-default" href="<?=base_url('ecommerce/category/All?page=1')?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to products</a>
				<!--  <p><span>OR</span>Try to search site</p>
				  <form class="search-404" method="get" autocomplete="off">
					<input class="form-control" type="text" name="search" placeholder="Search">
					<button type="submit"></button>
				  </form>-->
			</div>
		  </div>
		</div>
	</div>
<?endif;?>