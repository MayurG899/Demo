

{block type='page' name="forum-topic-categories"}
	{block type='row' class="forums-page-title" name="forum-topic-categories-row-1"}
		{block type='column' class="col-lg-12 col-md-12 col-sm-12 col-xs-12" name="forum-topic-categories-row-1-col-1"}
			{block type='forum_header' name="forum-topic-categories-row-1-col-1-block-1"}
				{content}
				{/content}
			{/block}
		{/block}
	{/block}
	{block type='row' class="container" name="forum-topic-categories-row-2"}
		{block type='column' class="col-lg-9 col-md-9 col-sm-9 col-xs-12" name="forum-topic-categories-row-2-col-1"}
			{block type='forum_topic_categories' name="forum-topic-categories-row-2-col-1-block-1"}
				{content}
				{/content}
			{/block}
		{/block}
		{block type='column' class="col-lg-3 col-md-3 col-sm-3 col-xs-12" name="forum-topic-categories-row-2-col-2"}
			{block type='forum_recent_thread_posts' name="forum-topic-categories-row-2-col-2-block-1"}
				{content}
				{/content}
			{/block}
		{/block}
	{/block}
{/block}