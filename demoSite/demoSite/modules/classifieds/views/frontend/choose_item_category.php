<link href="<?=base_url('modules/classifieds/css/style.css')?>" rel="stylesheet">
<?/*
function category_has_children($cat_id, $all_categories)
  {
    foreach($all_categories as $category)
    {
      if($category->parent == $cat_id){
        //echo "Category {$category->id} has parent {$category->parent}";
        return true;
      }
    }

    return false;
  }
  function output_category_menu($parent, $all_categories)
  {
    $output = "";
    foreach($all_categories as $category)
    {
      if($category->parent != $parent)
        continue;

      if(category_has_children($category->id, $all_categories)){
        if($parent == 0){
          $output .= "
            <li><a style=\"
            border: 3px solid #f25758;
            border-bottom-right-radius: 10px;
            border-top-right-radius: 10px;
            font-size: 21px;
            background-color: #f25758;
            color: #ffffff;
            \" href=\"#\">{$category->name}</a></li>";
            $output .= output_category_menu($category->id, $all_categories);
          }else{
            $output .= "
      
            <li class=\"has_sub\">
              <a style=\"
              border: 1px solid #D8CECE;
              border-left: 2px solid #f25758;
              border-bottom-right-radius: 5px;
              border-top-right-radius: 5px;
              font-size: 18px; color: #5E5E5E
              \" href=\"#\">{$category->name}</a>
                <ul>
                ".output_category_menu($category->id, $all_categories)."
              </ul>
            </li>";

          }
      }else
        $output .= "
            <li>
              <a href=\"/classifieds/create_item?category_id={$category->id}\">{$category->name}</a>
            </li>";
    }
    return $output;
  }*/
  ?>
<div class="items">
  <div class="container">
    <div class="row">

      	<!-- Sidebar -->
      	<div class="span3">

        <h5 class="title">Logged in as <?=$member->username?></h5>
        <!-- Sidebar navigation -->
          <nav>
            <ul id="nav">
              <li><a href="<?=base_url('/classifieds/choose_item_category')?>">Post an item</a></li>
              <li class="has_sub">
                <a href="#">Account</a>
                <ul>
                  <li><a href="<?=base_url('/classifieds/profile/'.$member->id)?>">Profile</a></li>
                  <li><a href="<?=base_url('/classifieds/edit_profile')?>">Edit profile</a></li>
                  <li><a href="<?=base_url('/classifieds/logout')?>">Logout</a></li>
                </ul>
              </li>
              <li class="has_sub">
                <a href="#">Items</a>
                <ul>
                  <li><a href="<?=base_url('/classifieds/placed_ads')?>">Placed items</a></li>
                  <li><a href="<?=base_url('/classifieds/my_watchlist')?>">Watched items</a></li>
                </ul>
              </li>
              <li class="has_sub">
                <a href="#">Follows</a>
                <ul>
                  <li><a href="<?=base_url('/classifieds/followed_users')?>">Followed Users</a></li>
                  <li><a href="<?=base_url('/classifieds/users_following_me')?>">Users following me</a></li>
                </ul>
              </li>
              <li class="has_sub">
                <?
                $messages = new ClassifiedsMessage();
                $messages->where('to', $member->id);
                $messages->where('viewed', 'no');
                $messages = $messages->get();
                $i = 0;
                foreach ($messages as $message)
                {
                  $i++;
                }?>
                <? if($i > 0):?>
                  <a href="#">Messages (<p class="red-info"><?=$i?></p>)</a>
                <? else:?>
                  <a href="#">Messages</a>
                <? endif;?>
                <ul>
                   <li><a href="<?=base_url('/classifieds/send_message')?>">Send a message</a></li>
                    <? if($i > 0):?>
                      <li><a href="<?=base_url('/classifieds/inbox')?>">Inbox (<p class="red-info"><?=$i?></p>)</a></li>
                    <? else:?>
                      <li><a href="<?=base_url('/classifieds/inbox')?>">Inbox</a></li>
                    <? endif;?>
                </ul>
              </li>
            </ul>
          </nav>

      	</div>
        
        <?/*
      	<div class="span9">
          	<h5 class="title" style="text-align: start; margin-left: 17%">Choose a category for your Ad</h5>
            <div class="row-fluid">
            	<div class="span6 offset1">
	              	<nav>
			            <ul id="nav">
			              <?=output_category_menu(0, $all_categories)?>
			            </ul>
		          	</nav>
		        </div>
            </div>
      	</div> */?>      
        <?$block = new Block('be_gbanjo_choose_item_category');?>
        <?$block->set_type('classifieds_categories');?>
        <?$block->set_size('span9');?>
        <?$block->show();?>

    </div>
  </div>
</div>



<script src="<?=base_url('modules/classifieds/js/custom.js')?>"></script>
<script src="<?=base_url('modules/classifieds/js/nav.js')?>"></script>