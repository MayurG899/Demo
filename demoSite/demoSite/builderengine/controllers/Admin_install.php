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

    class Admin_install extends BE_Controller
    {
        function admin_install()
        {
            parent::__construct();

            if($this->is_installed())
                redirect("/", 'location');
        }

        function validate_info()
        {
            if($_POST)
            {
                if(isset($_POST['db_host']) && isset($_POST['db_user']) && isset($_POST['db_pass']) && isset($_POST['db_name']))
                {
                    $connection = mysqli_connect($_POST['db_host'], $_POST['db_user'], $_POST['db_pass'], $_POST['db_name']);

                    if (!$connection) {
                        if (strpos(mysqli_connect_error(), 'denied') !== false)
                        {
                            echo 'denied';
                            return;
                        }
                        else
                        {
                            echo 'unable';
                            return;
                        }
                    }
                    else
                    {
                        echo 'connected';
                        return;
                    }
                }
                echo 'not set';
                return;
            }
            echo 'no post';
            return;
        }
        function ajax_validate(){
            error_reporting(0);

            if($this->input->is_ajax_request()){
                $this->output
                    ->set_content_type('application/json');

                $this->load->library('form_validation');
                $this->form_validation->set_error_delimiters('', '');

                $input = $this->input->post('input');
                $value= $this->input->post('value');

                switch($input){
                    case 'txt_sitename':{
                        $this->form_validation->set_rules('value', 'Site Name', 'required');
                        break;
                    }
                    case 'txt_admin_username':{
                        $this->form_validation->set_rules('value', 'Admin Username', 'required');
                        break;
                    }
                    case 'txt_admin_email':{
                        $this->form_validation->set_rules('value', 'Admin email address', 'required|valid_email');
                        break;
                    }
                    case 'txt_admin_password':{
                        $this->form_validation->set_rules('value', 'Password', 'required');
                        break;
                    }
                    case 'txt_admin_passwordconf':{
                        $this->form_validation->set_rules('password', 'Password Confirmation', 'required');
                        $this->form_validation->set_rules('value', 'Password Confirmation', 'required|matches[password]');
                        break;
                    }
                    case 'txt_db_host':{

                        if(strlen($this->input->post('value')) == 0){
                            $this->form_validation->set_rules('value', 'MySQL host', 'required');
                        }else{
                            $link = mysql_connect( $value );
                            if(!$link){

                                if( preg_match("/^Can't connect to MySQL server on(.*)/i", trim(mysql_error())) ||
                                    preg_match("/^Unknown MySQL server host (.*)/i", trim(mysql_error()))){
                                    echo json_encode(array('result' => FALSE, 'input' => $input, 'error_message' => mysql_error()));
                                }
                                else{
                                    echo json_encode(array('result' => TRUE, 'input' => $input, 'development_info' => mysql_error()));
                                }
                            }else{
                                echo json_encode(array('result' => TRUE, 'input' => $input));
                            }
                            exit();
                        }
                        break;
                    }
                    case 'txt_db_name':{


                        if(strlen($this->input->post('value')) == 0){
                            $this->form_validation->set_rules('value', 'MySQL database', 'required');
                        }else{
                            $host = $this->input->post('host');
                            $user = $this->input->post('username');
                            $pass = $this->input->post('passowrd');
                            $db = $this->input->post('value');

                            $link = mysql_connect( $host, $user, $pass );

                            if(!$link){
                                echo json_encode(array('result' => FALSE, 'input' => $input, 'error_message' => 'Check database credentials first!'));
                            }else{

                                $db_selected = mysql_select_db($db, $link);
                                if (!$db_selected) {
                                    echo json_encode(array('result' => FALSE, 'input' => $input, 'error_message' => "Database doesn't exist"));
                                }else{
                                    echo json_encode(array('result' => TRUE, 'input' => $input));
                                }
                            }
                            exit();
                        }
                        break;

                    }
                    case 'db_credentials':{
                        error_reporting(0);
                        if(strlen($this->input->post('value')) == 0){
                            $this->form_validation->set_rules('value', 'MySQL host', 'required');
                        }else{
                            $host = $this->input->post('host');
                            $user = $this->input->post('username');
                            $pass = $this->input->post('passowrd');

                            $link = mysql_connect( $host, $user, $pass );
                            if(!$link){

                                if( preg_match("/^Can't connect to MySQL server on(.*)/i", trim(mysql_error())) ||
                                    preg_match("/^Unknown MySQL server host (.*)/i", trim(mysql_error()))){
                                    echo json_encode(array('result' => FALSE, 'input' => $input, 'error_message' => 'Check your Database Host first!'));
                                }
                                elseif(preg_match("/^Access denied for user(.*)/i", trim(mysql_error()))){
                                    echo json_encode(array('result' => FALSE, 'input' => $input, 'error_message' => 'Unknown user, wrong password or denied access'));
                                }else{
                                    echo json_encode(array('result' => FALSE, 'input' => $input, 'error_message' => 'Unknown Database error: ' . mysql_error()));
                                }
                            }else{
                                echo json_encode(array('result' => TRUE, 'input' => $input));
                            }

                            exit();

                        }

                        break;

                    }
                    default:{break;}
                }


                if ($this->form_validation->run() == FALSE)
                {
                    $this->output
                        ->set_output(json_encode(array('result' => FALSE, 'input' => $input, 'error_message' => form_error('value'))));
                }
                else
                {
                    $this->output
                        ->set_output(json_encode(array('result' => TRUE, 'input' => $input)));
                }
            }

        }


        function index()
        {
            $this->step_one();
        }

        function create_admin($username = null, $password = null, $email = null)
        {
            $this->load->database();
            $this->load->model("users");

			$admin['first_name'] = 'Admin';
			$admin['last_name'] = 'Manager';
			$admin['groups']    = "Members,Administrators,Frontend Editor,Frontend Manager,Basic Member,Premium Member";
			$admin['verified']   = 'yes';
			$admin['city'] = 'Galway City';
			$admin['address'] = 'Portershed,Eyre Square';
			$admin['state'] = 'Ireland';
			$admin['zip'] = 'H91 HY5';
			$admin['country'] = 'Ireland';
			$admin['telephone'] = '091000000';
			if($this->is_cms()){
				$admin['username']  = $this->input->post('admin_username');
				$admin['password']  = $this->input->post('admin_password');
				$admin['email']     = $this->input->post('admin_email');
				$this->BuilderEngine->set_option('adminemail', $this->input->post('admin_email'));
			}else{
				$admin['username']  = urldecode($username);
				$admin['password']  = urldecode($password);
				$admin['email']     = urldecode($email);
				$this->BuilderEngine->set_option('adminemail',urldecode($email));
			}
            $this->users->register_user($admin,true);
            echo "success";
        }
        function install_db($host = null, $user = null, $password = null, $db = null)
        {
			if($this->is_cms()){
				ini_set('max_execution_time', 0);
				$this->show->disable_full_wrapper();
				$host = $this->input->post('host');
				$user = $this->input->post('user');
				$password = $this->input->post('password');
				$db = $this->input->post('db');

				error_reporting(0);

				$queries = file_get_contents(APPPATH."install/database.sql");

				if($queries === null)
					die("PHP function <a href='http://php.net/file_get_contents'>file_get_contents()</a> is disabled by your server administrator");
					
				if($queries === false)
					die("Could not read database import file.");
				//Check if extra db data exists
				if($this->extra_db_exists())
				{
					$extra_queries = file_get_contents(APPPATH."install/database_extra.sql");

					if($extra_queries === null)
						die("PHP function <a href='http://php.net/file_get_contents'>file_get_contents()</a> is disabled by your server administrator");
						
					if($extra_queries === false)
						die("Could not read database import file.");

					$queries .= $extra_queries;
				}
				// Support multiple query execution
				$mysqli = new mysqli($host, $user, $password , $db);
				// check connection
				if (mysqli_connect_errno()) {
					printf("Connect failed: %s\n", mysqli_connect_error());
					exit();
				}
				// execute multi query 
				if ($mysqli->multi_query($queries)) {
					do {
						// store first result set
						if ($result = $mysqli->store_result()) {
							while ($row = $result->fetch_row()) {
								printf("%s\n", $row[0]);
							}
							$result->free();
						}
					} while ($mysqli->next_result());
				}
				// close connection
				$mysqli->close();

			}else{
				$this->load->library('../controllers/Admin_cloud');
				$this->admin_cloud->install_cloud_db($host, $user, $password, $db);
			}
            $config = file_get_contents(APPPATH."config/database_template.php");
            $config = str_replace("##DB_HOST##", $host, $config);
            $config = str_replace("##DB_USER##", $user, $config);
            $config = str_replace("##DB_PASS##", $password, $config);
            $config = str_replace("##DB_NAME##", $db, $config);

            file_put_contents(APPPATH."config/database.php", $config) or die("Could not create database configuration file.");

            echo "success";
        }
        function finish()
        {
            $config = file_get_contents(APPPATH."config/config.php");
            $config = str_replace('$config[\'site_installed\'] = false;', '$config[\'site_installed\'] = true;', $config);

            file_put_contents(APPPATH."config/config.php", $config);
            echo "success";
        }
        function configure($sitename = null, $whm_user = null, $whm_pass = null, $password = null, $db = null){
			if($this->is_cms()){
				$this->output
					->set_content_type('application/json');

				if($this->input->is_ajax_request()) {

					$sitename   = $this->input->post('sitename');
					$host       = $this->input->post('host');
					$user       = $this->input->post('user');
					$password   = $this->input->post('password');
					$db         = $this->input->post('db');

					$this->load->database();
					$this->BuilderEngine->load_settings();
					$this->BuilderEngine->set_option("website_name", $sitename);
					$this->BuilderEngine->set_option("website_title", $sitename);

					$this->output
						->set_output(json_encode(array('result' => TRUE)));

				}else{
					$this->output
						->set_output(json_encode(array('result' => FALSE)));
				}
			}else{
				$this->load->library('../controllers/Admin_cloud');
				$this->admin_cloud->configure_cloud($sitename, $whm_user, $whm_pass, $password, $db);
			}

        }
        function step_one()
        {
            $requirements = array();
            if(array_key_exists('HTTP_MOD_REWRITE', $_SERVER) && $_SERVER['HTTP_MOD_REWRITE'] == "On")
                $requirements['mod_rewrite'] = true;
            else
                $requirements['mod_rewrite'] = false;

            $requirements['short_tags'] = ini_get('short_open_tag') == "1";

            $requirements['writable'] = check_writable_recurse(".") ;
            $requirements['php_version'] = check_php_version("5.0") ;
            $requirements['mysql_available'] = function_exists("mysql_connect") && function_exists("mysql_select_db") && function_exists("mysql_query") ;
            $requirements['mysqli_available'] = function_exists("mysqli_connect") && function_exists("mysqli_select_db") && function_exists("mysqli_query") ;

            $data['requirements'] = $requirements;
            $this->load->helper('bs_progressbar');
            $this->load->helper('form');
			if($this->is_cms())
				$this->show->backend('maintenance_install', $data);
			else
				$this->show->backend('maintenance_cloud_install', $data);
        }

    }
?>