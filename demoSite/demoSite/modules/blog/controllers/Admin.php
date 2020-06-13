<?php
    class Admin extends BE_Controller
    {
        // [MenuItem ("Blog/Blog Posts/Add New Blog Post")]
        public function add_post()
        {
            $this->modify_object('post');
        }
        // [MenuItem ("Blog/Blog Posts/Show All Blog Posts")]
        public function show_posts()
        {
            $this->show_objects('post');
        }
        // [MenuItem ("Blog/Blog Categories/Add New Category")]
        public function add_category()
        {
            $this->modify_object('category');
        }
        // [MenuItem ("Blog/Blog Categories/Show All Categories")]
        public function show_categories()
        {
            $this->show_objects('category');
        }
        // [MenuItem ("Blog/Blog Reports/Comment Reports")]
        public function show_comment_reports()
        {
            $this->show_objects('comment_report');
        }

        public function modify_object($object_type, $object_id = -1)
        {
            $object = $this->get_object($object_type, $object_id);
            
            if($_POST)
            {
                $object->create($_POST);
                redirect(base_url('/index.php/admin/module/blog/show_objects/'.$object_type), 'location');
            }
            
            $data['view'] = $this->get_view($object_type,  $object_id);
            $data['title'] = ucfirst($object_type);
			$data['current_page'] = 'blog';
			$data['current_child_page'] = $object_type;
            $this->load->view('backend/modify_object', $data);
        }

        public function delete_object($object_type, $object_id)
        {
            $object = $this->get_object($object_type, $object_id);
			if($object_type == 'category'){
				// get child categories
				$this->load->model('users');
				$categories = new Category();
				$categories = $categories->where('parent_id', $object_id)->get();
				$child_categories = array();
				foreach($categories as $child_category){
					array_push($child_categories,$child_category->id);
				}
				// assign category and category children posts to unallocated category
				$posts = new Post();
				foreach($posts->get() as $post){
					if($post->category_id == $object_id || in_array($post->category_id,$child_categories)){
						$unallocated_category = new Category();
						$unallocated_category = $unallocated_category->where('name','Unallocated')->get();
						$post->category_id = $unallocated_category->id;
						$post->save();
					}
				}
				// delete all child categories
				foreach($categories as $category){
					if($category->has_children())
						$this->delete_recursive($category->id);
					$category->delete();
				}
				// reset default user post category setting if set
				$groups = new Group();
				foreach($groups->get() as $group){
					$default_categories = new Category();
					$default_user_categories = $default_categories->where('id', $object_id)->get();
					foreach($default_user_categories as $default_user_category){
						if($default_user_category->name == $group->default_user_post_category){
							$group->default_user_post_category = '';
							$group->use_created_categories = 1;
							$group->save();
						}
					}
				}
			}
            $object->delete();
            redirect(base_url('/index.php/admin/module/blog/show_objects/'.$object_type), 'location');
        }

        public function bulk_delete($object_type,$view)
        {
			if($_POST){
				foreach($_POST['id'] as $id){
					$object = new $object_type($id);
					if($object_type == 'Category'){
						// get child categories
						$this->load->model('users');
						$categories = new Category();
						$categories = $categories->where('parent_id', $id)->get();
						$child_categories = array();
						foreach($categories as $child_category){
							array_push($child_categories,$child_category->id);
						}
						// assign category and category children posts to unallocated category
						$posts = new Post();
						foreach($posts->get() as $post){
							if($post->category_id == $id || in_array($post->category_id,$child_categories)){
								$unallocated_category = new Category();
								$unallocated_category = $unallocated_category->where('name','Unallocated')->get();
								$post->category_id = $unallocated_category->id;
								$post->save();
							}
						}
						// delete all child categories
						foreach($categories as $category){
							if($category->has_children())
								$this->delete_recursive($category->id);
							$category->delete();
						}
						// reset default user post category setting if set
						$groups = new Group();
						foreach($groups->get() as $group){
							$default_categories = new Category();
							$default_user_categories = $default_categories->where('id', $id)->get();
							foreach($default_user_categories as $default_user_category){
								if($default_user_category->name == $group->default_user_post_category){
									$group->default_user_post_category = '';
									$group->use_created_categories = 1;
									$group->save();
								}
							}
						}
					}
					$object->delete();
				}
				redirect(base_url('admin/module/blog/'.$view), 'location');
			}
        }

		public function delete_recursive($id) {
			$query = mysql_query("SELECT * FROM be_blog_categories WHERE parent_id='$id'");
			if(mysql_num_rows($query) > 0) {
				while($item = mysql_fetch_array($query)){
					$this->delete_recursive($item['id']);
				}
			}

			$posts = new Post();
			foreach($posts->get() as $post){
				if($post->category_id == $id){
					$unallocated_category = new Category();
					$unallocated_category = $unallocated_category->where('name','Unallocated')->get();
					$post->category_id = $unallocated_category->id;
					$post->save();
				}
			}

			mysql_query("DELETE FROM be_blog_categories WHERE id='$id'");
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
            if($object_type == 'post')
            {
                foreach ($group_id as $key => $value) {
                    if($user->get_group_by_id($value)->allow_posts == '1')
                        $condition = true;
                }
            } elseif ( $object_type == 'category' ) {
                foreach ($group_id as $key => $value) {
                    if($user->get_group_by_id($value)->allow_categories == '1')
                        $condition = true;
                }
            }

            $data['objects'] = $this->get_object($object_type, '', true);
            $data['condition'] = $condition;
			$data['current_page'] = 'blog';
			$data['current_child_page'] = $object_type;
            $this->load->view('backend/show_'.$object_type.'_objects', $data);
        }
        // [MenuItem ("Blog/Settings")]
        public function settings()
        {
            if($_POST)
            {
				$this->BuilderEngine->set_option('blog_active', $this->input->post('blog_active', true));
                $this->BuilderEngine->set_option('be_blog_allow_comments', $this->input->post('allow_comments', true));
                $this->BuilderEngine->set_option('be_blog_comments_private', $this->input->post('comments_private', true));
                $this->BuilderEngine->set_option('be_blog_captcha', $this->input->post('captcha', true));
                $this->BuilderEngine->set_option('be_blog_show_tags', $this->input->post('show_tags', true));
                $this->BuilderEngine->set_option('be_blog_num_tags_displayed', $this->input->post('num_tags_displayed', true));
                $this->BuilderEngine->set_option('be_blog_num_recent_posts_displayed', $this->input->post('num_recent_posts_displayed', true));
                $this->BuilderEngine->set_option('be_blog_num_posts_displayed', $this->input->post('num_posts_displayed', true));
                $this->BuilderEngine->set_option('be_blog_access_groups', $this->input->post('access_groups', true));
                //$this->BuilderEngine->set_option('be_blog_default_module', $_POST['default_module']);
            }
			$data['current_page'] = 'blog';
			$data['current_child_page'] = 'blog_settings';
            $this->load->view('backend/blog_settings',$data); 
        }

        public function show_report($id){
            $comment_report = new Comment_report();
            $data = array(
                'report' => $comment_report->where('id',$id)->get()->all[0]
                );
            $this->load->view('backend/show_report',$data);
        }

        public function delete_comment($id)
        {
            $comment = new Comment($id);
			$comment_reports = new Comment_report();
			foreach($comment_reports->where('comment_id',$id)->get() as $comment_report){
				$comment_report->delete();
			}
            $comment->delete();
            redirect(base_url('/admin/module/blog/show_objects/comment_report'), 'location');
        }
        public function delete_report($id)
        {
            $comment_report = new Comment_report($id);
            $comment_report->delete();
            redirect(base_url('/admin/module/blog/show_objects/comment_report'), 'location');
        }
    }
?>