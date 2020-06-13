<link href="{home_url('')}/builderengine/public/editor/css/special.css" rel="stylesheet" type="text/css" />
<section class="catalog-grid">
    {block type="page" class="container" name="ecommerce-search-second-theme-page"}
        {block type="row" name="ecommerce-search-second-theme-page-row-1"}
            {block type="column" class="col-md-2 col-sm-3" name="ecommerce-search-second-theme-page-row-1-col-1"}
                {block type="generic" name="ecommerce-search-second-theme-page-row-1-col-1-block-1"}
                    {content}
                        <h2 class="with-sorting">Search Results</h2>
                    {/content}
                {/block}
            {/block}
            {block type="column" class="col-md-5 col-sm-5" name="ecommerce-search-second-theme-page-row-1-col-2"}
                {block type="ecommerce_category_breadcrumb" name="ecommerce-search-second-theme-page-row-1-col-2-block-1"}
                    {content}
                    {/content}
                {/block}
            {/block}
            {block type="column" class="col-md-2 col-sm-3" name="ecommerce-search-second-theme-page-row-1-col-3"}
                {block type="ecommerce_category_sorting" name="ecommerce-search-second-theme-page-row-1-col-3-block-1"}
                    {content}
                    {/content}
                {/block}
            {/block}
            {block type="column" class="col-md-3 col-sm-12 col-xs-12" name="ecommerce-search-second-theme-page-row-1-col-4"}
                {block type="generic" name="ecommerce-search-second-theme-page-row-1-col-4-block-1"}
                    {content}
                        <form class="sidebar-search" method="POST" action="{base_url()}ecommerce/search">
                            <input type="text" class="form-control form-control-be-40" name="search_keyword" placeholder="Search">
                            <button name="search_request" type="submit"></button>
                        </form>
                    {/content}
                {/block}
            {/block}
        {/block}
        {block type="row" name="ecommerce-search-second-theme-page-row-2"}
            {block type="column" name="ecommerce-search-second-theme-page-row-2-col-1"}
                {block type="ecommerce_product_cart" name="ecommerce-search-second-theme-page-row-2-col-1-block-1"}
                    {content}
                    {/content}
                {/block}
            {/block}
        {/block}
        {block type="row" name="ecommerce-search-second-theme-page-row-3"}
            {block type="column" class="col-lg-3 col-md-3 col-sm-3" name="ecommerce-search-second-theme-page-row-3-col-1"}
                {block type="ecommerce_account_login" name="ecommerce-search-second-theme-page-row-3-col-1-block-1"}
                    {content}
                    {/content}
                {/block}
                {block type="ecommerce_product_featured_products" name="ecommerce-search-second-theme-page-row-3-col-1-block-2"}
                    {content}
                    {/content}
                {/block}
            {/block}
            {block type="column" class="col-lg-9 col-md-9 col-sm-9" name="ecommerce-search-second-theme-page-row-3-col-2"}
                {block type="ecommerce_category_products" name="ecommerce-search-second-theme-page-row-3-col-2-block-1"}
                    {content}
                    {/content}
                {/block}
            {/block}
            {block type="column" class="col-lg-12 col-md-12 col-sm-12" name="ecommerce-search-second-theme-page-row-3-col-3"}
                {block type="ecommerce_category_pagination" name="ecommerce-search-second-theme-page-row-3-col-3-block-1"}
                    {content}
                    {/content}
                {/block}
            {/block}
        {/block}
        {block type="row" name="ecommerce-search-second-theme-page-row-4"}
            {block type="column" class="col-lg-12 col-md-12 col-sm-12" name="ecommerce-search-second-theme-page-row-3-row-4-col-1"}
                {block type="ecommerce_category_recent_products" name="ecommerce-search-second-theme-page-row-3-row-4-col-1-block-1"}
                    {content}
                    {/content}
                {/block}
            {/block}
        {/block}
    {/block}
</section>