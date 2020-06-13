	<div class="breadcrumb-row">
		<div class="classifieds" id="listings-page">
		{block type='page' name="classifieds-category"}
			{block type='row' class="classifieds-top-bar" name="classifieds-category-row-1-out"}
			{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="classifieds-category-row-1-col-1-blank"}
			{block type='row' class="row container" name="classifieds-category-row-1-inner"}
				{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="classifieds-category-row-1-col-1"}
					{block type='classifieds_breadcrumbs' name="classifieds-category-row-1-col-1-block-1"}
						{content}
						{/content}
					{/block}
				{/block}
				{block type='column' class="col-lg-4 col-md-4 col-sm-4 col-xs-12 classifieds-category-activename" name="classifieds-category-row-1-col-2"}
					{block type='classifieds_category_name' name="classifieds-category-row-1-col-2-block-1"}
						{content}
						{/content}
					{/block}
				{/block}
				{block type='column' class="col-lg-8 col-md-8 col-sm-8 col-xs-12" name="classifieds-category-row-1-col-3"}
					{block type='classifieds_search_section' name="classifieds-category-row-1-col-3-block-1"}
						{content}
						{/content}
					{/block}
				{/block}
			{/block}
		{/block}
	{/block}
			{block type='row' class="container" name="classifieds-category-row-2"}
				{block type='column' class="col-lg-3 col-md-3 col-sm-4 col-xs-12 listing-wrapper listings-top listings-bottom" name="classifieds-category-row-2-col-1"}
					{block type='classifieds_user_menu' name="classifieds-category-row-2-col-1-block-1"}
						{content}
						{/content}
					{/block}
					{block type='classifieds_categories' name="classifieds-category-row-2-col-1-block-2"}
						{content}
						{/content}
					{/block}
					{block type='classifieds_page_listing_filters' name="classifieds-category-row-2-col-1-block-3"}
						{content}
						{/content}
					{/block}
				{/block}
				{block type='column' class="col-lg-9 col-md-9 col-sm-8 col-xs-12 listing-wrapper listings-top listings-bottom" name="classifieds-category-row-2-col-2"}
					{block type='classifieds_category_items' name="classifieds-category-row-2-col-2-block-1"}
						{content}
						{/content}
					{/block}
				{/block}
			{/block}
		{/block}
	</div>
</div>
