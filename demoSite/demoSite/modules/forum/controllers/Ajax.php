<?php
/***********************************************************
* BuilderEngine v3.1.0
* ---------------------------------
* BuilderEngine CMS Platform - Radian Enterprise Systems Limited
* Copyright Radian Enterprise Systems Limited 2012-2015. All Rights Reserved.
*
* http://www.builderengine.com
* Email: info@builderengine.com
* Time: 2015-08-31 | File version: 3.1.0
*
***********************************************************/

 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends Module_Controller {

    function __construct()
    {
        parent::__construct();
		$this->load->model('user');
		$this->load->model('area');
		$this->load->model('forum_topic');
		$this->load->model('forum_category');
		$this->load->model('forum_thread');
		$this->load->model('icon');
		$this->load->model('like');
    }
	
	public function toggle_like($user_id,$post_id)
	{
		if($this->user->is_logged_in()){	
			$user = new User($this->user->get_id());
			$user_id = $user->id;
			
			$like = $this->like->where('post_id',$post_id)->where('user_id',$user_id)->count();
			$my_like = $this->like->where('post_id',$post_id)->where('user_id',$user_id)->get();
			if($like == 1){
				$my_like->delete();
				return '';
			}
			else{
				$data = array(
					'user_id' => $user_id,
					'post_id' => $post_id
				);
				$this->like->create($data);
				return $user->first_name.' '.$user->last_name.'';
			}
		}
		else
			redirect(base_url('/forum/login'), 'location');
	}
}
