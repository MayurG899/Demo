<link href="<?=base_url('modules/classifieds/assets/css/theme.css')?>" rel="stylesheet">
<link href="<?=base_url('modules/classifieds/assets/css/style.css')?>" rel="stylesheet">

<style>
@media(max-width:480px){
  .responsive-label
  {
    width: auto !important;
  }
  .responsive-input
  {
    width:100% !important;
  }
}
</style>
<div class="items">
  <div class="container">
    <div class="row">

      <div class="span3">
        <?if($this->user->is_guest()):?>
          <h5 class="title"><a href="<?=base_url('/classifieds/login')?>">User section</a></h5>
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
        <? endif;?>

      </div>
      <div class="span9">
        <h4 class="title" style="margin-bottom: 20px">Tell a friend</h4>
        <p style="font-size: 12px; margin-bottom: 20px">Tell a friend about <a href="<?=base_url('/classifieds/view_item/'.$item->id)?>"><strong>"<?=$item->name?>"</strong></a> on Gbanjo.</p>
        <form class="form-horizontal" method="post" >
          <?//if($this->user->is_guest())?> 
          <div class="control-group" style="margin-bottom: 10px">
            <label class="control-label responsive-label" style="width: 30%; margin-right: 10px;"for="name">Your friend's name:</label>
            <div class="controls" style="width: 80%">
              <input class="responsive-input" style="width: 70%;" type="text" name="friend_name" placeholder="friend name" required>
            </div>
          </div> 
          <div class="control-group" style="margin-bottom: 10px">
            <label class="control-label responsive-label" style="width: 30%; margin-right: 10px;"for="name">Your friend's email:</label>
            <div class="controls" style="width: 80%">
              <input class="responsive-input" style="width: 70%;" type="text" name="friend_email" placeholder="friend email address" required>
            </div>
          </div>
          <div class="control-group" style="margin-bottom: 10px">
            <label class="control-label responsive-label" style="width: 30%; margin-right: 10px;"for="name">Your name:</label>
            <div class="controls" style="width: 80%">
              <input class="responsive-input" style="width: 70%;" type="text" name="name" placeholder="name" required <?if (isset($member->name)) echo 'value="'.$member->name.'"';?>>
            </div>
          </div> 
          <div class="control-group" style="margin-bottom: 10px">
            <label class="control-label responsive-label" style="width: 30%; margin-right: 10px;"for="name">Your email:</label>
            <div class="controls" style="width: 80%">
              <input class="responsive-input" style="width: 70%;" type="text" name="email" placeholder="email address" required <?if (isset($member->email)) echo 'value="'.$member->email.'"';?>>
            </div>
          </div>
          <div class="control-group" style="margin-bottom: 10px">
            <label class="control-label responsive-label" style="width: 30%; margin-right: 10px;"for="name">A message for your friend:</label>
            <div class="controls" style="width: 80%">
              <textarea class="responsive-input input-large" style="width: 70%;" name="message" placeholder="message" style="height:100px"></textarea>
              <input type="hidden" name="time_of_creation" value="<?=date('H:i:s d/m/Y ')?>">
            </div>
          </div>
          <div class="form-actions" style="padding-left: 30px">
            <button type="submit" class="btn">Post</button>
            <button type="reset" class="btn">Reset</button>
          </div>
        </form>
        <p><strong>Privacy:</strong> We only use this information to send one email to your friend.</p>
      </div>
    </div>
  </div>
</div>
<script src="<?=base_url('modules/classifieds/js/custom.js')?>"></script>
<script src="<?=base_url('modules/classifieds/js/nav.js')?>"></script>