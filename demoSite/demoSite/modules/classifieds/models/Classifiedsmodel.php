<?
	require_once(APPPATH.'../modules/classifieds/models/Classifiedsmake.php');

	class ClassifiedsModel extends DataMapper 
	{	
		var $table = 'classifieds_models';

		var $has_one = array(
			'make' => array(
				'class' => 'ClassifiedsMake',
				'other_field' => 'model',
				'join_self_as' => 'model',
				'join_other_as' => 'make',					
			),
		);
	}