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


class User_blog extends BE_Controller
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
        $this->user->is_verified();
        $this->load->model('builderengine');
        if($this->builderengine->get_option('user_dashboard_activ') != 'yes')
            redirect("/", 'location');
        if($this->builderengine->get_option('user_dashboard_blog') != 'yes')
            redirect("user/main/dashboard", 'location');
		*/
		if($this->user->is_logged_in())
			redirect(base_url("cp/dashboard"), 'location');
		else
			redirect(base_url("cp/login"), 'location');
    }

    public function add_post($type = '', $id = -1)
    {
        $groups_name = $this->users->get_user_group_name(get_active_user_id());
        $groups = array();
        $user_created_posts = '';
        $user_created_categories = '';
        $default_user_post_category = '';

        foreach ($groups_name as $key => $value) {
            $group = $this->users->get_groups($value);

            if($group[0]->allow_posts)
                $user_created_posts = 1;

            if($group[0]->allow_categories)
                $user_created_categories = 1;

            $default_user_post_category .= $group[0]->default_user_post_category;

            $groups[] = $group[0];
        }

        if(!$this->user->is_logged_in())
            redirect("/user/main/userLogin", 'location');
        else{
            // if($this->builderengine->get_option('user_created_posts') == 'yes' && $type != '')
            if($user_created_posts && $type != '')
            {
                $category = new Category();
                $categores = explode(',', $default_user_post_category);
                $data['default_user_post_category'] = $category->where_in('name',$categores)->get();

                $this->load->model('post');
                $post = new Post($id);
                $data['object'] = $post;
                $data['page'] = ucfirst($type);
                if($this->input->post() && $this->input->post('category_id')){
                    $image_name = mt_rand().'.jpg';
                    $this->load->model('user');
                    $this->user->upload_file('image', 'files/users', $image_name);

                    $_POST['groups_allowed'] = implode(',',$this->users->get_user_group_name($this->user->get_id()));
					if(isset($_FILES['image']) && $_FILES['image']['size'] > 0){
						$_POST['image'] = base_url().'files/users/'.$image_name;
					}elseif(isset($_POST['image1'])){
						$_POST['image'] = $_POST['image1'];
					}else{
						$_POST['image'] = $post->image;
					}
					
					if(isset($_FILES['img']) && !empty($_FILES['img']['tmp_name']))
					{
						$file_name = $_FILES['img']['name'];
						$file_size =$_FILES['img']['size'];
						$file_tmp = $_FILES['img']['tmp_name'];
						$file_type = $_FILES['img']['type'];   
						$file_ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
						$extensions = array("jpeg","jpg","png"); 

						if(!is_dir("files"))
							mkdir("files");
						if(in_array($file_ext,$extensions))
							move_uploaded_file($file_tmp,"files/".$file_name);
						$file_name = base_url().'files/'.$_FILES['img']['name'];
						$img = '<img class="img-responsive" src="'.$file_name.'" >';
					}
					else
						$img ='';
					
					$_POST['text'] .= $img;
					//print_r($_POST);print_r($_FILES);die;
                    $post->create($_POST);
                    redirect('/user/blog/posts', 'location');
                }
				$data['current_page'] = 'blog';
				$data['current_child_page'] = 'posts';				
                $this->show->set_user_backend();
                $this->show->user_backend('blog/add_post',$data);
            }else{
                redirect("user/main/dashboard", 'location');
            }
        }
    }
    public function posts()
    {
        if(!$this->user->is_logged_in())
            redirect("/user/main/userLogin", 'location');
        else{
            $post = new Post(-1);
            $data['objects'] = $post->get();
            $data['id_user'] = $this->user->get_id();
			$data['current_page'] = 'blog';
			$data['current_child_page'] = 'posts';
            $this->show->set_user_backend();
            $this->show->user_backend('blog/show_post_objects',$data);
        }
    }
    public function delete_post($id)
    {
        if(!$this->user->is_logged_in())
            redirect("/user/main/userLogin", 'location');
        else{
            $post = new Post($id);
            $post->delete();
            redirect('/user/blog/posts', 'location');
        }
    }
    public function add_category($type = '', $id = -1)
    {
        $groups_name = $this->users->get_user_group_name(get_active_user_id());
        $groups = array();
        $user_created_posts = '';
        $user_created_categories = '';

        foreach ($groups_name as $key => $value) {
            $group = $this->users->get_groups($value);

            if($group[0]->allow_posts)
                $user_created_posts = 1;

            if($group[0]->allow_categories)
                $user_created_categories = 1;

            $groups[] = $group[0];
        }

        if(!$this->user->is_logged_in())
            redirect("/user/main/userLogin", 'location');
        else{
            // if($this->builderengine->get_option('user_created_categories') == 'yes' && $type != '')
            if($user_created_categories && $type != '')
            {
                $category = new Category($id);
                $data['object'] = $category;
                $data['page'] = ucfirst($type);
                if($this->input->post()){
                    $image_name = mt_rand().'.jpg';
                    $this->load->model('user');
                    $this->user->upload_file('image', 'files/users', $image_name);

                    $_POST['groups_allowed'] = implode(',',$this->users->get_user_group_name($this->user->get_id()));
                    $_POST['user_id'] = $this->user->get_id();
					if(isset($_FILES['image']) && $_FILES['image']['size'] > 0){
						$_POST['image'] = base_url().'files/users/'.$image_name;
					}elseif(isset($_POST['image1'])){
						$_POST['image'] = $_POST['image1'];
					}else{
						$_POST['image'] = $category->image;
					}
                    $category->create($_POST);
                    redirect('/user/blog/categories', 'location');
                }
				$data['current_page'] = 'blog';
				$data['current_child_page'] = 'categories';
                $this->show->set_user_backend();
                $this->show->user_backend('blog/add_category',$data);
            }else{
                redirect("user/main/dashboard", 'location');
            }
        }
    }
    public function categories()
    {
        if(!$this->user->is_logged_in())
            redirect("/user/main/userLogin", 'location');
        else{
            $category = new Category(-1);
            $data['objects'] = $category->get();
            $data['id_user'] = $this->user->get_id();
			$data['current_page'] = 'blog';
			$data['current_child_page'] = 'categories';
            $this->show->set_user_backend();
            $this->show->user_backend('blog/show_category_objects',$data);
        }
    }
    public function delete_category($id)
    {
        if(!$this->user->is_logged_in())
            redirect("/user/main/userLogin", 'location');
        else{
			// get child categories
			$object = new Category($id);
			$this->load->model('users');
			$categories = new Category();
			$categories = $categories->where('parent_id', $object->id)->get();
			$child_categories = array();
			foreach($categories as $child_category){
				array_push($child_categories,$child_category->id);
			}
			// assign category and category children posts to unallocated category
			$posts = new Post();
			foreach($posts->get() as $post){
				if($post->category_id == $object->id || in_array($post->category_id,$child_categories)){
					$unallocated_category = new Category();
					$unallocated_category = $unallocated_category->where('name','Unallocated')->get();
					$post->category_id = $unallocated_category->id;
					$post->save();
				}
			}
			// delete all child categories
			foreach($categories as $category){
				if($category->has_children())
					$this->delete_category_recursive($category->id);
				$category->delete();
			}
			// reset default user post category setting if set
			$groups = new Group();
			foreach($groups->get() as $group){
				$default_categories = new Category();
				$default_user_categories = $default_categories->where('id', $object->id)->get();
				foreach($default_user_categories as $default_user_category){
					if($default_user_category->name == $group->default_user_post_category){
						$group->default_user_post_category = '';
						$group->use_created_categories = 1;
						$group->save();
					}
				}
			}
            $object->delete();
            redirect('/index.php/user/blog/categories', 'location');
        }
    }

	public function delete_category_recursive($id) {

        if(!$this->user->is_logged_in())
            redirect("/user/main/userLogin", 'location');

		$query = mysql_query("SELECT * FROM be_blog_categories WHERE parent_id='$id'");
		if(mysql_num_rows($query) > 0) {
			while($item = mysql_fetch_array($query)){
				$this->delete_category_recursive($item['id']);
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
}
/* End of file user_blog.php */
/* Location: ./application/controllers/user_blog.php */