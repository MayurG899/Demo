<?
	class ClassfiedsRegion extends DataMapper 
	{	
		var $table = 'classifieds_regions';

		var $has_many = array(
            'location' => array(
				'class' => 'ClassifiedsLocation',
				'other_field' => 'region',
				'join_self_as' => 'region',
				'join_other_as' => 'location',			
			),
		);
	}
?>	