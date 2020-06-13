<?php
/***********************************************************
 * BuilderEngine Community Edition v1.0.0
 * ---------------------------------
 * BuilderEngine CMS Platform - BuilderEngine Limited
 * Copyright BuilderEngine Limited 2012-2017. All Rights Reserved.
 *
 * http://www.builderengine.com
 * Email: info@builderengine.com
 * Time: 2017-01-17 | File version: 1.0.0
 *
 ***********************************************************/

if (!defined('BASEPATH')) exit('No direct script access allowed');


class Admin_main extends BE_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */

    public function Admin_main()
    {
        parent::__construct();

        if ($this->uri->segment(3) != 'login' && $this->uri->segment(3) != 'recover_password' && $this->uri->segment(3) != 'approve_account' && $this->uri->segment(3) != 'logout') {

            $this->user->require_group("Administrators");
        } else if ($this->uri->segment(3) == 'login')
            if ($this->user->is_logged_in())
                redirect("/admin/main/dashboard", 'location');
    }

    public function are_tutorials_active()
    {
        $tutorials = new Tutorial();
        foreach($tutorials->get() as $tutorial)
        {
            if($tutorial->display != 'hidden')
                return true;
        }
        return false;
    }

    public function dashboard()
    {
		if(!$this->is_cms()){
			$this->load->library('../controllers/Admin_cloud');
			$data['subscription_status'] = $this->admin_cloud->check_subscription_status();
		}
        $countries = $this->BuilderEngine->getcountries();
        $countriesArr = Array();
        $n = 0;
        foreach ($countries as $c) {
            $countriesArr[$n]['ip'] = $c->ip;
            $countriesArr[$n]['count'] = $c->count;
            $n++;
        }

        $countryFullNamesArr = Array();
        $arrCountries = array();
        $arr = array();
        $k = 0;
        foreach ($countriesArr as $ca) {

            $ip = $ca['ip'];
            $apiurl = 'http://ip-api.com/json/'.$ip;

            /* try this code for new fersion php */
            // $res = file_get_contents($apiurl);

            /* try this code for new fersion php */
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $apiurl);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            $res = curl_exec($ch);
            curl_close($ch);

            $res = json_decode($res);

            if(isset($res->status)
                && isset($res->country)
                && isset($res->countryCode)
                && $res->status == 'success'){

                $arr[$k][] = $res->country;
                $countryFullNamesArr[$k]['name'] = $res->country;
                $arrCountries[$res->countryCode] = '#00acac';

                $countOfVisits = $this->BuilderEngine->getVisitsByIp($ip);
                $countryFullNamesArr[$k]['count'] = $countOfVisits;
                $k++;
            }
        }

        /*Get's only unique countries*/
        $countryUnique = Array();
        foreach ($countryFullNamesArr as $val) {
            $countryUnique[] = $val['name'];
        }
        $countryUnique = array_unique($countryUnique);

        $j = 0;
        $arrCounts = Array();

        /*Sum up all countries by their visitors' count*/

        foreach ($countryFullNamesArr as $key => $val) {
            $sum = 0;
            foreach ($countryUnique as $c) {
                if ($val['name'] == $c) {
                    $sum += $val['count'];
                    if (!isset($arrCounts[$c])) {
                        $arrCounts[$c] = $sum;
                    } else {
                        $arrCounts[$c] += $sum;
                    }
                }
            }

            if (count($arrCounts) > 2) {
                break;
            }
            $j++;
        }

        $jsonCountries = json_encode($arrCountries);
        $data['countryNamesArr'] = $jsonCountries;
        $data['arrCounts'] = $arrCounts;

        $todayvisitorscount = $this->BuilderEngine->todayvisitorscount();
        $data['todayvisitorscount'] = $todayvisitorscount;

        $lastweekvisitorscount = $this->BuilderEngine->lastweekvisitorscount();
        $data['lastweekvisitorscount'] = $lastweekvisitorscount;

        $all_users_count = $this->BuilderEngine->getuserscount();
        $todays_users_count = $this->BuilderEngine->getuserscount(true);
        $data['all_users_count'] = $all_users_count;
        $data['todays_users_count'] = $todays_users_count;

        # return data

        $this->show->set_default_breadcrumb(0, "Dashboard", "");
        $current_version = $this->BuilderEngine->get_option('version');

        $remote_version = $this->cache->fetch("latest_be_version");

        if ($remote_version == null) {
            $remote_version = file_get_contents("http://update-server.builderengine.com/check.php?version=" . $current_version);
            $this->cache->insert("latest_be_version", $remote_version, 120);
        }

        $location_cache_id = "be_visitor_location_" . $_SERVER['REMOTE_ADDR'];
        $location = $this->cache->fetch($location_cache_id);
        if ($location == null) {
            $location = $this->getLocation($_SERVER['REMOTE_ADDR']);
            $this->cache->insert($location_cache_id, $location, 2678400);
        }

        $weather_cache_id = "be_admin_weather_forecast_" . md5(serialize($location));
        $weather = $this->cache->fetch($weather_cache_id);
        if ($weather == null && $weather = $this->getWeather($location)) {
            $this->cache->insert($weather_cache_id, $weather, 3600);
        }

        $data['weather'] = $weather;
		if(!$this->is_cms()){
			$this->load->library('../controllers/Admin_cloud');
			if($this->check_cms_update() == true){
				$this->admin_cloud->update_cloud();
			}
		}
        $data['update_available'] = $this->check_cms_update();
		$data['current_page'] = '';
        $data['statistics']['todays'] = $all_visits = $this->BuilderEngine->get_site_visits("all", 10, true);
        $data['statistics']['total_blogs'] = $this->BuilderEngine->getBlogCount();
        $data['statistics']['total_comments'] = $this->BuilderEngine->getBlogCommentsCount();
		$data['statistics']['total_ecommerce_orders'] = $this->BuilderEngine->getTotalEcommerceOrdersCount();
		$data['statistics']['todays_ecommerce_orders'] = $this->BuilderEngine->getTodayEcommerceOrdersCount();
		$data['statistics']['total_users_count'] = $this->BuilderEngine->getTotalUsersCount();
		$data['statistics']['total_ecommerce_revenue'] = $this->BuilderEngine->getTotalEcommerceRevenue();
		$data['statistics']['todays_ecommerce_revenue'] = $this->BuilderEngine->getTodayEcommerceRevenue();
        $data['tutorials_active'] = $this->are_tutorials_active();
		
		if($this->BuilderEngine->get_option('admin_dashboard_selection') != 'default')
			$this->show->backend('dashboard_'.$this->BuilderEngine->get_option('admin_dashboard_selection'), $data);
		else
			$this->show->backend('dashboard', $data);
    }

	public function statistics()
	{
        $countries = $this->BuilderEngine->getcountries();
        $countriesArr = Array();
        $n = 0;
        foreach ($countries as $c) {
            $countriesArr[$n]['ip'] = $c->ip;
            $countriesArr[$n]['count'] = $c->count;
            $n++;
        }

        $countryFullNamesArr = Array();
        $arrCountries = array();
        $arr = array();
        $k = 0;
        foreach ($countriesArr as $ca) {

            $ip = $ca['ip'];
            $apiurl = 'http://ip-api.com/json/'.$ip;

            /* try this code for new fersion php */
            // $res = file_get_contents($apiurl);

            /* try this code for new fersion php */
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $apiurl);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            $res = curl_exec($ch);
            curl_close($ch);

            $res = json_decode($res);

            if(isset($res->status)
                && isset($res->country)
                && isset($res->countryCode)
                && $res->status == 'success'){

                $arr[$k][] = $res->country;
                $countryFullNamesArr[$k]['name'] = $res->country;
                $arrCountries[$res->countryCode] = '#00acac';

                $countOfVisits = $this->BuilderEngine->getVisitsByIp($ip);
                $countryFullNamesArr[$k]['count'] = $countOfVisits;
                $k++;
            }
        }

        /*Get's only unique countries*/
        $countryUnique = Array();
        foreach ($countryFullNamesArr as $val) {
            $countryUnique[] = $val['name'];
        }
        $countryUnique = array_unique($countryUnique);

        $j = 0;
        $arrCounts = Array();

        /*Sum up all countries by their visitors' count*/

        foreach ($countryFullNamesArr as $key => $val) {
            $sum = 0;
            foreach ($countryUnique as $c) {
                if ($val['name'] == $c) {
                    $sum += $val['count'];
                    if (!isset($arrCounts[$c])) {
                        $arrCounts[$c] = $sum;
                    } else {
                        $arrCounts[$c] += $sum;
                    }
                }
            }

            if (count($arrCounts) > 2) {
                break;
            }
            $j++;
        }

        $jsonCountries = json_encode($arrCountries);
        $data['countryNamesArr'] = $jsonCountries;
        $data['arrCounts'] = $arrCounts;

        $todayvisitorscount = $this->BuilderEngine->todayvisitorscount();
        $data['todayvisitorscount'] = $todayvisitorscount;

        $lastweekvisitorscount = $this->BuilderEngine->lastweekvisitorscount();
        $data['lastweekvisitorscount'] = $lastweekvisitorscount;

        $all_users_count = $this->BuilderEngine->getuserscount();
        $todays_users_count = $this->BuilderEngine->getuserscount(true);
        $data['all_users_count'] = $all_users_count;
        $data['todays_users_count'] = $todays_users_count;

        $data['statistics']['todays'] = $all_visits = $this->BuilderEngine->get_site_visits("all", 10, true);
        $data['statistics']['total_blogs'] = $this->BuilderEngine->getBlogCount();
        $data['statistics']['total_comments'] = $this->BuilderEngine->getBlogCommentsCount();
		$data['statistics']['total_ecommerce_orders'] = $this->BuilderEngine->getTotalEcommerceOrdersCount();
		$data['statistics']['todays_ecommerce_orders'] = $this->BuilderEngine->getTodayEcommerceOrdersCount();
		$data['statistics']['total_users_count'] = $this->BuilderEngine->getTotalUsersCount();
		$data['statistics']['total_ecommerce_revenue'] = $this->BuilderEngine->getTotalEcommerceRevenue();
		$data['statistics']['todays_ecommerce_revenue'] = $this->BuilderEngine->getTodayEcommerceRevenue();

		$data['user_agents'] = $this->BuilderEngine->get_all_user_agents();
		$data['platforms'] = $this->BuilderEngine->get_all_platforms();
		$data['devices'] = $this->BuilderEngine->get_all_devices();
		$data['referrers'] = $this->BuilderEngine->get_all_referrers();
		$data['current_page'] = 'analytics';
		$this->show->backend('website_statistics', $data);
	}
	
	public function statisticsmodules()
	{
		$data['current_page'] = 'analytics';
		$data['user_agents'] = $this->BuilderEngine->get_all_user_agents();
		$data['platforms'] = $this->BuilderEngine->get_all_platforms();
		$data['devices'] = $this->BuilderEngine->get_all_devices();
		$data['referrers'] = $this->BuilderEngine->get_all_referrers();
		$this->show->backend('website_statistics_modules', $data);
	}

    public function check_cms_update()
    {
		if($this->is_cms()){
			$updates = json_decode($this->update_check());
		}else{
			$this->load->library('../controllers/Admin_cloud');
			$updates = $this->admin_cloud->update_cloud_check();
		}

        if(isset($updates->result) && isset($updates->available_updates) 
            && ($updates->result && $updates->available_updates > 0)){
            $this->user->alert("Website Update is available.", "".base_url()."admin/update/index", "fa-download", "be-update");
            return true;
        }else{
            $this->load->model('alert');
            $this->alert->where(array('user_id' => $this->user->get_id(),'text' => 'Website Update is available.'))->get();
            $this->alert->delete();
            return false;
        }
    }

    public function login()
    {
        if (isset($_POST['forgot'])) {
            $this->users->send_password_reset_email(urldecode($_POST['email']));
        }
        $this->load->model("builderengine");
        $data['builderengine'] = &$this->builderengine;
		/*
        if($data['builderengine']->get_option('background_img'))
            $url = base_url($data['builderengine']->get_option('background_img'));
        else
		*/
		$url = get_theme_path()."assets/img/login-bg/bg-2.jpg";
		$option = $this->BuilderEngine->get_option('user_login_option');
		if($option == 'both')
			$data['placeholder'] = 'Username or Email Address';
		if($option == 'email')
			$data['placeholder'] = 'Email Address';
		if($option == 'username')
			$data['placeholder'] = 'Username';		
        $data['url'] = $url;
        $data['login'] = true;
        $this->show->backend('index', $data);
    }

    public function approve_account($token = false)
    {
        $this->users->validate_registration_token($token);
        if (!$token) {
            redirect(base_url('/'), 'location');
        }
        $user = $this->users->activation_account($token);
		$this->users->approve_module_access($user->id);
        $this->user->initialize($user->id);
        redirect(base_url('/login'), 'location');
    }

    public function recover_password($token = FALSE)
    {

        $this->users->validate_password_reset_token($token);
        if (!$token)
		{
            redirect(base_url('/'), 'location');
        }
		
        $data['error'] = false;
		
        if ($_POST && $token)
		{
            if ($_POST['password'] == $_POST['password_re'])
			{
                $this->users->reset_password($token, $_POST['password']);
                redirect(base_url('/admin/main/login'), 'location');
            }
			else
				$data['error'] = true;
        }

        $this->load->model("builderengine");
        $data['builderengine'] = &$this->builderengine;
        $data['url'] = get_theme_path()."assets/img/login-bg/bg-2.jpg";
        $data['token'] = $token;
		$data['current_page'] = 'reset_password';
        $this->show->user_backend('reset_password',$data);
    }

    public function settings()
    {
        $this->show->set_default_breadcrumb(0, "Settings", "");
        $this->show->set_default_breadcrumb(1, "General", "");
        $this->load->model("builderengine");

        if (isset($_POST['erase_content_control'])){
            foreach ($_POST as $key => $value) {
                $this->builderengine->set_option($key, $value);
            }
			
			$allowed_groups = array();
			$default_groups = explode(',',$_POST['default_website_access_group']);
			$groups = new Group();
			$module_permissions = new Group_permission();
			
			foreach($default_groups as $default_group){
				$group = $groups->where('name',$default_group)->get();
				array_push($allowed_groups,$group->id);
			}

			foreach($allowed_groups as $allowed_group){
				$module_permission = $module_permissions->where('module_id',1)->where('access','frontend')->where('group_id',$allowed_group)->get();
				if($module_permission->group_id != $allowed_group && $allowed_group != 1){
					$new_permission = new Group_permission();
					$new_permission->module_id = 1;
					$new_permission->group_id = $allowed_group;
					$new_permission->access = 'frontend';
					$new_permission->save();
				}
				else{
					$permissions = new Group_permission();
					$existing_groups = explode(',',$_POST['default_website_access_group']);
					foreach($permissions->where('module_id',1)->where('access','frontend')->get() as $permission){
						if(!in_array($permission->group_id,$existing_groups) && $permission->group_id != 1){
							$permission->delete();
						}
					}
				}
			}
			$https_on_line1 = "RewriteCond %{HTTPS} !=on";
			$https_on_line2 = "RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]";
			$https_off_line1 = "#RewriteCond %{HTTPS} !=on";
			$https_off_line2 = "#RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]";
			$path_to_file = '.htaccess';
			$file_contents = file_get_contents($path_to_file);
			if($_POST['force_https'] == 'off'){
				$file_contents = str_replace($https_on_line1,$https_off_line1,$file_contents);
				$file_contents = str_replace($https_on_line2,$https_off_line2,$file_contents);
			}else{
				$file_contents = str_replace($https_off_line1,$https_on_line1,$file_contents);
				$file_contents = str_replace($https_off_line2,$https_on_line2,$file_contents);
			}
			file_put_contents($path_to_file,$file_contents);
		}
		if(isset($_POST['admin_dashboard_selection'])){
            foreach ($_POST as $key => $value) {
                $this->builderengine->set_option($key, $value);
            }
			redirect(base_url('admin'),'location');
		}
		if(isset($_POST['facebook_login'])){
            foreach ($_POST as $key => $value) {
                $this->builderengine->set_option($key, $value);
            }
			redirect(base_url('admin'),'location');
		}
        $data['current_page'] = 'settings';
        $data['builderengine'] = &$this->builderengine;
		$data['erase_content_control'] = $this->builderengine->get_option('erase_content_control');
 		$data['default_website_access_groups'] = $this->builderengine->get_option('default_website_access_group');
		$data['force_https'] = $this->builderengine->get_option('force_https');
		$data['facebook_login'] = $this->builderengine->get_option('facebook_login');
		$data['facebook_app_id'] = $this->builderengine->get_option('facebook_app_id');
		$data['facebook_app_secret'] = $this->builderengine->get_option('facebook_app_secret');
		$data['admin_dashboard_selection'] = $this->builderengine->get_option('admin_dashboard_selection');
		$data['admin_theme_color_pattern'] = $this->builderengine->get_option('admin_theme_color_pattern');
		$data['admin_left_sidebar_minimized'] = $this->builderengine->get_option('admin_left_sidebar_minimized');
		$data['login_count_attempts'] = $this->builderengine->get_option('login_count_attempts');
		$data['login_max_attempts'] = $this->builderengine->get_option('login_max_attempts');
		$data['login_attempt_expire'] = $this->builderengine->get_option('login_attempt_expire');
		$data['notify_admin_about_banned_user'] = $this->builderengine->get_option('notify_admin_about_banned_user');
		$data['tutorials_active'] = $this->are_tutorials_active();
		$data['google_maps_api_key'] = $this->builderengine->get_option('google_maps_api_key');
		$this->show->backend('settings', $data);
    }

    public function seo_settings()
    {
        $this->show->set_default_breadcrumb(0, "Settings", "");
        $this->show->set_default_breadcrumb(1, "Search Engine", "");
        $this->load->model("builderengine");

        if ($_POST) {
			$this->builderengine->set_option('website_title', $_POST['website_title']);
			$this->builderengine->set_option('website_keywords', $_POST['website_keywords']);
			$this->builderengine->set_option('website_description', $_POST['website_description']);
            $this->builderengine->set_option('google_analytics_code', $_POST['google_analytics_code']);
        }

        $data['current_page'] = 'analytics';
        $data['builderengine'] = &$this->builderengine;
        $this->show->backend('seo_settings', $data);
    }

	public function add_social_link()
	{
		if($_POST){
			//$this->upload_image('social_images',$_POST['image']);
			$socialLink = new SocialLink();
			$socialLink->create($_POST);
			redirect(base_url('admin/main/show_social_links'),'location');
		}
        $data['current_page'] = 'settings';
		$data['current_child_page'] = 'social_links';
        $this->show->backend('add_social_link', $data);
	}

	public function edit_social_link($id)
	{
		$socialLink = new SocialLink();
		$socialLink = $socialLink->where('id',$id)->get();
		if($_POST){
			$socialLink->create($_POST);
			redirect(base_url('admin/main/show_social_links'),'location');
		}
		$data['socialLink'] = $socialLink;
        $data['current_page'] = 'settings';
		$data['current_child_page'] = 'social_links';
        $this->show->backend('edit_social_link', $data);
	}

	public function delete_social_link($id)
	{
		$socialLink = new SocialLink();
		$socialLink = $socialLink->where('id',$id)->get();
		$socialLink->delete();
		redirect(base_url('admin/main/show_social_links'),'location');
	}

	public function show_social_links()
	{
		$socialLink = new SocialLink();
		$data['social_links'] = $socialLink->get();
        $data['current_page'] = 'settings';
		$data['current_child_page'] = 'social_links';
        $this->show->backend('show_social_links', $data);
	}

    public function search($keyword = '')
    {
        if ($_POST) {
            redirect(base_url('admin/main/search/'.$_POST['keyword']),'location');
        }
        if (isset($keyword) && $keyword != '')
            $data['keyword'] = $keyword;
        else
            $data['keyword'] = '';
        $this->show->backend('search', $data);
    }

    public function logout()
    {
        $this->user->logout();
        redirect("/admin/main/login", 'location');
    }

    public function verify_login($user, $pass)
    {
        $user = $this->users->verify_admin_login($user, $pass);
        if ($user != 0) {
            $this->user->initialize($user);
            echo "success";
        } else
            echo "fail";
    }

    function getCurrentWeather($city)
    {
        $url = "http://api.openweathermap.org/data/2.5/weather?q=$city&mode=json&units=metric";
        $json = @file_get_contents($url);
        $weatherData = json_decode($json, true);
        return $weatherData;
    }

    function getWeatherIconClass($weather)
    {
        switch (substr($weather, 0, 2)) {
            case "01":
                if ($weather == "01d")
                    return "i-sun-2 orange";
                else
                    return "i-moon ";
                break;
            case "02":
                return "i-cloud";
                break;

            case "03":
                return "i-cloud-2 dark";
                break;

            case "04":
                return "i-cloud-2 dark";
                break;

            case "09":
                return "i-weather-rain dark";
                break;

            case "10":
                return "i-weather-rain blue";
                break;
            case "11":
                return "i-weather-lightning red-smooth";
                break;

            case "13":
                return "i-weather-snow blue";
                break;


            default:
                return "";
                break;
        }
    }


    function getLocation($ip)
    {
        $url = "http://ip-api.com/json/" . $ip;
        $json = file_get_contents($url);

        $ip_data = json_decode($json, true);
        return $ip_data;
    }

    function getWeather($id)
    {
         if(!empty($id) && !empty($id['city']))
         {
             $current_weather = $this->getCurrentWeather($id['city'].",".$id['countryCode']);
             $result['location'] = $id['city'].", ".$id['country'];
             $result['now']['temp'] = round($current_weather['main']['temp']);
             $result['now']['code'] = $current_weather['weather'][0]['icon'];
             $result['now']['icon_class'] = $this->getWeatherIconClass($result['now']['code']);

             $url = 'http://api.openweathermap.org/data/2.5/forecast/daily?q='.$id['city'].",".$id['countryCode'].'&mode=json&units=metric&cnt=7';

             $json = @file_get_contents($url);

             $weatherData = json_decode($json, true);

             for($i = 1; $i < 7; $i++){
                 $result[$i]['time'] = $weatherData['list'][$i]['dt'];
                 $result[$i]['temp']['min'] = ceil($weatherData['list'][$i]['temp']['min']);
                 $result[$i]['temp']['max'] = floor($weatherData['list'][$i]['temp']['max']);
                 $result[$i]['code'] = $weatherData['list'][$i]['weather'][0]['icon'];
                 $result[$i]['icon_class'] = $this->getWeatherIconClass($result[$i]['code']);

             }

             //$result['now']['type'] = $weatherData['list'][0]
             return $result;
         }
    }

    function weather()
    {
        error_reporting(0);
        Header('Content-Type: text/html; charset=utf-8');

        $weather = $this->getWeather('Sofia'); // id нужного города
        file_put_contents('weather.png', file_get_contents($weather['img'])); // сохраним картинку погоды для вывода в качество иконки для notify-send.

        echo $weather['name'] . "\n";
        echo $weather['now']['temp'] . " °C\n";
        echo "Now: \n";
        echo "Clouds: " . $weather['clouds'] . "% \n";
        echo "Pressure: " . $weather['pressure'] . " hpa \n";
        echo "Humidity: " . $weather['humidity'] . "% \n";
    }

	function upload_image($folder,$filename)
	{
		if(!is_dir("files"))
			mkdir("files");

		if(!is_dir("files/".$folder))
			mkdir("files/".$folder);


		$this->load->library('upload');

		$file = 'image';
		// Check if there was a file uploaded - there are other ways to
		// check this such as checking the 'error' for the file - if error
		// is 0, you are good to code

		// Specify configuration for File
		$config['upload_path'] = 'files/'.$folder.'/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = '11100';
		$config['max_width']  = '22048';
		$config['max_height']  = '22048';
		$config['overwrite']  = true;

		// Initialize config for File
		$this->upload->initialize($config);

		// Upload file
		if ($this->upload->do_upload($filename))
		{
			$result = $this->upload->data();
		} 
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */