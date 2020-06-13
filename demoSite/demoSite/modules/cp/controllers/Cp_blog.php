<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cp_blog extends Module_Controller
{

    protected function check_login()
    {
        if(!$this->user->is_logged_in())
            redirect(base_url('cp/login'), 'location');
	}

	public function posts()
	{
		$this->check_login();
		$this->load->view('frontend/blog_posts.tpl');
	}

	public function add_post($type = '', $id = null)
	{
		$this->check_login();
		$this->load->view('frontend/blog_post_add_edit.tpl');
	}

	public function delete_post($id)
	{
		$this->check_login();
		if($id)
		{
			$post = new Post($id);
			if($post->exists())
			{
				$post->delete();
				redirect(base_url('cp/blog/posts'),'location');
			}
			show_404();
		}
		show_404();
	}

    public function categories()
    {
        $this->check_login();
		$this->load->view('frontend/blog_categories.tpl');
    }

	public function add_category($type = '', $id = null)
	{
		$this->check_login();
		$this->load->view('frontend/blog_category_add_edit.tpl');
	}

	public function delete_category($id)
	{
		$this->check_login();
		if($id)
		{
			$category = new Category($id);
			if($category->exists())
			{
				$category->delete();
				redirect(base_url('cp/blog/categories'),'location');
			}
			show_404();
		}
		show_404();
	}
}