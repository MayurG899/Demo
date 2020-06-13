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

	class Version_manager extends Module_Controller {

		public function Version_manager()
		{
			parent::__construct();
			
		}
		
		public function index()
		{
			echo "Versions1::index()";
		}

		public function test()
		{
			echo "Yep working good";
		}
		public function query1($string)
		{
			echo "Versions1::query()"; 
		}

		
	}

?>