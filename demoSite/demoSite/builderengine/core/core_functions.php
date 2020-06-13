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
    
    function includeRecurse($dirName) { 
        if(!is_dir($dirName)) 
            return false;          
        $dirHandle = opendir($dirName); 
        while(false !== ($incFile = readdir($dirHandle))) { 
            if($incFile != "." && $incFile != "..") { 
                if(is_file("$dirName/$incFile")) 
                    include_once("$dirName/$incFile"); 
                elseif(is_dir("$dirName/$incFile")) 
                    includeRecurse("$dirName/$incFile"); 
            } 
        } 
        closedir($dirHandle); 
    }
    
    function check_writable_recurse($dirName) {
        if($dirName[0] == ".")
            return true;
        if(!is_dir($dirName)) 
            return false;          
        $dirHandle = opendir($dirName); 
        while(false !== ($incFile = readdir($dirHandle))) { 

            if($incFile != "." && $incFile != "..") { 
                if(is_file("$dirName/$incFile")) 
                    if(!is_writable("$dirName/$incFile"))
                        return false; 
                elseif(is_dir("$dirName/$incFile")) 
                    if(!check_writable_recurse("$dirName/$incFile"))
                        return false; 
            } 
        }
        echo $incFile; 
        return true;
    }
    function check_php_version($required_version)
    {
        $current_version = phpversion();

        return version_compare($current_version, $required_version, '>=');
    }

    function get_php_version()
    {
        return phpversion();
    }

    function get_active_user_id()
    {
        $CI = & get_instance();
        $CI->load->library('session');
        return $CI->session->userdata('user_id');
    }

    /*
    *sometimes FCKeditor wants to add \r\n, so replace it with a space
    *sometimes FCKeditor wants to add <p>&nbsp;</p>, so replace it with nothing
    */
    function ChEditorfix($value){
        $order   = array("\\r\\n", "\\n", "\\r", "<p>&nbsp;</p>");
        $replace = array(" ", " ", " ", "");
        $value = str_replace($order, $replace, $value);
        if(strpos($value, 'src')){
            return preg_replace('/(\\\")/', '"',$value );
        }else{
            return $value;
        }
    }

	function checkImagePath($imagePath){
		$position = strpos($imagePath,'/');
		if ($position !== false && $position == 0 && strpos($imagePath, 'be_demo') !== false){
			$newImagePath = substr_replace($imagePath, base_url(), $position, strlen('/'));
			return $newImagePath;
		}
		else
			return $imagePath;
	}

	function checkLink($link,$type = false){
		if($type && $type == 'external'){
			return $link;
		}else{
			if(strpos($link,base_url()) !== false)
				return $link;
			else
				return base_url($link);
		}
	}

	function convertCurrency($amount, $from, $to){
		$url  = "https://finance.google.com/finance/converter?a=".$amount."&from=".$from."&to=".$to;
		$data = file_get_contents($url);
		preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
		$converted = preg_replace("/[^0-9.]/", "", $converted[1]);
		return round($converted, 3);
	}

	function deleteDirectoryFiles($path){
		if(is_dir($path) === true){
			$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::CHILD_FIRST);
			foreach($files as $file){
				if(in_array($file->getBasename(), array('.', '..')) !== true){
					if($file->isDir() === true){
						rmdir($file->getPathName());
					}
					else if(($file->isFile() === true) || ($file->isLink() === true) || strpos($file->getBasename(),'.php.php') !== FALSE){
						unlink($file->getPathname());
					}
				}
			}
			return rmdir($path);
		}
		else if((is_file($path) === true) || (is_link($path) === true)){
			return unlink($path);
		}
		return false;
	}

	function countFiles($path){
		$count = 0;
		$ignore = array('.','..','.tmb','.quarantine');
		$files = scandir($path);
		foreach($files as $t) {
			if(in_array($t, $ignore)) continue;
			if (is_dir(rtrim($path, '/') . '/' . $t)){
				$count += countFiles(rtrim($path, '/') . '/' . $t);
			}else{
				$count++;
			}   
		}
		return $count;
	}

	function PDF($fileName,$content,$option,$stylesheet = false)
	{
        $CI = & get_instance();
        $CI->load->library('pdf');

		$pdf = $CI->pdf->load();
		$pdf->SetFooter(''.'|{PAGENO}|'.date(DATE_RFC822));

		if($stylesheet){
			$stylesheet = file_get_contents($stylesheet);
			$pdf->WriteHTML($stylesheet,1);
			$pdf->WriteHTML($content,2);
		}else
			$pdf->WriteHTML($content,2);

		$filePath = $fileName.".pdf";
		# Return as a string #
		if($option == 'S')
			return $pdf->Output($filePath, $option);
		# Save to file #
		if($option == 'F'){
			$pdf->Output($filePath, $option);
			return $filePath;
		}
		# Show in browser / Download a file #
		if($option == 'I' || $option == 'D')
			$pdf->Output($filePath, $option);
	}

	function timeElapsedSince($time)
	{

		$time = time() - $time;
		$time = ($time < 1)? 1 : $time;
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
			return $numberOfUnits.' '.$text.(($numberOfUnits > 1)?'s':'').' ago';
		}

	}

	# $start and $end dates must be in Y-m-d format #
	function getDateRange($start, $end, $format = 'Y-m-d') {
		$start  = new DateTime($start);
		$end    = new DateTime($end);
		$invert = $start > $end;

		$dates = array();
		$dates[] = $start->format($format);
		while ($start != $end) {
			$start->modify(($invert ? '-' : '+') . '1 day');
			$dates[] = $start->format($format);
		}
		return $dates;
	}
	# test if apache rewrite module is on #
	function testApacheRewriteExists($moduleName = 'mod_rewrite')
    {
        if (function_exists('apache_get_modules') && in_array($moduleName, apache_get_modules()))
            return true;
        if (isset($_SERVER['HTTP_MOD_REWRITE']) && $_SERVER['HTTP_MOD_REWRITE'] == 'On')
            return true;
        if (isset($_SERVER['REDIRECT_HTTP_MOD_REWRITE']) && $_SERVER['REDIRECT_HTTP_MOD_REWRITE'] == 'On')
            return true;
		return false;
    }