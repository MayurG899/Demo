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

    class Admin extends BE_Controller{
        
        function Admin()
        {
            parent::__construct();
            $this->show->set_default_breadcrumb(0,"Pages", "/admin/module/page/show_pages");
        }

        // [MenuItem ("Pages/Add Page")]    
        function add(){
            $this->load->model("pages");
			$this->load->model("links");
            if($_POST){
				$this->db->where("title",$_POST['title']);
				$query = $this->db->get("pages");
				$result = $query->result();				
				if($_POST['title'] == $result[0]->title || count($result) > 0){
					redirect('admin/module/page/add?error=1','location');
				}else{
					$this->pages->add($_POST, $this->user->get_id());
					$this->user->editor_mode(true);
					redirect(base_url().'page-'.$_POST['slug'].".html", 'location');
				}
            }
                
            $pages_folder = "themes/".$this->BuilderEngine->get_option("active_frontend_theme")."/templates";
            if(is_dir($pages_folder))
            {
                $folder_contents = scandir($pages_folder);
                $page_files = array();
                foreach($folder_contents as $entry)
                {
                    if($entry == "." || $entry ==".." || is_dir($entry))
                        continue;

                    $entry = basename($entry, ".php");
                    array_push($page_files, $entry);
                }
            }
            $data = array();
            if($page_files)
                $data['theme_pages'] = $page_files;
			$data['links'] = $this->links->get_all_links();
			$data['current_page'] = 'webpages';
            $this->load->view("backend/add_page", $data);
        }
        

        

        function edit_page($id){
            $this->load->model("pages");
            if($_POST){
				$this->db->where("title",$_POST['title']);
				$query = $this->db->get("pages");
				$result = $query->result();
				if($result && ($_POST['title'] == $result[0]->title && $id != $result[0]->id)){
					redirect('admin/module/page/edit_page/'.$id.'?error='.$_POST['title'],'location');
				}else{				
					$this->pages->edit_page_link($_POST['old_name'], $_POST);
					$this->pages->edit($_POST['id'], $_POST);
				}
            }
            
            $data['page'] = $this->pages->get($id);
            $this->load->view("backend/edit_page", $data);
        }
        
        function delete_page($id)
        {              
            $this->load->model("pages");
            $this->load->helper('url');
            
            $this->pages->delete($id);
            
            redirect('/admin/module/page/show_pages', 'location');
        }

		public function bulk_delete()
		{
            $this->load->model("pages");
            if($_POST){
				foreach($_POST['id'] as $id){
					$this->pages->delete($id);
				}
            }
            redirect(base_url('admin/module/page/show_pages'), 'location');
		}

        // [MenuItem ("Pages/Show Pages")]
        function show_pages(){
            $this->load->model("pages");
            $this->load->model("users");

            if($_POST)
                $data['pages'] = $this->pages->search($_POST['search']);
            else
                $data['pages'] = $this->pages->search();
            
            foreach($data['pages'] as $key => $post)
            {
                $user = $this->users->get_by_id($post->author);
                $page_array = (array)$post;
                unset($page_array['author']);
                $obj = (object) array_merge( (array)$page_array, array( 'author' => $user ) );
                $data['pages'][$key] = $obj;  
            }

            $data['current_page'] = 'webpages';
            $this->load->view("backend/show_pages", $data);
        }
    }  
?>
