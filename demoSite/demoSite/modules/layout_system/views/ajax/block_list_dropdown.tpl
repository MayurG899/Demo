<li role="presentation">
    <a role="menuitem" tabindex="-1" href="#" class="insert-block" block-type="row">Row</a>
</li>

<li onmouseover="colDetectEdge(this)" class="dropdown-submenu">
    <a tabindex="-1" href="#">Block</a>
    <ul class="dropdown-menu">
        {foreach from=$blocks key=name item=block}
            {if $block.type == "block"}
                <li><a tabindex="-1" href="#" class="insert-block" block-type="{$block['folder']}">{$name}</a></li>
            {else}
                <li onmouseover="colDetectEdge(this)" class="dropdown-submenu"><a href="#">{$name}</a>
                    <ul class="dropdown-menu">
                        {foreach from=$block.blocks key=sub_name item=sub_block}
							{if $sub_block.folder == 'ecommerce_category'
							 || $sub_block.folder == 'ecommerce_category_pagination'
							 || $sub_block.folder == 'ecommerce_category_sidebar'
							 || $sub_block.folder == 'ecommerce_category_categories_sidebar'
							 || $sub_block.folder == 'ecommerce_product_desc_and_reviews'
							 || $sub_block.folder == 'ecommerce_product_gallery'
							 || $sub_block.folder == 'ecommerce_product_price'
							 || $sub_block.folder == 'ecommerce_product_title'
							}
								{continue}
							{/if}
                            <li><a tabindex="-1" href="#" class="insert-block" block-type="{$sub_block.folder}">{$sub_name}</a></li>
                        {/foreach}
                    </ul>
                </li>
            {/if}
        {/foreach}
    </ul>
</li>
<script>
    function colDetectEdge(obj){
        $(obj).parent().parent().parent().parent().find('#dropdownMenu1').css('z-index', '1001');
        var position = $(obj).find('.dropdown-menu').position();
        var absoluteRight = ($(window).width() - ($(obj).offset().left + $(obj).outerWidth()));
        if(absoluteRight < 220){
            $(obj).find('.dropdown-menu').css('left', '-188px');
        }
    }
</script>
