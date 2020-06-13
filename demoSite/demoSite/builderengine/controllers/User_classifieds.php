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


class User_classifieds extends BE_Controller
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
    function __construct()
    {
        parent::__construct();
		/*
        $this->user->is_verified();
        $this->load->model('builderengine');
        if($this->builderengine->get_option('user_dashboard_activ') != 'yes')
            redirect("/", 'location');
        if($this->builderengine->get_option('user_dashboard_classifieds') != 'yes')
            redirect("user/main/dashboard", 'location');
		*/
		if($this->user->is_logged_in())
			redirect(base_url("cp/dashboard"), 'location');
		else
			redirect(base_url("cp/login"), 'location');
    }

	public function my_watchlist()
	{
		$user = new ClassifiedsMember($this->user->get_id());
		$user_extend = $user->classifiedsmemberextend->get();
		if($user_extend->registration_completed != 'yes')
			redirect(base_url('classifieds/not_authenticated'), 'location');

		$member = new ClassifiedsMember($this->user->get_id());

		if(isset($_GET['delete_item_id']))
		{
			$item_id = $_GET['delete_item_id'];

			$item = new ClassifiedsItem($item_id);
			$member->delete_watchlist($item);

			redirect(base_url('user/classifieds/my_watchlist'), 'location');
		}
		
		$data['current_page'] = 'Watched items';
		$data['member'] = $member;
		$data['watchlist'] = $data['member']->watchlist->get();
		$categories = new ClassifiedsCategory();
		$data['categories'] = $categories;
		$this->show->set_user_backend();
		$this->show->user_backend('classifieds/watchlist',$data);
	}

	public function followed_users()
	{
		$user = new ClassifiedsMember($this->user->get_id());
		$user_extend = $user->classifiedsmemberextend->get();
		if($user_extend->registration_completed != 'yes')
			redirect(base_url('classifieds/not_authenticated'), 'location');

		$member = new ClassifiedsMember($this->user->get_id());
		$following = new ClassifiedsFollowing();
		$following->where('following_user', $this->user->get_id());

		if(isset($_GET['delete_followed_id']))
		{
			$followed_user_id = $_GET['delete_followed_id'];

			$following = new ClassifiedsFollowing();
			$following->where('followed_user', $followed_user_id);
			$following->get();
			$following->delete();

			redirect(base_url('user/classifieds/followed_users'), 'location');
		}

		$data['current_page'] = 'Followed users';
		$data['member'] = $member;
		$data['following'] = $following->get();
		$categories = new ClassifiedsCategory();
		$data['categories'] = $categories;
		$this->show->set_user_backend();
		$this->show->user_backend('classifieds/followed_users',$data);
	}
}
/* End of file user_classifieds.php */
/* Location: ./application/controllers/user_classifieds.php */