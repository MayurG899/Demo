<? 
  class Classifieds_user_menu_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Classifieds";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "User Menu";
        $info['block_icon'] = "fa-envelope-o public";
      
        return $info;
    }
    public function generate_admin()
    {
		$this->show_placeholder();
    }
    public function generate_content()
    {
        $CI = & get_instance();
        $CI->load->module('classifieds');
        global $active_controller;
        $this->user = $active_controller->user;
		$this->load_generic_styles();
		$single_element = '';
		$allowed_to_create_ads_groups = explode(',',$CI->BuilderEngine->get_option('be_classifieds_create_ads_groups'));
		$allowed_to_buy_groups = explode(',',$CI->BuilderEngine->get_option('be_classifieds_shop_groups'));

        if(!$this->user->is_guest())
        {
            $member = new ClassifiedsMember($this->user->get_id());
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
            <div id="classifieds-usermenu-items-container-'.$this->block->get_id().'" class="">
			<div class="panel classifieds-header-light animated fadeIn">
                <div id="user-panel-heading" class="panel-heading navbar-user-box classifieds-header-dark">Account Options</div>
                <div class="panel-body classifieds-panel-body-user-dropdown">
                    <ul class="nav nav-pills nav-stacked classifieds-user-dropdown-space">';
					if($this->user->is_member_of_any($allowed_to_create_ads_groups))
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
		</div>';
        }
        else
           $output = '
            <div id="classifieds-usermenu-items-container-'.$this->block->get_id().'">
			<div class="panel classifieds-header-light animated fadeIn">
                <div id="user-panel-heading" class="panel-heading navbar-user-box classifieds-header-dark">Login / Register</div>
                <div class="panel-body classifieds-panel-body-user-dropdown">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a class="category-element department-li classifieds-user-dropdown-text" href="'.base_url('cp/login').'">Login</a></li>
                        <li><a class="category-element department-li classifieds-user-dropdown-text" href="'.base_url('cp/register').'">Register</a></li>
                    </ul>
                </div>
            </div>
		</div>'; 
        

        if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'classifieds-usermenu-items-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output;
    }
  }
?>

