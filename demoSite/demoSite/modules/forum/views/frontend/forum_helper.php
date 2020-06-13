<?php

	function calculateTime($time)
	{

		$time = time() - $time; // to get the time since that moment
		$time = ($time<1)? 1 : $time;
		$tokens = array (
			31536000 => 'year',
			2592000 => 'month',
			604800 => 'week',
			86400 => 'day',
			3600 => 'hour',
			60 => 'minute',
			1 => 'second'
		);

		foreach ($tokens as $unit => $text) {
			if ($time < $unit) continue;
			$numberOfUnits = floor($time / $unit);
			return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
		}

	}
	
	function getLabel($user_level)
	{
		switch($user_level)
		{
			case'Administrator':
				echo 'danger';
				break;
			case 'Member':
				echo 'success';
				break;
			case 'Guest':
				echo 'info';
				break;
		}
	}
?>