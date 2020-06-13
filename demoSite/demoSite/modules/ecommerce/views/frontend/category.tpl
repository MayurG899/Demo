
<link href="{home_url('')}/builderengine/public/editor/css/special.css" rel="stylesheet" type="text/css" />


<section class="catalog-grid">
    {block type="page" class="" name="ecommerce-category-second-theme-page"}
        {block type="row" class="container boxed-row custom-store-special-category-row-1" name="ecommerce-category-second-theme-page-row-1"}
            {block type="column" class="col-lg-2 col-md-2 col-sm-12 col-xs-12" name="ecommerce-category-second-theme-page-row-1-col-1"}
                {block type="generic" name="ecommerce-category-second-theme-page-row-1-col-1-block-1"}
                    {content}
                        <h3 class="with-sorting">{$title}</h3>
                    {/content}
                {/block}
            {/block}
            {block type="column" class="col-lg-5 col-md-5 col-sm-12 col-xs-12" name="ecommerce-category-second-theme-page-row-1-col-2"}
                {block type="ecommerce_category_breadcrumb" name="ecommerce-category-second-theme-page-row-1-col-2-block-1"}
                    {content}
                    {/content}
                {/block}
            {/block}
            {block type="column" class="col-lg-2 col-md-2 col-sm-6 col-xs-12" name="ecommerce-category-second-theme-page-row-1-col-3"}
                {block type="ecommerce_category_sorting" name="ecommerce-category-second-theme-page-row-1-col-3-block-1"}
                    {content}
                    {/content}
                {/block}
            {/block}
            {block type="column" class="col-lg-3 col-md-3 col-sm-6 col-xs-12" name="ecommerce-category-second-theme-page-row-1-col-4"}
                {block type="generic" name="ecommerce-category-second-theme-page-row-1-col-4-block-1"}
                    {content}
                        <form class="sidebar-search" method="POST" action="{base_url()}ecommerce/search">
                            <input type="text" class="form-control form-control-be-40" name="search_keyword" placeholder="Search">
                            <button name="search_request" type="submit"></button>
                        </form>
                    {/content}
                {/block}
            {/block}
        {/block}
        {block type="row" class="container boxed-row custom-store-special-category-row-2" name="ecommerce-category-second-theme-page-row-2"}
		 {block type="column" class="col-lg-10 col-md-10 col-sm-8 col-xs-12" name="ecommerce-category-second-theme-page-row-2-01-col-2"}
			{/block}
            {block type="column" class="col-lg-2 col-md-2 col-sm-4 col-xs-12" name="ecommerce-category-second-theme-page-row-2-col-1"}
                {block type="ecommerce_product_cart" class="custom-store-special-cart-2" name="ecommerce-category-second-theme-page-row-2-col-1-block-1"}
                    {content}
                    {/content}
                {/block}
            {/block}
        {/block}
        {block type="row" class="container boxed-row" name="ecommerce-category-theme-page-row-3"}  
			{block type="column" class="col-lg-3 col-md-3 col-sm-6 col-xs-12" name="ecommerce-category-second-theme-page-row-3-col-1"}
                {block type="generic" name="ecommerce-category-second-theme-page-row-3-col-1-block-1"}
                    {content} 
                    {/content}
                {/block}
				{block type="ecommerce_category_list" name="ecommerce-category-theme-page-row-3-col-1-block-18"}
                    {content}
                    {/content}
                {/block}
			{/block}	
			{block type="column" class="col-lg-9 col-md-9 col-sm-12 col-xs-12" name="ecommerce-category-second-theme-page-row-3-col-2"}
                {block type="ecommerce_category_products" name="ecommerce-category-second-theme-page-row-3-col-2-block-1"}
                    {content}
                    {/content}
                {/block}
            {/block}
		{/block}
		{block type="row" class="container boxed-row" name="ecommerce-category-theme-page-row-4"}
			{block type="column" class="col-lg-3 col-md-3 col-sm-12 col-xs-12" name="ecommerce-category-theme-page-row-3-col-6"}
                {block type="generic" name="ecommerce-category-theme-page-row-3-col-3-block-2"}
                    {content}
                    {/content}
                {/block}
            {/block}
            {block type="column" class="col-lg-9 col-md-9 col-sm-12 col-xs-12" name="ecommerce-category-second-theme-page-row-3-col-3"}
                {block type="ecommerce_category_pagination" name="ecommerce-category-second-theme-page-row-3-col-3-block-1"}
                    {content}
                    {/content}
                {/block}
            {/block}
        {/block}
        {block type="row" class="container boxed-row" name="ecommerce-category-second-theme-page-row-5"}
            {block type="column" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="ecommerce-category-second-theme-page-row-4-col-1"}
                {block type="ecommerce_category_recent_products" name="ecommerce-category-second-theme-page-row-4-col-1-block-1"}
                    {content}
                    {/content}
                {/block}
            {/block}
        {/block}
		
    {/block}
</section>