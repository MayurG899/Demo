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

    class Settings extends CI_Model {
    	private $layout_system_type = "bootstrap2";
    	public function set_layout_system_type($type)
    	{
    		$this->$layout_system_type = $type;
    	}
    	public function layout_system_type()
    	{
    		return $this->$layout_system_type;
    	}

    }
?>