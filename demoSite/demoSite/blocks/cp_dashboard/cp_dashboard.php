<?php
class Cp_dashboard_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Account Dashboard";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Account Dashboard - Dashboard";
        $info['block_icon'] = "fa-envelope-o";

        return $info;
    }

    public function generate_admin()
    {
		$this->show_placeholder();
    }
	
	 public function generate_style($active_menu = '')
    {
        
    }
    public function load_generic_styling()
    {
       
    }
	
	public function set_initial_values_if_empty()
    {
        $content = $this->block->data('content');

        if(!is_array($content) || empty($content))
        {
            $content = array();
            $content[0] = new stdClass();
            $content[0]->text = "Default Text";

            $this->block->set_data('content', $content, true);
        }
    }
	
    public function generate_content()
    {
		//Controller
		global $active_controller;
		$user = &$active_controller->user;
		$active_user = new User($user->get_id());
        $CI = & get_instance();
		$CI->load->module('cp');
		$this->load_generic_styles();
		$user->is_verified();
		
		$this->block->set_data("editorEnabled", 1);
		$CI->load->module('layout_system');
		$this->set_initial_values_if_empty();
		$content = $this->block->data('content');
        $single_element = '';

        //generic animations
        $this->load_generic_styles();
        //
		
		// Get blog posts
		$CI->load->module('blog');
		$posts = new Post();
		$posts->where('category_id', 2)->order_by('time_created', 'DESC')->limit(1)->get();
		// /Get blog posts
		
		$location_cache_id = "be_visitor_location_" . $_SERVER['REMOTE_ADDR'];
		$location = $CI->cache->fetch($location_cache_id);
		if ($location == null) {
			$location = $CI->cp->getLocation($_SERVER['REMOTE_ADDR']);
			$CI->cache->insert($location_cache_id, $location, 2678400);
		}
		$output = '';
        if(strpos($this->block->get_name(), 'custom-block-')  !== false)
        {
            $block_name = explode('-', $this->block->get_name());
            $block_id = $block_name[2];
        }
        else
            $block_id = $this->block->get_id();
        $output ='
		';
		foreach($content as $key => $element)
        {
			$suspended = false;
			$element = (object)$element;
			$output .='
		<div block-editor="ckeditor" block-name="'.$this->block->get_name().'" id="userdashboard-container-'.$this->block->get_id().'">
			<div id="be-uaccount-page-container" class="be-uaccount-main-pad">
			
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h3 class="user-account-title">Account Dashboard <small> Welcome '.$user->first_name.' '.$user->last_name.'</small></h3>
						</div>
						
						<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 beaccount-dashboard-box-col">
							<div class="panel panel-box-white">';
							if($suspended)
								$output .='<a href="'.base_url('cp/edit/'.$user->get_id()).'" type="button" class="btn btn-lg panel-box-white">';
							else
								$output .='<a href="'.base_url('cp/edit/'.$user->get_id()).'" type="button" class="btn btn-lg panel-box-white">';
								$output .='
									<div class="panel-heading panel-box-white">
										<h4 class="panel-title">My Account</h4>
									</div>
									<div class="panel-body panel-box-white">
										<p><i class="fa fa-edit fa-3x panel-box-icon-dashboard"></i>
											<br><b class="panel-box-lineheight">Account Settings</b><br>
											<small>Edit Account Details</small>
										</p>
									</div>
								</a>
							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 beaccount-dashboard-box-col">
						<div class="panel panel-box-white">';
							if($suspended)
								$output .='<a href="'.base_url('cp/user/'.$user->get_id()).'" type="button" class="btn btn-lg panel-box-white">';
							else
								$output .='<a href="'.base_url('cp/user/'.$user->get_id()).'" type="button" class="btn btn-lg panel-box-white">';
								$output .='
							<div class="panel-heading panel-box-white">
								<h4 class="panel-title">My Acount</h4>
							</div>
							<div class="panel-body panel-box-white">
								<p><i class="fa fa-user fa-3x panel-box-icon-dashboard"></i>
									<br><b class="panel-box-lineheight">My Profile</b><br>
									<small>View '.$user->first_name.' '.$user->last_name.'</small>
								</p>
							</div>
						</a>
						</div>
						</div>
						
						<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 beaccount-dashboard-box-col">
						<div class="panel panel-box-white"> 
						<a href="'.base_url('cp/orders').'" type="button" class="btn btn-lg panel-box-white">
							<div class="panel-heading panel-box-white">
								<h4 class="panel-title">My Account</h4>
							</div>
							<div class="panel-body panel-box-white">
								<p><i class="fa fa-money fa-3x panel-box-icon-dashboard"></i>
									<br><b class="panel-box-lineheight">Billing & Orders</b><br>
									<small>View Orders & Invoices</small>
								</p>
							</div>
						</a>
						</div>
						</div>
						
			<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 be-uaccount-box-news">
				<div id="account_rightside">
					<div class="row">

						<div class="panel panel-inverse panel-with-tabs">
							<div class="panel-heading be-uaccount-panel-news">
								<!-- begin nav-tabs -->
								<div class="tab-overflow">
									<ul class="nav nav-tabs nav-tabs-default">
										<li class="prev-button"><a href="javascript:;" data-click="prev-tab" class="text-primary"><i class="fa fa-arrow-left"></i></a></li>
										<li class="active"><a href="#nav-tab-0" data-toggle="tab">Latest News</a></li>
										<li class="next-button"><a href="javascript:;" data-click="next-tab" class="text-primary"><i class="fa fa-arrow-right"></i></a></li>
									</ul>
								</div>
							</div>
							<div class="tab-content">
								<div class="tab-pane fade active in" id="nav-tab-0">';
									foreach($posts as $post){
										$output .='
										<div class="col-md-12 blog-news-entry">
											<div class="row">
												<a href="'.base_url('blog/post/'.$post->slug).'">
													<h3>'.$post->title.'</h3>
												</a>
												<a class="blog-news-image" href="'.base_url('blog/post/'.$post->slug).'">
													<img src="'.$post->image.'">
												</a>
											</div>
											<div class="row be-uaccount-newsdate">
												<p>'.date('d/M/Y', $post->time_created).'</p>
											</div>
											<div class="row">
												<p>
													'.substr($post->text, 0, 250).'...'.'
												</p>
											</div>
											<div class="row">
												<p class="blog-news-desc">
												<a class="btn btn-sm btn-success-news" href="'.base_url('blog/post/'.$post->slug).'">Read More</a>
												</p>
											</div>
										</div>';
									}
								$output .='
								</div>					   
							</div>
						</div>
					</div>
					<!-- end panel -->
				</div>	
			</div>
			<!-- end news -->
						
				<!-- end -->
			</div>
			<!-- end #content -->
		</div>
		';
        }
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='global_style';
		else
			$menu ='style';
		if(!$user->is_guest()){
			if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
				return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'userdashboard-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
			else
				return $output;
		}
    }
}
?>