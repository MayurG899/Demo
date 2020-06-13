<link href="<?=base_url('modules/classifieds/assets/css/bootstrap.css')?>" rel="stylesheet">
<link href="<?=base_url('modules/classifieds/assets/css/theme.css')?>" rel="stylesheet">
<link href="<?=base_url('modules/classifieds/assets/css/style.css')?>" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<!-- Items -->
<div class="items">
  <div class="container">
    <div class="row">
      <!-- Sidebar -->
      <div class="span3">
        <?if($this->user->is_guest()):?>
        <h5 class="title">User section</h5>
          <nav>
            <ul id="navi">
              <li><a href="<?=base_url('/classifieds/login')?>">Login</a></li>
              <li><a href="<?=base_url('/classifieds/register')?>">Register</a></li>
            </ul>
          </nav>
        <?else:?>
          <h5 class="title">Logged in as <?=$member->username?></h5>
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
        <?endif;?>
          <br>

          <h5 class="title" style="margin-top: 10px;"> All Sections </h5>
          <ul id="nav" style="margin-bottom: 20px;">
            <?foreach ($sections as $section):?>
            <li>
              <a style="border-left: 3px solid #bc8000; padding: 5px<? if ($id == $section->id) echo ';background-color: #dd9700; color: #ffffff !important';?>" 
                href="
                <?if(isset($_GET['step']) && $_GET['step'] == '2')
                    echo base_url('/classifieds/subcategories/'.$section->id.'?step=2');
                  else
                    echo base_url('/classifieds/subcategories/'.$section->id);?>
                "><?=$section->name?></a>
            </li>
            <?endforeach;?>
          </ul>

<br />
          <!-- Sidebar items (featured items)-->



      </div>

<script>
$(document).ready( function () {

  $("#products-order-by").change( 
    function(){ 
      if($(this).attr('value') == 0)
        return;
      window.location.href = '<?=base_url()?>classifieds/view_category/<?=$category->id?>?order=' + $(this).attr('value');
    } 

  );

});
</script>

<!-- Main content -->
      <div class="span9">

        <!-- Breadcrumb -->
        <ul class="breadcrumb">
          <li><a href="/">Home</a> <span class="divider">/</span></li>
          <li class='active'><?=$category->name?></li>
        </ul>
        
        <div class="row-fluid">
          <div class="afeatureorange" style="border: 1px solid #EBEBEB; background: #fff; box-shadow: 0px 0px 1px #EBEBEB !important;">
            <div class="row-fluid">
              <div class="span12">
                <div class="afmatter afmatter-sub" style="background-color: #FFFFFF">
                    <div class="row-fluid section-title-row" style="margin-bottom: 10px; border-bottom: 2px solid #6A6DC5">
                      <div class="span12">
                        <div class="row-fluid">
                          <div class="span3">
                            <div class="section-row-container">
                              <!-- left front thumbnail -->
                              <div class="left-front-thumbnail">
                                <img class="section-thumbnail-image" src="<?=checkImagePath($category->image2)?>">
                              </div>
                              <!-- left back thumbnail -->
                              <div class="left-back-thumbnail">
                              </div>
                              <!-- right thumbnail -->
                              <div class="right-thumbnail">
                                <img class="section-thumbnail-image" src="<?=checkImagePath($category->image)?>">
                              </div>
                            </div>
                          </div>
                          <div class="span7" style="margin-left: 0px;">
                            <?$section_ads = '';?>
                            <? foreach($subcategories as $subcategory)
                            {
                              $subsubcategory = new ClassifiedsCategory();
                              $subsubcategory->where('parent', $subcategory->id);
                              $subsubcategory = $subsubcategory->get();
                              $placed_ads = '';
                              foreach($subsubcategory as $sub)
                              {
                                $items = $sub->item->get();
                                $n = 0;
                                foreach($items as $item)
                                {
                                  $n++;
                                }
                                $placed_ads += $n;
                              }
                              $section_ads += $placed_ads;
                            }
                            ?>
                            <p class="section-thumbnail-title" style="margin-top: 25px; font-size: 20px; width: 100%;"><?=$category->name?>  (<?=$section_ads?>)</p>
                          </div>
                          <div class="span2" style="margin-left: 0px; margin-top: 25px">
                            <a href="<?=base_url('/classifieds/view_category/'.$category->id.'?page=1')?>" style="font-size: 14px; width: 100%;">All Ads >></a>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- section row -->
                    <? foreach($subcategories as $subcategory):?>
                    <?$i = 0;?>
                    <div class="row-fluid">
                      <div class="span12">
                        <fieldset class="ad-fieldset-sub" style="border-top: 1px solid #B4B4B4; margin-bottom: 10px">
                          <legend class="ad-legend-sub" style="padding: 0px; max-width: 40%">
                            <?
                            $subsubcategory = new ClassifiedsCategory();
                            $subsubcategory->where('parent', $subcategory->id);
                            $subsubcategory = $subsubcategory->get();
                            $total_ads = '';
                            foreach($subsubcategory as $sub)
                            {
                              $items = $sub->item->get();
                              $n = 0;
                              foreach($items as $item)
                              {
                                $n++;
                              }
                              $total_ads += $n;
                            }?>
                            <p style="display: inline"><?=$subcategory->name?>  (<?=$total_ads?>)</p>
                            <a style="font-size: 12px; margin-left: 6%" href="<?=base_url('classifieds/view_category/'.$subcategory->id.'?page=1')?>">All Ads >></a>
                          </legend>
                      </fieldset>
                      </div>
                    </div>
                    <div class="row-fluid">
                      <? $subsubcategory = new ClassifiedsCategory();
                         $subsubcategory->where('parent', $subcategory->id);
                         $subsubcategory = $subsubcategory->get();

                      foreach($subsubcategory as $sub):?>
                        <div class="span3"  style="min-height: 103px !important<?if(is_int($i / 4)) echo '; margin-left: 0px';?>">
                          <a href="
                          <?if(isset($_GET['step']) && $_GET['step'] == '2')
                            echo base_url('classifieds/create_item?category_id='.$sub->id);
                          else
                            echo base_url('classifieds/view_category/'.$sub->id.'/?page=1');?>
                          " style="text-decoration: none">
                            <div class="section-link section-link-subcategories" style="width:75%">
                              <div class="row-fluid">
                                  <img src="<?=checkImagePath($sub->image)?>" style="max-width: 100px;max-height: 50px; margin-top: 5px">
                              </div>
                              <div class="row-fluid">
                                  <p style="margin-bottom: 0px"><?=$sub->name?></p>
                              </div>
                              <div class="row-fluid">
                                  <p>(
                                  <?
                                  $items = $sub->item->get();
                                  $n = 0;
                                  foreach($items as $item)
                                  {
                                    $n++;
                                  }
                                  echo $n;
                                  ?>
                                  )</p>
                              </div>
                            </div>
                          </a>
                        </div>
                        <?$i++?>
                      <?endforeach;?>
                    </div>
                    <?endforeach;?>
                    <!-- /section row -->
                </div>
              </div>
            </div>
          </div>
        </div>

    </div>
  </div>
</div>

<!-- Recent items carousel starts -->

<div class="recent-posts">
  <div class="container">
    <div class="row">
      <div class="span12">
        <div class="bor"></div>
        <h4 class="title">Recent Items</h4>
        <div class="carousel_nav pull-right">
          <!-- Navigation -->
          <a class="prev" id="car_prev" href="#"><i class="icon-chevron-left"></i></a>
          <a class="next" id="car_next" href="#"><i class="icon-chevron-right"></i></a>
        </div>
        <div class="clearfix"></div>
        <ul class="rps-carousel">
            <!-- Recent items #1 -->
            <!-- Each item should be enclosed inside "li"  tag. -->
            <?
                $limit = $this->BuilderEngine->get_option("be_classifieds_recent_items_count"); 
                $recent_items->order_by('time_of_creation', "DESC");
                $recent_items->limit($limit);
                $recent_items = $recent_items->get();?>
            <? foreach($recent_items as $product):?>
            <li>
                <div class="rp-item"> 
                  <div class="rp-image">    
                  <!-- Image -->    
                    <a href="/classifieds/view_item/<?=$product->id?>"><img src="<?=checkImagePath($product->img)?>"/></a>
                  </div>
                  <div class="rp-details">
                    <!-- Title and para -->
                    <h5><a style="color: #fff !important" href="<?=base_url()?>classifieds/view_item/<?=$product->id?>"><?=$product->name?><span class="price pull-right">
                      <? $currency = new Currency($product->currency_id);
                      if($currency->symbol_position == "before"):?>
                        <?=$currency->symbol?><?=number_format($product->price, 2, '.', ',')?></h5>
                      <? else:?>
                        <?=number_format($product->price, 2, '.', ',')?> <?=$currency->symbol?></h5>
                      <? endif;?></span></a></h5>
                    <div class="clearfix"></div>
                  </div>                
                </div>        
            </li>
            <? endforeach;?>                                     
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- Recent Posts ends -->

<!-- Newsletter starts -->

<!--<div class="container newsletter">
  <div class="row">
    <div class="span12">
      <div class="well">
               <h5><i class="icon-envelope-alt"></i> Hot Offers - Don't Miss Anything!!!</h5>
               <p>Nulla facilisi. Sed justo dui, scelerisque ut consectetur vel, eleifend id erat. Morbi auctor adipiscing tempor. Phasellus condimentum rutrum aliquet.</p>
               <form class="form-inline">
                  <div class="controls controls-row">
                    <input class="span3" type="text" placeholder="Enter your email to Subscribe">
                    <button type="submit" class="btn">Subscribe</button>
                  </div>
               </form>
      </div>
    </div>
  </div>
</div>-->

<!-- Newsletter ends -->
<script src="<?=base_url('modules/classifieds/js/custom.js')?>"></script>
<script src="<?=base_url('modules/classifieds/js/nav.js')?>"></script>
<script src="<?=base_url('modules/classifieds/js/jquery.carouFredSel-6.1.0-packed.js')?>"></script>
