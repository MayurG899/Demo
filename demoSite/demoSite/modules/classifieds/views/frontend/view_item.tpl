<div class="classifieds" id="listings-page">
    <div class="">
		{block type='page' name="classifieds-view-item"}
			{block type='row' class="row container breadcrumb-row" name="classifieds-view-item-row-1"}
				{block type='column' class="col-lg-8 col-md-8 col-sm-12 col-xs-12" name="classifieds-view-item-row-1-col-1"}
					{block type='classifieds_breadcrumbs' name="classifieds-view-item-row-1-col-1-block-1"}
						{content}
						{/content}
					{/block}
				{/block}
				{block type='column' class="col-lg-2 col-md-2 col-sm-6 col-xs-6" name="classifieds-view-item-row-1-col-2"}
					{block type='classifieds_category_menu' name="classifieds-view-item-row-1-col-2-block-1"}
						{content}
						{/content}
					{/block}
				{/block}
				{block type='column' class="col-lg-2 col-md-2 col-sm-6 col-xs-6" name="classifieds-view-item-row-1-col-3"}
					{block type='classifieds_account_menu' name="classifieds-view-item-row-1-col-3-block-1"}
						{content}
						{/content}
					{/block}
				{/block}
			{/block}
			{block type='row' class="row container" name="classifieds-view-item-row-2"}
				{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 listing-wrapper listings-top listings-bottom" name="classifieds-view-item-row-2-col-1"}
					{block type='classifieds_ad' name="classifieds-view-item-row-2-col-1-block-1"}
						{content}
						{/content}
					{/block}
				{/block}
			{/block}
			{block type='row' class="row container" name="classifieds-view-item-row-3"}
				{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 listing-wrapper listings-top listings-bottom" name="classifieds-view-item-row-3-col-1"}
					{block type='classifieds_latest_ads' name="classifieds-view-item-row-3-col-1-block-1"}
						{content}
						{/content}
					{/block}
				{/block}
			{/block}
			{block type='row' class="row container" name="classifieds-view-item-row-4"}
				{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12 listing-wrapper listings-top listings-bottom" name="classifieds-view-item-row-4-col-1"}
					{block type='classifieds_recent_items' name="classifieds-view-item-row-4-col-1-block-1"}
						{content}
						{/content}
					{/block}
				{/block}
			{/block}
		{/block}
	</div>
</div>
