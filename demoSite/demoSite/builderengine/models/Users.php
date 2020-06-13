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

    class Users extends CI_Model {
 
        function get_current_user()
        {
            global $active_show;
            return $active_show->controller->user;
        }
        function is_online($id) {
            $timeout = 300;
 
            $now = strtotime("now");
            $id = mysql_real_escape_string($id);
 
            $this->db->select('last_activity')->where("`id` = '".$id."'", "LIMIT 1", FALSE);
            $query = $this->db->get('users');
            $last_activity = $query->first_row()->last_activity;
 
            if($now - $last_activity < 300)
                return true;
            return false;
        }
        function validate_password_reset_token(&$token)
        {
            $this->db->where("pass_reset_token", $token);
            $query = $this->db->get("users");
            $result = $query->result();

            if(!$result)
                $token = FALSE;
        }
        function validate_registration_token(&$token)
        {
            $this->db->where("cache_token", $token);
            $query = $this->db->get("users");
            $result = $query->result();

            if(!$result)
                $token = FALSE;
        }
        function register_activity($id) {
            $now = strtotime("now");
            $id = mysql_real_escape_string($id);
 
            $object = array('last_activity' => $now);
            $this->db->where("`id` = '".$id."'", "LIMIT 1", FALSE);
            $this->db->update('users', $object);
        }
 
        function set_user_groups_by_name($user, $groups)
        {
            $groups = explode(",", $groups);
 
 
            $this->db->delete('link_groups_users', array('user_id' => $user));
 
            foreach($groups as $group)
            {
                $group_id = $this->get_group_id_by_name($group);
                if($group_id == -1)
                    continue;
 
                $data = array(
                    "user_id" => $user,
                    "group_id"=> $group_id
                );
                $this->db->insert("link_groups_users", $data);
            }
        }
        function get_group_id_by_name($name)
        {
            $this->db->where("name", $name);
            $query = $this->db->get("user_groups");
            $result = $query->result();
            if(count($result) != 0)
            {
                return $result[0]->id;
            }else
                return -1;
        }
 
        function register_user($data, $admin = false){
            if($this->username_already_used($data['username']) || $this->email_already_used($data['email'])){
                return 0;
            }
			$this->load->model("builderengine");
			
            $insert = array(
                'first_name'        => (isset($data['first_name'])) ? $data['first_name'] : '',
                'last_name'         => (isset($data['last_name'])) ? $data['last_name'] : '',
                'username'          => $data['username'],
                'password'          => md5($data['password']),
                'email'             => $data['email'],
                'level'             => ($admin == true)?'Administrator':'Member',
                'date_registered'   => time()
            );
            if(isset($data['avatar']))
                $insert['avatar'] = $data['avatar'];
			else
				$insert['avatar'] = base_url().'builderengine/public/img/avatar.png';
            if(isset($data['verified']))
                $insert['verified'] = $data['verified'];

            $this->db->insert('users', $insert);
            $user = $this->db->insert_id();
			if(!is_dir("files/users"))
				mkdir("files/users");
			if(!is_dir("files/users/user_".$user))
				mkdir("files/users/user_".$user);
			$ext_info = array(
				'telephone' => (isset($data['telephone']) && !empty($data['telephone']))?$data['telephone']:'none',
				'address' => (isset($data['address']) && !empty($data['address']))?$data['address']:'none',
				'country' => (isset($data['country']) && !empty($data['country']))?$data['country']:'',
				'city' => (isset($data['city']) && !empty($data['city']))?$data['city']:'none',
			);
			$this->add_extended_info($user,$ext_info); #delete#
			$ext_info['user_id'] = $user; //temp workaround
			$ext_info['telephone'] = (isset($data['telephone']) && !empty($data['telephone']))?$data['telephone']:'none';
			$ext_info['address'] = (isset($data['address']) && !empty($data['address']))?$data['address']:'none';
			$ext_info['country'] = (isset($data['country']) && !empty($data['country']))?$data['country']:'';
			$ext_info['city'] = (isset($data['city']) && !empty($data['city']))?$data['city']:'none';
			$ext_info['zip'] = (isset($data['zip']) && !empty($data['zip']))?$data['zip']:'none';
			$ext_info['state'] = (isset($data['state']) && !empty($data['state']))?$data['state']:'none';
			$ext_info['gender'] = (isset($data['gender']) && !empty($data['gender']))?$data['gender']:'male';
			if($admin)
				$this->install_admin_extended_info($ext_info);
			else
				$this->extended_info('create',$ext_info);
            $user_data = $this->get_by_id($user);
            $username = $user_data->username;
            //$this->upload_avatar($username);
 
            if($admin)
                $data['groups'] = "Members,Administrators,Frontend Editor,Frontend Manager,Basic Member,Premium Member";
 
            if(!isset($data['groups']) || $data['groups'] == "")
                $data['groups'] = $this->builderengine->get_option('default_registration_group');

			if(isset($data['account_type']) && $data['account_type'] != '' && $this->builderengine->get_option('extra_registration_active') == 'yes' && $this->builderengine->get_option('extra_registration_usergroups') != ''){
				$extra_groups = explode(',',$this->builderengine->get_option('extra_registration_usergroups'));
				if(in_array($data['account_type'],$extra_groups))
					$data['groups'] .= ','.$data['account_type'];
			}

			if($this->builderengine->get_option('sign_up_verification') == 'email')
				$this->send_registration_email($data['email'],$user);

			if($this->builderengine->get_option('notify_admin_registered_user') == 'yes')
				$this->notify_admin();
				
            $this->set_user_groups_by_name($user,$data['groups']);
            return $user;
        }
        function delete_alerts_with_tag ($tag)
        {
            $this->db->where("tag", $tag);
            $this->db->delete("alerts");
        }
        function get_alerts($user) 
        {
            $this->db->where("user", $user);
            $query = $this->db->get("alerts");
            $result = $query->result();


            return $result;
        }
        function add_alert($user, $text, $url, $icon, $tag)
        {
            $this->db->where("user", $user);
            $this->db->where("text", $text);
            $this->db->where("url", $url);
            $query = $this->db->get("alerts");
            $result = $query->result();
            if($result)
            {
                return;
            }

            $data = array(
                "user"  => $user,
                "text"  => $text,
                "url"   => $url,
                "icon"  => $icon,
                "tag"   => $tag
                );

            $this->db->insert("alerts", $data);
        }
        function add_group($data)
        {
            if($this->group_already_used($data['group']))
                return 0;
 
            $data = array(
                'name'              => $data['group'],
                'description'       => $data['description'],
                'allow_posts'       => intval($data['posts']),
                'allow_categories'  => intval($data['categories']),
                'use_created_categories'    => intval($data['use_created_categories']),
                'default_user_post_category'=> $data['default_user_post_category'],
            );
 
            $this->db->insert('user_groups', $data);
            return $this->db->insert_id();
        }
 
        function edit_group($data)
        {
 
            $update = array(
                'name'                      => $data['group'],
                'description'               => $data['description'],
                'allow_posts'               => intval($data['posts']),
                'allow_categories'          => intval($data['categories']),
                'use_created_categories'    => intval($data['use_created_categories']),
                'default_user_post_category'=> $data['default_user_post_category'],
            );
 
            $this->db->where('id', $data['id']);
            $this->db->update('user_groups', $update);
        }
 
        function delete($id)
        {
            $this->db->delete('users', array('id' => $id));
			$this->db->delete('link_groups_users', array('user_id' => $id));
			$this->delete_extended_info($id); #delete#
			$data['user_id'] = $id;
			$this->extended_info('delete',$data);
			$this->delete_subscriptions($id);
			$moduleSettings = array(
				'AudioPlayerUserSettings',
				'PhotoGalleryUserSettings',
				'VideoTubeUserSettings',
				//'VideoStreamUserSettings'
			);
			foreach($moduleSettings as $moduleSetting){
				$this->revoke_module_access($id,$moduleSetting);
			}
			deleteDirectoryFiles($_SERVER['DOCUMENT_ROOT'].'/files/users/user_'.$id);
        }
        function upload_avatar($username,$user_id = null)
        {
            if(!is_dir("files"))
                mkdir("files");
			
			if($user_id){
            if(!is_dir("files/avatars"))
                mkdir("files/avatars");
			}else{
				if(!is_dir("files/users"))
					mkdir("files/users");
				if(!is_dir("files/users/user_".$user_id))
					mkdir("files/users/user_".$user_id);
				 if(!is_dir("files/users/user_".$user_id."/avatars"))
					mkdir("files/users/user_".$user_id."/avatars");
			}
 
            $this->load->library('upload');
 
            $file = 'avatar';
            // Check if there was a file uploaded - there are other ways to
            // check this such as checking the 'error' for the file - if error
            // is 0, you are good to code
 
 
            // Specify configuration for File
            $config['file_name'] = $username.".jpg";
            $config['upload_path'] = 'files/users/user_/'.$user_id.'/avatars';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '11100';
            $config['max_width']  = '22048';
            $config['max_height']  = '22048';
            $config['overwrite']  = true;
 
            // Initialize config for File
            $this->upload->initialize($config);
 
            // Upload file
            if ($this->upload->do_upload($file))
            {
                $result = $this->upload->data();
            }
 
     
        }
		function notify_admin($subject = null,$message = null)
		{
			$this->load->model("builderengine");
            $to = $this->builderengine->get_option("adminemail");
			if(!$message || !$subject){
				$subject = 'New User Registration !';
				$message = '<h2>New user has been registered!</h2><br/>Log in to '. $_SERVER['HTTP_HOST'].' to check out new account created <a href="'.base_url('admin/main/login').'">Here</a>.';
			}
            $headers = 'MIME-Version: 1.0' . "\r\n".
                'Content-type: text/html; charset=iso-8859-1' . "\r\n".
                'From: "'.$this->BuilderEngine->get_option("website_title").'" <'.$this->BuilderEngine->get_option("email_address") .'>'. "\r\n" .
                'Reply-To: '.$this->builderengine->get_option("email_address") . "\r\n" .
                'mailed-by: '.$this->builderengine->get_option("email_address") . "\r\n";

            mail($to, $subject, $message, $headers);		
		}
        function send_password_reset_email($email)
        {
			if($this->email_already_used(trim($email))){
				$token = md5(time().rand(0,99999999999999999999));
				$protocol = strtolower(substr($_SERVER['SERVER_PROTOCOL'],0,strrpos($_SERVER['SERVER_PROTOCOL'],'/'))).'://';
				$url = $_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,strrpos($_SERVER['SCRIPT_NAME'],'index.php'));
				$site_url = $protocol.$url;
				if($email == $this->BuilderEngine->get_option('adminemail') && $this->BuilderEngine->get_option('user_dashboard_activ') == 'no')
					$link = $site_url."admin/main/recover_password/".$token;
				else
					$link = $site_url."cp/recover_password/".$token;

				$to      = $email;
				$subject = 'Password Reset Token';
				$message = '<h2>Password Reset</h2><br>We have received a password reset request for your account at '. $_SERVER['HTTP_HOST'].'<br>To reset your password please click <a href="'.$link.'">HERE</a>.';
				$headers = 'MIME-Version: 1.0' . "\r\n".
					'Content-type: text/html; charset=iso-8859-1' . "\r\n".
					'From: no-reply@'.$_SERVER['HTTP_HOST'] . "\r\n" .
					'Reply-To: no-reply@'.$_SERVER['HTTP_HOST'] . "\r\n" .
					'mailed-by: no-reply@'.$_SERVER['HTTP_HOST'] . "\r\n";

				mail($to, $subject, $message, $headers);

				$update = array("pass_reset_token" => $token);
				$this->db->where("email", $email);
				$this->db->update("users", $update);
			}
        }
        function send_registration_email($email,$id)
        {
            $this->load->model("builderengine");

            $token = md5(time().$id.rand(0,99999999999999999999));
			$protocol = strtolower(substr($_SERVER['SERVER_PROTOCOL'],0,strrpos($_SERVER['SERVER_PROTOCOL'],'/'))).'://';
			$url = $_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,strrpos($_SERVER['SCRIPT_NAME'],'index.php'));
			$site_url = $protocol.$url;
            $link = $site_url."admin/main/approve_account/".$token;
            $to      = $email;
            $subject = 'Activate Your Account';
            $message = $this->builderengine->get_option('register_email') . $_SERVER['HTTP_HOST'].'.<br/><br/>To activate your account please click <a href="'.$link.'" style="background:teal;padding:5px 8px;color:white;border-radius:5px;text-decoration:none;"> HERE </a>';
            $headers = 'MIME-Version: 1.0' . "\r\n".
                'Content-type: text/html; charset=iso-8859-1' . "\r\n".
                'From: "'.$this->BuilderEngine->get_option("website_title").'" <'.$this->BuilderEngine->get_option("email_address") .'>'. "\r\n" .
                'Reply-To: '.$this->builderengine->get_option("email_address") . "\r\n" .
                'mailed-by: '.$this->builderengine->get_option("email_address") . "\r\n";

            mail($to, $subject, $message, $headers);

            $update = array("cache_token" => $token);
            $this->db->where(array("email" => $email, 'id' => $id));
            $this->db->update("users", $update);
        }
        function send_email_message($email,$option,$subject)
        {
            $this->load->model("builderengine");
            $to      = $email;
            $message = $this->builderengine->get_option($option). $_SERVER['HTTP_HOST'].'.';
            $headers = 'MIME-Version: 1.0' . "\r\n".
                'Content-type: text/html; charset=iso-8859-1' . "\r\n".
                'From: "'.$this->BuilderEngine->get_option("website_title").'" <'.$this->BuilderEngine->get_option("email_address") .'>'. "\r\n" .
                'Reply-To: '.$this->builderengine->get_option("email_address") . "\r\n" .
                'mailed-by: '.$this->builderengine->get_option("email_address") . "\r\n";

            mail($to, $subject, $message, $headers);
        }
        function send_custom_email_message($email,$subject,$message)
        {
			$this->load->model("builderengine");
            $headers = 'MIME-Version: 1.0' . "\r\n".
                'Content-type: text/html; charset=iso-8859-1' . "\r\n".
                'From: "'.$this->BuilderEngine->get_option("website_title").'" <'.$this->BuilderEngine->get_option("email_address") .'>'. "\r\n" .
                'Reply-To: '.$this->builderengine->get_option("email_address") . "\r\n" .
                'mailed-by: '.$this->builderengine->get_option("email_address") . "\r\n";

            mail($email, $subject, $message, $headers);
        }
		function send_html_email($recipient_email, $subject, $template, $message, $sender_email = false, $company = false)
		{
			$data = array(
				'subject'   => $subject,
				'message'   => $message,
				'company'   => $this->get_company($company)
			);
			$user = new User();
			$user = $user->where('email',trim($recipient_email))->get();
			if($user->exists())
				$data['recipient'] = $user;
			if(!$sender_email)
				$sender_email = $this->BuilderEngine->get_option("email_address");
			$headers = 'MIME-Version: 1.0' . "\r\n".
				'Content-type: text/html; charset=iso-8859-1' . "\r\n".
				'From: "'.$this->BuilderEngine->get_option("website_title").'" <'.$sender_email .'>'. "\r\n" .
				'Reply-To: '.$sender_email . "\r\n" .
				'mailed-by: '.$sender_email . "\r\n";

			$html_message = $this->load->view($template, $data, true);

			mail($recipient_email, $subject, $html_message, $headers);
		}
		function send_email($recipient_email, $subject, $message, $template, $reply = false, $attachment = false, $sender_email = false, $company = false)
		{
			$data = array(
				'subject'   => $subject,
				'message'   => $message,
				'company'   => $this->get_company($company)
			);
			$html = $this->load->view($template, $data, true);

			$user = new User();
			$user = $user->where('email',trim($recipient_email))->get();

			if($user->exists())
				$data['recipient'] = $user;
			if(!$sender_email)
				$sender_email = $this->BuilderEngine->get_option("email_address");

			$sender_name = $this->BuilderEngine->get_option("website_title");

			$this->load->library('email');
			$config = array(
				'charset' => 'iso-8859-1',
				'wordwrap' => TRUE,
				'mailtype' => 'html',
			);
			$this->email->initialize($config);
			$this->email->from($sender_email, $sender_name);
			$this->email->to($recipient_email);
			if($reply)
				$this->email->reply_to($sender_email, $sender_name);
			$this->email->subject($subject);
			$this->email->message($html);
			if($attachment)
				$this->email->attach($attachment);
			$this->email->send();
			if($attachment)
				$this->email->clear(TRUE);
		}
        function reset_password($token, $password)
        {
            $update = array(
                "password"          => md5($password),
                "pass_reset_token"  => "");
            $this->db->where("pass_reset_token", $token);

            $this->db->update("users", $update);
        }
        function activation_account($token)
        {
            $user = $this->db->get_where('users',array("cache_token" => $token))->row();

            $this->send_email_message($user->email,'verification_email','Account Activation Complete');
            $this->send_email_message($user->email,'welcome_email','Welcome');
            $update = array("verified"  => "yes","cache_token" => "");
            $this->db->where("cache_token", $token);
            $this->db->update("users", $update);

            return $user;
        }
        function edit($data){
            $update = array(
                'first_name'        => $data['first_name'],
                'last_name'         => $data['last_name'],
                'username'         => $data['username'],
                'email'             => $data['email'],
                'avatar'            => $data['avatar']
                //'level'             => $data['level'],
            );
 
            $user = $this->get_by_id($data['id']);
            $username = $user->username;
			if(empty($update['avatar']))
				$update['avatar'] = $user->avatar;
            $this->upload_avatar($username,$data['id']);
 
            if(strlen($data['password']) > 1)
                $update['password'] = md5($data['password']);
 
            $this->db->where('id', $data['id']);
            $this->db->update('users', $update);
 
            $this->set_user_groups_by_name($data['id'], $data['groups']);
            return true;
        }
 
        function get($search = "",$data = array())
        {
            $search = mysql_real_escape_string($search);
            if($search != "")
                $this->db->where("`username` like '%".$search."%'", NULL, FALSE);
            if(!empty($data))
                    $this->db->where($data);

            $this->db->limit(1500);
            $query = $this->db->get("users");
            return $query->result();
        }

        public function user_verified($user_id, $status)
        {
            $data = array(
                'verified' => $status
                );
            $this->db->where('id', $user_id);
            $this->db->update('users', $data);
        }
 
        function get_group_by_id($id)
        {
            $id = mysql_real_escape_string($id);
            $this->db->where("`id` = '".$id."'", NULL, FALSE);
 
            $this->db->limit(1);
            $query = $this->db->get("user_groups");
            $result = $query->result();
            return $result[0];
        }
 
        function get_user_group_ids($user)
        {
            $id = mysql_real_escape_string($user);
            $this->db->where("`user_id` = '".$id."'", NULL, FALSE);
 
            $this->db->from("link_groups_users");
            $this->db->join('user_groups', 'user_groups.id = link_groups_users.group_id');
            $query = $this->db->get();
 
            $groups = array();
            foreach($query->result() as $group)
            {
                array_push($groups, intval($group->id));
            }
 
            return $groups;
        }
        function get_user_group_name($user)
        {
            $id = mysql_real_escape_string($user);
            $this->db->where("`user_id` = '".$id."'", NULL, FALSE);

            $this->db->from("link_groups_users");
            $this->db->join('user_groups', 'user_groups.id = link_groups_users.group_id');
            $query = $this->db->get();

            $groups = array();
            foreach($query->result() as $group)
            {
                array_push($groups,$group->name);
            }

            return $groups;
        }
        function get_groups($search = "")
        {
            $search = mysql_real_escape_string($search);
            if($search != "")
                $this->db->where("`name` like '%".$search."%'", NULL, FALSE);
 
            $this->db->limit(1500);
            $query = $this->db->get("user_groups");
            return $query->result();
        }
        function get_group_name_by_id($group_id)
        {
 
            $this->db->where('id', $group_id);
            $query = $this->db->get("user_groups");
            $result = $query->result();
 
            return $result[0]->name;
        }
        function get_groups_string($user)
        {
            $this->db->where('user_id', $user);
            $query = $this->db->get("link_groups_users");
            $result = $query->result();
 
 
            $groups = array();
            foreach($result as $group)
            {
                $group_name = $this->get_group_name_by_id($group->group_id);
                array_push($groups, $group_name);
            }
 
            $result = implode(",", $groups);
 
            return $result;
        }
        function get_by_id($id)
        {
            $id = mysql_real_escape_string($id);
            $this->db->where("`id` = '".$id."'", "LIMIT 1", FALSE);
 
            $query = $this->db->get("users");
            $result = $query->result();

            if(!$result)
                return null;
            $result = $result[0];
 
            $obj = (object) array_merge( (array)$result, array( 'groups_string' => $this->get_groups_string($id) ) );
            return $obj;
        }
        function is_admin()
        {
            foreach ($this->get_user_group_ids(get_active_user_id()) as $key => $value) {
                if($this->get_group_by_id($value)->name == 'Administrators')
                    return true;
            }
            return false;
        }
        function is_admin_by_id($id)
        {
            foreach ($this->get_user_group_ids($id) as $key => $value) {
                if($this->get_group_by_id($value)->name == 'Administrators')
                    return true;
            }
            return false;
        }
        function email_already_used($email = ""){
            $email = mysql_real_escape_string($email);
 
            $this->db->where(array('email' => $email));
            $this->db->from("users");
 
            $count = $this->db->count_all_results();
            return $count != 0;
        }
 
        function username_already_used($username = ""){
            $username = mysql_real_escape_string($username);
 
            $this->db->where(array('username' => $username));
            $this->db->from("users");
 
            $count = $this->db->count_all_results();
            return $count != 0;
        }
 
        function group_already_used($username = ""){
            $username = mysql_real_escape_string($username);
 
            $this->db->where(array('name' => $username));
            $this->db->from("user_groups");
 
            $count = $this->db->count_all_results();
            return $count != 0;
        }

        function verify_login($username, $password, $admin = false)
		{
			$this->load->model('builderengine');
			switch($this->builderengine->get_option('user_login_option'))
			{
				case 'username':
					$where = array(
						'username'  => $username,
						'password'  => md5($password),
						'verified'  => 'yes',
					);
					$this->db->where($where);
					break;
				case 'email':
					$where = array(
						'email'  => $username,
						'password'  => md5($password),
						'verified'  => 'yes',
					);
					$this->db->where($where);
					break;
				case 'both':
					$this->db->where("(email = '$username' OR username = '$username') 
					AND password = md5('$password') AND verified = 'yes'");
					break;
				case null:
					$where = array(
						'username'  => $username,
						'password'  => md5($password),
						'verified'  => 'yes',
					);
					$this->db->where($where);
			}
			
            $query = $this->db->get("users");
            $result = $query->result();
 
            if(count($result) != 1)
                return 0;
 
            $result = $result[0];
			$this->check_and_fix_extended_info($result->id);
			$this->register_user_access($result->id);
            return $result->id;
        }
 
        function verify_admin_login($username, $password)
        {
            return $this->verify_login($username, $password, true);
        }

		function add_extended_info($user_id,$data) #delete#
		{
			$this->db->insert('ecommerce_users_extend', $data);
			$user_extended_id = $this->db->insert_id();
			$insert = array(
				'member_id' => $user_id,
				'extended_info_id' => $user_extended_id
			);
			$this->db->insert('ecommerce_member_extended_info_links', $insert);
		}

		function update_extended_info($user_id,$data) #delete#
		{
            $this->db->where('member_id', $user_id);
            $query = $this->db->get("ecommerce_member_extended_info_links");
            $result = $query->result();
			if(!empty($result)){
				$this->db->where('id', $result[0]->extended_info_id);
				$this->db->update('ecommerce_users_extend', $data);
			}else{
				$this->add_extended_info($user_id,$data);
			}
		}

		function get_extended_info($user_id) #delete#
		{
            $this->db->where('member_id', $user_id);
            $query = $this->db->get("ecommerce_member_extended_info_links");
            $user = $query->result();
			
            $this->db->where('id', $user[0]->extended_info_id);
            $query = $this->db->get("ecommerce_users_extend");
			return $query->result();
		}

		function delete_extended_info($user_id) #delete#
		{
            $this->db->where('member_id', $user_id);
            $query = $this->db->get("ecommerce_member_extended_info_links");
            $result = $query->result();
			$this->db->delete("ecommerce_member_extended_info_links",array('member_id' => $user_id));	

			$this->db->delete('ecommerce_users_extend', array('id' => $result[0]->extended_info_id));
		}

		function install_admin_extended_info($data)
		{
			$this->db->insert('be_users_extended', $data);
		}

		function extended_info($action,$data)
		{
			$extended = new UserExtended();
			if($action == 'create'){
				$extended->create($data);
			}
			if($action == 'update'){
				$extended = $extended->where('user_id',$data['user_id'])->get();
				$extended->create($data);
			}
			if($action == 'delete'){
				$extended = $extended->where('user_id',$data['user_id'])->get();
				$extended->delete();
			}
		}

		function delete_subscriptions($user_id)
		{
			$subscriptions = new UserSubscription();
			$subscriptions = $subscriptions->where('user_id',$user_id)->get();
			if($subscriptions->exists())
				$subscriptions->delete_all();
		}

		# Check All Users Subscriptions #
		function check_all_subscriptions()
		{
			$u = new User();
			foreach($u->get() as $usr){
				if($usr->subscribed->get()->exists()){
					$usr->subscribed->check();
				}
			}
		}

		function check_and_fix_extended_info($user_id)
		{
			$e = new UserExtended();
			$extended_info = $e->where('user_id',$user_id)->get();
			if(!$extended_info->exists()){
				$data = array(
					'user_id' => $user_id,
					'telephone' => 'none',
					'address' => 'none',
					'city' => 'none',
					'state' => 'none',
					'zip' => 'none',
					'country' => '',
				);
				$this->extended_info('create',$data);
			}
		}

		function approve_module_access($user_id)
		{
			$data = array(
				'user_id' => $user_id,
				'about'   => '',
				'background_img' => '', 
			);
			$audioPlayer = new AudioPlayerUserSettings();
			$audioPlayer->create($data);
			$photoGallery = new PhotoGalleryUserSettings();
			$photoGallery->create($data);
			//$videoStream = new VideoStreamUserSettings();
			//$videoStream->create($data);
			$videoTube = new VideoTubeUserSettings();
			$videoTube->create($data);
		}

		function revoke_module_access($user_id,$moduleSettings)
		{
			$moduleAccess = new $moduleSettings();
			$moduleAccess = $moduleAccess->where('user_id',$user_id)->get();
			$moduleAccess->delete();
		}

		function register_user_access($user_id)
		{
			$u = new UserExtended();
			$usr = $u->where('user_id',$user_id)->get();
			$usr->last_ip = $this->input->ip_address();
			$usr->last_user_agent = $this->builderengine->get_user_agent();
			$usr->last_ua_version = $this->builderengine->get_user_agent_version();
			$usr->last_os = $this->builderengine->get_os();
			$usr->last_device = $this->builderengine->get_device();
			$usr->save();
		}

		/**
		 * Check if login attempts exceeded max login attempts (specified in be_options DB table)
		 *
		 * @param	string
		 * @return	bool
		 */
		function is_max_login_attempts_exceeded($login)
		{
			if ($this->BuilderEngine->get_option('login_count_attempts') == 'yes') {
				$this->load->model('login_attempts');
				if($this->login_attempts->get_attempts_num($this->input->ip_address(), $login) >= $this->BuilderEngine->get_option('login_max_attempts')){
					$user = new User();
					if($this->BuilderEngine->get_option('user_login_option') == 'both')
						$user = $user->where('username',$login)->or_where('email',$login)->get();
					if($this->BuilderEngine->get_option('user_login_option') == 'username')
						$user = $user->where('username',$login)->get();
					if($this->BuilderEngine->get_option('user_login_option') == 'email')
						$user = $user->where('email',$login)->get();
					if($user->exists()){
						if(	$user->banned == 0 && $this->BuilderEngine->get_option('notify_admin_about_banned_user') == 'yes')
							$this->notify_admin('User banned!','<h2>User email: '.$user->email.' </h2><h4>Reason: Too Many attempts</h4><br/>Log in to '. $_SERVER['HTTP_HOST'].' to take action <a href="'.base_url('admin/main/login').'">Here</a>.');
						$user->banned = 1;
						$user->ban_reason = 'Too many login attempts';
						$user->save();
					}
					return TRUE;
				}
			}
			return FALSE;
		}

		/**
		 * Increase number of attempts for given IP-address and login
		 * (if attempts to login is being counted)
		 *
		 * @param	string
		 * @return	void
		 */
		function increase_login_attempt($login)
		{
			if ($this->BuilderEngine->get_option('login_count_attempts') == 'yes') {
				if (!$this->is_max_login_attempts_exceeded($login)) {
					$this->load->model('login_attempts');
					$this->login_attempts->increase_attempt($this->input->ip_address(), $login);
				}
			}
		}

		/**
		 * Clear all attempt records for given IP-address and login
		 * (if attempts to login is being counted)
		 *
		 * @param	string
		 * @return	void
		 */
		function clear_login_attempts($login)
		{
			if ($this->BuilderEngine->get_option('login_count_attempts') == 'yes') {
				$this->load->model('login_attempts');
				$this->login_attempts->clear_attempts(
					$this->input->ip_address(),
					$login,
					$this->BuilderEngine->get_option('login_attempt_expire')
				);
			}
		}

		/**
		 * Ban user
		 *
		 * @param	int
		 * @param	string
		 * @return	void
		 */
		function ban_user($user_id, $reason = NULL)
		{
			$this->db->where('id', $user_id);
			$this->db->update('users', array('banned' => 1, 'ban_reason' => $reason));
		}

		/**
		 * Unban user
		 *
		 * @param	int
		 * @return	void
		 */
		function unban_user($user_id,$admin = false)
		{
			$this->db->where('id', $user_id);
			$this->db->update('users', array('banned' => 0,'ban_reason' => ''));
			if($admin){
				$user = new User($user_id);
				$this->db->where('login', $user->username);
				$this->db->or_where('login', $user->email);
				$this->db->delete('be_user_login_attempts');
			}
		}

		public function get_company($company = false)
		{
			if($company)
			{
				$data = array(
					'name' => ($this->BuilderEngine->get_option('be_'.$company.'_company_name') != null)?$this->BuilderEngine->get_option('be_'.$company.'_company_name'):'',
					'logo' => ($this->BuilderEngine->get_option('be_'.$company.'_company_logo') != null)?$this->BuilderEngine->get_option('be_'.$company.'_company_logo'):'',
					'address' => ($this->BuilderEngine->get_option('be_'.$company.'_company_address') != null)?$this->BuilderEngine->get_option('be_'.$company.'_company_address'):'',
					'phone' => ($this->BuilderEngine->get_option('be_'.$company.'_company_phone') != null)?$this->BuilderEngine->get_option('be_'.$company.'_company_phone'):'',
					'email' => ($this->BuilderEngine->get_option('be_'.$company.'_company_email') != null)?$this->BuilderEngine->get_option('be_'.$company.'_company_email'):'',
					'tax_vat_number' => ($this->BuilderEngine->get_option('be_'.$company.'_company_tax_vat_number') != null)?$this->BuilderEngine->get_option('be_'.$company.'_company_tax_vat_number'):'',
					'zip' => ($this->BuilderEngine->get_option('be_'.$company.'_company_zip') != null)?$this->BuilderEngine->get_option('be_'.$company.'_company_zip'):'',
					'city' => ($this->BuilderEngine->get_option('be_'.$company.'_company_city') != null)?$this->BuilderEngine->get_option('be_'.$company.'_company_city'):'',
					'country' => ($this->BuilderEngine->get_option('be_'.$company.'_company_country') != null)?$this->BuilderEngine->get_option('be_'.$company.'_company_country'):'',
					'bank_account_number' => ($this->BuilderEngine->get_option('be_'.$company.'_company_bank_account_number') != null)?$this->BuilderEngine->get_option('be_'.$company.'_company_bank_account_number'):'',
					'payment_option' => ($this->BuilderEngine->get_option('be_'.$company.'_company_payment_option') != null)?$this->BuilderEngine->get_option('be_'.$company.'_company_payment_option'):'',
					'additional_info' => ($this->BuilderEngine->get_option('be_'.$company.'_company_additional_info') != null)?$this->BuilderEngine->get_option('be_'.$company.'_company_additional_info'):'',
				);
			}else
				$data = array();
			return $data;
		}

		public function get_all_user_company_names()
		{
			$users = new User();
			$companies = array();
			foreach($users->get() as $user)
			{
				$user_company = $user->extended->get()->company;
				if($user_company != null || $user_company != '')
					if(!in_array($user_company,$companies))
						array_push($companies,$user_company);
			}
			return $companies;
		}

		public function get_users_by_company_name($company_name)
		{
			$users = new User();
			$users = $users->where_related_extended('company',$company_name)->get();
			if($users->exists())
			{
				return $users;
			}
			return false;
		}
    }
?>