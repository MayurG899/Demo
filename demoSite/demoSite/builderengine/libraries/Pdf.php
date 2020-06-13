<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pdf
{
	/*
	include_once APPPATH.'/third_party/mpdf60/mpdf.php';
    public function __construct(){
        parent::__construct();

        $this->CI =& get_instance();
    }
	*/
    function check()
    {
        $CI = & get_instance();
        echo 'mPDF class is loaded.';
    }
 
    function load($param=NULL)
    {
		//define('_MPDF_TTFONTPATH','your_path/ttfonts/');
		//define('_MPDF_TTFONTDATAPATH','your_path/ttfontdata/');

        include_once APPPATH.'/third_party/mpdf60/mpdf.php';
         
        if ($params == NULL)
        {
            $param = '"en-GB-x","A4","","",10,10,10,10,6,3';         
        }

        return new mPDF($param);
    }
}
/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */