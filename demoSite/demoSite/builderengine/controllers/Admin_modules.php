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

    class Admin_modules extends BE_Controller{

        public function Admin_modules(){
            parent::__construct();
            $this->user->require_group("Administrators");
            $this->load->model('users');
            $this->load->model('modules_db');
        }
         
        function edit($id)
        {
            $this->show->set_default_breadcrumb(0, "Settings", "");
            $this->show->set_default_breadcrumb(1, "Modules", "/admin/modules/show");
            $this->show->set_default_breadcrumb(2, "Edit", "");

            $data = array();
            if($_POST)
            {
                $this->modules_db->edit($_POST);
                $this->user->notify('success', "Module edited successfully!");    
            }    
            $data['module'] = $this->modules_db->get($id);
            $data['groups'] = $this->users->get_groups();
            $this->show->backend("edit_module", $data);    
        }

        function delete($id)
        {    
            $this->links->delete($id);
            $this->user->notify('success', "Module deleted successfully!");      
            redirect('/admin/links/show/', 'location');        
        }
        
        function show()
        {         
            $this->show->set_default_breadcrumb(0, "Settings", "");
            $this->show->set_default_breadcrumb(1, "Modules", "");
            $this->show->set_default_breadcrumb(2, "Show", "");
            $data['modules'] = $this->modules_db->get_all();
			$data['current_page'] = 'settings';
            $this->show->backend("show_modules", $data);        
        }
    }
?>
