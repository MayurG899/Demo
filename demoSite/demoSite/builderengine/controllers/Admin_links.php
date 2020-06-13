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

    class Admin_links extends BE_Controller{

        public function Admin_links(){
            parent::__construct();
            $this->user->require_group("Administrators");
            $this->load->model('users');
            $this->load->model('links');
        }
         
        function add()
        {
            $this->show->set_default_breadcrumb(0, "Links", "/admin/links/show");
            $this->show->set_default_breadcrumb(1, "Add", "");
            if($_POST)
            {
				if(empty($_POST['order']))
					$_POST['order'] = 1;
				if(empty($_POST['target']))
					$_POST['target'] = '';					
                $this->links->add($_POST); 
                $this->user->notify('success', "Link added successfully!");
                redirect('/admin/links/show/', 'location'); 
            }
            $data['current_page'] = 'navigation';
			$data['links'] = $this->links->get_all_links();
            $data['groups'] = $this->users->get_groups();
            $this->show->backend("add_link", $data);    
        }
        
        function edit($id)
        {
            $this->show->set_default_breadcrumb(0, "Links", "/admin/links/show");
            $this->show->set_default_breadcrumb(1, "Edit", "");
            $this->load->model('links');
            if($_POST)
            {
				if(empty($_POST['order']))
					$_POST['order'] = 1;
				if(empty($_POST['target']))
					$_POST['target'] = '';	
                $this->links->edit($_POST);
                $this->user->notify('success', "Link edited successfully!");
                header( "refresh:1;url=".base_url()."admin/links/show");
            }    
            $group = new Group();
            $data['groups'] = $group->get()->all;
            $data['current_page'] = 'navigation';
			$data['links'] = $this->links->get_all_links();
            $data['link'] = $this->links->get($id);
            $this->show->backend("edit_link", $data);    
        }

        function delete($id)
        {    
            $this->links->delete($id);
            $this->user->notify('success', "Link deleted successfully!");      
            redirect('/admin/links/show/', 'location');        
        }
        
        function show($view=null)
        {         
            $this->show->set_default_breadcrumb(0, "Links", "/admin/links/show");
            $this->show->set_default_breadcrumb(1, "Show", "");
            $data['current_page'] = 'navigation';
            $this->show->backend("show_links", $data);        
        }
    }
?>
