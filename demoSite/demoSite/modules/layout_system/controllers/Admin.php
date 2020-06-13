<?php
class Admin extends BE_Controller
{
    public function add_product()
    {
        $this->modify_object('Tutorial');
    }
	
    public function show_products()
    {
        $this->show_objects('Tutorial');
    }

    public function modify_object($object_type, $object_id = -1)
    {
        $object = $this->get_object($object_type, $object_id);

        if($_POST)
        {
            $object->create($_POST);
            redirect(base_url('/admin/module/layout_system/show_objects/'.$object_type), 'location');
        }

        $data['view'] = $this->get_view($object_type,  $object_id);
        $this->load->view('backend/modify_object', $data);
    }

    public function delete_object($object_type, $object_id)
    {
        $object = $this->get_object($object_type, $object_id);
        if($object_type == 'Tutorial'){
            $steps = new Tutorial_step();
            $steps = $steps->where('tutorial_id',$object_id)->get();
            $steps->delete_all();
        }
        $object->delete();
        redirect(base_url('/index.php/admin/module/layout_system/show_objects/'.$object_type), 'location');
    }

    public function get_object($object_type, $object_id = -1, $get = false)
    {
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
        $data['objects'] = $this->get_object($object_type, '', true);
        $this->load->view('backend/show_'.$object_type.'_objects', $data);
    }
}