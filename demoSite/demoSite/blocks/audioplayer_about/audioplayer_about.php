<?php
class Audioplayer_about_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Audio Player";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "About Content";
        $info['block_icon'] = "fa-envelope-o";

        return $info;
    }
    public function generate_admin()
    {
    }
    public function generate_style()
    {
    }
    public function generate_content()
    {
		//Controller
		global $active_controller;
		$user = &$active_controller->user;
        $CI = & get_instance();
        $CI->load->module('audioplayer');
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		$username = $segments[$count-2];
		$owner = new User();
		$channel_owner = $owner->where('username',$username)->get();	
		$owner_settings = $CI->audioplayerusersettings->where('user_id',$channel_owner->id)->get();
		$views = $CI->visits
			->where('page','audioplayer/channel/'.$username.'')
			->or_where('page','audioplayer/channel/'.$username.'/photos')
			->or_where('page','audioplayer/channel/'.$username.'/albums')
			->or_where('page','audioplayer/channel/'.$username.'/discussion')
			->or_where('page','audioplayer/channel/'.$username.'/about')
		->count();
		$followers = $CI->audioplayerfollow->where('following_id',$channel_owner->id)->count();
		if($followers < 1)
			$followers = 0;
		//View
        $output ='<!-- Work Detail Section -->
				<!-- work Filter -->
				<div class="row">
					<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
						<h2 class="text-center">About '.$channel_owner->first_name.' '.$channel_owner->last_name.'</h2>
						<div class="well audioplayer-about-text-area">';
						$output .='	<p>'.str_replace('\n','',$owner_settings->about).'</p>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
						<p class=""><b>Name:</b> '.$channel_owner->first_name.' '.$channel_owner->last_name.'</p>
						<p class=""><b>Username:</b> '.$channel_owner->username.'</p>
						<p class=""><b>Followers:</b> '.number_format($followers).'</p>
						<p class=""><b>Channel Views:</b> '.number_format($views).'</p>
						<p class=""><b>Joined:</b> '.date('d.m.Y',$channel_owner->date_registered).'</p>
						<p class=""><b>Location:</b> '.$channel_owner->extended->get()->country.'</p>
					</div>
                </div>
        <!-- End Work Detail Section -->';

        return $output;
    }
}
?>