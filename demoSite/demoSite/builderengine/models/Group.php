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

	class Group extends DataMapper 
	{
		/* DataMapper specific members below*/
		var $table = 'user_groups';
		var $has_one = array(
		 "module_permission"	=> array(
		        'class' => 'Group_module_permission',
		        'other_field' => 'group',
				'join_self_as' => 'group',
				'join_other_as' => 'permission',
				 ),);
		var $has_many = array(
			"module"	=> array(
				'join_table' => 'link_groups_modules',
				'join_self_as' => 'group',
				'join_other_as' => 'module',
				 ), 
			"user"	=> array(
				'join_table' => 'link_groups_users',
				'join_self_as' => 'group',
				'join_other_as' => 'user',
				 ),
		);

		/* Group specific members below*/


	}
?>