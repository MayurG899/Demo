<?php 	/***********************************************************
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

	class Alert extends DataMapper 
	{
		/* DataMapper specific members below*/
		var $table = 'alerts';
		var $has_one = array('user');
		var $has_many = array();

		/* Alert specific members below*/


	}
?>