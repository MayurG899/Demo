<?php
/***********************************************************
* BuilderEngine v2.0.12
* ---------------------------------
* BuilderEngine CMS Platform - Radian Enterprise Systems Limited
* Copyright Radian Enterprise Systems Limited 2012-2014. All Rights Reserved.
*
* http://www.builderengine.com
* Email: info@builderengine.com
* Time: 2015-1-11 | File version: 3.1.3
*
***********************************************************/

 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends Module_Controller {

    function __construct()
    {
        parent::__construct();
		$this->load->model('user');
		$this->load->model('audioplayerlike');
    }

	public function index($id = 0)
	{
	}
	
	public function toggle_like_sound($user_id,$media_id,$status)
	{
		if($this->user->is_logged_in())
		{	
			$user = new User($this->user->get_id());
			$user_id = $user->id;
			
			$counter = new AudioPlayerLike();		
			$my_like = new AudioPlayerLike();
			$my_like = $my_like->where('media_id',$media_id)->where('user_id',$user_id)->get();
			
			if($my_like->media_id == $media_id && $my_like->user_id == $user_id)
			{
				$my_like->delete();
				
				$counters['likes'] = $counter->where('media_id',$media_id)->where('status','like')->count();
				$counters['unlikes'] = $counter->where('media_id',$media_id)->where('status','unlike')->count();
				echo json_encode($counters);
			}
			else
			{
				$data = array(
					'user_id' => $user_id,
					'media_id' => $media_id,
					'status' => $status,
				);
				$my_like->create($data);
				
				$counters['likes'] = $counter->where('media_id',$media_id)->where('status','like')->count();
				$counters['unlikes'] = $counter->where('media_id',$media_id)->where('status','unlike')->count();
				echo json_encode($counters);
			}
		}
		else
			redirect(base_url('/audioplayer/login'), 'location');
	}

	public function toggle_follow($follower_id,$author_id)
	{
		if($this->user->is_logged_in())
		{	
			$user = new User($this->user->get_id());
			$user_id = $user->id;
			
			$follows = new AudioPlayerFollow();
			$followers = $follows->where('following_id',$author_id)->get();
			$followed = $follows->where('follower_id',$follower_id)->where('following_id',$author_id)->count();
			
			if($follower_id != $author_id && $followed == 0)
			{
				$data = array(
					'follower_id' => $follower_id,
					'following_id' => $author_id,
				);
				$follow = new AudioPlayerFollow();
				$follow->create($data);
				
				$result = array(
					'text' => 'Following',
					'class' => 'btn-color-line',
					'activeclass' => 'btn-danger',
				);
				echo json_encode($result);
			}
			else
			{
				$followers->delete();
				$result = array(
					'text' => 'Follow',
					'class' => 'btn-color-line',
					'activeclass' => 'btn-danger',
				);
				echo json_encode($result);
			}
		}
		else
			redirect(base_url('/audioplayer/login'), 'location');
	}
}