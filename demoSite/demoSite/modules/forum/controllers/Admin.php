<?php
    class Admin extends BE_Controller
    {
        // [MenuItem ("Forum/Areas/Add")]
        public function add_area()
        {
            $this->modify_object('area');
        }
        // [MenuItem ("Forum/Areas/Show")]
        public function show_area()
        {
            $this->show_objects('area');
        }
        // [MenuItem ("Forum/Forums/Add")]
        public function add_topic()
        {
            $this->modify_object('forum_topic');
        }
        // [MenuItem ("Forum/Forums/Show")]
        public function show_topics()
        {
            $this->show_objects('forum_topic');
        }
        // [MenuItem ("Forum/Threads/Add")]
        public function add_category()
        {
            $this->modify_object('forum_category');
        }
        // [MenuItem ("Forum/Threads/Show")]
        public function show_categories()
        {
            $this->show_objects('forum_category');
        }
        // [MenuItem ("Forum/Posts/Add")]s
        public function add_thread()
        {
            $this->modify_object('forum_thread');
        }
        // [MenuItem ("Forum/Posts/Show")]
        public function show_threads()
        {
            $this->show_objects('forum_thread');
        }
        public function modify_object($object_type, $object_id = -1)
        {
            $object = $this->get_object($object_type, $object_id);
            
            if($_POST){
				if($object_type == 'forum_thread'){
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
						if(empty($errors)==true)
							move_uploaded_file($file_tmp,"files/".$file_name);
						$file_name = base_url().'files/'.$_FILES['attachment']['name'];
						$target = ($file_ext == 'pdf')?'target="_blank"':'';
						$attachment = '<a href="'.$file_name.'" class="btn btn-xs btn-warning" '.$target.'> '.$_FILES['attachment']['name'].' <i class="fa fa-download"></i></a>';
						$_POST['text'] = $_POST['text'].$attachment;
					}
				}
                $object->create($_POST);
                redirect(base_url('/index.php/admin/module/forum/show_objects/'.$object_type), 'location');
            }
            
            $data['view'] = $this->get_view($object_type,  $object_id);
			$name = $object_type;
			if($object_type == 'forum_topic')
				$name = str_replace('forum_topic','forum',$object_type);
			if($object_type == 'forum_thread')
				$name = str_replace('forum_thread','post',$object_type);
			if($object_type == 'forum_category')
				$name = str_replace('forum_category','thread',$object_type);

			$data['current_page'] = 'forum';
			$data['current_child_page'] = $object_type;
            $data['title'] = ucfirst($name);
            $this->load->view('backend/modify_object', $data);
        }

        public function delete_object($object_type, $object_id)
        {
            $object = $this->get_object($object_type, $object_id);
            $object->delete();
            redirect(base_url('/index.php/admin/module/forum/show_objects/'.$object_type), 'location');
        }

		public function bulk_delete($object_type,$view)
		{
			if($_POST){
				foreach($_POST['id'] as $id){
					if($object_type == 'Area')
						$this->delete_area($object_type,$id);
					if($object_type == 'Forum_topic')
						$this->delete_topic($object_type,$id);
					if($object_type == 'Forum_category')
						$this->delete_thread($object_type,$id);
					if($object_type == 'Forum_thread')
						$this->delete_post($object_type,$id);
				}
				redirect(base_url('admin/module/forum/'.$view),'location');
			}
		}

        public function get_object($object_type, $object_id = -1, $get = false)
        {
            $this->load->model($object_type);
            $object = new $object_type($object_id);

            if($get == true)
                return $object->get();
            else
                return $object;
        }

        public function get_view($object_type, $object_id = -1)
        {
            $view_name = 'add_'.$object_type;

            if($object_id == -1)
                $data['page'] = 'Add';
            else
                $data['page'] = 'Edit';

            $data['object'] = $this->get_object($object_type, $object_id);
            $view = $this->load->view('backend/'.$view_name, $data, true);
            return $view;
        }

        public function show_objects($object_type)
        {

            $user = new users();
            $group_id = $user->get_user_group_ids(get_active_user_id());
            $condition = false;
            if($object_type == 'forum_thread') {
                foreach ($group_id as $key => $value) {
                    if($user->get_group_by_id($value)->allow_posts == '1')
                        $condition = true;
                }
            } elseif ( $object_type == 'forum_category' ) {
                foreach ($group_id as $key => $value) {
                    if($user->get_group_by_id($value)->allow_categories == '1')
                        $condition = true;
                }
            }

            $data['objects'] = $this->get_object($object_type, '', true);
            $data['condition'] = $condition;
			$data['current_page'] = 'forum';
			$data['current_child_page'] = $object_type;	
            $this->load->view('backend/show_'.$object_type.'_objects', $data);
        }
		
		public function toggle_lock_category($object_type,$object_id,$lock_status)
		{
			$this->load->model($object_type);
			$object = new $object_type($object_id);
			if($lock_status == 'yes')
				$object->locked = 'no';
			else
				$object->locked = 'yes';
			
			$object->save();
				
			redirect(base_url('/index.php/admin/module/forum/show_objects/'.$object_type), 'location');
		}
		
        // [MenuItem ("Forum/Settings")]
        public function settings()
        {
            if($_POST)
            {
				$protocol = strtolower(substr($_SERVER['SERVER_PROTOCOL'],0,strrpos($_SERVER['SERVER_PROTOCOL'],'/'))).'://';
				$link = $_POST['forum_terms'];
				if(strpos($link, $protocol) !== false)
					$this->BuilderEngine->set_option('forum_terms', $link);
				else
					$this->BuilderEngine->set_option('forum_terms', $protocol.$link);

                $this->BuilderEngine->set_option('forum_active', $this->input->post('forum_active', true));
                $this->BuilderEngine->set_option('forum_visibility', $this->input->post('forum_visibility', true));
                $this->BuilderEngine->set_option('forum_access_groups', $this->input->post('forum_access_groups', true));
				$this->BuilderEngine->set_option('forum_num_posts_displayed', $this->input->post('forum_num_posts_displayed', true));
				$this->BuilderEngine->set_option('forum_num_categories_displayed', $this->input->post('forum_num_categories_displayed', true));
				$this->BuilderEngine->set_option('forum_num_recent_posts_displayed', $this->input->post('forum_num_recent_posts_displayed', true));
				$this->BuilderEngine->set_option('forum_thread_image', $this->input->post('forum_thread_image', true));
				$this->BuilderEngine->set_option('forum_thread_admin_image', $this->input->post('image', true));
				$this->BuilderEngine->set_option('forum_register_info', $this->input->post('register_info', true));
				$this->BuilderEngine->set_option('forum_login_info', $this->input->post('login_info', true));
            }
			$this->set_forum_visibility();
			$data['current_page'] = 'forum';
			$data['current_child_page'] = 'settings';	
            $this->load->view('backend/forum_settings',$data); 
        }
		
        public function set_forum_visibility()
        {
            if($this->BuilderEngine->get_option('forum_visibility') == 'private'){
				$user_agent = "User-Agent: *\n";
				$rule ="Disallow: /modules/forum";
			}
			else{
				$user_agent = "User-Agent: *\n";
				$rule ="Disallow: ";			
			}
			$robot = fopen($_SERVER['DOCUMENT_ROOT'] . '/robots.txt', "w") or die("Unable to open file!");
			fwrite($robot,$user_agent);
			fwrite($robot,$rule);
			fclose($robot);
        }

		public function delete_post($object,$id, $inplace = null)
		{
			$post = $this->forum_thread->where('id',$id)->get();
			
				$this->load->model('like');
				$likes = $this->like->where('post_id',$id)->get();
				foreach($likes as $like){
					$like->delete();
				}
			$post->delete();
			if($inplace)
				redirect(base_url('admin/module/forum/show_threads'), 'location');
		}

		public function delete_thread($object,$id,$inplace = null)
		{	
			$posts = $this->forum_thread->where('category_id',$id)->get();
			foreach($posts as $post){
				$this->load->model('like');
				$likes = $this->like->where('post_id',$post->id)->get();
				foreach($likes as $like){
					$like->delete();
				}				
				$post->delete();
			}
			$thread = $this->forum_category->where('id',$id)->get();
			$thread->delete();
			if($inplace)
				redirect(base_url('admin/module/forum/show_categories'), 'location');
		}

		public function delete_topic($object,$id,$inplace = null)
		{	
			$topic = $this->forum_topic->where('id',$id)->get();
			$topic->delete();
			$threads = $this->forum_category->where('topic_id',$id)->get();
			foreach($threads as $thread){
				$posts = $this->forum_thread->where('category_id',$thread->id)->get();
				foreach($posts as $post){
					$this->load->model('like');
					$likes = $this->like->where('post_id',$post->id)->get();
					foreach($likes as $like){
						$like->delete();
					}
					$post->delete();
				}
				$thread->delete();	
			}
			if($inplace)
				redirect(base_url('admin/module/forum/show_topics'), 'location');
		}

		public function delete_area($object,$id,$inplace = null)
		{
			$area = $this->area->where('id',$id)->get();
			
			$topics = $this->forum_topic->where('area_id',$id)->get();
			foreach($topics as $topic){
				$threads = $this->forum_category->where('topic_id',$topic->id)->get();
				foreach($threads as $thread){
					$posts = $this->forum_thread->where('category_id',$thread->id)->get();
					foreach($posts as $post){	
						$this->load->model('like');
						$likes = $this->like->where('post_id',$post->id)->get();
						foreach($likes as $like){
							$like->delete();
						}	
						$post->delete();
					}	
					$thread->delete();	
				}
				$topic->delete();
			}
			$area->delete();
			if($inplace)
				redirect(base_url('admin/module/forum/show_area'), 'location');
		}
		
    }
?>