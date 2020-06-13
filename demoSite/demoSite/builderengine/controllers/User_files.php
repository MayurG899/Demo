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

ini_set('max_file_uploads', 50);   // allow uploading up to 50 files at once

function access($attr, $path, $data, $volume) {
	return strpos(basename($path), '.') === 0       // if file/folder begins with '.' (dot)
		? !($attr == 'read' || $attr == 'write')    // set read+write to false, other (locked+hidden) set to true
		:  null;                                    // else elFinder decide it itself
}

class User_files extends BE_Controller {
	function User_files()
	{
		parent::__construct();
		/*
        $this->load->model('users');;
        $this->user = $this->users->get_current_user();
		if(!$this->user->is_logged_in())
			redirect(base_url(),'location');
		*/
		if($this->user->is_logged_in())
			redirect(base_url("cp/dashboard"), 'location');
		else
			redirect(base_url("cp/login"), 'location');
	}

	function show($embedded = false)
	{		
		$data['embedded'] = true;
		$this->show->set_user_backend();
		$this->show->user_backend('files',$data);
	}
	
	function connector()
	{
		include_once APPPATH.'third_party/finder/elFinderConnector.class.php';
		include_once APPPATH.'third_party/finder/elFinder.class.php';
		include_once APPPATH.'third_party/finder/elFinderVolumeDriver.class.php';
		include_once APPPATH.'third_party/finder/elFinderVolumeLocalFileSystem.class.php';

		$opts = array(
			// 'debug' => true,
			'uploadMaxSize'	=> "10M",
					'uploadTotalSize'	=> "5000000000",
					'uploadFileSize'	=> "10M",
					'uploadDeny'    => array('all'),
					'uploadAllow' => array('image'),
					'uploadOrder'   => array('deny', 'allow'),
			'roots' => array(
				
				array(
					'uploadMaxSize'	=> "10M",
					'uploadTotalSize'	=> "10M",
					'uploadFileSize'	=> "10M",
					'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
					'path'          => APPPATH.'../files/users/user_'.$this->user->get_id().'/',         // path to files (REQUIRED)
					'URL'           => base_url().'files/users/user_'.$this->user->get_id().'/', // URL to files (REQUIRED)
					'uploadDeny'    => array('all'),                // All Mimetypes not allowed to upload
					'uploadAllow'   => array('image', 'application/pdf', 'application/msword', 'video/avi', 'audio/mp3', 'video/msvideo', 'video/mp4', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'text/plain'),// Mimetype `image` and `text/plain` allowed to upload
					'uploadOrder'   => array('deny', 'allow'),      // allowed Mimetype `image` and `text/plain` only
					'accessControl' => 'access'  ,           // disable and hide dot starting files (OPTIONAL)
					'defaults'     => array(        // default permisions
						'read'   => true,
						'write'  => true,
						'rm'     => true
					),
					'perms' => array( // individual folders/files permisions 
					   '/^test_dir\/.*/' => array(
						  'read'  => true,
						  'write' => true,
						  'rm'    => true
						)
					),
					'attributes'   => array(
						array(
							'pattern' => '/.(files|users)$/', // Dont write or delete to this but subfolders and files
							'read'  => true,
							'write' => false,
							'locked' => true
						)   
					),
				)
			)
		);

		// run elFinder
		$connector = new elFinderConnector(new elFinder($opts));
		$connector->run();
	}

	public function upload($field_name,$module,$directory,$subdirectory = null)
	{
		$files = $this->_reArrangeFiles($_FILES[$field_name]);

		foreach ($files as $file) {
			//echo 'File Name: ' . $file['name'];
			//echo 'File Type: ' . $file['type'];
			//echo 'File Size: ' . $file['size'];
			$newUniqueFileName = md5(uniqid());
			$ext = pathinfo($file[$field_name], PATHINFO_EXTENSION);
			$newFileName = $this->_get_file_path()."/".$newUniqueFileName.".".$ext;
			move_uploaded_file($file['tmp_name'], $newFileName);
			echo $newUniqueFileName.'.'.$ext;
		}
	}
	//TODO
	public function remove_file()
	{
		if(isset($_POST['fileName'])){
			$fileName = $_POST['fileName'];
			$file = $_SERVER['DOCUMENT_ROOT'].'/files/users/user_'.$user_id.'/classifieds/images/'.$_POST['fileName'];
			if(file_exists($file)){
				unlink($file);
				echo 'file deleted: '.$fileName;
			}else
				echo 'file deletion for : '.$fileName.' failed!';	
		}else
			echo 'No file to delete!';
	}

	public function _get_file_path($module,$directory,$subdirectory = null)
	{
		if($module && $directory){
			$user_id = $this->user->get_id();
			if(!is_dir("files/users"))
				mkdir("files/users");
			if(!is_dir("files/users/user_".$user_id))
				mkdir("files/users/user_".$user_id);
			if(!is_dir("files/users/user_".$user_id."/".$module))
				mkdir("files/users/user_".$user_id."/".$module);
			if(!is_dir("files/users/user_".$user_id."/".$module."/".$directory))
				mkdir("files/users/user_".$user_id."/".$module."/".$directory);
			$path = $_SERVER['DOCUMENT_ROOT']."/files/users/user_".$user_id."/".$module."/".$directory;

			if($subdirectory){
				if(!is_dir("files/users/user_".$user_id."/".$module."/".$directory."/".$subdirectory))
					mkdir("files/users/user_".$user_id."/".$module."/".$directory."/".$subdirectory);
				$path = $_SERVER['DOCUMENT_ROOT']."/files/users/user_".$user_id."/".$module."/".$directory."/".$subdirectory;
			}
			
			return $path;
		}
	}

	public function _reArrangeFiles(&$file_post) 
	{

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
}