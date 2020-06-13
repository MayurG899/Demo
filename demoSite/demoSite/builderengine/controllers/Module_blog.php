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

  class Module_blog extends BE_Controller{
      
      public function module_blog()
      {
          parent::__construct();
      }
      
      public function index()
      {
        $this->show->frontend("blog");    
      }
      
  }
?>
