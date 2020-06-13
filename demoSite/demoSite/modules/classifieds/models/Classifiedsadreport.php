<?php
	class ClassifiedsAdReport extends DataMapper 
	{
		var $table = 'classifieds_ad_reports';

		var $has_one = array(
		    'item' => array(
				'class' => 'ClassifiedsItem',
				'other_field' => 'report',
				'join_self_as' => 'report',
				'join_other_as' => 'item',
			), 
		);
	}
?>