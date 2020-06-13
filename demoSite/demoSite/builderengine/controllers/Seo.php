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
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Seo extends BE_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
    public function seo(){
        parent::__construct();
    }
	public function index($id)
	{
        $this->load->model('users');

		$this->show->frontend('welcome_message');

	}
    function dispatch($string)
    {
        $data = explode("-", $string, 2);

        $this->load->model('users');

        if(!isset($data[1]))
        	$data[1] = "index";
        

        $output = Modules::run($data[0].'/seo', $data[1]);

        if(strlen($output) == 0)
            show_404();
        else
            echo $output;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */