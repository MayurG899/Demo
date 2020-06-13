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

if (!defined('BASEPATH')) exit('No direct script access allowed');


class User_registration extends BE_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
    */
    function __construct()
    {
        parent::__construct();
		/*
        $this->load->model('builderengine');
        if($this->builderengine->get_option('user_dashboard_activ') != 'yes')
            redirect("/", 'location');
		*/
		if($this->user->is_logged_in())
			redirect(base_url("cp/dashboard"), 'location');
		else
			redirect(base_url("cp/login"), 'location');
    }

    public function index()
    {
        if($this->user->is_logged_in())
            redirect("/user/main/dashboard", 'location');
        else{
            $this->load->model("builderengine");
            $data['builderengine'] = &$this->builderengine;
            if($data['builderengine']->get_option('user_register_background_img'))
                $url = $data['builderengine']->get_option('user_register_background_img');
            else
                $url = get_theme_path()."assets/img/login-bg/bg-2.jpg";
            $data['url'] = $url;
            $this->show->set_user_backend();
            $this->show->user_backend('registration',$data);
        }
    }
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */