<link href="<?=base_url('modules/classifieds/assets/css/bootstrap.css')?>" rel="stylesheet">
<link href="<?=base_url('modules/classifieds/assets/css/theme.css')?>" rel="stylesheet">
<link href="<?=base_url('modules/classifieds/assets/css/style.css')?>" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

<div class="items">
  <div class="container">
    <div class="row">
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
      <div class="span8">
        <h5 class="title">Users following you</h5>
        <?$i = 0;?>
       	<? foreach($following as $follow)
       	{
       		$i++;
       	}?>
  	    <? if ($i <= 0):?>
  	      <h5 class="title">THere are no users following you.</h5>
  	    <?else:?>
          <? foreach($following as $follow):?>
			    	<div class="row">
				    	<div class="span8">
                <div class="row-fluid">
					    		<? $following_member = new ClassifiedsMember($follow->following_user);
						      $following_member_extend = $following_member->classifieds_member_extend->get();
						      ?>
			       			<div class="span4">
				       			<h4><?=$following_member->username?></h4>
				       		</div>
				          <div class="span8">
                    <div class="btn-group">
				       			  <a class="btn btn-primary" href="<?=base_url('/classifieds/send_message?username='.$following_member->username)?>">Send a message</a>
				       			  <a class="btn btn-success" href="<?=base_url('classifieds/profile/'.$following_member->id);?>">View profile</a>
                      <? $following_member->id;
                      $this->user->get_id();
                      $following = new ClassifiedsFollowing();
                      $following->where('following_user', $this->user->get_id());
                      $following->where('followed_user', $following_member->id);
                      $following->get();
                      $i = 0;
                      foreach ($following as $follow)
                      {
                        $i++;
                      }?>
                      <? if($i > 0):?>
                        <a class="btn btn-warning" href="#" disabled>Following</a>
                      <? else:?>
                        <a class="btn btn-warning" style="width: 57px" href="<?=base_url('classifieds/follow_user/'.$following_member->id);?>">Follow</a>
                      <? endif;?>
				       		  </div>
                  </div>
                </div>
				      </div>
				   	</div>
          <?endforeach;?>
		    <?endif;?> 
			</div>
    </div>
  </div>
</div>
<br><br><br><br>

<script src="<?=base_url('modules/classifieds/js/custom.js')?>"></script>
<script src="<?=base_url('modules/classifieds/js/nav.js')?>"></script>