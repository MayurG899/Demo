<link href="{home_url('')}/builderengine/public/editor/css/special.css" rel="stylesheet" type="text/css" />
<style>
    @media screen and (max-width: 768px) {
        .sidebar-search button {
            display: inline !important;
            position: relative !important;
            right: -82px !important;
            top: -36px !important;
        }
    }
</style>
<div class="page-content">
    <section class="catalog-single">
        {block type="page" class="container" name="ecommerce-product-second-theme-page"}
            {block type="row" name="ecommerce-product-second-theme-page-row-1" class="theme-2016-alignment-fix"}
                {block type="column" class="col-lg-6 col-md-6 col-sm-6 col-xs-12" name="ecommerce-product-second-theme-page-row-1-col-1"}
                    {block type="ecommerce_category_breadcrumb" name="ecommerce-product-second-theme-page-row-1-col-1-block-1"}
                        {content}
                        {/content}
                    {/block}
                {/block}
                {block type="column" class="col-lg-4 col-md-4 col-sm-4 col-xs-12" name="ecommerce-product-second-theme-page-row-1-col-2"}
                    {block type="generic" name="ecommerce-product-second-theme-page-row-1-col-2-block-1"}
                        {content}
                            <form class="sidebar-search" method="POST" action="{base_url()}ecommerce/search">
                                <input type="text" class="form-control form-control-be-40" name="search_keyword" placeholder="Search">
                                <button name="search_request" type="submit"></button>
                            </form>
                        {/content}
                    {/block}
                {/block}
                {block type="column" class="col-lg-2 col-md-2 col-sm-2 col-xs-12" name="ecommerce-product-second-theme-page-row-1-col-3"}
                    {block type="ecommerce_product_cart" class="custom-store-special-cart-2" name="ecommerce-product-second-theme-page-row-1-col-3-block-1"}
                        {content}
                        {/content}
                    {/block}
                {/block}
            {/block}
            {block type="row" name="ecommerce-product-second-theme-page-row-2" class="be-onlinestore-product-page-tpl-row ecommerce-product"}
                {block type="column" class="col-lg-7 col-md-6 col-sm-12 col-xs-12" name="ecommerce-product-second-theme-page-row-2-col-2"}
                    {block type="ecommerce_product_gallery" name="ecommerce-product-second-theme-page-row-2-col-2-block-1"}
                        {content}
                        {/content}
                    {/block}
                {/block}
				{block type="column" class="col-lg-5 col-md-4 col-sm-12 col-xs-12" name="ecommerce-product-second-theme-page-row-2-col-1"}
                    {block type="ecommerce_product_title" name="ecommerce-product-second-theme-page-row-2-col-1-block-1"}
                        {content}
                        {/content}
                    {/block}
                    {block type="ecommerce_product_price" name="ecommerce-product-second-theme-page-row-2-col-1-block-2"}
                        {content}
                        {/content}
                    {/block}
                {/block}
				{block type="column" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 colfull12" name="ecommerce-product-second-theme-page-row-2-col-1-2"}
                    {block type="ecommerce_product_desc_and_reviews" name="ecommerce-product-second-theme-page-row-2-col-1-block-3"}
                        {content}
                        {/content}
                    {/block}
                {/block}
            {/block}

		{/block}
 </section>			
			<section class="catalog-grid">
            {block type="row" class="container boxed-row" name="ecommerce-product-second-theme-page-row-3"}
                {block type="column" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="ecommerce-product-second-theme-page-row-3-col-1"}
                    {block type="ecommerce_category_recent_products" name="ecommerce-product-second-theme-page-row-3-col-1-block-2"}
                        {content}
                        {/content}
                    {/block}
					{block type="generic" name="ecommerce-product-second-theme-page-row-3-col-1-block-3"}
                        {content}
						<p></p>
                        {/content}
                    {/block}
                {/block}
			{/block}
       </section>	
</div>