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

class Admin_files extends BE_Controller {
	function Admin_files()
	{
		parent::__construct();
		$this->user->require_group("Administrators");
		
	}
	function show($embedded = false) {
		$data['embedded'] = $embedded;
		$data['current_page'] = 'webpages';
		$this->show->backend("files", $data);  
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
					'path'          => APPPATH.'../files/',         // path to files (REQUIRED)
					'URL'           => base_url().'files/', // URL to files (REQUIRED)
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
				)
			)
		);

		// run elFinder
		$connector = new elFinderConnector(new elFinder($opts));
		$connector->run();
	}
}