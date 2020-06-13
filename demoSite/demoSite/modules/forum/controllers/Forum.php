<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function initialize_forum_js()
	{
		echo '
			<!-- ================== BEGIN BASE JS ================== -->
			<!--[if lt IE 9]>
				<script src="'.base_url('modules/forum/assets/crossbrowserjs/html5shiv.js').'"></script>
				<script src="'.base_url('modules/forum/assets/crossbrowserjs/respond.min.js').'"></script>
				<script src="'.base_url('modules/forum/assets/crossbrowserjs/excanvas.min.js').'"></script>
			<![endif]-->
			<script src="'.base_url('modules/forum/assets/plugins/jquery-cookie/jquery.cookie.js').'"></script>
			<script src="'.base_url('modules/forum/assets/js/apps.js').'"></script>
			<!-- ================== END BASE JS ================== -->
			
			<script>    
				$(document).ready(function() {
					App.init();
				});
			</script>	
			
		';
	}
	//add_action("be_foot", "initialize_forum_js");
	
class Forum extends Module_Controller {

    function __construct()
    {
        parent::__construct();
		$this->load->model('user');
		$this->load->model('area');
		$this->load->model('forum_topic');
		$this->load->model('forum_category');
		$this->load->model('forum_thread');
		$this->load->model('icon');
		$this->load->model('like');
		$this->load->model('users');
    }

	public function all_topics()
	{
		if($this->BuilderEngine->get_option('forum_active') != 'yes')
			show_404();

		$data['topics'] = $this->forum_topic->get();
		$data['areas'] = $this->area->get();
		$this->load->view('frontend/all_topics.tpl',$data);
	}

	public function area($area_name)
	{
		if($this->BuilderEngine->get_option('forum_active') != 'yes')
			show_404();

		$area_name = str_replace("%20"," ",$area_name);
		$data['area'] = $this->area->where('name',$area_name)->order_by('time_created','desc')->get();
		$this->load->view('frontend/area.tpl',$data);
	}
	
	public function topic($topic_name,$category = null,$category_id = null)
	{
		if($this->BuilderEngine->get_option('forum_active') !== 'yes')
			show_404();

		$page_num = 1;
		if(isset($_GET['page']))
			$page_num = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['page']);
		if(!$this->BuilderEngine->get_option('forum_num_recent_posts_displayed'))
			$num_recent_posts = 3;
		else
			$num_recent_posts = $this->BuilderEngine->get_option('forum_num_recent_posts_displayed');
		if(!$this->BuilderEngine->get_option('forum_num_categories_displayed'))
			$categories_per_page = 6;
		else
			$categories_per_page = $this->BuilderEngine->get_option('forum_num_categories_displayed');
		
		$topic_name = str_replace("%20"," ",$topic_name);
		$topic = $this->forum_topic->where('name',$topic_name)->get();
		$categories = $this->forum_category->where('topic_id',$topic->id)->order_by('time_created','desc')->get_paged($page_num,$categories_per_page);
		$data['categories'] = $categories;
		$data['topic'] = $topic;
		$data['area'] = $this->area->where('id',$topic->area_id)->get();
		$data['num_recent_posts'] = $num_recent_posts;
		if($category){
			$page_number = 1;
			if(isset($_GET['page']))
				$page_number = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['page']);
				
			if(!$this->BuilderEngine->get_option('forum_num_posts_displayed'))
				$posts_per_page = 6;
			else
				$posts_per_page = $this->BuilderEngine->get_option('forum_num_posts_displayed');
				
			if(isset($_POST['content'])){
				if(!$this->user->is_guest()){
					$user = new User($this->user->get_id());
					$user_id = $user->id;
					
					if(isset($_FILES['img']) && !empty($_FILES['img']['tmp_name'])){
						$file_name = $_FILES['img']['name'];
						$file_size =$_FILES['img']['size'];
						$file_tmp = $_FILES['img']['tmp_name'];
						$file_type = $_FILES['img']['type'];   
						$file_ext = strtolower(end(explode('.',$_FILES['img']['name'])));
						$extensions = array("jpeg","jpg","png");

						if(in_array($file_ext,$extensions )=== false)
							$errors[] ="This extension is not allowed, please choose a JPEG,JPG or PNG file.";
						if($file_size > 1000000)
							$errors[] ='File size must be less than 1 MB';	
						if(empty($errors)==true){
							if(!is_dir("files/users"))
								mkdir("files/users");
							if(!is_dir("files/users/user_".$user_id))
								mkdir("files/users/user_".$user_id);
							 if(!is_dir("files/users/user_".$user_id."/forum"))
								mkdir("files/users/user_".$user_id."/forum");
							 if(!is_dir("files/users/user_".$user_id."/forum/images"))
								mkdir("files/users/user_".$user_id."/forum/images");
							move_uploaded_file($file_tmp, $_SERVER['DOCUMENT_ROOT']."/files/users/user_".$user_id."/forum/images/".$file_name);
							$file_name = base_url()."files/users/user_".$user_id."/forum/images/".$_FILES['img']['name'];
							$img = '<img style="width:auto;max-width:100%;" src="'.$file_name.'" >';
						}
					}
					else
						$img ='';

					if(isset($_FILES['attachment']) && !empty($_FILES['attachment']['tmp_name'])){
						$file_name = $_FILES['attachment']['name'];
						$file_size =$_FILES['attachment']['size'];
						$file_tmp = $_FILES['attachment']['tmp_name'];
						$file_type = $_FILES['attachment']['type'];   
						$file_ext = strtolower(end(explode('.',$_FILES['attachment']['name'])));
						$extensions = array("zip","pdf");

						if(in_array($file_ext,$extensions )=== false)
							$errors[] ="This extension is not allowed, please choose a JPEG,JPG or PNG file.";
						if($file_size > 20000000)
							$errors[] ='File size must be less than 20 MB';	
						if(empty($errors)==true){
							if(!is_dir("files/users"))
								mkdir("files/users");
							if(!is_dir("files/users/user_".$user_id))
								mkdir("files/users/user_".$user_id);
							 if(!is_dir("files/users/user_".$user_id."/forum"))
								mkdir("files/users/user_".$user_id."/forum");
							 if(!is_dir("files/users/user_".$user_id."/forum/attachments"))
								mkdir("files/users/user_".$user_id."/forum/attachments");
							move_uploaded_file($file_tmp, $_SERVER['DOCUMENT_ROOT']."/files/users/user_".$user_id."/forum/attachments/".$file_name);
							$file_name = base_url()."files/users/user_".$user_id."/forum/attachments/".$_FILES['attachment']['name'];
							$target = ($file_ext == 'pdf')?'target="_blank"':'';
							$attachment = '<br/><br/><a href="'.$file_name.'" class="btn btn-xs btn-warning" '.$target.'> '.$_FILES['attachment']['name'].' <i class="fa fa-download"></i></a>';
							$_POST['content'] = $_POST['content'].$attachment;
						}
					}
					
					$text = stripslashes(str_replace('\r\n', '',$_POST['content']));
					$text .= $img;
					$data = array(
						'title' => $_POST['title'],
						'text' => $text,
						'image' => $this->get_avatar(),
						'category_id' => $_POST['category_id'],
						'groups_allowed' => 'Guests,Members',
						'user_id' => $user_id
					);
					$this->forum_thread->create($data);
					redirect($_SERVER['HTTP_REFERER']);
				}
				else
					redirect(base_url('/forum/login'), 'location');
			}
			if(isset($_POST['text'])){
				if(!$this->user->is_guest()){
					$user = new User($this->user->get_id());
					$user_id = $user->id;
					$id = $_POST['thread_id'];
					$data = array(
						'text' => stripslashes(str_replace('\r\n', '',$_POST['text'])),
						'time_created' => time(),
						'edited' => 'yes'
					);
					$this->forum_thread->where('id',$id)->update($data);
					redirect($_SERVER['HTTP_REFERER']);
				}
				else
					redirect(base_url('/forum/login'), 'location');
			}

			$currCategory = new Forum_category();
			$currCategory = $currCategory->where('id',$category_id)->get();
			$data = array('views'=> $currCategory->views + 1);
			$this->forum_category->where('id',$category_id)->update($data);
			
			$data['threads'] = $this->forum_thread->where('category_id',$category_id)->order_by('time_created','asc')->get_paged($page_number,$posts_per_page);
			$data['area'] = $this->area->where('id',$topic->area_id)->get();
			$data['category'] = $this->forum_category->where('id',$category_id)->get();
			$data['cat_id'] = $category_id;
			$this->load->view('frontend/category_thread.tpl',$data);
		}
		else
			$this->load->view('frontend/topic_categories.tpl',$data);
	}
	
	public function login($info = null)
	{
		if($this->BuilderEngine->get_option('forum_active') !== 'yes')
			show_404();

		$this->load->model('users');
		if($info == 'info')
			$data['info'] = 'You must be signed in or registered user to be able to post !';
		if($info == 'approval')
			$data['info'] = 'Your account has been registered and awaiting for approval.Once approved,you will be notified by email!';
		if($info == 'password')
			$data['info'] = 'Reset token has been sent to your email address!';
		if($_POST)
		{
			if(isset($_POST['email'])){
				$this->users->send_password_reset_email(urldecode($_POST['email']));
				redirect(base_url('forum/login/password'),'location');
			}

            $userid = $this->users->verify_login($_POST['username'], $_POST['password']);

			if($userid != -1 && $userid != 0){
				$this->user->initialize($userid);

				if(!is_dir("files/users"))
					mkdir("files/users");
				if(!is_dir("files/users/user_".$userid))
					mkdir("files/users/user_".$userid);
				 if(!is_dir("files/users/user_".$userid."/forum"))
					mkdir("files/users/user_".$userid."/forum");

				redirect(base_url('/forum/all_topics'), 'location');
			}
			else
			{
				$registered_user = new User();
				$registered_user = $registered_user->where('username',$_POST['username'])->where('password',md5($_POST['password']))->get();
				if($registered_user->id > 0 && $registered_user->verified == 'no'){
					$data['error_msg'] = 'Your account has been registered and awaiting for approval.Once approved,you will be notified by email!';
				}
				else
					$data['error_msg'] = 'Invalid username or password';
			}
		}
		$data['errors'] = '';
		$data['login_info'] = $this->BuilderEngine->get_option('forum_login_info');
		$this->load->view('frontend/login.tpl',$data);	
	}

	public function logout()
	{
		if($this->BuilderEngine->get_option('forum_active') !== 'yes')
			show_404();

		$this->user->logout(base_url('/forum/login'));
	}
	
	public function register()
	{
		if($this->BuilderEngine->get_option('forum_active') !== 'yes')
			show_404();

        $data['error'] = '';
		if($_POST){
            if($_POST['password'] != $_POST['password_re'])
                $data['error'] = 'password';
            else{
				if($this->BuilderEngine->get_option('forum_access_groups'))
					$_POST['groups'] = $this->BuilderEngine->get_option('forum_access_groups');			
                $created = $this->users->register_user($_POST);
                if($created != false){
                   // if(isset($_GET['token']) && $_GET['token'] != '')
                    redirect(base_url('/forum/login/approval'), 'location');
                }
                else
                    $data['error'] = 'exists';
            }
		}
		$forum_terms = $this->BuilderEngine->get_option('forum_terms');
		$data['register_info'] = $this->BuilderEngine->get_option('forum_register_info');
		$data['forum_terms'] = (!empty($forum_terms))?$forum_terms:'';
		$this->load->view('frontend/register.tpl', $data);	
	}
	
	public function new_thread($topic_id,$error = null)
	{
		if($this->BuilderEngine->get_option('forum_active') !== 'yes')
			show_404();

		if(!$this->user->is_guest()){
			if($_POST){
				if(!empty($_POST['title'])){
					$user = new User($this->user->get_id());
					$user_id = $user->id;
					$topic = $this->forum_topic->get_by_id($topic_id);

					$thread = array(
						'name' => $_POST['title'],
						'description' => stripslashes(str_replace('\r\n', '',$_POST['title'])),
						'image' => $this->get_thread_image(),
						'topic_id' => $topic_id,
						'groups_allowed' => 'Administrators,Guests,Members',
						'user_id' => $user_id
					);
					$this->forum_category->create($thread);
					$category = $this->forum_category->where('name',$_POST['title'])->where('description',$_POST['title'])->where('user_id',$user_id)->get();
						
						if(isset($_FILES['img']) && !empty($_FILES['img']['tmp_name'])){
							$file_name = preg_replace(array("/\s+/", "/[^-\.\w]+/"),array("_", ""),trim($_FILES['img']['name']));
							$file_size =$_FILES['img']['size'];
							$file_tmp = $_FILES['img']['tmp_name'];
							$file_type = $_FILES['img']['type'];   
							$file_ext = strtolower(end(explode('.',$_FILES['img']['name'])));
							$extensions = array("jpeg","jpg","png");

							if(in_array($file_ext,$extensions )=== false)
								$errors[] ="This extension is not allowed, please choose a JPEG,JPG or PNG file.";
							if($file_size > 1000000)
								$errors[] ='File size must be less than 1 MB';	
							if(empty($errors)==true){
								if(!is_dir("files/users"))
									mkdir("files/users");
								if(!is_dir("files/users/user_".$user_id))
									mkdir("files/users/user_".$user_id);
								 if(!is_dir("files/users/user_".$user_id."/forum"))
									mkdir("files/users/user_".$user_id."/forum");
								 if(!is_dir("files/users/user_".$user_id."/forum/images"))
									mkdir("files/users/user_".$user_id."/forum/images");
								move_uploaded_file($file_tmp, $_SERVER['DOCUMENT_ROOT']."/files/users/user_".$user_id."/forum/images/".$file_name);
								$file_name = base_url()."files/users/user_".$user_id."/forum/images/".$_FILES['img']['name'];
								$img = '<img style="width:auto;max-width:100%;" src="'.$file_name.'" >';
							}
						}
						else
							$img ='';
						
						if(isset($_FILES['attachment']) && !empty($_FILES['attachment']['tmp_name'])){
							$file_name = preg_replace(array("/\s+/", "/[^-\.\w]+/"),array("_", ""),trim($_FILES['attachment']['name']));
							$file_size =$_FILES['attachment']['size'];
							$file_tmp = $_FILES['attachment']['tmp_name'];
							$file_type = $_FILES['attachment']['type'];   
							$file_ext = strtolower(end(explode('.',$_FILES['attachment']['name'])));
							$extensions = array("zip","pdf");

							if(in_array($file_ext,$extensions )=== false)
								$errors[] ="This extension is not allowed, please choose a JPEG,JPG or PNG file.";
							if($file_size > 20000000)
								$errors[] ='File size must be less than 20 MB';	
							if(empty($errors)==true){
								if(!is_dir("files/users"))
									mkdir("files/users");
								if(!is_dir("files/users/user_".$user_id))
									mkdir("files/users/user_".$user_id);
								 if(!is_dir("files/users/user_".$user_id."/forum"))
									mkdir("files/users/user_".$user_id."/forum");
								 if(!is_dir("files/users/user_".$user_id."/forum/attachments"))
									mkdir("files/users/user_".$user_id."/forum/attachments");
								move_uploaded_file($file_tmp, $_SERVER['DOCUMENT_ROOT']."/files/users/user_".$user_id."/forum/attachments/".$file_name);
								$file_name = base_url()."files/users/user_".$user_id."/forum/attachments/".$_FILES['attachment']['name'];
								$target = ($file_ext == 'pdf' || $file_ext == 'zip')?'target="_blank"':'';
								$attachment = '<a href="'.$file_name.'" class="btn btn-xs btn-warning" '.$target.'> '.$file_name.' <i class="fa fa-download"></i></a>';
								$_POST['content'] = $_POST['content'].$attachment;
							}
						}
						
						$text = stripslashes(str_replace('\r\n', '',$_POST['content']));
						$text .= $img;
						
					$post = array(
						'title' => $_POST['title'],
						'text' => $text,
						'image' => $this->get_avatar(),
						'category_id' => $category->id,
						'groups_allowed' => 'Administrators,Guests,Members',
						'user_id' => $user_id
					);				
					$this->forum_thread->create($post);
					
					redirect(base_url('forum/topic/'.$topic->name.'/category/'.$category->id.''),'location');
				}
				else
					redirect(base_url('forum/new_thread/'.$topic_id.'/error'), 'location');
			
		    }
			$data['topic_id'] = $topic_id;
			$this->load->view('frontend/add_new_thread.tpl', $data);
		}
		else
			redirect(base_url('forum/login/info'), 'location');
	}
	
	public function delete_post($id)
	{
		if($this->BuilderEngine->get_option('forum_active') !== 'yes')
			show_404();

		$post = $this->forum_thread->where('id',$id)->get();
		$likes = new Like();
		$likes = $likes->where('post_id',$id)->get();
		$likes->delete();
		$post->delete();
		redirect($_SERVER['HTTP_REFERER']);
		
	}
	
    public function search($keyword = null)
    {
		if($this->BuilderEngine->get_option('forum_active') !== 'yes')
			show_404();

        $keyword = urldecode($keyword);
        $posts = $this->forum_thread->get();

        if(isset($_GET['keyword'])){
			$keywords = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['keyword']);
            redirect(base_url('/forum/search/'.$keywords), 'location');
		}
        $page_number = 1;
        if(isset($_GET['page']))
            $page_number = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['page']);
        if(!$this->BuilderEngine->get_option('forum_num_posts_displayed'))
            $posts_per_page = 6;
        else
            $posts_per_page = $this->BuilderEngine->get_option('forum_num_posts_displayed');

        $data['posts'] = $posts->like('title', $keyword)->or_like('text', $keyword)->order_by('time_created', 'desc')->get_paged($page_number, $posts_per_page);
        $data['keyword'] = $keyword;
        $this->load->view('frontend/search.tpl', $data);
    }
	
    function textFix($value){
        $order   = array("\\r\\n", "\\n", "\\r", "<p>&nbsp;</p>");
        $replace = array(" ", " ", " ", "");
        $value = str_replace($order, $replace, $value);
        if(strpos($value, 'src')){
            return preg_replace('/(\\\")/', '"',$value );
        }else{
            return $value;
        }
    }

	public function get_avatar($user_id)
	{
		$user = new User($this->user->get_id());
		$user_id = $user->id;
		$avatar = $user->avatar;
		if($user->avatar == null)
			$avatar = base_url().'modules/forum/assets/img/default_avatar.png';
		return $avatar;
	}
	
	public function get_thread_image()
	{
		$user = new User($this->user->get_id());
		$user_id = $user->id;
		$topic = $this->forum_topic->get_by_id($topic_id);
		
		switch($this->BuilderEngine->get_option('forum_thread_image')){
			case 'admin':
				$file_name = $this->BuilderEngine->get_option('forum_thread_admin_image');
				return $file_name;
				break;
			case 'avatar':
				if($user->avatar == null){
					$file_name = base_url().'modules/forum/assets/img/default_avatar.png';
					return $file_name;
				}
				else{
					$file_name = $user->avatar;
					return $file_name;
				}
				break;
			case 'custom':
				if(isset($_FILES['photo']) && !empty($_FILES['photo']['tmp_name'])){
					$errors= array();
					$file_name = $_FILES['photo']['name'];
					$file_size =$_FILES['photo']['size'];
					$file_tmp = $_FILES['photo']['tmp_name'];
					$file_type = $_FILES['photo']['type'];   
					$file_ext = strtolower(end(explode('.',$_FILES['photo']['name'])));
					$extensions = array("jpeg","jpg","png");

					if(in_array($file_ext,$extensions )=== false)
						$errors[] ="This extension is not allowed, please choose a JPEG,JPG or PNG file.";
					if($file_size > 1000000)
						$errors[] ='File size must be less than 1 MB';	
					if(empty($errors)==true){
						if(!is_dir("files/users"))
							mkdir("files/users");
						if(!is_dir("files/users/user_".$user_id))
							mkdir("files/users/user_".$user_id);
						 if(!is_dir("files/users/user_".$user_id."/forum"))
							mkdir("files/users/user_".$user_id."/forum");
						 if(!is_dir("files/users/user_".$user_id."/forum/avatars"))
							mkdir("files/users/user_".$user_id."/forum/avatars");
						move_uploaded_file($file_tmp, $_SERVER['DOCUMENT_ROOT']."/files/users/user_".$user_id."/forum/avatars/".$file_name);
						$file_name = base_url().'files/'.$_FILES['photo']['name'];
					}else
						$file_name = '';
					return $file_name;
				}
				break;
			default:
				$file_name = 'http://placehold.it/64x64';
				return $file_name;
		}	
	}

	public function toggle_lock_thread($thread_id)
	{
		$thread = new Forum_category($thread_id);
		if($thread->locked == 'yes')
			$data = array('locked'=> 'no');
		else
			$data = array('locked'=> 'yes');
		$this->forum_category->where('id',$thread_id)->update($data);
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	public function calculateTime($time)
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
	
	public function getLabel($user_level)
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
}