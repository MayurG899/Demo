<? 
  class Classifieds_account_menu_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Classifieds";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "User Account Menu";
        $info['block_icon'] = "fa-envelope-o";
      
        return $info;
    }
    public function generate_admin()
    {

    }
    public function generate_content()
    {
        $CI = & get_instance();
        $CI->load->module('classifieds');
        global $active_controller;
        $user = $active_controller->user;
		$allowed_to_create_ads_groups = explode(',',$CI->BuilderEngine->get_option('be_classifieds_create_ads_groups'));

        if(!$user->is_guest())
        {
            $member = new ClassifiedsMember($user->id);
            $messages = new ClassifiedsMessage();
            $messages->where('to', $member->id)->where('viewed', 'no')->get();

            if($messages->exists())
            {
                $i = 0;
                foreach ($messages as $message)
                {
                  $i++;
                }
                $inbox = '<li style="height:31px"><a style="font-size: 15px;padding: 5px 10px;" class="category-element department-li" href="'.base_url('classifieds/inbox').'">Inbox (<p style="display:inline;color: red;font-weight:bold">'.$i.'</p>)</a></li>';
            }
            else
                $inbox = '<li style="height:31px"><a style="font-size: 15px;padding: 5px 10px;" class="category-element department-li" href="'.base_url('classifieds/inbox').'">Inbox</a></li>';

            $output = '
				<div class="classifieds-user-button-margin">
					<a class="btn btn-sm btn-default classifieds-btn classifieds-btn-user" id="open-user-panel">
						<div class="navbar-user classifieds-push-account-avatar">
							<b class="caret classifieds-caret-user pull-right"></b>
							Account <span class="classifieds-img-account-avatar"><img src="'.$user->get_avatar().'" alt="" /></span>
						</div>
					</a>
					<div class="col-sm-11 classifieds-user-panel-details" id="user-panel">
						<div class="panel classifieds-header-light animated fadeIn">
							<div id="user-panel-heading" class="panel-heading navbar-user-box classifieds-header-dark">Account Options</div>
							<div class="panel-body classifieds-panel-body-user-dropdown">
								<ul class="nav nav-pills nav-stacked classifieds-user-dropdown-space">';
								if($user->is_member_of_any($allowed_to_create_ads_groups))
									$output .='<li><a class="category-element department-li classifieds-user-dropdown-text" href="'.base_url('classifieds/create_item').'">Post New Ad</a></li>';
									$output .='
									<hr>
									<li><a class="category-element department-li classifieds-user-dropdown-text" href="'.base_url('classifieds/profile/'.$member->id).'">View Profile</a></li>
									<li><a class="category-element department-li classifieds-user-dropdown-text" href="'.base_url('cp/edit/'.$member->id).'">Edit Account</a></li>
									<li><a class="category-element department-li classifieds-user-dropdown-text" href="'.base_url('classifieds/placed_ads').'">Posted Ads</a></li>
									<li><a class="category-element department-li classifieds-user-dropdown-text" href="'.base_url('classifieds/my_watchlist').'">Watched Ads</a></li>
									<hr>
									'.$inbox.'
									<li><a class="category-element department-li classifieds-user-dropdown-text" href="'.base_url('classifieds/send_message').'">Send Message</a></li>
									<li><a class="category-element department-li classifieds-user-dropdown-text" href="'.base_url('classifieds/followed_users').'">Followed Sellers</a></li>
									<hr>
									<li><a class="category-element department-li classifieds-user-dropdown-text" href="'.base_url('cp/logout').'">Logout</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>';
        }
        else{
            $output = '
				<div class="classifieds-user-button-margin">
					<a class="btn btn-sm btn-default classifieds-btn classifieds-btn-user" id="open-user-panel">
						<div class="navbar-user">
							<b class="caret classifieds-caret-user pull-right"></b>
							<img src="'.$user->get_avatar().'" alt="" />Account 
						</div>
					</a>
					<div class="col-sm-11 classifieds-user-panel-details" id="user-panel">
						<div class="panel classifieds-header-light animated fadeIn">
							<div id="user-panel-heading" class="panel-heading navbar-user-box classifieds-header-dark">Login / Register</div>
							<div class="panel-body classifieds-panel-body-user-dropdown">
								<ul class="nav nav-pills nav-stacked">
									<li><a class="category-element department-li classifieds-user-dropdown-text" href="'.base_url('cp/login').'">Login</a></li>
									<li><a class="category-element department-li classifieds-user-dropdown-text" href="'.base_url('cp/register').'">Register</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>'; 
        }
		$output .='
			<script>
				$(document).ready(function(){
					$(".department-li").click(function(){
						$(".custom-child-subcategories").find(".active").removeClass("active");
					});
					$("#open-user-panel").click(function(){
						$("#user-panel").toggle();
					});
				});
			</script>
		';

        return $output;
    }
  }
?>

