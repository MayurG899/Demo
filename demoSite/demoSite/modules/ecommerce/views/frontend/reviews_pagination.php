<div class="text-center">
    <ul class="be-pagination">
        <?if(isset($_GET['page']) && $_GET['page'] > 1):?>
            <li><a href="<?=base_url()?>ecommerce/product/<?=$product_id?>?page=<?=$_GET['page'] - 1?>"><i class="fa fa-chevron-left"></i></a></li>
        <?else:?>
            <li><a style="pointer-events: none" href="#"><i class="fa fa-chevron-left"></i></a></li>
        <?endif;?>

        <?for ($i=1; $i<=$total_pages;$i++)
        {
            if(isset($_GET['page']) && $_GET['page'] == $i) {
                echo '<li class="active"><a href="'.base_url().'ecommerce/product/'.$product_id.'?page='.$i.'">'.$i.'</a></li>';
            } else {
                echo '<li><a href="'.base_url().'ecommerce/product/'.$product_id.'?page='.$i.'">'.$i.'</a></li>';
            }
        }?>

        <?if(isset($_GET['page']) && $_GET['page'] < $total_pages):?>
            <li><a href="<?=base_url()?>ecommerce/product/<?=$product_id?>?page=<?=$_GET['page'] + 1?>"><i class="fa fa-chevron-right"></i></a></li>
        <?else:?>
            <li><a style="pointer-events: none" href="#"><i class="fa fa-chevron-right"></i></a></li>
        <?endif;?>
    </ul>
</div>