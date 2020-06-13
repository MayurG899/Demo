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
	
	public function toggle_like_video($user_id,$media_id,$status)
	{
		if($this->user->is_logged_in()){
			$counter = New VideoTubeLike();		
			$my_like = new VideoTubeLike();
			$my_like = $my_like->where('media_id',$media_id)->where('user_id',$user_id)->get();
			
			if($my_like->media_id == $media_id && $my_like->user_id == $user_id){
				$my_like->delete();
				
				$counters['likes'] = $counter->where('media_id',$media_id)->where('status','like')->count();
				$counters['unlikes'] = $counter->where('media_id',$media_id)->where('status','unlike')->count();
				echo json_encode($counters);
			}else{
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
		}else
			redirect(base_url('videotube/login'), 'location');
	}

	public function toggle_follow($follower_id,$author_id)
	{
		if($this->user->is_logged_in()){
			$follows = new VideoTubeFollow();
			$followers = $follows->where('following_id',$author_id)->get();
			$followed = $follows->where('follower_id',$follower_id)->where('following_id',$author_id)->count();

			if($follower_id != $author_id && $followed == 0){
				$data = array(
					'follower_id' => $follower_id,
					'following_id' => $author_id,
				);
				$follow = new VideoTubeFollow();
				$follow->create($data);
				
				$result = array(
					'text' => 'Following',
					'class' => 'video-btn-black-line-border',
					'activeclass' => 'video-btn-danger',
				);
				echo json_encode($result);
			}else{
				$followers->delete();
				$result = array(
					'text' => 'Follow',
					'class' => 'video-btn-black-line-border',
					'activeclass' => 'video-btn-danger',
				);
				echo json_encode($result);
			}
		}else
			redirect(base_url('videotube/login'), 'location');
	}

	public function upload()
	{
		$user_id = $this->user->get_id();
		if(!is_dir("files/users"))
			mkdir("files/users");
		if(!is_dir("files/users/user_".$user_id))
			mkdir("files/users/user_".$user_id);
		 if(!is_dir("files/users/user_".$user_id."/videotube"))
			mkdir("files/users/user_".$user_id."/videotube");
		 if(!is_dir("files/users/user_".$user_id."/videotube/videos"))
			mkdir("files/users/user_".$user_id."/videotube/videos");

		$files = $this->_reArrangeFiles($_FILES['file']);

		foreach ($files as $file) {
			//echo 'File Name: ' . $file['name'];
			//echo 'File Type: ' . $file['type'];
			//echo 'File Size: ' . $file['size'];
			$newUniqueFileName = md5(uniqid());
			$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
			$newFileName = $_SERVER['DOCUMENT_ROOT'].'/files/users/user_'.$user_id.'/videotube/videos/'.$newUniqueFileName.'.'.$ext;
			move_uploaded_file($file['tmp_name'], $newFileName);
			echo $newUniqueFileName.'.'.$ext;
		}
		
	}

	public function remove_file()
	{
		if(isset($_POST['fileName'])){
			$fileName = $_POST['fileName'];
			$file = $_SERVER['DOCUMENT_ROOT'].'/files/users/user_'.$this->user->get_id().'/videotube/videos/'.$_POST['fileName'];
			if(file_exists($file)){
				unlink($file);
				echo 'file deleted: '.$fileName;
			}else
				echo 'file deletion for : '.$fileName.' failed!';	
		}else
			echo 'No file to delete!';
	}

	public function _reArrangeFiles(&$file_post) {

		$file_array = array();
		$file_count = count($file_post['name']);
		$file_keys = array_keys($file_post);

		for ($i=0; $i<$file_count; $i++) {
			foreach ($file_keys as $key) {
				$file_array[$i][$key] = $file_post[$key][$i];
			}
		}
		return $file_array;
	}

	public function get_uploaded_files($item_id)
	{
		$ad = new VideoTubeMedia($item_id);
		$images = array();
		if($ad->exists()){
			if(!empty($ad->file)){
				if(strpos($ad->file,'be_demo') !== FALSE){
					$user_id = $this->user->get_id();
					if(!is_dir("files/users"))
						mkdir("files/users");
					if(!is_dir("files/users/user_".$user_id))
						mkdir("files/users/user_".$user_id);
					 if(!is_dir("files/users/user_".$user_id."/videotube"))
						mkdir("files/users/user_".$user_id."/videotube");
					 if(!is_dir("files/users/user_".$user_id."/videotube/videos"))
						mkdir("files/users/user_".$user_id."/videotube/videos");
					$img = base_url().$ad->file;
					$img_name = basename($img);
					copy($_SERVER['DOCUMENT_ROOT'].$ad->file,$_SERVER['DOCUMENT_ROOT'].'/files/users/user_'.$user_id.'/videotube/videos/'.$img_name);
					$ad->file = base_url().'files/users/user_'.$user_id.'/videotube/videos/'.$img_name;
				}
				$image = array(
					'name' => basename($ad->file),
					'size' => filesize(str_replace(base_url(),$_SERVER['DOCUMENT_ROOT'].'/',$ad->file)),
					'url' => checkImagePath($ad->file),
					'path' => str_replace(base_url(),$_SERVER['DOCUMENT_ROOT'].'/',$ad->file)
				);
				array_push($images,$image);
				echo json_encode($images);
			}
		}
	}
}