<div class="text-center">
  <ul class="be-pagination">
      <?if(isset($_GET['page']) && $_GET['page'] > 1 && $search == false && $not_in_module == false):?>
        <li><a href="<?=base_url()?>ecommerce/category/<?=$page_content?>?page=<?=$_GET['page'] - 1?>"><i class="fa fa-chevron-left"></i></a></li>
      <?elseif(isset($_GET['page']) && $_GET['page'] > 1 && $search == true):?>
        <li><a href="<?=base_url()?>ecommerce/search/<?=$page_content?>?page=<?=$_GET['page'] - 1?>"><i class="fa fa-chevron-left"></i></a></li>
      <?elseif(isset($_GET['page']) && $_GET['page'] > 1 && $not_in_module == true):?>
        <li><a href="<?=base_url()?>?category=<?=$_GET['category']?>&page=<?=$_GET['page'] - 1?>"><i class="fa fa-chevron-left"></i></a></li>
      <?else:?>
        <li><a style="pointer-events: none" href="#"><i class="fa fa-chevron-left"></i></a></li>
      <?endif;?>

      <?for ($i=1; $i<=$total_pages;$i++)
      {
        if($search == true)
        {
          if(!isset($_GET['page']) && $i == 1)
            echo '<li class="active"><a href="'.base_url().'ecommerce/search/'.$page_content.'?page='.$i.'">'.$i.'</a></li>';
          else if(isset($_GET['page']) && $_GET['page'] == $i)
            echo '<li class="active"><a href="'.base_url().'ecommerce/search/'.$page_content.'?page='.$i.'">'.$i.'</a></li>';
          else
            echo '<li><a href="'.base_url().'ecommerce/search/'.$page_content.'?page='.$i.'">'.$i.'</a></li>';
        }
        elseif($not_in_module == true)
        {
            if(!isset($_GET['page']) && $i == 1)
                echo '<li class="active"><a href="'.base_url().'?category='.$_GET['category'].'&page='.$i.'">'.$i.'</a></li>';
            else if(isset($_GET['page']) && $_GET['page'] == $i)
                echo '<li class="active"><a href="'.base_url().'?category='.$_GET['category'].'&page='.$i.'">'.$i.'</a></li>';
            else
                echo '<li><a href="'.base_url().'?category='.$_GET['category'].'&page='.$i.'">'.$i.'</a></li>';
        }
        else
        {
          if(!isset($_GET['page']) && $i == 1)
            echo '<li class="active"><a href="'.base_url().'ecommerce/category/'.$page_content.'?page='.$i.'">'.$i.'</a></li>';
          else if(isset($_GET['page']) && $_GET['page'] == $i)
            echo '<li class="active"><a href="'.base_url().'ecommerce/category/'.$page_content.'?page='.$i.'">'.$i.'</a></li>';
          else
            echo '<li><a href="'.base_url().'ecommerce/category/'.$page_content.'?page='.$i.'">'.$i.'</a></li>';
        }
      }?>

      <?if(isset($_GET['page']) && $_GET['page'] < $total_pages && $search == false && $not_in_module == false):?>
        <li><a href="<?=base_url()?>ecommerce/category/<?=$page_content?>?page=<?=$_GET['page'] + 1?>"><i class="fa fa-chevron-right"></i></a></li>
      <?elseif(isset($_GET['page']) && $_GET['page'] < $total_pages && $search == true):?>
        <li><a href="<?=base_url()?>ecommerce/search/<?=$page_content?>?page=<?=$_GET['page'] + 1?>"><i class="fa fa-chevron-right"></i></a></li>
      <?elseif(!isset($_GET['page']) && $search == false && $not_in_module == false):?>
        <li><a style="pointer-events: none" href="<?=base_url()?>ecommerce/category/<?=$page_content?>?page=2"><i class="fa fa-chevron-right"></i></a></li>
      <?elseif(!isset($_GET['page']) && $search == true):?>
        <li><a style="pointer-events: none" href="<?=base_url()?>ecommerce/search/<?=$page_content?>?page=2"><i class="fa fa-chevron-right"></i></a></li>
      <?elseif(isset($_GET['page']) && $_GET['page'] < $total_pages && $not_in_module == true):?>
        <li><a href="<?=base_url()?>?category=<?=$_GET['category']?>&page=<?=$_GET['page'] + 1?>"><i class="fa fa-chevron-right"></i></a></li>
      <?else:?>
        <li><a style="pointer-events: none" href="#"><i class="fa fa-chevron-right"></i></a></li>
      <?endif;?>
  </ul>
</div>