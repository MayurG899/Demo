<?
	require_once(APPPATH.'../modules/classifieds/models/Classifiedsmodel.php');

	class ClassifiedsMake extends DataMapper 
	{	
		var $table = 'classifieds_makes';

		var $has_many = array(
			'model' => array(
				'class' => 'ClassifiedsModel',
				'other_field' => 'make',
				'join_self_as' => 'make',
				'join_other_as' => 'model',				
			),
		);
	}