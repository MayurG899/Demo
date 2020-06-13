<?
	class ClassifiedsLocation extends DataMapper 
	{	
		var $table = 'classifieds_locations';

		var $has_one = array(
            'region' => array(
				'class' => 'ClassifiedsRegion',
				'other_field' => 'location',
				'join_self_as' => 'location',
				'join_other_as' => 'region',			
			),
		);
		
	}
?>	